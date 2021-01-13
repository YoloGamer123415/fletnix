<?php
require_once("database.php");

function getMovies() {
	return dbQuery("SELECT * FROM `movies` LIMIT 6;");
}

function getAllMovies() {
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

function getAllGenres() {
	return dbQuery("SELECT id, nederlands FROM `genres`;");
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

function getUser($email) {
	return dbQuery(
		"SELECT * FROM `users` WHERE `email` = :email",
		array(
			":email" => $email,
		)
	);
}

function addUser($firstName, $lastName, $email, $password) {
	dbQuery(
		"INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`) VALUES (':firstName', ':lastName', ':email', ':password')",
		array(
			":firstName" => $firstName,
			":lastName" => $lastName,
			":email" => $email,
			":password" => password_hash($password, PASSWORD_DEFAULT)
		),
		true
	);
}