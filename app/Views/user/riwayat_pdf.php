<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Riwayat Barang</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 6px;
            text-align: center;
        }

        th {
            background: #eee;
        }

        .summary {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h2>LAPORAN RIWAYAT BARANG</h2>
    <?php if (!empty($judulPeriode)): ?>
        <div style="text-align:center;margin:-10px 0 15px 0;">Periode: <?= esc($judulPeriode) ?></div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Jenis</th>
                <th>Staff</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($riwayatData as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d-m-Y H:i:s', strtotime($row['tanggal'])) ?></td>
                    <td><?= esc($row['nama_barang']) ?></td>
                    <td><?= esc($row['jumlah']) ?></td>
                    <td><?= ucfirst($row['jenis']) ?></td>
                    <td><?= esc($row['nama_user']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="summary">
        <p><strong>Total Barang Masuk:</strong> <?= $totalMasuk ?></p>
        <p><strong>Total Barang Dipakai:</strong> <?= $totaldipakai ?></p>
        <p><strong>Kesimpulan:</strong> <?= $kesimpulan ?></p>
    </div>
</body>

</html>