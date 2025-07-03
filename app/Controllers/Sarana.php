<?php

namespace App\Controllers;

use App\Models\SaranaModel;
use App\Models\RuangModel;

class Sarana extends BaseController
{
    public function index()
    {
        $model = new SaranaModel();

        // Ambil semua data sarana + nama ruang
        $data['sarana'] = $model
            ->select('tb_sarana.*, tb_ruang.nama_ruang')
            ->join('tb_ruang', 'tb_ruang.id = tb_sarana.ruang_id', 'left')
            ->findAll();

        return view('sarana/index', $data);
    }

    public function create()
{
    $ruangModel = new \App\Models\RuangModel();
    $data['ruangan'] = $ruangModel->findAll();

    return view('sarana/create', $data);
}

public function store()
{
    $model = new \App\Models\SaranaModel();

    $data = [
        'nama'      => $this->request->getPost('nama'),
        'jumlah_total'  => $this->request->getPost('jumlah_total'),
        'type'      => $this->request->getPost('type'),
        'thn_beli'  => $this->request->getPost('thn_beli'),
        'ruang_id'  => $this->request->getPost('ruang_id'),
        'status'    => $this->request->getPost('status'),
    ];

    $model->insert($data);

    return redirect()->to('/sarana')->with('success', 'Data sarana berhasil ditambahkan.');
}

public function edit($id)
{
    $model       = new \App\Models\SaranaModel();
    $ruangModel  = new \App\Models\RuangModel();

    $data['sarana']  = $model->find($id);
    $data['ruangan'] = $ruangModel->findAll();

    return view('sarana/edit', $data);
}

public function update($id)
{
    $model = new \App\Models\SaranaModel();

    $data = [
        'nama'      => $this->request->getPost('nama'),
        'type'      => $this->request->getPost('type'),
        'thn_beli'  => $this->request->getPost('thn_beli'),
        'ruang_id'  => $this->request->getPost('ruang_id'),
        'status'    => $this->request->getPost('status'),
        'jumlah_total' => $this->request->getPost('jumlah_total'),
    ];

    $model->update($id, $data);

    return redirect()->to('/sarana')->with('success', 'Data sarana berhasil diperbarui.');
}

public function delete($id)
{
    $model = new \App\Models\SaranaModel();
    $model->delete($id);

    return redirect()->to('/sarana')->with('success', 'Data sarana berhasil dihapus.');
}

}
