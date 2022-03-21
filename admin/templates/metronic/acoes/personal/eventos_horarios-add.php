<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

if(trim($_SESSION['eventos_horarios_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].''])=="") { } else {
	$carrinhoArray = unserialize($_SESSION['eventos_horarios_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']);
	foreach ($carrinhoArray as $key => $value) {
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
}

$horario_inicioSet = ''.$_GET['horario_inicio'].'';
for ($i = 1; $i <= $_GET['horario_qtd']; $i++) {
	$ja_existeN = 0;
	if(trim($_SESSION['eventos_horarios_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].''])=="") { } else {
		$carrinhoArray = unserialize($_SESSION['eventos_horarios_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']);
		foreach ($carrinhoArray as $key => $value) {
			if(trim($horario_inicioSet)==trim($value['horario_inicio'])) {
				$ja_existeN++;
			}
		}
	}

	
	$horario_inicio_timeSet = strtotime($horario_inicioSet);
	$horario_fimSet = date('H:i', strtotime('+'.$_GET['horario_periodo'].' minute', strtotime($horario_inicioSet)));
	$horario_fim_timeSet = strtotime($horario_fimSet);
	if($ja_existeN==0) {
		$dataControle[] = array("tag" => "eventos_horarios", 
								"numeroUnico" => "".geraCodReturn()."", 
								"numeroUnico_ticket" => "".$_SESSION['numeroUnico_ticket']."", 
								"horario_tempo" => "".$_GET['horario_periodo']."", 
								"horario_inicio" => "".$horario_inicioSet."", 
								"horario_inicio_time" => $horario_inicio_timeSet, 
								"horario_fim" => "".$horario_fimSet."", 
								"horario_fim_time" => $horario_fim_timeSet, 
								"stat" => "1");
	}
	if(trim($_GET['horario_intervalo'])=="") {
		$_GET['horario_inicio_novo'] = $_GET['horario_periodo'];
	} else {
		$_GET['horario_inicio_novo'] = $_GET['horario_periodo'] + $_GET['horario_intervalo'];
	}
	$horario_inicioSet = date('H:i', strtotime('+'.$_GET['horario_inicio_novo'].' minute', strtotime($horario_inicioSet)));
}

$dataControleSerial = serialize($dataControle);
$_SESSION['eventos_horarios_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].''] = $dataControleSerial;
?>
