<?php
    namespace App\Infrastructure\Persistence;

    use App\Infrastructure\Database\DatabaseConnection;
    use App\School\Repositories\ICourseRepository;
    use App\School\Entities\Course;

    class CourseRepository implements ICourseRepository{
        private \PDO $db;

        function __construct(){
            $this->db= DatabaseConnection::getConnection();
        }

        function get($field, $value){
            $validFields = ['id','name','degree_id'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }
            
            $stmt=$this->db->prepare("SELECT * FROM courses WHERE $field=:value");
            $stmt->execute(['value'=>$value]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        function getList($field, $value){
            if (empty($field) && empty($value)) {
                $stmt = $this->db->query("SELECT * FROM courses");
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }

            $validFields = ['id','name','degree_id'];            
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }

            $values = explode(',', $value); 
            $placeholders = implode(',', array_fill(0, count($values), '?'));

            $stmt=$this->db->prepare("SELECT * FROM courses WHERE $field IN ($placeholders)");
            $stmt->execute($values);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }


        function set(Course $course){
            $stmt=$this->db->prepare("INSERT INTO courses(name, degree_id) 
            VALUES(:name, :degree_id)");
            $stmt->execute([
                'name'=>$course->getName(),
                'degree_id'=>$course->getDegreeId(),
            ]);
            
        }

        function delete($id) {
            $stmt = $this->db->prepare("DELETE FROM courses WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }


    }