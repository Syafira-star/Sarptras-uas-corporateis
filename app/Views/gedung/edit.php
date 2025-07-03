<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Edit Gedung</h2>

  <form action="<?= base_url('gedung/update/' . $gedung['id']) ?>" method="post">
    <div class="mb-3">
      <label>Nama Gedung</label>
      <input type="text" name="nama_gedung" class="form-control" value="<?= esc($gedung['nama_gedung']) ?>" required>
    </div>

    <div class="mb-3">
      <label>Penanggung Jawab</label>
      <input type="text" name="pj_gedung" class="form-control" value="<?= esc($gedung['pj_gedung']) ?>">
    </div>

    <div class="mb-3">
      <label>Luas (m²)</label>
      <input type="number" name="luas" class="form-control" value="<?= esc($gedung['luas']) ?>">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= base_url('gedung') ?>" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?= $this->endSection(); ?>
