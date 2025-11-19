public function index()
{
    $student = session()->get('student');
    $fees = model('FeeStructureModel')
        ->where('program', $student['program'])
        ->where('level', $student['level'])
        ->where('session', active_session())
        ->findAll();

    $total = array_sum(array_column($fees, 'amount'));
    $paid = model('PaymentModel')->where('student_id', $student['id'])->sum('amount');

    return view('student/fees/index', [
        'title' => 'Fee Breakdown',
        'fees' => $fees,
        'total' => $total,
        'paid' => $paid,
        'balance' => $total - $paid
    ]);
}