<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$numeroUnicoItem = geraCodReturn();

$carrinhoArray = unserialize($_SESSION['eventos_horarios_'.$_GET['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']);
foreach ($carrinhoArray as $key => $value) {
	if(trim($_GET['numeroUnicoS'])==trim($value['numeroUnico'])) {
		$value['stat'] = $_GET['statS'];
	} else {
		$value['stat'] = $value['stat'];
	}
	$dataControle[] = array("tag" => "eventos_horarios", 
							"numeroUnico" => "".$value['numeroUnico']."", 
							"numeroUnico_ticket" => "".$value['numeroUnico_ticket']."", 
							"horario_tempo" => "".$value['horario_tempo']."", 
							"horario_inicio" => "".$value['horario_inicio']."", 
							"horario_inicio_time" => $value['horario_inicio_time'], 
							"horario_fim" => "".$value['horario_fim']."", 
							"horario_fim_time" => $value['horario_fim_time'], 
							"stat" => "".$value['stat']."");
}


$dataControleSerial = serialize($dataControle);
$_SESSION['eventos_horarios_'.$_GET['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].''] = $dataControleSerial;
?>

