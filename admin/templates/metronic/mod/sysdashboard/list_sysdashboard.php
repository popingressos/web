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
                            include("./templates/".$layout_padrao_set."/acoes/sysdashboard/tabela-tbody-".$mod.".php"); 
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
                        echo "<input type=\"hidden\" name=\"modulo\" id=\"modulo\" value=\"sysdashboard_add\" />";
                        
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
        
                        }
                        

                        echo "".$iditem_input."";
                        echo "<input type=\"hidden\" name=\"numeroUnico\" id=\"numeroUnico\" value=\"".$_SESSION['numeroUnicoGerado']."\" />";
                        echo "<input type=\"hidden\" name=\"idsysusu\" value=\"".$id_redator_set."\" />";
                        echo "".$id_item_row_input."";
        
                        ?>
                <div class="col-md-12 div_ativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="informacoes-basicas">
                    <div class="col-md-12" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-file-invoice" style="padding-right:10px;"></i>Informações básicas</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Configurações de Exibição</span>
                            </h4>
    
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Ordem</label>
                                <div class="col-md-12">
                                    <select name="ordem" id="ordem" class="form-control">
                                        <option value="">---</option>
										<?
                                        $nSql = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sysdashboard WHERE idsysusu='".$sysusu['id']."' "));
                                        if($nSql[0]==0) {
                                        ?>
                                        <option value='1'>1</option>
                                        <?
										} else {
											if(trim($tipo_form_set)=="add") {
												$ultimaOrdem = $nSql[0] + 1;
											} else {
												$ultimaOrdem = $nSql[0];
											}
											for ($b=1; $b<=$ultimaOrdem; $b++) {
                                        ?>
                                            <option value='<?=$b?>' <? if($b==$row['ordem']) { echo "selected"; } ?>><?=$b?></option>
                                            <? } ?>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Título do Bloco</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['nome']?>" type="text" name="nome" id="nome" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Subtítulo do Bloco</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['subtitulo']?>" type="text" name="subtitulo" id="subtitulo" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Módulo do Bloco</label>
                                <div class="col-md-12">
                                    <select name="modulo_do_bloco" id="modulo_do_bloco" class="form-control">
                                        <option value="">---</option>
                                        <option value="resumo_financeiro_mes_atual" <? if(trim($row['modulo_do_bloco'])=="resumo_financeiro_mes_atual") { echo " selected"; } ?>>Resumo Financeiro do mês atual</option>
                                        <option value="resumo_financeiro_total" <? if(trim($row['modulo_do_bloco'])=="resumo_financeiro_total") { echo " selected"; } ?>>Resumo Financeiro Total</option>
                                        <option value="agenda_do_google" <? if(trim($row['modulo_do_bloco'])=="agenda_do_google") { echo " selected"; } ?>>Agenda do Google</option>

                                        <? if(trim($_construtor_sysperm['visualizar_TRvGFS9gJzCgikXBxXLQJdAzqbs9bq'])==1) { ?>
                                        <option value="resumo_notificacao_por_evento" <? if(trim($row['modulo_do_bloco'])=="resumo_notificacao_por_evento") { echo " selected"; } ?>>Resumo de Notificações por Evento</option>

                                        <option value="cadastrados_por_mapa" <? if(trim($row['modulo_do_bloco'])=="cadastrados_por_mapa") { echo " selected"; } ?>>Cadastrados por Mapa</option>
                                        <option value="cadastros_por_faixa_etaria_tabela" <? if(trim($row['modulo_do_bloco'])=="cadastros_por_faixa_etaria_tabela") { echo " selected"; } ?>>Tabela de Cadastrados por Faixa Etária</option>
                                        <option value="cadastros_por_idade_tabela" <? if(trim($row['modulo_do_bloco'])=="cadastros_por_idade_tabela") { echo " selected"; } ?>>Tabela de Cadastrados por Idade</option>

                                        <option value="vacinados_por_periodo_tabela" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_periodo_tabela") { echo " selected"; } ?>>Tabela de Vacinados por Período</option>
                                        <option value="vacinados_por_grupo_tabela" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_grupo_tabela") { echo " selected"; } ?>>Tabela de Vacinados por Grupo</option>
                                        <option value="vacinados_por_faixa_etaria_tabela" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_faixa_etaria_tabela") { echo " selected"; } ?>>Tabela de Vacinados por Faixa Etária</option>
                                        <option value="vacinados_por_idade_tabela" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_idade_tabela") { echo " selected"; } ?>>Tabela de Vacinados por Idade</option>

                                        <option value="vacinados_por_periodo" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_periodo") { echo " selected"; } ?>>Gráfico de Vacinados por Período</option>
                                        <option value="vacinados_por_grupo" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_grupo") { echo " selected"; } ?>>Gráfico de Vacinados por Grupo</option>
                                        <option value="vacinados_por_faixa_etaria" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_faixa_etaria") { echo " selected"; } ?>>Gráfico de Vacinados por Faixa Etária</option>
                                        <option value="vacinados_por_mapa" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_mapa") { echo " selected"; } ?>>Vacinados por Mapa</option>
                                        <option value="vacinados_por_mapa_de_calor" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_mapa_de_calor") { echo " selected"; } ?>>Vacinados por Mapa de Calor</option>
                                        <option value="vacinador_por_mapa" <? if(trim($row['modulo_do_bloco'])=="vacinador_por_mapa") { echo " selected"; } ?>>Vacinados por Local de Vacinação</option>
                                        <? } ?>

                                        <? if(trim($_construtor_sysperm['visualizar_agenda_de_treinos'])==1) { ?>
                                        <option value="agenda_de_treinos" <? if(trim($row['modulo_do_bloco'])=="agenda_de_treinos") { echo " selected"; } ?>>Tabela com Solicitações de Agenda de Treino</option>
                                        <? } ?>
                                        
                                        <? if(trim($_construtor_sysperm['visualizar_treinos'])==1) { ?>
                                        <option value="treinos_expirando" <? if(trim($row['modulo_do_bloco'])=="treinos_expirando") { echo " selected"; } ?>>Tabela com Treinos Expirando</option>
                                        <? } ?>
                                        
                                        <option value="agenda_unificada" <? if(trim($row['modulo_do_bloco'])=="agenda_unificada") { echo " selected"; } ?>>Agenda Unificada de Compromissos</option>
                                        
                                        <? if(trim($_construtor_sysperm['visualizar_carrinhos_de_compras'])==1) { ?>
                                        <option value="acompanhamento_de_carrinho_de_compras" <? if(trim($row['modulo_do_bloco'])=="acompanhamento_de_carrinho_de_compras") { echo " selected"; } ?>>Acompanhamento de Carrinho de Compras</option>
                                        <? } ?>
                                        
                                        <? if(trim($_construtor_sysperm['visualizar_vendas'])==1) { ?>
                                        <option value="acompanhamento_de_vendas_comercial" <? if(trim($row['modulo_do_bloco'])=="acompanhamento_de_vendas_comercial") { echo " selected"; } ?>>Acompanhamento de Vendas do Comercial</option>
                                        <? } ?>
                                        
                                        <? if(trim($_construtor_sysperm['visualizar_compras'])==1) { ?>
                                        <option value="acompanhamento_de_compras_comercial" <? if(trim($row['modulo_do_bloco'])=="acompanhamento_de_compras_comercial") { echo " selected"; } ?>>Acompanhamento de Compras do Comercial</option>
                                        <? } ?>
                                        
                                        <? if(trim($_construtor_sysperm['visualizar_contas_a_pagar'])==1) { ?>
                                        <option value="acompanhamento_de_contas_a_pagar" <? if(trim($row['modulo_do_bloco'])=="acompanhamento_de_contas_a_pagar") { echo " selected"; } ?>>Acompanhamento de Contas à Pagar</option>
                                        <? } ?>
                                        
                                        <? if(trim($_construtor_sysperm['visualizar_contas_a_receber'])==1) { ?>
                                        <option value="acompanhamento_de_contas_a_receber" <? if(trim($row['modulo_do_bloco'])=="acompanhamento_de_contas_a_receber") { echo " selected"; } ?>>Acompanhamento de Contas à Receber</option>
                                        <? } ?>
                                        
                                        <? if(trim($_construtor_sysperm['visualizar_editar'])==1) { ?>
                                        <option value="agenda_de_eventos" <? if(trim($row['modulo_do_bloco'])=="agenda_de_eventos") { echo " selected"; } ?>>Agenda de Eventos</option>
                                        <? } ?>
                                        
                                        <? if(trim($_construtor_sysperm['visualizar_wYZyxbB0w96D3Zxc91A70xy20Z74ZY'])==1) { ?>
                                        <option value="acompanhamento_de_vendas_de_evento" <? if(trim($row['modulo_do_bloco'])=="acompanhamento_de_vendas_de_evento") { echo " selected"; } ?>>Acompanhamento de Vendas de Evento</option>
                                        <? } ?>
                                        
                                        <? if(trim($_construtor_sysperm['visualizar_agenda_de_recursos'])==1) { ?>
                                        <option value="agenda_de_recursos" <? if(trim($row['modulo_do_bloco'])=="agenda_de_recursos") { echo " selected"; } ?>>Agenda de Recursos</option>
                                        <? } ?>
                                        
                                        <? if(trim($_construtor_sysperm['visualizar_pessoas'])==1) { ?>
                                        <option value="acompanhamento_de_pessoas" <? if(trim($row['modulo_do_bloco'])=="acompanhamento_de_pessoas") { echo " selected"; } ?>>Acompanhamento de Cadastro de Pessoas</option>
                                        <? } ?>
                                        
                                        <? if(trim($_construtor_sysperm['visualizar_todas'])==1) { ?>
                                        <option value="acompanhamento_de_solicitacoes" <? if(trim($row['modulo_do_bloco'])=="acompanhamento_de_solicitacoes") { echo " selected"; } ?>>Acompanhamento de Solicitações</option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Tamanho do Bloco</label>
                                <div class="col-md-12">
                                    <select name="tamanho_do_bloco" id="tamanho_do_bloco" class="form-control">
                                        <option value="">---</option>
                                        <option value='col-md-1' <? if($row['tamanho_do_bloco']=="col-md-1") { echo "selected"; } ?>>10%</option>
                                        <option value='col-md-2' <? if($row['tamanho_do_bloco']=="col-md-2") { echo "selected"; } ?>>15%</option>
                                        <option value='col-md-3' <? if($row['tamanho_do_bloco']=="col-md-3") { echo "selected"; } ?>>25%</option>
                                        <option value='col-md-4' <? if($row['tamanho_do_bloco']=="col-md-4") { echo "selected"; } ?>>35%</option>
                                        <option value='col-md-5' <? if($row['tamanho_do_bloco']=="col-md-5") { echo "selected"; } ?>>40%</option>
                                        <option value='col-md-6' <? if($row['tamanho_do_bloco']=="col-md-6") { echo "selected"; } ?>>50%</option>
                                        <option value='col-md-7' <? if($row['tamanho_do_bloco']=="col-md-7") { echo "selected"; } ?>>60%</option>
                                        <option value='col-md-8' <? if($row['tamanho_do_bloco']=="col-md-8") { echo "selected"; } ?>>65%</option>
                                        <option value='col-md-9' <? if($row['tamanho_do_bloco']=="col-md-9") { echo "selected"; } ?>>75%</option>
                                        <option value='col-md-10' <? if($row['tamanho_do_bloco']=="col-md-10") { echo "selected"; } ?>>85%</option>
                                        <option value='col-md-11' <? if($row['tamanho_do_bloco']=="col-md-11") { echo "selected"; } ?>>90%</option>
                                        <option value='col-md-12' <? if($row['tamanho_do_bloco']=="col-md-12") { echo "selected"; } ?>>100%</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Quantidade de Items à Exibir</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['qtd']?>" type="number" name="qtd" id="qtd" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Ordenação da Exibição</label>
                                <div class="col-md-12">
                                    <select name="ordenacao" id="ordenacao" class="form-control">
                                        <option value="">---</option>
                                        <option value="randomica" <? if(trim($row['ordenacao'])=="randomica") { echo " selected"; } ?>>Ordenação randômica (mostra elementos randomicamente)</option>
                                        <option value="alfabetica_asc" <? if(trim($row['ordenacao'])=="alfabetica_asc") { echo " selected"; } ?>>Ordenação alfabética de A para Z</option>
                                        <option value="alfabetica_desc" <? if(trim($row['ordenacao'])=="alfabetica_desc") { echo " selected"; } ?>>Ordenação alfabética de Z para A</option>
                                        <option value="data_asc" <? if(trim($row['ordenacao'])=="data_asc") { echo " selected"; } ?>>Data de inserção as mais novas antes</option>
                                        <option value="data_desc" <? if(trim($row['ordenacao'])=="data_desc") { echo " selected"; } ?>>Data de inserção as mais antigas antes</option>
                                        <option value="ordem_asc" <? if(trim($row['ordenacao'])=="ordem_asc") { echo " selected"; } ?>>Pelo campo ordem de menor para o maior ( 1 para 10)</option>
                                        <option value="ordem_desc" <? if(trim($row['ordenacao'])=="ordem_desc") { echo " selected"; } ?>>Pelo campo ordem de maior para o menor ( 10 para 1)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Status</label>
                                <div class="col-md-12">
                                    <select name="stat" id="stat" class="form-control">
                                        <option value="1" <? if(trim($row['stat'])=="1") { echo " selected"; } ?>>ATIVO</option>
                                        <option value="0" <? if(trim($row['stat'])=="0") { echo " selected"; } ?>>INATIVO</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- END informacoes-basicas-->

                </form>

            </div>
        </div>

    </div>

    <div class="botoes_salvar_rodape">
        <? if(trim($_REQUEST['var3'])=="novo") { $nome_btn = "Cadastrar Configuração de Dashboard"; } else { $nome_btn = "Salvar Mudanças"; } ?>
        <div class="row top-side">
            <!-- Inicio menu desktop-->
            <div class="col-xs-6 col-sm-12 botoes_de_salvar top-side-desktop">
                <button type="button" class="btn yellow-gold input-label" style="margin-left: 0px;" onclick="javascript:sysdashboard_salvar('<?=$tipo_form_set?>');" style=""><?=$nome_btn?></button>
                <button type="button" class="btn green input-label" style="margin-left: 0px;" onclick="javascript:sysdashboard_salvar('<?=$tipo_form_set?>-continuar');" style=""><?=$nome_btn?> e Continuar Editando</button>
            </div>
            <!-- Fim menu desktop-->
        </div>
    </div>

<? } ?>