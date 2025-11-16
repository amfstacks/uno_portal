<?php
namespace App\Controllers\Applicant;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use App\Models\CourseModel;
use App\Models\UserModel;
use App\Models\ApplicationModel;

class Application extends BaseController
{
    public function index()
    {
        $data = [
            'school' => model('SchoolModel')->current(),
            'departments' => model('DepartmentModel')->findAll(),
            'courses' => model('CourseModel')->findAll()
        ];
        return view('applicant/form', $data);
    }

    public function submit()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'first_name' => 'required|min_length[2]',
            'last_name' => 'required|min_length[2]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'phone' => 'required|regex_match[/^\+?\d{10,15}$/]',
            'program' => 'required',
            'course_id' => 'required',
            'password' => 'required|min_length[6]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $schoolId = model('SchoolModel')->current()['id'];

        // Create User
        $userId = model('UserModel')->insert([
            'school_id' => $schoolId,
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role' => 'applicant',
            'is_active' => 1
        ]);

        // Create Application
        model('ApplicationModel')->insert([
            'user_id' => $userId,
            'first_name' => $this->request->getPost('first_name'),
            'middle_name' => $this->request->getPost('middle_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'program' => $this->request->getPost('program'),
            'course_id' => $this->request->getPost('course_id'),
            'status' => 'pending'
        ]);

        // Auto-login
        session()->set([
            'user_id' => $userId,
            'email' => $this->request->getPost('email'),
            'role' => 'applicant',
            'school_id' => $schoolId,
            'is_logged_in' => true
        ]);

        toast('Application submitted! Welcome to your dashboard.', 'success');
        return redirect()->to('/applicant/dashboard'); // We'll build later
    }
}