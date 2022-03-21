<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";

$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."".$modGet." WHERE id='".$idGet."'"));
$itemFluxo = mysql_fetch_array(mysql_query("SELECT * FROM sysfluxo_de_caixa WHERE numeroUnico_pai='".$item['numeroUnico']."'"));

$sql = mysql_query("DELETE FROM ".$linguagem_set."".$modGet." WHERE id='".$idGet."'");
$sqlFluxo = mysql_query("DELETE FROM sysfluxo_de_caixa WHERE id='".$itemFluxo['id']."'");

?>
