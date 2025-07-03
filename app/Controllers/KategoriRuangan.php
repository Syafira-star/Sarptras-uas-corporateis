<?php

namespace App\Controllers;

use App\Models\KategoriRuanganModel;

class KategoriRuangan extends BaseController
{
    public function index()
    {
        $model = new KategoriRuanganModel();
        $data['kategori'] = $model->findAll();

        return view('kategori-ruangan/index', $data);
    }

    public function create()
    {
        return view('kategori-ruangan/create');
    }

    public function store()
    {
        $model = new KategoriRuanganModel();

        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'keterangan'    => $this->request->getPost('keterangan'),
        ];

        $model->insert($data);

        return redirect()->to('/kategori-ruangan')->with('success', 'Data berhasil ditambahkan.');
    }
    public function edit($id)
{
    $model = new KategoriRuanganModel();
    $data['kategori'] = $model->find($id);

    return view('kategori-ruangan/edit', $data);
}

public function update($id)
{
    $model = new KategoriRuanganModel();

    $data = [
        'nama_kategori' => $this->request->getPost('nama_kategori'),
        'keterangan'    => $this->request->getPost('keterangan'),
    ];

    $model->update($id, $data);

    return redirect()->to('/kategori-ruangan')->with('success', 'Data berhasil diupdate.');
}
public function delete($id)
{
    $model = new KategoriRuanganModel();
    $model->delete($id);

    return redirect()->to('/kategori-ruangan')->with('success', 'Data berhasil dihapus.');
}

}
