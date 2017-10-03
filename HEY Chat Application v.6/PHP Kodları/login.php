<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
include 'baglan.php';
$kulAdi = htmlentities(mysqli_real_escape_string($baglan,$_POST["kulAdi"]));
$sifre = htmlentities(mysqli_real_escape_string($baglan,$_POST["sifre"]));

$userSorgu = mysqli_query($baglan,"select * from Login where kuLadi='".$kulAdi."' and kuLsif='".$sifre."'") or die (mysql_error());

$userVarmi = mysqli_num_rows($userSorgu);
if($userVarmi > 0)
{
	echo "Giris basarili";
	while($sonuc = mysqli_fetch_assoc($userSorgu)) {
		echo $sonuc["id"];
	}
}
else
mysqli_close($baglan);
?>