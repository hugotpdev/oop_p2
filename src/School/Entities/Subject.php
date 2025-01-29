<?php

    namespace App\School\Entities;

    use App\School\Entities\Course;

    class Subject{
        protected string $id;
        protected string $name;
        protected int $course_id;

        function __construct(string $name, int $course_id){
            $this->name=$name;
            $this->course_id=$course_id;
        }

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                return $this->id = $id;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getCourseId()
        {
            return $this->course_id;
        }

    }