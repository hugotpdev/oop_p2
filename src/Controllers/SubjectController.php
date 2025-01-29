<?php 

    namespace App\Controllers;

    use App\School\Services\SubjectService;
    use App\Infrastructure\Persistence\SubjectRepository;
    use App\Infrastructure\Database\DatabaseConnection;
    use App\School\Entities\Subject;


    class SubjectController{

        function index(){
            echo view('subject');
        }

        function get(){
            try{
                $field = $_GET['field'];
                $value = $_GET['value'];
                $subjectService = new SubjectService();
                $subject = $subjectService->getSubject($field, $value);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($subject);
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
                $subjectService = new SubjectService();
                $subjects = $subjectService->getListSubject($field, $value);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($subjects);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function set(){
            try{
                $data = $_POST;
                $subjectService = new SubjectService();
                $subjects = $subjectService->setSubject($data);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Asignatura creada correctamente"]);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function delete(){
            try{
                $id = $_GET['id'];
                $subjectService = new SubjectService();
                $subjects = $subjectService->deleteSubject($id);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Asignatura eliminada correctamente"]);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }   
        
        function createSubjectView(){
            echo view('createSubject');
        }  
    }