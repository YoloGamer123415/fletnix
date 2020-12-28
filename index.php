<!DOCTYPE html>
<html lang="nl">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="./resources/style/normalize.css" />
	<link rel="stylesheet" href="./resources/style/variables.css" />
	<link rel="stylesheet" href="./resources/style/fonts.css" />
	<link rel="stylesheet" href="./resources/style/main.css" />
	<link rel="stylesheet" href="./resources//style/home.css" />
	<link rel="shortcut icon" href="./resources/images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="./resources/images/favicon.ico" type="image/x-icon"><link rel="stylesheet" href="../resources/style/genre.css">
	<title>Fletnix - Home</title>
</head>
<body>
	<?php require("./includes/header.php") ?>

	<main>
		<div class="welcome">
			<div class="container">
				<h1>Welkom op <span class="underline">Fletnix</span></h1>

				<p>
					Op deze site zijn veel populaire films te bekijken zonder te betalen voor een Netflix abbonement!
				</p>
				<p>
					Het enige wat je hoeft te doen is te registreren en een film aan te klikken. Deze site is volledig beschrikbaar zonder betaling en we hopen dat je zo beter door de Corona crisis heen komt. De films worden elke maandag aangevuld. de 10 beste films op dat moment voegen we toe aan Fletnix. Deze service is bedoeld voor  studenten maar natuurlijk is iedereen welkom. 
				</p>
				<p>
					We hopen dat je geniet!
				</p>
			</div>
		</div>

		<div class="best-films">
			<div class="container">
				<h1>Het beste van Fletnix</h1>
	
				<div class="films">
					<?php
						require("./includes/helpers/queries.php");
						require("./includes/factories/movie.php");

						$movies = getMovies();
						foreach($movies as $movie) {
							echo getMovieHtml($movie);
						}
					?>
				</div>
			</div>
		</div>
	</main>

	<?php require("./includes/footer.php") ?>
</body>
</html>
