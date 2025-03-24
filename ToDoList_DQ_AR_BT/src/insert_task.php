<?php

ob_start();

$host = '51.83.36.122';  // Adresse du serveur PostgreSQL
$port = '5432';       // Port PostgreSQL (5432 par défaut)
$dbname = 'DB_Docker_RA_TB_QD';  // Remplacez par le nom de votre base de données
$user = 'dacque';  // Remplacez par votre nom d'utilisateur PostgreSQL
$password = 'IRVb99';  // Remplacez par votre mot de passe PostgreSQL

    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Active les exceptions en cas d'erreur
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC  // Mode de récupération des données
    ]);

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nomelement = $_POST['nomelement'];
    $estcocher = isset($_POST['estcocher']) ? 1 : 0;  // Si la case est cochée, c'est 1, sinon 0
    $idlist = $_POST['idlist'];  // ID de la liste sélectionnée
    
    // Préparer la requête SQL pour insérer la nouvelle tâche
    $stmt = $pdo->prepare("INSERT INTO todo_list.element (nomelement, estcocher, idlist) VALUES (:nomelement, :estcocher, :idlist)");

    // Lier les paramètres de la requête préparée
    $stmt->bindParam(':nomelement', $nomelement, PDO::PARAM_STR);
    $stmt->bindParam(':estcocher', $estcocher, PDO::PARAM_INT);
    $stmt->bindParam(':idlist', $idlist, PDO::PARAM_INT);

    // Exécuter la requête pour insérer la tâche dans la base de données
    if ($stmt->execute()) {
        // Redirection vers la page principale après l'insertion
        header("Location: index.php");
        exit;  // N'oublie pas d'ajouter un exit() pour éviter de continuer l'exécution
    } else {
        echo "Erreur lors de l'ajout de la tâche.";
    }
}

// Envoie le tampon de sortie (cela affichera tout le contenu du tampon après l'en-tête)
ob_end_flush();
?>