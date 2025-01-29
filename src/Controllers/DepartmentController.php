<?php 

    namespace App\Controllers;

    use App\School\Entities\Department;
    use App\School\Services\DepartmentService;


    class DepartmentController{

        function index(){
            echo view('department');
        }

        function get(){
            try{
                $field = $_GET['field'];
                $value = $_GET['value'];
                $departmentService = new DepartmentService();
                $department = $departmentService->getDepartment($field, $value);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($department);
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
                $departmentService = new DepartmentService();
                $departments = $departmentService->getListDepartment($field, $value);
        
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($departments);
            } catch (Exception $e) {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function set(){
            try {
                $data = $_POST;
                $departmentService = new DepartmentService();
                $department = $departmentService->setDepartment($data);
        
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Departamento creado correctamente"]);
            } catch (Exception $e) {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }  
        }

        function delete(){
            try {
                $id = $_GET['id'];
                $departmentService = new DepartmentService();
                $department = $departmentService->deleteDepartment($id);
        
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Departamento eliminado correctamente"]);
            } catch (Exception $e) {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }   
        }    
        
        function createDepartmentView(){
            echo view('createDepartment');
        }  
    }