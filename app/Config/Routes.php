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

    //http://localhost:8081/api/tipo_transaccion
    $routes->get('tipo_transaccion', 'tipo_transaccion::index');

    $routes->post('tipo_transaccion/create', 'tipo_transaccion::create');
    $routes->get('tipo_transaccion/edit/(:num)', 'tipo_transaccion::edit/$1');
    $routes->put('tipo_transaccion/update/(:num)', 'tipo_transaccion::update/$1');
    $routes->delete('tipo_transaccion/delete/(:num)', 'tipo_transaccion::delete/$1');

    //http://localhost:8081/api/transaccion
    $routes->get('transaccion', 'transaccion::index');

    $routes->post('transaccion/create', 'transaccion::create');
    $routes->get('transaccion/edit/(:num)', 'transaccion::edit/$1');
    $routes->put('transaccion/update/(:num)', 'transaccion::update/$1');
    $routes->delete('transaccion/delete/(:num)', 'transaccion::delete/$1');



});
