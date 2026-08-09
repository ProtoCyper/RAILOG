<?= $this->extend('layout/templateSuperAdmin') ?>

<?= $this->section('content') ?>

<!-- Main Content -->
<div class="main-content">
  <!-- Header -->
  <div class="header">
    <div class="header-content">
      <div class="header-title">
        <h1>Dashboard</h1>
        <p>Selamat datang kembali, <?= esc($superAdmin['nama']) ?>! Berikut aktivitas hari ini.</p>
      </div>
      <div class="header-actions">
        <div class="user-profile">
          <div class="user-avatar">JD</div>
          <a href="<?= base_url('superadmin/pengaturan-akun') ?>" class="a-info">
            <div class="user-info">
              <h6> <?= esc($superAdmin['nama']) ?></h6>
              <p><?= esc($superAdmin['role']) ?></p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Area -->
  <div class="content-area">

    <!-- Stats Cards -->
    <div class="stats-grid">

      <!-- Total Admin Aktif -->
      <div class="stat-card">
        <div class="stat-header">
          <p class="stat-title">Total Admin</p>
          <div class="stat-icon">
            <i class="fas fa-user-shield"></i>
          </div>
        </div>
        <h2 class="stat-value"><?= esc($totalAdmin) ?></h2>
      </div>

      <!-- Barang Hampir Habis -->
      <div class="stat-card">
        <div class="stat-header">
          <p class="stat-title">Total Admin Aktif</p>
          <div class="stat-icon">
            <i class="fas fa-user-check"></i>
          </div>
        </div>
        <h2 class="stat-value"><?= esc($totalAdminAktif) ?></h2>
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

      <!-- Recent Activity -->
      <div class="content-card">
        <div class="card-header">
          <h3 class="card-title">Aktivitas Terbaru</h3>
          <a href="<?= base_url('superadmin/log-aktivitas-admin') ?>" class="card-action">View All</a>
        </div>

        <ul class="activity-list">
          <?php if (!empty($logsAdmin)): ?>
            <?php foreach ($logsAdmin as $log): ?>
              <li class="activity-item">
                <div class="activity-avatar">
                  <?= strtoupper(substr($log['nama_admin'] ?? 'NA', 0, 2)); ?>
                </div>
                <div class="activity-content">
                  <h6><?= $log['nama_admin']; ?></h6>
                  <p><?= $log['aktivitas']; ?></p>
                </div>
                <div class="activity-time"><?= $log['waktu_ago']; ?></div>
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
<?= $this->endSection() ?>