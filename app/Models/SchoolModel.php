<?php
namespace App\Models;

use CodeIgniter\Model;

class SchoolModel extends Model
{
    protected $table            = 'schools';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    protected $allowedFields = [
        'name', 'short_name', 'logo', 'primary_color',
        'secondary_color', 'header_html', 'footer_html',
        'custom_css', 'custom_js'
    ];

    // -----------------------------------------------------------------
    // Helper: get the current school (cached for the request)
    // -----------------------------------------------------------------
    public function current()
    {
        $schoolId = session()->get('school_id') ?? 1;
        return cache()->remember("school_{$schoolId}", 3600, function () use ($schoolId) {
            return $this->find($schoolId);
        });
    }
}