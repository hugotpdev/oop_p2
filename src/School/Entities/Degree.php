<?php 

    namespace App\School\Entities;

    class Degree{
        protected $name;
        protected $durationYears;

        function __construct(string $name, int $durationYears){
            $this->name=$name;
            $this->durationYears=$durationYears;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getDurationYears()
        {
            return $this->durationYears;
        }

    }