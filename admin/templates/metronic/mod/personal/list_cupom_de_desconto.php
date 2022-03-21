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
                    echo "<input type=\"hidden\" name=\"modulo\" id=\"modulo\" value=\"cupom_de_desconto_add\" />";
                    
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

						if(trim($_SESSION['descontos_'.$_SESSION['numeroUnicoGerado'].''])=="") {
							$_SESSION['descontos_'.$_SESSION['numeroUnicoGerado'].''] = $row['descontos'];
						} else {
							$_SESSION['descontos_'.$_SESSION['numeroUnicoGerado'].''] = $_SESSION['descontos_'.$_SESSION['numeroUnicoGerado'].''];
						}
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
                                <span style="width:100%;float:left;"><i class="fal fa-user-circle" style="padding-right:10px;"></i>Informações básicas</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Configurações básicas de cupom</span>
                            </h4>
    
							<?
                            if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
                                $sysusu_empresaSet = "".$sysusu['empresa']."";
								$filtro_plataformaSet = "";
                            } else {
								$filtro_plataformaSet = " AND mod_empresa.id='".$sysusu['empresa']."' ";
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
                            <? } else { $empresa_set="".$sysusu['empresa'].""; ?>
                            <? $rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT plataforma FROM empresa WHERE id='".$sysusu['empresa']."'")); ?>
                            <input type="hidden" name="plataforma" id="plataforma" value="<?=$rSqlPlataforma['plataforma']?>" />
                            <input type="hidden" name="empresa" id="empresa" value="<?=$sysusu['empresa']?>" />

                            <? } ?>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Nome</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['nome']?>" type="text" name="nome" id="nome" placeholder="Nome" class="form-control" />
                                </div>
                            </div>

							<? if(trim($row['codigo'])=="") { ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Código do Cupom</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['codigo']?>" style="text-transform:uppercase;" type="text" name="codigo" id="codigo" onkeypress="return sem_acento(event);" class="form-control" />
                                    <p class="help-block">Não utilize caracteres especiais como acentos, espaços e pontuações.</p>
                                </div>
                            </div>
                            <? } else { ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Código do Cupom</label>
                                <div class="col-md-12">
                                    <input type="hidden" name="codigo" id="codigo" value="<?=$row['codigo']?>">
                                    <input value="<?=$row['codigo']?>" style="text-transform:uppercase;" disabled="disabled" type="text" class="form-control" />
                                    <p class="help-block">O código não pode ser alterado após a sua criação</p>
                                </div>
                            </div>
                            <? } ?>


							<?
                            if(trim($row['tipo_desconto'])=="") {
                                $displayDescontoPorcentagemSet = "block";
                                $displayDescontoValorSet = "none";
                                $DescontoPorcentagem = "";
                                $DescontoValor = "";
                            } else {
                                if(trim($row['tipo_desconto'])=="porcentagem") {
                                    $displayDescontoPorcentagemSet = "block";
                                    $displayDescontoValorSet = "none";
                                    $DescontoPorcentagem = $row['desconto'];
                                    $DescontoValor = "";
                                } else if(trim($row['tipo_desconto'])=="valor") {
                                    $displayDescontoPorcentagemSet = "none";
                                    $displayDescontoValorSet = "block";
                                    $DescontoPorcentagem = "";
                                    $DescontoValor = $row['desconto'];
                                }
                            }
                            ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Configuração de Desconto</label>
                                <div class="col-md-3" style="padding-right:0px;">
                                    <select name="tipo_desconto" id="tipo_desconto" onchange="javascript:tipo_desconto_set('');" class="form-control">
                                        <option value="porcentagem" <? if(trim($row['tipo_desconto'])=="porcentagem") { echo " selected"; } ?>>Porcentagem %</option>
                                        <option value="valor" <? if(trim($row['tipo_desconto'])=="valor") { echo " selected"; } ?>>Valor</option>
                                    </select>
                                </div>
                                <div class="col-md-9" id="div_desconto_porcentagem" style="display:<?=$displayDescontoPorcentagemSet?>;padding-left:0px;">
                                    <input value="<?=$DescontoPorcentagem?>" type="text" name="desconto_porcentagem" id="desconto_porcentagem" placeholder="Digite apenas números" maxlength="3" onkeypress="javascript:mascara(this,soNumeros);" class="form-control" style="border-left:0px;" />
                                </div>
                                <div class="col-md-9" id="div_desconto_valor" style="display:<?=$displayDescontoValorSet?>;padding-left:0px;">
                                    <input value="<?=$DescontoValor?>" type="text" name="desconto_valor" id="desconto_valor" placeholder="Digite apenas números" onkeypress="javascript:mascara(this,moeda);" class="form-control" style="border-left:0px;" />
                                </div>
                                <div class="col-md-12">
                                    <p class="help-block">Você pode escolher entra a opção de dar desconto de uma porcentagem do valor total ou desconto de um valor fixo do total.</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Informações / Descrição / Detalhes</label>
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" id="informacoes" name="informacoes"><?=$row['informacoes']?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-clipboard-list-check" style="padding-right:10px;"></i>Descontos</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Lista de itens que deverão receber o desconto</span>
                            </h4>
    
                            <div class="col-md-12" style="padding-left:0px;">
                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Módulo do item</label>
                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;margin-top:5px;">
                                    <select id="modulo_busca" class="form-control bs-select campo_avaliacao" data-live-search="true" data-show-subtext="true" onchange="javascript:seleciona_modulo_busca();">
                                        <option value="">---</option>
                                        <? if(trim($_construtor_sysperm['inserir_sysgrupousuario'])==1) { ?>
                                        <option value="sysgrupousuario">Planos de Assinatura Plataforma</option>
                                        <? } ?>

                                        <? if(trim($_construtor_sysperm['inserir_9AaBy3cY80aZwY04w0Ywzbwcx5xyw1'])==1) { ?>
                                        <option value="assinaturas">Assinaturas</option>
                                        <? } ?>

                                        <? if(trim($_construtor_sysperm['inserir_AcByd6wA75Bc97ZccZ1D451d5wdW7D'])==1) { ?>
                                        <option value="produtos">Produtos</option>
                                        <? } ?>

                                        <? if(trim($_construtor_sysperm['inserir_ZZwwcDa432YxAbZcw2Y3AxY61yy8Y5'])==1) { ?>
                                        <option value="planos_e_pacotes">Planos e Pacotes</option>
                                        <? } ?>

                                        <? if(trim($_construtor_sysperm['inserir_4CD6Zc62zA20xxzW0cWx5DCYDyb88W'])==1 || trim($_construtor_sysperm['inserir_wYZyxbB0w96D3Zxc91A70xy20Z74ZY'])==1) { ?>
                                        <option value="eventos">Eventos</option>
                                        <? } ?>

                                        <? if(trim($_construtor_sysperm['inserir_4CD6Zc62zA20xxzW0cWx5DCYDyb88W'])==1 || trim($_construtor_sysperm['inserir_wYZyxbB0w96D3Zxc91A70xy20Z74ZY'])==1) { ?>
                                        <option value="tickets">Tickets</option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12" style="padding-left:0px;display:none;" id="DIV_item">
                                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;" id="item_label"></label>
                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;margin-top:5px;">
                                    <select id="item_add" class="form-control bs-select campo_avaliacao" data-live-search="true" data-show-subtext="true">
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12" style="margin-top:30px;margin-bottom:0px;padding-left:0px;">
                                <a class="btn input-label" onclick="javascript:cupom_de_desconto_descontos_add();" style="background-color:#19d18e;color:#FFF;text-align:center;">&nbsp;Adicionar Item</a>
                            </div>

                            <div id="cupom_de_desconto_descontos-lista" style="width:100%;display:block;">
                                <? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/cupom_de_desconto_descontos-lista.php"); ?>
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
        <? if(trim($_REQUEST['var3'])=="novo") { $nome_btn = "Cadastrar Cupom de Desconto"; } else { $nome_btn = "Salvar Mudanças"; } ?>
        <div class="row top-side">
            <!-- Inicio menu desktop-->
            <div class="col-xs-6 col-sm-12 botoes_de_salvar top-side-desktop">
                <button type="button" class="btn yellow-gold input-label" style="margin-left: 0px;" onclick="javascript:cupom_de_desconto_salvar('<?=$tipo_form_set?>');" style=""><?=$nome_btn?></button>
                <button type="button" class="btn green input-label" style="margin-left: 0px;" onclick="javascript:cupom_de_desconto_salvar('<?=$tipo_form_set?>-continuar');" style=""><?=$nome_btn?> e Continuar Editando</button>
            </div>
            <!-- Fim menu desktop-->
        </div>
    </div>

<? } ?>