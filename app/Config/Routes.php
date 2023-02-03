<?php

namespace Config;

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

//Routes Supplier
$routes->get('supplier', 'SupplierController::index', ['filter' => 'role:admin,owner']);
$routes->post('supplier', 'SupplierController::index', ['filter' => 'role:admin,owner']); //to search
$routes->post('supplier/store', 'SupplierController::store', ['filter' => 'role:admin']);
$routes->put('supplier/update/(:num)', 'SupplierController::update/$1', ['filter' => 'role:admin']);
$routes->delete('supplier/destroy/(:num)', 'SupplierController::destroy/$1', ['filter' => 'role:admin']);

//Routes Profile
$routes->get('profile', 'ProfileController::index');
$routes->post('profile/(:num)', 'ProfileController::update/$1');

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


//Routes Penjualan
$routes->get('penjualan', 'PenjualanController::index');

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
