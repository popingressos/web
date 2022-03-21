<?php
header('Access-Control-Allow-Origin: *');

include("".$_SERVER['DOCUMENT_ROOT']."/include/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

#$_SESSION['data_sessao'] = "";
#$_SESSION['tempo_sessao'] = "";
#$_SESSION['tempo_intervalo'] = "";

if(trim($_SESSION['data_sessao'])=="") {
	$_SESSION['data_sessao'] = $data;
} else {
	$_SESSION['data_sessao'] = $_SESSION['data_sessao'];
}

$data1 = $_SESSION['data_sessao'];
$data2 = $data;

$intervalo = diferenca_entre_datas_DATE_Return($data1, $data2);

$_SESSION['tempo_sessao'] = $intervalo;
$_SESSION['tempo_intervalo'] = 900 - $intervalo;

?>



