<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?? 'Sistem Sarpras' ?></title>
  <!-- Atlantis CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Sevillana&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('atlantis/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('atlantis/css/atlantis.min.css') ?>">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Tambahan CSS lain jika perlu -->
  <style>
    body {
      margin: 0;
      padding: 0;
    }

    body, .nav-link, .sidebar .nav {
      font-family: 'Comfortaa', cursive;
    }

    .main-wrapper {
      display: flex;
    }

    .nav-link {
      padding-top: 20px;
      padding-bottom: 10px;
    }

    .sidebar {
      width: 250px;
      height: 100vh;
      position: fixed;
      top: 56px; /* tinggi navbar */
      left: 0;
      background-color: #1a2035;
      overflow-y: auto;
      z-index: 1030;
    }
    .main-content {
      margin-left: 225px;
      padding: 80px 40px 20px 40px; /* kiri-kanan tambah jarak */
      flex-grow: 1;
    }

    .navbar-custom {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1040;
    }

    body.sidebar-hidden .main-content {
      margin-left: 0 !important;
    }

  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-custom">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
      <!-- Logo atau Nama Aplikasi -->
      <span class="navbar-brand mb-0 h1 mr-3" style="font-family: 'Sevillana', cursive;">Sarpras</span>
    <!-- Tombol toggle sidebar -->
      <button class="btn btn-link text-white p-0" id="toggleSidebar">
        <i class="fas fa-bars fa-lg"></i>
      </button>
    </div>
    <div class="ml-auto">
      <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-user-circle"></i> <?= session()->get('username') ?>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="<?= base_url('akun') ?>">Akun Saya</a>
        </div>
      </div>
    </div>
  </div>
</nav>
  <div class="main-wrapper">
    <!-- SIDEBAR -->
    <?php include('sidebar.php'); ?>

    <!-- MAIN CONTENT -->
    <div class="main-content">
      <?= $this->renderSection('content'); ?>
    </div>
  </div>

  <!-- Atlantis JS -->
  <script src="<?= base_url('atlantis/js/core/jquery.3.2.1.min.js') ?>"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
  <script src="<?= base_url('atlantis/js/core/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('atlantis/js/atlantis.min.js') ?>"></script>
  <script>
    document.getElementById('toggleSidebar').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    const body = document.body;
    
    sidebar.classList.toggle('d-none');
    body.classList.toggle('sidebar-hidden');
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>