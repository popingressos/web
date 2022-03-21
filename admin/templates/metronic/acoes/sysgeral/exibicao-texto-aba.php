<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";
$abaGet = $_GET['abaS'];
$idsysusuGet = $_GET['idsysusuS'];


$insert = mysql_query("INSERT INTO ".$linguagem_set."".$modGet."_textos_aba (idsysusu,aba) 
													VALUES 
												   ('".$idsysusuGet."','".$abaGet."')");

?>
