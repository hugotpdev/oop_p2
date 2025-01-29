<?php 

    namespace App\Controllers;

    use App\School\Services\TeacherService;
    use App\Infrastructure\Persistence\UserRepository;
    use App\Infrastructure\Persistence\TeacherRepository;
    use App\Infrastructure\Database\DatabaseConnection;
    use App\School\Entities\User;
    use App\School\Entities\Teacher;


    class TeacherController{

        function index(){
            echo view('teacher');
        }

        function get(){
            try{
                $field = $_GET['field'];
                $value = $_GET['value'];
                $teacherService = new TeacherService();
                $teacher = $teacherService->getTeacher($field, $value);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($teacher);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function getList() {
            try{
                $field = $_GET['field'];
                $value = $_GET['value'];
                $teacherService = new TeacherService();
                $teacher = $teacherService->getListTeacher($field, $value);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($teacher);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function set(){
            try{
                $data = $_POST;
                $teacherService = new TeacherService();
                $teacherService->setTeacher($data);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Profesor creado correctamente"]);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }     
        }

        function delete(){
            try{
                $id = $_GET['id'];
                $teacherService = new TeacherService();
                $teacherService->deleteTeacher($id);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Profesor eliminado correctamente"]);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function createTeacherView(){
            echo view('createTeacher');
        }  
          
    }