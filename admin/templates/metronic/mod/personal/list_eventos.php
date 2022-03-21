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
                                
                                <div style="float:left;margin-right:10px;">
                                    <button type="button" class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" onclick="window.open('<?=$link?><?=geraCodReturn();?>/<?=$_REQUEST['var1']?>/novo/','_self','');" style="padding: 7px 10px;">Adicionar Novo</button>
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
                <div class="col-md-12" style="margin-bottom:10px;padding-left:10px;padding-right:10px;">
                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12 box_menu box_ativo" div-toggle="informacoes-basicas">
                            <h4>
                                <span style="width:100%;float:left;">Informações Básicas<i class="fal fa-user-circle" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de identificação, execução e valores</span>
                            </h4>
                        </div>
                    </div>
                    <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|endereco|") === false) { ?>
                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="endereco">
                            <h4>
                                <span style="width:100%;float:left;">Endereço e Local<i class="fal fa-map-marked-alt" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de localização e endereço</span>
                            </h4>
                        </div>
                    </div>
                    <? } ?>
                    <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|imagem_de_capa|") === false || 
					      strrpos($_construtor_sysperm['modulo_eventos'],"|imagem_de_icone|") === false || 
					      strrpos($_construtor_sysperm['modulo_eventos'],"|imagem_de_banner|") === false || 
					      strrpos($_construtor_sysperm['modulo_eventos'],"|imagem_de_banner_2|") === false || 
					      strrpos($_construtor_sysperm['modulo_eventos'],"|imagem_de_banner_vertical|") === false) { ?>
                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="imagens">
                            <h4>
                                <span style="width:100%;float:left;">Imagens<i class="fal fa-camera-retro" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Imagens de exibição</span>
                            </h4>
                        </div>
                    </div>
                    <? } ?>
                    <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|detalhe|") === false || strrpos($_construtor_sysperm['modulo_eventos'],"|extras|") === false) { ?>
                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="descricoes">
                            <h4>
                                <span style="width:100%;float:left;">Descrições<i class="fal fa-file-alt" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Informações sobre o evento</span>
                            </h4>
                        </div>
                    </div>
                    <? } ?>
                    <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|ticket|") === false) { ?>
                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="tickets-e-lotes">
                            <h4>
                                <span style="width:100%;float:left;">Tickets e Lotes<i class="fal fa-cogs" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Lista de tickets e lotes do evento</span>
                            </h4>
                        </div>
                    </div>
                    <? } ?>
                    <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|galeria|") === false) { ?>
                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="galeria-de-images-e-videos">
                            <h4>
                                <span style="width:100%;float:left;">Galeria de Imagens e Vídeos<i class="fal fa-photo-video" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Fotos e vídeos de acompanhamento</span>
                            </h4>
                        </div>
                    </div>
                    <? } ?>
                </div>

            
                <input type="hidden" id="url_post" value="<?=$link?><?=$chave_url?><?=$_SESSION['var1']?>/<?=$_SESSION['var2']?>/" />
                <form name="forms" method="post" action="<?=$link?><?=$chave_url?><?=$_SESSION['var1']?>/<?=$_SESSION['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="formulario" class="form-horizontal form-bordered form-row-stripped">
                    <input type="hidden" id="campos_alterados" value="0" />
                    <input type="hidden" name="aba" id="aba" value="" />
                    <input type="hidden" name="subMod" value="" />
        
                        <? 
                        if(trim($_REQUEST['var2'])=="novo") {
                            $tipo_form_set = "add";
                        } else {
                            $tipo_form_set = "editar";
                        }
                        
                        echo "<input type=\"hidden\" name=\"acaoLocal\" value=\"interno\" />";
                        echo "<input type=\"hidden\" name=\"acaoForm\" id=\"idacaoForm\" value=\"".$tipo_form_set."\" />";
                        echo "<input type=\"hidden\" name=\"modulo\" id=\"modulo\" value=\"eventos_add\" />";
                        
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
        
                            if(trim($_SESSION['eventos_tickets_'.$chave_url.''.$_SESSION['numeroUnicoGerado'].''])=="") {
                                $_SESSION['eventos_tickets_'.$chave_url.''.$_SESSION['numeroUnicoGerado'].''] = $row['tickets'];
                            } else {
                                $_SESSION['eventos_tickets_'.$chave_url.''.$_SESSION['numeroUnicoGerado'].''] = $_SESSION['eventos_tickets_'.$chave_url.''.$_SESSION['numeroUnicoGerado'].''];
                            }

                            if(trim($_SESSION['eventos_horarios_'.$chave_url.''.$_SESSION['numeroUnicoGerado'].''])=="") {
                                $_SESSION['eventos_horarios_'.$chave_url.''.$_SESSION['numeroUnicoGerado'].''] = $row['horarios'];
                            } else {
                                $_SESSION['eventos_horarios_'.$chave_url.''.$_SESSION['numeroUnicoGerado'].''] = $_SESSION['eventos_horarios_'.$chave_url.''.$_SESSION['numeroUnicoGerado'].''];
                            }

                            if(trim($_SESSION['eventos_produtos_'.$chave_url.''.$_SESSION['numeroUnicoGerado'].''])=="") {
                                $_SESSION['eventos_produtos_'.$chave_url.''.$_SESSION['numeroUnicoGerado'].''] = $row['produtos'];
                            } else {
                                $_SESSION['eventos_produtos_'.$chave_url.''.$_SESSION['numeroUnicoGerado'].''] = $_SESSION['eventos_produtos_'.$chave_url.''.$_SESSION['numeroUnicoGerado'].''];
                            }

                            if(trim($_SESSION['eventos_lotes_'.$chave_url.''.$_SESSION['numeroUnicoGerado'].''])=="") {
                                $_SESSION['eventos_lotes_'.$chave_url.''.$_SESSION['numeroUnicoGerado'].''] = $row['lotes'];
                            } else {
                                $_SESSION['eventos_lotes_'.$chave_url.''.$_SESSION['numeroUnicoGerado'].''] = $_SESSION['eventos_lotes_'.$chave_url.''.$_SESSION['numeroUnicoGerado'].''];
                            }

                        }
						
						#$_SESSION['eventos_tickets_'.$_SESSION['numeroUnicoGerado'].''] = "";
						#$_SESSION['eventos_lotes_'.$_SESSION['numeroUnicoGerado'].''] = "";
						
						if(trim($_SESSION['eventos_tickets_seta'])=="") {
							$_SESSION['eventos_tickets_seta'] = "";
						} else {
							$_SESSION['eventos_tickets_seta'] = "".$_SESSION['eventos_tickets_seta']."";
						}
                        

                        echo "".$iditem_input."";
                        echo "<input type=\"hidden\" name=\"numeroUnico\" id=\"numeroUnico\" value=\"".$_SESSION['numeroUnicoGerado']."\" />";
                        echo "<input type=\"hidden\" name=\"idsysusu\" value=\"".$id_redator_set."\" />";
                        echo "".$id_item_row_input."";
        
                        ?>
                <input type="hidden" name="chave_urlS" id="chave_urlS" value="<?=$chave_url?>" />
                <div class="col-md-12 div_ativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="informacoes-basicas">
                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-file-invoice" style="padding-right:10px;"></i>Informações básicas</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de perfil</span>
                            </h4>
    
							<?
                            if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
                                $sysusu_empresaSet = "".$sysusu['empresa']."";
								$filtro_plataformaSet = "";
                            } else {
								$filtro_plataformaSet = " AND mod_empresa.id='".$sysusu['empresa']."' ";
                                $rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT plataforma FROM empresa WHERE id='".$sysusu['empresa']."'"));
                                if(trim($rSqlPlataforma['plataforma'])=="" || trim($rSqlPlataforma['plataforma'])=="0") {
									if(trim($rSqlEmpresa['tipo_empresa'])=="centralizador_de_empresas" || trim($rSqlEmpresa['tipo_empresa'])=="centralizador_de_empresas") {
										$sysusu_empresaSet = "0";
										$filtro_empresaSet = " AND mod_empresa.plataforma='".$sysusu['empresa']."' ";
									} else {
										$sysusu_empresaSet = "".$sysusu['empresa']."";
									}

                                } else { 
                                    $sysusu_empresaSet = "".$sysusu['empresa']."";
                                }
                            }
                            ?>
							<? if(trim($sysusu_empresaSet)=="" || trim($sysusu_empresaSet)=="0") { ?> 
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Plataforma</label>
                                <div class="col-md-12">
                                    <select name="plataforma" id="plataforma" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:filtrar_empresas_plataforma();">
                                        <option value="0">---</option>
                                        <?
                                        $qSqlItem = mysql_query("
                                                                SELECT 
                                                                    mod_empresa.id,
                                                                    mod_empresa.nome
                                                                     
                                                                FROM 
                                                                    empresa AS mod_empresa 
                                                                WHERE
                                                                    (mod_empresa.stat='0' OR mod_empresa.stat='1') AND
																	mod_empresa.tipo_empresa='centralizador_de_empresas'
																	".$filtro_plataformaSet."
                                                                ORDER BY 
                                                                    mod_empresa.nome");
                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                        ?>
                                        <option value="<?= $rSqlItem['id'] ?>" <? if(trim($row['plataforma'])==trim($rSqlItem['id'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Empresa</label>
                                <div class="col-md-12">
                                    <select name="empresa" id="empresa" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:filtra_empresa_taxas();">
                                        <option value="">---</option>
                                        <?
                                        $qSqlItem = mysql_query("
                                                                SELECT 
                                                                    mod_empresa.id,
                                                                    mod_empresa.nome
                                                                     
                                                                FROM 
                                                                    empresa AS mod_empresa 
                                                                WHERE
                                                                    (mod_empresa.stat='0' OR mod_empresa.stat='1')
																	".$filtro_empresaSet." 
                                                                ORDER BY 
                                                                    mod_empresa.nome");
                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                        ?>
                                        <option value="<?= $rSqlItem['id'] ?>" <? if(trim($row['empresa'])==trim($rSqlItem['id'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>
                            <div id="DIV_empresa_taxas" style="display:none;">
                            <input value="<?=$row_taxas['taxa_pdv_ccr_empresa']?>" type="hidden" id="taxa_pdv_ccr_empresa" />
                            <input value="<?=$row_taxas['taxa_pdv_ccd_empresa']?>" type="hidden" id="taxa_pdv_ccd_empresa" />
                            <input value="<?=$row_taxas['taxa_pdv_din_empresa']?>" type="hidden" id="taxa_pdv_din_empresa" />
                            <input value="<?=$row_taxas['taxa_pdv_bol_empresa']?>" type="hidden" id="taxa_pdv_bol_empresa" />
                            <input value="<?=$row_taxas['taxa_pdv_cor_empresa']?>" type="hidden" id="taxa_pdv_cor_empresa" />
                            
                            <input value="<?=$row_taxas['taxa_site_ccr_empresa']?>" type="hidden" id="taxa_site_ccr_empresa" />
                            <input value="<?=$row_taxas['taxa_site_ccd_empresa']?>" type="hidden" id="taxa_site_ccd_empresa" />
                            <input value="<?=$row_taxas['taxa_site_din_empresa']?>" type="hidden" id="taxa_site_din_empresa" />
                            <input value="<?=$row_taxas['taxa_site_bol_empresa']?>" type="hidden" id="taxa_site_bol_empresa" />
                            <input value="<?=$row_taxas['taxa_site_cor_empresa']?>" type="hidden" id="taxa_site_cor_empresa" />
                            
                            <input value="<?=$row_taxas['taxa_app_ccr_empresa']?>" type="hidden" id="taxa_app_ccr_empresa" />
                            <input value="<?=$row_taxas['taxa_app_ccd_empresa']?>" type="hidden" id="taxa_app_ccd_empresa" />
                            <input value="<?=$row_taxas['taxa_app_din_empresa']?>" type="hidden" id="taxa_app_din_empresa" />
                            <input value="<?=$row_taxas['taxa_app_bol_empresa']?>" type="hidden" id="taxa_app_bol_empresa" />
                            <input value="<?=$row_taxas['taxa_app_cor_empresa']?>" type="hidden" id="taxa_app_cor_empresa" />
                            
                            <input value="<?=$row_taxas['taxa_pdv_ccr_cms']?>" type="hidden" id="taxa_pdv_ccr_cms" />
                            <input value="<?=$row_taxas['taxa_pdv_ccd_cms']?>" type="hidden" id="taxa_pdv_ccd_cms" />
                            <input value="<?=$row_taxas['taxa_pdv_din_cms']?>" type="hidden" id="taxa_pdv_din_cms" />
                            <input value="<?=$row_taxas['taxa_pdv_bol_cms']?>" type="hidden" id="taxa_pdv_bol_cms" />
                            <input value="<?=$row_taxas['taxa_pdv_cor_cms']?>" type="hidden" id="taxa_pdv_cor_cms" />
                            
                            <input value="<?=$row_taxas['taxa_site_ccr_cms']?>" type="hidden" id="taxa_site_ccr_cms" />
                            <input value="<?=$row_taxas['taxa_site_ccd_cms']?>" type="hidden" id="taxa_site_ccd_cms" />
                            <input value="<?=$row_taxas['taxa_site_din_cms']?>" type="hidden" id="taxa_site_din_cms" />
                            <input value="<?=$row_taxas['taxa_site_bol_cms']?>" type="hidden" id="taxa_site_bol_cms" />
                            <input value="<?=$row_taxas['taxa_site_cor_cms']?>" type="hidden" id="taxa_site_cor_cms" />
                            
                            <input value="<?=$row_taxas['taxa_app_ccr_cms']?>" type="hidden" id="taxa_app_ccr_cms" />
                            <input value="<?=$row_taxas['taxa_app_ccd_cms']?>" type="hidden" id="taxa_app_ccd_cms" />
                            <input value="<?=$row_taxas['taxa_app_din_cms']?>" type="hidden" id="taxa_app_din_cms" />
                            <input value="<?=$row_taxas['taxa_app_bol_cms']?>" type="hidden" id="taxa_app_bol_cms" />
                            <input value="<?=$row_taxas['taxa_app_cor_cms']?>" type="hidden" id="taxa_app_cor_cms" />
                            </div>

                            <? } else { $empresa_set="".$sysusu['empresa'].""; ?>
                            <div id="DIV_empresa_taxas" style="display:none;">
                            <input value="<?=$row_taxas['taxa_pdv_ccr_empresa']?>" type="hidden" id="taxa_pdv_ccr_empresa" />
                            <input value="<?=$row_taxas['taxa_pdv_ccd_empresa']?>" type="hidden" id="taxa_pdv_ccd_empresa" />
                            <input value="<?=$row_taxas['taxa_pdv_din_empresa']?>" type="hidden" id="taxa_pdv_din_empresa" />
                            <input value="<?=$row_taxas['taxa_pdv_bol_empresa']?>" type="hidden" id="taxa_pdv_bol_empresa" />
                            <input value="<?=$row_taxas['taxa_pdv_cor_empresa']?>" type="hidden" id="taxa_pdv_cor_empresa" />
                            
                            <input value="<?=$row_taxas['taxa_site_ccr_empresa']?>" type="hidden" id="taxa_site_ccr_empresa" />
                            <input value="<?=$row_taxas['taxa_site_ccd_empresa']?>" type="hidden" id="taxa_site_ccd_empresa" />
                            <input value="<?=$row_taxas['taxa_site_din_empresa']?>" type="hidden" id="taxa_site_din_empresa" />
                            <input value="<?=$row_taxas['taxa_site_bol_empresa']?>" type="hidden" id="taxa_site_bol_empresa" />
                            <input value="<?=$row_taxas['taxa_site_cor_empresa']?>" type="hidden" id="taxa_site_cor_empresa" />
                            
                            <input value="<?=$row_taxas['taxa_app_ccr_empresa']?>" type="hidden" id="taxa_app_ccr_empresa" />
                            <input value="<?=$row_taxas['taxa_app_ccd_empresa']?>" type="hidden" id="taxa_app_ccd_empresa" />
                            <input value="<?=$row_taxas['taxa_app_din_empresa']?>" type="hidden" id="taxa_app_din_empresa" />
                            <input value="<?=$row_taxas['taxa_app_bol_empresa']?>" type="hidden" id="taxa_app_bol_empresa" />
                            <input value="<?=$row_taxas['taxa_app_cor_empresa']?>" type="hidden" id="taxa_app_cor_empresa" />
                            
                            <input value="<?=$row_taxas['taxa_pdv_ccr_cms']?>" type="hidden" id="taxa_pdv_ccr_cms" />
                            <input value="<?=$row_taxas['taxa_pdv_ccd_cms']?>" type="hidden" id="taxa_pdv_ccd_cms" />
                            <input value="<?=$row_taxas['taxa_pdv_din_cms']?>" type="hidden" id="taxa_pdv_din_cms" />
                            <input value="<?=$row_taxas['taxa_pdv_bol_cms']?>" type="hidden" id="taxa_pdv_bol_cms" />
                            <input value="<?=$row_taxas['taxa_pdv_cor_cms']?>" type="hidden" id="taxa_pdv_cor_cms" />
                            
                            <input value="<?=$row_taxas['taxa_site_ccr_cms']?>" type="hidden" id="taxa_site_ccr_cms" />
                            <input value="<?=$row_taxas['taxa_site_ccd_cms']?>" type="hidden" id="taxa_site_ccd_cms" />
                            <input value="<?=$row_taxas['taxa_site_din_cms']?>" type="hidden" id="taxa_site_din_cms" />
                            <input value="<?=$row_taxas['taxa_site_bol_cms']?>" type="hidden" id="taxa_site_bol_cms" />
                            <input value="<?=$row_taxas['taxa_site_cor_cms']?>" type="hidden" id="taxa_site_cor_cms" />
                            
                            <input value="<?=$row_taxas['taxa_app_ccr_cms']?>" type="hidden" id="taxa_app_ccr_cms" />
                            <input value="<?=$row_taxas['taxa_app_ccd_cms']?>" type="hidden" id="taxa_app_ccd_cms" />
                            <input value="<?=$row_taxas['taxa_app_din_cms']?>" type="hidden" id="taxa_app_din_cms" />
                            <input value="<?=$row_taxas['taxa_app_bol_cms']?>" type="hidden" id="taxa_app_bol_cms" />
                            <input value="<?=$row_taxas['taxa_app_cor_cms']?>" type="hidden" id="taxa_app_cor_cms" />
                            </div>
                            <? $rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT plataforma FROM empresa WHERE id='".$sysusu['empresa']."'")); ?>
                            <input type="hidden" name="plataforma" id="plataforma" value="<?=$rSqlPlataforma['plataforma']?>" />
                            <input type="hidden" name="empresa" id="empresa" value="<?=$sysusu['empresa']?>" />

                            <? } ?>

                            <?
							if(strrpos($_construtor_sysperm['modulo_pessoas'],"|nome|") === false) {
								$esconde_campo["nome"] = false;
							} else {
								if($tipo_form_set=="add") {
									$esconde_campo["nome"] = false;
								} else {
									$esconde_campo["nome"] = true;
								}
							}
							?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Nome do Evento</label>
                                <div class="col-md-12">
									<? if($esconde_campo["nome"] === false) { ?>
                                    <input value="<?=$row['nome']?>" 
                                    onkeyup="javascript:cria_titulo_e_url('nome','titulo_seo','titulo_seo_google','url_amigavel','url_amigavel_google','','titulo_seo_contador','0','0'); "
                                    type="text" name="nome" id="nome" placeholder="Nome do Evento" class="form-control" />
                                    <? } else { ?>
                                    <input value="<?=$row['nome']?>" type="hidden" name="nome" id="nome" />
                                    <input value="<?=$row['nome']?>" type="text" disabled="disabled" placeholder="Nome do Evento" class="form-control" />
                                    <? } ?>
                                    <p class="help-block">Dê um nome ou coloque um detalhamento do evento.</p>
                                </div>
                            </div>

                            <?
                            if(trim($row['data_do_evento'])=="") {
                                $data_do_eventoSet = "";
                            } else {
                                $data_do_eventoSet = ajustaDataSemHoraReturn($row['data_do_evento'],"d/m/Y");
                            }
                            ?>
                            <?
							if(strrpos($_construtor_sysperm['modulo_pessoas'],"|data_do_evento|") === false) {
								$esconde_campo["data_do_evento"] = false;
							} else {
								if($tipo_form_set=="add") {
									$esconde_campo["data_do_evento"] = false;
								} else {
									$esconde_campo["data_do_evento"] = true;
								}
							}
							?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Data Inicial do Evento</label>
                                <div class="col-md-12">
                                    <div class="col-md-4" style="padding:0px;">
                                        <div class="input-group date date-picker" id="TI_data_do_evento" data-date-format="dd/mm/yyyy"  data-date="<?=$data_do_eventoSet?>">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span> 
											<? if($esconde_campo["data_do_evento"] === false) { ?>
                                            <input type="text" id="data_do_evento" name="data_do_evento" class="form-control input-sm" value="<?=$data_do_eventoSet?>" style="height: 34px;margin-top:0px;">
											<? } else { ?>
                                            <input value="<?=$data_do_eventoSet?>" type="hidden" name="data_do_evento" id="data_do_evento" />
                                            <input value="<?=$data_do_eventoSet?>" type="text" disabled="disabled" class="form-control" />
                                            <? } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="help-block">Você deve informar a data única em que o evento acontece ou a primeira data que vai possuir algum tipo de venda.</p>
                                </div>
                            </div>

							<?
                            if(trim($row['hora_inicio'])=="") {
                                $hSet = date("H");
                                $mSet = date("m");
                                if($mSet>0 || $mSet<5) {
                                    $mSet = 00;
                                } else if($mSet>=5 || $mSet<=10) {
                                    $mSet = 10;
                                } else if($mSet>=11 || $mSet<=20) {
                                    $mSet = 20;
                                } else if($mSet>=21 || $mSet<=30) {
                                    $mSet = 30;
                                } else if($mSet>=31 || $mSet<=40) {
                                    $mSet = 40;
                                } else if($mSet>=41 || $mSet<=50) {
                                    $mSet = 50;
                                } else if($mSet>=51 || $mSet<=59) {
                                    $mSet = 55;
                                }
                                #$hora_inicioSet = $hSet.":".$mSet;
                                $hora_inicioSet = "00:00";
                            } else {
                                $hora_inicioSet = $row['hora_inicio'];
                            }

                            if(trim($row['hora_fim'])=="") {
                                $hSet = date("H");
                                $mSet = date("m");
                                if($mSet>0 || $mSet<5) {
                                    $mSet = 00;
                                } else if($mSet>=5 || $mSet<=10) {
                                    $mSet = 10;
                                } else if($mSet>=11 || $mSet<=20) {
                                    $mSet = 20;
                                } else if($mSet>=21 || $mSet<=30) {
                                    $mSet = 30;
                                } else if($mSet>=31 || $mSet<=40) {
                                    $mSet = 40;
                                } else if($mSet>=41 || $mSet<=50) {
                                    $mSet = 50;
                                } else if($mSet>=51 || $mSet<=59) {
                                    $mSet = 55;
                                }
                                #$hora_fimSet = $hSet.":".$mSet;
                                $hora_fimSet = "00:00";
                            } else {
                                $hora_fimSet = $row['hora_fim'];
                            }
                            ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Horário do Evento</label>
                                <div class="col-md-12">
                                    <div class="col-md-6" style="padding-left:0px;border-left:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </span> 
                                            <input type="text"  name="hora_inicio" id="hora_inicio" value="<?=$hora_inicioSet?>" class="form-control input-sm timepicker timepicker-24" style="height: 34px;margin-top:0px;">
                                        </div>
                                        <p class="help-block">Previsão de início</p>
                                    </div>
                                    <div class="col-md-6" style="padding-left:0px;border-left:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </span> 
                                            <input type="text"  name="hora_fim" id="hora_fim" value="<?=$hora_fimSet?>" class="form-control input-sm timepicker timepicker-24" style="height: 34px;margin-top:0px;">
                                        </div>
                                        <p class="help-block">Previsão de fim</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

						<?
                        if(trim($row['titulo_seo'])=="") {
                            if(trim($valor_controle_seo)=="") {
                                $titulo_seo_set = "Título"; 
                                $tamanho_titulo = 55; 
                            } else {
                                $titulo_seo_set = $valor_controle_seo; 
                                $tamanho_titulo = 150 - strlen($valor_controle_seo); 
                            }
                        } else {
                            $titulo_seo_set = $row['titulo_seo']; 
                            $tamanho_titulo = 150 - strlen($row['titulo_seo']); 
                        }
    
                        if(trim($row['url_amigavel'])=="") {
                            if(trim($valor_controle_seo)=="") {
                                $url_amigavel_set = ""; 
                            } else {
                                $url_set = transformaCaractere($valor_controle_seo);
                                $url_amigavel_set = "".$url_set.""; 
                            }
                        } else {
                            $url_amigavel_set = "".$row['url_amigavel'].""; 
                        }
    
                        if(trim($row['texto_seo'])=="") {  
                            $texto = "Se você não acrescentar nenhum texto, o Meta Description não será exibido"; 
                            $tamanho_texto = 150; 
                        } else {
                            $texto = $row['texto_seo']; 
                            $tamanho_texto = 150 - strlen($row['texto_seo']); 
                        }
                        ?>
                        <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|seo|") === false) { ?>
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;margin-top:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fab fa-google" style="padding-right:10px;"></i>Configurações SEO</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Título, URL e Texto Meta Description</span>
                            </h4>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Pré-visualização SEO</label>
                                <div class="col-md-12">
                                    <div style="float:left;width:100%;font-size:18px;color:#1e0fbe;text-decoration: none;padding:5px;" id="titulo_seo_google"><?=$titulo_seo_set?></div>
                                    <div style="float:left;width:100%;font-size:medium;color:#006621;padding:5px;" id="url_amigavel_google"><?=$url_amigavel_set?></div>
                                    <div style="float:left;width:100%;font-size:small;color:#444;margin-bottom:10px;padding:5px;" id="texto_seo_google"><?=$texto?></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Título SEO</label>
                                <div class="col-md-12">
                                    <input value="<?=$titulo_seo_set?>" class="form-control" type="hidden" name="titulo_seo" id="titulo_seo_real" />
                                    <input value="<?=$titulo_seo_set?>"  data-required="1" class="form-control" type="text" id="titulo_seo" <? if(trim($row['titulo_seo_travada'])==1) { echo "disabled=\"disabled\""; } ?>  onkeyup="cria_seo_titulo_e_url('titulo_seo','titulo_seo_google','url_amigavel','url_amigavel_google','Título','titulo_seo_contador','55','-1');" />
                                </div>
                                <div class="col-md-12" style="margin-top:5px;">
                                    <input type="checkbox" name="titulo_seo_travada" <? if(trim($row['titulo_seo_travada'])==1) { echo " checked"; } ?> id="TI_titulo_seo_travada" class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                                    <p class="help-block"><span style="color:#090;display:none;" id="titulo_seo_contador"><?=$tamanho_titulo?></span>
                                    Se você travar o "Título SEO", a edição fica bloqueada tanto manualmente como com base no campo definido como título</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">URL Amigável</label>
                                <div class="col-md-12">
                                    <input value="<?=$url_amigavel_set?>" class="form-control" type="hidden" name="url_amigavel" id="url_amigavel_real" />
                                    <input value="<?=$url_amigavel_set?>"  data-required="1" class="form-control" type="text" id="url_amigavel" <? if(trim($row['url_amigavel_travada'])==1) { echo "disabled=\"disabled\""; } ?> onkeyup="controle_url_amigavel('url_amigavel','url_amigavel_google');" />
                                </div>
                                <div class="col-md-12" style="margin-top:5px;">
                                    <input type="checkbox" name="url_amigavel_travada" <? if(trim($row['url_amigavel_travada'])==1) { echo " checked"; } ?> id="TI_url_amigavel_travada" class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                                    <p class="help-block">Se você travar a "URL Amigável", a edição fica bloqueada tanto manualmente como com base no "Título SEO" acima</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Texto (Meta-description)</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="texto_seo" id="texto_seo" onkeyup="controle_meta_description('texto_seo','texto_seo_google','texto_seo_contador','<?=$texto?>','150','N');" style="height:150px;"><?=$row['texto_seo']?></textarea>
                                    <p class="help-block"><span style="color:#090;display:none;" id="texto_seo_contador"><?=$tamanho_texto?></span>
                                    Se a meta-description estiver vazia, os robôs dos sites de busca varrerão o conteúdo</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Palavras-chave</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="palavras_chave_seo" id="palavras_chave_seo" style="height:150px;"><?=$row['palavras_chave_seo']?></textarea>
                                </div>
                            </div>
                        </div>
                        <? } ?>

                    </div>

                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-calendar-exclamation" style="padding-right:10px;"></i>Informações de Publicação</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Datas de publicação e despublicação, limites e status</span>
                            </h4>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">PDF Informativo</label>
                                <div class="col-md-12" style="margin-top:10px;">
                                    <? $campo_imagem_set = "pdf_informativo"; ?>
                                    <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                        <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px;">
                                            <? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                            <a href="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" target="_blank"><?=$row[''.$campo_imagem_set.'']?></a>
                                            <? } ?>
                                        </div>
    
                                        <? if(trim($row[''.$campo_imagem_set.''])=="") { ?>
                                        <div>
                                            <span class="btn red btn-outline btn-file">
                                                <span class="fileinput-new">Selecionar Imagem</span> 
                                                <span class="fileinput-exists">Trocar</span> 
                                                <input type="file" name="<?=$campo_imagem_set?>">
                                            </span> 
                                            <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;">Remover</a>
                                        </div>
                                        <? } else { ?>
                                        <div>
                                            <span class="btn red btn-outline btn-file">
                                                <span class="fileinput-new">Alterar</span> 
                                                <span class="fileinput-exists">Alterar</span> 
                                                <input type="file" name="<?=$campo_imagem_set?>">
                                            </span> 
                                            <a class="btn red" href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                        </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>

                            <?
                            if(trim($row['data_de_publicacao'])=="") {
                                $data_de_publicacaoSet = "";
                            } else {
                                $data_de_publicacaoSet = ajustaDataSemHoraReturn($row['data_de_publicacao'],"d/m/Y");
                            }
                            ?>
                            <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|data_de_publicacao|") === false) { ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Data de Publicação</label>
                                <div class="col-md-12">
                                    <div class="col-md-4" style="padding:0px;">
                                        <div class="input-group date date-picker" id="TI_data_de_publicacao" data-date-format="dd/mm/yyyy"  data-date="<?=$data_de_publicacaoSet?>">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span> 
                                            <input type="text" id="data_de_publicacao" name="data_de_publicacao" class="form-control input-sm" value="<?=$data_de_publicacaoSet?>" style="height: 34px;margin-top:0px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="help-block">Está data serve para que o evento fique disponível automáticamente nas suas plataformas apartir da data informada caso o <b>Status</b> deste evento esteja selecionado como "Publicado".</p>
                                </div>
                            </div>
                            <? } ?>

                            <?
                            if(trim($row['data_de_despublicacao'])=="") {
                                $data_de_despublicacaoSet = "";
                            } else {
                                $data_de_despublicacaoSet = ajustaDataSemHoraReturn($row['data_de_despublicacao'],"d/m/Y");
                            }
                            ?>
                            <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|data_de_despublicacao|") === false) { ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Data de Despublicação</label>
                                <div class="col-md-12">
                                    <div class="col-md-4" style="padding:0px;">
                                        <div class="input-group date date-picker" id="TI_data_de_despublicacao" data-date-format="dd/mm/yyyy"  data-date="<?=$data_de_despublicacaoSet?>">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span> 
                                            <input type="text" id="data_de_despublicacao" name="data_de_despublicacao" class="form-control input-sm" value="<?=$data_de_despublicacaoSet?>" style="height: 34px;margin-top:0px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="help-block">Está data serve para que o evento seja despublicado automáticamente nas suas plataformas apartir da data informada.</p>
                                </div>
                            </div>
                            <? } ?>

                            <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|senhas_para_evento|") === false) { ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Senha para Evento</label>
                                <div class="col-md-12">
                                    <select name="numeroUnico_senhas_para_evento" id="numeroUnico_senhas_para_evento" class="form-control">
                                        <option value="">---</option>
										<?
                                        $qSqlItem = mysql_query("
                                                                SELECT 
                                                                    mod_senhas_para_evento.numeroUnico,
                                                                    mod_senhas_para_evento.nome,
																	mod_empresa.nome AS empresa_nome
                                                                     
                                                                FROM 
                                                                    senhas_para_evento AS mod_senhas_para_evento
																LEFT JOIN empresa AS mod_empresa ON (mod_empresa.id = mod_senhas_para_evento.empresa) 
                                                                WHERE
                                                                    (mod_senhas_para_evento.stat='0' OR mod_senhas_para_evento.stat='1') ".$filtro["mod_senhas_para_evento"]." 
                                                                ORDER BY 
                                                                    mod_senhas_para_evento.nome");
                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
											if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
												if(trim($rSqlItem['empresa_nome'])=="") {
													$rSqlItem['nome'] = "Sem empresa setada - ".$rSqlItem['nome']."";
												} else {
													$rSqlItem['nome'] = "".$rSqlItem['empresa_nome']." - ".$rSqlItem['nome']."";
												}
											} else {
												$rSqlItem['nome'] = "".$rSqlItem['nome']."";
											}
                                        ?>
                                        <option value="<?= $rSqlItem['numeroUnico'] ?>" <? if(trim($rSqlItem['numeroUnico'])==trim($row['numeroUnico_senhas_para_evento'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>
                            <? } ?>

                            <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|campanha_de_cartao|") === false) { ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Campanha de Cartão</label>
                                <div class="col-md-12">
                                    <select name="numeroUnico_campanha_de_cartao" id="numeroUnico_campanha_de_cartao" class="form-control">
                                        <option value="">---</option>
										<?
                                        $qSqlItem = mysql_query("
                                                                SELECT 
                                                                    mod_campanha_de_cartao.numeroUnico,
                                                                    mod_campanha_de_cartao.nome,
																	mod_empresa.nome AS empresa_nome
                                                                     
                                                                FROM 
                                                                    campanha_de_cartao AS mod_campanha_de_cartao
																LEFT JOIN empresa AS mod_empresa ON (mod_empresa.id = mod_campanha_de_cartao.empresa) 
                                                                WHERE
                                                                    (mod_campanha_de_cartao.stat='0' OR mod_campanha_de_cartao.stat='1') ".$filtro["mod_campanha_de_cartao"]." 
                                                                ORDER BY 
                                                                    mod_campanha_de_cartao.nome");
                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
											if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
												if(trim($rSqlItem['empresa_nome'])=="") {
													$rSqlItem['nome'] = "Sem empresa setada - ".$rSqlItem['nome']."";
												} else {
													$rSqlItem['nome'] = "".$rSqlItem['empresa_nome']." - ".$rSqlItem['nome']."";
												}
											} else {
												$rSqlItem['nome'] = "".$rSqlItem['nome']."";
											}
                                        ?>
                                        <option value="<?= $rSqlItem['numeroUnico'] ?>" <? if(trim($rSqlItem['numeroUnico'])==trim($row['numeroUnico_campanha_de_cartao'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>
                            <? } ?>

                            <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|maximo_de_compra_permitida|") === false) { ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Quantidade de Ingresso por CPF</label>
                                <div class="col-md-12">
                                    <select name="maximo_de_compra_permitida" id="maximo_de_compra_permitida" class="form-control">
                                        <option value="">---</option>
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row['maximo_de_compra_permitida'])==$i) { echo " selected"; } ?>><?=$i?> ingresso por pessoa</option>
                                        <? } ?>
                                    </select>
                                    <p class="help-block">Está informação serve para limitar quantos itens um mesmo login/cpf pode comprar do mesmo evento.</p>
                                </div>
                            </div>
                            <? } else { ?>
                            <input type="hidden" name="maximo_de_compra_permitida" id="maximo_de_compra_permitida" value="9999" />
                            <? } ?>


                            <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|exibir_site|") === false && 
							      strrpos($_construtor_sysperm['modulo_eventos'],"|exibir_app|") === false &&
							      strrpos($_construtor_sysperm['modulo_eventos'],"|exibir_pdv|") === false &&
								  strrpos($_construtor_sysperm['modulo_eventos'],"|exibir_com|") === false) { ?>
                            <div class="form-group" style="margin-bottom:10px;">
								<? if(strrpos($_construtor_sysperm['modulo_eventos'],"|exibir_site|") === false) { ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Ativo no Site</label>
                                    <div class="col-md-12">
                                        <select name="exibir_site" id="exibir_site" class="form-control">
                                            <option value="1" <? if(trim($row['exibir_site'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($row['exibir_site'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
								<? } ?>
								<? if(strrpos($_construtor_sysperm['modulo_eventos'],"|exibir_app|") === false) { ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Ativo no App</label>
                                    <div class="col-md-12">
                                        <select name="exibir_app" id="exibir_app" class="form-control">
                                            <option value="1" <? if(trim($row['exibir_app'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($row['exibir_app'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
								<? } ?>
								<? if(strrpos($_construtor_sysperm['modulo_eventos'],"|exibir_pdv|") === false) { ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Ativo no PDV</label>
                                    <div class="col-md-12">
                                        <select name="exibir_pdv" id="exibir_pdv" class="form-control">
                                            <option value="1" <? if(trim($row['exibir_pdv'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($row['exibir_pdv'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
								<? } ?>
								<? if(strrpos($_construtor_sysperm['modulo_eventos'],"|exibir_com|") === false) { ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Ativo para Comissário</label>
                                    <div class="col-md-12">
                                        <select name="exibir_com" id="exibir_com" class="form-control">
                                            <option value="1" <? if(trim($row['exibir_com'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($row['exibir_com'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
								<? } ?>
                            </div>
                            <? } ?>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Evento em Destaque</label>
                                <div class="col-md-12">
                                    <select name="destaque" id="destaque" class="form-control">
                                        <option value="">---</option>
                                        <option value="0" <? if(trim($row['destaque'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row['destaque'])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Status do Evento</label>
                                <div class="col-md-12">
                                    <select name="stat" <? if(trim($row['stat'])=="3" || trim($row['stat'])=="4") { ?> disabled="disabled" <? } ?> onchange="javascript:seleciona_stat_evento_tipo();" id="stat" class="form-control">
                                        <option value="">---</option>
                                        <option value="0" <? if(trim($row['stat'])=="0") { echo " selected"; } ?>>Despublicado</option>
                                        <option value="1" <? if(trim($row['stat'])=="1") { echo " selected"; } ?>>Publicado</option>
                                        <option value="2" <? if(trim($row['stat'])=="2") { echo " selected"; } ?>>Em produção</option>
                                        <? if(trim($row['stat'])=="3" || trim($row['stat'])=="4") { ?>
                                        <option value="3" <? if(trim($row['stat'])=="3") { echo " selected"; } ?>>Encerrado Automáticamente</option>
                                        <option value="4" <? if(trim($row['stat'])=="4") { echo " selected"; } ?>>Encerrado Manualmente</option>
                                        <? } ?>
                                        <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|info_clinica|") === false) { ?>
                                        <option value="5" <? if(trim($row['stat'])=="5") { echo " selected"; } ?>>Exibir para usuários que selecionarem que já tomaram PRIMEIRA dose</option>
                                        <option value="6" <? if(trim($row['stat'])=="6") { echo " selected"; } ?>>Exibir para usuários que selecionarem que já tomaram SEGUNDA dose</option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

					<? if(strrpos($_construtor_sysperm['modulo_eventos'],"|info_ingresso|") === false || strrpos($_construtor_sysperm['modulo_eventos'],"|info_clinica|") === false) { ?>
                    <div class="col-md-4" style="padding:5px;">
                        <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|info_ingresso|") === false) { ?>
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;margin-bottom:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-calendar-exclamation" style="padding-right:10px;"></i>Informações de Impressão</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Texto e imagem que serão impressos ao final do ticket</span>
                            </h4>

                            <p class="help-block">As informações abaixo vão aparecer na parte inferior na impressão do ingresso.</p>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Texto para impressão no ingresso</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" id="info_ingresso_texto" name="info_ingresso_texto"><?=$row['info_ingresso_texto']?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Imagem para impressão no ingresso</label>
                                <div class="col-md-12" style="margin-top:10px;">
                                    <? $campo_imagem_set = "info_ingresso_img_b64"; ?>
                                    <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                        <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            <? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                            <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                            <? } ?>
                                        </div>
    
                                        <? if(trim($row[''.$campo_imagem_set.''])=="") { ?>
                                        <div>
                                            <span class="btn red btn-outline btn-file">
                                                <span class="fileinput-new">Selecionar Imagem</span> 
                                                <span class="fileinput-exists">Trocar</span> 
                                                <input type="file" name="<?=$campo_imagem_set?>">
                                            </span> 
                                            <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;">Remover</a>
                                        </div>
                                        <? } else { ?>
                                        <div>
                                            <span class="btn red btn-outline btn-file">
                                                <span class="fileinput-new">Alterar</span> 
                                                <span class="fileinput-exists">Alterar</span> 
                                                <input type="file" name="<?=$campo_imagem_set?>">
                                            </span> 
                                            <a class="btn red" href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                        </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <? } ?>


                    </div>
                    <? } ?>

                </div>
                <!-- END informacoes-basicas-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="endereco">
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-map-marked-alt" style="padding-right:10px;"></i>Endereço</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de localização e endereço</span>
                            </h4>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Nome do Local</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['local']?>" type="text" name="local" id="local" placeholder="Ex.: Casa, Estádio do Morumbi, Teatro do CIC" class="form-control" />
                                    <p class="help-block">Digite o nome do local onde o evento vai acontecer. Ex.: Casa, Estádio do Morumbi, Teatro do CIC.</p>
                                </div>
                            </div>

							<? monta_mascara("cep","99999-999"); ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">CEP</label>
                                <div class="col-md-4" style="padding-right:0px;">
                                    <input value="<?=$row['cep']?>" class="form-control" type="text" id="cep" name="cep" />
                                    <p class="help-block">Ex.: 99999-999</p>
                                </div>
                                <div class="col-md-3" style="padding-left:0px;">
                                    <button type="button" onclick="buscaCepTxt();" style="margin-top:0px;" class="btn grey-gallery">Carregar endereço</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Rua</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['rua']?>" type="text" id="rua" name="rua" class="form-control" placeholder="Ex.: Rua, Logradouro, Avenida." />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Número</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['numero']?>" type="text" id="numero" name="numero" class="form-control" placeholder="Digite o número do endereço" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Complemento</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['complemento']?>" type="text" id="complemento" name="complemento" class="form-control" placeholder="Ex.: Apt 000, Bloco X, Sala 0000" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Bairro</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['bairro']?>" type="text" name="bairro" id="bairro" placeholder="Bairro" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Cidade</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['cidade']?>" type="text" name="cidade" id="cidade" placeholder="Cidade" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Estado</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['estado']?>" type="text" name="estado" id="estado" placeholder="Cidade" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-street-view" style="padding-right:10px;"></i>Mapa</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de localização e endereço</span>
                            </h4>
                            <?
							$monta_endereco_print = "".$row['rua']."";
							if(trim($row['numero'])=="") { } else { $monta_endereco_print .= ", ".$row['numero'].""; }
							if(trim($row['bairro'])=="") { } else { $monta_endereco_print .= ", ".$row['bairro'].""; }
							if(trim($row['cidade'])=="") { } else { $monta_endereco_print .= ", ".$row['cidade'].""; }
							if(trim($row['estado'])=="") { } else { $monta_endereco_print .= ", ".$row['estado'].""; }
							if(trim($row['cep'])=="") { } else { $monta_endereco_print .= ", ".$row['cep'].""; }
							if(trim($monta_endereco_print)!="") {
								$linkMapa = "https://maps.google.it/maps?q=".$monta_endereco_print."&output=embed";
							?>
                            <iframe src="<?=$linkMapa?>" width="100%" height="450px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            <? } ?>
                        </div>
                    </div>

                </div>
                <!-- END endereco-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="imagens">
					<? if(strrpos($_construtor_sysperm['modulo_eventos'],"|imagem_de_capa|") === false) { ?>
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-image" style="padding-right:10px;"></i>Imagem de Capa</span>
                            </h4>

                            <? 
							$campo_imagem_name = "imagem_de_capa"; 
							$campo_imagem_width = "400"; 
							$campo_imagem_height = "400"; 
							$campo_imagem_type = "square"; 
							include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/imagem-crop.php");
							?>
                        
                        </div>
                    </div>
                    <? } ?>

					<? if(strrpos($_construtor_sysperm['modulo_eventos'],"|imagem_de_icone|") === false) { ?>
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-image" style="padding-right:10px;"></i>Imagem de Ícone</span>
                            </h4>

                            <? 
							$campo_imagem_name = "imagem_de_icone"; 
							$campo_imagem_width = "300"; 
							$campo_imagem_height = "300"; 
							$campo_imagem_type = "circle"; 
							include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/imagem-crop.php");
							?>

                        </div>
                    </div>
                    <? } ?>

					<? if(strrpos($_construtor_sysperm['modulo_eventos'],"|imagem_de_banner|") === false) { ?>
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-image" style="padding-right:10px;"></i>Imagem de Banner</span>
                            </h4>

                            <? 
							$campo_imagem_name = "imagem_de_banner"; 
							$campo_imagem_width = "600"; 
							$campo_imagem_height = "300"; 
							$campo_imagem_type = "square"; 
							include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/imagem-crop.php");
							?>

                        </div>
                    </div>
                    <? } ?>

					<? if(strrpos($_construtor_sysperm['modulo_eventos'],"|imagem_de_banner_2|") === false) { ?>
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-image" style="padding-right:10px;"></i>Imagem de Banner 2</span>
                            </h4>

                            <? 
							$campo_imagem_name = "imagem_de_banner_2"; 
							$campo_imagem_width = "600"; 
							$campo_imagem_height = "440"; 
							$campo_imagem_type = "square"; 
							include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/imagem-crop.php");
							?>

                        </div>
                    </div>
                    <? } ?>

					<? if(strrpos($_construtor_sysperm['modulo_eventos'],"|imagem_de_banner_vertical|") === false) { ?>
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-image" style="padding-right:10px;"></i>Imagem de Banner</span>
                            </h4>

                            <? 
							$campo_imagem_name = "imagem_de_banner_vertical"; 
							$campo_imagem_width = "300"; 
							$campo_imagem_height = "600"; 
							$campo_imagem_type = "square"; 
							include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/imagem-crop.php");
							?>

                        </div>
                    </div>
                    <? } ?>

                </div>
                <!-- END imagens-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="descricoes">
                    <div class="col-md-12" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-file-alt" style="padding-right:10px;"></i>Descrições</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Informações do evento e informações extras</span>
                            </h4>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Informações do Evento</label>
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" id="detalhe" name="detalhe"><?=$row['detalhe']?></textarea>
                                    <p class="help-block">Acima você pode colocar um texto descritivo entre outras informações.</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Extras</label>
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" id="extras" name="extras"><?=$row['extras']?></textarea>
                                    <p class="help-block">Acima você colocar um texto com algum informativo e/ou aviso que irá aparecer como um popup quando o cliente acessar as plataformas e visualizar este evento.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END descricoes-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="tickets-e-lotes">

                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;margin-bottom:30px;">
                            <div id="eventos_tickets-view" style="display:none;"></div>
                            <div id="eventos_tickets-novo" style="display:block;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-layer-plus" style="padding-right:10px;"></i>Novo Ticket</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Preencha os campos abaixo, alguns são obrigatórios e clique em 'Adicionar Ticket'</span>
                            </h4>

                            <div class="form-group" style="margin-bottom:10px;">
                                <label class="control-label col-md-12" style="text-align:left;">Nome</label>
                                <div class="col-md-12">
                                    <input value="" type="text" id="ticket_nome" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group" id="DIV_ticket_cpf_qtd" style="margin-bottom:10px;">
                                <label class="control-label col-md-12" style="text-align:left;">Quantidade de Tickets/Vouchers que um mesmo CPF pode adquirir</label>
                                <div class="col-md-12">
                                    <input value="1" type="number" id="ticket_cpf_qtd" placeholder="" class="form-control" />
                                    <div class="note note-warning" style="margin-bottom:0px;margin-top:5px;padding-top:5px;">
                                        <h3><font style="font-size:14px;">ATENÇÃO</font></h3>
                                        <p>Este campo determina a quantidade de vezes que o cliente que está comprando no site/app pode marcar/atribuir um mesmo CPF em ingressos de mesmo Ticket/Voucher.<br /><br /> 
                                        O recomendado para evitar cambismo de Tickets/Vouchers é deixar o padrão de 1 ingresso por atribuição de CPF.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Tipo de Ticket</label>
                                    <div class="col-md-12">
                                        <select id="ticket_tipo" onchange="javascript:seleciona_ticket_tipo('')" class="form-control">
                                            <option value="0">Normal</option>
                                            <option value="1">Pré-venda</option>
                                            <option value="2">Lista Bônus</option>
                                            <option value="3">Lounge</option>
                                            <option value="4">Código para Sorteio</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Apenas Compra Autorizada?</label>
                                    <div class="col-md-12">
                                        <select id="ticket_compra_autorizada" class="form-control">
                                            <option value="0">NÃO</option>
                                            <option value="1">SIM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="DIV_ticket_tipo_numeracao" style="margin-bottom:10px;display:none;">
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Tipo de Númeração do Ticket</label>
                                    <div class="col-md-12">
                                        <select id="ticket_tipo_numeracao" onchange="javascript:seleciona_ticket_tipo_numeracao('')" class="form-control">
                                            <option value="0">Números com definição de início e fim</option>
                                            <option value="1">Números e Letras Randômicos</option>
                                            <option value="2">Apenas Números Randômicos</option>
                                            <option value="3">Apenas Letras Randômicos</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="DIV_ticket_tipo_numeracao_tamanho" style="margin-bottom:10px;display:none;">
                                <label class="control-label col-md-12" style="text-align:left;">Quantidade de caracteres do Ticket/Voucher</label>
                                <div class="col-md-12">
                                    <input value="" type="number" id="ticket_tipo_numeracao_tamanho" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group" id="DIV_ticket_tipo_numeracao_0" style="margin-bottom:10px;display:none;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">De</label>
                                    <div class="col-md-12">
                                        <input value="" type="number" id="ticket_tipo_numeracao_de" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Até</label>
                                    <div class="col-md-12">
                                        <input value="" type="number" id="ticket_tipo_numeracao_ate" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="DIV_ticket_tipo_numeros_letras" style="margin-bottom:10px;display:none;">
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Tipo de Númeração do Ticket</label>
                                    <div class="col-md-12">
                                        <select id="ticket_tipo_numeros_letras" onchange="javascript:seleciona_ticket_tipo_numeros_letras('')" class="form-control">
                                            <option value="0">Ordem Aleatória</option>
                                            <option value="1">Começa com Letras</option>
                                            <option value="2">Começa com Números</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="DIV_ticket_tipo_numeros_letras_qtd" style="margin-bottom:10px;display:none;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Qtd Letras</label>
                                    <div class="col-md-12">
                                        <input value="" type="number" id="ticket_tipo_numeros_letras_qtd_letras" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Qtd Números</label>
                                    <div class="col-md-12">
                                        <input value="" type="number" id="ticket_tipo_numeros_letras_qtd_numeros" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="DIV_ticket_qtd_lounge" style="margin-bottom:10px;display:none;">
                                <label class="control-label col-md-12" style="text-align:left;">Quantidade de Ingresso por Lounge</label>
                                <div class="col-md-12">
                                    <input value="" type="text" id="ticket_qtd_lounge" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Gênero</label>
                                    <div class="col-md-12">
                                        <select id="ticket_genero" class="form-control">
                                            <option value="U">Unissex</option>
                                            <option value="F">Feminino</option>
                                            <option value="M">Masculino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exigir Atribuição de Beneficiário</label>
                                    <div class="col-md-12">
                                        <select id="ticket_exigir_atribuicao" class="form-control">
                                            <option value="1">SIM</option>
                                            <option value="0">NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir Info de Lote</label>
                                    <div class="col-md-12">
                                        <select id="ticket_exibir_lote" class="form-control">
                                            <option value="1">SIM</option>
                                            <option value="0">NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir Info de Taxa</label>
                                    <div class="col-md-12">
                                        <select id="ticket_exibir_taxa" class="form-control">
                                            <option value="1">SIM</option>
                                            <option value="0">NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Meia Entrada</label>
                                    <div class="col-md-12">
                                        <select id="ticket_meia_entrada" class="form-control">
                                            <option value="0">NÃO</option>
                                            <option value="1">SIM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Virada de Lote Automática</label>
                                    <div class="col-md-12">
                                        <select id="ticket_virada_de_lote" class="form-control">
                                            <option value="0">NÃO</option>
                                            <option value="1">SIM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Ativo no Site</label>
                                    <div class="col-md-12">
                                        <select id="ticket_exibir_site" class="form-control">
                                            <option value="1">SIM</option>
                                            <option value="0">NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Ativo no App</label>
                                    <div class="col-md-12">
                                        <select id="ticket_exibir_app" class="form-control">
                                            <option value="1">SIM</option>
                                            <option value="0">NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Ativo no PDV</label>
                                    <div class="col-md-12">
                                        <select id="ticket_exibir_pdv" class="form-control">
                                            <option value="1">SIM</option>
                                            <option value="0">NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Ativo para Comissário</label>
                                    <div class="col-md-12">
                                        <select id="ticket_exibir_com" class="form-control">
                                            <option value="1">SIM</option>
                                            <option value="0">NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|campanha_de_cartao|") === false) { ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Campanha de Cartão</label>
                                <div class="col-md-12">
                                    <select id="ticket_campanha_de_cartao" class="form-control">
                                        <option value="">---</option>
										<?
                                        $qSqlItem = mysql_query("
                                                                SELECT 
                                                                    mod_campanha_de_cartao.numeroUnico,
                                                                    mod_campanha_de_cartao.nome,
																	mod_empresa.nome AS empresa_nome
                                                                     
                                                                FROM 
                                                                    campanha_de_cartao AS mod_campanha_de_cartao
																LEFT JOIN empresa AS mod_empresa ON (mod_empresa.id = mod_campanha_de_cartao.empresa) 
                                                                WHERE
                                                                    (mod_campanha_de_cartao.stat='0' OR mod_campanha_de_cartao.stat='1') ".$filtro["mod_campanha_de_cartao"]." 
                                                                ORDER BY 
                                                                    mod_campanha_de_cartao.nome");
                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
											if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
												if(trim($rSqlItem['empresa_nome'])=="") {
													$rSqlItem['nome'] = "Sem empresa setada - ".$rSqlItem['nome']."";
												} else {
													$rSqlItem['nome'] = "".$rSqlItem['empresa_nome']." - ".$rSqlItem['nome']."";
												}
											} else {
												$rSqlItem['nome'] = "".$rSqlItem['nome']."";
											}
                                        ?>
                                        <option value="<?= $rSqlItem['numeroUnico'] ?>" <? if(trim($rSqlItem['numeroUnico'])==trim($row['numeroUnico_campanha_de_cartao'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>
                            <? } ?>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Imagem de Capa do Ticket</label>
                                    <div class="col-md-12" style="margin-top:10px;">
                                        <? $campo_imagem_set = "ticket_imagem_de_capa"; ?>
                                        <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                            <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            </div>
        
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-new">Selecionar Imagem</span> 
                                                    <span class="fileinput-exists">Trocar</span> 
                                                    <input type="file" name="<?=$campo_imagem_set?>">
                                                </span> 
                                                <a class="btn red fileinput-exists" id="remover_<?=$campo_imagem_set?>" data-dismiss="fileinput" href="javascript:;">Remover</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Mapa informativo do Ticket</label>
                                    <div class="col-md-12" style="margin-top:10px;">
                                        <? $campo_imagem_set = "ticket_mapa"; ?>
                                        <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                            <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            </div>
        
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-new">Selecionar Imagem</span> 
                                                    <span class="fileinput-exists">Trocar</span> 
                                                    <input type="file" name="<?=$campo_imagem_set?>">
                                                </span> 
                                                <a class="btn red fileinput-exists" id="remover_<?=$campo_imagem_set?>" data-dismiss="fileinput" href="javascript:;">Remover</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">PDF Informativo do Ticket</label>
                                    <div class="col-md-12" style="margin-top:10px;">
                                        <? $campo_imagem_set = "ticket_pdf_informativo"; ?>
                                        <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                            <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            </div>
        
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-new">Selecionar Arquivo</span> 
                                                    <span class="fileinput-exists">Trocar</span> 
                                                    <input type="file" accept="application/pdf" name="<?=$campo_imagem_set?>">
                                                </span> 
                                                <a class="btn red fileinput-exists" id="remover_<?=$campo_imagem_set?>" data-dismiss="fileinput" href="javascript:;">Remover</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <? $ticket_dataSet = ""; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <label class="control-label col-md-12" style="text-align:left;">Data do Ticket</label>
                                <div class="col-md-12">
                                    <div class="col-md-6" style="padding:0px;">
                                        <div class="input-group date date-picker" id="TI_ticket_data" data-date-format="dd/mm/yyyy"  data-date="<?=$ticket_dataSet?>">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span> 
                                            <input type="text" id="ticket_data" class="form-control input-sm" value="<?=$ticket_dataSet?>" style="height: 34px;margin-top:0px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="help-block">Está data serve para informar ao cliente a data de utilização deste ticket.</p>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <label class="control-label col-md-12" style="text-align:left;">Informações</label>
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" id="ticket_info"></textarea>
                                    <p class="help-block">Acima você pode colocar um texto descritivo sobre o ticket, o qual vai aparecer ao ser clicado no ícone de "informações" que fica disponível nas suas plataformas.</p>
                                </div>
                            </div>


                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-10">
                                    <a class="btn input-label" onclick="javascript:eventos_tickets_add();" style="background-color:#19d18e;color:#FFF;text-align:center;"><i class="fa fa-plus"></i>&nbsp;Adicionar Ticket</a>
                                </div>
                            </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-layer-group" style="padding-right:10px;"></i>Lista de Tickets</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Lista de tickets do evento</span>
                            </h4>

                            <div id="eventos_tickets-lista" style="width:100%;display:block;">
                                <? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/eventos_tickets-lista.php"); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;margin-bottom:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;"><i class="fal fa-layer-group" style="padding-right:10px;"></i>Lista de Horários Disponíveis</span>
                            </h4>

                            <div id="eventos_produtos-qtd">
								<? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/eventos_horarios-qtd.php"); ?>
                            </div>
                            <div id="eventos_horarios-lista">

                                <div class="note note-info" style="margin-bottom:0px;">
                                    <h3><font style="font-size:13px;">Selecione um ticket para inserir e/ou visualizar os horários relacionados à ele</font></h3>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12" style="background-color:#FFF;padding:10px;margin-bottom:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;"><i class="fal fa-layer-group" style="padding-right:10px;"></i>Lista de Produtos Relacionados</span>
                            </h4>

                            <div id="eventos_produtos-qtd">
								<? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/eventos_produtos-qtd.php"); ?>
                            </div>
                            <div id="eventos_produtos-lista">

                                <div class="note note-info" style="margin-bottom:0px;">
                                    <h3><font style="font-size:13px;">Selecione um ticket para inserir e/ou visualizar os produtos relacionados à ele</font></h3>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;"><i class="fal fa-layer-group" style="padding-right:10px;"></i>Lista de Lotes</span>
                            </h4>

                            <div id="eventos_lotes-qtd">
								<? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/eventos_lotes-qtd.php"); ?>
                            </div>
                            <div id="eventos_lotes-lista">

                                <div class="note note-info" style="margin-bottom:0px;">
                                    <h3><font style="font-size:13px;">Selecione um ticket para inserir e/ou visualizar os lotes disponíveis para ele</font></h3>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <!-- END tickets-e-lotes-->
                </form>

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;" id="galeria-de-images-e-videos">
                    <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                        <h4 class="font-green-sharp">
                            <span style="width:100%;float:left;"><i class="fal fa-photo-video" style="padding-right:10px;"></i>Galeria de Imagens, Arquivos e Vídeos</span>
                            <span style="width:100%;font-size:12px;font-style:italic;">Fotos e vídeos de acompanhamento</span>
                        </h4>

						<?
                        $modGet = $mod;
                        $numeroUnico_modulo_catGet = $modulo_set_categoria['numeroUnico'];
                        $numeroUnico_moduloGet = $modulo_set['numeroUnico'];
                        $numeroUnico_paiGet = $numeroUnicoGerado;
                        ?>
                        <div class="form-group" id="FORM_GROUP_galeria_de_imagens">
                        <div id="galeria-de-imagens" class="tab-pane" style="min-height:350px;">
        
                            <div class="row">
                                <div class="col-md-12" style="margin-top:10px;padding-left:25px;padding-right:25px;">
                                    <input type="hidden" id="lista_files" value="">
                                    <input type="hidden" id="n_selecionados" value="0">
                                    <input type="hidden" id="ordem_alterada" value="0">
                                    <input type="hidden" id="lista_selecionados_galeria" value="">
                                    <input type="hidden" id="mod_pasta" value="<?=$modGet?>">
                                    <input type="hidden" id="numeroUnico_modulo_cat" value="<?=$numeroUnico_modulo_catGet?>">
                                    <input type="hidden" id="numeroUnico_modulo" value="<?=$numeroUnico_moduloGet?>">
                                    <input type="hidden" id="numeroUnico_interno_galeria" value="<?=$numeroUnicoGerado?>">
        
                                    <a class="btn default green-turquoise-stripe" onClick="javascript: _construtor_template_sysmidia_call_dropzone_out();"><i class="fa fa-file"></i>&nbsp;&nbsp;Novo Arquivo</a>
        
                                    <a class="divider" style="border-left:1px solid #F7CA18;padding-bottom: 0px;padding-top:0px;margin-left:10px;margin-right:10px;"></a>
        
                                    <a onclick="_construtor_template_sysmidia_remover_selecionados_out('<?=$modGet?>','<?=$numeroUnico_modulo_catGet?>','<?=$numeroUnico_moduloGet?>','<?=$numeroUnico_paiGet?>');" class="btn default red-thunderbird-stripe"><i class="fa fa-times"></i>&nbsp;&nbsp;Remover</a>
                                    <a onclick="sysmidia_compactar_selecionados_out();" class="btn default purple-medium-stripe"><i class="fa fa-download"></i>&nbsp;&nbsp;Baixar</a>
        
                                    <!--
                                    <a class="divider" style="border-left:1px solid #F7CA18;padding-bottom: 0px;padding-top:0px;margin-left:10px;margin-right:10px;"></a>
        
                                    <a onclick="_construtor_template_reordenar_nome('<?=$modGet?>','<?=$numeroUnico_modulo_catGet?>','<?=$numeroUnico_moduloGet?>','<?=$numeroUnico_paiGet?>');" class="btn default blue-stripe" style="display:none;"><i class="fa fa-sort-alpha-asc"></i>&nbsp;&nbsp;Reordenar alfabeticamente</a>
                                    <a id="btn-finalizar-upload" onclick="_construtor_template_refresh_iframes_out('<?=$modGet?>','<?=$numeroUnico_modulo_catGet?>','<?=$numeroUnico_moduloGet?>','<?=$numeroUnico_paiGet?>');" class="btn default blue-stripe" style="display:none;"><i class="fa fa-upload"></i>&nbsp;&nbsp;Finalizar Upload</a>-->
        
                                    <a class="divider" style="border-left:1px solid #F7CA18;padding-bottom: 0px;padding-top:0px;margin-left:10px;margin-right:10px;"></a>
        
                                    <div class="btn-group ">
                                        <a onclick="" class="btn default green-turquoise-stripe dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i>&nbsp;&nbsp;Mais Opções</a>
                                        <div class="col-md-12 dropdown-menu" role="menu">
                                        
                                            <div class="col-md-12" style="padding-top:10px;">
                                                <input type="hidden" id="filtro_interno_view_set" value="thumb">
                                                <div class="form-group">
                                                    <label><b>Visualização</b></label>
                                                    <div class="input-group">
                                                        <div class="icheck-list">
                                                            <label>
                                                            <input type="radio" name="filtro_interno_view" id="filtro_interno_view_thumb" <? if(trim($_SESSION["sysmidia_interno_visualizacao"])=="thumb"||trim($_SESSION["sysmidia_interno_visualizacao"])=="") { ?> checked<? } ?> value="thumb"> Miniaturas </label>
                                                            <label>
                                                            <input type="radio" name="filtro_interno_view" id="filtro_interno_view_lista" <? if(trim($_SESSION["sysmidia_interno_visualizacao"])=="lista") { ?> checked<? } ?> value="lista"> Lista </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label><b>Exibir</b></label>
                                                    <div class="input-group">
                                                        <div class="icheck-list">
                                                            <label>
                                                            <input type="checkbox" id="filtro_interno_show_ordem" <? if(trim($_SESSION["p_interno_ordem"])=="1"||trim($_SESSION["p_interno_ordem"])=="") { ?> checked<? } ?> value="ordem"> Ordem </label>
                                                            <label>
                                                            <input type="checkbox" id="filtro_interno_show_nome" <? if(trim($_SESSION["p_interno_nome"])=="1"||trim($_SESSION["p_interno_nome"])=="") { ?> checked<? } ?> value="nome"> Nome </label>
                                                            <label>
                                                            <input type="checkbox" id="filtro_interno_show_tamanho" <? if(trim($_SESSION["p_interno_tamanho"])=="1") { ?> checked<? } ?> value="tamanho"> Tamanho </label>
                                                            <label>
                                                            <input type="checkbox" id="filtro_interno_show_data" <? if(trim($_SESSION["p_interno_data"])=="1") { ?> checked<? } ?> value="data"> Data </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label><b>Ordenar por</b></label>
                                                    <div class="input-group">
                                                        <div class="icheck-list">
                                                            <label>
                                                            <input type="radio" name="filtro_interno_order" <? if(trim($_SESSION["ordenacao_sysmidia_interno"])=="ordem"||trim($_SESSION["ordenacao_sysmidia_interno"])=="") { ?> checked<? } ?> id="filtro_interno_order_ordem" value="ordem"> Ordem </label>
                                                            <label>
                                                            <input type="radio" name="filtro_interno_order" <? if(trim($_SESSION["ordenacao_sysmidia_interno"])=="nome") { ?> checked<? } ?> id="filtro_interno_order_nome" value="nome"> Nome </label>
                                                            <label>
                                                            <input type="radio" name="filtro_interno_order" <? if(trim($_SESSION["ordenacao_sysmidia_interno"])=="extensao") { ?> checked<? } ?> id="filtro_interno_order_extensao" value="extensao"> Tipo </label>
                                                            <label>
                                                            <input type="radio" name="filtro_interno_order" <? if(trim($_SESSION["ordenacao_sysmidia_interno"])=="tamanho") { ?> checked<? } ?> id="filtro_interno_order_tamanho" value="tamanho"> Tamanho </label>
                                                            <label>
                                                            <input type="radio" name="filtro_interno_order" <? if(trim($_SESSION["ordenacao_sysmidia_interno"])=="dataModificacao") { ?> checked<? } ?> id="filtro_interno_order_dataModificacao" value="dataModificacao"> Data </label>
                                                            <label>
                                                            <input type="checkbox" id="filtro_interno_order_desc" <? if(trim($_SESSION["ordenacao_sysmidia_interno_direcao"])=="DESC") { ?> checked<? } ?>> Decrescente </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
        
                                    <a class="divider" style="border-left:1px solid #F7CA18;padding-bottom: 0px;padding-top:0px;margin-left:10px;margin-right:10px;"></a>
        
                                    <a onclick="marcarTodos('marcar');" class="btn default red-thunderbird-stripe marcar_todos"><i class="fa fa-times"></i>&nbsp;&nbsp;Selecionar Todos</a>
                                    <a onclick="marcarTodos('desmarcar');" class="btn default red-thunderbird-stripe desmarcar_todos" style="display:none;"><i class="fa fa-times"></i>&nbsp;&nbsp;Desmarcar Todos</a>
        
                                </div>
                                
                                <div id="DIV_dropzone" class="col-md-12" style="margin-top:10px;padding-left:25px;padding-right:25px;">
                                    <form action="<?=$link_vpnssl?>templates/<?=$layout_padrao_set?>/acoes/sysmidia/_construtor_template-arquivo-drop.php?idsysusuS=<?=$sysusu['id']?>&modS=<?=$modGet?>&idpaiS=<?=$idpaiGet?>&numeroUnico_paiS=<?=$numeroUnico_paiGet?>&numeroUnico_modulo_catS=<?=$numeroUnico_modulo_catGet?>&numeroUnico_moduloS=<?=$numeroUnico_moduloGet?>" class="dropzone" id="my-dropzone" ENCTYPE="multipart/form-data">
                                    <? include("./templates/".$layout_padrao_set."/acoes/sysmidia/_construtor_template-dropzone-out.php"); ?>
                                    </form>
                                </div>
        
                                <div id="DIV_pasta" class="col-md-12" style="margin-top:10px;padding-left:25px;padding-right:25px;">
                                    <? include("./templates/".$layout_padrao_set."/acoes/sysmidia/_construtor_template-pasta-out.php"); ?>
                                </div>
                            </div>
        
                        </div>
                        </div>

                    </div>
                </div>
                <!-- END galeria-de-images-e-videos-->
                

            </div>
        </div>

    </div>

    <div class="botoes_salvar_rodape" style="z-index:9999 !important;">
        <? if(trim($_REQUEST['var3'])=="novo") { $nome_btn = "Cadastrar Evento"; } else { $nome_btn = "Salvar Mudanças"; } ?>
        <? if(trim($row['stat'])=="3" || trim($row['stat'])=="4") { } else { ?>
        <div class="row top-side">
            <!-- Inicio menu desktop-->
            <div class="col-xs-6 col-sm-12 botoes_de_salvar top-side-desktop">
                <button type="button" id="BTN_salvar" class="btn yellow-gold input-label" style="margin-left: 0px;" onclick="javascript:eventos_salvar('<?=$tipo_form_set?>');" style=""><?=$nome_btn?></button>
                <button type="button" id="BTN_salvar_continuar" class="btn green input-label" style="margin-left: 0px;" onclick="javascript:eventos_salvar('<?=$tipo_form_set?>-continuar');" style=""><?=$nome_btn?> e Continuar Editando</button>
                <? if(trim($_REQUEST['var3'])=="novo") { } else { ?>
                <button type="button" class="btn red-sunglo input-label" style="margin-left: 0px;" data-toggle="modal" data-target="#exampleModal">Deseja Encerrar Este Evento?</button>
                <? } ?>
            </div>
            <!-- Fim menu desktop-->
        </div>
        <? } ?>
    </div>

    <style>
	@media (min-width: 768px) {
		.modal-dialog {
			width: 600px;
			margin: 0px auto;
		}
	}
	@media (min-width: 768px) {
		.modal-content {
			/* -webkit-box-shadow: 0 5px 15px rgb(0 0 0 / 50%); */
			/* box-shadow: 0 5px 15px rgb(0 0 0 / 50%); */
			-webkit-box-shadow:none !important;
			box-shadow:none !important;
		}
	}
	.modal-content {
		position: relative;
		background-color: #fff;
		border-radius: 6px;
		/* border: 1px solid #999; */
		/* border: 1px solid rgba(0,0,0,.2); */
		/* -webkit-box-shadow: 0 3px 9px rgb(0 0 0 / 50%); */
		/* box-shadow: 0 3px 9px rgb(0 0 0 / 50%); */
		/* background-clip: padding-box; */

		border: 0px solid #999 !important;
		border: 0px solid rgba(0,0,0,.2) !important;
		-webkit-box-shadow: none !important;
		box-shadow: none !important;
		background-clip: padding-box;
		outline: 0;
	}
	.modal .modal-header {
		border-bottom: 0px solid #efefef !important;
	}
	.modal-footer {
		padding: 15px;
		text-align: right;
		border-top: 0px solid #e5e5e5 !important;
	}
	.modal.fade.in {
		top: 10%;
	}
    </style>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="font-weight:bold">Encerramento de Evento</h5>
          </div>
          <div class="modal-body">
              <input type="hidden" id="nao_confirmados_campo" value="0" />
              <input type="hidden" id="confirmados_campo" value="0" />
              <input type="hidden" id="total_campo" value="0" />
              <input type="hidden" id="selecionados_campo" value="0" />

              <input type="hidden" id="email_campo" value="0" />
              <input type="hidden" id="whats_campo" value="0" />
              <input type="hidden" id="sms_campo" value="0" />
              <input type="hidden" id="push_campo" value="0" />
              <div class="form-group">
                <label for="tipo_encerramento" class="col-form-label">Modelo de encerramento:</label>
                <select name="tipo_encerramento" id="tipo_encerramento" onchange="javascript:evento_encerramento_pacotes_de_utilizacao_numeros();" class="form-control">
                    <option value="">Selecione uma opção</option>
                    <option value="0">Apenas encerrar o evento</option>
                    <option value="1">Encerrar o evento e notificar os usuários que possuem ticket do mesmo</option>
                </select>
              </div>
              <div class="form-group" id="DIV_pacotes" style="display:none;">
                <label class="col-form-label">Pacotes disponíveis:</label>
                <div style="color:#777;width:100%;margin-bottom:10px;margin-top:10px;cursor:pointer;" id="DIV_email_check"><input type="checkbox" id="email_check" style="margin-right:5px;" /><i style="font-size:20px;width:35px;color: #2b8fbe;text-align:center;" class="fal fa-envelope-open-text"></i>&nbsp;<span id="disponivel_email"></span> e-mail's disponíveis</div>
                <div style="color:#777;width:100%;margin-bottom:10px;cursor:pointer;" id="DIV_whats_check"><input type="checkbox" id="whats_check" style="margin-right:5px;" /><i style="font-size:20px;width:35px;color: #3ebe2b;text-align:center;" class="fab fa-whatsapp"></i>&nbsp;<span id="disponivel_whats"></span> whatsapp's disponíveis</div>
                <div style="color:#777;width:100%;margin-bottom:10px;cursor:pointer;" id="DIV_sms_check"><input type="checkbox" id="sms_check" style="margin-right:5px;" /><i style="font-size:20px;width:35px;color: #177c08;text-align:center;" class="fal fa-sms"></i>&nbsp;<span id="disponivel_sms"></span> sms's disponíveis</div>
                <div style="color:#777;width:100%;margin-bottom:10px;cursor:pointer;" id="DIV_push_check"><input type="checkbox" id="push_check" style="margin-right:5px;" /><i style="font-size:20px;width:35px;color: #33dddf;text-align:center;" class="fal fa-mobile-android-alt"></i>&nbsp;<span id="disponivel_push"></span> push's disponíveis</div>
              </div>
              <div class="form-group" id="DIV_numeros_pessoas" style="display:none;">
                <label class="col-form-label">Números de Pessoas:</label>
                <div style="color:#777;width:100%;margin-bottom:10px;margin-top:10px;cursor:pointer;" id="DIV_nao_confirmados_check"><input type="checkbox" id="nao_confirmados_check" style="margin-right:5px;" /><i style="font-size:20px;width:35px;color: #e91c01;text-align:center;" class="fal fa-users"></i>&nbsp;<span id="nao_confirmados"></span> não confirmados</div>
                <div style="color:#777;width:100%;margin-bottom:10px;cursor:pointer;" id="DIV_confirmados_check"><input type="checkbox" id="confirmados_check" style="margin-right:5px;" /><i style="font-size:20px;width:35px;color: #23b877;text-align:center;" class="fal fa-users"></i>&nbsp;<span id="confirmados"></span> já confirmados</div>
              </div>
              <div class="note note-warning" id="DIV_mensagem_retorno_warning" style="margin-bottom:0px;padding:5px;display:none;">
                  <p id="mensagem_retorno_warning"></p>
              </div>
              <div class="note note-danger" id="DIV_mensagem_retorno_erro" style="margin-bottom:0px;padding:5px;display:none;">
                  <p id="mensagem_retorno_erro"></p>
              </div>
              <div class="note note-success" id="DIV_mensagem_retorno_sucesso" style="margin-bottom:0px;padding:5px;display:none;">
                  <p id="mensagem_retorno_sucesso"></p>
              </div>
              <div class="form-group">
                <label for="motivo_encerramento" class="col-form-label">Motivo encerramento:</label>
                <textarea class="form-control" name="motivo_encerramento" id="motivo_encerramento"></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" id="DIV_botao_envio" style="display:none;" class="btn btn-primary red-sunglo" onclick="javascript:encerrar_evento('encerrar');">Confirmar Encerramento</button>
          </div>
        </div>
      </div>
    </div>

<? } ?>