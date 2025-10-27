<?php
namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login_()
    {
        if ($this->request->getMethod() === 'POST') {
            $userModel = model('UserModel');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            var_dump($email);
            exit;
            $user = $userModel->where('email', $email)->first();

            if ($user && password_verify($password, $user['password_hash'])) {
                session()->set([
                    'user_id' => $user['id'],
                    'school_id' => $user['school_id'],
                    'role' => $user['role']
                ]);
                return redirect()->to($user['role'] . '/dashboard');
            }
            return redirect()->back()->with('error', 'Invalid credentials');
        }
        return view('auth/login');
    }
    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            $userModel = new UserModel();
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $user = $userModel->where('email', $email)->first();
//  var_dump($email);
//             exit;
            if ($user && password_verify($password, $user['password_hash'])) {
                session()->set([
                    'user_id' => $user['id'],
                    'school_id' => $user['school_id'],
                    'role' => $user['role']
                ]);
                helper('toast');
                toast('Login successful', 'success');
                return redirect()->to($user['role'] . '/dashboard');
            }
            helper('toast');
            toast('Invalid credentials', 'error');
            // return redirect()->back()->withInput();
            return redirect()->back()->with('error', 'Invalid credentials')->withInput();

        }
        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}