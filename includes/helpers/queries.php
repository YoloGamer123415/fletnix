<?php
require_once("database.php");

function getMovies() {
	// global $connection;

	// $rows = [];
	// $result = $connection->query("SELECT * FROM `movies` LIMIT 6");

	// while( $row = $result->fetch_assoc() ) {
		// $rows[] = $row;
	// }

	// return $rows;
	
	return dbQuery("SELECT * FROM `movies` LIMIT 6;");
}

function getAllMovies() {
	// global $connection;

	// $rows = [];
	// $stmt = $connection->prepare("SELECT * FROM `movies`;");
	// $stmt->bind_param("s", $genreId);
	// $stmt->execute();
	// $result = $stmt->get_result();
	// $stmt->close();

	// while( $row = $result->fetch_assoc() ) {
		// $rows[] = $row;
	// }

	// return $rows;

	return dbQuery("SELECT * FROM `movies`;");
}

function getMovieById($movieId) {
	if(!$movieId) throw new Exception("No movieId given!");

	return dbQuery(
		"SELECT * FROM `movies` WHERE `id` = :movieId;",
		array(
			":movieId" => $movieId
		)
	)[0];
}

function getMoviesByGenre($genreId) {
	if (!$genreId) {
		throw new Exception("No genreId given");
	}

	return dbQuery(
		"SELECT * FROM `movies` WHERE `genre_id` = :genreId;",
		array(
			":genreId" => $genreId
		)
	);
}

function searchForMovies($title, $director, $genre, $yearKeyword, $year) {
	$filters = [];
	$variables = [];

	if ( isset($title) && !empty($title) ) {
		// add % in front of and behind the title, because `LIKE %:title%` becomes `LIKE '%'{title}'%'`, which doesn't work
		$filters[] = "title LIKE CONCAT('%', :title, '%')";
		$variables[":title"] = $title;
	}
	if ( isset($director) && !empty($director) ) {
		$filters[] = "director LIKE CONCAT('%', :director, '%')";
		$variables[":director"] = $director;
	}
	if ( isset($genre) && !empty($genre) ) {
		$filters[] = "genre_id = :genre";
		$variables[":genre"] = $genre;
	}
	if ( isset($year) && !empty($year) ) {
		// TODO: what if they change it to something not in this array?
		$char = array(
			"before" => "<",
			"in" => "=",
			"after" => ">",
		)[$yearKeyword];
		$filters[] = "YEAR(publication_date) $char :year";
		$variables[":year"] = intval($year);
	}

	return dbQuery(
		"SELECT * FROM `movies` WHERE " . implode(" AND ", $filters) . ";",
		$variables
	);
}
