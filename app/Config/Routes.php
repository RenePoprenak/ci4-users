<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// protected homepage
$routes->get('/', 'Home::index', ['filter' => 'auth.redirect']);

// admin section (for now placeholder)
$routes->group('admin', ['filter' => 'auth.redirect'], static function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index');
});

// Shield auth routes (/login, /logout, /register ...)
service('auth')->routes($routes);

// other routes
$routes->get('users', 'UsersController::index', ['as' => 'users.index', 'filter' => 'auth.redirect']);
$routes->get('users/(:num)', 'UsersController::show/$1', ['as' => 'users.show', 'filter' => 'auth.redirect']);
