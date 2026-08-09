<?= $this->extend('layout/templateAdmin') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">

  <!-- Content Area -->
  <div class="content-area">

    <!-- Stats Cards -->
    <div class="stats-grid">

      <!-- Total Admin Aktif -->
      <div class="stat-card">
        <div class="stat-header">
          <p class="stat-title">Total Admin Aktif</p>
          <div class="stat-icon">
            <i class="fas fa-user-shield"></i>
          </div>
        </div>
        <h2 class="stat-value"><?= esc($admin ? 1 : 0) ?></h2>
      </div>

      <!-- Barang Hampir Habis -->
      <div class="stat-card">
        <div class="stat-header">
          <p class="stat-title">Barang Hampir Habis</p>
          <div class="stat-icon">
            <i class="fas fa-box-open"></i>
          </div>
        </div>
        <h2 class="stat-value"><?= esc($barangHampirHabis) ?></h2>
      </div>

      <!-- Barang di Gudang -->
      <div class="stat-card">
        <div class="stat-header">
          <p class="stat-title">Barang di Gudang</p>
          <div class="stat-icon">
            <i class="fas fa-boxes"></i>
          </div>
        </div>
        <h2 class="stat-value"><?= esc($totalBarang) ?></h2>
      </div>

      <!-- Total Staff Gudang -->
      <div class="stat-card">
        <div class="stat-header">
          <p class="stat-title">Total Staff Gudang</p>
          <div class="stat-icon">
            <i class="fas fa-user-friends"></i>
          </div>
        </div>
        <h2 class="stat-value"><?= esc($totalStaff) ?></h2>
      </div>

    </div>

    <!-- Content Grid -->
    <div class="content-grid">
      <!-- Laporan Terbaru -->
      <div class="content-card">
        <div class="card-header">
          <h3 class="card-title">Laporan Terbaru</h3>
          <a href="<?= base_url('admin/laporan-barang') ?>" class="card-action">View All</a>
        </div>
        <div class="table-container">
          <table class="modern-table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Jenis</th>
                <th>Staff</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($laporan)): ?>
                <?php foreach ($laporan as $row): ?>
                  <tr>
                    <td><?= date('d M Y H:i', strtotime($row['tanggal'])) ?></td>
                    <td><?= esc($row['nama_barang']) ?></td>
                    <td><?= esc($row['jumlah']) ?></td>
                    <td>
                      <?php if ($row['jenis'] == 'Masuk'): ?>
                        <span class="status-badge status-active">Masuk</span>
                      <?php else: ?>
                        <span class="status-badge status-inactive">Dipakai</span>
                      <?php endif; ?>
                    </td>
                    <td><?= esc($row['staff']) ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" class="text-center">Belum ada laporan</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Aktivitas Terbaru -->
      <div class="content-card">
        <div class="card-header">
          <h3 class="card-title">Aktivitas Terbaru</h3>
          <a href="<?= base_url('admin/log-aktivitas-staff') ?>" class="card-action">View All</a>
        </div>

        <ul class="activity-list">
          <?php if (!empty($logsUser)): ?>
            <?php foreach ($logsUser as $log): ?>
              <?php
              $nama = trim($log['nama_user'] ?? 'NA');
              $parts = explode(' ', $nama);

              if (count($parts) >= 2) {
                // Ambil huruf pertama dari 2 kata
                $initials = strtoupper(substr($parts[0], 0, 1) . substr($parts[1], 0, 1));
              } else {
                // Ambil 2 huruf depan
                $initials = strtoupper(substr($nama, 0, 2));
              }

              // Warna avatar konsisten berdasarkan nama
              $colors = ['#3498db', '#e67e22', '#2ecc71', '#9b59b6', '#e74c3c'];
              $color = $colors[crc32($nama) % count($colors)];
              ?>
              <li class="activity-item">
                <div class="activity-avatar" style="background: <?= $color ?>;">
                  <?= esc($initials) ?>
                </div>
                <div class="activity-content">
                  <h6><?= esc($nama) ?></h6>
                  <p><?= esc($log['aktivitas']) ?></p>
                </div>
                <div class="activity-time"><?= esc($log['waktu_ago']) ?></div>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li class="activity-item">
              <div class="activity-content">
                <p class="text-muted">Belum ada aktivitas.</p>
              </div>
            </li>
          <?php endif; ?>
        </ul>

      </div>
    </div>
  </div>
</div>

<style>
  .activity-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .activity-item {
    display: flex;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
  }

  .activity-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    color: #fff;
    font-weight: bold;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    flex-shrink: 0;
    text-transform: uppercase;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  }

  .activity-content {
    flex: 1;
  }

  .activity-content h6 {
    margin: 0;
    font-size: 14px;
    font-weight: 600;
    color: #333;
  }

  .activity-content p {
    margin: 2px 0 0;
    font-size: 13px;
    color: #555;
  }

  .activity-time {
    font-size: 12px;
    color: #888;
    margin-left: 12px;
    white-space: nowrap;
  }
</style>

<?= $this->endSection() ?>