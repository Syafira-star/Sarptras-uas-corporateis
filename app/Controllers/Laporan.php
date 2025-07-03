<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\PeminjamanSaranaModel;
use App\Models\SaranaModel;

class Laporan extends BaseController
{
    public function index()
    {
        $model = new PeminjamanModel();
        $saranaModel = new SaranaModel();

        $tanggalMulai = $this->request->getGet('tanggal_mulai');
        $tanggalAkhir = $this->request->getGet('tanggal_akhir');
        $urut = $this->request->getGet('urut') ?? 'asc';
        $filterSarana = $this->request->getGet('sarana_id');

        $query = $model
        ->select('tb_peminjaman.*, tb_peminjaman.id as peminjaman_id') // ✅ pastikan ID aman
        ->where('status', 'Diterima');


        if ($tanggalMulai && $tanggalAkhir) {
            $query = $query->where('tanggal_peminjaman >=', $tanggalMulai)
                           ->where('tanggal_peminjaman <=', $tanggalAkhir);
        }
        if (!empty($filterSarana)) {
            $query->join('tb_peminjaman_sarana', 'tb_peminjaman.id = tb_peminjaman_sarana.peminjaman_id')
                ->where('tb_peminjaman_sarana.sarana_id', $filterSarana);
        }

        $query->orderBy('tanggal_peminjaman', $urut);

        $peminjamanRows = $query->groupBy('tb_peminjaman.id')->findAll();

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
        $saranaDetails = $peminjamanSaranaModel
            ->select('tb_peminjaman_sarana.peminjaman_id, tb_sarana.nama, tb_peminjaman_sarana.jumlah')
            ->join('tb_sarana', 'tb_sarana.id = tb_peminjaman_sarana.sarana_id')
            ->whereIn('tb_peminjaman_sarana.peminjaman_id', $peminjamanIds)
            ->findAll();

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

        $peminjaman = array_values($peminjaman); // tambahkan ini sebelum kirim ke view

        $data = [
            'peminjaman'     => $peminjaman,
            'tanggal_mulai'  => $tanggalMulai,
            'tanggal_akhir'  => $tanggalAkhir,
            'urut'           => $urut,
            'daftarSarana'   => $saranaModel->findAll(),
            'title'          => 'Laporan Penggunaan Fasilitas',
        ];

        // Total diterima
        $jumlahDiterima = $model->where('status', 'Diterima')->countAllResults();

        // Total ditolak
        $jumlahDitolak = $model->where('status', 'Ditolak')->countAllResults();

        // Total yang diproses admin
        $jumlahDiproses = $jumlahDiterima + $jumlahDitolak;

        // Persentase
        $persentaseDiterima = $jumlahDiproses > 0 ? round(($jumlahDiterima / $jumlahDiproses) * 100) : 0;
        $persentaseDitolak  = $jumlahDiproses > 0 ? round(($jumlahDitolak / $jumlahDiproses) * 100) : 0;

        // Kirim ke view
        $data['jumlahDiterima'] = $jumlahDiterima;
        $data['jumlahDitolak'] = $jumlahDitolak;
        $data['jumlahDiproses'] = $jumlahDiproses;
        $data['persentaseDiterima'] = $persentaseDiterima;
        $data['persentaseDitolak'] = $persentaseDitolak;
        
        // Hitung total peminjaman yang diterima
        $totalPeminjaman = (new PeminjamanModel())
            ->where('status', 'Diterima')
            ->countAllResults();

        // Hitung total sarana yang dipinjam
        $totalSarana = (new PeminjamanSaranaModel())
            ->select('sarana_id')
            ->distinct()
            ->countAllResults();

        // Hitung total unit kerja (dari instansi)
        $totalUnitKerja = (new PeminjamanModel())
            ->select('instansi')
            ->distinct()
            ->countAllResults();
        
        $data['totalPeminjaman'] = $totalPeminjaman;
        $data['totalSarana'] = $totalSarana;
        $data['totalUnitKerja'] = $totalUnitKerja;

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
