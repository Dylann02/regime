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

// Routes protégées par filtre admin
$routes->group('', ['filter' => 'admin'], function($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('admin/regimes', 'RegimeController::index');
    $routes->get('admin/regimes/create', 'RegimeController::create');
    $routes->post('admin/regimes/store', 'RegimeController::store');
    $routes->get('admin/regimes/edit/(:num)', 'RegimeController::edit/$1');
    $routes->post('admin/regimes/update/(:num)', 'RegimeController::update/$1');
    $routes->post('admin/regimes/delete/(:num)', 'RegimeController::delete/$1');
    $routes->get('admin/activites', 'ActiviteController::index');
    $routes->get('admin/activites/create', 'ActiviteController::create');
    $routes->post('admin/activites/store', 'ActiviteController::store');
    $routes->get('admin/activites/edit/(:num)', 'ActiviteController::edit/$1');
    $routes->post('admin/activites/update/(:num)', 'ActiviteController::update/$1');
    $routes->post('admin/activites/delete/(:num)', 'ActiviteController::delete/$1');
    // Paramètres globaux (price gold, remise, etc.)
    $routes->get('admin/parametres', 'ParametreController::index');
    $routes->get('admin/parametres/create', 'ParametreController::create');
    $routes->post('admin/parametres/store', 'ParametreController::store');
    $routes->get('admin/parametres/edit/(:any)', 'ParametreController::edit/$1');
    $routes->post('admin/parametres/update/(:any)', 'ParametreController::update/$1');
    $routes->post('admin/parametres/delete/(:any)', 'ParametreController::delete/$1');
});

// Routes protégées par filtre auth (utilisateurs normaux)
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('logout', 'AuthController::logout');
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
    $routes->get('ajoutArgent' , 'CreditController::index');
    $routes->post('traitementCredit' , 'CreditController::ajoutCredit');
});
?>