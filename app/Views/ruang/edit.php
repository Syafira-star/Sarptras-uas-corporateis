<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Edit Ruang</h2>

  <form action="<?= base_url('ruang/' . $gedung_id . '/' . $ruang['id'] . '/update') ?>" method="post">
    <div class="mb-3">
      <label>Nama Ruang</label>
      <input type="text" name="nama_ruang" class="form-control" value="<?= esc($ruang['nama_ruang']) ?>" required>
    </div>

    <div class="mb-3">
      <label>Keadaan</label>
      <select name="keadaan" class="form-control" required>
        <option value="">- Pilih Keadaan -</option>
        <option value="Baik" <?= $ruang['keadaan'] === 'Baik' ? 'selected' : '' ?>>Baik</option>
        <option value="Rusak Ringan" <?= $ruang['keadaan'] === 'Rusak Ringan' ? 'selected' : '' ?>>Rusak Ringan</option>
        <option value="Rusak Berat" <?= $ruang['keadaan'] === 'Rusak Berat' ? 'selected' : '' ?>>Rusak Berat</option>
      </select>
    </div>

    <div class="mb-3">
      <label>Kategori</label>
      <select name="kategori_id" class="form-control" required>
        <option value="">- Pilih Kategori -</option>
        <?php foreach ($kategori as $k) : ?>
          <option value="<?= $k['id'] ?>" <?= $ruang['kategori_id'] == $k['id'] ? 'selected' : '' ?>>
            <?= $k['id'] ?> - <?= esc($k['nama_kategori']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="<?= base_url('gedung/' . $gedung_id . '/ruang') ?>" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?= $this->endSection(); ?>
