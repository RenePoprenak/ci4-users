<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// protected homepage
$routes->get('/', 'Home::index', ['filter' => 'admin.only', 'as'=> 'home']);

$routes->get('patients', 'Home::patients', ['filter' => 'admin.only', 'as' => 'patients']);
$routes->get('patients/table', 'Home::patientsTable', ['filter' => 'admin.only', 'as' => 'patients.table']);
$routes->get('patients/(:num)', 'Home::patientDetail/$1', ['filter' => 'admin.only', 'as' => 'patients.detail']);

// admin section
$routes->group('admin', ['filter' => 'admin.only'], static function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index', ['as' => 'admin.dashboard']);

    $routes->get('patients', 'Admin\PatientsController::index', ['as' => 'admin.patients']);
    $routes->get('patients/table', 'Admin\PatientsController::table', ['as' => 'admin.patients.table']);

    // modal partials + actions
    $routes->get('patients/create', 'Admin\PatientsController::create', ['as' => 'admin.patients.create']);
    $routes->post('patients', 'Admin\PatientsController::store', ['as' => 'admin.patients.store']);

    $routes->get('patients/(:num)/edit', 'Admin\PatientsController::edit/$1', ['as' => 'admin.patients.edit']);
    $routes->post('patients/(:num)', 'Admin\PatientsController::update/$1', ['as' => 'admin.patients.update']);
});

// Shield auth routes (/login, /logout, /register ...)
service('auth')->routes($routes);

// other routes
$routes->post('ui/toast', 'UiController::toast');

