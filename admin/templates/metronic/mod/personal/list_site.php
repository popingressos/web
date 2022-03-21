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
            .wrapper {
              margin-left: auto;
              margin-right: auto;
              padding-right: 5px;
              padding-left: 5px;
              width: 100%;
            }
            
            /* Masonry grid */
            .masonry, .masonry2 {
              transition: all .5s ease-in-out;
              column-gap: 10px;
              column-fill: initial;
            }
            
            /* Masonry item */
            .masonry .brick, .masonry2 .brick {
              margin-bottom: 15px;
              display: inline-block; /* Fix the misalignment of items */
              vertical-align: top; /* Keep the item on the very top */
            }
            
            /* Masonry on tablets */
            @media only screen and (min-width: 768px) and (max-width: 1279px) {
              .masonry {
                column-count: 3;
              }
              .masonry2 {
                column-count: 3;
              }
            }
            
            /* Masonry on big screens */
            @media only screen and (min-width: 1280px) {
              .masonry {
                column-count: 4;
              }
              .masonry2 {
                column-count: 3;
              }
            }

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
                    <div class="col-md-3" style="padding:5px;">
                        <div class="col-md-12 box_menu box_ativo" div-toggle="informacoes-basicas">
                            <h4>
                                <span style="width:100%;float:left;">Informações Básicas<i class="fal fa-mobile-alt" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de identificação e layout</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="imagens">
                            <h4>
                                <span style="width:100%;float:left;">Imagens<i class="fal fa-images" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Configurações de logotipos e imagens de fundo</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="configuracoes-do-template">
                            <h4>
                                <span style="width:100%;float:left;">Configurações do Template<i class="fal fa-pencil-paintbrush" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Menu, fontes, posicionamentos e textos extras</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="configuracoes-dos-campos">
                            <h4>
                                <span style="width:100%;float:left;">Configurações de Campos de Perfil<i class="fal fa-tasks" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Label de campos, exibição e obrigatoriedades</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="menu-topo">
                            <h4>
                                <span style="width:100%;float:left;">Menu Cabeçalho<i class="fal fa-list" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Menu principal do topo do site</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="menu-rodape">
                            <h4>
                                <span style="width:100%;float:left;">Menu Rodapé<i class="fal fa-list" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Menu do rodapé do site</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="aceites-extras">
                            <h4>
                                <span style="width:100%;float:left;">Aceites Extras<i class="fal fa-file-signature" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Título, texto e status</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="informacoes-do-template">
                            <h4>
                                <span style="width:100%;float:left;">Informações do Template<i class="fal fa-sitemap" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de contato, horários, endereço e outros</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="paginas-do-template">
                            <h4>
                                <span style="width:100%;float:left;">Páginas do Template<i class="fal fa-images" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Imagens, títulos e textos das páginas de retorno</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="cores">
                            <h4>
                                <span style="width:100%;float:left;">Cores<i class="far fa-palette" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Configurações de cores da plataforma</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="contatos-e-permissoes">
                            <h4>
                                <span style="width:100%;float:left;">Contatos e Permissões<i class="fal fa-cogs" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de contato</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="configuracoes-de-loja">
                            <h4>
                                <span style="width:100%;float:left;">Configurações de loja<i class="fal fa-cogs" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Formas de pagamento e permissões</span>
                            </h4>
                        </div>
                    </div>
                </div>

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
                    echo "<input type=\"hidden\" name=\"modulo\" id=\"modulo\" value=\"site_add\" />";
                    
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

						if(trim($_SESSION['menu_topo_'.$_SESSION['numeroUnicoGerado'].''])=="") {
							$_SESSION['menu_topo_'.$_SESSION['numeroUnicoGerado'].''] = $row['menu_topo'];
						} else {
							$_SESSION['menu_topo_'.$_SESSION['numeroUnicoGerado'].''] = $_SESSION['menu_topo_'.$_SESSION['numeroUnicoGerado'].''];
						}


						if(trim($_SESSION['menu_rodape_'.$_SESSION['numeroUnicoGerado'].''])=="") {
							$_SESSION['menu_rodape_'.$_SESSION['numeroUnicoGerado'].''] = $row['menu_rodape'];
						} else {
							$_SESSION['menu_rodape_'.$_SESSION['numeroUnicoGerado'].''] = $_SESSION['menu_rodape_'.$_SESSION['numeroUnicoGerado'].''];
						}

						$campos_clienteArray = unserialize($row['campos_cliente']);
						$campos_profissionalArray = unserialize($row['campos_profissional']);
                    }
                    
                    #$_SESSION['detalhamento_'.$_SESSION['numeroUnicoGerado'].''] = "";
                    
                    echo "".$iditem_input."";
                    echo "<input type=\"hidden\" name=\"numeroUnico\" id=\"numeroUnico\" value=\"".$_SESSION['numeroUnicoGerado']."\" />";
                    echo "<input type=\"hidden\" name=\"idsysusu\" value=\"".$id_redator_set."\" />";
                    echo "".$id_item_row_input."";

                    ?>
                <div class="col-md-12 div_ativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="informacoes-basicas">
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-mobile-alt" style="padding-right:10px;"></i>Informações básicas</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de identificação e layout</span>
                            </h4>
    
							<? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {  $empresa_set=""; ?> 
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Empresa</label>
                                <div class="col-md-12">
                                    <select name="empresa" id="empresa" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:seleciona_empresa_multi();">
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
                                                                ORDER BY 
                                                                    mod_empresa.nome");
                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                        ?>
                                        <option value="<?= $rSqlItem['id'] ?>" <? if(trim($row['empresa'])==trim($rSqlItem['id'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>
                            <? } else { $empresa_set="".$sysusu['empresa'].""; ?>
                            <input type="hidden" name="empresa" id="empresa" value="<?=$sysusu['empresa']?>" />
                            <? } ?>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Nome do Site</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['nome']?>" type="text" name="nome" id="nome" placeholder="Nome do Site" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Link Apple Store</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['link_apple']?>" type="text" name="link_apple" id="link_apple" placeholder="Link Play Store" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Link Play Store</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['link_google']?>" type="text" name="link_google" id="link_google" placeholder="Link Apple Store" class="form-control" />
                                </div>
                            </div>

                            <? $nome_campo = "em_manutencao"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Em Manutenção</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
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
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fab fa-google" style="padding-right:10px;"></i>Configurações SEO</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Título, URL e Texto Meta Description</span>
                            </h4>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Pré-visualização SEO</label>
                                <div class="col-md-12">
                                    <div style="float:left;width:100%;font-size:18px;color:#1e0fbe;text-decoration: none;padding:5px;" id="titulo_seo_google"><?=$titulo_seo_set?></div>
                                    <div style="float:left;width:100%;font-size:small;color:#444;margin-bottom:10px;padding:5px;" id="texto_seo_google"><?=$texto?></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Título SEO</label>
                                <div class="col-md-12">
                                    <input value="<?=$titulo_seo_set?>" class="form-control" type="hidden" name="titulo_seo" id="titulo_seo_real" />
                                    <input value="<?=$titulo_seo_set?>"  data-required="1" class="form-control" type="text" id="titulo_seo" onkeyup="cria_seo_titulo_e_url('titulo_seo','titulo_seo_google','url_amigavel','url_amigavel_google','Título','titulo_seo_contador','55','-1');" />
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
                    </div>

                </div>
                <!-- END informacoes-basicas-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="menu-topo">

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;margin-bottom:30px;">
                            <div id="menu_topo-view" style="display:none;"></div>
                            <div id="menu_topo-novo" style="display:block;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-layer-plus" style="padding-right:10px;"></i>Novo Item</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Preencha os campos abaixo, alguns são obrigatórios e clique em 'Adicionar Item'</span>
                            </h4>

                            <div class="form-group" style="margin-bottom:10px;">
                                <label class="control-label col-md-12" style="text-align:left;">Tipo de Menu</label>
                                <div class="col-md-12">
                                    <select id="menu_topo_tipo" onchange="javascript:menu_topo_tipo_set('');" class="form-control">
                                        <option value="">Selecione uma opção</option>
                                        <option value="modulo">Módulo do Sistema</option>
                                        <option value="link">Link Externo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group menu_topo_itens_de_divisor_modulo_link" style="margin-bottom:10px;display:none;">
                                <label class="control-label col-md-12" style="text-align:left;">Nome / Título</label>
                                <div class="col-md-12">
                                    <input value="" type="text" id="menu_topo_nome" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group menu_topo_itens_de_link" style="margin-bottom:10px;display:none;">
                                <label class="control-label col-md-12" style="text-align:left;">Link</label>
                                <div class="col-md-12">
                                    <input value="" type="text" id="menu_topo_link" placeholder="" class="form-control" />
                                </div>
                            </div>

							<? $nome_campo = "modulo"; ?>
							<? $rSqlMenuOpcoes = $rSqlMenuApp; ?>
                            <div class="form-group menu_topo_itens_de_modulo" style="margin-bottom:10px;display:none;">
                                <label class="control-label col-md-12" style="text-align:left;">Módulo</label>
                                <div class="col-md-12">
                                    <select id="menu_topo_modulo" onchange="javascript:menu_topo_modulo_set('');" class="form-control">
                                    	<option value="">Selecione uma opção</option>
                                        <? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/menu_topo-opcoes.php"); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group menu_topo_itens_de_modulo_item" style="margin-bottom:10px;display:none;">
                                <label class="control-label col-md-12" style="text-align:left;">Item do Módulo</label>
                                <div class="col-md-12">
                                    <select id="menu_topo_modulo_item" class="form-control">
                                    	<option value="">Selecione uma opção</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-10">
                                    <a class="btn input-label" onclick="javascript:menu_topo_add();" style="background-color:#19d18e;color:#FFF;text-align:center;"><i class="fa fa-plus"></i>&nbsp;Adicionar Item</a>
                                </div>
                            </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-layer-group" style="padding-right:10px;"></i>Lista de Itens</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Lista de itens adicionados</span>
                            </h4>

                            <div id="menu_topo-lista" style="width:100%;display:block;">
                                <? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/menu_topo-lista.php"); ?>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END menu-topo-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="configuracoes-do-template">
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-mobile-alt" style="padding-right:10px;"></i>Configurações de Layout</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Comportamento de layout e textos exibidos</span>
                            </h4>

                            <? $nome_campo = "template"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Template Utilizado</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" onchange="javascript:site_tipo_template();" class="form-control">
                                        <option value="">---</option>
                                        <option value="porto" <? if(trim($row[''.$nome_campo.''])=="porto") { echo " selected"; } ?>>Porto para venda de planos</option>
                                        <option value="groci" <? if(trim($row[''.$nome_campo.''])=="groci") { echo " selected"; } ?>>Groci</option>
                                        <option value="porto_loja" <? if(trim($row[''.$nome_campo.''])=="porto_loja") { echo " selected"; } ?>>Porto completo com loja</option>
                                        <option value="redirecionamento" <? if(trim($row[''.$nome_campo.''])=="redirecionamento") { echo " selected"; } ?>>Apenas redirecionamento</option>
                                        <option value="outra_pasta" <? if(trim($row[''.$nome_campo.''])=="outra_pasta") { echo " selected"; } ?>>Pasta Personalizada</option>
                                    </select>
                                </div>
                            </div>

                            <?
							if(trim($row['template'])=="outra_pasta") {
								$displayTemplatePastaSet = " style=\"display:block;\" ";
							} else {
								$displayTemplatePastaSet = " style=\"display:none;\" ";
							}
							?>
                            <div class="form-group" id="DIV_template_pasta" <?=$displayTemplatePastaSet?>>
                                <label class="control-label col-md-12" style="text-align:left;">Pasta do Template</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['template_pasta']?>" class="form-control" type="text" name="template_pasta" id="template_pasta" onkeyup="controle_caracteres_especiais('template_pasta');" />
                                </div>
                            </div>

                            <? $nome_campo = "modelo_cabecalho_menu"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Modelo da Cabeçalho/Menu</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="tela_toda" <? if(trim($row[''.$nome_campo.''])=="tela_toda") { echo " selected"; } ?>>De lado a lado</option>
                                        <option value="box" <? if(trim($row[''.$nome_campo.''])=="box") { echo " selected"; } ?>>Box central com margens laterais</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "modelo_alinhamento_logotipo"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Alinhamento do Logotipo do Cabeçalho</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="esquerda" <? if(trim($row[''.$nome_campo.''])=="esquerda") { echo " selected"; } ?>>Alinhado à esquerda</option>
                                        <option value="centro" <? if(trim($row[''.$nome_campo.''])=="centro") { echo " selected"; } ?>>Alinhado ao centro</option>
                                        <option value="direita" <? if(trim($row[''.$nome_campo.''])=="direita") { echo " selected"; } ?>>Alinhado à direita</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "modelo_alinhamento_menu"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Alinhamento do Menu do Cabeçalho</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="esquerda" <? if(trim($row[''.$nome_campo.''])=="esquerda") { echo " selected"; } ?>>Alinhado à esquerda</option>
                                        <option value="centro" <? if(trim($row[''.$nome_campo.''])=="centro") { echo " selected"; } ?>>Alinhado ao centro</option>
                                        <option value="direita" <? if(trim($row[''.$nome_campo.''])=="direita") { echo " selected"; } ?>>Alinhado à direita</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "modelo_lista_inicial"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Modelo da Inicial</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="inicial" <? if(trim($row[''.$nome_campo.''])=="inicial") { echo " selected"; } ?>>Listagem em formato de box</option>
                                        <option value="inicial_parallax" <? if(trim($row[''.$nome_campo.''])=="inicial_parallax") { echo " selected"; } ?>>Listagem em formato de linha com parallax</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "modelo_lista_eventos"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Modelo de Eventos</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="eventos" <? if(trim($row[''.$nome_campo.''])=="eventos") { echo " selected"; } ?>>Listagem em formato de box</option>
                                        <option value="eventos_parallax" <? if(trim($row[''.$nome_campo.''])=="eventos_parallax") { echo " selected"; } ?>>Listagem em formato de linha com parallax</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-mobile-alt" style="padding-right:10px;"></i>Configurações de Fontes do Site</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Tipo de fonte</span>
                            </h4>

                            <? $nome_campo = "fonte_body"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Fonte Body</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="Poppins" <? if(trim($row[''.$nome_campo.''])=="Poppins") { echo " selected"; } ?>>Poppins</option>
                                        <option value="Lato" <? if(trim($row[''.$nome_campo.''])=="Lato") { echo " selected"; } ?>>Lato</option>
                                        <option value="Amatic SC" <? if(trim($row[''.$nome_campo.''])=="Amatic SC") { echo " selected"; } ?>>Amatic SC</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "fonte_menu"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Fonte do Menu</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="Poppins" <? if(trim($row[''.$nome_campo.''])=="Poppins") { echo " selected"; } ?>>Poppins</option>
                                        <option value="Lato" <? if(trim($row[''.$nome_campo.''])=="Lato") { echo " selected"; } ?>>Lato</option>
                                        <option value="Amatic SC" <? if(trim($row[''.$nome_campo.''])=="Amatic SC") { echo " selected"; } ?>>Amatic SC</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "fonte_p"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Fonte de Texto Normal<b>&lt;p&gt;</b></label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="Poppins" <? if(trim($row[''.$nome_campo.''])=="Poppins") { echo " selected"; } ?>>Poppins</option>
                                        <option value="Lato" <? if(trim($row[''.$nome_campo.''])=="Lato") { echo " selected"; } ?>>Lato</option>
                                        <option value="Amatic SC" <? if(trim($row[''.$nome_campo.''])=="Amatic SC") { echo " selected"; } ?>>Amatic SC</option>
                                    </select>
                                </div>
                            </div>

                            <? for ($i = 1; $i <= 6; $i++) { ?>
							<? $nome_campo = "fonte_h".$i.""; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Fonte de H<?=$i?></label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="Poppins" <? if(trim($row[''.$nome_campo.''])=="Poppins") { echo " selected"; } ?>>Poppins</option>
                                        <option value="Lato" <? if(trim($row[''.$nome_campo.''])=="Lato") { echo " selected"; } ?>>Lato</option>
                                        <option value="Amatic SC" <? if(trim($row[''.$nome_campo.''])=="Amatic SC") { echo " selected"; } ?>>Amatic SC</option>
                                    </select>
                                </div>
                            </div>
                            <? } ?>

                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">

                            <h4 class="font-green-sharp" style="margin-top:13px !important;margin-bottom:13px !important;">
                                <span style="width:100%;float:left;"><i class="fal fa-mobile-alt" style="padding-right:10px;"></i>Configurações de Top Header</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Configurações gerais</span>
                            </h4>

                            <div class="col-md-12" style="padding:0px;">
                                <label class="control-label col-md-12" style="text-align:left;padding:0px;">Exibir?</label>
                                <div class="col-md-12" style="padding:0px;">
                                    <select name="top_header" id="top_header" class="form-control">
                                        <option value="0" <? if(trim($row['top_header'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row['top_header'])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "top_header_cor_fundo"; ?>
                            <div class="col-md-12" style="padding:0px;">
                                <label class="control-label col-md-12" style="text-align:left;padding:0px;">Cor de Fundo</label>
                                <div class="col-md-12" style="padding:0px;">
                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                    <p class="help-block">Esta configuração afeta a cor de fundo da linha que aparece antes do meu no cabeçalho do site</p>
                                </div>
                            </div>

                            <? $nome_campo = "top_header_cor_linha_div"; ?>
                            <div class="col-md-12" style="padding:0px;">
                                <label class="control-label col-md-12" style="text-align:left;padding:0px;">Cor da Linha Divisória</label>
                                <div class="col-md-12" style="padding:0px;">
                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                    <p class="help-block">Esta configuração afeta a cor da linha divisória da linha que aparece antes do meu no cabeçalho do site</p>
                                </div>
                            </div>

                            <h4 class="font-green-sharp" style="margin-top:13px !important;">
                                <span style="width:100%;float:left;padding-top:20px;"><i class="fal fa-mobile-alt" style="padding-right:10px;"></i>Configurações de Top Header</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Componentes de alinhamento à ESQUERDA</span>
                            </h4>

                            <? for ($i = 1; $i <= 3; $i++) { ?>
							<? $nome_campo = "info_esq_".$i.""; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;"><b>Bloco <?=$i?></b></label>
                                </div>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Texto</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'_texto']?>" class="form-control" type="text" name="<?=$nome_campo?>_texto" id="<?=$nome_campo?>_texto" />
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Cor de Fundo</label>
                                    <div class="col-md-12">
                                        <? if(trim($row[''.$nome_campo.'_cor_fundo'])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'_cor_fundo']; } ?>
                                        <input type="text" name="<?=$nome_campo?>_cor_fundo" id="<?=$nome_campo?>_cor_fundo" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                        <p class="help-block">Esta configuração afeta a cor de fundo do item</p>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Cor do Texto</label>
                                    <div class="col-md-12">
                                        <? if(trim($row[''.$nome_campo.'_cor_texto'])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'_cor_texto']; } ?>
                                        <input type="text" name="<?=$nome_campo?>_cor_texto" id="<?=$nome_campo?>_cor_texto" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                        <p class="help-block">Esta configuração afeta a cor do texto do item</p>
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                            <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Ícone</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'_icone']?>" class="form-control" type="text" name="<?=$nome_campo?>_icone" id="<?=$nome_campo?>_icone" />
                                        <p class="help-block">Coloque apenas a classe do ícone. Ex.: fa-brands fa-facebook-f. Você pode encontrar os ícones em <a href="https://fontawesome.com/" target="_blank">clicando aqui</a></p>
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Link</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'_link']?>" class="form-control" type="text" name="<?=$nome_campo?>_link" id="<?=$nome_campo?>_link" />
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Target</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>_target" id="<?=$nome_campo?>_target" class="form-control">
                                            <option value="_self" <? if(trim($row[''.$nome_campo.'_target'])=="_self") { echo " selected"; } ?>>Mesma janela</option>
                                            <option value="_blank" <? if(trim($row[''.$nome_campo.'_target'])=="_blank") { echo " selected"; } ?>>Nova janela</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <? } ?>

                            <h4 class="font-green-sharp" style="margin-top:13px !important;">
                                <span style="width:100%;float:left;padding-top:20px;"><i class="fal fa-mobile-alt" style="padding-right:10px;"></i>Configurações de Top Header</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Componentes de alinhamento à DIREITA</span>
                            </h4>

                            <? for ($i = 1; $i <= 3; $i++) { ?>
							<? $nome_campo = "info_dir_".$i.""; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;"><b>Bloco <?=$i?></b></label>
                                </div>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Texto</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'_texto']?>" class="form-control" type="text" name="<?=$nome_campo?>_texto" id="<?=$nome_campo?>_texto" />
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Cor de Fundo</label>
                                    <div class="col-md-12">
                                        <? if(trim($row[''.$nome_campo.'_cor_fundo'])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'_cor_fundo']; } ?>
                                        <input type="text" name="<?=$nome_campo?>_cor_fundo" id="<?=$nome_campo?>_cor_fundo" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                        <p class="help-block">Esta configuração afeta a cor de fundo do item</p>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Cor do Texto</label>
                                    <div class="col-md-12">
                                        <? if(trim($row[''.$nome_campo.'_cor_texto'])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'_cor_texto']; } ?>
                                        <input type="text" name="<?=$nome_campo?>_cor_texto" id="<?=$nome_campo?>_cor_texto" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                        <p class="help-block">Esta configuração afeta a cor do texto do item</p>
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                            <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Ícone</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'_icone']?>" class="form-control" type="text" name="<?=$nome_campo?>_icone" id="<?=$nome_campo?>_icone" />
                                        <p class="help-block">Coloque apenas a classe do ícone. Ex.: fa-brands fa-facebook-f. Você pode encontrar os ícones em <a href="https://fontawesome.com/" target="_blank">clicando aqui</a></p>
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Link</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'_link']?>" class="form-control" type="text" name="<?=$nome_campo?>_link" id="<?=$nome_campo?>_link" />
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Target</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>_target" id="<?=$nome_campo?>_target" class="form-control">
                                            <option value="_self" <? if(trim($row[''.$nome_campo.'_target'])=="_self") { echo " selected"; } ?>>Mesma janela</option>
                                            <option value="_blank" <? if(trim($row[''.$nome_campo.'_target'])=="_blank") { echo " selected"; } ?>>Nova janela</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <? } ?>

                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-mobile-alt" style="padding-right:10px;"></i>Configurações de Rede Social</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Comportamento, Exibição e Informações</span>
                            </h4>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-12">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Login com Redes Sociais?</label>
                                </div>
								<? $nome_campo = "login_facebook"; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                            <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        </select>
                                        <p class="help-block">Login com Facebook</p>
                                    </div>
                                </div>
								<? $nome_campo = "login_google"; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                            <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        </select>
                                        <p class="help-block">Login com Google</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Facebook</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['facebook']?>" type="text" name="facebook" id="facebook" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Instagram</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['instagram']?>" type="text" name="instagram" id="instagram" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <h4 class="font-green-sharp" style="margin-bottom:13px !important;">
                                <span style="width:100%;float:left;"><i class="fab fa-whatsapp" style="padding-right:10px;"></i>Informações de WhatsApp</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Ativação, Número e Texto de Chamada</span>
                            </h4>

                            <? $nome_campo = "whatsapp_ativo"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">WhatsApp Ativo</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Telefone do WhatApp</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['whatsapp_numero']?>" type="text" name="whatsapp_numero" id="whatsapp_numero" placeholder="" class="form-control telefone" />
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:13px !important;">
                                <label class="control-label col-md-12" style="text-align:left;">Frase do WhatApp</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['whatsapp_frase']?>" type="text" name="whatsapp_frase" id="whatsapp_frase" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <h4 class="font-green-sharp" style="margin-top:13px !important;margin-bottom:13px !important;">
                                <span style="width:100%;float:left;"><i class="fal fa-mobile-alt" style="padding-right:10px;"></i>Configurações de Fale Conosco</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Comportamento de layout e textos exibidos</span>
                            </h4>

                            <? for ($i = 1; $i <= 4; $i++) { ?>
							<? $nome_campo = "contato_bloco_".$i.""; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;"><b>Bloco <?=$i?></b></label>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label/Título</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'_titulo']?>" class="form-control" type="text" name="<?=$nome_campo?>_titulo" id="<?=$nome_campo?>_titulo" />
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="">---</option>
                                            <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                            <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Texto</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'_texto']?>" class="form-control" type="text" name="<?=$nome_campo?>_texto" id="<?=$nome_campo?>_texto" />
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Link</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'_link']?>" class="form-control" type="text" name="<?=$nome_campo?>_link" id="<?=$nome_campo?>_link" />
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Target</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>_target" id="<?=$nome_campo?>_target" class="form-control">
                                            <option value="">---</option>
                                            <option value="_self" <? if(trim($row[''.$nome_campo.'_target'])=="_self") { echo " selected"; } ?>>Mesma janela</option>
                                            <option value="_blank" <? if(trim($row[''.$nome_campo.'_target'])=="_blank") { echo " selected"; } ?>>Nova janela</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Ícone</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'_icone']?>" class="form-control" type="text" name="<?=$nome_campo?>_icone" id="<?=$nome_campo?>_icone" />
                                        <p class="help-block">Coloque apenas a classe do ícone. Ex.: fa-brands fa-facebook-f. Você pode encontrar os ícones em <a href="https://fontawesome.com/" target="_blank">clicando aqui</a></p>
                                    </div>
                                </div>

                                <div class="col-md-6" style="margin-top:10px;">
                                    <div class="input-group" style="margin-bottom:10px;">
                                        <span>Imagem</span>
                                    </div>
                                    <? $campo_imagem_set = "".$nome_campo."_img"; ?>
                                    <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                        <? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                        <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                        </div>
                                        <? } ?>
    
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
                                            <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                        </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                            <? } ?>

                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-mobile-alt" style="padding-right:10px;"></i>Configurações de Label</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Comportamento de layout e textos exibidos</span>
                            </h4>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Label 'Voucher pessoal e intransferível'</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['label_voucher_intranferivel']?>" class="form-control" type="text" name="label_voucher_intranferivel" id="label_voucher_intranferivel" />
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label de Produto</label>
                                </div>
                                <? $nome_campo = "label_produto_singular"; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Singular</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" class="form-control" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" />
                                    </div>
                                </div>
                                <? $nome_campo = "label_produto_plural"; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Plural</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" class="form-control" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label de Evento</label>
                                </div>
                                <? $nome_campo = "label_evento_singular"; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Singular</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" class="form-control" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" />
                                    </div>
                                </div>
                                <? $nome_campo = "label_evento_plural"; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Plural</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" class="form-control" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label de Ticket</label>
                                </div>
                                <? $nome_campo = "label_ticket_singular"; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Singular</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" class="form-control" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" />
                                    </div>
                                </div>
                                <? $nome_campo = "label_ticket_plural"; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Plural</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" class="form-control" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-mobile-alt" style="padding-right:10px;"></i>Configurações de Rodapé</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Comportamento de layout e textos exibidos</span>
                            </h4>

                            <? $nome_campo = "rodape_slogan"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Slogan do Rodapé</label>
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" name="<?=$nome_campo?>" id="<?=$nome_campo?>"><?=$row[''.$nome_campo.'']?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Informações de Copyright</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['rodape_copyright']?>" class="form-control" type="text" name="rodape_copyright" id="rodape_copyright" />
                                    <p class="help-block">Caso nada seja preenchido, o padrão será exibido. Padrão: Copyrights © <b>[NOME DA EMPRESA]</b> Todos os direitos.</p>
                                </div>
                            </div>

                            <? $nome_campo = "rodape_bloco1"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Bloco 1</label>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label/Título</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'_label']?>" class="form-control" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" />
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="">---</option>
                                            <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                            <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <? $nome_campo = "rodape_bloco2"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Bloco 2</label>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label/Título</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'_label']?>" class="form-control" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" />
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="">---</option>
                                            <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                            <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <? $nome_campo = "rodape_bloco3"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Bloco 3</label>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label/Título</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'_label']?>" class="form-control" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" />
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="">---</option>
                                            <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                            <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <? $nome_campo = "rodape_bloco4"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Bloco 4</label>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label/Título</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'_label']?>" class="form-control" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" />
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="">---</option>
                                            <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                            <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
                <!-- END configuracoes-do-template-->


                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="imagens">
                    <div class="col-md-12" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-images" style="padding-right:10px;"></i>Imagens</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Configurações de logotipos e imagens do site</span>
                            </h4>

                            <div class="col-md-3" style="margin-top:10px;">
                                <div class="input-group" style="margin-bottom:10px;">
                                    <span>Favicon</span>
                                </div>
                                <? $campo_imagem_set = "favicon"; ?>
                                <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
									<? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                    <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                        <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                    </div>
									<? } ?>

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
                                        <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                    </div>
                                    <? } ?>
                                </div>
                            </div>

                            <div class="col-md-3" style="margin-top:10px;">
                                <div class="input-group" style="margin-bottom:10px;">
                                    <span>Logotipo Cabeçalho</span>
                                </div>
                                <? $campo_imagem_set = "logotipo_cabecalho"; ?>
                                <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
									<? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                    <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                        <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                    </div>
									<? } ?>

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
                                        <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                    </div>
                                    <? } ?>
                                </div>
                            </div>

                            <div class="col-md-3" style="margin-top:10px;">
                                <div class="input-group" style="margin-bottom:10px;">
                                    <span>Logotipo Rodapé</span>
                                </div>
                                <? $campo_imagem_set = "logotipo_rodape"; ?>
                                <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
									<? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                    <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                        <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                    </div>
									<? } ?>

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
                                        <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                    </div>
                                    <? } ?>
                                </div>
                            </div>

                            <div class="col-md-3" style="margin-top:10px;">
                                <div class="input-group" style="margin-bottom:10px;">
                                    <span>Logotipo Popup Flutuante</span>
                                </div>
                                <? $campo_imagem_set = "logotipo_popup"; ?>
                                <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
									<? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                    <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                        <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                    </div>
									<? } ?>

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
                                        <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                    </div>
                                    <? } ?>
                                </div>
                            </div>

                            <div class="col-md-3" style="margin-top:10px;">
                                <div class="input-group" style="margin-bottom:10px;">
                                    <span>Logotipo Loja Google</span>
                                </div>
                                <? $campo_imagem_set = "logotipo_loja_google"; ?>
                                <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
									<? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                    <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                        <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                    </div>
									<? } ?>

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
                                        <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                    </div>
                                    <? } ?>
                                </div>
                            </div>

                            <div class="col-md-3" style="margin-top:10px;">
                                <div class="input-group" style="margin-bottom:10px;">
                                    <span>Logotipo Loja Apple</span>
                                </div>
                                <? $campo_imagem_set = "logotipo_loja_apple"; ?>
                                <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
									<? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                    <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                        <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                    </div>
									<? } ?>

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
                                        <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                    </div>
                                    <? } ?>
                                </div>
                            </div>

                            <div class="col-md-3" style="margin-top:10px;">
                                <div class="input-group" style="margin-bottom:10px;">
                                    <span>Imagem Formas de Pagamento</span>
                                </div>
                                <? $campo_imagem_set = "imagem_formas_de_pagamento"; ?>
                                <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
									<? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                    <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                        <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                    </div>
									<? } ?>

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
                                        <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                    </div>
                                    <? } ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- END imagens-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="configuracoes-dos-campos">
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fad fa-user-tie" style="padding-right:10px;"></i>Campos do perfil de 'Profissional'</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Configurações de exibição, textos, obrigatoriedade e funcionamento</span>
                            </h4>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-12">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label e Definição de Textos de Perfil</label>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <div class="col-md-12">
                                        <input value="<?=$row['label_profissional']?>" type="text" name="label_profissional" id="label_profissional" placeholder="" class="form-control" />
                                        <p class="help-block">Singular</p>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <div class="col-md-12">
                                        <input value="<?=$row['label_profissional_plural']?>" type="text" name="label_profissional_plural" id="label_profissional_plural" placeholder="" class="form-control" />
                                        <p class="help-block">Plural</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="help-block">Este texto é exibido nos locais de definição e escolha de tipo de perfil e nas informações internas onde se refere ao perfil. Caso nada for preenchido, o padrão exibido é 'Profissional' e 'Profissionais' respectivamente.</p>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "label_login_profissional"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo de Login</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                        <p class="help-block">Este texto é exibido dentro do campo de login. Caso nada for preenchido, o padrão exibido é 'E-mail, CPF, RG ou CNPJ'.</p>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_profissional_nome"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Nome'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_profissionalArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Nome'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_profissional_genero"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Gênero'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_profissionalArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Gênero'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_profissional_documento"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_tipo"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Tipo de Documento</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="qualquer" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['tipo'])=="qualquer") { echo " selected"; } ?>>Qualquer tipo de documento</option>
                                            <option value="cnpj" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['tipo'])=="cnpj") { echo " selected"; } ?>>Apenas CNPJ</option>
                                            <option value="cpf" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['tipo'])=="cpf") { echo " selected"; } ?>>Apenas CPF</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Documento'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_profissionalArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Documento'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_profissional_data_de_nascimento"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Data de Nascimento'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_profissionalArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_menor_18"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Aceita menor de 18 anos no cadastro?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['menor_18'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['menor_18'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Data de Nascimento'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_profissional_email"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'E-mail'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_profissionalArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'E-mail'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_profissional_telefone"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Tel. Comercial'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_profissionalArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Tel. Comercial'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_profissional_whatsapp"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Tel. WhatsApp'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_profissionalArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Tel. WhatsApp'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_profissional_cep"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'CEP'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_profissionalArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'CEP'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_profissional_rua"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Rua'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_profissionalArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Rua'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_profissional_numero"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Número'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_profissionalArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Número'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_profissional_complemento"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Complemento'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_profissionalArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Complemento'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_profissional_bairro"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Bairro'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_profissionalArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Bairro'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_profissional_cidade"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Cidade'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_profissionalArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Cidade'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_profissional_estado"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Estado'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_profissionalArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Estado'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_profissionalArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
    

                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fad fa-user-crown" style="padding-right:10px;"></i>Campos do perfil de 'Cliente'</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Configurações de exibição, textos, obrigatoriedade e funcionamento</span>
                            </h4>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-12">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label e Definição de Textos de Perfil</label>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <div class="col-md-12">
                                        <input value="<?=$row['label_cliente']?>" type="text" name="label_cliente" id="label_cliente" placeholder="" class="form-control" />
                                        <p class="help-block">Singular</p>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <div class="col-md-12">
                                        <input value="<?=$row['label_cliente_plural']?>" type="text" name="label_cliente_plural" id="label_cliente_plural" placeholder="" class="form-control" />
                                        <p class="help-block">Plural</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="help-block">Este texto é exibido nos locais de definição e escolha de tipo de perfil e nas informações internas onde se refere ao perfil. Caso nada for preenchido, o padrão exibido é 'Cliente' e 'Clientes' respectivamente.</p>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "label_login_cliente"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo de Login</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                        <p class="help-block">Este texto é exibido dentro do campo de login. Caso nada for preenchido, o padrão exibido é 'E-mail, CPF, RG ou CNPJ'.</p>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_nome"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Nome'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Nome'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_genero"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Gênero'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Gênero'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_tipo_sanguineo"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Tipo Sanguíneo'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Tipo Sanguíneo'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_categorias_de_pessoas"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Grupo de Atendimento'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>

                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Grupo de Atendimento'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_numeroUnico_atividades"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Profissão/Atividade'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Profissão/Atividade'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_profissional_da_saude"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Profissional da Saúde'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Profissional da Saúde'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_encontrase_acamado"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Encontra-se Acamado'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Encontra-se Acamado'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_contraiu_doenca"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Contraiu Alguma Doença'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Contraiu Alguma Doença'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_numeroUnico_vacinas"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Lista de Doenças'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Lista de Doenças'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_doenca_outros"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Nome da Doença (Caso Outros)'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Nome da Doença (Caso Outros)'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_numeroUnico_unidades_de_saude"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Unidade de Saúde'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Unidade de Saúde'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_documento"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_tipo"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Tipo de Documento</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="qualquer" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['tipo'])=="qualquer") { echo " selected"; } ?>>Qualquer tipo de documento</option>
                                            <option value="cnpj" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['tipo'])=="cnpj") { echo " selected"; } ?>>Apenas CNPJ</option>
                                            <option value="cpf" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['tipo'])=="cpf") { echo " selected"; } ?>>Apenas CPF</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Documento'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Documento'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_nome_da_mae"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Nome da Mãe'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Nome da Mãe'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_cns"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Cartão Nacional de Saúde'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Cartão Nacional de Saúde'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_data_de_nascimento"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Data de Nascimento'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_menor_18"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Aceita menor de 18 anos no cadastro?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['menor_18'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['menor_18'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Data de Nascimento'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_email"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'E-mail'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'E-mail'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_telefone"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Tel. Comercial'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Tel. Comercial'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_whatsapp"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Tel. WhatsApp'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Tel. WhatsApp'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_cep"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'CEP'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'CEP'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_rua"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Rua'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Rua'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_numero"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Número'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Número'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_complemento"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Complemento'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Complemento'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_bairro"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Bairro'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Bairro'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_cidade"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Cidade'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Cidade'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "campo_cliente_estado"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray."_label"; ?>
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Label do campo 'Estado'</label>
                                    <div class="col-md-12">
                                        <input value="<?=$campos_clienteArray[''.$nome_campoArray.''][0]['label']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-8" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir campo 'Estado'</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control" onchange="javascript:campo_formulario_app_obrigatoriedade('<?=$nome_campo?>');">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['exibir'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_obrigatorio"; ?>
                                <div class="col-md-4" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Obrigatório?</label>
                                    <div class="col-md-12">
                                        <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                            <option value="1" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($campos_clienteArray[''.$nome_campoArray.''][0]['obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- END configuracoes-dos-campos-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="aceites-extras">
                    <div class="col-md-12" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-file-signature" style="padding-right:10px;padding-bottom:10px;"></i>Aceite 1 Extra</span>
                            </h4>

                            <? $nome_campo = "aceite_extra_1"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Ativo</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Título</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['aceite_extra_1_label']?>" type="text" id="aceite_extra_1_label" name="aceite_extra_1_label" class="form-control" placeholder="" />
                                </div>
                            </div>

							<? $nome_campo = "aceite_extra_1_texto"; ?>
                            <div class="form-group" style="margin-top:10px;">
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" id="<?=$nome_campo?>" name="<?=$nome_campo?>"><?=$row[''.$nome_campo.'']?></textarea>
                                </div>
                            </div>

                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-file-signature" style="padding-right:10px;padding-bottom:10px;"></i>Aceite 2 Extra</span>
                            </h4>

                            <? $nome_campo = "aceite_extra_2"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Ativo</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Título</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['aceite_extra_2_label']?>" type="text" id="aceite_extra_2_label" name="aceite_extra_2_label" class="form-control" placeholder="" />
                                </div>
                            </div>

							<? $nome_campo = "aceite_extra_2_texto"; ?>
                            <div class="form-group" style="margin-top:10px;">
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" id="<?=$nome_campo?>" name="<?=$nome_campo?>"><?=$row[''.$nome_campo.'']?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END aceites-extras-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="paginas-do-template">
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-cogs" style="padding-right:10px;"></i>Carrinho Vázio</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Tela exibida quando o carrinho está vazio</span>
                            </h4>
    
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Imagem do Topo</label>
                                <div class="col-md-12">
									<? $campo_imagem_set = "imagem_carrinho_vazio"; ?>
                                    <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                        <? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                        <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                        </div>
                                        <? } ?>
    
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
                                            <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                        </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>

                            <? $nome_campo = "titulo_carrinho_vazio"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Título do Texto da Página</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <? $nome_campo = "texto_carrinho_vazio"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Texto da Página</label>
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" name="<?=$nome_campo?>" id="<?=$nome_campo?>"><?=$row[''.$nome_campo.'']?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-cogs" style="padding-right:10px;"></i>Compra em Análise</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Tela exibida quando a compra é enviada para análise</span>
                            </h4>
    
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Imagem do Topo</label>
                                <div class="col-md-12">
									<? $campo_imagem_set = "imagem_compra_em_analise"; ?>
                                    <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                        <? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                        <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                        </div>
                                        <? } ?>
    
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
                                            <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                        </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>

                            <? $nome_campo = "titulo_compra_em_analise"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Título do Texto da Página</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <? $nome_campo = "texto_compra_em_analise"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Texto da Página</label>
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" name="<?=$nome_campo?>" id="<?=$nome_campo?>"><?=$row[''.$nome_campo.'']?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-cogs" style="padding-right:10px;"></i>Compra Confirmada</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Tela exibida quando a compra é confirmado o pagamento imediato</span>
                            </h4>
    
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Imagem do Topo</label>
                                <div class="col-md-12">
									<? $campo_imagem_set = "imagem_compra_confirmada"; ?>
                                    <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                        <? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                        <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                        </div>
                                        <? } ?>
    
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
                                            <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                        </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>

                            <? $nome_campo = "titulo_compra_confirmada"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Título do Texto da Página</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <? $nome_campo = "texto_compra_confirmada"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Texto da Página</label>
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" name="<?=$nome_campo?>" id="<?=$nome_campo?>"><?=$row[''.$nome_campo.'']?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-cogs" style="padding-right:10px;"></i>Orçamento Confirmado</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Tela exibida quando o orçamento é confirmado</span>
                            </h4>
    
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Imagem do Topo</label>
                                <div class="col-md-12">
									<? $campo_imagem_set = "imagem_orcamento_confirmada"; ?>
                                    <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                        <? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                        <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                        </div>
                                        <? } ?>
    
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
                                            <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                        </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>

                            <? $nome_campo = "titulo_orcamento_confirmada"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Título do Texto da Página</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <? $nome_campo = "texto_orcamento_confirmada"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Texto da Página</label>
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" name="<?=$nome_campo?>" id="<?=$nome_campo?>"><?=$row[''.$nome_campo.'']?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-cogs" style="padding-right:10px;"></i>Compra com Boleto</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Tela exibida quando a compra é selecionado pagamento com boleto.</span>
                            </h4>
    
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Imagem do Topo</label>
                                <div class="col-md-12">
									<? $campo_imagem_set = "imagem_compra_boleto_pagar"; ?>
                                    <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                        <? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                        <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                        </div>
                                        <? } ?>
    
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
                                            <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                        </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>

                            <? $nome_campo = "titulo_compra_boleto_pagar"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Título do Texto da Página</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <? $nome_campo = "texto_compra_boleto_pagar"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Texto da Página</label>
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" name="<?=$nome_campo?>" id="<?=$nome_campo?>"><?=$row[''.$nome_campo.'']?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-cogs" style="padding-right:10px;"></i>Erro na Compra</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Tela exibida quando o processo de compra acontece algum erro.</span>
                            </h4>
    
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Imagem do Topo</label>
                                <div class="col-md-12">
									<? $campo_imagem_set = "imagem_compra_erro"; ?>
                                    <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                        <? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                        <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                        </div>
                                        <? } ?>
    
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
                                            <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                        </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>

                            <? $nome_campo = "titulo_compra_erro"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Título do Texto da Página</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <? $nome_campo = "texto_compra_erro"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Texto da Página</label>
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" name="<?=$nome_campo?>" id="<?=$nome_campo?>"><?=$row[''.$nome_campo.'']?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- END configuracoes-de-templates-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:5px;padding-right:5px;padding-top:0px;margin-top:-5px;" id="informacoes-do-template">
                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;padding-right:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;">Informações de Menu</span>
                            </h4>

							<? $nome_campoArray = "label_menu_home"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Home no Singular</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_plural"; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Home no Plural</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "label_menu_eventos"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Evento no Singular</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_plural"; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Evento no Plural</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "label_menu_contato"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Contato no Singular</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_plural"; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Contato no Plural</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "label_menu_acesso"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Entrar no Singular</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_plural"; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Entrar no Plural</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "label_menu_cadastro"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Cadastre-se no Singular</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_plural"; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Cadastre-se no Plural</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "label_menu_minha_conta"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Minha Conta no Singular</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_plural"; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Minha Conta no Plural</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "label_menu_meus_ingressos"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Meus Ingressos no Singular</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_plural"; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Meus Ingressos no Plural</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>

							<? $nome_campoArray = "label_menu_minhas_compras"; ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <? $nome_campo = "".$nome_campoArray.""; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Minhas Compras no Singular</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <? $nome_campo = "".$nome_campoArray."_plural"; ?>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Minhas Compras no Plural</label>
                                    <div class="col-md-12">
                                        <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;padding-right:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;">Informações do Topo</span>
                            </h4>
    
                            <? $nome_campo = "topo_telefone"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Telefone</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>
    
                            <? $nome_campo = "topo_email"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">E-mail</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>
    
                            <? $nome_campo = "topo_horario_funcionamento"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Horário de Funcionamento</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;">Informações do Rodapé</span>
                            </h4>
    
                            <? $nome_campo = "rodape_telefone"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Telefone</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>
    
                            <? $nome_campo = "rodape_email"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">E-mail</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>
    
                            <? $nome_campo = "rodape_horario_funcionamento"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Horário de Funcionamento</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <? $nome_campo = "rodape_endereco"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Horário de Funcionamento</label>
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" name="<?=$nome_campo?>" id="<?=$nome_campo?>"><?=$row[''.$nome_campo.'']?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;padding-right:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;">Informações Página de Contato</span>
                            </h4>
    
                            <? $nome_campo = "contato_telefone"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Telefone</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>
    
                            <? $nome_campo = "contato_email"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">E-mail</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>
    
                            <? $nome_campo = "contato_horario_funcionamento"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Horário de Funcionamento</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>
    
                            <? $nome_campo = "contato_link_do_mapa"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Link do Mapa</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>
    
                            <? $nome_campo = "contato_endereco_extenso"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Endereço por Extenso</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>
    
                            <? $nome_campo = "contato_endereco"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Endereço</label>
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" name="<?=$nome_campo?>" id="<?=$nome_campo?>"><?=$row[''.$nome_campo.'']?></textarea>
                                </div>
                            </div>
    
                            <? $nome_campo = "contato_titulo_do_texto"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Título do Texto da Página</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="Título do Texto da Página" class="form-control" />
                                </div>
                            </div>
    
                            <? $nome_campo = "contato_texto_da_pagina"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Texto da Página</label>
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" name="<?=$nome_campo?>" id="<?=$nome_campo?>"><?=$row[''.$nome_campo.'']?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;padding-right:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;">Box de Destaque Rodapé</span>
                            </h4>
    
                            <? $nome_campo = "call_of_action_titulo"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Título</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>
    
                            <? $nome_campo = "call_of_action_texto1"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Texto 1</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>
    
                            <? $nome_campo = "call_of_action_texto2"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Texto 2</label>
                                <div class="col-md-12">
                                    <input value="<?=$row[''.$nome_campo.'']?>" type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" placeholder="" class="form-control" />
                                </div>
                            </div>
    
                            <? $nome_campo = "call_of_action_cor_de_fundo"; ?>
                            <div class="col-md-12" style="padding-left:0px;">
                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo</label>
                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                    <p class="help-block">Esta configuração afeta a cor de fundo do destaque que aparece antes do rodapé</p>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Imagem de Fundo</label>
                                <div class="col-md-12">
                                    <? $campo_imagem_set = "call_of_action_imagem_de_fundo"; ?>
                                    <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                        <? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                        <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                        </div>
                                        <? } ?>
    
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
                                            <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                        </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Mockup 1</label>
                                <div class="col-md-12">
                                    <? $campo_imagem_set = "call_of_action_mockup1"; ?>
                                    <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                        <? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                        <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                        </div>
                                        <? } ?>
    
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
                                            <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                        </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Mockup 2</label>
                                <div class="col-md-12">
                                    <? $campo_imagem_set = "call_of_action_mockup2"; ?>
                                    <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                        <? if(trim($row[''.$campo_imagem_set.''])=="") {  } else { ?>
                                        <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row[''.$campo_imagem_set.'']?>" alt="">
                                        </div>
                                        <? } ?>
    
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
                                            <a class="btn red fileinput-exists" data-dismiss="fileinput" href="javascript:;" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','<?=$campo_imagem_set?>');">Remover</a>
                                        </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END configuracoes-de-templates-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:5px;padding-right:5px;padding-top:0px;margin-top:-5px;" id="cores">
                    <div class="col-md-12" style="padding:10px;padding-top:5px;">

                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <div class="row">
                                <div class="col-md-3">
                                    <ul class="ver-inline-menu tabbable margin-bottom-10">
                                        <li onclick="seta_aba('cores-base');"><a data-toggle="tab" href="#cores-base"><i class="fa fa-caret-right"></i> Cores Base</a></li>
                                        <li onclick="seta_aba('cores-de-botoes');"><a data-toggle="tab" href="#cores-de-botoes"><i class="fa fa-caret-right"></i> Cores de Botões</a></li>
                                        <li onclick="seta_aba('cores-do-cabecalho');"><a data-toggle="tab" href="#cores-do-cabecalho"><i class="fa fa-caret-right"></i> Cores do Cabeçalho</a></li>
                                        <li onclick="seta_aba('cores-do-caminho-de-migalha');"><a data-toggle="tab" href="#cores-do-caminho-de-migalha"><i class="fa fa-caret-right"></i> Cores do Caminho de Migalha</a></li>
                                        <li onclick="seta_aba('cores-do-menu');"><a data-toggle="tab" href="#cores-do-menu"><i class="fa fa-caret-right"></i> Cores do Menu</a></li>
                                        <li onclick="seta_aba('cores-do-popup-flutuante');"><a data-toggle="tab" href="#cores-do-popup-flutuante"><i class="fa fa-caret-right"></i> Cores do Popup Flutuante</a></li>
                                        <li onclick="seta_aba('cores-do-corpo-do-site');"><a data-toggle="tab" href="#cores-do-corpo-do-site"><i class="fa fa-caret-right"></i> Cores do Corpo do Site</a></li>
                                        <li onclick="seta_aba('cores-do-meu-painel');"><a data-toggle="tab" href="#cores-do-meu-painel"><i class="fa fa-caret-right"></i> Cores do Meu Painel</a></li>
                                        <li onclick="seta_aba('cores-do-rodape');"><a data-toggle="tab" href="#cores-do-rodape"><i class="fa fa-caret-right"></i> Cores do Rodapé</a></li>
                                        <li onclick="seta_aba('cores-adicionais-de-produto');"><a data-toggle="tab" href="#cores-adicionais-de-produto"><i class="fa fa-caret-right"></i> Cores Adicionais de Produto</a></li>
                                        <li onclick="seta_aba('cores-do-checkout');"><a data-toggle="tab" href="#cores-do-checkout"><i class="fa fa-caret-right"></i> Cores do Checkout</a></li>
                                        <li onclick="seta_aba('cores-do-carrosel-do-checkout');"><a data-toggle="tab" href="#cores-do-carrosel-do-checkout"><i class="fa fa-caret-right"></i> Cores do Carrosel do Checkout</a></li>
                                        <li onclick="seta_aba('cores-do-carrinho-flutuante');"><a data-toggle="tab" href="#cores-do-carrinho-flutuante"><i class="fa fa-caret-right"></i> Cores do Carrinho Flutuante</a></li>
                                    </ul>
                                </div>
    
                                <div class="col-md-9">
                                    <div class="portlet light bg-inverse form-fit">
                                    <div class="portlet-body form">
                                        <div class="form-body" style="padding:10px;">
                                            <div class="tab-content">
    
                                                <div id="cores-base" class="tab-pane active" style="min-height:350px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
    
                                                            <? $nome_campo = "cor_principal"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor Principal</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo das telas de login, esqueci minha senha e cadastro</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fundo_do_site"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fundo do Site</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo dos formulários das telas de login, esqueci minha senha e cadastro</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte Principal</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo dos campos dos formulários das telas de login, esqueci minha senha e cadastro</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte_titulo"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte Títulos</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de texto, placeholder e borda dos campos existentes nas telas de login e cadastro.</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte_subtitulo"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte Subtítulos</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de texto dos links existentes na tela de login. Esqueceu sua senha? Ainda não é registrado? e outros.</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte_texto"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte Texto</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de texto dos links existentes na tela de login. Esqueceu sua senha? Ainda não é registrado? e outros.</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte_link"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte Links</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de texto dos links existentes na tela de login. Esqueceu sua senha? Ainda não é registrado? e outros.</p>
                                                                </div>
                                                            </div>
    
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIM cores-base -->
    
                                                <div id="cores-de-botoes" class="tab-pane" style="min-height:350px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
    
                                                            <? $nome_campo = "cor_fundo_do_botao"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fundo do Botão</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo das telas internas do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte_do_botao"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte do Botão</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo das telas internas do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fundo_hover_do_botao"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fundo Hover do Botão</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo dos cabeçalhos nas telas internas do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte_hover_do_botao"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte Hover do Botão</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor afeta a fonte de título dos cabeçalhos nas telas internas do aplicativo</p>
                                                                </div>
                                                            </div>
    
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIM cores-de-botoes -->
    
                                                <div id="cores-do-cabecalho" class="tab-pane" style="min-height:350px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
    
                                                            <? $nome_campo = "cor_fundo_cabecalho"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fundo Cabeçalho</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor dos títulos coloridos do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte_cabecalho"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte Cabeçalho</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor dos subtítulos coloridos do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_link_cabecalho"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Link Cabeçalho</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor dos subtítulos coloridos do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_cabecalho_hover"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo Cabeçalho Hover</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor dos textos coloridos do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_cabecalho_hover"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte Cabeçalho Hover</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor dos títulos padrões do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_divisor_cabecalho"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Linha Divisora do Cabeçalho</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor dos títulos padrões do aplicativo</p>
                                                                </div>
                                                            </div>
    
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIM cores-do-cabecalho -->
    
                                                <div id="cores-do-caminho-de-migalha" class="tab-pane" style="min-height:350px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
    
                                                            <? $nome_campo = "cor_fundo_caminho_de_migalhas"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo do Caminho de Migalhas</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo do cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte_titulo_caminho_de_migalhas"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte do Título do Caminho de Migalhas</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da bora do cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte_link_caminho_de_migalhas"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte do Link do Caminho de Migalhas</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do texto do cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte_texto_caminho_de_migalhas"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte do Texto do Caminho de Migalhas</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da seta de voltar no cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
    
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIM cores-do-caminho-de-migalha -->
    
                                                <div id="cores-do-menu" class="tab-pane" style="min-height:350px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                            
                                                            <? $nome_campo = "cor_fundo_do_menu"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fundo do Menu</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo dos botões transparentes nas telas de login e cadastro do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte_do_menu"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte do Menu</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da borda dos botões transparentes nas telas de login e cadastro do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_menu_hover"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo Menu Hover</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo dos botões coloridos nas telas de login e cadastro do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte_do_menu_hover"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte do Menu Hover</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da borda dos botões coloridos nas telas de login e cadastro do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_divisor_abaixo_do_menu"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Divisor Abaixo do Menu</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do texto dos botões coloridos nas telas de login e cadastro do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_1_de_fundo_menu_responsivo"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor 1 de Fundo Menu Responsivo</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo dos botões coloridos do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_2_de_fundo_menu_responsivo"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor 2 de Fundo Menu Responsivo</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da borda dos botões coloridos do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_menu_responsivo"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte Menu Responsivo</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do texto dos botões coloridos do aplicativo</p>
                                                                </div>
                                                            </div>
    
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIM cores-do-menu -->
    
                                                <div id="cores-do-popup-flutuante" class="tab-pane" style="min-height:350px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
    
                                                            <? $nome_campo = "cor_de_fundo_popup_flutuante"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo do Popup</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor dos títulos coloridos do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte_textos_popup"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Textos do Popup</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor dos subtítulos coloridos do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_borda_do_campo_popup"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Borda dos Campos</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor dos textos coloridos do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_campo_popup"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo dos Campos</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor dos títulos padrões do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_campo_popup"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte dos Campos</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor dos títulos padrões do aplicativo</p>
                                                                </div>
                                                            </div>
    
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIM cores-do-popup-flutuante -->
    
                                                <div id="cores-do-corpo-do-site" class="tab-pane" style="min-height:350px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
    
                                                            <? $nome_campo = "cor_de_fundo_do_slide"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo do Slide</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo do informativo de carrinho no rodapé do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_cabecalho_box_dos_itens"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo do Cabeçalho do Box dos Itens</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo do menu de rodapé do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_cabecalho_box_dos_itens"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte do Cabeçalho do Box dos Itens</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo do menu de rodapé do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_box_dos_itens"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo Box dos Itens</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo do menu de rodapé do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_icone_box_dos_itens"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor dos Ícones Box dos Itens</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da borda do menu de rodapé do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_titulo_box_dos_itens"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Título Box dos Itens</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da borda do menu de rodapé do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_subtitulo_box_dos_itens"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Subtítulo Box dos Itens</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do ícone sem estar clicado</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_preco_box_dos_itens"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Preço Box dos Itens</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do texto sem estar clicado</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_preco_desconto_box_dos_itens"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Preço Desconto Box dos Itens</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do ícone quando está clicado</p>
                                                                </div>
                                                            </div>
                            
                                                            <? $nome_campo = "cor_de_fundo_box_categorias"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo Box Categorias</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do texto quando está clicado</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_box_categorias_titulo"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo Box Categorias Título</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do texto quando está clicado</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fonte_box_categorias_titulo"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fonte Box Categorias Título</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do texto quando está clicado</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fonte_box_categorias"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fonte Box Categorias</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do texto quando está clicado</p>
                                                                </div>
                                                            </div>
    
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIM cores-do-corpo-do-site -->
    
                                                <div id="cores-do-meu-painel" class="tab-pane" style="min-height:350px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
    
                                                            <? $nome_campo = "cor_de_fundo_do_menu_painel"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo do Menu Painel</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo do cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fonte_do_menu_ativo_painel"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fonte do Menu Ativo Painel</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da bora do cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fonte_do_menu_inativo_painel"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fonte do Menu Inativo Painel</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do texto do cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_do_painel_direito"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo do Painel Direito</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo do cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_dos_titulos_do_painel_direito"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte dos Títulos do Painel Direito</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da bora do cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_dos_textos_do_painel_direito"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte dos Textos do Painel Direito</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do texto do cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_dos_campos_do_painel_direito"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo dos Campos do Painel Direito</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da borda do avatar no cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_dos_campos_do_painel_direito"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte dos Campos do Painel Direito</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo do avatar no cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_do_cabecalho_das_tabelas_do_painel_direito"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo do Cabeçalho das Tabelas do Painel Direito</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da seta de voltar no cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_do_cabecalho_das_tabelas_do_painel_direito"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte do Cabeçalho das Tabelas do Painel Direito</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da seta de voltar no cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_dos_textos_das_tabelas_do_painel_direito"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte dos Textos das Tabelas do Painel Direito</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da seta de voltar no cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
    
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIM cores-do-meu-painel -->
    
                                                <div id="cores-do-rodape" class="tab-pane" style="min-height:350px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
    
                                                            <? $nome_campo = "cor_divisor_antes_do_rodape"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Divisor Antes do Rodapé</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo da linha onde encontra-se  campo do formulário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "fonte_divisor_antes_do_rodape"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte Divisor Antes do Rodapé</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da borda onde encontra-se  campo do formulário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fundo_do_rodape"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fundo do Rodapé</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo do campo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte_principal_rodape"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte Principal Rodapé</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da borda do campo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte_secundario_rodape"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte Secundário Rodape</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do placeholder do campo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fundo_copyright"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fundo Copyright</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do texto do campo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_fonte_copyright"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte Copyright</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do texto do campo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_link_copyright"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Link Copyright</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do texto do campo</p>
                                                                </div>
                                                            </div>
    
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIM cores-do-rodape -->
    
                                                <div id="cores-adicionais-de-produto" class="tab-pane" style="min-height:350px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
    
                                                            <? $nome_campo = "cor_de_fundo_adicionais"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo Adicionais</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundos das navegações em abas do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_titulo_produto_adicionais"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte Título Produto Adicionais</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da borda das navegações em abas do aplicativo</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_preco_produto_adicionais"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte Preço Produto Adicionais</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo dos itens e menus em formato de box</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_cabecalho_tabela_de_adicionais"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Cabeçalho Tabela de Adicionais</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do ícone que pode ser exibido nos itens e menus em formato de box</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_do_cabecalho_tabela_de_adicionais"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte do Cabeçalho Tabela de Adicionais</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do título dos itens e menus em formato de box</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_titulo_na_tabela_de_adicionais"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte Título na Tabela de Adicionais</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo do subtítulo dos itens e menus em formato de box</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_preco_na_tabela_de_adicionais"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte Preço na Tabela de Adicionais</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do subtítulo dos itens e menus em formato de box</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_botoes_quantidade_na_tabela_de_adicionais"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo Botões Quantidade na Tabela de Adicionais</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do subtítulo dos itens e menus em formato de box</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_campo_quantidade_na_tabela_de_adicionais"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo Campo Quantidade na Tabela de Adicionais</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do subtítulo dos itens e menus em formato de box</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_campo_quantidade_na_tabela_de_adicionais"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte Campo Quantidade na Tabela de Adicionais</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do subtítulo dos itens e menus em formato de box</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_valor_total_tabela_de_adicionais"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo Valor Total Tabela de Adicionais</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do subtítulo dos itens e menus em formato de box</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_valor_total_tabela_de_adicionais"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte Valor Total Tabela de Adicionais</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do subtítulo dos itens e menus em formato de box</p>
                                                                </div>
                                                            </div>
    
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIM cores-adicionais-de-produto -->
    
                                                <div id="cores-do-checkout" class="tab-pane" style="min-height:350px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
    
                                                            <? $nome_campo = "cor_de_fundo_cabecalho_da_tabela_checkout"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo Cabeçalho da Tabela Checkout</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundo do cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_cabecalho_da_tabela_checkout"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte Cabeçalho da Tabela Checkout</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da bora do cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_da_tabela_checkout"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo da Tabela Checkout</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor do texto do cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_dos_detalhes_do_produto_e_precos_da_tabela_checkout"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte dos Detalhes do Produto e Preços da Tabela Checkout</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da seta de voltar no cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                            
                                                            <? $nome_campo = "cor_valores_totais_carrinho"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte dos Valores Totais e Preços da Tabela Checkout</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da seta de voltar no cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
                            
                                                            <? $nome_campo = "cor_fonte_cabecalho_info_carrinho"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte dos Caebçalhos das Tabelas de Informações da Tabela Checkout</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da seta de voltar no cabeçalho onde tem as informações do usuário</p>
                                                                </div>
                                                            </div>
    
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIM cores-do-checkout -->
    
                                                <div id="cores-do-carrosel-do-checkout" class="tab-pane" style="min-height:350px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
    
                                                            <? $nome_campo = "cor_de_fundo_cabecalho_do_carrossel_no_checkout"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo Cabeçalho do Carrossel no Checkout</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundos dos itens divisores de menu</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_cabecalho_do_carrossel_no_checkout"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte Cabeçalho do Carrossel no Checkout</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de texto dos itens divisores de menu</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_do_carrossel_no_checkout"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo do Carrossel no Checkout</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundos dos itens do menu</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_dos_titulos_do_carrossel_no_checkout"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte dos Títulos do Carrossel no Checkout</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da borda dos itens do menu</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_dos_textos_do_carrossel_no_checkout"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte dos Textos do Carrossel no Checkout</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de texto dos itens do menu</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_dos_campos_do_carrossel_no_checkout"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo dos Campos do Carrossel no Checkout</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor dos ícones dos itens do menu</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_dos_campos_do_carrossel_no_checkout"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte dos Campos do Carrossel no Checkout</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor das seta dos itens do menu</p>
                                                                </div>
                                                            </div>
    
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIM cores-do-carrosel-do-checkout -->
    
                                                <div id="cores-do-carrinho-flutuante" class="tab-pane" style="min-height:350px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
    
                                                            <? $nome_campo = "cor_de_fundo_carrinho_flutuante"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo Carrinho Flutuante</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundos dos itens divisores de menu</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_cabecalho_carrinho_flutuante"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo Cabeçalho Carrinho Flutuante</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de texto dos itens divisores de menu</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_cabecalho_carrinho_flutuante"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte Cabeçalho Carrinho Flutuante</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de fundos dos itens do menu</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_detalhes_produto_carrinho_flutuante"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte Detalhes Produto Carrinho Flutuante</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor da borda dos itens do menu</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_totais_carrinho_flutuante"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo Totais Carrinho Flutuante</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor de texto dos itens do menu</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_totais_carrinho_flutuante"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte Totais Carrinho Flutuante</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor dos ícones dos itens do menu</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_de_fundo_botao_finalizar_compra_carrinho_flutuante"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor de Fundo Botão Finalizar Compra Carrinho Flutuante</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor das seta dos itens do menu</p>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "cor_da_fonte_botao_finalizar_compra_carrinho_flutuante"; ?>
                                                            <div class="col-md-12" style="padding-left:0px;">
                                                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Cor da Fonte Botão Finalizar Compra Carrinho Flutuante</label>
                                                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                                                    <? if(trim($row[''.$nome_campo.''])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row[''.$nome_campo.'']; } ?>
                                                                    <input type="text" name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">Esta configuração afeta a cor das seta dos itens do menu</p>
                                                                </div>
                                                            </div>
    
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIM cores-do-carrinho-flutuante -->
    
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
    
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END cores-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="contatos-e-permissoes">
                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-user-headset" style="padding-right:10px;"></i>Dados de Suporte</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Informações de suporte exibidas no app</span>
                            </h4>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Nome</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['suporte_nome']?>" type="text" id="suporte_nome" name="suporte_nome" class="form-control" placeholder="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">E-mail</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['suporte_email']?>" type="text" id="suporte_email" name="suporte_email" class="form-control" placeholder="" />
                                </div>
                            </div>

                            <? monta_mascara("suporte_telefone","(99) 9999-9999"); ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Telefone</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['suporte_telefone']?>" type="text" name="suporte_telefone" id="suporte_telefone" placeholder="Telefone Fixo" class="form-control" />
                                </div>
                            </div>

                            <? monta_mascara("suporte_whatsapp","(99) 99999-9999"); ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">WhatsApp</label>
                                <div class="col-md-12">
                                    <div class="input-icon">
                                        <i class="fab fa-whatsapp"></i>
                                        <input value="<?=$row['suporte_whatsapp']?>" class="form-control" type="text" name="suporte_whatsapp" id="suporte_whatsapp" placeholder="Telefone Celular e WhatsApp" />
                                    </div>
                                    <?
                                    if(trim($row['suporte_whatsapp'])=="") {
                                    } else {
                                        $suporte_whatsappSet = $row['suporte_whatsapp'];
                                        $suporte_whatsappSet = preg_replace("/[^0-9]/", "", $suporte_whatsappSet);
                                        $suporte_whatsappLink = "https://api.whatsapp.com/send?phone=+55".$suporte_whatsappLink."&text=Ol%C3%A1!";
                                    ?>
                                    <a href="<?=$suporte_whatsappLink?>" target="_blank" style="padding-top:5px;">Iniciar uma conversa</a>
                                    <? } ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-shopping-cart" style="padding-right:10px;"></i>Dados de Venda</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Informações de venda exibidas no app</span>
                            </h4>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Nome</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['vendas_nome']?>" type="text" id="vendas_nome" name="vendas_nome" class="form-control" placeholder="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">E-mail</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['vendas_email']?>" type="text" id="vendas_email" name="vendas_email" class="form-control" placeholder="" />
                                </div>
                            </div>

                            <? monta_mascara("vendas_telefone","(99) 9999-9999"); ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Telefone</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['vendas_telefone']?>" type="text" name="vendas_telefone" id="vendas_telefone" placeholder="Telefone Fixo" class="form-control" />
                                </div>
                            </div>

                            <? monta_mascara("vendas_whatsapp","(99) 99999-9999"); ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">WhatsApp</label>
                                <div class="col-md-12">
                                    <div class="input-icon">
                                        <i class="fab fa-whatsapp"></i>
                                        <input value="<?=$row['vendas_whatsapp']?>" class="form-control" type="text" name="vendas_whatsapp" id="vendas_whatsapp" placeholder="Telefone Celular e WhatsApp" />
                                    </div>
                                    <?
                                    if(trim($row['vendas_whatsapp'])=="") {
                                    } else {
                                        $vendas_whatsappSet = $row['vendas_whatsapp'];
                                        $vendas_whatsappSet = preg_replace("/[^0-9]/", "", $vendas_whatsappSet);
                                        $vendas_whatsappLink = "https://api.whatsapp.com/send?phone=+55".$vendas_whatsappLink."&text=Ol%C3%A1!";
                                    ?>
                                    <a href="<?=$vendas_whatsappLink?>" target="_blank" style="padding-top:5px;">Iniciar uma conversa</a>
                                    <? } ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-question-circle" style="padding-right:10px;"></i>Dados de Dúvidas</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Informações de dúvidas exibidas no app</span>
                            </h4>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Nome</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['duvidas_nome']?>" type="text" id="duvidas_nome" name="duvidas_nome" class="form-control" placeholder="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">E-mail</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['duvidas_email']?>" type="text" id="duvidas_email" name="duvidas_email" class="form-control" placeholder="" />
                                </div>
                            </div>

                            <? monta_mascara("duvidas_telefone","(99) 9999-9999"); ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Telefone</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['duvidas_telefone']?>" type="text" name="duvidas_telefone" id="duvidas_telefone" placeholder="Telefone Fixo" class="form-control" />
                                </div>
                            </div>

                            <? monta_mascara("duvidas_whatsapp","(99) 99999-9999"); ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">WhatsApp</label>
                                <div class="col-md-12">
                                    <div class="input-icon">
                                        <i class="fab fa-whatsapp"></i>
                                        <input value="<?=$row['duvidas_whatsapp']?>" class="form-control" type="text" name="duvidas_whatsapp" id="duvidas_whatsapp" placeholder="Telefone Celular e WhatsApp" />
                                    </div>
                                    <?
                                    if(trim($row['duvidas_whatsapp'])=="") {
                                    } else {
                                        $duvidas_whatsappSet = $row['duvidas_whatsapp'];
                                        $duvidas_whatsappSet = preg_replace("/[^0-9]/", "", $duvidas_whatsappSet);
                                        $duvidas_whatsappLink = "https://api.whatsapp.com/send?phone=+55".$duvidas_whatsappLink."&text=Ol%C3%A1!";
                                    ?>
                                    <a href="<?=$duvidas_whatsappLink?>" target="_blank" style="padding-top:5px;">Iniciar uma conversa</a>
                                    <? } ?>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- END contatos-e-permissoes-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="configuracoes-de-loja">

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-cogs" style="padding-right:10px;"></i>Configuração de Loja</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Comportamento de cadastros e carrinho no site</span>
                            </h4>

                            <? $nome_campo = "delivery"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Possui Delivery ?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "aceita_compra_sem_cadastro"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Aceita Compra Sem Cadastro ?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "verificacao_de_genero"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Verificação de Genero ?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "checkout_com_cupom"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Checkout com Cupom ?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "cashback"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Cashback ?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "apenas_cartao_validado"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Apenas Cartão Validado ?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-cogs" style="padding-right:10px;"></i>Formas de Pagamento</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Comportamento das formas de pagamento no site</span>
                            </h4>

                            <? $nome_campo = "aceita_ccr"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Aceita Cartão de Crédito ?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "aceita_boleto"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Aceita Boleto ?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "aceita_pix"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Aceita PIX ?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="">---</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- END configuracoes-de-loja-->

                </form>


            </div>

        </div>
    </div>


    <div class="botoes_salvar_rodape">
        <? if(trim($_REQUEST['var3'])=="novo") { $nome_btn = "Cadastrar Configuração de Site"; } else { $nome_btn = "Salvar Mudanças"; } ?>
        <div class="row top-side">
            <!-- Inicio menu desktop-->
            <div class="col-xs-6 col-sm-12 botoes_de_salvar top-side-desktop">
                <button type="button" class="btn yellow-gold input-label" style="margin-left: 0px;" onclick="javascript:site_salvar('<?=$tipo_form_set?>');" style=""><?=$nome_btn?></button>
                <button type="button" class="btn green input-label" style="margin-left: 0px;" onclick="javascript:site_salvar('<?=$tipo_form_set?>-continuar');" style=""><?=$nome_btn?> e Continuar Editando</button>
            </div>
            <!-- Fim menu desktop-->
        </div>
    </div>

<? } ?>