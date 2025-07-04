<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\PeminjamanSaranaModel;
use App\Models\SaranaModel;
use Config\Database;

class Laporan extends BaseController
{
    public function index()
    {
        $db = Database::connect(); // Pakai query builder
        $model = new PeminjamanModel();
        $saranaModel = new SaranaModel();

        $tanggalMulai = $this->request->getGet('tanggal_mulai');
        $tanggalAkhir = $this->request->getGet('tanggal_akhir');
        $urut = strtolower($this->request->getGet('urut'));
            if (!in_array($urut, ['asc', 'desc'])) {
                $urut = 'asc';
            }
        $filterSarana = $this->request->getGet('sarana_id');

        $builder = $db->table('tb_peminjaman')
            ->select('tb_peminjaman.*, tb_peminjaman.id as peminjaman_id')
            ->where('tb_peminjaman.status', 'Diterima');

        // Filter tanggal
        if ($tanggalMulai && $tanggalAkhir) {
            $builder->where('tanggal_peminjaman >=', $tanggalMulai)
                    ->where('tanggal_peminjaman <=', $tanggalAkhir);
        }

        // Filter sarana (kalau ada)
        if (!empty($filterSarana)) {
            $builder->join('tb_peminjaman_sarana', 'tb_peminjaman.id = tb_peminjaman_sarana.peminjaman_id')
                    ->where('tb_peminjaman_sarana.sarana_id', $filterSarana);
        }

        // Tambahkan urutan dan group by
        $builder->orderBy('tanggal_peminjaman', $urut);
        $builder->groupBy('tb_peminjaman.id');
        // echo $builder->getCompiledSelect();
        // exit;

        // Ambil data
        $peminjamanRows = $builder->get()->getResultArray();


        $peminjaman = [];
        $peminjamanIds = [];

        foreach ($peminjamanRows as $row) {
            $id = $row['peminjaman_id'];
            if (!isset($peminjaman[$id])) {
                $peminjaman[$id] = $row;
                $peminjaman[$id]['detail_sarana'] = [];
                $peminjamanIds[] = $id;
            }
        }

        // Ambil data peminjaman_sarana
        $peminjamanSaranaModel = new PeminjamanSaranaModel();
        $saranaDetails = [];
        if (!empty($peminjamanIds)) {
            $saranaDetails = $peminjamanSaranaModel
                ->select('tb_peminjaman_sarana.peminjaman_id, tb_sarana.nama, tb_peminjaman_sarana.jumlah')
                ->join('tb_sarana', 'tb_sarana.id = tb_peminjaman_sarana.sarana_id')
                ->whereIn('tb_peminjaman_sarana.peminjaman_id', $peminjamanIds)
                ->findAll();
        }

        // Kelompokkan sarana ke masing-masing peminjaman
        $saranaMap = [];
        foreach ($saranaDetails as $s) {
            $pid = $s['peminjaman_id'];
            if (!isset($saranaMap[$pid])) {
                $saranaMap[$pid] = [];
            }
            $saranaMap[$pid][] = [
                'nama' => $s['nama'],
                'jumlah' => $s['jumlah'],
            ];
        }

        foreach ($peminjaman as &$item) {
        $id = $item['peminjaman_id'];
        $item['detail_sarana'] = $saranaMap[$id] ?? [];

        }

        $peminjaman = array_values($peminjaman); // reset index array

        // Matriks totalan
        $model = new PeminjamanModel();
        $jumlahDiterima = $model->where('status', 'Diterima')->countAllResults();
        $jumlahDitolak = $model->where('status', 'Ditolak')->countAllResults();
        $jumlahDiproses = $jumlahDiterima + $jumlahDitolak;

        $persentaseDiterima = $jumlahDiproses > 0 ? round(($jumlahDiterima / $jumlahDiproses) * 100) : 0;
        $persentaseDitolak  = $jumlahDiproses > 0 ? round(($jumlahDitolak / $jumlahDiproses) * 100) : 0;

        // Analitik
        $totalPeminjaman = $model->where('status', 'Diterima')->countAllResults();
        $totalSarana = (new PeminjamanSaranaModel())->select('sarana_id')->distinct()->countAllResults();
        $totalUnitKerja = (new PeminjamanModel())->select('instansi')->distinct()->countAllResults();

        $data = [
            'peminjaman'         => $peminjaman,
            'tanggal_mulai'      => $tanggalMulai,
            'tanggal_akhir'      => $tanggalAkhir,
            'urut'               => $urut,
            'daftarSarana'       => $saranaModel->findAll(),
            'title'              => 'Laporan Penggunaan Fasilitas',
            'jumlahDiterima'     => $jumlahDiterima,
            'jumlahDitolak'      => $jumlahDitolak,
            'jumlahDiproses'     => $jumlahDiproses,
            'persentaseDiterima' => $persentaseDiterima,
            'persentaseDitolak'  => $persentaseDitolak,
            'totalPeminjaman'    => $totalPeminjaman,
            'totalSarana'        => $totalSarana,
            'totalUnitKerja'     => $totalUnitKerja,
        ];

        return view('laporan/index', $data);
    }

    public function cetak()
    {
        $model = new \App\Models\PeminjamanModel();
        $peminjamanSaranaModel = new \App\Models\PeminjamanSaranaModel();
        $saranaModel = new \App\Models\SaranaModel();

        $tanggal_mulai = $this->request->getGet('tanggal_mulai');
        $tanggal_akhir = $this->request->getGet('tanggal_akhir');

        $query = $model->where('status', 'Diterima');

        if ($tanggal_mulai && $tanggal_akhir) {
            $query->where('tanggal_peminjaman >=', $tanggal_mulai)
                ->where('tanggal_peminjaman <=', $tanggal_akhir);
        }

        $peminjaman = $query->findAll();

        // Tambahkan data sarana ke masing-masing peminjaman
        foreach ($peminjaman as &$p) {
            $dataSarana = $peminjamanSaranaModel
                ->where('peminjaman_id', $p['id'])
                ->findAll();

            // Ambil nama sarana dari tb_sarana
            $listSarana = [];
            foreach ($dataSarana as $ds) {
                $namaSarana = $saranaModel->find($ds['sarana_id'])['nama'] ?? 'Tidak diketahui';
                $listSarana[] = [
                    'nama_sarana' => $namaSarana,
                    'jumlah'      => $ds['jumlah']
                ];
            }

            $p['sarana'] = $listSarana; // masukkan array ke dalam peminjaman
        }

        $data = [
            'peminjaman'     => $peminjaman,
            'tanggal_mulai'  => $tanggal_mulai,
            'tanggal_akhir'  => $tanggal_akhir,
            'title'          => 'Cetak Laporan'
        ];

        return view('laporan/cetak', $data);
    }

}
