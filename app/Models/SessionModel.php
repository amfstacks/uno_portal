<?php
namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model
{
    protected $table = 'academic_sessions';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'school_id', 'session_name', 'semester', 'is_active','programme_id',
        'application_open', 'registration_open', 'results_entry_open','session_type'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
     public function deactivateAll($schoolId, $programmeId,$session_type)
    {
        return $this->where('school_id', $schoolId)
                    ->where('programme_id', $programmeId)
                    ->where('session_type', $session_type)
                    ->set(['is_active' => 0])
                    ->update();
    }

    public function getActive($schoolId,$programmeId)
    {
        return $this->where('school_id', $schoolId)->where('is_active', 1)
         ->where('programme_id', $programmeId)->first();
    }

    public function toggle($field, $value,$programmeId)
    {
        $session = $this->getActive(session()->get('school_id'),$programmeId);
        if ($session) {
            $this->update($session['id'], [$field => $value]);
        }
    }
     public function updateActive(array $data, $programmeId)
    {
        $session = $this->getActive(session()->get('school_id'),$programmeId);
        if ($session) {
            return $this->update($session['id'], $data);
        }
        return false; // optional: handle if no active session exists
    }
    public function getAllActiveSessions($schoolId)
{
    return $this->where('school_id', $schoolId)
                ->where('is_active', 1)
                ->findAll();
}
}