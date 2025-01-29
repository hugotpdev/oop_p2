<?php 

    namespace App\Controllers;

    use App\School\Services\UserService;
    use App\Infrastructure\Persistence\UserRepository;
    use App\Infrastructure\Database\DatabaseConnection;
    use App\School\Entities\User;


    class UserController{

        function get(){
            try{
                $field = $_GET['field'];
                $value = $_GET['value'];
                $userService = new UserService();
                $user = $userService->getUser($field, $value);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($user);
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
                $userService = new UserService();
                $users = $userService->getListUser($field, $value);

                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($users);
            }catch(\Exception $e){
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }

        
              
    }