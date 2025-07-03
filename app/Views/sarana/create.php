<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Tambah Sarana</h2>

  <form action="<?= base_url('sarana/store') ?>" method="post">
    <div class="mb-3">
      <label>Nama Sarana</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="jumlah_total">Jumlah Total</label>
        <input type="number" name="jumlah_total" id="jumlah_total" class="form-control" required min="1">
    </div>
    <div class="mb-3">
      <label>Tipe</label>
      <input type="text" name="type" class="form-control">
    </div>

    <div class="mb-3">
      <label>Tahun Beli</label>
      <input type="number" name="thn_beli" class="form-control" min="2000" max="<?= date('Y') ?>" required>
    </div>

    <div class="mb-3">
      <label>Ruang</label>
      <select name="ruang_id" class="form-control" required>
        <option value="">- Pilih Ruang -</option>
        <?php foreach ($ruangan as $r) : ?>
          <option value="<?= $r['id'] ?>"><?= esc($r['nama_ruang']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Status</label>
      <select name="status" class="form-control" required>
        <option value="">- Pilih Status -</option>
        <option value="Aktif">Aktif</option>
        <option value="Rusak">Rusak</option>
        <option value="Dipinjam">Dipinjam</option>
        <option value="Dipindah">Dipindah</option>
        <option value="Hilang">Hilang</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= base_url('sarana') ?>" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?= $this->endSection(); ?>
