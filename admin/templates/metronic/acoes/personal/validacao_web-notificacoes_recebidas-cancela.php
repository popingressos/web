<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$rSqlModal = mysql_fetch_array(mysql_query("
										SELECT 
											mod_carrinho.id,
											mod_carrinho.numeroUnico,
											mod_carrinho.numeroUnico_evento,
											mod_carrinho.numeroUnico_pessoa,
											mod_carrinho.objetoModificacoes,

											mod_empresa.token AS empresa_token
											
										FROM 
											carrinho_notificacao AS mod_carrinho 
										LEFT JOIN 
											empresa AS mod_empresa ON (mod_empresa.id = mod_carrinho.empresa)
										WHERE 
											mod_carrinho.numeroUnico='".$_GET['numeroUnicoS']."'
										"));

if(trim($rSql['objetoModificacoes'])=="") { } else {
	$modificacoesArray = unserialize($rSql['objetoModificacoes']);
	foreach ($modificacoesArray as $key => $value) {
		$modificacoesControle[] = array("tag" => "modificacoes", 
										"numeroUnico" => "".$value['numeroUnico']."", 
										"idsysusu" => "".$value['idsysusu']."", 
										"numeroUnico_validador" => "".$value['numeroUnico_validador']."", 
										"acao" => "".$value['acao']."", 
										"data" => "".$value['data']."");
	}
}
$modificacoesControle[] = array("tag" => "modificacoes", 
								"numeroUnico" => "".geraCodReturn()."", 
								"idsysusu" => "".$sysusu['id']."", 
								"numeroUnico_validador" => "".$_GET['numeroUnico_validadorS']."", 
								"acao" => "cancelada",
								"data" => "".$data."");
$modificacoesControleSerial = serialize($modificacoesControle);

$numeroUnico_eventoGet = $rSqlModal['numeroUnico_evento'];

$update = mysql_query("
						UPDATE 
							carrinho_notificacao 
						SET 
							numeroUnico_validador='".$_GET['numeroUnico_validadorS']."',
							dataConfirmado=NULL,
							confirmado='0', 
							validador_web='1',
							stat='5', 
							dataCancelado='".$data."',
							numeroUnico_retornos_de_validacao='".$_GET['numeroUnico_retornos_de_validacaoS']."', 
							observacao='".$_GET['motivo_cancelamentoS']."', 
							objetoModificacoes='".$modificacoesControleSerial."', 

							dataModificacao='".$data."' 
						WHERE 
							id='".$rSqlModal['id']."'");

$ConfirmacaoHabilitada = 0;
if($sysusu['id']=="1") {
	$_POST['data_marketing'] = date('Y-m-d H:i:s', strtotime("+0 minutes", strtotime("".date('Y-m-d H:i:s')."")));
} else {
	$_POST['data_marketing'] = date('Y-m-d H:i:s', strtotime("+15 minutes", strtotime("".date('Y-m-d H:i:s')."")));
}
if($ConfirmacaoHabilitada=="1") {
	$rSqlEmpresa = mysql_fetch_array(mysql_query(" SELECT id,token,dominio,nome FROM empresa WHERE token='".$rSqlModal['empresa_token']."'"));
	$rSqlUsuario = mysql_fetch_array(mysql_query(" SELECT * FROM pessoas WHERE numeroUnico='".$rSqlModal['numeroUnico_pessoa']."'"));
	
	$numeroUnico_profissionalGet = "";
	
	$tituloGet = "Comprovante de Cancelamento";
	
$mensagem_whatsSet = "
📣 *Oh-Oh!*
\n🚫Seu QR Code foi cancelado
\n*".$rSqlEmpresa['nome']."* agradece por sua conscientização e para mais detalhes acesse https://".$rSqlEmpresa['dominio'].".
\n_Segue abaixo os dados detalhados do QR Code que foi cancelado_";
	
	$mensagem_emailSet = "
	<b>Oh-Oh!</b>
	<br><br>
	Seu QR Code foi cancelado
	<br><br>
	<b>".$rSqlEmpresa['nome']."</b> agradece por sua conscientização e para mais detalhes acesse <a href=\"https://".$rSqlEmpresa['dominio']."\">".$rSqlEmpresa['dominio']."</a>.
	<br><br>
	<i>Segue abaixo os dados detalhados do QR Code que foi cancelado</i>
	<br><br>";
	
	$numeroUnico_marketingSet = geraCodReturn();
	$_POST['plataforma'] = "envio_de_notificacao";
	$_POST['qtd'] = "1";
	$_POST['qtd_limite'] = "0";
	$_POST['tipo_de_envio'] = "ambas";
	$_POST['tipo_de_envio_notificacao'] = "ambas";
	
	$numeroUnico_eventoSet = $numeroUnico_eventoGet;
	$empresa_idSet = $rSqlEmpresa['id'];
	$empresa_tokenSet = $rSqlEmpresa['token'];
	$filtroSet = "mod_pessoas.numeroUnico=@".$rSqlUsuario['numeroUnico']."@";
	$filtroLimpoSet = str_replace("@","'",$filtroSet);
	
	$insert = mysql_query("INSERT INTO marketing (
													 idsysusu, 
													 empresa,
													 empresa_token,
													 numeroUnico,
													 plataforma,
													 numeroUnico_profissional,
													 numeroUnico_evento,
													 nome,
													 tipo_de_envio,
													 texto,
													 texto_email,
													 filtro,
													 qtd,
													 qtd_limite,
													 processado,
													 enviado,
													 com_qrcode,
													 confirma_notificacao,
													 nao_gerar_carrinho_notificacao,
													 stat,
													 data,
													 dataModificacao
													) VALUES (
													'".$sysusu['id']."', 
													'".$rSqlEmpresa['id']."', 
													'".$rSqlEmpresa['token']."',
													'".$numeroUnico_marketingSet."', 
													'".$_POST['plataforma']."',
													'".$numeroUnico_profissionalGet."', 
													'".$numeroUnico_eventoGet."', 
													'".$tituloGet."',
													'".$_POST['tipo_de_envio_notificacao']."',
													'".$mensagem_whatsSet."',
													'".$mensagem_emailSet."',
													'".$filtroSet."',
													'".$_POST['qtd']."',
													'".$_POST['qtd_limite']."',
													'0',
													'0',
													'0',
													'0',
													'1',
													'1',
													'".$_POST['data_marketing']."',
													'".$_POST['data_marketing']."'
													)");
	
	#include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/atualiza-pacotes_de_utilizacao_utilizado.php");
	$numeroUnico_marketingSet = $numeroUnico_marketingSet;
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-cron/marketing-envia-notificacao.php");
}
?>




