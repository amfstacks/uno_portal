<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'total_students' => model('StudentModel')->countAll(),
            'pending_payments' => model('PaymentModel')->where('status', 'pending')->countAllResults(),
            'active_session' => model('SessionModel')->where('is_active', 1)->first(),
        ];
        return view('admin/dashboard', $data);
    }

    public function toggleApplication($status)
    {
        model('SessionModel')->updateActive(['application_open' => $status]);
        toast('Application '.($status ? 'opened' : 'closed'));
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