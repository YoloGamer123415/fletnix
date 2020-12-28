<!DOCTYPE html>
<html lang="nl">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="./resources/style/normalize.css" />
	<link rel="stylesheet" href="./resources/style/variables.css" />
	<link rel="stylesheet" href="./resources/style/main.css" />
	<link rel="stylesheet" href="./resources/style/registreren.css" />
	<link rel="stylesheet" href="./resources/style/fonts.css" />
	<link rel="shortcut icon" href="./resources/images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="./resources/images/favicon.ico" type="image/x-icon"><link rel="stylesheet" href="../resources/style/genre.css">
	<title>Fletnix - Registreren</title>
</head>
<body>
	<?= require("./includes/header.php") ?>

	<main>
		<div class="container">
			<div class="register">
				<div class="title">
					<h1><span class="underline">Registreren</span></h1>
					<p>Of <a href="./inloggen.html">login</a> als je al een account hebt</p>
				</div>

				<div class="box">
					<input type="text" name="username" id="username" placeholder="Gebruikersnaam">
					<input type="password" name="password" id="password" placeholder="Wachtwoord">
				
					<button>registreer</button>
				</div>
			</div>
		</div>
	</main>

	<?= require("./includes/footer.php") ?>
</body>
</html>
