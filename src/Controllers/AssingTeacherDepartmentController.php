<?php 

    namespace App\Controllers;

    use App\School\Services\AssingTeacherDepartmentService;
    use App\Infrastructure\Database\DatabaseConnection;
    use App\Infrastructure\Persistence\TeacherRepository;
    use App\Infrastructure\Persistence\UserRepository;
    use App\Infrastructure\Persistence\DepartmentRepository;


    class AssingTeacherDepartmentController{

        function set(){     
            try {
                $data = $_POST;
                $db = DatabaseConnection::getConnection();
                $assingTeacherDepartmentService = new AssingTeacherDepartmentService(new TeacherRepository($db), new UserRepository($db), new DepartmentRepository($db));
                $assingTeacherDepartmentService->setAssingTeacherDepartmentService($data);
        
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Profesor creado correctamente"]);
            } catch (Exception $e) {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }   
        }
  
    }