<?php 
$host = "localhost";
$name = "root";
$pw = "Marcel123";
$dbname = 'user';


$dsn = 'mysql:host='. $host .';dbname='. $dbname;
$pdo = new PDO($dsn, $name, $pw);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

?>