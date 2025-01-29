<?php

namespace App\School\Repositories;
use App\School\Entities\Subject;

    interface ISubjectRepository{
        public function get($field, $value);
        public function getList($field, $value);
        public function set(Subject $subject);
        public function delete($id);
    }