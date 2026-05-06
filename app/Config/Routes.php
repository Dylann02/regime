<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\EtudiantController;
use App\Controllers\NotesController;

/**
 * @var RouteCollection $routes
 */

$routes->group("etudiants", function($routes){
    $routes->get("/", "EtudiantController::liste");
});

$routes->group("notes", function($routes){
    $routes->get("/create", "NotesController::create");
    $routes->post("/store", "NotesController::store");
});