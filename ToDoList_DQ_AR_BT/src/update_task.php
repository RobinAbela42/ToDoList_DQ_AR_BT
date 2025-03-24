<?php
// Connexion à la base de données (PDO)
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



    if (isset($_POST['idelement']) && isset($_POST['estcocher'])) {
        $idelement = $_POST['idelement'];
        $estcocher = $_POST['estcocher'];
    
        // Mise à jour de la base de données pour l'élément spécifié
        $stmt = $pdo->prepare("UPDATE todo_list.element SET estcocher = :estcocher WHERE idelement = :idelement");
        $stmt->bindParam(':estcocher', $estcocher, PDO::PARAM_INT);
        $stmt->bindParam(':idelement', $idelement, PDO::PARAM_INT);
    
        // Exécution de la requête
        $stmt->execute();
        $stmt->close();
        
        // Retourner une réponse en cas de succès
        echo "Mise à jour réussie!";
    }
    ?>
