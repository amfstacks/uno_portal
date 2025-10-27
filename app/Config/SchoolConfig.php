<?php
// app/Config/SchoolConfig.php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class SchoolConfig extends BaseConfig
{
    public $school = [];

  public function init()
    {
        $db = \Config\Database::connect();
        $schoolId = session()->get('school_id') ?? 1;
        $this->school = $db->table('schools')->getWhere(['id' => $schoolId])->getRowArray() ?? [
            'name' => 'Default School',
            'logo' => '/assets/uploads/logos/default.png',
            'primary_color' => '#1e40af',
            'secondary_color' => '#1e293b',
            'custom_css' => '',
            'custom_js' => '',
            'header_html' => '',
            'footer_html' => ''
        ];
    }
}