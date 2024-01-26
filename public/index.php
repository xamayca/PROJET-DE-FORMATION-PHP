<?php
session_start();

// INITIALISE L'AUTOLOAD, LA BASE DE DONNÉE & LE ROUTEUR //
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../models/router.php';

// INSTANCE DE LA CLASS ROUTER //
$router = new Router();

// CREATION DES ROUTES POUR LES DIFFÉRENTES PAGES //
$router->addRoute('/', 'Pages', 'home');

// CREATION DES ROUTES POUR ACCOUNT //
$router->addRoute('/inscription', 'Users', 'registration');


// CREATION D'UNE ROUTE POUR GÉRER LES ERREURS DE CONNEXION A LA BASE DE DONNÉES //
$router->addRoute('/erreur-database', 'Errors', 'databaseError');

// CREATION DES ROUTES POUR LE TEST //
$router->addRoute('/test-php', 'Pages', 'testPhp');
$router->addRoute('/test-database', 'Pages', 'testDatabase');

// APPEL LES VUES HEADER & FOOTER + VUE INTERMÉDIAIRE //
require_once "../views/elements/header.php";
$router->dispatch();
require_once "../views/elements/footer.php";
