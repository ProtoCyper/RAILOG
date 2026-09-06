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

    .btn-success {
        background: #10b981;
        color: white;
    }

    .btn-success:hover {
        background: #059669;
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

    .badge-masuk {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-dipakai {
        background: #fee2e2;
        color: #991b1b;
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

    /* Modal */
    #printModal {
        z-index: 9999;
    }

    .format-card input:checked+img,
    .format-card input:checked+img+span {
        opacity: 1;
    }

    .format-card input:checked+img {
        filter: drop-shadow(0 0 5px #22c55e);
    }

    .format-card:has(input:checked) {
        border-color: #22c55e;
        background-color: #f0fdf4;
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
                        <label class="filter-label">Mode Filter</label>
                        <select name="filter_mode" id="filter_mode" class="filter-input">
                            <?php $fm = service('request')->getVar('filter_mode'); ?>
                            <option value="" <?= $fm == '' ? 'selected' : ''; ?>>Semua</option>
                            <option value="harian" <?= $fm == 'harian' ? 'selected' : ''; ?>>Harian</option>
                            <option value="mingguan" <?= $fm == 'mingguan' ? 'selected' : ''; ?>>Mingguan</option>
                            <option value="bulanan" <?= $fm == 'bulanan' ? 'selected' : ''; ?>>Bulanan</option>
                            <option value="range" <?= $fm == 'range' ? 'selected' : ''; ?>>Rentang</option>
                        </select>
                    </div>

                    <div id="wrap_harian" class="filter-group" style="display: none;">
                        <label class="filter-label">Tanggal</label>
                        <input type="date" name="date" value="<?= esc(service('request')->getVar('date')) ?>" class="filter-input" />
                    </div>

                    <div id="wrap_mingguan" class="filter-group" style="display: none;">
                        <label class="filter-label">Mulai Minggu</label>
                        <input type="date" name="week_start" value="<?= esc(service('request')->getVar('week_start')) ?>" class="filter-input" />
                    </div>

                    <div id="wrap_bulanan" class="filter-group" style="display: none;">
                        <label class="filter-label">Bulan</label>
                        <input type="month" name="month" value="<?= esc(service('request')->getVar('month')) ?>" class="filter-input" />
                    </div>

                    <div id="wrap_range" class="filter-group" style="display: none;">
                        <label class="filter-label">Rentang Tanggal</label>
                        <div style="display: flex; gap: 0.5rem;">
                            <input type="date" name="start_date" value="<?= esc(service('request')->getVar('start_date')) ?>" class="filter-input" placeholder="Dari" />
                            <input type="date" name="end_date" value="<?= esc(service('request')->getVar('end_date')) ?>" class="filter-input" placeholder="Sampai" />
                        </div>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Cari</label>
                        <input type="text" name="keyword" value="<?= esc(service('request')->getVar('keyword')) ?>" placeholder="Cari barang atau staff..." class="filter-input" />
                    </div>

                    <div class="filter-buttons">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                            Filter
                        </button>
                        <?php if (service('request')->getVar('keyword') || service('request')->getVar('filter_mode')): ?>
                            <a href="<?= current_url() ?>" class="btn btn-secondary">
                                <i class="fas fa-redo"></i>
                                Reset
                            </a>
                        <?php endif; ?>
                        <button type="button" onclick="openPrintModal()" class="btn btn-success">
                            <i class="fas fa-print"></i>
                            Cetak Laporan
                        </button>
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
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Jenis</th>
                            <th>Staff</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($riwayatData)): ?>
                            <?php foreach ($riwayatData as $index => $riwayat): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td>
                                        <?php
                                        date_default_timezone_set('Asia/Jakarta');
                                        echo date('d M Y, H:i', strtotime($riwayat['tanggal']));
                                        ?>
                                    </td>
                                    <td style="font-weight: 600;"><?= esc($riwayat['nama_barang']) ?></td>
                                    <td><?= esc($riwayat['jumlah']) ?></td>
                                    <td>
                                        <?php if (strtolower($riwayat['jenis']) === 'masuk'): ?>
                                            <span class="badge badge-masuk">Masuk</span>
                                        <?php else: ?>
                                            <span class="badge badge-dipakai">Dipakai</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($riwayat['nama']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <p>Tidak ada data laporan</p>
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
                    <input type="hidden" name="keyword" value="<?= esc($keyword) ?>" />
                    <input type="hidden" name="filter_mode" value="<?= esc(service('request')->getVar('filter_mode')) ?>" />
                    <input type="hidden" name="date" value="<?= esc(service('request')->getVar('date')) ?>" />
                    <input type="hidden" name="week_start" value="<?= esc(service('request')->getVar('week_start')) ?>" />
                    <input type="hidden" name="month" value="<?= esc(service('request')->getVar('month')) ?>" />
                    <input type="hidden" name="start_date" value="<?= esc(service('request')->getVar('start_date')) ?>" />
                    <input type="hidden" name="end_date" value="<?= esc(service('request')->getVar('end_date')) ?>" />
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

<!-- Modal Memilih Format Cetak -->
<div id="printModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[9999] p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Pilih Format Cetak</h2>
        </div>
        <form id="printForm" method="get" action="" class="p-6">
            <?= csrf_field() ?>
            <input type="hidden" name="keyword" value="<?= esc($keyword) ?>">
            <input type="hidden" name="per_page" value="<?= esc($perPage) ?>">
            <input type="hidden" name="filter_mode" id="h_filter_mode" value="<?= esc(service('request')->getVar('filter_mode')) ?>">
            <input type="hidden" name="date" id="h_date" value="<?= esc(service('request')->getVar('date')) ?>">
            <input type="hidden" name="week_start" id="h_week_start" value="<?= esc(service('request')->getVar('week_start')) ?>">
            <input type="hidden" name="month" id="h_month" value="<?= esc(service('request')->getVar('month')) ?>">
            <input type="hidden" name="start_date" id="h_start_date" value="<?= esc(service('request')->getVar('start_date')) ?>">
            <input type="hidden" name="end_date" id="h_end_date" value="<?= esc(service('request')->getVar('end_date')) ?>">

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih format</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="format-card cursor-pointer border-2 rounded-lg p-6 flex flex-col items-center justify-center transition hover:border-green-500">
                        <input type="radio" name="format" value="excel" class="hidden formatOption">
                        <img src="<?= base_url('assets/img/excel.png') ?>" alt="Excel" class="w-16 h-16 mb-3 opacity-70">
                        <span class="text-sm font-semibold">Excel</span>
                    </label>
                    <label class="format-card cursor-pointer border-2 rounded-lg p-6 flex flex-col items-center justify-center transition hover:border-green-500">
                        <input type="radio" name="format" value="pdf" class="hidden formatOption">
                        <img src="<?= base_url('assets/img/pdf.png') ?>" alt="PDF" class="w-16 h-16 mb-3 opacity-70">
                        <span class="text-sm font-semibold">PDF</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" id="closePrintModal" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold text-sm">
                    Batal
                </button>
                <button type="submit" id="btnPrint" disabled class="px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                    Cetak
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openPrintModal() {
    // Copy filter values to hidden inputs
    document.getElementById('h_filter_mode').value = document.getElementById('filter_mode').value;
    const dateInp = document.querySelector('input[name="date"]');
    const weekInp = document.querySelector('input[name="week_start"]');
    const monthInp = document.querySelector('input[name="month"]');
    const startInp = document.querySelector('input[name="start_date"]');
    const endInp = document.querySelector('input[name="end_date"]');
    if (dateInp) document.getElementById('h_date').value = dateInp.value;
    if (weekInp) document.getElementById('h_week_start').value = weekInp.value;
    if (monthInp) document.getElementById('h_month').value = monthInp.value;
    if (startInp) document.getElementById('h_start_date').value = startInp.value;
    if (endInp) document.getElementById('h_end_date').value = endInp.value;
    document.getElementById("printModal").classList.remove("hidden");
    document.body.style.overflow = 'hidden';
}

document.addEventListener("DOMContentLoaded", function() {
    const printModal = document.getElementById("printModal");
    const closePrintModal = document.getElementById("closePrintModal");
    const formatOptions = document.querySelectorAll(".formatOption");
    const btnPrint = document.getElementById("btnPrint");
    const printForm = document.getElementById("printForm");

    // Close modal
    closePrintModal.addEventListener("click", () => {
        printModal.classList.add("hidden");
        document.body.style.overflow = 'auto';
        formatOptions.forEach(opt => opt.checked = false);
        btnPrint.disabled = true;
    });

    // Change action based on format selection
    formatOptions.forEach(option => {
        option.addEventListener("change", () => {
            if (option.value === "excel") {
                printForm.action = "<?= base_url('admin/laporan/excel') ?>";
            } else if (option.value === "pdf") {
                printForm.action = "<?= base_url('admin/laporan/pdf') ?>";
            }
            btnPrint.disabled = false;
        });
    });

    // Show fields based on filter_mode
    function toggleFilterFields() {
        const mode = document.getElementById('filter_mode').value;
        document.getElementById('wrap_harian').style.display = 'none';
        document.getElementById('wrap_mingguan').style.display = 'none';
        document.getElementById('wrap_bulanan').style.display = 'none';
        document.getElementById('wrap_range').style.display = 'none';
        if (mode === 'harian') document.getElementById('wrap_harian').style.display = 'block';
        if (mode === 'mingguan') document.getElementById('wrap_mingguan').style.display = 'block';
        if (mode === 'bulanan') document.getElementById('wrap_bulanan').style.display = 'block';
        if (mode === 'range') document.getElementById('wrap_range').style.display = 'block';
    }
    document.getElementById('filter_mode').addEventListener('change', toggleFilterFields);
    toggleFilterFields();

    // Close modal on outside click
    printModal.addEventListener('click', function(e) {
        if (e.target === this) {
            closePrintModal.click();
        }
    });
});
</script>

<?= $this->endSection() ?>