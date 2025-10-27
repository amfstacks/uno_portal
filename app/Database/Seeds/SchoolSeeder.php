<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SchoolSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Demo University',
                'short_name' => 'DU',
                'logo' => '/assets/uploads/logos/demo.png',
                'primary_color' => '#1e40af',
                'secondary_color' => '#1e293b',
                'header_html' => '<header class="bg-[#1e40af] text-white p-4"><h1>Demo University</h1></header>',
                'footer_html' => '<footer class="bg-gray-800 text-white p-4 text-center">© 2025 Demo University</footer>',
                'custom_css' => 'body { font-family: Arial, sans-serif; }',
                'custom_js' => 'console.log("Demo University Loaded");'
            ]
        ];
        $this->db->table('schools')->insertBatch($data);
    }
}