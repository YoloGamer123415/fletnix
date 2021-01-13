<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require_once("../includes/helpers/queries.php");

	if(isset($_GET["id"])) {
		$movie = getMovieById($_GET["id"]);
		if($movie) {
			$id = $movie["id"];
			$title = $movie["title"];
			$publication_date = $movie["publication_date"];
			$runtime = $movie["runtime"];
			$cast = $movie["cast"];
			$story = $movie["story"];
			$facts = $movie["facts"];
			$imageUrl = "/resources/images/posters/" . $id . ".png";
		} else {
			$title = "Film niet gevonden";
			$publication_date = "niet gevonden";
			$runtime = "niet gevonden";
			$cast = "niet gevonden";
			$story = "niet gevonden";
			$facts = "niet gevonden";
		}
	} else {
		$title = "Film niet gevonden";
		$publication_date = "niet gevonden";
		$runtime = "niet gevonden";
		$cast = "niet gevonden";
		$story = "niet gevonden";
		$facts = "niet gevonden";
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
	<link rel="stylesheet" href="/resources/style/description.css" />
	<title>Fletnix - Films</title>
</head>
<body>
	<?php
		include("../includes/header.php");
	?>

	<main>
		<div class="container">
			<div class="poster">
				<img
					src="<?= $imageUrl ?>"
					alt="poster"
				/>
				</div>

				<div class="text">
					<h1><?= $title ?></h1>
					<h4><?= $publication_date ?> - <?= $runtime ?></h4>
					<button><a href="play.php?id=<?= $id ?>">speel af</a></button>

					<h2>Facts</h2>
					<p>
						<?= $facts ?>
					</p>

					<h2>De Cast</h2>
					<p>
						<?= str_replace("\n",  "<br>", $cast) ?>
					</p>
					
					<h2>Het Verhaal</h2>
					<p>
					<?= $story ?>
					</p>
				</div>
			</div>
		</div>
	</main>

	<?php
		include("../includes/footer.php");
	?>
</body>

<style>
body {
  background: url("<?= $imageUrl ?>")
    no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>
</html>
