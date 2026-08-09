<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informasi Barang</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    /* Mobile-friendly tweaks */
    @media (max-width: 640px) {
      table td {
        display: block;
        width: 100%;
        padding: 6px 0;
      }

      table tr {
        display: block;
        border-bottom: 1px solid #f1f1f1;
        margin-bottom: 8px;
        padding-bottom: 8px;
      }

      #qrcode canvas {
        width: 100% !important;
        height: auto !important;
      }
    }
  </style>
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center justify-center">

  <!-- Card dinaikkan dengan translate-y -->
  <div class="max-w-4xl w-full bg-white shadow-2xl rounded-3xl p-8 md:p-10 transform -translate-y-15">

    <!-- Header -->
    <div class="flex items-center justify-between border-b pb-4 mb-6">
      <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Informasi Barang</h1>
    </div>

    <!-- Alerts -->
    <?php if (session()->getFlashdata('error')): ?>
      <div id="errorAlert" class="bg-red-100 text-red-700 p-3 rounded-xl mb-4 border border-red-300 shadow-sm">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
      <div id="successAlert" class="bg-green-100 text-green-700 p-3 rounded-xl mb-4 border border-green-300 shadow-sm">
        <?= session()->getFlashdata('success') ?>
      </div>
    <?php endif; ?>

    <!-- Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

      <!-- Detail Barang -->
      <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-4"><?= esc($barang['nama_barang']) ?></h2>
        <table class="w-full text-sm">
          <tr>
            <td class="py-2 font-medium">Nama Barang</td>
            <td class="py-2"><?= esc($barang['nama_barang']) ?></td>
          </tr>
          <tr>
            <td class="py-2 font-medium">Jumlah</td>
            <td class="py-2"><?= esc($barang['jumlah']) ?></td>
          </tr>
          <tr>
            <td class="py-2 font-medium">Satuan</td>
            <td class="py-2"><?= esc($barang['satuan']) ?></td>
          </tr>
          <tr>
            <td class="py-2 font-medium">Tanggal Masuk</td>
            <td class="py-2"><?= esc($barang['tanggal_masuk']) ?></td>
          </tr>
          <tr>
            <td class="py-2 font-medium">Minimum Stok</td>
            <td class="py-2"><?= esc($barang['minimum_stok']) ?></td>
          </tr>
          <tr>
            <td class="py-2 font-medium">Barcode</td>
            <td class="py-2"><?= esc($barang['barcode']) ?></td>
          </tr>
        </table>

      </div>

      <!-- QRCode -->
      <div class="flex flex-col items-center justify-center">
        <div id="qrcode" class="w-48 h-48 bg-gray-50 flex items-center justify-center border rounded-2xl shadow-inner"></div>
        <div class="mt-4 text-sm text-gray-600">Barcode:
          <span class="font-semibold"><?= esc($barang['barcode']) ?></span>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const code = <?= json_encode($barang['barcode']) ?>;
      const el = document.getElementById('qrcode');
      if (el && code) {
        el.innerHTML = '';
        new QRCode(el, {
          text: code,
          width: el.clientWidth,
          height: el.clientWidth
        });
      }
    });
  </script>
</body>

</html>