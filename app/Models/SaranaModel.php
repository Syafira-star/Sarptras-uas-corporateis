<?php

namespace App\Models;

use CodeIgniter\Model;

class SaranaModel extends Model
{
    protected $table = 'tb_sarana';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'type', 'thn_beli', 'ruang_id', 'status', 'jumlah_total'];
}
