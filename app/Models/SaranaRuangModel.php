<?php

namespace App\Models;

use CodeIgniter\Model;

class SaranaRuangModel extends Model
{
    protected $table = 'tb_sarana_ruang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ruang_id', 'sarana_id', 'jumlah'];
}
