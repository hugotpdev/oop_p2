<?php 

    namespace App\School\Services;

    use App\School\Services\UserService;
    use App\School\Entities\Teacher;
    use App\School\Entities\User;
    use App\Infrastructure\Persistence\TeacherRepository;
    use App\Infrastructure\Persistence\UserRepository;
    use App\Infrastructure\Database\DatabaseConnection;
    

    class TeacherService{

        private UserService $userService;

        function __construct()
        {
            $this->userService = new UserService();
        }

        function getTeacher($field, $value){
            if ($field == null || $value == null){
                throw new \Exception("No se pudo obtener al profesor");
            }

            try {            
                $teacherRepository = new TeacherRepository(DatabaseConnection::getConnection());
                $teacher = $teacherRepository->get($field, $value);
        
                return $teacher;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function getListTeacher($field, $value){
            try {
                if ((empty($field) && !empty($value)) || (!empty($field) && empty($value))) {
                    throw new \Exception("No se pudo obtener la asignatura");
                }

                $teacherRepository = new TeacherRepository(DatabaseConnection::getConnection());
                $teacher = $teacherRepository->getList($field, $value);
        
                return $teacher;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function setTeacher($data){
            try {
                $firstName = isset($data['firstName']) ? $data['firstName'] : null;
                $lastName = isset($data['lastName']) ? $data['lastName'] : null;
                $email = isset($data['email']) ? $data['email'] : null;
                $password = isset($data['password']) ? $data['password'] : null;
                $department_id = isset($data['department_id']) ? $data['department_id'] : null;

                if ((empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($department_id))) {
                    throw new \Exception("Todos los campos son necesarios");
                }

                $uuid = uniqid();
                $dataUser = [
                    'uuid' => $uuid,
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'email' => $email,
                    'password' => $password,
                    'type' => 'Teacher',
                ];
                
                
                $userId = $this->userService->setUser($dataUser);

                $teacher = new Teacher($uuid, $firstName, $lastName, $email, $password, $userId, $department_id);
                $teacherRepository = new TeacherRepository(DatabaseConnection::getConnection());
                $teacherRepository->set($teacher);
                
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }    
        }

        function deleteTeacher($id){
            try {
                if ($id == null){
                    throw new \Exception("No se ha podido eliminar el profesor");
                }
    
                $teacherRepository = new TeacherRepository(DatabaseConnection::getConnection());
                $teacher = $teacherRepository->get('id', $id);
    
                $teacherRepository->delete($teacher["id"]);
                $this->userService->deleteUser($teacher['user_id']);
                    
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }