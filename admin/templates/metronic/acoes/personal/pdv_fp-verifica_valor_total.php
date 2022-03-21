<?
if(trim($_GET['numeroUnico_paiS'])=="") {
	$numeroUnico_paiS = $numeroUnicoGerado;
} else {
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");
	
	$numeroUnico_paiS = $_GET['numeroUnico_paiS'];
}

$_GET['valorS'] = limpa_valor_dinheiro($_GET['valorS']);

$totalSet = 0;
$carrinhoArray = unserialize($_SESSION['pdv_lista_'.$numeroUnico_paiS.'']);
$carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
foreach ($carrinhoArray as $key => $value) {
	$totalSet = $totalSet + $value['valor'];
}

$totalFpSet = 0;
$carrinhoArray = unserialize($_SESSION['pdv_fp_'.$numeroUnico_paiS.'']);
$carrinhoArray = array_sort($carrinhoArray, 'valor', SORT_ASC);
foreach ($carrinhoArray as $key => $value) {
	$totalFpSet = $totalFpSet + $value['valor'];
}

$totalRestanteSet = $totalSet - ($totalFpSet + $_GET['valorS']);

if($totalRestanteSet<0) {
	$gravaSet = "NAO";
} else {
	$gravaSet = "SIM";
}

echo "".$gravaSet."";
?>
