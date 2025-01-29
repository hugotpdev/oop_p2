<?php 

    namespace App\School\Entities;

    class Course{
        protected $name;
        protected $degree_id;

        function __construct(string $name, int $degree_id){
            $this->name=$name;
            $this->degree_id=$degree_id;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getDegreeId()
        {
            return $this->degree_id;
        }
    }