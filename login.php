<html>
<body>
<form method = 'post'>
	<input type="text" name="usrnm">
	<input type ="password" name ="psw">
	<input type ="submit">
	<input type="checkbox" name="remember" id="remember"/>
	<label for="remember-me">Remember me</label>
</form>
</body>
</html>

<?php

session_start();
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



$sql = 'SELECT username,password FROM user WHERE username = :uname && password = :psw';
$stmt = $pdo->prepare($sql);
$stmt->execute(['uname' => $uname, 'psw'=> $psw]);
$post = $stmt->fetch();
if($post){
	foreach($post as $row) {
		echo $row . "<br>";
	}
	//try the for loop
	$_SESSION['user_id'] = 0;
	if(!empty($_POST["remember"])) {
	setcookie ("username",$_POST["usrnm"],time()+ 3600);
	setcookie ("password",$_POST["psw"],time()+ 3600);
	echo "Cookies Set Successfuly" . "<br>";
} else {
	setcookie("username","");
	setcookie("password","");
	echo "Cookies Not Set";
}
}



?>