<?php 

namespace App\School\Repositories;

use App\School\Entities\Enrollment;

interface IEnrollmentRepository{
    public function get($field, $value);
    public function getList($field, $value);
    public function set(Enrollment $enrollment);
    public function delete($id);
}