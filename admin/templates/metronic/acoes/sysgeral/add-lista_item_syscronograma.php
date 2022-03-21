<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";

$sufixoGet = $_GET['sufixoS'];
$nomeGet = $_GET['nomeS'];
$textoGet = $_GET['textoS'];

$insert = mysql_query("INSERT INTO ".$modGet."_item (numeroUnico_pai,nome,texto,concluido,aprovado,stat,data) 
													VALUES 
												   ('".$numeroUnicoGet."','".$nomeGet."','".$textoGet."','0','0','1','".$data."')");

include("lista_".$modGet."_item.php");
?>
