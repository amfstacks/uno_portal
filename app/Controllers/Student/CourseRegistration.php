<?php
namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\StudentModel;
use App\Models\SessionModel;
use App\Models\RegistrationModel;
use App\Models\RegisteredCourseModel;

class CourseRegistration extends BaseController
{
    public function index__()
    {
        // $student = session()->get('student');
        $studentId = session()->get('user_id');
        $registered = model('RegistrationModel')
            ->where('student_id', $studentId)
            ->where('session', active_session())
            ->findColumn('course_id') ?? [];

        $data = [
            'title' => 'Course Registration',
            'courses' => model('CourseModel')->where('level', $student['level'])->findAll(),
            'registered' => $registered,
            'session' => active_session()
        ];

        return view('student/courses/register', $data);
    }

     public function index()
    {
        $studentId = session()->get('user_id');

        // Fetch logged-in student's academic info
        $student = model(StudentModel::class)
            ->where('user_id', $studentId)
            ->first();

        if (!$student) {
            return redirect()->to('/login')->with('error', 'Student record not found.');
        }

        $sessionModel = new SessionModel();

// Get active registration session
$activeRegistration = $sessionModel->getActiveByType(
    // $student['school_id'],
    $student['programme'],
    'registration'
);
  if (!$activeRegistration) {
            return view('student/courses/no_access', [
                'title' => 'Course Registration Closed',
                'message' => 'Registration session has not been opened.',
            'student'  => $student,

            ]);
        }

 if ($activeRegistration['session_name'] != $student['session']) {
            return view('student/courses/no_access', [
                'title' => 'Registration Not Allowed',
                'message' => 'Course registration is not available for your session.',
            'student'  => $student,

            ]);
        }

         if ($activeRegistration['registration_open'] !=1) {
            return view('student/courses/no_access', [
                'title' => 'Registration Not Opened',
                'message' => 'Course registration is not activated for your session.',
            'student'  => $student,

            ]);
        }


        $courseModel = new CourseModel();
    $RegisteredCourseModel    = new RegisteredCourseModel();


        // Fetch all courses matching the student's academic details
        $courses = $courseModel
            ->select('courses.*')
            // ->join('course_applied AS ca', 'ca.id = courses.course_department_id', 'left')
            ->where('courses.department_id', $student['department'])
            ->where('courses.course_department_id', $student['course_of_study'])
            ->where('courses.level', $student['level'])
            ->where('courses.semester', $student['semester'])
            ->where('courses.session', $student['session'])
            ->orderBy('courses.title', 'ASC')
            ->findAll();


             $registered = $RegisteredCourseModel
        ->select('cid')
        ->where('user_id', $studentId)
        // ->where('department_id', $student['department'])
        // ->where('course_department_id', $student['course_of_study'])
        ->where('level', $student['level'])
        ->where('semester', $student['semester'])
        ->where('session', $student['session'])
        ->findColumn('cid');

    if (!$registered) {
        $registered = [];
    }
    
// var_dump($registered);
// // var_dump($courses);
// exit;
        // (Not registering yet — just fetching)
        $data = [
            'title'    => 'Course Registration',
            'student'  => $student,
            'courses'  => $courses,   // final list
            'session'  => $student['session'],
            'registered' => $registered,

        ];

        return view('student/courses/register', $data);
    }


    public function submit()
{
    if ($this->request->getMethod() !== 'POST') {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid request method.'
        ]);
    }

    $studentId = session()->get('user_id');

    $student = model(StudentModel::class)
        ->where('user_id', $studentId)
        ->first();

    if (! $student) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Student data not found.'
        ]);
    }

    $courseIds = $this->request->getPost('course_ids');

    if (empty($courseIds)) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Please select at least one course.'
        ]);
    }

    $courseModel = new CourseModel();
    $regModel    = new RegisteredCourseModel();

    $session  = $student['session'];
    $semester = $student['semester'];
    $level    = $student['level'];

    $insertData = [];

    foreach ($courseIds as $cid) {

        $course = $courseModel->find($cid);
        if (! $course) continue;

        // Prevent duplicate registration
        if ($regModel->isRegistered($student['id'], $cid, $session, $semester)) {
            continue;
        }

        $insertData[] = [
            'student_id' => $student['id'],
            'user_id'    => $studentId,
            'matricno'   => $student['matric_no'],

            'cid'        => $course['id'],
            'ccode'      => $course['code'],
            'ctitle'     => $course['title'],
            'dept'       => $course['department_id'],
            'unit'       => $course['units'],
            'level'      => $level,

            'session'    => $session,
            'semester'   => $semester,

            'ca'         => 0,
            'cbt'        => 0,
            'exam'       => 0,
            'total'      => 0,
            'grade'      => '',
            'graded'     => 0,
            'sitting'    => 1,



        ];
    }

    if (! empty($insertData)) {
        $regModel->insertBatch($insertData);
    }

    return $this->response->setJSON([
        'status'  => 'success',
        'message' => 'Course registration submitted successfully.'
    ]);
}

    public function save()
    {
        $courses = $this->request->getPost('courses');
        $studentId = session()->get('student')['id'];
        $session = active_session();

        // Clear old
        model('RegistrationModel')->where(['student_id' => $studentId, 'session' => $session])->delete();

        // Save new
        $data = [];
        foreach ($courses as $courseId) {
            $data[] = [
                'student_id' => $studentId,
                'course_id' => $courseId,
                'session' => $session,
                'registered_at' => date('Y-m-d H:i:s')
            ];
        }
        model('RegistrationModel')->insertBatch($data);

        toast('Courses registered successfully!', 'success');
        return redirect()->to('/student/courses/register');
    }
}