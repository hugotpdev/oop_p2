<?php 

    namespace App\School\Services;

    use App\School\Entities\Enrollment;
    use App\Infrastructure\Persistence\EnrollmentRepository;
    use App\Infrastructure\Database\DatabaseConnection;
    

    class EnrollmentService{


        function __construct()
        {

        }

        function getEnrollment($field, $value){
            if ($field == null || $value == null){
                throw new \Exception("No se pudo obtener al profesor");
            }

            try {            
                $enrollmentRepository = new EnrollmentRepository(DatabaseConnection::getConnection());
                $enrollment = $enrollmentRepository->get($field, $value);
        
                return $enrollment;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function getListEnrollment($field, $value){
            try {
                if ((empty($field) && !empty($value)) || (!empty($field) && empty($value))) {
                    throw new \Exception("No se pudo obtener la inscripcion");
                }
                $enrollmentRepository = new EnrollmentRepository(DatabaseConnection::getConnection());
                $enrollments = $enrollmentRepository->getList($field, $value);
        
                return $enrollments;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function setEnrollment($data){
            try {
                $student_id = isset($data['student_id']) ? $data['student_id'] : null;
                $subject_id = isset($data['subject_id']) ? $data['subject_id'] : null;

                if ((empty($student_id) || empty($subject_id))) {
                    throw new \Exception("Todos los campos son necesarios");
                }

                $enrollment = new Enrollment($student_id, $subject_id);
                $enrollmentRepository = new enrollmentRepository(DatabaseConnection::getConnection());
                $enrollmentRepository->set($enrollment); 
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }    
        }

        function deleteEnrollment($id){
            try {
                if ($id == null){
                    throw new \Exception("No se ha podido eliminar ls inscripcion");
                }
    
                $enrollmentRepository = new enrollmentRepository(DatabaseConnection::getConnection());
                $enrollmentRepository->delete($id);            
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }