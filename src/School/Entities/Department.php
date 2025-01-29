<?php 

    namespace App\School\Entities;

    class Department{
        protected $name;
        protected $id;

        function __construct($name)
        {
            $this->name=$name;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getName()
        {
            return $this->name;
        }
    }