<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table            = 'laporan';
    protected $primaryKey       = 'id_laporan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_barang', 'jumlah', 'jenis', 'tanggal', 'id_user'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

public function getRiwayatData($keyword = null, $perPage = null, $all = false, $offset = 0)
{
    $builder = $this->db->table($this->table)
        ->select('laporan.*, barang.nama_barang, users.nama')
        ->join('barang', 'barang.id_barang = laporan.id_barang')
        ->join('users', 'users.id_user = laporan.id_user')
        ->orderBy('laporan.tanggal', 'DESC');

    if (!empty($keyword)) {
        $builder->groupStart()
            ->like('barang.nama_barang', $keyword)
            ->orLike('users.nama', $keyword)
            ->groupEnd();
    }

    // Jika diminta semua data (mis. untuk export Excel/PDF), kembalikan seluruh hasil tanpa limit
    if ($all) {
        return $builder->get()->getResultArray();
    }

    // Jika perPage diberikan, terapkan limit dan offset untuk pagination
    if ($perPage) {
        $builder->limit((int) $perPage, (int) $offset);
        return $builder->get()->getResultArray();
    }

    // Default: kembalikan semua hasil (jika caller tidak menggunakan pagination)
    return $builder->get()->getResultArray();
}

}
