<?= $this->extend('layout/templateAdmin') ?>
<?= $this->section('content') ?>


<!-- Main Content -->
<main class="main-content p-6 md:p-8 lg:p-10">
    <!-- Flash Message -->
    <?php if (session()->getFlashdata('error')): ?>
        <div id="errorAlert" class="error-message">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
        <div id="successAlert" class="success-message">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <!-- Search -->
    <div class="mb-4 flex items-center gap-2">
        <form method="get" class="flex items-center gap-2">
            <input type="text" name="keyword" value="<?= esc(service('request')->getVar('keyword')) ?>" placeholder="Search..."
                class="px-3 py-2 border border-gray-300 rounded w-64 focus:outline-none focus:ring focus:ring-blue-200 text-sm" />
            <button type="submit" class="px-3 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">Cari</button>
            <?php if (service('request')->getVar('keyword') || service('request')->getVar('per_page')): ?>
                <a href="<?= current_url() ?>" class="px-3 py-2 bg-gray-300 text-sm rounded hover:bg-gray-400 transition">Reset</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Table -->
    <div class="table">
        <div class="flex items-center gap-2 mb-2 text-sm text-gray-600">
            <span class="inline-block w-3 h-3 rounded bg-red-400"></span>
            <span>Menandakan stok berada pada atau di bawah minimum.</span>
        </div>
        <table class="min-w-full text-sm bg-white rounded shadow">
            <thead class="bg-gray-200 text-gray-700 font-semibold">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Nama Barang</th>
                    <th class="p-3 text-left">Jumlah</th>
                    <th class="p-3 text-left">Satuan</th>
                    <th class="p-3 text-left">Tgl Masuk</th>
                    <th class="p-3 text-left">Barcode</th>
                    <th class="p-3 text-left">Min Stok</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($barangList)): ?>
                    <?php $no = 1;
                    foreach ($barangList as $barang): ?>
                        <?php $lowStock = ((int)($barang['jumlah'] ?? 0)) <= ((int)($barang['minimum_stok'] ?? 0)); ?>
                        <tr class="border-t <?= $lowStock ? 'bg-red-50' : 'hover:bg-gray-50' ?>">
                            <td class="p-3"><?= $no++ ?></td>
                            <td class="p-3"><?= esc($barang['nama_barang']) ?></td>
                            <td class="p-3 <?= $lowStock ? 'text-red-600 font-semibold' : '' ?>">
                                <?= esc($barang['jumlah']) ?>
                                <?php if ($lowStock): ?>
                                    <span class="ml-2 inline-block align-middle px-2 py-0.5 rounded text-xs bg-red-100 text-red-700">Minimum</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3"><?= esc($barang['satuan']) ?></td>
                            <td class="p-3"><?= esc($barang['tanggal_masuk']) ?></td>
                            <td class="p-3"><?= esc($barang['barcode']) ?></td>
                            <td class="p-3"><?= esc($barang['minimum_stok']) ?></td>
                            <td class="p-3 text-center space-x-2">
                                <!-- Edit -->
                                <button type="button" onclick="openModalEdit(<?= htmlspecialchars(json_encode($barang), ENT_QUOTES, 'UTF-8') ?>)"
                                    class="inline-flex items-center px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded transition">
                                    <i data-feather="edit" class="w-4 h-4"></i>
                                </button>
                                <!-- Detail -->
                                <button type="button" title="Detail" onclick="openDetailModal(<?= htmlspecialchars(json_encode($barang), ENT_QUOTES, 'UTF-8') ?>)"
                                    class="inline-flex items-center px-2 py-1 bg-green-600 hover:bg-green-700 text-white rounded transition">
                                    <i data-feather="eye" class="w-4 h-4"></i>
                                </button>
                                <!-- Hapus -->
                                <form action="<?= base_url('admin/hapus-barang/' . $barang['id_barang']) ?>" method="post" class="form-hapus inline">
                                    <?= csrf_field() ?>
                                    <button title="Hapus" type="submit"
                                        class="btn-hapus inline-flex items-center px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded transition">
                                        <i data-feather="trash" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center py-4">Tidak ada data barang.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="flex justify-between items-center mt-4 text-sm">
            <div class="flex items-center gap-2">
                <span>Rows per page</span>
                <form method="get">
                    <input type="hidden" name="keyword" value="<?= esc($keyword) ?>" />
                    <select name="per_page" onchange="this.form.submit()" class="border border-gray-300 px-2 py-1 rounded">
                        <option value="5" <?= ($perPage == 5) ? 'selected' : '' ?>>5</option>
                        <option value="10" <?= ($perPage == 10) ? 'selected' : '' ?>>10</option>
                        <option value="25" <?= ($perPage == 25) ? 'selected' : '' ?>>25</option>
                    </select>
                </form>
            </div>
            <div class="flex items-center justify-center gap-2 mt-4">
                <?php if ($pager): ?>
                    <div class="flex items-center space-x-1">
                        <?= $pager->simpleLinks('number', 'tailwind_pagination') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Barang -->
    <!-- Modal Tambah Barang -->
    <div id="modalTambah"
        class="hidden fixed inset-0 bg-gray-600 bg-opacity-30 z-[9999] flex items-center justify-center">

        <!-- Konten Modal -->
        <div class="bg-white rounded-lg shadow-lg p-6 relative w-full max-w-5xl">

            <!-- Tombol Close -->
            <button type="button" onclick="closeModal('modalTambah')"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>

            <!-- Header -->
            <h2 class="text-lg font-bold mb-6">Barang Masuk</h2>

            <!-- Form -->
            <form action="<?= base_url('admin/tambah-barang') ?>" method="post">
                <?= csrf_field() ?>

                <div class="grid grid-cols-3 gap-6">
                    <!-- Kolom kiri (form input) -->
                    <div class="col-span-2 grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Nama Barang</label>
                            <input type="text" name="nama_barang" placeholder="Masukkan nama barang baru"
                                class="w-full border rounded px-3 py-2 focus:ring focus:ring-gray-200" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Jumlah</label>
                            <input type="number" name="jumlah" placeholder="Masukkan jumlah barang"
                                class="w-full border rounded px-3 py-2 focus:ring focus:ring-gray-200" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Satuan</label>
                            <input type="text" name="satuan" placeholder="Masukkan satuan barang"
                                class="w-full border rounded px-3 py-2 focus:ring focus:ring-gray-200" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk"
                                class="w-full border rounded px-3 py-2 focus:ring focus:ring-gray-200" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Minimum Stok</label>
                            <input type="number" name="minimum_stok" placeholder="Minimum stok"
                                class="w-full border rounded px-3 py-2 focus:ring focus:ring-gray-200" required>
                        </div>
                    </div>

                    <!-- Kolom kanan (barcode) -->
                    <div class="border rounded p-4 flex flex-col items-center justify-center">
                        <label class="block text-sm font-medium mb-3">Barcode (QR Code)</label>
                        <div id="qrcode" class="w-32 h-32 flex items-center justify-center bg-gray-100 border mb-3"></div>
                        <button type="button" onclick="generateBarcode()"
                            class="bg-gray-800 text-white px-4 py-2 rounded mb-2">Generate</button>
                        <input type="text" name="barcode" id="barcodeInput"
                            class="w-full border rounded px-3 py-2 text-center" readonly required>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="submit"
                        class="px-5 py-2 bg-gray-800 text-white rounded hover:bg-gray-900">Tambah</button>
                    <button type="button" onclick="closeModal('modalTambah')"
                        class="px-5 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Batal</button>
                </div>
            </form>
        </div>
    </div>






    <!-- Modal Barang Keluar -->
    <div id="modalKeluar" class="hidden fixed inset-0 bg-gray-600 bg-opacity-30 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-3/4 p-8 relative">
            <button type="button" onclick="closeModal('modalKeluar')" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">&times;</button>
            <h2 class="text-lg font-semibold mb-4">Barang Dipakai</h2>
            <form action="<?= base_url('admin/barang_keluar') ?>" method="post">
                <?= csrf_field() ?>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label>Pilih Barang</label>
                        <select name="id_barang" class="w-full border rounded px-3 py-2" required>
                            <option value="">-- Pilih --</option>
                            <?php foreach ($barangList as $barang): ?>
                                <option value="<?= $barang['id_barang'] ?>"><?= esc($barang['nama_barang']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" class="w-full border rounded px-3 py-2" required>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modalEdit" class="hidden fixed inset-0 bg-gray-600 bg-opacity-30 z-50 flex items-start justify-center">
        <div class="bg-white rounded-lg shadow-lg p-8 relative mt-24
                    w-[calc(100%-250px)] ml-[250px] max-w-5xl">

            <!-- Tombol Close -->
            <button type="button" onclick="closeModal('modalEdit')"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>

            <!-- Header -->
            <h2 class="text-xl font-semibold mb-4">Edit Barang</h2>

            <!-- Form -->
            <form id="formEdit" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id_barang" id="edit_id_barang">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" id="edit_nama_barang"
                            class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" id="edit_jumlah"
                            class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label>Satuan</label>
                        <input type="text" name="satuan" id="edit_satuan"
                            class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label>Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" id="edit_tanggal_masuk"
                            class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label>Minimum Stok</label>
                        <input type="number" name="minimum_stok" id="edit_minimum_stok"
                            class="w-full border rounded px-3 py-2" required>
                    </div>

                </div>

                <!-- Tombol -->
                <div class="mt-4 flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail Barang -->
    <div id="modalDetail" class="hidden fixed inset-0 bg-gray-600 bg-opacity-30 z-50 flex items-start justify-center">
        <div class="bg-white rounded-lg shadow-lg p-8 relative mt-24 w-[calc(100%-250px)] ml-[250px] max-w-5xl">
            <button type="button" onclick="closeModal('modalDetail')" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            <h2 class="text-lg font-semibold mb-4">Detail Barang</h2>

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
                    <form id="downloadBarcodeForm" action="<?= base_url('admin/download-barcode/0') ?>" method="post" class="mt-4">
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

</main>

<!-- Feather Icons -->
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
    feather.replace();
</script>

<!-- Script Modal & Alert -->
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function openModalEdit(data) {
        document.getElementById('modalEdit').classList.remove('hidden');
        document.getElementById('formEdit').action = "<?= base_url('admin/update-barang/') ?>" + data.id_barang;
        document.getElementById('edit_id_barang').value = data.id_barang;
        document.getElementById('edit_nama_barang').value = data.nama_barang;
        document.getElementById('edit_jumlah').value = data.jumlah;
        document.getElementById('edit_satuan').value = data.satuan;
        document.getElementById('edit_tanggal_masuk').value = data.tanggal_masuk;
        document.getElementById('edit_minimum_stok').value = data.minimum_stok;

    }

    function openDetailModal(barang) {
        const base = "<?= base_url() ?>";

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

        const gambarUrl = barang?.gambar ? `${base}/uploads/gambar_barang/${barang.gambar}` : null;
        const sjUrl = barang?.surat_jalan ? `${base}/uploads/surat_jalan/${barang.surat_jalan}` : null;

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
                frameSJ.src = sjUrl;
                frameSJ.classList.remove('hidden');
                imgSJ.src = '';
                imgSJ.classList.add('hidden');
                linkOpenSJNewTab.href = sjUrl;
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
        formDownloadBarcode.action = "<?= base_url('admin/download-barcode') ?>/" + barang.id_barang;

        openModal('modalDetail');

        // Fallback handlers
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


    // Auto hide alert
    setTimeout(() => {
        let errorAlert = document.getElementById('errorAlert');
        let successAlert = document.getElementById('successAlert');
        if (errorAlert) errorAlert.style.display = 'none';
        if (successAlert) successAlert.style.display = 'none';
    }, 3000);
</script>

<?= $this->endSection() ?>