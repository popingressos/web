<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM syscronograma_item WHERE id='".$idGet."'"));

$qall = mysql_query("SELECT * FROM syscronograma_item WHERE numeroUnico_pai='".$item['numeroUnico_pai']."'");
while($rall = mysql_fetch_array($qall)) {
	if( $rall['ordem'] > $item['ordem']) {
		$ordem = $rall['ordem'] - 1;
		$update = mysql_query("UPDATE syscronograma_item SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
	}
}

$update = mysql_query("
						UPDATE 
							syscronograma_item 
						SET 
							stat='101', 
							dataModificacao='".$data."' 
						WHERE 
							id='".$idGet."' ");
#$sql = mysql_query("DELETE FROM syscronograma_item WHERE id='".$idGet."'");
?>
