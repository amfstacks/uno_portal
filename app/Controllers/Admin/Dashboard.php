<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\SessionModel;
use App\Models\StudentModel;

class Dashboard extends BaseController
{

    protected $sessionModel;
    protected $userModel;
    protected $studentModel;

    public function __construct()
    {
        $this->sessionModel = new SessionModel();
        $this->userModel = new UserModel();
        $this->studentModel = new StudentModel();
    }
    public function index()
    {
        $data = [
            'total_students' => model('StudentModel')->countAll(),
            'pending_payments' => model('PaymentModel')->where('status', 'pending')->countAllResults(),
            'active_session' => model('SessionModel')->where('is_active', 1)->first(),
        ];
        // $data = [
        //     'active_session' => $this->sessionModel->getActive(session()->get('school_id')),
        //     'exam_officers' => $this->userModel->where('role', 'exam_officer')->findAll(),
        //     'stats' => [
        //         'total_students' => $this->studentModel->countAll(),
        //         'registered' => $this->studentModel->where('session', '2025/2026')->countAllResults(),
        //     ]
        // ];
        return view('admin/dashboard', $data);
    }

    public function toggleApplication($status)
    {
        model('SessionModel')->updateActive(['application_open' => $status]);
        toast('Application '.($status ? 'opened' : 'closed'));
        return redirect()->back();
    }

    public function setSession()
    {
        $session = $this->request->getPost('session');
        $semester = $this->request->getPost('semester');
        $schoolId = session()->get('school_id');

        // Deactivate all
        $this->sessionModel->where('school_id', $schoolId)->set(['is_active' => 0])->update();

        // Create or activate
        $existing = $this->sessionModel->where(['session_name' => $session, 'semester' => $semester, 'school_id' => $schoolId])->first();
        if (!$existing) {
            $this->sessionModel->insert([
                'school_id' => $schoolId,
                'session_name' => $session,
                'semester' => $semester,
                'is_active' => 1
            ]);
        } else {
            $this->sessionModel->update($existing['id'], ['is_active' => 1]);
        }

            helper('toast');

        toast('Academic session set to ' . $session . ' Semester ' . $semester,);
        return redirect()->back()->with('success', 'Academic session set to ' . $session . ' Semester ' . $semester,);
    }

    public function createOfficer()
    {
        $data = [
            'school_id' => session()->get('school_id'),
            'email' => $this->request->getPost('email'),
            'matric_no' => $this->request->getPost('matric_no'),
            'role' => 'exam_officer',
            'password_hash' => password_hash('exam123', PASSWORD_BCRYPT),
            'is_active' => 1
        ];
        $this->userModel->insert($data);
        toast('Exam officer created. Default password: exam123');
        return redirect()->back();
    }

    public function toggleOfficer($id, $status)
    {
        $this->userModel->update($id, ['is_active' => $status]);
        toast('Officer account ' . ($status ? 'activated' : 'deactivated'));
        return redirect()->back();
    }

    // === ACTIVATE RESULTS ===
    public function activateResults()
    {
        // Logic: Mark results as final (add column `is_activated` to results table)
        // For now: just toggle a session flag
        toast('Results activated for current session');
        return redirect()->back();
    }

    // === REGISTRATION LIST ===
    public function registrationList()
    {
        $students = $this->studentModel->where('session', '2025/2026')->findAll();
        return view('admin/registration_list', compact('students'));
    }

    // === PORTAL SETTINGS ===
    public function settings()
    {
        if ($this->request->getMethod() === 'post') {
            $schoolId = session()->get('school_id');
            $data = [
                'name' => $this->request->getPost('name'),
                'short_name' => $this->request->getPost('short_name'),
                'primary_color' => $this->request->getPost('primary_color'),
                'secondary_color' => $this->request->getPost('secondary_color'),
                'custom_css' => $this->request->getPost('custom_css'),
                'custom_js' => $this->request->getPost('custom_js'),
            ];

            if ($file = $this->request->getFile('logo')) {
                if ($file->isValid()) {
                    $name = $file->getRandomName();
                    $file->move(WRITEPATH . '../public/assets/uploads/logos', $name);
                    $data['logo'] = '/assets/uploads/logos/' . $name;
                }
            }

            model('SchoolModel')->update($schoolId, $data);
            config('SchoolConfig')->init();
            toast('Portal settings updated');
            return redirect()->back();
        }
        return view('admin/settings');
    }

    // === USER MANAGEMENT ===
    public function resetPassword($id)
    {
        $this->userModel->update($id, ['password_hash' => password_hash('newpass123', PASSWORD_BCRYPT)]);
        toast('Password reset to: newpass123');
        return redirect()->back();
    }

 public function switchSchool($id)
    {
        if (session()->get('role') === 'admin') {
            session()->set('school_id', $id);
            config('SchoolConfig')->init();
        }
        return redirect()->back();
    }


}