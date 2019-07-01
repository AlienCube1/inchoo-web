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
echo $id;
$timeOfUpload = date("d-y-M");

//// Variables for my picture upload

$imageName = $_FILES["image_of"]["name"];
$imageTmp = addslashes(file_get_contents($_FILES['image_of']['tmp_name']));


//// Insert picture into SQL


if (isset($_POST['upload'])) {
  	// Get image name
  	$imageName = $_FILES['image']['name'];
  	// Get text
  	$imageText = $_POST['image_text'];
  	$imageData = file_get_contents($_FILES['image']['tmp_name']);
  	$imageType = $_FILES["image"]["type"];
  	$theImage = $_POST['image_of'];
  	// Insert the neccessary info into picture base, user_id represents current users    //ingres_fetch_object(result)
	$sql = "INSERT INTO picture (picid, image, image_text, user_id, date_uploaded)           VALUES(:image, :image_text, :user_id, :date_uploaded)";
	$sqlquery = $pdo->prepare($sql);
	$sqlquery->execute(['image' => $ImageTmp, 'image_text' => $imageName, 'user_id' => $id, 'date_uploaded' => $timeOfUpload]);
	if($sqlquery) {
		echo "Picture uploaded successfuly";
	}
	else {
		echo "Picture upload failed";
	}



  }

?>