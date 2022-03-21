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

	<?
    if(trim($row['tipo_documento'])=="") {
        $displayDocCPFSet = "block";
        $displayDocCNPJSet = "none";
        $displayGeneroSet = "block";
        $displayDataDeNascimentoSet = "block";
		$displayRazaoSocialSet = "none";
		$displayCodIbgeSet = "none";
        $numeroDocCPF = "";
        $numeroDocCNPJ = "";
        $displayMenuResponsavelSet = "none";
    } else {
        if(trim($row['tipo_documento'])=="cpf") {
            $displayDocCPFSet = "block";
            $displayDocCNPJSet = "none";
            $displayGeneroSet = "block";
			$displayDataDeNascimentoSet = "block";
			$displayRazaoSocialSet = "none";
			$displayCodIbgeSet = "none";
            $numeroDocCPF = $row['documento'];
            $numeroDocCNPJ = "";
			$displayMenuResponsavelSet = "none";
        } else if(trim($row['tipo_documento'])=="cnpj") {
            $displayDocCPFSet = "none";
            $displayDocCNPJSet = "block";
            $displayGeneroSet = "none";
			$displayDataDeNascimentoSet = "none";
			$displayRazaoSocialSet = "block";
			$displayCodIbgeSet = "block";
            $numeroDocCPF = "";
            $numeroDocCNPJ = $row['documento'];
			$displayMenuResponsavelSet = "block";
        }
    }
    ?>

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
				box-shadow: 0px 3px 1px -2px rgb(0 0 0 / 20%), 0px 2px 2px 0px rgb(0 0 0 / 14%), 0px 1px 5px 0px rgb(0 0 0 / 12%);
				background-color: #fff;
				border-radius: 2px;
				
				background-color:#ffffff;
				padding:10px;
				border-radius:5px !important;
				color: #1ab394;
				cursor:pointer;
			}
            .box_inativo:hover {
				box-shadow: 0px 5px 5px -3px rgb(0 0 0 / 20%), 0px 8px 10px 1px rgb(0 0 0 / 14%), 0px 3px 14px 2px rgb(0 0 0 / 12%);
				/*background-color:#33d8b7;*/
				padding:10px;
				border-radius:5px !important;
				color: #1ab394;
				cursor:pointer;
			}
            </style>
            <div class="row" style="padding-left:0px;padding-right:0px;">
                <div class="col-md-12" style="margin-bottom:10px;padding-left:10px;padding-right:10px;">
                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12 box_menu box_ativo" div-toggle="informacoes-basicas">
                            <h4>
                                <span style="width:100%;float:left;">Informações Básicas<i class="fal fa-user-circle" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de identificação da empresa e cadastro básico</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding:5px;">
                        <div id="menu_endereco_click" class="col-md-12 box_menu box_inativo" div-toggle="endereco">
                            <h4>
                                <span style="width:100%;float:left;">Endereço<i class="fal fa-map-marked-alt" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de localização e endereço</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="textos-informativos">
                            <h4>
                                <span style="width:100%;float:left;">Textos Informativos<i class="fal fa-file-signature" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Texto do topo e rodapé da impressão</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="configuracoes-de-registro">
                            <h4>
                                <span style="width:100%;float:left;">Configurações de Registro<i class="fal fa-cogs" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Autorização e campos</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="configuracoes-de-funcionamento">
                            <h4>
                                <span style="width:100%;float:left;">Configurações de Funcionamento<i class="fal fa-cogs" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Modelo, autorizações e limites</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="configuracoes-de-impressao">
                            <h4>
                                <span style="width:100%;float:left;">Configurações de Impressão<i class="fal fa-cogs" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Autorizações, limites e personalização</span>
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
                    echo "<input type=\"hidden\" name=\"modulo\" id=\"modulo\" value=\"pdv_add\" />";
                    
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

						if(trim($_SESSION['horarios_de_atendimento_'.$numeroUnicoGerado.''])=="") {
							$_SESSION['horarios_de_atendimento_'.$numeroUnicoGerado.''] = $row['horarios_de_atendimento'];
						} else {
							$_SESSION['horarios_de_atendimento_'.$numeroUnicoGerado.''] = $_SESSION['horarios_de_atendimento_'.$numeroUnicoGerado.''];
						}
                    }
                    
					if(trim($_SESSION['imp_pdv_ordenacao_'.$_SESSION['numeroUnicoGerado'].''])=="") {
						$_SESSION['imp_pdv_ordenacao_'.$_SESSION['numeroUnicoGerado'].''] = $row['imp_pdv_ordenacao'];
						if(trim($_SESSION['imp_pdv_ordenacao_'.$_SESSION['numeroUnicoGerado'].''])=="") {
							if(trim($_SESSION['imp_pdv_ordenacao_editando_'.$_SESSION['numeroUnicoGerado'].''])=="1") { } else {
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "1", "campo" => "imp_imagem_do_evento_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "2", "campo" => "imp_compra_id_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "3", "campo" => "imp_evento_nome_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "4", "campo" => "imp_ingresso_nome_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "5", "campo" => "imp_ingresso_data_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "6", "campo" => "imp_ingresso_cadeira_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "7", "campo" => "imp_compra_adicionais_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "8", "campo" => "imp_compra_valor_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "9", "campo" => "imp_pessoa_nome_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "11", "campo" => "imp_pessoa_documento_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "11", "campo" => "imp_compra_data_pagamento_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "12", "campo" => "imp_pdv_nome_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "13", "campo" => "imp_pdv_id_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "14", "campo" => "imp_sysusu_nome_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "15", "campo" => "imp_sysusu_email_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "16", "campo" => "imp_sysusu_documento_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "17", "campo" => "imp_cod_voucher_qrcode_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "18", "campo" => "imp_cod_voucher_barras_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "19", "campo" => "imp_cod_voucher_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "20", "campo" => "imp_info_impressao_ticket_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "21", "campo" => "imp_imagem_impressao_ticket_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "22", "campo" => "imp_empresa_nome_ordem");
								$numeroUnicoItem = geraCodReturn();
								$dataControle[] = array("numeroUnico" => "".$numeroUnicoItem."", "ordem" => "23", "campo" => "imp_empresa_logo_ordem");
								$dataControleSerial = serialize($dataControle);
								$_SESSION['imp_pdv_ordenacao_'.$_SESSION['numeroUnicoGerado'].''] = $dataControleSerial;
							}
						}
					} else {
						$_SESSION['imp_pdv_ordenacao_'.$_SESSION['numeroUnicoGerado'].''] = $_SESSION['imp_pdv_ordenacao_'.$_SESSION['numeroUnicoGerado'].''];
					}
					

                    #$_SESSION['horarios_de_atendimento_'.$numeroUnicoGerado.''] = "";
                    
                    echo "".$iditem_input."";
                    echo "<input type=\"hidden\" name=\"numeroUnico\" id=\"numeroUnico\" value=\"".$numeroUnicoGerado."\" />";
                    echo "<input type=\"hidden\" name=\"idsysusu\" value=\"".$id_redator_set."\" />";
                    echo "".$id_item_row_input."";

                    ?>
                <div class="col-md-12 div_ativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="informacoes-basicas">
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;margin-bottom:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-user-circle" style="padding-right:10px;"></i>Informações básicas</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de perfil e imagens</span>
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
                                <label class="control-label col-md-12" style="text-align:left;">Nome</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['nome']?>" type="text" name="nome" id="nome" placeholder="Nome" class="form-control" />
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-map-marked-alt" style="padding-right:10px;"></i>Imagens</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Logotipos de topo e rodapé utilizados na impressão</span>
                            </h4>


                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Logotipo do Topo</label>
                                <div class="col-md-12">
                                    <? $campo_imagem_set = "logotipo_topo"; ?>
                                    <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                        <? 
                                        if(trim($row[''.$campo_imagem_set.''])=="") {
											$urlImg = "";
										} else {
                                            $row[''.$campo_imagem_set.''] = "".str_replace(" ","+",$row[''.$campo_imagem_set.''])."";
                                            $urlImg = "data:image/jpeg;base64,".$row[''.$campo_imagem_set.''].""; 
                                        }
                                        ?>
                                        <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            <img id="arquivo-atual-imagem" src="<?=$urlImg?>" alt="">
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

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Logotipo do Rodapé</label>
                                <div class="col-md-12">
                                    <? $campo_imagem_set = "logotipo_rodape"; ?>
                                    <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                        <? 
                                        if(trim($row[''.$campo_imagem_set.''])=="") {
											$urlImg = "";
										} else {
                                            $row[''.$campo_imagem_set.''] = "".str_replace(" ","+",$row[''.$campo_imagem_set.''])."";
                                            $urlImg = "data:image/jpeg;base64,".$row[''.$campo_imagem_set.''].""; 
                                        }
                                        ?>
                                        <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                            <img id="arquivo-atual-imagem" src="<?=$urlImg?>" alt="">
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
                    </div>

                </div>
                <!-- END informacoes-basicas-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="endereco">
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-map-marked-alt" style="padding-right:10px;"></i>Endereço</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de localização e endereço</span>
                            </h4>

							<? monta_mascara("cep","99999-999"); ?>
                            <div class="form-group" style="margin-bottom:5px;">
                                <label class="control-label col-md-12" style="text-align:left;">CEP</label>
                                <div class="col-md-4" style="padding-right:0px;">
                                    <input value="<?=$row['cep']?>" class="form-control" type="text" id="cep" name="cep" />
                                    <p class="help-block">Ex.: 99999-999</p>
                                </div>
                                <div class="col-md-3" style="padding-left:0px;">
                                    <? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                    <button type="button" onclick="javascript:buscaCepIdSimples();" style="margin-top:0px;" class="btn grey-gallery">Carregar endereço</button>
                                    <? } else { ?>
                                    <button type="button" onclick="javascript:buscaCepIdSimples();" style="margin-top:0px;" class="btn grey-gallery">Carregar endereço</button>
                                    <? } ?>
                                </div>
                            </div>

                            <div class="form-group" style="padding-bottom:5px;margin-bottom:0px;">
                                <label class="control-label col-md-12" style="text-align:left;">Tipo de Logradouro</label>
                                <div class="col-md-12">
                                    <select name="numeroUnico_tipos_de_logradouro" id="numeroUnico_tipos_de_logradouro" class="form-control">
                                        <option value="">---</option>
										 <?
                                         $qSqlItem = mysql_query("
                                                                 SELECT 
                                                                     mod_tipos_de_logradouro.numeroUnico,
                                                                     mod_tipos_de_logradouro.nome
                                                                     
                                                                 FROM 
                                                                     tipos_de_logradouro AS mod_tipos_de_logradouro 
                                                                 WHERE
                                                                    mod_tipos_de_logradouro.stat='1' ".$filtro["mod_tipos_de_logradouro"]." 
                                                                 ORDER BY 
                                                                     mod_tipos_de_logradouro.nome");
                                         while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                         ?>
                                         <option value="<?= $rSqlItem['numeroUnico'] ?>" <? if(trim($rSqlItem['numeroUnico'])==trim($row['numeroUnico_tipos_de_logradouro'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                                         <? } ?>
                                    </select>
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
                                <label class="control-label col-md-12" style="text-align:left;">Estado</label>
                                <div class="col-md-12">
									<? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                    <select name="estado" id="estado" class="form-control" onchange="javascript:mostraCidadesId();">
                                        <option value="">Selecione um estado</option>
										<?
                                        $cont = 0;
                                        $qSqlEstado = mysql_query("SELECT uf,estado FROM cepbr_estado ORDER BY uf");
                                        while($rSqlEstado = mysql_fetch_array($qSqlEstado)) {
                                        $titulo_setado = $rSqlEstado['estado'];
                                        ?>
                                        <option value="<?=$rSqlEstado['uf']?>" <? if(trim($row['estado'])==trim($rSqlEstado['uf'])) { echo " selected"; } ?>><?=$titulo_setado?></option>
                                        <? } ?>
                                    </select>
                                    <? } else { ?>
                                    <input type="hidden" value="<?=$rSqlEmpresa['estado']?>" name="estado" id="estado">
                                    <select disabled="disabled" class="form-control">
                                        <option value="">Selecione um estado</option>
										<?
                                        $cont = 0;
                                        $qSqlEstado = mysql_query("SELECT uf,estado FROM cepbr_estado ORDER BY uf");
                                        while($rSqlEstado = mysql_fetch_array($qSqlEstado)) {
                                        $titulo_setado = $rSqlEstado['estado'];
                                        ?>
                                        <option value="<?=$rSqlEstado['uf']?>" <? if(trim($rSqlEmpresa['estado'])==trim($rSqlEstado['uf'])) { echo " selected"; } ?>><?=$titulo_setado?></option>
                                        <? } ?>
                                    </select>
                                    <? } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Cidade</label>
                                <div class="col-md-12">
									<? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                    <select name="cidade_id" id="cidade" class="form-control" onchange="javascript:mostraBairrosId();">
                                        <option value="">Selecione uma cidade</option>
										<?
										if(trim($row['estado'])=="") { } else {
											$qSqlCidade = mysql_query("SELECT id_cidade,cidade FROM cepbr_cidade WHERE uf='".$row['estado']."' ORDER BY cidade");
											while($rSqlCidade = mysql_fetch_array($qSqlCidade)) {
											?>
											<option value="<?=$rSqlCidade['id_cidade']?>" <? if(trim($row['cidade_id'])==trim($rSqlCidade['id_cidade'])) { echo " selected"; } ?>><?=$rSqlCidade['cidade']?></option>
											<? } ?>
										<? } ?>
                                    </select>
                                    <? } else { ?>
                                    <input type="hidden" value="<?=$rSqlEmpresa['cidade_id']?>" name="cidade_id" id="cidade">
                                    <select disabled="disabled" class="form-control">
                                        <option value="">Selecione um cidade</option>
										<?
										if(trim($row['estado'])=="") { } else {
											$qSqlCidade = mysql_query("SELECT id_cidade,cidade FROM cepbr_cidade WHERE uf='".$row['estado']."' ORDER BY cidade");
											while($rSqlCidade = mysql_fetch_array($qSqlCidade)) {
											?>
											<option value="<?=$rSqlCidade['id_cidade']?>" <? if(trim($row['cidade_id'])==trim($rSqlCidade['id_cidade'])) { echo " selected"; } ?>><?=$rSqlCidade['cidade']?></option>
											<? } ?>
										<? } ?>
                                    </select>
                                    <? } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Bairro</label>
                                <div class="col-md-12">
									<? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                                    <select name="bairro_id" id="bairro" class="form-control" onchange="javascript:mostraEventos();">
                                        <option value="">Selecione um bairro</option>
										<?
										if(trim($row['cidade_id'])=="") { } else {
											$qSqlCidade = mysql_query("SELECT id_bairro,bairro FROM cepbr_bairro WHERE id_cidade='".$row['cidade_id']."' ORDER BY bairro");
											while($rSqlCidade = mysql_fetch_array($qSqlCidade)) {
											?>
											<option value="<?=$rSqlCidade['id_bairro']?>" <? if(trim($row['bairro_id'])==trim($rSqlCidade['id_bairro'])) { echo " selected"; } ?>><?=$rSqlCidade['bairro']?></option>
											<? } ?>
										<? } ?>
                                    </select>
                                    <? } else { ?>
                                    <select name="bairro_id" id="bairro" class="form-control" onchange="javascript:mostraEventos();">
                                        <option value="">Selecione um bairro</option>
										<?
										if(trim($row['cidade_id'])=="") { } else {
											$qSqlCidade = mysql_query("SELECT id_bairro,bairro FROM cepbr_bairro WHERE id_cidade='".$row['cidade_id']."' ORDER BY bairro");
											while($rSqlCidade = mysql_fetch_array($qSqlCidade)) {
											?>
											<option value="<?=$rSqlCidade['id_bairro']?>" <? if(trim($row['bairro_id'])==trim($rSqlCidade['id_bairro'])) { echo " selected"; } ?>><?=$rSqlCidade['bairro']?></option>
											<? } ?>
										<? } ?>
                                    </select>
                                    <? } ?>
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

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="textos-informativos">
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-text" style="padding-right:10px;"></i>Texto do Topo</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Este texto será exibido no topo da impressão do ingresso</span>
                            </h4>

							<? $nome_campo = "texto_topo"; ?>
                            <div class="form-group" style="margin-top:10px;">
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" id="<?=$nome_campo?>" name="<?=$nome_campo?>"><?=$row[''.$nome_campo.'']?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-text" style="padding-right:10px;"></i>Texto do Rodapé</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Este texto será exibido no rodapé da impressão do ingresso</span>
                            </h4>

							<? $nome_campo = "texto_rodape"; ?>
                            <div class="form-group" style="margin-top:10px;">
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" id="<?=$nome_campo?>" name="<?=$nome_campo?>"><?=$row[''.$nome_campo.'']?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END textos-informativos-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="configuracoes-de-registro">
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-cogs" style="padding-right:10px;"></i>Configurações de Registro</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Autorização e campos</span>
                            </h4>

                            <? $nome_campo = "venda_com_registro"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Registro do cliente na hora da venda?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "pessoa_nome"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Nome Completo'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Habilitado</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Obrigatório</label>
                                    <select name="<?=$nome_campo?>_obrigatorio" id="<?=$nome_campo?>_obrigatorio" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.'_obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.'_obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "pessoa_documento"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Documento'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Habilitado</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Obrigatório</label>
                                    <select name="<?=$nome_campo?>_obrigatorio" id="<?=$nome_campo?>_obrigatorio" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.'_obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.'_obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "pessoa_email"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'E-mail'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Habilitado</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Obrigatório</label>
                                    <select name="<?=$nome_campo?>_obrigatorio" id="<?=$nome_campo?>_obrigatorio" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.'_obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.'_obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "pessoa_whatsapp"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'WhatsApp'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Habilitado</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Obrigatório</label>
                                    <select name="<?=$nome_campo?>_obrigatorio" id="<?=$nome_campo?>_obrigatorio" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.'_obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.'_obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "pessoa_genero"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Gênero'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Habilitado</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Obrigatório</label>
                                    <select name="<?=$nome_campo?>_obrigatorio" id="<?=$nome_campo?>_obrigatorio" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.'_obrigatorio'])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.'_obrigatorio'])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- END configuracoes-de-registro-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="configuracoes-de-funcionamento">
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-cogs" style="padding-right:10px;"></i>Configurações de Funcionamento</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Modelo, autorizações e limites</span>
                            </h4>

                            <? $nome_campo = "tipo_checkout"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Tipo de Checkout e Pagamento?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="embarcado_cielo" <? if(trim($row[''.$nome_campo.''])=="embarcado_cielo") { echo " selected"; } ?>>Embarcado na Maquineta da Cielo</option>
                                        <option value="embarcado_hubdepagamento" <? if(trim($row[''.$nome_campo.''])=="embarcado_hubdepagamento") { echo " selected"; } ?>>Embarcado na Usando Gateway da Plataforma</option>
                                        <option value="maquineta_externa" <? if(trim($row[''.$nome_campo.''])=="maquineta_externa") { echo " selected"; } ?>>Cobrança em Maquineta Externa</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "fechamento"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Fechamento Maquineta Habilitado?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "sangria"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Sangria Maquineta Habilitada?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "relatorio"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Relatório Maquineta Habilitado?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "busca"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Busca Maquineta Habilitada?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>


                            <? $nome_campo = "cortesia"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Autorizado a gerar cortesia?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "tipo_maquina"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Máquina do Cliente ou da Plataforma?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="plataforma" <? if(trim($row[''.$nome_campo.''])=="plataforma") { echo " selected"; } ?>>Plataforma</option>
                                        <option value="cliente" <? if(trim($row[''.$nome_campo.''])=="cliente") { echo " selected"; } ?>>Cliente</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;">&nbsp;</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">&nbsp;</span>
                            </h4>

                            <? $nome_campo = "limite_carrinho"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Limite de ingressos por CPF</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <? for ($i = 1; $i <= 12; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.''])=="".$i."") { echo " selected"; } ?>>em até <?=$i?>x</option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "parcelamento"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Aceita fazer parcelamento?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "split"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Aceita realiza SPLIT no pagamento?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>


                            <? $nome_campo = "ccr"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Aceita Pagamento em Cartão de Crédito?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "ccd"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Aceita Pagamento em Cartão de Débito?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "din"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Aceita Pagamento em Dinheiro?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "pix"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Aceita Pagamento em PIX?</label>
                                <div class="col-md-12">
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- END configuracoes-de-funcionamento-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="configuracoes-de-impressao">
                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-cogs" style="padding-right:10px;"></i>Configurações de Impressão</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Ordenação</span>
                            </h4>

                            <div id="pdv_impressao_ordem-lista" style="width:100%;display:block;">
                                <? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/pdv_impressao_ordem-lista.php"); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-cogs" style="padding-right:10px;"></i>Configurações de Impressão</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Autorizações, limites e personalização</span>
                            </h4>

                            <? $nome_campo = "imp_imagem_evento"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Imagem do Evento'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_empresa_logo"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Logo da Empresa'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_data_do_evento"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Data do Evento'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_pdv_id"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Id do PDV'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_pdv_nome"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Nome do PDV'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_sysusu_nome"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Nome do Usuário do PDV'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_sysusu_email"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'E-mail do Usuário do PDV'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_sysusu_documento"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Documento do Usuário do PDV'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_compra_id"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Id da Compra'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_evento_nome"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Nome do Evento'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_ingresso_nome"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Nome do Ingresso/Ticket'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_ingresso_data"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Data do Ingresso/Ticket'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-cogs" style="padding-right:10px;"></i>Configurações de Impressão</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Autorizações, limites e personalização</span>
                            </h4>

                            <? $nome_campo = "imp_compra_adicionais"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Adicionais Selecionados'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_compra_valor"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Valor Pago'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_ingresso_cadeira"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Informações de Local Marcado'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_pessoa_nome"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Nome do Beneficiário'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_pessoa_documento"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Documento do Beneficiário'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_info_impressao_ticket"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Informações de Impressão do Ticket'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_imagem_impressao_ticket"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Imagem de Informação de Impressão do Ticket'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_compra_data_pagamento"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Data do Pagamento'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_cod_voucher_qrcode"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Código Voucher QRCode'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_cod_voucher_barras"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Código Voucher Barra'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_cod_voucher"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Código Voucher Texto'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                            <? $nome_campo = "imp_empresa_nome"; ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;"><b>Campo de 'Powered By Empresa'?</b></label>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Label</label>
                                    <input value="<?=$row[''.$nome_campo.'_label']?>" type="text" name="<?=$nome_campo?>_label" id="<?=$nome_campo?>_label" placeholder="" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Imprimir?</label>
                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Alinhamento do Texto</label>
                                    <select name="<?=$nome_campo?>_KEY_ALIGN" id="<?=$nome_campo?>_KEY_ALIGN" class="form-control">
                                        <option value="left" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="left") { echo " selected"; } ?>>Esquerda</option>
                                        <option value="center" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="center") { echo " selected"; } ?>>Centro</option>
                                        <option value="right" <? if(trim($row[''.$nome_campo.'_KEY_ALIGN'])=="right") { echo " selected"; } ?>>Direita</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TYPEFACE" id="<?=$nome_campo?>_KEY_TYPEFACE" class="form-control">
                                        <? for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TYPEFACE'])=="".$i."") { echo " selected"; } ?>>Modelo <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Fonte</label>
                                    <select name="<?=$nome_campo?>_KEY_TEXT_SIZE" id="<?=$nome_campo?>_KEY_TEXT_SIZE" class="form-control">
                                        <? for ($i = 10; $i <= 50; $i++) { ?>
                                        <option value="<?=$i?>" <? if(trim($row[''.$nome_campo.'_KEY_TEXT_SIZE'])=="".$i."") { echo " selected"; } ?>>Tamanho <?=$i?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- END configuracoes-de-impressao-->
                </form>

            </div>

        </div>
    </div>


    <div class="botoes_salvar_rodape">
        <? if(trim($_REQUEST['var3'])=="novo") { $nome_btn = "Cadastrar PDV"; } else { $nome_btn = "Salvar Mudanças"; } ?>
        <div class="row top-side">
            <!-- Inicio menu desktop-->
            <div class="col-xs-6 col-sm-12 botoes_de_salvar top-side-desktop">
                <button type="button" id="BTN_salvar" class="btn yellow-gold input-label" style="margin-left: 0px;" onclick="javascript:pdv_salvar('<?=$tipo_form_set?>');" style=""><?=$nome_btn?></button>
                <button type="button" id="BTN_salvar_continuar" class="btn green input-label" style="margin-left: 0px;" onclick="javascript:pdv_salvar('<?=$tipo_form_set?>-continuar');" style=""><?=$nome_btn?> e Continuar Editando</button>
            </div>
            <!-- Fim menu desktop-->
        </div>
    </div>

<? } ?>