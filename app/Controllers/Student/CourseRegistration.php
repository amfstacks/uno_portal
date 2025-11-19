<?php
namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\RegistrationModel;

class CourseRegistration extends BaseController
{
    public function index()
    {
        $student = session()->get('student');
        $registered = model('RegistrationModel')
            ->where('student_id', $student['id'])
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