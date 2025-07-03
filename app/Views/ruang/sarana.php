<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Daftar Sarana di Ruang <?= esc($ruang['nama_ruang']) ?> (<?= esc($gedung['nama_gedung']) ?>)</h2>

  <?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success">
      <?= session()->getFlashdata('success') ?>
    </div>
  <?php endif; ?>

  <a href="<?= base_url('gedung/' . $gedung['id'] . '/ruang') ?>" class="btn btn-secondary mb-3">← Kembali ke Ruang</a>
  <a href="<?= base_url('ruang/' . $gedung['id'] . '/' . $ruang['id'] . '/sarana/create') ?>" class="btn btn-primary mb-3">
  + Tambah Sarana
</a>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Sarana</th>
        <th>Jumlah</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($sarana_ruang)) : ?>
        <tr>
          <td colspan="4" class="text-center text-muted">Belum ada data sarana di ruang ini.</td>
        </tr>
      <?php else : ?>
        <?php $no = 1; foreach ($sarana_ruang as $sr) : ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($sr['nama_sarana']) ?></td>
            <td><?= esc($sr['jumlah']) ?></td>
            <td>
            <a href="<?= base_url('ruang/' . $gedung['id'] . '/' . $ruang['id'] . '/sarana/edit/' . $sr['id']) ?>" class="btn btn-sm btn-warning">Edit</a>

            <form action="<?= base_url('ruang/' . $gedung['id'] . '/' . $ruang['id'] . '/sarana/delete/' . $sr['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus sarana ini?')">
              <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form>

            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?= $this->endSection(); ?>
