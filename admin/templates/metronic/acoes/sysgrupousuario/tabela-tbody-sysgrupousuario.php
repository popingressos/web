<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/chave.php");

$mod = $_SESSION['mod'];
$where = filtro_tabela();

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
                                                <th style="width:10px;"></th>
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
                                                <th style="vertical-align:top;">
                                                <select id="busca_tipo" class="form-control campo_busca" pesquisa="igual" bd_externo="">
                                                    <option value="" <? if(trim($_SESSION[''.$mod.'tipo'])=="") { echo " selected"; } ?>></option>
                                                    <option value="padrao" <? if(trim($_SESSION[''.$mod.'tipo'])=="padrao") { echo " selected"; } ?>>Padrão / Apenas Controle de Permissão</option>
                                                    <option value="assinatura_usuario" <? if(trim($_SESSION[''.$mod.'tipo'])=="assinatura_usuario") { echo " selected"; } ?>>Assinatura Usuário</option>
                                                    <option value="assinatura_whitelabel" <? if(trim($_SESSION[''.$mod.'tipo'])=="assinatura_whitelabel") { echo " selected"; } ?>>Assinatura WhiteLabel</option>
                                                </select>
                                                </th>
                                                <th style="vertical-align:top;"><input type="text" style="height: 34px;" pesquisa="like" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_nome" value="<?=$_SESSION[''.$mod.'nome']?>"></th>
                                                <th style="vertical-align:top;">
                                                <input type="text" onkeypress="javascript:mascara(this,moeda);" style="height: 34px;margin-bottom:5px;" pesquisa="valor_de" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_valor_de" placeholder="De" value="<?=$_SESSION[''.$mod.'valor_de']?>">
                                                <input type="text" onkeypress="javascript:mascara(this,moeda);" style="height: 34px;" pesquisa="valor_ate" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_valor_ate" placeholder="Até" value="<?=$_SESSION[''.$mod.'valor_ate']?>">
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
                                                    <option value="1" <? if(trim($_SESSION[''.$mod.'stat'])=="1") { echo " selected"; } ?>>ATIVOS</option>
                                                    <option value="0" <? if(trim($_SESSION[''.$mod.'stat'])=="0") { echo " selected"; } ?>>INATIVOS</option>
                                                </select>
                                                </th>
                                                <th style="vertical-align:top;">
                                                <button type="button" onclick="javascript:filtra_itens();" style="width:100%;margin-bottom:3px;" class="btn default"> Filtrar </button>
                                                <button type="button" onclick="javascript:filtra_limpa();" style="width:100%;" class="btn btn-default"> Limpar </button>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th style="width:10px;" class="table-checkbox"><input type="checkbox" class="group-checkable" title="Selecionar todos"/></th>
                                                <? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                                <th style="width:250px;">Empresa</th>
                                                <? } ?>
                                                <th style="width:170px;">Tipo</th>
                                                <th>Nome</th>
                                                <th style="width:170px;">Valor</th>
                                                <th style="width:170px;">Data de Inserção</th>
                                                <th style="width:130px;">Status</th>
                                                <th style="width:125px;"></th>
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
													mod_".$mod.".nome,
													mod_".$mod.".tipo,
													mod_".$mod.".valor,
													mod_".$mod.".numeroUnico,
													mod_".$mod.".stat,
													mod_".$mod.".data,

													mod_empresa.nome AS empresa_nome
												
												FROM 
													".$mod." AS mod_".$mod." 
												LEFT JOIN 
													empresa AS mod_empresa ON (mod_empresa.id = mod_".$mod.".empresa)
												
												".$where."
			
												ORDER BY
													mod_".$mod.".data ASC
													
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

												$_SESSION['cobrancas_adicionais_'.$rSql['numeroUnico'].''] = "";
												$_SESSION['numeroUnicoGerado'] = "";

												$idSend = $rSql['id'];
												if(trim($rSql['empresa'])=="" || trim($rSql['empresa'])=="0") {
													$empresaSet = "<i>Sem empresa setada</i>";
												} else {
													$empresaSet = "".$rSql['empresa_nome']."";
												}

												if(trim($rSql['tipo'])=="" || trim($rSql['tipo'])=="padrao") {
													$plano_de_assinaturaSet = "Padrão";
												} else if(trim($rSql['tipo'])=="assinatura_usuario") {
													$plano_de_assinaturaSet = "Assinatura Usuário";
												} else if(trim($rSql['tipo'])=="assinatura_whitelabel") {
													$plano_de_assinaturaSet = "Assinatura WhiteLabel";
												}

												if(trim($rSql['stat'])=="1") {
													$stat1Set = " style=\"display:block;padding: 3px 11px;width:110px !important;text-align:center;\" ";
													$stat0Set = " style=\"display:none;padding: 3px 5px;width:110px !important;text-align:center;\" ";
												} else {
													$stat1Set = " style=\"display:none;padding: 3px 11px;width:110px !important;text-align:center;\" ";
													$stat0Set = " style=\"display:block;padding: 3px 5px;width:110px !important;text-align:center;\" ";
												}
												
												if($rSql['valor']>0) {
													$valorSet = "R$ ".number_format($rSql['valor'], 2, ',', '.')."";
												} else {
													$valorSet = "<i>Não informado</i>";
												}

												if (strripos($_SESSION["".$mod."ids_selecionados"], "|".$rSql['id']."|") === false) { $checked_set=""; } else { $checked_set = " checked=\"checked\" "; }
                                            ?>
                                            <tr id_linha="<?=$rSql['id']?>" cor_anterior="<?=$cor_anterior_set?>" <?=$style_set?> role="row">
                                                <td><input id="check_<?=$rSql['id']?>" type="checkbox" name="msg_sel[]" title="" class="checkboxes check_<?=$mod?>" <?=$checked_set?> value="<?=$rSql['id']?>" /></td>
                                                <? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                                <td style="vertical-align:middle;"><?=$empresaSet?></td>
                                                <? } ?>
                                                <td style="vertical-align:middle;"><?=$plano_de_assinaturaSet?></td>
                                                <td style="vertical-align:middle;"><?=$rSql['nome']?></td>
                                                <td style="vertical-align:middle;"><?=$valorSet?></td>
                                                <td style="vertical-align:middle;"><?=ajustaDataReturn($rSql['data'],"d/m/Y");?></td>
                                                <td style="vertical-align:middle;">
                                                    <a href="javascript:void(0);" <?=$stat1Set?> id="stat_1_<?=$rSql['numeroUnico']?>" onclick="muda_lista_stat('<?=$rSql['numeroUnico']?>','0','<?=$mod?>');" class="btn btn-xs green" title="Despublicar"> ATIVO </a>
                                                    <a href="javascript:void(0);" <?=$stat0Set?> id="stat_0_<?=$rSql['numeroUnico']?>" onclick="muda_lista_stat('<?=$rSql['numeroUnico']?>','1','<?=$mod?>');" class="btn btn-xs yellow-gold" title="Publicar"> INATIVO </a>
                                                </td>
                                                <td style="vertical-align:middle;" class="block_check_click">
                                                    <div class="btn-group">
                                                        <? $chave_gerada = geraCodReturn()."/"; ?>
                                                        <a class="btn btn-sm blue-madison" 
                                                        href="<?=$link?><?=$chave_gerada?><?=$_SESSION['var1']?>/<?=$_SESSION['var2']?>/editar/<?=$rSql['numeroUnico']?>/" title="Editar Item"><i class="fa fa-edit"></i></a>
                                                        
                                                        <span class="red-sunglo btn btn-sm" onclick="javascript:remover_item_lista('<?=$rSql['numeroUnico']?>','<?=$mod?>');" title="Excluir"><i class="fa fa-times"></i></span> 
                                                        
                                                        <span class="blue btn btn-sm" onclick="javascript:duplicar_item_lista('<?=$rSql['numeroUnico']?>','<?=$mod?>');" title="Duplicar"><i class="fa fa-copy"></i></span>
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

                                    <? include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/lib/controle_checkbox.php"); ?>
