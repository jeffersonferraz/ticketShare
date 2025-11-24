<?php
namespace App\Core;

class Router {
    private $routes = [];

    // register Router
    public function add($path, $controller, $method) {
        $this->routes[$path] = [
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function dispatch( $route) {
        // if the route does not exist
        if (!isset($this->routes[$route])) {
            include '../app/Views/includes/header.php';
            include '../app/Views/404.php';
            include '../app/Views/includes/footer.php';
            return;
        }

        // get the name of the controller class
        $controllerName = $this->routes[$route]['controller'];
        // get the name of the method 
        $methodName = $this->routes[$route]['method'];

        // create an object 
        $controller = new $controllerName();
        // run the method
        $controller->$methodName();
    }
}