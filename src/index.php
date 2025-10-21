<?php
// start session
session_start();

// load allowed routes
$allowedRoutes = require_once __DIR__ . "/includes/routes.php";

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
$script = null;
switch ($route) {
    case '404':
        $script = '404.php';
        break;

    case 'signup':
        $script = 'signUp.php';
        break;
    
    case 'signup-submit':
        $script = 'signUpSubmit.php';
        break;

    case 'login':
        $script = 'login.php';
        break;

    case 'login-submit':
        $script = 'loginSubmit.php';
        break;

    case 'logout':
        $script = 'logout.php';
        break;

    case 'home':
        $script = 'home.php';
        break;

    case 'offer':
        $script = 'offer.php';
        break;

    case 'offer-submit':
        $script = 'offerSubmit.php';
        break;

    case 'search':
        $script = 'search.php';
        break;

    case 'search-submit':
        $script = 'searchSubmit.php';
        break;
}

// constantly required resources
require_once __DIR__ . "/includes/config.php";
require_once __DIR__ . "/classes/Database.php";
require_once __DIR__ . "/classes/Login.php";
require_once __DIR__ . "/classes/SignUp.php";
require_once __DIR__ . "/classes/Offer.php";

// display page
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/scripts/$script";
require_once __DIR__ . "/includes/footer.php";