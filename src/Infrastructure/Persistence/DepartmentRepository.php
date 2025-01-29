<?php
    namespace App\Infrastructure\Persistence;

    use App\Infrastructure\Database\DatabaseConnection;
    use App\School\Repositories\IDepartmentRepository;
    use App\School\Entities\Department;

    class DepartmentRepository implements IDepartmentRepository{
        private \PDO $db;

        function __construct($db){
            $this->db= $db;
        }

        function get($field, $value){
            $validFields = ['id','name'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }

            $stmt=$this->db->prepare("SELECT * FROM departments WHERE $field=:value");
            $stmt->execute(['value'=>$value]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        function getList($field, $value){
            if (empty($field) && empty($value)) {
                $stmt = $this->db->query("SELECT * FROM departments");
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }

            $validFields = ['id','name'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }

            $values = explode(',', $value); 
            $placeholders = implode(',', array_fill(0, count($values), '?'));

            $stmt=$this->db->prepare("SELECT * FROM departments WHERE $field IN ($placeholders)");
            $stmt->execute($values);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }


        function set(Department $department){
            $stmt=$this->db->prepare("INSERT INTO departments(name) 
            VALUES(:name)");
            $stmt->execute([
                'name'=>$department->getName()
            ]);
            
        }

        function delete($id) {
            $stmt = $this->db->prepare("DELETE FROM departments WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }


    }