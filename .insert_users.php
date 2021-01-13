<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("./includes/helpers/database.php");

$users = array(
	0 => array(
		"first_name" => "Vincent",
		"last_name" => "Brouwer",
		"email" => "kipsensatie@gmail.com",
		"password" => password_hash("apenbouteke123", PASSWORD_DEFAULT),
	),
	1 => array(
		"first_name" => "Joram",
		"last_name" => "Buitenhuis",
		"email" => "jorambuitenhuis@gmail.com",
		"password" => password_hash("Doos123!", PASSWORD_DEFAULT),
	),
	2 => array(
		"first_name" => "Denise",
		"last_name" => "Kolkman",
		"email" => "denise.kolkman@gmail.com",
		"password" => password_hash("G0edW8w00rd!", PASSWORD_DEFAULT),
	),
	3 => array(
		"first_name" => "<span style=\"color: #ff0000\">Henk</span>",
		"last_name" => "de Hacker",
		"email" => "henkdehacker@anonymous.com",
		"password" => password_hash("hackerboi", PASSWORD_DEFAULT),
	),
);

var_dump($users);

// echo "<h1>Hey</h1>";

// foreach($users as $user) {
	// $res = dbQuery(
	// 	"INSERT INTO `users` (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)",
	// 	array(
	// 		":first_name" => $user["first_name"],
	// 		":last_name" => $user["last_name"],
	// 		":email" => $user["email"],
	// 		":password" => $user["password"],
	// 	),
	// 	true,
	// );

	// var_dump($res);
// 	echo "<br><br>";
// }
