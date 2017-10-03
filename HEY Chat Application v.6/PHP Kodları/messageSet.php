<?php
	session_start();
	header('Content-Type: text/html; charset=UTF-8');
	function Baglan($host,$dbname,$dbuser,$dbpass){
		$db = new PDO('mysql:host='.$host.';dbname='.$dbname.'', $dbuser, $dbpass);
		$db->exec("SET CHARSET 'utf8'");
		return $db;
	}
	function KullaniciGet(){
		$db=Baglan("mysql10.000webhost.com","a9896778_heychat","a9896778_heychat","1234+asd");
		if($query = $db->prepare("SELECT * FROM Login where kuLadi='".$_POST["aAdi"]."'")){
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		$db=null;
	}
	function MessageSet($kosul){
		$db=Baglan("mysql10.000webhost.com","a9896778_heychat","a9896778_heychat","1234+asd");
		$kul=KullaniciGet();
		if($query = $db->prepare("insert into Icerik values('','".$_POST["gID"]."','".$kul[0]["id"]."','".$_POST["icerik"]."','')")){
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		$db=null;
	}
	$setMessage=MessageSet($_POST["id"]);
	$yazdir=array();
	$yazdir["posts"]   = array();
	foreach ($setMessage as $message) {
		$post             = array();
		$post["kuLadi"]  = $message["kuLadi"];
		$post["icerik"] = $message["icerik"];
		array_push($yazdir["posts"], $post);
	}
	echo json_encode($yazdir);
?>