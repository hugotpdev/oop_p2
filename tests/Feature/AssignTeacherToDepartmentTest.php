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
        // Mock de repositorios
        $teacherRepository = $this->createMock(ITeacherRepository::class);
        $userRepository = $this->createMock(IUserRepository::class);
        $departmentRepository = $this->createMock(IDepartmentRepository::class);

        // Datos de prueba
        $departmentData = [
            'id' => '101',
            'name' => 'Mathematics'
        ];
        $userId = 63;

        // Crear un mock para el método `get` del repositorio de departamentos
        $departmentRepository->expects($this->once())
            ->method('get')
            ->with('id', '101')
            ->willReturn($departmentData);

        // Simular el guardado del usuario y devolver su ID
        $userRepository->expects($this->once())
            ->method('set')
            ->willReturn($userId);

        // Verificar que el repositorio de profesores guarda un objeto correcto
        $teacherRepository->expects($this->once())
            ->method('set')
            ->with($this->isInstanceOf(Teacher::class));

        // Caso de uso
        $useCase = new AssingTeacherDepartmentService($teacherRepository, $userRepository, $departmentRepository);

        // Ejecutar el caso de uso con datos de prueba
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
