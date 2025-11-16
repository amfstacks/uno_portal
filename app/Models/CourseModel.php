<?php
namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['department_id', 'code', 'title', 'level', 'units', 'session', 'semester'];
}