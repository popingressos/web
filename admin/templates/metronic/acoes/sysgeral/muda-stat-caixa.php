<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";
$statGet = $_GET['statS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$modGet." WHERE id='".$idGet."'"));
$itemFluxo = mysql_fetch_array(mysql_query("SELECT * FROM sysfluxo_de_caixa WHERE numeroUnico_pai='".$item['numeroUnico']."'"));

$update = mysql_query("UPDATE ".$linguagem_set."".$modGet." SET stat='".$statGet."',dataModificacao='".$data."' WHERE id='".$item['id']."'");
$updateFluxo = mysql_query("UPDATE sysfluxo_de_caixa SET stat='".$statGet."',dataModificacao='".$data."' WHERE id='".$itemFluxo['id']."'");
?>
