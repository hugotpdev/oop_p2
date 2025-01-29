<?php 

    namespace App\School\Services;

    use App\School\Entities\Enrollment;
    use App\School\Entities\Subject;
    use App\School\Entities\Student;
    use App\School\Repositories\IEnrollmentRepository;
    use App\School\Repositories\IStudentRepository;
    use App\School\Repositories\ISubjectRepository;
    use App\School\Repositories\IUserRepository;

    class AssignStudentSubjectService{

        private IEnrollmentRepository $iEnrollmentRepository;
        private IStudentRepository $iStudentRepository;
        private ISubjectRepository $iSubjectRepository;
        private IUserRepository $iUserRepository;

        function __construct($enrollmentRepository, $studentRepository, $subjectRepository,$userRepository)
        {
            $this->iEnrollmentRepository = $enrollmentRepository;
            $this->iStudentRepository = $studentRepository;
            $this->iSubjectRepository = $subjectRepository;
            $this->iUserRepository = $userRepository;
        }

        function setAssignStudentSubjectService($data){
            try {
                $student_id = isset($data['student_id']) ? $data['student_id'] : null;
                $subject_id = isset($data['subject_id']) ? $data['subject_id'] : null;

                if ((empty($student_id) || empty($subject_id))) {
                    throw new \Exception("Todos los campos son necesarios");
                }

                $subjectArray = $this->iSubjectRepository->get('id', $subject_id);
                $subject = new Subject($subjectArray['name'], $subjectArray['course_id']);
                $subject->setId($subjectArray['id']);

                $studentArray = $this->iStudentRepository->get('id', $student_id);
                $user = $this->iUserRepository->get('id',$studentArray['user_id']);
                
                $student = new Student($user['uuid'],$user['first_name'],$user['last_name'],$user['email'],$user['password'],$studentArray['dni'],$studentArray['user_id']);
                $student->setId($studentArray['id']);

                $inscriptionsOfPatient = $this->iEnrollmentRepository->getList('student_id', $student_id);
                
                if($inscriptionsOfPatient != null){
                    foreach($inscriptionsOfPatient as $insc){
                        if($insc['subject_id'] == $subject_id)
                            throw new \Exception("El estudiante ya esta inscrito a la asignatura");
                    }    
                }
                
                $enrollment = new Enrollment($student, $subject);
                $this->iEnrollmentRepository->set($enrollment); 
            } catch (Exception $e) {
                throw new \Exception($e->getMessage());
            }    
        }
                
        
    }