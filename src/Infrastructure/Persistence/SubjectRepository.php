<?php
    namespace App\Infrastructure\Persistence;

    use App\Infrastructure\Database\DatabaseConnection;
    use App\School\Repositories\ISubjectRepository;
    use App\School\Entities\Subject;

    class SubjectRepository implements ISubjectRepository{
        private \PDO $db;

        function __construct(){
            $this->db= DatabaseConnection::getConnection();
        }

        function get($field, $value){
            $validFields = ['id','course_id','name'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }

            $stmt=$this->db->prepare("SELECT * FROM subjects WHERE $field=:value");
            $stmt->execute(['value'=>$value]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        function getList($field, $value) {            
            if (empty($field) && empty($value)) {
                $stmt = $this->db->query("SELECT * FROM subjects");
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }

            $validFields = ['id','course_id','name'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }
        
            $values = explode(',', $value); 
            $placeholders = implode(',', array_fill(0, count($values), '?'));
        

            $stmt = $this->db->prepare("SELECT * FROM subjects WHERE $field IN ($placeholders)");
        
            $stmt->execute($values);
        
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        


        function set(Subject $subject){
            $stmt=$this->db->prepare("INSERT INTO subjects(name, course_id) 
            VALUES(:name, :course_id)");
            $stmt->execute([
                'name'=>$subject->getName(),
                'course_id'=>$subject->getCourseId(),
            ]);
            
        }

        function delete($id) {
            $stmt = $this->db->prepare("DELETE FROM subjects WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }


    }