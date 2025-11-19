<?php
namespace App\Controllers\Student;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index_()
    {
        // $student = session()->get('student'); // from your login system
        $studentId =session()->get('user_id');

        // Helper to get current session (you can customize)
        $currentSession = $this->activeSession();

        // === 1. CGPA Calculation ===
        $results = model('ResultModel')
            ->select('results.*, courses.units')
            ->join('courses', 'courses.id = results.course_id')
            ->where('results.student_id', $studentId)
            ->findAll();

        $totalPoints = $totalUnits = 0;
        foreach ($results as $r) {
            $gp = ['A' => 5, 'B' => 4, 'C' => 3, 'D' => 2, 'E' => 1, 'F' => 0][$r['grade']] ?? 0;
            $totalPoints += $gp * $r['units'];
            $totalUnits += $r['units'];
        }
        $cgpa = $totalUnits > 0 ? round($totalPoints / $totalUnits, 2) : 0.00;

        // === 2. Fee Summary ===
        $feeModel = model('FeeStructureModel');
        $totalFees = $feeModel
            ->where('program', $student['program'] ?? 'Undergraduate')
            ->where('level', $student['level'])
            ->where('session', $currentSession)
            ->selectSum('amount')->first()['amount'] ?? 0;

        $paidFees = model('PaymentModel')
            ->where('student_id', $studentId)
            ->where('status', 'success')
            ->selectSum('amount')->first()['amount'] ?? 0;

        // === 3. Recent Results (Last 5) ===
        $recentResults = model('ResultModel')
            ->select('results.*, courses.code, courses.title')
            ->join('courses', 'courses.id = results.course_id')
            ->where('results.student_id', $studentId)
            ->orderBy('results.created_at', 'DESC')
            ->limit(5)
            ->findAll();

        // === 4. Registered Courses Count ===
        $registeredCount = model('RegistrationModel')
            ->where('student_id', $studentId)
            ->where('session', $currentSession)
            ->countAllResults();

        $data = [
            'title' => 'Dashboard',
            'student' => $student,
            'cgpa' => $cgpa,
            'total_fees' => $totalFees,
            'paid_fees' => $paidFees,
            'balance' => $totalFees - $paidFees,
            'recent_results' => $recentResults,
            'registered_count' => $registeredCount,
            'current_session' => $currentSession
        ];

        return view('student/dashboard', $data);
    }
public function index()
{
    $studentId = session()->get('user_id');

    // Load Student Model
    // $student = model('StudentModel')
    //     ->where('user_id', $studentId)
    //     ->first();
        $student = model('StudentModel')->getFullProfile($studentId);

    if (!$student) {
        return redirect()->to('/login')->with('error', 'Student record not found.');
    }

    $data = [
        'title'   => 'Student Dashboard',
        'student' => $student
    ];

    return view('student/dashboard', $data);
}
    private function activeSession()
    {
        // You can make this dynamic from DB or config
        $year = date('Y');
        $month = date('n');
        return ($month >= 8) ? "$year/" . ($year + 1) : ($year - 1) . "/$year";
    }
}