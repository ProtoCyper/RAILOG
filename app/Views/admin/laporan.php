<?= $this->extend('layout/templateAdmin') ?>
<?= $this->section('content') ?>

<!-- Main Content -->
<div class="main-content p-5">
  <div class="mb-4 flex items-start gap-4 flex-wrap">
    <form method="get" id="filterForm" class="flex flex-wrap items-end gap-3">
      <div class="flex flex-col">
        <label class="text-xs font-semibold mb-1">Keyword</label>
        <input type="text" name="keyword" value="<?= esc(service('request')->getVar('keyword')) ?>"
          placeholder="Search..."
          class="px-3 py-2 border border-gray-300 rounded w-56 focus:outline-none focus:ring focus:ring-blue-200 text-sm" />
      </div>

      <div class="flex flex-col">
        <label class="text-xs font-semibold mb-1">Mode Filter</label>
        <select name="filter_mode" id="filter_mode" class="px-3 py-2 border border-gray-300 rounded text-sm">
          <?php $fm = service('request')->getVar('filter_mode'); ?>
          <option value="" <?= $fm == '' ? 'selected' : ''; ?>>Semua</option>
          <option value="harian" <?= $fm == 'harian' ? 'selected' : ''; ?>>Harian</option>
          <option value="mingguan" <?= $fm == 'mingguan' ? 'selected' : ''; ?>>Mingguan</option>
          <option value="bulanan" <?= $fm == 'bulanan' ? 'selected' : ''; ?>>Bulanan</option>
          <option value="range" <?= $fm == 'range' ? 'selected' : ''; ?>>Rentang</option>
        </select>
      </div>

      <div id="wrap_harian" class="flex flex-col hidden">
        <label class="text-xs font-semibold mb-1">Tanggal</label>
        <input type="date" name="date" value="<?= esc(service('request')->getVar('date')) ?>" class="px-3 py-2 border border-gray-300 rounded text-sm" />
      </div>

      <div id="wrap_mingguan" class="flex flex-col hidden">
        <label class="text-xs font-semibold mb-1">Mulai Minggu</label>
        <input type="date" name="week_start" value="<?= esc(service('request')->getVar('week_start')) ?>" class="px-3 py-2 border border-gray-300 rounded text-sm" />
      </div>

      <div id="wrap_bulanan" class="flex flex-col hidden">
        <label class="text-xs font-semibold mb-1">Bulan</label>
        <input type="month" name="month" value="<?= esc(service('request')->getVar('month')) ?>" class="px-3 py-2 border border-gray-300 rounded text-sm" />
      </div>

      <div id="wrap_range" class="flex flex-col hidden">
        <label class="text-xs font-semibold mb-1">Rentang</label>
        <div class="flex gap-2">
          <input type="date" name="start_date" value="<?= esc(service('request')->getVar('start_date')) ?>" class="px-3 py-2 border border-gray-300 rounded text-sm" />
          <input type="date" name="end_date" value="<?= esc(service('request')->getVar('end_date')) ?>" class="px-3 py-2 border border-gray-300 rounded text-sm" />
        </div>
      </div>

      <div class="flex gap-2 items-center">
        <button type="submit"
          class="px-3 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
          Terapkan
        </button>
        <?php if (service('request')->getVar('keyword') || service('request')->getVar('filter_mode')): ?>
          <a href="<?= current_url() ?>"
            class="px-3 py-2 bg-gray-300 text-sm rounded hover:bg-gray-400 transition">Reset</a>
        <?php endif; ?>
      </div>
    </form>

    <div class="ml-auto">
      <button type="button"
        onclick="openPrintModal()"
        class="px-3 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
        Cetak Laporan
      </button>
    </div>
  </div>

  <!-- Table -->
  <div class="overflow-x-auto">
    <table class="min-w-full text-sm bg-white rounded shadow">
      <thead class="bg-gray-200 text-gray-700 font-semibold">
        <tr>
          <th class="p-3 text-left">No</th>
          <th class="p-3 text-left">Waktu</th>
          <th class="p-3 text-left">Nama Barang</th>
          <th class="p-3 text-left">Jumlah</th>
          <th class="p-3 text-left">Jenis</th>
          <th class="p-3 text-left">Staff</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($riwayatData)): ?>
          <?php foreach ($riwayatData as $index => $riwayat): ?>
            <tr class="border-t hover:bg-gray-50">
              <td class="p-3"><?= $index + 1 ?></td>
              <td class="p-3"><?= date('d-m-Y H:i:s', strtotime($riwayat['tanggal'])) ?></td>
              <td class="p-3"><?= $riwayat['nama_barang'] ?></td>
              <td class="p-3"><?= $riwayat['jumlah'] ?></td>
              <td class="p-3"><?= $riwayat['jenis'] ?></td>
              <td class="p-3"><?= $riwayat['nama'] ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="7" class="p-3 text-center">Tidak ada data riwayat.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- Footer Pagination -->
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


<!-- Modal Memilih Format Cetak -->
<div id="printModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg p-6 w-96">
    <h2 class="text-lg font-bold mb-4">Pilih Format Print</h2>
    <form id="printForm" method="get" action="" class="space-y-4">
      <?= csrf_field() ?>
      <input type="hidden" name="keyword" value="<?= esc($keyword) ?>">
      <input type="hidden" name="per_page" value="<?= esc($perPage) ?>">
      <!-- Hidden filter parameters -->
      <input type="hidden" name="filter_mode" id="h_filter_mode" value="<?= esc(service('request')->getVar('filter_mode')) ?>">
      <input type="hidden" name="date" id="h_date" value="<?= esc(service('request')->getVar('date')) ?>">
      <input type="hidden" name="week_start" id="h_week_start" value="<?= esc(service('request')->getVar('week_start')) ?>">
      <input type="hidden" name="month" id="h_month" value="<?= esc(service('request')->getVar('month')) ?>">
      <input type="hidden" name="start_date" id="h_start_date" value="<?= esc(service('request')->getVar('start_date')) ?>">
      <input type="hidden" name="end_date" id="h_end_date" value="<?= esc(service('request')->getVar('end_date')) ?>">

      <div>
        <label class="block text-sm font-medium mb-2">Pilih format</label>
        <div class="grid grid-cols-2 gap-4">
          <label class="format-card cursor-pointer border rounded-lg p-4 flex flex-col items-center justify-center transition hover:border-green-500">
            <input type="radio" name="format" value="excel" class="hidden formatOption">
            <img src="../assets/img/excel.png" alt="Excel" class="mb-2 opacity-70">
            <span class="text-sm font-medium">Excel</span>
          </label>
          <label class="format-card cursor-pointer border rounded-lg p-4 flex flex-col items-center justify-center transition hover:border-green-500">
            <input type="radio" name="format" value="pdf" class="hidden formatOption">
            <img src="../assets/img/pdf.png" alt="PDF" class="mb-2 opacity-70">
            <span class="text-sm font-medium">PDF</span>
          </label>
        </div>
      </div>

      <div class="flex justify-end gap-2 pt-2">
        <button type="button" id="closePrintModal"
          class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
        <button type="submit" id="btnPrint" disabled
          class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 disabled:opacity-50 disabled:cursor-not-allowed">
          Print
        </button>
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
</style>

<!-- Script Modal -->
<script>
  function openPrintModal() {
    // Salin nilai filter ke hidden
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
  }

  document.addEventListener("DOMContentLoaded", function() {
    const printModal = document.getElementById("printModal");
    const closePrintModal = document.getElementById("closePrintModal");
    const formatOptions = document.querySelectorAll(".formatOption");
    const btnPrint = document.getElementById("btnPrint");
    const printForm = document.getElementById("printForm");

    // Tutup modal
    closePrintModal.addEventListener("click", () => {
      printModal.classList.add("hidden");
      formatOptions.forEach(opt => opt.checked = false);
      btnPrint.disabled = true;
    });

    // Ubah action sesuai pilihan format
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

    // Tampilkan field sesuai filter_mode
    function toggleFilterFields() {
      const mode = document.getElementById('filter_mode').value;
      document.getElementById('wrap_harian').classList.add('hidden');
      document.getElementById('wrap_mingguan').classList.add('hidden');
      document.getElementById('wrap_bulanan').classList.add('hidden');
      document.getElementById('wrap_range').classList.add('hidden');
      if (mode === 'harian') document.getElementById('wrap_harian').classList.remove('hidden');
      if (mode === 'mingguan') document.getElementById('wrap_mingguan').classList.remove('hidden');
      if (mode === 'bulanan') document.getElementById('wrap_bulanan').classList.remove('hidden');
      if (mode === 'range') document.getElementById('wrap_range').classList.remove('hidden');
    }
    document.getElementById('filter_mode').addEventListener('change', toggleFilterFields);
    toggleFilterFields();
  });
</script>

<?= $this->endSection() ?>