<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/chave.php");

$_SESSION['mod'] = "carrinho";
$mod = $_SESSION['mod'];
$mod2 = $_SESSION['mod2'];
$where = filtro_tabela();

if(trim($where)=="") {
	$where = " WHERE (mod_".$mod.".tipo_operacao='loja_virtual' OR 
	                  mod_".$mod.".tipo_operacao='compra_hub' OR 
					  mod_".$mod.".tipo_operacao='cobranca_hub' OR 
					  mod_".$mod.".tipo_operacao='compra_session' OR 
					  mod_".$mod.".tipo_operacao='pagamento_hub') ";
} else {
	$where = " ".$where." AND 
	                 (mod_".$mod.".tipo_operacao='loja_virtual' OR 
					  mod_".$mod.".tipo_operacao='compra_hub' OR 
					  mod_".$mod.".tipo_operacao='cobranca_hub' OR 
					  mod_".$mod.".tipo_operacao='compra_session' OR 
					  mod_".$mod.".tipo_operacao='pagamento_hub') ";
}

if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
} else {
	$rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT plataforma FROM empresa WHERE id='".$sysusu['empresa']."'"));
	if(trim($rSqlPlataforma['plataforma'])=="" || trim($rSqlPlataforma['plataforma'])=="0") {
	} else { 
		$where = str_replace("mod_".$mod.".empresa='".$sysusu['empresa']."'","( mod_".$mod.".empresa='".$sysusu['empresa']."' OR mod_".$mod.".empresaObjeto LIKE '%empresa_".$sysusu['empresa']."%' )",$where);
	}
}


#echo "[".$where."] <br>";
#echo "[".$rSqlPlataforma['plataforma']."]";

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
                                                <th style="vertical-align:top;"><input type="text" onKeyPress="return submitarPersoal(event)" style="height: 34px;" pesquisa="igual" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_tid" value="<?=$_SESSION[''.$mod.'tid']?>"></th>
                                                <th style="vertical-align:top;"><input type="text" onKeyPress="return submitarPersoal(event)" style="height: 34px;" pesquisa="like" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_pessoa_nome" value="<?=$_SESSION[''.$mod.'pessoa_nome']?>"></th>
                                                <th style="vertical-align:top;"><input type="text" onKeyPress="return submitarPersoal(event)" style="height: 34px;" pesquisa="like" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_pessoa_documento" value="<?=$_SESSION[''.$mod.'pessoa_documento']?>"></th>
                                                <th style="vertical-align:top;"><input type="text" onKeyPress="return submitarPersoal(event)" style="height: 34px;" pesquisa="like" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_pessoa_email" value="<?=$_SESSION[''.$mod.'pessoa_email']?>"></th>
                                                <th style="vertical-align:top;">
                                                <input type="text" onkeypress="javascript:mascara(this,moeda);" style="height: 34px;margin-bottom:5px;" pesquisa="valor_de" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_valor_subtotal_de" placeholder="De" value="<?=$_SESSION[''.$mod.'valor_subtotal_de']?>">
                                                <input type="text" onkeypress="javascript:mascara(this,moeda);" style="height: 34px;" pesquisa="valor_ate" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_valor_subtotal_ate" placeholder="Até" value="<?=$_SESSION[''.$mod.'valor_subtotal_ate']?>">
                                                </th>
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
                                                    <option value="1" <? if(trim($_SESSION[''.$mod.'stat'])=="1") { echo " selected"; } ?>>PAGO</option>
                                                    <option value="3" <? if(trim($_SESSION[''.$mod.'stat'])=="3") { echo " selected"; } ?>>ESTORNADO</option>
                                                    <option value="5" <? if(trim($_SESSION[''.$mod.'stat'])=="5") { echo " selected"; } ?>>CHARGEBACK</option>
                                                    <option value="6" <? if(trim($_SESSION[''.$mod.'stat'])=="6") { echo " selected"; } ?>>EM ANÁLISE</option>
                                                    <option value="7" <? if(trim($_SESSION[''.$mod.'stat'])=="7") { echo " selected"; } ?>>RECUSADA</option>
                                                    <option value="999" <? if(trim($_SESSION[''.$mod.'stat'])=="999") { echo " selected"; } ?>>ERRO</option>
                                                </select>
                                                </th>
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
                                                <th style="width:110px;">TID da Operação</th>
                                                <th>Pessoa</th>
                                                <th style="width:200px;">Documento</th>
                                                <th style="width:200px;">E-mail</th>
                                                <th style="width:110px;">Valor</th>
                                                <th style="width:170px;">Data da Compra</th>
                                                <th style="width:180px;">Status</th>
                                                <th style="width:95px;"></th>
                                            </tr>

                                        </thead>

										<? $campoSqlGet = $lista_campo_sql; ?>
										<input type="hidden" id="lista_campo_sql" value="<?=$campoSqlGet?>" />
                                        <tbody>
											<?
											// Salva lista de usuários para consulta posterior, evitando múltiplos acessos a tabela de usuários a cada linha da listagem
											$users = getListaDeUsuarios();

											$strSql = "
												SELECT 
													mod_".$mod.".empresa,
													mod_".$mod.".id,
													mod_".$mod.".numeroUnico,
													mod_".$mod.".numeroUnico_pai,
													mod_".$mod.".cod_contrato,
													mod_".$mod.".valor_subtotal,
													mod_".$mod.".valor_total,
													mod_".$mod.".dataObjeto,
													mod_".$mod.".objeto_carrinho_detalhado,
													mod_".$mod.".objeto_resposta_gateway,
													mod_".$mod.".objetoRetorno,
													mod_".$mod.".tipo_operacao,
													mod_".$mod.".tid,
													mod_".$mod.".forma_de_pagamento,
													mod_".$mod.".pago,
													mod_".$mod.".stat,
													mod_".$mod.".dataModificacao,
													mod_".$mod.".data,

													mod_".$mod.".pessoa_nome AS pessoa_nome,
													mod_".$mod.".pessoa_documento AS pessoa_documento,
													mod_".$mod.".pessoa_email AS pessoa_email,
													mod_".$mod.".whatsapp AS whatsapp,

													mod_empresa.nome AS empresa_nome
												
												FROM 
													".$mod." AS mod_".$mod." 
												LEFT JOIN 
													empresa AS mod_empresa ON (mod_empresa.id = mod_".$mod.".empresa)
												
												".$where."
			
												ORDER BY
													mod_".$mod.".data DESC
													
											";
													  
											$strSQL_N = "
												SELECT 
													COUNT(*)
												
												FROM 
													".$mod." AS mod_".$mod." 
												LEFT JOIN 
													empresa AS mod_empresa ON (mod_empresa.id = mod_".$mod.".empresa)
												
												".$where."";
											$nSql = mysql_fetch_row(mysql_query($strSQL_N));
											
											if($sysusu['id']=="1") {
												#echo "".$strSql." ".$limit_filtro." ";
											}
											
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

												$statusDataDaCompraSet = statusDataDaCompraSimples($rSql);
												$statusDataDaCompraCorSet = $statusDataDaCompraSet['cor'];
												$statusDataDaCompraTxtSet = $statusDataDaCompraSet['txt'];

												$valorTotal = 
												$rSql['valor_subtotal'] + 
												$rSql['valor_taxa_frete_minimo_empresa'] + 
												$rSql['valor_taxa_frete_minimo_cms'] + 
												$rSql['valor_taxa_produto_empresa_km'] + 
												$rSql['valor_taxa_produto_empresa'] + 
												$rSql['valor_taxa_produto_cms_km'] + 
												$rSql['valor_taxa_produto_cms'];

												$tipoDocTxt = "CPF";
												$documentoSet = "".mascaraCpf($rSql['pessoa_documento'])."";

												$formaDePagamentoSet = formaDePagamento($rSql);
												$formaDePagamentoIconeSet = $formaDePagamentoSet['icone'];
												$formaDePagamentoCorSet = $formaDePagamentoSet['cor'];
												$formaDePagamentoTxtSet = $formaDePagamentoSet['txt'];
					
												if(trim($rSql['carrinho_pedido_valor_troco'])=="" || trim($rSql['carrinho_pedido_valor_troco'])=="") {
													$trocoTxt = "Não";
												} else {
													$trocoTxt = "Troco para R$ ".number_format($rSql['carrinho_pedido_valor_troco'], 2, ',', '.')."";
												}
					
												$respGatewayArray = unserialize($rSql['objeto_resposta_gateway']);
												$respGatewayArray = json_decode($respGatewayArray,TRUE);

												$objetoRetornoArray = unserialize($rSql['objetoRetorno']);
												
												if (strripos($_SESSION["".$mod."ids_selecionados"], "|".$rSql['id']."|") === false) { $checked_set=""; } else { $checked_set = " checked=\"checked\" "; }
                                            ?>
                                            <tr id_linha="<?=$rSql['id']?>" cor_anterior="<?=$cor_anterior_set?>" <?=$style_set?> role="row">
                                                <? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                                <td style="vertical-align:middle;"><?=$empresaSet?></td>
                                                <? } ?>
                                                <td style="vertical-align:middle;"><?=$rSql['id']?></td>
                                                <td style="vertical-align:middle;"><?=$rSql['tid']?></td>
                                                <td style="vertical-align:middle;"><?=$rSql['pessoa_nome']?></td>
                                                <td style="vertical-align:middle;"><?=$documentoSet?></td>
                                                <td style="vertical-align:middle;"><?=$rSql['pessoa_email']?></td>
                                                <td style="vertical-align:middle;">R$ <?=number_format($valorTotal, 2, ',', '.')?></td>
                                                <td style="vertical-align:middle;"><?=ajustaDataReturn($rSql['data'],"d/m/Y");?></td>
                                                <td style="vertical-align:middle;">
                                                    <a href="javascript:void(0);" class="btn btn-xs" style="background-color:<?=$statusDataDaCompraCorSet?>;width:100%;text-align:center;color:#FFF;" 
                                                       title="<?=$statusDataDaCompraTxtSet?>"> <?=$statusDataDaCompraTxtSet?> </a>
                                                </td>
                                                <? if(trim($_construtor_sysperm['todos_'.$_SESSION['mod_numeroUnico'].''])==1) { ?>
                                                <td style="vertical-align:middle;">
                                                    <? if(trim($rSql['stat'])=="1" && trim($rSql['pago'])=="1") { ?>
                                                    <a href="javascript:void(0);" 
                                                       data-toggle="modal" data-target="#modal-estorno-<?=$rSql['numeroUnico']?>"
                                                       class="btn btn-xs" style="background-color:#C00;width:100%;text-align:center;color:#FFF;" 
                                                       title="Estornar Compra"> Estornar Compra </a>
                                                    <? } else { ?>
                                                    <a href="javascript:void(0);" 
                                                       onclick="javascript:alert('Compra recusada, não é possível estornar!');"
                                                       class="btn btn-xs" style="background-color:#666;width:100%;text-align:center;color:#FFF;" 
                                                       title="Estornar Compra"> Estornar Compra </a>
                                                    <? } ?>

                                                    <!--begin::Modal ESTORNAR COMPRA <?=$rSql['numeroUnico']?>-->
                                                    <div class="modal fade" id="modal-estorno-<?=$rSql['numeroUnico']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detalhes da COMPRA #<?=$rSql['id']?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-estorno-<?=$rSql['numeroUnico']?>">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        	<div style="max-height: 600px;overflow:auto;">
                                                            <table class="table display" style="background-color:#ffffff;" cellspacing="0" width="100%">
                                                                <tr>
                                                                    <td colspan="8" style="background-color:#333;color:#FFF;">Dados do Comprador</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="8">
                                                                    	<table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Nome</td>
                                                                                <td><?=$rSql['pessoa_nome']?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;"><?=$tipoDocTxt?></td>
                                                                                <td><?=$documentoSet?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">E-mail</td>
                                                                                <td><?=$rSql['pessoa_email']?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Telefone</td>
                                                                                <td><?=$rSql['whatsapp']?></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="8" style="background-color:#333;color:#FFF;">Detalhes da Compra</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="8">
                                                                    	<table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                                            <? if(trim($_construtor_sysperm['todos_'.$_SESSION['mod_numeroUnico'].''])==1) { ?>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Hash da Transação</td>
                                                                                <td><?=$rSql['numeroUnico_pai']?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">TID</td>
                                                                                <td><?=$rSql['tid']?></td>
                                                                            </tr>
                                                                            <? } ?>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Forma de Pagamento</td>
                                                                                <td><?=$formaDePagamentoTxtSet?></td>
                                                                            </tr>
                                                                            <? if(trim($trocoTxt)!="") { ?>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Necessita Troco?</td>
                                                                                <td><?=$trocoTxt?></td>
                                                                            </tr>
                                                                            <? } ?>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Data da Compra</td>
                                                                                <td><?=ajustaDataReturn($rSql['dataModificacao'],"d/m/Y")?></td>
                                                                            </tr>
                                                                            <? if(trim($_construtor_sysperm['todos_'.$_SESSION['mod_numeroUnico'].''])==1 && $rSql['stat']=="7") { ?>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Motivo da Recusa</td>
                                                                                <td><?=$respGatewayArray['returnMessage']?></td>
                                                                            </tr>
                                                                            <? } ?>
                                                                            <? if(trim($_construtor_sysperm['todos_'.$_SESSION['mod_numeroUnico'].''])==1 && $rSql['stat']=="999") { ?>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Motivo do Erro</td>
                                                                                <td><?=$objetoRetornoArray['txtRetorno']?></td>
                                                                            </tr>
                                                                            <? } ?>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <? if(trim($rSql['stat'])=="1" && trim($rSql['pago'])=="1") { ?>
                                                                <tr>
                                                                	<td colspan="8" style="padding:0px;border:0px;">
                                                                    	<select id="porcentagem_<?=$rSql['numeroUnico']?>" class="form-control">
                                                                        	<option value="">Selecione a porcentagem de estorno</option>
                                                                        	<option value="1.00">00%</option>
                                                                        	<option value="0.95">05%</option>
                                                                        	<option value="0.90">10%</option>
                                                                        	<option value="0.85">15%</option>
                                                                        	<option value="0.80">20%</option>
                                                                        	<option value="0.75">25%</option>
                                                                        	<option value="0.70">30%</option>
                                                                        	<option value="0.65">35%</option>
                                                                        	<option value="0.60">40%</option>
                                                                        	<option value="0.55">45%</option>
                                                                        	<option value="0.50">50%</option>
                                                                        	<option value="0.45">55%</option>
                                                                        	<option value="0.40">60%</option>
                                                                        	<option value="0.35">65%</option>
                                                                        	<option value="0.30">70%</option>
                                                                        	<option value="0.25">75%</option>
                                                                        	<option value="0.20">80%</option>
                                                                        	<option value="0.15">85%</option>
                                                                        	<option value="0.10">90%</option>
                                                                        	<option value="0.05">95%</option>
                                                                        	<option value="0.00">100%</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                	<td colspan="8" style="padding:0px;border:0px;">
                                                                        <button type="button" class="btn green input-label" style="margin-left: 0px;margin-top:10px;" onclick="javascript:estornar_carrinho('<?=$rSql['numeroUnico']?>');" >CONFIRMA O ESTORNO?</button>
                                                                        <button type="button" class="btn yellow-gold input-label" style="margin-left: 0px;margin-top:10px;float:right;margin-right:0px;" onclick="javascript:estornar_carrinho_fecha('<?=$rSql['numeroUnico']?>');" >CANCELAR</button>
                                                                    </td>
                                                                </tr>
                                                                <? } ?>
                                                            </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <? } ?>
                                                <td style="vertical-align:middle;" class="block_check_click">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm blue-madison" 
                                                        href="javascript:void(0);" 
                                                        data-toggle="modal" data-target="#modal-carrinho-<?=$rSql['numeroUnico_pai']?>"
                                                        title="Visualizar Detalhes"><i class="fa fa-eye"></i></a>
                                                    </div>

                                                    <!--begin::Modal VISUALIZAR COMPRA <?=$rSql['numeroUnico']?>-->
                                                    <div class="modal fade" id="modal-carrinho-<?=$rSql['numeroUnico_pai']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detalhes da COMPRA #<?=$rSql['id']?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-carrinho-<?=$rSql['numeroUnico_pai']?>">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        	<div style="max-height: 600px;overflow:auto;">
                                                            <table class="table display" style="background-color:#ffffff;" cellspacing="0" width="100%">
                                                                <tr>
                                                                    <td colspan="8" style="background-color:#333;color:#FFF;">Dados do Comprador</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="8">
                                                                    	<table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Nome</td>
                                                                                <td><?=$rSql['pessoa_nome']?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;"><?=$tipoDocTxt?></td>
                                                                                <td><?=$documentoSet?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">E-mail</td>
                                                                                <td><?=$rSql['pessoa_email']?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Telefone</td>
                                                                                <td><?=$rSql['whatsapp']?></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="8" style="background-color:#333;color:#FFF;">Detalhes da Compra</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="8">
                                                                    	<table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                                            <? if(trim($_construtor_sysperm['todos_'.$_SESSION['mod_numeroUnico'].''])==1) { ?>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Hash da Transação</td>
                                                                                <td><?=$rSql['numeroUnico_pai']?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">TID</td>
                                                                                <td><?=$rSql['tid']?></td>
                                                                            </tr>
                                                                            <? } ?>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Forma de Pagamento</td>
                                                                                <td><?=$formaDePagamentoTxtSet?></td>
                                                                            </tr>
                                                                            <? if(trim($trocoTxt)!="") { ?>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Necessita Troco?</td>
                                                                                <td><?=$trocoTxt?></td>
                                                                            </tr>
                                                                            <? } ?>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Data da Compra</td>
                                                                                <td><?=ajustaDataReturn($rSql['dataModificacao'],"d/m/Y")?></td>
                                                                            </tr>
                                                                            <? if(trim($_construtor_sysperm['todos_'.$_SESSION['mod_numeroUnico'].''])==1 && $rSql['stat']=="7") { ?>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Motivo da Recusa</td>
                                                                                <td><?=$respGatewayArray['returnMessage']?></td>
                                                                            </tr>
                                                                            <? } ?>
                                                                            <? if(trim($_construtor_sysperm['todos_'.$_SESSION['mod_numeroUnico'].''])==1 && $rSql['stat']=="999") { ?>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Motivo do Erro</td>
                                                                                <td><?=$objetoRetornoArray['txtRetorno']?></td>
                                                                            </tr>
                                                                            <? } ?>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="8" style="background-color:#333;color:#FFF;">Itens da Compra</td>
                                                                </tr>
																<?
																$detalheCompraSet = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"650px\">";
																$carrinhoDetalhadoArray = unserialize($rSql['objeto_carrinho_detalhado']);
																#var_dump($carrinhoDetalhadoArray);
																foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
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
																		$valueDetalhado['compra_descricao'] = "<strong>".$valueDetalhado['evento_nome']."</strong><br>".$valueDetalhado['ingresso_nome']."<br>".ajustaDataReturn($valueDetalhado['ingresso_data'],"d/m/Y")."<br>".$loteTxtSet."";
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
													
                                                                    if(trim($_construtor_sysperm['todos_'.$_SESSION['mod_numeroUnico'].''])==1) {
																		if(trim($valueDetalhado['pessoa_documento'])=="" && trim($rSql['stat'])=="1" && trim($rSql['pago'])=="1") {
																			$detalheCompraSet .= "<tr style=\"background-color:".$corSet.";border-bottom:1px solid #ccc;\">";
																			$detalheCompraSet .= "<td style=\"padding-top: 5px;padding-bottom: 5px;padding-left: 5px;width:30%;font-size: 16px;".$font_familySet.";\">".$valueDetalhado['compra_descricao']."</td>";
																			$detalheCompraSet .= "<td colspan=\"2\" style=\"text-align:center\">";
																			$detalheCompraSet .= "<input type=\"text\" id=\"pessoa_nome_".$valueDetalhado['numeroUnico']."\" style=\"margin-bottom:3px;margin-top:5px;\" placeholder=\"Digite o nome completo\" class=\"form-control\" />";
																			$detalheCompraSet .= "<input type=\"text\" id=\"pessoa_documento_".$valueDetalhado['numeroUnico']."\" style=\"margin-bottom:3px;\" placeholder=\"Digite o CPF. Apenas números.\" class=\"form-control documento\" />";
																			$detalheCompraSet .= "<input type=\"text\" id=\"pessoa_email_".$valueDetalhado['numeroUnico']."\" style=\"margin-bottom:3px;\" placeholder=\"Digite o E-mail.\" class=\"form-control\" />";
																			$detalheCompraSet .= "<input type=\"text\" id=\"pessoa_telefone_".$valueDetalhado['numeroUnico']."\" style=\"margin-bottom:3px;\" placeholder=\"Digite o Telefone. Apenas números com DDD.\" class=\"form-control telefone\" />";
																			$detalheCompraSet .= "<button type=\"button\" class=\"btn green input-label\" style=\"margin-right: 20px;margin-top:10px;margin-bottom:5px;\" onclick=\"javascript:atribuir_reenviar_ingresso('apenas-atribuir','".$rSql['numeroUnico_pai']."','".$valueDetalhado['numeroUnico']."');\" >APENAS ATRIBUIR</button>";
																			$detalheCompraSet .= "<button type=\"button\" class=\"btn green input-label\" style=\"margin-left: 0px;margin-top:10px;margin-bottom:5px;\" onclick=\"javascript:atribuir_reenviar_ingresso('atribuir-reenviar','".$rSql['numeroUnico_pai']."','".$valueDetalhado['numeroUnico']."');\" >ATRIBUIR E REENVIAR</button>";
																			$detalheCompraSet .= "</td>";
																			$detalheCompraSet .= "</tr>";
																		} else {
																			$detalheCompraSet .= "<tr id=\"reatribuicao_".$valueDetalhado['numeroUnico']."\" style=\"background-color:".$corSet.";border-bottom:1px solid #ccc;display:none;\">";
																			$detalheCompraSet .= "<td style=\"padding-top: 5px;padding-bottom: 5px;padding-left: 5px;width:30%;font-size: 16px;".$font_familySet.";\">".$valueDetalhado['compra_descricao']."</td>";
																			$detalheCompraSet .= "<td colspan=\"2\" style=\"text-align:center\">";
																			$detalheCompraSet .= "<input type=\"text\" value=\"".$valueDetalhado['pessoa_nome']."\" id=\"pessoa_nome_".$valueDetalhado['numeroUnico']."\" style=\"margin-bottom:3px;margin-top:5px;\" placeholder=\"Digite o nome completo\" class=\"form-control\" />";
																			$detalheCompraSet .= "<input type=\"text\" value=\"".$valueDetalhado['pessoa_documento']."\" id=\"pessoa_documento_".$valueDetalhado['numeroUnico']."\" style=\"margin-bottom:3px;\" placeholder=\"Digite o CPF. Apenas números.\" class=\"form-control documento\" />";
																			$detalheCompraSet .= "<input type=\"text\" value=\"".$valueDetalhado['pessoa_email']."\" id=\"pessoa_email_".$valueDetalhado['numeroUnico']."\" style=\"margin-bottom:3px;\" placeholder=\"Digite o E-mail.\" class=\"form-control\" />";
																			$detalheCompraSet .= "<input type=\"text\" value=\"".$valueDetalhado['pessoa_telefone']."\" id=\"pessoa_telefone_".$valueDetalhado['numeroUnico']."\" style=\"margin-bottom:3px;\" placeholder=\"Digite o Telefone. Apenas números com DDD.\" class=\"form-control telefone\" />";
																			$detalheCompraSet .= "<button type=\"button\" class=\"btn green input-label\" style=\"margin-right: 20px;margin-top:10px;margin-bottom:5px;\" onclick=\"javascript:atribuir_reenviar_ingresso('apenas-atribuir','".$rSql['numeroUnico_pai']."','".$valueDetalhado['numeroUnico']."');\" >APENAS RE-ATRIBUIR</button>";
																			$detalheCompraSet .= "<button type=\"button\" class=\"btn green input-label\" style=\"margin-left: 0px;margin-top:10px;margin-bottom:5px;\" onclick=\"javascript:atribuir_reenviar_ingresso('atribuir-reenviar','".$rSql['numeroUnico_pai']."','".$valueDetalhado['numeroUnico']."');\" >RE-ATRIBUIR E REENVIAR</button>";
																			$detalheCompraSet .= "</td>";
																			$detalheCompraSet .= "</tr>";

																			if(trim($rSql['stat'])=="1" && trim($rSql['pago'])=="1") {
																				$detalheCompraSet .= "<tr id=\"reatribuicao_info1_".$valueDetalhado['numeroUnico']."\" style=\"background-color:".$corSet.";border-bottom:0px solid #ccc;\">";
																				$detalheCompraSet .= "   <td style=\"padding-top: 5px;padding-bottom: 5px;padding-left: 5px;width:30%;font-size: 16px;".$font_familySet.";\">".$valueDetalhado['compra_descricao']."</td>";
																				$detalheCompraSet .= "   <td style=\"padding-top: 5px;padding-bottom: 5px;padding-left: 5px;width:40%;font-size: 16px;".$font_familySet.";\">".$valueDetalhado['pessoa_descricao']."</td>";
																				$detalheCompraSet .= "   <td style=\"padding-top: 5px;padding-bottom: 5px;padding-right: 5px;width:30%;font-size: 16px;".$font_familySet.";text-align:right;\"><strong>1x R$ ".number_format($valueDetalhado['valor_venda'], 2, ',', '.')."</strong></td>";
																				$detalheCompraSet .= "</tr>";
																				$detalheCompraSet .= "<tr id=\"reatribuicao_info2_".$valueDetalhado['numeroUnico']."\" style=\"background-color:".$corSet.";border-bottom:1px solid #ccc;\">";
																				$detalheCompraSet .= "<td colspan=\"3\" style=\"text-align:right\">";
																				$detalheCompraSet .= "<button type=\"button\" class=\"btn green input-label\" style=\"margin-right: 0px;margin-top:10px;margin-bottom:5px;\" onclick=\"javascript:reatribuir_ingresso('".$valueDetalhado['numeroUnico']."');\" >CORRIGIR OU RE-ATRIBUIR</button>";
																				$detalheCompraSet .= "</td>";
																				$detalheCompraSet .= "</tr>";
																			} else {
																				$detalheCompraSet .= "<tr id=\"reatribuicao_info1_".$valueDetalhado['numeroUnico']."\" style=\"background-color:".$corSet.";border-bottom:0px solid #ccc;\">";
																				$detalheCompraSet .= "   <td style=\"padding-top: 5px;padding-bottom: 5px;padding-left: 5px;width:30%;font-size: 16px;".$font_familySet.";\">".$valueDetalhado['compra_descricao']."</td>";
																				$detalheCompraSet .= "   <td style=\"padding-top: 5px;padding-bottom: 5px;padding-left: 5px;width:40%;font-size: 16px;".$font_familySet.";\">".$valueDetalhado['pessoa_descricao']."</td>";
																				$detalheCompraSet .= "   <td style=\"padding-top: 5px;padding-bottom: 5px;padding-right: 5px;width:30%;font-size: 16px;".$font_familySet.";text-align:right;\"><strong>1x R$ ".number_format($valueDetalhado['valor_venda'], 2, ',', '.')."</strong></td>";
																				$detalheCompraSet .= "</tr>";
																			}
																		}
																	} else {
																		if(trim($valueDetalhado['pessoa_documento'])=="" && trim($rSql['stat'])=="1" && trim($rSql['pago'])=="1") {
																			$detalheCompraSet .= "<tr style=\"background-color:".$corSet.";border-bottom:1px solid #ccc;\">";
																			$detalheCompraSet .= "<td style=\"padding-top: 5px;padding-bottom: 5px;padding-left: 5px;width:30%;font-size: 16px;".$font_familySet.";\">".$valueDetalhado['compra_descricao']."</td>";
																			$detalheCompraSet .= "<td colspan=\"2\" style=\"text-align:center\">";
																			$detalheCompraSet .= "<input type=\"text\" id=\"pessoa_nome_".$valueDetalhado['numeroUnico']."\" style=\"margin-bottom:3px;margin-top:5px;\" placeholder=\"Digite o nome completo\" class=\"form-control\" />";
																			$detalheCompraSet .= "<input type=\"text\" id=\"pessoa_documento_".$valueDetalhado['numeroUnico']."\" style=\"margin-bottom:3px;\" placeholder=\"Digite o CPF. Apenas números.\" class=\"form-control documento\" />";
																			$detalheCompraSet .= "<input type=\"text\" id=\"pessoa_email_".$valueDetalhado['numeroUnico']."\" style=\"margin-bottom:3px;\" placeholder=\"Digite o E-mail.\" class=\"form-control\" />";
																			$detalheCompraSet .= "<input type=\"text\" id=\"pessoa_telefone_".$valueDetalhado['numeroUnico']."\" style=\"margin-bottom:3px;\" placeholder=\"Digite o Telefone. Apenas números com DDD.\" class=\"form-control telefone\" />";
																			$detalheCompraSet .= "<button type=\"button\" class=\"btn green input-label\" style=\"margin-right: 20px;margin-top:10px;margin-bottom:5px;\" onclick=\"javascript:atribuir_reenviar_ingresso('apenas-atribuir','".$rSql['numeroUnico_pai']."','".$valueDetalhado['numeroUnico']."');\" >APENAS ATRIBUIR</button>";
																			$detalheCompraSet .= "<button type=\"button\" class=\"btn green input-label\" style=\"margin-left: 0px;margin-top:10px;margin-bottom:5px;\" onclick=\"javascript:atribuir_reenviar_ingresso('atribuir-reenviar','".$rSql['numeroUnico_pai']."','".$valueDetalhado['numeroUnico']."');\" >ATRIBUIR E REENVIAR</button>";
																			$detalheCompraSet .= "</td>";
																			$detalheCompraSet .= "</tr>";
																		} else {
																			$detalheCompraSet .= "<tr style=\"background-color:".$corSet.";border-bottom:1px solid #ccc;\">";
																			$detalheCompraSet .= "   <td style=\"padding-top: 5px;padding-bottom: 5px;padding-left: 5px;width:30%;font-size: 16px;".$font_familySet.";\">".$valueDetalhado['compra_descricao']."</td>";
																			$detalheCompraSet .= "   <td style=\"padding-top: 5px;padding-bottom: 5px;padding-left: 5px;width:40%;font-size: 16px;".$font_familySet.";\">".$valueDetalhado['pessoa_descricao']."</td>";
																			$detalheCompraSet .= "   <td style=\"padding-top: 5px;padding-bottom: 5px;padding-right: 5px;width:30%;font-size: 16px;".$font_familySet.";text-align:right;\"><strong>1x R$ ".number_format($valueDetalhado['valor_venda'], 2, ',', '.')."</strong></td>";
																			$detalheCompraSet .= "</tr>";
																		}
																	}
																}
																$detalheCompraSet .= "</table>";
                                                                ?>
                                                                <tr style="background-color:<?=$corSet?>;">
                                                                    <td colspan="8" style="vertical-align:middle;"><?=$detalheCompraSet?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="8" style="vertical-align:middle;text-align:right"><b>Total</b>&nbsp;R$ <?=number_format($rSql['valor_total'], 2, ',', '.')?></td>
                                                                </tr>
                                                                <? if(trim($rSql['stat'])=="1" && trim($rSql['pago'])=="1") { ?>
                                                                <tr>
                                                                	<td colspan="8" style="padding:0px;border:0px;">

                                                                        <input type="text" id="cpf_<?=$rSql['numeroUnico']?>" style="margin-bottom:10px;" placeholder="Digite o novo CPF para realizar a correção. Somente números." class="form-control" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                	<td colspan="8" style="padding:0px;border:0px;">
                                                                        <input type="text" id="email_<?=$rSql['numeroUnico']?>" placeholder="Digite o novo e-mail para realizar a correção" class="form-control" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                	<td colspan="8" style="padding:0px;border:0px;">
                                                                        <button type="button" class="btn green input-label" style="margin-left: 0px;margin-top:10px;" onclick="javascript:reenviar_ingresso('<?=$rSql['numeroUnico']?>');" >REENVIAR INGRESSO</button>
                                                                    </td>
                                                                </tr>
                                                                <? } ?>
                                                            </table>
                                                            </div>
                                                        </div>
                                                    </div>
												</td>
    
                                            </tr>
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

