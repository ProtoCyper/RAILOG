<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan <?= esc($laporan['id_laporan']) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #555;
        }

        th {
            background-color: #f2f2f2;
            padding: 8px;
            text-align: left;
        }

        td {
            padding: 8px;
        }

        .info {
            margin-bottom: 10px;
        }

        .info p {
            margin: 2px 0;
        }
    </style>
</head>

<body>

    <h2>Laporan Riwayat Barang</h2>

    <div class="info">
        <p><strong>ID Laporan:</strong> <?= esc($laporan['id_laporan']) ?></p>
        <p><strong>Tanggal Transaksi:</strong> <?= date('d-m-Y H:i:s', strtotime($laporan['tanggal'])) ?></p>
        <p><strong>Staff Penanggung Jawab:</strong> <?= esc($laporan['nama']) ?></p>
        <p><strong>Total Stok Barang Saat Ini:</strong> <?= esc($laporan['total_stok_sekarang'] ?? '-') ?> <?= esc($laporan['satuan'] ?? '') ?></p>
    </div>

    <table>
        <tr>
            <th>Nama Barang</th>
            <th>Jumlah Mutasi</th>
            <th>Jenis Transaksi</th>
            <th>Stok Tersisa</th>
        </tr>
        <tr>
            <td><?= esc($laporan['nama_barang']) ?></td>
            <td><?= esc($laporan['jumlah']) ?> <?= esc($laporan['satuan'] ?? '') ?></td>
            <td><strong><?= ucfirst(esc($laporan['jenis'])) ?></strong></td>
            <td><?= esc($laporan['total_stok_sekarang'] ?? '-') ?> <?= esc($laporan['satuan'] ?? '') ?></td>
        </tr>
    </table>

</body>

</html>