<?php

require_once('db.php');
function loadJokes() {
    $result = pg_query('select * from barryt.jokes');
    return $result;

}


function displayJokes($result) {

    while ($row = pg_fetch_assoc($result)) {
        echo "<table>";
        echo "<tr>";
        foreach($row as $key=>$value)
            echo "<td>".$value."</td> ";

        echo "</tr>";
    }
    echo "</table> ";
    
}


function displayJokeForm() {

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

function insertJoke($text,$category) {
    echo"<h2>La blague ".$text." </h2>";
    echo"<h2>the category ".$category." </h2>";
    pg_query("insert into jokes(texte,category) values('$texte','$categorie')");
}


function deleteJoke($idjoke) {
	
}



function updateJoke($idjoke, $text, $category) {
	

}