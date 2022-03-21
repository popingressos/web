<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";
$statGet = $_GET['statS'];

$update = mysql_query("UPDATE ".$linguagem_set."".$modGet."_cabecalho SET stat='".$statGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");

include("cabecalho-lista.php");
?>
