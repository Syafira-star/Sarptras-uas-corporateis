<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanSaranaModel extends Model
{
    protected $table = 'tb_peminjaman_sarana';
    protected $primaryKey = 'id';
    protected $allowedFields = ['peminjaman_id', 'sarana_id', 'jumlah'];
}
