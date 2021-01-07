<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("../includes/helpers/queries.php");

$movies = searchForMovies(
	$_GET["title"],
	$_GET["director"],
	$_GET["genre"],
	$_GET["year-keyword"],
	$_GET["year"],
);

echo '<br><br><br><br><br><br><br>';
var_dump($movies);
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
	<link rel="stylesheet" href="/resources/style/search.css" />
	<title>Fletnix - Films</title>
</head>
<body>
	<?php
		include("../includes/header.php");
	?>

	<main>
		<div class="container">

		</div>
	</main>

	<?php
		include("../includes/footer.php");
	?>
</body>
</html>
