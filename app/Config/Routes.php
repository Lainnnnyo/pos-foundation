<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('about', 'Home::about');
$routes->get('profile', 'Home::profile');
$routes->get('tasks', 'Tasks::index');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attempt');
$routes->post('logout', 'Auth::logout', ['filter' => 'auth']);

$routes->group('tasks', ['filter' => 'auth'], static function ($routes) {
    $routes->get('new', 'Tasks::new');
    $routes->post('/', 'Tasks::create');
    $routes->get('(:num)/edit', 'Tasks::edit/$1');
    $routes->post('(:num)/edit', 'Tasks::update/$1');
    $routes->post('(:num)/archive', 'Tasks::archive/$1');
});

$routes->group('customers', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Customers::index');
    $routes->get('new', 'Customers::new');
    $routes->post('/', 'Customers::create');
    $routes->get('(:num)/edit', 'Customers::edit/$1');
    $routes->post('(:num)/edit', 'Customers::update/$1');
});
$routes->group('users', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Users::index');
    $routes->get('new', 'Users::new');
    $routes->post('/', 'Users::create');
    $routes->get('(:num)/edit', 'Users::edit/$1');
    $routes->post('(:num)/edit', 'Users::update/$1');
});
