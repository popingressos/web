<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";
$ordemGet = $_GET['ordemS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."_cabecalho WHERE id='".$idGet."'"));

$qall = mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."_cabecalho");
while($rall = mysql_fetch_array($qall)) {
	if($rall['ordem'] > $item['ordem']) {
		$ordem = $rall['ordem'] - 1;
		$update = mysql_query("UPDATE ".$linguagem_set."".$modGet."_cabecalho SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
	}
}

$qall = mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."_cabecalho");
while($rall = mysql_fetch_array($qall)) {
	if($rall['ordem'] >= $ordemGet) {
		$ordem = $rall['ordem'] + 1;
		$update = mysql_query("UPDATE ".$linguagem_set."".$modGet."_cabecalho SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
	}
}

$update = mysql_query("UPDATE ".$linguagem_set."".$modGet."_cabecalho SET ordem='".$ordemGet."' WHERE id='".$idGet."'");

include("cabecalho-lista.php");
?>
