<?php
session_start();

// INITIALISE L'AUTOLOAD, LA BASE DE DONNÉE & LE ROUTEUR //
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../models/router.php';

// INSTANCE DE LA CLASS ROUTER //
$router = new Router();

// CREATION DES ROUTES POUR LES DIFFÉRENTES PAGES //
$router->addRoute('/', 'Pages', 'home');

// CREATION DES ROUTES POUR L'UTILISATEUR (INSCRIPTION, CONNEXION, DECONNEXION) //
$router->addRoute('/inscription', 'Registration', 'registration');
$router->addRoute('/connexion', 'Login', 'login');
$router->addRoute('/deconnexion', 'Logout', 'logout');

// CREATION DES ROUTES POUR LE TEST //
$router->addRoute('/test-php', 'Pages', 'testPhp');
$router->addRoute('/test-database', 'Pages', 'testDatabase');

// ROUTE LA REQUETE HTTP VERS LE CONTROLEUR ET L'ACTION CORRESPONDANTS //
$router->dispatch();

