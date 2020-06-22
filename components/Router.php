<?php

namespace components;

class Router {
    private $routes;

    public function __construct() {
        $this->routes = include('./config/routes.php');
    }

    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI']);
        }
    }

    public function run() {
        $uri = $this->getURI();

        foreach($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $internalRoute = ltrim($internalRoute, $internalRoute[0]);

                $segments = explode('/', $internalRoute);

                $parameters = [
                    'controller' => array_shift($segments),
                    'action' => array_shift($segments)
                ];

                $controllerName = 'controllers\\' . ucfirst($parameters['controller'].'Controller');
                $actionName = 'action'.ucfirst($parameters['action']);

                $controllerObject = new $controllerName($parameters);
                $result = call_user_func_array(array($controllerObject, $actionName), $segments);

                if($result != null) {
                    break;
                }
            }
        }
    }
}