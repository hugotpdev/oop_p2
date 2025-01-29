<?php
    define('VIEWS',__DIR__.'/src/views');
    require __DIR__.'/vendor/autoload.php';
    $dotenv=Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    use App\Controllers\HomeController;
    use App\Controllers\StudentController;
    use App\Controllers\UserController;
    use App\Controllers\DegreeController;
    use App\Controllers\CourseController;
    use App\Controllers\SubjectController;
    use App\Controllers\ExamController;
    use App\Controllers\EnrollmentController;
    use App\Controllers\DepartmentController;
    use App\Controllers\TeacherController;
    use App\Controllers\AssingTeacherDepartmentController;
    use App\Infrastructure\Database\DatabaseConnection;
    use App\Infrastructure\Routing\Router;
    use App\School\Services\EnrollmentService;
    use App\Infrastructure\Persistence\EnrollmentRepository;
    use App\Controllers\AssignStudentSubjectController;
    
    use App\School\Services\Services;
    

    //carga de servicios siguiendo dependencias
    $db=DatabaseConnection::getConnection();
    $services=new Services();
    $services->addServices('db',fn()=>$db);
    $db=$services->getService('db');
    $services->addServices('enrollmentRepository',fn()=>new EnrollmentRepository($db));
   
    $router=new Router();
    $router->addRoute('GET','/',[new StudentController(),'index'])
            ->addRoute('GET','/student',[new StudentController(),'index'])
            ->addRoute('GET','/createStudent',[new StudentController(),'createStudentView'])
            ->addRoute('GET','/getStudent',[new StudentController(),'get'])
            ->addRoute('GET','/getListStudent',[new StudentController(),'getList'])
            ->addRoute('POST','/setStudent',[new StudentController(),'set'])
            ->addRoute('DELETE','/deleteStudent',[new StudentController(),'delete'])
            ->addRoute('GET','/getUser',[new UserController(),'get'])
            ->addRoute('GET','/getListUser',[new UserController(),'getList'])
            ->addRoute('GET','/degree',[new DegreeController(),'index'])
            ->addRoute('GET','/getDegree',[new DegreeController(),'get'])
            ->addRoute('GET','/getListDegree',[new DegreeController(),'getList'])
            ->addRoute('POST','/setDegree',[new DegreeController(),'set'])
            ->addRoute('DELETE','/deleteDegree',[new DegreeController(),'delete'])
            ->addRoute('GET','/createDegree',[new DegreeController(),'createDegreeView'])
            ->addRoute('GET','/course',[new CourseController(),'index'])
            ->addRoute('GET','/getCourse',[new CourseController(),'get'])
            ->addRoute('GET','/getListCourse',[new CourseController(),'getList'])
            ->addRoute('POST','/setCourse',[new CourseController(),'set'])
            ->addRoute('DELETE','/deleteCourse',[new CourseController(),'delete'])
            ->addRoute('GET','/createCourse',[new CourseController(),'createCourseView'])
            ->addRoute('GET','/subject',[new SubjectController(),'index'])
            ->addRoute('GET','/getSubject',[new SubjectController(),'get'])
            ->addRoute('GET','/getListSubject',[new SubjectController(),'getList'])
            ->addRoute('POST','/setSubject',[new SubjectController(),'set'])
            ->addRoute('DELETE','/deleteSubject',[new SubjectController(),'delete'])
            ->addRoute('GET','/createSubject',[new SubjectController(),'createSubjectView'])
            ->addRoute('GET','/exam',[new ExamController(),'index'])
            ->addRoute('GET','/getExam',[new ExamController(),'get'])
            ->addRoute('GET','/getListExam',[new ExamController(),'getList'])
            ->addRoute('POST','/setExam',[new ExamController(),'set'])
            ->addRoute('DELETE','/deleteExam',[new ExamController(),'delete'])
            ->addRoute('GET','/createExam',[new ExamController(),'createExamView'])
            ->addRoute('GET','/enrollment',[new EnrollmentController(),'index'])
            ->addRoute('GET','/getEnrollment',[new EnrollmentController(),'get'])
            ->addRoute('GET','/getListEnrollment',[new EnrollmentController(),'getList'])
            ->addRoute('POST','/setEnrollment',[new AssignStudentSubjectController(),'set'])
            ->addRoute('DELETE','/deleteEnrollment',[new EnrollmentController(),'delete'])
            ->addRoute('GET','/createEnrollment',[new EnrollmentController(),'createEnrollmentView'])
            ->addRoute('GET','/teacher',[new TeacherController(),'index'])
            ->addRoute('GET','/getTeacher',[new TeacherController(),'get'])
            ->addRoute('GET','/getListTeacher',[new TeacherController(),'getList'])
            ->addRoute('POST','/setTeacher',[new AssingTeacherDepartmentController(),'set'])
            ->addRoute('DELETE','/deleteTeacher',[new TeacherController(),'delete'])
            ->addRoute('GET','/createTeacher',[new TeacherController(),'createTeacherView'])
            ->addRoute('GET','/department',[new DepartmentController(),'index'])
            ->addRoute('GET','/createDepartment',[new DepartmentController(),'createDepartmentView'])
            ->addRoute('GET','/getDepartment',[new DepartmentController(),'get'])
            ->addRoute('GET','/getListDepartment',[new DepartmentController(),'getList'])
            ->addRoute('POST','/setDepartment',[new DepartmentController(),'set'])
            ->addRoute('DELETE','/deleteDepartment',[new DepartmentController(),'delete']);
