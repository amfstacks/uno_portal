<?php

namespace App\Models;

use CodeIgniter\Model;

class FeeTypeModel extends Model
{
    protected $table = 'fee_types';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'school_id', 'name', 'description'
    ];

    public function getBySchool()
    {
        return $this->where('school_id', session()->get('school_id'))
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }
}
