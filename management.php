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

//// Just a random query to get picid 
// $id_of_pic = $pdo->query('SELECT user_id FROM picture');
// while($out = $id_of_pic->fetch(PDO::FETCH_ASSOC)){
// 	$pic_id = $out['user_id'];
// }

//// Query for getting id from username so I can compare it to the id of pictures poster
$get_user_id = 'SELECT id FROM user WHERE username=:usname';
$id_query = $pdo->prepare($get_user_id);
$id_query->execute(['usname' => $username]);
$idPost = $id_query->fetch();
foreach($idPost as $rowid){
	$idPost = $rowid;
}


$stmt = $pdo->query('SELECT picid,image,user_id FROM picture');

//// The while loop and its nested foreach is used to display picture and relevant info alongside remove button

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$id = $row['picid'];
	$imagedata = $row['image'];
	$pic_user_id = $row['user_id'];
	echo "<div>";
	echo '<img border="5"src="data:image/png;base64,' .  base64_encode(stripslashes($imagedata))  . '" />';
	$_SESSION["picid"] = $id;

	//// Get id of the picture

	$get_pics_desc = "SELECT user_id FROM picture WHERE picid=:picid";
	$get_pic_descQuery = $pdo->prepare($get_pics_desc);
	$get_pic_descQuery->execute(['picid' => $id]);
	$descPost = $get_pic_descQuery->fetch(PDO::FETCH_ASSOC);
	
	//// Get username and email of user who posted that picture

	$get_user_info = 'SELECT username, mail FROM user WHERE id=:id';
	$get_user_query = $pdo->prepare($get_user_info);
	$get_user_query->execute(['id' => $descPost['user_id']]);
	$post = $get_user_query->fetch();
	
	?>
	<form action='remove.php' method="post">
		<!-- Check if current user is the one who uploaded the picture he sees, if he is let him delete it -->
	<?php if($pic_user_id == $idPost) {
	echo "<input type='submit' value='remove'>";
	?>
	<?php	} foreach($post as $rows) {
		echo $rows . "<br>";
		} ?>
	</form>
	<?php   
 	echo "</div>";
	}
	
	

 



 ?>
<img src = <?php $imagedata ?> >


</body>
</html>




