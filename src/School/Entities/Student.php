<?php

    namespace App\School\Entities;

    use App\School\Entities\User;
   
    use App\School\Trait\Timestampable;

    class Student extends User {
        private string $id;
        private string $dni;
        private string $user_id;
        private ?\DateTime $enrollment_year = null;

        protected $enrollments=[];

        public function showSchool(){
            echo parent::MYSCHOOL;
        }
       
        public function __construct($uuid,$firstName,$lastName,$email,$password,$dni, $user_id,) {
            
            parent::__construct(
                $uuid,          
                $firstName,         
                $lastName,          
                $email,             
                $password,      
                'Student'   
            );
            $this->dni = $dni;
            $this->user_id = $user_id;
        }

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                return $this->id = $id;
        }

        public function getDni()
        {
                return $this->dni;
        }

        public function getUserID()
        {
                return $this->user_id;
        }

        public function getEnrollmentYear()
        {
            return $this->enrollment_year->format('Y');
        }

    }