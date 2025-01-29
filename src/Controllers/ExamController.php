<?php 

    namespace App\Controllers;

    use App\School\Services\ExamService;
    use App\Infrastructure\Persistence\ExamRepository;
    use App\Infrastructure\Database\DatabaseConnection;
    use App\School\Entities\Exam;


    class ExamController{

        function index(){
            echo view('exam');
        }

        function get(){
            try{
                $field = $_GET['field'];
                $value = $_GET['value'];
                $examService = new ExamService();
                $exam = $examService->getExam($field, $value);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($exam);
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
                $examService = new ExamService();
                $exams = $examService->getListExam($field, $value);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($exams);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function set(){
            $data = $_POST;
            try{
                $examService = new ExamService();
                $exams = $examService->setExam($data);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Examen creado correctamente"]);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function delete(){
            try{
                $id = $_GET['id'];
                $examService = new ExamService();
                $exams = $examService->deleteExam($id);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Examen eliminado correctamente"]);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }    
        
        function createExamView(){
            echo view('createExam');
        }  
    }