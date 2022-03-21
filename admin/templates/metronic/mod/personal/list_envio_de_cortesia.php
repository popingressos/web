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
                echo "<input type=\"hidden\" name=\"modulo\" id=\"modulo\" value=\"envio_de_cortesia_add\" />";
                
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

                    if(trim($_SESSION['pessoas_lista_'.$_SESSION['numeroUnicoGerado'].''])=="") {
                        $_SESSION['pessoas_lista_'.$_SESSION['numeroUnicoGerado'].''] = $row['pessoas_lista'];
                    } else {
                        $_SESSION['pessoas_lista_'.$_SESSION['numeroUnicoGerado'].''] = $_SESSION['pessoas_lista_'.$_SESSION['numeroUnicoGerado'].''];
                    }
                }
                
                #$_SESSION['detalhamento_'.$_SESSION['numeroUnicoGerado'].''] = "";
                
                echo "".$iditem_input."";
                echo "<input type=\"hidden\" name=\"numeroUnico\" id=\"numeroUnico\" value=\"".$_SESSION['numeroUnicoGerado']."\" />";
                echo "<input type=\"hidden\" name=\"idsysusu\" value=\"".$id_redator_set."\" />";
                echo "".$id_item_row_input."";

                ?>

        <div class="col-md-12">

            <div class="row" style="padding-left:10px;padding-right:10px;">
            
                <div class="<? if(trim($_REQUEST['var3'])=="novo") { ?>col-md-4<? } else { ?>col-md-6<? } ?>" style="margin-bottom:10px;padding-left:5px;padding-right:5px;">
                    <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                        <h4 class="font-green-sharp">
                            <span style="width:100%;float:left;">Informações Básicas</span>
                            <span style="width:100%;font-size:12px;font-style:italic;">Dados de identificação, evento, ticket e valor de venda</span>
                        </h4>

						<? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {  $empresa_set=""; ?> 
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
                            <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;">Empresa</label>
                            <div class="col-md-12">
                                <select name="empresa" id="empresa" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:filtrar_empresa_eventos_single('');">
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
                            <? $rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT plataforma FROM empresa WHERE id='".$sysusu['empresa']."'")); ?>
                            <input type="hidden" name="plataforma" id="plataforma" value="<?=$rSqlPlataforma['plataforma']?>" />
                            <input type="hidden" name="empresa" id="empresa" value="<?=$sysusu['empresa']?>" />
                        <? } ?>

                        <div class="form-group">
                            <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;">Referência</label>
                            <div class="col-md-12">
                                <input value="<?=$row['nome']?>" type="text" name="nome" id="nome" placeholder="" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;">Tipo de Envio</label>
                            <div class="col-md-12">
                                <select name="tipo_de_envio" id="tipo_de_envio" class="form-control">
                                    <option value="nao_enviar">Não enviar notificação</option>
                                    <option value="ambas" <? if(trim($row['tipo_de_envio'])=="ambas") { echo " selected"; } ?>>Ambas, E-mail e WhatsApp</option>
                                    <option value="email" <? if(trim($row['tipo_de_envio'])=="email") { echo " selected"; } ?>>Apenas por E-mail</option>
                                    <option value="whatsapp" <? if(trim($row['tipo_de_envio'])=="whatsapp") { echo " selected"; } ?>>Apenas por WhatsApp</option>
                                </select>
                            </div>
                        </div>

                        <input value="cortesia" type="hidden" name="modelo_envio" id="modelo_envio"/>
                        
                        <div class="form-group">
                            <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;">Evento</label>
                            <div class="col-md-12">
                                <select name="numeroUnico_evento" id="numeroUnico_evento" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:filtrar_eventos_tickets();">
									<? if(trim($row["numeroUnico_evento"])=="" && (trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0")) { ?>
                                    <option value="">Selecione uma empresa</option>
                                    <? } else { ?>
                                        <option value="">Selecione um evento</option>
										<?
                                        $qSqlItem = mysql_query("
                                                                SELECT 
                                                                    mod_eventos.numeroUnico,
                                                                    mod_eventos.nome,
                                                                    mod_eventos.tickets,
                                                                    mod_eventos.lotes
                                                                     
                                                                FROM 
                                                                    eventos AS mod_eventos 
                                                                WHERE
                                                                    mod_eventos.stat='1' AND
                                                                    mod_eventos.empresa='".$sysusu["empresa"]."' 
                                                                ORDER BY 
                                                                    mod_eventos.nome");
                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                            if(trim($rSqlItem['numeroUnico'])==trim($row["numeroUnico_evento"])) {
                                                $numeroUnico_eventoSet = $rSqlItem['numeroUnico'];
                                                $ticketsSet = $rSqlItem['tickets'];
                                                $lotesSet = $rSqlItem['lotes'];
                                            }
                                        ?>
                                        <option value="<?= $rSqlItem['numeroUnico'] ?>" <? if(trim($rSqlItem['numeroUnico'])==trim($row["numeroUnico_evento"])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                                        <? } ?>
                                    <? } ?>
                                </select>
                            </div>
                        </div>
						
                        <? $generoSet = ""; ?>
                        <div class="form-group">
                            <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;">Ticket</label>
                            <div class="col-md-12">
                                <select name="numeroUnico_ticket" id="numeroUnico_ticket" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:filtrar_ticket_genero();">
                                    <?
									if(trim($row["numeroUnico_evento"])=="") { } else {
										$rSqlEvento = mysql_fetch_array(mysql_query("SELECT tickets FROM eventos WHERE numeroUnico='".$row["numeroUnico_evento"]."'"));
										$ticketArray = unserialize($rSqlEvento['tickets']);
										$ticketArray = array_sort($ticketArray, 'ticket_data', SORT_ASC);
										foreach ($ticketArray as $key => $value) {
											if(trim($value['numeroUnico'])==trim($row["numeroUnico_ticket"])) {
												$generoSet = $value['ticket_genero'];
											}
										?>
										<option value="<?= $value['numeroUnico'] ?>" <? if(trim($value['numeroUnico'])==trim($row["numeroUnico_ticket"])) { echo " selected"; } ?>><?=$value['ticket_nome']?></option>
										<? } ?>
									<? } ?>
                                </select>
                            </div>
                        </div>

                        <?
						if(trim($generoSet)=="") {
							$display_DIV_qtd = "none";
							$display_DIV_qtd_u = "none";
							$display_DIV_qtd_f = "none";
							$display_DIV_qtd_m = "none";
							$display_DIV_valor = "none";
							$genero_ticketSet = "";
						} else if(trim($generoSet)=="U") {
							$display_DIV_qtd = "block";
							$display_DIV_qtd_u = "block";
							$display_DIV_qtd_f = "none";
							$display_DIV_qtd_m = "none";
							$display_DIV_valor = "block";
							$genero_ticketSet = "U";
						} else if(trim($generoSet)=="F") {
							$display_DIV_qtd = "block";
							$display_DIV_qtd_u = "none";
							$display_DIV_qtd_f = "block";
							$display_DIV_qtd_m = "none";
							$display_DIV_valor = "block";
							$genero_ticketSet = "F";
						} else if(trim($generoSet)=="M") {
							$display_DIV_qtd = "block";
							$display_DIV_qtd_u = "none";
							$display_DIV_qtd_f = "none";
							$display_DIV_qtd_m = "block";
							$display_DIV_valor = "block";
							$genero_ticketSet = "M";
						}
						?>
                        <input value="<?=$genero_ticketSet?>" type="hidden" name="genero_ticket" id="genero_ticket"/>

                        <div class="form-group" id="DIV_lotes" style="display:none;margin-left:0px;margin-right:0px;"></div>

                    </div>
                </div>
                
                <? if(trim($_REQUEST['var3'])=="novo") { ?>
                <div class="col-md-4" style="margin-bottom:10px;padding-left:5px;padding-right:5px;">
                    <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                        <h4 class="font-green-sharp">
                            <span style="width:100%;float:left;">Pesquise por um usuário</span>
                            <span style="width:100%;font-size:12px;font-style:italic;">Ao selecionar na lista abaixo ele será adicionado na lista</span>
                        </h4>

                        <div class="form-group">
                            <label class="control-label col-md-12" style="text-align:left;">Modelo de Pesquisa de Usuário</label>
                            <div class="col-md-12">
                                <select id="modelo_pesquisa_usuarios" onchange="javascript:filtro_modelo_pesquisa_usuarios();" class="form-control bs-select ">
                                    <option value="">---</option>
                                    <option value="excel">Importar lista</option>
                                    <option value="sem_cadastro">Sem cadastro</option>
                                    <option value="grupo">Grupo</option>
                                    <option value="individual">Individual</option>
                                </select>
                                <p class="help-block">Selecione o formato que você deseja pesquisar por usuários para inserir neste pacote</p>
                            </div>
                        </div>

						<style>
                        .div_grupo_de_usuarios {
                            width: 65% !important;
							float:left;
                        }
                        .div_btn_add {
                            width: 35% !important;
							float:left;
                        }
                        @media (max-width: 1400px) {
                            .div_grupo_de_usuarios {
                                width: 100% !important;
								float:left;
                            }
                            .div_btn_add {
                                width: 100% !important;
								float:left;
                            }
                        }

						.filesize {
							display: inline-block;
							vertical-align: top;
							color: #30693d;
							width: auto !important;
							margin-left: 0px;
							margin-right: 5px;
						}

						.statusbar {
							margin-left: 0px;
							min-height: 25px;
							width: 100%;
							padding: 10px 10px 10px 10px;
							vertical-align: top;
							margin-bottom: 5px;
						}

						.progressBar {
							width: 100% !important;
							height: 26px;
							border: 0px solid #ddd;
							border-radius: 3px !important;
							overflow: hidden;
							display: inline-block;
							margin: 0 0px 0px 0px;
							vertical-align: top;
						}
                        </style>
                        
                        <div class="form-group" id="DIV_excel" style="display:none;">
                            <div class="col-md-12" style="margin-bottom:10px;">
                                <div class="note note-info" style="margin-bottom:0px;">
                                    <p>
                                    <b>Você pode importar uma lista de clientes</b>
                                    <br />- Baixe o modelo <a href="<?=$link?>include/lista_transmissao.csv" target="_blank">neste link</a>;
                                    <br />- Para realizar a importação, você deve seguir exatamente o modelo fornecido acima;
                                    <br />- O arquivo CSV deve ser no formato <i>separados por virgula</i>;
                                    <br />- A ordem dos dados deve ser exatamente a seguinte: nome, cpf, telefone, whatsapp, email e gênero;
                                    <br />- Nenhuma das colunas acima citadas deve estar em branco;
                                    <br />- Os campos de telefone devem seguir o padrão DDD + TELEFONE. Ex.: 48984341312
                                    <br />- O gênero deve ser informado no modelo M ou F, sendo M para masculino e F para feminino;
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                            <input type="file" accept=".csv"  id="uploadArquivosDocumento" multiple>
                            </div>
                        
                            <div class="col-md-12 arquivo_upload"></div>
                        </div>                           

                        <div class="form-group" id="DIV_sem_cadastro" style="display:none;">
                            <div class="col-md-12">
                                <h4 class="font-green-sharp">
                                    <span style="width:100%;float:left;">Usuário sem cadastro</span>
                                    <span style="width:100%;font-size:12px;font-style:italic;">Preencha os campos abaixo para inserir um usuário que não possui cadastro à lista de transmissão</span>
                                </h4>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Nome Completo</label>
                                <input value="" type="text" id="sem_cadastro_nome" placeholder="" class="form-control"/>
                            </div>
                            <? monta_mascara("sem_cadastro_documento","999.999.999-99"); ?>
                            <div class="col-md-12">
                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Documento</label>
                                <input value="" type="text" id="sem_cadastro_documento" placeholder="N&deg; Documento" class="form-control" onblur="javascript:validarCpf('sem_cadastro_documento');" />
                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                    <div id="DIV_sem_cadastro_documento_valido" style="display:none;color:#777;font-size:11px;"><i style="color:#25D366;" class="far fa-check-circle"></i>&nbsp;&nbsp;CPF informado é válido</div>
                                    <div id="DIV_sem_cadastro_documento_invalido" style="display:none;color:#777;font-size:11px;"><i style="color:#e70101;" class="far fa-engine-warning"></i>&nbsp;&nbsp;CPF informado é inválido</div>
                                    <input type="hidden" id="sem_cadastro_documento_valido" name="sem_cadastro_documento_valido" value="0">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">E-mail</label>
                                <input value="" type="text" id="sem_cadastro_email" onblur="javascript:validarEmail('sem_cadastro_email');" placeholder="" class="form-control"/>
                                <div id="DIV_sem_cadastro_email_valido" style="display:none;color:#777;font-size:11px;"><i style="color:#25D366;" class="far fa-check-circle"></i>&nbsp;&nbsp;E-mail informado é válido</div>
                                <div id="DIV_sem_cadastro_email_invalido" style="display:none;color:#777;font-size:11px;"><i style="color:#e70101;" class="far fa-engine-warning"></i>&nbsp;&nbsp;E-mail informado é inválido</div>
                                <input type="hidden" id="sem_cadastro_email_valido" name="sem_cadastro_email_valido" value="0">
                            </div>
                            <? monta_mascara("sem_cadastro_telefone","(99) 99999-9999"); ?>
                            <div class="col-md-12">
                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Telefone</label>
                                <input value="" type="text" id="sem_cadastro_telefone" placeholder="" class="form-control"/>
                            </div>
                            <? monta_mascara("sem_cadastro_whatsapp","(99) 99999-9999"); ?>
                            <div class="col-md-12">
                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">WhatsApp</label>
                                <input value="" type="text" id="sem_cadastro_whatsapp" onkeypress="javascript:validarWhats('sem_cadastro_whatsapp');" onblur="javascript:validarWhats('sem_cadastro_whatsapp');" placeholder="" class="form-control"/>
                                <div id="DIV_sem_cadastro_whatsapp_valido" style="display:none;color:#777;font-size:11px;margin-top: 5px;"><i style="color:#25D366;" class="fas fa-badge-check"></i>&nbsp;&nbsp;WhatsApp válido</div>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Gênero</label>
                                <select id="sem_cadastro_genero" class="form-control bs-select" data-live-search="true" data-show-subtext="true">
                                    <option value="">Selecione um gênero</option>
                                    <option value="F">Feminino</option>
                                    <option value="M">Masculino</option>
                                </select>
                            </div>
                            <div class="col-md-12" style="width:100%;text-align:right;margin-top:10px;">
                                <button class="btn green" onclick="javascript:pessoas_lista_add_sem_cadastro();" type="button">Adicionar Usuário</button>
                            </div>
                        </div>

                        <div class="form-group" id="DIV_grupo_de_usuarios" style="display:none;">
                            <label class="control-label col-md-12" style="text-align:left;">Grupos de Usuários</label>
                            <div class="col-md-12">
                                <div class="div_grupo_de_usuarios" style="padding:0px;">
                                    <select name="grupo_de_usuarios" id="grupo_de_usuarios" class="form-control bs-select" data-live-search="true" data-show-subtext="true">
                                        <option value="">Selecione uma empresa</option>
                                    </select>
                                </div>
                                <div class="div_btn_add" style="padding:0px;">
                                    <button class="btn green" onclick="javascript:pessoas_lista_add_grupo();" style="width:100%;text-align:center;float:right;" type="button">Adicionar Usuários</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="DIV_usuarios" style="display:none;">
                            <div class="col-md-4">
                                <select name="categorias_de_pessoas" id="categorias_de_pessoas" class="form-control bs-select" onchange="javascript:pessoas_lista_filtra_pessoas();" data-live-search="true" data-show-subtext="true">
                                    <option value="">Todos as categorias</option>
                                    <?
                                    $qSqlItem = mysql_query("
                                                            SELECT 
                                                                mod_categorias_de_pessoas.numeroUnico,
                                                                mod_categorias_de_pessoas.nome
                                                                 
                                                            FROM 
                                                                categorias_de_pessoas AS mod_categorias_de_pessoas 
                                                            WHERE
                                                                (mod_categorias_de_pessoas.stat='0' OR mod_categorias_de_pessoas.stat='1') ".$filtro["mod_categorias_de_pessoas"]." 
                                                            ORDER BY 
                                                                mod_categorias_de_pessoas.nome");
                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                    ?>
                                    <option value="<?= $rSqlItem['numeroUnico'] ?>"><?=$rSqlItem['nome']?></option>
                                    <? } ?>
                                </select>
                            </div>
                            <div class="col-md-8" style="padding-left:0px;">
                                <input value="" type="text" id="nome_pessoa" onKeyPress="return submitarPessoas(event)" placeholder="" class="form-control" />
                            </div>
                            <div class="col-md-12">
                                <p class="help-block">Digite o nome de pessoa que você deseja adicionar e para realizar a pesquisa use a tecla 'Enter'</p>
                            </div>
                        </div>
                        
                        <div class="col-md-12" id="pessoas_lista-pesquisa" style="padding:0px;margin-top:5px;"></div>

                    </div>
                </div>
                <? } ?>

                <div class="<? if(trim($_REQUEST['var3'])=="novo") { ?>col-md-4<? } else { ?>col-md-6<? } ?>" style="margin-bottom:10px;padding-left:5px;padding-right:5px;">
                    <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;margin-bottom:10px;">
                        <h4 class="font-green-sharp">
                            <span style="width:100%;float:left;">Lista de Pessoas</span>
                            <span style="width:100%;font-size:12px;font-style:italic;">Abaixo a lista de pessoas selecionados</span>
                        </h4>

                        <div class="col-md-12" id="pessoas_lista-lista" style="padding:0px;margin-top:5px;">
                            <? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/pessoas_lista-lista.php"); ?>
                        </div>
                    </div>

                </div>
                
            </div>
        </div>
        </form>


    </div>

    <div class="botoes_salvar_rodape">
        <? 
		if(trim($_REQUEST['var3'])=="novo") { 
			$nome_btn = "Cadastrar Envio de Cortesia"; 
		?>
        <div class="row top-side">
            <!-- Inicio menu desktop-->
            <div class="col-xs-6 col-sm-12 botoes_de_salvar top-side-desktop">
                <button type="button" class="btn yellow-gold input-label" style="margin-left: 0px;" onclick="javascript:envio_de_cortesia_salvar('<?=$tipo_form_set?>');" style=""><?=$nome_btn?></button>
            </div>
            <!-- Fim menu desktop-->
        </div>
        <? } ?>
    </div>

<? } ?>