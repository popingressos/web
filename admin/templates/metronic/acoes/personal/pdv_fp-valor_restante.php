<?
if(trim($_GET['numeroUnico_paiS'])=="") {
	$numeroUnico_paiS = $numeroUnicoGerado;
} else {
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");
	
	$numeroUnico_paiS = $_GET['numeroUnico_paiS'];
}

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

$totalRestanteSet = $totalSet - $totalFpSet;

if($totalFpSet>$totalSet) {
	$pagamentoMaiorSet = "SIM";
} else {
	$pagamentoMaiorSet = "NAO";
}

if($totalRestanteSet>0) {
	$mostraSet = "SIM";
} else {
	$mostraSet = "NAO";
}

echo "".$pagamentoMaiorSet."||".$mostraSet."||R$ ".number_format($totalRestanteSet, 2, ',', '.')."||".$totalFpSet."||".$totalSet."";
?>
