<?php 

    namespace App\School\Repositories;

    use App\School\Entities\Student;
    
    interface IStudentRepository{
        public function get($field, $value);
        public function getList($field, $value);
        public function set(Student $student);
        public function delete($id);
    }