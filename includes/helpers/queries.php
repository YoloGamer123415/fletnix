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

// function searchForMovies($title, $director, $genre, $yearKeyword, $year) {
// 	$filters = [];

// 	if ( isset($title) ) {
// 		$filters[] = ""
// 	}
// }
