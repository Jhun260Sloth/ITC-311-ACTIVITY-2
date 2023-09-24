<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MusicController::home');

$routes->get('/player', 'MusicController::home');

$routes->post('/insert', 'MusicController::insert');
