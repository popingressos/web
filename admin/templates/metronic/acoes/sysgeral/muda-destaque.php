<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";
$destaqueGet = $_GET['destaqueS'];

$update = mysql_query("UPDATE ".$linguagem_set."".$modGet." SET destaque='".$destaqueGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");
?>
