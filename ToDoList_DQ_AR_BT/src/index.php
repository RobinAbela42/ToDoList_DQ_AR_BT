<?php
session_start();
include "db.php"; // Connexion à la BD
include "misc.php";  // Fonctions diverses
include "todolist.php"; // Fonctions sur les blagues
include "actions.php"; // Execution des actions (chargement, formulaires)
include "view.php"; // Affichage (HTML)


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

global $list;
 $list = loadTodoList($pdo);

// var_dump($list);


function displayTodo($jsp) {




        // value='" . $row['id'] . "' " . ($row['completed'] ? 'checked' : '') . "
        foreach($jsp as $key=>$value){

            echo "<table>";
            echo "<tr>";
            echo "<td><input type='checkbox' name='completed[]' ></td>";
            foreach($value as $key=>$ptetre){

                echo "<td>".$ptetre."</td> ";}
            echo "</tr>";
            echo "</table> ";}

}


displayTodo($list);

function displayTodoForm() {

    echo("<form method='post' action='actions.php' >
    <div>
        <label for='text'>text</label>
        <input type='text' name='text' id='text'/>
    </div>
    <div>
        <label for='category'>Catégorie</label>
        <input type='text' name='category' id='category'/>
    </div>
    <div>
        <label></label>
        <input type='submit' action ='Valider' value='Assigner les valeurs'/>
    </div>		
    </form>");
}
