		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap" style="padding-top:40px;">
				<div class="container clearfix">

					<div class="single-product">
						<div class="product">
							<div class="row gutter-40">

								<div class="col-md-6 product-desc" style="padding-top:0px;">

									<?
								    if(trim($rSqlEvento['local'])=="") { $monta_local = ""; } else { $monta_local = "".$rSqlEvento['local']."<br>"; }
	
								    if(trim($rSqlEvento['rua'])=="") { } else { $monta_endereco .= "".$rSqlEvento['rua'].""; }
								    if(trim($rSqlEvento['numero'])=="") { } else { $monta_endereco .= ", ".$rSqlEvento['numero'].""; }
								    if(trim($rSqlEvento['bairro'])=="") { } else { $monta_endereco .= "<br>".$rSqlEvento['bairro'].""; }
									
									if(trim($rSqlEvento['rua'])=="" && trim($rSqlEvento['numero'])=="" && trim($rSqlEvento['bairro'])=="") { $prefixoCidade = ""; } else { $prefixoCidade = " - "; }
									
								    if(trim($rSqlEvento['cidade'])=="") { } else { $monta_endereco .= "".$prefixoCidade."".$rSqlEvento['cidade'].""; }
								    if(trim($rSqlEvento['estado'])=="") { } else { $monta_endereco .= "/".$rSqlEvento['estado'].""; }
								    if(trim($rSqlEvento['cep'])=="") { } else { $monta_endereco .= " <br> ".$rSqlEvento['cep'].""; }
	
									$carrinhoArray = unserialize($_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].'']);
									
                                    $contTickets = 0;
									$ticketsArray = unserialize($rSqlEvento['tickets']);
                                    $ticketsArray = array_sort($ticketsArray, 'ticket_data', SORT_ASC);
                                    foreach ($ticketsArray as $key_ticket => $value_ticket) {
										
										if(trim($value_ticket['ticket_data'])>=$data) {
											if(trim($value_ticket['stat'])=="1") {
												if(trim($value_ticket['ticket_exibir_site'])=="1") {
													$lotesArray = unserialize($rSqlEvento['lotes']);
													$lotesArray = array_sort($lotesArray, 'lote', SORT_ASC);
													foreach ($lotesArray as $key_lote => $value_lote) {
														if(trim($value_ticket['numeroUnico'])==trim($value_lote['numeroUnico_ticket']) && trim($value_lote['stat'])=="1") {
															$nSqlCarrinhoLote = mysql_fetch_row(mysql_query("SELECT 
																												COUNT(*) 
																											 FROM 
																												carrinho_notificacao 
																											 WHERE 
																												numeroUnico_lote='".$value_lote['numeroUnico']."' AND 
																												stat='1'
																											 "));
	
															if($value_lote['lote_qtd']>$nSqlCarrinhoLote[0]) {
																$contTickets++;
															}
															
															$procura = "".$value_ticket["ticket_data"]."";
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
																$d  = substr($value_ticket['ticket_data'],8,2);
																$a  = substr($value_ticket['ticket_data'],0,4);
														
																if($cont_datasLista==1) {
																	$ticket_data_deSet = $value_ticket['ticket_data'];
																}
																if($value_ticket['ticket_data']>$ticket_data_deSet) {
																	$ticket_data_ateSet = "".$value_ticket['ticket_data']."";
																}
																
																// com-feira, sem-feira, curto
																$diasemana = diasemana_extenso($value_ticket['ticket_data'],"com-feira");
																
																$mes = mes_extenso(substr($value_ticket['ticket_data'],5,2),"longo");
														
																$tickets_datas[] = array(
																					"tag" => "ticket_data", 
																					"id" => "".$value_ticket['numeroUnico']."", 
																					"numeroUnico" => "".$value_ticket['numeroUnico']."", 
																					"numeroUnico_filial" => "", 
																					"numeroUnico_evento" => "".$rSqlEvento['numeroUnico']."", 
																					"numeroUnico_ticket" => "".$value_ticket['numeroUnico']."", 
																					"numeroUnico_lote" => "".$value_lote['numeroUnico']."", 
																					"ticket_data" => "".$value_ticket["ticket_data"]."", 
																					"ticket_data_diasemana" => "".$diasemana."", 
																					"ticket_data_mes" => "".$mes."", 
																					"ticket_data_print" => "".ajustaDataReturn($value_ticket['ticket_data'],"d/m/Y")."", 
																				);
															}
	
	
														}
													}
												}
											}
										}
									}
									
									if(trim($rSqlEmpresa['venda_evento_site'])=="1") {
										if($contTickets>0) {
											$mostraIngressos = "1";
										} else {
											$mostraIngressos = "0";
										}
									} else {
										$mostraIngressos = "0";
									}
									if($mostraIngressos=="1") {
									?>
					
									<div title="<?=$data?>" class="product-price"><ins><?=$configuracoes_site['label_ticket_plural']?></ins></div>

                                    <? if(count($tickets_datas)>1) { $display_ticketsArray = "none"; ?>
                                    <div class="col-md-12 col-lg-12 mb-3" style="padding-right:0px !important;padding-left:0px !important;">
                                        <div class="row">
                                        	<?
											$tickets_datas = array_sort($tickets_datas, 'ticket_data', SORT_ASC);
											foreach ($tickets_datas as $key_tickets_datas => $value_tickets_datas) {
											?>
                                            <div class="col-sm-6">
                                             <a id="BTN_tickets_datas_<?=$value_tickets_datas["ticket_data"]?>" 
                                                href="javascript:void(0);" onclick="javascript:seleciona_tickets_datas('<?=$value_tickets_datas["ticket_data"]?>');" 
                                                class="BTN_tickets_datas button button-desc button-3d button-rounded button-white button-light center w-100"><?=$value_tickets_datas["ticket_data_print"]?></a>
                                            </div>
                                            <? } ?>
                                        </div>
                                    </div>
                                    <? } else { $display_ticketsArray = "block"; } ?>
                                    
                                    <div class="line item_ticket_data" style="display:<?=$display_ticketsArray?>;"></div>

									<?
										$ticketsArray = unserialize($rSqlEvento['tickets']);
										$ticketsArray = array_sort($ticketsArray, 'ticket_data', SORT_ASC);
										foreach ($ticketsArray as $key_ticket => $value_ticket) {
											
											if(trim($value_ticket['ticket_data'])>=$data) {
												if(trim($value_ticket['stat'])=="1") {
													if(trim($value_ticket['ticket_exibir_site'])=="1") {
														if(trim($value_ticket['ticket_imagem_de_capa'])=="") { $imgUrl = ""; } else {
															$imgUrl = "".$link."files/eventos_ticket_imagem_de_capa/".$value_ticket['numeroUnico']."/".$value_ticket['ticket_imagem_de_capa']."";
														}
				
														if(trim($value_ticket['ticket_exigir_atribuicao'])=="" || trim($value_ticket['ticket_exigir_atribuicao'])=="1") { 
															$value_ticket['ticket_exigir_atribuicao'] = "1"; 
														} else {
															$value_ticket['ticket_exigir_atribuicao'] = "0"; 
														}
														
														if(trim($value_ticket['ticket_exibir_lote'])=="" || trim($value_ticket['ticket_exibir_lote'])=="1") { 
															$value_ticket['ticket_exibir_lote'] = "1"; 
														} else {
															$value_ticket['ticket_exibir_lote'] = "0"; 
														}
														
														if(trim($value_ticket['ticket_genero'])=="" || trim($value_ticket['ticket_exibir_taxa'])=="U") { 
															$generoSet = ""; 
															$value_ticket['ticket_genero'] = "U";
														} else if(trim($value_ticket['ticket_genero'])=="F") {
															$generoSet = "Feminino"; 
														} else if(trim($value_ticket['ticket_genero'])=="M") {
															$generoSet = "Masculino"; 
														}
														
														if(trim($value_ticket['ticket_exibir_taxa'])=="" || trim($value_ticket['ticket_exibir_taxa'])=="1") { 
															$value_ticket['ticket_exibir_taxa'] = "1"; 
														} else {
															$value_ticket['ticket_exibir_taxa'] = "0"; 
														}
														
														$lotesArray = unserialize($rSqlEvento['lotes']);
														$lotesArray = array_sort($lotesArray, 'lote', SORT_ASC);
														foreach ($lotesArray as $key_lote => $value_lote) {
															if((trim($value_ticket['numeroUnico'])==trim($value_lote['numeroUnico_ticket']) && trim($value_lote['stat'])=="1") || $rSqlUsuario['id']=="50769" ) {
																$valor_subtotal = $value_lote['lote_valor'];
	
																$valueDetalhado["taxa_cms"] = retornaTaxas("".$rSqlEvento['empresa']."","SITE","taxa_cms");
	
																$valor_taxa = $value_lote['lote_valor'] / 100 * $valueDetalhado["taxa_cms"];
																$valor_ingresso = $value_lote['lote_valor'];
	
																$valor_total = $value_lote['lote_valor'] + ($value_lote['lote_valor'] / 100 * $valueDetalhado["taxa_cms"]);
										?>
	
										<input type="hidden" id="evento_empresa_<?=$value_lote['numeroUnico']?>" value="<?=$rSqlEvento['empresa']?>" />
										<input type="hidden" id="evento_empresa_token_<?=$value_lote['numeroUnico']?>" value="<?=$rSqlEvento['empresa_token']?>" />

										<input type="hidden" id="numeroUnico_loja_<?=$value_lote['numeroUnico']?>" value="<?=$rSqlEmpresa['numeroUnico']?>" />
										<input type="hidden" id="numeroUnico_produto_<?=$value_lote['numeroUnico']?>" value="" />
										<input type="hidden" id="numeroUnico_evento_<?=$value_lote['numeroUnico']?>" value="<?=$rSqlEvento['numeroUnico']?>" />
										<input type="hidden" id="numeroUnico_ticket_<?=$value_lote['numeroUnico']?>" value="<?=$value_ticket['numeroUnico']?>" />
										<input type="hidden" id="numeroUnico_lote_<?=$value_lote['numeroUnico']?>" value="<?=$value_lote['numeroUnico']?>" />
										<input type="hidden" id="lote_<?=$value_lote['numeroUnico']?>" value="<?=$value_lote['lote']?>" />

										<input type="hidden" id="produto_nome_<?=$value_lote['numeroUnico']?>" value="" />
										<input type="hidden" id="evento_nome_<?=$value_lote['numeroUnico']?>" value="<?=$rSqlEvento['nome']?>" />
										<input type="hidden" id="ingresso_nome_<?=$value_lote['numeroUnico']?>" value="<?=$value_ticket['ticket_nome']?>" />
										<input type="hidden" id="ingresso_data_<?=$value_lote['numeroUnico']?>" value="<?=$value_ticket['ticket_data']?>" />
										<input type="hidden" id="ticket_genero_<?=$value_lote['numeroUnico']?>" value="<?=$value_ticket['ticket_genero']?>" />
										<input type="hidden" id="ticket_compra_autorizada_<?=$value_lote['numeroUnico']?>" value="<?=$value_ticket['ticket_compra_autorizada']?>" />
										<input type="hidden" id="imagem_<?=$value_lote['numeroUnico']?>" value="<?=$imgUrl?>" />
										<input type="hidden" id="ticket_exigir_atribuicao_<?=$value_lote['numeroUnico']?>" value="<?=$value_ticket['ticket_exigir_atribuicao']?>" />

										<input type="hidden" id="valor_<?=$value_lote['numeroUnico']?>" value="<?=$value_lote['lote_valor']?>" />
										<input type="hidden" id="valor_subtotal_<?=$value_lote['numeroUnico']?>" value="<?=$valor_subtotal?>" />
										<input type="hidden" id="valor_total_<?=$value_lote['numeroUnico']?>" value="<?=$valor_total?>" />
										<input type="hidden" id="valor_pago_<?=$value_lote['numeroUnico']?>" value="<?=$valor_total?>" />
										<input type="hidden" id="valor_promocional_<?=$value_lote['numeroUnico']?>" value="0.00" />

										<div class="col-md-12 col-lg-12 mb-3 item_ticket_data ticket_data_<?=$value_ticket['ticket_data']?>" ticket_data="<?=$value_ticket['ticket_data']?>" style="padding-right:0px;display:<?=$display_ticketsArray?>;">
											<div class="row">
												<div class="col-md-6 col-50-mobile">
                                                    <div class="col-md-12 p-0"><?=$value_ticket['ticket_nome']?></div>
                                                    <div class="col-md-12 p-0">
                                                    <? if(trim($value_ticket['ticket_exibir_lote'])=="1") { ?>
                                                    <b><?=$value_lote['lote']?>° Lote</b><br />
                                                    <? } ?>
                                                    <? if(trim($generoSet)=="") { } else { ?>
                                                    <b><i><?=$generoSet?></i></b><br />
                                                    <? } ?>
                                                    <?="R$ ".number_format($valor_total, 2, ',', '.').""?><br />
                                                    <? if($valor_taxa>0 && trim($value_ticket['ticket_exibir_taxa'])=="1") { ?>
                                                    <span style="font-style:italic;font-size:10px;">(<?="R$ ".number_format($valor_ingresso, 2, ',', '.').""?> + <?="R$ ".number_format($valor_taxa, 2, ',', '.').""?> de taxa)</span><br />
                                                    <? } ?>
                                                    </div>
                                                </div>
												<div class="col-md-6 col-50-mobile pr-0" style="padding-right:0px;">
													<?
													$qtdSet = 0;
													foreach ($carrinhoArray as $key => $value) {
													   if($value_lote['numeroUnico']==$value['numeroUnico_lote']) {
														   $qtdSet = $value['qtd'];
													   }
													}
													?>

													<div class="quantity float-end">
														<input type="button" value="-" onclick="javascript:interacaoCarrinho('<?=$value_lote['numeroUnico']?>','menos','evento');" class="minus">
														<input type="number" value="<?=$qtdSet?>" title="Qtd" class="qty" id="qtd_<?=$value_lote['numeroUnico']?>" />
														<input type="button" value="+" onclick="javascript:interacaoCarrinho('<?=$value_lote['numeroUnico']?>','mais','evento');" class="plus">
													</div>
												</div>
											</div>
										</div>
										<div class="line item_ticket_data" ticket_data="<?=$value_ticket['ticket_data']?>" style="display:<?=$display_ticketsArray?>;"></div>
															<? } ?>
														<? } ?>
													<? } ?>
												<? } ?>
											<? } ?>
										<? } ?>
                                        <div id="btn_finalizar_compra" class="col-md-12 col-lg-12 mb-3 text-center" style="display:<?=$display_ticketsArray?>;">
                                        <a href="<?=$link_modelo?>checkout/" class="button button-3d button-small m-0"><i class="icon-line-bag"></i>&nbsp;Finalizar Compra</a>
                                        </div>
                                    <? } else { ?>
									<div class="product-price"><ins>Não possuem ingressos disponíveis</ins></div>
									<? } ?>

								</div>

                                <div class="col-md-6">
                                    <? if(trim($rSqlEvento['imagem_de_banner'])=="") { } else { ?>
                                    <div class="entry-image mb-0">
                                        <a href="#"><img src="data:image/png;base64,<?=$rSqlEvento['imagem_de_banner']?>" alt="<?=$rSqlEvento['nome']?>"></a>
                                    </div>
                                    <? } ?>
									<? if(trim($monta_local)=="" && trim($monta_endereco)=="") { } else { ?>
                                    <h3><span class="subtitle" style="font-size: 13px;font-style: italic;"><?=$monta_local?><?=$monta_endereco?></span></h3>
                                    <? } ?>
                                    <br />
                                    <?=$rSqlEvento['detalhe']?>
                                </div>
    
								<div class="w-100"></div>

							</div>
						</div>
					</div>

					<div class="line"></div>

				</div>
			</div>
		</section><!-- #content end -->