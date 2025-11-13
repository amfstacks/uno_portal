<?php
namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model
{
    protected $table = 'academic_sessions';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'school_id', 'session_name', 'semester', 'is_active',
        'application_open', 'registration_open', 'results_entry_open'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';

    public function getActive($schoolId)
    {
        return $this->where('school_id', $schoolId)->where('is_active', 1)->first();
    }

    public function toggle($field, $value)
    {
        $session = $this->getActive(session()->get('school_id'));
        if ($session) {
            $this->update($session['id'], [$field => $value]);
        }
    }
     public function updateActive(array $data)
    {
        $session = $this->getActive(session()->get('school_id'));
        if ($session) {
            return $this->update($session['id'], $data);
        }
        return false; // optional: handle if no active session exists
    }
}