<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/chave.php");

$mod = $_SESSION['mod'];
$mod2 = $_SESSION['mod2'];
$where = filtro_tabela();

#$where = str_replace("".$mod."","".$mod2."",$where);

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
													$filtroProfissionaisSet = "";
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
														if(trim($_SESSION[''.$mod.'empresa'])==trim($rSqlItem['id'])) { 
															$filtroProfissionaisSet = " AND mod_profissional.empresa='".$rSqlItem['id']."'";
														}
                                                    ?>
                                                    <option value="<?= $rSqlItem['id'] ?>" <? if(trim($_SESSION[''.$mod.'empresa'])==trim($rSqlItem['id'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                    <? } ?>
                                                </select>
                                                </th>
                                                <? } ?>
                                                <th style="vertical-align:top;"><input type="text" onKeyPress="return submitarPersoal(event)" style="height: 34px;" pesquisa="like" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_nome" value="<?=$_SESSION[''.$mod.'nome']?>"></th>
                                                <th style="vertical-align:top;"></th>
                                                <th style="vertical-align:top;"></th>
                                                <th style="vertical-align:top;"></th>
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
                                                <button type="button" onclick="javascript:filtra_itens();" style="width:100%;margin-bottom:3px;" class="btn default"> Filtrar </button>
                                                <button type="button" onclick="javascript:filtra_limpa();" style="width:100%;" class="btn btn-default"> Limpar </button>
                                                </th>
                                            </tr>

                                            <tr>
                                                <? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                                <th style="width:250px;">Empresa</th>
                                                <? } ?>
                                                <th>Nome</th>
                                                <th style="width:170px;">Qtd de Vendas</th>
                                                <th style="width:170px;">R$ em Caixa</th>
                                                <th style="width:170px;">Status</th>
                                                <th style="width:170px;">Data da Atualização</th>
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
													mod_".$mod.".id,
													mod_".$mod.".numeroUnico,
													mod_".$mod.".numeroUnico_usuario,
													mod_".$mod.".numeroUnico_finger,
													mod_".$mod.".valor,
													mod_".$mod.".valor_atual,
													mod_".$mod.".observacao,
													mod_".$mod.".data,

													mod_sysusu.nome AS sysusu_nome,
													mod_empresa.nome AS empresa_nome
												
												FROM 
													".$mod." AS mod_".$mod." 
												LEFT JOIN 
													sysusu AS mod_sysusu ON (mod_sysusu.numeroUnico = mod_".$mod.".numeroUnico_usuario)
												LEFT JOIN 
													empresa AS mod_empresa ON (mod_empresa.id = mod_sysusu.empresa)
												
												".$where."
			
												GROUP BY
													mod_".$mod.".numeroUnico_usuario

												ORDER BY
													mod_".$mod.".data DESC

													
											";
											
											$strSQL_N = "
												SELECT 
													DISTINCT mod_pdv_fluxo_caixa.numeroUnico_usuario
												
												FROM 
													".$mod." AS mod_".$mod." 
												LEFT JOIN 
													sysusu AS mod_sysusu ON (mod_sysusu.numeroUnico = mod_".$mod.".numeroUnico_usuario)
												LEFT JOIN 
													empresa AS mod_empresa ON (mod_empresa.id = mod_sysusu.empresa)
												
												".$where."
												";
											$nSql[0] = mysql_num_rows(mysql_query($strSQL_N));

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
												if(trim($rSql['empresa_nome'])=="") {
													$empresaSet = "<i>Sem empresa setada</i>";
												} else {
													$empresaSet = "".$rSql['empresa_nome']."";
												}

												if(strlen($rSql['documento'])>11) {
													$rSql['documento'] = mascaraCnpj($rSql['documento']);
												} else {
													$rSql['documento'] = mascaraCpf($rSql['documento']);
												}

												$rSqlPdvUltimaAbertura = mysql_fetch_array(mysql_query("
																										SELECT 
																											numeroUnico,
																											data,
																											valor AS total 
																										FROM 
																											pdv_fluxo_caixa 
																										WHERE 
																											numeroUnico_usuario='".$rSql['numeroUnico_usuario']."' AND 
																											tipo_operacao='ABERTURA' 
																										ORDER BY 
																											id DESC 
																										LIMIT 1
																										"));
						
												$rSqlCaixaAtual = mysql_fetch_array(mysql_query("
																								SELECT 
																									SUM(valor) AS total 
																								FROM 
																									pdv_fluxo_caixa_hist 
																								WHERE 
																									numeroUnico_pdv_fluxo_caixa='".$rSqlPdvUltimaAbertura['numeroUnico']."' AND 
																									data > '".$rSqlPdvUltimaAbertura['data']."'
																								"));
						
												$rSqlSangriaAtual = mysql_fetch_array(mysql_query("
																								SELECT 
																									SUM(valor) AS total 
																								FROM 
																									pdv_fluxo_caixa 
																								WHERE 
																									numeroUnico_usuario='".$rSql['numeroUnico_usuario']."' AND 
																									tipo_operacao='SANGRIA' AND 
																									data > '".$rSqlPdvUltimaAbertura['data']."'
																								"));
							
												if(trim($rSqlPdvUltimaAbertura['total'])=="") { $rSqlPdvUltimaAbertura['total'] = 0; }
												if(trim($rSqlCaixaAtual['total'])=="") { $rSqlCaixaAtual['total'] = 0; }
												if(trim($rSqlSangriaAtual['total'])=="") { $rSqlSangriaAtual['total'] = 0; }
						
												$totalSet = ($rSqlPdvUltimaAbertura['total'] + $rSqlCaixaAtual['total']) - $rSqlSangriaAtual['total'];




												$nSqlPdvVenda = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho_notificacao WHERE numeroUnico_comissario='".$rSql['numeroUnico_usuario']."'"));

												$rSqlPdvLogado = mysql_fetch_array(mysql_query("SELECT 
																									numeroUnico,
																									data,
																									valor AS total, 
																									tipo_operacao
																								FROM 
																									pdv_fluxo_caixa 
																								WHERE 
																									numeroUnico_usuario='".$rSql['numeroUnico_usuario']."'
																								ORDER BY 
																									id DESC 
																								LIMIT 1
																							   "));
					
												if(trim($rSqlPdvLogado['tipo_operacao'])=="FECHAMENTO") {
													$tipo_operacaoSet = "CAIXA FECHADO";
												} else if(trim($rSqlPdvLogado['tipo_operacao'])=="ABERTURA") {
													$tipo_operacaoSet = "CAIXA ABERTO";
												} else if(trim($rSqlPdvLogado['tipo_operacao'])=="SANGRIA") {
													$tipo_operacaoSet = "CAIXA ABERTO";
												}

												if (strripos($_SESSION["".$mod."ids_selecionados"], "|".$rSql['id']."|") === false) { $checked_set=""; } else { $checked_set = " checked=\"checked\" "; }
                                            ?>
                                            <tr id_linha="<?=$rSql['id']?>" cor_anterior="<?=$cor_anterior_set?>" <?=$style_set?> role="row">
                                                <? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                                <td style="vertical-align:middle;"><?=$empresaSet?></td>
                                                <? } ?>
                                                <td style="vertical-align:middle;"><?=$rSql['sysusu_nome']?></td>
                                                <td style="vertical-align:middle;"><?=$nSqlPdvVenda[0]?></td>
                                                <td style="vertical-align:middle;"><?="R$ ".number_format($totalSet, 2, ',', '.').""?></td>
                                                <td style="vertical-align:middle;"><?=$tipo_operacaoSet?></td>
                                                <td style="vertical-align:middle;"><?=ajustaDataReturn($rSql['data'],"d/m/Y");?></td>
                                                <td style="vertical-align:middle;" class="block_check_click">
                                                    <input type="hidden" id="data_<?=$rSql['id']?>" value="<?=$rSqlPdvLogado['data']?>" />
                                                    <input type="hidden" id="numeroUnico_usuario_<?=$rSql['id']?>" value="<?=$rSql['numeroUnico_usuario']?>" />
                                                    <input type="hidden" id="numeroUnico_fluxo_caixa_<?=$rSql['id']?>" value="<?=$rSqlPdvUltimaAbertura['numeroUnico']?>" />
                                                    <input type="hidden" id="numeroUnico_finger_<?=$rSql['id']?>" value="<?=$rSql['numeroUnico_finger']?>" />
                                                    <input type="hidden" id="valor_atual_<?=$rSql['id']?>" value="<?=$total_em_caixa?>" />
                                                    <div class="btn-group">
                                                        <? if($totalSet>0) { ?>
                                                        <a href="javascript:void(0);" 
                                                           data-toggle="modal" data-target="#modal-sangria-<?=$rSql['numeroUnico']?>"
                                                           class="btn btn-xs blue" style="width:150px;text-align:center;color:#FFF;margin-bottom:5px;" 
                                                           title="SANGRIA CAIXA"> SANGRIA CAIXA </a>
													    <? } ?>
                                                    	<? if(trim($rSqlPdvLogado['tipo_operacao'])=="ABERTURA" || trim($rSqlPdvLogado['tipo_operacao'])=="SANGRIA") { ?>
                                                        <a href="javascript:void(0);" 
                                                           data-toggle="modal" data-target="#modal-fechamento-<?=$rSql['numeroUnico']?>"
                                                           class="btn btn-xs red-sunglo" style="width:150px;text-align:center;color:#FFF;" 
                                                           title="FECHAR CAIXA"> FECHAR CAIXA </a>
                                                        <? } ?>
                                                    </div>

                                                    <!--begin::Modal SANGRIA <?=$rSql['numeroUnico']?>-->
                                                    <div class="modal fade" id="modal-sangria-<?=$rSql['numeroUnico']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">SANGRIA PDV <?=$rSql['sysusu_nome']?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-sangria-<?=$rSql['numeroUnico']?>">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        	<div style="max-height: 600px;overflow:auto;">
                                                            <table class="table display" style="background-color:#ffffff;" cellspacing="0" width="100%">
                                                                <tr>
                                                                    <td colspan="8" style="background-color:#333;color:#FFF;">Detalhes</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="8">
                                                                    	<table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Usuário</td>
                                                                                <td><?=$rSql['sysusu_nome']?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Valor Atual</td>
                                                                                <td><?="R$ ".number_format($totalSet, 2, ',', '.').""?></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                	<td colspan="8" style="padding:0px;border:0px;">
                                                                    	<input value="" type="text" id="valor_sangria_<?=$rSql['id']?>" onkeypress="javascript:mascara(this,moeda);" placeholder="Valor de Sangria" class="form-control" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                	<td colspan="8" style="padding:0px;border:0px;">
                                                                        <button type="button" class="btn green input-label" style="margin-left: 0px;margin-top:10px;" onclick="javascript:usuarios_de_pdv_sangria_de_caixa('<?=$rSql['id']?>');" >CONFIRMA O SANGRIA?</button>
                                                                        <button type="button" class="btn yellow-gold input-label" style="margin-left: 0px;margin-top:10px;float:right;margin-right:0px;" onclick="javascript:usuarios_de_pdv_sangria_de_caixa_fecha('<?=$rSql['numeroUnico']?>');" >CANCELAR</button>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--begin::Modal FECHAMENTO <?=$rSql['numeroUnico']?>-->
                                                    <div class="modal fade" id="modal-fechamento-<?=$rSql['numeroUnico']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">FECHAMENTO PDV <?=$rSql['sysusu_nome']?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-fechamento-<?=$rSql['numeroUnico']?>">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        	<div style="max-height: 600px;overflow:auto;">
                                                            <table class="table display" style="background-color:#ffffff;" cellspacing="0" width="100%">
                                                                <tr>
                                                                    <td colspan="8" style="background-color:#333;color:#FFF;">Detalhes</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="8">
                                                                    	<table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Usuário</td>
                                                                                <td><?=$rSql['sysusu_nome']?></td>
                                                                            </tr>
                                                                        	<tr style="line-height: 25px;">
                                                                            	<td style="width:160px;font-weight:bold;padding-right:5px;">Valor Atual</td>
                                                                                <td><?="R$ ".number_format($totalSet, 2, ',', '.').""?></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                	<td colspan="8" style="padding:0px;border:0px;">
                                                                    	<input value="" type="text" id="valor_fechamento_<?=$rSql['id']?>" onkeypress="javascript:mascara(this,moeda);" placeholder="Valor de Fechamento" class="form-control" />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                	<td colspan="8" style="padding:0px;border:0px;">
                                                                        <button type="button" class="btn green input-label" style="margin-left: 0px;margin-top:10px;" onclick="javascript:usuarios_de_pdv_fechamento_de_caixa('<?=$rSql['id']?>');" >CONFIRMA O FECHAMENTO?</button>
                                                                        <button type="button" class="btn yellow-gold input-label" style="margin-left: 0px;margin-top:10px;float:right;margin-right:0px;" onclick="javascript:usuarios_de_pdv_fechamento_de_caixa_fecha('<?=$rSql['numeroUnico']?>');" >CANCELAR</button>
                                                                    </td>
                                                                </tr>
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

                                    <? #include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/lib/controle_checkbox.php"); ?>
