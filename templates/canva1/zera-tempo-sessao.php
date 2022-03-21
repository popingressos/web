<?php
header('Access-Control-Allow-Origin: *');

include("".$_SERVER['DOCUMENT_ROOT']."/include/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$_SESSION['data_sessao'] = "";
$_SESSION['tempo_sessao'] = "";
$_SESSION['tempo_intervalo'] = "";

$_SESSION['numeroUnico_carrinho'] = ""; 
$_SESSION['numeroUnico_carrinho'] = geraCodReturn(); 

?>



