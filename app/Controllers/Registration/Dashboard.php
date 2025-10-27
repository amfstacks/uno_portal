<?php
namespace App\Controllers\Registration;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function form()
    {
        return view('registration/form');
    }

    public function submit()
    {
        $data = $this->request->getPost(['matric_no', 'full_name', 'course_of_study', 'level', 'session', 'semester']);
        $studentModel = model('StudentModel');
        $studentModel->save($data);
        helper('toast');
        toast('Registration successful', 'success');
        return redirect()->to('/student/dashboard');
    }
}