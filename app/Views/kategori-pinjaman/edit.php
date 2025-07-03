<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Edit Kategori Pinjaman</h2>

  <form action="<?= base_url('kategori-pinjaman/update/' . $kategori['id']) ?>" method="post">
    <div class="mb-3">
      <label>Nama Kategori</label>
      <input type="text" name="nama_kategori" class="form-control" value="<?= esc($kategori['nama_kategori']) ?>" required>
    </div>

    <div class="mb-3">
      <label>Keterangan</label>
      <textarea name="keterangan" class="form-control"><?= esc($kategori['keterangan']) ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= base_url('kategori-pinjaman') ?>" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?= $this->endSection(); ?>
