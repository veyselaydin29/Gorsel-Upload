<?php 
	include("baglan.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Görsel Yükle</title>
</head>
<body>
	<div align="center" style="margin: 250px; border: 2px solid lightgrey;
    border-radius: 15px;">
    	<br>
		<?php
			error_reporting(0);
			$hedef = "uploads/";
			$hedef_dosya = $hedef . basename($_FILES["dosya"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($hedef_dosya,PATHINFO_EXTENSION);
			$yeniDosyaAdi = $hedef . date("Ymdhis").".".$imageFileType;

			if(isset($_POST["submit"])) {
			    $kontrol = getimagesize($_FILES["dosya"]["tmp_name"]);
			    if($kontrol !== false) {
			        $uploadOk = 1;
			    } else {
			        echo "Seçilen dosya görsel değil.";
			        $uploadOk = 0;
			    }
			}
			if (file_exists($hedef_dosya)) {
			    echo "Sistemde bir hata oluştu.";
			    $uploadOk = 0;
			}
			
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Uzantısı JPG, JPEG, PNG, GIF olan görselleri yükleyebilirsiniz";
			    $uploadOk = 0;
			}
			if ($uploadOk == 0) {
			    echo "<br>Görsel yüklenemedi";
			} else {
			    if (move_uploaded_file($_FILES["dosya"]["tmp_name"], $yeniDosyaAdi)) {

					$sql = "insert into gorseller(url) values (?)";
					$pdo->prepare($sql)->execute([$yeniDosyaAdi]);

			    	echo "Dosyanızın adresi <br>";
			    	echo "<textarea autofocus style='resize: none;' rows='2' cols='50'>http://".$dir.$yeniDosyaAdi."</textarea>";
			    } else {
			        echo "Bir hata oluştu";
			    }
			}
			echo "<br><a href='http://".$dir."'>Ana sayfa</a>";
		?>
		


	</div>
</body>
</html>