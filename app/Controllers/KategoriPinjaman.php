<?php

namespace App\Controllers;

use App\Models\KategoriPinjamanModel;

class KategoriPinjaman extends BaseController
{
    public function index()
    {
        $model = new KategoriPinjamanModel();
        $data['kategori'] = $model->findAll();

        return view('kategori-pinjaman/index', $data);
    }

    public function create()
    {
        return view('kategori-pinjaman/create');
    }

    public function store()
    {
        $model = new KategoriPinjamanModel();

        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'keterangan'    => $this->request->getPost('keterangan'),
        ];

        $model->insert($data);

        return redirect()->to('/kategori-pinjaman')->with('success', 'Data berhasil ditambahkan.');
    }
    public function edit($id)
{
    $model = new KategoriPinjamanModel();
    $data['kategori'] = $model->find($id);

    return view('kategori-pinjaman/edit', $data);
}

public function update($id)
{
    $model = new KategoriPinjamanModel();

    $data = [
        'nama_kategori' => $this->request->getPost('nama_kategori'),
        'keterangan'    => $this->request->getPost('keterangan'),
    ];

    $model->update($id, $data);

    return redirect()->to('/kategori-pinjaman')->with('success', 'Data berhasil diupdate.');
}
public function delete($id)
{
    $model = new KategoriPinjamanModel();
    $model->delete($id);

    return redirect()->to('/kategori-pinjaman')->with('success', 'Data berhasil dihapus.');
}

}
