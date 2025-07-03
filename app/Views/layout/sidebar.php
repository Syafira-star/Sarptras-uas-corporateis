
<div class="bg-primary text-white p-3 position-fixed" style="width: 250px; height: 100vh; overflow-y: auto;" id="sidebar">
  <h5 class="mb-4">Menu Sidebar</h5>
  <ul class="nav flex-column">

    <li class="nav-item">
      <a class="nav-link text-white" href="<?= base_url('dashboard') ?>">
        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
      </a>
    </li>
    <!-- Master Data Dropdown -->
    <li class="nav-item">
      <a class="nav-link text-white" data-toggle="collapse" href="#masterData" role="button" aria-expanded="false" aria-controls="masterData">
        <i class="fas fa-layer-group mr-2"></i> Master Data
        <i class="fas fa-chevron-down float-right mt-1"></i>
      </a>
      <div class="collapse pl-3" id="masterData">
        <ul class="nav flex-column mt-2">
          <li class="nav-item">
            <a class="nav-link text-white-50" href="<?= base_url('kategori-ruangan') ?>">Kategori Ruangan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white-50" href="<?= base_url('kategori-pinjaman') ?>">Kategori Pinjaman</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white-50" href="<?= base_url('gedung') ?>">Gedung</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white-50" href="<?= base_url('sarana') ?>">Sarana</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white" href="<?= base_url('peminjaman') ?>">
        <i class="fas fa-calendar-check mr-2"></i> Data Peminjaman
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="<?= base_url('laporan') ?>">
        <i class="fas fa-file-alt mr-2"></i> Laporan
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="<?= base_url('logout') ?>">
        <i class="fas fa-sign-out-alt mr-2"></i> Logout
      </a>
    </li>
  </ul>
</div>
