<?php
namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\StudentModel;
use App\Models\RegistrationModel;

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

        $courseModel = new CourseModel();

        // Fetch all courses matching the student's academic details
        $courses = $courseModel
            ->select('courses.*, ca.name AS applied_course_name')
            ->join('course_applied AS ca', 'ca.id = courses.course_department_id', 'left')
            ->where('courses.department_id', $student['department'])
            ->where('courses.course_department_id', $student['course_of_study'])
            ->where('courses.level', $student['level'])
            ->where('courses.semester', $student['semester'])
            ->where('courses.session', $student['session'])
            ->orderBy('courses.title', 'ASC')
            ->findAll();

        // (Not registering yet — just fetching)
        $data = [
            'title'    => 'Course Registration',
            'student'  => $student,
            'courses'  => $courses,   // final list
            'session'  => $student['session'],
        ];

        return view('student/courses/register', $data);
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