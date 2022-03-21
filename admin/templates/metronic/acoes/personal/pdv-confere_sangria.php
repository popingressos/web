<?
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$rSqlPdvUltimaAbertura = mysql_fetch_array(mysql_query("
														SELECT 
															numeroUnico,
															data,
															valor AS total 
														FROM 
															pdv_fluxo_caixa 
														WHERE 
															numeroUnico_usuario='".$sysusu['numeroUnico']."' AND 
															numeroUnico_finger='".$_COOKIE['finger']."' AND 
															tipo_operacao='ABERTURA' 
														ORDER BY 
															id DESC 
														LIMIT 1
														"));

$rSqlCaixaAtual = mysql_fetch_array(mysql_query("
												SELECT 
													SUM(valor) AS total 
												FROM 
													pdv_fluxo_caixa_hist 
												WHERE 
													numeroUnico_pdv_fluxo_caixa='".$rSqlPdvUltimaAbertura['numeroUnico']."' AND 
													data > '".$rSqlPdvUltimaAbertura['data']."'
												"));

$rSqlSangriaAtual = mysql_fetch_array(mysql_query("
												SELECT 
													SUM(valor) AS total 
												FROM 
													pdv_fluxo_caixa 
												WHERE 
													numeroUnico_usuario='".$sysusu['numeroUnico']."' AND 
													numeroUnico_finger='".$_COOKIE['finger']."' AND 
													tipo_operacao='SANGRIA' AND 
													data > '".$rSqlPdvUltimaAbertura['data']."'
												"));

$valorEnviado = limpa_valor_dinheiro($_GET['valorS']);

$totalSet = ($rSqlPdvUltimaAbertura['total'] + $rSqlCaixaAtual['total']) - $rSqlSangriaAtual['total'];
$totalSet = limpa_valor_dinheiro(round($totalSet,2));

$soma = ($totalSet * 1) - ($valorEnviado * 1);


if($soma<0) {
	echo "SIM";
} else {
	echo "NAO";
}
?>

