<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Pages::index');
$routes->get('about', 'Pages::about');
$routes->get('login', 'Auth::loginForm');
$routes->post('login', 'Auth::login');
$routes->post('logout', 'Auth::logout', ['filter' => 'auth']);

// Protect both the pages and the POST actions that change account records.
$protected = ['filter' => 'auth'];
$routes->get('customers', 'Customers::index', $protected);
$routes->get('customers/new', 'Customers::newForm', $protected);
$routes->post('customers/new', 'Customers::create', $protected);
$routes->get('customers/(:num)/edit', 'Customers::edit/$1', $protected);
$routes->post('customers/(:num)/edit', 'Customers::update/$1', $protected);

$routes->get('users', 'Users::index', $protected);
$routes->get('users/new', 'Users::newForm', $protected);
$routes->post('users/new', 'Users::create', $protected);
$routes->get('users/(:num)/edit', 'Users::edit/$1', $protected);
$routes->post('users/(:num)/edit', 'Users::update/$1', $protected);
