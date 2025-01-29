<?php

namespace App\School\Repositories;

use App\School\Entities\User;

interface IUserRepository{
    public function get($field, $value);
    public function getList($field, $value);
    public function set(User $user);
    public function delete($id);
}