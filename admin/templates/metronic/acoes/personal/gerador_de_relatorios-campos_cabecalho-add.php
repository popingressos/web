<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/chave.php");

$numeroUnicoItem = geraCodReturn();

$ordemN = 0;
if(trim($_SESSION['campos_cabecalho_'.$_SESSION['numeroUnicoGerado'].''])=="") { 
} else {
	$carrinhoArray = unserialize($_SESSION['campos_cabecalho_'.$_SESSION['numeroUnicoGerado'].'']);
	foreach ($carrinhoArray as $key => $value) {
		$ordemN++;
		$dataControle[] = array("tag" => "campos_cabecalho", 
								"numeroUnico" => "".$value['numeroUnico']."",
								"ordem" => $value['ordem'],
								"label" => $value['label'],
								"local" => $value['local'],
								"campo" => $value['campo'],
								"campo_tag" => "|".$value['campo']."|",
								"stat" => $value['stat']);
									
	}
}
$ordemN++;
$dataControle[] = array("tag" => "campos_cabecalho", 
						"numeroUnico" => "".geraCodReturn()."",
						"ordem" => $ordemN,
						"label" => $_POST['label'],
						"local" => $_POST['local'],
						"campo" => $_POST['campo'],
						"campo_tag" => "|".$_POST['campo']."|",
						"stat" => "1");

$dataControleSerial = serialize($dataControle);
$_SESSION['campos_cabecalho_'.$_SESSION['numeroUnicoGerado'].''] = $dataControleSerial;
?>

