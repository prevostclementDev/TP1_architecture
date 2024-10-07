<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/users/(:num)', 'Users::get/$1');
$routes->post('/users', 'Users::create');
$routes->delete('/users/(:num)', 'Users::delete/$1');
$routes->put('/users/(:num)', 'Users::update/$1');
