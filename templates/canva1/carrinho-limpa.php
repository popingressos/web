<?php
header('Access-Control-Allow-Origin: *');

include("".$_SERVER['DOCUMENT_ROOT']."/include/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

#LIMPEZA DA TABELA E VARIÁVEIS DA COMPRA DE TEMPO REAL
$_SESSION['numeroUnico_carrinho'] = "";
$_SESSION['numeroUnico_carrinho'] = geraCodReturn();
$_SESSION['CUPOM_CARRINHO'] = "";
?>
