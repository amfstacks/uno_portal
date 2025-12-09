<?php
namespace App\Controllers\Student;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        if (session()->get('role') !== 'student') {
            return redirect()->to('/login');
        }
        $student = model('StudentModel')->where('user_id', session()->get('user_id'))->first();
        return view('student/dashboard', compact('student'));
    }
 
    public function courses()
    {
        $courses = model('RegisteredCourseModel')->where('student_id', session()->get('user_id'))->findAll();
        return view('student/courses', compact('courses'));
        //
    }

    public function results()
    {
        $results = model('ResultModel')->where('student_id', session()->get('user_id'))->findAll();
        return view('student/results', compact('results'));
    }

    public function transcript()
    {
        $student = model('StudentModel')->where('user_id', session()->get('user_id'))->first();
        $results = model('ResultModel')->where('student_id', session()->get('user_id'))->findAll();
        $mpdf = new \Mpdf\Mpdf();
        $data = ['student' => $student, 'results' => $results, 'school' => $this->school];
        $html = view('student/transcript', $data);
        $mpdf->WriteHTML($html);
        $mpdf->Output('transcript.pdf', 'D');
    }

    public function documents()
    {
        return view('student/documents');
    }

    public function support()
    {
        return view('student/support');
    }
}