<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=mydb;port=3308;charset=utf8", "root", "");
    // print "Connexion réussie à la base de données";
} catch (\Throwable $th) {
    die("Échec de la connexion à la base de données : " . $th->getMessage());
}