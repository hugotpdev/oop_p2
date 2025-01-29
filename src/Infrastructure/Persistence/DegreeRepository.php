<?php
    namespace App\Infrastructure\Persistence;

    use App\Infrastructure\Database\DatabaseConnection;
    use App\School\Repositories\IDegreeRepository;
    use App\School\Entities\Degree;

    class DegreeRepository implements IDegreeRepository{
        private \PDO $db;

        function __construct(){
            $this->db= DatabaseConnection::getConnection();
        }

        function get($field, $value){
            $validFields = ['id','name','duration_years'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }

            $stmt=$this->db->prepare("SELECT * FROM degrees WHERE $field=:value");
            $stmt->execute(['value'=>$value]);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        function getList($field, $value){            
            if (empty($field) && empty($value)) {
                $stmt = $this->db->query("SELECT * FROM degrees");
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }

            $validFields = ['id','name','duration_years'];
            if (!in_array($field, $validFields)) {
                throw new \Exception('Campo no válido');
            }

            $values = explode(',', $value); 
            $placeholders = implode(',', array_fill(0, count($values), '?'));

            $stmt=$this->db->prepare("SELECT * FROM degrees WHERE $field IN ($placeholders)");
            $stmt->execute($values);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }


        function set(Degree $degree){
            $stmt=$this->db->prepare("INSERT INTO degrees(name, duration_years) 
            VALUES(:name, :duration_years)");
            $stmt->execute([
                'name'=>$degree->getName(),
                'duration_years'=>$degree->getDurationYears(),
            ]);
            
        }

        function delete($id) {
            $stmt = $this->db->prepare("DELETE FROM degrees WHERE id = :id");
            $stmt->execute(['id' => $id]);
        }


    }