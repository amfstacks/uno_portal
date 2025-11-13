<?php
namespace App\Models;

use CodeIgniter\Model;

class ResultModel extends Model
{
    protected $table            = 'results';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $allowedFields = [
        'student_id', 'course_code', 'session',
        'semester', 'score', 'grade', 'uploaded_by'
    ];

    // -----------------------------------------------------------------
    // Relationships
    // -----------------------------------------------------------------
    public function student()
    {
        return $this->belongsTo(StudentModel::class, 'student_id');
    }

    public function uploader()
    {
        return $this->belongsTo(UserModel::class, 'uploaded_by');
    }

    // -----------------------------------------------------------------
    // Compute GPA for a student in a given session/semester
    // -----------------------------------------------------------------
    public function computeGPA(int $studentId, string $session, string $semester): ?float
    {
        $rows = $this->where('student_id', $studentId)
                     ->where('session', $session)
                     ->where('semester', $semester)
                     ->findAll();

        if (empty($rows)) {
            return null;
        }

        $totalPoints = 0;
        $totalUnits  = 0;

        // Assume you have a `courses` table with `unit` column.
        // For demo we treat every course as 3 units.
        $unit = 3;

        foreach ($rows as $r) {
            $gradePoint = $this->gradeToPoint($r['grade']);
            $totalPoints += $gradePoint * $unit;
            $totalUnits  += $unit;
        }

        return $totalUnits ? round($totalPoints / $totalUnits, 2) : 0;
    }

    private function gradeToPoint(string $grade): int
    {
        return match (strtoupper($grade)) {
            'A' => 5, 'B' => 4, 'C' => 3, 'D' => 2, 'E' => 1, default => 0
        };
    }
}