<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
  <h2>Dashboard</h2>
  
  <div class="row">
    <!-- Jumlah Gedung -->
    <div class="col-md-3">
      <div class="card text-white bg-primary mb-3">
        <div class="card-body">
          <h5 class="card-title">Jumlah Gedung</h5>
          <p class="card-text display-4"><?= $jumlahGedung ?></p>
        </div>
      </div>
    </div>

    <!-- Jumlah Ruang -->
    <div class="col-md-3">
      <div class="card text-white bg-success mb-3">
        <div class="card-body">
          <h5 class="card-title">Jumlah Ruang</h5>
          <p class="card-text display-4"><?= $jumlahRuang ?></p>
        </div>
      </div>
    </div>

    <!-- Jumlah Sarana -->
    <div class="col-md-3">
      <div class="card text-white bg-warning mb-3">
        <div class="card-body">
          <h5 class="card-title">Jumlah Sarana</h5>
          <p class="card-text display-4"><?= $jumlahSarana ?></p>
        </div>
      </div>
    </div>

    <!-- Jumlah Peminjaman -->
    <div class="col-md-3">
      <div class="card text-white bg-danger mb-3">
        <div class="card-body">
          <h5 class="card-title">Jumlah Peminjaman</h5>
          <p class="card-text display-4"><?= $jumlahPeminjaman ?></p>
        </div>
      </div>
    </div>
  </div>
  <!-- Filter Tanggal -->
  <div class="row">
    <div class="col">
      <label>Dari:</label>
      <input type="date" id="tanggalMulai" class="form-control">
    </div>
    <div class="col">
      <label>Sampai:</label>
      <input type="date" id="tanggalAkhir" class="form-control">
    </div>
    <div class="col d-flex align-items-end">
      <button onclick="tampilkanData()" class="btn btn-primary">Tampilkan</button>
    </div>
  </div>

  <div class="card mt-4">
  <div class="card-header">
    <h4 class="card-title">Ruang Paling Sering Dipinjam</h4>
  </div>
  <div class="card-body" style="position: relative;">
    <canvas id="grafikRuang" height="100"></canvas>
    <div id="pesanKosongBar" class="text-center text-danger"
         style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); display:none;">
      Tidak ada data peminjaman pada tanggal tersebut.
    </div>
  </div>
</div>
<div class="card mt-4">
  <div class="card-header">
    <h4 class="card-title">Distribusi Jenis Fasilitas (Pie Chart)</h4>
  </div>
  <div class="card-body" style="position: relative;">
    <div style="width: 400px; height: 400px; margin: 0 auto;">
      <canvas id="pieChart"></canvas>
    </div>
    <div id="pesanKosongPie" class="text-center text-danger"
         style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); display:none;">
      Tidak ada data fasilitas pada tanggal tersebut.
    </div>
  </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  let barChart, pieChart;

  function tampilkanData() {
    const tanggalMulai = document.getElementById('tanggalMulai').value;
    const tanggalAkhir = document.getElementById('tanggalAkhir').value;

    // ========== BAR CHART ==========
    fetch(`<?= base_url('dashboard/grafik') ?>?tanggal_mulai=${tanggalMulai}&tanggal_akhir=${tanggalAkhir}`)
      .then(response => response.json())
      .then(data => {
        const ctx = document.getElementById('grafikRuang').getContext('2d');
        if (barChart) barChart.destroy();

        // ➤ Tampilkan atau sembunyikan pesan kosong
        if (data.labels.length === 0) {
          document.getElementById('pesanKosongBar').style.display = 'block';
        } else {
          document.getElementById('pesanKosongBar').style.display = 'none';
        }

        barChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: data.labels,
            datasets: [{
              label: 'Jumlah Peminjaman',
              data: data.jumlah,
              backgroundColor: '#007bff'
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              y: { beginAtZero: true, ticks: { precision: 0 } }
            }
          }
        });
      });

    // ========== PIE CHART ==========
    fetch(`<?= base_url('dashboard/piedata') ?>?tanggal_mulai=${tanggalMulai}&tanggal_akhir=${tanggalAkhir}`)
      .then(response => response.json())
      .then(data => {
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        if (pieChart) pieChart.destroy();

        // ➤ Tampilkan atau sembunyikan pesan kosong
        if (data.labels.length === 0) {
          document.getElementById('pesanKosongPie').style.display = 'block';
        } else {
          document.getElementById('pesanKosongPie').style.display = 'none';
        }

        pieChart = new Chart(pieCtx, {
          type: 'pie',
          data: {
            labels: data.labels,
            datasets: [{
              data: data.data.map(Number),
              backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.7)'
              ],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
          }
        });
      });
  }

  // Auto tampil saat pertama buka
  window.onload = tampilkanData;
</script>

</div>

<?= $this->endSection(); ?>
