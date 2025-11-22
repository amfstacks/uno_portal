<?php

namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\FeeStructureModel;
use App\Models\StudentModel;

class Fees extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');

        // Fetch student profile
        // $student = model(StudentModel::class)
        //     ->where('user_id', $userId)
        //     ->first();
            $student = student();

        if (!$student) {
            return redirect()->to('/login')->with('error', 'Student record not found.');
        }

        // Load the fee model
        $feeModel = new FeeStructureModel();

        // Build filters based on student academic data
        $filters = [
            'department_id' => $student['department'] ?? null,
            'session'       => $student['session'] ?? null,
            'level'         => $student['level'] ?? null,
            'semester'      => $student['semester'] ?? null,
        ];

        // Fetch all fee items
        $fees = $feeModel->getByFilters($filters);

        // Total Fees
        $total_fees = 0;
        foreach ($fees as $f) {
            $total_fees += (int)$f['amount'];
        }

        // Send to view
        return view('student/fees/index', [
            'title'       => 'School Fees',
            'student'     => $student,
            'fees'        => $fees,
            'total_fees'  => $total_fees,
        ]);
    }
}
