<?= $this->extend('layout/templateAdmin') ?>

<?= $this->section('content') ?>

<style>
    .page-wrapper {
        margin-left: 280px;
        background-color: #f0f2f5;
        min-height: 100vh;
    }

    .page-content {
        padding: 2rem;
    }

    /* Filter Section */
    .filter-section {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .filter-row {
        display: flex;
        gap: 1rem;
        align-items: end;
        flex-wrap: wrap;
    }

    .filter-group {
        flex: 1;
        min-width: 200px;
    }

    .filter-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .filter-input {
        width: 100%;
        padding: 0.625rem 0.875rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.875rem;
        transition: all 0.2s;
        background: white;
    }

    .filter-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .filter-buttons {
        display: flex;
        gap: 0.5rem;
    }

    /* Buttons */
    .btn {
        padding: 0.625rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
        text-decoration: none;
    }

    .btn-primary {
        background: #3b82f6;
        color: white;
    }

    .btn-primary:hover {
        background: #2563eb;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #6b7280;
        color: white;
    }

    .btn-secondary:hover {
        background: #4b5563;
    }

    /* Table Card */
    .table-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    /* Data Table */
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead {
        background: #f9fafb;
        border-bottom: 2px solid #e5e7eb;
    }

    .data-table th {
        padding: 1rem 1.5rem;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .data-table td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #f3f4f6;
        color: #374151;
        font-size: 0.875rem;
        vertical-align: middle;
    }

    .data-table tbody tr:hover {
        background: #f9fafb;
    }

    .data-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Badges */
    .badge {
        display: inline-block;
        padding: 0.3rem 0.85rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .badge-ip {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
        font-family: monospace;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: none;
        letter-spacing: normal;
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .pagination-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .pagination-select {
        border: 1px solid #d1d5db;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        background: white;
        font-size: 0.875rem;
        cursor: pointer;
    }

    .pagination-links {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .pagination-links a,
    .pagination-links span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 0.75rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        color: #374151;
        background: white;
        border: 1px solid #e5e7eb;
        transition: all 0.2s;
    }

    .pagination-links a:hover {
        background: #f9fafb;
        border-color: #d1d5db;
    }

    .pagination-links .active,
    .pagination-links a.active {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    /* Empty State */
    .empty-state {
        padding: 3rem;
        text-align: center;
        color: #9ca3af;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #d1d5db;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .page-wrapper {
            margin-left: 0;
        }
        .filter-row {
            flex-direction: column;
            align-items: stretch;
        }
        .filter-group {
            width: 100%;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <!-- Filter Section -->
        <div class="filter-section">
            <form method="get" id="filterForm">
                <div class="filter-row">
                    <div class="filter-group">
                        <label class="filter-label">Cari</label>
                        <input type="text" name="keyword" value="<?= esc(service('request')->getVar('keyword')) ?>"
                            placeholder="Cari nama staff, aktivitas, atau IP address..." class="filter-input" />
                    </div>

                    <?php if (service('request')->getVar('per_page')): ?>
                        <input type="hidden" name="per_page" value="<?= esc(service('request')->getVar('per_page')) ?>" />
                    <?php endif; ?>

                    <div class="filter-buttons">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                            Filter
                        </button>
                        <?php if (service('request')->getVar('keyword') || service('request')->getVar('per_page')): ?>
                            <a href="<?= current_url() ?>" class="btn btn-secondary">
                                <i class="fas fa-redo"></i>
                                Reset
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table Card -->
        <div class="table-card">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Staff</th>
                            <th>Aktivitas</th>
                            <th>IP Address</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($logsStaff)): ?>
                            <?php
                            $page = (int) (service('request')->getVar('page_number') ?? 1);
                            $page = ($page > 0) ? $page : 1;
                            $no = ($page - 1) * $perPage + 1;
                            foreach ($logsStaff as $log):
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td style="font-weight: 600;"><?= esc($log['nama_user'] ?? '-') ?></td>
                                    <td><?= esc($log['aktivitas']) ?></td>
                                    <td>
                                        <span class="badge badge-ip"><?= esc($log['ip_address']) ?></span>
                                    </td>
                                    <td>
                                        <?= formatTanggalIndo($log['created_at']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="fas fa-clipboard-list"></i>
                                        <p>Belum ada log aktivitas.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            <div class="pagination-info">
                <span>Baris per halaman</span>
                <form method="get">
                    <?php if (!empty($keyword)): ?>
                        <input type="hidden" name="keyword" value="<?= esc($keyword) ?>" />
                    <?php endif; ?>
                    <select name="per_page" onchange="this.form.submit()" class="pagination-select">
                        <option value="5" <?= ($perPage == 5) ? 'selected' : '' ?>>5</option>
                        <option value="10" <?= ($perPage == 10) ? 'selected' : '' ?>>10</option>
                        <option value="25" <?= ($perPage == 25) ? 'selected' : '' ?>>25</option>
                    </select>
                </form>
            </div>
            <div class="pagination-links">
                <?php if ($pager): ?>
                    <?= $pager->simpleLinks('number', 'tailwind_pagination') ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>