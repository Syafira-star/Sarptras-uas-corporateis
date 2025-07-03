<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php if (!session()->get('logged_in')): ?>
  <div class="alert alert-warning">Anda belum login.</div>
<?php else: ?>
  <div class="alert alert-success">Login sebagai: <?= session()->get('username') ?></div>
<?php endif; ?>

<h2>Dashboard</h2>
<p>Selamat datang di sistem sarpras kampus!</p>

<?= $this->endSection() ?>
