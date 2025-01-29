<?php
    namespace App\Infrastructure\Persistence;

    use App\Infrastructure\Database\DatabaseConnection;
    use App\School\Repositories\IStudentRepository;
    use App\School\Entities\Student;
    use DateTime;

    class StudentRepository implements IStudentRepository{
        private \PDO $db;

        function __construct(){
            $this->db= DatabaseConnection::getConnection();
        }

        function set(Student $student){
            $stmt=$this->db->prepare("INSERT INTO students(user_id, dni) 
            VALUES(:user_id, :dni)");
            $stmt->execute([
                'user_id'=>$student->getUserId(),
                'dni'=>$student->getDni(),
            ]);
            
        }

        function getList($field, $value){           
            if (empty($field) && empty($value)) {
                $stmt = $this->db->query("SELECT * FROM students");
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }

            $validFields = ['id','user_id','dni','enrollment_year'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }

            $values = explode(',', $value); 
            $placeholders = implode(',', array_fill(0, count($values), '?'));

            $stmt = $this->db->prepare("SELECT * FROM students WHERE $field IN ($placeholders)");
        
            $stmt->execute($values);
        
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        function get($field, $value){
            $validFields = ['id','user_id','dni','enrollment_year'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }
            
            $stmt=$this->db->prepare("SELECT * FROM students WHERE $field=:value");
            $stmt->execute(['value'=>$value]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        function delete($id) {
            $stmt = $this->db->prepare("DELETE FROM students WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }


    }