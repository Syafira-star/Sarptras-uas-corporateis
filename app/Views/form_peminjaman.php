<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid mt-5">
  <div class="row">
    <div class="col-md-8 offset-md-1">
  <h3>Form Pengajuan Peminjaman Fasilitas</h3>

  <form action="<?= base_url('peminjaman/simpan') ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label>Nama Penanggung Jawab</label>
      <input type="text" name="nama_penanggung_jawab" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>

    <div class="form-group">
      <label>No. HP</label>
      <input type="text" name="no_hp" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Instansi / Organisasi</label>
      <input type="text" name="instansi" class="form-control" required>
    </div>

    <div class="form-group">
      <label>Tanggal Peminjaman</label>
      <input type="date" name="tanggal_peminjaman" class="form-control" required>
    </div>

    <div class="form-group row">
      <div class="col-md-6">
        <label>Waktu Mulai</label>
        <input type="time" name="waktu_mulai" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label>Waktu Selesai</label>
        <input type="time" name="waktu_selesai" class="form-control" required>
      </div>
    </div>

    <div class="form-group">
      <label>Permohonan Prasarana</label>
      <input type="text" name="permohonan_prasarana" class="form-control" required>
    </div>

    <div id="sarana-container">
  <div class="row mb-2 sarana-group">
    <div class="col-md-6">
      <label>Pilih Sarana</label>
      <select name="sarana_id[]" class="form-control" required>
        <option value="">- Pilih Sarana -</option>
        <?php foreach ($sarana as $s) : ?>
          <option value="<?= $s['id'] ?>">
            <?= esc($s['nama']) ?> (Tersedia: <?= $s['jumlah_total'] ?>)
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-4">
      <label>Jumlah</label>
      <input type="number" name="jumlah[]" class="form-control" min="1" required>
    </div>
    <div class="col-md-2 d-flex align-items-end">
      <button type="button" class="btn btn-danger remove-sarana">Hapus</button>
    </div>
  </div>
</div>

<button type="button" class="btn btn-secondary mb-3" id="add-sarana">+ Tambah Sarana</button>

    <div class="form-group">
      <label>Upload Surat Peminjaman (PDF)</label>
      <input type="file" name="surat" class="form-control-file" accept=".pdf">
    </div>

    <div class="form-group mt-3">
      <button type="submit" class="btn btn-primary">Kirim Permohonan</button>
    </div>
  </form>
  <script>
  document.getElementById('add-sarana').addEventListener('click', function () {
    const container = document.getElementById('sarana-container');
    const group = container.querySelector('.sarana-group');
    const clone = group.cloneNode(true);

    // Kosongkan nilai input baru
    clone.querySelector('select').selectedIndex = 0;
    clone.querySelector('input').value = '';

    container.appendChild(clone);
  });

  // Event delegation untuk hapus baris
  document.getElementById('sarana-container').addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-sarana')) {
      const groups = document.querySelectorAll('.sarana-group');
      if (groups.length > 1) {
        e.target.closest('.sarana-group').remove();
      }
    }
  });
</script>
</div>
</div>
</div>

<?= $this->endSection(); ?>

<script>
  document.getElementById('add-sarana').addEventListener('click', function () {
    const container = document.getElementById('sarana-container');
    const group = container.querySelector('.sarana-group');
    const clone = group.cloneNode(true);

    // Kosongkan nilai input baru
    clone.querySelector('select').selectedIndex = 0;
    clone.querySelector('input').value = '';

    container.appendChild(clone);
  });

  // Event delegation untuk hapus baris
  document.getElementById('sarana-container').addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-sarana')) {
      const groups = document.querySelectorAll('.sarana-group');
      if (groups.length > 1) {
        e.target.closest('.sarana-group').remove();
      }
    }
  });
</script>
