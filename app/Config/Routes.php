<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MusicController::home');

$routes->get('/player', 'MusicController::home');

$routes->get('/player/(:any)', 'MusicController::home/$1');

$routes->post('/insert', 'MusicController::insert');

$routes->post('/insert2', 'MusicController::insert2');

$routes->get('/delete/(:any)', 'MusicController::delete/$1');

$routes->get('/search', 'MusicController::search');