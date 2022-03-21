                            <table class="cor_de_fundo_da_tabela_checkout cor_da_fonte_dos_detalhes_do_produto_e_precos_da_tabela_checkout" style="width:100%;">
                                <tr>
                                    <th class="cor_de_fundo_cabecalho_da_tabela_checkout cor_da_fonte_cabecalho_da_tabela_checkout" style="padding:5px 5px;width:100px;">#ID</th>
                                    <th class="cor_de_fundo_cabecalho_da_tabela_checkout cor_da_fonte_cabecalho_da_tabela_checkout" style="padding:5px 5px;">Forma de Pagamento</th>
                                    <th class="cor_de_fundo_cabecalho_da_tabela_checkout cor_da_fonte_cabecalho_da_tabela_checkout" style="padding:5px 5px;width:110px;">Total</th>
                                    <th class="cor_de_fundo_cabecalho_da_tabela_checkout cor_da_fonte_cabecalho_da_tabela_checkout" style="padding:5px 5px;width:170px;">Data</th>
                                    <th class="cor_de_fundo_cabecalho_da_tabela_checkout cor_da_fonte_cabecalho_da_tabela_checkout" style="padding:5px 5px;">Status</th>
                                    <th class="cor_de_fundo_cabecalho_da_tabela_checkout cor_da_fonte_cabecalho_da_tabela_checkout" style="padding:5px 5px;width:95px;"></th>
                                </tr>

								<?
								if(trim($EMPRESA_TOKEN)==trim($EMPRESA_TOKEN_CONFIG)) {
									$filtroCarrinhoPlataforma = "";
								} else {
									$filtroCarrinhoPlataforma = " AND mod_carrinho.empresaObjeto LIKE '%empresa_token_".$EMPRESA_TOKEN_CONFIG."%' ";
								}

								$strSql = "
									SELECT 
										COUNT(*)
									FROM 
										carrinho AS mod_carrinho 
									
									WHERE 
										mod_carrinho.numeroUnico_comprador='".$rSqlUsuario['numeroUnico']."' AND
										mod_carrinho.stat NOT IN ('103')
										".$filtroCarrinhoPlataforma."
						
									ORDER BY
										mod_carrinho.data DESC
										
								";
								$nSql = mysql_fetch_row(mysql_query("".$strSql.""));
								
								if($nSql[0]==0) {
								?>
									<tr style="background-color:<?=$corSet?>;" role="row">
										<td colspan="7" style="vertical-align:middle;padding:5px 5px;text-align:center;">Você não possui itens registrados</td>
									</tr>
                                <? } else { ?>
								<?
									$strSql = "
										SELECT 
											mod_carrinho.id,
											mod_carrinho.numeroUnico,
											mod_carrinho.numeroUnico_pai,
											mod_carrinho.cod_contrato,
											mod_carrinho.valor_total,
											mod_carrinho.forma_de_pagamento,
											mod_carrinho.objeto_carrinho,
											mod_carrinho.data,
											mod_carrinho.pago,
											mod_carrinho.stat
										FROM 
											carrinho AS mod_carrinho 
										
										WHERE 
											mod_carrinho.numeroUnico_comprador='".$rSqlUsuario['numeroUnico']."' AND
											mod_carrinho.stat NOT IN ('103')
											".$filtroCarrinhoPlataforma."
							
										ORDER BY
											mod_carrinho.data DESC
											
									";
									$corSet = "#ffffff";
									$qSql = mysql_query("".$strSql." ".$limit_filtro." ");
									while($rSql = mysql_fetch_array($qSql)) {
	
										$valorTotal = 0;
										$carrinhoArray = unserialize($rSql['objeto_carrinho']);
										$carrinhoArray = json_decode(json_encode($carrinhoArray), true);
										foreach ($carrinhoArray as $key => $value) {
											if(trim($value['valor_venda'])=="") {
												$value['preco_com_cupom'] = $value['preco_com_cupom'];
											} else {
												$value['preco_com_cupom'] = $value['valor_venda'];
											}
											
											$valorTotal = $valorTotal + ($value['preco_com_cupom'] * $value['qtd']);
										}
	
										$contLista++;
										if($corSet=="#ffffff") {
											$corSet = "#e2e2e2";
										} else {
											$corSet = "#ffffff";
										}
							
										$formaDePagamentoSet = formaDePagamento($rSql);
										$formaDePagamentoIconeSet = $formaDePagamentoSet['icone'];
										$formaDePagamentoCorSet = $formaDePagamentoSet['cor'];
										$formaDePagamentoTxtSet = $formaDePagamentoSet['txt'];
	
										$statusDataDaCompraSet = statusDataDaCompraSimples($rSql);
										$statusDataDaCompraCorSet = $statusDataDaCompraSet['cor'];
										$statusDataDaCompraTxtSet = $statusDataDaCompraSet['txt'];
									?>
									<tr style="background-color:<?=$corSet?>;" role="row">
										<td style="vertical-align:middle;padding:5px 5px;">#<?=$rSql['id']?></td>
										<td style="vertical-align:middle;padding:5px 5px;"><?=$formaDePagamentoTxtSet?></td>
										<td style="vertical-align:middle;padding:5px 5px;">R$ <?=number_format($valorTotal, 2, ',', '.')?></td>
										<td style="vertical-align:middle;padding:5px 5px;"><?=ajustaDataReturn($rSql['data'],"d/m/Y")?></td>
										<td style="vertical-align:middle;padding:5px 5px;"><?=$statusDataDaCompraTxtSet?></td>
										<td style="vertical-align:middle;padding:5px 5px;">
											<a href="<?=$link_modelo?>painel/<?=$_REQUEST['var2']?>/<?=$rSql['numeroUnico']?>/" class="button button-3d btn-azul btn-xs" title="Ver Detalhes">+ Detalhes</a>
										</td>
									</tr>
									<? } ?>
                                <? } ?>
                            </table>
