<?php 
	include("ayar.php");

	$dsn = "mysql:host=$dbsunucu;dbname=$dbadi;charset=$charset";
	$pdo = new PDO($dsn, $dbuser, $dbpass);

	$url = $_SERVER['REQUEST_URI'];
	$parts = explode('/',$url);
	$dir = $_SERVER['SERVER_NAME'];
	for ($i = 0; $i < count($parts) - 1; $i++) {
	 $dir .= $parts[$i] . "/";
	}
 ?>