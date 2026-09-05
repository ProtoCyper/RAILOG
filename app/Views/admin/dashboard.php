<?= $this->extend('layout/templateAdmin') ?>

<?= $this->section('content') ?>

<style>
  .dashboard-wrapper {
    margin-left: 280px;
    background-color: #f0f2f5;
    min-height: 100vh;
    padding: 0;
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
    border-left: 4px solid;
  }

  .stat-card:nth-child(1) {
    background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);
    border-left-color: #86efac;
  }

  .stat-card:nth-child(2) {
    background: linear-gradient(135deg, #eff6ff 0%, #ffffff 100%);
    border-left-color: #93c5fd;
  }

  .stat-card:nth-child(3) {
    background: linear-gradient(135deg, #f5f3ff 0%, #ffffff 100%);
    border-left-color: #c4b5fd;
  }

  .stat-card:nth-child(4) {
    background: linear-gradient(135deg, #fef3c7 0%, #ffffff 100%);
    border-left-color: #fbbf24;
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
    margin: 0;
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
    display: flex;
    flex-direction: column;
  }

  .activity-section {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    height: fit-content;
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
    margin: 0;
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

  .activity-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .activity-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f3f4f6;
  }

  .activity-item:last-child {
    border-bottom: none;
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
    color: #1f2937;
  }

  .activity-content p {
    margin: 2px 0 0;
    font-size: 13px;
    color: #6b7280;
  }

  .activity-time {
    font-size: 12px;
    color: #9ca3af;
    margin-left: 12px;
    white-space: nowrap;
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
  <div class="dashboard-container">
    <!-- Stats Cards -->
    <div class="stats-grid">
      <!-- Total Admin Aktif -->
      <div class="stat-card">
        <div class="stat-label">Total Admin Aktif</div>
        <div class="stat-value"><?= esc($admin ? 1 : 0) ?></div>
      </div>

      <!-- Barang Hampir Habis -->
      <div class="stat-card">
        <div class="stat-label">Barang Hampir Habis</div>
        <div class="stat-value"><?= esc($barangHampirHabis) ?></div>
      </div>

      <!-- Barang di Gudang -->
      <div class="stat-card">
        <div class="stat-label">Barang di Gudang</div>
        <div class="stat-value"><?= esc($totalBarang) ?></div>
      </div>

      <!-- Total Staff Gudang -->
      <div class="stat-card">
        <div class="stat-label">Total Staff Gudang</div>
        <div class="stat-value"><?= esc($totalStaff) ?></div>
      </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
      <!-- Laporan Terbaru -->
      <div class="content-section">
        <div class="section-header">
          <h2 class="section-title">Laporan Terbaru</h2>
          <a href="<?= base_url('admin/laporan-barang') ?>" class="section-link">Lihat Semua</a>
        </div>

        <div class="table-wrapper">
          <table class="data-table">
            <thead>
              <tr>
                <th>TANGGAL</th>
                <th>NAMA BARANG</th>
                <th>JUMLAH</th>
                <th>JENIS</th>
                <th>STAFF</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($laporan)): ?>
                <?php foreach ($laporan as $row): ?>
                  <tr>
                    <td>
                      <?php
                      $datetime = new DateTime($row['tanggal']);
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
                    <td style="font-weight: 600;"><?= esc($row['nama_barang']) ?></td>
                    <td><?= esc($row['jumlah']) ?> unit</td>
                    <td>
                      <?php if ($row['jenis'] == 'Masuk'): ?>
                        <span class="badge badge-masuk">Masuk</span>
                      <?php else: ?>
                        <span class="badge badge-dipakai">Dipakai</span>
                      <?php endif; ?>
                    </td>
                    <td><?= esc($row['staff']) ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" style="text-align: center; padding: 2rem; color: #9ca3af;">Belum ada laporan</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <div style="text-align: center; margin-top: 1.5rem;">
          <a href="<?= base_url('admin/laporan-barang') ?>" class="view-all-link">Lihat Semua Laporan</a>
        </div>
      </div>

      <!-- Aktivitas Terbaru -->
      <div class="activity-section">
        <div class="section-header">
          <h2 class="section-title">Aktivitas Terbaru</h2>
          <a href="<?= base_url('admin/log-aktivitas-staff') ?>" class="section-link">Lihat Semua</a>
        </div>

        <ul class="activity-list">
          <?php if (!empty($logsUser)): ?>
            <?php foreach ($logsUser as $log): ?>
              <?php
              $nama = trim($log['nama_user'] ?? 'NA');
              $parts = explode(' ', $nama);

              if (count($parts) >= 2) {
                $initials = strtoupper(substr($parts[0], 0, 1) . substr($parts[1], 0, 1));
              } else {
                $initials = strtoupper(substr($nama, 0, 2));
              }

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
                <p style="color: #9ca3af; text-align: center; padding: 2rem 0;">Belum ada aktivitas</p>
              </div>
            </li>
          <?php endif; ?>
        </ul>

        <div style="text-align: center; margin-top: 1.5rem;">
          <a href="<?= base_url('admin/log-aktivitas-staff') ?>" class="view-all-link">Lihat Semua Aktivitas</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>