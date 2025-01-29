<?php

namespace Tests\Feature;

use App\School\Entities\Student;
use App\School\Entities\Subject;
use App\School\Entities\Enrollment;
use App\School\Services\AssignStudentSubjectService;
use App\School\Repositories\IEnrollmentRepository;
use App\School\Repositories\IStudentRepository;
use App\School\Repositories\ISubjectRepository;
use App\School\Repositories\IUserRepository;
use PHPUnit\Framework\TestCase;

class AssignStudentSubjectTest extends TestCase {

    /*
        Verifica el caso exitoso donde un estudiante es asignado a una asignatura si no está previamente inscrito en ella.
     */
    public function testAssignStudentToSubject(): void {
        $enrollmentRepository = $this->createMock(IEnrollmentRepository::class);
        $studentRepository = $this->createMock(IStudentRepository::class);
        $subjectRepository = $this->createMock(ISubjectRepository::class);
        $userRepository = $this->createMock(IUserRepository::class);

        $studentId = '1';
        $subjectId = '101';

        $subjectData = ['id' => '101', 'name' => 'Mathematics', 'course_id' => '1'];
        $studentData = [
            'id' => '1',
            'user_id' => '123',
            'dni' => 'A12345678',
        ];
        $userData = [
            'uuid' => 'uuid-1234',
            'first_name' => 'Hugo',
            'last_name' => 'Tabla',
            'email' => 'hugo@gmail.com',
            'password' => 'sdgvsgv',
        ];

        $subjectRepository->expects($this->once())
            ->method('get')
            ->with('id', $subjectId)
            ->willReturn($subjectData);

        $studentRepository->expects($this->once())
            ->method('get')
            ->with('id', $studentId)
            ->willReturn($studentData);

        $userRepository->expects($this->once())
            ->method('get')
            ->with('id', $studentData['user_id'])
            ->willReturn($userData);

        $enrollmentRepository->expects($this->once())
            ->method('getList')
            ->with('student_id', $studentId)
            ->willReturn([]);

      
        $enrollmentRepository->expects($this->once())
            ->method('set')
            ->with($this->isInstanceOf(Enrollment::class));

        
        $useCase = new AssignStudentSubjectService(
            $enrollmentRepository,
            $studentRepository,
            $subjectRepository,
            $userRepository
        );

        $data = [
            'student_id' => $studentId,
            'subject_id' => $subjectId,
        ];

        $useCase->setAssignStudentSubjectService($data);

        $subject = new Subject($subjectData['name'], $subjectData['course_id']);
        $subject->setId($subjectData['id']);
        $student = new Student(
            $userData['uuid'],
            $userData['first_name'],
            $userData['last_name'],
            $userData['email'],
            $userData['password'],
            $studentData['dni'],
            $studentData['user_id']
        );
        $student->setId($studentData['id']);

        $enrollment = new Enrollment($student, $subject);

        $this->assertInstanceOf(Enrollment::class, $enrollment);
        $this->assertEquals($student, $enrollment->getStudent());
        $this->assertEquals($subject, $enrollment->getSubject());
    }

    /*
        Verifica el caso en el que un estudiante intenta inscribirse en una asignatura en la que ya está inscrito. 
        Se espera que se lance una excepción, indicando que el estudiante ya está inscrito.
    */

    public function testAssignStudentToSubjectAlreadyEnrolled(): void {
        $enrollmentRepository = $this->createMock(IEnrollmentRepository::class);
        $studentRepository = $this->createMock(IStudentRepository::class);
        $subjectRepository = $this->createMock(ISubjectRepository::class);
        $userRepository = $this->createMock(IUserRepository::class);

        $studentId = '1';
        $subjectId = '101';

        $subjectData = ['id' => '101', 'name' => 'Mathematics', 'course_id' => '1'];
        $studentData = [
            'id' => '1',
            'user_id' => '123',
            'dni' => 'A12345678',
        ];
        $userData = [
            'uuid' => 'uuid-1234',
            'first_name' => 'Hugo',
            'last_name' => 'Tabla',
            'email' => 'hugo@gmail.com',
            'password' => 'sdgvsgv',
        ];

        $subjectRepository->expects($this->once())
            ->method('get')
            ->with('id', $subjectId)
            ->willReturn($subjectData);

        $studentRepository->expects($this->once())
            ->method('get')
            ->with('id', $studentId)
            ->willReturn($studentData);

        $userRepository->expects($this->once())
            ->method('get')
            ->with('id', $studentData['user_id'])
            ->willReturn($userData);

        $enrollmentRepository->expects($this->once())
            ->method('getList')
            ->with('student_id', $studentId)
            ->willReturn([
                ['subject_id' => $subjectId] 
            ]);

        $useCase = new AssignStudentSubjectService(
            $enrollmentRepository,
            $studentRepository,
            $subjectRepository,
            $userRepository
        );

        $data = [
            'student_id' => $studentId,
            'subject_id' => $subjectId,
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('El estudiante ya esta inscrito a la asignatura');

        $useCase->setAssignStudentSubjectService($data);
    }
}
