<?php

// общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);

// подсключение файлов системы
require_once('./components/Router.php');
include_once './components/Db.php';

// вызов роутера
$router = new Router();
$router->run();