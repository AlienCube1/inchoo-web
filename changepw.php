<?php
session_start();
$host = "localhost";
$name = "root";
$pw = "Marcel123";
$dbname = 'user';




$dsn = 'mysql:host='. $host .';dbname='. $dbname;

$pdo = new PDO($dsn, $name, $pw);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

if(isset($_POST['uploadpw'])) {
echo "yes";
$username = $_SESSION['user'];

//// Get user input from account
$old_pw = $_POST['old_password'];
$new_pw = $_POST['new_password'];

//// Hash old and new password

$hashed = md5($new_pw);
$hashedold = md5($old_pw);


//// Get old pass from base and compare it to $old

$oldpw = "SELECT password FROM user WHERE username = :uname";
$old = $pdo->prepare($oldpw);
$old->execute(['uname' => $username]);
$oldpost = $old->fetch(PDO::FETCH_ASSOC);

$oldpass = $oldpost['password'];
if($oldpass == $hashedold) { 

//// Get ID of user that wants to change pass
$sql = "SELECT id FROM user WHERE username = :uname";

$sqlstmt = $pdo->prepare($sql);
$sqlstmt->execute(['uname' => $username]);


//// Update the password for CURRENT(I forgot to add the 'WHERE' and i updated the password for everyone) user
//// Start backingup tables so this doesn't happen in the future, this could have been bad if it were a bigger database
//// Actually used by someone 

$user = 'UPDATE user SET password = :password WHERE username= :username';
$stmt = $pdo->prepare($user);
$stmt->execute(['password' => $hashed, 'username' => $username]);
$go = true;
if($go){
	header("location: main.php");
		}
	}
}


?>