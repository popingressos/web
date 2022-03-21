<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";
$ordemSetGet = $_GET['ordemSetS'];
$ordemGet = $_GET['ordemS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."".$modGet." WHERE id='".$idGet."'"));
$item_sys_arquivo = mysql_fetch_array(mysql_query("SELECT * FROM sys_arquivo WHERE numeroUnico='".$item['numeroUnico']."'"));

if(trim($ordemSetGet)=="SIM") {
	$qall = mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."");
	while($rall = mysql_fetch_array($qall)) {
		if( $rall['ordem'] > $item['ordem']) {
			$ordem = $rall['ordem'] - 1;
			$update = mysql_query("UPDATE ".$linguagem_set."".$modGet." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
		}
	}
}

$qSql = mysql_query("SELECT * FROM sysmidia WHERE numeroUnico_item_pai='".$item['numeroUnico']."'");
while($rSql = mysql_fetch_array($qSql)) {

	if($rSql['tipo']=="folder") {
		$item_folder = mysql_fetch_array(mysql_query("SELECT * FROM sysmidia WHERE id='".$rSql['id']."'"));

		$qSqlFile = mysql_query("SELECT * FROM sysmidia WHERE numeroUnico_pai='".$item_folder['numeroUnico']."' AND tipo='file'");
		while($rSqlFile = mysql_fetch_array($qSqlFile)) {
			remove_arquivo("../../../../","sysmidia",$rSqlFile['id'],"arquivo",""); 
		}
		
		remove_pasta_arvore("../../../../","sysmidia",$rSql['id'],"");
	
		$update = mysql_query("UPDATE sysmidia SET lixeira='1' WHERE id='".$rSql['id']."'");
		$sql = mysql_query("DELETE FROM sysmidia WHERE id='".$rSql['id']."'");
	} else {
		remove_arquivo("../../../../","sysmidia",$rSql['id'],"arquivo",""); 
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

$update = mysql_query("
						UPDATE 
							sys_arquivo 
						SET 
							stat='101', 
							dataModificacao='".$data."' 
						WHERE 
							id='".$item_sys_arquivo['id']."' ");

#$sql = mysql_query("DELETE FROM ".$linguagem_set."".$modGet." WHERE id='".$idGet."'");
#$sql = mysql_query("DELETE FROM sys_arquivo WHERE id='".$item_sys_arquivo['id']."'");
$update = mysql_query("UPDATE sysmidia SET lixeira='1' WHERE numeroUnico='".$item['numeroUnico']."'");
#$sql = mysql_query("DELETE FROM sysmidia WHERE numeroUnico='".$item['numeroUnico']."'");

?>
