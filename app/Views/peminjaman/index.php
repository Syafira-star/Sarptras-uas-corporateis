<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Data Peminjaman</h2>

  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Instansi</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Prasarana</th>
                <th>Sarana</th>
                <th>Surat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; foreach ($peminjaman as $p) : ?>
                
                <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($p['nama_penanggung_jawab']) ?></td>
                <td><?= esc($p['email']) ?></td>
                <td><?= esc($p['no_hp']) ?></td>
                <td><?= esc($p['instansi']) ?></td>
                <td><?= esc($p['tanggal_peminjaman']) ?></td>
                <td><?= esc($p['waktu_mulai']) ?> - <?= esc($p['waktu_selesai']) ?></td>
                <td><?= esc($p['prasarana'] ?? '-') ?></td>
                <td><?= esc($p['sarana'] ?? '-') ?></td>
                <td>
                    <?php if ($p['surat_peminjaman']) : ?>
                    <a href="<?= base_url('uploads/surat/' . $p['surat_peminjaman']) ?>" target="_blank">Lihat Surat</a>
                    <?php else : ?>
                    <span class="text-muted">Tidak ada</span>
                    <?php endif; ?>
                </td>
                <td>
                  <span class="badge 
                    <?= $p['status'] === 'Diterima' ? 'badge-success' : 
                        ($p['status'] === 'Ditolak' ? 'badge-danger' : 'badge-warning') ?>">
                    <?= esc($p['status'] ?: 'Pending') ?>
                  </span>
                </td>
                <td>
                  <?php if ($p['status'] === 'Pending') : ?>
                    <form action="<?= base_url('peminjaman/terima/' . $p['id']) ?>" method="post" class="d-inline">
                        <button class="btn btn-success btn-sm" onclick="return confirm('Yakin terima peminjaman ini?')">Terima</button>
                    </form>

                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#tolakModal<?= $p['id'] ?>">Tolak</button>

                    <!-- Modal Tolak -->
                    <div class="modal fade" id="tolakModal<?= $p['id'] ?>" tabindex="-1">
                      <div class="modal-dialog">
                        <form action="<?= base_url('peminjaman/tolak/' . $p['id']) ?>" method="post">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Alasan Penolakan</h5>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <textarea name="alasan_penolakan" class="form-control" required></textarea>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-danger">Kirim</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  <?php elseif ($p['status'] === 'Ditolak' && $p['alasan_penolakan']) : ?>
                    <small class="text-muted">Alasan: <?= esc($p['alasan_penolakan']) ?></small>
                  <?php endif; ?>
                </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
  </div>
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
