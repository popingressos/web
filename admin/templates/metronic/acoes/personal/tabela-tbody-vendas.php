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
                                                <th style="vertical-align:top;"><input type="text" onKeyPress="return submitarPersoal(event)" style="height: 34px;" pesquisa="like" bd_externo="pessoas" class="form-control form-filter input-sm campo_busca" id="busca_pessoas_nome" value="<?=$_SESSION[''.$mod.'pessoas_nome']?>"></th>
                                                <th style="vertical-align:top;"><input type="text" onKeyPress="return submitarPersoal(event)" style="height: 34px;" pesquisa="like" bd_externo="produtos" class="form-control form-filter input-sm campo_busca" id="busca_produtos_nome" value="<?=$_SESSION[''.$mod.'produtos_nome']?>"></th>
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
                                                <th>Pessoa</th>
                                                <th style="width:200px;">Item</th>
                                                <th style="width:110px;">Valor</th>
                                                <th style="width:170px;">Data da Venda</th>
                                                <th style="width:170px;">Data de Inserção</th>
                                                <th style="width:130px;">Status</th>
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
													mod_".$mod.".tipo,
													mod_".$mod.".valor,
													mod_".$mod.".stat,
													mod_".$mod.".data_contratacao,
													mod_".$mod.".data,

													mod_pessoas.nome AS pessoas_nome,
													
													mod_planos_e_pacotes.nome AS planos_e_pacotes_nome,
													mod_produtos.nome AS produtos_nome,
													mod_circuitos.nome AS circuitos_nome,

													mod_empresa.nome AS empresa_nome
												
												FROM 
													".$mod." AS mod_".$mod." 
												LEFT JOIN 
													empresa AS mod_empresa ON (mod_empresa.id = mod_".$mod.".empresa)
												LEFT JOIN 
													pessoas AS mod_pessoas ON (mod_pessoas.numeroUnico = mod_".$mod.".pessoa)
												LEFT JOIN 
													planos_e_pacotes AS mod_planos_e_pacotes ON (mod_planos_e_pacotes.numeroUnico = mod_".$mod.".numeroUnico_planos_e_pacotes)
												LEFT JOIN 
													produtos AS mod_produtos ON (mod_produtos.numeroUnico = mod_".$mod.".numeroUnico_produtos)
												LEFT JOIN 
													circuitos AS mod_circuitos ON (mod_circuitos.numeroUnico = mod_".$mod.".numeroUnico_circuitos)
												
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
												LEFT JOIN 
													pessoas AS mod_pessoas ON (mod_pessoas.numeroUnico = mod_".$mod.".pessoa)
												LEFT JOIN 
													planos_e_pacotes AS mod_planos_e_pacotes ON (mod_planos_e_pacotes.numeroUnico = mod_".$mod.".numeroUnico_planos_e_pacotes)
												LEFT JOIN 
													produtos AS mod_produtos ON (mod_produtos.numeroUnico = mod_".$mod.".numeroUnico_produtos)
												LEFT JOIN 
													circuitos AS mod_circuitos ON (mod_circuitos.numeroUnico = mod_".$mod.".numeroUnico_circuitos)
												
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

												if(trim($rSql['stat'])=="1") {
													$stat1Set = " style=\"display:block;padding: 3px 11px;width:110px !important;text-align:center;\" ";
													$stat0Set = " style=\"display:none;padding: 3px 5px;width:110px !important;text-align:center;\" ";
												} else {
													$stat1Set = " style=\"display:none;padding: 3px 11px;width:110px !important;text-align:center;\" ";
													$stat0Set = " style=\"display:block;padding: 3px 5px;width:110px !important;text-align:center;\" ";
												}

												if(trim($rSql['tipo'])=="planos_e_pacotes") {
													$tipoSet = "Planos e/ou Pacotes";
													$nomeSet = $rSql['planos_e_pacotes_nome'];
												} else if(trim($rSql['tipo'])=="produtos") {
													$tipoSet = "Produtos";
													$nomeSet = $rSql['produtos_nome'];
												} else if(trim($rSql['tipo'])=="circuitos") {
													$tipoSet = "Circuitos";
													$nomeSet = $rSql['circuitos_nome'];
												}

												if (strripos($_SESSION["".$mod."ids_selecionados"], "|".$rSql['id']."|") === false) { $checked_set=""; } else { $checked_set = " checked=\"checked\" "; }
                                            ?>
                                            <tr id_linha="<?=$rSql['id']?>" cor_anterior="<?=$cor_anterior_set?>" <?=$style_set?> role="row">
                                                <td><input id="check_<?=$rSql['id']?>" type="checkbox" name="msg_sel[]" title="" class="checkboxes check_<?=$mod?>" <?=$checked_set?> value="<?=$rSql['id']?>" /></td>
                                                <? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                                <td style="vertical-align:middle;"><?=$empresaSet?></td>
                                                <? } ?>
                                                <td style="vertical-align:middle;"><?=$rSql['pessoas_nome']?></td>
                                                <td style="vertical-align:middle;"><?=$nomeSet?><br /><i><?=$tipoSet?></i></td>
                                                <td style="vertical-align:middle;">R$ <?=number_format($rSql['valor'], 2, ',', '.')?></td>
                                                <td style="vertical-align:middle;"><?=ajustaDataSemHoraReturn($rSql['data_contratacao'],"d/m/Y");?></td>
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
