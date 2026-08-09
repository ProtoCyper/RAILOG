<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $admins = [];

        // Hash password sekali untuk menghemat proses
        $passwordHash = password_hash('wifiburik14', PASSWORD_DEFAULT);

        for ($i = 1; $i <= 100; $i++) {

            // Tentukan role
            $role = ($i === 1) ? 'Super Admin' : 'Admin';

            // Tentukan status aktif:
            // - Admin #1 aktif = 1
            // - Admin #2 sampai #99 aktif = 0
            // - Admin #100 aktif = 1 (default)
            if ($i === 1) {
                $aktif = 1;
            } elseif ($i >= 2 && $i <= 99) {
                $aktif = 0;
            } else {
                $aktif = 1; // admin #100
            }

            $admins[] = [
                'nama'               => ($i === 1) ? 'Super Administrator' : 'Admin ' . $i,
                'email'              => 'admin' . $i . '@gmail.com',
                'password'           => $passwordHash,
                'role'               => $role,
                'aktif'              => $aktif,
                'aktivitas_terakhir' => null,
            ];
        }

        $this->db->table('admin')->insertBatch($admins);
    }
}
