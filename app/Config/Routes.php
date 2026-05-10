<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\EtudiantController;
use App\Controllers\NotesController;

/**
 * @var RouteCollection $routes
 */

// Route par défaut
$routes->get('/', function() {
    return redirect()->to('/login');
});

$routes->get('login', 'AuthController::form');
$routes->post('login', 'AuthController::login');
$routes->get('inscription', 'InscriptionController::index');
$routes->post('inscription/store', 'InscriptionController::store');
$routes->get('inscription/etape2', 'InscriptionController::etape2');
$routes->post('inscription/finaliser', 'InscriptionController::finaliser');
$routes->get('inscription/choix_objectif', 'InscriptionController::choixObjectif');
$routes->post('inscription/save_objectif', 'InscriptionController::saveObjectif');


$routes->group('',['filter' => 'auth'], function($routes) {
    $routes->get('profil', 'InscriptionController::profil');
    $routes->get('profil/modifier', 'InscriptionController::edit');
    $routes->post('profil/modifier', 'InscriptionController::update');
    $routes->get('suggestions', 'SuggestionController::index');
    $routes->get('suggestions/export-pdf', 'SuggestionController::exportPdf');
    $routes->post('suggestions/export-pdf', 'SuggestionController::exportPdf');
    $routes->post('souscrire', 'SuggestionController::souscrire');
    $routes->get('gold', 'GoldController::index');
    $routes->get('gold/activer', 'GoldController::activerForm');
    $routes->post('gold/activer', 'GoldController::activer');
    $routes->get('logout', 'AuthController::logout');
    $routes->get('ajoutArgent' , 'CreditController::index');
    $routes->post('traitementCredit' , 'CreditController::ajoutCredit');
});
?>