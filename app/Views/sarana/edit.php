<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Edit Sarana</h2>

  <form action="<?= base_url('sarana/update/' . $sarana['id']) ?>" method="post">
    <div class="mb-3">
      <label>Nama Sarana</label>
      <input type="text" name="nama" class="form-control" value="<?= esc($sarana['nama']) ?>" required>
    </div>

    <div class="mb-3">
      <label>Tipe</label>
      <input type="text" name="type" class="form-control" value="<?= esc($sarana['type']) ?>">
    </div>

    <div class="mb-3">
      <label>Tahun Beli</label>
      <input type="number" name="thn_beli" class="form-control" value="<?= esc($sarana['thn_beli']) ?>" min="2000" max="<?= date('Y') ?>" required>
    </div>

    <div class="mb-3">
      <label>Ruang</label>
      <select name="ruang_id" class="form-control" required>
        <option value="">- Pilih Ruang -</option>
        <?php foreach ($ruangan as $r) : ?>
          <option value="<?= $r['id'] ?>" <?= $sarana['ruang_id'] == $r['id'] ? 'selected' : '' ?>>
            <?= esc($r['nama_ruang']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    
    <div class="mb-3">
  <label for="jumlah_total">Jumlah Total</label>
  <input type="number" name="jumlah_total" id="jumlah_total" class="form-control" value="<?= esc($sarana['jumlah_total']) ?>" required min="1">
</div>

    <div class="mb-3">
      <label>Status</label>
      <select name="status" class="form-control" required>
        <option value="">- Pilih Status -</option>
        <?php
        $opsi = ['Aktif', 'Rusak', 'Dipinjam', 'Dipindah', 'Hilang'];
        foreach ($opsi as $o) :
        ?>
          <option value="<?= $o ?>" <?= $sarana['status'] == $o ? 'selected' : '' ?>><?= $o ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="<?= base_url('sarana') ?>" class="btn btn-secondary">Batal</a>
  </form>
</div>

<?= $this->endSection(); ?>
