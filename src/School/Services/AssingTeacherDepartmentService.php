<?php 

    namespace App\School\Services;

    use App\School\Entities\User;
    use App\School\Entities\Teacher;
    use App\School\Entities\Department;
    use App\School\Repositories\ITeacherRepository;
    use App\School\Repositories\IUserRepository;
    use App\School\Repositories\IDepartmentRepository;

    class AssingTeacherDepartmentService{

        private ITeacherRepository $iTeacherRepository;
        private IUserRepository $iUserRepository;
        private IDepartmentRepository $iDepartmentRepository;
        

        function __construct($teacherRepository, $userRepository, $departmentRepository)
        {
            $this->iTeacherRepository = $teacherRepository;
            $this->iUserRepository = $userRepository;
            $this->iDepartmentRepository = $departmentRepository;
        }

        function setAssingTeacherDepartmentService($data){
            // Creo el teacher y lo asigno ya que mi base de datos no permite crear un teacher sin un departament_id
            try {
                $firstName = isset($data['firstName']) ? $data['firstName'] : null;
                $lastName = isset($data['lastName']) ? $data['lastName'] : null;
                $email = isset($data['email']) ? trim($data['email']) : null;
                $password = isset($data['password']) ? $data['password'] : null;
                $department_id = isset($data['department_id']) ? $data['department_id'] : null;

                if ((empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($department_id))) {
                    throw new \Exception("Todos los campos son necesarios");
                }

                $department = $this->iDepartmentRepository->get('id', $department_id);

                if(!$department){
                    throw new \Exception("El departamento no existe");
                }

                $existEmail = $this->iUserRepository->get('email', $email);

                if($existEmail != null){
                    throw new \Exception("El email ya esta en uso");
                }

                $departmentInstance = new Department($department['name']);
                $departmentInstance->setId($department_id);

                $uuid = uniqid();
                
                $user = new User($uuid, $firstName, $lastName, $email, $password, 'Teacher');
                
                $userId = $this->iUserRepository->set($user);

                $teacher = new Teacher($uuid, $firstName, $lastName, $email, $password, $userId, $departmentInstance);

                $this->iTeacherRepository->set($teacher);

                return $teacher;
                
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }    
        }
                
        
    }