<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";

$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."_cabecalho WHERE id='".$idGet."'"));

$qall = mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."_cabecalho");
while($rall = mysql_fetch_array($qall)) {
	if( $rall['ordem'] > $item['ordem']) {
		$ordem = $rall['ordem'] - 1;
		$update = mysql_query("UPDATE ".$linguagem_set."".$modGet."_cabecalho SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
	}
}

$sql = mysql_query("DELETE FROM ".$linguagem_set."".$modGet."_cabecalho WHERE id='".$idGet."'");

include("cabecalho-lista.php");
?>
