<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes);

$routes->get('users', 'UsersController::index', ['as' => 'users.index']);
$routes->get('users/(:num)', 'UsersController::show/$1', ['as' => 'users.show']);
