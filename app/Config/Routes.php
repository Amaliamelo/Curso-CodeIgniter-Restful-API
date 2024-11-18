<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// http://localhost:8081/api
$routes->group('api',['namespace' => 'App\Controllers\API'], function($routes){
    // http://localhost:8081/api/clientes --> GET
    $routes->get('clientes', 'Clientes::index');

    $routes->post('clientes/create', 'Clientes::create');
    $routes->get('clientes/edit/(:num)', 'Clientes::edit/$1');
    $routes->put('clientes/update/(:num)', 'Clientes::update/$1');
    $routes->delete('clientes/delete/(:num)', 'Clientes::delete/$1');

    //http://localhost:8081/api/cuentas
    $routes->get('cuentas', 'Cuentas::index');

    $routes->post('cuentas/create', 'Cuentas::create');
    $routes->get('cuentas/edit/(:num)', 'Cuentas::edit/$1');
    $routes->put('cuentas/update/(:num)', 'Cuentas::update/$1');
    $routes->delete('cuentas/delete/(:num)', 'Cuentas::delete/$1');

    //http://localhost:8081/api/cuentas
    $routes->get('TiposTransaccion', 'TiposTransaccion::index');

    $routes->post('TiposTransaccion/create', 'TiposTransaccion::create');
    $routes->get('TiposTransaccion/edit/(:num)', 'TiposTransaccion::edit/$1');
    $routes->put('TiposTransaccion/update/(:num)', 'TiposTransaccion::update/$1');
    $routes->delete('TiposTransaccion/delete/(:num)', 'TiposTransaccion::delete/$1');

    //http://localhost:8081/api/cuentas
    $routes->get('Transacciones', 'Transacciones::index');

    $routes->post('Transacciones/create', 'Transacciones::create');
    $routes->get('Transacciones/edit/(:num)', 'Transacciones::edit/$1');
    $routes->put('Transacciones/update/(:num)', 'Transacciones::update/$1');
    $routes->delete('Transacciones/delete/(:num)', 'Transacciones::delete/$1');



});
