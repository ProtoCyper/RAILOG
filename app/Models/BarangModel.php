<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'id_barang';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_barang',
        'jumlah',
        'satuan',
        'tanggal_masuk',
        'barcode',
        'minimum_stok',
        'gambar',
        'surat_jalan'
    ];

    // Jika tidak menggunakan timestamps, bisa di-nonaktifkan
    protected $useTimestamps = false;

    // Validation (opsional, bisa diisi jika ingin validasi model)
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;

    // Callbacks (opsional, jika tidak digunakan bisa dikosongkan)
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
