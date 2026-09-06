<?= $this->extend('layout/templateUser') ?>
<?= $this->section('content') ?>

<style>
    .page-wrapper {
        margin-left: 280px;
        background-color: #f0f2f5;
        min-height: 100vh;
    }

    .page-header {
        background: white;
        padding: 1.5rem 2rem;
        border-bottom: 1px solid #e5e7eb;
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

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    /* Table Card */
    .table-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .table-card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-card-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
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

    .data-table th.text-center {
        text-align: center;
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

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        align-items: center;
    }

    .icon-btn {
        padding: 0.5rem;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
    }

    .icon-btn i {
        width: 0.875rem;
        height: 0.875rem;
        font-size: 0.875rem;
    }

    .icon-btn-edit {
        background: #3b82f6;
        color: white;
    }

    .icon-btn-edit:hover {
        background: #2563eb;
        transform: translateY(-1px);
    }

    .icon-btn-delete {
        background: #ef4444;
        color: white;
    }

    .icon-btn-delete:hover {
        background: #dc2626;
        transform: translateY(-1px);
    }

    .icon-btn-print {
        background: #10b981;
        color: white;
    }

    .icon-btn-print:hover {
        background: #059669;
        transform: translateY(-1px);
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
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Laporan Barang</h1>
        <p class="page-subtitle">Pantau dan kelola riwayat transaksi barang gudang</p>
    </div>

    <div class="page-content">
        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="flash-alert" style="background: #fee2e2; border: 1px solid #fecaca; color: #991b1b; padding: 0.875rem 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.875rem; transition: opacity 0.5s ease;">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="flash-alert" style="background: #d1fae5; border: 1px solid #a7f3d0; color: #065f46; padding: 0.875rem 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.875rem; transition: opacity 0.5s ease;">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>

        <!-- Filter Section -->
        <div class="filter-section">
            <form method="get">
                <div class="filter-row">
                    <div class="filter-group">
                        <label class="filter-label">Jenis Laporan</label>
                        <select name="type" id="filterType" class="filter-input">
                            <option value="semua" <?= (isset($type) && $type === 'semua') ? 'selected' : '' ?>>Semua</option>
                            <option value="harian" <?= (isset($type) && $type === 'harian') ? 'selected' : '' ?>>Harian</option>
                            <option value="mingguan" <?= (isset($type) && $type === 'mingguan') ? 'selected' : '' ?>>Mingguan</option>
                            <option value="bulanan" <?= (isset($type) && $type === 'bulanan') ? 'selected' : '' ?>>Bulanan</option>
                        </select>
                    </div>

                    <div id="fieldHarian" class="filter-group" style="display: none;">
                        <label class="filter-label">Pilih Tanggal</label>
                        <input type="date" name="day" value="<?= esc($day ?? '') ?>" class="filter-input" />
                    </div>

                    <div id="fieldMingguan" class="filter-group" style="display: none;">
                        <label class="filter-label">Pilih Minggu</label>
                        <input type="week" name="week" value="<?= esc($week ?? '') ?>" class="filter-input" />
                    </div>

                    <div id="fieldBulanan" class="filter-group" style="display: none;">
                        <label class="filter-label">Pilih Bulan</label>
                        <input type="month" name="month" value="<?= esc($month ?? '') ?>" class="filter-input" />
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Cari</label>
                        <input type="text" name="keyword" value="<?= esc($keyword ?? '') ?>" placeholder="Cari barang atau staff..." class="filter-input" />
                    </div>

                        <div class="filter-buttons">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                                Filter
                            </button>
                            <a href="<?= current_url() ?>" class="btn btn-secondary">
                                <i class="fas fa-redo"></i>
                                Reset
                            </a>
                            <a href="<?= base_url('user/sync-stok') ?>" class="btn" style="background:#f59e0b;color:white;" title="Sinkronkan stok barang dengan total laporan" onclick="return confirm('Sinkronkan ulang stok barang dari total laporan?')">
                                <i class="fas fa-sync"></i>
                                Sync Stok
                            </a>
                            <div class="relative" id="printDropdownWrapper">
                                <button type="button" id="openPrintAll" class="btn btn-success">
                                    <i class="fas fa-print"></i>
                                    Cetak Laporan
                                    <i class="fas fa-chevron-down" style="font-size: 0.75rem;"></i>
                                </button>
                                <div id="printDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg overflow-hidden z-50 border border-gray-200">
                                    <a href="#" id="cetakPdf" class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition">
                                        <i class="fas fa-file-pdf text-red-500"></i>
                                        Cetak PDF
                                    </a>
                                    <a href="#" id="cetakExcel" class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition">
                                        <i class="fas fa-file-excel text-green-500"></i>
                                        Cetak Excel
                                    </a>
                                </div>
                            </div>
                        </div>
                </div>
            </form>
        </div>

        <!-- Table Card -->
        <div class="table-card">
            <div class="table-card-header">
                <h3 class="table-card-title">Daftar Laporan</h3>
            </div>
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
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($riwayatData)): ?>
                            <?php $no = 1; foreach ($riwayatData as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <?php
                                        date_default_timezone_set('Asia/Jakarta');
                                        echo date('d M Y, H:i', strtotime($row['tanggal']));
                                        ?>
                                    </td>
                                    <td style="font-weight: 600;"><?= esc($row['nama_barang']) ?></td>
                                    <td><?= esc($row['jumlah']) ?></td>
                                    <td>
                                        <?php if (strtolower($row['jenis']) === 'masuk'): ?>
                                            <span class="badge badge-masuk">Masuk</span>
                                        <?php else: ?>
                                            <span class="badge badge-dipakai">Dipakai</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($row['nama']) ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button type="button" onclick="openEditModal(<?= $row['id_laporan'] ?>, <?= (int)$row['id_barang'] ?>, '<?= esc($row['nama_barang']) ?>', '<?= esc($row['tanggal']) ?>', <?= $row['jumlah'] ?>, '<?= esc($row['jenis']) ?>')"
                                                class="icon-btn icon-btn-edit" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <div class="relative" data-dropdown-wrapper>
                                                <button type="button" 
                                                    onclick="toggleRowDropdown(event, <?= $row['id_laporan'] ?>)"
                                                    class="icon-btn icon-btn-print" title="Cetak">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                                <div id="rowDropdown-<?= $row['id_laporan'] ?>" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg overflow-hidden z-50 border border-gray-200">
                                                    <a href="#" onclick="printRiwayat(event, <?= $row['id_laporan'] ?>, 'pdf')" 
                                                        class="flex items-center gap-2 px-3 py-2 text-xs text-gray-700 hover:bg-gray-100 transition">
                                                        <i class="fas fa-file-pdf text-red-500"></i>
                                                        PDF
                                                    </a>
                                                    <a href="#" onclick="printRiwayat(event, <?= $row['id_laporan'] ?>, 'excel')" 
                                                        class="flex items-center gap-2 px-3 py-2 text-xs text-gray-700 hover:bg-gray-100 transition">
                                                        <i class="fas fa-file-excel text-green-500"></i>
                                                        Excel
                                                    </a>
                                                </div>
                                            </div>
                                            <form action="<?= base_url('user/hapus-riwayat/' . $row['id_laporan']) ?>" method="post" class="form-hapus" style="display: inline;">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="icon-btn icon-btn-delete btn-hapus" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <p>Tidak ada data riwayat</p>
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
                    <input type="hidden" name="keyword" value="<?= esc($keyword ?? '') ?>" />
                    <input type="hidden" name="type" value="<?= esc($type ?? 'semua') ?>" />
                    <input type="hidden" name="day" value="<?= esc($day ?? '') ?>" />
                    <input type="hidden" name="week" value="<?= esc($week ?? '') ?>" />
                    <input type="hidden" name="month" value="<?= esc($month ?? '') ?>" />
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

<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-900">Edit Laporan</h2>
            <button type="button" onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        </div>
        <form id="editForm" method="post" class="p-6">
            <?= csrf_field() ?>
            <input type="hidden" name="id_laporan" id="editIdLaporan">
            <input type="hidden" name="id_barang" id="editIdBarang">
            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Barang</label>
                <select name="nama_barang" id="editNamaBarang" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <?php if (!empty($uniqueBarang)): ?>
                        <?php foreach ($uniqueBarang as $barang): ?>
                            <option value="<?= esc($barang['nama_barang']) ?>" data-id="<?= esc($barang['id_barang'] ?? '') ?>"><?= esc($barang['nama_barang']) ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                <input type="datetime-local" name="tanggal" id="editTanggal" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah</label>
                <input type="number" name="jumlah" id="editJumlah" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis</label>
                <select name="jenis" id="editJenis" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="Masuk">Masuk</option>
                    <option value="Dipakai">Dipakai</option>
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeEditModal()" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold text-sm">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold text-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Filter Type Handler
const filterType = document.getElementById('filterType');
const fieldHarian = document.getElementById('fieldHarian');
const fieldMingguan = document.getElementById('fieldMingguan');
const fieldBulanan = document.getElementById('fieldBulanan');

function toggleFields() {
    const type = filterType.value;
    fieldHarian.style.display = 'none';
    fieldMingguan.style.display = 'none';
    fieldBulanan.style.display = 'none';
    
    if (type === 'harian') fieldHarian.style.display = 'block';
    if (type === 'mingguan') fieldMingguan.style.display = 'block';
    if (type === 'bulanan') fieldBulanan.style.display = 'block';
}

filterType.addEventListener('change', toggleFields);
toggleFields();

// Edit Modal
function openEditModal(id, idBarang, namaBarang, tanggal, jumlah, jenis) {
    document.getElementById('editModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    document.getElementById('editIdLaporan').value = id;
    document.getElementById('editIdBarang').value = idBarang;
    document.getElementById('editForm').action = "<?= base_url('user/edit-riwayat') ?>/" + id;

    // Set value for select
    const selectBarang = document.getElementById('editNamaBarang');
    for (let i = 0; i < selectBarang.options.length; i++) {
        if (selectBarang.options[i].value === namaBarang) {
            selectBarang.selectedIndex = i;
            break;
        }
    }

    // Format tanggal untuk datetime-local input
    const formattedDate = tanggal.replace(' ', 'T').substring(0, 16);
    document.getElementById('editTanggal').value = formattedDate;
    document.getElementById('editJumlah').value = jumlah;

    const selectJenis = document.getElementById('editJenis');
    for (let i = 0; i < selectJenis.options.length; i++) {
        if (selectJenis.options[i].value.toLowerCase() === jenis.toLowerCase()) {
            selectJenis.selectedIndex = i;
            break;
        }
    }
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal on outside click
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});

// Print function for individual row
function toggleRowDropdown(event, id) {
    event.preventDefault();
    event.stopPropagation();
    
    // Close all other dropdowns first
    document.querySelectorAll('[id^="rowDropdown-"]').forEach(dd => {
        if (dd.id !== 'rowDropdown-' + id) {
            dd.classList.add('hidden');
        }
    });
    
    const dropdown = document.getElementById('rowDropdown-' + id);
    dropdown.classList.toggle('hidden');
}

function printRiwayat(event, id, format) {
    event.preventDefault();
    
    const url = "<?= base_url('user/print-riwayat') ?>/" + id;
    
    if (format === 'excel') {
        // For Excel, we need to submit form with format
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = url;
        
        const formatInput = document.createElement('input');
        formatInput.type = 'hidden';
        formatInput.name = 'format';
        formatInput.value = 'excel';
        form.appendChild(formatInput);
        
        // Add CSRF token
        const csrfName = '<?= csrf_token() ?>';
        const csrfHash = '<?= csrf_hash() ?>';
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = csrfName;
        csrfInput.value = csrfHash;
        form.appendChild(csrfInput);
        
        document.body.appendChild(form);
        form.submit();
    } else {
        // For PDF, open in new tab
        window.open(url + '?format=pdf', '_blank');
    }
    
    // Close dropdown
    document.getElementById('rowDropdown-' + id)?.classList.add('hidden');
}

// Close row dropdowns when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('[data-dropdown-wrapper]')) {
        document.querySelectorAll('[id^="rowDropdown-"]').forEach(dd => {
            dd.classList.add('hidden');
        });
    }
});

// Print All - Dropdown Handler
const printDropdownWrapper = document.getElementById('printDropdownWrapper');
const printDropdown = document.getElementById('printDropdown');
const openPrintAllBtn = document.getElementById('openPrintAll');

if (openPrintAllBtn) {
    openPrintAllBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        printDropdown.classList.toggle('hidden');
    });
}

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    if (printDropdownWrapper && !printDropdownWrapper.contains(e.target)) {
        printDropdown?.classList.add('hidden');
    }
});

// Build URL with filters
function buildPrintUrl(baseUrl) {
    const type = document.getElementById('filterType')?.value || 'semua';
    const keyword = document.querySelector('input[name="keyword"]')?.value || '';
    const day = document.querySelector('input[name="day"]')?.value || '';
    const week = document.querySelector('input[name="week"]')?.value || '';
    const month = document.querySelector('input[name="month"]')?.value || '';
    
    let url = baseUrl + "?type=" + encodeURIComponent(type) + "&keyword=" + encodeURIComponent(keyword);
    if (day) url += "&day=" + day;
    if (week) url += "&week=" + week;
    if (month) url += "&month=" + month;
    return url;
}

// Cetak PDF
document.getElementById('cetakPdf')?.addEventListener('click', function(e) {
    e.preventDefault();
    const url = buildPrintUrl("<?= base_url('user/riwayat/pdf') ?>");
    window.open(url, '_blank');
    printDropdown.classList.add('hidden');
});

// Cetak Excel
document.getElementById('cetakExcel')?.addEventListener('click', function(e) {
    e.preventDefault();
    const url = buildPrintUrl("<?= base_url('user/riwayat/excel') ?>");
    window.location.href = url;
    printDropdown.classList.add('hidden');
});

// Delete confirmation with SweetAlert2
document.querySelectorAll('.btn-hapus').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const form = this.closest('form');
        
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data laporan ini akan dihapus permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#3b82f6',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

// Auto-hide flash messages after 5 seconds
document.querySelectorAll('.flash-alert').forEach(el => {
    setTimeout(() => {
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 500);
    }, 5000);
});
</script>

<?= $this->endSection() ?>
