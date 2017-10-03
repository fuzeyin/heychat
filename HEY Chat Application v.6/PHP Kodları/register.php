<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
include 'baglan.php';
$kulAdi = htmlentities(mysqli_real_escape_string($baglan,$_POST["kulAdi"]));
$sifre = htmlentities(mysqli_real_escape_string($baglan,$_POST["sifre"]));
$sifreTekrar = htmlentities(mysqli_real_escape_string($baglan,$_POST["sifreTekrar"]));
$mail = $_POST["mail"];
if($mail=="" || $sifre=="" || $sifreTekrar=="" || $kulAdi=="")
{
	echo "Lutfen tum alanlari eksiksiz doldurunuz!";
	return;
}
else if($sifre != $sifreTekrar)
{
	echo "Sifre ve Sifre Tekrari alanlari ayni olmalidir!";
	return;
}

function checkmail($mail){
  return filter_var($mail, FILTER_VALIDATE_EMAIL);
}

if(!checkmail($mail))
{
	echo "Yazdiginiz e-posta adresi geçersiz!";
	return;	
}

$yenikayit = "INSERT INTO Login (kuLadi, kuLsif, kuLmail) values ('".$kulAdi."', '".$sifre."', '".$mail."')";
$sorgu = mysqli_query($baglan,$yenikayit);
if($sorgu){
echo "Kayit islemi tamamlandi.";
return;
}
else{
echo "Bir hata olustu! Lutfen daha sonra tekrar deneyin.";
}
mysqli_close($baglan);
?>