<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/chave.php");

$_SESSION['mod'] = "carrinho_notificacao";
$mod = $_SESSION['mod'];
$mod2 = $_SESSION['mod2'];
$where = filtro_tabela();

if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
} else {
	$rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT id,plataforma FROM empresa WHERE id='".$sysusu['empresa']."'"));
	if(trim($rSqlPlataforma['plataforma'])=="" || trim($rSqlPlataforma['plataforma'])=="0") {
		$where = str_replace("empresa='".$sysusu['empresa']."'","plataforma='".$rSqlPlataforma['id']."'",$where);
		$filtro_eventosSet = "( mod_eventos.empresa='".$sysusu['empresa']."' OR mod_eventos.plataforma='".$sysusu['empresa']."') ";
	} else {
		$where = str_replace("empresa='".$rSqlPlataforma['plataforma']."'","empresa='".$sysusu['empresa']."'",$where);
		$filtro_eventosSet = " mod_eventos.empresa='".$sysusu['empresa']."' ";
	}
}

if(trim($_SESSION[''.$mod.'empresa'])=="") { 
} else {
	$filtro_eventosSet = " mod_eventos.empresa='".$_SESSION[''.$mod.'empresa']."' ";
}

if(trim($_SESSION[''.$mod.'numeroUnico_evento'])=="") { } else {
	$rSqlEvento = mysql_fetch_array(mysql_query("SELECT tickets,lotes FROM eventos WHERE numeroUnico='".$_SESSION[''.$mod.'numeroUnico_evento']."'"));
}

if(trim($_SESSION[''.$mod.'stat'])=="") { } else {
	if(trim($_SESSION[''.$mod.'stat'])=="0") {
		$where = str_replace("stat='0'","forma_de_pagamento='COR'",$where);
	} else if(trim($_SESSION[''.$mod.'stat'])=="1") {
		$where = str_replace("stat='1'","forma_de_pagamento='CCR'",$where);
	}
}

if(trim($where)=="") {
	#$where = " WHERE (mod_".$mod.".tipo_operacao='loja_virtual' OR mod_".$mod.".tipo_operacao='compra_hub' OR mod_".$mod.".tipo_operacao='cobranca_hub' OR mod_".$mod.".tipo_operacao='compra_session') ";
} else {
	#$where = " ".$where." AND (mod_".$mod.".tipo_operacao='loja_virtual' OR mod_".$mod.".tipo_operacao='compra_hub' OR mod_".$mod.".tipo_operacao='cobranca_hub' OR mod_".$mod.".tipo_operacao='compra_session') ";
}

$itens_por_pagina = 50;

if(trim($_GET['pagina'])=="" || trim($_GET['pagina'])=="0") {
	if(trim($_SESSION[''.$mod2.'pagina'])=="" || trim($_SESSION[''.$mod2.'pagina'])=="0") {
		$_SESSION[''.$mod2.'pagina'] = "1";
	} else {
		$_SESSION[''.$mod2.'pagina'] = $_SESSION[''.$mod2.'pagina'];
	}
} else {
	$_SESSION[''.$mod2.'pagina'] = $_GET['pagina'];
}

if(trim($_SESSION[''.$mod2.'pagina'])=="1") {
	$limit_filtro = "LIMIT ".$itens_por_pagina."";
} else {
	$limit_filtro = "LIMIT ".($_SESSION[''.$mod2.'pagina'] - 1) * $itens_por_pagina.",".$itens_por_pagina."";
}
?>

                                    <style>
									@media screen and (min-width:1024px){
										.hide-on-desktop{display:none!important}
										.show-on-desktop{display:block}
									}
									
									@media screen and (max-width:1023px){
										.hide-on-mobile{display:none!important}
										.show-on-mobile{display:block}
									}
                                    </style>
                                    <table class="table table-striped table-bordered table-hover display table-header-fixed" style="background-color:#ffffff;" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                                <th style="width:250px;vertical-align:top;">
                                                <select id="busca_empresa" class="form-control bs-select campo_busca" pesquisa="igual" bd_externo="" data-live-search="true" data-show-subtext="true">
                                                    <option value="">---</option>
                                                    <?
                                                    $qSqlItem = mysql_query("
                                                                            SELECT 
                                                                                mod_empresa.id,
                                                                                mod_empresa.nome
                                                                                 
                                                                            FROM 
                                                                                empresa AS mod_empresa 
                                                                            WHERE
                                                                                (mod_empresa.stat='0' OR mod_empresa.stat='1') ".$filtroEmpresaMod." 
                                                                            ORDER BY 
                                                                                mod_empresa.nome");
                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                    ?>
                                                    <option value="<?= $rSqlItem['id'] ?>" <? if(trim($_SESSION[''.$mod.'empresa'])==trim($rSqlItem['id'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                    <? } ?>
                                                </select>
                                                </th>
                                                <? } ?>
                                                <th style="vertical-align:top;"><input type="text" onKeyPress="return submitarPersoal(event)" style="height: 34px;" pesquisa="igual" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_id" value="<?=$_SESSION[''.$mod.'id']?>"></th>
                                                <th style="vertical-align:top;"><input type="text" onKeyPress="return submitarPersoal(event)" style="height: 34px;" pesquisa="like" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_pessoa_nome" value="<?=$_SESSION[''.$mod.'pessoa_nome']?>"></th>
                                                <th style="vertical-align:top;"><input type="text" onKeyPress="return submitarPersoal(event)" style="height: 34px;" pesquisa="like" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_pessoa_documento" value="<?=$_SESSION[''.$mod.'pessoa_documento']?>"></th>
                                                <th style="width:250px;vertical-align:top;">
                                                <select id="busca_numeroUnico_evento" class="form-control bs-select campo_busca" pesquisa="igual" bd_externo="" data-live-search="true" data-show-subtext="true">
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
                                                                                (mod_eventos.stat='0' OR mod_eventos.stat='1') AND
																				".$filtro_eventosSet."
                                                                            ORDER BY 
                                                                                mod_eventos.nome");
                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                    ?>
                                                    <option value="<?= $rSqlItem['numeroUnico'] ?>" <? if(trim($_SESSION[''.$mod.'numeroUnico_evento'])==trim($rSqlItem['numeroUnico'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                    <? } ?>
                                                </select>
                                                </th>
												<? $numeroUnico_ticketSet = ""; ?>
                                                <? if(trim($_SESSION[''.$mod.'numeroUnico_evento'])=="") { ?> 
                                                <th style="vertical-align:top;"><input type="text" onKeyPress="return submitarPersoal(event)" style="height: 34px;" pesquisa="like" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_ingresso_nome" value="<?=$_SESSION[''.$mod.'ingresso_nome']?>"></th>
                                                <? } else { ?>
                                                <th style="width:250px;vertical-align:top;">
                                                <select id="busca_ingresso_nome" class="form-control bs-select campo_busca" pesquisa="like" bd_externo="" data-live-search="true" data-show-subtext="true">
                                                    <option value="">---</option>
                                                    <?
													$ticketArray = unserialize($rSqlEvento['tickets']);
													$ticketArray = array_sort($ticketArray, 'ticket_data', SORT_ASC);
													foreach ($ticketArray as $key => $value_ticket) {
														if(trim($_SESSION[''.$mod.'ingresso_nome'])==trim($value_ticket['ticket_nome'])) {
															$numeroUnico_ticketSet = $value_ticket['numeroUnico'];
														}
                                                    ?>
                                                    <option value="<?= $value_ticket['ticket_nome'] ?>" <? if(trim($_SESSION[''.$mod.'ingresso_nome'])==trim($value_ticket['ticket_nome'])) { echo " selected"; } ?>><?=$value_ticket['ticket_nome']?></option>
                                                    <? } ?>
                                                </select>
                                                </th>
                                                <? } ?>

                                                <? if(trim($numeroUnico_ticketSet)=="") { ?> 
                                                <th style="vertical-align:top;"><input type="number" onKeyPress="return submitarPersoal(event)" style="height: 34px;" pesquisa="like" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_lote_nome" value="<?=$_SESSION[''.$mod.'lote_nome']?>"></th>
                                                <? } else { ?>
                                                <th style="width:250px;vertical-align:top;">
                                                <select id="busca_lote_nome" class="form-control bs-select campo_busca" pesquisa="like" bd_externo="" data-live-search="true" data-show-subtext="true">
                                                    <option value=""></option>
                                                    <?
													$loteArray = unserialize($rSqlEvento['lotes']);
													$loteArray = array_sort($loteArray, 'lote', SORT_ASC);
													foreach ($loteArray as $key => $value_lote) {
														if(trim($numeroUnico_ticketSet)==trim($value_lote['numeroUnico_ticket'])) {
                                                    ?>
                                                    <option value="<?= $value_lote['lote'] ?>" <? if(trim($_SESSION[''.$mod.'lote_nome'])==trim($value_lote['lote'])) { echo " selected"; } ?>><?=$value_lote['lote']?>º Lote</option>
														<? } ?>
                                                    <? } ?>
                                                </select>
                                                </th>
                                                <? } ?>

                                                <th style="vertical-align:top;">
                                                <input type="text" onkeypress="javascript:mascara(this,moeda);" style="height: 34px;margin-bottom:5px;" pesquisa="valor_de" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_valor_subtotal_de" placeholder="De" value="<?=$_SESSION[''.$mod.'valor_subtotal_de']?>">
                                                <input type="text" onkeypress="javascript:mascara(this,moeda);" style="height: 34px;" pesquisa="valor_ate" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_valor_subtotal_ate" placeholder="Até" value="<?=$_SESSION[''.$mod.'valor_subtotal_ate']?>">
                                                </th>
                                                <? if(trim($rSqlPlataforma['plataforma'])=="" || trim($rSqlPlataforma['plataforma'])=="0") { ?>
                                                <th style="vertical-align:top;">
                                                <input type="text" onkeypress="javascript:mascara(this,moeda);" style="height: 34px;margin-bottom:5px;" pesquisa="valor_de" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_valor_total_de" placeholder="De" value="<?=$_SESSION[''.$mod.'valor_total_de']?>">
                                                <input type="text" onkeypress="javascript:mascara(this,moeda);" style="height: 34px;" pesquisa="valor_ate" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_valor_total_ate" placeholder="Até" value="<?=$_SESSION[''.$mod.'valor_total_ate']?>">
                                                </th>
                                                <? } ?>
                                                <th style="vertical-align:top;">
                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy"  data-date="">
                                                        <input type="text" class="form-control input-sm campo_busca" pesquisa="data_de" bd_externo="" id="busca_data_de" placeholder="De" value="<?=$_SESSION[''.$mod.'data_de']?>" style="height:34px;">
                                                        <span class="input-group-btn">
                                                            <button class="btn" type="button"><i class="fa fa-calendar"></i></button>
                                                        </span>
                                                    </div>

                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy"  data-date="">
                                                        <input type="text" class="form-control input-sm campo_busca" pesquisa="data_ate" bd_externo="" id="busca_data_ate" placeholder="Até" value="<?=$_SESSION[''.$mod.'data_ate']?>" style="height:34px;">
                                                        <span class="input-group-btn">
                                                            <button class="btn" type="button"><i class="fa fa-calendar"></i></button>
                                                        </span>
                                                    </div>
                                                </th>
                                                <th style="vertical-align:top;">
                                                <select id="busca_stat" class="form-control campo_busca" pesquisa="igual" bd_externo="">
                                                    <option value="" <? if(trim($_SESSION[''.$mod.'stat'])=="") { echo " selected"; } ?>></option>
                                                    <option value="0" <? if(trim($_SESSION[''.$mod.'stat'])=="0") { echo " selected"; } ?>>CORTESIA</option>
                                                    <option value="1" <? if(trim($_SESSION[''.$mod.'stat'])=="1") { echo " selected"; } ?>>PAGO</option>
                                                    <option value="3" <? if(trim($_SESSION[''.$mod.'stat'])=="3") { echo " selected"; } ?>>ESTORNADO</option>
                                                    <option value="5" <? if(trim($_SESSION[''.$mod.'stat'])=="5") { echo " selected"; } ?>>CHARGEBACK</option>
                                                    <option value="6" <? if(trim($_SESSION[''.$mod.'stat'])=="6") { echo " selected"; } ?>>EM ANÁLISE</option>
                                                    <option value="7" <? if(trim($_SESSION[''.$mod.'stat'])=="7") { echo " selected"; } ?>>RECUSADA</option>
                                                </select>
                                                </th>
                                                <th class="hide-on-mobile" style="vertical-align:top;"></th>
                                                <th class="hide-on-mobile" style="vertical-align:top;"></th>
                                                <th style="vertical-align:top;">
                                                <button type="button" onclick="javascript:filtra_itens();" style="width:100%;margin-bottom:3px;" class="btn default"> Filtrar </button>
                                                <button type="button" onclick="javascript:filtra_limpa();" style="width:100%;" class="btn btn-default"> Limpar </button>
                                                </th>
                                            </tr>

                                            <tr>
                                                <? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                                <th style="width:250px;">Empresa</th>
                                                <? } ?>
                                                <th style="width:110px;">#ID</th>
                                                <th>Pessoa</th>
                                                <th style="width:200px;">Documento</th>
                                                <th style="width:110px;">Evento</th>
                                                <th style="width:110px;">Ticket</th>
                                                <th style="width:110px;">Lote</th>
                                                <th style="width:110px;">Valor S/ Taxa</th>
                                                <? if(trim($rSqlPlataforma['plataforma'])=="" || trim($rSqlPlataforma['plataforma'])=="0") { ?>
                                                <th style="width:110px;">Valor C/ Taxa</th>
                                                <? } ?>
                                                <th style="width:170px;">Data da Compra</th>
                                                <th style="width:180px;">Status</th>
                                                <th style="width:55px;"></th>
                                                <th style="width:55px;"></th>
                                                <th style="width:95px;"></th>
                                            </tr>

                                        </thead>

										<? $campoSqlGet = $lista_campo_sql; ?>
										<input type="hidden" id="lista_campo_sql" value="<?=$campoSqlGet?>" />
                                        <tbody>
											<? if(trim($_SESSION[''.$mod.'busca'])=="") { ?>
                                            <tr id_linha="<?=$rSql['id']?>" cor_anterior="<?=$cor_anterior_set?>" <?=$style_set?> role="row">
                                            	<td colspan="99" style="text-align:center;">Você precisa realizar um filtro para exibir os itens</td>
                                            </tr>
                                            <? } else { ?>
											<?
											// Salva lista de usuários para consulta posterior, evitando múltiplos acessos a tabela de usuários a cada linha da listagem
											$users = getListaDeUsuarios();

											$strSql = "
												SELECT 
													mod_".$mod.".empresa,
													mod_".$mod.".id,
													mod_".$mod.".numeroUnico,
													mod_".$mod.".objetoGlobal,
													mod_".$mod.".dataModificacao AS dataModificacao2,
													mod_".$mod.".data AS data2,
													
													mod_".$mod.".valor_subtotal,
													mod_".$mod.".valor_total,

													mod_".$mod.".evento_nome AS evento_nome,
													mod_".$mod.".ingresso_nome AS ingresso_nome,
													mod_".$mod.".ingresso_data AS ingresso_data,
													mod_".$mod.".lote_nome AS lote_nome,

													mod_".$mod.".pessoa_nome AS pessoa_nome,
													mod_".$mod.".pessoa_documento AS pessoa_documento,
													mod_".$mod.".pessoa_telefone AS pessoa_telefone,
													mod_".$mod.".pessoa_email AS pessoa_email,
													mod_".$mod.".forma_de_pagamento AS forma_de_pagamento,
													mod_".$mod.".confirmado AS confirmado,
													mod_".$mod.".dataConfirmado AS dataConfirmado,
													mod_".$mod.".device AS device,
													mod_".$mod.".stat AS stat,
													mod_".$mod.".label AS label,

													mod_validador.nome AS validador_nome,

													mod_carrinho.pessoa_nome AS comprador_nome,
													mod_carrinho.pessoa_documento AS comprador_documento,
													mod_carrinho.dataObjeto,
													mod_carrinho.objeto_carrinho,
													mod_carrinho.tipo_operacao,
													mod_carrinho.pago,
													mod_carrinho.dataModificacao,
													mod_carrinho.data,

													mod_empresa.nome AS empresa_nome
												
												FROM 
													".$mod." AS mod_".$mod." 
												LEFT JOIN 
													sysusu AS mod_validador ON (mod_validador.numeroUnico = mod_".$mod.".numeroUnico_validador)
												LEFT JOIN 
													empresa AS mod_empresa ON (mod_empresa.id = mod_".$mod.".empresa)
												LEFT JOIN 
													carrinho AS mod_carrinho ON (mod_carrinho.numeroUnico_pai = mod_".$mod.".numeroUnico_pai)
												
												".$where."
			
												GROUP BY
													mod_".$mod.".id

												ORDER BY
													mod_".$mod.".data DESC

													
											";
													  
											$strSQL_N = "
												SELECT 
													COUNT(*)
												
												FROM 
													".$mod." AS mod_".$mod." 
												LEFT JOIN 
													sysusu AS mod_validador ON (mod_validador.numeroUnico = mod_".$mod.".numeroUnico_validador)
												LEFT JOIN 
													empresa AS mod_empresa ON (mod_empresa.id = mod_".$mod.".empresa)
												LEFT JOIN 
													pessoas AS mod_comprador ON (mod_comprador.numeroUnico = mod_".$mod.".numeroUnico_pessoa)
												
												".$where."";
											$nSql = mysql_fetch_row(mysql_query($strSQL_N));
											
											if($nSql[0]==0) {
											?>
                                            <tr id_linha="<?=$rSql['id']?>" cor_anterior="<?=$cor_anterior_set?>" <?=$style_set?> role="row">
                                            	<td colspan="99" style="text-align:center;">Sem itens para exibir</td>
                                            </tr>
											<?
											} else {
                                            $qSql = mysql_query("".$strSql." ".$limit_filtro." ");
                                            while($rSql = mysql_fetch_array($qSql)) {

												$_SESSION['numeroUnicoGerado'] = "";

												$idSend = $rSql['id'];
												if(trim($rSql['empresa'])=="" || trim($rSql['empresa'])=="0") {
													$empresaSet = "<i>Sem empresa setada</i>";
												} else {
													$empresaSet = "".$rSql['empresa_nome']."";
												}

												$statusDataDaCompraSet = statusDataDaCompraSimples($rSql,"carrinho_notificacao");
												$statusDataDaCompraCorSet = $statusDataDaCompraSet['cor'];
												$statusDataDaCompraTxtSet = $statusDataDaCompraSet['txt'];

												$comprador_nomeTxt = "".$rSql['pessoa_nome']."";

												if(trim($rSql['data'])=="") {
													$rSql['data'] = "".$rSql['data2']."";
												} else {
													$rSql['data'] = "".$rSql['data']."";
												}

												if(trim($rSql['dataModificacao'])=="") {
													$rSql['dataModificacao'] = "".$rSql['dataModificacao2']."";
												} else {
													$rSql['dataModificacao'] = "".$rSql['dataModificacao']."";
												}

												$documentoSet = "".mascaraCpf($rSql['pessoa_documento'])."";
												$documento_compradorSet = "".mascaraCpf($rSql['comprador_documento'])."";

												if(trim($rSql['comprador_whatsapp'])=="") {
													if(trim($rSql['comprador_whatsapp'])=="") {
														$telefoneTxt = "Não informado";
													} else {
														$telefoneTxt = "".$rSql['comprador_telefone']."";
													}
												} else {
													$telefoneTxt = "".$rSql['comprador_whatsapp']."";
												}

												if(trim($rSql['forma_de_pagamento'])=="BOLETO") {
													$formaDePagamentoTxtSet = "Boleto";
												} else if(trim($rSql['forma_de_pagamento'])=="CCR") {
													$formaDePagamentoTxtSet = "Cartão de Crédito";
												} else if(trim($rSql['forma_de_pagamento'])=="CCD") {
													$formaDePagamentoTxtSet = "Cartão de Débito";
												} else if(trim($rSql['forma_de_pagamento'])=="DIN") {
													$formaDePagamentoTxtSet = "Dinheiro";
												} else if(trim($rSql['forma_de_pagamento'])=="TEF") {
													$formaDePagamentoTxtSet = "Transferência";
												}

												if(trim($rSql['carrinho_pedido_valor_troco'])=="" || trim($rSql['carrinho_pedido_valor_troco'])=="") {
													$trocoTxt = "Não";
												} else {
													$trocoTxt = "Troco para R$ ".number_format($rSql['carrinho_pedido_valor_troco'], 2, ',', '.')."";
												}
												
												if($rSql['data']>'2021-09-11 18:00:00') {
													#$rSql['valor_subtotal'] = $rSql['valor_subtotal'] - ($rSql['valor_subtotal'] * 0.10);
													$rSql['valor_subtotal'] = $rSql['valor_subtotal'];
												} else {
													$rSql['valor_subtotal'] = $rSql['valor_subtotal'];
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
												
												if (strripos($_SESSION["".$mod."ids_selecionados"], "|".$rSql['id']."|") === false) { $checked_set=""; } else { $checked_set = " checked=\"checked\" "; }
                                            ?>
                                            <tr id_linha="<?=$rSql['id']?>" cor_anterior="<?=$cor_anterior_set?>" <?=$style_set?> role="row">
                                                <? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                                <td style="vertical-align:middle;"><?=$empresaSet?></td>
                                                <? } ?>
                                                <td style="vertical-align:middle;"><?=$rSql['id']?></td>
                                                <td style="vertical-align:middle;"><?=$comprador_nomeTxt?></td>
                                                <td style="vertical-align:middle;"><?=$documentoSet?></td>
                                                <td style="vertical-align:middle;"><?=$rSql['evento_nome']?></td>
                                                <td style="vertical-align:middle;"><?=$rSql['ingresso_nome']?></td>
                                                <td style="vertical-align:middle;"><?=$rSql['lote_nome']?></td>
                                                <td style="vertical-align:middle;">R$ <?=number_format($rSql['valor_subtotal'], 2, ',', '.')?></td>
                                                <? if(trim($rSqlPlataforma['plataforma'])=="" || trim($rSqlPlataforma['plataforma'])=="0") { ?>
                                                <td style="vertical-align:middle;">R$ <?=number_format($rSql['valor_total'], 2, ',', '.')?></td>
                                                <? } ?>
                                                <td style="vertical-align:middle;"><?=ajustaDataReturn($rSql['data'],"d/m/Y");?></td>
                                                <td style="vertical-align:middle;">
                                                    <a href="javascript:void(0);" class="btn btn-xs" style="background-color:<?=$statusDataDaCompraCorSet?>;width:100%;text-align:center;color:#FFF;" 
                                                       title="<?=$statusDataDaCompraTxtSet?>"> <?=$statusDataDaCompraTxtSet?> </a>
                                                </td>
                                                <td style="vertical-align:middle;" class="block_check_click">
                                                    <? if(trim($rSql['device'])=="PDVWEB" || trim($rSql['device'])=="PDVMAQUINETA") { ?>
														<? if(trim($rSql['stat'])=="1") { ?>
                                                        <span class="red-sunglo btn btn-sm" style="width:100%" onclick="javascript:estorna_ingresso_unico_pdv('<?=$rSql['numeroUnico']?>');" title="Estornar Ingresso">Estornar Ingresso</span> 
                                                        <? } else { ?>
                                                        <span class="gray btn btn-sm" style="width:100%;background-color:#666;color:#FFF;" onclick="javascript:alert('Não é possível estornar este ingresso novamente!');" title="Estornar Ingresso">Estornar Ingresso</span> 
                                                        <? } ?>
                                                    <? } else { ?>
                                                    <span class="gray btn btn-sm" style="width:100%;background-color:#666;color:#FFF;" style="width:100%" onclick="javascript:alert('Não é possível estornar este ingresso!');" title="Estornar Ingresso">Estornar Ingresso</span> 
                                                    <? } ?>
                                                </td>
                                                <td style="vertical-align:middle;" class="block_check_click">
                                                    <span class="green btn btn-sm" style="width:100%" onclick="javascript:reenviar_ingresso_unico('<?=$rSql['numeroUnico']?>');" title="Renviar Ingresso">Reenviar Ingresso</span> 
                                                </td>
                                                <td style="vertical-align:middle;" class="block_check_click">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm blue-madison" 
                                                        href="javascript:void(0);" 
                                                        data-toggle="modal" data-target="#modal-carrinho-<?=$rSql['numeroUnico']?>"
                                                        title="Visualizar Detalhes"><i class="fa fa-eye"></i></a>
                                                    </div>

                                                    <!--begin::Modal VISUALIZAR COMPRA <?=$rSql['numeroUnico']?>-->
                                                    <div class="modal fade" id="modal-acompanhamento-<?=$rSql['numeroUnico']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Acompanhamento do Pagamento</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-carrinho-<?=$rSql['numeroUnico']?>">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table display" style="background-color:#ffffff;" cellspacing="0" width="550px">
                                                                <tr>
                                                                    <td colspan="3" style="background-color:#333;color:#FFF;">Dados da Compra</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3">
                                                                    	<table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Nome do Comprador</td>
                                                                                <td><?=$rSql['comprador_nome']?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:150px;font-weight:bold;padding-right:5px;">Data da Compra</td>
                                                                                <td style="width:400px;padding-right:5px;"><?=ajustaDataReturn($rSql['data'],"d/m/Y")?></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3" style="background-color:#333;color:#FFF;">Time Line</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3">
                                                                    	<table border="0" cellspacing="0" cellpadding="0" width="100%">
																			<?
                                                                            $carrinhoArray = unserialize($rSql['dataObjeto']);
                                                                            $carrinhoArray = json_decode(json_encode($carrinhoArray), true);
                                                                            foreach ($carrinhoArray as $key => $value) {
																				$statusDataDaCompraSet = statusDataDaCompra($rSql,$value['info'],$_SESSION['mod']);
																				$btnStat = $statusDataDaCompraSet['btn'];
																				$txtStat = $statusDataDaCompraSet['txt'];
                                                                            ?>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:450px;font-weight:bold;padding:15px 5px 15px 0px;"><?=$txtStat?></td>
                                                                                <td style="width:200px;padding:15px 5px 15px 0px;"><?=ajustaDataReturn($value['data'],"d/m/Y")?></td>
                                                                                <td><?=$btnStat?></td>
                                                                            </tr>
                                                                            <? } ?>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <!--begin::Modal VISUALIZAR COMPRA <?=$rSql['numeroUnico']?>-->
                                                    <div class="modal fade" id="modal-carrinho-<?=$rSql['numeroUnico']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detalhes da COMPRA #<?=$rSql['id']?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-carrinho-<?=$rSql['numeroUnico']?>">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table display" style="background-color:#ffffff;" cellspacing="0" width="100%">
                                                                <tr>
                                                                    <td colspan="5" style="background-color:#333;color:#FFF;">Dados do Comprador</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5">
                                                                    	<table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Nome do Comprador</td>
                                                                                <td><?=$rSql['comprador_nome']?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">CPF</td>
                                                                                <td><?=$documento_compradorSet?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Telefone</td>
                                                                                <td><?=$telefoneTxt?></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
																<? if(trim($rSql['confirmado'])=="1") { ?>
                                                                <tr>
                                                                    <td colspan="5" style="background-color:#333;color:#FFF;">Dados de Confirmação e Validação</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5">
                                                                    	<table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Nome do Validador</td>
                                                                                <td><?=$rSql['validador_nome']?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Data da Validacao</td>
                                                                                <td><?=ajustaDataReturn($rSql['dataConfirmado'],"d/m/Y")?></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <? } ?>
                                                                <tr>
                                                                    <td colspan="5" style="background-color:#333;color:#FFF;">Detalhes da Compra</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5">
                                                                    	<table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Forma de Pagamento</td>
                                                                                <td><?=$formaDePagamentoTxtSet?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Data da Compra</td>
                                                                                <td><?=ajustaDataReturn($rSql['dataModificacao'],"d/m/Y")?></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5" style="background-color:#333;color:#FFF;">Itens da Compra</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5">
                                                                    	<table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Evento</td>
                                                                                <td><?=$rSql['evento_nome']?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Ticket</td>
                                                                                <td><?=$rSql['ingresso_nome']?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Data do Ticket</td>
                                                                                <td><?=ajustaDataReturn($rSql['ingresso_data'],"d/m/Y")?></td>
                                                                            </tr>
                                                                        	<?
																			if(trim($rSql['lote_nome'])=="") { 
																				$rSql['lote_nome'] = "";
																			} else {
																				if(strrpos($rSql['lote_nome'],"Lote") === false) {
																					$rSql['lote_nome'] = "".$rSql['lote_nome']."° Lote";
																				} else {
																					$rSql['lote_nome'] = "".$rSql['lote_nome']."";
																				}
																			}
																			?>
                                                                            <tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Lote</td>
                                                                                <td><?=$rSql['lote_nome']?></td>
                                                                            </tr>
                                                                        	<? if(trim($rSql['label'])=="") { } else { ?>
                                                                            <tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Cadeira</td>
                                                                                <td><?=$rSql['label']?></td>
                                                                            </tr>
                                                                            <? } ?>
                                                                        </table>
                                                                    </td>
                                                                </tr>

																<?
																$detalheCompraSet = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"650px\">";
																$carrinhoDetalhadoArray = unserialize($rSql['objeto_carrinho']);
																foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
																	if(trim($valueDetalhado['pessoa_documento'])==trim($rSql['pessoa_documento'])) {
																		if(trim($valueDetalhado['tipo'])=="evento") {
																			if(trim($valueDetalhado['lote'])=="") { 
																				$loteTxtSet = "";
																			} else {
																				if(strrpos($valueDetalhado['lote'],"Lote") === false) {
																					$loteTxtSet = "".$valueDetalhado['lote']."° Lote";
																				} else {
																					$loteTxtSet = "".$valueDetalhado['lote']."";
																				}
																			}
																			$valueDetalhado['compra_descricao'] = "<strong>".$valueDetalhado['evento_nome']."</strong><br>".$valueDetalhado['ingresso_nome']."<br>".$loteTxtSet."";
																			$valueDetalhado['pessoa_descricao'] = "<strong>".$valueDetalhado['pessoa_nome']."</strong><br />".$valueDetalhado['pessoa_email']."<br />".mascaraCpf($valueDetalhado['pessoa_documento'])."<br />".$valueDetalhado['pessoa_telefone']."";
														
																			if(trim($valueDetalhado['imagem'])=="") {
																				$imagem_de_capaSet = "";
																			} else {
																				$imagem_de_capaSet = "<img src=\"https://".$valueDetalhado['imagem']."\" style=\"max-width:100%;border-radius:100% !important;\">";
																			}
																		} else if(trim($valueDetalhado['tipo'])=="produto") {
																			$valueDetalhado['compra_descricao'] = "<strong>".$valueDetalhado['produto_nome']."</strong>";
																			$valueDetalhado['pessoa_descricao'] = "<strong>".$valueDetalhado['pessoa_nome']."</strong><br />".$valueDetalhado['pessoa_email']."<br />".$valueDetalhado['pessoa_telefone']."";
																			$imagem_de_capaSet = "https://".$rSqlEmpresa['dominio']."/admin/files/produtos/".$valueDetalhado['numeroUnico_produto']."/imagem_de_icone.png";
																		}
														
																		$detalheCompraSet .= "<tr style=\"background-color:".$corSet.";\">";
																		$detalheCompraSet .= "   <td style=\"padding-top: 5px;padding-bottom: 5px;padding-left: 5px;width:30%;font-size: 16px;".$font_familySet.";\">".$valueDetalhado['compra_descricao']."</td>";
																		$detalheCompraSet .= "   <td style=\"padding-top: 5px;padding-bottom: 5px;padding-left: 5px;width:40%;font-size: 16px;".$font_familySet.";\">".$valueDetalhado['pessoa_descricao']."</td>";
																		$detalheCompraSet .= "   <td style=\"padding-top: 5px;padding-bottom: 5px;padding-right: 5px;width:30%;font-size: 16px;".$font_familySet.";text-align:right;\"><strong>1x R$ ".number_format($valueDetalhado['valor_venda'], 2, ',', '.')."</strong></td>";
																		$detalheCompraSet .= "</tr>";
																	}
																}
																$detalheCompraSet .= "</table>";
                                                                ?>
                                                                <tr style="background-color:<?=$corSet?>;" role="row">
                                                                    <td colspan="5" style="vertical-align:middle;"><?=$detalheCompraSet?></td>
                                                                </tr>

																<? if(trim($rSql['device'])=="PDVWEB" && trim($rSql['stat'])=="1") { ?>
                                                                <tr>
                                                                	<td colspan="5" style="padding:0px;border:0px;">
                                                                        <button type="button" class="btn green input-label" style="margin-left: 0px;margin-top:10px;" onclick="javascript:cancela_ingresso_pdv('<?=$rSql['numeroUnico']?>');" >CANCELAR INGRESSO DE PDV?</button>
                                                                    </td>
                                                                </tr>
                                                                <? } ?>
                                                                
                                                                <? if(trim($btnStat)!="") { ?>
                                                                <tr>
                                                                    <td colspan="5" style="text-align:right;padding:0px;"><?=$btnStat?></td>
                                                                </tr>
                                                                <tr id="dados-estorno-<?=$rSql['numeroUnico']?>" style="display:none;">
                                                                	<td colspan="5" style="padding:0px;border:0px;">
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-12" style="text-align:left;padding:0px;">Login do ADMIN</label>
                                                                            <div class="col-md-12" style="padding:0px;">
                                                                                <input type="text" id="login-<?=$rSql['numeroUnico']?>" class="form-control" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-12" style="text-align:left;padding:0px;">Senha do ADMIN</label>
                                                                            <div class="col-md-12" style="padding:0px;">
                                                                                <input type="text" id="senha-<?=$rSql['numeroUnico']?>" class="form-control" />
                                                                            </div>
                                                                        </div>
                                                                        <button type="button" class="btn green input-label" style="margin-left: 0px;margin-top:10px;" onclick="javascript:confirmar_estorno('<?=$rSql['numeroUnico']?>');" >CONFIRMA O ESTORNO?</button>
                                                                        <button type="button" class="btn yellow-gold input-label" style="margin-left: 0px;margin-top:10px;float:right;margin-right:0px;" onclick="javascript:cancelar_estorno('<?=$rSql['numeroUnico']?>');" >CANCELAR</button>
                                                                    </td>
                                                                </tr>
                                                                <? } ?>
                                                            </table>
                                                            
                                                        </div>
                                                    </div>
												</td>
    
                                            </tr>
                                            <? } ?>
                                            <? } ?>
                                            <? } ?>
                                        </tbody>
                                    </table>

                                    <? if($nSql[0]==0) { } else { ?>
                                    <div class="row">
                                        <div class="col-md-2">

                                        </div>
                                        <div class="col-md-8" id="paginacao" style="text-align:center;">
                                            <? include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/lib/paginacao.php"); ?>
                                        </div>
                                        <div class="col-md-2" id="paginacao">
                                        </div>
                                    </div>
                                    <? } ?>

