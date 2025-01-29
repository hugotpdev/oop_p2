<?php 

    namespace App\Controllers;

    use App\School\Services\AssignStudentSubjectService;
    use App\Infrastructure\Persistence\EnrollmentRepository;
    use App\Infrastructure\Persistence\StudentRepository;
    use App\Infrastructure\Persistence\SubjectRepository;
    use App\Infrastructure\Persistence\UserRepository;
    use App\Infrastructure\Database\DatabaseConnection;


    class AssignStudentSubjectController{

        function set(){     
            try {
                $data = $_POST;
                $db = DatabaseConnection::getConnection();
                $assignStudentSubjectService = new AssignStudentSubjectService(new EnrollmentRepository($db), new StudentRepository($db), new SubjectRepository($db), new UserRepository($db));
                $assignStudentSubjectService->setAssignStudentSubjectService($data);
        
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Inscripcion creada correctamente"]);
            } catch (Exception $e) {
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }   
        }
  
    }