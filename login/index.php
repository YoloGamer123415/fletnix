<?php
	session_start();

	require_once("../includes/helpers/queries.php");

	$userVerification = isset($_POST["email"]) && isset($_POST["password"]);
	$error = null;

	if($userVerification) {
		$email = $_POST["email"];
		$password = $_POST["password"];

		$user = getUser($email)[0];
		$userExists = count($user) != 0;

		if(!$userExists) {
			$error = "Gebruiker bestaat niet";
		}

		if(!$error && password_verify($password, $user["password"])) {
			$_SESSION["user"] = $user;
			header("Location: /");
		} else if(!$error) {
			$error = "Wachtwoord onjuist!";
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
	<link rel="stylesheet" href="/resources/style/login.css" />
	<link rel="stylesheet" href="/resources/style/fonts.css" />
	<link rel="shortcut icon" href="/resources/images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/resources/images/favicon.ico" type="image/x-icon">
	<title>Fletnix - Inloggen</title>
</head>
<body>
	<?php require("../includes/header.php") ?>

	<main>
		<div class="container">
			<div class="login">
				<div class="title">
					<h1><span class="underline">Inloggen</span></h1>
					<p>Of <a href="/registreren">registreer</a> voor een account</p>
				</div>

				<div class="box">
					<form method="post">
						<input type="email" name="email" id="email" placeholder="E-mailadres">
						<input type="password" name="password" id="password" placeholder="Wachtwoord">

						<?= $error ? "<b>$error</b>" : "" ?>

						<button type="submit">log in</button>
					</form>
				</div>
			</div>
		</div>
	</main>

	<?php require("../includes/footer.php") ?>
</body>
</html>
