<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Riwayat Barang</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
            color: #222;
        }

        h2 {
            text-align: center;
            margin: 0 0 5px 0;
            color: #1e3a8a;
            font-size: 16px;
            text-transform: uppercase;
        }

        .periode {
            text-align: center;
            font-size: 11px;
            color: #555;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #94a3b8;
        }

        th,
        td {
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background: #e2e8f0;
            color: #0f172a;
            font-weight: bold;
        }

        td.text-left {
            text-align: left;
        }

        .badge-masuk {
            color: #15803d;
            font-weight: bold;
        }

        .badge-dipakai {
            color: #b91c1c;
            font-weight: bold;
        }

        .summary-box {
            margin-top: 15px;
            width: 100%;
            border: 1px solid #cbd5e1;
            background: #f8fafc;
            padding: 10px 15px;
        }

        .summary-table {
            width: 100%;
            border: none;
            margin: 0;
        }

        .summary-table td {
            border: none;
            padding: 3px 0;
            text-align: left;
            font-size: 11px;
        }

        .summary-table td.val {
            text-align: right;
            font-weight: bold;
        }

        .footer {
            margin-top: 25px;
            font-size: 9px;
            color: #94a3b8;
            text-align: right;
        }
    </style>
</head>

<body>
    <h2>LAPORAN RIWAYAT BARANG</h2>
    <?php if (!empty($judulPeriode)): ?>
        <div class="periode">Periode: <?= esc($judulPeriode) ?></div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">Waktu</th>
                <th style="width: 30%;">Nama Barang</th>
                <th style="width: 15%;">Jumlah</th>
                <th style="width: 12%;">Jenis</th>
                <th style="width: 18%;">Staff</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($riwayatData)): ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 15px; color: #64748b;">
                        Tidak ada riwayat transaksi pada filter ini.
                    </td>
                </tr>
            <?php else: ?>
                <?php $no = 1;
                foreach ($riwayatData as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d-m-Y H:i:s', strtotime($row['tanggal'])) ?></td>
                        <td class="text-left"><?= esc($row['nama_barang']) ?></td>
                        <td><?= esc($row['jumlah']) ?> <?= esc($row['satuan'] ?? '') ?></td>
                        <td>
                            <?php if (strtolower($row['jenis']) === 'masuk'): ?>
                                <span class="badge-masuk">Masuk</span>
                            <?php else: ?>
                                <span class="badge-dipakai">Dipakai</span>
                            <?php endif; ?>
                        </td>
                        <td><?= esc($row['nama_user'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="summary-box">
        <table class="summary-table">
            <tr>
                <td>Total Mutasi Barang Masuk</td>
                <td>:</td>
                <td class="val"><?= (int)$totalMasuk ?></td>
            </tr>
            <tr>
                <td>Total Mutasi Barang Dipakai</td>
                <td>:</td>
                <td class="val"><?= (int)$totaldipakai ?></td>
            </tr>
            <tr>
                <td><strong>Total Seluruh Stok Gudang Saat Ini</strong></td>
                <td>:</td>
                <td class="val" style="color: #1e40af;"><?= (int)($totalStokGudang ?? 0) ?></td>
            </tr>
            <tr>
                <td><strong>Kesimpulan Periode</strong></td>
                <td>:</td>
                <td class="val" style="color: #0f172a;"><?= esc($kesimpulan) ?></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Dicetak otomatis oleh RAILOG pada <?= date('d-m-Y H:i:s') ?> WIB</p>
    </div>
</body>

</html>
