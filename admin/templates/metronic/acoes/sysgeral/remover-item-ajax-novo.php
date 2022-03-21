<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$numeroUnicoGet = "".$_GET['numeroUnicoS']."";
$sufixoGet = $_GET['sufixoS'];
$localGet = $_GET['localS'];
$subLocalGet = $_GET['subLocalS'];
$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";
$ordemSetGet = $_GET['ordemSetS'];
$ordemGet = $_GET['ordemS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."".$subLocalGet." WHERE id='".$idGet."'"));

if(trim($ordemSetGet)=="SIM") {
	$qall = mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."".$subLocalGet."");
	while($rall = mysql_fetch_array($qall)) {
		if( $rall['ordem'] > $item['ordem']) {
			$ordem = $rall['ordem'] - 1;
			$update = mysql_query("UPDATE ".$linguagem_set."".$modGet."".$subLocalGet." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
		}
	}
}

$update = mysql_query("
						UPDATE 
							".$linguagem_set."".$modGet."".$subLocalGet." 
						SET 
							stat='101', 
							dataModificacao='".$data."' 
						WHERE 
							id='".$idGet."' ");
#$sql = mysql_query("DELETE FROM ".$linguagem_set."".$modGet."".$subLocalGet." WHERE id='".$idGet."'");

include("".$localGet."".$subLocalGet.".php");
?>
