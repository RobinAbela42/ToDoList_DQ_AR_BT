<?php

$host = '51.83.36.122';  // Adresse du serveur PostgreSQL
$port = '5432';       // Port PostgreSQL (5432 par défaut)
$dbname = 'DB_Docker_RA_TB_QD';  // Remplacez par le nom de votre base de données
$user = 'dacque';  // Remplacez par votre nom d'utilisateur PostgreSQL
$password = 'IRVb99';  // Remplacez par votre mot de passe PostgreSQL
try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Active les exceptions en cas d'erreur
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC  // Mode de récupération des données
    ]);

    echo "Connexion réussie à la base de données !";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}





/* à la maison :

http://localhost/phpmyadmin
login: root
passwd: 

Créer BD : table joke(idjoke, text, category)

*/