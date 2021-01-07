<?php
include("movie.php");

/**
 * @param array $genre Het eerste item in de array is de genre zoals hij in de
 *                     database staat (bv. "oldskool"). Het tweede item is de
 *                     nederlandse vertaling (bv. "Old-Skool").
 * @param array $movies
 * @return string
 */
function getExpandableHtml($genre, $movies) {
	$genreId = $genre[0];
	$genreName = $genre[1];
	$movieHtmlArr = [];

	foreach($movies as $movie) {
		$movieHtmlArr[] = getMovieHtml($movie);
	}

	$movieHtml = implode($movieHtmlArr);

	return <<<HTML
	<div id="{$genreId}" class="genre">
		<h1 class="name">{$genreName}</h1>

		<div class="genre-bar-wrapper">
			<input type="checkbox" id="genre-{$genreId}" hidden>

			<div class="genre-bar">
				<div class="toggle">
					<label for="genre-{$genreId}">
						<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-left" class="svg-inline--fa fa-angle-left fa-w-8" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path fill="currentColor" d="M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z"></path></svg>
					</label>
				</div>

				<div class="bar-background">
					{$movieHtml}
				</div>
			</div>
		</div>
	</div>
	HTML;
}
