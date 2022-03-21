<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

if(trim($_GET['modS'])=="cepbr_bairro") {
	$del = mysql_query("DELETE FROM ".$_GET['modS']." WHERE id_bairro='".$_GET['numeroUnicoS']."'");
} else {
	$update = mysql_query("
							UPDATE 
								".$_GET['modS']." 
							SET 
								stat='101', 
								dataModificacao='".$data."' 
							WHERE 
								numeroUnico='".$_GET['numeroUnicoS']."' ");
}
?>

