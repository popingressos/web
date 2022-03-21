<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$numeroUnicoItem = geraCodReturn();

if($_GET['tipoS']=="mais") {
	$_GET['ordemS'] = $_GET['ordemAtualS'] + 1;
} else {
	$_GET['ordemS'] = $_GET['ordemAtualS'] - 1;
}

$cont=0;
$carrinhoArray = unserialize($_SESSION['campos_cabecalho_'.$_SESSION['numeroUnicoGerado'].'']);
$carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
foreach ($carrinhoArray as $key => $value) {
	if($value['numeroUnico']==$_GET['numeroUnicoS']) { 
		if($_GET['tipoS']=="mais") {
			$value['ordem'] = $value['ordem'] + 1;
		} else {
			$value['ordem'] = $value['ordem'] - 1;
		}
	} else {
		if($_GET['tipoS']=="mais") {
			if($value['ordem'] == $_GET['ordemS']) {
				$value['ordem'] = $value['ordem'] - 1;
			} else if($value['ordem'] > $_GET['ordemS']) {
				$value['ordem'] = $value['ordem'];
			} else if($value['ordem'] < $_GET['ordemS'] && $value['ordem'] > $_GET['ordemAtualS']) {
				$value['ordem'] = $value['ordem'] - 1;
			}
		} else {
			if($value['ordem'] == $_GET['ordemS']) {
				$value['ordem'] = $value['ordem'] + 1;
			} else if($value['ordem'] < $_GET['ordemS']) {
				$value['ordem'] = $value['ordem'];
			} else if($value['ordem'] < $_GET['ordemS'] && $value['ordem'] < $_GET['ordemAtualS']) {
				$value['ordem'] = $value['ordem'] + 1;
			}
		}
	}
	$cont++;

	$dataControle[] = array("tag" => "campos_cabecalho", 
							"numeroUnico" => "".$value['numeroUnico']."",
							"ordem" => $value['ordem'],
							"label" => $value['label'],
							"local" => $value['local'],
							"campo" => $value['campo'],
							"campo_tag" => "|".$value['campo']."|",
							"stat" => $value['stat']);
}


$dataControleSerial = serialize($dataControle);
$_SESSION['campos_cabecalho_'.$_SESSION['numeroUnicoGerado'].''] = $dataControleSerial;
?>

