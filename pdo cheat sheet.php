<?php 
$host = "localhost";
$name = "root";
$pw = "Marcel123";
$dbname = 'user';

// SET DSN
$dsn = 'mysql:host='. $host .';dbname='. $dbname;

// Create a PDO instance
$pdo = new PDO($dsn, $name, $pw);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

/*
// PDO QUERY
$stmt = $pdo->query('SELECT * FROM user');

//while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//	echo $row['username'] . '<br>';
//}

while($row = $stmt->fetch()){
	?>

	<h1><?php echo $row->username . '<br>'; ?> </h1>
	<h2><?php echo $row->mail . '<br>'; ?> </h2>
	<?php

}
*/

# PREPARED STATEMENTS (prepare & execute)

// UNSAFE, DON'T USE!
//$sql = "SELECT * FROM users WHERE username = '$username' ";

// FETCH MULTIPLE POSTS

// User Input
// $uname = "Marcel";
// $pass = "Marcel123";
// $id = 2;
//Postional params

// $sql = 'SELECT * FROM user WHERE username = ?';
// $stmt = $pdo->prepare($sql);
// $stmt->execute([$uname]);
// $posts = $stmt->fetchAll();

// Named params

// $sql = 'SELECT * FROM user WHERE username = :uname && password = :pass';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['uname' => $uname, 'pass' => $pass]);
// $posts = $stmt->fetchAll();



// foreach($posts as $post) {
// 	echo $post->username . '<br>';
// }

// FETCH SINGLE POST

// $sql = 'SELECT * FROM user WHERE id = :id';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['id' => $id]);
// $post = $stmt->fetch();
// echo $post->username;

// GET ROW COUNT 
// $stmt = $pdo->prepare('SELECT * FROM user WHERE password = ?');
// $stmt->execute([$pass]);
// $postCount = $stmt->rowCount();

// echo $postCount;

// INSERT DATA

// $username = 'user';
// $password = 'user123';
// $repsw = 'user123';
// $mail = 'user@gmail.com';

// $sql = 'INSERT INTO user(username, password, repsw, mail) VALUES (:username, :password, :repsw, :mail)';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['username' => $username, 'password' => $password, 'repsw' => $repsw, 'mail' => $mail]);
// echo 'Post added';


// UPDATE DATA
// $id = 4;
// $username = 'user632';

// $sql = 'UPDATE user SET username = :username WHERE id = :id';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['username' => $username, 'id'=> $id]);
// echo 'Post updated';

// DELETE DATA
// $id = 4;

// $sql = 'DELETE FROM user WHERE id = :id';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['id'=> $id]);
// echo 'Post deleted';

// SEARCH DATA
$search = '%Marcel%';
$sql = 'SELECT * FROM user WHERE password LIKE ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$search]);
$posts = $stmt->fetchAll();

foreach($posts as $post){
	echo $post->username . "<br>";
}





?>