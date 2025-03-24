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
	<section>
		<?php
			$page =$_GET["page"]
		?>
		<?php if ($page == "home") { ?>
		<article>
			<h1>Ma TodoList</h1>
		</article>
		<?php } ?>


		<?php if ($page == "add") { ?>
		<article>
			<h1>Ajouter Todo</h1>
		</article>
		<?php } ?>

	</section>

</body>
</html>