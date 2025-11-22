<?php

namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\PaymentHistoryModel;
use App\Models\StudentModel;

class Payments extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');

        // Fetch student
        // $student = model(StudentModel::class)
        //     ->where('user_id', $userId)
        //     ->first();
            $student = student();

        if (!$student) {
            return redirect()->to('/login')->with('error', 'Student record not found.');
        }

        // Load payment history
        $paymentModel = new PaymentHistoryModel();

        $payments = $paymentModel
            ->where('user_id', $userId)
            ->orderBy('paid_at', 'DESC')
            ->findAll();

        return view('student/payments/history', [
            'title'     => 'Payment History',
            'student'   => $student,
            'payments'  => $payments,
        ]);
    }
}
