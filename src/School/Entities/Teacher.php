<?php

    namespace App\School\Entities;

    use App\School\Entities\User;
    use App\School\Entities\Department;
   

    class Teacher extends User {
        private int $user_id;
        private Department $department;
       
        public function __construct($uuid,$firstName,$lastName,$email,$password,$user_id,$department) {
            
            parent::__construct(
                $uuid,          
                $firstName,         
                $lastName,          
                $email,             
                $password,      
                'Teacher'   
            );
            $this->user_id = $user_id;
            $this->department = $department;
        }

        public function getUserId()
        {
                return $this->user_id;
        }

        public function getDepartment()
        {
                return $this->department;
        }

    }
    