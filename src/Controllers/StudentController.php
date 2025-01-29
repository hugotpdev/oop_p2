<?php 

    namespace App\Controllers;

    use App\School\Services\StudentService;
    use App\Infrastructure\Persistence\UserRepository;
    use App\Infrastructure\Persistence\StudentRepository;
    use App\Infrastructure\Database\DatabaseConnection;
    use App\School\Entities\User;
    use App\School\Entities\Student;
    use DateTime;


    class StudentController{

        function index(){
            echo view('student');
        }

        function get(){
            try {     
                $field = $_GET['field'];
                $value = $_GET['value'];   

                $studentService = new StudentService();
                $student = $studentService->getStudent($field, $value);
        
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($student);
            } catch (Exception $e) {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function getList() {
            try {
                $field = $_GET['field'];
                $value = $_GET['value'];
                $studentService = new StudentService();
                $students = $studentService->getListStudent($field, $value);
        
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($students);
            } catch (Exception $e) {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function set(){ 
            try{
                $data = $_POST;
                $studentService = new StudentService();
                $studentService->setStudent($data);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Estudiante creado correctamente"]);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }  
        }

        function delete(){
            try{
                $id = $_GET['id'];
                $studentService = new StudentService();
                $studentService->deleteStudent($id);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Estudiante eliminado correctamente"]);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        

        function createStudentView(){
            echo view('createStudent');
        }                
    }