<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$sufixoGet = $_GET['sufixoS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM syscontrato_modelo WHERE id='".$idGet."'"));

echo $item['texto_1'];

?>

