<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id_user';

    protected $allowedFields = ['nama', 'email', 'password', 'no_hp'];
    protected $useTimestamps = false; // karena tabel kamu tidak ada created_at / updated_at


}
