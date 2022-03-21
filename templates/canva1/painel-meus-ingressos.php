                            <table class="cor_de_fundo_da_tabela_checkout cor_da_fonte_dos_detalhes_do_produto_e_precos_da_tabela_checkout" style="width:100%;">
                                <tr>
                                    <th class="cor_de_fundo_cabecalho_da_tabela_checkout cor_da_fonte_cabecalho_da_tabela_checkout" style="padding:5px 5px;width:100px;">#ID</th>
                                    <th class="cor_de_fundo_cabecalho_da_tabela_checkout cor_da_fonte_cabecalho_da_tabela_checkout" style="padding:5px 5px;">Info</th>
                                    <th class="cor_de_fundo_cabecalho_da_tabela_checkout cor_da_fonte_cabecalho_da_tabela_checkout" style="padding:5px 5px;"></th>
                                    <th class="cor_de_fundo_cabecalho_da_tabela_checkout cor_da_fonte_cabecalho_da_tabela_checkout" style="padding:5px 5px;width:70px;">Código</th>
                                    <th class="cor_de_fundo_cabecalho_da_tabela_checkout cor_da_fonte_cabecalho_da_tabela_checkout" style="padding:5px 5px;width:70px;">Lote</th>
                                    <th class="cor_de_fundo_cabecalho_da_tabela_checkout cor_da_fonte_cabecalho_da_tabela_checkout" style="padding:5px 5px;width:110px;">Valor</th>
                                    <th class="cor_de_fundo_cabecalho_da_tabela_checkout cor_da_fonte_cabecalho_da_tabela_checkout" style="padding:5px 5px;width:170px;">Data da Criação</th>
                                    <th class="cor_de_fundo_cabecalho_da_tabela_checkout cor_da_fonte_cabecalho_da_tabela_checkout" style="padding:5px 5px;width:125px;"></th>
                                    <th class="cor_de_fundo_cabecalho_da_tabela_checkout cor_da_fonte_cabecalho_da_tabela_checkout" style="padding:5px 5px;width:95px;"></th>
                                </tr>

								<?
								if(trim($EMPRESA_TOKEN)==trim($EMPRESA_TOKEN_CONFIG)) {
									$filtroCarrinhoPlataforma = "";
									$filtroCarrinhoNotificacaoPlataforma = " AND (mod_carrinho.plataforma='".$rSqlUsuario['empresa']."' OR mod_carrinho.empresa='".$rSqlUsuario['empresa']."') ";
								} else {
									$filtroCarrinhoPlataforma = " AND mod_carrinho.empresaObjeto LIKE '%empresa_token_".$EMPRESA_TOKEN_CONFIG."%' ";
									$filtroCarrinhoNotificacaoPlataforma = " AND mod_carrinho.empresa_token='".$EMPRESA_TOKEN_CONFIG."' ";
								}
								$strSql = "
									SELECT 
										COUNT(*)
									FROM 
										carrinho AS mod_carrinho 
									
									WHERE 
										mod_carrinho.numeroUnico_comprador='".$rSqlUsuario['numeroUnico']."' AND
										mod_carrinho.stat IN ('103')
										".$filtroCarrinhoPlataforma."
						
									ORDER BY
										mod_carrinho.data DESC
										
								";
								$nSql = mysql_fetch_row(mysql_query("".$strSql.""));
								
								if($nSql[0]==0) { } else {
								?>
								<?
									$strSql = "
										SELECT 
											mod_carrinho.id,
											mod_carrinho.numeroUnico,
											mod_carrinho.numeroUnico_pai,
											mod_carrinho.cod_contrato,
											mod_carrinho.valor_total,
											mod_carrinho.objeto_carrinho_detalhado,
											mod_carrinho.data,
											mod_carrinho.pago,
											mod_carrinho.stat
										FROM 
											carrinho AS mod_carrinho 
										
										WHERE 
											mod_carrinho.numeroUnico_comprador='".$rSqlUsuario['numeroUnico']."' AND
											mod_carrinho.stat IN ('103')
											".$filtroCarrinhoPlataforma."
							
										ORDER BY
											mod_carrinho.data DESC
											
									";
									$corSet = "#ffffff";
									$qSql = mysql_query("".$strSql." ".$limit_filtro." ");
									while($rSql = mysql_fetch_array($qSql)) {

										$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"button button-3d\" 
										 style=\"background-color:#ff9900;text-align:center;color:#FFF;margin-right: 0px;width:150px;padding: 8px 0px;\"> NÃO PAGO </a>";
	
										$contLista++;
										if($corSet=="#ffffff") {
											$corSet = "#e2e2e2";
										} else {
											$corSet = "#ffffff";
										}
							
										$detalhadoArray = unserialize($rSql['objeto_carrinho_detalhado']);
										foreach ($detalhadoArray as $key => $value_detalhado) {
											$rSql['evento_nome'] = $value_detalhado['evento_nome'];
											$rSql['ingresso_nome'] = $value_detalhado['ingresso_nome'];
										}

										$rSql['valor_total'] = $rSql['valor_total'] + ($rSql['valor_total'] * 0.10);
									?>
									<tr style="background-color:<?=$corSet?>;" role="row">
										<td style="vertical-align:middle;padding:5px 5px;">#<?=$rSql['id']?></td>
										<td style="vertical-align:middle;padding:5px 5px;"><?=$rSql['evento_nome']?></td>
										<td style="vertical-align:middle;padding:5px 5px;"><?=$rSql['ingresso_nome']?></td>
										<td style="vertical-align:middle;padding:5px 5px;"></td>
										<td style="vertical-align:middle;padding:5px 5px;">Sem definição de lote</td>
										<td style="vertical-align:middle;padding:5px 5px;">R$ <?=number_format($rSql['valor_total'], 2, ',', '.')?></td>
										<td style="vertical-align:middle;padding:5px 5px;"><?=ajustaDataReturn($rSql['data'],"d/m/Y")?></td>
										<td style="vertical-align:middle;padding:5px 5px;"><?=$confirmadoSet?></td>
										<td style="vertical-align:middle;padding:5px 5px;">
											<a href="<?=$link_modelo?>pagar-ingresso/<?=$rSql['numeroUnico']?>/" style="width:135px;text-align:center;" class="button button-3d btn-azul btn-xs" title="Pagar">Pagar</a>
										</td>
									</tr>
									<? } ?>
                                <? } ?>

								<? 
								if(trim($rSqlUsuario['documento'])=="") {
									$nSql[0] = 0;
								} else {
									$strSql = "
										SELECT 
											COUNT(*)
										FROM 
											carrinho_notificacao AS mod_carrinho 
										
										WHERE 
											mod_carrinho.pessoa_documento='".$rSqlUsuario['documento']."'
											".$filtroCarrinhoNotificacaoPlataforma."
							
										ORDER BY
											mod_carrinho.data DESC
											
									";
									$nSql = mysql_fetch_row(mysql_query("".$strSql.""));
								}

								if($nSql[0]==0) { 
								?>
									<tr style="background-color:<?=$corSet?>;" role="row">
										<td colspan="8" style="vertical-align:middle;padding:5px 5px;text-align:center;">Você não possui itens disponíveis</td>
									</tr>
                                <? } else { ?>
                                <?
									$strSql = "
										SELECT 
											mod_carrinho.id,
											mod_carrinho.numeroUnico,
											mod_carrinho.numeroUnico_pai,
											mod_carrinho.numeroUnico_carrinho,
											mod_carrinho.numeroUnico_pessoa,
											mod_carrinho.cod_voucher,
											mod_carrinho.pessoa_nome,
											mod_carrinho.pessoa_email,
											mod_carrinho.pessoa_documento,
											mod_carrinho.pessoa_telefone,
											mod_carrinho.numeroUnico_evento,
											mod_carrinho.numeroUnico_ticket,
											mod_carrinho.numeroUnico_lote,
											mod_carrinho.numeroUnico_produto,
											mod_carrinho.numeroUnico_cod_voucher,
	
											mod_eventos.nome AS eventos_nome,
											mod_eventos.tickets AS eventos_tickets,
											mod_eventos.data_do_evento AS eventos_data_do_evento,

											mod_carrinho.evento_nome,
											mod_carrinho.ingresso_nome,
											mod_carrinho.lote_nome,
											mod_carrinho.produto_nome,
											mod_carrinho.valor,
	
											mod_carrinho.confirmado,
											mod_carrinho.data,
											mod_carrinho.stat
										FROM 
											carrinho_notificacao AS mod_carrinho 
										LEFT JOIN 
											eventos AS mod_eventos ON (mod_eventos.numeroUnico = mod_carrinho.numeroUnico_evento)
										
										WHERE 
											mod_carrinho.pessoa_documento='".$rSqlUsuario['documento']."'
											".$filtroCarrinhoNotificacaoPlataforma."
							
										ORDER BY
											mod_carrinho.data DESC
											
									";
									$corSet = "#ffffff";
									$qSql = mysql_query("".$strSql." ".$limit_filtro." ");
									while($rSql = mysql_fetch_array($qSql)) {
										if($corSet=="#ffffff") {
											$corSet = "#e2e2e2";
										} else {
											$corSet = "#ffffff";
										}

									    $d  = substr($rSql['eventos_data_do_evento'],8,2);
									    $a  = substr($rSql['eventos_data_do_evento'],0,4);
									  
									    // com-feira, sem-feira, curto
									    $diasemana = diasemana_extenso($rSql['eventos_data_do_evento'],"sem-feira");
									
									    $mes = mes_extenso(substr($rSql['eventos_data_do_evento'],5,2),"longo");
		
										$ticketArray = unserialize($rSql['eventos_tickets']);
										$ticketArray = array_sort($ticketArray, 'ticket_data', SORT_ASC);
										foreach ($ticketArray as $key => $value_ticket) {
											if(trim($value_ticket['numeroUnico'])==trim($rSql["numeroUnico_ticket"])) {
												$rSql['ingresso_nome'] = $value_ticket['ticket_nome'];
											}
										}
	
										if(trim($rSql['lote_nome'])=="") {
											$rSql['lote_nome'] = "Sem definição de lote";
										} else {
											if(strrpos($rSql['lote_nome'],"Lote") === false) {
												$rSql['lote_nome'] = "".$rSql['lote_nome']."&deg; Lote";
											} else {
												$rSql['lote_nome'] = "".$rSql['lote_nome']."";
											}
										}

										if(trim($rSql['stat'])=="3") {
											$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"button button-3d\" 
											 style=\"background-color:#d610c1;text-align:center;color:#FFF;margin-right: 0px;width:150px;padding: 8px 0px;\"> ESTORNADO </a>";
										} else if(trim($rSql['stat'])=="4") {
											$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"button button-3d\" 
											 style=\"background-color:#000;text-align:center;color:#FFF;margin-right: 0px;width:150px;padding: 8px 0px;\"> BLOQUEADO </a>";
										} else if(trim($rSql['stat'])=="5") {
											$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"button button-3d\" 
											 style=\"background-color:#000;text-align:center;color:#FFF;margin-right: 0px;width:150px;padding: 8px 0px;\"> CANCELADO </a>";
										} else {
											if(trim($rSql['confirmado'])=="1") {
												$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"button button-3d\" 
												 style=\"background-color:#093;text-align:center;color:#FFF;margin-right: 0px;width:150px;padding: 8px 0px;\"> JÁ UTILIZADO </a>";
											} else if(trim($rSql['confirmado'])=="0" || trim($rSql['confirmado'])=="") {
												$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"button button-3d\"
												 style=\"background-color:#c00;text-align:center;color:#FFF;margin-right: 10px;width:150px;padding: 8px 0px;\"> NÃO UTILIZADO </a>";
											}
										}
										
									?>
									<tr style="background-color:<?=$corSet?>;" role="row">
										<td style="vertical-align:middle;padding:5px 5px;">#<?=$rSql['id']?></td>
										<td style="vertical-align:middle;padding:5px 5px;"><?=$rSql['eventos_nome']?></td>
										<td style="vertical-align:middle;padding:5px 5px;"><?=$rSql['ingresso_nome']?></td>
										<td style="vertical-align:middle;padding:5px 5px;"><?=$rSql['numeroUnico_cod_voucher']?></td>
										<td style="vertical-align:middle;padding:5px 5px;"><?=$rSql['lote_nome']?></td>
										<td style="vertical-align:middle;padding:5px 5px;">R$ <?=number_format($rSql['valor'], 2, ',', '.')?></td>
										<td style="vertical-align:middle;padding:5px 5px;"><?=ajustaDataReturn($rSql['data'],"d/m/Y")?></td>
										<td style="vertical-align:middle;padding:5px 5px;"><?=$confirmadoSet?></td>
										<td style="vertical-align:middle;padding:5px 5px;">
											<a href="<?=$link_modelo?>painel/<?=$_REQUEST['var2']?>/<?=$rSql['numeroUnico']?>/" style="width:135px;text-align:center;" class="button button-3d btn-azul btn-xs" title="Ver Detalhes">+ Detalhes</a>
										</td>
									</tr>
									<? } ?>
								<? } ?>
                            </table>
