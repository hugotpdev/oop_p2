<?php

    namespace App\School\Entities;


    class Exam {

        protected int $subject_id;
        protected ?\DateTime $exam_date;
        protected string $description;

        function __construct(int $subject_id, ?\DateTime $exam_date, string $description){
            $this->subject_id=$subject_id;
            $this->exam_date=$exam_date;
            $this->description=$description;
        }

        public function getSubjectId()
        {
                return $this->subject_id;
        }

        public function getExamDate()
        {
                return $this->exam_date;
        }

        public function getExamDateString()
        {
                return $this->exam_date->format('Y-m-d H:i:s');
        }

        public function getDescription()
        {
                return $this->description;
        }


    }