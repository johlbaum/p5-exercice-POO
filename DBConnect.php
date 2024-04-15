<?php

class DBConnect
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = $this->dbConnect();
    }

    private function dbConnect(): PDO
    {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=contact_app;charset=utf8', 'root', 'root');
            return $pdo;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
