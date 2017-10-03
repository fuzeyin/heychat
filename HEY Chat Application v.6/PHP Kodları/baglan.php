<?php
$kullaniciadi="a9896778_heychat";
$sifre= "1234+asd";
$host="mysql10.000webhost.com";
$veritabani="a9896778_heychat";

$baglan=mysqli_connect($host,$kullaniciadi,$sifre);
if(!$baglan) die("MySQL sunucusuna baglanti saglanamadi!");	
mysqli_select_db($baglan,$veritabani) or die ("Veritabanina baglanti saglanamadi!");
?>
