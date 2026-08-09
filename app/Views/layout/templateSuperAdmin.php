<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href=" <?= base_url('/assets/css/superAdmin.css') ?>">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Super Admin Panel</h3>
            <p>Dashboard Management</p>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-section">Main</div>

            <a href="<?= base_url('superadmin/dashboard') ?>" class="nav-link <?= ($currentPage === 'dashboard') ? 'active' : '' ?>">
                <i class="fas fa-home"></i> Dashboard
            </a>

            <a href="<?= base_url('superadmin/kelola-admin') ?>" class="nav-link <?= ($currentPage === 'kelola-admin') ? 'active' : '' ?>">
                <i class="fas fa-user-friends"></i> Kelola Admin
            </a>

            <a href="<?= base_url('superadmin/log-aktivitas-admin') ?>" class="nav-link <?= ($currentPage === 'log-aktivitas-admin') ? 'active' : '' ?>">
                <i class="fas fa-clipboard-list"></i> Log Aktivitas Admin
            </a>

            <div class="menu-section">System</div>

            <a href="<?= base_url('superadmin/pengaturan-akun') ?>" class="nav-link <?= ($currentPage === 'pengaturan-akun') ? 'active' : '' ?>">
                <i class="fas fa-user-cog"></i> Pengaturan Akun
            </a>

            <a href="<?= base_url('/logout') ?>" class="nav-link" id="logoutBtn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </nav>

    </div>

    <?= $this->renderSection('content') ?>

    <script src="<?= base_url('/assets/js/superAdmin.js') ?>"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutBtn = document.getElementById('logoutBtn');

            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault(); // Cegah logout langsung

                    Swal.fire({
                        title: 'Yakin ingin logout?',
                        text: 'Kamu akan keluar dari sesi sekarang.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Logout',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = logoutBtn.href; // Arahkan ke URL logout
                        }
                    });
                });
            }
        });
    </script>
</body>

</html>