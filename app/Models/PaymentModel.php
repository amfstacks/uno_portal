<?php
namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table            = 'payments';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $allowedFields = [
        'student_id', 'session', 'amount',
        'status', 'reference', 'paid_at'
    ];

    // -----------------------------------------------------------------
    // Relationships
    // -----------------------------------------------------------------
    public function student()
    {
        return $this->belongsTo(StudentModel::class, 'student_id');
    }

    // -----------------------------------------------------------------
    // Stats for Bursary
    // -----------------------------------------------------------------
    public function totalPaid(string $session = null): float
    {
        $builder = $this->where('status', 'paid');
        if ($session) {
            $builder->where('session', $session);
        }
        return (float) $builder->selectSum('amount')->first()->amount;
    }
}