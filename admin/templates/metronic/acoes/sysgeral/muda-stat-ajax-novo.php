<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";
$sufixoGet = $_GET['sufixoS'];
$cmpGet = $_GET['cmpS'];
$cmpDataGet = $_GET['cmpDataS'];
$localGet = $_GET['localS'];
$subLocalGet = $_GET['subLocalS'];
$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";
$statGet = $_GET['statS'];

$update = mysql_query("UPDATE ".$linguagem_set."".$modGet."".$subLocalGet." SET ".$cmpGet."='".$statGet."',".$cmpDataGet."='".$data."' WHERE id='".$idGet."'");

include("".$localGet."".$subLocalGet.".php");
?>
