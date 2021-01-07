<?php
$fileLines = file($_SERVER["DOCUMENT_ROOT"] . "/credentials.txt");

if ( count($fileLines) != 4 ) {
	$length = count($fileLines);
	$file = $_SERVER["DOCUMENT_ROOT"] . "/credentials.txt";
	$msg = <<<EOF
	Incorrect ammount of data in $file.<br>
	Expected 4 lines, got $length.<br>
	<br>
	File format:<br>
	{{ host }}<br>
	{{ username }}<br>
	{{ password }}<br>
	{{ database }}<br>
	EOF;

	die($msg);
}

$host = trim( $fileLines[0] );
$username = trim( $fileLines[1] );
$password = trim( $fileLines[2] );
$database = trim( $fileLines[3] );

try {
	$connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die("Connection failed: " . $e->getMessage());
}

function _filter($key) {
	return gettype($key) == "string";
}

function parseResult(array $result) {
	return array_filter($result, '_filter', ARRAY_FILTER_USE_KEY);
}

// EXAMPLE: dbQuery("{query}", ["{var}" => "{value}"])
function dbQuery(string $query, array $vars = []) {
	global $connection;

	$stmt = $connection->prepare($query);
	foreach ($vars as $type => $var) {
		$stmt->bindParam($type, $var);
	}
	$stmt->execute();
	$result = $stmt->fetchAll();

	var_dump($result, parseResult($result));

	return parseResult($result);
}
