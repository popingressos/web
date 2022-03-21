<?
$qSql = mysql_query("
					SELECT 
						mod_eventos.id,
						mod_eventos.numeroUnico,
						mod_eventos.empresa,
						mod_eventos.nome,
						mod_eventos.imagem_de_capa,
						mod_eventos.imagem_de_banner,
						mod_eventos.imagem_de_icone,
						mod_eventos.data_de_publicacao,
						mod_eventos.data_de_despublicacao,
						mod_eventos.hora_inicio,
						mod_eventos.hora_fim,
						mod_eventos.tickets,
						mod_eventos.lotes,
						mod_eventos.horarios,
						mod_eventos.data_do_evento,
						mod_eventos.detalhe,
						mod_eventos.senhas_para_evento,

						mod_eventos.local,
						mod_eventos.cep,
						mod_eventos.rua,
						mod_eventos.numero,
						mod_eventos.complemento,
						mod_eventos.estado,
						mod_eventos.cidade,
						mod_eventos.bairro,
						mod_eventos.latitude,
						mod_eventos.longitude
					FROM 
						eventos AS mod_eventos 
					WHERE 
						mod_eventos.numeroUnico='".$numeroUnicoGet."'
					");
					
$rSql = mysql_fetch_array($qSql);

$dataEventoSet = substr($rSql['data_do_evento'],0,10);
$horaEventoSet = substr($rSql['data_do_evento'],11,5);
$diasemana_numero = date('w', strtotime($dataEventoSet));


$preco_deSet = "";
$preco_ateSet = "";

$ticket_data_deSet = "";
$ticket_data_ateSet = "";

$contLista = 0;
$cont_datasLista = 0;
$ticketsArray = unserialize($rSql['tickets']);
$ticketsArray = array_sort($ticketsArray, 'ticket_data', SORT_ASC);
foreach ($ticketsArray as $key => $ticket) {

	if(trim($ticket['ticket_data'])>=$data) {
		if(trim($ticket['stat'])=="1") {
			if(trim($ticket['ticket_exibir_site'])=="1") {
				$horariosLista = "NAO";
				$cont_horariosLista = 0;
				$horariosContArray = unserialize($rSql['horarios']);
				foreach ($horariosContArray as $key => $horariosCont) {
					if(trim($ticket['numeroUnico'])==trim($horariosCont['numeroUnico_ticket']) && trim($horariosCont['stat'])=="1") {
						$cont_horariosLista++;
					}
				}
				if($cont_horariosLista>0) {
					$horariosLista = "SIM";
				}
	
				$valor_original = 0;
				$valor = 0;
				$loteSetado = 0;
				$lotesArray = unserialize($rSql['lotes']);
				$lotesArray = array_sort($lotesArray, 'lote', SORT_ASC);
				foreach ($lotesArray as $key => $lote) {
					if(trim($ticket['numeroUnico'])==trim($lote['numeroUnico_ticket']) && trim($lote['stat'])=="1" && trim($loteSetado)=="0") {
	
						$nSqlCarrinhoLote = mysql_fetch_row(mysql_query("SELECT 
																			COUNT(*) 
																		 FROM 
																			carrinho_notificacao 
																		 WHERE 
																			numeroUnico_lote='".$lote['numeroUnico']."' AND 
																			stat='1'
																		 "));
						if($lote['lote_qtd']>$nSqlCarrinhoLote[0]) {
	
							$qtd = $lote['lote_qtd'];
							$valor_subtotal = $lote['lote_valor'];
	
							$valueDetalhado["taxa_cms"] = retornaTaxas("".$rSql['empresa']."","APP","taxa_cms");
							#$valor = $lote['lote_valor'] + ($lote['lote_valor'] / 100 * $valueDetalhado["taxa_cms"]);
	
	
							if(trim($MODELO_BUILD)=="pdv") {
								$valueDetalhado["taxa_cms"] = retornaTaxas("".$rSql['empresa']."","PDV","taxa_cms");
							} else {
								if(trim($rSql['numeroUnico'])=="I7zZujtbY4d4RS2fqw9kLa6JAt9P8Q" || trim($rSql['numeroUnico'])=="5FzpavMv2LBtldtaScT2P73Hy9tKH3") {
									$valueDetalhado["taxa_cms"] = retornaTaxas("".$rSql['empresa']."","APP","taxa_cms");
								} else {
									$valueDetalhado["taxa_cms"] = retornaTaxas("".$rSql['empresa']."","".$DeviceGet."","taxa_cms");
								}
							}
							
							if(trim($valueDetalhado["taxa_cms"])=="" || trim($valueDetalhado["taxa_cms"])=="0") {
								$valueDetalhado["taxa_cms"] = 0;
							}
	
							$valor_original = $lote['lote_valor'];
							$valor = $lote['lote_valor'] + ($lote['lote_valor'] / 100 * $valueDetalhado["taxa_cms"]);
							#$valor = $lote['lote_valor'] + ($lote['lote_valor'] / 100 * $rSqlEmpresaTaxas['taxa_app_ccr_cms']);
	
							$valor_taxa = 0;
							$n_lote = $lote['lote'];
							$id_lote = $lote['numeroUnico'];
							$numeroUnico_lote = $lote['numeroUnico'];
							$precoSet = "R$ ".number_format($valor, 2, ',', '.')."";
							$loteSetado = 1;
				
							if($cont_datasLista==1) {
								$preco_deSet = $lote['lote_valor'];
							}
							if($lote['lote_valor']>$preco_deSet) {
								$preco_ateSet = "".$lote['lote_valor']."";
							}
							
						}
				
					}
				}
	
				if(trim($ticket['ticket_compra_autorizada'])=="0" || trim($ticket['ticket_compra_autorizada'])=="") {
					$compra_autorizadaSet = "0";
				} else if(trim($ticket['ticket_compra_autorizada'])=="1") {
					$compra_autorizadaSet = "1";
				}
	
				if(trim($ticket['ticket_exigir_atribuicao'])=="0" || trim($ticket['ticket_exigir_atribuicao'])=="") {
					$ticket_exigir_atribuicaoSet = "0";
				} else if(trim($ticket['ticket_exigir_atribuicao'])=="1") {
					$ticket_exigir_atribuicaoSet = "1";
				}
	
				if($ticket['ticket_genero']=="U") {
					$generoSet = "Unissex";
				} else if($ticket['ticket_genero']=="F") {
					$generoSet = "Feminino";
				} else if($ticket['ticket_genero']=="M") {
					$generoSet = "Masculino";
				}
			
				if($ticket['ticket_tipo']=="0") {
					$prevendaSet = "0";
					$txt_lote = "".$n_lote."° Lote";
				} else if($ticket['ticket_tipo']=="1") {
					$prevendaSet = "1";
					$txt_lote = "";
				} else if($ticket['ticket_tipo']=="2") {
					$prevendaSet = "2";
					$txt_lote = "Lista Bônus";
				} else if($ticket['ticket_tipo']=="3") {
					$prevendaSet = "0";
					$txt_lote = "".$n_lote."° Lote";
				}
		
				$capaTicketSet = "".$link."files/eventos_ticket_imagem_de_capa/".$ticket['numeroUnico']."/".$ticket['ticket_imagem_de_capa']."";
				$ticket_mapaSet = "".$link."files/eventos_ticket_mapa/".$ticket['numeroUnico']."/".$ticket['ticket_mapa']."";
			
				if(trim($ticket['ticket_mapa'])=="") { $showImagemSet = 0; } else { $showImagemSet = 1; }
				if(trim($ticket['ticket_info'])=="") { $showInfoSet = 0; } else { $showInfoSet = 1; }
	
				if(trim($ticket['ticket_construtor_de_mapa'])=="" || trim($ticket['ticket_construtor_de_mapa'])=="0") {
					$cadeiraSet = "0";
				} else {
					$cadeiraSet = "1";
				}
	
				if($valor>0) {
					$tickets[] = array(
												"tag" => "evento", 
												"id" => "".$ticket['numeroUnico']."", 
												"numeroUnico" => "".$ticket['numeroUnico']."", 
												"numeroUnico_filial" => "", 
												"numeroUnico_evento" => "".$rSql['numeroUnico']."", 
												"numeroUnico_ticket" => "".$ticket['numeroUnico']."", 
												"numeroUnico_lote" => "".$numeroUnico_lote."", 
												"limite_boleto" => "", 
												"genero" => "".$ticket['ticket_genero']."", 
												"fila_compra" => "", 
												"qtd" => 0, 
												"show" => false, 
												"cadeira" => $cadeiraSet, 
												"name" => "".$ticket["ticket_nome"]."", 
												"subname" => "", 
												"prevenda" => "".$prevendaSet."", 
												"image_tipo" => "url",
												"image" => $capaTicketSet,
				
												"evento_nome" => "".$rSql["nome"]."", 
												"evento_data" => "".ajustaDataSemHoraReturn($rSql['data_do_evento'],"d/m/Y")." - ".$diasemana[$diasemana_numero]."", 
												"ticket_nome" => "".$ticket["ticket_nome"]."", 
												"ticket_meia_entrada" => "".$ticket['ticket_meia_entrada']."", 
												"ticket_data" => "".$ticket['ticket_data']."", 
												"ticket_genero" => "".$ticket['ticket_genero']."", 
												"ticket_genero_txt" => "".$generoSet."", 
												"ticket_compra_autorizada" => "".$compra_autorizadaSet."", 
												"ticket_exigir_atribuicao" => "".$ticket_exigir_atribuicaoSet."", 
				
												"horario_set" => "NAO", 
						
												"imagem_show" => $showImagemSet,
												"info_show" => $showInfoSet,
				
												"imagem" => $ticket_mapaSet,
												"info" => "".$ticket["info"]."",
				
												"cliente_registro" => "sim",
												"valor_original" => $valor_original,
												"valor" => $precoSet,
												"valor_subtotal" => $valor_subtotal,
												"valor_total" => $valor,
												"preco" => $valor,
												"preco_com_cupom" => $valor,
				
												"valor_taxa_produto_empresa_cobra" => 0,
												"valor_taxa_produto_empresa" => 0,
					
												"valor_taxa_produto_cms_cobra" => 0,
												"valor_taxa_produto_cms" => 0,
					
												"valor_taxa_entregador" => 0,
												"valor_taxa" => $valor_taxa,
					
												"adicionaisN" => 0,
												"horariosN" => "".$horariosLista."",
					
												"description" => $generoSet,
												"lote" => "".$txt_lote.""
											);
				}
		
				$procura = "".$ticket["ticket_data"]."";
				$coluna = "ticket_data";
				
				$found_key = array_search(
					$procura,
					array_filter(
						array_combine(
							array_keys($tickets_datas),
							array_column(
								$tickets_datas, $coluna
							)
						)
					)
				);
	
				if(trim($found_key)=="") {
					$cont_datasLista++;
					$d  = substr($ticket['ticket_data'],8,2);
					$a  = substr($ticket['ticket_data'],0,4);
			
					if($cont_datasLista==1) {
						$ticket_data_deSet = $ticket['ticket_data'];
					}
					if($ticket['ticket_data']>$ticket_data_deSet) {
						$ticket_data_ateSet = "".$ticket['ticket_data']."";
					}
					
					// com-feira, sem-feira, curto
					$diasemana = diasemana_extenso($ticket['ticket_data'],"com-feira");
					
					$mes = mes_extenso(substr($ticket['ticket_data'],5,2),"longo");
			
					$tickets_datas[] = array(
										"tag" => "ticket_data", 
										"id" => "".$ticket['numeroUnico']."", 
										"numeroUnico" => "".$ticket['numeroUnico']."", 
										"numeroUnico_filial" => "", 
										"numeroUnico_evento" => "".$rSql['numeroUnico']."", 
										"numeroUnico_ticket" => "".$ticket['numeroUnico']."", 
										"numeroUnico_lote" => "".$numeroUnico_lote."", 
										"ticket_data" => "".$ticket["ticket_data"]."", 
										"ticket_data_diasemana" => "".$diasemana."", 
										"ticket_data_mes" => "".$mes."", 
										"ticket_data_print" => "".ajustaDataReturn($ticket['ticket_data'],"d/m/Y")."", 
									);
				}
			}
		}
	}
}

$cont_horariosLista = 0;
$horariosArray = unserialize($rSql['horarios']);
$horariosArray = array_sort($horariosArray, 'horario_inicio_time', SORT_ASC);
foreach ($horariosArray as $key => $horario) {
	$cont_horariosLista++;

	$ticket_nomeSet = "";
	$ticket_generoSet = "";
	$ticket_generoTxtSet = "";
	$ticket_meia_entradaSet = "";
	$ticket_infoSet = "";
	$ticketsInArray = unserialize($rSql['tickets']);
	$ticketsInArray = array_sort($ticketsInArray, 'ticket_data', SORT_ASC);
	foreach ($ticketsInArray as $key => $ticketIn) {
		if(trim($ticketIn['numeroUnico'])==trim($horario['numeroUnico_ticket'])) {
			$ticket_nomeSet = $ticketIn['ticket_nome'];
			$ticket_generoSet = $ticketIn['ticket_genero'];
			$ticket_meia_entradaSet = $ticketIn['ticket_meia_entrada'];
			$ticket_infoSet = $ticketIn['info'];

			$loteInSetado = 0;
			$lotesInArray = unserialize($rSql['lotes']);
			$lotesInArray = array_sort($lotesInArray, 'lote', SORT_ASC);
			foreach ($lotesInArray as $key => $loteIn) {
				if(trim($ticketIn['numeroUnico'])==trim($loteIn['numeroUnico_ticket']) && trim($loteIn['stat'])=="1" && trim($loteInSetado)=="0") {
					$qtd = $loteIn['lote_qtd'];
					$valor = $loteIn['lote_valor'];
					$valor_taxa = 0;
					$n_lote = $loteIn['lote'];
					$id_lote = $loteIn['numeroUnico'];
					$numeroUnico_lote = $loteIn['numeroUnico'];
					$precoSet = "R$ ".number_format($valor, 2, ',', '.')."";
					$loteSetado = 1;
				}
			}
		
			if(trim($ticketIn['ticket_compra_autorizada'])=="0" || trim($ticketIn['ticket_compra_autorizada'])=="") {
				$compra_autorizadaSet = "0";
			} else if(trim($ticketIn['ticket_compra_autorizada'])=="1") {
				$compra_autorizadaSet = "1";
			}

			if($ticketIn['ticket_genero']=="U") {
				$ticket_generoTxtSet = "Unissex";
			} else if($ticketIn['ticket_genero']=="F") {
				$ticket_generoTxtSet = "Feminino";
			} else if($ticketIn['ticket_genero']=="M") {
				$ticket_generoTxtSet = "Masculino";
			}

			if($ticketIn['ticket_tipo']=="0") {
				$prevendaSet = "0";
				$txt_lote = "".$n_lote."° Lote";
			} else if($ticketIn['ticket_tipo']=="1") {
				$prevendaSet = "1";
				$txt_lote = "";
			} else if($ticketIn['ticket_tipo']=="2") {
				$prevendaSet = "2";
				$txt_lote = "Lista Bônus";
			} else if($ticketIn['ticket_tipo']=="3") {
				$prevendaSet = "0";
				$txt_lote = "".$n_lote."° Lote";
			}

			$capaTicketSet = "".$link."files/eventos_ticket_imagem_de_capa/".$ticketIn['numeroUnico']."/".$ticketIn['ticket_imagem_de_capa']."";
			$ticket_mapaSet = "".$link."files/eventos_ticket_mapa/".$ticketIn['numeroUnico']."/".$ticketIn['ticket_mapa']."";
		
			if(trim($ticketIn['ticket_mapa'])=="") { $showImagemSet = 0; } else { $showImagemSet = 1; }
			if(trim($ticketIn['ticket_info'])=="") { $showInfoSet = 0; } else { $showInfoSet = 1; }
		}
	}
	
	$horarios[] = array(
						"tag" => "evento", 
						"id" => "".$horario['numeroUnico']."", 
						"numeroUnico" => "".$horario['numeroUnico']."", 
						"numeroUnico_filial" => "", 
						"numeroUnico_evento" => "".$rSql['numeroUnico']."", 
						"numeroUnico_ticket" => "".$horario['numeroUnico_ticket']."", 
						"numeroUnico_horario" => "".$horario['numeroUnico']."", 
						"numeroUnico_lote" => "".$numeroUnico_lote."", 
						"limite_boleto" => "", 
						"genero" => "".$ticket_generoSet."", 
						"fila_compra" => "", 
						"qtd" => 0, 
						"show" => false, 
						"cadeira" => "0", 
						"name" => "".$ticket_nomeSet."", 
						"subname" => "", 
						"prevenda" => "".$prevendaSet."", 
						"image_tipo" => "url",
						"image" => $capaTicketSet,

						"horario_set" => "SIM", 
						"horario_tempo" => "".$horario['horario_tempo']."", 
						"horario_inicio" => "".$horario['horario_inicio']."", 
						"horario_inicio_time" => $horario['horario_inicio_time'], 
						"horario_fim" => "".$horario['horario_fim']."", 
						"horario_fim_time" => $horario['horario_fim_time'], 
						"stat" => "".$horario['stat']."",

						"image_tipo" => "url",
						"image" => $capaTicketSet,

						"evento_nome" => "".$rSql["nome"]."", 
						"evento_data" => "".ajustaDataSemHoraReturn($rSql['data_do_evento'],"d/m/Y")." - ".$diasemana[$diasemana_numero]."", 
						"ticket_nome" => "".$ticket_nomeSet."", 
						"ticket_meia_entrada" => "".$ticket_meia_entradaSet."", 
						"ticket_genero" => "".$ticket_generoSet."", 
						"ticket_genero_txt" => "".$ticket_generoTxtSet."", 
						"ticket_compra_autorizada" => "".$compra_autorizadaSet."", 

						"imagem_show" => $showImagemSet,
						"info_show" => $showInfoSet,

						"imagem" => $ticket_mapaSet,
						"info" => "".$ticket_infoSet."",

						"cliente_registro" => "sim",
						"valor" => $precoSet,
						"preco" => $valor,
						"preco_com_cupom" => $valor,

						"valor_taxa_produto_empresa_cobra" => 0,
						"valor_taxa_produto_empresa" => 0,

						"valor_taxa_produto_cms_cobra" => 0,
						"valor_taxa_produto_cms" => 0,

						"valor_taxa_entregador" => 0,
						"valor_taxa" => $valor_taxa,

						"adicionaisN" => 0,

						"description" => $generoSet,
						"lote" => "".$txt_lote.""
						);

}

if(trim($rSql['senhas_para_evento'])=="" || trim($rSql['senhas_para_evento'])=="0") { $senhas_para_eventoSet = false; } else { $senhas_para_eventoSet = true; }
if(trim($rSql['chat'])=="" || trim($rSql['chat'])=="0") { $chatSet = "0"; } else { $chatSet = "1"; }

#Montagem de endereço
$monta_endereco_geo = "".str_replace(" ","%20",str_replace("-","",$rSql['cep']))."";
$monta_endereco_geo .= ",".str_replace(" ","%20",$rSql['rua'])."";
if(trim($rSql['numero'])=="") { } else { $monta_endereco_geo .= ", ".$rSql['numero'].""; }
if(trim($rSql['bairro'])=="") { } else { $monta_endereco_geo .= ", ".str_replace(" ","%20",$rSql['bairro']).""; }
if(trim($rSql['cidade'])=="") { } else { $monta_endereco_geo .= ", ".str_replace(" ","%20",$rSql['cidade']).""; }
if(trim($rSql['estado'])=="") { } else { $monta_endereco_geo .= ", ".$rSql['estado'].""; }
$endereco_printSet = "".$monta_endereco_geo."";
$address = "".$monta_endereco_geo."";
$address = str_replace(" ","%20",$address);

#Montagem de endereço
$monta_endereco_print = "".$rSql['rua']."";
if(trim($rSql['numero'])=="") { } else { $monta_endereco_print .= ", ".$rSql['numero'].""; }
if(trim($rSql['bairro'])=="") { } else { $monta_endereco_print .= " - ".$rSql['bairro'].""; }
if(trim($rSql['cidade'])=="") { } else { $monta_endereco_print .= " - ".$rSql['cidade'].""; }
if(trim($rSql['estado'])=="") { } else { $monta_endereco_print .= "/".$rSql['estado'].""; }
$address_print1 = "".$monta_endereco_print."";
$address_print2 = "CEP ".$rSql['cep']."";

$rSql['imagem_de_capa'] = "".str_replace(" ","+",$rSql['imagem_de_capa'])."";
$rSql['imagem_de_banner'] = "".str_replace(" ","+",$rSql['imagem_de_banner'])."";
$rSql['imagem_de_icone'] = "".str_replace(" ","+",$rSql['imagem_de_icone'])."";

if($cont_datasLista>1) {
	$datasViewSet = "SIM";
} else {
	$datasViewSet = "NAO";
}

if($cont_horariosLista>0) {
	$horariosViewSet = "SIM";
} else {
	$horariosViewSet = "NAO";
}

$dataEventoSet = substr($rSql['data_do_evento'],0,10);
$horaEventoSet = substr($rSql['data_do_evento'],11,5);

// com-feira, sem-feira, curto
$diasemana = diasemana_extenso($rSql['data_do_evento'],"com-feira");

$diasemana_de = diasemana_extenso($ticket_data_deSet,"sem-feira");
$d_de  = substr($ticket_data_deSet,8,2);
$mes_de = mes_extenso(substr($ticket_data_deSet,5,2),"longo");
$a_de  = substr($ticket_data_deSet,0,4);
if(trim($ticket_data_ateSet)=="") {
	$data_extensoSet = "".$diasemana_de.", ".$d_de." DE ".$mes_de."/".$a_de."";
} else {
	$diasemana_ate = diasemana_extenso($ticket_data_ateSet,"sem-feira");
	$d_ate  = substr($ticket_data_ateSet,8,2);
	$mes_ate = mes_extenso(substr($ticket_data_ateSet,5,2),"longo");
	$a_ate  = substr($ticket_data_ateSet,0,4);
	$data_extensoSet = "".$diasemana_de.", ".$d_de." DE ".$mes_de."/".$a_de." A ".$diasemana_ate.", ".$d_ate." DE ".$mes_ate."/".$a_ate."";
}

$preco_deSet = "R$ ".number_format($preco_deSet, 2, ',', '.')."";
$preco_ateSet = "R$ ".number_format($preco_ateSet, 2, ',', '.')."";

$campos["data"][] = array(
							"tag" => "eventos-detalhe", 
							"id" => "".$rSql['id']."", 
							"numeroUnico" => "".$rSql['numeroUnico']."",
							"numeroUnico_evento" => "".$rSql['numeroUnico']."",
							"senhas_para_evento" => "".$senhas_para_eventoSet."", 
							"chat" => "".$chatSet."", 
							"name" => "".$rSql['nome']."", 
							"nome" => "".$rSql['nome']."", 
							"imagem_de_capa" => "".$rSql['imagem_de_capa']."", 
							"imagem_de_banner" => "".$rSql['imagem_de_banner']."", 
							"imagem_de_icone" => "".$rSql['imagem_de_icone']."",
							"data_vinculacao_inicio" => "".$rSql['data_de_publicacao']."", 
							"data_vinculacao_fim" => "".$rSql['data_de_despublicacao']."", 
							"link_mapa" => "//www.google.com/maps/place/".$address."", 
							"text" => "".ajustaDataSemHoraReturn($rSql['data_do_evento'],"d/m/Y")." - ".$diasemana."", 
							"description" => "".$rSql['local']."",
							"info" => "".caracteres_especiais($rSql['detalhe'],"ler")."",
							"cont_datasLista" => "".$cont_datasLista."",
							"local" => "".$rSql['local']."",
							"endereco_evento1" => "".$address_print1."",
							"endereco_evento2" => "".$address_print2."",
							"preco_de" => "".$preco_deSet."",
							"preco_ate" => "".$preco_ateSet."",
							"ticket_data_de" => "".$ticket_data_deSet."",
							"ticket_data_ate" => "".$ticket_data_ateSet."",
							"data_extenso" => "".strtoupper($data_extensoSet)."",
							"horario_extenso" => "".substr($rSql['hora_inicio'],0,5)." - ".substr($rSql['hora_fim'],0,5)."",
							"datasView" => "".$datasViewSet."",
							"tickets_datas" => $tickets_datas,
							"tickets" => $tickets,
							"cont_horariosLista" => "".$cont_horariosLista."",
							"horariosView" => "".$horariosViewSet."",
							"horarios" => $horarios,
						);

if(count($campos)>0) {
	$campos["msg"] = "Eventos recuperados com sucesso";
	$campos["success"] = true;
} else {
	$campos["data"] = array("retorno" => "eventos-indisponiveis");
	$campos["msg"] = "Sem eventos disponíveis para exibição";
	$campos["success"] = true;
}
#echo "<pre>";
echo json_encode($campos);
?>