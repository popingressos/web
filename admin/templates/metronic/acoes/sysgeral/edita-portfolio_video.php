<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$nomeGet = $_GET['nomeS'];
$linkGet = $_GET['linkS'];
$ordemGet = $_GET['ordemS'];
$modGet = $_GET['modS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$modGet." WHERE id='".$idGet."'"));

$numeroUnicoGet = $item['numeroUnico'];

$qall = mysql_query("SELECT * FROM ".$modGet." WHERE numeroUnico='".$item['numeroUnico']."'");
while($rall = mysql_fetch_array($qall)) {
	if($rall['ordem'] > $item['ordem']) {
		$ordem = $rall['ordem'] - 1;
		$update = mysql_query("UPDATE ".$modGet." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
	}
}

$qall = mysql_query("SELECT * FROM ".$modGet." WHERE numeroUnico='".$item['numeroUnico']."'");
while($rall = mysql_fetch_array($qall)) {
	if($rall['ordem'] >= $ordemGet) {
		$ordem = $rall['ordem'] + 1;
		$update = mysql_query("UPDATE ".$modGet." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
	}
}

$update = mysql_query("UPDATE ".$modGet." SET nome='".$nomeGet."',link='".$linkGet."',ordem='".$ordemGet."',dataModificacao='".$data."' WHERE id='".$item['id']."'");
?>
