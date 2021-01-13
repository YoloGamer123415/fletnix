<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	session_start();

	require("../includes/helpers/queries.php");

	$userVerification = isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["password"]);
	$error = NULL;

	if($userVerification) {
		$firstName = $_POST["firstname"];
		$lastName = $_POST["lastname"];
		$email = $_POST["email"];
		$password = $_POST["password"];

		if(empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
			$error = "Alle velden moeten gevuld zijn!";
		}

		if(!$error) {
			$user = getUser($email);
			$userExists = count($user) != 0;

			if($userExists) {
				$error = "Gebruiker bestaat al!";
			}
		}

		if(!$error && strlen($firstName) > 256) {
			$error = "Voornaam kan niet langer zijn dan 256 karakters!";
		}

		if(!$error && strlen($lastName) > 256) {
			$error = "Achternaam kan niet langer zijn dan 256 karakters!";
		}

		if(!$error && strlen($email) > 256) {
			$error = "E-mail kan niet langer zijn dan 256 karakters!";
		} else if(!$error && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error = "E-mail incorrect!";
		}

		if(!$error && strlen($password) < 4) {
			$error = "Wachtwoord moet minstens 4 tekens zijn";
		}

		if(!$error) {
			addUser($firstName, $lastName, $email, $password);
			$user = getUser($email)[0];

			if(count($user) == 0) {
				$error = "Error bij het maken van de gebruiker!";
			}

			$_SESSION["user"] = $user;
			header("Location: /");
		}
	}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="/resources/style/normalize.css" />
	<link rel="stylesheet" href="/resources/style/variables.css" />
	<link rel="stylesheet" href="/resources/style/main.css" />
	<link rel="stylesheet" href="/resources/style/registreren.css" />
	<link rel="stylesheet" href="/resources/style/fonts.css" />
	<link rel="shortcut icon" href="/resources/images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/resources/images/favicon.ico" type="image/x-icon">
	<title>Fletnix - Registreren</title>
</head>
<body>
	<?= require("../includes/header.php") ?>

	<main>
		<div class="container">
			<div class="register">
				<div class="title">
					<h1><span class="underline">Registreren</span></h1>
					<p>Of <a href="/inloggen">login</a> als je al een account hebt</p>
				</div>

				<div class="box">
					<form method="post">
						<input type="firstname" name="firstname" id="firstname" placeholder="Voornaam" required>
						<input type="lastname" name="lastname" id="lastname" placeholder="Achternaam" required>
						<input type="email" name="email" id="email" placeholder="E-mailadres" required>
						<input type="password" name="password" id="password" placeholder="Wachtwoord" required>

						<?= $error ? "<b>$error</b>" : "" ?>

						<button type="submit">registreer</button>
					</form>
				</div>
			</div>
		</div>
	</main>

	<?= require("../includes/footer.php") ?>
</body>
</html>
