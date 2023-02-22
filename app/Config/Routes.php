<?php

namespace Config;

use App\Models\PenjualanModel;
use App\Models\ProduksiModel;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//Routes Dashboard
$routes->get('/', 'DashboardController::index');
$routes->post('/', 'DashboardController::index');

//Routes Supplier
$routes->get('supplier', 'SupplierController::index', ['filter' => 'role:admin,owner']);
$routes->post('supplier', 'SupplierController::index', ['filter' => 'role:admin,owner']); //to search
$routes->post('supplier/store', 'SupplierController::store', ['filter' => 'role:admin']);
$routes->post('supplier/update/(:num)', 'SupplierController::update/$1', ['filter' => 'role:admin']);
$routes->delete('supplier/destroy/(:num)', 'SupplierController::destroy/$1', ['filter' => 'role:admin']);

//Routes Profile
$routes->get('profile', 'ProfileController::index');
$routes->post('profile/(:num)', 'ProfileController::update/$1');

//Routes Users
$routes->get('users', 'UsersController::index', ['filter' => 'role:owner']);
$routes->post('users/update/(:num)', 'UsersController::update/$1', ['filter' => 'role:owner']);
$routes->post('users/passw/(:num)', 'UsersController::passw/$1', ['filter' => 'role:owner']);

//Routes Laporan Produksi
$routes->get('laporanproduksi', 'LaporanProduksiController::index', ['filter' => 'role:owner,admin']);
$routes->post('laporanproduksi', 'LaporanProduksiController::index', ['filter' => 'role:owner,admin']);
// $routes->get('/coba', function () {
//     $ProduksiModel = new ProduksiModel();
//     $data = $ProduksiModel->select('nama_brg,harga,bahan,ukuran,jmlh_brg,tgl_pro,status')->orderBy('created_at', 'desc')->findAll();
//     return view('admin/laporan/produksi/viewPrint', ['data' => $data]);
// });
$routes->post('laporanproduksi/print', 'LaporanProduksiController::print', ['filter' => 'role:owner,admin']);

//Routes Laporan Penjualan
$routes->get('laporanpenjualan', 'LaporanPenjualanController::index', ['filter' => 'role:owner,admin']);
$routes->post('laporanpenjualan', 'LaporanPenjualanController::index', ['filter' => 'role:owner,admin']);
// $routes->get('/lap/coba', function () {
//     $penjulanModel = new PenjualanModel();
//     $data = $penjulanModel->orderBy('created_at', 'desc')->findAll();
//     // dd($data);
//     return view('admin/laporan/penjualan/viewPrint', ['data' => $data]);
// });
$routes->post('laporanpenjualan/print', 'LaporanPenjualanController::print', ['filter' => 'role:owner']);

//Routes Produksi
$routes->get('produksi', 'ProduksiController::index', ['filter' => 'role:pegawai']);
$routes->post('produksi', 'ProduksiController::index', ['filter' => 'role:pegawai']); //to search
$routes->post('produksi/store', 'ProduksiController::store', ['filter' => 'role:pegawai']);
$routes->delete('produksi/destroy/(:num)', 'ProduksiController::destroy/$1', ['filter' => 'role:pegawai']);
$routes->get('produksi/detail-produksi/(:num)', 'ProduksiController::detail/$1',  ['filter' => 'role:pegawai']);
$routes->post('produksi/updateProses/(:num)', 'ProduksiController::updateProses/$1', ['filter' => 'role:pegawai']);
$routes->post('produksi/update/(:num)', 'ProduksiController::update/$1', ['filter' => 'role:pegawai']);

//Routes Opname
$routes->get('opname', 'OpnameController::index', ['filter' => 'role:pegawai']);
$routes->post('opname', 'OpnameController::index', ['filter' => 'role:pegawai']); //to search
$routes->post('opname/store', 'OpnameController::store', ['filter' => 'role:pegawai']);
$routes->post('opname/update/(:num)', 'OpnameController::update/$1', ['filter' => 'role:pegawai']);

//Routes Etalase
$routes->get('etalase', 'EtalaseController::index', ['filter' => 'role:pegawai']);
$routes->post('etalase', 'EtalaseController::index', ['filter' => 'role:pegawai']); //to search
$routes->post('etalase/store', 'EtalaseController::store', ['filter' => 'role:pegawai']);
$routes->post('etalase/update/(:num)', 'EtalaseController::update/$1', ['filter' => 'role:pegawai']);


//Routes Penjualan
$routes->get('penjualan', 'PenjualanController::index', ['filter' => 'role:admin,owner']);
$routes->post('penjualan', 'PenjualanController::index', ['filter' => 'role:admin,owner']); //to search
$routes->get('penjualan/getdata', 'PenjualanController::getdata', ['filter' => 'role:admin,owner']);
$routes->post('penjualan/store', 'PenjualanController::store', ['filter' => 'role:admin']);
$routes->post('penjualan/update/(:num)', 'PenjualanController::update/$1', ['filter' => 'role:admin']);
$routes->delete('penjualan/destroy/(:num)', 'PenjualanController::destroy/$1', ['filter' => 'role:admin']);

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
