<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];

#$sql = mysql_query("DELETE FROM sysconfig_links WHERE id='".$idGet."'");
$update = mysql_query("
						UPDATE 
							sysconfig_links 
						SET 
							stat='101', 
							dataModificacao='".$data."' 
						WHERE 
							id='".$idGet."' ");

include("lista_links.php");
?>
