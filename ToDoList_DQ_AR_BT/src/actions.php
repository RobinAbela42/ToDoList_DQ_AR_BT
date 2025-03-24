<?php

require_once('jokes.php');

if (isset($_POST["action"])) {
	$text = $_POST["text"];
    $category = $_POST["category"];
    echo"<h2>La blague ".$text." </h2>";
    echo"<h2>the category ".$category." </h2>";
	insertJoke($text,$category);
	header("Location: index.php");
}

$jokes = loadJokes();

