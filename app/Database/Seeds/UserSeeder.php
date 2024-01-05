<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'email' => 'admin@email.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'fullname' => 'admin 1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'email' => 'user@email.com',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'fullname' => 'user 1',
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
