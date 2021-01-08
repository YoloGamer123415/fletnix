<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("../includes/helpers/queries.php");
require("../includes/factories/expandable.php");

function getOptions($genres) {
	$html = <<<HTML
	<option value="not-chosen" selected disabled>Selecteer een genre</option>
	HTML;

	foreach ($genres as $genre) {
		$genreId = $genre["id"];
		$genreText = $genre["nederlands"];
		$html .= <<<HTML
		<option value="{$genreId}">{$genreText}</option>
		HTML;
	}

	return $html;
}

$genres = dbQuery("SELECT id, nederlands FROM `genres`;");
$expandablesHtml = [];

foreach ($genres as $genre) {
	$genreId = $genre["id"];
	$genreText = $genre["nederlands"];

	$movies = getMoviesByGenre($genreId);
	$html = getExpandableHtml( array($genreId, $genreText), $movies );

	$expandablesHtml[] = $html;
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
	<link rel="stylesheet" href="/resources/style/fonts.css" />
	<link rel="stylesheet" href="/resources/style/genre.css" />
	<title>Fletnix - Films</title>
</head>
<body>
	<?php
		include("../includes/header.php");
	?>

	<main>
		<div class="container">
			<div class="top">
				<div class="title">
					<h1>
						<span class="underline">Films</span>
					</h1>

					<p class="small">Check al onze genres!</p>
				</div>

				<div class="search-button">
					<label for="search-box">Voeg zoekopties toe</label>
				</div>
			</div>

			<?php
				if ( isset( $_GET["search"] ) ) {
					echo <<<HTML
					<input id="search-box" type="checkbox" hidden checked>
					HTML;
				} else {
					echo <<<HTML
					<input id="search-box" type="checkbox" hidden>
					HTML;
				}
			?>

			<!-- TODO: Doen we dit in een apart bestand of gewoon hier? -->
			<form action="/search/" class="search-box">
				<div class="filter-title">
					<input type="text" name="title" placeholder="Film titel">
				</div>

				<div class="filter-director">
					<input type="text" name="director" placeholder="Regisseur">
				</div>

				<div class="filter-genre">
					<select name="genre">
						<?= getOptions($genres) ?>
					</select>
				</div>

				<div class="filter-year">
					<select name="year-keyword">
						<option value="before">Voor</option>
						<option value="in">In</option>
						<option value="after">Na</option>
					</select>

					<input
						type="number"
						name="year"
						placeholder="Publicatiejaar"
						min="0" max="<?= date("Y") ?>" step="1"
					>
				</div>

				<div class="submit">
					<button type="submit">Zoeken</button>
				</div>
			</form>

			<div class="genres">
				<?= implode($expandablesHtml) ?>
			</div>
		</div>
	</main>

	<?php
		include("../includes/footer.php");
	?>
</body>
</html>
