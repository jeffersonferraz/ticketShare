<?php
// start session
session_start();

// load allowed routes
$allowedRoutes = require_once __DIR__ . "/../app/Core/routes.php";

// define routes
$route = $_GET['route'] ?? 'home';

// verify if user is logged in or wants sign up
if (!isset($_SESSION['user']) && $route != 'login-submit' && $route != 'signup' && $route != 'signup-submit') {
    $route = 'login';
}

// if user is logged in and try to login again
if (isset($_SESSION['user']) && $route === 'login') {
    $route = 'home';
}

// if route does not exist
if (!in_array($route, $allowedRoutes)) {
    $route = '404';
}

// provide requested routes
$path = null;
switch ($route) {
    case '404':
        $path = 'Views/404.php';
        break;

    case 'signup':
        $path = 'Views/signUp.php';
        break;
    
    case 'signup-submit':
        $path = 'Controllers/SignUpController.php';
        break;

    case 'login':
        $path = 'Views/login.php';
        break;

    case 'login-submit':
        $path = 'Controllers/LoginController.php';
        break;

    case 'logout':
        $path = 'Views/logout.php';
        break;

    case 'home':
        $path = 'Views/home.php';
        break;

    case 'offer':
        $path = 'Views/offer.php';
        break;

    case 'offer-submit':
        $path = 'Controllers/OfferController.php';
        break;

    case 'my-offers':
        $path = 'Views/myOffers.php';
        break;

    case 'search':
        $path = 'Views/search.php';
        break;

    case 'search-submit':
        $path = 'Controllers/searchSubmit.php';
        break;
}

// constantly required resources
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../app/Core/Database.php";
require_once __DIR__ . "/../app/Models/Login.php";
require_once __DIR__ . "/../app/Models/SignUp.php";
require_once __DIR__ . "/../app/Models/Offer.php";
require_once __DIR__ . "/../app/Models/Cities.php";

// display page
require_once __DIR__ . "/../app/Views/includes/header.php";
require_once __DIR__ . "/../app/$path";
require_once __DIR__ . "/../app/Views/includes/footer.php";