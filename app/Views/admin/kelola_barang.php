<?= $this->extend('layout/templateAdmin') ?>
<?= $this->section('content') ?>

<style>
    /* Styling Action Buttons & Badges yang sama dengan User */
    .action-btns {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
    }

    .icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .icon-btn-edit {
        background-color: #3b82f6;
        color: white;
    }

    .icon-btn-edit:hover {
        background-color: #2563eb;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
    }

    .icon-btn-view {
        background-color: #10b981;
        color: white;
    }

    .icon-btn-view:hover {
        background-color: #059669;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);
    }

    .icon-btn-delete {
        background-color: #ef4444;
        color: white;
    }

    .icon-btn-delete:hover {
        background-color: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.3);
    }

    .stock-badge {
        display: inline-block;
        padding: 0.2rem 0.5rem;
        background-color: #fee2e2;
        color: #b91c1c;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 0.5rem;
    }

    .low-stock {
        background-color: #fff7ed;
    }
</style>

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
    <div class="mb-4 flex items-center justify-between">
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
                        <tr class="border-t <?= $lowStock ? 'low-stock' : 'hover:bg-gray-50' ?>">
                            <td class="p-3"><?= $no++ ?></td>
                            <td class="p-3 font-semibold"><?= esc($barang['nama_barang']) ?></td>
                            <td class="p-3 <?= $lowStock ? 'text-red-600 font-semibold' : '' ?>">
                                <?= esc($barang['jumlah']) ?>
                                <?php if ($lowStock): ?>
                                    <span class="stock-badge">Minimum</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3"><?= esc($barang['satuan']) ?></td>
                            <td class="p-3"><?= esc($barang['tanggal_masuk']) ?></td>
                            <td class="p-3 font-mono text-gray-600"><?= esc($barang['barcode']) ?></td>
                            <td class="p-3"><?= esc($barang['minimum_stok']) ?></td>
                            <td class="p-3 text-center">
                                <div class="action-btns">
                                    <!-- Edit -->
                                    <button type="button" onclick="openModalEdit(<?= htmlspecialchars(json_encode($barang), ENT_QUOTES, 'UTF-8') ?>)"
                                        class="icon-btn icon-btn-edit" title="Edit Barang">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <!-- Detail -->
                                    <button type="button" onclick="openDetailModal(<?= htmlspecialchars(json_encode($barang), ENT_QUOTES, 'UTF-8') ?>)"
                                        class="icon-btn icon-btn-view" title="Detail Barang">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <!-- Hapus -->
                                    <form action="<?= base_url('admin/hapus-barang/' . $barang['id_barang']) ?>" method="post" class="form-hapus inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="icon-btn icon-btn-delete btn-hapus" title="Hapus Barang">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4 text-gray-500">Tidak ada data barang.</td>
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

    <!-- Modal Edit Barang (Sama persis dengan User Kelola Barang) -->
    <div id="modalEdit" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[9999] p-4 md:pl-72">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-y-auto relative">
            <button type="button" onclick="closeModal('modalEdit')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl z-10">&times;</button>
            
            <div class="p-8">
                <h2 class="text-2xl font-semibold mb-8 text-gray-800">Edit Barang</h2>
                
                <form id="formEdit" action="" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_barang" id="editIdBarang">
                    
                    <div class="grid grid-cols-12 gap-8">
                        <!-- Left Column - Form Fields -->
                        <div class="col-span-12 md:col-span-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                                <!-- Row 1: Nama Barang & Jumlah -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
                                    <input type="text" name="nama_barang" id="editNamaBarang" 
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                        placeholder="Nama barang" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                                    <input type="number" name="jumlah" id="editJumlah" 
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                        placeholder="0" required>
                                </div>
                                
                                <!-- Row 2: Satuan & Tanggal Masuk -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Satuan</label>
                                    <input type="text" name="satuan" id="editSatuan" 
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                        placeholder="Unit/Pcs/dll" required>
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
                                        placeholder="0" required>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Column - QR Code -->
                        <div class="col-span-12 md:col-span-4">
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

    <!-- Modal Detail Barang (Sama persis dengan User Kelola Barang) -->
    <div id="modalDetail" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[9999] p-4 md:pl-72">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-y-auto p-6 relative">
            <button type="button" onclick="closeModal('modalDetail')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl z-10">&times;</button>
            <h2 class="text-xl font-semibold mb-6 text-gray-800">Detail Barang</h2>

            <div class="grid md:grid-cols-3 grid-cols-1 gap-6">
                <!-- Gambar Barang -->
                <div class="border rounded-lg p-4 bg-gray-50">
                    <h3 class="font-semibold mb-3 text-gray-700">Gambar Barang</h3>
                    <div class="bg-white rounded border p-2 min-h-[240px] flex items-center justify-center">
                        <img id="detailGambarImg" src="" alt="Gambar Barang" class="w-full h-56 object-contain rounded hidden" />
                        <div id="detailGambarFallback" class="text-gray-500 text-sm text-center">Tidak ada gambar barang.</div>
                    </div>
                    <a id="downloadGambarLink" href="#" download class="mt-3 w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition hidden text-sm font-medium">
                        <i class="fas fa-download mr-2"></i>
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
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Buka di Tab Baru
                        </a>
                        <a id="downloadSJLink" href="#" download class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition hidden text-sm font-medium">
                            <i class="fas fa-download mr-2"></i>
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
                        <form id="downloadBarcodeForm" action="<?= base_url('admin/download-barcode/0') ?>" method="post" class="mt-4 w-full">
                            <?= csrf_field() ?>
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm font-medium">
                                <i class="fas fa-download mr-2"></i>
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

</main>

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

    // Close on outside click
    window.addEventListener('click', function(e) {
        ['modalEdit', 'modalDetail'].forEach(id => {
            const modal = document.getElementById(id);
            if (modal && e.target === modal) {
                closeModal(id);
            }
        });
    });

    // Close on Escape key
    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            ['modalEdit', 'modalDetail'].forEach(id => {
                closeModal(id);
            });
        }
    });

    function openModalEdit(barang) {
        document.getElementById('modalEdit').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('formEdit').action = "<?= base_url('admin/update-barang') ?>/" + barang.id_barang;
        document.getElementById('editIdBarang').value = barang.id_barang;
        document.getElementById('editNamaBarang').value = barang.nama_barang;
        document.getElementById('editJumlah').value = barang.jumlah;
        document.getElementById('editSatuan').value = barang.satuan;
        document.getElementById('editTanggalMasuk').value = barang.tanggal_masuk;
        document.getElementById('editMinimumStok').value = barang.minimum_stok;
        document.getElementById('editBarcode').value = barang.barcode;
        
        document.getElementById('editQrcode').innerHTML = '';
        if (barang.barcode) {
            new QRCode(document.getElementById('editQrcode'), {
                text: barang.barcode,
                width: 192,
                height: 192
            });
        }
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
