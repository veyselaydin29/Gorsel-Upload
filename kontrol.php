<?php
$myfile = fopen("kurulum.ini", "r") or die("kurulum.ini dosyası açılamadı!");
$kontrol = fread($myfile,filesize("kurulum.ini"));
fclose($myfile);
?>