<?php 

    namespace App\School\Services;

    use App\School\Entities\Course;
    use App\Infrastructure\Persistence\CourseRepository;
    use App\Infrastructure\Database\DatabaseConnection;
    

    class CourseService{

        

        function __construct()
        {
            
        }

        function getCourse($field, $value){
            if ($field == null || $value == null){
                throw new \Exception("No se pudo obtener el curso");
            }

            try {            
                $courseRepository = new CourseRepository(DatabaseConnection::getConnection());
                $course = $courseRepository->get($field, $value);
        
                return $course;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function getListCourse($field, $value){
            try {
                if ((empty($field) && !empty($value)) || (!empty($field) && empty($value))) {
                    throw new \Exception("No se pudo obtener el curso");
                }
                $courseRepository = new CourseRepository(DatabaseConnection::getConnection());
                $courses = $courseRepository->getList($field, $value);
        
                return $courses;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function setCourse($data){
            try {
                $name = isset($data['name']) ? $data['name'] : null;
                $degree_id = isset($data['degree_id']) ? $data['degree_id'] : null;

                if ((empty($name) || empty($degree_id))) {
                    throw new \Exception("Todos los campos son necesarios");
                }
                // Comprobar su el grado existe
                $course = new Course($name, $degree_id);
                $courseRepository = new CourseRepository(DatabaseConnection::getConnection());
                $courseRepository->set($course);
                
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }    
        }

        function deleteCourse($id){
            try {
                if ($id == null){
                    throw new \Exception("No se ha podido eliminar el profesor");
                }
    
                $courseRepository = new CourseRepository(DatabaseConnection::getConnection());
                $courseRepository->delete($id);
                    
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }