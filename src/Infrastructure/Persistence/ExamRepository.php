<?php
    namespace App\Infrastructure\Persistence;

    use App\Infrastructure\Database\DatabaseConnection;
    use App\School\Repositories\IExamRepository;
    use App\School\Entities\Exam;

    class ExamRepository implements IExamRepository{
        private \PDO $db;

        function __construct(){
            $this->db= DatabaseConnection::getConnection();
        }

        function get($field, $value){
            $validFields = ['id','subject_id','exam_date','description'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }

            $stmt=$this->db->prepare("SELECT * FROM exams WHERE $field=:value");
            $stmt->execute(['value'=>$value]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        function getList($field, $value){
            if (empty($field) && empty($value)) {
                $stmt = $this->db->query("SELECT * FROM exams");
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }

            $validFields = ['id','subject_id','exam_date','description'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }

            $values = explode(',', $value); 
            $placeholders = implode(',', array_fill(0, count($values), '?'));

            $stmt=$this->db->prepare("SELECT * FROM exams WHERE $field IN ($placeholders)");
            $stmt->execute($values);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }


        function set(Exam $exam){
            $stmt=$this->db->prepare("INSERT INTO exams(subject_id, exam_date, description) 
            VALUES(:subject_id, :exam_date, :description)");
            $stmt->execute([
                'subject_id'=>$exam->getSubjectId(),
                'exam_date'=>$exam->getExamDateString(),
                'description'=>$exam->getDescription(),
            ]);
            
        }

        function delete($id) {
            $stmt = $this->db->prepare("DELETE FROM exams WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }


    }