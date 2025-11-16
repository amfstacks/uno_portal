<?php
namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['faculty_id', 'name', 'code'];

    public function withCourses()
    {
        // return $this->select('departments.*, COUNT(courses.id) as course_count')
        //             ->join('courses', 'courses.department_id = departments.id', 'left')
        //             ->groupBy('departments.id');

                     return $this->select("
                    departments.*,
                    COUNT(DISTINCT courses.id) AS course_count,
                    COUNT(DISTINCT course_applied.id) AS applied_course_count
                ")
                ->join('courses', 'courses.department_id = departments.id', 'left')
                ->join('course_applied', 'course_applied.department_id = departments.id', 'left')
                ->groupBy('departments.id');
    }
}