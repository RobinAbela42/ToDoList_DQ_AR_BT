<?php

require_once('db.php');
function loadTodoList($pdo) {
    $sql = "SELECT * FROM todo_list.element"; 
    $stmt = $pdo->prepare($sql);
    $stmt->execute(); 

    $element = $stmt->fetch_all();  
    return $element;

}


function displayTodo($result) {

    while ($row = pg_fetch_assoc($result)) {
        echo "<table>";
        echo "<tr>";
        echo "<td><input type='checkbox' name='completed[]' ></td>";
// value='" . $row['id'] . "' " . ($row['completed'] ? 'checked' : '') . "
        foreach($row as $key=>$value)
            echo "<td>".$value."</td> ";

        echo "</tr>";
    }
    echo "</table> ";
    
}


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

function insertTodo($text,$category) {
    echo"<h2>La blague ".$text." </h2>";
    echo"<h2>the category ".$category." </h2>";
}


// function deleteJoke($idjoke) {
	
// }



// function updateJoke($idjoke, $text, $category) {
	

// }