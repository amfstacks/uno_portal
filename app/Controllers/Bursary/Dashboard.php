<?php
namespace App\Controllers\Bursary;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        if (session()->get('role') !== 'bursary') {
            return redirect()->to('/login');
        }
        return view('bursary/dashboard');
    }

    public function statistics()
    {
        $stats = [
            'total_paid' => model('PaymentModel')->selectSum('amount')->where('status', 'paid')->first()->amount ?? 0,
            'total_students' => model('StudentModel')->countAll(),
        ];
        return view('bursary/stats', compact('stats'));
    }

    public function payments()
    {
        $payments = model('PaymentModel')->findAll();
        return view('bursary/payments', compact('payments'));
    }

    public function queryPayment($id)
    {
        $payment = model('PaymentModel')->find($id);
        return view('bursary/query', compact('payment'));
    }
}