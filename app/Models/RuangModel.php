<?php

namespace App\Models;

use CodeIgniter\Model;

class RuangModel extends Model
{
    protected $table = 'tb_ruang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_ruang', 'keadaan', 'kategori_id', 'gedung_id'];

}
