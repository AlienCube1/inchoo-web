<?php
session_start();
//// Start using database config file because this is annoying.

$host = "localhost";
$name = "root";
$pw = "Marcel123";
$dbname = 'user';

$username = $_SESSION['user'];



$dsn = 'mysql:host='. $host .';dbname='. $dbname;

$pdo = new PDO($dsn, $name, $pw);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

// Delete pictures of that account 
// Later add it so that if the user deleted their account, under their picture it says 'user delete account'
			/// Get id of user 
$get_acc = "SELECT id FROM user WHERE username = :username";
$get_stmt = $pdo->prepare($get_acc);
$get_stmt->execute(['username'=> $username]);
$get_id = $get_stmt->fetch(PDO::FETCH_ASSOC);
echo $get_id['id'];



$delete = "DELETE FROM picture WHERE user_id = :id";
$delete_stmt = $pdo->prepare($delete);
$delete_stmt->execute(['id' => $get_id['id']]);

// Delete account
if(isset($_POST['delete'])) {
$sql = 'DELETE FROM user WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['id'=> $get_id['id']]);
echo 'Post deleted';
header("location: logout.php");
}






?>