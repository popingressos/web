<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/chave.php");

$mod = $_SESSION['mod'];
$where = filtro_tabela();
$where = "".$where." AND (mod_".$mod.".stat='0' OR mod_".$mod.".stat='1')";

if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
} else {
	$where = str_replace("mod_".$mod.".empresa='".$sysusu['empresa']."'","(mod_".$mod.".empresa='".$sysusu['empresa']."' OR mod_".$mod.".plataforma='".$sysusu['empresa']."')",$where);
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
									@media (max-width: 992px) {
										.hide-on-mobile{display:none !important}
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
                                                <th style="width:250px;vertical-align:top;">
                                                <select id="busca_idsysgrupousuario" class="form-control bs-select campo_busca" pesquisa="igual" bd_externo="" data-live-search="true" data-show-subtext="true">
                                                    <option value="">---</option>
                                                    <?
                                                    if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
                                                        $where_sysgrupousuario = "WHERE mod_sysgrupousuario.tipo='padrao'";
                                                    } else {
                                                        $where_sysgrupousuario = "WHERE mod_sysgrupousuario.tipo='padrao' AND mod_sysgrupousuario.empresa='".$sysusu['empresa']."'";
                                                    }
                                                    $qSqlItem = mysql_query("
                                                                            SELECT 
                                                                                mod_sysgrupousuario.id, 
                                                                                mod_sysgrupousuario.nome, 
                                                                                mod_sysgrupousuario.id, 
        
                                                                                mod_empresa.nome AS empresa_nome
                                                                            FROM 
                                                                                sysgrupousuario AS mod_sysgrupousuario
                                                                            LEFT JOIN empresa AS mod_empresa ON (mod_empresa.id = mod_sysgrupousuario.empresa)
                                                                            ".$where_sysgrupousuario."
                                                                            ORDER BY 
                                                                                mod_sysgrupousuario.nome
                                                                            ");
                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
														if(trim($rSqlItem['empresa_nome'])=="") {
															$rSqlItem['empresa_nome'] = "Sem empresa setada - ";
														} else {
															$rSqlItem['empresa_nome'] = "".$rSqlItem['empresa_nome']." - ";
														}
                                                    ?>
                                                    <option value="<?= $rSqlItem['id'] ?>"  <? if(trim($_SESSION[''.$mod.'idsysgrupousuario'])==trim($rSqlItem['id'])) { echo " selected"; } ?>><?=$rSqlItem['empresa_nome']?><?=$rSqlItem['nome']?></option>
                                                    <? } ?>
                                                </select>
                                                </th>
                                                <th style="vertical-align:top;"><input type="text" onKeyPress="return submitarPersoal(event)" style="height: 34px;" pesquisa="like" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_nome" value="<?=$_SESSION[''.$mod.'nome']?>"></th>
                                                <th style="vertical-align:top;"><input type="text" onKeyPress="return submitarPersoal(event)" style="height: 34px;" pesquisa="like" bd_externo="" class="form-control form-filter input-sm campo_busca" id="busca_email" value="<?=$_SESSION[''.$mod.'email']?>"></th>
                                                <th class="hide-on-mobile" style="vertical-align:top;">
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
                                                <th class="hide-on-mobile" style="vertical-align:top;">
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
                                                <th style="width:140px;">Grupo de Permissão</th>
                                                <th>Nome</th>
                                                <th style="width:170px;">E-mail</th>
                                                <th class="hide-on-mobile" style="width:170px;">Data de Inserção</th>
                                                <th class="hide-on-mobile" style="width:130px;">Status</th>
                                                <th style="width:210px;"></th>
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
													mod_".$mod.".cod_voucher,
													mod_".$mod.".nome,
													mod_".$mod.".email,
													mod_".$mod.".whatsapp,
													mod_".$mod.".numeroUnico,
													mod_".$mod.".stat,
													mod_".$mod.".data,

													mod_sysgrupousuario.nome as sysgrupousuario_nome,
													mod_empresa.nome AS empresa_nome
												
												FROM 
													".$mod." AS mod_".$mod." 
												LEFT JOIN 
													empresa AS mod_empresa ON (mod_empresa.id = mod_".$mod.".empresa)
												LEFT JOIN 
													sysgrupousuario AS mod_sysgrupousuario ON (mod_sysgrupousuario.id = mod_sysusu.idsysgrupousuario)
												
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
													sysgrupousuario AS mod_sysgrupousuario ON (mod_sysgrupousuario.id = mod_sysusu.idsysgrupousuario)
												
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

												if (strripos($_SESSION["".$mod."ids_selecionados"], "|".$rSql['id']."|") === false) { $checked_set=""; } else { $checked_set = " checked=\"checked\" "; }
                                            ?>
                                            <tr id_linha="<?=$rSql['id']?>" cor_anterior="<?=$cor_anterior_set?>" <?=$style_set?> role="row">
                                                <td><input id="check_<?=$rSql['id']?>" type="checkbox" name="msg_sel[]" title="" class="checkboxes check_<?=$mod?>" <?=$checked_set?> value="<?=$rSql['id']?>" /></td>
                                                <? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                                <td style="vertical-align:middle;"><?=$empresaSet?></td>
                                                <? } ?>
                                                <td style="vertical-align:middle;"><?=$rSql['sysgrupousuario_nome']?></td>
                                                <td style="vertical-align:middle;"><?=$rSql['nome']?></td>
                                                <td style="vertical-align:middle;"><?=$rSql['email']?></td>
                                                <td class="hide-on-mobile" style="vertical-align:middle;"><?=ajustaDataReturn($rSql['data'],"d/m/Y");?></td>
                                                <td class="hide-on-mobile" style="vertical-align:middle;">
                                                    <a href="javascript:void(0);" <?=$stat1Set?> id="stat_1_<?=$rSql['numeroUnico']?>" onclick="muda_stat('<?=$mod?>','<?=$rSql['id']?>','0');" class="btn btn-xs green" title="Despublicar"> ATIVO </a>
                                                    <a href="javascript:void(0);" <?=$stat0Set?> id="stat_0_<?=$rSql['numeroUnico']?>" onclick="muda_stat('<?=$mod?>','<?=$rSql['id']?>','1');" class="btn btn-xs yellow-gold" title="Publicar"> INATIVO </a>
                                                </td>
                                                <td style="vertical-align:middle;" class="block_check_click">

                                                    <a href="javascript:void(0);" 
                                                       data-toggle="modal" data-target="#modal-qrcode-<?=$rSql['id']?>"
                                                       class="btn btn-xs green-jungle" style="background-color:#3CF;color:#FFF;" 
                                                       title="Estornar Compra"> <i style="color:#FFF;" class="fas fa-qrcode"></i> </a>
													
													<? if(trim($_construtor_sysperm['admin_sysacesso'])==1) { ?>
                                                        <a href="<?=$link?><?=$chave_gerada?>sistema/usuarios/historico-de-acessos/<?=$rSql['id']?>/" class="btn btn-xs green-jungle" title="Histórico de Acessos"><i class="icon-login"></i></a>
													<? } ?>
                                                    <? if(trim($_construtor_sysperm['admin_syslog'])==1) { ?>
                                                        <a href="<?=$link?><?=$chave_gerada?>sistema/usuarios/historico-de-operacoes/<?=$rSql['id']?>/" class="btn btn-xs blue-chambray" title="Histórico de Operações"><i class="icon-layers"></i></a>
													<? } ?>
                                                    <? if(trim($_construtor_sysperm['visualizar_construtor_sysperm'])==1||trim($_construtor_sysperm['editar_construtor_sysperm'])==1) { ?>
                                                        <a href="<?=$link?><?=$chave_gerada?>sistema/usuarios/permissoes/<?=$rSql['id']?>/" class="btn btn-xs blue-steel" title="Permissões"><i class="fa fa-unlock-alt"></i></a>
													<? } ?>
                                                    <? if(trim($_construtor_sysperm['editar_'.$mod.''])==1) { ?>
                                                        <a href="<?=$link?><?=$chave_gerada?>sistema/usuarios/editar/<?=$rSql['id']?>/" class="btn btn-xs blue" title="Editar"><i class="fa fa-pencil"></i></a>
                                                    <? } ?>
                                                    <? if(trim($_construtor_sysperm['excluir_'.$mod.''])==1) { ?>
                                                        <a href="javascript:void(0);" onclick="remover_item_tabela('<?=$rSql['id']?>','<?=$mod?>','NAO','');" title="Remover" class="btn btn-xs red-thunderbird"><i class="fa fa-times"></i></a>
                                                    <? } ?>

                                                    <div class="modal fade" id="modal-qrcode-<?=$rSql['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detalhes de Login #<?=$rSql['id']?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-qrcode-<?=$rSql['id']?>">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        	<div style="max-width: 500px;max-height: 500px;overflow:auto;">
                                                                <?
																if (file_exists("".$_SERVER['DOCUMENT_ROOT']."/admin/files/qrcode/".$rSql['cod_voucher'].".jpg")) { } else {
																	include_once("".$_SERVER['DOCUMENT_ROOT']."/admin/include/lib/phpqrcode/qrlib.php");
																	include_once("".$_SERVER['DOCUMENT_ROOT']."/admin/include/lib/phpqrcode/qrconfig.php");
																	
																	// generating 
																	QRcode::png($rSql['cod_voucher'], "".$_SERVER['DOCUMENT_ROOT']."/admin/files/qrcode/".$rSql['cod_voucher'].".jpg", QR_ECLEVEL_H, 450, 6); 
																}
																?>
                                                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                	<tr>
                                                                    	<td colspan="2" align="center" style="text-align:center;"><img style="width:350px !important;" src="https://www.saguarocomunicacao.com.br/admin/files/qrcode/<?=$rSql['cod_voucher']?>.jpg?<?=time();?>" /></td>
                                                                    </tr>
                                                                    <tr>
                                                                    	<td align="left" style="text-align:left;">
                                                                        <? if(trim($rSql['whatsapp'])=="") { } else { ?>
                                                                        <span class="green btn btn-sm" onclick="javascript:enviar_login_pdv_whats('<?=$rSql['id']?>');" title="Enviar via WhatsApp">Enviar via WhatsApp</span>
                                                                        <? } ?>
                                                                        </td>
                                                                    	<td align="right" style="text-align:right;">
                                                                        <? if(trim($rSql['email'])=="") { } else { ?>
                                                                        <span class="green btn btn-sm" onclick="javascript:enviar_login_pdv_email('<?=$rSql['id']?>');" title="Enviar via E-mail">Enviar via E-mail</span>
                                                                        <? } ?>
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
