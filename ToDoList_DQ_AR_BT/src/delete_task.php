<?php
// Connexion à la base de données
$host = '51.83.36.122';  // Adresse du serveur PostgreSQL
$port = '5432';          // Port PostgreSQL (5432 par défaut)
$dbname = 'DB_Docker_RA_TB_QD';  // Remplacez par le nom de votre base de données
$user = 'dacque';        // Remplacez par votre nom d'utilisateur PostgreSQL
$password = 'IRVb99';    // Remplacez par votre mot de passe PostgreSQL

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Active les exceptions en cas d'erreur
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC  // Mode de récupération des données
    ]);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}

// Vérifier si l'ID de l'élément à supprimer est fourni
if (isset($_POST['idelement'])) {
    $idelement = $_POST['idelement'];

    // Préparer la requête SQL pour supprimer l'élément
    $stmt = $pdo->prepare("DELETE FROM todo_list.element WHERE idelement = :idelement");
    
    // Lier le paramètre de la requête préparée
    $stmt->bindParam(':idelement', $idelement, PDO::PARAM_INT);
    
    // Exécuter la requête
    if ($stmt->execute()) {
        // Redirection vers la page principale après la suppression
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de la suppression de la tâche.";
    }
} 
?>
