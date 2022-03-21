<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$nomeGet = $_GET['nomeS'];
$idGet = $_GET['idS'];
$subLocalGet = $_GET['subLocalS'];
$modGet = "".$_GET['modS']."";
$valorGet = $_GET['valorS'];
$cmpReferenciaGet = $_GET['cmpReferenciaS'];
$idReferenciaGet = $_GET['idReferenciaS'];


$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$modGet." WHERE id='".$idGet."'"));

$campo_ref_set = " WHERE ".$cmpReferenciaGet."='".$idReferenciaGet."' ";

$qall = mysql_query("SELECT * FROM ".$modGet." ".$campo_ref_set." ");
while($rall = mysql_fetch_array($qall)) {
	if($rall[''.$nomeGet.''] > $item[''.$nomeGet.'']) {
		$ordem = $rall[''.$nomeGet.''] - 1;
		$update = mysql_query("UPDATE ".$modGet." SET ".$nomeGet."='".$ordem."' WHERE id='".$rall['id']."'");
	}
}

$qall = mysql_query("SELECT * FROM ".$modGet." ".$campo_ref_set." ");
while($rall = mysql_fetch_array($qall)) {
	if($rall[''.$nomeGet.''] >= $_POST[''.$nomeGet.'']) {
		$ordem = $rall[''.$nomeGet.''] + 1;
		$update = mysql_query("UPDATE ".$modGet." SET ".$nomeGet."='".$ordem."' WHERE id='".$rall['id']."'");
	}
}
?>
