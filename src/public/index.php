<?php

session_start();

require_once '../app/Core/Router.php';
require_once '../app/Models/Cities.php';
require_once '../app/Models/Offer.php';
require_once '../app/Core/Database.php';
require_once '../app/Core/View.php';
require_once '../app/Controllers/OfferController.php';
require_once '../app/Controllers/AuthController.php';
require_once '../app/Models/User.php';


use App\Controllers\AuthController;
use App\Controllers\OfferController;
use App\Core\Router;


$router = new Router();

$router->add('home', AuthController::class, 'start');
$router->add('login', AuthController::class, 'login');
$router->add('login-submit', AuthController::class, 'loginSubmit');
$router->add('logout', AuthController::class, 'logout');
$router->add('signup', AuthController::class, 'signup');
$router->add('signup-submit', AuthController::class, 'signupSubmit');
$router->add('my-offers', OfferController::class, 'listUserOffers');
$router->add('offer', OfferController::class, 'viewCreateOffer');
$router->add('offer-create', OfferController::class, 'createOffer');
$router->add('offer-update', OfferController::class, 'updateOffer');
$router->add('offer-edit', OfferController::class, 'editOffer');
$router->add('offer-delete', OfferController::class, 'deleteOffer');
$router->add('search-offer', OfferController::class, 'searchOffer');
$router->add('search', OfferController::class, 'viewSearchOffer');

// define routes
$route = $_GET['route'] ?? 'login';

// start Router
$router->dispatch($route);