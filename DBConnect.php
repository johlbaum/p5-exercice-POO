<?php

/**
 * Classe est un singleton qui permet de se connecter à la base de données et de récupérer l'objet PDO.
 */
class DBConnect
{
    private static $instance = null;
    private $pdo;

    /**
     * Constructeur de la classe DBConnect.
     * Initialise la connexion à la base de données.
     * Constructeur privé pour empêcher l'instanciation de la classe depuis l'extérieur. 
     * Pour récupérer une instance de la classe, il faut utiliser la méthode getInstance().
     */
    private function __construct()
    {
        $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
    }

    /**
     * Méthode qui permet de récupérer l'instance de la classe DBConnect.
     * Puisque l'instance est stockée dans une propriété statique, seule une instance est créée et retournée à chaque appel.
     * Le premier appel instancie la classe et tous les suivants retourneront l'instance déjà créée.
     * @return DBConnect
     */
    public static function getInstance(): DBConnect
    {
        if (self::$instance == null) {
            self::$instance = new DBConnect();
        }
        return self::$instance;
    }

    /**
     * Méthode qui permet de récupérer l'objet PDO.
     * @return PDO
     */
    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
