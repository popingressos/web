<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/chave.php");

$_SESSION['mod'] = "carrinho";
$mod = $_SESSION['mod'];
$where = filtro_tabela();

if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
} else {
	$rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT plataforma FROM empresa WHERE id='".$sysusu['empresa']."'"));
	if(trim($rSqlPlataforma['plataforma'])=="" || trim($rSqlPlataforma['plataforma'])=="0") {
	} else {
		$where = str_replace("empresa='".$rSqlPlataforma['plataforma']."'","empresa='".$sysusu['empresa']."'",$where);
	}
}

if(trim($where)=="") {
	$where = " WHERE mod_".$mod.".stat='102' ";
} else {
	$where = " ".$where." AND mod_".$mod.".stat='102' ";
}

$itens_por_pagina = 50;

if(trim($_GET['pagina'])=="" || trim($_GET['pagina'])=="0") {
	if(trim($_SESSION[''.$mod.'pagina'])=="" || trim($_SESSION[''.$mod.'pagina'])=="0") {
		$_SESSION[''.$mod.'pagina'] = "1";
	} else {
		$_SESSION[''.$mod.'pagina'] = $_SESSION[''.$mod.'pagina'];
	}
} else {
	$_SESSION[''.$mod.'pagina'] = $_GET['pagina'];
}

if(trim($_SESSION[''.$mod.'pagina'])=="1") {
	$limit_filtro = "LIMIT ".$itens_por_pagina."";
} else {
	$limit_filtro = "LIMIT ".($_SESSION[''.$mod.'pagina'] - 1) * $itens_por_pagina.",".$itens_por_pagina."";
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
                                                <th style="vertical-align:top;">
                                                <input type="text" onkeypress="javascript:mascara(this,moeda);" style="height: 34px;margin-bottom:5px;" pesquisa="valor_de" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_valor_de" placeholder="De" value="<?=$_SESSION[''.$mod.'valor_de']?>">
                                                <input type="text" onkeypress="javascript:mascara(this,moeda);" style="height: 34px;" pesquisa="valor_ate" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_valor_ate" placeholder="Até" value="<?=$_SESSION[''.$mod.'valor_ate']?>">
                                                </th>
                                                <th style="vertical-align:top;">
                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy"  data-date="">
                                                        <input type="text" class="form-control input-sm campo_busca" pesquisa="data_de" bd_externo="" id="busca_data_contratacao_de" placeholder="De" value="<?=$_SESSION[''.$mod.'data_contratacao_de']?>" style="height:34px;">
                                                        <span class="input-group-btn">
                                                            <button class="btn" type="button"><i class="fa fa-calendar"></i></button>
                                                        </span>
                                                    </div>

                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy"  data-date="">
                                                        <input type="text" class="form-control input-sm campo_busca" pesquisa="data_ate" bd_externo="" id="busca_data_contratacao_ate" placeholder="Até" value="<?=$_SESSION[''.$mod.'data_contratacao_ate']?>" style="height:34px;">
                                                        <span class="input-group-btn">
                                                            <button class="btn" type="button"><i class="fa fa-calendar"></i></button>
                                                        </span>
                                                    </div>
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
                                                    <option value="12" <? if(trim($_SESSION[''.$mod.'stat'])=="7") { echo " selected"; } ?>>BOLETO EM CANCELAMENTO</option>
                                                    <option value="13" <? if(trim($_SESSION[''.$mod.'stat'])=="7") { echo " selected"; } ?>>BOLETO A PAGAR</option>
                                                    <option value="14" <? if(trim($_SESSION[''.$mod.'stat'])=="7") { echo " selected"; } ?>>BOLETO EM PROCESSO</option>
                                                    <option value="15" <? if(trim($_SESSION[''.$mod.'stat'])=="7") { echo " selected"; } ?>>BOLETO DEVOLVIDO</option>
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
                                                <th>Pessoa</th>
                                                <th style="width:200px;">Documento</th>
                                                <th style="width:110px;">Valor</th>
                                                <th style="width:170px;">Data da Compra</th>
                                                <th style="width:170px;">Data de Inserção</th>
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
													mod_".$mod.".valor_total,
													mod_".$mod.".dataObjeto,
													mod_".$mod.".objeto_carrinho,
													mod_".$mod.".objeto_carrinho_detalhado,
													mod_".$mod.".tipo_operacao,
													mod_".$mod.".forma_de_pagamento,
													mod_".$mod.".pago,
													mod_".$mod.".stat,
													mod_".$mod.".dataModificacao,
													mod_".$mod.".data,

													mod_".$mod.".pessoa_nome AS pessoa_nome,
													mod_".$mod.".pessoa_documento AS pessoa_documento,
													mod_".$mod.".pessoa_telefone AS pessoa_telefone,
													mod_".$mod.".whatsapp AS whatsapp,
													mod_".$mod.".pessoa_email AS pessoa_email,

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

												$tipoDocTxt = "CPF";
												$documentoSet = "".mascaraCpf($rSql['pessoa_documento'])."";

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
					
												
												if (strripos($_SESSION["".$mod."ids_selecionados"], "|".$rSql['id']."|") === false) { $checked_set=""; } else { $checked_set = " checked=\"checked\" "; }
                                            ?>
                                            <tr id_linha="<?=$rSql['id']?>" cor_anterior="<?=$cor_anterior_set?>" <?=$style_set?> role="row">
                                                <? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                                <td style="vertical-align:middle;"><?=$empresaSet?></td>
                                                <? } ?>
                                                <td style="vertical-align:middle;"><?=$rSql['id']?></td>
                                                <td style="vertical-align:middle;"><?=$rSql['pessoa_nome']?></td>
                                                <td style="vertical-align:middle;"><?=$documentoSet?></td>
                                                <td style="vertical-align:middle;">R$ <?=number_format($rSql['valor_total'], 2, ',', '.')?></td>
                                                <td style="vertical-align:middle;"><?=ajustaDataReturn($rSql['dataModificacao'],"d/m/Y");?></td>
                                                <td style="vertical-align:middle;"><?=ajustaDataReturn($rSql['data'],"d/m/Y");?></td>
                                                <td style="vertical-align:middle;">
                                                    <a href="javascript:void(0);" class="btn btn-xs" style="background-color:<?=$statusDataDaCompraCorSet?>;width:100%;text-align:center;color:#FFF;" 
                                                       title="<?=$statusDataDaCompraTxtSet?>"> <?=$statusDataDaCompraTxtSet?> </a>
                                                </td>
                                                <td style="vertical-align:middle;" class="block_check_click">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm blue-madison" 
                                                        href="javascript:void(0);" 
                                                        data-toggle="modal" data-target="#modal-carrinho-<?=$rSql['numeroUnico']?>"
                                                        title="Visualizar Detalhes"><i class="fa fa-eye"></i></a>
                                                    </div>


                                                    <!--begin::Modal VISUALIZAR COMPRA <?=$rSql['numeroUnico']?>-->
                                                    <div class="modal fade" id="modal-carrinho-<?=$rSql['numeroUnico']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detalhes da COMPRA #<?=$rSql['id']?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-carrinho-<?=$rSql['numeroUnico']?>">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table display" style="background-color:#ffffff;" cellspacing="0" width="650px" style="width:650px;">
                                                                <tr>
                                                                    <td colspan="2" style="background-color:#333;color:#FFF;">Dados do Comprador</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                    	<table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:650px;">
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
                                                                    <td colspan="2" style="background-color:#333;color:#FFF;">Detalhes da Compra</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                    	<table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:650px;">
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
                                                                    <td colspan="2">
                                                                    	<table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:650px;">
                                                                            <tr>
                                                                                <td style="font-weight:bold;padding:10px;">Item</td>
                                                                                <td style="font-weight:bold;padding:10px;width:100px;">Total</td>
                                                                            </tr>
                                                                            <?
                                                                            $valorSubtotal = 0;
                                                                            $valorTaxaEmpresa = 0;
                                                                            $valorTaxaCMS = 0;
                                                                            $corSet = "#ffffff";
                                                                            $carrinhoArray = unserialize($rSql['objeto_carrinho_detalhado']);
                                                                            $carrinhoArray = json_decode(json_encode($carrinhoArray), true);
                                                                            foreach ($carrinhoArray as $key => $value) {
                                                                                $contLista++;
                                                                                if($corSet=="#ffffff") {
                                                                                    $corSet = "#e2e2e2";
                                                                                } else {
                                                                                    $corSet = "#ffffff";
                                                                                }
                                                                            ?>
                                                                            <tr style="background-color:<?=$corSet?>;" role="row">
                                                                                <? if(trim($value['tipo'])=="evento") { ?>
                                                                                <td style="vertical-align:top;padding:10px;"><b><?=$value['evento_nome']?></b><br /><?=$value['ingresso_nome']?></td>
                                                                                <? } else { ?>
                                                                                <td style="vertical-align:top;padding:10px;"><?=$value['nome']?></td>
                                                                                <? } ?>
            
                                                                                <td style="vertical-align:middle;padding:10px;">R$ <?=number_format($value['valor'], 2, ',', '.')?></td>
                                                                            </tr>
                                                                            <? } ?>
            
                                                                            <tr>
                                                                                <td style="font-weight:bold;text-align:right;padding:10px;">Total&nbsp;&nbsp;</td>
                                                                                <td style="vertical-align:middle;width:100px;padding:10px;">R$ <?=number_format($rSql['valor_total'], 2, ',', '.')?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2" style="text-align:right;padding:10px;">
																				<button type="button" class="btn green input-label" style="margin-left: 0px;margin-top:10px;" onclick="javascript:enviar_compra_para_aprovacao('<?=$rSql['numeroUnico']?>');" >ENVIAR PARA CONFIRMAÇÃO?</button>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            
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

