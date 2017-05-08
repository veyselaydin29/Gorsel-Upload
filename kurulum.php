<?php
	if (!file_exists('uploads')) {
	    mkdir('uploads', 0777, true);
	}
	include("kontrol.php");
	include("ayar.php");
	if ($kontrol != 0) {
		die("Daha önceden kurulum yapılmış. Eğer tekrar kurulum yapmak istiyorsanız 'kurulum.ini' dosyasındaki değeri '0' yapınız");
	}

	if (isset($_POST["kur"])) {

		try {
		    $conn = new PDO("mysql:host=$dbsunucu;charset=$charset", $dbuser, $dbpass);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $sql = "CREATE DATABASE IF NOT EXISTS ".$dbadi;
		    $conn->exec($sql);
		    $sql = "use ".$dbadi;
		    $conn->exec($sql);
		    $sql = "CREATE TABLE IF NOT EXISTS gorseller (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, url VARCHAR(30) NOT NULL, tarih TIMESTAMP) CHARACTER SET utf8 COLLATE utf8_general_ci;";
		    $conn->exec($sql);
		    $sql = "CREATE TABLE IF NOT EXISTS admin (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, kadi VARCHAR(30) NOT NULL, sifre VARCHAR(30) NOT NULL) CHARACTER SET utf8 COLLATE utf8_general_ci;";
		    $conn->exec($sql);
		    $sql = "insert into admin(kadi,sifre) values('admin','admin')";
		    $conn->exec($sql);


		    $myfile = fopen("kurulum.ini", "w") or die("kurulum.ini açılamadı!");
			$txt = "1";
			fwrite($myfile, $txt);
			fclose($myfile);
			echo "<font color='green'>Kurulum başarılı.</font><br>";
			echo "<font color='red'>Kullanıcı adı: admin</font><br>";
			echo "<font color='red'>Şifre: admin</font><br>";
		    echo "<font color='green'><a href='index.php'>Ana sayfa</a> <a href='admin.php'>Yönetim</a></font><br>";
		}
		catch(PDOException $e)
		{
		    echo $sql . "<br>" . $e->getMessage();
		}

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Görsel upload scripti kurulumu</title>
</head>
<body>
	<div align="center" style="margin: 250px; border: 2px solid lightgrey;
    border-radius: 15px;"><br>
    		<form action="kurulum.php" method="post">
    		
    		<p><font color="red">Eğer bağlantı bilgileriniz doğru değilse "ayar.php" dosyasını düzenleyiniz.</font></p>

	    		
	    		<p>Sunucu: <font color="green"><?php echo $dbsunucu ?></font><br>
	    		Database adı: <font color="green"><?php echo $dbadi ?></font><br>
	    		Kullanıcı adı: <font color="green"><?php echo $dbuser ?></font><br>
	    		Şifre: <font color="green">********</font></p>

				<input type="submit" value="Kur" name="kur">
		</form>
		<br>
	</div>
</body>
</html>