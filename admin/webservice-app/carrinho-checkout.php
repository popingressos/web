<?
include("".$_SERVER['DOCUMENT_ROOT']."/include/sess.php");
$rSqlUsuario = mysql_fetch_array(mysql_query("SELECT * FROM pessoas WHERE numeroUnico='".$numeroUnico_pessoaGet."'"));
$rSqlLoja = mysql_fetch_array(mysql_query("SELECT numeroUnico FROM loja WHERE numeroUnico_pessoa='".$numeroUnico_pessoaGet."'"));

$empresa_numeroUnico_carrinho = $_SESSION['numeroUnico_carrinho'];

$valorCashbackTotal = 0;
$valorSubTotal = 0;
$valorDesconto = 0;
$valorVenda = 0;
$carrinhoDetalhadoArray = unserialize($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].'']);
$carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'numeroUnico_lote', SORT_ASC);
$carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'ordem', SORT_ASC);
foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
	$cont++;

	#CONTROLE VALOR CASO EVENTO
	if(trim($valueDetalhado['numeroUnico_evento'])=="") { } else {
		$rSqlItem = mysql_fetch_array(mysql_query("SELECT 
													numeroUnico,
													empresa,
													empresa_token,
													tickets,
													lotes
												   FROM 
													eventos 
												   WHERE 
													numeroUnico='".$valueDetalhado['numeroUnico_evento']."'"));

		$lotesArray = unserialize($rSqlItem['lotes']);
		foreach ($lotesArray as $key_lotes => $value_lotes) {
			if(trim($value_lotes['numeroUnico'])==trim($valueDetalhado["numeroUnico_lote"])) {
				$valueDetalhado["valor_lote"] = $value_lotes['lote_valor'];
			}
		}

	}

	#CONTROLE VALOR CASO PRODUTO
	if(trim($valueDetalhado['numeroUnico_produto'])=="") { } else {
		$rSqlItem = mysql_fetch_array(mysql_query("SELECT numeroUnico,empresa,empresa_token FROM produtos WHERE numeroUnico='".$valueDetalhado['numeroUnico_produto']."'"));
		$valueDetalhado["valor_lote"] = $valueDetalhado["valor"];
	}
	
	$valueDetalhado["valor_original"] = $valueDetalhado["valor_lote"];

	$valueDetalhado['valor_taxa'] = $valueDetalhado["valor_lote"] * 0.10;
	$valueDetalhado['valor_pago'] = $valueDetalhado["valor_lote"] + ($valueDetalhado['valor_lote'] * 0.10);

	#CONTROLE CUPOM DE DESCONTO
	$achou_cupom = 0;
	if(trim($_SESSION['carrinho_cupom_descontos'])=="") {
		$achou_cupom=0;
	} else {
		$cupomArray = unserialize($_SESSION['carrinho_cupom_descontos']);
		foreach ($cupomArray as $keyCupom => $valueCupom) {
			if(trim($valueDetalhado['tipo'])=="evento" || trim($valueDetalhado['tipo'])=="evento-cadeira") {
				if(trim($valueCupom['tipo_item'])=="eventos") {
					if(trim($valueDetalhado['numeroUnico_evento'])==trim($valueCupom['numeroUnico_item'])) {
						$achou_cupom++;
					}
				} else if(trim($valueCupom['tipo_item'])=="tickets") {
					if(trim($valueDetalhado['numeroUnico_ticket'])==trim($valueCupom['numeroUnico_item'])) {
						$achou_cupom++;
					}
				}
			} else if(trim($valueDetalhado['tipo'])=="produto") {
				if(trim($valueDetalhado['numeroUnico_produto'])==trim($valueCupom['numeroUnico_item'])) {
					$achou_cupom++;
				}
			} else if(trim($valueDetalhado['tipo'])=="combo") {
				if(trim($valueDetalhado['numeroUnico_produto'])==trim($valueCupom['numeroUnico_item'])) {
					$achou_cupom++;
				}
			}
		}
	}
	
	if($achou_cupom>0) {
		$valueDetalhado['numeroUnico_cupom'] = $_SESSION['carrinho_cupom_numeroUnico'];
		$comCupom = 1;
		if(trim($_SESSION['carrinho_cupom_tipo_desconto'])=="valor") {
			$valorDescontoCupom = $_SESSION['carrinho_cupom_desconto'];
			$valueDetalhado["valor_lote"] = $valueDetalhado["valor_lote"] - $valorDescontoCupom;
			$valorLinha = $valueDetalhado["valor_pago"] - $valorDescontoCupom;
		} else {
			$porcentagemGet = $_SESSION['carrinho_cupom_desconto'];
			if($porcentagemGet>0) {
				$valorDescontoCupom = ($porcentagemGet / 100) * $valueDetalhado["valor_pago"];
			} else {
				$valorDescontoCupom = 0;
			}
			$valueDetalhado["valor_lote"] = $valueDetalhado["valor_lote"] - $valorDescontoCupom;
			$valorLinha = $valueDetalhado["valor_pago"] - $valorDescontoCupom;
		}
	} else {
		$valueDetalhado['numeroUnico_cupom'] = "";
		$comCupom = 0;
		$valorDescontoCupom = 0;
		$valueDetalhado["valor_lote"] = $valueDetalhado["valor_lote"];
		$valorLinha = $valueDetalhado["valor_pago"];
	}

	#CONTROLE ARRAY EMPRESA
	$procura = "".$rSqlItem['empresa_token']."";
	$coluna = "empresa_token";
	
	$found_key = array_search(
		$procura,
		array_filter(
			array_combine(
				array_keys($objetoEmpresaControle),
				array_column(
					$objetoEmpresaControle, $coluna
				)
			)
		)
	);
	
	if(trim($found_key)=="") {
		$objetoEmpresaControle[] = array("tag" => "empresa-detalhado", 
										 "empresa" => "empresa_".$rSqlItem['empresa']."", 
										 "empresa_token" => "empresa_token_".$rSqlItem['empresa_token']."", 
										 "stat" => "1");
	}

	#CONTROLE ENVIO DE NOTIFICAÇÃO
	if(trim($valueDetalhado['email_enviar'])=="") {
		$valueDetalhado['email_enviar'] = "1";
	}
	if(trim($valueDetalhado['telefone_enviar'])=="") {
		$valueDetalhado['telefone_enviar'] = "1";
	}

	#CONTROLE VALOR DE TAXAS
	$valueDetalhado["taxa_empresa"] = retornaTaxas("".$rSqlItem['empresa']."","".$DeviceGet."","taxa_empresa");
	$valueDetalhado["taxa_cms"] = retornaTaxas("".$rSqlItem['empresa']."","".$DeviceGet."","taxa_cms");
	
	#CONTROLE CASHBACK
	$numeroUnico_pessoas_creditosSet = "";
	$achou_cashback = 0;
	$nSqlCashback = mysql_fetch_row(mysql_query("SELECT 
														COUNT(*) 
													 FROM 
														desconto_de_cashback 
													 WHERE 
														(descontos LIKE '%".$valueDetalhado['numeroUnico_evento']."%' OR descontos LIKE '%".$valueDetalhado['numeroUnico_ticket']."%') AND 
														stat='1'
													 "));

	if(trim($nSqlCashback[0])>0) {
		$rSqlCashback = mysql_fetch_array(mysql_query("SELECT 
															  numeroUnico,
															  tipo_desconto,
															  desconto,
															  descontos 
														   FROM 
															  desconto_de_cashback 
														   WHERE 
															  (descontos LIKE '%".$valueDetalhado['numeroUnico_evento']."%' OR descontos LIKE '%".$valueDetalhado['numeroUnico_ticket']."%') AND 
															  stat='1'
														   "));


		$cupomArray = unserialize($rSqlCashback['descontos']);
		foreach ($cupomArray as $keyCupom => $valueCupom) {
			if(trim($valueDetalhado['tipo'])=="evento" || trim($valueDetalhado['tipo'])=="evento-cadeira") {
				if(trim($valueCupom['tipo_item'])=="eventos") {
					if(trim($valueDetalhado['numeroUnico_evento'])==trim($valueCupom['numeroUnico_item'])) {
						$achou_cashback++;
					}
				} else if(trim($valueCupom['tipo_item'])=="tickets") {
					if(trim($valueDetalhado['numeroUnico_ticket'])==trim($valueCupom['numeroUnico_item'])) {
						$achou_cashback++;
					}
				}
			} else if(trim($valueDetalhado['tipo'])=="produto") {
				if(trim($valueDetalhado['numeroUnico_produto'])==trim($valueCupom['numeroUnico_item'])) {
					$achou_cashback++;
				}
			} else if(trim($valueDetalhado['tipo'])=="combo") {
				if(trim($valueDetalhado['numeroUnico_produto'])==trim($valueCupom['numeroUnico_item'])) {
					$achou_cashback++;
				}
			}
		}

		if($achou_cashback>0) {
			$numeroUnico_pessoas_creditosSet = geraCodReturn();
			if(trim($rSqlCashback['tipo_desconto'])=="valor") {
				$valorCashback = $rSqlCashback['desconto'];
				$valueDetalhado['valor_desconto_em_item_adquirido'] = $valueDetalhado['valor_subtotal'] - $valorDescontoCupom;
			} else {
				$porcentagemGet = $rSqlCashback['desconto'];
				if($porcentagemGet>0) {
					$valorCashback = ($porcentagemGet / 100) * $valueDetalhado['valor_subtotal'];
				} else {
					$valorCashback = 0;
				}
			}

			$insert = mysql_query("INSERT INTO pessoas_creditos (
																 empresa,
																 empresa_token,

																 plataforma,
																 plataforma_token,

																 numeroUnico,
					
																 numeroUnico_pai,
																 numeroUnico_loja,
																 numeroUnico_pessoa,
																 numeroUnico_desconto_de_cashback,
																 numeroUnico_item,
																 valor,
																 qtd,
																 tipo,
					
																 pago,
																 stat,
																 data,
																 dataModificacao
																) VALUES (
																'".$rSqlItem['empresa']."',
																'".$rSqlItem['empresa_token']."',

																'".$rSqlEmpresa['id']."',
																'".$rSqlEmpresa['token']."',

																'".$numeroUnico_pessoas_creditosSet."',
					
																'".$empresa_numeroUnico_carrinho."',
																'".$rSqlLoja['numeroUnico_loja']."',
																'".$rSqlUsuario['numeroUnico']."',
																'".$rSqlCashback['numeroUnico']."',
																'".$rSqlItem['numeroUnico']."',
																'".$valorCashback."',
																'".$valorCashback."',
																'recebeu',
					
																'0',
																'1',
																'".$data."',
																'".$data."'
																)");
		} else {
			$valorCashback = 0;
		}
	} else {
		$valorCashback = 0;
	}

	#CONTROLE OBJETO
	$objetoCarrinhoControle[] = array("tag" => "carrinho-detalhado", 
									  "empresa" => "empresa_".$rSqlItem['empresa']."", 
									  "empresa_token" => "empresa_token_".$rSqlItem['empresa_token']."", 

									  "ordem" => "".$valueDetalhado['ordem']."", 
									  "tipo" => "".$valueDetalhado['tipo']."", 
									  "numeroUnico_pai" => "".$valueDetalhado['numeroUnico_pai']."", 
									  "numeroUnico" => "".$valueDetalhado['numeroUnico']."", 

									  "numeroUnico_pessoas_creditos" => "".$numeroUnico_pessoas_creditosSet."", 
									  "numeroUnico_loja" => "".$valueDetalhado['numeroUnico_loja']."", 
									  "numeroUnico_pessoa" => "".$valueDetalhado['numeroUnico_pessoa']."", 
									  "pessoa_nome" => "".$valueDetalhado['pessoa_nome']."", 
									  "pessoa_documento" => "".$valueDetalhado['pessoa_documento']."", 
									  "pessoa_email" => "".$valueDetalhado['pessoa_email']."", 
									  "pessoa_telefone" => "".$valueDetalhado['pessoa_telefone']."", 
									  "numeroUnico_cupom" => "".$valueDetalhado['numeroUnico_cupom']."", 
									  "numeroUnico_produto" => "".$valueDetalhado['numeroUnico_produto']."", 
									  "numeroUnico_evento" => "".$valueDetalhado['numeroUnico_evento']."", 
									  "numeroUnico_ticket" => "".$valueDetalhado['numeroUnico_ticket']."", 
									  "numeroUnico_lote" => "".$valueDetalhado['numeroUnico_lote']."", 
									  "produto_nome" => "".$valueDetalhado['produto_nome']."", 
									  "evento_nome" => "".$valueDetalhado['evento_nome']."", 
									  "ingresso_nome" => "".$valueDetalhado['ingresso_nome']."", 
									  "ingresso_data" => "".$valueDetalhado['ingresso_data']."", 

									  "nome" => "".$valueDetalhado['nome']."", 
									  "imagem" => "".$valueDetalhado['imagem']."", 

									  "taxa_empresa" => "".$valueDetalhado["taxa_empresa"]."", 
									  "taxa_cms" => "".$valueDetalhado["taxa_cms"]."", 

									  "valor" => "".$valueDetalhado["valor_original"]."", 
									  "valor_original" => "".$valueDetalhado['valor_original']."", 
									  "valor_taxa" => "".$valueDetalhado['valor_taxa']."", 
									  "valor_desconto" => "".$valorDescontoCupom."", 
									  "valor_pago" => "".$valueDetalhado['valor_pago']."", 
									  "valor_promocional" => "".$valueDetalhado['valor_promocional']."", 
									  "valor_venda" => "".$valorLinha."", 
									  "valor_cashback" => "".$valorCashback."", 
									  
									  "lote" => "".$valueDetalhado['lote']."", 
									  "marcado" => "".$valueDetalhado['marcado']."", 
									  "email_enviar" => "".$valueDetalhado['email_enviar']."", 
									  "telefone_enviar" => "".$valueDetalhado['telefone_enviar']."", 
									  "qtd" => "1", 
									  "stat" => "1");

	#DEFINIÇÕES DE CARRINHO, COMPRA E VALORES 
	$valorSubTotal = $valorSubTotal + $valueDetalhado["valor_lote"];
	$valorVenda = $valorVenda + $valorLinha;
}



#CALCULO FINAL DO VALOR TOTAL
$valorTotal = $valorVenda - $valorDesconto;

#CALCULO FINAL DO VALOR TOTAL COM JUROS DE PARCELAMENTO
$total_parcelado = $valorTotal / $qtd_parcelasGet;
$parcela = $total_parcelado * $rSqlEmpresa['fator_parcela'.$qtd_parcelasGet.''];
$parcela = round($parcela,2);
$valorTotal = $parcela * $qtd_parcelasGet;

#OUTROS VALORES
$valorTotalTaxa = 0;
$valorFreteSet = 0;

$valor_taxa_frete_minimo_empresaSet = 0;
$valor_taxa_frete_minimo_cmsSet = 0; 

$valor_taxa_produto_empresa_cobraSet = 0;
$valor_taxa_produto_empresa_kmSet = 0;
$valor_taxa_produto_empresaSet = 0;

$valor_taxa_produto_cms_cobraSet = 0;
$valor_taxa_produto_cms_kmSet = 0;
$valor_taxa_produto_cmsSet = 0;

$rSqlUsuario['nome'] = $nomeGet;
$rSqlUsuario['documento'] = $cpfGet;
$rSqlUsuario['email'] = $emailGet;
$rSqlUsuario['whatsapp'] = $telefoneGet;

$_POST['GOOGLE_MAP_KEY'] = $GOOGLE_MAP_KEY_SET;
$_POST['cep'] = $cepGet;
$_POST['rua'] = $ruaGet;
$_POST['numero'] = $numeroGet;
$_POST['complemento'] = $complementoGet;
$_POST['bairro'] = $bairroGet;
$_POST['cidade'] = $cidadeGet;
$_POST['estado'] = $estadoGet;
$COORDENADAS = latitude_longitude($_POST,"",$GOOGLE_MAP_KEY_SET);
$_POST['latitude'] = $COORDENADAS['latitude'];
$_POST['longitude'] = $COORDENADAS['longitude'];

$rSqlEndereco['cep'] = $cepGet;
$rSqlEndereco['rua'] = $ruaGet;
$rSqlEndereco['numero'] = $numeroGet;
$rSqlEndereco['complemento'] = $complementoGet;
$rSqlEndereco['bairro'] = $bairroGet;
$rSqlEndereco['cidade'] = $cidadeGet;
$rSqlEndereco['estado'] = $estadoGet;

#DIRECIONAMENTO FORMA DE PAGAMENTO
$items_pagarme[] = array( 
						"id" => "".$empresa_numeroUnico_carrinho."",
						"title" => "Compra em ".$configuracoes_site['nome']."",
						"unit_price" => preg_replace("/[^0-9]/", "",format_number($valorTotal,2)),
						"quantity" => 1,
						"tangible" => true
					);

if(trim($rSqlEmpresa['id'])=="51" || trim($rSqlEmpresa['id'])=="57") {
	$operadora_selecionadaGet = "userede";
	$cobraEndereco = 0;
} else {
	$operadora_selecionadaGet = "pagarme";
	if(trim($cepGet)=="" || 
	   trim($ruaGet)=="" ||
	   trim($numeroGet)=="" ||
	   trim($bairroGet)=="" ||
	   trim($cidadeGet)=="" ||
	   trim($estadoGet)==""
	   ) {
	$cobraEndereco = 1;
   } else {
	$cobraEndereco = 0;
   }
}

if($valorTotal>0) {
	if(trim($cobraEndereco)=="1") {
		$retornoSet = "endereco-nao-informado";
		$erroPagamento = true;
	} else {
		if(trim($forma_pagamentoGet)=="") {
			$retornoSet = "forma-de-pagamento-nao-informado";
			$erroPagamento = true;
		} else {
			if(trim($forma_pagamentoGet)=="BOLETO") {
				$rSqlVencimento = mysql_fetch_array(mysql_query("SELECT data_limite_date FROM data_limite_boleto WHERE data_hoje_date='".date('Y-m-d', strtotime('+7 days'))."'"));
				$vencimentoSet = ajustaDataReturn($rSqlVencimento['data_limite_date'],"d/m/Y");
			
				$rSqlFP['titular_nome'] = $nomeGet;
				$rSqlFP['titular_cpf'] = $cpfGet;
				$rSqlFP['titular_telefone'] = $telefoneGet;
				$rSqlFP['titular_email'] = $emailGet;

				$descricao_da_compraSet = "Compra em ".$configuracoes_site['nome']."";
				$_POST['Local'] = "safe2pay-boleto";
				include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-hub/index.php");
				
				if(trim($RESPOSTA_GATEWAY->ResponseDetail->Status)=="1") {
					$boleto_urlSet = $RESPOSTA_GATEWAY->ResponseDetail->BankSlipUrl;
					$boleto_linha_digitavelSet = $RESPOSTA_GATEWAY->ResponseDetail->DigitableLine;
					$tidSet = $RESPOSTA_GATEWAY->ResponseDetail->IdTransaction;
					$nsuSet = $RESPOSTA_GATEWAY->ResponseDetail->SeedNumber;
			
					$retornoSet = "compra-boleto";
					$erroPagamento = false;
				} else {
					$boleto_urlSet = "";
					$boleto_linha_digitavelSet = "";
					$tidSet = "";
					$nsuSet = "";
			
					$retornoSet = "compra-boleto";
					$erroPagamento = true;
				}
			
			} else if(trim($forma_pagamentoGet)=="PIX") {
				$operadoraGet = "safe2pay";
				$_POST['Local'] = "safe2pay-pix";
				$rSqlVencimento = mysql_fetch_array(mysql_query("SELECT data_limite_date FROM data_limite_boleto WHERE data_hoje_date='".date('Y-m-d', strtotime('+7 days'))."'"));
				$vencimentoSet = ajustaDataReturn($rSqlVencimento['data_limite_date'],"d/m/Y");
			
				$rSqlFP['titular_nome'] = $card_nameGet;
				$rSqlFP['titular_cpf'] = $cpfGet;
				$rSqlFP['titular_telefone'] = $telefoneGet;
				$rSqlFP['titular_email'] = $emailGet;

				$descricao_da_compraSet = "Compra em ".$configuracoes_site['nome']."";
				include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-hub/index.php");
				
				if(trim($RESPOSTA_GATEWAY->ResponseDetail->Status)=="1") {
					$pix_qrcode_urlSet = $RESPOSTA_GATEWAY->ResponseDetail->QrCode;
					$pix_qrcode_keySet = $RESPOSTA_GATEWAY->ResponseDetail->Key;
					$tidSet = $RESPOSTA_GATEWAY->ResponseDetail->IdTransaction;
					$nsuSet = $RESPOSTA_GATEWAY->ResponseDetail->SeedNumber;
			
					$retornoSet = "compra-pix";
					$erroPagamento = false;
				} else {
					$pix_qrcode_urlSet = "";
					$pix_qrcode_keySet = "";
					$tidSet = "";
					$nsuSet = "";
			
					$retornoSet = "compra-pix";
					$erroPagamento = true;
				}
			} else if(trim($forma_pagamentoGet)=="CCR") {
			
				if(trim($card_nameGet)=="" || 
				   trim($card_cvcGet)=="" ||
				   trim($card_numberGet)=="" ||
				   trim($card_expiryGet)=="" ||
				   trim($card_cpfGet)==""
				   ) {
					$retornoSet = "dados-do-cartao-nao-informado";
					$erroPagamento = true;
				} else {
					$rSqlFP['titular_nome'] = $card_nameGet;
					$rSqlFP['titular_cpf'] = $cpfGet;
					$rSqlFP['titular_telefone'] = $telefoneGet;
					$rSqlFP['titular_email'] = $emailGet;
					$CVV_SET = $card_cvcGet;
					$rSqlFP['cartao_cvc'] = $CVV_SET;
					$rSqlFP['cartao_numero'] = $card_numberGet; 
					$rSqlFP['cartao_validade'] = $card_expiryGet;
					$rSqlFP['cartao_validade_mes'] = $card_expiry_mesGet;
					$rSqlFP['cartao_validade_ano'] = $card_expiry_anoGet;
					$rSqlFP['cartao_bandeira'] = $card_binGet;
				
					if(trim($operadora_selecionadaGet)=="pagarme") {
						$operadoraGet = "pagarme";
						$_POST['Local'] = "pagarme-credito";
						include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-hub/index.php");
					
						if(trim($RESPOSTA_GATEWAY->status)=="paid") {
							$boleto_urlSet = "";
							$boleto_linha_digitavelSet = "";
							$tidSet = $RESPOSTA_GATEWAY->tid;
							$nsuSet = $RESPOSTA_GATEWAY->nsu;
					
							$retornoSet = "compra-confirmada";
							$erroPagamento = false;
						} else if(trim($RESPOSTA_GATEWAY->status)=="processing") {
							$boleto_urlSet = "";
							$boleto_linha_digitavelSet = "";
							$tidSet = "";
							$nsuSet = "";
					
							$retornoSet = "compra-em-analise";
							$erroPagamento = false;
						} else if(trim($RESPOSTA_GATEWAY->status)=="refused") {
							$boleto_urlSet = "";
							$boleto_linha_digitavelSet = "";
							$tidSet = "";
							$nsuSet = "";
					
							$retornoSet = "compra-negada";
							$erroPagamento = true;
						}
					} else if(trim($operadora_selecionadaGet)=="userede") {
						$operadoraGet = "userede";
						$retornoSet = "compra-confirmada-userede";
						$erroPagamento = false;
					}
				}
			
			} else if(trim($forma_pagamentoGet)=="CREDITO") {
				$retornoSet = "compra-confirmada";
				$erroPagamento = false;

				$insert = mysql_query("INSERT INTO pessoas_creditos (
																	 empresa,
																	 empresa_token,
																	 numeroUnico,
						
																	 numeroUnico_pai,
																	 numeroUnico_loja,
																	 numeroUnico_pessoa,
																	 valor,
																	 qtd,
																	 pago,
																	 tipo,
						
																	 stat,
																	 data,
																	 dataModificacao
																	) VALUES (
																	'".$rSqlEmpresa['id']."',
																	'".$rSqlEmpresa['token']."',
																	'".geraCodReturn()."',
						
																	'".$empresa_numeroUnico_carrinho."',
																	'".$rSqlLoja['numeroUnico_loja']."',
																	'".$rSqlUsuario['numeroUnico']."',
																	'".$valorTotal."',
																	'".$valorTotal."',
																	'1',
																	'usou',
						
																	'1',
																	'".$data."',
																	'".$data."'
																	)");

			}
		}
	}
} else {
	$retornoSet = "valor-incorreto";
	$erroPagamento = true;
}

#TRATAMENTO DE RETORNO SETANDO STAT E PAGO
if($erroPagamento===false) {
	$mod_carrinho = "carrinho";
	if($retornoSet == "compra-confirmada") {
		$statSet = "1";
		$pagoSet = "1";
	} else if($retornoSet == "compra-boleto") {
		$statSet = "13";
		$pagoSet = "0";
	} else if($retornoSet == "compra-pix") {
		$statSet = "32";
		$pagoSet = "0";
	} else if($retornoSet == "compra-em-analise") {
		$statSet = "6";
		$pagoSet = "0";
	} else if($retornoSet == "compra-confirmada-userede") {
		$statSet = "102";
		$pagoSet = "0";
	}

} else {
	if($retornoSet == "compra-negada") {
		$mod_carrinho = "carrinho";

		$statSet = "7";
		$pagoSet = "0";
	} else {
		$mod_carrinho = "carrinho";

		$statSet = "999";
		$pagoSet = "0";
	}
}

#Geração das datas de acompanhamento
$dataControle[] = array("data" => $data, "info" => "dataAdicionado", "stat" => "0");
if(trim($forma_pagamentoGet)=="BOLETO") {
	$dataControle[] = array("data" => $data, "info" => "dataBoletoGerado", "stat" => "13");
} else if(trim($forma_pagamentoGet)=="PIX") {
	$dataControle[] = array("data" => $data, "info" => "dataPixGerado", "stat" => "32");
} else {
	$dataControle[] = array("data" => $data, "info" => "dataPagamentoGerado", "stat" => "2");
	if($retornoSet == "compra-confirmada") {
		$dataControle[] = array("data" => $data, "info" => "dataEmAnalise", "stat" => "6");
		$dataControle[] = array("data" => $data, "info" => "dataPago", "stat" => "".$statSet."");
		$dataControle[] = array("data" => $data, "info" => "dataAtivar", "stat" => "8");
	} else {
		$dataControle[] = array("data" => $data, "info" => "dataEmAnalise", "stat" => "".$statSet."");
	}
}
$dataControleSerial = serialize($dataControle);

#Geração do numeroUnico e do número do contrato de acompanhamento
$numeroUnicoGerado_carrinho = geraCodReturn();
$cod_contratoSet = strtoupper(geraCodReturnLimitado("15"));

#INSERÇÃO NA TABELA OFICIAL DA TRANSAÇÃO (carrinho ou carinho_erro)
$insert = mysql_query("INSERT INTO ".$mod_carrinho." (
                                                       empresa,
                                                       empresa_token,
													   empresaObjeto,
													   cod_contrato,
													   tipo_operacao,
													   tag,
                                                       
                                                       numeroUnico,
                                                       numeroUnico_pai,
                                                       numeroUnico_filial,
                                                       numeroUnico_comprador,
													   numeroUnico_cupom,
													   numeroUnico_sysgrupousuario,
        
                                                       pessoa_nome,
                                                       pessoa_documento,
                                                       pessoa_email,
                                                       pessoa_telefone,
                                                       whatsapp,
                                                       tid,
                                                       nsu, 
													   forma_de_pagamento,
													   qtd_parcelas,
													   operadora,
													   cartao_bandeira,
        
													   valor_subtotal, 
                                                       valor_desconto, 
                                                       valor_total_taxas, 
                                                       valor_total_frete, 
                                                       valor_total, 
        
                                                       valor_taxa_frete_minimo_empresa, 
                                                       valor_taxa_frete_minimo_cms, 
        
                                                       valor_taxa_produto_empresa_cobra, 
                                                       valor_taxa_produto_empresa_km, 
                                                       valor_taxa_produto_empresa,
        
                                                       valor_taxa_produto_cms_cobra,
                                                       valor_taxa_produto_cms_km,
                                                       valor_taxa_produto_cms,
        
                                                       objeto_carrinho,
                                                       objeto_carrinho_detalhado,
                                                       objeto_enviado_gateway,
                                                       objeto_recebido_gateway,
													   objeto_resposta_gateway,
                                                       
                                                       boleto_url,
                                                       boleto_linha_digitavel,

                                                       objetoEnderecoPagamento,
                                                       objetoFormaPagamento,
        
													   card_number,
													   card_cvc,
													   card_bin,
													   card_expiry_mes,
													   card_expiry_ano,
													   card_name,
													   card_cpf,
														
                                                       pago,
                                                       stat,
													   device,
                                                       data,
                                                       dataModificacao,
                                                       dataObjeto
                                                       ) 
                                                       VALUES 
                                                       (
                                                       '".$rSqlEmpresa['id']."', 
                                                       '".$rSqlEmpresa['token']."',
                                                       '".serialize($objetoEmpresaControle)."',
													   '".$cod_contratoSet."',
													   'compra_session', 
													   'compra_session', 
                                                       
                                                       '".$numeroUnicoGerado_carrinho."', 
                                                       '".$empresa_numeroUnico_carrinho."',
                                                       '".$numeroUnico_filialGet."',
                                                       '".$rSqlUsuario['numeroUnico']."', 
                                                       '".$_SESSION['carrinho_cupom_numeroUnico']."', 
                                                       '".$rSqlCarrinho['numeroUnico']."', 
        
													   '".$nomeGet."',
                                                       '".preg_replace("/[^0-9]/", "",$cpfGet)."', 
													   '".$emailGet."',
                                                       '".preg_replace("/[^0-9]/", "",$telefoneGet)."', 
                                                       '".preg_replace("/[^0-9]/", "",$_POST['whatsapp'])."', 
                                                       '".$tidSet."', 
                                                       '".$nsuSet."', 
													   '".$forma_pagamentoGet."', 
													   '".$qtd_parcelasGet."', 
													   '".$operadoraGet."', 
													   '".$card_binGet."', 

                                                       '".$valorSubTotal."', 
                                                       '".$valorDesconto."', 
                                                       '".$valorTotalTaxa."', 
                                                       '".$valorFreteSet."', 
                                                       '".$valorTotal."', 
        
                                                       '".$valor_taxa_frete_minimo_empresaSet."',
                                                       '".$valor_taxa_frete_minimo_cmsSet."', 
                                                       
                                                       '".$valor_taxa_produto_empresa_cobraSet."',
                                                       '".$valor_taxa_produto_empresa_kmSet."',
                                                       '".$valor_taxa_produto_empresaSet."',
                                                       
                                                       '".$valor_taxa_produto_cms_cobraSet."',
                                                       '".$valor_taxa_produto_cms_kmSet."',
                                                       '".$valor_taxa_produto_cmsSet."',
        
                                                       '".serialize($objetoCarrinhoControle)."',
                                                       '".serialize($objetoCarrinhoControle)."',
                                                       '".serialize($OBJ_ENVIADO_GATEWAY)."',
                                                       '".serialize($OBJ_RECEBIDO_GATEWAY)."',
                                                       '".serialize($RESPOSTA_GATEWAY)."',
        
                                                       '".$boleto_urlSet."',
                                                       '".$boleto_linha_digitavelSet."',

                                                       '".serialize($rSqlEndereco)."',
                                                       '".serialize($rSqlFP)."',
        
                                                       '".$rSqlFP['cartao_numero']."',
                                                       '".$rSqlFP['cartao_cvc']."',
                                                       '".$rSqlFP['cartao_bandeira']."',
                                                       '".$rSqlFP['cartao_validade_mes']."',
                                                       '".$rSqlFP['cartao_validade_ano']."',
                                                       '".$rSqlFP['titular_nome']."',
                                                       '".$rSqlFP['titular_cpf']."',

                                                       '".$pagoSet."',
                                                       '".$statSet."',
                                                       '".$DeviceGet."',
                                                       '".$data."',
                                                       '".$data."',
                                                       '".$dataControleSerial."'
                                                       )");

#ENVIO DE E-MAIL
if($erroPagamento===false) {
	$mod_carrinho = "carrinho";

	$rSqlCarrinho = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod_carrinho." WHERE numeroUnico='".$numeroUnicoGerado_carrinho."'"));
	$idCompraSet = $rSqlCarrinho['id'];
	if($retornoSet == "compra-confirmada") {
		$numeroUnico_usuarioSet = $rSqlUsuario['numeroUnico'];
		$indexGet = "site";
		$_POST['Local'] = "compra_confirmada";
		if(trim($rSqlUsuario['email'])=="") { } else {
			include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-email/index.php");
		}
	} else if($retornoSet == "compra-boleto") {
		$numeroUnico_usuarioSet = $rSqlUsuario['numeroUnico'];
		$indexGet = "site";
		$_POST['Local'] = "compra_boleto_pagar";
		if(trim($rSqlUsuario['email'])=="") { } else {
			include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-email/index.php");
		}
	} else if($retornoSet == "compra-pix") {
		$numeroUnico_usuarioSet = $rSqlUsuario['numeroUnico'];
		$indexGet = "site";
		$assuntoDoEmail_PRE = "Pagamento via PIX";
		$_POST['Local'] = "compra_pix_pagar";
		if(trim($rSqlUsuario['email'])=="") { } else {
			include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-email/index.php");
		}
	} else if($retornoSet == "compra-em-analise" || $retornoSet == "compra-confirmada-userede") {
		$numeroUnico_usuarioSet = $rSqlUsuario['numeroUnico'];
		$indexGet = "site";
		$_POST['Local'] = "compra_em_analise";
		if(trim($rSqlUsuario['email'])=="") { } else {
			include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-email/index.php");
		}
	}

} else {
	if($retornoSet == "compra-negada") {
		$mod_carrinho = "carrinho";

		$rSqlCarrinho = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod_carrinho." WHERE numeroUnico='".$numeroUnicoGerado_carrinho."'"));
		$idCompraSet = $rSqlCarrinho['id'];

		$numeroUnico_usuarioSet = $rSqlUsuario['numeroUnico'];
		$indexGet = "site";
		$_POST['Local'] = "compra_negada";
		if(trim($rSqlUsuario['email'])=="") { } else {
			include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-email/index.php");
		}
	} else {
		$mod_carrinho = "carrinho";

		$rSqlCarrinho = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod_carrinho." WHERE numeroUnico='".$numeroUnicoGerado_carrinho."'"));
		$idCompraSet = $rSqlCarrinho['id'];

		$numeroUnico_usuarioSet = $rSqlUsuario['numeroUnico'];
		$indexGet = "site";
		$_POST['Local'] = "compra_erro";
		if(trim($rSqlUsuario['email'])=="") { } else {
			include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-email/index.php");
		}
	}
}

#REDIRECIONAMENTO DA URL DE RETORNO FINAL DA COMPRA
if($erroPagamento===false) {
	if($retornoSet == "compra-confirmada") {
		$tituloRetornoSet = "PARABÉNS";
		$corRetornoSet = "#38a701";
		$iconeRetornoSet = "checkbox-marked-circle-outline";
		$txtRetornoSet = "Compra realizada com sucesso!";
		$pagoSet = "1";
	} else if($retornoSet == "compra-boleto") {
		$tituloRetornoSet = "PARABÉNS";
		$corRetornoSet = "#38a701";
		$iconeRetornoSet = "text-box-check-outline";
		$txtRetornoSet = "Boleto gerado com sucesso, verifique seu e-mail para mais instruções!";
		$pagoSet = "2";
	} else if($retornoSet == "compra-pix") {
		$tituloRetornoSet = "PARABÉNS";
		$corRetornoSet = "#38a701";
		$iconeRetornoSet = "text-box-check-outline";
		$txtRetornoSet = "Pix gerado com sucesso, verifique seu e-mail para mais instruções!";
		$pagoSet = "0";
	} else if($retornoSet == "compra-em-analise" || $retornoSet == "compra-confirmada-userede") {
		$tituloRetornoSet = "PARABÉNS";
		$corRetornoSet = "#38a701";
		$iconeRetornoSet = "eye-check-outline";
		$txtRetornoSet = "Compra enviada para análise, verifique seu e-mail para mais instruções!";
		$pagoSet = "2";
	}
} else {
	if($retornoSet == "endereco-nao-informado") {
		$tituloRetornoSet = "ATENÇÃO";
		$corRetornoSet = "#edb200";
		$iconeRetornoSet = "alert-outline";
		$txtRetornoSet = "Ocorreu um problema com o seu pagamento, você precisa informar os dadados de endereço completo!";
		$pagoSet = "0";
	} else if($retornoSet == "forma-de-pagamento-nao-informado") {
		$tituloRetornoSet = "ATENÇÃO";
		$corRetornoSet = "#edb200";
		$iconeRetornoSet = "alert-outline";
		$txtRetornoSet = "Ocorreu um problema com o seu pagamento, é necessário informar a forma de pagamento!";
		$pagoSet = "0";
	} else if($retornoSet == "dados-do-cartao-nao-informado") {
		$tituloRetornoSet = "ATENÇÃO";
		$corRetornoSet = "#edb200";
		$iconeRetornoSet = "alert-outline";
		$txtRetornoSet = "Ocorreu um problema com o seu pagamento, é necessário informar os dados do cartão!";
		$pagoSet = "0";
	} else if($retornoSet == "valor-incorreto") {
		$tituloRetornoSet = "ATENÇÃO";
		$corRetornoSet = "#edb200";
		$iconeRetornoSet = "alert-outline";
		$txtRetornoSet = "Ocorreu um problema com o seu pagamento, o valor informado é incorreto!";
		$pagoSet = "0";
	} else {
		$tituloRetornoSet = "ATENÇÃO";
		$corRetornoSet = "#edb200";
		$iconeRetornoSet = "alert-outline";
		$txtRetornoSet = "Ocorreu um problema com o seu pagamento, verifique seu e-mail para mais detalhes!";
		$pagoSet = "0";
	}
}

if(trim($forma_pagamentoGet)=="CREDITO") {
	$infoSet = "dataCompraDetalhe";
	atualizaStatusDaCompra($rSqlCarrinho['numeroUnico'],$infoSet,"carrinho");
}

#$insert = mysql_query("INSERT INTO log  (detalhe,data) VALUES ('".serialize($campos)."','".$data."')");

$objetoRetorno["retorno"] = $retornoSet;
$objetoRetorno["erro"] = $erroPagamento;
$objetoRetorno["tituloRetorno"] = $tituloRetornoSet;
$objetoRetorno["corRetorno"] = $corRetornoSet;
$objetoRetorno["iconeRetorno"] = $iconeRetornoSet;
$objetoRetorno["txtRetorno"] = $txtRetornoSet;
$objetoRetorno["pago"] = $pagoSet;
$objetoRetorno["stat"] = $statSet;
$objetoRetorno["msg"] = $msgSet;

$update = mysql_query("
						UPDATE 
							".$mod_carrinho." 
						SET 

							objetoRetorno='".serialize($objetoRetorno)."',
							dataModificacao='".$data."'
						WHERE 
							numeroUnico='".$numeroUnicoGerado_carrinho."'
						");


$_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].''] = "";
$_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].''] = "";
$_SESSION['numeroUnico_carrinho'] = "";
$_SESSION['carrinho_cupom'] = "";
$_SESSION['carrinho_cupom_numeroUnico'] = "";
$_SESSION['carrinho_cupom_tipo_desconto'] = "";
$_SESSION['carrinho_cupom_desconto'] = "";
$_SESSION['carrinho_cupom_descontos'] = "";

$campos["retorno"] = $retornoSet;
$campos["msg"] = "".$txtRetornoSet."";
$campos["id_transacao"] = "".$numeroUnicoGerado_carrinho."";
$campos["pix_qrcode_url"] = "".$pix_qrcode_urlSet."";
$campos["pix_key_url"] = "".$pix_qrcode_keySet."";
$campos["boleto_url"] = "".$boleto_urlSet."";
$campos["boleto_linha_digitavel"] = "".$boleto_linha_digitavelSet."";
$campos["success"] = true;

echo json_encode($campos);
?>