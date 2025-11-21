<?php
namespace App\Models;

use CodeIgniter\Model;

class RegisteredCourseModel extends Model
{
    protected $table            = 'registered_courses';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $allowedFields = [
        'student_id', 'user_id', 'matricno',
        'cid', 'ccode', 'ctitle', 'dept', 'unit',
        'level', 'session', 'semester',
        'ca', 'cbt', 'exam', 'total', 'grade',
        'graded', 'sitting',
        'date_added', 'status'
    ];

    public function student()
    {
        return $this->belongsTo(StudentModel::class, 'student_id');
    }

    /** Drop a course (set status = 'dropped') */
    public function drop(int $id)
    {
        $this->update($id, ['status' => 'dropped']);
    }
     public function isRegistered($studentId, $courseId, $session, $semester)
    {
        return $this->where([
            'student_id' => $studentId,
            'cid'        => $courseId,
            'session'    => $session,
            'semester'   => $semester
        ])->first();
    }
}