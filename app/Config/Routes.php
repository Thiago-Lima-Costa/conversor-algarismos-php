<?php

use App\Controllers\ConversorController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [ConversorController::class, 'index'], ['as' => 'conversor']);
$routes->get('romano-para-arabico', [ConversorController::class, 'converterParaArabico'], ['as' => 'conversor.arabicos']);
$routes->get('arabico-para-romano', [ConversorController::class, 'converterParaRomano'], ['as' => 'conversor.romanos']);
