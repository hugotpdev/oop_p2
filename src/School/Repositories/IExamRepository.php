<?php

namespace App\School\Repositories;
use App\School\Entities\Exam;

    interface IExamRepository{
        public function get($field, $value);
        public function getList($field, $value);
        public function set(Exam $exam);
        public function delete($id);
    }
    