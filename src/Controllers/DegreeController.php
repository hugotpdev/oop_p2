<?php 

    namespace App\Controllers;

    use App\School\Services\DegreeService;
    use App\Infrastructure\Persistence\DegreeRepository;
    use App\Infrastructure\Database\DatabaseConnection;
    use App\School\Entities\Degree;


    class DegreeController{

        function index(){
            echo view('degree');
        }

        function get(){
            try{
                $field = $_GET['field'];
                $value = $_GET['value'];
                $degreeService = new DegreeService();
                $degree = $degreeService->getDegree($field, $value);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($degree);
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
                $degreeService = new DegreeService();
                $degrees = $degreeService->getListDegree($field, $value);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($degrees);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function set(){
            try{
                $data = $_POST;
                $degreeService = new DegreeService();
                $degrees = $degreeService->setDegree($data);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Grado creado correctamente"]);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function delete(){
            try {  
                $id = $_GET['id'];   
                $degreeService = new DegreeService();
                $degrees = $degreeService->deleteDegree($id);
                
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Grado eliminado correctamente"]);
            } catch (Exception $e) {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function createDegreeView(){
            echo view('createDegree');
        }      

              
    }