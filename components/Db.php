<?php


class Db
{
    private static $instance;
    private $connection;

    private function __construct() {
        $paramsPath = './config/db_params.php';
        $params = include($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $this->connection = new PDO($dsn, $params['user'], $params['password']);
    }

    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self;    
        }
        
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}