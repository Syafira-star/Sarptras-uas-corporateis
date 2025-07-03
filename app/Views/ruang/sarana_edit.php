<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Edit Sarana di Ruang <?= esc($ruang['nama_ruang']) ?> (<?= esc($gedung['nama_gedung']) ?>)</h2>

  <form action="<?= base_url('ruang/' . $gedung['id'] . '/' . $ruang['id'] . '/sarana/update/' . $sarana_ruang['id']) ?>" method="post">
    <div class="mb-3">
      <label>Jenis Sarana</label>
      <input type="text" class="form-control" value="<?php
        $nama = '—';
        foreach ($sarana as $s) {
          if ($s['id'] == $sarana_ruang['sarana_id']) {
            $nama = $s['nama'];
            break;
          }
        }
        echo esc($nama);
      ?>" readonly>
    </div>

    <div class="mb-3">
      <label>Jumlah</label>
      <input type="number" name="jumlah" class="form-control" value="<?= esc($sarana_ruang['jumlah']) ?>" min="1" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="<?= base_url('ruang/' . $gedung['id'] . '/' . $ruang['id'] . '/sarana') ?>" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?= $this->endSection(); ?>
