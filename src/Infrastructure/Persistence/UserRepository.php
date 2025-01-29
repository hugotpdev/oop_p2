<?php
    namespace App\Infrastructure\Persistence;

    use App\Infrastructure\Database\DatabaseConnection;
    use App\School\Repositories\IUserRepository;
    use App\School\Entities\User;
    use DateTime;

    class UserRepository implements IUserRepository{
        private \PDO $db;

        function __construct(\PDO $db){

            $this->db=$db;
        }

        function set(User $user){
            $stmt=$this->db->prepare("INSERT INTO users(uuid, first_name, last_name, email, password, user_type) 
            VALUES(:uuid, :first_name, :last_name, :email, :password, :user_type)");
            $stmt->execute([
                'uuid'=>$user->getUuid(),
                'first_name'=>$user->getFirstName(),
                'last_name'=>$user->getLastName(),
                'email'=>$user->getEmail(),
                'password'=>$user->getPassword(),
                'user_type'=>$user->getUserType()
            ]);
            

            // Devolver el ID del usuario
            return $this->db->lastInsertId();
        }

        function get($field, $value){
            $validFields = ['id','uuid','first_name', 'last_name', 'email', 'password', 'created_at', 'updated_at', 'user_type'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }

            $stmt=$this->db->prepare("SELECT * FROM users WHERE $field=:value");
            $stmt->execute(['value'=>$value]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        function delete($id) {
            $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }

        function getList($field, $value){
            if (empty($field) && empty($value)) {
                $stmt = $this->db->query("SELECT * FROM users");
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }

            $validFields = ['id','uuid','first_name', 'last_name', 'email', 'password', 'created_at', 'updated_at', 'user_type'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }

            $values = explode(',', $value);
            $placeholders = implode(',', array_fill(0, count($values), '?'));
            $stmt = $this->db->prepare("SELECT * FROM users WHERE $field IN ($placeholders)");
            $stmt->execute($values);

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    }