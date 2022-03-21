<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";
$importanteGet = $_GET['importanteS'];

$update = mysql_query("UPDATE ".$linguagem_set."".$modGet." SET importante='".$importanteGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");
?>
