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


$host = "localhost";
$name = "root";
$pw = "Marcel123";
$dbname = 'user';
$uname = $_POST['usrnm'];
$psw = $_POST['psw'];
// SET DSN
$dsn = 'mysql:host='. $host .';dbname='. $dbname;
echo 'Hello';
// Create a PDO instance
$pdo = new PDO($dsn, $name, $pw);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);




?>