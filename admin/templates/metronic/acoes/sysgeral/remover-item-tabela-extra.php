<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";
$ordemSetGet = $_GET['ordemSetS'];
$ordemGet = $_GET['ordemS'];
$tabelaExtraGet = $_GET['tabelaExtraS'];
$valorTabelaExtraGet = $_GET['valorTabelaExtraS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."".$modGet." WHERE id='".$idGet."'"));

if(trim($ordemSetGet)=="SIM") {
	if(trim($tabelaExtraGet)=="") {
		$qall = mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."");
	} else {
		$qall = mysql_query("SELECT * FROM ".$linguagem_set."".$modGet." id".$tabelaExtraGet."='".$valorTabelaExtraGet."' ");
	}
	while($rall = mysql_fetch_array($qall)) {
		if( $rall['ordem'] > $item['ordem']) {
			$ordem = $rall['ordem'] - 1;
			$update = mysql_query("UPDATE ".$linguagem_set."".$modGet." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
		}
	}
}

$update = mysql_query("
						UPDATE 
							".$linguagem_set."".$modGet." 
						SET 
							stat='101', 
							dataModificacao='".$data."' 
						WHERE 
							id='".$idGet."' ");
#$sql = mysql_query("DELETE FROM ".$linguagem_set."".$modGet." WHERE id='".$idGet."'");

?>
