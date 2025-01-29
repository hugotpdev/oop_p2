<?php 

    namespace App\School\Repositories;

    use App\School\Entities\Teacher;

    interface ITeacherRepository{
        public function get($field, $value);
        public function getList($field, $value);
        public function set(Teacher $teacher);
        public function delete($id);
    }