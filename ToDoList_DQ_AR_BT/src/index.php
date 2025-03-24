<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
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


        $list = loadTodoList(pdo: $pdo);


        echo "<section>";
        $page = "home";
        $page = $_GET["page"];
        if ($page == "home") { 
            echo "<article>
            <h1>Ma TodoList</h1>".
            displayTodo( $list)."</article>";
        }
        if ($page == "add") { 
            echo "<article>
                <h1>Ajouter Todo</h1>
                ".displayTodoForm()."
            </article>";
        } 


        // var_dump($list);
        

        function displayMenu()
        {
            echo "<ul>
                <li><a href='.?page=home'>Accueil</a></li>
                <li><a href='.?page=add'>Ajouter</a></li>
            </ul>";
        }

        function displayTodo($list)
        {
            // value='" . $row['id'] . "' " . ($row['completed'] ? 'checked' : '') . "
            foreach ($list as $key => $value) {

                echo "<table>";
                echo "<tr>";
                echo "<form method='post'>";
                echo "<td><input type='checkbox' name='completed[]' ></td>";
                echo "<td>".$value['nomelement']."</td>";
                echo "</form>";
                echo "</tr>";
                echo "</table> ";
            }
        }


        function loadTodoList($pdo) {
            $sql = "SELECT * FROM todo_list.element"; 
            $stmt = $pdo->prepare($sql);
            $stmt->execute(); 
        
            $element = $stmt->fetchAll();  
            return $element;
        }

        function insertTodo($text,$category) {
            echo"<h2>La blague ".$text." </h2>";
            echo"<h2>the category ".$category." </h2>";
        }

        
        function displayTodoForm()
        {

            echo ("<form method='post' action='actions.php' >
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
        ?>



    </section>

</body>

</html>