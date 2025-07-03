<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Data Sarana</h2>

  <a href="<?= base_url('sarana/create') ?>" class="btn btn-primary mb-3">Tambah Sarana</a>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Sarana</th>
        <th>Tipe</th>
        <th>Tahun Beli</th>
        <th>Ruang</th>
        <th>Jumlah</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach ($sarana as $s) : ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= esc($s['nama']) ?></td>
          <td><?= esc($s['type']) ?></td>
          <td><?= esc($s['thn_beli']) ?></td>
          <td><?= esc($s['nama_ruang'] ?? '—') ?></td>
          <td><?= esc($s['jumlah_total']) ?></td>
          <td><?= esc($s['status']) ?></td>
          <td>
            <a href="<?= base_url('sarana/edit/' . $s['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
            <form action="<?= base_url('sarana/delete/' . $s['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
              <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

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
