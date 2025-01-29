<?php 

    namespace App\Controllers;

    use App\School\Services\EnrollmentService;
    use App\Infrastructure\Persistence\EnrollmentRepository;
    use App\Infrastructure\Database\DatabaseConnection;
    use App\School\Entities\Enrollment;


    class EnrollmentController{

        function index(){
            echo view('enrollment');
        }

        function get(){
            try{
                $field = $_GET['field'];
                $value = $_GET['value'];
                $enrollmentService = new EnrollmentService();
                $enrollment = $enrollmentService->getEnrollment($field, $value);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($enrollment);
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
                $enrollmentService = new EnrollmentService();
                $enrollments = $enrollmentService->getListEnrollment($field, $value);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($enrollments);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function set(){
            try{
                $data = $_POST;
                $enrollmentService = new EnrollmentService();
                $enrollment = $enrollmentService->setEnrollment($data);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Inscripcion creada correctamente"]);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function delete(){
            try{
                $id = $_GET['id'];
                $enrollmentService = new EnrollmentService();
                $enrollment = $enrollmentService->deleteEnrollment($id);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Inscripcion eliminada correctamente"]);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        function createEnrollmentView(){
            echo view('createEnrollment');
        }

              
    }