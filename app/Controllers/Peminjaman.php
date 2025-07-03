<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\SaranaModel;

class Peminjaman extends BaseController
{
    public function index()
{
    $peminjamanModel = new \App\Models\PeminjamanModel();
    $peminjamanSaranaModel = new \App\Models\PeminjamanSaranaModel();

    $dataPeminjaman = $peminjamanModel->findAll();

    // Ambil data sarana yang dipinjam per peminjaman_id
    foreach ($dataPeminjaman as &$p) {
        $sarana = $peminjamanSaranaModel
            ->select('tb_sarana.nama, tb_peminjaman_sarana.jumlah')
            ->join('tb_sarana', 'tb_sarana.id = tb_peminjaman_sarana.sarana_id')
            ->where('tb_peminjaman_sarana.peminjaman_id', $p['id'])
            ->findAll();

        // Format jadi: "Proyektor (2), Sound System (1)"
        $list = [];
        foreach ($sarana as $s) {
            $list[] = $s['nama'] . ' (' . $s['jumlah'] . ')';
        }

        $p['sarana'] = count($list) ? implode(', ', $list) : '-';
    }

    $data['peminjaman'] = $dataPeminjaman;
    $data['title'] = 'Data Peminjaman';

    return view('peminjaman/index', $data);
}


    public function form()
{
    $saranaModel = new SaranaModel();
    $data['sarana'] = $saranaModel->findAll();

    return view('form_peminjaman', $data);
}

public function simpan()
{
    $model = new \App\Models\PeminjamanModel();

    // Tangkap file surat jika ada
    $surat = $this->request->getFile('surat');
    $namaSurat = '';

    if ($surat && $surat->isValid() && !$surat->hasMoved()) {
        $namaSurat = $surat->getRandomName();
        $surat->move('uploads/surat', $namaSurat);
    }

        $data = [
        'nama_penanggung_jawab' => $this->request->getPost('nama_penanggung_jawab'),
        'email'                 => $this->request->getPost('email'),
        'no_hp'                 => $this->request->getPost('no_hp'),
        'instansi'              => $this->request->getPost('instansi'),
        'tanggal_peminjaman'    => $this->request->getPost('tanggal_peminjaman'),
        'waktu_mulai'           => $this->request->getPost('waktu_mulai'),
        'waktu_selesai'         => $this->request->getPost('waktu_selesai'),
        'prasarana'             => $this->request->getPost('permohonan_prasarana'),  // ✅ diganti kolomnya
        'sarana'                => $this->request->getPost('permohonan_sarana'),     // ✅ diganti juga
        'surat_peminjaman'      => $namaSurat, // ✅ ganti sesuai kolom db
        'jumlah_total'          => $this->request->getPost('jumlah_total'),
        'status'                => 'Pending', // default status
    ];
 
    $model = new \App\Models\PeminjamanModel(); // ✅ Pastikan ini ada
    $model->insert($data);                    
        // Ambil ID peminjaman terakhir yang baru saja dimasukkan
    $peminjamanId = $model->insertID();

    // Ambil data sarana yang dikirim dari form
$sarana_ids = $this->request->getPost('sarana_id');
$jumlahs = $this->request->getPost('jumlah');

    $saranaModel = new \App\Models\PeminjamanSaranaModel();

    if (is_array($sarana_ids) && is_array($jumlahs)) {
    foreach ($sarana_ids as $index => $id_sarana) {
        $saranaModel->insert([
            'peminjaman_id' => $peminjamanId,
            'sarana_id'     => $id_sarana,
            'jumlah'        => $jumlahs[$index],
        ]);
    }
}

    return redirect()->to('/form-peminjaman')->with('success', 'Permohonan berhasil dikirim.');
}

public function terima($id)
{
    $peminjamanModel = new \App\Models\PeminjamanModel();
    $peminjamanSaranaModel = new \App\Models\PeminjamanSaranaModel();
    $saranaModel = new \App\Models\SaranaModel();

    // Ambil semua sarana yang diminta dalam peminjaman ini
    $saranaDipinjam = $peminjamanSaranaModel->where('peminjaman_id', $id)->findAll();

    foreach ($saranaDipinjam as $item) {
        $sarana = $saranaModel->find($item['sarana_id']);

        $dipinjam = $peminjamanSaranaModel
            ->selectSum('jumlah')
            ->join('tb_peminjaman', 'tb_peminjaman.id = tb_peminjaman_sarana.peminjaman_id')
            ->where('sarana_id', $item['sarana_id'])
            ->where('tb_peminjaman.status', 'Diterima')
            ->first()['jumlah'] ?? 0;

        $sisaStok = $sarana['jumlah_total'] - $dipinjam;

        if ($item['jumlah'] > $sisaStok) {
            return redirect()->to('/peminjaman')->with('error', 'Stok untuk salah satu sarana tidak mencukupi.');
        }
    }

    // Update status peminjaman
    $peminjamanModel->update($id, [
        'status' => 'Diterima',
        'alasan_penolakan' => null
    ]);

    // Kurangi stok setelah diterima
    foreach ($saranaDipinjam as $item) {
        $sarana = $saranaModel->find($item['sarana_id']);
        $saranaBaru = $sarana['jumlah_total'] - $item['jumlah'];

        $saranaModel->update($item['sarana_id'], [
            'jumlah_total' => $saranaBaru
        ]);
    }

    return redirect()->to('/peminjaman')->with('success', 'Peminjaman diterima.');
}


public function tolak($id)
{
    $model = new \App\Models\PeminjamanModel();

    $alasan = $this->request->getPost('alasan_penolakan');

    $model->update($id, [
        'status' => 'Ditolak',
        'alasan_penolakan' => $alasan
    ]);

    return redirect()->to('/peminjaman')->with('success', 'Peminjaman ditolak.');
}

}