<?php 

    namespace App\School\Services;

    use App\School\Entities\Department;
    use App\Infrastructure\Persistence\DepartmentRepository;
    use App\Infrastructure\Database\DatabaseConnection;
    

    class DepartmentService{

        

        function __construct()
        {
            
        }

        function getDepartment($field, $value){
            if ($field == null || $value == null){
                throw new \Exception("No se pudo obtener el departamento");
            }

            try {            
                $departmentRepository = new DepartmentRepository(DatabaseConnection::getConnection());
                $department = $departmentRepository->get($field, $value);
        
                return $department;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function getListDepartment($field, $value){
            try {
                if ((empty($field) && !empty($value)) || (!empty($field) && empty($value))) {
                    throw new \Exception("No se pudo obtener el departamento");
                }
                $departmentRepository = new DepartmentRepository(DatabaseConnection::getConnection());
                $departments = $departmentRepository->getList($field, $value);
        
                return $departments;
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        function setDepartment($data){
            try {
                $name = isset($data['name']) ? $data['name'] : null;

                if (empty($name)) {
                    throw new \Exception("Todos los campos son necesarios");
                }

                $department = new Department($name);
                $departmentRepository = new DepartmentRepository(DatabaseConnection::getConnection());
                $departmentRepository->set($department);
                
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }    
        }

        function deleteDepartment($id){
            try {
                if ($id == null){
                    throw new \Exception("No se ha podido eliminar el departamento");
                }
    
                $departmentRepository = new DepartmentRepository(DatabaseConnection::getConnection());
                $departmentRepository->delete($id);
                    
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }