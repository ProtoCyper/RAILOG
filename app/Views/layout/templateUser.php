<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <meta name="csrf-token-name" content="<?= csrf_token() ?>">
    <title> <?= esc($title) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            color: #333;
        }

        .navbar-custom {
            background: #0B1F3A;
            height: 80px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            display: none; /* Hide navbar completely */
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .navbar-link {
            font-size: 1.1rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        /* ini buat yang aktif */
        .navbar-link.active {
            color: #60a5fa;
            padding-bottom: 4px;
            font-weight: 600;
        }

        .hide-navbar-links .navbar-custom nav {
            display: none;
        }

        .navbar-custom-dashboard {
            justify-content: space-between;
        }

        /* Sidebar Layout sudah di-handle di admin.css */
        
    </style>
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>?v=<?= time() ?>">

</head>

<body class="bg-gray-100 min-h-screen <?= (strtolower($currentPage) === 'dashboard') ? 'hide-navbar-links' : '' ?>">

    <!-- Notification Bell (Top Right) - Only show on dashboard -->
    <?php if (strtolower($currentPage ?? '') === 'dashboard'): ?>
    <?php endif; ?>

    <!-- Sidebar Admin Style -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div style="display: flex; align-items: center; gap: 12px;">
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="RAILOG Logo" style="width: 40px; height: 40px; object-fit: contain;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div style="width: 36px; height: 36px; background: #3498db; border-radius: 8px; display: none; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 18px;">R</div>
                <div>
                    <h3>RAILOG</h3>
                    <p>Staff Gudang</p>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <a href="<?= base_url('/user/dashboard') ?>" class="nav-link <?= (strtolower($currentPage ?? '') === 'dashboard') ? 'active' : '' ?>">
                <i class="fas fa-home"></i>
                <span>Beranda</span>
            </a>
            <a href="<?= base_url('/user/kelola_barang') ?>" class="nav-link <?= (strtolower($currentPage ?? '') === 'kelolabarang') ? 'active' : '' ?>">
                <i class="fas fa-box"></i>
                <span>Kelola Barang</span>
            </a>
            <a href="<?= base_url('/user/riwayat') ?>" class="nav-link <?= (strtolower($currentPage ?? '') === 'riwayat') ? 'active' : '' ?>">
                <i class="fas fa-chart-bar"></i>
                <span>Laporan Barang</span>
            </a>
        </div>

        <!-- Spacer untuk push profile ke bawah -->
        <div class="sidebar-spacer"></div>

        <!-- User Profile di Footer Sidebar -->
        <div class="user-profile-footer">
            <a href="<?= base_url('/user/profil') ?>" class="user-profile">
                <div class="user-avatar">
                    <?php
                    $nama = trim($user['nama'] ?? '');
                    $parts = explode(' ', $nama);
                    if (count($parts) >= 2) {
                        $initials = strtoupper(substr($parts[0], 0, 1) . substr($parts[1], 0, 1));
                    } else {
                        $initials = strtoupper(substr($nama, 0, 1));
                    }
                    echo $initials;
                    ?>
                </div>
                <div class="user-info">
                    <h6><?= esc($user['nama'] ?? 'User') ?></h6>
                    <p>Staff Gudang</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Hidden Navbar (kept for non-dashboard pages compatibility) -->
    <header class="navbar-custom <?= (strtolower($currentPage) === 'dashboard') ? 'navbar-custom-dashboard' : '' ?>" style="display: none;">
        <div class="flex items-center gap-3">
            <img src="../assets/img/logo.png" alt="Logo RAILOG" class="w-10 h-10">
            <span class="text-2xl font-semibold text-white">RAILOG</span>
        </div>
        
        <?php if (strtolower($currentPage) !== 'dashboard'): ?>
        <nav class="space-x-8">
            <a href="<?= base_url('/user/dashboard') ?>" class="navbar-link text-white hover:text-blue-300 <?= (strtolower($currentPage) === 'dashboard') ? 'active' : '' ?>">Beranda</a>
            <a href="<?= base_url('/user/kelola_barang') ?>" class="navbar-link text-white hover:text-blue-300 <?= (strtolower($currentPage) === 'kelolabarang') ? 'active' : '' ?>">Kelola Barang</a>
            <div class="relative inline-block text-left">
                <button id="laporanMenuBtn" type="button" class="navbar-link text-white hover:text-blue-300 <?= (strtolower($currentPage) === 'riwayat') ? 'active' : '' ?> flex items-center gap-1">
                    Laporan Barang
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="laporanMenuDropdown" class="hidden absolute right-0 mt-2 w-52 bg-white rounded-lg shadow-lg overflow-hidden z-50">
                    <a href="<?= base_url('/user/riwayat?type=harian') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Laporan Harian</a>
                    <a href="<?= base_url('/user/riwayat?type=mingguan') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Laporan Mingguan</a>
                    <a href="<?= base_url('/user/riwayat?type=bulanan') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Laporan Bulanan</a>
                    <a href="<?= base_url('/user/riwayat?type=semua') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Semua</a>
                </div>
            </div>
            <a href="<?= base_url('/user/profil') ?>" class="navbar-link text-white hover:text-blue-300 <?= (strtolower($currentPage) === 'profil') ? 'active' : '' ?> ">Profil</a>
        </nav>
        <?php endif; ?>
        
        <!-- Bagian kanan (Notifikasi + Profil) -->
        <div class="flex items-center gap-4">
            <!-- Notifikasi -->
            <div class="relative inline-block text-left">
                <button id="notifButton" type="button"
                    class="relative flex items-center justify-center text-white focus:outline-none">
                    <span class="text-xl">🔔</span>
                    <?php if (count($notif) > 0): ?>
                        <span
                            class="absolute -top-1 -right-2 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                            <?= count($notif) ?>
                        </span>
                    <?php endif; ?>
                </button>

                <!-- Dropdown -->
                <div id="notifDropdown"
                    class="hidden absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg overflow-hidden z-50">
                    <ul class="divide-y divide-gray-200 max-h-64 overflow-y-auto">
                        <?php if (!empty($notif)): ?>
                            <?php foreach ($notif as $n): ?>
                                <li>
                                    <a href="notifikasi/read/<?= $n['id_notif'] ?>"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <?= esc($n['pesan']) ?>
                                        <div class="text-xs text-gray-400">
                                            <?= esc(formatTanggalIndo($n['created_at'])) ?>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="px-4 py-2 text-sm text-gray-500">Tidak ada notifikasi</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Profil - Hidden -->
            <a href="<?= base_url('user/profil') ?>" style="display: none;">
                <div class="flex items-center gap-4">
                    <div class="text-right text-base">
                        <div class="font-semibold text-white"><?= esc($user['nama']) ?></div>
                        <div class="text-blue-200 text-sm">Staff Gudang</div>
                    </div>

                    <?php
                    $nama = trim($user['nama']);
                    $parts = explode(' ', $nama);

                    if (count($parts) >= 2) {
                        $initials = strtoupper(substr($parts[0], 0, 1) . substr($parts[1], 0, 1));
                    } else {
                        $initials = strtoupper(substr($parts[0], 0, 2));
                    }
                    ?>

                    <div class="w-10 h-10 rounded-full border-2 border-white flex items-center justify-center bg-blue-500 text-white font-bold">
                        <?= $initials ?>
                    </div>
                </div>
            </a>
        </div>
    </header>



    <!-- Konten Dinamis -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <script>
        feather.replace();
    </script>
    <script src="<?= base_url('/assets/js/user.js') ?>"></script>
</body>

<script>
    const notifBtn = document.getElementById("notifButton");
    const notifDropdown = document.getElementById("notifDropdown");

    notifBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        notifDropdown.classList.toggle("hidden");
    });

    // klik di luar dropdown -> close
    document.addEventListener("click", (e) => {
        if (notifBtn && !notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
            notifDropdown.classList.add("hidden");
        }
    });

    // Dropdown Laporan Barang
    const laporanBtn = document.getElementById('laporanMenuBtn');
    const laporanDropdown = document.getElementById('laporanMenuDropdown');
    if (laporanBtn && laporanDropdown) {
        laporanBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            laporanDropdown.classList.toggle('hidden');
        });
        document.addEventListener('click', (e) => {
            if (!laporanBtn.contains(e.target) && !laporanDropdown.contains(e.target)) {
                laporanDropdown.classList.add('hidden');
            }
        });
    }
</script>

</html>