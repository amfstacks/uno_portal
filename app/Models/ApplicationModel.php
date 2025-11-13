<?php
namespace App\Models;

use CodeIgniter\Model;

class ApplicationModel extends Model
{
    protected $table            = 'applications';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    protected $createdField     = 'applied_at';
    protected $updatedField     = 'updated_at';

    protected $allowedFields = [
        'full_name', 'email', 'phone',
        'course_applied', 'status', 'admission_letter_path'
    ];
}