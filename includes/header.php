<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/helpers/queries.php");

session_start();

$genres = getAllGenres();
$genresHtml = [];

foreach($genres as $genre) {
	$id = $genre["id"];
	$text = $genre["nederlands"];

	$genresHtml[] = <<<HTML
	<li><a href="/movies/#{$id}">{$text}</a></li>
	HTML;
}

$signinHtml = <<<HTML
<a href="/inloggen/">Inloggen</a>
HTML;

if ( isset( $_SESSION["user"] ) ) {
	$username = htmlspecialchars($_SESSION["user"]["first_name"] . ' ' . $_SESSION["user"]["last_name"], ENT_QUOTES);

	$signinHtml = <<<HTML
	<a href="/logout"><b>{$username}</b></a>
	HTML;
}
?>
<header>
	<nav>
		<div class="left">
			<a href="/">
				<img src="/resources/images/logo.png" alt="LOGO" />
			</a>
		</div>

		<input type="checkbox" id="menu-toggle" hidden />
		<label for="menu-toggle" class="menu-btn">
			<span class="btn"></span>
		</label>

		<div class="right">
			<ul>
				<li>
					<a href="/movies/">Films</a>
					<ul>
						<?= implode($genresHtml) ?>
					</ul>
				</li>
				<li><?= $signinHtml ?></li>
			</ul>
		</div>
	</nav>
</header>
