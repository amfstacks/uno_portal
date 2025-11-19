<?php
namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'students';
    protected $primaryKey       = 'id';

    protected $useSoftDeletes   = true;
    protected $deletedField     = 'deleted_at';

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $allowedFields = [
        'user_id',
        'matric_no',

        // New name fields
        'first_name',
        'last_name',
        'middle_name',

        // Admission / academic info
        'session_admit',
        'start_level',
        'level',
        'session',
        'semester',

        // Course & department info
        'course_of_study',
        'department',
        'faculty',

        // Personal info
        'email',
        'religion',
        'state_of_origin',
        'dob',
        'blood_group',
        'bio',

        // Media files
        'profile_pic',
        'signature',

        // System info
        'gpa',
        'cgpa',
        'is_probation',
        'status',
    ];

    // -----------------------------------------------------------------
    // Relationships
    // -----------------------------------------------------------------
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function payments()
    {
        return $this->hasMany(PaymentModel::class, 'student_id');
    }

    public function results()
    {
        return $this->hasMany(ResultModel::class, 'student_id');
    }

    public function registeredCourses()
    {
        return $this->hasMany(RegisteredCourseModel::class, 'student_id');
    }

    // Helper: count students registered for a given session
    public function countBySession(string $session): int
    {
        return $this->where('session', $session)->countAllResults();
    }

    // Helper: fetch probation list
    public function probationList()
    {
        return $this->where('is_probation', 1)->findAll();
    }
     public function getFullProfile($userId)
    {
        return $this->select("
                students.*,

                course_applied.name AS course_name,
                course_applied.code AS course_code,

                departments.name AS department_name,
                departments.code AS department_code,

                faculties.name AS faculty_name,
                faculties.code AS faculty_code
            ")
            ->join('course_applied', 'course_applied.id = students.course_of_study', 'left')
            ->join('departments', 'departments.id = students.department', 'left')
            ->join('faculties', 'faculties.id = students.faculty', 'left')
            ->where('students.user_id', $userId)
            ->first();
    }
}
