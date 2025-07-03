<?php

namespace App\Controllers;

use App\Models\GedungModel;
use App\Models\RuangModel;
use App\Models\KategoriRuanganModel;

class Ruang extends BaseController
{
    public function index($gedung_id)
{
    $gedungModel    = new \App\Models\GedungModel();
    $ruangModel     = new \App\Models\RuangModel();
    $kategoriModel  = new \App\Models\KategoriRuanganModel();

    $data['gedung']   = $gedungModel->find($gedung_id);
    $data['ruangan']  = $ruangModel->where('gedung_id', $gedung_id)->findAll();
    $data['kategori'] = $kategoriModel->findAll(); // ⬅️ INI WAJIB ADA

    return view('ruang/index', $data);
}


    public function create($gedung_id)
{
    $kategoriModel = new \App\Models\KategoriRuanganModel();

    $data['gedung_id'] = $gedung_id;
    $data['kategori']  = $kategoriModel->findAll();

    return view('ruang/create', $data);
}

public function store($gedung_id)
{
    $model = new \App\Models\RuangModel();

    $data = [
        'gedung_id'   => $gedung_id,
        'kategori_id' => $this->request->getPost('kategori_id'),
        'nama_ruang'  => $this->request->getPost('nama_ruang'),
        'keadaan'     => $this->request->getPost('keadaan'),
    ];

    $model->insert($data);

    return redirect()->to('/gedung/' . $gedung_id . '/ruang')->with('success', 'Data ruang berhasil ditambahkan.');
}
public function edit($gedung_id, $ruang_id)
{
    $ruangModel    = new \App\Models\RuangModel();
    $kategoriModel = new \App\Models\KategoriRuanganModel();

    $data['gedung_id'] = $gedung_id;
    $data['ruang']     = $ruangModel->find($ruang_id);
    $data['kategori']  = $kategoriModel->findAll();

    return view('ruang/edit', $data);
}

public function update($gedung_id, $ruang_id)
{
    $model = new \App\Models\RuangModel();

    $data = [
        'nama_ruang'  => $this->request->getPost('nama_ruang'),
        'keadaan'     => $this->request->getPost('keadaan'),
        'kategori_id' => $this->request->getPost('kategori_id'),
    ];

    $model->update($ruang_id, $data);

    return redirect()->to('/gedung/' . $gedung_id . '/ruang')->with('success', 'Data ruang berhasil diperbarui.');
}

public function delete($gedung_id, $ruang_id)
{
    $model = new \App\Models\RuangModel();
    $model->delete($ruang_id);

    return redirect()->to('/gedung/' . $gedung_id . '/ruang')->with('success', 'Data ruang berhasil dihapus.');
}

public function sarana($gedung_id, $ruang_id)
{
    $gedungModel      = new \App\Models\GedungModel();
    $ruangModel       = new \App\Models\RuangModel();
    $saranaModel      = new \App\Models\SaranaModel();
    $saranaRuangModel = new \App\Models\SaranaRuangModel();

    $data['gedung'] = $gedungModel->find($gedung_id);
    $data['ruang']  = $ruangModel->find($ruang_id);

    // Ambil semua data sarana di ruang ini
    $data['sarana_ruang'] = $saranaRuangModel
        ->select('tb_sarana_ruang.*, tb_sarana.nama AS nama_sarana')
        ->join('tb_sarana', 'tb_sarana.id = tb_sarana_ruang.sarana_id')
        ->where('tb_sarana_ruang.ruang_id', $ruang_id)
        ->findAll();

    return view('ruang/sarana', $data);
}

public function createSarana($gedung_id, $ruang_id)
{
    $gedungModel = new \App\Models\GedungModel();
    $ruangModel  = new \App\Models\RuangModel();
    $saranaModel = new \App\Models\SaranaModel();

    $data['gedung']  = $gedungModel->find($gedung_id);
    $data['ruang']   = $ruangModel->find($ruang_id);
    $data['sarana']  = $saranaModel->findAll();

    return view('ruang/sarana_create', $data);
}

public function storeSarana($gedung_id, $ruang_id)
{
    $model = new \App\Models\SaranaRuangModel();

    $data = [
        'ruang_id'   => $ruang_id,
        'sarana_id'  => $this->request->getPost('sarana_id'),
        'jumlah'     => $this->request->getPost('jumlah'),
    ];

    $model->insert($data);

    return redirect()
        ->to('/ruang/' . $gedung_id . '/' . $ruang_id . '/sarana')
        ->with('success', 'Data sarana berhasil ditambahkan ke ruang.');
}

public function editSarana($gedung_id, $ruang_id, $id)
{
    $gedungModel      = new \App\Models\GedungModel();
    $ruangModel       = new \App\Models\RuangModel();
    $saranaRuangModel = new \App\Models\SaranaRuangModel();
    $saranaModel      = new \App\Models\SaranaModel();

    $data['gedung']        = $gedungModel->find($gedung_id);
    $data['ruang']         = $ruangModel->find($ruang_id);
    $data['sarana_ruang']  = $saranaRuangModel->find($id);
    $data['sarana']        = $saranaModel->findAll(); // untuk tampilkan nama sarana

    return view('ruang/sarana_edit', $data);
}

public function updateSarana($gedung_id, $ruang_id, $id)
{
    $model = new \App\Models\SaranaRuangModel();

    $data = [
        'jumlah' => $this->request->getPost('jumlah'),
    ];

    $model->update($id, $data);

    return redirect()
        ->to('/ruang/' . $gedung_id . '/' . $ruang_id . '/sarana')
        ->with('success', 'Jumlah sarana berhasil diperbarui.');
}

public function deleteSarana($gedung_id, $ruang_id, $id)
{
    $model = new \App\Models\SaranaRuangModel();
    $model->delete($id);

    return redirect()
        ->to('/ruang/' . $gedung_id . '/' . $ruang_id . '/sarana')
        ->with('success', 'Data sarana berhasil dihapus.');
}

}
