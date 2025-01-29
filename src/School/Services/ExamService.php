<?php 

    namespace App\School\Services;

    use App\School\Entities\Exam;
    use App\Infrastructure\Persistence\ExamRepository;
    use App\Infrastructure\Database\DatabaseConnection;
    

    class ExamService{


        function __construct()
        {

        }

        function getExam($field, $value){
            if ($field == null || $value == null){
                throw new \Exception("No se pudo obtener al profesor");
            }

            try {            
                $examRepository = new ExamRepository(DatabaseConnection::getConnection());
                $exam = $examRepository->get($field, $value);
        
                return $exam;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function getListExam($field, $value){
            try {
                if ((empty($field) && !empty($value)) || (!empty($field) && empty($value))) {
                    throw new \Exception("No se pudo obtener la asignatura");
                }
                $examRepository = new ExamRepository(DatabaseConnection::getConnection());
                $exams = $examRepository->getList($field, $value);
        
                return $exams;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function setExam($data){
            try {
                $subject_id = isset($data['subject_id']) ? $data['subject_id'] : null;
                $exam_date = isset($data['exam_date']) ? $data['exam_date'] : null;
                $description = isset($data['description']) ? $data['description'] : null;

                if ((empty($subject_id) || empty($exam_date) || empty($description))) {
                    throw new \Exception("Todos los campos son necesarios");
                }

                $exam_date = new \DateTime($exam_date);

                $exam = new Exam($subject_id, $exam_date, $description);
                $examRepository = new ExamRepository(DatabaseConnection::getConnection());
                $examRepository->set($exam);   
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }    
        }

        function deleteExam($id){
            try {
                if ($id == null){
                    throw new \Exception("No se ha podido eliminar el examen");
                }
    
                $examRepository = new ExamRepository(DatabaseConnection::getConnection());
                $examRepository->delete($id);            
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }