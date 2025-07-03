<?php

namespace App\Controllers;

use App\Models\GedungModel;

class Gedung extends BaseController
{
    public function index()
    {
        $model = new GedungModel();
        $data['gedung'] = $model->findAll(); // ambil semua data gedung dari DB

        return view('gedung/index', $data); // kirim ke view
    }
    public function create()
{
    return view('gedung/create');
}
public function store()
{
    $model = new \App\Models\GedungModel();

    $data = [
        'nama_gedung' => $this->request->getPost('nama_gedung'),
        'pj_gedung'   => $this->request->getPost('pj_gedung'),
        'luas'        => $this->request->getPost('luas'),
    ];

    $model->insert($data);

    return redirect()->to('/gedung')->with('success', 'Data gedung berhasil ditambahkan.');
}
public function edit($id)
{
    $model = new \App\Models\GedungModel();
    $data['gedung'] = $model->find($id);

    return view('gedung/edit', $data);
}

public function update($id)
{
    $model = new \App\Models\GedungModel();

    $data = [
        'nama_gedung' => $this->request->getPost('nama_gedung'),
        'pj_gedung'   => $this->request->getPost('pj_gedung'),
        'luas'        => $this->request->getPost('luas'),
    ];

    $model->update($id, $data);

    return redirect()->to('/gedung')->with('success', 'Data gedung berhasil diupdate.');
}
public function delete($id)
{
    $model = new \App\Models\GedungModel();
    $model->delete($id);

    return redirect()->to('/gedung')->with('success', 'Data gedung berhasil dihapus.');
}

public function lihatRuang($gedung_id)
{
    $gedungModel = new \App\Models\GedungModel();
    $ruangModel  = new \App\Models\RuangModel();
    $kategoriModel = new \App\Models\KategoriRuanganModel();

    $data['gedung']   = $gedungModel->find($gedung_id);
    $data['ruangan']  = $ruangModel->where('gedung_id', $gedung_id)->findAll();
    $data['kategori'] = $kategoriModel->findAll(); // ⬅️ WAJIB ADA

    return view('ruang/index', $data);
}


}
