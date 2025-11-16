<?php
namespace App\Models;

use CodeIgniter\Model;

class FeeStructureModel extends Model
{
    protected $table = 'fee_structures';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'school_id', 'department_id', 'program', 'session',
        'level', 'semester', 'amount', 'fee_type', 'is_mandatory','fee_category'
    ];

    public function getByFilters($filters = [])
    {
        $builder = $this->builder();
        $builder->where('school_id', session()->get('school_id'));

        if (!empty($filters['department_id'])) {
            $builder->where('department_id', $filters['department_id']);
        }
        if (!empty($filters['session'])) {
            $builder->where('session', $filters['session']);
        }
        if (!empty($filters['level'])) {
            $builder->where('level', $filters['level']);
        }
        if (!empty($filters['semester'])) {
            $builder->where('semester', $filters['semester']);
        }

        return $builder->orderBy('program', 'ASC')
                       ->orderBy('level', 'ASC')
                       ->orderBy('fee_type', 'ASC')
                       ->get()
                       ->getResultArray();
    }

    public function getTotalByProgram($program, $session, $level, $semester)
    {
        return $this->selectSum('amount')
                    ->where([
                        'program' => $program,
                        'session' => $session,
                        'level' => $level,
                        'semester' => $semester,
                        'school_id' => session()->get('school_id')
                    ])
                    ->first()['amount'] ?? 0;
    }

    // public function getFeeTypes()
    // {
    //     return ['tuition','acceptance','lab','library','medical','development','ict','sports','caution'];
    // }
    public function getFeeTypes()
{
    $feeTypeModel = new \App\Models\FeeTypeModel();

    return $feeTypeModel->getBySchool();
}
}