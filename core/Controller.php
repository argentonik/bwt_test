<?php

namespace core;

use models\User;

abstract class Controller {

public $route;
public $view;
public $user;
public $requiredUserStatus;

public function __construct($route) {
    $this->route = $route;
    $this->user = new User();
    if (!$this->checkRights()) {
        View::errorCode(403);
    }
    $this->view = new View($route);
    $this->model = $this->loadModel($route['controller']);
}

public function loadModel($name) {
    $path = 'models\\'.ucfirst($name);
    if (class_exists($path)) {
        return new $path;
    }
}

public function checkRights() {
    $userAuthProps = require 'config/auth.php';
    $this->requiredUserStatus = $userAuthProps[$this->route['controller']][$this->route['action']];

    if ($this->requiredUserStatus === 'all') {
        return true;
    }
    elseif ($this->requiredUserStatus === 'authorize' && $this->user->checkLogged()) {
        return true;
    }
    return false;
}

}