<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Tambah Sarana untuk Ruang <?= esc($ruang['nama_ruang']) ?> (<?= esc($gedung['nama_gedung']) ?>)</h2>

  <form action="<?= base_url('ruang/' . $gedung['id'] . '/' . $ruang['id'] . '/sarana/store') ?>" method="post">
    <div class="mb-3">
      <label>Jenis Sarana</label>
      <select name="sarana_id" class="form-control" required>
        <option value="">- Pilih Sarana -</option>
        <?php foreach ($sarana as $s) : ?>
          <option value="<?= $s['id'] ?>"><?= esc($s['nama']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Jumlah</label>
      <input type="number" name="jumlah" class="form-control" min="1" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= base_url('ruang/' . $gedung['id'] . '/' . $ruang['id'] . '/sarana') ?>" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?= $this->endSection(); ?>
