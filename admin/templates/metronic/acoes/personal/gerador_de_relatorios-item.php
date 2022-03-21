<?
$relatorio_html  = "";
if($tipoExport=="csv" || $tipoExport=="excel") { } else {
	$relatorio_html .= "<table class=\"table table-striped table-bordered table-hover tabela_com_scroll\" id=\"sample_1\">";
}
$relatorio_html .= "<thead>";
$relatorio_html .= "<tr>";
$relatorio_html .= "<th>#ID</th>";

			$corSet = "#ffffff";
			$campos_cabecalhoArray = unserialize($row['campos_cabecalho']);
			$campos_cabecalhoArray = array_sort($campos_cabecalhoArray, 'ordem', SORT_ASC);
			foreach ($campos_cabecalhoArray as $key => $value) {
				$contLista++;
				if($corSet=="#ffffff") {
					$corSet = "#e2e2e2";
				} else {
					$corSet = "#ffffff";
				}

$relatorio_html .= "<th>".$value['label']."</th>";
			}
$relatorio_html .= "</tr>";
$relatorio_html .= "</thead>";
$relatorio_html .= "<tbody>";

		$corSet = "#ffffff";
		for ($arrayFor = 0; $arrayFor < count($rSqlControle); $arrayFor++) {
			$rSqlRela = $rSqlControle[$arrayFor];

			if(trim($corSet)=="#ffffff") {
				$corSet = "#f6f6f6";
			} else {
				$corSet = "#ffffff";
			}
			
			$rSqlRela['idade'] = diferenca_entre_datas_sem_hora("".$rSqlRela['idade']."",date("Y-m-d"));

			if($tipoExport=="csv" || $tipoExport=="excel") { 
				if(trim($rSqlRela['numeroUnico_cupom'])=="") { 
					$rSqlRela['numeroUnico_cupom'] = "Sem cupom"; 
				} else {
					$rSqlRela['numeroUnico_cupom'] = "".$rSqlRela['cupom_de_desconto_nome'].""; 
				}
	
				if(trim($rSqlRela['forma_de_pagamento'])=="COR") { 
					$rSqlRela['valor_subtotal'] = 0.00;
					$rSqlRela['valor_total'] = 0.00;
				} else {
					if(trim($rSqlRela['valor_subtotal'])=="") { $rSqlRela['valor_subtotal'] = 0.00; } else { $rSqlRela['valor_subtotal'] = $rSqlRela['valor_subtotal']; }
					if(trim($rSqlRela['valor_total'])=="") { $rSqlRela['valor_total'] = 0.00; } else { $rSqlRela['valor_total'] = $rSqlRela['valor_total']; }

					if(trim($rSqlRela['valor_total'])=="") { 
						$rSqlRela['valor_total'] = 0.00; 
					} else { 
						if(trim($rSqlRela['qtd_parcelas'])=="") {
							$rSqlRela['qtd_parcelas'] = 1;
						}
						if(trim($rSqlRela['fator_parcelamento'])=="") {
							$rSqlRela['fator_parcelamento'] = 1;
						}
						$total_parcelado = $rSqlRela['valor_total'] / $rSqlRela['qtd_parcelas'];
						$parcela = $total_parcelado * $rSqlRela['fator_parcelamento'];
						$parcela = round($parcela,2);

						$rSqlRela['valor_total'] = $parcela * $rSqlRela['qtd_parcelas'];

						$rSqlRela['valor_total'] = $rSqlRela['valor_total']; 
					}
				}

				$rSqlRela['valor_lucro'] = $rSqlRela['valor_total'] - $rSqlRela['valor_subtotal'];

				$rSqlRela['pessoa_documento'] = preg_replace("/[^0-9]/", "", $rSqlRela['pessoa_documento']);
				$rSqlRela['pessoa_documento'] = preg_replace("/[^0-9]/", "", $rSqlRela['pessoa_documento']);
				$rSqlRela['documento'] = preg_replace("/[^0-9]/", "", $rSqlRela['documento']);

				if(trim($rSqlRela['lote_nome'])=="") { 
					if(trim($rSqlRela['forma_de_pagamento'])=="COR") { 
						$rSqlRela['lote_nome'] = "CORTESIA"; 
					} else {
						$rSqlRela['lote_nome'] = "Não informado"; 
					}
				} else { 
					if(strrpos($rSqlRela['lote_nome'],"Lote") === false) {
						$rSqlRela['lote_nome'] = "".$rSqlRela['lote_nome']."º Lote";
					} else {
						$rSqlRela['lote_nome'] = "".$rSqlRela['lote_nome']."";
					}
				}
			} else {
				if(trim($rSqlRela['numeroUnico_cupom'])=="") { 
					$rSqlRela['numeroUnico_cupom'] = "<i>Sem cupom</i>"; 
				} else {
					$rSqlRela['numeroUnico_cupom'] = "".$rSqlRela['cupom_de_desconto_nome'].""; 
				}
	
				if(trim($rSqlRela['forma_de_pagamento'])=="COR") { 
					$rSqlRela['valor_subtotal'] = 0.00;
					$rSqlRela['valor_total'] = 0.00;
				} else {
					if(trim($rSqlRela['valor_subtotal'])=="") { 
						$rSqlRela['valor_subtotal'] = 0.00;
					} else { 
						$rSqlRela['valor_subtotal'] = $rSqlRela['valor_subtotal']; 
					}
					
					if(trim($rSqlRela['valor_total'])=="") { 
						$rSqlRela['valor_total'] = 0.00;
					} else { 
						if(trim($rSqlRela['qtd_parcelas'])=="") {
							$rSqlRela['qtd_parcelas'] = 1;
						}
						if(trim($rSqlRela['fator_parcelamento'])=="") {
							$rSqlRela['fator_parcelamento'] = 1;
						}
						$total_parcelado = $rSqlRela['valor_total'] / $rSqlRela['qtd_parcelas'];
						$parcela = $total_parcelado * $rSqlRela['fator_parcelamento'];
						$parcela = round($parcela,2);

						$rSqlRela['valor_total'] = $parcela * $rSqlRela['qtd_parcelas'];

						$rSqlRela['valor_total'] = $rSqlRela['valor_total']; 
					}
				}
	
				$rSqlRela['valor_lucro'] = $rSqlRela['valor_total'] - $rSqlRela['valor_subtotal'];

				if(strlen($rSqlRela['pessoa_documento'])>11) {
					$rSqlRela['pessoa_documento'] = mascaraCPF($rSqlRela['pessoa_documento']);
				} else {
					$rSqlRela['pessoa_documento'] = mascaraCNPJ($rSqlRela['pessoa_documento']);
				}
				
				if(strlen($rSqlRela['pessoa_documento'])>11) {
					$rSqlRela['pessoa_documento'] = mascaraCPF($rSqlRela['pessoa_documento']);
				} else {
					$rSqlRela['pessoa_documento'] = mascaraCNPJ($rSqlRela['pessoa_documento']);
				}
				
				if(strlen($rSqlRela['documento'])>11) {
					$rSqlRela['documento'] = mascaraCPF($rSqlRela['documento']);
				} else {
					$rSqlRela['documento'] = mascaraCNPJ($rSqlRela['documento']);
				}

				if(trim($rSqlRela['lote_nome'])=="") { 
					if(trim($rSqlRela['forma_de_pagamento'])=="COR") { 
						$rSqlRela['lote_nome'] = "<i>CORTESIA</i>"; 
					} else {
						$rSqlRela['lote_nome'] = "<i>Não informado</i>"; 
					}
				} else { 
					if(strrpos($rSqlRela['lote_nome'],"Lote") === false) {
						$rSqlRela['lote_nome'] = "".$rSqlRela['lote_nome']."&deg; Lote";
					} else {
						$rSqlRela['lote_nome'] = "".$rSqlRela['lote_nome']."";
					}
				}
			}
			
			if(trim($rSqlRela['pessoa_nome'])=="") {
				$rSqlRela['pessoa_nome'] = "Pessoa não atribuída";
			} else {
				$rSqlRela['pessoa_nome'] = $rSqlRela['pessoa_nome'];
			}

			if(trim($rSqlRela['stat'])=="0") {
				$rSqlRela['stat'] = "Aguardando pagamento";
			} elseif(trim($rSqlRela['stat'])=="1") {
				$rSqlRela['stat'] = "Pago";
			} elseif(trim($rSqlRela['stat'])=="3") {
				$rSqlRela['stat'] = "Estornado";
			}

			if(trim($rSqlRela['pessoa_genero'])=="U" || trim($rSqlRela['pessoa_genero'])=="") {
				$rSqlRela['pessoa_genero'] = "Sem gênero definido";
			} elseif(trim($rSqlRela['pessoa_genero'])=="M") {
				$rSqlRela['pessoa_genero'] = "Masculino";
			} elseif(trim($rSqlRela['pessoa_genero'])=="F") {
				$rSqlRela['pessoa_genero'] = "Feminino";
			}

			if(trim($rSqlRela['genero'])=="U" || trim($rSqlRela['genero'])=="") {
				$rSqlRela['genero'] = "Sem gênero definido";
			} elseif(trim($rSqlRela['genero'])=="M") {
				$rSqlRela['genero'] = "Masculino";
			} elseif(trim($rSqlRela['genero'])=="F") {
				$rSqlRela['genero'] = "Feminino";
			}

			if(trim($rSqlRela['pessoa_profissional_da_saude'])=="" || trim($rSqlRela['pessoa_profissional_da_saude'])=="0") {
				$rSqlRela['pessoa_profissional_da_saude'] = "Não";
			} elseif(trim($rSqlRela['pessoa_profissional_da_saude'])=="1") {
				$rSqlRela['pessoa_profissional_da_saude'] = "Sim";
			}

			if(trim($rSqlRela['profissional_da_saude'])=="" || trim($rSqlRela['profissional_da_saude'])=="0") {
				$rSqlRela['profissional_da_saude'] = "Não";
			} elseif(trim($rSqlRela['profissional_da_saude'])=="1") {
				$rSqlRela['profissional_da_saude'] = "Sim";
			}

			if(trim($rSqlRela['confirmado'])=="" || trim($rSqlRela['confirmado'])=="0") {
				$rSqlRela['confirmado'] = "Não";
			} elseif(trim($rSqlRela['confirmado'])=="1") {
				$rSqlRela['confirmado'] = "Sim";
			}

			if(trim($rSqlRela['pago'])=="" || trim($rSqlRela['pago'])=="0") {
				$rSqlRela['pago'] = "Não";
			} elseif(trim($rSqlRela['pago'])=="1") {
				$rSqlRela['pago'] = "Sim";
			}

			if(trim($rSqlRela['pessoa_encontrase_acamado'])=="" || trim($rSqlRela['pessoa_encontrase_acamado'])=="0") {
				$rSqlRela['pessoa_encontrase_acamado'] = "Não";
			} elseif(trim($rSqlRela['pessoa_encontrase_acamado'])=="1") {
				$rSqlRela['pessoa_encontrase_acamado'] = "Sim";
			}

			if(trim($rSqlRela['pessoa_contraiu_doenca'])=="" || trim($rSqlRela['pessoa_contraiu_doenca'])=="0") {
				$rSqlRela['pessoa_contraiu_doenca'] = "Não";
				$rSqlRela['pessoa_doenca_outros'] = "Não contraiu";
			} elseif(trim($rSqlRela['pessoa_contraiu_doenca'])=="1") {
				$rSqlRela['pessoa_contraiu_doenca'] = "Sim";
				if(trim($rSqlRela['pessoa_numeroUnico_vacinas'])=="OUTROS") {
					$rSqlRela['pessoa_doenca_outros'] = "".$rSqlRela['pessoa_doenca_outros']."";
				} else {
					$rSqlRela['pessoa_doenca_outros'] = "".$rSqlRela['vacinas_nome']."";
				}
			}

			if(trim($rSqlRela['encontrase_acamado'])=="" || trim($rSqlRela['encontrase_acamado'])=="0") {
				$rSqlRela['encontrase_acamado'] = "Não";
			} elseif(trim($rSqlRela['encontrase_acamado'])=="1") {
				$rSqlRela['encontrase_acamado'] = "Sim";
			}

			if(trim($rSqlRela['atividades_nome'])=="" || trim($rSqlRela['atividades_nome'])=="0") {
				$rSqlRela['atividades_nome'] = "Não informada";
			} else {
				$rSqlRela['atividades_nome'] = $rSqlRela['atividades_nome'];
			}

			if(trim($rSqlRela['contraiu_doenca'])=="" || trim($rSqlRela['contraiu_doenca'])=="0") {
				$rSqlRela['contraiu_doenca'] = "Não";
				$rSqlRela['doenca_outros'] = "Não contraiu";
			} elseif(trim($rSqlRela['contraiu_doenca'])=="1") {
				$rSqlRela['contraiu_doenca'] = "Sim";
				if(trim($rSqlRela['numeroUnico_vacinas'])=="OUTROS") {
					$rSqlRela['doenca_outros'] = "".$rSqlRela['doenca_outros']."";
				} else {
					$rSqlRela['doenca_outros'] = "".$rSqlRela['vacinas_nome']."";
				}
			}

			if(trim($rSqlRela['pessoa_gestante'])=="" || trim($rSqlRela['pessoa_gestante'])=="0") {
				$rSqlRela['pessoa_gestante'] = "[".$rSqlRela['pessoa_gestante']."]Não";
			} elseif(trim($rSqlRela['pessoa_gestante'])=="1") {
				$rSqlRela['pessoa_gestante'] = "[".$rSqlRela['pessoa_gestante']."]Sim";
			}


			if(trim($rSqlRela['pessoa_puerpera'])=="" || trim($rSqlRela['pessoa_puerpera'])=="0") {
				$rSqlRela['pessoa_puerpera'] = "Não";
			} elseif(trim($rSqlRela['pessoa_puerpera'])=="1") {
				$rSqlRela['pessoa_puerpera'] = "Sim";
			}

			if(trim($rSqlRela['pessoa_comunicante_hanseniase'])=="" || trim($rSqlRela['pessoa_comunicante_hanseniase'])=="0") {
				$rSqlRela['pessoa_comunicante_hanseniase'] = "Não";
			} elseif(trim($rSqlRela['pessoa_comunicante_hanseniase'])=="1") {
				$rSqlRela['pessoa_comunicante_hanseniase'] = "Sim";
			}

			if(trim($rSqlRela['device'])=="" || trim($rSqlRela['device'])=="SITE") {
				$rSqlRela['device'] = "Site";
			} elseif(trim($rSqlRela['device'])=="APP") {
				$rSqlRela['device'] = "Aplicativo";
			} elseif(trim($rSqlRela['device'])=="PDVWEB") {
				$rSqlRela['device'] = "PDV Web";
			} elseif(trim($rSqlRela['device'])=="PDVAPP") {
				$rSqlRela['device'] = "PDV Maquineta";
			}

			if(trim($rSqlRela['forma_de_pagamento'])=="") {
				$rSqlRela['forma_de_pagamento'] = "Não informado";
			} elseif(trim($rSqlRela['forma_de_pagamento'])=="DIN") {
				$rSqlRela['forma_de_pagamento'] = "Dinheiro";
			} elseif(trim($rSqlRela['forma_de_pagamento'])=="CCR") {
				$rSqlRela['forma_de_pagamento'] = "Cartão de Crédito";
			} elseif(trim($rSqlRela['forma_de_pagamento'])=="CCD") {
				$rSqlRela['forma_de_pagamento'] = "Cartão de Débito";
			}

			if(trim($rSqlRela['envio_de_cortesia_nome'])=="") {
				if(trim($rSqlRela['envio_de_ingresso_nome'])=="") {
					$rSqlRela['lista_nome'] = "Não informado";
				} else {
					$rSqlRela['lista_nome'] = "".$rSqlRela['envio_de_ingresso_nome']."";
				}
			} else {
				$rSqlRela['lista_nome'] = "".$rSqlRela['envio_de_cortesia_nome']."";
			}

			if(trim($rSqlRela['envio_de_cortesia_data'])=="") {
				if(trim($rSqlRela['envio_de_ingresso_data'])=="") {
					$rSqlRela['lista_data'] = "Não informado";
				} else {
					$rSqlRela['lista_data'] = "".ajustaDataReturn($rSqlRela['envio_de_ingresso_data'],"d/m/Y")."";
				}
			} else {
				$rSqlRela['lista_data'] = "".ajustaDataReturn($rSqlRela['envio_de_cortesia_data'],"d/m/Y")."";
			}

			if(trim($rSqlRela['pessoa_data_de_nascimento'])=="") { $rSqlRela['pessoa_data_de_nascimento'] = ""; } else { $rSqlRela['pessoa_data_de_nascimento'] = "".ajustaDataSemHoraReturn($rSqlRela['pessoa_data_de_nascimento'],"d/m/Y").""; }
			if(trim($rSqlRela['lote_data_de_validade'])=="") { $rSqlRela['lote_data_de_validade'] = ""; } else { $rSqlRela['lote_data_de_validade'] = "".ajustaDataSemHoraReturn($rSqlRela['lote_data_de_validade'],"d/m/Y").""; }
			if(trim($rSqlRela['data_de_nascimento'])=="") { $rSqlRela['data_de_nascimento'] = ""; } else { $rSqlRela['data_de_nascimento'] = "".ajustaDataSemHoraReturn($rSqlRela['data_de_nascimento'],"d/m/Y").""; }
			if(trim($rSqlRela['data_de_publicacao'])=="") { $rSqlRela['data_de_publicacao'] = ""; } else { $rSqlRela['data_de_publicacao'] = "".ajustaDataSemHoraReturn($rSqlRela['data_de_publicacao'],"d/m/Y").""; }
			if(trim($rSqlRela['data_de_despublicacao'])=="") { $rSqlRela['data_de_despublicacao'] = ""; } else { $rSqlRela['data_de_despublicacao'] = "".ajustaDataSemHoraReturn($rSqlRela['data_de_despublicacao'],"d/m/Y").""; }
			if(trim($rSqlRela['ingresso_data'])=="") { $rSqlRela['ingresso_data'] = ""; } else { $rSqlRela['ingresso_data'] = "".ajustaDataSemHoraReturn($rSqlRela['ingresso_data'],"d/m/Y").""; }
			if(trim($rSqlRela['data_do_evento'])=="") { $rSqlRela['data_do_evento'] = ""; } else { $rSqlRela['data_do_evento'] = "".ajustaDataSemHoraReturn($rSqlRela['data_do_evento'],"d/m/Y").""; }
			if(trim($rSqlRela['data_do_ticket'])=="") { $rSqlRela['data_do_ticket'] = ""; } else { $rSqlRela['data_do_ticket'] = "".ajustaDataSemHoraReturn($rSqlRela['data_do_ticket'],"d/m/Y").""; }
			if(trim($rSqlRela['dataConfirmado'])=="") { $rSqlRela['dataConfirmado'] = ""; } else { $rSqlRela['dataConfirmado'] = "".ajustaDataReturn($rSqlRela['dataConfirmado'],"d/m/Y").""; }
			if(trim($rSqlRela['dataAplicacao'])=="") { $rSqlRela['dataAplicacao'] = ""; } else { $rSqlRela['dataAplicacao'] = "".ajustaDataReturn($rSqlRela['dataAplicacao'],"d/m/Y").""; }
			if(trim($rSqlRela['dataCadastro'])=="") { $rSqlRela['dataCadastro'] = ""; } else { $rSqlRela['dataCadastro'] = "".ajustaDataReturn($rSqlRela['dataCadastro'],"d/m/Y").""; }
			if(trim($rSqlRela['dataPago'])=="") { $rSqlRela['dataPago'] = ""; } else { $rSqlRela['dataPago'] = "".ajustaDataSemHoraReturn($rSqlRela['dataPago'],"d/m/Y").""; }
			if(trim($rSqlRela['data_hora'])=="") { $rSqlRela['data_hora'] = ""; } else { $rSqlRela['data_hora'] = "".ajustaDataReturn($rSqlRela['data_hora'],"d/m/Y").""; }
			if(trim($rSqlRela['data'])=="") { $rSqlRela['data'] = ""; } else { $rSqlRela['data'] = "".ajustaDataSemHoraReturn($rSqlRela['data'],"d/m/Y").""; }
			if(trim($rSqlRela['hora'])=="") { $rSqlRela['hora'] = ""; } else { $rSqlRela['hora'] = "".ajustaDataSemDataReturn($rSqlRela['hora'],"d/m/Y").""; }
			if(trim($rSqlRela['dataModificacao'])=="") { $rSqlRela['dataModificacao'] = ""; } else { $rSqlRela['dataModificacao'] = "".ajustaDataReturn($rSqlRela['dataModificacao'],"d/m/Y").""; }
			if(trim($rSqlRela['dataModificacao_data'])=="") { $rSqlRela['dataModificacao_data'] = ""; } else { $rSqlRela['dataModificacao_data'] = "".ajustaDataSemHoraReturn($rSqlRela['dataModificacao_data'],"d/m/Y").""; }
			if(trim($rSqlRela['dataModificacao_hora'])=="") { $rSqlRela['dataModificacao_hora'] = ""; } else { $rSqlRela['dataModificacao_hora'] = "".ajustaDataSemDataReturn($rSqlRela['dataModificacao_hora'],"d/m/Y").""; }
			if(trim($rSqlRela['dataBaixa'])=="") { $rSqlRela['dataBaixa'] = "<i>Ainda não foi baixado</i>"; } else { $rSqlRela['dataBaixa'] = "".ajustaDataSemHoraReturn($rSqlRela['dataBaixa'],"d/m/Y").""; }
			if(trim($rSqlRela['valor'])=="") { $rSqlRela['valor'] = ""; } else { $rSqlRela['valor'] = "".number_format($rSqlRela['valor'], 2, ',', '.').""; }
			if(trim($rSqlRela['valor_medio'])=="") { $rSqlRela['valor_medio'] = ""; } else { $rSqlRela['valor_medio'] = "".number_format($valorMedioSet, 2, ',', '.').""; }
			if(trim($rSqlRela['valor_promocional'])=="") { $rSqlRela['valor_promocional'] = ""; } else { $rSqlRela['valor_promocional'] = "".number_format($rSqlRela['valor_promocional'], 2, ',', '.').""; }
			if(trim($rSqlRela['valor_desconto'])=="") { $rSqlRela['valor_desconto'] = ""; } else { $rSqlRela['valor_desconto'] = "".number_format($rSqlRela['valor_desconto'], 2, ',', '.').""; }
			if(trim($rSqlRela['valor_total_taxas'])=="") { $rSqlRela['valor_total_taxas'] = ""; } else { $rSqlRela['valor_total_taxas'] = "".number_format($rSqlRela['valor_total_taxas'], 2, ',', '.').""; }
			if(trim($rSqlRela['valor_troco'])=="") { $rSqlRela['valor_troco'] = ""; } else { $rSqlRela['valor_troco'] = "".number_format($rSqlRela['valor_troco'], 2, ',', '.').""; }

			if(trim($rSqlRela['valor_subtotal'])=="") { $rSqlRela['valor_subtotal'] = ""; } else { $rSqlRela['valor_subtotal'] = "".number_format($rSqlRela['valor_subtotal'], 2, ',', '.').""; }
			if(trim($rSqlRela['valor_total'])=="") { $rSqlRela['valor_total'] = ""; } else { $rSqlRela['valor_total'] = "".number_format($rSqlRela['valor_total'], 2, ',', '.').""; }
			if(trim($rSqlRela['valor_lucro'])=="") { $rSqlRela['valor_lucro'] = ""; } else { $rSqlRela['valor_lucro'] = "".number_format($rSqlRela['valor_lucro'], 2, ',', '.').""; }

			if(trim($rSqlRela['unidades_de_saude_nome'])=="") { $rSqlRela['unidades_de_saude_nome'] = "<i>Não informado</i>"; } else { $rSqlRela['unidades_de_saude_nome'] = "".$rSqlRela['unidades_de_saude_nome'].""; }
			if(trim($rSqlRela['imunobiologico_nome'])=="") { $rSqlRela['imunobiologico_nome'] = "<i>Não informado</i>"; } else { $rSqlRela['imunobiologico_nome'] = "".$rSqlRela['imunobiologico_nome'].""; }
			if(trim($rSqlRela['estrategia_nome'])=="") { $rSqlRela['estrategia_nome'] = "<i>Não informado</i>"; } else { $rSqlRela['estrategia_nome'] = "".$rSqlRela['estrategia_nome'].""; }
			if(trim($rSqlRela['vacina_nome'])=="") { $rSqlRela['vacina_nome'] = "<i>Não informado</i>"; } else { $rSqlRela['vacina_nome'] = "".$rSqlRela['vacina_nome'].""; }
			if(trim($rSqlRela['vacinas_nome'])=="") { $rSqlRela['vacinas_nome'] = "<i>Não informado</i>"; } else { $rSqlRela['vacinas_nome'] = "".$rSqlRela['vacinas_nome'].""; }
			if(trim($rSqlRela['imunobiologicos_nome'])=="") { $rSqlRela['imunobiologicos_nome'] = "<i>Não informado</i>"; } else { $rSqlRela['imunobiologicos_nome'] = "".$rSqlRela['imunobiologicos_nome'].""; }
			if(trim($rSqlRela['estrategias_nome'])=="") { $rSqlRela['estrategias_nome'] = "<i>Não informado</i>"; } else { $rSqlRela['estrategias_nome'] = "".$rSqlRela['estrategias_nome'].""; }
			if(trim($rSqlRela['lotes_nome'])=="") { $rSqlRela['lotes_nome'] = "<i>Não informado</i>"; } else { $rSqlRela['lotes_nome'] = "".$rSqlRela['lotes_nome'].""; }

if($tipoExport=="csv" || $tipoExport=="excel") { 
	$relatorio_html .= "<tr>";
} else {
	$relatorio_html .= "<tr style=\"background-color:".$corSet."\">";
}
$relatorio_html .= "<td>".$rSqlRela['id']."</td>";
			$campos_cabecalhoArray = unserialize($row['campos_cabecalho']);
			$campos_cabecalhoArray = array_sort($campos_cabecalhoArray, 'ordem', SORT_ASC);
			foreach ($campos_cabecalhoArray as $key => $value) {
$relatorio_html .= "<td>".$rSqlRela[''.$value['campo'].'']."</td>";
			}
$relatorio_html .= "</tr>";
		}

$relatorio_html .= "</tbody>";
$relatorio_html .= "</table>";

if(trim($tipoExport)=="" || trim($tipoExport)=="pdf") { 
	echo $relatorio_html;
}
