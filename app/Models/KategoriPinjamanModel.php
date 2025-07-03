<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriPinjamanModel extends Model
{
    protected $table = 'tb_kategori_pinjaman'; // nama tabel
    protected $primaryKey = 'id';              // primary key

    protected $allowedFields = ['nama_kategori', 'keterangan']; // kolom yg bisa diinput
}
