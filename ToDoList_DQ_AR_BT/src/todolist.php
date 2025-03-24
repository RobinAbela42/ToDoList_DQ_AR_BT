<?php

require_once('db.php');
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


// function deleteJoke($idjoke) {
	
// }



// function updateJoke($idjoke, $text, $category) {
	

// }