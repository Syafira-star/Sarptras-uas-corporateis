<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false); // ⬅️ Ini PENTING

$routes->get('/', 'Login::index');

$routes->get('dashboard', 'Dashboard::index', ['filter' => 'login']);
$routes->get('dashboard/grafik', 'Dashboard::getGrafik');

$routes->get('profil', 'Profil::index', ['filter' => 'login']);
$routes->get('master-data', 'MasterData::index', ['filter' => 'login']);
$routes->get('peminjaman', 'Peminjaman::index', ['filter' => 'login']);
$routes->get('transaksi', 'Transaksi::index', ['filter' => 'login']);
$routes->get('laporan', 'Laporan::index', ['filter' => 'login']);
$routes->get('history', 'History::index', ['filter' => 'login']);
$routes->get('pengaturan', 'Pengaturan::index', ['filter' => 'login']);

$routes->get('kategori-ruangan', 'KategoriRuangan::index', ['filter' => 'login']);
$routes->get('kategori-ruangan/create', 'KategoriRuangan::create', ['filter' => 'login']);
$routes->post('kategori-ruangan/store', 'KategoriRuangan::store', ['filter' => 'login']);
$routes->get('kategori-ruangan/edit/(:num)', 'KategoriRuangan::edit/$1', ['filter' => 'login']);
$routes->post('kategori-ruangan/update/(:num)', 'KategoriRuangan::update/$1', ['filter' => 'login']);
$routes->get('kategori-ruangan/delete/(:num)', 'KategoriRuangan::delete/$1', ['filter' => 'login']);

$routes->get('kategori-pinjaman', 'KategoriPinjaman::index', ['filter' => 'login']);
$routes->get('kategori-pinjaman', 'KategoriPinjaman::index', ['filter' => 'login']);
$routes->get('kategori-pinjaman/create', 'KategoriPinjaman::create', ['filter' => 'login']);
$routes->post('kategori-pinjaman/store', 'KategoriPinjaman::store', ['filter' => 'login']);
$routes->get('kategori-pinjaman/edit/(:num)', 'KategoriPinjaman::edit/$1', ['filter' => 'login']);
$routes->post('kategori-pinjaman/update/(:num)', 'KategoriPinjaman::update/$1', ['filter' => 'login']);
$routes->get('kategori-pinjaman/delete/(:num)', 'KategoriPinjaman::delete/$1', ['filter' => 'login']);

$routes->get('gedung', 'Gedung::index', ['filter' => 'login']);
$routes->get('gedung/create', 'Gedung::create', ['filter' => 'login']);
$routes->post('gedung/store', 'Gedung::store', ['filter' => 'login']);
$routes->get('gedung/edit/(:num)', 'Gedung::edit/$1', ['filter' => 'login']);
$routes->post('gedung/update/(:num)', 'Gedung::update/$1', ['filter' => 'login']);
$routes->get('gedung/delete/(:num)', 'Gedung::delete/$1', ['filter' => 'login']);

$routes->get('gedung/(:num)/ruang', 'Gedung::lihatRuang/$1', ['filter' => 'login']);
$routes->get('ruang/create/(:num)', 'Ruang::create/$1', ['filter' => 'login']);
$routes->post('ruang/store/(:num)', 'Ruang::store/$1', ['filter' => 'login']);
$routes->get('ruang/(:num)/(:num)/edit', 'Ruang::edit/$1/$2'); // gedung_id, ruang_id
$routes->post('ruang/(:num)/(:num)/update', 'Ruang::update/$1/$2'); // untuk simpan editan
$routes->post('ruang/(:num)/(:num)/delete', 'Ruang::delete/$1/$2');

$routes->get('sarana', 'Sarana::index');
$routes->get('sarana/create', 'Sarana::create');
$routes->post('sarana/store', 'Sarana::store');
$routes->get('sarana/edit/(:num)', 'Sarana::edit/$1');
$routes->post('sarana/update/(:num)', 'Sarana::update/$1');
$routes->post('sarana/delete/(:num)', 'Sarana::delete/$1');
$routes->get('ruang/(:num)/(:num)/sarana', 'Ruang::sarana/$1/$2');
$routes->get('ruang/(:num)/(:num)/sarana/create', 'Ruang::createSarana/$1/$2');
$routes->post('ruang/(:num)/(:num)/sarana/store', 'Ruang::storeSarana/$1/$2');
$routes->get('ruang/(:num)/(:num)/sarana/edit/(:num)', 'Ruang::editSarana/$1/$2/$3');
$routes->post('ruang/(:num)/(:num)/sarana/update/(:num)', 'Ruang::updateSarana/$1/$2/$3');
$routes->post('ruang/(:num)/(:num)/sarana/delete/(:num)', 'Ruang::deleteSarana/$1/$2/$3');

$routes->get('login', 'Login::index');
$routes->post('login/process', 'Login::process');
$routes->get('logout', 'Login::logout');

$routes->get('form-peminjaman', 'Peminjaman::form');
$routes->post('peminjaman/simpan', 'Peminjaman::simpan');

$routes->get('permohonan', 'Permohonan::index');
$routes->post('permohonan/simpan', 'Permohonan::simpan');
$routes->get('peminjaman', 'Peminjaman::index'); // Ini memang hanya untuk admin
$routes->post('peminjaman/terima/(:num)', 'Peminjaman::terima/$1');
$routes->post('peminjaman/tolak/(:num)', 'Peminjaman::tolak/$1');

$routes->get('laporan/cetak', 'Laporan::cetak');

$routes->get('logout', 'Auth::logout');

$routes->get('dashboard/piedata', 'Dashboard::getPieData');

