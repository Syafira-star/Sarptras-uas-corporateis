<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriRuanganModel extends Model
{
    protected $table = 'tb_kategori_ruangan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_kategori', 'keterangan'];
}
