<?php 

    namespace App\School\Services;

    use App\School\Services\UserService;
    use App\School\Entities\Student;
    use App\Infrastructure\Persistence\StudentRepository;
    use App\Infrastructure\Database\DatabaseConnection;
    

    class StudentService{

        private UserService $userService;

        function __construct()
        {
            $this->userService = new UserService();
        }

        function getStudent($field, $value){
            if ($field == null || $value == null){
                throw new \Exception("No se pudo obtener al estudiante");
            }

            try {            
                $studentRepository = new StudentRepository(DatabaseConnection::getConnection());
                $student = $studentRepository->get($field, $value);
        
                return $student;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function getListStudent($field, $value){
            try {
                if ((empty($field) && !empty($value)) || (!empty($field) && empty($value))) {
                    throw new \Exception("No se pudo obtener la asignatura");
                }
                $studentRepository = new StudentRepository(DatabaseConnection::getConnection());
                $students = $studentRepository->getList($field, $value);
        
                return $students;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function setStudent($data){
            try {
                $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : null;
                $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : null;
                $email = isset($_POST['email']) ? trim($_POST['email']) : null;
                $dni = isset($_POST['dni']) ? trim($_POST['dni']) : null;
                $password = isset($_POST['password']) ? $_POST['password'] : null;

                if ((empty($firstName) || empty($lastName) || empty($email) || empty($dni) || empty($password))) {
                    throw new \Exception("Todos los campos son necesarios");
                }

                $existEmail = $this->userService->getUser('email', $email);

                if($existEmail != null){
                    throw new \Exception("El email ya esta en uso");
                }

                $studentRepository = new StudentRepository(DatabaseConnection::getConnection());

                $existDNI = $studentRepository->get('dni', $dni);

                if($existDNI != null){
                    throw new \Exception("El email ya esta en uso");
                }

                $uuid = uniqid();
                $dataUser = [
                    'uuid' => $uuid,
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'email' => $email,
                    'password' => $password,
                    'type' => 'Student',
                ];
                
                $userId = $this->userService->setUser($dataUser);
                

                $student = new Student($uuid, $firstName, $lastName, $email, $password, $dni, $userId);
                $studentRepository->set($student);
                
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }    
        }

        function deleteStudent($id){
            try {
                if ($id == null){
                    throw new \Exception("No se ha podido eliminar el profesor");
                }
    
                $studentRepository = new StudentRepository(DatabaseConnection::getConnection());
                $student = $studentRepository->get('id', $id);
    
                $studentRepository->delete($student["id"]);
                $this->userService->deleteUser($student['user_id']);
                    
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }