<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('auth/login', 'AuthController::login');

$routes->get('/employe/dashboard', 'EmployeController::dashboard');
$routes->get('/employe/create', 'EmployeController::create');
$routes->get('/employe/index', 'EmployeController::index');

$routes->get('/rh/index', 'RhController::index');

$routes->get('/admin/dashboard', 'AdminController::dashboard');
$routes->get('/admin/employes', 'AdminController::employes');



