<?php

namespace App\School\Repositories;
use App\School\Entities\Course;

    interface ICourseRepository{
        public function get($field, $value);
        public function getList($field, $value);
        public function set(Course $course);
        public function delete($id);
    }
    