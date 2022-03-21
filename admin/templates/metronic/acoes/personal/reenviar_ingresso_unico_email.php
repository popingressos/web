<?php
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$rSqlCarrinho = mysql_fetch_array(mysql_query("
												SELECT 
													mod_carrinho.empresa,
													mod_carrinho.empresa_token,

													mod_carrinho.plataforma,
													mod_carrinho.plataforma_token,
													mod_carrinho.cod_voucher,
													mod_carrinho.numeroUnico_evento,
													mod_carrinho.numeroUnico_ticket,

													mod_carrinho.label,
													mod_carrinho.linha,
													mod_carrinho.coluna,
													mod_carrinho.linha_real,
													mod_carrinho.coluna_real,

													mod_carrinho.pessoa_nome,
													mod_carrinho.pessoa_telefone,
													mod_carrinho.pessoa_documento,
													mod_carrinho.pessoa_email,
												
													mod_eventos.nome AS evento_nome,
													mod_eventos.tickets AS evento_tickets,
													mod_eventos.data_de_publicacao AS evento_data_de_publicacao,
													mod_eventos.data_de_despublicacao AS evento_data_de_despublicacao,
													mod_eventos.cep AS evento_cep,
													mod_eventos.rua AS evento_rua,
													mod_eventos.numero AS evento_numero,
													mod_eventos.complemento AS evento_complemento,
													mod_eventos.estado AS evento_estado,
													mod_eventos.cidade AS evento_cidade,
													mod_eventos.bairro AS evento_bairro,
													mod_eventos.bairro AS evento_bairro
											
												FROM 
													carrinho_notificacao AS mod_carrinho
												LEFT JOIN 
													eventos AS mod_eventos ON (mod_eventos.numeroUnico = mod_carrinho.numeroUnico_evento)
												WHERE 
													mod_carrinho.numeroUnico='".$_GET['numeroUnicoS']."'
											"));
$rSqlEmpresa = mysql_fetch_array(mysql_query("SELECT * FROM empresa WHERE id='".$rSqlCarrinho['plataforma']."'"));

$cod_voucherSet = $rSqlCarrinho['cod_voucher'];

#ENVIO DE WHATSAPP
$strSqlSession = "
	SELECT 
		mod_sessoes_de_whatsapp.numeroUnico,
		mod_sessoes_de_whatsapp.session
	
	FROM 
		sessoes_de_whatsapp AS mod_sessoes_de_whatsapp 

	WHERE 
		mod_sessoes_de_whatsapp.status='CONNECTED' AND
		mod_sessoes_de_whatsapp.empresa_token='".$rSqlCarrinho['plataforma_token']."'

	ORDER BY
		RAND ()
";
$rSqlSession = mysql_fetch_array(mysql_query("".$strSqlSession.""));

if(trim($rSqlCarrinho['evento_data_de_publicacao'])=="0000-00-00" && trim($rSqlCarrinho['evento_data_de_despublicacao'])=="0000-00-00") {
	$label_dataPrint = "";
	$data_printSet = "Sem data definida";
} else {
	if(trim($rSqlCarrinho['evento_data_de_publicacao'])=="0000-00-00") {
		if(trim($rSqlCarrinho['evento_data_de_despublicacao'])=="0000-00-00") {
			$label_dataPrint = "";
			$data_printSet = "Sem data definida";
		} else {
			$label_dataPrint = "Data do Evento";
			$data_printSet = "".ajustaDataReturn($rSqlCarrinho['evento_data_de_despublicacao'],"d/m/Y")."";
		}
	} else {
		if(trim($rSqlCarrinho['evento_data_de_despublicacao'])=="0000-00-00") {
			$label_dataPrint = "Data do Evento";
			$data_printSet = "".ajustaDataReturn($rSqlCarrinho['evento_data_de_publicacao'],"d/m/Y")."";
		} else {
			$label_dataPrint = "Data de Início e Fim";
			$data_printSet = "".ajustaDataReturn($rSqlCarrinho['evento_data_de_publicacao'],"d/m/Y")." até ".ajustaDataReturn($rSqlCarrinho['evento_data_de_despublicacao'],"d/m/Y")."";
		}
	}
}

$monta_endereco_print = "";
$monta_endereco_whats = "";

if(trim($rSqlCarrinho['evento_rua'])=="") { } else { $monta_endereco_print .= "<b>Logradouro:</b> ".$rSqlCarrinho['evento_rua'].""; }
if(trim($rSqlCarrinho['evento_numero'])=="") { } else { $monta_endereco_print .= ", ".$rSqlCarrinho['evento_numero'].""; }
if(trim($rSqlCarrinho['evento_bairro'])=="") { } else { $monta_endereco_print .= "<br><b>Bairro:</b> ".$rSqlCarrinho['evento_bairro'].""; }
if(trim($rSqlCarrinho['evento_cidade'])=="") { } else { $monta_endereco_print .= "<br><b>Cidade:</b> ".$rSqlCarrinho['evento_cidade'].""; }
if(trim($rSqlCarrinho['evento_estado'])=="") { } else { $monta_endereco_print .= "/".$rSqlCarrinho['evento_estado'].""; }
if(trim($rSqlCarrinho['evento_cep'])=="") { } else { $monta_endereco_print .= "<br><b>CEP:</b> ".$rSqlCarrinho['evento_cep'].""; }

if(trim($rSqlCarrinho['evento_rua'])=="") { } else { $monta_endereco_whats .= "_Logradouro:_ ".$rSqlCarrinho['evento_rua'].""; }
if(trim($rSqlCarrinho['evento_numero'])=="") { } else { $monta_endereco_whats .= ", ".$rSqlCarrinho['evento_numero'].""; }
if(trim($rSqlCarrinho['evento_bairro'])=="") { } else { $monta_endereco_whats .= " \n _Bairro:_ ".$rSqlCarrinho['evento_bairro'].""; }
if(trim($rSqlCarrinho['evento_cidade'])=="") { } else { $monta_endereco_whats .= " \n _Cidade:_ ".$rSqlCarrinho['evento_cidade'].""; }
if(trim($rSqlCarrinho['evento_estado'])=="") { } else { $monta_endereco_whats .= "/".$rSqlCarrinho['evento_estado'].""; }
if(trim($rSqlCarrinho['evento_cep'])=="") { } else { $monta_endereco_whats .= " \n _CEP:_ ".$rSqlCarrinho['evento_cep'].""; }

include_once("".$_SERVER['DOCUMENT_ROOT']."/admin/include/lib/phpqrcode/qrlib.php");
include_once("".$_SERVER['DOCUMENT_ROOT']."/admin/include/lib/phpqrcode/qrconfig.php");

$ticketArray = unserialize($rSqlCarrinho['evento_tickets']);
$ticketArray = array_sort($ticketArray, 'ticket_data', SORT_ASC);
foreach ($ticketArray as $keyEvento => $valueEvento) {
	if(trim($valueEvento['numeroUnico'])==trim($rSqlCarrinho["numeroUnico_ticket"])) {
		$rSqlEnvio['ingresso_nome'] = $valueEvento['ticket_nome'];
		$rSqlEnvio["ingresso_data"] = $valueEvento['ticket_data'];
	}
}

if(trim($rSqlCarrinho['evento_rua'])=="") { } else { $rSqlSend['evento_rua'] = $rSqlCarrinho['evento_rua']; }
if(trim($rSqlCarrinho['evento_numero'])=="") { } else { $rSqlSend['evento_numero'] = $rSqlCarrinho['evento_numero']; }
if(trim($rSqlCarrinho['evento_bairro'])=="") { } else { $rSqlSend['evento_bairro'] = $rSqlCarrinho['evento_bairro']; }
if(trim($rSqlCarrinho['evento_cidade'])=="") { } else { $rSqlSend['evento_cidade'] = $rSqlCarrinho['evento_cidade']; }
if(trim($rSqlCarrinho['evento_estado'])=="") { } else { $rSqlSend['evento_estado'] = $rSqlCarrinho['evento_estado']; }
if(trim($rSqlCarrinho['evento_cep'])=="") { } else { $rSqlSend['evento_cep'] = $rSqlCarrinho['evento_cep']; }

// generating 
QRcode::png($cod_voucherSet, "".$_SERVER['DOCUMENT_ROOT']."/admin/files/qrcode/".$cod_voucherSet.".jpg", QR_ECLEVEL_L, 4); 

$imagemWhatsSet = "https://www.saguarocomunicacao.com.br/admin/files/qrcode/".$cod_voucherSet.".jpg";

$rSqlSend['whatsapp'] = $rSqlCarrinho['pessoa_telefone'];
$rSqlSend['assunto'] = "Comprovante de Ingresso";

$tipo_documentoSet = "CPF";

$textoWhatsSet  = "Segue abaixo os dados completos do seu ingresso, ";
$textoWhatsSet .= "você deve apresentar o QRCode abaixo, juntamente com documento de comprovação de identidade com foto.\n\n";

$nomeWhatsSet = $rSqlCarrinho['pessoa_nome'];
$documentoWhatsSet = $rSqlCarrinho['pessoa_documento'];

$evento_nomeWhatsSet = $rSqlCarrinho['evento_nome'];
$ingresso_nomeWhatsSet = $rSqlEnvio['ingresso_nome'];


if(trim($rSqlCarrinho['pessoa_email'])=="") { } else {
	#ENVIO DE E-MAIL
	$enviado_emailSet = "1";
	$font_familySet = "font-family: Montserrat,Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Tahoma,sans-serif;";
	
	$texto_emailSet  = "";
	$texto_emailSet .= "[".$retorno_verifica_whatsapp."]Segue abaixo os dados completos do seu ingresso,";
	$texto_emailSet .= "você deve apresentar o QRCode abaixo, juntamente com documento de comprovação de identidade com foto.";
	$texto_emailSet .= "<br>";
	$texto_emailSet .= "<br>";
	
	$htmlEmailSet  = "";
	$htmlEmailSet .= "<table width=\"100%\">";
	
	$htmlEmailSet .= "<tr>";
	$htmlEmailSet .= "    <td colspan=\"2\" style=\"".$font_familySet."\">".$texto_emailSet."</td>";
	$htmlEmailSet .= "</tr>";
	
	$htmlEmailSet .= "<tr>";
	$htmlEmailSet .= "    <td colspan=\"2\" style=\"text-align:center;".$font_familySet."\"><b>ABAIXO DETALHES DO INGRESSO</b><br><br></td>";
	$htmlEmailSet .= "</tr>";
	
	$htmlEmailSet .= "<tr>";
	$htmlEmailSet .= "    <td style=\"vertical-align:top;width:150px;font-weight:bold;font-size: 16px;".$font_familySet."\">Nome:</td>";
	$htmlEmailSet .= "    <td style=\"vertical-align:top;font-size: 16px;".$font_familySet."\">".$rSqlCarrinho['pessoa_nome']."</td>";
	$htmlEmailSet .= "</tr>";
	
	$htmlEmailSet .= "<tr>";
	$htmlEmailSet .= "    <td style=\"vertical-align:top;width:150px;font-weight:bold;font-size: 16px;".$font_familySet."\">".$tipo_documentoSet.":</td>";
	$htmlEmailSet .= "    <td style=\"vertical-align:top;font-size: 16px;".$font_familySet."\">".mascaraCpf($rSqlCarrinho['pessoa_documento'])."</td>";
	$htmlEmailSet .= "</tr>";
	
	$htmlEmailSet .= "<tr>";
	$htmlEmailSet .= "    <td style=\"vertical-align:top;width:150px;font-weight:bold;font-size: 16px;".$font_familySet."\">E-mail:</td>";
	$htmlEmailSet .= "    <td style=\"vertical-align:top;font-size: 16px;".$font_familySet."\">".$rSqlCarrinho['pessoa_email']."</td>";
	$htmlEmailSet .= "</tr>";
	
	$htmlEmailSet .= "<tr>";
	$htmlEmailSet .= "    <td style=\"vertical-align:top;width:150px;font-weight:bold;font-size: 16px;".$font_familySet."\">Evento:</td>";
	$htmlEmailSet .= "    <td style=\"vertical-align:top;font-size: 16px;".$font_familySet."\">".$rSqlCarrinho['evento_nome']."</td>";
	$htmlEmailSet .= "</tr>";
	
	$htmlEmailSet .= "<tr>";
	$htmlEmailSet .= "    <td style=\"vertical-align:top;width:150px;font-weight:bold;font-size: 16px;".$font_familySet."\">Ticket:</td>";
	$htmlEmailSet .= "    <td style=\"vertical-align:top;font-size: 16px;".$font_familySet."\">".$rSqlEnvio['ingresso_nome']."</td>";
	$htmlEmailSet .= "</tr>";
	
	if(trim($rSqlCarrinho["label"])=="" && trim($rSqlCarrinho["linha_real"])=="" && trim($rSqlCarrinho["coluna_real"])=="") { } else {
	$htmlEmailSet .= "<tr>";
	$htmlEmailSet .= "    <td style=\"vertical-align:top;width:150px;font-weight:bold;font-size: 16px;".$font_familySet."\">Cadeira:</td>";
	$htmlEmailSet .= "    <td style=\"vertical-align:top;font-size: 16px;".$font_familySet."\">".$rSqlCarrinho['label']."</td>";
	$htmlEmailSet .= "</tr>";
	}
	
	if(trim($rSqlCarrinho['numeroUnico_cod_voucher'])=="") { } else {
	$htmlEmailSet .= "<tr>";
	$htmlEmailSet .= "    <td style=\"vertical-align:top;width:150px;font-weight:bold;font-size: 16px;".$font_familySet."\">Código/Voucher:</td>";
	$htmlEmailSet .= "    <td style=\"vertical-align:top;font-size: 16px;".$font_familySet."\">".$rSqlCarrinho['numeroUnico_cod_voucher']."</td>";
	$htmlEmailSet .= "</tr>";
	}

	if(trim($monta_endereco_print)=="") { } else {
		$htmlEmailSet .= "<tr>";
		$htmlEmailSet .= "    <td style=\"vertical-align:top;width:150px;font-weight:bold;font-size: 16px;".$font_familySet."\">Endereço:</td>";
		$htmlEmailSet .= "    <td style=\"vertical-align:top;font-size: 16px;".$font_familySet."\">".$monta_endereco_print."</td>";
		$htmlEmailSet .= "</tr>";
	}
	
	$htmlEmailSet .= "<tr>";
	$htmlEmailSet .= "    <td style=\"vertical-align:top;width:150px;font-weight:bold;font-size: 16px;".$font_familySet."\">QRCode:</td>";
	$htmlEmailSet .= "    <td style=\"vertical-align:top;font-size: 16px;".$font_familySet."\"><img style=\"height:150px;border: 1px solid #CCC;margin-top: 10px;\" src=\"https://www.saguarocomunicacao.com.br/admin/files/qrcode/".$cod_voucherSet.".jpg\"></td>";
	$htmlEmailSet .= "</tr>";

	$htmlEmailSet .= "</table>";
	
	$rSqlUsuario['nome'] = $rSqlCarrinho['pessoa_nome'];
	$rSqlUsuario['email'] = $rSqlCarrinho['pessoa_email'];
	$rSqlUsuario['documento'] = $rSqlCarrinho['pessoa_documento'];
	
	$assuntoDoEmail_PRE = "Comprovante de Ingresso";
	$tituloModeloEmail_PRE = "Comprovante de Ingresso";
	$textoModeloEmail_PRE = "".$htmlEmailSet."";
	
	$indexGet = "site";
	$EMPRESA_DE_PLATAFORMA_TOKEN = $rSqlCarrinho['empresa_token'];
	$_POST['Local'] = "personalizado";
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-email/index.php");
	$cont_envio_email++;
}
?>
