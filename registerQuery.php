<?php
$host = "localhost";
$name = "root";
$pw = "Marcel123";
$dbname = 'user';

// Vars for query
$username = $_POST["username"];
$password = $_POST["password"];
$repeate =  $_POST["repeatPassword"];
$mail = $_POST["mail"];
$code = rand();
$hashed = md5($password);
// SET DSN --> I'm not sure how this works, have to check in.
$dsn = 'mysql:host='. $host .';dbname='. $dbname;


// Create a PDO instance
$pdo = new PDO($dsn, $name, $pw);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

if($password == $repeate) {
	if(strlen($password) > 7) {
	$sql = 'INSERT INTO user(username, password, mail, code) VALUES (:username, :password, :mail,:code)';
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['username' => $username, 'password' => $hashed, 'mail' => $mail, 'code' => $code]);
	header("location: main.php");
}
	else{
		Echo "Password needs to have at leaset 7 chars";
	}

}



?>