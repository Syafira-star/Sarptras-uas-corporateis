<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Tambah Gedung</h2>

  <form action="<?= base_url('gedung/store') ?>" method="post">
    <div class="mb-3">
      <label>Nama Gedung</label>
      <input type="text" name="nama_gedung" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Penanggung Jawab</label>
      <input type="text" name="pj_gedung" class="form-control">
    </div>

    <div class="mb-3">
      <label>Luas (m²)</label>
      <input type="number" name="luas" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= base_url('gedung') ?>" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?= $this->endSection(); ?>
