<?php


$host = "localhost";
$name = "root";
$pw = "Marcel123";
$dbname = 'user';
$uname = $_POST['usrnm'];
$psw = $_POST['psw'];
// SET DSN
$dsn = 'mysql:host='. $host .';dbname='. $dbname;
// Create a PDO instance
$pdo = new PDO($dsn, $name, $pw);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


// A query to go through the DB and select the choosen uname and psw,*myb add separate file for 
// searching
$sql = 'SELECT username,password FROM user WHERE username = :uname && password = :psw';
$stmt = $pdo->prepare($sql);
$stmt->execute(['uname' => $uname, 'psw'=> $psw]);
$post = $stmt->fetch();
//if the login info is correct create a session and set cookies if choosen so.
if($post){
	echo "Logged in succesfully";
	session_start();
	$_SESSION["user"] = $uname;
	$_SESSION["loggedin"] = true;
	
	//try the for loop
	$_SESSION['user_id'] = 0;

	if(!empty($_POST["remember"])) {
	setcookie ("username",$_POST["usrnm"],time()+ 3600);
	setcookie ("password",$_POST["psw"],time()+ 3600);
	#echo "Cookies Set Successfuly" . "<br>";
} else {
	setcookie("username","");
	setcookie("password","");
	#echo "Cookies Not Set";
}
if($_SESSION["loggedin"]){
		header("Location:main.php");
	}
}



?>