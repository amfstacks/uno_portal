<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseAppliedModel extends Model
{
    protected $table = 'course_applied';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'department_id',
        'name',
        'code',
        'duration',
        'level',
        'school_id'
    ];

    public function getByDepartment($department_id)
    {
        return $this->where([
                'department_id' => $department_id,
                'school_id' => session()->get('school_id')
            ])
            ->orderBy('name', 'ASC')
            ->findAll();
    }
}
