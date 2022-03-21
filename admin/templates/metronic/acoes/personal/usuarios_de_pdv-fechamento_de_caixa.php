<?
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$_GET['valor_fechamentoS'] = limpa_valor_dinheiro($_GET['valor_fechamentoS']);

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
															'FECHAMENTO',
															'".$data."',
															'".$_GET['valor_fechamentoS']."',
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
													   '".$sysusu['numeroUnico']."', 
													   '".$_GET['numeroUnico_usuarioS']."',
													   '".$_GET['numeroUnico_fingerS']."',
													   'FECHAMENTO',
													   'F',
													   '".$_GET['valor_fechamentoS']."', 
													   '".$_GET['valor_atualS']."', 
													   'Fechamento executado via sistema administrativo pelo usuário ".$sysusu['nome']."', 
													   '".$data."',
													   '".$data."'
													   )");
?>

