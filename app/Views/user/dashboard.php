<?= $this->extend('layout/templateUser'); ?>
<?= $this->section('content'); ?>

<style>
    .dashboard-wrapper {
        margin-left: 280px;
        background-color: #f0f2f5;
        min-height: 100vh;
        padding: 0;
    }

    .dashboard-header {
        background: white;
        padding: 1.5rem 2rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-title-section {
        flex: 1;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .page-subtitle {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0.25rem 0 0 0;
    }

    .dashboard-container {
        padding: 2rem;
    }

    .header-title h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .header-title p {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0.25rem 0 0 0;
    }

    .notification-bell {
        position: relative;
        background: #f3f4f6;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s;
        flex-shrink: 0;
    }

    .notification-bell:hover {
        background: #e5e7eb;
    }

    .notification-bell i {
        font-size: 1.125rem;
        color: #374151;
    }

    .notification-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        background: #ef4444;
        color: white;
        font-size: 0.625rem;
        font-weight: 700;
        padding: 0.125rem 0.375rem;
        border-radius: 10px;
        min-width: 18px;
        text-align: center;
    }

    .notification-dropdown {
        position: absolute;
        top: 50px;
        right: 2rem;
        width: 320px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        overflow: hidden;
    }

    .notification-dropdown.hidden {
        display: none;
    }

    .notification-dropdown-header {
        padding: 1rem 1.25rem;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
    }

    .notification-dropdown-header h3 {
        font-size: 0.875rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .notification-list {
        max-height: 360px;
        overflow-y: auto;
    }

    .notification-item {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f3f4f6;
        transition: background 0.2s;
        cursor: pointer;
    }

    .notification-item:hover {
        background: #f9fafb;
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notification-text {
        font-size: 0.8125rem;
        color: #374151;
        line-height: 1.5;
        margin-bottom: 0.25rem;
    }

    .notification-time {
        font-size: 0.75rem;
        color: #9ca3af;
    }

    .notification-empty {
        padding: 2rem 1.25rem;
        text-align: center;
        color: #9ca3af;
        font-size: 0.875rem;
    }

    .dashboard-container {
        padding: 2rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
        position: relative;
        border-bottom: 3px solid;
    }

    .stat-card:nth-child(1) {
        border-bottom-color: #10b981;
    }

    .stat-card:nth-child(2) {
        border-bottom-color: #3b82f6;
    }

    .stat-card:nth-child(3) {
        border-bottom-color: #6366f1;
    }

    .stat-card:nth-child(4) {
        background: #fef3c7;
        border-bottom-color: #f59e0b;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .stat-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.75rem;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1f2937;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-meta {
        font-size: 0.875rem;
        color: #10b981;
        font-weight: 600;
        margin-bottom: 0.75rem;
        display: inline-block;
    }

    .stat-card:nth-child(2) .stat-meta {
        color: #3b82f6;
    }

    .stat-card:nth-child(3) .stat-meta {
        color: #6b7280;
    }

    .stat-card:nth-child(4) .stat-meta {
        color: #1f2937;
    }

    .stat-description {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.5rem;
    }

    .stat-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: #fbbf24;
        color: #78350f;
        font-size: 0.625rem;
        font-weight: 700;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        text-transform: uppercase;
    }

    .progress-bar {
        height: 6px;
        background: #e5e7eb;
        border-radius: 3px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        border-radius: 3px;
        transition: width 0.3s ease;
    }

    .stat-card:nth-child(1) .progress-fill {
        background: linear-gradient(90deg, #10b981, #059669);
    }

    .stat-card:nth-child(2) .progress-fill {
        background: linear-gradient(90deg, #3b82f6, #2563eb);
    }

    .stat-card:nth-child(3) .progress-fill {
        background: linear-gradient(90deg, #8b5cf6, #7c3aed);
    }

    .stat-card:nth-child(4) .progress-fill {
        background: linear-gradient(90deg, #f59e0b, #d97706);
    }

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
    }

    .content-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.25rem;
    }

    .section-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1f2937;
    }

    .section-link {
        font-size: 0.875rem;
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
    }

    .section-link:hover {
        color: #2563eb;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    .data-table thead {
        border-bottom: 2px solid #e5e7eb;
    }

    .data-table th {
        padding: 0.75rem 1rem;
        text-align: left;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        font-size: 0.6875rem;
        letter-spacing: 0.5px;
        background: #fafafa;
    }

    .data-table td {
        padding: 1rem;
        border-bottom: 1px solid #f3f4f6;
        color: #374151;
        vertical-align: top;
    }

    .data-table tbody tr:hover {
        background-color: #f9fafb;
    }

    .data-table tbody tr:last-child td {
        border-bottom: none;
    }

    .badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .badge-masuk {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-dipakai {
        background: #fee2e2;
        color: #991b1b;
    }

    .value-positive {
        color: #10b981;
        font-weight: 700;
    }

    .value-negative {
        color: #ef4444;
        font-weight: 700;
    }

    .sidebar-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .sidebar-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .stock-item {
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .stock-item:last-child {
        border-bottom: none;
    }

    .stock-item-name {
        font-weight: 600;
        color: #1f2937;
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .stock-item-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.75rem;
        color: #6b7280;
    }

    .stock-count {
        color: #ef4444;
        font-weight: 700;
        font-size: 0.875rem;
    }

    .system-status {
        background: #1e293b;
        border-radius: 12px;
        padding: 1.25rem;
        color: white;
    }

    .status-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .status-icon {
        color: #fbbf24;
    }

    .status-title {
        font-weight: 700;
        font-size: 0.875rem;
    }

    .status-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        font-size: 0.8125rem;
    }

    .status-value {
        font-weight: 700;
    }

    .status-ready {
        color: #10b981;
    }

    .activity-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.75rem;
        border-radius: 6px;
        font-size: 0.8125rem;
        font-weight: 500;
    }

    .activity-badge i {
        font-size: 0.75rem;
    }

    .activity-received {
        background: #d1fae5;
        color: #065f46;
    }

    .activity-dispatched {
        background: #dbeafe;
        color: #1e40af;
    }

    .activity-updated {
        background: #e0e7ff;
        color: #3730a3;
    }

    .view-all-link {
        color: #3b82f6;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s;
    }

    .view-all-link:hover {
        color: #2563eb;
    }

    .low-stock-table {
        overflow-x: auto;
        max-height: 500px;
        overflow-y: auto;
    }

    .stock-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.8125rem;
    }

    .stock-table thead {
        border-bottom: 2px solid #e5e7eb;
    }

    .stock-table th {
        padding: 0.625rem 0.5rem;
        text-align: left;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        font-size: 0.625rem;
        letter-spacing: 0.5px;
        background: #fafafa;
    }

    .stock-table td {
        padding: 0.75rem 0.5rem;
        border-bottom: 1px solid #f3f4f6;
        color: #374151;
        font-size: 0.8125rem;
    }

    .stock-table tbody tr:hover {
        background-color: #f9fafb;
    }

    .stock-table tbody tr:last-child td {
        border-bottom: none;
    }

    .item-with-icon {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .item-icon {
        width: 32px;
        height: 32px;
        background: #f3f4f6;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .item-name {
        font-weight: 600;
        color: #1f2937;
        font-size: 0.8125rem;
    }

    .category-badge {
        background: #f3f4f6;
        color: #6b7280;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-block;
    }

    .stock-available {
        color: #ef4444;
        font-weight: 700;
        font-size: 0.875rem;
    }

    .stock-reorder {
        color: #6b7280;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .status-low-stock {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        color: #dc2626;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-low-stock i {
        font-size: 0.625rem;
    }

    @media (max-width: 1024px) {
        .dashboard-wrapper {
            margin-left: 0;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-container {
            padding: 1rem;
        }
    }
</style>

<div class="dashboard-wrapper">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <!-- Title Section -->
        <div class="header-title-section">
            <h1 class="page-title">Beranda</h1>
            <p class="page-subtitle">Dashboard overview dan statistik inventori gudang</p>
        </div>

        <!-- Notification Bell -->
        <div class="notification-bell" id="notificationBell">
            <i class="fas fa-bell"></i>
            <?php if (!empty($notif) && count($notif) > 0): ?>
                <span class="notification-badge"><?= count($notif) ?></span>
            <?php endif; ?>
        </div>

        <!-- Notification Dropdown -->
        <div class="notification-dropdown hidden" id="notificationDropdown">
            <div class="notification-dropdown-header">
                <h3>Notifikasi</h3>
            </div>
            <div class="notification-list">
                <?php if (!empty($notif)): ?>
                    <?php foreach ($notif as $n): ?>
                        <a href="<?= base_url('user/notifikasi/read/' . $n['id_notif']) ?>" class="notification-item" style="display: block; text-decoration: none; color: inherit;">
                            <div class="notification-text"><?= esc($n['pesan']) ?></div>
                            <div class="notification-time"><?= esc(formatTanggalIndo($n['created_at'])) ?></div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="notification-empty">Tidak ada notifikasi</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="dashboard-container">
        <!-- Stats Cards -->
        <div class="stats-grid">
            <!-- Barang Masuk -->
            <div class="stat-card">
                <div class="stat-label">Barang Masuk</div>
                <div class="stat-value"><?= number_format($totalMasuk, 0, ',', '.') ?></div>
                <?php
                // Calculate percentage (mock calculation, you can adjust based on previous period)
                $masukPercentage = 12; // Based on design
                ?>
                <div class="stat-meta">+<?= $masukPercentage ?>%</div>
            </div>

            <!-- Barang Dipakai -->
            <div class="stat-card">
                <div class="stat-label">Barang Dipakai</div>
                <div class="stat-value"><?= number_format($totalDipakai, 0, ',', '.') ?></div>
                <?php
                $dipakaiPercentage = 4;
                ?>
                <div class="stat-meta"><?= $dipakaiPercentage ?>%</div>
            </div>

            <!-- Total Stok -->
            <div class="stat-card">
                <div class="stat-label">Total Stok</div>
                <div class="stat-value"><?= number_format($totalBarang, 0, ',', '.') ?></div>
                <div class="stat-meta">Unit</div>
            </div>

            <!-- Stok Minimum -->
            <div class="stat-card">
                <?php if ($barangMinimum > 0): ?>
                    <span class="stat-badge">ALERT</span>
                <?php endif; ?>
                <div class="stat-label">Stok Minimum</div>
                <div class="stat-value"><?= $barangMinimum ?></div>
                <div class="stat-meta">SKU</div>
                <div class="stat-description">Membutuhkan restock segera</div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Aktivitas Terbaru -->
            <div class="content-section">
                <div class="section-header">
                    <h2 class="section-title">Aktivitas Terbaru</h2>
                    <a href="<?= base_url('/user/riwayat') ?>" class="section-link">Lihat Semua</a>
                </div>

                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>WAKTU</th>
                                <th>AKTIVITAS</th>
                                <th>BARANG</th>
                                <th>DETAIL</th>
                                <th>PENGGUNA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($laporanData)): ?>
                                <?php foreach ($laporanData as $index => $laporan): ?>
                                    <tr>
                                        <td>
                                            <?php
                                            // Data dari database sudah dalam timezone Jakarta
                                            // Tidak perlu konversi lagi
                                            $datetime = new DateTime($laporan['tanggal']);
                                            
                                            // Format: "20 Agu, 21:44"
                                            $bulan = [
                                                1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
                                                5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
                                                9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
                                            ];
                                            
                                            $day = $datetime->format('j');
                                            $month = $bulan[(int)$datetime->format('n')];
                                            $time = $datetime->format('H:i');
                                            
                                            echo "$day $month,<br>$time";
                                            ?>
                                        </td>
                                        <td>
                                            <?php if (strtolower($laporan['jenis']) === 'masuk'): ?>
                                                <span class="activity-badge activity-received">
                                                    <i class="fas fa-arrow-down"></i>
                                                    <span>Barang Masuk</span>
                                                </span>
                                            <?php else: ?>
                                                <span class="activity-badge activity-dispatched">
                                                    <i class="fas fa-arrow-up"></i>
                                                    <span>Barang Dipakai</span>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="font-weight: 600;"><?= esc($laporan['nama_barang']) ?></td>
                                        <td>
                                            <?php if (strtolower($laporan['jenis']) === 'masuk'): ?>
                                                Diterima <?= number_format($laporan['jumlah'], 0, ',', '.') ?> unit
                                            <?php else: ?>
                                                Dipakai <?= number_format($laporan['jumlah'], 0, ',', '.') ?> unit
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($laporan['nama_user'] ?? 'Unknown') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 2rem; color: #9ca3af;">
                                        Belum ada aktivitas
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div style="text-align: center; margin-top: 1.5rem;">
                    <a href="<?= base_url('/user/riwayat') ?>" class="view-all-link">Lihat Semua Aktivitas</a>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Barang Stok Rendah -->
                <div class="sidebar-card">
                    <div class="section-header" style="margin-bottom: 1.25rem;">
                        <h3 class="sidebar-title">Stok Minimum</h3>
                        <a href="<?= base_url('/user/kelola_barang') ?>" class="section-link" style="font-size: 0.8125rem;">Lihat Semua</a>
                    </div>

                    <?php if (!empty($lowStockItems)): ?>
                        <div class="low-stock-table">
                            <table class="stock-table">
                                <thead>
                                    <tr>
                                        <th>BARANG</th>
                                        <th>KATEGORI</th>
                                        <th>TERSEDIA</th>
                                        <th>MIN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($lowStockItems as $item): ?>
                                        <tr>
                                            <td>
                                                <span class="item-name"><?= esc($item['nama_barang']) ?></span>
                                            </td>
                                            <td><span class="category-badge"><?= esc($item['satuan']) ?></span></td>
                                            <td><span class="stock-available"><?= esc($item['jumlah']) ?></span></td>
                                            <td><span class="stock-reorder"><?= esc($item['minimum_stok']) ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div style="text-align: center; margin-top: 1.25rem;">
                            <a href="<?= base_url('/user/kelola_barang') ?>" class="view-all-link">Lihat Semua Stok Rendah</a>
                        </div>
                    <?php else: ?>
                        <p style="text-align: center; color: #9ca3af; padding: 2rem 0;">Semua stok barang mencukupi</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Notification Bell Toggle
const notificationBell = document.getElementById('notificationBell');
const notificationDropdown = document.getElementById('notificationDropdown');

if (notificationBell && notificationDropdown) {
    notificationBell.addEventListener('click', function(e) {
        e.stopPropagation();
        notificationDropdown.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!notificationBell.contains(e.target) && !notificationDropdown.contains(e.target)) {
            notificationDropdown.classList.add('hidden');
        }
    });
}

// Real-time update function
function updateDashboard() {
    fetch('<?= base_url('user/dashboard/getData') ?>')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update statistics
                updateStatCards(data.stats);
                
                // Update activity table
                updateActivityTable(data.activities);
                
                // Update low stock items
                updateLowStockTable(data.lowStockItems);
                
                // Update notification badge
                updateNotificationBadge(data.notifCount);
            }
        })
        .catch(error => console.error('Error updating dashboard:', error));
}

function updateStatCards(stats) {
    // Update Barang Masuk
    const masukValue = document.querySelector('.stat-card:nth-child(1) .stat-value');
    if (masukValue) masukValue.textContent = formatNumber(stats.totalMasuk);
    
    // Update Barang Dipakai
    const dipakaiValue = document.querySelector('.stat-card:nth-child(2) .stat-value');
    if (dipakaiValue) dipakaiValue.textContent = formatNumber(stats.totalDipakai);
    
    // Update Total Stok
    const totalValue = document.querySelector('.stat-card:nth-child(3) .stat-value');
    if (totalValue) totalValue.textContent = formatNumber(stats.totalBarang);
    
    // Update Stok Minimum
    const minimumValue = document.querySelector('.stat-card:nth-child(4) .stat-value');
    if (minimumValue) minimumValue.textContent = stats.barangMinimum;
}

function updateActivityTable(activities) {
    const tbody = document.querySelector('.data-table tbody');
    if (!tbody) return;
    
    if (activities.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" style="text-align: center; padding: 2rem; color: #9ca3af;">
                    Belum ada aktivitas
                </td>
            </tr>
        `;
        return;
    }
    
    tbody.innerHTML = activities.map(laporan => {
        // Data dari database sudah dalam timezone Jakarta
        // Langsung parse tanpa konversi timezone
        const date = new Date(laporan.tanggal);
        
        const bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        const day = date.getDate();
        const month = bulan[date.getMonth()];
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        
        const isMasuk = laporan.jenis.toLowerCase() === 'masuk';
        const badgeClass = isMasuk ? 'activity-received' : 'activity-dispatched';
        const badgeIcon = isMasuk ? 'fa-arrow-down' : 'fa-arrow-up';
        const badgeText = isMasuk ? 'Barang Masuk' : 'Barang Dipakai';
        const detailText = isMasuk ? 'Diterima' : 'Dipakai';
        
        return `
            <tr>
                <td>${day} ${month},<br>${hours}:${minutes}</td>
                <td>
                    <span class="activity-badge ${badgeClass}">
                        <i class="fas ${badgeIcon}"></i>
                        <span>${badgeText}</span>
                    </span>
                </td>
                <td style="font-weight: 600;">${escapeHtml(laporan.nama_barang)}</td>
                <td>${detailText} ${formatNumber(laporan.jumlah)} unit</td>
                <td>${escapeHtml(laporan.nama_user || 'Unknown')}</td>
            </tr>
        `;
    }).join('');
}

function updateLowStockTable(items) {
    const tbody = document.querySelector('.stock-table tbody');
    if (!tbody) return;
    
    if (items.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" style="text-align: center; padding: 2rem; color: #9ca3af;">
                    Semua stok barang mencukupi
                </td>
            </tr>
        `;
        return;
    }
    
    tbody.innerHTML = items.map(item => `
        <tr>
            <td><span class="item-name">${escapeHtml(item.nama_barang)}</span></td>
            <td><span class="category-badge">${escapeHtml(item.satuan)}</span></td>
            <td><span class="stock-available">${item.jumlah}</span></td>
            <td><span class="stock-reorder">${item.minimum_stok}</span></td>
        </tr>
    `).join('');
}

function updateNotificationBadge(count) {
    const existingBadge = document.querySelector('.notification-badge');
    
    if (count > 0) {
        if (existingBadge) {
            existingBadge.textContent = count;
        } else {
            const bell = document.getElementById('notificationBell');
            if (bell) {
                const badge = document.createElement('span');
                badge.className = 'notification-badge';
                badge.textContent = count;
                bell.appendChild(badge);
            }
        }
    } else {
        if (existingBadge) {
            existingBadge.remove();
        }
    }
}

function formatNumber(num) {
    return new Intl.NumberFormat('id-ID').format(num);
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Update dashboard every 5 seconds
setInterval(updateDashboard, 5000);

// Initial load
document.addEventListener('DOMContentLoaded', function() {
    // First update after 2 seconds
    setTimeout(updateDashboard, 2000);
});
</script>

<?= $this->endSection(); ?>
