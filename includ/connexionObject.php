<?php
class Database
{
    private $dbserver = 'localhost';
    private $dbuser = 'root';
    private $dbpassword = '';
    private $dbname = 'mydb';
    private $port = '3308';
    private $pdo; // Ajout de la variable $pdo

    // Constructeur
    public function __construct()
    {
        $dsn = "mysql:host={$this->dbserver};port={$this->port};dbname={$this->dbname};charset=utf8";
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        );

        try {
            $this->pdo = new PDO($dsn, $this->dbuser, $this->dbpassword, $options);
            // print "Connexion réussie à la base de données";
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
}