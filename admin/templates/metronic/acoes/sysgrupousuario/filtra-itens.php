<?php
#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);
#error_reporting( error_reporting() & ~E_NOTICE );

header('Access-Control-Allow-Origin: *');

include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$modPagina = $_SESSION['mod'];

$buscaArray = json_decode($_GET['busca'], true);
foreach ($buscaArray as $key => $value) {
	$_SESSION[''.$modPagina.''.$value["nome"].''] = $value["valor"];
}

$_SESSION[''.$modPagina.'busca'] = $_GET['busca'];
$_SESSION[''.$modPagina.'pagina'] = 1;

?>



