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

    /* Modal Positioning Fix - Prevent sidebar overlap */
    #modalEdit,
    #modalPilihJenis,
    #modalBarangLama,
    #modalTambah,
    #modalKeluar,
    #modalDetail {
        position: fixed !important;
        left: 0 !important;
        right: 0 !important;
        top: 0 !important;
        bottom: 0 !important;
        margin: 0 !important;
        z-index: 9999 !important;
    }

    .page-content {
        padding: 2rem;
    }

    .search-actions-bar {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }

    .search-form {
        display: flex;
        gap: 0.75rem;
        flex: 1;
        max-width: 600px;
    }

    .search-input-wrapper {
        position: relative;
        flex: 1;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        width: 1.25rem;
        height: 1.25rem;
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.75rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.875rem;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .search-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .btn {
        padding: 0.75rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background: #3b82f6;
        color: white;
    }

    .btn-primary:hover {
        background: #2563eb;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #d1d5db;
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

    .action-buttons {
        display: flex;
        gap: 0.75rem;
    }

    .alert-info {
        background: #fef3c7;
        border: 1px solid #fde68a;
        border-radius: 8px;
        padding: 0.875rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .alert-dot {
        width: 0.625rem;
        height: 0.625rem;
        background: #f59e0b;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .alert-text {
        font-size: 0.875rem;
        color: #92400e;
        font-weight: 500;
    }

    .content-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .content-card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .content-card-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .data-table-wrapper {
        overflow-x: auto;
    }

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

    .data-table tbody tr.low-stock {
        background: #fef3c7;
    }

    .data-table tbody tr.low-stock:hover {
        background: #fde68a;
    }

    .stock-badge {
        display: inline-block;
        padding: 0.25rem 0.625rem;
        border-radius: 4px;
        font-size: 0.6875rem;
        font-weight: 700;
        text-transform: uppercase;
        background: #fed7aa;
        color: #92400e;
        margin-left: 0.5rem;
    }

    .action-btns {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
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
    }

    .icon-btn-edit {
        background: #3b82f6;
        color: white;
    }

    .icon-btn-edit:hover {
        background: #2563eb;
    }

    .icon-btn-view {
        background: #10b981;
        color: white;
    }

    .icon-btn-view:hover {
        background: #059669;
    }

    .icon-btn-delete {
        background: #ef4444;
        color: white;
    }

    .icon-btn-delete:hover {
        background: #dc2626;
    }

    .empty-state {
        padding: 3rem;
        text-align: center;
        color: #9ca3af;
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
        margin-top: 1.5rem;
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

    @media (max-width: 1024px) {
        .page-wrapper {
            margin-left: 0;
        }

        .search-actions-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .search-form {
            max-width: none;
        }
    }
</style>

<div class="page-wrapper">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Kelola Barang</h1>
        <p class="page-subtitle">Kelola dan pantau inventori barang gudang</p>
    </div>

    <div class="page-content">
        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert-info" style="background: #fee2e2; border-color: #fecaca;">
                <div class="alert-dot" style="background: #ef4444;"></div>
                <span class="alert-text" style="color: #991b1b;"><?= session()->getFlashdata('error'); ?></span>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert-info" style="background: #d1fae5; border-color: #a7f3d0;">
                <div class="alert-dot" style="background: #10b981;"></div>
                <span class="alert-text" style="color: #065f46;"><?= session()->getFlashdata('success'); ?></span>
            </div>
        <?php endif; ?>

        <!-- Search & Actions Bar -->
        <div class="search-actions-bar">
            <form method="get" class="search-form">
                <div class="search-input-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" name="keyword" value="<?= esc(service('request')->getVar('keyword')) ?>"
                        placeholder="Cari inventori..." class="search-input" />
                </div>
                <button type="submit" class="btn btn-primary">Cari</button>
                <?php if (service('request')->getVar('keyword') || service('request')->getVar('per_page')): ?>
                    <a href="<?= current_url() ?>" class="btn btn-secondary">Reset</a>
                <?php endif; ?>
            </form>

            <div class="action-buttons">
                <button type="button" onclick="openModal('modalPilihJenis')" class="btn btn-success">
                    <i class="fas fa-arrow-down"></i>
                    Barang Masuk
                </button>
                <button type="button" onclick="openModal('modalKeluar')" class="btn btn-danger">
                    <i class="fas fa-arrow-up"></i>
                    Barang Dipakai
                </button>
            </div>
        </div>

        <!-- Table Card -->
        <div class="content-card">
            <div class="content-card-header">
                <h3 class="content-card-title">Daftar Barang</h3>
            </div>
            <div class="alert-info" style="margin: 1rem 1.5rem 0 1.5rem;">
                <div class="alert-dot"></div>
                <span class="alert-text">Menandakan stok berada pada atau di bawah minimum</span>
            </div>

            <div class="data-table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Tgl Masuk</th>
                            <th>Barcode</th>
                            <th>Min Stok</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($barangList)): ?>
                            <?php $no = 1;
                            foreach ($barangList as $barang): ?>
                                <?php $lowStock = ((int)($barang['jumlah'] ?? 0)) <= ((int)($barang['minimum_stok'] ?? 0)); ?>
                                <tr class="<?= $lowStock ? 'low-stock' : '' ?>">
                                    <td><?= $no++ ?></td>
                                    <td style="font-weight: 600;"><?= esc($barang['nama_barang']) ?></td>
                                    <td>
                                        <span style="<?= $lowStock ? 'color: #f59e0b; font-weight: 700;' : '' ?>">
                                            <?= esc($barang['jumlah']) ?>
                                        </span>
                                        <?php if ($lowStock): ?>
                                            <span class="stock-badge">Minimum</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($barang['satuan']) ?></td>
                                    <td><?= esc($barang['tanggal_masuk']) ?></td>
                                    <td style="font-family: monospace; font-size: 0.8125rem; color: #6b7280;"><?= esc($barang['barcode']) ?></td>
                                    <td><?= esc($barang['minimum_stok']) ?></td>
                                    <td>
                                        <div class="action-btns">
                                            <button type="button" onclick="openModalEdit(<?= htmlspecialchars(json_encode($barang), ENT_QUOTES, 'UTF-8') ?>)"
                                                class="icon-btn icon-btn-edit" title="Edit">
                                                <i class="fas fa-edit" style="width: 1rem; height: 1rem;"></i>
                                            </button>
                                            <button type="button" onclick="openDetailModal(<?= htmlspecialchars(json_encode($barang), ENT_QUOTES, 'UTF-8') ?>)"
                                                class="icon-btn icon-btn-view" title="Detail">
                                                <i class="fas fa-eye" style="width: 1rem; height: 1rem;"></i>
                                            </button>
                                            <form action="<?= base_url('user/hapus_barang/' . $barang['id_barang']) ?>" method="post" class="form-hapus" style="display: inline;">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="icon-btn icon-btn-delete btn-hapus" title="Hapus">
                                                    <i class="fas fa-trash" style="width: 1rem; height: 1rem;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="empty-state">
                                    Tidak ada data barang
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

<!-- Modal Pilih Jenis Barang -->
<div id="modalPilihJenis" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-8 relative">
        <button type="button" onclick="closeModal('modalPilihJenis')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        <h2 class="text-2xl font-bold mb-8 text-center">Pilih Jenis</h2>

        <div class="grid grid-cols-2 gap-6">
            <!-- Barang yang sudah ada -->
            <button type="button" onclick="closeModal('modalPilihJenis'); openModal('modalBarangLama')"
                class="flex flex-col items-center justify-center p-8 border-2 border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition group">
                <div class="w-32 h-32 mb-4 bg-gray-200 rounded-lg flex items-center justify-center group-hover:bg-green-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-400 group-hover:text-green-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-700 group-hover:text-green-600">Barang yang sudah ada</h3>
            </button>

            <!-- Barang baru -->
            <button type="button" onclick="closeModal('modalPilihJenis'); openModal('modalTambah')"
                class="flex flex-col items-center justify-center p-8 border-2 border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition group">
                <div class="w-32 h-32 mb-4 bg-gray-200 rounded-lg flex items-center justify-center group-hover:bg-blue-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-400 group-hover:text-blue-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-700 group-hover:text-blue-600">Barang baru</h3>
            </button>
        </div>

        <div class="mt-8 text-center">
            <button type="button" onclick="closeModal('modalPilihJenis')" class="px-8 py-3 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition text-base">
                Cancel
            </button>
        </div>
    </div>
</div>

<!-- Modal Barang Lama (Yang Sudah Ada) -->
<div id="modalBarangLama" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-4/5 max-w-3xl p-8 relative">
        <button type="button" onclick="closeModal('modalBarangLama')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        <h2 class="text-xl font-semibold mb-6">Tambah Stok Barang yang Sudah Ada</h2>

        <form action="<?= base_url('user/barang_masuk/save-existing') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
            <?= csrf_field() ?>

            <!-- Pilih Nama Barang -->
            <div>
                <label for="id_barang_lama" class="block text-base font-medium mb-2">Nama Barang</label>
                <select name="id_barang" id="id_barang_lama" class="w-full border border-gray-300 rounded px-4 py-3 text-base focus:outline-none focus:ring focus:ring-green-200" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach ($uniqueBarang as $barang): ?>
                        <option value="<?= $barang['id_barang'] ?>">
                            <?= esc($barang['nama_barang']) ?> (Stok Saat Ini: <?= esc($barang['jumlah']) ?> <?= esc($barang['satuan']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Jumlah Tambahan -->
            <div>
                <label for="jumlah_lama" class="block text-base font-medium mb-2">Jumlah Tambahan</label>
                <input type="number" name="jumlah" id="jumlah_lama" placeholder="Masukkan jumlah yang akan ditambahkan"
                    class="w-full border border-gray-300 rounded px-4 py-3 text-base focus:outline-none focus:ring focus:ring-green-200" min="1" required>
            </div>

            <!-- Tanggal Masuk -->
            <div>
                <label for="tanggal_masuk_lama" class="block text-base font-medium mb-2">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" id="tanggal_masuk_lama"
                    class="w-full border border-gray-300 rounded px-4 py-3 text-base focus:outline-none focus:ring focus:ring-green-200" required>
            </div>

            <!-- File inputs berdampingan -->
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-base mb-2">Surat Jalan</label>
                    <input type="file" name="surat_jalan" id="inputSuratJalan" placeholder="Surat jalan" class="w-full border rounded px-4 py-3 text-base" required>
                </div>

                <div>
                    <label class="block text-base mb-2">Gambar Barang</label>
                    <input type="file" name="gambar_barang" id="inputGambarBarang" placeholder="Gambar barang" class="w-full border rounded px-4 py-3 text-base" required>
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-3 mt-6">
                <button type="submit" style="background-color: #1565C0;" class="text-white px-6 py-3 rounded hover:opacity-90 text-base">Simpan</button>
                <button type="button" onclick="closeModal('modalBarangLama')" class="bg-gray-300 text-black px-6 py-3 rounded hover:bg-gray-400 text-base">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Tambah Barang Baru -->
<div id="modalTambah" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-6xl max-h-[90vh] overflow-y-auto relative">
        <button type="button" onclick="closeModal('modalTambah')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl z-10">&times;</button>
        
        <div class="p-8">
            <h2 class="text-2xl font-semibold mb-8">Barang Baru</h2>

            <!-- Box Pesan -->
            <div id="msgBox" class="hidden mb-6 p-4 rounded text-base"></div>

            <form id="formTambahBarang" action="<?= base_url('user/barang_masuk/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="grid grid-cols-12 gap-8">
                    <!-- Left Column - Form Fields -->
                    <div class="col-span-8">
                        <div class="grid grid-cols-2 gap-x-8 gap-y-6">
                            <!-- Row 1: Nama Barang & Jumlah -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
                                <input type="text" name="nama_barang" id="inputNamaBarang" 
                                    placeholder="Masukkan nama barang baru" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                                <input type="number" name="jumlah" id="inputJumlah" 
                                    placeholder="Masukkan jumlah barang" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            
                            <!-- Row 2: Satuan & Tanggal Masuk -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Satuan</label>
                                <input type="text" name="satuan" id="inputSatuan" 
                                    placeholder="Masukkan satuan barang" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" id="inputTanggalMasuk" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            
                            <!-- Row 3: Minimum Stok & Surat Jalan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Stok</label>
                                <input type="number" name="minimum_stok" id="inputMinimumStok" 
                                    placeholder="Minimum stok" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Surat Jalan</label>
                                <input type="file" name="surat_jalan" id="inputSuratJalan" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <!-- Row 4: Gambar Barang -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Barang</label>
                                <input type="file" name="gambar_barang" id="inputGambarBarang" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column - QR Code -->
                    <div class="col-span-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-3 text-center">Barcode (QR Code)</label>
                        <div class="h-full flex flex-col items-center justify-start bg-gray-50 border border-gray-200 rounded-lg p-6">
                            <div class="bg-white p-5 rounded-lg border border-gray-300 mb-5 shadow-sm">
                                <div id="qrcode" class="w-48 h-48 flex items-center justify-center bg-gray-100"></div>
                            </div>
                            <button type="button" onclick="generateBarcode()" 
                                class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg mb-4 text-base font-semibold hover:bg-blue-700 transition-all shadow-sm hover:shadow-md">
                                Generate Barcode
                            </button>
                            <input type="text" name="barcode" id="barcodeInput" 
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-center text-base font-mono bg-gray-100 text-gray-700" 
                                readonly required>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" 
                        class="px-10 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all font-semibold text-base shadow-sm hover:shadow-md">
                        Tambah
                    </button>
                    <button type="button" onclick="closeModal('modalTambah')" 
                        class="px-10 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all font-semibold text-base">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Barang Keluar -->
<div id="modalKeluar" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-4/5 max-w-4xl p-8 relative">
        <button type="button" onclick="closeModal('modalKeluar')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        <h2 class="text-xl font-semibold mb-6">Barang Dipakai</h2>
        <form id="formBarangKeluar" action="<?= base_url('user/barang_keluar/save') ?>" method="post" class="grid grid-cols-2 gap-8">
            <?= csrf_field() ?>
            <div>
                <label for="id_barang" class="block text-base font-medium mb-2">Pilih Barang</label>
                <select name="id_barang" id="id_barang" class="w-full border rounded px-4 py-3 text-base" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach ($uniqueBarang as $barang): ?>
                        <option value="<?= $barang['id_barang'] ?>">
                            <?= esc($barang['nama_barang']) ?> (Stok: <?= esc($barang['jumlah']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="jumlah" class="block text-base font-medium mb-2">Jumlah Dipakai</label>
                <input type="number" name="jumlah" id="jumlah" placeholder="Masukkan jumlah Dipakai" class="w-full border rounded px-4 py-3 text-base" min="1" required>
            </div>
            <div>
                <label for="tanggal" class="block text-base font-medium mb-2">Tanggal Dipakai</label>
                <input type="date" name="tanggal" id="tanggal" class="w-full border rounded px-4 py-3 text-base" required>
            </div>
            <div class="col-span-2 flex justify-end gap-3 mt-6">
                <button type="submit" style="background-color: #1565C0;" class="text-white px-6 py-3 rounded hover:opacity-90 text-base">Simpan</button>
                <button type="button" onclick="closeModal('modalKeluar')" class="bg-gray-300 text-black px-6 py-3 rounded hover:bg-gray-400 text-base">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-6xl max-h-[90vh] overflow-y-auto relative">
        <button type="button" onclick="closeModal('modalEdit')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl z-10">&times;</button>
        
        <div class="p-8">
            <h2 class="text-2xl font-semibold mb-8">Edit Barang</h2>
            
            <form id="formEditBarang" action="" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id_barang" id="editIdBarang">
                
                <div class="grid grid-cols-12 gap-8">
                    <!-- Left Column - Form Fields -->
                    <div class="col-span-8">
                        <div class="grid grid-cols-2 gap-x-8 gap-y-6">
                            <!-- Row 1: Nama Barang & Jumlah -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
                                <input type="text" name="nama_barang" id="editNamaBarang" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    placeholder="Pipa Baja" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                                <input type="number" name="jumlah" id="editJumlah" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    placeholder="75" required>
                            </div>
                            
                            <!-- Row 2: Satuan & Tanggal Masuk -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Satuan</label>
                                <input type="text" name="satuan" id="editSatuan" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    placeholder="1" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" id="editTanggalMasuk" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            
                            <!-- Row 3: Minimum Stok (Single Column) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Stok</label>
                                <input type="number" name="minimum_stok" id="editMinimumStok" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    placeholder="50" required>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column - QR Code -->
                    <div class="col-span-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-3 text-center">Barcode (QR Code)</label>
                        <div class="h-full flex flex-col items-center justify-start bg-gray-50 border border-gray-200 rounded-lg p-6">
                            <div class="bg-white p-5 rounded-lg border border-gray-300 mb-5 shadow-sm">
                                <div id="editQrcode" class="w-48 h-48 flex items-center justify-center"></div>
                            </div>
                            <input type="text" name="barcode" id="editBarcode" 
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-center text-base font-mono bg-gray-100 text-gray-700" 
                                readonly required>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                    <button type="submit" 
                        class="px-10 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all font-semibold text-base shadow-sm hover:shadow-md">
                        Update
                    </button>
                    <button type="button" onclick="closeModal('modalEdit')" 
                        class="px-10 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all font-semibold text-base">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openModalEdit(barang) {
        document.getElementById('modalEdit').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('formEditBarang').action = "<?= base_url('user/update_barang') ?>/" + barang.id_barang;
        document.getElementById('editIdBarang').value = barang.id_barang;
        document.getElementById('editNamaBarang').value = barang.nama_barang;
        document.getElementById('editJumlah').value = barang.jumlah;
        document.getElementById('editSatuan').value = barang.satuan;
        document.getElementById('editTanggalMasuk').value = barang.tanggal_masuk;
        document.getElementById('editMinimumStok').value = barang.minimum_stok;
        document.getElementById('editBarcode').value = barang.barcode;
        document.getElementById('editQrcode').innerHTML = '';
        new QRCode(document.getElementById('editQrcode'), {
            text: barang.barcode,
            width: 192,
            height: 192
        });
    }

    function generateBarcode() {
        const nama = document.getElementById('inputNamaBarang').value;
        if (!nama) {
            alert('Isi nama barang terlebih dahulu!');
            return;
        }
        const prefix = nama.substring(0, 3).toUpperCase();
        const rand = Math.floor(Math.random() * 1000000).toString().padStart(6, '0');
        const barcode = `BC${prefix}${rand}`;
        document.getElementById('barcodeInput').value = barcode;
        document.getElementById('qrcode').innerHTML = '';
        new QRCode(document.getElementById('qrcode'), {
            text: barcode,
            width: 192,
            height: 192
        });
    }

    $("#formTambahBarang").on("submit", function(e) {
        e.preventDefault();

        let nama_barang = $("#inputNamaBarang").val();
        let barcode = $("#barcodeInput").val();
        let form = $(this);
        let msgBox = $("#msgBox");

        $.post("<?= base_url('user/barang_masuk/cekBarang') ?>", {
                nama_barang,
                barcode
            },
            function(res) {
                if (res.status === "error") {
                    msgBox
                        .removeClass("hidden bg-green-100 text-green-700 border-green-400")
                        .addClass("bg-red-100 text-red-700 border border-red-400")
                        .text(res.message)
                        .show();
                } else {
                    msgBox.hide();
                    form.off("submit").submit();
                }
            }, "json"
        );
    });
</script>

<!-- Modal Detail Barang -->
<div id="modalDetail" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-5xl max-h-[90vh] overflow-y-auto p-6 relative">
        <button type="button" onclick="closeModal('modalDetail')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl z-10">&times;</button>
        <h2 class="text-xl font-semibold mb-6">Detail Barang</h2>

        <div class="grid md:grid-cols-3 grid-cols-1 gap-6">
            <!-- Gambar Barang -->
            <div class="border rounded-lg p-4 bg-gray-50">
                <h3 class="font-semibold mb-3 text-gray-700">Gambar Barang</h3>
                <div class="bg-white rounded border p-2 min-h-[240px] flex items-center justify-center">
                    <img id="detailGambarImg" src="" alt="Gambar Barang" class="w-full h-56 object-contain rounded hidden" />
                    <div id="detailGambarFallback" class="text-gray-500 text-sm text-center">Tidak ada gambar barang.</div>
                </div>
                <a id="downloadGambarLink" href="#" download class="mt-3 w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition hidden text-sm font-medium">
                    <i data-feather="download" class="w-4 h-4 mr-2"></i>
                    Download Gambar
                </a>
            </div>

            <!-- Surat Jalan -->
            <div class="border rounded-lg p-4 bg-gray-50">
                <h3 class="font-semibold mb-3 text-gray-700">Surat Jalan</h3>
                <div class="bg-white rounded border p-2 min-h-[240px] flex items-center justify-center">
                    <img id="detailSJImg" src="" alt="Surat Jalan" class="w-full h-56 object-contain rounded hidden" />
                    <iframe id="detailSJFrame" src="" class="w-full h-56 rounded hidden"></iframe>
                    <div id="detailSJFallback" class="text-gray-500 text-sm text-center">Tidak ada file surat jalan.</div>
                </div>
                <div class="mt-3 flex flex-col gap-2">
                    <a id="openSJNewTab" href="#" target="_blank" rel="noopener" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition hidden text-sm font-medium">
                        <i data-feather="external-link" class="w-4 h-4 mr-2"></i>
                        Buka di Tab Baru
                    </a>
                    <a id="downloadSJLink" href="#" download class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition hidden text-sm font-medium">
                        <i data-feather="download" class="w-4 h-4 mr-2"></i>
                        Download Surat Jalan
                    </a>
                </div>
            </div>

            <!-- Barcode / QR -->
            <div class="border rounded-lg p-4 bg-gray-50 flex flex-col">
                <h3 class="font-semibold mb-3 text-gray-700">Barcode</h3>
                <div class="flex-1 flex flex-col items-center justify-center">
                    <div class="bg-white p-4 rounded border">
                        <div id="detailQrcode" class="w-40 h-40 flex items-center justify-center"></div>
                    </div>
                    <div class="text-sm text-gray-600 mt-3 text-center">
                        <span class="font-semibold">Kode:</span><br/>
                        <span id="detailBarcodeText" class="font-mono text-gray-800"></span>
                    </div>
                    <form id="downloadBarcodeForm" action="<?= base_url('user/download_barcode/0') ?>" method="post" class="mt-4 w-full">
                        <?= csrf_field() ?>
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm font-medium">
                            <i data-feather="download" class="w-4 h-4 mr-2"></i>
                            Download Barcode
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end border-t pt-4">
            <button type="button" onclick="closeModal('modalDetail')" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium">Tutup</button>
        </div>
    </div>

</div>

<script>
    function openDetailModal(barang) {
        // Base URL for building file paths
        const base = "<?= base_url() ?>";

        // Elements
        const modalId = 'modalDetail';
        const imgBarang = document.getElementById('detailGambarImg');
        const imgBarangFallback = document.getElementById('detailGambarFallback');
        const linkDownloadGambar = document.getElementById('downloadGambarLink');

        const imgSJ = document.getElementById('detailSJImg');
        const frameSJ = document.getElementById('detailSJFrame');
        const sjFallback = document.getElementById('detailSJFallback');
        const linkDownloadSJ = document.getElementById('downloadSJLink');
        const linkOpenSJNewTab = document.getElementById('openSJNewTab');

        const qrWrap = document.getElementById('detailQrcode');
        const barcodeText = document.getElementById('detailBarcodeText');
        const formDownloadBarcode = document.getElementById('downloadBarcodeForm');

        // Build URLs from record
        const gambarUrl = barang?.gambar ? `${base}/uploads/gambar_barang/${barang.gambar}` : null;
        const sjUrl = barang?.surat_jalan ? `${base}/uploads/surat_jalan/${barang.surat_jalan}` : null;
        // Use controller endpoint for PDF preview to force inline rendering
        const sjPreviewUrl = barang?.surat_jalan ? `${base}/user/surat-jalan/preview/${barang.id_barang}` : null;

        // Setup Gambar Barang
        if (gambarUrl) {
            imgBarang.src = gambarUrl;
            imgBarang.classList.remove('hidden');
            imgBarangFallback.classList.add('hidden');
            linkDownloadGambar.href = gambarUrl;
            linkDownloadGambar.classList.remove('hidden');
        } else {
            imgBarang.src = '';
            imgBarang.classList.add('hidden');
            imgBarangFallback.classList.remove('hidden');
            linkDownloadGambar.href = '#';
            linkDownloadGambar.classList.add('hidden');
        }

        // Setup Surat Jalan: image or pdf
        if (sjUrl) {
            const isPdf = /\.pdf$/i.test(sjUrl);
            linkDownloadSJ.href = sjUrl;
            linkDownloadSJ.classList.remove('hidden');
            sjFallback.classList.add('hidden');

            if (isPdf) {
                frameSJ.src = sjPreviewUrl || sjUrl;
                frameSJ.classList.remove('hidden');
                imgSJ.src = '';
                imgSJ.classList.add('hidden');
                // Show open in new tab for PDF preview route
                linkOpenSJNewTab.href = sjPreviewUrl || sjUrl;
                linkOpenSJNewTab.classList.remove('hidden');
            } else {
                imgSJ.src = sjUrl;
                imgSJ.classList.remove('hidden');
                frameSJ.src = '';
                frameSJ.classList.add('hidden');
                linkOpenSJNewTab.href = '#';
                linkOpenSJNewTab.classList.add('hidden');
            }
        } else {
            // No file
            imgSJ.src = '';
            imgSJ.classList.add('hidden');
            frameSJ.src = '';
            frameSJ.classList.add('hidden');
            linkDownloadSJ.href = '#';
            linkDownloadSJ.classList.add('hidden');
            linkOpenSJNewTab.href = '#';
            linkOpenSJNewTab.classList.add('hidden');
            sjFallback.classList.remove('hidden');
        }

        // Setup Barcode preview and download
        barcodeText.textContent = barang?.barcode || '-';
        qrWrap.innerHTML = '';
        if (barang?.barcode) {
            new QRCode(qrWrap, {
                text: barang.barcode,
                width: 140,
                height: 140
            });
        }
        formDownloadBarcode.action = "<?= base_url('user/download_barcode') ?>/" + barang.id_barang;

        openModal(modalId);

        // Handle image errors to show fallback
        imgBarang.onerror = () => {
            imgBarang.classList.add('hidden');
            imgBarangFallback.classList.remove('hidden');
            linkDownloadGambar.classList.add('hidden');
        };
        imgSJ.onerror = () => {
            imgSJ.classList.add('hidden');
            sjFallback.classList.remove('hidden');
            linkDownloadSJ.classList.add('hidden');
        };
    }
</script>
<?= $this->endSection() ?>