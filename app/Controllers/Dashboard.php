<?php

namespace App\Controllers;

use App\Models\GedungModel;
use App\Models\RuangModel;
use App\Models\SaranaModel;
use App\Models\PeminjamanModel;

class Dashboard extends BaseController
{
   public function index()
{
    $gedungModel = new \App\Models\GedungModel();
    $ruangModel  = new \App\Models\RuangModel();
    $saranaModel = new \App\Models\SaranaModel();
    $peminjamanModel = new \App\Models\PeminjamanModel();

    // Ambil total jumlah data
    $data['jumlahGedung'] = $gedungModel->countAll();
    $data['jumlahRuang']  = $ruangModel->countAll();
    $data['jumlahSarana'] = $saranaModel->countAll();
    $data['jumlahPeminjaman'] = $peminjamanModel->where('status', 'Diterima')->countAllResults();

    // Ambil data grafik: jumlah peminjaman per ruang
    $db = \Config\Database::connect();
    $builder = $db->table('tb_peminjaman_sarana');
    $builder->select('tb_ruang.nama_ruang, COUNT(tb_peminjaman_sarana.id) as jumlah');
    $builder->join('tb_sarana', 'tb_sarana.id = tb_peminjaman_sarana.sarana_id');
    $builder->join('tb_ruang', 'tb_ruang.id = tb_sarana.ruang_id');
    $builder->join('tb_peminjaman', 'tb_peminjaman.id = tb_peminjaman_sarana.peminjaman_id');
    $builder->where('tb_peminjaman.status', 'Diterima');
    $builder->groupBy('tb_ruang.nama_ruang');
    $builder->orderBy('jumlah', 'DESC');
    $builder->limit(6);

    $grafik = $builder->get()->getResultArray();

    $data['labels'] = array_column($grafik, 'nama_ruang');
    $data['jumlah'] = array_column($grafik, 'jumlah');

    return view('dashboard/index', $data);
}

public function getGrafik()
{
    $tanggalMulai = $this->request->getGet('tanggal_mulai');
    $tanggalAkhir = $this->request->getGet('tanggal_akhir');

    $db = \Config\Database::connect();
    $builder = $db->table('tb_peminjaman_sarana');
    $builder->select('tb_ruang.nama_ruang, COUNT(tb_peminjaman_sarana.id) as jumlah');
    $builder->join('tb_sarana', 'tb_sarana.id = tb_peminjaman_sarana.sarana_id');
    $builder->join('tb_ruang', 'tb_ruang.id = tb_sarana.ruang_id');
    $builder->join('tb_peminjaman', 'tb_peminjaman.id = tb_peminjaman_sarana.peminjaman_id');
    $builder->where('tb_peminjaman.status', 'Diterima');

    if ($tanggalMulai && $tanggalAkhir) {
        $builder->where('tb_peminjaman.tanggal_peminjaman >=', $tanggalMulai)
                ->where('tb_peminjaman.tanggal_peminjaman <=', $tanggalAkhir);
    }

    $builder->groupBy('tb_ruang.nama_ruang');
    $builder->orderBy('jumlah', 'DESC');
    $builder->limit(6);

    $result = $builder->get()->getResultArray();

    $labels = [];
    $jumlah = [];
    foreach ($result as $row) {
        $labels[] = $row['nama_ruang'];
        $jumlah[] = (int) $row['jumlah'];
    }

    return $this->response->setJSON([
        'labels' => $labels,
        'jumlah' => $jumlah
    ]);
}


public function getPieData()
{
    $tanggalMulai = $this->request->getGet('tanggal_mulai');
    $tanggalAkhir = $this->request->getGet('tanggal_akhir');

    $db = \Config\Database::connect();
    $builder = $db->table('tb_peminjaman_sarana');
    $builder->select('tb_sarana.nama, COUNT(tb_peminjaman_sarana.id) as jumlah');
    $builder->join('tb_peminjaman', 'tb_peminjaman.id = tb_peminjaman_sarana.peminjaman_id');
    $builder->join('tb_sarana', 'tb_sarana.id = tb_peminjaman_sarana.sarana_id');
    $builder->where('tb_peminjaman.status', 'Diterima');

    if (!empty($tanggalMulai) && !empty($tanggalAkhir)) {
        $builder->where('tb_peminjaman.tanggal_peminjaman >=', $tanggalMulai)
                ->where('tb_peminjaman.tanggal_peminjaman <=', $tanggalAkhir);
    }

    $builder->groupBy('tb_sarana.nama');
    $result = $builder->get()->getResultArray();

    $labels = array_column($result, 'nama');
    $data   = array_column($result, 'jumlah');

    return $this->response->setJSON([
        'labels' => $labels,
        'data'   => $data
    ]);
}

}
