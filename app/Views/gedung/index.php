<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Data Gedung</h2>
<!-- Tombol Tambah Gedung -->
<a href="<?= base_url('gedung/create') ?>" class="btn btn-primary mb-3">+ Tambah Gedung</a>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Gedung</th>
        <th>Penanggung Jawab</th>
        <th>Luas (m²)</th>
        <th>Jumlah Ruang</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($gedung)) : ?>
        <?php $no = 1; foreach ($gedung as $row) : ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($row['nama_gedung']) ?></td>
            <td><?= esc($row['pj_gedung']) ?></td>
            <td><?= esc($row['luas']) ?></td>
            <td>
              <?php
                $jumlahRuang = model('App\Models\RuangModel')->where('gedung_id', $row['id'])->countAllResults();
              ?>
              <?= $jumlahRuang ?> ruang
              <a href="<?= base_url('gedung/' . $row['id'] . '/ruang') ?>" class="btn btn-sm btn-info ms-2">Lihat</a>
            </td>

            <td>
                <a href="<?= base_url('gedung/edit/' . $row['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
               
                <a href="<?= base_url('gedung/delete/' . $row['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus gedung ini?')">Hapus</a>
                </td>
          </tr>
            <?php endforeach; ?>
          <?php else : ?>
        <tr>
          <td colspan="6" class="text-center">Belum ada data gedung.</td>
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
