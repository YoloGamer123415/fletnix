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

function parseResult(array $results) {
	$final = [];

	foreach ($results as $key => $result) {
		$final[$key] = array_filter($result, function($key) {
			return gettype($key) == "string";
		}, ARRAY_FILTER_USE_KEY);
	}

	return $final;
}

// EXAMPLE: dbQuery("{query}", ["{var}" => "{value}"])
function dbQuery(string $query, array $vars = []) {
	global $connection;

	$stmt = $connection->prepare($query);
	foreach ($vars as $var => $value) {
		$type = NULL;

		switch ( gettype($value) ) {
			case 'NULL': {
				$type = PDO::PARAM_NULL;
				break;
			}
			case 'boolean': {
				$type = PDO::PARAM_BOOL;
				break;
			}
			case 'integer': {
				$type = PDO::PARAM_INT;
				break;
			}
			case 'string':
			default: {
				$type = PDO::PARAM_STR;
				break;
			}
		}

		$stmt->bindValue($var, $value, $type);
	}
	$stmt->execute();
	$result = $stmt->fetchAll();

	return parseResult($result);
}
