<?php 

    namespace App\Controllers;

    use App\School\Services\CourseService;
    use App\School\Entities\Course;


    class CourseController{

        function index(){
            echo view('course');
        }

        function get(){
            try{
                $field = $_GET['field'];
                $value = $_GET['value'];
                $courseService = new CourseService();
                $course = $courseService->getCourse($field, $value);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($course);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function getList() {
            try {
                $field = $_GET['field'];
                $value = $_GET['value'];
                $courseService = new CourseService();
                $courses = $courseService->getListCourse($field, $value);
        
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($courses);
            } catch (Exception $e) {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function set(){     
            try {
                $data = $_POST;
                $courseService = new CourseService();
                $courses = $courseService->setCourse($data);
        
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Curso creado correctamente"]);
            } catch (Exception $e) {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }   
        }

        function delete(){
            try {
                $id = $_GET['id'];
                $courseService = new CourseService();
                $courses = $courseService->deleteCourse($id);
        
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Curso eliminado correctamente"]);
            } catch (Exception $e) {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }   
        }  
        
        function createCourseView(){
            echo view('createCourse');
        }      
    }