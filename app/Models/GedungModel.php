<?php

namespace App\Models;

use CodeIgniter\Model;

class GedungModel extends Model
{
    protected $table = 'tb_gedung';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nama_gedung', 'pj_gedung', 'luas'];
}
