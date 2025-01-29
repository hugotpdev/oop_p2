<?php
namespace Tests\Feature;

use App\School\Entities\Teacher;
use App\School\Entities\Department;
use App\School\Services\AssingTeacherDepartmentService;
use App\School\Repositories\ITeacherRepository;
use App\School\Repositories\IDepartmentRepository;
use App\School\Repositories\IUserRepository;
use PHPUnit\Framework\TestCase;

class AssignTeacherToDepartmentTest extends TestCase {
    public function testAssignTeacherToDepartment(): void {
        $teacherRepository = $this->createMock(ITeacherRepository::class);
        $userRepository = $this->createMock(IUserRepository::class);
        $departmentRepository = $this->createMock(IDepartmentRepository::class);

        $departmentData = [
            'id' => '101',
            'name' => 'Mathematics'
        ];
        $userId = 63;

        $departmentRepository->expects($this->once())
            ->method('get')
            ->with('id', '101')
            ->willReturn($departmentData);

        $userRepository->expects($this->once())
            ->method('set')
            ->willReturn($userId);

        $teacherRepository->expects($this->once())
            ->method('set')
            ->with($this->isInstanceOf(Teacher::class));

        $useCase = new AssingTeacherDepartmentService($teacherRepository, $userRepository, $departmentRepository);

        $data = [
            'firstName' => 'Hugo',
            'lastName' => 'Tabla',
            'email' => 'hugo@gmail.com',
            'password' => 'sdgvsgv',
            'department_id' => '101'
        ];

        $teacher = $useCase->setAssingTeacherDepartmentService($data);

        // Validaciones explícitas
        $this->assertEquals('Mathematics', $teacher->getDepartment()->getName());
        $this->assertEquals('101', $teacher->getDepartment()->getId());
    }
}
