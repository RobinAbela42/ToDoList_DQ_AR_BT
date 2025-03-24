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
        include "update_task.php"; // Execution des actions (chargement, formulaires)


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

            displayTodo( $list,pdo: $pdo)."</article>";
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

        function displayTodo($list, $pdo)
        {
            foreach ($list as $key => $value) {
                // Affichage de chaque ligne avec une checkbox
                echo "<table>";
                echo "<tr>";
                echo "<td><input type='checkbox' class='checkbox' data-id='" . $value['idelement'] . "' " . ($value['estcocher'] == 1 ? "checked" : "") . "></td>";
                echo "<td>" . $value['nomelement'] . "</td>";
                echo "</tr>";
                echo "</table>";
            }
            
            // Inclure le script AJAX pour gérer la mise à jour sans rafraîchir la page
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