<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'school_id' => 1,
                'matric_no' => 'ADMIN001',
                'email' => 'admin@demo.edu',
                'password_hash' => password_hash('admin123', PASSWORD_BCRYPT),
                'role' => 'admin',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'school_id' => 1,
                'matric_no' => 'STUDENT001',
                'email' => 'student@demo.edu',
                'password_hash' => password_hash('student123', PASSWORD_BCRYPT),
                'role' => 'student',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('users')->insertBatch($data);
    }
}