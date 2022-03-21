<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";
$sufixoGet = $_GET['sufixoS'];
$localGet = $_GET['localS'];
$subLocalGet = $_GET['subLocalS'];
$nomeGet = $_GET['nomeS'];
$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";
$valorGet = $_GET['valorS'];

$update = mysql_query("UPDATE ".$linguagem_set."".$modGet."".$subLocalGet." SET ".$nomeGet."='".$valorGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");

include("".$localGet."".$subLocalGet.".php");
?>
