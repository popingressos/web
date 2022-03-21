<?
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$_GET['valor_sangriaS'] = limpa_valor_dinheiro($_GET['valor_sangriaS']);

$insert = mysql_query("INSERT INTO pdv_fluxo_caixa_hist (
															numeroUnico,
															numeroUnico_usuario_master,
															numeroUnico_fluxo_caixa,
															numeroUnico_usuario,
															tipoMaster,
															tipoOperacao,
															dataOperacao,
															valorOperacao,
															data,
															dataModificacao
														   ) 
														   VALUES 
														   (
															'".$numeroUnicoGet."',
															'".$sysusu['numeroUnico']."',
															'".$_GET['numeroUnico_fluxo_caixaS']."',
															'".$_GET['numeroUnico_usuarioS']."',
															'sysusu',
															'SANGRIA',
															'".$data."',
															'".$_GET['valor_sangriaS']."',
															'".$data."',
															'".$data."'
														   )");

$insert = mysql_query("INSERT INTO pdv_fluxo_caixa (
													   numeroUnico,
													   numeroUnico_usuario_master,
													   numeroUnico_usuario,
													   numeroUnico_finger,
													   tipo_operacao,
													   status,
													   valor,
													   valor_atual,
													   observacao,
													   data,
													   dataModificacao
													   ) 
													   VALUES 
													   (
													   '".geraCodReturn()."', 
													   '', 
													   '".$_GET['numeroUnico_usuarioS']."',
													   '".$_GET['numeroUnico_fingerS']."',
													   'SANGRIA',
													   'S',
													   '".$_GET['valor_sangriaS']."', 
													   '".$_GET['valor_atualS']."', 
													   'Sangria executada via sistema administrativo pelo usuário ".$sysusu['nome']."', 
													   '".$data."',
													   '".$data."'
													   )");
?>

