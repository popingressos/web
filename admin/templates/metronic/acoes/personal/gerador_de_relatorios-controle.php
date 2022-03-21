                                                    	<?
														$CamposJoinSet = "";
														$LeftJoinSet = "";
														
														#echo "".$row['local_filtro']." <br>";
														
														if(trim($row['local_filtro'])=="carrinho_notificacao_evento" || 
														   trim($row['local_filtro'])=="carrinho_notificacao_comissario" ||
														   trim($row['local_filtro'])=="carrinho_notificacao_pdv") {
															$modRela = "carrinho_notificacao";

															if(trim($row['local_filtro'])=="carrinho_notificacao_comissario") {
																$CamposJoinSet .= "mod_".$modRela.".numeroUnico_comissario AS numeroUnico_comissario,";
															}
															
															if(trim($row['local_filtro'])=="carrinho_notificacao_evento") {
																if(strrpos($row['campos_cabecalho'],"|numeroUnico_cupom|") === false) { } else {
																	$CamposJoinSet .= "mod_".$modRela.".numeroUnico_cupom AS numeroUnico_cupom,";
	
																	$CamposJoinSet .= "mod_cupom_de_desconto.nome AS cupom_de_desconto_nome,";
																	$LeftJoinSet .= "
																		LEFT JOIN 
																			cupom_de_desconto AS mod_cupom_de_desconto ON (mod_cupom_de_desconto.numeroUnico = mod_".$modRela.".numeroUnico_cupom)
																	";
																}
															}
															
															if(trim($row['local_filtro'])=="carrinho_notificacao_pdv") {
																$CamposJoinSet .= "mod_".$modRela.".numeroUnico_pdv AS numeroUnico_pdv,";
															}
															
															$row['numeroUnico_itens'] = str_replace("||","','",$row['numeroUnico_itens']);
															$row['numeroUnico_itens'] = str_replace("|","'",$row['numeroUnico_itens']);
															if(trim($row['numeroUnico_itens'])=="") {
																$filtroModuloTipoSet = " ";
															} else {
																$filtroModuloTipoSet = " AND mod_".$modRela.".numeroUnico_evento IN (".$row['numeroUnico_itens'].")";
															}
															
															if(strrpos($row['campos_cabecalho'],"|nome|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".nome AS nome,";
															}

															$CamposJoinSet .= "mod_".$modRela.".device AS device,";
															if(strrpos($row['campos_cabecalho'],"|device|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".device AS device,";
															}
															if(strrpos($row['campos_cabecalho'],"|pessoa_nome|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pessoa_nome AS pessoa_nome,";
															}
															if(strrpos($row['campos_cabecalho'],"|pessoa_email|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pessoa_email AS pessoa_email,";
															}
															if(strrpos($row['campos_cabecalho'],"|pessoa_telefone|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pessoa_telefone AS pessoa_telefone,";
															}
															if(strrpos($row['campos_cabecalho'],"|pessoa_documento|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pessoa_documento AS pessoa_documento,";
															}
															if(strrpos($row['campos_cabecalho'],"|pessoa_idade|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pessoa_idade AS pessoa_idade,";
															}
															if(strrpos($row['campos_cabecalho'],"|pessoa_data_de_nascimento|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pessoa_data_de_nascimento AS pessoa_data_de_nascimento,";
															}
															if(strrpos($row['campos_cabecalho'],"|pessoa_genero|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pessoa_genero AS pessoa_genero,";
															}
															if(strrpos($row['campos_cabecalho'],"|evento_nome|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".evento_nome AS evento_nome,";
															}
															if(strrpos($row['campos_cabecalho'],"|ingresso_nome|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".ingresso_nome AS ingresso_nome,";
															}
															if(strrpos($row['campos_cabecalho'],"|ingresso_data|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".ingresso_data AS ingresso_data,";
															}
															if(strrpos($row['campos_cabecalho'],"|data_do_evento|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".data_do_evento AS data_do_evento,";
															}
															if(strrpos($row['campos_cabecalho'],"|qtd_parcelas|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".qtd_parcelas AS qtd_parcelas,";
															}
															if(strrpos($row['campos_cabecalho'],"|valor|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".valor AS valor,";
															}
															if(strrpos($row['campos_cabecalho'],"|valor_subtotal|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".valor_subtotal AS valor_subtotal,";
															}
															if(strrpos($row['campos_cabecalho'],"|valor_lucro|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".valor_total AS valor_total,";
																$CamposJoinSet .= "mod_".$modRela.".valor_subtotal AS valor_subtotal,";
															}
															if(strrpos($row['campos_cabecalho'],"|valor_total|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".valor_total AS valor_total,";
																$CamposJoinSet .= "mod_".$modRela.".qtd_parcelas AS qtd_parcelas,";
																$CamposJoinSet .= "mod_".$modRela.".fator_parcelamento AS fator_parcelamento,";
															}
															if(strrpos($row['campos_cabecalho'],"|lote_nome|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".lote_nome AS lote_nome,";
																$CamposJoinSet .= "mod_".$modRela.".forma_de_pagamento AS forma_de_pagamento,";
															}
															if(strrpos($row['campos_cabecalho'],"|pago|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pago AS pago,";
															}
															if(strrpos($row['campos_cabecalho'],"|data_hora|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".data AS data_hora,";
															}
															if(strrpos($row['campos_cabecalho'],"|data|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".data AS data,";
															}
															if(strrpos($row['campos_cabecalho'],"|hora|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".data AS hora,";
															}
															if(strrpos($row['campos_cabecalho'],"|dataModificacao|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".dataModificacao AS dataModificacao,";
															}
															if(strrpos($row['campos_cabecalho'],"|dataModificacao_data|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".dataModificacao AS dataModificacao_data,";
															}
															if(strrpos($row['campos_cabecalho'],"|dataModificacao_hora|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".dataModificacao AS dataModificacao_hora,";
															}
															if(strrpos($row['campos_cabecalho'],"|confirmado|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".confirmado AS confirmado,";
															}
															if(strrpos($row['campos_cabecalho'],"|dataConfirmado|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".dataConfirmado AS dataConfirmado,";
															}
															if(strrpos($row['campos_cabecalho'],"|stat|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".stat AS stat,";
															}

															$CamposJoinSet .= "mod_".$modRela.".forma_de_pagamento AS forma_de_pagamento,";
															if(strrpos($row['campos_cabecalho'],"|forma_de_pagamento|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".forma_de_pagamento AS forma_de_pagamento,";
															}

															if(trim($row['local_filtro'])=="carrinho_notificacao_comissario") {
																if(strrpos($row['campos_cabecalho'],"|sysusu_nome|") === false) { } else {
																	$CamposJoinSet .= "mod_sysusu.nome AS sysusu_nome,";
																	$LeftJoinSet .= "
																		LEFT JOIN 
																			sysusu AS mod_sysusu ON (mod_sysusu.numeroUnico = mod_".$modRela.".numeroUnico_comissario)
																	";
																}
																if(strrpos($row['campos_cabecalho'],"|lista_nome|") === false) { } else {
																	$CamposJoinSet .= "mod_envio_de_cortesia.nome AS envio_de_cortesia_nome,";
																	$CamposJoinSet .= "mod_envio_de_cortesia.data AS envio_de_cortesia_data,";
																	$LeftJoinSet .= "
																		LEFT JOIN 
																			envio_de_cortesia AS mod_envio_de_cortesia ON (mod_envio_de_cortesia.numeroUnico = mod_".$modRela.".numeroUnico_envio_de_cortesia)
																	";
																	$CamposJoinSet .= "mod_envio_de_ingresso.nome AS envio_de_ingresso_nome,";
																	$CamposJoinSet .= "mod_envio_de_ingresso.data AS envio_de_ingresso_data,";
																	$LeftJoinSet .= "
																		LEFT JOIN 
																			envio_de_ingresso AS mod_envio_de_ingresso ON (mod_envio_de_ingresso.numeroUnico = mod_".$modRela.".numeroUnico_envio_de_ingresso)
																	";
																}
															}
															
															if(trim($row['local_filtro'])=="carrinho_notificacao_pdv") {
																if(strrpos($row['campos_cabecalho'],"|sysusu_nome|") === false) { } else {
																	$CamposJoinSet .= "mod_sysusu.nome AS sysusu_nome,";
																	$LeftJoinSet .= "
																		LEFT JOIN 
																			sysusu AS mod_sysusu ON (mod_sysusu.numeroUnico = mod_".$modRela.".numeroUnico_comissario)
																	";
																}
															}
															
														} else if(trim($row['local_filtro'])=="carrinho_notificacao") {
															if(trim($row['modulo_tipo'])=="eventos_notificacao") {
																$modRela = "carrinho_notificacao";
																$campoWhere = "numeroUnico_evento";
															
															} else if(trim($row['modulo_tipo'])=="imunobiologicos") {
																$modRela = "carrinho_notificacao";
																$campoWhere = "numeroUnico_imunobiologico";
															
															} else if(trim($row['modulo_tipo'])=="vacinas") {
																$modRela = "carrinho_notificacao";
																$campoWhere = "numeroUnico_vacinas";
															
															} else if(trim($row['modulo_tipo'])=="unidades_de_saude") {
																$modRela = "carrinho_notificacao";
																$campoWhere = "numeroUnico_unidades_de_saude";
															
															} else if(trim($row['modulo_tipo'])=="estrategias") {
																$modRela = "carrinho_notificacao";
																$campoWhere = "numeroUnico_estrategia";
															
															} else if(trim($row['modulo_tipo'])=="lotes") {
																$modRela = "carrinho_notificacao";
																$campoWhere = "numeroUnico_lote";
															
															} else if(trim($row['modulo_tipo'])=="doses") {
																$modRela = "carrinho_notificacao";
																$campoWhere = "numero_dose";
															}

															$row['numeroUnico_itens'] = str_replace("||","','",$row['numeroUnico_itens']);
															$row['numeroUnico_itens'] = str_replace("|","'",$row['numeroUnico_itens']);
															if(trim($row['numeroUnico_itens'])=="") {
																$filtroModuloTipoSet = " ";
															} else {
																$filtroModuloTipoSet = " AND mod_".$modRela.".".$campoWhere." IN (".$row['numeroUnico_itens'].")";
															}
															
															#carrinho_notificacao
															$pessoaN = 0;
															if(strrpos($row['campos_cabecalho'],"|pessoa_nome|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_email|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_whatsapp|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_documento|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_idade|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_data_de_nascimento|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_genero|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_profissional_da_saude|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_encontrase_acamado|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_contraiu_doenca|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_doenca_outros|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_gestante|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_puerpera|") === false) { } else { $pessoaN++; }
	
															if($pessoaN>0) {
																$CamposJoinSet .= "mod_pessoa.nome AS pessoa_nome,";
																$CamposJoinSet .= "mod_pessoa.email AS pessoa_email,";
																$CamposJoinSet .= "mod_pessoa.whatsapp AS pessoa_whatsapp,";
																$CamposJoinSet .= "mod_pessoa.documento AS pessoa_documento,";
																$CamposJoinSet .= "YEAR(CURRENT_DATE) - YEAR(mod_pessoa.data_de_nascimento) - 
																				   (DATE_FORMAT(CURRENT_DATE, '%m%d') < DATE_FORMAT(mod_pessoa.data_de_nascimento, '%m%d')) AS pessoa_idade,";
																$CamposJoinSet .= "YEAR(CURRENT_DATE) - YEAR(mod_".$modRela.".pessoa_data_de_nascimento) - 
																				   (DATE_FORMAT(CURRENT_DATE, '%m%d') < DATE_FORMAT(mod_".$modRela.".pessoa_data_de_nascimento, '%m%d')) AS pessoa_data_de_nascimento,";
																$CamposJoinSet .= "mod_pessoa.data_de_nascimento AS pessoa_data_de_nascimento,";
																$CamposJoinSet .= "mod_pessoa.genero AS pessoa_genero,";
																$CamposJoinSet .= "mod_pessoa.gestante AS pessoa_gestante,";
																$CamposJoinSet .= "mod_pessoa.puerpera AS pessoa_puerpera,";
																$CamposJoinSet .= "mod_pessoa.profissional_da_saude AS pessoa_profissional_da_saude,";
																$CamposJoinSet .= "mod_pessoa.encontrase_acamado AS pessoa_encontrase_acamado,";
																$CamposJoinSet .= "mod_pessoa.contraiu_doenca AS pessoa_contraiu_doenca,";
																$CamposJoinSet .= "mod_pessoa.doenca_outros AS pessoa_doenca_outros,";
																$CamposJoinSet .= "mod_pessoa.numeroUnico_vacinas AS pessoa_numeroUnico_vacinas,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		pessoas AS mod_pessoa ON (mod_pessoa.numeroUnico = mod_".$modRela.".numeroUnico_pessoa)
																";
															}
	
															if(strrpos($row['campos_cabecalho'],"|confirmado|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".confirmado AS confirmado,";
															}
															if(strrpos($row['campos_cabecalho'],"|dataConfirmado|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".dataConfirmado AS dataConfirmado,";
															}
	
															$eventoN = 0;
															if(strrpos($row['campos_cabecalho'],"|evento_nome|") === false) { } else { $eventoN++; }
															if(strrpos($row['campos_cabecalho'],"|data_do_evento|") === false) { } else { $eventoN++; }
															if($eventoN>0) {
																$CamposJoinSet .= "mod_eventos.nome AS evento_nome,";
																$CamposJoinSet .= "mod_eventos.data_do_evento AS data_do_evento,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		eventos AS mod_eventos ON (mod_eventos.numeroUnico = mod_".$modRela.".numeroUnico_evento)
																";
															}
															
															if(strrpos($row['campos_cabecalho'],"|unidades_de_saude_nome|") === false) { } else { $unidades_de_saudeN++; }
															if(strrpos($row['campos_cabecalho'],"|unidades_de_saude_id_esus|") === false) { } else { $unidades_de_saudeN++; }
															if($unidades_de_saudeN>0) {
																$CamposJoinSet .= "mod_unidades_de_saude.nome AS unidades_de_saude_nome,";
																$CamposJoinSet .= "mod_unidades_de_saude.id_esus AS unidades_de_saude_id_esus,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		unidades_de_saude AS mod_unidades_de_saude ON (mod_unidades_de_saude.numeroUnico = mod_".$modRela.".numeroUnico_unidades_de_saude)
																";
															}

															if(strrpos($row['campos_cabecalho'],"|imunobiologico_id_esus|") === false) { } else { $imunobiologicoN++; }
															if(strrpos($row['campos_cabecalho'],"|imunobiologico_nome|") === false) { } else { $imunobiologicoN++; }
															if(strrpos($row['campos_cabecalho'],"|imunobiologico_sigla|") === false) { } else { $imunobiologicoN++; }
															if(strrpos($row['campos_cabecalho'],"|imunobiologico_filtro|") === false) { } else { $imunobiologicoN++; }
															if(strrpos($row['campos_cabecalho'],"|imunobiologico_classe|") === false) { } else { $imunobiologicoN++; }
															if($imunobiologicoN>0) {
																$CamposJoinSet .= "mod_imunobiologico.id_esus AS imunobiologico_id_esus,";
																$CamposJoinSet .= "mod_imunobiologico.nome AS imunobiologico_nome,";
																$CamposJoinSet .= "mod_imunobiologico.sigla AS imunobiologico_sigla,";
																$CamposJoinSet .= "mod_imunobiologico.filtro AS imunobiologico_filtro,";
																$CamposJoinSet .= "mod_imunobiologico.classe AS imunobiologico_classe,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		imunobiologicos AS mod_imunobiologico ON (mod_imunobiologico.numeroUnico = mod_".$modRela.".numeroUnico_imunobiologico)
																";
															}
															
															if(strrpos($row['campos_cabecalho'],"|estrategia_nome|") === false) { } else {
																$CamposJoinSet .= "mod_estrategia.nome AS estrategia_nome,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		estrategias AS mod_estrategia ON (mod_estrategia.numeroUnico = mod_".$modRela.".numeroUnico_estrategia)
																";
															}
	
															if(strrpos($row['campos_cabecalho'],"|vacina_nome|") === false) { } else {
																$CamposJoinSet .= "mod_vacina.nome AS vacina_nome,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		vacinas AS mod_vacina ON (mod_vacina.numeroUnico = mod_".$modRela.".numeroUnico_vacinas)
																";
															}
	
															if(strrpos($row['campos_cabecalho'],"|doses_id_esus|") === false) { } else { $dosesN++; }
															if(strrpos($row['campos_cabecalho'],"|doses_nome|") === false) { } else { $dosesN++; }
															if($dosesN>0) {
																$CamposJoinSet .= "mod_doses.id_esus AS doses_id_esus,";
																$CamposJoinSet .= "mod_doses.nome AS doses_nome,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		doses AS mod_doses ON (mod_doses.numeroUnico = mod_".$modRela.".numeroUnico_doses)
																";
															}
	
															if(strrpos($row['campos_cabecalho'],"|lote_nome|") === false) { } else { $lotesN++; }
															if(strrpos($row['campos_cabecalho'],"|lote_data_de_validade|") === false) { } else { $lotesN++; }
															if($lotesN>0) {
																$CamposJoinSet .= "mod_lote.nome AS lote_nome,";
																$CamposJoinSet .= "mod_lote.data_de_validade AS lote_data_de_validade,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		lotes AS mod_lote ON (mod_lote.numeroUnico = mod_".$modRela.".numeroUnico_lote)
																";
															}

															if(strrpos($row['campos_cabecalho'],"|vacinador_nome|") === false) { } else { $vacinadorN++; }
															if(strrpos($row['campos_cabecalho'],"|vacinador_cns|") === false) { } else { $vacinadorN++; }
															if($vacinadorN>0) {
																$CamposJoinSet .= "mod_vacinador.nome AS vacinador_nome,";
																$CamposJoinSet .= "mod_vacinador.cns AS vacinador_cns,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		vacinador AS mod_vacinador ON (mod_vacinador.numeroUnico = mod_".$modRela.".numeroUnico_vacinador)
																";
															}

															if(strrpos($row['campos_cabecalho'],"|categorias_de_pessoas_nome|") === false) { } else { $categorias_de_pessoasN++; }
															if(strrpos($row['campos_cabecalho'],"|categorias_de_pessoas_id_esus|") === false) { } else { $categorias_de_pessoasN++; }
															if($categorias_de_pessoasN>0) {
																$CamposJoinSet .= "mod_categorias_de_pessoas.nome AS categorias_de_pessoas_nome,";
																$CamposJoinSet .= "mod_categorias_de_pessoas.id_esus AS categorias_de_pessoas_id_esus,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		categorias_de_pessoas AS mod_categorias_de_pessoas ON (mod_categorias_de_pessoas.numeroUnico = mod_pessoa.categorias_de_pessoas)
																";
															}
															
															if(strrpos($row['campos_cabecalho'],"|numero_dose|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".numero_dose AS numero_dose,";
															}

															if(strrpos($row['campos_cabecalho'],"|dataAplicacao|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".dataConfirmado AS dataAplicacao,";
															}

															if(strrpos($row['campos_cabecalho'],"|dataCadastro|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".dataConfirmado AS dataCadastro,";
															}
	
															if(strrpos($row['campos_cabecalho'],"|vacinas_nome|") === false) { } else {
																$CamposJoinSet .= "mod_vacinas.nome AS vacinas_nome,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		vacinas AS mod_vacinas ON (mod_vacinas.numeroUnico = mod_pessoa.numeroUnico_vacinas)
																";
															}

														} else if(trim($row['local_filtro'])=="cadastros") {
															if(trim($row['modulo_tipo'])=="pessoas") {
																$modRela = "pessoas";

																$CamposJoinSet .= "mod_".$modRela.".nome AS nome,";
																$CamposJoinSet .= "mod_".$modRela.".nome_da_mae AS nome_da_mae,";
																$CamposJoinSet .= "mod_".$modRela.".nome_do_pai AS nome_do_pai,";
																$CamposJoinSet .= "mod_".$modRela.".email AS email,";
																$CamposJoinSet .= "mod_".$modRela.".whatsapp AS whatsapp,";
																$CamposJoinSet .= "mod_".$modRela.".documento AS documento,";
																$CamposJoinSet .= "mod_".$modRela.".cns AS cns,";
																$CamposJoinSet .= "mod_".$modRela.".data_de_nascimento AS idade,";
																$CamposJoinSet .= "mod_".$modRela.".data_de_nascimento AS data_de_nascimento,";
																$CamposJoinSet .= "mod_".$modRela.".genero AS genero,";
																$CamposJoinSet .= "mod_".$modRela.".gestante AS gestante,";
																$CamposJoinSet .= "mod_".$modRela.".puerpera AS puerpera,";
																$CamposJoinSet .= "mod_".$modRela.".profissional_da_saude AS profissional_da_saude,";
																$CamposJoinSet .= "mod_".$modRela.".encontrase_acamado AS encontrase_acamado,";
																$CamposJoinSet .= "mod_".$modRela.".contraiu_doenca AS contraiu_doenca,";
																$CamposJoinSet .= "mod_".$modRela.".doenca_outros AS doenca_outros,";
																$CamposJoinSet .= "mod_".$modRela.".numeroUnico_vacinas AS numeroUnico_vacinas,";
																$CamposJoinSet .= "mod_".$modRela.".cep AS cep,";
																$CamposJoinSet .= "mod_".$modRela.".rua AS rua,";
																$CamposJoinSet .= "mod_".$modRela.".numero AS numero,";
																$CamposJoinSet .= "mod_".$modRela.".complemento AS complemento,";
															}

															if(strrpos($row['campos_cabecalho'],"|etnias_nome|") === false) { } else {
																$CamposJoinSet .= "mod_etnias.nome AS etnias_nome,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		etnias AS mod_etnias ON (mod_etnias.numeroUnico = mod_".$modRela.".numeroUnico_etnias)
																";
															}
															
															if(strrpos($row['campos_cabecalho'],"|categorias_de_pessoas_nome|") === false) { } else { $categorias_de_pessoasN++; }
															if(strrpos($row['campos_cabecalho'],"|categorias_de_pessoas_id_esus|") === false) { } else { $categorias_de_pessoasN++; }
															if($categorias_de_pessoasN>0) {
																$CamposJoinSet .= "mod_categorias_de_pessoas.nome AS categorias_de_pessoas_nome,";
																$CamposJoinSet .= "mod_categorias_de_pessoas.id_esus AS categorias_de_pessoas_id_esus,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		categorias_de_pessoas AS mod_categorias_de_pessoas ON (mod_categorias_de_pessoas.numeroUnico = mod_".$modRela.".categorias_de_pessoas)
																";
															}
															
															if(strrpos($row['campos_cabecalho'],"|atividades_nome|") === false) { } else {
																$CamposJoinSet .= "mod_atividades.nome AS atividades_nome,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		atividades AS mod_atividades ON (mod_atividades.numeroUnico = mod_".$modRela.".numeroUnico_atividades)
																";
															}
															
															if(strrpos($row['campos_cabecalho'],"|tipos_sanguineos_nome|") === false) { } else {
																$CamposJoinSet .= "mod_tipos_sanguineos.slug AS tipos_sanguineos_nome,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		tipos_sanguineos AS mod_tipos_sanguineos ON (mod_tipos_sanguineos.numeroUnico = mod_".$modRela.".numeroUnico_tipos_sanguineos)
																";
															}
															
															if(strrpos($row['campos_cabecalho'],"|tipos_de_logradouro_nome|") === false) { } else {
																$CamposJoinSet .= "mod_tipos_de_logradouro.nome AS tipos_de_logradouro_nome,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		tipos_de_logradouro AS mod_tipos_de_logradouro ON (mod_tipos_de_logradouro.numeroUnico = mod_".$modRela.".numeroUnico_tipos_de_logradouro)
																";
															}
															
															if(strrpos($row['campos_cabecalho'],"|bairro|") === false) { } else {
																$CamposJoinSet .= "mod_bairro.bairro AS bairro,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		cepbr_bairro AS mod_bairro ON (mod_bairro.id_bairro = mod_".$modRela.".bairro_id)
																";
															}
															
															if(strrpos($row['campos_cabecalho'],"|cidade|") === false) { } else {
																$CamposJoinSet .= "mod_cidade.cidade AS cidade,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		cepbr_cidade AS mod_cidade ON (mod_cidade.id_cidade = mod_".$modRela.".cidade_id)
																";
															}
															
															if(strrpos($row['campos_cabecalho'],"|estado|") === false) { } else {
																$CamposJoinSet .= "mod_estado.estado AS estado,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		cepbr_estado AS mod_estado ON (mod_estado.uf = mod_".$modRela.".estado)
																";
															}
															

														} else if(trim($row['local_filtro'])=="estoque") {
															if(trim($row['modulo_tipo'])=="produtos") {
																$modRela = "produtos";
															
															} else if(trim($row['modulo_tipo'])=="eventos") {
																$modRela = "eventos";
															
															} else if(trim($row['modulo_tipo'])=="tickets") {
																$modRela = "eventos_tickets";
															}

															#eventos
															if(strrpos($row['campos_cabecalho'],"|unidades_de_saude_nome|") === false) { } else {
																$CamposJoinSet .= "mod_unidades_de_saude.nome AS unidades_de_saude_nome,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		unidades_de_saude AS mod_unidades_de_saude ON (mod_unidades_de_saude.numeroUnico = mod_".$modRela.".numeroUnico_unidades_de_saude)
																";
															}
	
															if(strrpos($row['campos_cabecalho'],"|vacinas_nome|") === false) { } else {
																$CamposJoinSet .= "mod_vacinas.nome AS vacinas_nome,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		vacinas AS mod_vacinas ON (mod_vacinas.numeroUnico = mod_".$modRela.".numeroUnico_vacinas)
																";
															}
	
															if(strrpos($row['campos_cabecalho'],"|imunobiologicos_nome|") === false) { } else {
																$CamposJoinSet .= "mod_imunobiologicos.nome AS imunobiologicos_nome,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		imunobiologicos AS mod_imunobiologicos ON (mod_imunobiologicos.numeroUnico = mod_".$modRela.".numeroUnico_imunobiologicos)
																";
															}
	
															if(strrpos($row['campos_cabecalho'],"|estrategias_nome|") === false) { } else {
																$CamposJoinSet .= "mod_estrategias.nome AS estrategias_nome,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		estrategias AS mod_estrategias ON (mod_estrategias.numeroUnico = mod_".$modRela.".numeroUnico_estrategias)
																";
															}
	
															if(strrpos($row['campos_cabecalho'],"|numeroUnico_lotes|") === false) { } else {
																$CamposJoinSet .= "mod_lotes.nome AS lotes_nome,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		lotes AS mod_lotes ON (mod_lotes.numeroUnico = mod_".$modRela.".numeroUnico_lotes)
																";
															}
	
	
														} else if(trim($row['local_filtro'])=="carrinho_solicitacao") {
															$modRela = "carrinho";
															if(strrpos($row['campos_cabecalho'],"|boleto_linha_digitavel_pagamento|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".boleto_linha_digitavel_pagamento AS boleto_linha_digitavel_pagamento,";
															}
															if(strrpos($row['campos_cabecalho'],"|device|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".device AS device,";
															}
															if(strrpos($row['campos_cabecalho'],"|tid|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".tid AS tid,";
															}
															if(strrpos($row['campos_cabecalho'],"|pessoa_nome|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pessoa_nome AS pessoa_nome,";
															}
															if(strrpos($row['campos_cabecalho'],"|pessoa_email|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pessoa_email AS pessoa_email,";
															}
															if(strrpos($row['campos_cabecalho'],"|pessoa_telefone|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pessoa_telefone AS pessoa_telefone,";
															}
															if(strrpos($row['campos_cabecalho'],"|pessoa_documento|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pessoa_documento AS pessoa_documento,";
															}
															if(strrpos($row['campos_cabecalho'],"|pessoa_idade|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pessoa_idade AS pessoa_idade,";
															}
															if(strrpos($row['campos_cabecalho'],"|pessoa_data_de_nascimento|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pessoa_data_de_nascimento AS pessoa_data_de_nascimento,";
															}
															if(strrpos($row['campos_cabecalho'],"|pessoa_genero|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pessoa_genero AS pessoa_genero,";
															}
															if(strrpos($row['campos_cabecalho'],"|valor|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".valor AS valor,";
															}
															if(strrpos($row['campos_cabecalho'],"|qtd_parcelas|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".qtd_parcelas AS qtd_parcelas,";
															}
															if(strrpos($row['campos_cabecalho'],"|valor_subtotal|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".valor_subtotal AS valor_subtotal,";
															}
															if(strrpos($row['campos_cabecalho'],"|valor_total|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".valor_total AS valor_total,";
															}
															if(strrpos($row['campos_cabecalho'],"|pago|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pago AS pago,";
															}
															if(strrpos($row['campos_cabecalho'],"|data|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".data AS data,";
															}
															if(strrpos($row['campos_cabecalho'],"|dataModificacao|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".dataModificacao AS dataModificacao,";
															}
															if(strrpos($row['campos_cabecalho'],"|dataBaixa|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".dataBaixa AS dataBaixa,";
															}

														} else if(trim($row['local_filtro'])=="carrinho") {
															if(trim($row['modulo_tipo'])=="produtos") {
																$modRela = "carrinho";
															
															} else if(trim($row['modulo_tipo'])=="eventos") {
																$modRela = "carrinho";
															
															} else if(trim($row['modulo_tipo'])=="tickets") {
																$modRela = "carrinho";

															} else if(trim($row['modulo_tipo'])=="compras") {
																$modRela = "carrinho";
															}

															#carrinho
															$pessoaN = 0;
															if(strrpos($row['campos_cabecalho'],"|pessoa_nome|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_email|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_whatsapp|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_documento|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_data_de_nascimento|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_genero|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_gestante|") === false) { } else { $pessoaN++; }
															if(strrpos($row['campos_cabecalho'],"|pessoa_puerpera|") === false) { } else { $pessoaN++; }
	
															if($pessoaN>0) {
																$CamposJoinSet .= "mod_pessoa.nome AS pessoa_nome,";
																$CamposJoinSet .= "mod_pessoa.email AS pessoa_email,";
																$CamposJoinSet .= "mod_pessoa.whatsapp AS pessoa_whatsapp,";
																$CamposJoinSet .= "mod_pessoa.documento AS pessoa_documento,";
																$CamposJoinSet .= "mod_pessoa.data_de_nascimento AS pessoa_data_de_nascimento,";
																$CamposJoinSet .= "mod_pessoa.genero AS pessoa_genero,";
																$CamposJoinSet .= "mod_pessoa.gestante AS pessoa_gestante,";
																$CamposJoinSet .= "mod_pessoa.puerpera AS pessoa_puerpera,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		pessoas AS mod_pessoa ON (mod_pessoa.numeroUnico = mod_".$modRela.".numeroUnico_comprador)
																";
															}
	
															if(strrpos($row['campos_cabecalho'],"|pago|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".pago AS pago,";
															}
															if(strrpos($row['campos_cabecalho'],"|dataPago|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".dataObjeto AS dataObjeto,";
															}
															if(strrpos($row['campos_cabecalho'],"|stat|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".stat AS stat,";
															}
															if(strrpos($row['campos_cabecalho'],"|data|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".data AS data,";
															}
															if(strrpos($row['campos_cabecalho'],"|dataModificacao|") === false) { } else {
																$CamposJoinSet .= "mod_".$modRela.".dataModificacao AS dataModificacao,";
															}
	
															$eventoN = 0;
															if(strrpos($row['campos_cabecalho'],"|evento_nome|") === false) { } else { $eventoN++; }
															if(strrpos($row['campos_cabecalho'],"|data_do_evento|") === false) { } else { $eventoN++; }
															if($eventoN>0) {
																$CamposJoinSet .= "mod_eventos.nome AS evento_nome,";
																$CamposJoinSet .= "mod_eventos.data_do_evento AS data_do_evento,";
																$LeftJoinSet .= "
																	LEFT JOIN 
																		eventos AS mod_eventos ON (mod_eventos.numeroUnico = mod_".$modRela.".numeroUnico_evento)
																";
															}

														} else if(trim($row['local_filtro'])=="contratos") {
															$modRela = "contratos";

														} else if(trim($row['local_filtro'])=="orcamentos") {
															$modRela = "orcamentos";

														} else if(trim($row['local_filtro'])=="assinaturas") {
															$modRela = "assinaturas";

														}

														if($sysusu['id']=="1") {
															#echo "<br>".$row['local_filtro']."<br>";
														}

														$filtroComissarioSet = "";
														if(trim($row['numeroUnico_comissario'])=="") { 
															$filtroComissarioSet = ""; 
														} else {
															$row['numeroUnico_comissario'] = str_replace("||","','",$row['numeroUnico_comissario']);
															$row['numeroUnico_comissario'] = str_replace("|","'",$row['numeroUnico_comissario']);

															if(trim($row['numeroUnico_comissario'])=="") {
																$filtroComissarioSet = ""; 
															} else {
																$filtroComissarioSet = " AND mod_".$modRela.".numeroUnico_comissario IN (".$row['numeroUnico_comissario'].")"; 
															}
														}

														$filtroPdvSet = "";
														if(trim($row['numeroUnico_pdv'])=="") { 
															$filtroPdvSet = ""; 
														} else {
															$row['numeroUnico_pdv'] = str_replace("||","','",$row['numeroUnico_pdv']);
															$row['numeroUnico_pdv'] = str_replace("|","'",$row['numeroUnico_pdv']);

															if(trim($row['numeroUnico_pdv'])=="") {
																$filtroPdvSet = ""; 
															} else {
																$filtroPdvSet = " AND mod_".$modRela.".numeroUnico_pdv IN (".$row['numeroUnico_pdv'].")"; 
															}
														}

														$filtroConfirmadoSet = "";
														if(strrpos($row['status_do_filtro'],"|confirmado_0|") === false) { 
															if(strrpos($row['status_do_filtro'],"|confirmado_1|") === false) {
																$filtroConfirmadoSet = ""; 
															} else {
																$filtroConfirmadoSet = " AND mod_".$modRela.".confirmado='1'"; 
															}
														} else {
															if(strrpos($row['status_do_filtro'],"|confirmado_1|") === false) {
																$filtroConfirmadoSet = " AND mod_".$modRela.".confirmado='0'"; 
															} else {
																$filtroConfirmadoSet = ""; 
															}
														}

														$filtroStatSet = ""; 
														if(strrpos($row['status_do_filtro'],"|stat_1|") === false) { 
															if(strrpos($row['status_do_filtro'],"|stat_3|") === false) {
																if(strrpos($row['status_do_filtro'],"|stat_7|") === false) {
																	$filtroStatSet = ""; 
																} else {
																	$filtroStatSet = " AND mod_".$modRela.".stat IN ('7')"; 
																}
															} else {
																if(strrpos($row['status_do_filtro'],"|stat_7|") === false) {
																	$filtroStatSet = " AND mod_".$modRela.".stat IN ('3')"; 
																} else {
																	$filtroStatSet = " AND mod_".$modRela.".stat IN ('3','7')"; 
																}
															}
														} else {
															if(strrpos($row['status_do_filtro'],"|stat_3|") === false) {
																if(strrpos($row['status_do_filtro'],"|stat_7|") === false) {
																	$filtroStatSet = " AND mod_".$modRela.".stat IN ('1')"; 
																} else {
																	$filtroStatSet = " AND mod_".$modRela.".stat IN ('1','7')"; 
																}
															} else {
																if(strrpos($row['status_do_filtro'],"|stat_7|") === false) {
																	$filtroStatSet = " AND mod_".$modRela.".stat IN ('1','3')"; 
																} else {
																	$filtroStatSet = " AND mod_".$modRela.".stat IN ('1','3','7')"; 
																}
															}
														}

														$filtroPagoSet = "";
														if(strrpos($row['status_do_filtro'],"|pago_0|") === false) { 
															if(strrpos($row['status_do_filtro'],"|pago_1|") === false) {
																$filtroPagoSet = ""; 
															} else {
																$filtroPagoSet = " AND mod_".$modRela.".pago='1'"; 
															}
														} else {
															if(strrpos($row['status_do_filtro'],"|pago_1|") === false) {
																$filtroPagoSet = " AND mod_".$modRela.".pago='0'"; 
															} else {
																$filtroPagoSet = ""; 
															}
														}

														if(trim($row['device'])=="") {
                                                            $filtro_deviceSet = "";
                                                        } else {
															$row['device'] = str_replace("||","','",$row['device']);
															$row['device'] = str_replace("|","'",$row['device']);
															if(trim($row['device'])=="") {
																$filtro_deviceSet = "";
															} else {
																$filtro_deviceSet = " AND mod_".$modRela.".device IN (".$row['device'].")"; 
															}
														}

														if(trim($row['numeroUnico_ticket'])=="") {
                                                            $filtro_numeroUnico_ticketSet = "";
                                                        } else {
															$row['numeroUnico_ticket'] = str_replace("||","','",$row['numeroUnico_ticket']);
															$row['numeroUnico_ticket'] = str_replace("|","'",$row['numeroUnico_ticket']);
															if(trim($row['numeroUnico_ticket'])=="") {
																$filtro_numeroUnico_ticketSet = "";
															} else {
																$filtro_numeroUnico_ticketSet = " AND mod_".$modRela.".numeroUnico_ticket IN (".$row['numeroUnico_ticket'].")"; 
															}
														}

														if(trim($row['numeroUnico_lote'])=="") {
                                                            $filtro_numeroUnico_loteSet = "";
                                                        } else {
															$row['numeroUnico_lote'] = str_replace("||","','",$row['numeroUnico_lote']);
															$row['numeroUnico_lote'] = str_replace("|","'",$row['numeroUnico_lote']);
															if(trim($row['numeroUnico_lote'])=="") {
																$filtro_numeroUnico_loteSet = "";
															} else {
																$filtro_numeroUnico_loteSet = " AND mod_".$modRela.".numeroUnico_lote IN (".$row['numeroUnico_lote'].")"; 
															}
														}

														if(trim($row['campo_intervalo'])=="" || trim($row['campo_intervalo'])=="data") {
                                                            $campo_intervaloSet = "data";
                                                        } else if(trim($row['campo_intervalo'])=="dataConfirmado") {
                                                            $campo_intervaloSet = "dataConfirmado";
                                                        } else if(trim($row['campo_intervalo'])=="dataBloqueado") {
                                                            $campo_intervaloSet = "dataBloqueado";
                                                        } else if(trim($row['campo_intervalo'])=="dataCancelado") {
                                                            $campo_intervaloSet = "data";
                                                        } else if(trim($row['campo_intervalo'])=="idade") {
                                                            $campo_intervaloSet = "data_de_nascimento";
														}

														if(trim($row['campo_ordem'])=="" || trim($row['campo_ordem'])=="data") {
                                                            $campo_ordemSet = "data";
                                                        } else if(trim($row['campo_ordem'])=="dataConfirmado") {
                                                            $campo_ordemSet = "dataConfirmado";
                                                        } else if(trim($row['campo_ordem'])=="dataBloqueado") {
                                                            $campo_ordemSet = "dataBloqueado";
                                                        } else if(trim($row['campo_ordem'])=="dataCancelado") {
                                                            $campo_ordemSet = "dataCancelado";
                                                        } else if(trim($row['campo_ordem'])=="idade") {
                                                            $campo_ordemSet = "data_de_nascimento";
                                                        } else if(trim($row['campo_ordem'])=="pessoa_nome") {
                                                            $campo_ordemSet = "pessoa_nome";
														}

														if(trim($row['periodizacao'])=="completo") {
                                                            $dataIniSet = "'0000-00-00 00:00:00'";
                                                            $dataFimSet = "'9999-12-31 23:59:59'";
                                                        } else if(trim($row['periodizacao'])=="0") {
                                                            $dataIniSet = "'".date('Y-m-d', strtotime('-0 days', strtotime(date("Y-m-d"))))." 00:00:00'";
                                                            $dataFimSet = "'9999-12-31 23:59:59'";
                                                        } else if(trim($row['periodizacao'])=="1") {
                                                            $dataIniSet = "'".date('Y-m-d', strtotime('-1 days', strtotime(date("Y-m-d"))))." 00:00:00'";
                                                            $dataFimSet = "'9999-12-31 23:59:59'";
                                                        } else if(trim($row['periodizacao'])=="2") {
                                                            $dataIniSet = "'".date('Y-m-d', strtotime('-2 days', strtotime(date("Y-m-d"))))." 00:00:00'";
                                                            $dataFimSet = "'9999-12-31 23:59:59'";
                                                        } else if(trim($row['periodizacao'])=="3") {
                                                            $dataIniSet = "'".date('Y-m-d', strtotime('-3 days', strtotime(date("Y-m-d"))))." 00:00:00'";
                                                            $dataFimSet = "'9999-12-31 23:59:59'";
                                                        } else if(trim($row['periodizacao'])=="4") {
                                                            $dataIniSet = "".date('Y-m-d', strtotime('-4 days', strtotime(date("Y-m-d"))))." 00:00:00'";
                                                            $dataFimSet = "9999-12-31 23:59:59'";
                                                        } else if(trim($row['periodizacao'])=="5") {
                                                            $dataIniSet = "'".date('Y-m-d', strtotime('-5 days', strtotime(date("Y-m-d"))))." 00:00:00'";
                                                            $dataFimSet = "'9999-12-31 23:59:59'";
                                                        } else if(trim($row['periodizacao'])=="6") {
                                                            $dataIniSet = "'".date('Y-m-d', strtotime('-6 days', strtotime(date("Y-m-d"))))." 00:00:00'";
                                                            $dataFimSet = "'9999-12-31 23:59:59'";
                                                        } else if(trim($row['periodizacao'])=="7") {
                                                            $dataIniSet = "'".date('Y-m-d', strtotime('-7 days', strtotime(date("Y-m-d"))))." 00:00:00'";
                                                            $dataFimSet = "'9999-12-31 23:59:59'";
                                                        } else if(trim($row['periodizacao'])=="15") {
                                                            $dataIniSet = "'".date('Y-m-d', strtotime('-15 days', strtotime(date("Y-m-d"))))." 00:00:00'";
                                                            $dataFimSet = "'9999-12-31 23:59:59'";
                                                        } else if(trim($row['periodizacao'])=="30") {
                                                            $dataIniSet = "'".date('Y-m-d', strtotime('-30 days', strtotime(date("Y-m-d"))))." 00:00:00'";
                                                            $dataFimSet = "'9999-12-31 23:59:59'";
                                                        } else if(trim($row['periodizacao'])=="60") {
                                                            $dataIniSet = "'".date('Y-m-d', strtotime('-60 days', strtotime(date("Y-m-d"))))." 00:00:00'";
                                                            $dataFimSet = "'9999-12-31 23:59:59'";
                                                        } else if(trim($row['periodizacao'])=="90") {
                                                            $dataIniSet = "'".date('Y-m-d', strtotime('-90 days', strtotime(date("Y-m-d"))))." 00:00:00'";
                                                            $dataFimSet = "'9999-12-31 23:59:59'";
                                                        } else if(trim($row['periodizacao'])=="180") {
                                                            $dataIniSet = "'".date('Y-m-d', strtotime('-180 days', strtotime(date("Y-m-d"))))." 00:00:00'";
                                                            $dataFimSet = "'9999-12-31 23:59:59'";
                                                        } else if(trim($row['periodizacao'])=="365") {
                                                            $dataIniSet = "'".date('Y-m-d', strtotime('-365 days', strtotime(date("Y-m-d"))))." 00:00:00'";
                                                            $dataFimSet = "'9999-12-31 23:59:59'";
                                                        } else if(trim($row['periodizacao'])=="personalizado") {
															if(trim($row['campo_intervalo'])=="idade") {
																$dataIniSet = "".$row['idade_de']."";
																$dataFimSet = "".$row['idade_ate']."";
															} else {
																$dataIniSet = "'".$row['data_de']." 00:00:00'";
																$dataFimSet = "'".$row['data_ate']." 23:59:59'";
															}
                                                        }

														if(trim($row['campo_intervalo'])=="idade") {
															$filtroPeriodoSet = " YEAR(CURRENT_DATE) - YEAR(mod_".$modRela.".pessoa_data_de_nascimento) - 
															(DATE_FORMAT(CURRENT_DATE, '%m%d') < DATE_FORMAT(mod_".$modRela.".pessoa_data_de_nascimento, '%m%d')) BETWEEN ".$dataIniSet." AND ".$dataFimSet."";
														} else {
															$filtroPeriodoSet = "mod_".$modRela.".".$campo_intervaloSet." BETWEEN ".$dataIniSet." AND ".$dataFimSet."";
														}

														if(trim($row['ordenacao'])=="data_asc") {
                                                            $ordenacaoSet = "mod_".$modRela.".".$campo_ordemSet." ASC";
                                                        } else if(trim($row['ordenacao'])=="data_desc") {
                                                            $ordenacaoSet = "mod_".$modRela.".".$campo_ordemSet." DESC";
                                                        } else if(trim($row['ordenacao'])=="alfabetica_a_z") {
															if(trim($row['local_filtro'])=="carrinho_notificacao_evento") {
																$ordenacaoSet = "mod_".$modRela.".pessoa_nome ASC";
															} else {
																$ordenacaoSet = "mod_".$modRela.".nome ASC";
															}
                                                        } else if(trim($row['ordenacao'])=="alfabetica_z_a") {
															if(trim($row['local_filtro'])=="carrinho_notificacao_evento") {
																$ordenacaoSet = "mod_".$modRela.".pessoa_nome DESC";
															} else {
																$ordenacaoSet = "mod_".$modRela.".nome DESC";
															}
														}

														$strSqlRela = "
															SELECT 
																mod_".$modRela.".empresa,
																mod_".$modRela.".id,
																mod_".$modRela.".numeroUnico,
																mod_".$modRela.".stat,
																mod_".$modRela.".data,
																
																".$CamposJoinSet."

			
																mod_empresa.nome AS empresa_nome
															
															FROM 
																".$modRela." AS mod_".$modRela." 
															LEFT JOIN 
																empresa AS mod_empresa ON (mod_empresa.id = mod_".$modRela.".empresa)

															".$LeftJoinSet."
															
															WHERE
																mod_".$modRela.".empresa='".$row['empresa']."' AND
																".$filtroPeriodoSet."
																".$filtroModuloTipoSet."
																".$filtroComissarioSet."
																".$filtroPdvSet."
																".$filtroConfirmadoSet."
																".$filtroStatSet."
																".$filtro_deviceSet."
																".$filtro_numeroUnico_ticketSet."
																".$filtro_numeroUnico_loteSet."
						
															ORDER BY
																".$ordenacaoSet."
																
														";

														$dataDeSet = "9999-12-31 23:59:59";
														$dataAteSet = "0000-00-00 00:00:00";
														$cont = 0;
														$rSqlControle = array();
														$corSet = "#ffffff";
														
														$qSqlRela = mysql_query("".$strSqlRela."");
														while($rSqlRela = mysql_fetch_array($qSqlRela)) {
															
															if(trim($row['local_filtro'])=="carrinho_notificacao_comissario") {
																if(trim($rSqlRela['numeroUnico_comissario'])=="") {
																	$mostra_registro = 0;
																} else {
																	if(trim($rSqlRela['device'])=="PDVWEB") {
																		$mostra_registro = 0;
																	} else {
																		$mostra_registro = 1;
																	}
																}
															} else if(trim($row['local_filtro'])=="carrinho_notificacao_pdv") {
																if(trim($rSqlRela['numeroUnico_pdv'])=="") {
																	$mostra_registro = 0;
																} else {
																	if(trim($rSqlRela['device'])=="PDVWEB") {
																		$mostra_registro = 1;
																	} else {
																		$mostra_registro = 0;
																	}
																}
															} else {
																$mostra_registro = 1;
															}
															
															if($mostra_registro==1) {
																$cont++;
																if($rSqlRela['data']<$dataDeSet) {
																	$dataDeSet = $rSqlRela['data'];
																}
																if($dataAteSet<$rSqlRela['data']) {
																	$dataAteSet = $rSqlRela['data'];
																}
	
																$rSqlControle[] = $rSqlRela;
															}
														}
														
														if($cont>0) {
															$periodoGeracaoSet = "Período de consulta de <b>".ajustaDataReturn($dataDeSet,"d/m/Y")."</b> até <b>".ajustaDataReturn($dataAteSet,"d/m/Y")."</b>";
														} else {
															$periodoGeracaoSet = "<b>Os parâmetros do relátório não retornaram nenhum registro</b>";
														}
														
														if($sysusu['id']=="1") {
															#echo "<br>".$strSqlRela."<br>";
														}
														?>
