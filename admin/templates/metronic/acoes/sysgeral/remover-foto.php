<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$listaIdGet = str_replace("||","','",$_GET['listaIdS']);
$listaIdGet = str_replace("|","'",$listaIdGet);
$modGet = "".$_GET['modS']."";

$qSql = mysql_query("SELECT * FROM ".$linguagem_set."".$modGet." WHERE id IN (".$listaIdGet.")");
while($rSql = mysql_fetch_array($qSql)) {

	$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."".$modGet." WHERE id='".$rSql['id']."'"));

	$qall = mysql_query("SELECT * FROM ".$linguagem_set."".$modGet." WHERE numeroUnico='".$item['numeroUnico']."'");
	while($rall = mysql_fetch_array($qall)) {
		if( $rall['ordem'] > $item['ordem']) {
			$ordem = $rall['ordem'] - 1;
			$update = mysql_query("UPDATE ".$linguagem_set."".$modGet." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
		}
	}


	$update = mysql_query("
							UPDATE 
								".$linguagem_set."".$modGet." 
							SET 
								stat='101', 
								dataModificacao='".$data."' 
							WHERE 
								id='".$item['id']."' ");
	#$sql = mysql_query("DELETE FROM ".$linguagem_set."".$modGet." WHERE id='".$item['id']."'");
}

?>
