<?
if(trim($_GET['numeroUnico_paiS'])=="") {
	$numeroUnico_paiS = $numeroUnicoGerado;
	$_GET['chave_urlS'] = $chave_url;
} else {
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
	
	$numeroUnico_paiS = $_GET['numeroUnico_paiS'];
	$_GET['chave_urlS'] = $_GET['chave_urlS'];
}

$contLotes = 0;
$carrinhoArray = unserialize($_SESSION['eventos_lotes_'.$_GET['chave_urlS'].''.$numeroUnico_paiS.'']);
foreach ($carrinhoArray as $key => $value) {
	$contLotes++;
}
?>
<input type="hidden" id="eventos_lotes_lista" value="<?=$contLotes?>" />
