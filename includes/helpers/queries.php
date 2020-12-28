<?php
require_once("database.php");

function getMovies() {
	global $connection;
	$movies = $connection->query("SELECT * FROM `movies` LIMIT 6");

	return $movies;
}