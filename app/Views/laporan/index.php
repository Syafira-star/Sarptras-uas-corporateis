<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Laporan Penggunaan Fasilitas</h2>

  <!-- Filter Tanggal -->
  <form method="get" class="mb-3">
  <div class="form-row">
    <div class="form-group col-md-2">  
      <label for="tanggal_mulai" class="mr-2">Dari:</label>
      <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control mr-3" value="<?= esc($_GET['tanggal_mulai'] ?? '') ?>">
    </div>
    <div class="form-group col-md-2">
      <label for="tanggal_akhir" class="mr-2">Sampai:</label>
      <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control mr-3" value="<?= esc($_GET['tanggal_akhir'] ?? '') ?>">
    </div>
    <div class="form-group col-md-3">
      <label for="sarana_id" class="mr-2">Sarana:</label>
      <select name="sarana_id" id="sarana_id" class="form-control mr-3">
        <option value="">-- Semua Sarana --</option>
        <?php foreach ($daftarSarana as $s) : ?>
          <option value="<?= $s['id'] ?>" <?= ($_GET['sarana_id'] ?? '') == $s['id'] ? 'selected' : '' ?>>
            <?= esc($s['nama']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="urut" class="mr-2">Urutkan:</label>
      <select name="urut" id="urut" class="form-control mr-3">
          <option value="asc" <?= (isset($_GET['urut']) && $_GET['urut'] === 'asc') ? 'selected' : '' ?>>Terlama</option>
          <option value="desc" <?= (isset($_GET['urut']) && $_GET['urut'] === 'desc') ? 'selected' : '' ?>>Terbaru</option>
      </select>
    </div>
    <div class="form-group col-md-3 d-flex align-items-end">
      <button type="submit" class="btn btn-primary mr-2">Tampilkan</button>

      <?php if (!empty($_GET['tanggal_mulai']) && !empty($_GET['tanggal_akhir'])) : ?>
        <a href="<?= base_url('laporan/cetak?tanggal_mulai=' . $_GET['tanggal_mulai'] . '&tanggal_akhir=' . $_GET['tanggal_akhir'] . '&sarana_id=' . ($_GET['sarana_id'] ?? '') . '&urut=' . ($_GET['urut'] ?? '')) ?>"
          target="_blank" class="btn btn-success">Cetak</a>
      <?php endif; ?>
    </div>
  </div>
  </form>

  <!-- Tabel Laporan -->
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="thead-light">
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Instansi</th>
          <th>Tanggal</th>
          <th>Waktu</th>
          <th>Prasarana</th>
          <th>Sarana</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($peminjaman)) : ?>
          <tr>
            <td colspan="7" class="text-center text-muted">Tidak ada data peminjaman.</td>
          </tr>
        <?php else : ?>
          <?php $no = 1; foreach ($peminjaman as $p) : ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($p['nama_penanggung_jawab']) ?></td>
              <td><?= esc($p['instansi']) ?></td>
              <td><?= esc($p['tanggal_peminjaman']) ?></td>
              <td><?= esc($p['waktu_mulai']) ?> - <?= esc($p['waktu_selesai']) ?></td>
              <td><?= esc($p['prasarana'] ?? '-') ?></td>
              <td>
                <?php if (!empty($p['detail_sarana'])) : ?>
                  <?php foreach ($p['detail_sarana'] as $ds) : ?>
                    <?= esc($ds['nama']) ?> (<?= esc($ds['jumlah']) ?>)<br>
                  <?php endforeach; ?>
                <?php else : ?>
                  -
                <?php endif; ?>
              </td>

            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
    <h5 class="mt-5">Matriks Kuantitatif dan Kualitatif (Transparansi Admin)</h5>
    <table class="table table-bordered mt-3">
      <thead class="thead-dark">
        <tr>
          <th>Indikator</th>
          <th>Jumlah</th>
          <th>Persentase</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Peminjaman Diterima</td>
          <td><?= $jumlahDiterima ?></td>
          <td><?= $persentaseDiterima ?>%</td>
          <td>Peminjaman yang disetujui oleh admin</td>
        </tr>
        <tr>
          <td>Peminjaman Ditolak</td>
          <td><?= $jumlahDitolak ?></td>
          <td><?= $persentaseDitolak ?>%</td>
          <td>Peminjaman yang tidak disetujui (terdapat alasan penolakan)</td>
        </tr>
        <tr>
          <td>Total Diproses oleh Admin</td>
          <td><?= $jumlahDiproses ?></td>
          <td>100%</td>
          <td>Seluruh data yang telah diperiksa admin</td>
        </tr>
      </tbody>
    </table>
    <hr class="my-4">
    <h4>Matriks Analitik Penggunaan Fasilitas</h4>

    <table class="table table-bordered">
      <thead class="thead-light">
        <tr>
          <th>Keterangan</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Total Peminjaman</td>
          <td><?= $totalPeminjaman ?></td>
        </tr>
        <tr>
          <td>Total Fasilitas Dipinjam</td>
          <td><?= $totalSarana ?></td>
        </tr>
        <tr>
          <td>Total Unit Kerja</td>
          <td><?= $totalUnitKerja ?></td>
        </tr>
      </tbody>
    </table>

  </div>
</div>

<?= $this->endSection(); ?>
