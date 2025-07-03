<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Data Ruang - <?= esc($gedung['nama_gedung']) ?></h2>

  <a href="<?= base_url('ruang/create/' . $gedung['id']) ?>" class="btn btn-primary mb-3">+ Tambah Ruang</a>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Ruang</th>
        <th>Keadaan</th>
        <th>Kategori</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($ruangan as $r) : ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= esc($r['nama_ruang']) ?></td>
      <td><?= esc($r['keadaan']) ?></td>
      <td>
        <?php
          if (!empty($r['kategori_id'])) {
            $kategoriMatch = array_filter($kategori, fn($k) => $k['id'] == $r['kategori_id']);
            echo esc(reset($kategoriMatch)['nama_kategori'] ?? '—');
        } else {
            echo '—';
        }
        ?>
      </td>
    <td>
    <a href="<?= base_url('ruang/' . $gedung['id'] . '/' . $r['id'] . '/sarana') ?>" class="btn btn-sm btn-info">
        📦 Lihat Sarana
    </a>
    <a href="<?= base_url('ruang/' . $gedung['id'] . '/' . $r['id'] . '/edit') ?>" class="btn btn-sm btn-warning">Edit</a>
    <form action="<?= base_url('ruang/' . $gedung['id'] . '/' . $r['id'] . '/delete') ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus ruang ini?')">
        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
    </form>
    </td>

    </tr>
  <?php endforeach; ?>
</tbody>
  </table>

  <a href="<?= base_url('gedung') ?>" class="btn btn-secondary mt-2">← Kembali ke Daftar Gedung</a>
  <!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  <?php if (session()->getFlashdata('success')): ?>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: '<?= session()->getFlashdata('success') ?>',
      showConfirmButton: false,
      timer: 2000
    });
  <?php elseif (session()->getFlashdata('error')): ?>
    Swal.fire({
      icon: 'error',
      title: 'Gagal!',
      text: '<?= session()->getFlashdata('error') ?>',
      showConfirmButton: false,
      timer: 2000
    });
  <?php endif; ?>
</script>

</div>

<?= $this->endSection(); ?>
