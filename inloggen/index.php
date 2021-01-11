<!DOCTYPE html>
<html lang="nl">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="/resources/style/normalize.css" />
	<link rel="stylesheet" href="/resources/style/variables.css" />
	<link rel="stylesheet" href="/resources/style/main.css" />
	<link rel="stylesheet" href="/resources/style/inloggen.css" />
	<link rel="stylesheet" href="/resources/style/fonts.css" />
	<link rel="shortcut icon" href="/resources/images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/resources/images/favicon.ico" type="image/x-icon"><link rel="stylesheet" href="../resources/style/genre.css">
	<title>Fletnix - Inloggen</title>
</head>
<body>
	<!-- <?php require("../includes/header.php") ?> -->
	<?php
		session_start();

		require("../includes/helpers/queries.php");

		$userVerification = isset($_POST["email"]) && isset($_POST["password"]);
		$userExists = false;

		if($userVerification) {
			$email = $_POST["email"];
			$password = $_POST["password"];

			$user = getUser($email);
			$userExists = count($user) != 0;

			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			if($userExists && password_verify($password, $hashedPassword)) { 
				$_SESSION["user"] = $user;
				header("Location: /");
			}
		}
	?>

	<main>
		<div class="container">
			<div class="login">
				<div class="title">
					<h1><span class="underline">Inloggen</span></h1>
					<p>Of <a href="./registreren.html">registreer</a> voor een account</p>
				</div>

				<div class="box">
					<form method="post">
						<input type="email" name="email" id="email" placeholder="E-mail adres">
						<input type="password" name="password" id="password" placeholder="Wachtwoord">

						<?php 
							if($userVerification) {
								echo $userExists ? "" : "Gebruikersnaam of wachtwoord incorrect!";
							}
						?>

						<button type="submit">log in</button>
					</form>
				</div>
			</div>
		</div>
	</main>

	<?php require("../includes/footer.php") ?>
</body>
</html>
