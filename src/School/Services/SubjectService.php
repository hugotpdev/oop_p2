<?php 

    namespace App\School\Services;

    use App\School\Entities\Subject;
    use App\Infrastructure\Persistence\SubjectRepository;
    use App\Infrastructure\Database\DatabaseConnection;
    

    class SubjectService{


        function __construct()
        {

        }

        function getSubject($field, $value){
            if ($field == null || $value == null){
                throw new \Exception("No se pudo obtener al profesor");
            }

            try {            
                $subjectRepository = new SubjectRepository(DatabaseConnection::getConnection());
                $subject = $subjectRepository->get($field, $value);
        
                return $subject;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function getListSubject($field, $value){
            try {
                if ((empty($field) && !empty($value)) || (!empty($field) && empty($value))) {
                    throw new \Exception("No se pudo obtener la asignatura");
                }
                $subjectService = new SubjectRepository(DatabaseConnection::getConnection());
                $subjects = $subjectService->getList($field, $value);
        
                return $subjects;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function setSubject($data){
            try {
                $name = isset($data['name']) ? $data['name'] : null;
                $course_id = isset($data['course_id']) ? $data['course_id'] : null;

                if ((empty($name) || empty($course_id))) {
                    throw new \Exception("Todos los campos son necesarios");
                }

                $subject = new Subject($name, $course_id);
                $subjectRepository = new SubjectRepository(DatabaseConnection::getConnection());
                $subjectRepository->set($subject);    
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }    
        }

        function deleteSubject($id){
            try {
                if ($id == null){
                    throw new \Exception("No se ha podido eliminar el profesor");
                }
                
                $subjectRepository = new SubjectRepository(DatabaseConnection::getConnection());
                $subject = $subjectRepository->delete($id);            
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }