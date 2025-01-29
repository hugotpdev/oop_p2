<?php 

    namespace App\School\Services;

    use App\School\Entities\Degree;
    use App\Infrastructure\Persistence\DegreeRepository;
    use App\Infrastructure\Database\DatabaseConnection;
    

    class DegreeService{


        function __construct()
        {

        }

        function getDegree($field, $value){
            if ($field == null || $value == null){
                throw new \Exception("No se pudo obtener al profesor");
            }

            try {            
                $degreeRepository = new DegreeRepository(DatabaseConnection::getConnection());
                $degree = $degreeRepository->get($field, $value);
        
                return $degree;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function getListDegree($field, $value){
            try {
                if ((empty($field) && !empty($value)) || (!empty($field) && empty($value))) {
                    throw new \Exception("No se pudo obtener el grado");
                }
                $degreeRepository = new DegreeRepository(DatabaseConnection::getConnection());
                $degrees = $degreeRepository->getList($field, $value);
        
                return $degrees;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function setDegree($data){
            try {
                $name = isset($data['name']) ? $data['name'] : null;
                $durationYears = isset($data['durationYears']) ? $data['durationYears'] : null;

                if ((empty($name) || empty($durationYears))) {
                    throw new \Exception("Todos los campos son necesarios");
                }

                $degree = new Degree($name, $durationYears);
                $degreeRepository = new DegreeRepository(DatabaseConnection::getConnection());
                $degreeRepository->set($degree);
                
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }    
        }

        function deleteDegree($id){
            try {
                if ($id == null){
                    throw new \Exception("No se ha podido eliminar el profesor");
                }
    
                $degreeRepository = new DegreeRepository(DatabaseConnection::getConnection());
                $degree = $degreeRepository->delete($id);            
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }