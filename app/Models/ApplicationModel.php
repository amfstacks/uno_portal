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
        'user_id', 'first_name', 'middle_name', 'last_name',
        'email', 'phone', 'program', 'course_id', 'status'
    ];
}