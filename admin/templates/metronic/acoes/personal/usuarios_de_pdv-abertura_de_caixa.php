<?
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$insert = mysql_query("INSERT INTO pdv_fluxo_caixa (
													   numeroUnico,
													   numeroUnico_usuario_master,
													   numeroUnico_usuario,
													   numeroUnico_finger,
													   tipo_operacao,
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
													   '".$sysusu['numeroUnico']."', 
													   '".$_GET['numeroUnico_fingerS']."',
													   'ABERTURA',
													   '0.00', 
													   '".$_GET['valor_atualS']."', 
													   'Fechamento executado via sistema administrativo pelo usuário ".$sysusu['nome']."', 
													   '".$data."',
													   '".$data."'
													   )");
?>

