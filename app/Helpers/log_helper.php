<?php

use Config\Database;
use Config\Services;

if (!function_exists('logAktivitas')) {
    /**
     * Catat log aktivitas user/admin
     *
     * @param string $aktivitas Deskripsi aktivitas
     */
    function logAktivitas(string $aktivitas)
    {
        $db      = Database::connect();
        $request = Services::request();
        $session = session();

        // Data dasar
        $data = [
            'role'       => $session->get('role') ?: 'tidak terdaftar',
            'aktivitas'  => $aktivitas,
            'ip_address' => $request->getIPAddress(),
            'user_agent' => $request->getUserAgent()->getAgentString(),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Bedakan kolom id tergantung role
        if ($session->get('role') === 'User') {
            $data['id_user'] = $session->get('id_user');
        } else {
            $data['id_admin'] = $session->get('id_admin');
        }

        $db->table('log_aktivitas')->insert($data);
    }
}
