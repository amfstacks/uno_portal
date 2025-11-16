<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FeeStructureModel;
use App\Models\DepartmentModel;

class FeeStructure extends BaseController
{
    protected $feeModel;
    protected $deptModel;

    public function __construct()
    {
        $this->feeModel = new FeeStructureModel();
        $this->deptModel = new DepartmentModel();
    }

    public function index()
    {
        $filters = [
            'department_id' => $this->request->getGet('department'),
            'session' => $this->request->getGet('session'),
            'level' => $this->request->getGet('level'),
            'semester' => $this->request->getGet('semester')
        ];

        $data = [
            'fees' => $this->feeModel->getByFilters($filters),
            'departments' => $this->deptModel->where('faculty_id IS NOT NULL')->findAll(),
            'filters' => $filters,
            'sessions' => $this->getSessions(),
            'levels' => ['100','200','300','400'],
            'feeTypes' => $this->feeModel->getFeeTypes()
        ];

        return view('admin/fees/index', $data);
    }

    public function create()
    {
        $data = $this->request->getPost();
        $data['school_id'] = session()->get('school_id');
        $this->feeModel->insert($data);
        toast('Fee added successfully.');
        return redirect()->back();
    }

    public function update($id)
    {
        $data = $this->request->getPost(['amount', 'is_mandatory']);
        $this->feeModel->update($id, $data);
        toast('Fee updated.');
        return redirect()->back();
    }

    public function delete($id)
    {
        $this->feeModel->delete($id);
        toast('Fee deleted.');
        return redirect()->back();
    }

    public function export()
    {
        $fees = $this->feeModel->getByFilters($this->request->getGet());
        $filename = "fee_structure_" . date('Ymd') . ".csv";
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Program', 'Session', 'Level', 'Semester', 'Fee Type', 'Amount', 'Mandatory']);

        foreach ($fees as $fee) {
            fputcsv($output, [
                $fee['program'],
                $fee['session'],
                $fee['level'],
                $fee['semester'],
                ucfirst($fee['fee_type']),
                number_format($fee['amount'], 2),
                $fee['is_mandatory'] ? 'Yes' : 'No'
            ]);
        }
        exit;
    }

    private function getSessions()
    {
        $current = date('Y');
        $sessions = [];
        for ($i = 0; $i < 5; $i++) {
            $year = $current - $i;
            $sessions[] = "$year/" . ($year + 1);
        }
        return $sessions;
    }
}