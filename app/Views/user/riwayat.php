<?= $this->extend('layout/templateUser') ?>
<?= $this->section('content') ?>

<main class="px-8 py-10 max-w-full mx-auto">
  <h1 class="text-2xl font-bold mb-6">Laporan Barang</h1>
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

  <!-- Filter & Search -->
  <div class="mb-6">
    <form method="get" class="flex flex-wrap items-end gap-3">
      <div>
        <label class="block text-sm text-gray-600 mb-1">Jenis Laporan</label>
        <select name="type" id="filterType" class="px-3 py-2 border border-gray-300 rounded text-base">
          <option value="semua" <?= (isset($type) && $type === 'semua') ? 'selected' : '' ?>>Semua</option>
          <option value="harian" <?= (isset($type) && $type === 'harian') ? 'selected' : '' ?>>Harian</option>
          <option value="mingguan" <?= (isset($type) && $type === 'mingguan') ? 'selected' : '' ?>>Mingguan</option>
          <option value="bulanan" <?= (isset($type) && $type === 'bulanan') ? 'selected' : '' ?>>Bulanan</option>
        </select>
      </div>

      <div id="fieldHarian" class="hidden">
        <label class="block text-sm text-gray-600 mb-1">Pilih Tanggal</label>
        <input type="date" name="day" value="<?= esc($day ?? '') ?>" class="px-3 py-2 border border-gray-300 rounded text-base" />
      </div>

      <div id="fieldMingguan" class="hidden">
        <label class="block text-sm text-gray-600 mb-1">Pilih Minggu</label>
        <input type="week" name="week" value="<?= esc($week ?? '') ?>" class="px-3 py-2 border border-gray-300 rounded text-base" />
      </div>

      <div id="fieldBulanan" class="hidden">
        <label class="block text-sm text-gray-600 mb-1">Pilih Bulan</label>
        <input type="month" name="month" value="<?= esc($month ?? '') ?>" class="px-3 py-2 border border-gray-300 rounded text-base" />
      </div>

      <div class="ml-auto flex items-end gap-3">
        <div>
          <label class="block text-sm text-gray-600 mb-1">Pencarian</label>
          <input type="text" name="keyword" value="<?= esc($keyword ?? service('request')->getVar('keyword')) ?>" placeholder="Search..." class="px-4 py-2.5 border border-gray-300 rounded w-64 focus:outline-none focus:ring focus:ring-blue-200 text-base" />
        </div>
        <button type="submit" class="px-4 py-3 bg-blue-500 text-white text-base rounded hover:bg-blue-600 transition">Filter</button>
        <a href="<?= base_url('/user/riwayat') ?>" class="px-4 py-3 bg-gray-300 text-base rounded hover:bg-gray-400 transition">Reset</a>
        <button type="button" id="openPrintAll" class="px-4 py-3 bg-green-600 text-white text-base rounded hover:bg-green-700 transition">Cetak Laporan</button>
      </div>

      <?php if (!empty($perPage)): ?>
        <input type="hidden" name="per_page" value="<?= esc($perPage) ?>" />
      <?php endif; ?>
    </form>
  </div>

  <!-- Table -->
  <div class="overflow-x-auto mb-6">
    <table class="min-w-full text-base bg-white rounded shadow-lg">
      <thead class="bg-gray-200 text-gray-700 font-semibold">
        <tr>
          <th class="p-4 text-left">No</th>
          <th class="p-4 text-left">Waktu</th>
          <th class="p-4 text-left">Nama Barang</th>
          <th class="p-4 text-left">Jumlah</th>
          <th class="p-4 text-left">Jenis</th>
          <th class="p-4 text-left">Staff</th>
          <th class="p-4 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($riwayatData)): ?>
          <?php foreach ($riwayatData as $index => $riwayat): ?>
            <tr class="border-t hover:bg-gray-50">
              <td class="p-4"><?= $index + 1 ?></td>
              <td class="p-4"><?= date('d-m-Y H:i:s', strtotime($riwayat['tanggal'])) ?></td>
              <td class="p-4"><?= $riwayat['nama_barang'] ?></td>
              <td class="p-4"><?= $riwayat['jumlah'] ?></td>
              <td class="p-4"><?= $riwayat['jenis'] ?></td>
              <td class="p-4"><?= $riwayat['nama'] ?></td>
              <td class="p-4 text-center space-x-2">
                <form action="<?= base_url('user/edit-laporan/' . $riwayat['id_laporan']) ?>" method="post" class="inline">
                  <?= csrf_field() ?>
                  <button title="Edit" class="inline-flex items-center px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded transition">
                    <i data-feather="edit" class="w-5 h-5"></i>
                  </button>
                </form>
                <button type="button" data-id="<?= $riwayat['id_laporan'] ?>" class="btn-print inline-flex items-center px-3 py-2 bg-green-500 hover:bg-green-600 text-white rounded transition" title="Print">
                  <i data-feather="printer" class="w-5 h-5"></i>
                </button>
                <form action="<?= base_url('user/hapus-riwayat/' . $riwayat['id_laporan']) ?>"
                  method="post"
                  class="form-hapus inline">
                  <?= csrf_field() ?>
                  <button type="submit"
                    class="btn-hapus inline-flex items-center px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded transition"
                    title="Hapus">
                    <i data-feather="trash" class="w-5 h-5"></i>
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="7" class="p-4 text-center">Tidak ada data riwayat.</td>
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
        <input type="hidden" name="type" value="<?= esc($type ?? 'semua') ?>" />
        <input type="hidden" name="day" value="<?= esc($day ?? '') ?>" />
        <input type="hidden" name="week" value="<?= esc($week ?? '') ?>" />
        <input type="hidden" name="month" value="<?= esc($month ?? '') ?>" />
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

<!-- Modal for Edit -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg mx-4">
    <h2 class="text-xl font-bold mb-6">Edit Laporan</h2>
    <form id="editForm" method="post">
      <?= csrf_field() ?>
      <input type="hidden" name="id_laporan" id="editIdLaporan">
      <div class="mb-6">
        <label for="editNamaBarang" class="block text-base font-medium mb-2">Nama Barang</label>
        <select name="nama_barang" id="editNamaBarang" class="w-full px-4 py-3 border rounded-lg text-base" required>
          <option value="" disabled>Pilih Barang</option>
          <?php foreach ($uniqueBarang as $barang): ?>
            <option value="<?= esc($barang['nama_barang']) ?>">
              <?= esc($barang['nama_barang']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-6">
        <label for="editJumlah" class="block text-base font-medium mb-2">Jumlah</label>
        <input type="number" name="jumlah" id="editJumlah" class="w-full px-4 py-3 border rounded-lg text-base" required>
      </div>
      <div class="mb-6">
        <label for="editJenis" class="block text-base font-medium mb-2">Jenis</label>
        <select name="jenis" id="editJenis" class="w-full px-4 py-3 border rounded-lg text-base" required>
          <option value="Masuk">Masuk</option>
          <option value="Dipakai">Dipakai</option>
        </select>
      </div>
      <div class="flex justify-end gap-3">
        <button type="button" id="closeModal" class="px-6 py-3 bg-gray-300 rounded-lg hover:bg-gray-400 text-base">Batal</button>
        <button type="submit" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-base">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal for Print -->
<div id="printModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg mx-4">
    <h2 class="text-xl font-bold mb-6">Pilih Format Print</h2>
    <form id="printForm" method="post" class="space-y-6">
      <?= csrf_field() ?>
      <input type="hidden" name="id_laporan" id="printIdLaporan">

      <div>
        <label class="block text-base font-medium mb-3">Pilih format</label>
        <div class="grid grid-cols-2 gap-4">
          <label class="format-card cursor-pointer border rounded-lg p-6 flex flex-col items-center justify-center transition hover:border-green-500">
            <input type="radio" name="format" value="excel" class="hidden formatOption">
            <img src="../assets/img/excel.png" alt="Excel" class="mb-3 opacity-70 w-12 h-12">
            <span class="text-base font-medium">Excel</span>
          </label>
          <label class="format-card cursor-pointer border rounded-lg p-6 flex flex-col items-center justify-center transition hover:border-green-500">
            <input type="radio" name="format" value="pdf" class="hidden formatOption">
            <img src="../assets/img/pdf.png" alt="PDF" class="mb-3 opacity-70 w-12 h-12">
            <span class="text-base font-medium">PDF</span>
          </label>
        </div>
      </div>

      <div class="flex justify-end gap-3 pt-3">
        <button type="button" id="closePrintModal"
          class="px-6 py-3 bg-gray-300 rounded-lg hover:bg-gray-400 text-base">Batal</button>
        <button type="submit" id="btnPrint" disabled
          class="px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 disabled:opacity-50 disabled:cursor-not-allowed text-base">Print</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal for Print All (Filtered) -->
<div id="printAllModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg mx-4">
    <h2 class="text-xl font-bold mb-6">Pilih Format Cetak</h2>
    <form id="printAllForm" method="get" action="" class="space-y-6">
      <!-- Persist current filters as hidden inputs -->
      <input type="hidden" name="keyword" value="<?= esc($keyword ?? '') ?>">
      <input type="hidden" name="type" value="<?= esc($type ?? 'semua') ?>">
      <input type="hidden" name="day" value="<?= esc($day ?? '') ?>">
      <input type="hidden" name="week" value="<?= esc($week ?? '') ?>">
      <input type="hidden" name="month" value="<?= esc($month ?? '') ?>">

      <div>
        <label class="block text-base font-medium mb-3">Pilih format</label>
        <div class="grid grid-cols-2 gap-4">
          <label class="format-card-all cursor-pointer border rounded-lg p-6 flex flex-col items-center justify-center transition hover:border-green-500">
            <input type="radio" name="formatAll" value="excel" class="hidden formatOptionAll">
            <img src="../assets/img/excel.png" alt="Excel" class="mb-3 opacity-70 w-12 h-12">
            <span class="text-base font-medium">Excel</span>
          </label>
          <label class="format-card-all cursor-pointer border rounded-lg p-6 flex flex-col items-center justify-center transition hover:border-green-500">
            <input type="radio" name="formatAll" value="pdf" class="hidden formatOptionAll">
            <img src="../assets/img/pdf.png" alt="PDF" class="mb-3 opacity-70 w-12 h-12">
            <span class="text-base font-medium">PDF</span>
          </label>
        </div>
      </div>

      <div class="flex justify-end gap-3 pt-3">
        <button type="button" id="closePrintAllModal" class="px-6 py-3 bg-gray-300 rounded-lg hover:bg-gray-400 text-base">Batal</button>
        <button type="submit" id="btnPrintAll" disabled class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed text-base">Print</button>
      </div>
    </form>
  </div>

</div>

<style>
  /* Efek highlight saat dipilih */
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

  .format-card-all:has(input:checked) {
    border-color: #22c55e;
    background-color: #f0fdf4;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Toggle filter fields
    const typeSelect = document.getElementById('filterType');
    const fieldHarian = document.getElementById('fieldHarian');
    const fieldMingguan = document.getElementById('fieldMingguan');
    const fieldBulanan = document.getElementById('fieldBulanan');

    function refreshFilterFields() {
      const v = typeSelect.value;
      fieldHarian.classList.toggle('hidden', v !== 'harian');
      fieldMingguan.classList.toggle('hidden', v !== 'mingguan');
      fieldBulanan.classList.toggle('hidden', v !== 'bulanan');
    }
    refreshFilterFields();
    typeSelect.addEventListener('change', refreshFilterFields);

    // Edit Modal
    const editButtons = document.querySelectorAll('button[title="Edit"]');
    const editModal = document.getElementById('editModal');
    const closeModal = document.getElementById('closeModal');
    const editForm = document.getElementById('editForm');
    const editIdLaporan = document.getElementById('editIdLaporan');
    const editNamaBarang = document.getElementById('editNamaBarang');
    const editJumlah = document.getElementById('editJumlah');
    const editJenis = document.getElementById('editJenis');

    editButtons.forEach(button => {
      button.addEventListener('click', (e) => {
        e.preventDefault();
        const idLaporan = button.closest('form').action.split('/').pop();
        const row = button.closest('tr');
        const namaBarang = row.querySelector('td:nth-child(3)').textContent.trim();
        const jumlah = row.querySelector('td:nth-child(4)').textContent.trim();
        const jenis = row.querySelector('td:nth-child(5)').textContent.trim();

        editIdLaporan.value = idLaporan;
        editNamaBarang.value = namaBarang;
        editJumlah.value = jumlah;
        editJenis.value = jenis;

        editForm.action = `<?= base_url('user/edit-riwayat') ?>/${idLaporan}`;
        editModal.classList.remove('hidden');
      });
    });

    closeModal.addEventListener('click', () => {
      editModal.classList.add('hidden');
    });

    // Print Modal
    const printButtons = document.querySelectorAll('.btn-print');
    const printModal = document.getElementById('printModal');
    const closePrintModal = document.getElementById('closePrintModal');
    const printForm = document.getElementById('printForm');
    const printIdLaporan = document.getElementById('printIdLaporan');
    const btnPrint = document.getElementById('btnPrint');
    const formatOptions = document.querySelectorAll('.formatOption');

    printButtons.forEach(button => {
      button.addEventListener('click', () => {
        const idLaporan = button.getAttribute('data-id');
        printIdLaporan.value = idLaporan;
        btnPrint.disabled = true;
        formatOptions.forEach(opt => opt.checked = false);
        printForm.action = `<?= base_url('user/print-riwayat') ?>/${idLaporan}`;
        printModal.classList.remove('hidden');
      });
    });

    formatOptions.forEach(option => {
      option.addEventListener('change', () => {
        btnPrint.disabled = !document.querySelector('.formatOption:checked');
      });
    });

    closePrintModal.addEventListener('click', () => {
      printModal.classList.add('hidden');
    });

    // Print All (Filtered)
    const openPrintAllBtn = document.getElementById('openPrintAll');
    const printAllModal = document.getElementById('printAllModal');
    const closePrintAllModal = document.getElementById('closePrintAllModal');
    const printAllForm = document.getElementById('printAllForm');
    const formatOptionAll = document.querySelectorAll('.formatOptionAll');
    const btnPrintAll = document.getElementById('btnPrintAll');

    if (openPrintAllBtn) {
      openPrintAllBtn.addEventListener('click', () => {
        // reset state
        btnPrintAll.disabled = true;
        formatOptionAll.forEach(opt => opt.checked = false);
        printAllForm.action = '';
        printAllModal.classList.remove('hidden');
      });
    }

    formatOptionAll.forEach(opt => {
      opt.addEventListener('change', () => {
        if (opt.checked) {
          // Set endpoint by selected format
          if (opt.value === 'excel') {
            printAllForm.action = `<?= base_url('user/riwayat/excel') ?>`;
          } else if (opt.value === 'pdf') {
            printAllForm.action = `<?= base_url('user/riwayat/pdf') ?>`;
          }
          btnPrintAll.disabled = false;
        }
      });
    });

    if (closePrintAllModal) {
      closePrintAllModal.addEventListener('click', () => {
        printAllModal.classList.add('hidden');
      });
    }
  });
</script>

<?= $this->endSection() ?>