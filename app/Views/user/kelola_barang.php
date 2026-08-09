<?= $this->extend('layout/templateUser') ?>
<?= $this->section('content') ?>

<main class="px-8 py-10 max-w-full mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Kelola Barang</h1>
    </div>

    <!-- Flash Message -->
    <?php if (session()->getFlashdata('error')): ?>
        <div id="errorAlert" class="error-message mb-6">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
        <div id="successAlert" class="success-message mb-6">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <!-- Search -->
    <div class="mb-6 flex items-center justify-between">
        <form method="get" class="flex items-center gap-3">
            <input type="text" name="keyword" value="<?= esc(service('request')->getVar('keyword')) ?>"
                placeholder="Search..."
                class="px-4 py-3 border border-gray-300 rounded w-80 focus:outline-none focus:ring focus:ring-blue-200 text-base" />
            <button type="submit" class="px-4 py-3 bg-blue-500 text-white text-base rounded hover:bg-blue-600 transition">Cari</button>
            <?php if (service('request')->getVar('keyword') || service('request')->getVar('per_page')): ?>
                <a href="<?= current_url() ?>" class="px-4 py-3 bg-gray-300 text-base rounded hover:bg-gray-400 transition">Reset</a>
            <?php endif; ?>
        </form>

        <div class="flex space-x-3">
            <!-- Barang Masuk - Buka Modal Pilihan -->
            <button type="button" onclick="openModal('modalPilihJenis')"
                class="flex items-center gap-2 bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700 text-base">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M7.5 10.5L12 15m0 0l4.5-4.5M12 15V3" />
                </svg>
                Barang Masuk
            </button>

            <!-- Barang Dipakai -->
            <button type="button" onclick="openModal('modalKeluar')"
                class="flex items-center gap-2 bg-red-600 text-white px-6 py-3 rounded hover:bg-red-700 text-base">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5V5.25A2.25 2.25 0 015.25 3h13.5A2.25 2.25 0 0121 5.25V7.5M16.5 13.5L12 9m0 0L7.5 13.5M12 9v12" />
                </svg>
                Barang Dipakai
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto mb-6">
        <div class="flex items-center gap-2 mb-2 text-sm text-gray-600">
            <span class="inline-block w-3 h-3 rounded bg-red-400"></span>
            <span>Menandakan stok berada pada atau di bawah minimum.</span>
        </div>
        <table class="min-w-full text-base bg-white rounded shadow-lg">
            <thead class="bg-gray-200 text-gray-700 font-semibold">
                <tr>
                    <th class="p-4 text-left">No</th>
                    <th class="p-4 text-left">Nama Barang</th>
                    <th class="p-4 text-left">Jumlah</th>
                    <th class="p-4 text-left">Satuan</th>
                    <th class="p-4 text-left">Tgl Masuk</th>
                    <th class="p-4 text-left">Barcode</th>
                    <th class="p-4 text-left">Min Stok</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($barangList)): ?>
                    <?php $no = 1;
                    foreach ($barangList as $barang): ?>
                        <?php $lowStock = ((int)($barang['jumlah'] ?? 0)) <= ((int)($barang['minimum_stok'] ?? 0)); ?>
                        <tr class="border-t <?= $lowStock ? 'bg-red-50' : '' ?>">
                            <td class="p-4"><?= $no++ ?></td>
                            <td class="p-4"><?= esc($barang['nama_barang']) ?></td>
                            <td class="p-4 <?= $lowStock ? 'text-red-600 font-semibold' : '' ?>">
                                <?= esc($barang['jumlah']) ?>
                                <?php if ($lowStock): ?>
                                    <span class="ml-2 inline-block align-middle px-2 py-0.5 rounded text-xs bg-red-100 text-red-700">Minimum</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-4"><?= esc($barang['satuan']) ?></td>
                            <td class="p-4"><?= esc($barang['tanggal_masuk']) ?></td>
                            <td class="p-4"><?= esc($barang['barcode']) ?></td>
                            <td class="p-4"><?= esc($barang['minimum_stok']) ?></td>
                            <td class="p-4 text-center space-x-2">
                                <button type="button" onclick="openModalEdit(<?= htmlspecialchars(json_encode($barang), ENT_QUOTES, 'UTF-8') ?>)"
                                    class="inline-flex items-center px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded transition">
                                    <i data-feather="edit" class="w-5 h-5"></i>
                                </button>
                                <button type="button" title="Detail" onclick="openDetailModal(<?= htmlspecialchars(json_encode($barang), ENT_QUOTES, 'UTF-8') ?>)"
                                    class="inline-flex items-center px-3 py-2 bg-green-500 hover:bg-green-600 text-white rounded transition">
                                    <i data-feather="eye" class="w-5 h-5"></i>
                                </button>
                                <form action="<?= base_url('user/hapus_barang/' . $barang['id_barang']) ?>" method="post" class="form-hapus inline">
                                    <?= csrf_field() ?>
                                    <button title="Hapus" type="submit"
                                        class="btn-hapus inline-flex items-center px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded transition">
                                        <i data-feather="trash" class="w-5 h-5"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center py-6">Tidak ada data barang.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer Pagination -->
    <div class="flex justify-between items-center mt-6 text-base">
        <div class="flex items-center gap-3">
            <span>Rows per page</span>
            <form method="get">
                <input type="hidden" name="keyword" value="<?= esc($keyword) ?>" />
                <select name="per_page" onchange="this.form.submit()" class="border border-gray-300 px-3 py-2 rounded">
                    <option value="5" <?= ($perPage == 5) ? 'selected' : '' ?>>5</option>
                    <option value="10" <?= ($perPage == 10) ? 'selected' : '' ?>>10</option>
                    <option value="25" <?= ($perPage == 25) ? 'selected' : '' ?>>25</option>
                </select>
            </form>
        </div>
        <div class="flex items-center justify-center gap-3 mt-6">
            <?php if ($pager): ?>
                <div class="flex items-center space-x-2">
                    <?= $pager->simpleLinks('number', 'tailwind_pagination') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

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
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700 text-base">Simpan</button>
                <button type="button" onclick="closeModal('modalBarangLama')" class="bg-gray-300 text-black px-6 py-3 rounded hover:bg-gray-400 text-base">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Tambah Barang Baru -->
<div id="modalTambah" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-4/5 max-w-6xl p-8 relative">
        <button type="button" onclick="closeModal('modalTambah')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        <h2 class="text-xl font-semibold mb-6">Barang Baru</h2>

        <!-- Box Pesan -->
        <div id="msgBox" class="hidden mb-6 p-4 rounded text-base"></div>

        <form id="formTambahBarang" action="<?= base_url('user/barang_masuk/save') ?>" method="post" enctype="multipart/form-data" class="grid grid-cols-3 gap-8">
            <?= csrf_field() ?>
            <!-- Form Kiri -->
            <div class="col-span-2 grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-base mb-2">Nama Barang</label>
                    <input type="text" name="nama_barang" id="inputNamaBarang" placeholder="Masukkan nama barang baru" class="w-full border rounded px-4 py-3 text-base" required>
                </div>
                <div>
                    <label class="block text-base mb-2">Jumlah</label>
                    <input type="number" name="jumlah" id="inputJumlah" placeholder="Masukkan jumlah barang" class="w-full border rounded px-4 py-3 text-base" required>
                </div>
                <div>
                    <label class="block text-base mb-2">Satuan</label>
                    <input type="text" name="satuan" id="inputSatuan" placeholder="Masukkan satuan barang" class="w-full border rounded px-4 py-3 text-base" required>
                </div>
                <div>
                    <label class="block text-base mb-2">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" id="inputTanggalMasuk" class="w-full border rounded px-4 py-3 text-base" required>
                </div>
                <div>
                    <label class="block text-base mb-2">Minimum Stok</label>
                    <input type="number" name="minimum_stok" id="inputMinimumStok" placeholder="Minimum stok" class="w-full border rounded px-4 py-3 text-base" required>
                </div>
                <div>
                    <label class="block text-base mb-2">Surat Jalan</label>
                    <input type="file" name="surat_jalan" id="inputSuratJalan" placeholder="Surat jalan" class="w-full border rounded px-4 py-3 text-base" required>
                </div>
                <div>
                    <label class="block text-base mb-2">Gambar Barang</label>
                    <input type="file" name="gambar_barang" id="inputGambarBarang" placeholder="Gambar barang" class="w-full border rounded px-4 py-3 text-base" required>
                </div>
            </div>
            <!-- Form Barcode -->
            <div class="col-span-1 flex flex-col items-center justify-center border rounded p-6">
                <label class="block text-base mb-3">Barcode (QR Code)</label>
                <div id="qrcode" class="w-40 h-40 flex items-center justify-center bg-gray-100 border mb-4"></div>
                <button type="button" onclick="generateBarcode()" class="bg-gray-800 text-white px-6 py-3 rounded mb-3 text-base">Generate</button>
                <input type="text" name="barcode" id="barcodeInput" class="w-full border rounded px-4 py-3 text-center text-base" readonly required>
            </div>
            <!-- Tombol -->
            <div class="col-span-3 flex justify-end gap-3 mt-6">
                <button type="submit" class="bg-gray-800 text-white px-6 py-3 rounded text-base">Tambah</button>
                <button type="button" onclick="closeModal('modalTambah')" class="bg-gray-300 text-black px-6 py-3 rounded text-base">Batal</button>
            </div>
        </form>
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
                <button type="submit" class="bg-gray-800 text-white px-6 py-3 rounded hover:bg-gray-900 text-base">Simpan</button>
                <button type="button" onclick="closeModal('modalKeluar')" class="bg-gray-300 text-black px-6 py-3 rounded hover:bg-gray-400 text-base">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-4/5 max-w-6xl p-8 relative">
        <button type="button" onclick="closeModal('modalEdit')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        <h2 class="text-xl font-semibold mb-6">Edit Barang</h2>
        <form id="formEditBarang" action="" method="post" enctype="multipart/form-data" class="grid grid-cols-3 gap-8">
            <?= csrf_field() ?>
            <input type="hidden" name="id_barang" id="editIdBarang">
            <div class="col-span-2 grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-base mb-2">Nama Barang</label>
                    <input type="text" name="nama_barang" id="editNamaBarang" class="w-full border rounded px-4 py-3 text-base" required>
                </div>
                <div>
                    <label class="block text-base mb-2">Jumlah</label>
                    <input type="number" name="jumlah" id="editJumlah" class="w-full border rounded px-4 py-3 text-base" required>
                </div>
                <div>
                    <label class="block text-base mb-2">Satuan</label>
                    <input type="text" name="satuan" id="editSatuan" class="w-full border rounded px-4 py-3 text-base" required>
                </div>
                <div>
                    <label class="block text-base mb-2">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" id="editTanggalMasuk" class="w-full border rounded px-4 py-3 text-base" required>
                </div>
                <div>
                    <label class="block text-base mb-2">Minimum Stok</label>
                    <input type="number" name="minimum_stok" id="editMinimumStok" class="w-full border rounded px-4 py-3 text-base" required>
                </div>
            </div>
            <div class="col-span-1 flex flex-col items-center justify-center border rounded p-6">
                <label class="block text-base mb-3">Barcode (QR Code)</label>
                <div id="editQrcode" class="w-40 h-40 flex items-center justify-center bg-gray-100 border mb-4"></div>
                <input type="text" name="barcode" id="editBarcode" class="w-full border rounded px-4 py-3 text-center text-base" readonly required>
            </div>
            <div class="col-span-3 flex justify-end gap-3 mt-6">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded text-base">Update</button>
                <button type="button" onclick="closeModal('modalEdit')" class="bg-gray-300 text-black px-6 py-3 rounded text-base">Batal</button>
            </div>
        </form>
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
            width: 120,
            height: 120
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
            width: 120,
            height: 120
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
<div id="modalDetail" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-6xl p-6 relative">
        <button type="button" onclick="closeModal('modalDetail')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        <h2 class="text-xl font-semibold mb-4">Detail Barang</h2>

        <div class="grid md:grid-cols-3 grid-cols-1 gap-6">
            <!-- Gambar Barang -->
            <div class="border rounded p-4">
                <h3 class="font-semibold mb-3">Gambar Barang</h3>
                <img id="detailGambarImg" src="" alt="Gambar Barang" class="w-full h-56 object-contain rounded border hidden" />
                <div id="detailGambarFallback" class="text-gray-500 text-sm">Tidak ada gambar barang.</div>
                <a id="downloadGambarLink" href="#" download class="mt-3 inline-flex items-center px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition hidden">Download Gambar</a>
            </div>

            <!-- Surat Jalan -->
            <div class="border rounded p-4">
                <h3 class="font-semibold mb-3">Surat Jalan</h3>
                <img id="detailSJImg" src="" alt="Surat Jalan" class="w-full h-56 object-contain rounded border hidden" />
                <iframe id="detailSJFrame" src="" class="w-full h-56 rounded border hidden"></iframe>
                <div id="detailSJFallback" class="text-gray-500 text-sm">Tidak ada file surat jalan.</div>
                <div class="mt-3 flex gap-2">
                    <a id="openSJNewTab" href="#" target="_blank" rel="noopener" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition hidden">Buka di Tab Baru</a>
                    <a id="downloadSJLink" href="#" download class="inline-flex items-center px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition hidden">Download Surat Jalan</a>
                </div>
            </div>

            <!-- Barcode / QR -->
            <div class="border rounded p-4 flex flex-col items-center justify-start">
                <h3 class="font-semibold mb-3 self-start">Barcode</h3>
                <div id="detailQrcode" class="w-40 h-40 flex items-center justify-center bg-gray-100 border rounded"></div>
                <div class="text-sm text-gray-600 mt-2">Kode: <span id="detailBarcodeText" class="font-mono"></span></div>
                <form id="downloadBarcodeForm" action="<?= base_url('user/download_barcode/0') ?>" method="post" class="mt-4">
                    <?= csrf_field() ?>
                    <button type="submit" class="inline-flex items-center px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Download Barcode</button>
                </form>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="button" onclick="closeModal('modalDetail')" class="px-5 py-2 bg-gray-300 rounded hover:bg-gray-400">Tutup</button>
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