<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../includes/helpers/queries.php");
require("../includes/factories/movie.php");

if (
	!(isset($_GET["title"]) || isset($_GET["director"]) || isset($_GET["genre"]) || isset($_GET["year-keyword"]) || isset($_GET["year"]))
) {
	header("Location: /movies/?search");
}

$moviesHtmlArr = [];
$movies = searchForMovies(
	$_GET["title"],
	$_GET["director"],
	isset( $_GET["genre"] ) ? $_GET["genre"] : NULL,
	$_GET["year-keyword"],
	$_GET["year"],
);

foreach($movies as $movie)
	$moviesHtmlArr[] = getMovieHtml($movie);
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
			<?php
				if ( count($moviesHtmlArr) > 0 ) {
					$length = count($movies);

					echo "<h1>{$length} zoekresultaten</h1>";
					echo "<div class=\"movies\">" . implode($moviesHtmlArr) . "</div>";
				} else {
					echo <<<HTML
					<div class="no-results">
						<h1>Geen resultaten gevonden</h1>
						<p><a href="/movies/?search">Ga terug</a> en probeer het opnieuw.</p>
					</div>
					HTML;
				}
			?>
		</div>
	</main>

	<?php
		include("../includes/footer.php");
	?>
</body>
</html>
