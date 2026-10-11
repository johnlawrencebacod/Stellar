<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/loggedin', 'loggedin::home');
$routes->get('register', 'Registration::index');
$routes->post('register/save', 'Registration::save');