<?php
    namespace App\School\Entities;
    use App\School\Entities\Subject;
    use App\School\Entities\Student;



    class Enrollment{
        private Student $student;
        private Subject $subject;
        private \DateTime $enrollmentDate;

        function __construct($student, $subject){
                $this->student=$student;
                $this->subject=$subject;
        }
        
        
        public function getStudent()
        {
                return $this->student;
        }

        public function getSubject()
        {
                return $this->subject;
        }

        public function getEnrollmentDate()
        {
                return $this->enrollmentDate;
        }

        public function getEnrollmentDateString()
        {
                return $this->enrollmentDate->format('Y-m-d H:i:s');
        }
    }