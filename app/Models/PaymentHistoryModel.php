<?php
namespace App\Models;

use CodeIgniter\Model;

class PaymentHistoryModel extends Model
{
    protected $table = 'payment_history';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';

    protected $allowedFields = [
        'user_id', 'student_id', 'matricno', 'department_id',
        'course_of_study', 'level', 'semester', 'session',
        'payment_type', 'amount_paid', 'currency', 'reference',
        'gateway', 'status', 'paid_at'
    ];
}
