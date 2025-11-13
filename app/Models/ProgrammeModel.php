<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgrammeModel extends Model
{
    protected $table = 'programmes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'school_id', 'name', 'code', 'description', 'is_active'
    ];
    protected $useTimestamps = true; // Automatically manages created_at and updated_at
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Get all active programmes for a specific school
     */
    public function getActiveProgrammes($schoolId)
    {
        return $this->where('school_id', $schoolId)
                    ->where('is_active', 1)
                    ->findAll();
    }

    /**
     * Get a single programme by ID
     */
    public function getProgramme($id)
    {
        return $this->find($id);
    }
}
