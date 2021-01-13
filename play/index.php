<?php
	if(!isset($_GET["id"]) || $_GET["id"] == "-1") {
		header("Location: /");
	}

	$movie_id = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="/resources/style/normalize.css" />
	<link rel="stylesheet" href="/resources/style/variables.css" />
	<link rel="stylesheet" href="/resources/style/main.css" />
	<link rel="stylesheet" href="/resources/style/fonts.css" />
	<title>Fletnix - Afspelen</title>
</head>
<body>
	<?php
		include("../includes/header.php");
	?>

	<main>
		<div class="container">
			<video controls>
				<source src="/resources/movies/<?= $movie_id ?>.mp4" type="video/mp4">
				Your browser does not support the video tag.
			</video>
		</div>
	</main>

	<?php
		include("../includes/footer.php");
	?>
</body>
</html>