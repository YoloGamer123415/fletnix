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
	// $stmt->bind_param("s", $genre);
	// $stmt->execute();
	// $result = $stmt->get_result();
	// $stmt->close();

	// while( $row = $result->fetch_assoc() ) {
		// $rows[] = $row;
	// }

	// return $rows;

	return dbQuery("SELECT * FROM `movies`;");
}

function getMoviesByGenre($genre) {
	if (!$genre) {
		throw new Exception("No genre given");
	}

	// global $connection;

	// $rows = [];
	// $stmt = $connection->prepare("SELECT * FROM `movies` WHERE `genre` = ?;");
	// $stmt->bind_param("s", $genre);
	// $stmt->execute();
	// $result = $stmt->get_result();
	// $stmt->close();

	// while( $row = $result->fetch_assoc() ) {
		// $rows[] = $row;
	// }

	// return $rows;
	
	return dbQuery(
		"SELECT * FROM `movies` WHERE `genre` = :genre;",
		array(
			":genre" => $genre
		)
	);
}
