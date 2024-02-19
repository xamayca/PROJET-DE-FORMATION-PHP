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
$router->addRoute('/inscription', 'User', 'registration');
$router->addRoute('/connexion', 'User', 'login');
$router->addRoute('/profil', 'User', 'profile');
$router->addRoute('/deconnexion', 'User', 'logout');

// CREATION DES ROUTES POUR LA PAGE PANEL ADMINISTRATEUR //
$router->addRoute('/admin', 'Admin', 'adminPanel');

// CREATION DES ROUTES POUR LES ARTICLES //
$router->addRoute('/article', 'Articles', 'createArticle');

// CREATION DES ROUTES POUR LE TEST //
$router->addRoute('/php-test', 'Pages', 'testPhp');
$router->addRoute('/database-test', 'Pages', 'testDatabase');

// ROUTE LA REQUETE HTTP VERS LE CONTROLEUR ET L'ACTION CORRESPONDANTS //
$router->dispatch();

