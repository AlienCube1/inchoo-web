<?php
session_start();
unset($_SESSION["loggedin"]);
unset($_SESSION["user"]);
session_destroy();
header("Location: main.php");
die;




?>