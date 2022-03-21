<?php
header('Access-Control-Allow-Origin: *');

if(trim($_GET['reloadS'])=="1") {
	include("".$_SERVER['DOCUMENT_ROOT']."/include/sess.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");
}


$cont_carrinho=0;
$carrinhoArray = unserialize($_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].'']);
$carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
foreach ($carrinhoArray as $key => $value) {
	$cont_carrinho++;
}
echo $cont_carrinho;
?>
