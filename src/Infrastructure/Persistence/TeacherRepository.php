<?php
    namespace App\Infrastructure\Persistence;

    use App\Infrastructure\Database\DatabaseConnection;
    use App\School\Repositories\ITeacherRepository;
    use App\School\Entities\Teacher;

    class TeacherRepository implements ITeacherRepository{
        private \PDO $db;

        function __construct($db){
            $this->db= $db;
        }

        function set(Teacher $teacher){
            $department = $teacher->getDepartment();
            $stmt=$this->db->prepare("INSERT INTO teachers(user_id, department_id) 
            VALUES(:user_id, :department_id)");
            $stmt->execute([
                'user_id'=>$teacher->getUserId(),
                'department_id'=> $department->getId(),
            ]);
            
        }

        function getList($field, $value){
            if (empty($field) && empty($value)) {
                $stmt = $this->db->query("SELECT * FROM teachers");
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }

            $validFields = ['id','course_id','department_id'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }
        
            $values = explode(',', $value); 
            $placeholders = implode(',', array_fill(0, count($values), '?'));
        

            $stmt = $this->db->prepare("SELECT * FROM teachers WHERE $field IN ($placeholders)");
        
            $stmt->execute($values);
        
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        function get($field, $value){
            $validFields = ['id','course_id','department_id'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }
            
            $stmt=$this->db->prepare("SELECT * FROM teachers WHERE $field=:value");
            $stmt->execute(['value'=>$value]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        function delete($id) {
            $stmt = $this->db->prepare("DELETE FROM teachers WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }


    }