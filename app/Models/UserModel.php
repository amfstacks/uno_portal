<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['school_id', 'matric_no', 'email', 'password_hash', 'role', 'is_active'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $beforeInsert = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
            unset($data['data']['password']);
        }
        return $data;
    }

    public function school()
    {
        return $this->belongsTo(SchoolModel::class, 'school_id');
    }

    public function student()
    {
        return $this->hasOne(StudentModel::class, 'user_id');
    }

    // -----------------------------------------------------------------
    // Helper: find active exam-officers for the current school
    // -----------------------------------------------------------------
    public function activeExamOfficers()
    {
        return $this->where('role', 'exam_officer')
                    ->where('is_active', 1)
                    ->where('school_id', session()->get('school_id'))
                    ->findAll();
    }
}