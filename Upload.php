<?php
session_start();



$host = "localhost";
$name = "root";
$pw = "Marcel123";
$dbname = 'user';

// Vars for query
$username = $_SESSION["user"];
// SET DSN --> I'm not sure how this works, have to check it.
$dsn = 'mysql:host='. $host .';dbname='. $dbname;


// Create a PDO instance
$pdo = new PDO($dsn, $name, $pw);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

//// Search for id query


// query to get the id of current user so it's info could be used 
// in pictures description
$findid = "SELECT id FROM user WHERE username = :username";
$findstmt = $pdo->prepare($findid);
$findstmt->execute(['username' => $username]);
// I have overriden the Fetch_obj method with Fetch_assoc so I can
// get the first (and only) element much simpler (without the use of array unpacking or foreach)
$post = $findstmt->fetch(PDO::FETCH_ASSOC);
$id = reset($post);

$timeOfUpload = date("d-y-M");
// $pictureDesc = $_POST["name"];

if (isset($_POST['upload'])) {

	$image_name = $_FILES['image']['name'];
	$imagetmp  = addslashes (file_get_contents($_FILES['image']['tmp_name']));
	$file_type = $_FILES['image']['type'];
	$allowed = array("image/jpg", "image/png");
	if(!in_array($file_type, $allowed)) {
		echo "Only jpg and png is allowed";
	}
	else {
	$sql = 'INSERT INTO picture (image, image_text, user_id, date_uploaded) VALUES(:image, :image_text, :user_id, :date_uploaded)';
	#$sql = 'INSERT INTO image_upload(image'
	$sqlquery = $pdo->prepare($sql);
	$sqlquery->execute(['image' => $imagetmp, 'image_text' => $image_name, 'user_id' => $id, 'date_uploaded' => $timeOfUpload]);
}}
	
		
	
	



#imageOf
/*

if (isset($_POST['upload'])) {
	echo "yes";
 	$image = $_FILES['image']['name'];
 	$image_text = $_POST['image_text'];
 	$target = "/images".basename($image);
  	// Insert the neccessary info into picture base, user_id represents current users    //ingres_fetch_object(result)
	$sql = 'INSERT INTO picture (image, image_text, user_id, date_uploaded) VALUES(:image, :image_text, :user_id, :date_uploaded)';
	#$sql = 'INSERT INTO image_upload(image'
	$sqlquery = $pdo->prepare($sql);
	$sqlquery->execute(['image' => $image, 'image_text' => $image_text, 'user_id' => $id, 'date_uploaded' => $timeOfUpload]);
	if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
		echo "Image uploaded successfuly";
	}
	else {
		echo "Failed to upload the image";
	}
	$stmta = $pdo->query('SELECT * FROM picture');

    while($row = $stmta->fetch(PDO::FETCH_ASSOC)){
    echo $row['image'] . '<br>';
  }
  }
*/
?>