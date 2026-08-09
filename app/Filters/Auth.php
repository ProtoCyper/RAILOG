<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Kalau belum login, redirect ke login
        if (! $session->get('logged_in')) {
            return redirect()->to('/')->with('error', 'Silakan login dulu.');
        }

        // Kalau ada argument role, cek kesesuaian
        if ($arguments && isset($arguments[0])) {
            $requiredRole = $arguments[0];
            if ($session->get('role') !== $requiredRole) {
                return redirect()->to('/')->with('error', 'Akses ditolak.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada yang dilakukan setelah permintaan
    }
}
