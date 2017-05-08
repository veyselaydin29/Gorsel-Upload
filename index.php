<?php
	include("kontrol.php");
	if ($kontrol == 0) {
		header('Location: kurulum.php');
		die(); //neden die(); kullandık
		#http://thedailywtf.com/articles/WellIntentioned-Destruction
	}
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
		<p>Sadece şu uzantılar;<br>JPG - JPEG - PNG - GIF</p>
		
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<input type="file" name="dosya">
			<input type="submit" value="Yükle" name="submit">
		</form>
		<br>
	</div>

</body>
</html>