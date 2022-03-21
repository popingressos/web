<?
if(trim($_REQUEST['chave'])=="") {
	if(trim($_GET['chaveS'])=="") {
		$chave_set = $_REQUEST['chave']."";
		$chave_url = $chave_set."/";
	} else {
		$chave_set = $_GET['chaveS']."";
		$chave_url = $chave_set."/";
	}
} else {
	$chave_set = $_REQUEST['chave']."";
	$chave_url = $chave_set."/";
}

?>