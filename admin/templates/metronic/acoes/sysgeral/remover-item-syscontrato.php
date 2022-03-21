<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM syscontrato WHERE id='".$idGet."'"));

$update = mysql_query("UPDATE sysprospecto SET contrato='0',dataModificacao='".$data."' WHERE id='".$item['idsysprospecto']."'");

$sql = mysql_query("DELETE FROM syscontrato WHERE id='".$idGet."'");

?>
