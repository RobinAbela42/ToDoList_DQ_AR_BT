<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>TodoList</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <header>
        <h1>TodoList</h1>
    </header>
    <nav>
        <?php displayMenu(); ?>
    </nav>

    <?php

    include "actions.php"; // Execution des actions (chargement, formulaires)
    include "insert_task.php"; // Execution des actions (chargement, formulaires)
    include "delete_task.php";

    // Connexion à la base de données PostgreSQL
    $host = '51.83.36.122';  // Adresse du serveur PostgreSQL
    $port = '5432';       // Port PostgreSQL (5432 par défaut)
    $dbname = 'DB_Docker_RA_TB_QD';  // Nom de la base de données
    $user = 'dacque';  // Utilisateur PostgreSQL
    $password = 'IRVb99';  // Mot de passe PostgreSQL
    
    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        $pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Active les exceptions en cas d'erreur
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC  // Mode de récupération des données
        ]);
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }

    $list = loadTodoList(pdo: $pdo);
        
    usort($list, function($a, $b) {
        if ($a["estcocher"] !== $b["estcocher"]) {
            return $b["estcocher"] - $a["estcocher"];
        }
        return $a["idelement"] - $b["idelement"];
    });
        
    echo "<section>";

    // Vérifier si 'page' existe dans l'URL, sinon par défaut c'est 'home'
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    if ($page == "home") { 
        echo "<article>
            <h2>Ma TodoList</h2>" . displayTodo($list, $pdo) . "</article>";
    } elseif ($page == "add") { 
        echo "<article>
            <h2>Ajouter Todo</h2>" . displayTodoForm($pdo) . "</article>";
    }

    function displayMenu() {
        // Afficher le menu de navigation
        echo "<ul>
            <li id='homepage' class='cercle'><a href='.?page=home'>Accueil</a></li>
            <li id='addpage' class='cercle'><a href='.?page=add'>Ajouter</a></li>
        </ul>";
    }

    function displayTodo($list, $pdo) {
        // Affichage de la TodoList
        foreach ($list as $key => $value) {
            echo "<table>";
            echo "<tr>";
            echo "<td><input type='checkbox' class='checkbox' data-id='" . $value['idelement'] . "' " . ($value['estcocher'] == 1 ? "checked" : "") . "></td>";
            echo "<td>" . $value['nomelement'] . "</td>";
            // Ajout du bouton de suppression pour chaque tâche
            echo "<td>
                    <form action='delete_task.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='idelement' value='" . $value['idelement'] . "'>
                        <input type='submit' value='X'>
                    </form>
                  </td>";
            echo "</tr>";
            echo "</table>";
        }
    
        // Script AJAX pour la mise à jour de la tâche
        echo "
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <script>
            $(document).ready(function() {
                $('.checkbox').change(function() {
                    var idelement = $(this).data('id');
                    var estcocher = $(this).is(':checked') ? 1 : 0;  
    
                    $.ajax({
                        url: 'update_task.php',  
                        method: 'POST',
                        data: {
                            idelement: idelement,
                            estcocher: estcocher
                        },
                        success: function(response) {
                            console.log('Mise à jour réussie');
                        },
                        error: function() {
                            alert('Erreur lors de la mise à jour');
                        }
                    });
                });
            });
        </script>";
    }

    function loadTodoList($pdo) {
        $sql = "SELECT * FROM todo_list.element"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute(); 

        return $stmt->fetchAll();  // Retourne la liste des tâches
    }

    function displayTodoForm($pdo) {
        $stmt = $pdo->query("SELECT * FROM todo_list.list");
        
        // Affichage du formulaire pour ajouter une tâche
        echo ("<form action='insert_task.php' method='POST'>
            <label for='nomelement'>Nom de la tâche :</label>
            <input type='text' id='nomelement' name='nomelement' required><br>

            <label for='estcocher'>Cochée :</label>
            <input type='checkbox' id='estcocher' name='estcocher' value='1'><br>

            <label for='idlist'>Choisissez une liste :</label>
            <select id='idlist' name='idlist' required>");

        // Remplir le combobox avec les listes disponibles
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $row['idlist'] . "'>" . $row['nomlist'] . "</option>";
        }

        // Fermer le combobox et le reste du formulaire
        echo "</select><br>";
        echo "<input type='submit' value='Ajouter la tâche'>
        </form>";
    }
    ?>



    </section>
    
</body>

</html>