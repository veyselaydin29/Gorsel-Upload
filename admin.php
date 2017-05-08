<?php 
	session_start();
	include("baglan.php");

	if (isset($_POST["giris"])) {
		$kadi = $_POST["kadi"];
		$sifre = $_POST["sifre"];

		$stmt = $pdo->prepare("select * from admin where kadi = ?");
		$stmt->execute([$kadi]);
		$cikti = $stmt->fetch(PDO::FETCH_ASSOC);

		if($sifre == $cikti['sifre']) {
			$_SESSION['kadi'] = $kadi;
			panel();	
		}

	}

	if (isset($_POST["cikis"])) {
		if (isset($_SESSION["kadi"])) {
			session_unset($_SESSION["kadi"]);
		}
		session_destroy();
	}
	if(isset($_POST["sifreDegis"])) {
		    				$kadi = $_SESSION['kadi'];
		    				$yeniSifre = $_POST["yeniSifre"];
		    				$yeniSifreTekrar = $_POST["yeniSifreTekrar"];


							if (isset($_POST["yeniSifre"]) && isset($_POST["yeniSifreTekrar"])) {
								if ($_POST["yeniSifre"] == $_POST["yeniSifreTekrar"]) {
									$sql = "update admin set sifre = ? where kadi = ?";
									$pdo->prepare($sql)->execute([$yeniSifre, $kadi]);
									echo '<p><font color="green">Şifreniz başarıyla değiştirildi</font></p>';
									panel();
								}else{
									echo '<p><font color="red">Şifreler uyuşmuyor</font></p>';
									panel();
								}
							}else{
								echo '<p><font color="red">Formu eksiksiz doldurduğunuzdan emin olun</font></p>';
								panel();
							}
						}
	
	if (isset($_POST["sil"])) {
		$id=$_POST["id"];
		$url=$_POST["url"];
		$sql = "delete from gorseller where id=?";
		$pdo->prepare($sql)->execute([$id]);
		unlink($url);
		panel();
	}

	function panel(){
		echo '<div align="center" style="margin-left: 250px; margin-right: 250px; margin-top: 100px; border: 2px solid lightgrey;
		    border-radius: 15px;">
		    		<form action="admin.php" method="post"> 
		    			<p>
				    		<input type="password" name="yeniSifre" placeholder="Yeni Şifre">
							<input type="password" name="yeniSifreTekrar" placeholder="Yeni Şifre Tekrar">
							<input type="submit" name="sifreDegis" value="Şifre Değiştir">
							<form action="admin.php" method="post"><input type="submit" name="cikis" value="Çıkış"></form>
						</p>
					</form>
					</div>';
	}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Yönetim</title>
</head>
<body>
	<?php 
		if(isset($_SESSION['kadi'])) {?>
			
			<div align="center" style="margin-left: 250px; margin-right: 250px; margin-top: 10px; border: 2px solid lightgrey;
		    border-radius: 15px;">
				<p>
					<table>
			    	<?php

			    		$stmt = $pdo->query('select * from gorseller ORDER BY id DESC');
						foreach ($stmt as $satir) {

						 	echo "<tr>
						 			<form action='admin.php' method='post'>
										<td><a href='".$satir["url"]."' target='_blank'><img width='100px' height='100px' src='".$satir["url"]."'></a></td>
										<td><input type='submit' name='sil' value='Sil'></td>
										<td><input type='hidden' name='id' value='".$satir["id"]."'></td>
										<td><input type='hidden' name='url' value='".$satir["url"]."'></td>
									</form>
								</tr>";
	
						}

			    	 ?>

			    	 </table>
		    	 </p>
			</div>

		<?php }
		else {?>
			
			<div align="center" style="margin: 250px; border: 2px solid lightgrey;
		    border-radius: 15px;">
				<h1>Giriş</h1>
				
				<form action="admin.php" method="post">
					<input placeholder="Kullanıcı Adınız" type="text" name="kadi"><br>
					<input placeholder="Şifreniz" type="password" name="sifre"><br>
					<input type="submit" value="Giriş" name="giris">
				</form>
				<br>
			</div>

		<?php } ?>
</body>
</html>