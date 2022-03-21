<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$nomeGet = $_GET['nomeS'];
$idGet = $_GET['idS'];
$subLocalGet = $_GET['subLocalS'];
$modGet = "".$_GET['modS']."";

$rSqlMod = mysql_fetch_array(mysql_query("SELECT id,stat,nome_base,id_construtor_modulo_categoria,armazenar_sys_arquivo FROM _construtor_modulo WHERE stat='1' AND nome_base='".$modGet."'"));
$row_estrutura = mysql_fetch_array(mysql_query("SELECT * FROM ".$modGet."_estrutura LIMIT 1"));

$valorGet = $_GET['valorS'];
$valorGet = caracteres_especiais($valorGet,"");

$update = mysql_query("UPDATE ".$linguagem_set."".$modGet."".$subLocalGet." SET ".$nomeGet."='".$valorGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");

?>
