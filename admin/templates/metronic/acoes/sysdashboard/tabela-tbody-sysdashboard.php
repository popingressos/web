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
                                                <th style="width:10px;" class="table-checkbox"><input type="checkbox" class="group-checkable" title="Selecionar todos"/></th>
                                                <th style="width:50px;">Ordem</th>
                                                <th>Nome</th>
                                                <th style="width:300px;">Módulo do Bloco</th>
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
													mod_".$mod.".id,
													mod_".$mod.".ordem,
													mod_".$mod.".nome,
													mod_".$mod.".modulo_do_bloco,
													mod_".$mod.".numeroUnico,
													mod_".$mod.".stat,
													mod_".$mod.".data
												
												FROM 
													".$mod." AS mod_".$mod." 
												
												WHERE 
													mod_".$mod.".idsysusu='".$sysusu['id']."'
			
												ORDER BY
													mod_".$mod.".ordem ASC
													
											";
													  
											$strSQL_N = "
												SELECT 
													COUNT(*)
												
												FROM 
													".$mod." AS mod_".$mod." 
												
												WHERE 
													mod_".$mod.".idsysusu='".$sysusu['id']."'
													";
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
													$stat1Set = " style=\"display:block;padding: 3px 11px;\" ";
													$stat0Set = " style=\"display:none;padding: 3px 5px;\" ";
												} else {
													$stat1Set = " style=\"display:none;padding: 3px 11px;\" ";
													$stat0Set = " style=\"display:block;padding: 3px 5px;\" ";
												}
												
												if($rSql['valor']>0) {
													$valorSet = "R$ ".number_format($rSql['valor'], 2, ',', '.')."";
												} else {
													$valorSet = "<i>Não informado</i>";
												}

												if (strripos($_SESSION["".$mod."ids_selecionados"], "|".$rSql['id']."|") === false) { $checked_set=""; } else { $checked_set = " checked=\"checked\" "; }


												if(trim($rSql['modulo_do_bloco'])=="resumo_financeiro_mes_atual") { $moduloBlocoSet = "Resumo Financeiro do mês atual"; } else 
												if(trim($rSql['modulo_do_bloco'])=="resumo_financeiro_total") { $moduloBlocoSet = "Resumo Financeiro Total"; } else 
												if(trim($rSql['modulo_do_bloco'])=="agenda_do_google") { $moduloBlocoSet = "Agenda do Google"; } else 
												if(trim($rSql['modulo_do_bloco'])=="vacinados_por_periodo_tabela") { $moduloBlocoSet = "Tabela de Vacinados por Período"; } else 
												if(trim($rSql['modulo_do_bloco'])=="vacinados_por_grupo_tabela") { $moduloBlocoSet = "Tabela de Vacinados por Grupo"; } else 
												if(trim($rSql['modulo_do_bloco'])=="vacinados_por_faixa_etaria_tabela") { $moduloBlocoSet = "Tabela de Vacinados por Faixa Etária"; } else 
												if(trim($rSql['modulo_do_bloco'])=="vacinados_por_periodo") { $moduloBlocoSet = "Gráfico de Vacinados por Período"; } else 
												if(trim($rSql['modulo_do_bloco'])=="vacinados_por_grupo") { $moduloBlocoSet = "Gráfico de Vacinados por Grupo"; } else 
												if(trim($rSql['modulo_do_bloco'])=="vacinados_por_faixa_etaria") { $moduloBlocoSet = "Gráfico de Vacinados por Faixa Etária"; } else 
												if(trim($rSql['modulo_do_bloco'])=="vacinados_por_mapa") { $moduloBlocoSet = "Vacinados por Mapa"; } else 
												if(trim($rSql['modulo_do_bloco'])=="agenda_de_treinos") { $moduloBlocoSet = "Tabela com Solicitações de Agenda de Treino"; } else 
												if(trim($rSql['modulo_do_bloco'])=="treinos_expirando") { $moduloBlocoSet = "Tabela com Treinos Expirando"; } else 
												if(trim($rSql['modulo_do_bloco'])=="agenda_unificada") { $moduloBlocoSet = "Agenda Unificada de Compromissos"; } else 
												if(trim($rSql['modulo_do_bloco'])=="acompanhamento_de_carrinho_de_compras") { $moduloBlocoSet = "Acompanhamento de Carrinho de Compras"; } else 
												if(trim($rSql['modulo_do_bloco'])=="acompanhamento_de_vendas_comercial") { $moduloBlocoSet = "Acompanhamento de Vendas do Comercial"; } else 
												if(trim($rSql['modulo_do_bloco'])=="acompanhamento_de_compras_comercial") { $moduloBlocoSet = "Acompanhamento de Compras do Comercial"; } else 
												if(trim($rSql['modulo_do_bloco'])=="acompanhamento_de_contas_a_pagar") { $moduloBlocoSet = "Acompanhamento de Contas à Pagar"; } else 
												if(trim($rSql['modulo_do_bloco'])=="acompanhamento_de_contas_a_receber") { $moduloBlocoSet = "Acompanhamento de Contas à Receber"; } else 
												if(trim($rSql['modulo_do_bloco'])=="agenda_de_eventos") { $moduloBlocoSet = "Agenda de Eventos"; } else 
												if(trim($rSql['modulo_do_bloco'])=="acompanhamento_de_vendas_de_evento") { $moduloBlocoSet = "Acompanhamento de Vendas de Evento"; } else 
												if(trim($rSql['modulo_do_bloco'])=="agenda_de_recursos") { $moduloBlocoSet = "Agenda de Recursos"; } else 
												if(trim($rSql['modulo_do_bloco'])=="acompanhamento_de_pessoas") { $moduloBlocoSet = "Acompanhamento de Cadastro de Pessoas"; } else 
												if(trim($rSql['modulo_do_bloco'])=="acompanhamento_de_solicitacoes") { $moduloBlocoSet = "Acompanhamento de Solicitações"; }
                                            ?>
                                            <tr id_linha="<?=$rSql['id']?>" cor_anterior="<?=$cor_anterior_set?>" <?=$style_set?> role="row">
                                                <td><input id="check_<?=$rSql['id']?>" type="checkbox" name="msg_sel[]" title="" class="checkboxes check_<?=$mod?>" <?=$checked_set?> value="<?=$rSql['id']?>" /></td>
                                                <td style="vertical-align:middle;"><?=$rSql['ordem']?></td>
                                                <td style="vertical-align:middle;"><?=$rSql['nome']?></td>
                                                <td style="vertical-align:middle;"><?=$moduloBlocoSet?></td>
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
