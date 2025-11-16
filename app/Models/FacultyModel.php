<?php
namespace App\Models;

use CodeIgniter\Model;

class FacultyModel extends Model
{
    protected $table = 'faculties';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['school_id', 'name', 'code'];

    public function withDepartments()
    {
        return $this->select('faculties.*, COUNT(departments.id) as dept_count')
                    ->join('departments', 'departments.faculty_id = faculties.id', 'left')
                    ->groupBy('faculties.id');
    }
}