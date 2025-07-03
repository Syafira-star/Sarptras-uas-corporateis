<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Penggunaan Fasilitas</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
      margin: 20px;
    }

    h2, p {
      text-align: center;
      margin: 5px 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #000;
      padding: 6px 10px;
      text-align: left;
    }

    .footer {
      margin-top: 80px;
      display: flex;
      justify-content: space-between;
      padding: 0 60px;
    }

    .ttd {
      text-align: center;
    }

    .date {
      margin-top: 10px;
      text-align: right;
      margin-right: 20px;
    }

    .btn-print {
      display: inline-block;
      margin-bottom: 20px;
      padding: 8px 16px;
      background-color: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-size: 14px;
    }

    .btn-print i {
      margin-right: 5px;
    }

    @media print {
      .btn-print {
        display: none;
      }

      @page {
        size: A4 portrait;
        margin: 20mm;
      }

      body {
        font-size: 12pt;
      }

      .footer {
        margin-top: 100px;
      }
    }
  </style>
</head>
<body>

  <a href="#" onclick="window.print()" class="btn-print">
    <i class="fas fa-print"></i> Cetak Laporan
  </a>

  <h2>Laporan Penggunaan Fasilitas Kampus</h2>
  <p><?= date('d M Y', strtotime($tanggal_mulai)) ?> - <?= date('d M Y', strtotime($tanggal_akhir)) ?></p>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Instansi</th>
        <th>Tanggal</th>
        <th>Waktu</th>
        <th>Sarana</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; foreach ($peminjaman as $p) : ?>
        <?php foreach ($p['sarana'] as $s) : ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= esc($p['nama_penanggung_jawab']) ?></td>
          <td><?= esc($p['instansi']) ?></td>
          <td><?= esc($p['tanggal_peminjaman']) ?></td>
          <td><?= esc($p['waktu_mulai']) ?> - <?= esc($p['waktu_selesai']) ?></td>
          <td><?= esc($s['nama_sarana']) ?></td>
          <td><?= esc($s['jumlah']) ?></td>
        </tr>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </tbody>
  </table>

  <p class="date">
    Dicetak pada: <?= date('d M Y') ?>
  </p>

  <div class="footer">
    <div class="ttd">
      Mengetahui,<br><br><br><br>
      _______________________
    </div>
    <div class="ttd">
      Pemroses Laporan<br><br><br><br>
      _______________________
    </div>
  </div>
</body>
</html>
