<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";

$sufixoGet = $_GET['sufixoS'];
$nomeGet = $_GET['nomeS'];
$textoGet = $_GET['textoS'];

$insert = mysql_query("INSERT INTO ".$modGet."_item (numeroUnico_sysplano,nome,texto,hotsite,stat,data,dataModificacao) 
													VALUES 
												   ('".$numeroUnicoGet."','".$nomeGet."','".$textoGet."','1','1','".$data."','".$data."')");

include("lista_sysplano_item.php");
?>
