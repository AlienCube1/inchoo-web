<?php
session_start();
$host = "localhost";
$name = "root";
$pw = "Marcel123";
$dbname = 'user';
$username = $_SESSION['user'];
$new_name = $_POST['user'];




$dsn = 'mysql:host='. $host .';dbname='. $dbname;

$pdo = new PDO($dsn, $name, $pw);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

//// Get ID of user that wants to change name
$sql = "SELECT id FROM user WHERE username = :uname";
$sqlstmt = $pdo->prepare($sql);
$sqlstmt->execute(['uname' => $username]);



//// Change username query
if(isset($_POST['upload'])) {
	$user = 'UPDATE user SET username = :username WHERE username = :old';
	$stmt = $pdo->prepare($user);
	$stmt->execute(['username' => $new_name, 'old'=> $username]);
	$go = true;
	if($go){
		header("location: main.php");
	}
}
