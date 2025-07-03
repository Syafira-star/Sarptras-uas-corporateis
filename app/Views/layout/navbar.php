<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2"> 
  <div class="container-fluid">
    <div class="navbar-nav ml-auto">
      <div class="d-flex align-items-center">
        <i class="fas fa-user-circle text-white mr-2"></i>
        <span class="text-white"><?= session()->get('username') ?></span>
      </div>
    </div>
  </div>
</nav>
