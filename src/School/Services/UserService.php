<?php 

    namespace App\School\Services;
    
    use App\School\Entities\Teacher;
    use App\School\Entities\User;
    use App\Infrastructure\Persistence\TeacherRepository;
    use App\Infrastructure\Persistence\UserRepository;
    use App\Infrastructure\Database\DatabaseConnection;

    class UserService{


        function __construct()
        {

        }

        function getUser($field, $value){
            try {    
                if ($field == null || $value == null){
                    throw new \Exception("No se pudo obtener al usuario");
                }        
                $userRepository = new UserRepository(DatabaseConnection::getConnection());
                $user = $userRepository->get($field, $value);
        
                return $user;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function getListUser($field, $value){
            try {

                if (empty($field) || empty($value)) {
                    throw new \Exception("No se pudo obtener al usuario");
                }

                $userRepository = new UserRepository(DatabaseConnection::getConnection());
                $user = $userRepository->getList($field, $value);
        
                return $user;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function setUser($data){
            try {
                $uuid = isset($data['uuid']) ? $data['uuid'] : null;
                $firstName = isset($data['firstName']) ? $data['firstName'] : null;
                $lastName = isset($data['lastName']) ? $data['lastName'] : null;
                $email = isset($data['email']) ? $data['email'] : null;
                $password = isset($data['password']) ? $data['password'] : null;
                $type = isset($data['type']) ? $data['type'] : null;

                if ((empty($uuid) || empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($type))) {
                    throw new \Exception("Todos los campos son necesarios");
                }

                $user = new User($uuid, $firstName, $lastName, $email, $password, $type);

                $userRepository = new UserRepository(DatabaseConnection::getConnection());
                return $userRepository->set($user);
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }    
        }

        function deleteUser($id){
            try {
                if ($id == null){
                    throw new \Exception("No se ha podido eliminar el usuario");
                } 
    
                $userRepository = new UserRepository(DatabaseConnection::getConnection());
                $userRepository->delete($id);
                    
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }