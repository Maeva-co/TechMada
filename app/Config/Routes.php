<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AuthController::form');
$routes->get('auth/login', 'AuthController::form');

$routes->post('auth/login', 'AuthController::login');

$routes->get('auth/logout', 'AuthController::logout', ['filter' => 'auth']);

// Routes employé (authentifié + rôle)
$routes->group('employe', ['filter' => ['auth', 'role:employe']], function($routes) {
    $routes->get('dashboard', 'EmployeController::dashboard');
    $routes->get('create', 'EmployeController::create');
    $routes->post('store', 'EmployeController::store');
    $routes->get('index', 'EmployeController::index');
    $routes->get('cancel/(:num)', 'EmployeController::cancel/$1');
});

// Routes RH (authentifié + rôle)
$routes->group('rh', ['filter' => ['auth', 'role:rh']], function($routes) {
    $routes->get('dashboard', 'RhController::index');
    $routes->get('conges/approuver', 'RhController::approuver');
});

// Routes admin (authentifié + rôle)
$routes->group('admin', ['filter' => ['auth', 'role:admin']], function($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('employes', 'AdminController::employes');
    $routes->post('employes/create', 'AdminController::createEmploye');
});



