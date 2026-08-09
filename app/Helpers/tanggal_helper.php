<?php

function formatTanggalIndo($tanggal)
{
    if (!$tanggal) {
        return '-';
    }

    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    $time = strtotime($tanggal);
    $tgl  = date('d', $time);
    $bln  = $bulan[(int)date('m', $time)];
    $thn  = date('Y', $time);
    $jam  = date('H:i', $time);

    return "$tgl $bln $thn, $jam";
}

function namaHariIndo($tanggal)
{
    if (!$tanggal) {
        return '';
    }
    $hariMap = [
        0 => 'Minggu',
        1 => 'Senin',
        2 => 'Selasa',
        3 => 'Rabu',
        4 => 'Kamis',
        5 => "Jum'at",
        6 => 'Sabtu',
    ];
    $time = is_numeric($tanggal) ? (int)$tanggal : strtotime($tanggal);
    return $hariMap[(int)date('w', $time)] ?? '';
}

function formatTanggalIndoTanpaJam($tanggal)
{
    if (!$tanggal) {
        return '';
    }
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];
    $time = is_numeric($tanggal) ? (int)$tanggal : strtotime($tanggal);
    $tgl  = date('d', $time);
    $bln  = $bulan[(int)date('m', $time)];
    $thn  = date('Y', $time);
    return "$tgl $bln $thn";
}

function formatBulanTahunIndo(string $ym)
{
    if (empty($ym) || strpos($ym, '-') === false) {
        return '';
    }
    [$y, $m] = explode('-', $ym);
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];
    $namaBulan = $bulan[(int)$m] ?? '';
    return trim($namaBulan . ' ' . $y);
}
