<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$cmpGet = $_GET['cmpS'];
$cmpDataGet = $_GET['cmpDataS'];
$idGet = $_GET['idS'];
$statGet = $_GET['statS'];
if($statGet==0) {
	$data = "";
}

$update = mysql_query("UPDATE syscronograma_item SET ".$cmpGet."='".$statGet."',".$cmpDataGet."='".$data."' WHERE id='".$idGet."'");
?>
