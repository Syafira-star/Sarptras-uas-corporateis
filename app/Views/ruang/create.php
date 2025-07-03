<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Tambah Ruang</h2>

  <form action="<?= base_url('ruang/store/' . $gedung_id) ?>" method="post">
    <div class="mb-3">
      <label>Nama Ruang</label>
      <input type="text" name="nama_ruang" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Keadaan</label>
      <select name="keadaan" class="form-control" required>
        <option value="">- Pilih Keadaan -</option>
        <option value="Baik">Baik</option>
        <option value="Rusak Ringan">Rusak Ringan</option>
        <option value="Rusak Berat">Rusak Berat</option>
      </select>
    </div>

    <div class="mb-3">
      <label>Kategori</label>
      <select name="kategori_id" class="form-control" required>
        <option value="">- Pilih Kategori -</option>
        <?php foreach ($kategori as $k) : ?>
        <option value="<?= $k['id'] ?>"><?= $k['id'] ?> - <?= esc($k['nama_kategori']) ?></option>
        <?php endforeach; ?>

      </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= base_url('gedung/' . $gedung_id . '/ruang') ?>" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?= $this->endSection(); ?>
