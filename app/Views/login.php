<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Sistem Sarpras</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-body">
            <h4 class="text-center mb-4">Login</h4>

            <?php if (session()->getFlashdata('error')) : ?>
              <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
              </div>
            <?php endif; ?>


            <form action="<?= base_url('login/process') ?>" method="post">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" required autofocus>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
              <div class="text-center mt-3">
                <a href="<?= base_url('form-peminjaman') ?>" class="btn btn-sm btn-outline-primary">
                  Ajukan Peminjaman Fasilitas
                </a>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
