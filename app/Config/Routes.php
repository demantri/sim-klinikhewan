<?php

namespace Config;

use App\Controllers\SendEmail;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->get('login', 'Login::index');
$routes->add('doLogin', 'Login::doLogin');
$routes->add('logout', 'Login::logout');

$routes->get('forgot-password', 'Login::form_forgot_password');
$routes->add('forgot-password', 'Login::forgot_password');
$routes->add('find-username', 'Login::find_username');

$routes->get('register', 'Login::form_register');
$routes->add('register', 'Login::register');

$routes->get('form-booking', 'Booking::index');
$routes->add('booking', 'Booking::simpan');
$routes->get('daftar-booking', 'Booking::listBooking');
$routes->add('find-booking', 'Booking::getDataBooking');
$routes->add('proses-booking/(:any)', 'Booking::prosesBooking/$1');
$routes->add('proses-batal/(:any)', 'Booking::prosesBatal/$1');

// untuk grafik
$routes->get('getSpesies', 'Dashboard::getSpesies');
$routes->get('getRas', 'Dashboard::getRas');
$routes->get('getTrx', 'Dashboard::getTrx');


$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

$routes->group('masterdata', ['filter' => 'auth'], function($routes) {
    // CRUD utk master pemilik
    $routes->get('pemilik', 'Pemilik::index');
    $routes->add('pemilik/simpan', 'Pemilik::simpan');
    $routes->add('pemilik/update', 'Pemilik::update');
    $routes->add('pemilik/hapus/(:any)', 'Pemilik::hapus/$1');
    $routes->add('pemilik/confirm/(:any)', 'Pemilik::confirm/$1');

    // CRUD utk master kategori keperluan dropdown
    $routes->get('kategori', 'Kategori::index');
    $routes->add('kategori/simpan', 'Kategori::simpan');
    $routes->add('kategori/update', 'Kategori::update');
    $routes->add('kategori/hapus/(:any)', 'Kategori::hapus/$1');

    // RAS
    $routes->get('ras', 'Ras::index');
    $routes->add('ras/simpan', 'Ras::simpan');
    $routes->add('ras/update', 'Ras::update');
    $routes->add('ras/hapus/(:any)', 'Ras::hapus/$1');

    // spesies
    $routes->get('spesies', 'Spesies::index');
    $routes->add('spesies/simpan', 'Spesies::simpan');
    $routes->add('spesies/update', 'Spesies::update');
    $routes->add('spesies/hapus/(:any)', 'Spesies::hapus/$1');

    // masterdata dokter
    $routes->get('dokter', 'Dokter::index');
    $routes->add('dokter/simpan', 'Dokter::simpan');
    // $routes->add('dokter/edit/(:any)', 'Dokter::edit/$1');
    $routes->add('dokter/update', 'Dokter::update');
    $routes->add('dokter/hapus/(:any)', 'Dokter::hapus/$1');

    $routes->get('obat', 'Obat::index');
    $routes->add('obat/simpan', 'Obat::simpan');
    $routes->add('obat/update', 'Obat::update');
    $routes->add('obat/hapus/(:any)', 'Obat::hapus/$1');

    $routes->get('user', 'User::index');
    $routes->add('user/simpan', 'User::simpan');
    $routes->add('user/getUser', 'User::getUser');
    $routes->add('user/update', 'User::update');
    $routes->add('user/hapus/(:any)', 'User::hapus/$1');
    $routes->add('user/is_active/(:any)', 'User::is_active/$1');

    // hewan
    // RAS
    $routes->get('hewan', 'Hewan::index');
    $routes->add('hewan/getData', 'Hewan::getData');
    $routes->add('hewan/simpan', 'Hewan::simpan');
    $routes->add('hewan/update', 'Hewan::update');
    $routes->add('hewan/hapus/(:any)', 'Hewan::hapus/$1');
});

$routes->group('pendaftaran', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Pendaftaran::index');
    $routes->get('form/add', 'Pendaftaran::form_add');
    $routes->add('simpan', 'Pendaftaran::simpan');
    $routes->get('form/edit/(:any)', 'Pendaftaran::form_edit/$1');
    $routes->add('update', 'Pendaftaran::update');
    // $routes->add('hapus/(:any)', 'Pendaftaran::hapus/$1');
    $routes->add('hapus', 'Pendaftaran::hapus');

    $routes->add('add_detail', 'Pendaftaran::add_detail');
    $routes->add('getDetail', 'Pendaftaran::getDetail');
});

$routes->group('rekam-medis', ['filter' => 'auth'], function($routes) {
    $routes->get('input', 'RekamMedis::add');
    $routes->get('input/(:any)', 'RekamMedis::add/$1');
    $routes->get('view', 'RekamMedis::view');
    $routes->add('get-peliharaan', 'RekamMedis::get_peliharaan');
    $routes->add('simpan', 'RekamMedis::simpan');
    $routes->add('cetak', 'RekamMedis::cetak');
    $routes->add('getDetail', 'RekamMedis::getDetail');
    $routes->add('getObat', 'RekamMedis::getObat');

    $routes->get('pembayaran', 'Transaksi::index');
    $routes->add('pembayaran/add-to-detail', 'Transaksi::addToDetail');
    $routes->add('pembayaran/multiple', 'Transaksi::prosesMultiple');
    $routes->add('pembayaran/bayar', 'Transaksi::bayar');
    $routes->add('pembayaran/reset', 'Transaksi::reset');

    // cetak pdf
    $routes->add('cetakrm/(:any)', 'GeneratePDF::cetak_rm/$1');
    $routes->add('pembayaran/cetak/(:any)', 'GeneratePDF::cetak_invoice/$1');
});

$routes->group('setting', ['filter' => 'auth'], function($routes) {
    $routes->get('profile', 'Profile::index');
    $routes->add('profile/update', 'Profile::update');
    $routes->add('profile/delete-img/(:any)', 'Profile::delete_image/$1');

    // reset password
    $routes->add('profile/check-password', 'Profile::check_password');
    $routes->add('profile/reset-password', 'Profile::reset_password');
    // $routes->add('profile/check-password', 'Profile::check_password');
});

$routes->add('reset/(:any)', 'Login::reset/$1');

$routes->group('sent-email', function($routes) {
    // $routes->get('/', 'SendEmail::index');
    $routes->add('/', 'SendEmail::send_email');
});

$routes->get('read_notification', 'Dashboard::mark_as_read');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
