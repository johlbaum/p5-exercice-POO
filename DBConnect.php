<?php

class DBConnect
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=contact_app;charset=utf8', 'root', 'root');
    }

    public static function getInstance(): DBConnect
    {
        if (self::$instance == null) {
            self::$instance = new DBConnect();
        }
        return self::$instance;
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
