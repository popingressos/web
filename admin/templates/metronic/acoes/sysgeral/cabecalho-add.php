<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";

$nomeGet = $_GET['nomeS'];
$campoGet = $_GET['campoS'];
$campoBdGet = $_GET['campoBdS'];
$tipoGet = $_GET['tipoS'];

$nSql = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."_cabecalho"));

$ordemGet = $nSql + 1;

$insert = mysql_query("INSERT INTO ".$linguagem_set."".$modGet."_cabecalho (ordem,nome,campo,campo_bd,tipo,stat,data,dataModificacao) 
													VALUES 
												   ('".$ordemGet."','".$nomeGet."','".$campoGet."','".$campoBdGet."','".$tipoGet."','1','".$data."','".$data."')");

include("cabecalho-lista.php");
?>
