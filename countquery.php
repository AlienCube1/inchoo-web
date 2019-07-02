<?php
include 'config.php';

$nRows = $pdo->query('SELECT COUNT(*) FROM picture')->fetchColumn(); 
echo $nRows;

?>