<?
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";
$campoGet = $_GET['campoS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."".$modGet." WHERE id='".$idGet."'"));

if(trim($item['numeroUnico'])=="") {
	unlink("".$link."files/".$linguagem_set."".$modGet."/".$item[$campoGet]."");
} else {
	unlink("".$link."files/".$linguagem_set."".$modGet."/".$item['numeroUnico']."/".$item[$campoGet]."");
}

$update = mysql_query("UPDATE ".$linguagem_set."".$modGet." SET ".$campoGet."='',dataModificacao='".$data."' WHERE id='".$idGet."'");

?>
