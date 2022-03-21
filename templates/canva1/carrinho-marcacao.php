<?php
header('Access-Control-Allow-Origin: *');

include("".$_SERVER['DOCUMENT_ROOT']."/include/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$_POST['pessoa_documento'] = preg_replace("/[^0-9]/", "", $_POST['pessoa_documento']);

if(trim($_POST['marcado'])=="1") {

	$achou_compraAutorizada = 0;
	if(trim($_POST['compra_autorizada'])=="1") {
		$nSqlCompraAutorizada = mysql_fetch_row(mysql_query("SELECT 
																COUNT(*) 
															 FROM 
																compra_autorizada 
															 WHERE 
																numeroUnico_evento='".$_POST['numeroUnico_evento']."' AND 
																numeroUnico_ticket='".$_POST['numeroUnico_ticket']."' AND 
																stat='1'
															 "));
		if(trim($nSqlCompraAutorizada[0])>0) {
			$strSqlCompraAutorizada = "SELECT 
										  pessoas_lista 
									   FROM 
										  compra_autorizada 
									   WHERE 
										  numeroUnico_evento='".$_POST['numeroUnico_evento']."' AND 
										  numeroUnico_ticket='".$_POST['numeroUnico_ticket']."' AND 
										  stat='1'
									   ";


			$qSqlCompraAutorizada = mysql_query("".$strSqlCompraAutorizada."");
			while($rSqlCompraAutorizada = mysql_fetch_array($qSqlCompraAutorizada)) {
				$compraAutorizadaArray = unserialize($rSqlCompraAutorizada['pessoas_lista']);
				foreach ($compraAutorizadaArray as $keyCompraAutorizada => $valueCompraAutorizada) {
					$valueCompraAutorizada['documento'] = preg_replace("/[^0-9]/", "", $valueCompraAutorizada['documento']);
					if(trim($valueCompraAutorizada['documento'])==trim($_POST['pessoa_documento'])) {
						$achou_compraAutorizada++;
					}
				}
			}
		}

	} else {
		$achou_compraAutorizada++;
	}

	if($achou_compraAutorizada>0) {

		$rSqlItem = mysql_fetch_array(mysql_query("SELECT 
													tickets
												   FROM 
													eventos 
												   WHERE 
													numeroUnico='".$_POST['numeroUnico_evento']."'"));
		$qtdIngressosPermitida = 0;
		$ticketsArray = unserialize($rSqlItem['tickets']);
		foreach ($ticketsArray as $key_ticket => $value_ticket) {
			if(trim($value_ticket['numeroUnico'])==trim($_POST['numeroUnico_ticket'])) {
				$qtdIngressosPermitida = $value_ticket['ticket_cpf_qtd'];
			}
		}
		if(trim($qtdIngressosPermitida)=="" || trim($qtdIngressosPermitida)=="1") {
			$qtdIngressosPermitida = 1;
		}


		$nSqlIngresso = mysql_fetch_row(mysql_query("SELECT 
														COUNT(*) 
													 FROM 
														carrinho_notificacao 
													 WHERE 
														pessoa_documento='".$_POST['pessoa_documento']."' AND 
														numeroUnico_evento='".$_POST['numeroUnico_evento']."' AND 
														numeroUnico_ticket='".$_POST['numeroUnico_ticket']."' AND 
														stat='1'"));
		if($nSqlIngresso[0]>=$qtdIngressosPermitida) {
			echo "ja_possui";
		} else {
			$marca_ingresso = "SIM";
		
			$carrinhoDetalhadoArray = unserialize($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].'']);
		
			$ingressoMarcado = 0 + $nSqlIngresso[0];
			$carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'ordem', SORT_ASC);
			foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
				if($_POST['numeroUnico_evento']==$valueDetalhado['numeroUnico_evento']) {
					if($_POST['numeroUnico_ticket']==$valueDetalhado['numeroUnico_ticket']) {
						if($_POST['pessoa_documento']==$valueDetalhado['pessoa_documento']) {
							$ingressoMarcado++;
						} else {
						}
					} else {
					}
				} else {
				}
				
				
				if($ingressoMarcado>=$qtdIngressosPermitida) {
					$marca_ingresso = "NAO";
				}
			}
		
			if($marca_ingresso=="SIM") {
				$carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'ordem', SORT_ASC);
				foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
					if($_POST['numeroUnico']==$valueDetalhado['numeroUnico']) {
						if(trim($_POST['marcado'])=="1") {
	
							$nSqlDescontoItem = mysql_fetch_row(mysql_query("SELECT 
																				COUNT(*) 
																			 FROM 
																				desconto_em_item_adquirido 
																			 WHERE 
																				(comprando LIKE '%".$valueDetalhado['numeroUnico_evento']."%' OR comprando LIKE '%".$valueDetalhado['numeroUnico_ticket']."%') AND 
																				stat='1'
																			 "));
							if(trim($nSqlDescontoItem[0])>0) {
								$rSqlDescontoItem = mysql_fetch_array(mysql_query("SELECT 
																					  tipo_desconto,
																					  desconto,
																					  descontos,
																					  comprando 
																				   FROM 
																					  desconto_em_item_adquirido 
																				   WHERE 
																					  (comprando LIKE '%".$valueDetalhado['numeroUnico_evento']."%' OR comprando LIKE '%".$valueDetalhado['numeroUnico_ticket']."%') AND 
																					  stat='1'
																				   "));
	
	
								$cupomArray = unserialize($rSqlDescontoItem['comprando']);
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
	
								if($achou_cupom>0) {
									if(trim($rSqlDescontoItem['tipo_desconto'])=="valor") {
										$valorDescontoCupom = $rSqlDescontoItem['desconto'];
										$valueDetalhado['valor_desconto_em_item_adquirido'] = $valueDetalhado['valor_subtotal'] - $valorDescontoCupom;
									} else {
										$porcentagemGet = $rSqlDescontoItem['desconto'];
										if($porcentagemGet>0) {
											$valorDescontoCupom = ($porcentagemGet / 100) * $valueDetalhado['valor_subtotal'];
										} else {
											$valorDescontoCupom = 0;
										}
										$valueDetalhado['valor_desconto_em_item_adquirido'] = $valueDetalhado['valor_subtotal'] - $valorDescontoCupom;
									}
								} else {
									$valueDetalhado['valor_desconto_em_item_adquirido'] = "";
								}
							} else {
								$valueDetalhado['valor_desconto_em_item_adquirido'] = "";
							}
	
							$valueDetalhado['pessoa_nome'] = "".addslashes($_POST['pessoa_nome'])."";
							$valueDetalhado['pessoa_documento'] = "".$_POST['pessoa_documento']."";
							$valueDetalhado['pessoa_email'] = "".$_POST['pessoa_email']."";
							$valueDetalhado['pessoa_telefone'] = "".$_POST['pessoa_telefone']."";
							$valueDetalhado['email_enviar'] = "".$_POST['email_enviar']."";
							$valueDetalhado['telefone_enviar'] = "".$_POST['telefone_enviar']."";
							$valueDetalhado['valor_desconto_em_item_adquirido'] = "".$valueDetalhado['valor_desconto_em_item_adquirido']."";
						} else if(trim($_POST['marcado'])=="0") {
							$valueDetalhado['pessoa_nome'] = "";
							$valueDetalhado['pessoa_documento'] = "";
							$valueDetalhado['pessoa_email'] = "";
							$valueDetalhado['pessoa_telefone'] = "";
							$valueDetalhado['email_enviar'] = "0";
							$valueDetalhado['telefone_enviar'] = "0";
							$valueDetalhado['valor_desconto_em_item_adquirido'] = "";
						}
						$valueDetalhado['marcado'] = "".$_POST['marcado']."";
					} else {
						$valueDetalhado['pessoa_nome'] = $valueDetalhado['pessoa_nome'];
						$valueDetalhado['pessoa_documento'] = $valueDetalhado['pessoa_documento'];
						$valueDetalhado['pessoa_email'] = $valueDetalhado['pessoa_email'];
						$valueDetalhado['pessoa_telefone'] = $valueDetalhado['pessoa_telefone'];
						$valueDetalhado['email_enviar'] = $valueDetalhado['email_enviar'];
						$valueDetalhado['telefone_enviar'] = $valueDetalhado['telefone_enviar'];
						$valueDetalhado['valor_desconto_em_item_adquirido'] = $valueDetalhado['valor_desconto_em_item_adquirido'];
						$valueDetalhado['marcado'] = $valueDetalhado['marcado'];
					}
					$dataDetalhadoControle[] = array("tag" => "carrinho-detalhado", 
													 "ordem" => "".$valueDetalhado['ordem']."", 
													 "tipo" => "".$valueDetalhado['tipo']."", 
													 "empresa" => "".$valueDetalhado['empresa']."", 
													 "empresa_token" => "".$valueDetalhado['empresa_token']."", 
													 "numeroUnico_pai" => "".$valueDetalhado['numeroUnico_pai']."", 
													 "numeroUnico" => "".$valueDetalhado['numeroUnico']."", 
	
													 "numeroUnico_loja" => "".$valueDetalhado['numeroUnico_loja']."", 
													 "numeroUnico_produto" => "".$valueDetalhado['numeroUnico_produto']."", 
													 "numeroUnico_evento" => "".$valueDetalhado['numeroUnico_evento']."", 
													 "numeroUnico_ticket" => "".$valueDetalhado['numeroUnico_ticket']."", 
													 "numeroUnico_lote" => "".$valueDetalhado['numeroUnico_lote']."", 
													 "lote" => "".$valueDetalhado['lote']."", 
					
													 "numeroUnico_pessoa" => "".$valueDetalhado['numeroUnico_pessoa']."", 
													 "pessoa_nome" => "".$valueDetalhado['pessoa_nome']."", 
													 "pessoa_documento" => "".$valueDetalhado['pessoa_documento']."", 
													 "pessoa_email" => "".$valueDetalhado['pessoa_email']."", 
													 "pessoa_telefone" => "".$valueDetalhado['pessoa_telefone']."", 
	
													 "produto_nome" => "".$valueDetalhado['produto_nome']."", 
													 "evento_nome" => "".$valueDetalhado['evento_nome']."", 
													 "ingresso_nome" => "".$valueDetalhado['ingresso_nome']."", 
													 "ingresso_data" => "".$valueDetalhado['ingresso_data']."", 
													 "ticket_genero" => "".$valueDetalhado['ticket_genero']."", 
													 "ticket_compra_autorizada" => "".$valueDetalhado['ticket_compra_autorizada']."", 
													 "imagem" => "".$valueDetalhado['imagem']."", 
													 "ticket_exibir_lote" => "".$valueDetalhado['ticket_exibir_lote']."", 
													 "ticket_exibir_taxa" => "".$valueDetalhado['ticket_exibir_taxa']."", 
													 "ticket_exigir_atribuicao" => "".$valueDetalhado['ticket_exigir_atribuicao']."", 
	
													 "valor" => "".$valueDetalhado['valor']."", 
													 "valor_subtotal" => "".$valueDetalhado['valor_subtotal']."", 
													 "valor_total" => "".$valueDetalhado['valor_total']."", 
													 "valor_promocional" => "".$valueDetalhado['valor_promocional']."", 
													 "valor_pago" => "".$valueDetalhado['valor_pago']."", 
													 "valor_desconto_em_item_adquirido" => "".$valueDetalhado['valor_desconto_em_item_adquirido']."", 
	
													 "marcado" => "".$valueDetalhado['marcado']."", 
													 "email_enviar" => "".$valueDetalhado['email_enviar']."", 
													 "telefone_enviar" => "".$valueDetalhado['telefone_enviar']."", 
													 "qtd" => "1", 
													 "stat" => "1");
				}
				
				$dataDetalhadoControleSerial = serialize($dataDetalhadoControle);
				$_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].''] = $dataDetalhadoControleSerial;
				echo "nao_existe";
			} else {
				echo "ja_existe";
			}
		}
	} else {
		echo "nao_autorizada";
	}
} else {

	$carrinhoDetalhadoArray = unserialize($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].'']);
	$carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'ordem', SORT_ASC);
	foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
		if($_POST['numeroUnico']==$valueDetalhado['numeroUnico']) {
			$valueDetalhado['pessoa_nome'] = "";
			$valueDetalhado['pessoa_documento'] = "";
			$valueDetalhado['pessoa_email'] = "";
			$valueDetalhado['pessoa_telefone'] = "";
			$valueDetalhado['email_enviar'] = "0";
			$valueDetalhado['telefone_enviar'] = "0";
			$valueDetalhado['valor_desconto_em_item_adquirido'] = "";
			$valueDetalhado['marcado'] = "".$_POST['marcado']."";
		} else {
			$valueDetalhado['pessoa_nome'] = $valueDetalhado['pessoa_nome'];
			$valueDetalhado['pessoa_documento'] = $valueDetalhado['pessoa_documento'];
			$valueDetalhado['pessoa_email'] = $valueDetalhado['pessoa_email'];
			$valueDetalhado['pessoa_telefone'] = $valueDetalhado['pessoa_telefone'];
			$valueDetalhado['email_enviar'] = $valueDetalhado['email_enviar'];
			$valueDetalhado['telefone_enviar'] = $valueDetalhado['telefone_enviar'];
			$valueDetalhado['valor_desconto_em_item_adquirido'] = $valueDetalhado['valor_desconto_em_item_adquirido'];
			$valueDetalhado['marcado'] = $valueDetalhado['marcado'];
		}
		$dataDetalhadoControle[] = array("tag" => "carrinho-detalhado", 
										 "ordem" => "".$valueDetalhado['ordem']."", 
										 "tipo" => "".$valueDetalhado['tipo']."", 
										 "empresa" => "".$valueDetalhado['empresa']."", 
										 "empresa_token" => "".$valueDetalhado['empresa_token']."", 
										 "numeroUnico_pai" => "".$valueDetalhado['numeroUnico_pai']."", 
										 "numeroUnico" => "".$valueDetalhado['numeroUnico']."", 

										 "numeroUnico_loja" => "".$valueDetalhado['numeroUnico_loja']."", 
										 "numeroUnico_produto" => "".$valueDetalhado['numeroUnico_produto']."", 
										 "numeroUnico_evento" => "".$valueDetalhado['numeroUnico_evento']."", 
										 "numeroUnico_ticket" => "".$valueDetalhado['numeroUnico_ticket']."", 
										 "numeroUnico_lote" => "".$valueDetalhado['numeroUnico_lote']."", 
										 "lote" => "".$valueDetalhado['lote']."", 
		
										 "numeroUnico_pessoa" => "".$valueDetalhado['numeroUnico_pessoa']."", 
										 "pessoa_nome" => "".$valueDetalhado['pessoa_nome']."", 
										 "pessoa_documento" => "".$valueDetalhado['pessoa_documento']."", 
										 "pessoa_email" => "".$valueDetalhado['pessoa_email']."", 
										 "pessoa_telefone" => "".$valueDetalhado['pessoa_telefone']."", 

										 "produto_nome" => "".$valueDetalhado['produto_nome']."", 
										 "evento_nome" => "".$valueDetalhado['evento_nome']."", 
										 "ingresso_nome" => "".$valueDetalhado['ingresso_nome']."", 
										 "ingresso_data" => "".$valueDetalhado['ingresso_data']."", 
										 "ticket_genero" => "".$valueDetalhado['ticket_genero']."", 
										 "ticket_compra_autorizada" => "".$valueDetalhado['ticket_compra_autorizada']."", 
										 "imagem" => "".$valueDetalhado['imagem']."", 
										 "ticket_exibir_lote" => "".$valueDetalhado['ticket_exibir_lote']."", 
										 "ticket_exibir_taxa" => "".$valueDetalhado['ticket_exibir_taxa']."", 
										 "ticket_exigir_atribuicao" => "".$valueDetalhado['ticket_exigir_atribuicao']."", 

										 "valor" => "".$valueDetalhado['valor']."", 
										 "valor_subtotal" => "".$valueDetalhado['valor_subtotal']."", 
										 "valor_total" => "".$valueDetalhado['valor_total']."", 
										 "valor_promocional" => "".$valueDetalhado['valor_promocional']."", 
										 "valor_pago" => "".$valueDetalhado['valor_pago']."", 
										 "valor_desconto_em_item_adquirido" => "".$valueDetalhado['valor_desconto_em_item_adquirido']."", 

										 "marcado" => "".$valueDetalhado['marcado']."", 
										 "email_enviar" => "".$valueDetalhado['email_enviar']."", 
										 "telefone_enviar" => "".$valueDetalhado['telefone_enviar']."", 
										 "qtd" => "1", 
										 "stat" => "1");
	}
	
	$dataDetalhadoControleSerial = serialize($dataDetalhadoControle);
	$_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].''] = $dataDetalhadoControleSerial;
}
?>



