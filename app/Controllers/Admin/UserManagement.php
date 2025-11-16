<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\SchoolModel;

class UserManagement extends BaseController
{
    protected $userModel;
    protected $schoolModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->schoolModel = new SchoolModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $role = $this->request->getGet('role');

        $users = $this->userModel
            ->select('users.*, schools.name as school_name')
            ->join('schools', 'schools.id = users.school_id', 'left')
            ->orderBy('users.created_at', 'DESC');

        if ($search) {
            $users->groupStart()
                  ->like('users.email', $search)
                  ->orLike('users.matric_no', $search)
                  ->orLike('users.full_name', $search)
                  ->groupEnd();
        }

        if ($role && $role !== 'all') {
            $users->where('users.role', $role);
        }

        $data = [
            'users' => $users->findAll(),
            'roles' => ['admin', 'exam_officer', 'student', 'bursary'],
            'schools' => $this->schoolModel->findAll(),
            'search' => $search,
            'selected_role' => $role
        ];

        return view('admin/users/index', $data);
    }

    public function create()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'matric_no' => $this->request->getPost('matric_no'),
            'role' => $this->request->getPost('role'),
            'school_id' => session()->get('school_id'),
            'password' => 'temp123', // will be hashed
            'is_active' => 1
        ];

        if ($this->userModel->insert($data)) {
            toast('User created successfully. Default password: <strong>temp123</strong>', 'success');
        } else {
            toast('Failed to create user.', 'error');
        }

        return redirect()->to('/admin/users');
    }

    public function toggleStatus($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            toast('User not found.', 'error');
            return redirect()->back();
        }

        $newStatus = $user['is_active'] ? 0 : 1;
        $this->userModel->update($id, ['is_active' => $newStatus]);

        toast("User <strong>" . esc($user['email']) . "</strong> has been " . ($newStatus ? 'activated' : 'deactivated'), 'success');
        return redirect()->back();
    }

    public function resetPassword($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            toast('User not found.', 'error');
            return redirect()->back();
        }

        $this->userModel->update($id, [
            'password_hash' => password_hash('newpass123', PASSWORD_BCRYPT)
        ]);

        toast("Password reset for <strong>" . esc($user['email']) . "</strong> to: <strong>newpass123</strong>", 'success');
        return redirect()->back();
    }
}