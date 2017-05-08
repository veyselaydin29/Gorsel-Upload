<?php 
	include("ayar.php");

	$dsn = "mysql:host=$dbsunucu;dbname=$dbadi;charset=$charset";
	$pdo = new PDO($dsn, $dbuser, $dbpass);
 ?>