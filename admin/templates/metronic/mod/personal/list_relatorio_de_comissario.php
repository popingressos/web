<? if($geracao_relatorio==1) { ?> 
        <div class="col-md-12" style="padding:0px;margin-top:10px;">
    
            <div class="col-md-12">
    
                <div class="row" style="padding-left:0px;padding-right:0px;">
    
                    <div class="col-md-12 div_ativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;">
                        <div class="col-md-12" style="padding:5px;">
                            <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">

                                <h4 class="font-green-sharp" style="padding-bottom:10px;">
                                    <span style="width:100%;float:left;padding-bottom:10px;"><i class="fal fa-file-invoice" style="padding-right:10px;"></i><?=$row['empresa_nome']?></span>
                                    <span style="width:100%;font-size:12px;font-style:italic;"><?=$periodoGeracaoSet?></span>
                                </h4>

                                <?=$row['texto']?>
								<? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/gerador_de_relatorios-".$row['modelo_tipo'].".php"); ?>      
                                <?=$row['texto_rodape']?>
    
                            </div> 
                        </div>
                    </div>
                    <!-- END informacoes-basicas-->
    
                </div>
    
            </div>
        </div>
<? } else { ?>
	<? if($formulario==0) { ?> 
	
		<? 
		if($_SESSION["_SalvarS"]=="novo") {
			$_SESSION["_SalvarS"] = ""; 
		?>
		<script>
		window.setTimeout(function() {
			$("#alerta_popup").fadeOut();
		}, 5000);	
		</script>
		<div class="col-md-12" id="alerta_popup" style="margin-top:10px;padding:0px;">
			<div class="col-md-12">
				<div class="note note-success">
					<h3>INSERIDO COM SUCESSO</h3>
					<p>Para editar um item, procure o item desejado na listagem abaixo, e clique no ícone &nbsp;<span class="btn blue-madison"><i class="fa fa-edit"></i></span>
					</p>
				</div>
			</div>
		</div>
		<? } ?>
	
		<? 
		if($_SESSION["_SalvarS"]=="editar") {
			$_SESSION["_SalvarS"] = ""; 
		?>
		<script>
		window.setTimeout(function() {
			$("#alerta_editado").fadeOut();
		}, 5000);	
		</script>
		<div class="col-md-12" id="alerta_popup" style="margin-top:10px;padding:0px;">
			<div class="col-md-12">
				<div class="note note-success">
					<h3>ALTERAÇÕES SALVAS COM SUCESSO</h3>
					<p>Para editar um item, procure o item desejado na listagem abaixo, e clique no ícone &nbsp;<span class="btn blue-madison"><i class="fa fa-edit"></i></span>
					</p>
				</div>
			</div>
		</div>
		<? } ?>
	
		<div class="col-md-12" style="margin-bottom:10px;margin-top: 10px;">
			<div class="tabbable tabbable-custom">
				<div class="tab-content tab_content_principal" style="border:0px !important;padding:0px !important;">
					<div class="tab-pane active" id="lista">
						<div class="portlet light" style="padding:0px !important;margin-bottom:0px !important;">
							<div class="portlet-title" style="padding:10px 10px 0px 10px !important;">
		
								<?
								if(trim($_SESSION["".$mod."ids_selecionados"])!="") {
									$id_selecionados = $_SESSION["".$mod."ids_selecionados"];
									$id_selecionados = str_replace("||",",",$id_selecionados);
									$id_selecionados = str_replace("|","",$id_selecionados);
									$cont_selecionados = 0;
									if ($a = explode(",", $id_selecionados)) { // create parts
										foreach ($a as $s) {
											$cont_selecionados++;
										}
										if($cont_selecionados>1) {
											$txt_selecionados = "".$cont_selecionados." itens selecionados";
										} else {
											$txt_selecionados = "".$cont_selecionados." item selecionado";
										}
									}
								} else {
									$txt_selecionados = "0 itens selecionados";
								}
								?>
								<div class="col-md-6" id="info-itens" style="padding-top:13px;padding-left:0px;"><?=$txt_selecionados?></div>
		
								<div class="actions">
									<? if(trim($_SESSION["".$mod."ids_selecionados"])!="") { $displayCopiarSet = "block"; } else { $displayCopiarSet = "none"; }?>
									<div style="float:left;">
										<button id="btn-copiar-modulo" type="button" class="btn btn-circle btn-info btn-sm" href="javascript:void(0)" onclick="javascript:abre_popup('copiar','<?=$mod?>');" style="margin-right:10px;display:<?=$displayCopiarSet?>;padding: 7px 10px;">Copiar</button>
									</div>
									
									<div style="float:left;margin-right:10px;">
										<button type="button" class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" onclick="window.open('<?=$link?><?=geraCodReturn();?>/<?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/novo/','_self','');" style="padding: 7px 10px;">Adicionar Novo</button>
									</div>
		
									<div style="float:left;margin-right:10px;">
										<button type="button" class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm active" onclick="javascript:url_menu_limpa('<?=$mod?>','<?=$link?><?=geraCodReturn();?>/<?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/');" style="padding: 7px 10px;">Lista de Itens</button>
									</div>
		
									<div style="float:left;">
										<div class="btn-group">
											<a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
												<i class="fa fa-share"></i>
												<span class="hidden-xs"> Ações </span>
												<i class="fa fa-angle-down"></i>
											</a>
											<ul class="dropdown-menu pull-right">
												<li><a href="javascript:void(0);" class="controle_clique_edicao" onclick="acao_selecionados('excluir','');"><i class="fa fa-times"></i>&nbsp;Remover</a></li>
												<li><a href="javascript:void(0);" class="controle_clique_edicao" onclick="acao_selecionados('publicar','');"><i class="fa fa-check-circle"></i>&nbsp;Publicar</a></li>
												<li><a href="javascript:void(0);" class="controle_clique_edicao" onclick="acao_selecionados('despublicar','');"><i class="fa fa-minus-circle"></i>&nbsp;Despublicar</a></li>
												<li><a href="javascript:void(0);" class="controle_clique_edicao" onclick="acao_selecionados_clonar();"><i class="fa fa-copy"></i>&nbsp;Clonar</a></li>
											</ul>
										</div>
									</div>
								</div>
								<!-- FIM actions -->
							</div>
						</div>
						<!-- FIM portlet light -->
		
						<form name="list" action="<?=$link?><?=$chave_url?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" method="post" target="_self">
							<input type="hidden" id="qtd_itens_selecionados" value="0">
							<input type="hidden" name="copia_lista_itens" id="lista_checkboxes" value="<?=$_SESSION["".$_SESSION['mod']."ids_selecionados"]?>" style="width:500px;">
							<input type="hidden" name="script_script" id="script_script" value="">
							<input type="hidden" name="script_campo" id="script_campo" value="">
							<input type="hidden" name="copia_tipo" id="copia_tipo_lista" value="">
							<input type="hidden" name="aba" id="aba_lista" value="">
							<input type="hidden" name="subMod" value="">
							<input type="hidden" name="acaoForm" id="acaoForm_lista" value="">
							<input type="hidden" name="modulo" value="<?=$mod?>">
			
							<div id="datatable_ajax_tbody" style="padding:0px 10px 10px 10px !important;">
								<? 
								include("./templates/".$layout_padrao_set."/acoes/personal/tabela-tbody-".$mod.".php"); 
								?>
							</div>
						</form>
		
					</div>
					<!-- END TAB_LISTA-->
		
				</div>
				<!-- END TAB CONTENT-->
			</div>
		</div>
	
	<? } else { ?>
	
		<div class="col-md-12" style="padding:0px;margin-top:10px;">
	
			<div class="col-md-12">
	
				<style>
				.div_ativo {
					display:block;
				}
				.div_inativo {
					display:none;
				}
				.box_ativo {
					background-color:#1ab394;
					padding:10px;
					border-radius:5px !important;
					color:#FFF;
					cursor:pointer;
				}
				.box_inativo {
					background-color:#ffffff;
					padding:10px;
					border-radius:5px !important;
					color: #1ab394;
					cursor:pointer;
				}
				.box_inativo:hover {
					background-color:#33d8b7;
					padding:10px;
					border-radius:5px !important;
					color: #ffffff;
					cursor:pointer;
				}
	
				.col-md-2-5 {
					position: relative;
					min-height: 1px;
				}
				@media (min-width: 992px) {
					.col-md-2-5 {
						width: 20%;
					}
					.col-md-2-5 {
						float: left;
					}
				}
				</style>
				<div class="row" style="padding-left:0px;padding-right:0px;">
					<input type="hidden" id="url_post" value="<?=$link?><?=$chave_url?><?=$_SESSION['var1']?>/<?=$_SESSION['var2']?>/" />
					<form name="forms" method="post" action="<?=$link?><?=$chave_url?><?=$_SESSION['var1']?>/<?=$_SESSION['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="formulario" class="form-horizontal form-bordered form-row-stripped">
						<input type="hidden" id="campos_alterados" value="0" />
						<input type="hidden" name="aba" id="aba" value="" />
						<input type="hidden" name="subMod" value="" />
	
						<? 
						if(trim($_REQUEST['var3'])=="novo") {
							$tipo_form_set = "add";
						} else {
							$tipo_form_set = "editar";
						}
						
						echo "<input type=\"hidden\" name=\"acaoLocal\" value=\"interno\" />";
						echo "<input type=\"hidden\" name=\"acaoForm\" id=\"idacaoForm\" value=\"".$tipo_form_set."\" />";
						echo "<input type=\"hidden\" name=\"modulo\" id=\"modulo\" value=\"gerador_de_relatorios_add\" />";
						
						if($tipo_form_set=="add") {
							if(trim($_SESSION['numeroUnicoGerado'])=="") {
								$numeroUnicoGerado = geraCodReturn();
								$_SESSION['numeroUnicoGerado'] = $numeroUnicoGerado;
							} else {
								$numeroUnicoGerado = $_SESSION['numeroUnicoGerado'];
							}
							
							$id_redator_set = $sysusu['id'];
							$nome_redator_set = $sysusu['nome'];
							$iditem_input = "<input type=\"hidden\" name=\"iditem\" id=\"iditem\" value=\"\" />";
						} else {
							$numeroUnicoGerado = $row['numeroUnico'];
							$_SESSION['numeroUnicoGerado'] = $numeroUnicoGerado;
							
							$id_redator_set = $row['idsysusu'];
							$nome_redator_set = $lista_array_usuarios[$row['idsysusu']]['nome'];
							$iditem_input = "<input type=\"hidden\" name=\"iditem\" id=\"iditem\" value=\"".$row['id']."\" />";
							$id_item_row_input = "<input type=\"hidden\" id=\"id_item_row\" value=\"".$row['id']."\" />";

							if(trim($_SESSION['campos_cabecalho_'.$_SESSION['numeroUnicoGerado'].''])=="") {
								$_SESSION['campos_cabecalho_'.$_SESSION['numeroUnicoGerado'].''] = $row['campos_cabecalho'];
							} else {
								$_SESSION['campos_cabecalho_'.$_SESSION['numeroUnicoGerado'].''] = $_SESSION['campos_cabecalho_'.$_SESSION['numeroUnicoGerado'].''];
							}
							
							#$_SESSION['campos_cabecalho_'.$_SESSION['numeroUnicoGerado'].''] = "";
	
						}
						
						echo "".$iditem_input."";
						echo "<input type=\"hidden\" name=\"numeroUnico\" id=\"numeroUnico\" value=\"".$_SESSION['numeroUnicoGerado']."\" />";
						echo "<input type=\"hidden\" name=\"idsysusu\" value=\"".$id_redator_set."\" />";
						echo "".$id_item_row_input."";
	
						?>
					<div class="col-md-12 div_ativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="informacoes-basicas">
						<div class="col-md-6" style="padding:5px;">
							<div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
								<h4 class="font-green-sharp">
									<span style="width:100%;float:left;"><i class="fal fa-user-circle" style="padding-right:10px;"></i>Informações básicas</span>
									<span style="width:100%;font-size:12px;font-style:italic;">Configurações dos itens</span>
								</h4>
		
								<?
								if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
									$sysusu_empresaSet = "".$sysusu['empresa']."";
								} else {
									$rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT plataforma FROM empresa WHERE id='".$sysusu['empresa']."'"));
									if(trim($rSqlPlataforma['plataforma'])=="" || trim($rSqlPlataforma['plataforma'])=="0") {
										$sysusu_empresaSet = "0";
										$filtro_empresaSet = " AND mod_empresa.plataforma='".$sysusu['empresa']."' ";
									} else { 
										$sysusu_empresaSet = "".$sysusu['empresa']."";
									}
								}
								?>
                                
								<? if(trim($sysusu_empresaSet)=="" || trim($sysusu_empresaSet)=="0") { ?> 
								<div class="form-group">
									<label class="control-label col-md-12" style="text-align:left;">Empresa</label>
									<div class="col-md-12">
										<select name="empresa" id="empresa" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:relatorio_de_comissario_seleciona_empresa();">
											<option value="">---</option>
											<?
											$qSqlItem = mysql_query("
																	SELECT 
																		mod_empresa.id,
																		mod_empresa.nome
																		 
																	FROM 
																		empresa AS mod_empresa 
																	WHERE
																		(mod_empresa.stat='0' OR mod_empresa.stat='1') ".$filtro_empresaSet."
																	ORDER BY 
																		mod_empresa.nome");
											while($rSqlItem = mysql_fetch_array($qSqlItem)) {
											?>
											<option value="<?= $rSqlItem['id'] ?>" <? if(trim($row['empresa'])==trim($rSqlItem['id'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
											<? } ?>
										</select>
									</div>
								</div>
								<? } else { ?>
								<input type="hidden" name="empresa" id="empresa" value="<?=$sysusu['empresa']?>" />
								<? } ?>
	
								<? if(strrpos($_construtor_sysperm['modulo_gerador_de_relatorios'],"|nome|") === false) { ?>
                                <div class="form-group">
									<label class="control-label col-md-12" style="text-align:left;">Título do Relatório</label>
									<div class="col-md-12">
										<input value="<?=$row['nome']?>" id="nome" name="nome" type="text" class="form-control" />
									</div>
								</div>
                                <? } ?>
	
								<? if(strrpos($_construtor_sysperm['modulo_gerador_de_relatorios'],"|texto|") === false) { ?>
                                <div class="form-group">
									<label class="control-label col-md-12" style="text-align:left;">Texto do Relatório Topo</label>
									<div class="col-md-12">
										<textarea class="form-control ckeditor" id="texto" name="texto"><?=$row['texto']?></textarea>
										<p class="help-block">Esté texto acima será apresentado no topo do relatório na versão <b>PDF</b> e <b>Visualização em Tela</b>, como um adendo, explicação ou algum detalhamento extra.</p>
									</div>
								</div>
                                <? } ?>
	
								<? if(strrpos($_construtor_sysperm['modulo_gerador_de_relatorios'],"|texto_rodape|") === false) { ?>
                                <div class="form-group">
									<label class="control-label col-md-12" style="text-align:left;">Texto do Relatório Rodapé</label>
									<div class="col-md-12">
										<textarea class="form-control ckeditor" id="texto_rodape" name="texto_rodape"><?=$row['texto_rodape']?></textarea>
										<p class="help-block">Esté texto acima será apresentado no rodapé do relatório na versão <b>PDF</b> e <b>Visualização em Tela</b>, como um adendo, explicação ou algum detalhamento extra.</p>
									</div>
								</div>
                                <? } ?>
	
							</div>
						</div>
	
						<div class="col-md-6" style="padding:5px;">
							<div class="col-md-12" style="background-color:#FFF;padding:10px;margin-bottom:10px;margin-bottom:100px;">
								<h4 class="font-green-sharp">
									<span style="width:100%;float:left;"><i class="fal fa-layer-plus" style="padding-right:10px;"></i>Configurações de Geração</span>
									<span style="width:100%;font-size:12px;font-style:italic;">Preencha os campos abaixo para configurar como será executada a geração deste relatório</span>
								</h4>
	
								<?
								if(trim($row['empresa'])=="" || trim($row['empresa'])=="0") {
									if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
										$DIV_configuracoes_alerta_display = "block";
										$DIV_configuracoes_display = "none";
									} else {
										$DIV_configuracoes_alerta_display = "none";
										$DIV_configuracoes_display = "block";
									}
								} else {
									$DIV_configuracoes_alerta_display = "none";
									$DIV_configuracoes_display = "block";
								}
								?>

                                <div class="col-md-12" id="DIV_configuracoes_alerta" style="margin-top:10px;padding:0px;display:<?=$DIV_configuracoes_alerta_display?>">
                                    <div class="note note-success">
                                        <p>Para criar e acessar as configurações, você deve selecionar uma empresa antes</p>
                                    </div>
                                </div>

								<div id="DIV_configuracoes" style="display:<?=$DIV_configuracoes_display?>;">
								
                                <input type="hidden" name="modelo_tipo" id="modelo_tipo" value="item" />
                                <input type="hidden" name="local_filtro" id="local_filtro" value="carrinho_notificacao_comissario" />
                                <input type="hidden" name="modulo_tipo" id="modulo_tipo" value="eventos_notificacao" />
                                
								<?
								if(trim($row['local_filtro'])=="") {
									$DIV_modulo_tipo_display = "none";
								} else {
									$DIV_modulo_tipo_display = "block";
								}
								?>

								<?
								$localBaseSet = "carrinho_notificacao_comissario";
								?>

								<div class="form-group" style="display:block;">
									<label class="control-label col-md-12" style="text-align:left;">Usuários/Comissários</label>
									<div class="col-md-12">
										<select id="TI_numeroUnico_comissario_itens" class="multi-select input-sm" multiple="multiple">
                                            
											<? if($tipo_form_set=="add") { } else { ?>
											<?
											$qSqlItem = mysql_query("
																	SELECT 
																		mod_sysusu.id,
																		mod_sysusu.numeroUnico,
																		mod_sysusu.nome
																		 
																	FROM 
																		sysusu AS mod_sysusu 
																	WHERE
																		(mod_sysusu.stat='0' OR mod_sysusu.stat='1') AND
																		 mod_sysusu.empresa='".$row['empresa']."'
																	ORDER BY 
																		mod_sysusu.nome");
											while($rSqlItem = mysql_fetch_array($qSqlItem)) {
											?>
                                            <option value="|<?=$rSqlItem['numeroUnico']?>|"  <? if(strrpos($row['numeroUnico_comissario'],"|".$rSqlItem['numeroUnico']."|") === false) { } else { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                            <? } ?>
                                            <? } ?>

										</select>
										<input value="<?=$row['numeroUnico_comissario']?>" type="hidden" name="numeroUnico_comissario" id="TI_numeroUnico_comissario" />
										<p style="color:#169ef4;" class="help-block">Escolha acima qual os usuários que devem ser aplicados na geração.</p>
									</div>
								</div>

								<div class="form-group" id="DIV_status_do_filtro" style="display:block;">
									<label class="control-label col-md-12" style="text-align:left;">Status dos Itens</label>
									<div class="col-md-12">
										<select id="TI_status_do_filtro_itens" class="multi-select input-sm" multiple="multiple">
                                            
                                        	<optgroup label="Situação de Pagos/Estornados/Recusados">
                                                <option value="|stat_1|"  <? if(strrpos($row['status_do_filtro'],"|stat_1|") === false) { } else { echo "selected"; } ?>>Pagos</option>
                                                <option value="|stat_3|"  <? if(strrpos($row['status_do_filtro'],"|stat_3|") === false) { } else { echo "selected"; } ?>>Estornados</option>
                                                <option value="|stat_7|"  <? if(strrpos($row['status_do_filtro'],"|stat_7|") === false) { } else { echo "selected"; } ?>>Recusados</option>
                                            </optgroup>
										</select>
										<input value="<?=$row['status_do_filtro']?>" type="hidden" name="status_do_filtro" id="TI_status_do_filtro" />
										<p style="color:#169ef4;" class="help-block">Escolha acima qual o tipo de filtro que deve ser aplicado na geração.</p>
									</div>
								</div>
	
								<div class="form-group" id="DIV_device" style="display:block;">
									<label class="control-label col-md-12" style="text-align:left;" id="DIV_device_label">Locais de Venda</label>
									<div class="col-md-12">
										<select id="TI_device_itens" class="multi-select input-sm" multiple="multiple">
										<option value="|SITE|"  <? if(strrpos($row['device'],"|SITE|") === false) { } else { echo "selected"; } ?>>Vendas via Site</option>
										<option value="|APP|"  <? if(strrpos($row['device'],"|APP|") === false) { } else { echo "selected"; } ?>>Vendas via Aplicativo</option>
										</select>
										<input value="<?=$row['device']?>" type="hidden" name="device" id="TI_device" />
										<p style="color:#169ef4;" class="help-block">Escolha acima os itens que deverão ser inseridos no relatório, caso nenhum seja selecionado, por padrão todos serão exibidos.</p>
									</div>
								</div>

	
								<div class="form-group" id="DIV_numeroUnico_itens" style="display:block;">
									<label class="control-label col-md-12" style="text-align:left;" id="DIV_numeroUnico_itens_label">Eventos</label>
									<div class="col-md-12">
										<select id="TI_numeroUnico_itens_itens" class="multi-select input-sm" multiple="multiple">
											<?
											if(trim($_REQUEST['var3'])=="novo") { } else {
                                            $modSet = "eventos";
                                            $campoTickets = "mod_".$modSet.".tickets,";
                                            $campoLotes = "mod_".$modSet.".lotes,";
                                            
                                            $rItemArray = array();
                                            $qSqlItem = mysql_query("
                                                                    SELECT 
                                                                        ".$campoTickets."
                                                                        ".$campoLotes."
                                                                        mod_".$modSet.".numeroUnico,
                                                                        mod_".$modSet.".nome
                                                                         
                                                                    FROM 
                                                                        ".$modSet." AS mod_".$modSet." 
                                                                    WHERE
                                                                        mod_".$modSet.".empresa='".$row['empresa']."' 
                                                                    ORDER BY 
                                                                        mod_".$modSet.".nome");
                                            while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                if(strrpos($row['numeroUnico_itens'],"|".$rSqlItem['numeroUnico']."|") === false) { } else {
                                                    $rItemArray[] = $rSqlItem;
                                                }
                                            ?>
                                            <option value="|<?= $rSqlItem['numeroUnico'] ?>|"  <? if(strrpos($row['numeroUnico_itens'],"|".$rSqlItem['numeroUnico']."|") === false) { } else { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                            <? } ?>
                                            <? } ?>
										</select>
										<input value="<?=$row['numeroUnico_itens']?>" type="hidden" name="numeroUnico_itens" id="TI_numeroUnico_itens" />
										<p style="color:#169ef4;" class="help-block">Escolha acima os itens que deverão ser inseridos no relatório, caso nenhum seja selecionado, por padrão todos serão exibidos.</p>
									</div>
								</div>

								<div class="form-group" id="DIV_numeroUnico_ticket" style="display:block;">
									<label class="control-label col-md-12" style="text-align:left;" id="DIV_numeroUnico_ticket_label">Tickets</label>
									<div class="col-md-12">
										<select id="TI_numeroUnico_ticket_itens" class="multi-select input-sm" multiple="multiple">
										<?
										for ($rowArray = 0; $rowArray < count($rItemArray); $rowArray++) {
											$rSqlItem = $rItemArray[$rowArray];
										?>
                                        <optgroup label="<?=$rSqlItem['nome']?>">
										<?
											$ticketsArray = unserialize($rSqlItem['tickets']);
											$ticketsArray = array_sort($ticketsArray, 'ticket_data', SORT_ASC);
											foreach ($ticketsArray as $key_ticket => $value_ticket) {
										?>
										<option value="|<?= $value_ticket['numeroUnico'] ?>|"  <? if(strrpos($row['numeroUnico_ticket'],"|".$value_ticket['numeroUnico']."|") === false) { } else { echo "selected"; } ?>><?=$value_ticket['ticket_nome']?></option>
											<? } ?>
                                        </optgroup>
										<? } ?>
										
										</select>
										<input value="<?=$row['numeroUnico_ticket']?>" type="hidden" name="numeroUnico_ticket" id="TI_numeroUnico_ticket" />
										<p style="color:#169ef4;" class="help-block">Escolha acima os itens que deverão ser inseridos no relatório, caso nenhum seja selecionado, por padrão todos serão exibidos.</p>
									</div>
								</div>
	
								<div class="form-group" id="DIV_numeroUnico_lote" style="display:block;">
									<label class="control-label col-md-12" style="text-align:left;" id="DIV_numeroUnico_lote_label">Lotes</label>
									<div class="col-md-12">
										<select id="TI_numeroUnico_lote_itens" class="multi-select input-sm" multiple="multiple">
										<?
										$cont_ticket = 0;
										for ($rowArray = 0; $rowArray < count($rItemArray); $rowArray++) {
											$rSqlItem = $rItemArray[$rowArray];

											$ticketsArray = unserialize($rSqlItem['tickets']);
											$ticketsArray = array_sort($ticketsArray, 'ticket_data', SORT_ASC);
											foreach ($ticketsArray as $key_ticket => $value_ticket) {
												$cont_ticket++;

										?>
                                            <optgroup label="<?=$cont_ticket?> - <?=$rSqlItem['nome']?> - <?=$value_ticket['ticket_nome']?>">
										<?
												$lotesArray = unserialize($rSqlItem['lotes']);
												$lotesArray = array_sort($lotesArray, 'lote', SORT_ASC);
												foreach ($lotesArray as $key_lote => $value_lote) {
													if(trim($value_ticket['numeroUnico'])==trim($value_lote['numeroUnico_ticket'])) {

										?>
                                                    <option value="|<?= $value_lote['numeroUnico'] ?>|"  <? if(strrpos($row['numeroUnico_lote'],"|".$value_lote['numeroUnico']."|") === false) { } else { echo "selected"; } ?>><?=$value_lote['lote']?>º Lote</option>
													<? } ?>
												<? } ?>
                                            </optgroup>
											<? } ?>
										<? } ?>
										
										</select>
										<input value="<?=$row['numeroUnico_lote']?>" type="hidden" name="numeroUnico_lote" id="TI_numeroUnico_lote" />
										<p style="color:#169ef4;" class="help-block">Escolha acima os itens que deverão ser inseridos no relatório, caso nenhum seja selecionado, por padrão todos serão exibidos.</p>
									</div>
								</div>

                                <div id="DIV_campos_cabecalho" style="width:100%;display:block;">
									<label class="control-label col-md-12" style="text-align:left;padding-left:0px;padding-bottom:5px;">Campos Selecionados para Exibição no Relatório</label>
									<div class="col-md-12" style="padding:0px !important;">
                                        <div class="col-md-6" id="gerador_de_relatorios-campos_cabecalho-campos" style="padding-left:0px;">
											<? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/gerador_de_relatorios-campos_cabecalho-campos.php"); ?>
                                        </div>
                                        <div class="col-md-6" id="gerador_de_relatorios-campos_cabecalho-lista" style="padding-right:0px;">
											<? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/gerador_de_relatorios-campos_cabecalho-lista.php"); ?>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="campo_ordem" id="campo_ordem" value="data" />

								<div class="form-group" id="DIV_campo_ordem">
									<label class="control-label col-md-12" style="text-align:left;">Campo de Ordenação Utilizado no Relatório</label>
									<div class="col-md-12">
										<select name="campo_ordem" id="campo_ordem" class="form-control bs-select" data-live-search="true" data-show-subtext="true">
											<option value="">---</option>
											<option value="pessoa_nome" <? if(trim($row['campo_ordem'])=="pessoa_nome") { echo " selected"; } ?>>Nome do Comprador</option>
											<option value="data" <? if(trim($row['campo_ordem'])=="data") { echo " selected"; } ?>>Data da Compra</option>
											<option value="dataConfirmado" <? if(trim($row['campo_ordem'])=="dataConfirmado") { echo " selected"; } ?>>Data de confirmação</option>
											<option value="dataBloqueado" <? if(trim($row['campo_ordem'])=="dataBloqueado") { echo " selected"; } ?>>Data de bloqueio</option>
											<option value="dataCancelado" <? if(trim($row['campo_ordem'])=="dataCancelado") { echo " selected"; } ?>>Data de cancelamento</option>
										</select>
									</div>
								</div>

								<div class="form-group" id="DIV_ordenacao" style="display:block;">
									<label class="control-label col-md-12" style="text-align:left;">Ordenação</label>
									<div class="col-md-12">
										<select name="ordenacao" id="ordenacao" class="form-control bs-select" data-live-search="true" data-show-subtext="true">
											<option value="">---</option>
											<option value="data_desc" <? if(trim($row['ordenacao'])=="data_desc") { echo " selected"; } ?>>Os mais novos primeiro</option>
											<option value="data_asc" <? if(trim($row['ordenacao'])=="data_asc") { echo " selected"; } ?>>Os mais antigos primeiro</option>
											<option value="alfabetica_a_z" <? if(trim($row['ordenacao'])=="alfabetica_a_z") { echo " selected"; } ?>>Alfabética - A para Z</option>
											<option value="alfabetica_z_a" <? if(trim($row['ordenacao'])=="alfabetica_z_a") { echo " selected"; } ?>>Alfabética - Z para A</option>
										</select>
									</div>
								</div>

								<div class="form-group" id="DIV_periodizacao" style="display:block;">
									<label class="control-label col-md-12" style="text-align:left;">Periodização</label>
									<div class="col-md-12">
										<select name="periodizacao" id="periodizacao" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:gerador_de_relatorios_periodizacao_tipo();">
											<option value="">---</option>
											<option value="completo" <? if(trim($row['periodizacao'])=="completo") { echo " selected"; } ?>>Completo - Do início até o momento da geração</option>
											<option value="0" <? if(trim($row['periodizacao'])=="0") { echo " selected"; } ?>>Hoje</option>
											<option value="1" <? if(trim($row['periodizacao'])=="1") { echo " selected"; } ?>>Último dia</option>
											<option value="2" <? if(trim($row['periodizacao'])=="2") { echo " selected"; } ?>>Últimos 2 dias</option>
											<option value="3" <? if(trim($row['periodizacao'])=="3") { echo " selected"; } ?>>Últimos 3 dias</option>
											<option value="4" <? if(trim($row['periodizacao'])=="4") { echo " selected"; } ?>>Últimos 4 dias</option>
											<option value="5" <? if(trim($row['periodizacao'])=="5") { echo " selected"; } ?>>Últimos 5 dias</option>
											<option value="6" <? if(trim($row['periodizacao'])=="6") { echo " selected"; } ?>>Últimos 6 dias</option>
											<option value="7" <? if(trim($row['periodizacao'])=="7") { echo " selected"; } ?>>Últimos 7 dias</option>
											<option value="15" <? if(trim($row['periodizacao'])=="15") { echo " selected"; } ?>>Últimos 15 dias</option>
											<option value="30" <? if(trim($row['periodizacao'])=="30") { echo " selected"; } ?>>Último mês</option>
											<option value="60" <? if(trim($row['periodizacao'])=="60") { echo " selected"; } ?>>Último bimestre</option>
											<option value="90" <? if(trim($row['periodizacao'])=="90") { echo " selected"; } ?>>Último trimestre</option>
											<option value="180" <? if(trim($row['periodizacao'])=="180") { echo " selected"; } ?>>Último semestre</option>
											<option value="365" <? if(trim($row['periodizacao'])=="365") { echo " selected"; } ?>>Último ano</option>
											<option value="personalizado" <? if(trim($row['periodizacao'])=="personalizado") { echo " selected"; } ?>>Personalizado</option>
										</select>
									</div>
								</div>

								<?
								if(trim($row['periodizacao'])=="personalizado") {
									$DIV_campo_intervalo_display = "block";
								} else {
									$DIV_campo_intervalo_display = "none";
								}
								?>
								<div class="form-group" id="DIV_campo_intervalo" style="display:<?=$DIV_campo_intervalo_display?>;">
									<label class="control-label col-md-12" style="text-align:left;">Campo de Intervalo Utilizado no Filtro (De - Até)</label>
									<div class="col-md-12">
										<select name="campo_intervalo" id="campo_intervalo" class="form-control bs-select" onchange="javascript:gerador_de_relatorios_campo_intervalo();" data-live-search="true" data-show-subtext="true">
											<option value="">---</option>
											<option value="data" <? if(trim($row['campo_intervalo'])=="data") { echo " selected"; } ?>>Data de compra</option>
											<option value="dataConfirmado" <? if(trim($row['campo_intervalo'])=="dataConfirmado") { echo " selected"; } ?>>Data de confirmação</option>
											<option value="dataBloqueado" <? if(trim($row['campo_intervalo'])=="dataBloqueado") { echo " selected"; } ?>>Data de bloqueio</option>
											<option value="dataCancelado" <? if(trim($row['campo_intervalo'])=="dataCancelado") { echo " selected"; } ?>>Data de cancelamento</option>
										</select>
									</div>
								</div>

								<?
								if(trim($row['campo_intervalo'])=="data" ||
										  trim($row['campo_intervalo'])=="dataConfirmado" || 
										  trim($row['campo_intervalo'])=="dataBloqueado" || 
										  trim($row['campo_intervalo'])=="dataCancelado") {
									$DIV_periodo_display = "block";
								} else {
									$DIV_periodo_display = "none";
								}

								if(trim($row['data_de'])=="") {
									$data_deSet = "";
								} else {
									$data_deSet = ajustaDataSemHoraReturn($row['data_de'],"d/m/Y");
								}
	
								if(trim($row['data_ate'])=="") {
									$data_ateSet = "";
								} else {
									$data_ateSet = ajustaDataSemHoraReturn($row['data_ate'],"d/m/Y");
								}
								?>
								<div class="form-group" id="DIV_periodo" style="display:<?=$DIV_periodo_display?>;">
									<div class="col-md-6" style="padding:0px;">
										<label class="control-label col-md-12" style="text-align:left;">Data de Início</label>
										<div class="col-md-12">
											<div class="col-md-12" style="padding:0px;">
												<div class="input-group date date-picker" id="TI_data_de" data-date-format="dd/mm/yyyy"  data-date="<?=$data_deSet?>">
													<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</span> 
													<input type="text" id="data_de" name="data_de" class="form-control input-sm" value="<?=$data_deSet?>" style="height: 34px;margin-top:0px;">
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<p class="help-block">Data que o relatório deve começar.</p>
										</div>
									</div>
									<div class="col-md-6" style="padding:0px;">
										<label class="control-label col-md-12" style="text-align:left;">Data de Fim</label>
										<div class="col-md-12">
											<div class="col-md-12" style="padding:0px;">
												<div class="input-group date date-picker" id="TI_data_ate" data-date-format="dd/mm/yyyy"  data-date="<?=$data_ateSet?>">
													<span class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</span> 
													<input type="text" id="data_ate" name="data_ate" class="form-control input-sm" value="<?=$data_ateSet?>" style="height: 34px;margin-top:0px;">
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<p class="help-block">Data que o relatório deve terminar.</p>
										</div>
									</div>
								</div>
	
                                </div>
                                <!-- END DIV_configuracoes -->
							</div>
	
						</div>
	
					</div>
					<!-- END informacoes-basicas-->
	
	
					</form>
	
				</div>
	
			</div>
		</div>
	
	
		<? if(trim($_REQUEST['var3'])=="novo") { $nome_btn = "Cadastrar Relatório"; } else { $nome_btn = "Salvar Mudanças"; } ?>
		<div class="botoes_salvar_rodape">
			<div class="row top-side">
				<!-- Inicio menu desktop-->
				<div class="col-xs-6 col-sm-12 botoes_de_salvar top-side-desktop">
					<button type="button" class="btn yellow-gold input-label" style="margin-left: 0px;" onclick="javascript:gerador_de_relatorios_salvar('<?=$tipo_form_set?>');" style=""><?=$nome_btn?></button>
					<button type="button" class="btn green input-label" style="margin-left: 0px;" onclick="javascript:gerador_de_relatorios_salvar('<?=$tipo_form_set?>-continuar');" style=""><?=$nome_btn?> e Continuar Editando</button>
				</div>
				<!-- Fim menu desktop-->
			</div>
		</div>
	
	<? } ?>
<? } ?>

