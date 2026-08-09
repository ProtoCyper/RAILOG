<?php

namespace App\Models;

use CodeIgniter\Model;

class LogAktivitasModel extends Model
{
    protected $table            = 'log_aktivitas';
    protected $primaryKey       = 'id_log';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user',
        'id_admin',
        'role',
        'aktivitas',
        'ip_address',
        'user_agent'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    /**
     * Ambil log aktivitas admin
     */
    public function getLogsByAdmin($limit = 10)
    {
        return $this->select('log_aktivitas.*, admin.nama as nama_admin')
            ->join('admin', 'admin.id_admin = log_aktivitas.id_admin', 'left')
            ->where('log_aktivitas.role', 'Admin')
            ->orderBy('log_aktivitas.created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Ambil log aktivitas user (staff gudang)
     */
    public function getLogsByUser($limit = 10)
    {
        return $this->select('log_aktivitas.*, users.nama as nama_user')
            ->join('users', 'users.id_user = log_aktivitas.id_user', 'left')
            ->where('log_aktivitas.role', 'User')
            ->orderBy('log_aktivitas.created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Ambil log aktivitas user dengan filter pencarian
     */
    public function getLogsByUserWithFilter($keyword = null, $perPage = 10)
    {
        $builder = $this->select('log_aktivitas.*, users.nama as nama_user')
            ->join('users', 'users.id_user = log_aktivitas.id_user', 'left')
            ->where('log_aktivitas.role', 'user');

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('users.nama', $keyword)
                ->orLike('log_aktivitas.aktivitas', $keyword)
                ->orLike('log_aktivitas.ip_address', $keyword)
                ->orLike('log_aktivitas.created_at', $keyword)
                ->groupEnd();
        }

        return $builder
            ->orderBy('log_aktivitas.created_at', 'DESC')
            ->paginate($perPage, 'number');
    }

    /**
     * Ambil log aktivitas admin dengan filter pencarian
     */
    public function getLogsByAdminWithFilter($keyword = null, $perPage = 10)
    {
        $builder = $this->select('log_aktivitas.*, admin.nama as nama_admin')
            ->join('admin', 'admin.id_admin = log_aktivitas.id_admin', 'left')
            ->where('log_aktivitas.role', 'Admin');

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('admin.nama', $keyword)
                ->orLike('log_aktivitas.aktivitas', $keyword)
                ->orLike('log_aktivitas.ip_address', $keyword)
                ->orLike('log_aktivitas.created_at', $keyword)
                ->groupEnd();
        }

        return $builder
            ->orderBy('log_aktivitas.created_at', 'DESC')
            ->paginate($perPage, 'number');
    }

    /**
     * Ambil semua log (baik admin maupun user), 
     * sekaligus gabungkan nama jadi 1 kolom `nama_user`
     */
    public function getAllLogs($limit = 10)
    {
        return $this->db->table('log_aktivitas')
            ->select('log_aktivitas.*, 
                      COALESCE(users.nama, admin.nama) as nama_user')
            ->join('users', 'users.id_user = log_aktivitas.id_user', 'left')
            ->join('admin', 'admin.id_admin = log_aktivitas.id_admin', 'left')
            ->orderBy('log_aktivitas.created_at', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }
}
