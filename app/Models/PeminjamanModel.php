<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'tb_peminjaman'; // nama tabel
    protected $primaryKey = 'id';       // primary key-nya

    protected $allowedFields = [
        'nama_penanggung_jawab',
        'email',
        'no_hp',
        'instansi',
        'tanggal_peminjaman',
        'waktu_mulai',
        'waktu_selesai',
        'prasarana',
        'sarana',
        'surat_peminjaman',
        'status',
        'alasan_penolakan',
    ];
}
