<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<h1>Blagues</h1>
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
			<h1>Les blagues</h1>
			<?php displayJokes($jokes); ?>
		</article>
		<?php } ?>


		<?php if ($page == "add") { ?>
		<article>
			<h1>Ajouter une blague</h1>
			<?php displayJokeForm(); ?>
		</article>
		<?php } ?>

	</section>

</body>
</html>