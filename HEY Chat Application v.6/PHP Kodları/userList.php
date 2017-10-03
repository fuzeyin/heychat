<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
function Baglan($host,$dbname,$dbuser,$dbpass){
	$db = new PDO('mysql:host='.$host.';dbname='.$dbname.'', $dbuser, $dbpass);
   	$db->exec("SET CHARSET 'utf8'");
	return $db;
}
function UserListele($kosul){
$db=Baglan("mysql10.000webhost.com","a9896778_heychat","a9896778_heychat","1234+asd");
if($query = $db->prepare("SELECT * FROM Login WHERE id <>".$kosul)){
	$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
}
$db=null;
}
$userSorgu=UserListele($_POST["id"]);
$yazdir=array();
$yazdir["posts"]   = array();
foreach ($userSorgu as $user) {
	$post             = array();
	$post["kuLid"]  = $user["id"];
	$post["kuLadi"]  = $user["kuLadi"];
	$post["kuLadi"]  = $user["kuLadi"];
	$post["kuLsif"] = $user["kuLsif"];
	$post["kuLmail"]    = $user["kuLmail"];
	array_push($yazdir["posts"], $post);
}
echo json_encode($yazdir);
?>