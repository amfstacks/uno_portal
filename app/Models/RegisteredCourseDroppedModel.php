<?php

namespace App\Models;

use CodeIgniter\Model;

class RegisteredCourseDroppedModel extends Model
{
    protected $table      = 'registered_courses_dropped';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    // Allowed fields for insert/update
    protected $allowedFields = [
        'student_id',
        'user_id',
        'matricno',
        'cid',
        'ccode',
        'ctitle',
        'dept',
        'unit',
        'level',
        'session',
        'semester',
        'ca',
        'cbt',
        'exam',
        'total',
        'grade',
        'graded',
        'sitting',
        'created_at',
        'updated_at',
        'dropped_at'
    ];

    // Automatically manage timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Optional: set the date format
    protected $dateFormat = 'datetime';

    /**
     * Move a registered course to the dropped table
     *
     * @param array $courseData Full course row from registered_courses table
     * @return bool
     */
    public function dropCourse(array $courseData)
    {
        // Add a dropped_at timestamp
        $courseData['dropped_at'] = date('Y-m-d H:i:s');

        return $this->insert($courseData);
    }

    /**
     * Check if a dropped course exists for a student in a session and semester
     *
     * @param int $studentId
     * @param int $courseId
     * @param string $session
     * @param string $semester
     * @return array|null
     */
    public function findDroppedCourse(int $studentId, int $courseId, string $session, string $semester)
    {
        return $this->where('student_id', $studentId)
                    ->where('cid', $courseId)
                    ->where('session', $session)
                    ->where('semester', $semester)
                    ->first();
    }
}
