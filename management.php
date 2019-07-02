<!DOCTYPE html>
<html>
<body>
	<form method='post' action='Upload.php' enctype='multipart/form-data'>
    <input type='file' name='image'>
    <input type='text' name='image_text'>
    <input type='submit' value='Submit' name='upload'>
    </form>


<?php
session_start();
$host = "localhost";
$name = "root";
$pw = "Marcel123";
$dbname = 'user';
$username = $_SESSION['user'];
$show_delete = false;

$dsn = 'mysql:host='. $host .';dbname='. $dbname;

$pdo = new PDO($dsn, $name, $pw);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
/*
$get_pics = "SELECT image FROM picture";
$query = $pdo->prepare($get_pics);
$query->execute();

echo "<img src=" . $query . ">";
*/
//// Query for getting username and mail to echo ti
$get_user_info = 'SELECT username, mail FROM user WHERE username=:uname';
$get_user_query = $pdo->prepare($get_user_info);
$get_user_query->execute(['uname' => $username]);
$post = $get_user_query->fetch();


//// Query for getting id from username so I can compare it to the id of pictures poster
$get_user_id = 'SELECT id FROM user WHERE username=:usname';
$id_query = $pdo->prepare($get_user_id);
$id_query->execute(['usname' => $username]);
$idPost = $id_query->fetch();
foreach($idPost as $rowid){
	$idPost = $rowid;
}


$stmt = $pdo->query('SELECT picid,image,user_id FROM picture');

//// Get name and email of user who posted the picture




while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$id = $row['picid'];
	$imagedata = $row['image'];
	$pic_user_id = $row['user_id'];
	#header('Content-type: image/png');
	#echo $imagedata;
	echo "<div>";
	echo '<img border="5"src="data:image/png;base64,' .  base64_encode(stripslashes($imagedata))  . '" />';
	$_SESSION["picid"] = $id;
	$sqlInfo = 'SELECT username, mail FROM user WHERE id = :id';
	$Infostmt = $pdo->prepare($sqlInfo);
    $Infostmt->execute(['id' => $id]);
	$InfostmtPost = $Infostmt->fetchAll();
	
	?>
	<form action='remove.php' method="post">
	<?php if($pic_user_id == $idPost) {
	echo "<input type='submit' value='remove'>";
	?>
	<?php	} foreach($InfostmtPost as $rows) {
		echo "info" . $rows . "<br>";
		} ?>
	</form>
	<?php   
 	echo "</div>";
	}
	
	#echo $imagedata;

 



 ?>
<img src = <?php $imagedata ?> >


</body>
</html>




