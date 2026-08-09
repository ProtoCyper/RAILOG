<?= $this->extend('layout/templateUser'); ?>
<?= $this->section('content'); ?>

<!-- Main -->
<main class="py-8">
    <!-- Card statistik -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 flex items-center gap-5">
            <i data-feather="package" class="w-8 h-8 text-gray-600"></i>
            <div>
                <div class="text-base text-gray-500">Barang Masuk</div>
                <div class="text-2xl font-bold text-gray-800"><?= esc($totalMasuk) ?></div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 flex items-center gap-5">
            <i data-feather="arrow-down" class="w-8 h-8 text-gray-600"></i>
            <div>
                <div class="text-base text-gray-500">Barang Dipakai</div>
                <div class="text-2xl font-bold text-gray-800"><?= esc($totalDipakai) ?></div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 flex items-center gap-5">
            <i data-feather="box" class="w-8 h-8 text-gray-600"></i>
            <div>
                <div class="text-base text-gray-500">Total Stok</div>
                <div class="text-2xl font-bold text-gray-800"><?= esc($totalBarang) ?></div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 flex items-center gap-5">
            <i data-feather="alert-triangle" class="w-8 h-8 text-gray-600"></i>
            <div>
                <div class="text-base text-gray-500">Stok Minimum</div>
                <div class="text-2xl font-bold text-gray-800"><?= esc($barangMinimum) ?></div>
            </div>
        </div>
    </div>

    <!-- Riwayat table -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-xl font-semibold mb-6">Riwayat Terakhir</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-base text-left">
                <thead>
                    <tr class="border-b text-gray-700 font-semibold">
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Waktu</th>
                        <th class="px-6 py-3">Nama Barang</th>
                        <th class="px-6 py-3">Jenis</th>
                        <th class="px-6 py-3">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($laporanData as $index => $laporan): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-3"><?= $index + 1 ?></td>
                            <td class="px-6 py-3"><?= date('d-m-Y H:i:s', strtotime($laporan['tanggal'])) ?></td>
                            <td class="px-6 py-3"><?= esc($laporan['nama_barang']) ?></td>
                            <td class="px-6 py-3"><?= esc($laporan['jenis']) ?></td>
                            <td class="px-6 py-3"><?= esc($laporan['jumlah']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>
