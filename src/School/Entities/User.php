<?php

    namespace App\School\Entities;

    use App\School\Trait\Timestampable;

     class User{
        private string $uuid;
        private string $firstName;
        private string $lastName;
        private string $email;
        private string $password;
        protected  ?\DateTime $createdAt=null;
        protected  ?\DateTime $updatedAt=null;
        private string $userType;


        function __construct($uuid,$firstName,$lastName,$email,$password,$userType){
            $this->uuid=$uuid;
            $this->firstName=$firstName;
            $this->lastName=$lastName;
            $this->email=$email;
            $this->password=$password;
            $this->userType=$userType; 
        }

        function setEmail(string $email){
            $this->email=$email;
            return $this;
        }
        

        /**
         * Get the value of username
         */ 
        public function getUuid()
        {
                return $this->uuid;
        }

        /**
         * Get the value of firstName
         */ 
        public function getFirstName()
        {
                return $this->firstName;
        }

        /**
         * Get the value of lastName
         */ 
        public function getLastName()
        {
                return $this->lastName;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Get the value of createdAt
         */ 
        public function getCreatedAt()
        {
                return $this->createdAt->format('Y-m-d H:i:s');
        }

        /**
         * Get the value of updatedAt
         */ 
        public function getUpdatedAt()
        {
                return $this->updatedAt->format('Y-m-d H:i:s');
        }

        /**
         * Get the value of userType
         */ 
        public function getUserType()
        {
                return $this->userType;
        }

    }