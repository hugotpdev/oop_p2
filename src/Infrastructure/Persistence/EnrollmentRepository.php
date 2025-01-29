<?php
    namespace App\Infrastructure\Persistence;

    use App\Infrastructure\Database\DatabaseConnection;
    use App\School\Repositories\IEnrollmentRepository;
    use App\School\Entities\Enrollment;

    class EnrollmentRepository implements IEnrollmentRepository{
        private \PDO $db;

        function __construct(){
            $this->db= DatabaseConnection::getConnection();
        }

        function get($field, $value){
            $validFields = ['id','student_id','subject_id', 'enrollment_date'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }

            $stmt=$this->db->prepare("SELECT * FROM enrollments WHERE $field=:value");
            $stmt->execute(['value'=>$value]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        function getList($field, $value){            
            if (empty($field) && empty($value)) {
                $stmt = $this->db->query("SELECT * FROM enrollments");
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }

            $validFields = ['id','student_id','subject_id', 'enrollment_date'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }
            
            $values = explode(',', $value);
            $placeholders = implode(',', array_fill(0, count($values), '?'));
            
            
            $stmt = $this->db->prepare("SELECT * FROM enrollments WHERE $field IN ($placeholders)");
            $stmt->execute($values);

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }


        function set(Enrollment $enrollment){
            $student = $enrollment->getStudent();
            $subject = $enrollment->getSubject();
            $stmt=$this->db->prepare("INSERT INTO enrollments(student_id, subject_id) 
            VALUES(:student_id, :subject_id)");
            $stmt->execute([
                'student_id'=>$student->getId(),
                'subject_id'=>$subject->getId(),
            ]);
            
        }

        function delete($id) {
            $stmt = $this->db->prepare("DELETE FROM enrollments WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }


    }