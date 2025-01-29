<?php

namespace App\School\Repositories;
use App\School\Entities\Department;

    interface IDepartmentRepository{
        public function get($field, $value);
        public function getList($field, $value);
        public function set(Department $department);
        public function delete($id);
    }