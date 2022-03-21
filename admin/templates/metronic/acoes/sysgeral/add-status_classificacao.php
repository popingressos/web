<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";

$subLocalGet = $_GET['subLocalS'];
$ordemGet = $_GET['ordemS'];
$nomeGet = $_GET['nomeS'];
$numeroUnicoGet = $_GET['numeroUnicoS'];

$qall = mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."".$subLocalGet."");
while($rall = mysql_fetch_array($qall)) {
	if($rall['ordem'] >= $ordemGet) {
		$ordem = $rall['ordem'] + 1;
		$update = mysql_query("UPDATE ".$linguagem_set."".$modGet."".$subLocalGet." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
	}
}

$insert = mysql_query("INSERT INTO ".$linguagem_set."".$modGet."".$subLocalGet." (numeroUnico,ordem,nome,stat,data,dataModificacao) 
													VALUES 
												   ('".$numeroUnicoGet."','".$ordemGet."','".$nomeGet."','1','".$data."','".$data."')");


include("lista_status_classificacao.php");
?>
