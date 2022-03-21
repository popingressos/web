<?php
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";

$campoGet = $_GET['campoS'];
$campoBdGet = $_GET['campoBdS'];
$tipoGet = $_GET['tipoS'];

$nSql = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."_ordenacao"));

$ordemGet = $nSql + 1;

$insert = mysql_query("INSERT INTO ".$linguagem_set."".$modGet."_ordenacao (ordem,campo,campo_bd,tipo,stat,data,dataModificacao) 
													VALUES 
												   ('".$ordemGet."','".$campoGet."','".$campoBdGet."','".$tipoGet."','1','".$data."','".$data."')");

include("ordenacao-lista.php");
?>
