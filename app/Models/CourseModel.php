<?php
namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['department_id', 'code', 'title', 'level', 'units', 'session', 'semester','course_department_id','core_elective'];
    public function getWithAppliedName($departmentId)
    {
        return $this->select('courses.*, ca.name as applied_course_name')
                    ->join('course_applied ca', 'ca.id = courses.course_department_id', 'left')
                    ->where('courses.department_id', $departmentId)
                    ->orderBy('courses.title', 'ASC')
                    ->findAll();
    }
}