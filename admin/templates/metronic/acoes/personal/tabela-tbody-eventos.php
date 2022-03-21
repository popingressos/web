<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/chave.php");

$_SESSION['mod'] = "eventos";
$_SESSION['mod2'] = "";
$mod = $_SESSION['mod'];
$where = filtro_tabela();


if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
	$mostraEmpresa = 1;
	if(trim($_SESSION[''.$mod.'plataforma'])=="") {
		$filtroEmpresaMod = "";
	} else {
		$filtroEmpresaMod = " AND mod_empresa.plataforma='".$_SESSION[''.$mod.'plataforma']."' "; 
	}
} else {
	$rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT plataforma FROM empresa WHERE id='".$sysusu['empresa']."'"));
	$filtroEmpresaMod = " AND mod_empresa.plataforma='".$sysusu['empresa']."' "; 
	if(trim($rSqlPlataforma['plataforma'])=="" || trim($rSqlPlataforma['plataforma'])=="0") {
		$mostraEmpresa = 1;
		$where = str_replace("mod_".$mod.".empresa='".$sysusu['empresa']."'","( mod_".$mod.".empresa='".$sysusu['empresa']."' OR mod_".$mod.".plataforma='".$sysusu['empresa']."' )",$where);
	} else { 
		$mostraEmpresa = 0;
		$where = str_replace("empresa='".$rSqlPlataforma['plataforma']."'","empresa='".$sysusu['empresa']."'",$where);
	}
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
                                                <th style="width:10px;"></th>
                                                <? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                                <th style="width:250px;vertical-align:top;">
                                                <select id="busca_plataforma" class="form-control bs-select campo_busca" pesquisa="igual" bd_externo="" data-live-search="true" data-show-subtext="true" onchange="javascript:filtrar_empresas_busca_plataforma();">
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
                                                    <option value="<?= $rSqlItem['id'] ?>" <? if(trim($_SESSION[''.$mod.'plataforma'])==trim($rSqlItem['id'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                    <? } ?>
                                                </select>
                                                </th>
                                                <? } ?>
                                                <? if(trim($mostraEmpresa)=="1") { ?>
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
                                                <th style="vertical-align:top;"><input type="text" onKeyPress="return submitarPersoal(event)" style="height: 34px;" pesquisa="like" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_nome" value="<?=$_SESSION[''.$mod.'nome']?>"></th>
                                                <th style="vertical-align:top;">
                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy"  data-date="">
                                                        <input type="text" class="form-control input-sm campo_busca" pesquisa="data_de" bd_externo="" id="busca_data_do_evento_de" placeholder="De" value="<?=$_SESSION[''.$mod.'data_do_evento_de']?>" style="height:34px;">
                                                        <span class="input-group-btn">
                                                            <button class="btn" type="button"><i class="fa fa-calendar"></i></button>
                                                        </span>
                                                    </div>

                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy"  data-date="">
                                                        <input type="text" class="form-control input-sm campo_busca" pesquisa="data_ate" bd_externo="" id="busca_data_do_evento_ate" placeholder="Até" value="<?=$_SESSION[''.$mod.'data_do_evento_ate']?>" style="height:34px;">
                                                        <span class="input-group-btn">
                                                            <button class="btn" type="button"><i class="fa fa-calendar"></i></button>
                                                        </span>
                                                    </div>
                                                </th>
                                                <th style="vertical-align:top;">
                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy"  data-date="">
                                                        <input type="text" class="form-control input-sm campo_busca" pesquisa="data_de" bd_externo="" id="busca_data_de_publicacao_de" placeholder="De" value="<?=$_SESSION[''.$mod.'data_de_publicacao_de']?>" style="height:34px;">
                                                        <span class="input-group-btn">
                                                            <button class="btn" type="button"><i class="fa fa-calendar"></i></button>
                                                        </span>
                                                    </div>

                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy"  data-date="">
                                                        <input type="text" class="form-control input-sm campo_busca" pesquisa="data_ate" bd_externo="" id="busca_data_de_publicacao_ate" placeholder="Até" value="<?=$_SESSION[''.$mod.'data_de_publicacao_ate']?>" style="height:34px;">
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
                                                    <option value="2" <? if(trim($_SESSION[''.$mod.'stat'])=="2") { echo " selected"; } ?>>PRODUÇÃO</option>
                                                    <option value="3" <? if(trim($_SESSION[''.$mod.'stat'])=="3") { echo " selected"; } ?>>ENCERRADO AUTO</option>
                                                    <option value="4" <? if(trim($_SESSION[''.$mod.'stat'])=="4") { echo " selected"; } ?>>ENCERRADO MANUAL</option>
                                                    <option value="5" <? if(trim($_SESSION[''.$mod.'stat'])=="5") { echo " selected"; } ?>>PRIMEIRA DOSE</option>
                                                    <option value="6" <? if(trim($_SESSION[''.$mod.'stat'])=="6") { echo " selected"; } ?>>SEGUNDA DOSE</option>
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
                                                <th style="width:250px;">Plataforma</th>
                                                <? } ?>
                                                <? if(trim($mostraEmpresa)=="1") { ?>
                                                <th style="width:250px;">Empresa</th>
                                                <? } ?>
                                                <th>Nome</th>
                                                <th style="width:170px;">Data do Evento</th>
                                                <th style="width:170px;">Data de Publicação</th>
                                                <th style="width:160px;">Status</th>
                                                <th style="width:135px;"></th>
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
													mod_".$mod.".plataforma,
													mod_".$mod.".empresa,
													mod_".$mod.".id,
													mod_".$mod.".numeroUnico,
													mod_".$mod.".nome,
													mod_".$mod.".data_do_evento,
													mod_".$mod.".data_de_publicacao,
													mod_".$mod.".notifica_no_cadastro,
													mod_".$mod.".stat,
													mod_".$mod.".data,

													mod_empresa.nome AS empresa_nome,
													mod_plataforma.nome AS plataforma_nome
												
												FROM 
													".$mod." AS mod_".$mod." 
												LEFT JOIN 
													empresa AS mod_empresa ON (mod_empresa.id = mod_".$mod.".empresa)
												LEFT JOIN 
													empresa AS mod_plataforma ON (mod_plataforma.id = mod_".$mod.".plataforma)
												
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
													empresa AS mod_plataforma ON (mod_plataforma.id = mod_".$mod.".plataforma)
												
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

												$_SESSION['eventos_tickets_'.$rSql['numeroUnico'].''] = "";
												$_SESSION['eventos_lotes_'.$rSql['numeroUnico'].''] = "";
												$_SESSION['eventos_horarios_'.$rSql['numeroUnico'].''] = "";
												$_SESSION['numeroUnicoGerado'] = "";

												$idSend = $rSql['id'];
												if(trim($rSql['empresa'])=="" || trim($rSql['empresa'])=="0") {
													$empresaSet = "<i>Sem empresa setada</i>";
												} else {
													$empresaSet = "".$rSql['empresa_nome']."";
												}

												if(trim($rSql['plataforma'])=="" || trim($rSql['plataforma'])=="0") {
													$plataformaSet = "<i>Sem plataforma</i>";
												} else {
													$plataformaSet = "".$rSql['plataforma_nome']."";
												}

												if(trim($rSql['stat'])=="0") {
													$stat0Set = " style=\"display:block;padding: 3px 5px;width:140px !important;text-align:center;\" ";
													$stat1Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;\" ";
													$stat2Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#939 !important;border-color:#939 !important;\" ";
													$stat3Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#000 !important;border-color:#000 !important;\" ";
													$stat4Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#000 !important;border-color:#000 !important;\" ";
													$stat5Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#b307c3 !important;border-color:#b307c3 !important;\" ";
													$stat6Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#e04e89 !important;border-color:#e04e89 !important;\" ";
												} else if(trim($rSql['stat'])=="1") {
													$stat0Set = " style=\"display:none;padding: 3px 5px;width:140px !important;text-align:center;\" ";
													$stat1Set = " style=\"display:block;padding: 3px 11px;width:140px !important;text-align:center;\" ";
													$stat2Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#939 !important;border-color:#939 !important;\" ";
													$stat3Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#000 !important;border-color:#000 !important;\" ";
													$stat4Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#000 !important;border-color:#000 !important;\" ";
													$stat5Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#b307c3 !important;border-color:#b307c3 !important;\" ";
													$stat6Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#e04e89 !important;border-color:#e04e89 !important;\" ";
												} else if(trim($rSql['stat'])=="2") {
													$stat0Set = " style=\"display:none;padding: 3px 5px;width:140px !important;text-align:center;\" ";
													$stat1Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;\" ";
													$stat2Set = " style=\"display:block;padding: 3px 11px;width:140px !important;text-align:center;background-color:#939 !important;border-color:#939 !important;\" ";
													$stat3Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#000 !important;border-color:#000 !important;\" ";
													$stat4Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#000 !important;border-color:#000 !important;\" ";
													$stat5Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#b307c3 !important;border-color:#b307c3 !important;\" ";
													$stat6Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#e04e89 !important;border-color:#e04e89 !important;\" ";
												} else if(trim($rSql['stat'])=="3") {
													$stat0Set = " style=\"display:none;padding: 3px 5px;width:140px !important;text-align:center;\" ";
													$stat1Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;\" ";
													$stat2Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#939 !important;border-color:#939 !important;\" ";
													$stat3Set = " style=\"display:block;padding: 3px 11px;width:140px !important;text-align:center;background-color:#000 !important;border-color:#000 !important;\" ";
													$stat4Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#000 !important;border-color:#000 !important;\" ";
													$stat5Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#b307c3 !important;border-color:#b307c3 !important;\" ";
													$stat6Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#e04e89 !important;border-color:#e04e89 !important;\" ";
												} else if(trim($rSql['stat'])=="4") {
													$stat0Set = " style=\"display:none;padding: 3px 5px;width:140px !important;text-align:center;\" ";
													$stat1Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;\" ";
													$stat2Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#939 !important;border-color:#939 !important;\" ";
													$stat3Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#000 !important;border-color:#000 !important;\" ";
													$stat4Set = " style=\"display:block;padding: 3px 11px;width:140px !important;text-align:center;background-color:#000 !important;border-color:#000 !important;\" ";
													$stat5Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#b307c3 !important;border-color:#b307c3 !important;\" ";
													$stat6Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#e04e89 !important;border-color:#e04e89 !important;\" ";
												} else if(trim($rSql['stat'])=="5") {
													$stat0Set = " style=\"display:none;padding: 3px 5px;width:140px !important;text-align:center;\" ";
													$stat1Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;\" ";
													$stat2Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#939 !important;border-color:#939 !important;\" ";
													$stat3Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#000 !important;border-color:#000 !important;\" ";
													$stat4Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#000 !important;border-color:#000 !important;\" ";
													$stat5Set = " style=\"display:block;padding: 3px 11px;width:140px !important;text-align:center;background-color:#b307c3 !important;border-color:#b307c3 !important;\" ";
													$stat6Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#e04e89 !important;border-color:#e04e89 !important;\" ";
												} else if(trim($rSql['stat'])=="6") {
													$stat0Set = " style=\"display:none;padding: 3px 5px;width:140px !important;text-align:center;\" ";
													$stat1Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;\" ";
													$stat2Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#939 !important;border-color:#939 !important;\" ";
													$stat3Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#000 !important;border-color:#000 !important;\" ";
													$stat4Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#000 !important;border-color:#000 !important;\" ";
													$stat5Set = " style=\"display:none;padding: 3px 11px;width:140px !important;text-align:center;background-color:#b307c3 !important;border-color:#b307c3 !important;\" ";
													$stat6Set = " style=\"display:block;padding: 3px 11px;width:140px !important;text-align:center;background-color:#e04e89 !important;border-color:#e04e89 !important;\" ";
												}

												if(trim($rSql['notifica_no_cadastro'])=="1") {
													$notifica_no_cadastro1Set = " style=\"display:none;background-color:#00f076;padding:7px 5px 0px 5px;\" ";
													$notifica_no_cadastro0Set = " style=\"display:block;background-color:#CCC;padding:7px 5px 0px 5px;\" ";
												} else {
													$notifica_no_cadastro1Set = " style=\"display:block;background-color:#00f076;padding:7px 5px 0px 5px;\" ";
													$notifica_no_cadastro0Set = " style=\"display:none;background-color:#CCC;padding:7px 5px 0px 5px;\" ";
												}

												if (strripos($_SESSION["".$mod."ids_selecionados"], "|".$rSql['id']."|") === false) { $checked_set=""; } else { $checked_set = " checked=\"checked\" "; }
                                            ?>
                                            <tr id_linha="<?=$rSql['id']?>" cor_anterior="<?=$cor_anterior_set?>" <?=$style_set?> role="row">
                                                <td><input id="check_<?=$rSql['id']?>" type="checkbox" name="msg_sel[]" title="" class="checkboxes check_<?=$mod?>" <?=$checked_set?> value="<?=$rSql['id']?>" /></td>
                                                <? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                                <td style="vertical-align:middle;"><?=$plataformaSet?></td>
                                                <? } ?>
                                                <? if(trim($mostraEmpresa)=="1") { ?>
                                                <td style="vertical-align:middle;"><?=$empresaSet?></td>
                                                <? } ?>
                                                <td style="vertical-align:middle;"><?=$rSql['nome']?></td>
                                                <td style="vertical-align:middle;"><?=ajustaDataReturn($rSql['data_do_evento'],"d/m/Y");?></td>
                                                <td style="vertical-align:middle;"><?=ajustaDataReturn($rSql['data_de_publicacao'],"d/m/Y");?></td>
                                                <td style="vertical-align:middle;">
                                                    <a href="javascript:void(0);" <?=$stat0Set?> id="stat_0_<?=$rSql['numeroUnico']?>" onclick="muda_lista_stat('<?=$rSql['numeroUnico']?>','1','<?=$mod?>');" class="btn btn-xs yellow-gold" title="Publicar"> INATIVO </a>
                                                    <a href="javascript:void(0);" <?=$stat1Set?> id="stat_1_<?=$rSql['numeroUnico']?>" onclick="muda_lista_stat('<?=$rSql['numeroUnico']?>','0','<?=$mod?>');" class="btn btn-xs green" title="Despublicar"> ATIVO </a>
                                                    <a href="javascript:void(0);" <?=$stat2Set?> id="stat_2_<?=$rSql['numeroUnico']?>" class="btn btn-xs green" title="Em Produção"> PRODUÇÃO </a>
                                                    <a href="javascript:void(0);" <?=$stat3Set?> id="stat_3_<?=$rSql['numeroUnico']?>" class="btn btn-xs green" title="Encerrado Automáticamente"> ENCERRADO AUTO </a>
                                                    <a href="javascript:void(0);" <?=$stat4Set?> id="stat_4_<?=$rSql['numeroUnico']?>" class="btn btn-xs green" title="Encerrado Manualmente"> ENCERRADO MANUAL </a>
                                                    <a href="javascript:void(0);" <?=$stat5Set?> id="stat_5_<?=$rSql['numeroUnico']?>" class="btn btn-xs green" title="Evento para Primeira Dose automática"> PRIMEIRA DOSE </a>
                                                    <a href="javascript:void(0);" <?=$stat6Set?> id="stat_6_<?=$rSql['numeroUnico']?>" class="btn btn-xs green" title="Evento para Primeira Dose e Segunda Dose automática"> SEGUNDA DOSE </a>
                                                </td>
                                                <td style="vertical-align:middle;" class="block_check_click">
                                                    <div class="btn-group">
                                                        <? $chave_gerada = geraCodReturn()."/"; ?>
                                                        
                                                        <a href="javascript:void(0);" <?=$notifica_no_cadastro1Set?> id="notifica_no_cadastro_1_<?=$rSql['numeroUnico']?>" 
                                                        onclick="muda_lista_notifica_no_cadastro('<?=$rSql['numeroUnico']?>','1');" class="btn btn-sm" title="Ativar o Evento para Envio Automático">
                                                        <i style="color:#FFF;font-size:25px;" class="far fa-play-circle"></i></a>
                                                        
                                                        <a href="javascript:void(0);" <?=$notifica_no_cadastro0Set?> id="notifica_no_cadastro_0_<?=$rSql['numeroUnico']?>" 
                                                        onclick="muda_lista_notifica_no_cadastro('<?=$rSql['numeroUnico']?>','0');" class="btn btn-sm" title="Pausar o Evento para Envio Automático">
                                                        <i style="color:#000;font-size:25px;" class="far fa-pause-circle"></i></a>

                                                        <a class="btn btn-sm blue-madison" 
                                                        href="<?=$link?><?=$chave_gerada?><?=$_SESSION['var1']?>/<?=$_SESSION['var2']?>/<?=$rSql['numeroUnico']?>/" title="Editar Item"><i class="fa fa-edit"></i></a>
                                                        
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
