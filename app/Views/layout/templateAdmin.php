<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title) ?></title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="<?= base_url('/assets/css/admin.css') ?>">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <div class="header">
    <div class="header-content ml-72">
      <div class="header-title">
        <h1><?= $judul ?></h1>
        <p><?= $subJudul . " " . $admin['nama'] ?></p>
      </div>

      <div class="header-actions">
        <?php
        $nama = trim($admin['nama']);
        $parts = explode(" ", $nama);
        if (count($parts) >= 2) {
          // ambil huruf pertama kata 1 dan kata 2
          $avatar = strtoupper(substr($parts[0], 0, 1) . substr($parts[1], 0, 1));
        } else {
          // kalau cuma 1 kata → ambil 2 huruf awal
          $avatar = strtoupper(substr($nama, 0, 2));
        }
        ?>
        <div class="user-profile">
          <div class="user-avatar">
            <?= $avatar ?>
          </div>
          <a href="<?= base_url('admin/pengaturan-akun') ?>" class="a-info">
            <div class="user-info">
              <h6><?= esc($admin['nama']) ?></h6>
              <p><?= esc($admin['role']) ?></p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <h3>Admin Panel</h3>
      <p>Dashboard Management</p>
    </div>

    <nav class="sidebar-menu">
      <div class="menu-section">Main</div>

      <a href="<?= base_url('admin/dashboard') ?>"
        class="nav-link <?= (strtolower($currentPage) === 'dashboard') ? 'active' : '' ?>">
        <i class="fas fa-home"></i> Dashboard
      </a>

      <a href="<?= base_url('admin/kelola-barang') ?>"
        class="nav-link <?= (strtolower($currentPage) === 'kelolabarang') ? 'active' : '' ?>">
        <i class="fas fa-boxes"></i> Kelola Barang
      </a>

      <a href="<?= base_url('admin/laporan-barang') ?>"
        class="nav-link <?= (strtolower($currentPage) === 'laporan') ? 'active' : '' ?>">
        <i class="fas fa-file-alt"></i> Laporan Barang
      </a>

      <a href="<?= base_url('admin/kelola-staff') ?>"
        class="nav-link <?= (strtolower($currentPage) === 'kelolastaff') ? 'active' : '' ?>">
        <i class="fas fa-user-friends"></i> Kelola Staff
      </a>

      <a href="<?= base_url('admin/log-aktivitas-staff') ?>" class="nav-link <?= ($currentPage === 'log-aktivitas-staff') ? 'active' : '' ?>">
        <i class="fas fa-clipboard-list"></i> Log Aktivitas Staff
      </a>

      <div class="menu-section">System</div>

      <a href="<?= base_url('admin/pengaturan-akun') ?>"
        class="nav-link <?= (strtolower($currentPage) === 'profil') ? 'active' : '' ?>">
        <i class="fas fa-user-cog"></i> Pengaturan Akun
      </a>

      <a href="<?= base_url('/logout') ?>" class="nav-link" id="logoutBtn">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </nav>
  </div>

  <?= $this->renderSection('content') ?>

  <script src="<?= base_url('/assets/js/admin.js') ?>"></script>
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