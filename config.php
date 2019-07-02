<?php 
$host = "localhost";
$username = "root";
$password = "hjH3H5Aj";
$dbname = 'user';

// SET DSN
$dsn = 'mysql:host='. $host .';dbname='. $dbname;

// Create a PDO instance
$pdo = new PDO($dsn, $username, $password);

// PDO QUERY
$stmt = $pdo->query('SELECT * FROM users');

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo $row['username'] . '<br>';
}

?>