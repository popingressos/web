<?
$email = anti_injection($_POST['gestor_login']);
$senha = anti_injection($_POST['gestor_senha']);
$gestor_loginGet = str_replace(" ","",$email);
$gestor_senhaGet = str_replace(" ","",$senha);

$rSqlPdvGestor = mysql_fetch_array(mysql_query("SELECT numeroUnico,master FROM sysusu WHERE email='".$gestor_loginGet."' AND senha='".md5($gestor_senhaGet)."' AND stat='1'"));

$_POST['valor'] = limpa_valor_dinheiro($_POST['valor']);
$_POST['valor_atual'] = limpa_valor_dinheiro($_POST['valor_atual']);

$rSqlPdvUltimaAbertura = mysql_fetch_array(mysql_query("
														SELECT 
															numeroUnico 
														FROM 
															pdv_fluxo_caixa 
														WHERE 
															numeroUnico_usuario='".$sysusu['numeroUnico']."' AND 
															tipo_operacao='ABERTURA' 
														ORDER BY 
															id DESC 
														LIMIT 1
														"));

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
															'".geraCodReturn()."',
															'".$rSqlPdvGestor['numeroUnico']."',
															'".$rSqlPdvUltimaAbertura['numeroUnico']."',
															'".$sysusu['numeroUnico']."',
															'sysusu',
															'FECHAMENTO',
															'".$data."',
															'".$_POST['valor']."',
															'".$data."',
															'".$data."'
														   )");

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
													   '".$rSqlUsuario['numeroUnico']."', 
													   '".$sysusu['numeroUnico']."', 
													   '".$_COOKIE['finger']."',
													   'FECHAMENTO',
													   '".$_POST['valor']."', 
													   '".$_POST['valor_atual']."', 
													   '".$_POST['observacao']."', 
													   '".$data."',
													   '".$data."'
													   )");

$_SESSION['numeroUnicoGerado'] = "";

$chave_gerada = geraCodReturn()."/";
echo"<script>window.open('".$link."".$chave_gerada."".$_REQUEST['var1']."/abertura-de-caixa/','_self','')</script>";
?>

