<?php
	session_start();
	header('Content-Type: text/html; charset=UTF-8');
	function Baglan($host,$dbname,$dbuser,$dbpass){
		$db = new PDO('mysql:host='.$host.';dbname='.$dbname.'', $dbuser, $dbpass);
		$db->exec("SET CHARSET 'utf8'");
		return $db;
	}
	
	function KullaniciAdiGetId($id){
		$db=Baglan("mysql10.000webhost.com","a9896778_heychat","a9896778_heychat","1234+asd");
		if($query = $db->prepare("SELECT * FROM Login where id=".$id)){
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			return $result[0]["kuLadi"];
		}
		$db=null;
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
		if($query = $db->prepare("SELECT Icerik.icerik,Login.kuLadi,Icerik.gNiD,Icerik.aLiD,case Icerik.gNiD when ".$_POST["gID"]." then '".KullaniciAdiGetId($_POST["gID"])."' when ".$kul[0]["id"]." then '".KullaniciAdiGetId($kul[0]["id"])."' end as gAdi FROM Icerik inner join Login on Icerik.gNiD=Login.id WHERE (gNiD = ".$_POST["gID"]." and aLiD=".$kul[0]["id"].") or (gNiD = ".$kul[0]["id"]." and aLiD=".$_POST["gID"].") order by Icerik.id asc")){
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
		$post["gAdi"]  = $message["gAdi"];
		$post["gNiD"]  = $message["gNiD"];
		$post["aLiD"]  = $message["aLiD"];
		$post["icerik"] = $message["icerik"];
		array_push($yazdir["posts"], $post);
	}
	echo json_encode($yazdir);
?>	