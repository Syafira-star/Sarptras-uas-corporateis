<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Kategori Pinjaman</h2>
  
  <!-- Tombol Tambah -->
  <a href="<?= base_url('kategori-pinjaman/create') ?>" class="btn btn-primary mb-3">Tambah Kategori</a>

  <!-- Tabel -->
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Kategori</th>
        <th>Keterangan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($kategori)) : ?>
        <?php $no = 1; foreach ($kategori as $row) : ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($row['nama_kategori']) ?></td>
            <td><?= esc($row['keterangan']) ?></td>
            <td>
            <a href="<?= base_url('kategori-pinjaman/edit/' . $row['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="<?= base_url('kategori-pinjaman/delete/' . $row['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="4" class="text-center">Belum ada data.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

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
