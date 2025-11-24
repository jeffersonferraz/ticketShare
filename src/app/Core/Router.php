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
        // if $route does not exist in $routes
        if (!isset($this->routes[$route])) {
            include '../app/Views/includes/header.php';
            include '../app/Views/404.php';
            include '../app/Views/includes/footer.php';
            return;
        }

        // what happens here?
        $contrllerName = $this->routes[$route]['controller'];
        $methodName = $this->routes[$route]['method'];

        $controller = new $contrllerName();
        $controller->$methodName();
    }
}