<?php

namespace App\School\Repositories;
use App\School\Entities\Degree;

    interface IDegreeRepository{
        public function get($field, $value);
        public function getList($field, $value);
        public function set(Degree $degree);
        public function delete($id);
    }
    