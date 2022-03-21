            <?
			if(trim($_SESSION["_eventosS_home"])=="") {
				$eventoHomeSet = "";
				$filtroEvento = "";

				if(trim($plataformaHomeSet)=="") { 
					if(trim($empresaHomeSet)=="") { 
						$filtroEmpresaEventoSet = "";
					} else {
						$filtroEmpresaEventoSet = " AND mod_carrinho.empresa='".$empresaHomeSet."' ";
					}
				} else {
					if(trim($empresaHomeSet)=="") { 
						$filtroEmpresaEventoSet = " AND mod_carrinho.plataforma='".$plataformaHomeSet."' ";
					} else {
						$filtroEmpresaEventoSet = " AND mod_carrinho.empresa='".$plataformaHomeSet."' ";
					}
				}
	
			} else {
				$eventoHomeSet = "".$_SESSION["_eventosS_home"]."";
				$filtroEmpresaEventoSet = "";
				$filtroEvento = " AND mod_carrinho.numeroUnico_evento='".$eventoHomeSet."' ";
			}
			
			if(trim($filtro_carrinhoSet)=="") {
				$filtroEmpresaEventoSet = $filtroEmpresaEventoSet;
			} else {
				$filtroEmpresaEventoSet = "";
			}
			
			if(trim($_SESSION["_dataS_home"])=="") {
				$filtroEventoData = "";
			} else {
				$filtroEventoData = " AND mod_carrinho.data BETWEEN '".$_SESSION["_dataS_home"]." 00:00:00' AND '".date('Y-m-d')." 23:59:59' ";
			}
			
			if(trim($eventoHomeSet)=="5FzpavMv2LBtldtaScT2P73Hy9tKH3") {
				$campoValorSet = "valor_a_pagar";
			} else {
				$campoValorSet = "valor_subtotal";
			}

			#INGRESSOS QTD
			$strSql = "
				SELECT 
					COUNT(*)
				FROM 
					carrinho_notificacao AS mod_carrinho 
				
				WHERE 
					mod_carrinho.stat='1' AND
					mod_carrinho.forma_de_pagamento NOT IN ('COR')
					".$filtroEmpresaEventoSet."
					".$filtro_carrinhoSet."
					".$filtroEvento."
					".$filtroEventoData."
			";
			$nSqlIngressos = mysql_fetch_row(mysql_query("".$strSql.""));

			#INGRESSOS ESTORNOS QTD
			$strSql = "
				SELECT 
					COUNT(*)
				FROM 
					carrinho_notificacao AS mod_carrinho 
				
				WHERE 
					mod_carrinho.stat='3'
					".$filtroEmpresaEventoSet."
					".$filtro_carrinhoSet."
					".$filtroEvento."
					".$filtroEventoData."
			";
			$nSqlIngressosEstornos = mysql_fetch_row(mysql_query("".$strSql.""));

			#INGRESSOS ESTORNOS $$$
			$strSql = "
				SELECT 
					SUM(mod_carrinho.valor_total) AS valor_total
				FROM 
					carrinho_notificacao AS mod_carrinho 
				
				WHERE 
					mod_carrinho.stat='3'
					".$filtroEmpresaEventoSet."
					".$filtro_carrinhoSet."
					".$filtroEvento."
					".$filtroEventoData."
			";
			$rSqlIngressosEstornos = mysql_fetch_array(mysql_query("".$strSql.""));

			#INGRESSOS BIPADOS
			$strSql = "
				SELECT 
					COUNT(*)
				FROM 
					carrinho_notificacao AS mod_carrinho 
				
				WHERE 
					mod_carrinho.stat='1' AND
					mod_carrinho.confirmado='1'
					".$filtroEmpresaEventoSet."
					".$filtro_carrinhoSet."
					".$filtroEvento."
					".$filtroEventoData."
			";
			$nSqlIngressosBipados = mysql_fetch_row(mysql_query("".$strSql.""));

			#CORTESIAS QTD
			$strSql = "
				SELECT 
					COUNT(*)
				FROM 
					carrinho_notificacao AS mod_carrinho 
				
				WHERE 
					mod_carrinho.stat='1' AND
					mod_carrinho.forma_de_pagamento IN ('COR')
					".$filtroEmpresaEventoSet."
					".$filtro_carrinhoSet."
					".$filtroEvento."
					".$filtroEventoData."
			";
			$nSqlCortesia = mysql_fetch_row(mysql_query("".$strSql.""));

			#VENDAS PDV DIN $$$
			$strSqlPdvDin = "
				SELECT 
					SUM(mod_carrinho.valor_total) AS valor_total
				FROM 
					carrinho_notificacao AS mod_carrinho 
				
				WHERE 
					mod_carrinho.stat='1' AND
					mod_carrinho.forma_de_pagamento IN ('DIN') AND
					mod_carrinho.device IN ('PDVWEB')
					".$filtroEmpresaEventoSet."
					".$filtro_carrinhoSet."
					".$filtroEvento."
					".$filtroEventoData."
			";
			$rSqlVendasPdvDin = mysql_fetch_array(mysql_query("".$strSqlPdvDin.""));
			$rSqlVendasPdvDin['valor_total_taxa_pdv_din'] = $rSqlVendasPdvDin['valor_total'] * 0.10;
			$rSqlVendasPdvDin['valor_total'] = $rSqlVendasPdvDin['valor_total'] - $rSqlVendasPdvDin['valor_total_taxa_pdv_din'];

			#VENDAS PDV $$$
			$strSqlPdv = "
				SELECT 
					SUM(mod_carrinho.".$campoValorSet.") AS valor_total
				FROM 
					carrinho_notificacao AS mod_carrinho 
				
				WHERE 
					mod_carrinho.stat='1' AND
					mod_carrinho.data > '2021-09-11 18:00:00' AND
					mod_carrinho.device IN ('PDVWEB')
					".$filtroEmpresaEventoSet."
					".$filtro_carrinhoSet."
					".$filtroEvento."
					".$filtroEventoData."
			";
			$rSqlVendasPdv = mysql_fetch_array(mysql_query("".$strSqlPdv.""));

			#VENDAS Admin $$$
			$strSqlAdmin = "
				SELECT 
					SUM(mod_carrinho.valor_total) AS valor_total
				FROM 
					carrinho_notificacao AS mod_carrinho 
				
				WHERE 
					mod_carrinho.stat='1' AND
					mod_carrinho.device NOT IN ('PDVWEB')
					".$filtroEmpresaEventoSet."
					".$filtro_carrinhoSet."
					".$filtroEvento."
					".$filtroEventoData."
			";
			$rSqlVendasAdmin = mysql_fetch_array(mysql_query("".$strSqlAdmin.""));

			#VENDAS $$$
			$strSql = "
				SELECT 
					SUM(mod_carrinho.".$campoValorSet.") AS valor_total
				FROM 
					carrinho_notificacao AS mod_carrinho 
				
				WHERE 
					mod_carrinho.stat='1' AND
					mod_carrinho.device NOT IN ('PDVWEB')
					".$filtroEmpresaEventoSet."
					".$filtro_carrinhoSet."
					".$filtroEvento."
					".$filtroEventoData."
			";
			$rSqlVendas = mysql_fetch_array(mysql_query("".$strSql.""));

			$rSqlVendasOnline['valor_total'] = $rSqlVendasAdmin['valor_total'] - $rSqlVendas['valor_total'];
			$rSqlVendas['valor_total'] = $rSqlVendas['valor_total'] - $rSqlVendasPdvDin['valor_total_taxa_pdv_din'];
			
			#TICKETS $$$
			$rData = array();
			$qSql = mysql_query("
									SELECT
										COUNT(*) AS total,
										count(DISTINCT mod_carrinho.numeroUnico_ticket),
										mod_carrinho.evento_nome,
										mod_carrinho.numeroUnico_ticket,
										mod_carrinho.valor_total,
										mod_carrinho.ingresso_nome
									FROM 
										carrinho_notificacao AS mod_carrinho 
									WHERE
										mod_carrinho.stat='1' AND
										mod_carrinho.forma_de_pagamento NOT IN ('COR')
										".$filtroEmpresaEventoSet."
										".$filtro_carrinhoSet."
										".$filtroEvento."
										".$filtroEventoData."
									GROUP BY
										numeroUnico_ticket
									");
			while($rSql = mysql_fetch_array($qSql)) {
				$strSqlTicket = "
					SELECT 
						COUNT(*)
					FROM 
						carrinho_notificacao AS mod_carrinho 
					
					WHERE 
						mod_carrinho.stat='1' AND
						mod_carrinho.confirmado='1' AND
						mod_carrinho.numeroUnico_ticket='".$rSql['numeroUnico_ticket']."'
				";
				$nSqlIngressosBipadosTicket = mysql_fetch_row(mysql_query("".$strSqlTicket.""));
				$rSql['ingresso_bipados'] = $nSqlIngressosBipadosTicket[0]; 

				$strSqlCortesiaTicket = "
					SELECT 
						COUNT(*)
					FROM 
						carrinho_notificacao AS mod_carrinho 
					
					WHERE 
						mod_carrinho.stat='1' AND
						mod_carrinho.forma_de_pagamento='COR' AND
						mod_carrinho.numeroUnico_ticket='".$rSql['numeroUnico_ticket']."'
				";
				$nSqlIngressosCortesiaTicket = mysql_fetch_row(mysql_query("".$strSqlCortesiaTicket.""));
				$rSql['total_cortesia'] = $nSqlIngressosCortesiaTicket[0]; 
				$rData[] = $rSql;
			}
			
			if(trim($rSqlVendas['valor_total'])=="") { $rSqlVendas['valor_total'] = 0; }
			if(trim($rSqlIngressosEstornos['valor_total'])=="") { $rSqlIngressosEstornos['valor_total'] = 0; }
			
			if(trim($nSqlIngressos[0])=="") { $nSqlIngressos[0] = 0; }
			if(trim($nSqlIngressosEstornos[0])=="") { $nSqlIngressosEstornos[0] = 0; }
			if(trim($nSqlIngressosBipados[0])=="") { $nSqlIngressosBipados[0] = 0; }
			if($rSqlVendas['valor_total']==0 && $nSqlIngressos[0]==0) {
				$TicketMedio = 0;
			} else {
				$TicketMedio = $rSqlVendas['valor_total'] / $nSqlIngressos[0];
			}
			?>
            
            <div class="col-md-12" style="margin-bottom: 10px;">
                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;padding-right:0px;">Evento</label>
                <div class="col-md-6" style="padding-left:0px;padding-right:0px;">
                    <select name="eventos" id="eventos" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:filtrar_eventos_dashboard();">
                        <option value="">---</option>
                        <?
                        $qSqlItem = mysql_query("
                                                SELECT 
                                                    mod_eventos.id,
                                                    mod_eventos.numeroUnico,
                                                    mod_eventos.nome
                                                     
                                                FROM 
                                                    eventos AS mod_eventos 
                                                WHERE
                                                    (mod_eventos.stat='0' OR mod_eventos.stat='1') ".$filtro_eventosSet."
                                                ORDER BY 
                                                    mod_eventos.nome");
                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                        ?>
                        <option value="<?= $rSqlItem['numeroUnico'] ?>" <? if(trim($eventoHomeSet)==trim($rSqlItem['numeroUnico'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                        <? } ?>
                    </select>
                </div>
                <style>
				.btn-outline-primary {
					color: #716aca;
					background-color: #f3f3f4;
					border-color: #716aca;
				}
				.btn-outline-primary:hover, .btn-outline-primary-active {
					color: #FFFFFF;
					background-color: #716aca;
					border-color: #716aca;
				}
                </style>
                <div class="col-md-6" style="padding-left:0px;padding-right:0px;">
                    <div class="btn-group" role="group" style="float:right;">
                        <button type="button" onclick="javascript:filtrar_data_dashboard('');" class="btn btn-outline-primary <? if(trim($_SESSION["_periodoS_home"])=="") { ?>btn-outline-primary-active<? } ?>">Todo período</button>
                        <button type="button" onclick="javascript:filtrar_data_dashboard('1');" class="btn btn-outline-primary <? if(trim($_SESSION["_periodoS_home"])=="1") { ?>btn-outline-primary-active<? } ?>">24 Horas</button>
                        <button type="button" onclick="javascript:filtrar_data_dashboard('7');" class="btn btn-outline-primary <? if(trim($_SESSION["_periodoS_home"])=="7") { ?>btn-outline-primary-active<? } ?>">7 dias</button>
                        <button type="button" onclick="javascript:filtrar_data_dashboard('30');" class="btn btn-outline-primary <? if(trim($_SESSION["_periodoS_home"])=="30") { ?>btn-outline-primary-active<? } ?>">30 dias</button>
                        <button type="button" onclick="javascript:filtrar_data_dashboard('45');" class="btn btn-outline-primary <? if(trim($_SESSION["_periodoS_home"])=="45") { ?>btn-outline-primary-active<? } ?>">45 dias</button>
                    </div>
                </div>
            </div>

            <div class="<?=$tamanho_do_blocoSet?>">
                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                    <h3 class="page-title" style="margin: 0px 0px 5px 0px;"><?=$rSqlInicial['nome']?></b></h3>
                    <span class="caption-helper"><?=$rSqlInicial['subtitulo']?></span>
                </div>
                <div class="col-md-12" style="margin-bottom:20px;padding-left:0px;padding-right:0px;">
                    <div class="col-md-3 col-md-left">
                        <div class="col-md-12 box_menu box_verde_claro">
                            <h4>
                                <span style="width:100%;font-size:30px;"><div class="box_icon box_back_verde_claro"><i class="far fa-ticket"></i></div>
                                <div style="float:right;color:#000;font-weight:bold;margin-top: -45px;"><?=$nSqlIngressos[0]?></div></span>
                                <span style="width:100%;float:left;font-size:15px;text-align:right;color:#000;">Ingressos Vendidos</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-center">
                        <div class="col-md-12 box_menu box_laranja">
                            <h4>
                                <span style="width:100%;font-size:30px;"><div class="box_icon box_back_laranja" style="padding-left: 8.6px;padding-top: 8.4px;"><i class="far fa-gift-card"></i></div>
                                <div style="float:right;color:#000;font-weight:bold;margin-top: -45px;"><?=$nSqlCortesia[0]?></div></span>
                                <span style="width:100%;float:left;font-size:15px;text-align:right;color:#000;">Cortesias</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-center">
                        <div class="col-md-12 box_menu box_azul_claro">
                            <h4>
                                <span style="width:100%;font-size:30px;"><div class="box_icon box_back_azul_claro" style="padding-left: 8.0px;padding-top: 9.5px;"><i class="far fa-shopping-cart"></i></div>
                                <div style="float:right;color:#000;font-weight:bold;margin-top: -45px;">R$ <?=number_format($rSqlVendas['valor_total'], 2, ',', '.')?></div></span>
                                <span style="width:100%;float:left;font-size:15px;text-align:right;color:#000;">Vendas Totais</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-right">
                        <div class="col-md-12 box_menu box_vermelho_claro">
                            <h4>
                                <span style="width:100%;font-size:30px;"><div class="box_icon box_back_vermelho_claro"><i class="far fa-sensor-alert"></i></div>
                                <div style="float:right;color:#000;font-weight:bold;margin-top: -45px;">0</div></span>
                                <span style="width:100%;float:left;font-size:15px;text-align:right;color:#000;">Chargebacks</span>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-bottom:20px;padding-left:0px;padding-right:0px;">
                    <div class="col-md-3 col-md-left">
                        <div class="col-md-12 box_menu box_verde_claro">
                            <table border="0px" cellpadding="0px" cellspacing="0px" width="100%">
                                <tr>
                                    <td style="font-size:30px;text-align:right;color:#000;font-weight:bold;"><?=$nSqlIngressosBipados[0]?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;font-size:20px;text-align:right;color:#000;">Bipagem de Ingressos</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-3 col-md-center">
                        <div class="col-md-12 box_menu box_verde_claro">
                            <table border="0px" cellpadding="0px" cellspacing="0px" width="100%">
                                <tr>
                                    <td style="font-size:30px;text-align:right;color:#000;font-weight:bold;">R$ <?=number_format($rSqlIngressosEstornos['valor_total'], 2, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;font-size:20px;text-align:right;color:#000;">Estornos: <?=$nSqlIngressosEstornos[0]?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-3 col-md-center">
                        <div class="col-md-12 box_menu box_verde_claro">
                            <table border="0px" cellpadding="0px" cellspacing="0px" width="100%">
                                <tr>
                                    <td style="font-size:30px;text-align:right;color:#000;font-weight:bold;">R$ <?=number_format($TicketMedio, 2, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;font-size:20px;text-align:right;color:#000;">Ticket Médio</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-3 col-md-right">
                        <div class="col-md-12 box_menu box_verde_claro">
                            <table border="0px" cellpadding="0px" cellspacing="0px" width="100%">
                                <tr>
                                    <td style="font-size:20px;color:#000;padding-top: 22px;padding-bottom: 22px;">N/A</td>
                                    <td style="text-align:right;font-size:20px;text-align:right;color:#000;">-</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

                <? if(trim($sysusu_empresaSet)=="" || trim($sysusu_empresaSet)=="0") { ?>
                <div class="col-md-12" style="margin-bottom:20px;padding-left:0px;padding-right:0px;">
                    <div class="col-md-3 col-md-left">
                        <div class="col-md-12 box_menu box_vermelho_claro">
                            <table border="0px" cellpadding="0px" cellspacing="0px" width="100%">
                                <tr>
                                    <td style="font-size:30px;text-align:right;color:#000;font-weight:bold;">R$ <?=number_format($rSqlVendasOnline['valor_total'], 2, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;font-size:15px;text-align:right;color:#000;font-weight:300;">Receita Total Online</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-center">
                        <div class="col-md-12 box_menu box_azul_claro">
                            <table border="0px" cellpadding="0px" cellspacing="0px" width="100%">
                                <tr>
                                    <td style="font-size:30px;text-align:right;color:#000;font-weight:bold;">R$ <?=number_format($rSqlVendasPdvDin['valor_total_taxa_pdv_din'], 2, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;font-size:15px;text-align:right;color:#000;font-weight:300;">Receita Total PDV</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-center">
                        <div class="col-md-12 box_menu box_azul_claro">
                            <table border="0px" cellpadding="0px" cellspacing="0px" width="100%">
                                <tr>
                                    <td style="font-size:30px;text-align:right;color:#000;font-weight:bold;">R$ <?=number_format($rSqlVendasOnline['valor_total'] + $rSqlVendasPdvDin['valor_total_taxa_pdv_din'], 2, ',', '.')?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;font-size:15px;text-align:right;color:#000;font-weight:300;">Receita Total Bruta</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-right">
                        <div class="col-md-12 box_menu box_verde_claro">
                            <h4>
                                <span style="width:100%;font-size:30px;"><div class="box_icon box_back_verde_claro" style="padding-left: 14.0px;padding-top: 9.5px;"><i class="far fa-dollar"></i></div>
                                <div style="float:right;color:#000;font-weight:bold;margin-top: -45px;">R$ <?=number_format($rSqlVendasAdmin['valor_total'], 2, ',', '.')?></div></span>
                                <span style="width:100%;float:left;font-size:15px;text-align:right;color:#000;">Vendas Totais</span>
                            </h4>
                        </div>
                    </div>
                </div>
                <? } ?>

                <div class="col-md-12" style="margin-bottom:20px;padding-left:0px;padding-right:0px;">
                    <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                        <div class="col-md-12 box_menu box_verde_claro">
                            <h4>
                                <span style="width:100%;float:left;font-size:15px;color:#000;font-weight:bold;">Tickets</span>
                            </h4>
                            <div class="col-md-12" style="padding-left:0px;padding-right:0px;margin-top:10px;">
                            	<table border="0" cellpadding="0" cellspacing="0" width="100%">
                                	<tr style="line-height:30px;border-bottom:1px solid #CCC;">
                                    	<? if(trim($_SESSION["_eventosS_home"])=="") { ?>
                                        <td style="width:30%;color:#000;text-align:left;padding-left:10px;padding-right:10px;font-weight:bold;">Evento</td>
                                    	<td style="width:30%;color:#000;text-align:left;padding-left:10px;padding-right:10px;font-weight:bold;">Ticket</td>
                                        <? } else { ?>
                                    	<td style="width:60%;color:#000;text-align:left;padding-left:10px;padding-right:10px;font-weight:bold;">Ticket</td>
                                        <? } ?>
                                    	<td style="text-align:right;color:#000;padding-left:10px;padding-right:10px;font-weight:bold;">Valor</td>
                                    	<td style="text-align:right;color:#000;padding-left:10px;padding-right:10px;font-weight:bold;">Vendidos</td>
                                    	<td style="text-align:right;color:#000;padding-left:10px;padding-right:10px;font-weight:bold;">Cortesia</td>
                                    	<td style="text-align:right;color:#000;padding-left:10px;padding-right:10px;font-weight:bold;">Total</td>
                                    	<td style="text-align:right;color:#000;padding-left:10px;padding-right:10px;font-weight:bold;">Bipados</td>
                                    </tr>
									<?
                                    for ($row = 0; $row < count($rData); $row++) {
                                        $rSql = $rData[$row];
                                    ?>
                                	<tr style="line-height:30px;">
                                    	<? if(trim($_SESSION["_eventosS_home"])=="") { ?>
                                        <td style="width:30%;color:#000;text-align:left;padding-left:10px;padding-right:10px;"><?=$rSql['evento_nome']?></td>
                                    	<td style="width:30%;color:#000;text-align:left;padding-left:10px;padding-right:10px;"><?=$rSql['ingresso_nome']?></td>
                                        <? } else { ?>
                                    	<td style="width:60%;color:#000;text-align:left;padding-left:10px;padding-right:10px;"><?=$rSql['ingresso_nome']?></td>
                                        <? } ?>
                                    	<td style="text-align:right;color:#000;padding-left:10px;padding-right:10px;">R$ <?=number_format($rSql['valor_total'], 2, ',', '.')?></td>
                                    	<td style="text-align:right;color:#000;padding-left:10px;padding-right:10px;"><?=$rSql['total']?></td>
                                    	<td style="text-align:right;color:#000;padding-left:10px;padding-right:10px;"><?=$rSql['total_cortesia']?></td>
                                    	<td style="text-align:right;color:#000;padding-left:10px;padding-right:10px;"><?=$rSql['total'] + $rSql['total_cortesia']?></td>
                                    	<td style="text-align:right;color:#000;padding-left:10px;padding-right:10px;"><?=$rSql['ingresso_bipados']?></td>
                                    </tr>
                                    <? } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-bottom:20px;padding-left:0px;padding-right:0px;">
                    <div class="col-md-6 col-md-left">
                        <div class="col-md-12 box_menu box_verde_claro">
                            <h4>
                                <span style="width:100%;float:left;font-size:15px;color:#000;font-weight:bold;">Bandeiras mais utilizadas</span>
                            </h4>
                            <div class="col-md-12" style="padding-left:0px;padding-right:0px;margin-top:10px;">
                            	<table border="0" cellpadding="0" cellspacing="0" width="100%">
                                	<?

									$strSql = "
										SELECT 
											mod_carrinho.card_bin
										
										FROM 
											carrinho_notificacao AS mod_carrinho 
										
										WHERE
											mod_carrinho.stat='1' AND
											mod_carrinho.forma_de_pagamento='CCR'
											".$filtro_carrinhoSet."
											".$filtroEvento."
											".$filtroEventoData."
	
										GROUP BY
											mod_carrinho.card_bin

										ORDER BY
											mod_carrinho.data ASC

											
									";
									$qSql = mysql_query("".$strSql." ".$limit_filtro." ");
									while($rSql = mysql_fetch_array($qSql)) {
										$strSqlVendas = "
											SELECT
												COUNT(*) AS total,
												count(DISTINCT mod_carrinho.card_bin),
												mod_carrinho.card_bin
											FROM 
												carrinho_notificacao AS mod_carrinho 
											WHERE
												mod_carrinho.stat='1' AND
												mod_carrinho.card_bin='".$rSql['card_bin']."' AND
												mod_carrinho.forma_de_pagamento='CCR'
												".$filtro_carrinhoSet."
												".$filtroEvento."
												".$filtroEventoData."
											GROUP BY
												card_bin WITH ROLLUP
										";
										$rSqlVendas = mysql_fetch_array(mysql_query("".$strSqlVendas.""));
									?>
                                	<tr style="line-height:30px;">
                                    	<td style="text-align:right;"><img src="https://www.popingressos.dev/img/fp/<?=$rSql['card_bin']?>.png" style="width:20px;" /></td>
                                    	<td style="width:100%;color:#000;padding-left:10px;text-transform:capitalize;"><?=$rSql['card_bin']?></td>
                                    	<td style="text-align:right;color:#000;"><?=porcentagem_nx($rSqlVendas['total'],$nSqlIngressos[0]);?>%</td>
                                    </tr>
                                    <? } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-right">
                        <div class="col-md-12 box_menu box_vermelho_claro">
                            <h4>
                                <span style="width:100%;float:left;font-size:15px;color:#000;font-weight:bold;">Progressão de vendas</span>
                            </h4>
                            <div id="chart_progressao_de_vendas"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-bottom:20px;padding-left:0px;padding-right:0px;">
                    <div class="col-md-6 col-md-left">
                        <div class="col-md-12 box_menu box_vermelho_claro">
                            <h4>
                                <span style="width:100%;float:left;font-size:15px;color:#000;font-weight:bold;">Quantidade de parcelas nos cartões de crédito</span>
                            </h4>
                            <div id="chart_parcelas_cartao"></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-right">
                        <div class="col-md-12 box_menu box_vermelho_claro">
                            <h4>
                                <span style="width:100%;float:left;font-size:15px;color:#000;font-weight:bold;">Volume por dia da semana</span>
                            </h4>
                            <div id="chart_volume_por_dia_da_semana"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Resumo geral FIM -->
