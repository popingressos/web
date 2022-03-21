<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";
$idsysusuGet = $_GET['idsysusuS'];


$nFav = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."sysfavorito_add WHERE idsysusu='".$idsysusuGet."' AND bd='".$modGet."'"));

if($nFav==0) {
	$insert = mysql_query("INSERT INTO ".$linguagem_set."sysfavorito_add (idsysusu,bd,data,dataModificacao) 
														VALUES 
													   ('".$idsysusuGet."','".$modGet."','".$data."','".$data."')");
	echo "adicionou";													   
} else {
	$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."sysfavorito_add WHERE idsysusu='".$idsysusuGet."' AND bd='".$modGet."'"));
	$sql = mysql_query("DELETE FROM ".$linguagem_set."sysfavorito_add WHERE id='".$item['id']."'");
	echo "removido";													   
}

?>
