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
            <div class="portlet light bg-inverse form-fit">
                <div class="portlet-body form">
                    <div class="form-body">
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
                            echo "<input type=\"hidden\" name=\"modulo\" id=\"modulo\" value=\"vendas_add\" />";
                            
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
                            
                            #$_SESSION['detalhamento_'.$_SESSION['numeroUnicoGerado'].''] = "";
                            
                            echo "".$iditem_input."";
                            echo "<input type=\"hidden\" name=\"numeroUnico\" id=\"numeroUnico\" value=\"".$_SESSION['numeroUnicoGerado']."\" />";
                            echo "<input type=\"hidden\" name=\"idsysusu\" value=\"".$id_redator_set."\" />";
                            echo "".$id_item_row_input."";

                            ?>

                            <!-- tab-content -->
                            <div class="tab-content">

                                <!-- END dados-principais-->
                                <div id="dados-principais" class="tab-pane active" style="min-height:350px;">
									<? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {  $empresa_set=""; ?> 
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Empresa</label>
                                        <div class="col-md-10">
                                            <select name="empresa" id="empresa" class="form-control bs-select" data-live-search="true" data-show-subtext="true">
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

                                    <!--begin::CAMPO SELECT DE PESSOAS-->
                                    <? $labelCampo = "Pessoa"; ?>
                                    <? $nomeCampo = "pessoa"; ?>
                                    <? $modeloCampo = "modelo_col_md_2"; ?>
                                    <? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/pessoas_campo_select.php"); ?>
                                    <!--end::CAMPO SELECT DE PESSOAS-->
            
                                    <div class="form-group">
                                        <label class="control-label col-md-2"></label>
                                        <div class="col-md-10">
                                            <a class="btn input-label" style="background-color:#169ef4;color:#FFF;text-align:center;" 
                                             data-toggle="modal" data-target="#modal-novo_cadastro"
                                             ><i class="fa fa-plus"></i>&nbsp;Novo Cadastro ?</a>
                                        </div>
                                    </div>
            
                                    <!--begin::Modal NOVO CADASTRO-->
                                    <? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/mod/personal/popup_novo_cadastro.php"); ?>
                                    <!--end::Modal NOVO CADASTRO-->

                                    <?
									if(trim($row['tipo'])=="planos_e_pacotes") {
										$displayPlanos_e_pacotesSet = "block";
										$displayProdutosSet = "none";
										$displayCircuitosSet = "none";
									} else if(trim($row['tipo'])=="produtos") {
										$displayPlanos_e_pacotesSet = "none";
										$displayProdutosSet = "block";
										$displayCircuitosSet = "none";
									} else if(trim($row['tipo'])=="circuitos") {
										$displayPlanos_e_pacotesSet = "none";
										$displayProdutosSet = "none";
										$displayCircuitosSet = "block";
									} else {
										$displayPlanos_e_pacotesSet = "none";
										$displayProdutosSet = "none";
										$displayCircuitosSet = "none";
									}
									?>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Tipo de Item</label>
                                        <div class="col-md-10">
                                            <select name="tipo" id="tipo" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:tipo_venda_set();">
                                                <option value="">---</option>
                                                <option value="planos_e_pacotes" <? if(trim($row['tipo'])=="planos_e_pacotes") { echo " selected"; } ?>>Planos e Pacotes</option>
                                                <option value="produtos" <? if(trim($row['tipo'])=="produtos") { echo " selected"; } ?>>Produto</option>
                                                <option value="circuitos" <? if(trim($row['tipo'])=="circuitos") { echo " selected"; } ?>>Circuito</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group" id="DIV_planos_e_pacotes" style="display:<?=$displayPlanos_e_pacotesSet?>;">
                                        <label class="control-label col-md-2">Planos e Pacotes</label>
                                        <div class="col-md-10">
                                            <select name="numeroUnico_planos_e_pacotes" id="numeroUnico_planos_e_pacotes" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:planos_e_pacotes_valor('');">
                                                <option value="">---</option>
                                                <?
                                                $qSqlItem = mysql_query("
                                                                        SELECT 
                                                                            mod_planos_e_pacotes.id,
                                                                            mod_planos_e_pacotes.numeroUnico,
                                                                            mod_planos_e_pacotes.nome,
                                                                            mod_planos_e_pacotes.valor
                                                                             
                                                                        FROM 
                                                                            planos_e_pacotes AS mod_planos_e_pacotes 
                                                                        WHERE
                                                                            (mod_planos_e_pacotes.stat='0' OR mod_planos_e_pacotes.stat='1') ".$filtro["mod_planos_e_pacotes"]." 
                                                                        ORDER BY 
                                                                            mod_planos_e_pacotes.nome");
                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                ?>
                                                <option value="<?= $rSqlItem['numeroUnico'] ?>" <? if(trim($row['numeroUnico_item'])==trim($rSqlItem['numeroUnico'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?> - R$ <?=number_format($rSqlItem['valor'], 2, ',', '.')?></option>
                                                <? } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group" id="DIV_produtos" style="display:<?=$displayProdutosSet?>;">
                                        <label class="control-label col-md-2">Produto</label>
                                        <div class="col-md-10">
                                            <select name="numeroUnico_produtos" id="numeroUnico_produtos" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:produtos_valor();">
                                                <option value="">---</option>
                                                <?
                                                $qSqlItem = mysql_query("
                                                                        SELECT 
                                                                            mod_produtos.id,
                                                                            mod_produtos.numeroUnico,
                                                                            mod_produtos.nome,
                                                                            mod_produtos.valor
                                                                             
                                                                        FROM 
                                                                            produtos AS mod_produtos 
                                                                        WHERE
                                                                            (mod_produtos.stat='0' OR mod_produtos.stat='1') ".$filtro["mod_produtos"]." 
                                                                        ORDER BY 
                                                                            mod_produtos.nome");
                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                ?>
                                                <option value="<?= $rSqlItem['numeroUnico'] ?>" <? if(trim($row['numeroUnico_item'])==trim($rSqlItem['numeroUnico'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?> - R$ <?=number_format($rSqlItem['valor'], 2, ',', '.')?></option>
                                                <? } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group" id="DIV_circuitos" style="display:<?=$displayCircuitosSet?>;">
                                        <label class="control-label col-md-2">Circuitos</label>
                                        <div class="col-md-10">
                                            <select name="numeroUnico_circuitos" id="numeroUnico_circuitos" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:circuitos_valor();">
                                                <option value="">---</option>
                                                <?
                                                $qSqlItem = mysql_query("
                                                                        SELECT 
                                                                            mod_circuitos.id,
                                                                            mod_circuitos.numeroUnico,
                                                                            mod_circuitos.nome,
                                                                            mod_circuitos.valor,
                                                                            mod_circuitos.valor_promocional
                                                                             
                                                                        FROM 
                                                                            circuitos AS mod_circuitos 
                                                                        WHERE
                                                                            (mod_circuitos.stat='0' OR mod_circuitos.stat='1') ".$filtro["mod_circuitos"]." 
                                                                        ORDER BY 
                                                                            mod_circuitos.nome");
                                                while($rSqlItem = mysql_fetch_array($qSqlItem)) {
													if($rSqlItem['valor_promocional']>0) {
													   $rSqlItem['valor_venda'] = $rSqlItem['valor_promocional'];
													} else {
													   $rSqlItem['valor_venda'] = $rSqlItem['valor'];
													}
                                                ?>
                                                <option value="<?= $rSqlItem['numeroUnico'] ?>" <? if(trim($row['numeroUnico_circuitos'])==trim($rSqlItem['numeroUnico'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?> - R$ <?=number_format($rSqlItem['valor_venda'], 2, ',', '.')?></option>
                                                <? } ?>
                                            </select>
                                        </div>
                                    </div>

									<?
                                    if(trim($row['valor'])=="") {
                                        $row['valor'] = "";
                                    } else {
                                        $row['valor'] = "R$ ".number_format($row['valor'], 2, ',', '.')."";
                                    }
									?>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Valor Cobrado Nesta Venda</label>
                                        <div class="col-md-10">
                                            <input value="<?=$row['valor']?>" type="text" name="valor" id="valor" onkeypress="javascript:mascara(this,moeda);" placeholder="Valor Cobrado Nesta Venda" class="form-control" />
                                            <p class="help-block">Ao selecionar o produto, o sistema preenche o campo de valor automáticamente, mas caso deseje dar um desconto ou aumentar o preço de cobrança, é só editar o valor deste campo.</p>
                                        </div>
                                    </div>

                                    <div class="form-group" id="DIV_planos_e_pacotes_vigencia" style="display:<?=$displayPlanos_e_pacotesSet?>;">
                                        <label class="control-label col-md-2">Vigência desta Assinatura</label>
                                        <div class="col-md-10">
                                            <div class="col-md-6" style="padding-left:0px;padding-right:0px;">
                                                <select name="vigencia_tipo" id="vigencia_tipo" class="form-control">
                                                    <option value="" <? if(trim($row['vigencia_tipo'])=="") { echo " selected"; } ?>>Selecione um tipo</option>
                                                    <option value="unidades" <? if(trim($row['vigencia_tipo'])=="unidades") { echo " selected"; } ?>>Unidades</option>
                                                    <option value="dias" <? if(trim($row['vigencia_tipo'])=="dias") { echo " selected"; } ?>>Dias</option>
                                                    <option value="semanas" <? if(trim($row['vigencia_tipo'])=="semanas") { echo " selected"; } ?>>Semanas</option>
                                                    <option value="meses" <? if(trim($row['vigencia_tipo'])=="meses") { echo " selected"; } ?>>Meses</option>
                                                    <option value="anos" <? if(trim($row['vigencia_tipo'])=="anos") { echo " selected"; } ?>>Anos</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6" style="padding-left:0px;padding-right:0px;">
                                                <input value="<?=$row['vigencia_qtd']?>" type="text" name="vigencia_qtd" id="vigencia_qtd" onkeypress="javascript:mascara(this,soNumeros);" placeholder="Digite a quantidade da vigência" class="form-control" />
                                            </div>
                                            <div class="col-md-12" style="padding-left:0px;padding-right:0px;"><p class="help-block">Selecione o tipo e a quantidade de vigência que está assinatura deverá possuir.</p></div>
                                        </div>
                                    </div>

									<?
                                    if(trim($row['data_contratacao'])=="") {
                                        $data_contratacaoSet = date("d/m/Y");
                                    } else {
                                        $data_contratacaoSet = ajustaDataSemHoraReturn($row['data_contratacao'],"d/m/Y");
                                    }
									?>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Data da Venda</label>
                                        <div class="col-md-4">
                                            <div class="input-group date date-picker" id="TI_data_contratacao" data-date-format="dd/mm/yyyy"  data-date="<?=$data_contratacaoSet?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span> 
                                                <input type="text" id="data_contratacao" name="data_contratacao" class="form-control input-sm" value="<?=$data_contratacaoSet?>" style="height: 34px;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Observações</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control ckeditor" id="observacao" name="observacao"><?=$row['observacao']?></textarea>
                                            <p class="help-block">Acima você pode colocar alguma observação específica para servir de guia para um outro usuário e/ou até mesmo em uma futura consulta ao contrato da pessoa.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- END dados-principais-->

                            </div>
                            <!-- Fim tab-content -->

                            <div class="botoes_salvar_rodape">
                                <? if(trim($_REQUEST['var3'])=="novo") { $nome_btn = "Cadastrar Venda"; } else { $nome_btn = "Salvar Mudanças"; } ?>
                                <div class="row top-side">
                                    <!-- Inicio menu desktop-->
                                    <div class="col-xs-6 col-sm-12 botoes_de_salvar top-side-desktop">
                                        <button type="button" class="btn yellow-gold input-label" style="margin-left: 0px;" onclick="javascript:vendas_salvar('<?=$tipo_form_set?>');" style=""><?=$nome_btn?></button>
                                        <button type="button" class="btn green input-label" style="margin-left: 0px;" onclick="javascript:vendas_salvar('<?=$tipo_form_set?>-continuar');" style=""><?=$nome_btn?> e Continuar Editando</button>
                                    </div>
                                    <!-- Fim menu desktop-->
                                </div>
                            </div>
                    
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<? } ?>