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

echo <<<EOF
host: "$host"<br>
username: "$username"<br>
password: "$password"<br>
database: "$database"<br>
EOF;

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
	die("Connection to database failed: " . $connection->connect_error);
} else {
	echo "Connected to database!";
}
