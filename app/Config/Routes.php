<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('auth/login', 'AuthController::login');

$routes->group('employe', function($routes) {
    $routes->get('dashboard', 'EmployeController::dashboard');
    $routes->get('create', 'EmployeController::create');
    $routes->get('index', 'EmployeController::index');
});

$routes->group('rh', function($routes) {
    $routes->get('index', 'RhController::index');
});

$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('employes', 'AdminController::employes');
});



