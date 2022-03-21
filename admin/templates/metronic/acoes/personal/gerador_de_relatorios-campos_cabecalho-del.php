<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$numeroUnicoItem = geraCodReturn();

$ordemNova=0;
$carrinhoArray = unserialize($_SESSION['campos_cabecalho_'.$_SESSION['numeroUnicoGerado'].'']);
$carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
foreach ($carrinhoArray as $key => $value) {
	if($value['numeroUnico']==$_GET['numeroUnicoS']) { } else {
		$ordemNova++;
		$dataControle[] = array("tag" => "campos_cabecalho", 
								"numeroUnico" => "".$value['numeroUnico']."",
								"ordem" => $ordemNova,
								"label" => $value['label'],
								"local" => $value['local'],
								"campo" => $value['campo'],
								"campo_tag" => "|".$value['campo']."|",
								"stat" => $value['stat']);
	}
}


$dataControleSerial = serialize($dataControle);
$_SESSION['campos_cabecalho_'.$_SESSION['numeroUnicoGerado'].''] = $dataControleSerial;
?>

