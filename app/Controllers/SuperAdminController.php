<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\BarangModel;
use App\Models\LaporanModel;
use App\Models\LogAktivitasModel;

class SuperAdminController extends BaseController
{
    protected $adminModel,
        $userModel,
        $barangModel,
        $laporanModel,
        $logAktivitasModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel;
        $this->userModel = new userModel;
        $this->barangModel = new BarangModel;
        $this->laporanModel = new LaporanModel;
        $this->logAktivitasModel = new LogAktivitasModel;
    }

    public function dashSuperAdmin()
    {
        $dataSuperAdmin = session()->get('id_admin');
        $superAdmin = $this->adminModel->find($dataSuperAdmin);

        // Hitung total admin dan staff
        $totalAdmin = $this->adminModel
            ->where('role', 'Admin')
            ->countAllResults();

        $totalAdminAktif = $this->adminModel
            ->where('role', 'Admin')
            ->where('aktif', true)
            ->countAllResults();

        $totalBarang = $this->barangModel
            ->select('COUNT(DISTINCT nama_barang) as total')
            ->first()['total'] ?? 0;

        $totalStaff = $this->userModel->countAllResults();

        $logsAdmin = $this->logAktivitasModel->getLogsByAdmin();

        foreach ($logsAdmin as &$log) {
            $log['waktu_ago'] = $this->timeAgo($log['created_at']);
        }

        $data = [
            'title'             => 'Dashboard Admin - CargoWing',
            'currentPage'       => 'dashboard',
            'judul'             => 'Dashboard',
            'subJudul'          => 'Ringkasan informasi penting',
            'superAdmin'        => $superAdmin,
            'totalAdmin'        => $totalAdmin,
            'totalAdminAktif'   => $totalAdminAktif,
            'totalStaff'        => $totalStaff,
            'totalBarang'       => $totalBarang,
            'logsAdmin'         => $logsAdmin,
        ];

        return view('superadmin/dashboard', $data);
    }

    /**
     * Konversi created_at menjadi format "x menit/jam yang lalu"
     */
    private function timeAgo($datetime)
    {
        $timestamp = strtotime($datetime);
        $diff = time() - $timestamp;

        if ($diff < 60) {
            return $diff . ' detik yang lalu';
        } elseif ($diff < 3600) {
            return floor($diff / 60) . ' menit yang lalu';
        } elseif ($diff < 86400) {
            return floor($diff / 3600) . ' jam yang lalu';
        } else {
            return floor($diff / 86400) . ' hari yang lalu';
        }
    }

    public function kelolaAdmin()
    {
        $dataSuperAdmin = session()->get('id_admin');
        $superAdmin = $this->adminModel->find($dataSuperAdmin);
        $keyword   = $this->request->getVar('keyword');
        $perPage  = $this->request->getVar('per_page') ?? 10;

        $dataAdmin = $this->adminModel->getAdminWithFilter($keyword, $perPage);

        $data = [
            'title'         => 'Kelola Admin',
            'currentPage'   => 'kelola-admin',
            'keyword'       => $keyword,
            'perPage'       => $perPage,
            'pager'         => $this->adminModel->pager,
            'superAdmin'    => $superAdmin,
            'dataAdmin'     => $dataAdmin,
        ];
        return view('superadmin/kelola_admin', $data);
    }

    public function tambahAdmin()
    {
        $nama     = $this->request->getPost('nama');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // validasi sederhana
        if (empty($nama) || empty($email) || empty($password)) {
            return redirect()->back()->with('error', 'Semua field wajib diisi!');
        }

        $data = [
            'nama'     => $nama,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => 'Admin',
        ];

        $this->adminModel->insert($data);

        return redirect()->to(base_url('superadmin/kelola-admin'))
            ->with('success', 'Admin baru berhasil ditambahkan.');
    }

    public function editAdmin($id_admin)
    {
        $admin = $this->adminModel->find($id_admin);
        if (!$admin) {
            return redirect()->to(base_url('superadmin/kelola-admin'))
                ->with('error', 'Data admin tidak ditemukan.');
        }

        $nama     = $this->request->getPost('nama');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $dataUpdate = [
            'nama'  => $nama,
            'email' => $email,
        ];

        // hanya update password kalau diisi
        if (!empty($password)) {
            $dataUpdate['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->adminModel->update($id_admin, $dataUpdate);

        return redirect()->to(base_url('superadmin/kelola-admin'))
            ->with('success', 'Data admin berhasil diperbarui.');
    }

    public function hapusAdmin($id_admin)
    {
        $admin = $this->adminModel->find($id_admin);
        if (!$admin) {
            return redirect()->to(base_url('superadmin/kelola-admin'))
                ->with('error', 'Data admin tidak ditemukan.');
        }

        $this->adminModel->delete($id_admin);

        return redirect()->to(base_url('superadmin/kelola-admin'))
            ->with('success', 'Admin berhasil dihapus.');
    }

    public function logAktivitasAdmin()
    {
        $dataSuperAdmin = session()->get('id_admin');
        $superAdmin = $this->adminModel->find($dataSuperAdmin);
        $keyword   = $this->request->getVar('keyword');
        $perPage  = $this->request->getVar('per_page') ?? 10;

        $logsAdmin = $this->logAktivitasModel->getLogsByAdminWithFilter($keyword, $perPage);

        $data = [
            'title'         => 'Log Aktivitas Admin',
            'currentPage'   => 'log-aktivitas-admin',
            'keyword'       => $keyword,
            'perPage'       => $perPage,
            'pager'         => $this->logAktivitasModel->pager,
            'superAdmin'    => $superAdmin,
            'logsAdmin'     => $logsAdmin,
        ];
        return view('superadmin/log_aktivitas_admin', $data);
    }

    public function pengaturanAkun()
    {
        $dataSuperAdmin = session()->get('id_admin');
        $superAdmin = $this->adminModel->find($dataSuperAdmin);

        $data = [
            'title'         => 'Pengaturan Akun',
            'currentPage'   => 'pengaturan-akun',
            'superAdmin'    => $superAdmin
        ];
        return view('superadmin/pengaturan_akun', $data);
    }

    public function updateProfil()
    {
        $adminId = session()->get('id_admin');
        $admin   = $this->adminModel->find($adminId);

        if (!$admin) {
            return redirect()->back()->with('error', 'Data admin tidak ditemukan!');
        }

        $nama  = $this->request->getPost('nama');
        $email = $this->request->getPost('email');

        $dataUpdate = [
            'nama'  => $nama,
            'email' => $email,
        ];

        // Update data
        $this->adminModel->update($adminId, $dataUpdate);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function gantiPassword()
    {
        $adminId = session()->get('id_admin');
        $admin   = $this->adminModel->find($adminId);

        if (!$admin) {
            return redirect()->back()->with('errorp', 'Data admin tidak ditemukan!');
        }

        $passwordLama = $this->request->getPost('password_lama');
        $passwordBaru = $this->request->getPost('password_baru');
        $konfirmasi   = $this->request->getPost('konfirmasi_password');

        if (!password_verify($passwordLama, $admin['password'])) {
            return redirect()->back()->with('errorp', 'Password lama salah!');
        }

        if ($passwordBaru !== $konfirmasi) {
            return redirect()->back()->with('errorp', 'Konfirmasi password tidak cocok!');
        }

        $this->adminModel->update($adminId, [
            'password' => password_hash($passwordBaru, PASSWORD_DEFAULT)
        ]);

        return redirect()->back()->with('successp', 'Password berhasil diubah!');
    }
}
