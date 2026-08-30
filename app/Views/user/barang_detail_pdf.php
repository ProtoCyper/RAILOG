<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Barang - <?= esc($barang['nama_barang']) ?></title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            color: #1e3a8a;
            font-size: 20px;
            text-transform: uppercase;
        }

        .header p {
            margin: 4px 0 0 0;
            font-size: 11px;
            color: #64748b;
        }

        .card {
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f8fafc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            padding: 8px 10px;
            border: 1px solid #cbd5e1;
            text-align: left;
        }

        table th {
            background-color: #e2e8f0;
            color: #1e293b;
            font-weight: bold;
            width: 35%;
        }

        .status-badge {
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 4px;
            display: inline-block;
        }

        .status-aman {
            color: #15803d;
            background-color: #dcfce7;
        }

        .status-menipis {
            color: #b91c1c;
            background-color: #fee2e2;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #94a3b8;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>RAILOG — DETAIL INFORMASI BARANG</h2>
        <p>Dicetak pada: <?= date('d-m-Y H:i:s') ?> WIB</p>
    </div>

    <div class="card">
        <table>
            <tr>
                <th>Nama Barang</th>
                <td><strong><?= esc($barang['nama_barang']) ?></strong></td>
            </tr>
            <tr>
                <th>Kode Barcode / QR</th>
                <td><code><?= esc($barang['barcode'] ?? '-') ?></code></td>
            </tr>
            <tr>
                <th>Total Stok Saat Ini</th>
                <td>
                    <strong style="font-size: 14px; color: #1e40af;"><?= esc($barang['jumlah']) ?></strong>
                    <?= esc($barang['satuan'] ?? 'Unit') ?>
                </td>
            </tr>
            <tr>
                <th>Batas Minimum Stok</th>
                <td><?= esc($barang['minimum_stok']) ?> <?= esc($barang['satuan'] ?? 'Unit') ?></td>
            </tr>
            <tr>
                <th>Status Stok</th>
                <td>
                    <?php if ((int)$barang['jumlah'] <= (int)$barang['minimum_stok']): ?>
                        <span class="status-badge status-menipis">⚠️ Stok Menipis / Mencapai Minimum</span>
                    <?php else: ?>
                        <span class="status-badge status-aman">✓ Stok Aman</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Tanggal Masuk Pertama</th>
                <td><?= !empty($barang['tanggal_masuk']) ? date('d-m-Y', strtotime($barang['tanggal_masuk'])) : '-' ?></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Sistem Informasi Manajemen Inventaris Gudang — RAILOG</p>
    </div>

</body>

</html>
