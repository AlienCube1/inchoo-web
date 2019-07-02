<?php
session_start();
$host = "localhost";
$name = "root";
$pw = "Marcel123";
$dbname = 'user';


$dsn = 'mysql:host='. $host .';dbname='. $dbname;

$pdo = new PDO($dsn, $name, $pw);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$user = $_SESSION["user"];
$id = $_SESSION['picid'];

$sql = "DELETE FROM picture WHERE picid = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id'=> $id]);

header("location: main.php");

?>