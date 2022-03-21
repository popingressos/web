    <div class="col-md-12" id="DIV_form" style="padding:0px;margin-top:10px;">

        <input type="hidden" id="url_post" value="<?=$link?><?=$chave_url?><?=$_SESSION['var1']?>/<?=$_SESSION['var2']?>/" />
        <form name="forms" method="post" action="<?=$link?><?=$chave_url?><?=$_SESSION['var1']?>/<?=$_SESSION['var2']?>/" target="acoes_hidden" ENCTYPE="multipart/form-data" id="formulario" class="form-horizontal form-bordered form-row-stripped">
            <input type="hidden" id="campos_alterados" value="0" />
            <input type="hidden" name="aba" id="aba" value="" />
            <input type="hidden" name="subMod" value="" />

                <? 
				$tipo_form_set = "add";
                
                echo "<input type=\"hidden\" name=\"acaoLocal\" value=\"interno\" />";
                echo "<input type=\"hidden\" name=\"acaoForm\" id=\"idacaoForm\" value=\"".$tipo_form_set."\" />";
                echo "<input type=\"hidden\" name=\"modulo\" id=\"modulo\" value=\"nova_venda_add\" />";
                
				if(trim($_SESSION['numeroUnicoGerado'])=="") {
					$numeroUnicoGerado = geraCodReturn();
					$_SESSION['numeroUnicoGerado'] = $numeroUnicoGerado;
				} else {
					$numeroUnicoGerado = $_SESSION['numeroUnicoGerado'];
				}
				
				$id_redator_set = $sysusu['id'];
				$nome_redator_set = $sysusu['nome'];
				$iditem_input = "<input type=\"hidden\" name=\"iditem\" id=\"iditem\" value=\"\" />";
                
                echo "".$iditem_input."";
                echo "<input type=\"hidden\" name=\"numeroUnico\" id=\"numeroUnico\" value=\"".$_SESSION['numeroUnicoGerado']."\" />";
                echo "<input type=\"hidden\" name=\"idsysusu\" value=\"".$id_redator_set."\" />";
                echo "".$id_item_row_input."";

                ?>

        <div class="col-md-12">

            <div class="row" style="padding-left:10px;padding-right:10px;">
            
                <?
				if(trim($rSqlPdvBilheteria['venda_com_registro'])=="1") {
					if(trim($rSqlPdvBilheteria['pessoa_nome'])=="1" ||
					   trim($rSqlPdvBilheteria['pessoa_documento'])=="1" ||
					   trim($rSqlPdvBilheteria['pessoa_email'])=="1" ||
					   trim($rSqlPdvBilheteria['pessoa_whatsapp'])=="1" ||
					   trim($rSqlPdvBilheteria['pessoa_genero'])=="1") {
					   	  $mostra_campoSet = "1";
					   } else {
					   	  $mostra_campoSet = "0";
					   }
				} else {
					$mostra_campoSet = "0";
				}

				if(trim($mostra_campoSet)=="1") {
					   $colMd = "3";
			    } else {
					   $colMd = "6";
			    }

				?>

                <div class="col-md-<?=$colMd?>" style="margin-bottom:10px;padding-left:5px;padding-right:5px;">
                    <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                        <h4 class="font-green-sharp">
                            <span style="width:100%;float:left;">Informações do Ingresso</span>
                            <span style="width:100%;font-size:12px;font-style:italic;">Evento, ticket e valor de venda</span>
                        </h4>

                        <input type="hidden" name="numeroUnico_pdv" id="numeroUnico_pdv" value="<?=$rSqlPdvBilheteria['numeroUnico']?>" />

						<? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {  $empresa_set=""; ?> 
                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                            <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;padding-left:0px;">Plataforma</label>
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

                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                            <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;padding-left:0px;">Empresa</label>
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
                        <? } else { $empresa_set="".$sysusu['empresa'].""; ?>
                            <? $rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT plataforma FROM empresa WHERE id='".$sysusu['empresa']."'")); ?>
                            <input type="hidden" name="plataforma" id="plataforma" value="<?=$rSqlPlataforma['plataforma']?>" />
                            <input type="hidden" name="empresa" id="empresa" value="<?=$sysusu['empresa']?>" />
                        <? } ?>

                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                            <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;padding-left:0px;">Enviar confirmação para</label>
                            <select name="tipo_de_envio" id="tipo_de_envio" class="form-control">
                                <option value="nao_enviar">Não enviar confirmação</option>
                                <option value="ambas" <? if(trim($row['tipo_de_envio'])=="ambas") { echo " selected"; } ?>>Ambas, E-mail e WhatsApp</option>
                                <option value="email" <? if(trim($row['tipo_de_envio'])=="email") { echo " selected"; } ?>>Apenas por E-mail</option>
                                <option value="whatsapp" <? if(trim($row['tipo_de_envio'])=="whatsapp") { echo " selected"; } ?>>Apenas por WhatsApp</option>
                            </select>
                        </div>

                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                            <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;padding-left:0px;">Evento</label>
                            <select name="numeroUnico_evento" id="numeroUnico_evento" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:filtrar_eventos_tickets_pdv();">
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
						
                        <? $generoSet = ""; ?>
                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                            <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;padding-left:0px;">Ticket</label>
                            <select name="numeroUnico_ticket" id="numeroUnico_ticket" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:filtrar_ticket_pdv();">
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

						<? if(trim($rSqlPdvBilheteria['cortesia'])=="1") { ?>
                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                            <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;padding-left:0px;">Cortesia?</label>
                            <select id="cortesia" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:pdv_cortesia_set();">
                                <option value="0">NÃO</option>
                                <option value="1">SIM</option>
                            </select>
                        </div>
                        <? } else { ?>
                        <input type="hidden" id="cortesia" value="0" />
                        <? } ?>

                        <div class="col-md-12" id="DIV_valor" style="padding-left:0px;padding-right:0px;">
                            <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;padding-left:0px;">Valor da Venda</label>
                            <input value="" type="text" name="valor" id="valor" onkeypress="javascript:mascara(this,moeda);" class="form-control" placeholder="" />
                        </div>

                        <div class="form-group" id="DIV_lotes" style="display:none;margin-left:0px;margin-right:0px;"></div>

						<? if(trim($mostra_campoSet)=="1") { } else { ?>
                        <div class="col-md-12" style="width:100%;text-align:right;margin-top:10px;padding-right:0px;">
                            <button class="btn green" onclick="javascript:pdv_lista_add();" type="button">Adicionar Item</button>
                        </div>
                        <? } ?>
                    </div>
                </div>
                
				<? if(trim($rSqlPdvBilheteria['venda_com_registro'])=="1") { ?>
                <input type="hidden" id="venda_com_registro" value="1" />
                <? } else { ?>
                <input type="hidden" id="venda_com_registro" value="0" />
                <? } ?>

				<? if(trim($rSqlPdvBilheteria['pessoa_nome'])=="1" && trim($rSqlPdvBilheteria['pessoa_nome_obrigatorio'])=="1") { ?>
                <input type="hidden" id="pessoa_nome_obrigatorio" value="1" />
                <? } else { ?>
                <input type="hidden" id="pessoa_nome_obrigatorio" value="0" />
                <? } ?>

				<? if(trim($rSqlPdvBilheteria['pessoa_documento'])=="1" && trim($rSqlPdvBilheteria['pessoa_documento_obrigatorio'])=="1") { ?>
                <input type="hidden" id="pessoa_documento_obrigatorio" value="1" />
                <? } else { ?>
                <input type="hidden" id="pessoa_documento_obrigatorio" value="0" />
                <? } ?>

				<? if(trim($rSqlPdvBilheteria['pessoa_email'])=="1" && trim($rSqlPdvBilheteria['pessoa_email_obrigatorio'])=="1") { ?>
                <input type="hidden" id="pessoa_email_obrigatorio" value="1" />
                <? } else { ?>
                <input type="hidden" id="pessoa_email_obrigatorio" value="0" />
                <? } ?>

				<? if(trim($rSqlPdvBilheteria['pessoa_whatsapp'])=="1" && trim($rSqlPdvBilheteria['pessoa_whatsapp_obrigatorio'])=="1") { ?>
                <input type="hidden" id="pessoa_whatsapp_obrigatorio" value="1" />
                <? } else { ?>
                <input type="hidden" id="pessoa_whatsapp_obrigatorio" value="0" />
                <? } ?>

				<? if(trim($rSqlPdvBilheteria['pessoa_genero'])=="1" && trim($rSqlPdvBilheteria['pessoa_genero_obrigatorio'])=="1") { ?>
                <input type="hidden" id="pessoa_genero_obrigatorio" value="1" />
                <? } else { ?>
                <input type="hidden" id="pessoa_genero_obrigatorio" value="0" />
                <? } ?>

                <? if(trim($mostra_campoSet)=="1") { ?>
                <div class="col-md-<?=$colMd?>" style="margin-bottom:10px;padding-left:5px;padding-right:5px;">
                    <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                        <h4 class="font-green-sharp">
                            <span style="width:100%;float:left;">Informações do Beneficiário</span>
                            <span style="width:100%;font-size:12px;font-style:italic;">Dados do proprietário do item</span>
                        </h4>

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
                        </style>
                        

                        <div class="form-group" id="DIV_sem_cadastro">
							<? if(trim($rSqlPdvBilheteria['pessoa_nome'])=="1") { ?>
                            <div class="col-md-12">
                                <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;padding-left:0px;">Nome Completo</label>
                                <input value="" type="text" id="nome" placeholder="" class="form-control"/>
                            </div>
                            <? } else { ?>
                            <input value="SEM" type="hidden" id="nome"/>
							<? } ?>
                            
							<? if(trim($rSqlPdvBilheteria['pessoa_documento'])=="1") { ?>
                            <? monta_mascara("documento","999.999.999-99"); ?>
                            <div class="col-md-12">
                                <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;padding-left:0px;">Documento</label>
                                <input value="" type="text" id="documento" placeholder="N&deg; Documento" class="form-control" onblur="javascript:validarCpf('documento');" />
                                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                                    <div id="DIV_documento_valido" style="display:none;color:#777;font-size:11px;"><i style="color:#25D366;" class="far fa-check-circle"></i>&nbsp;&nbsp;CPF informado é válido</div>
                                    <div id="DIV_documento_invalido" style="display:none;color:#777;font-size:11px;"><i style="color:#e70101;" class="far fa-engine-warning"></i>&nbsp;&nbsp;CPF informado é inválido</div>
                                    <input type="hidden" id="documento_valido" name="documento_valido" value="0">
                                </div>
                            </div>
                            <? } else { ?>
                            <input value="SEM" type="hidden" id="documento"/>
							<? } ?>

							<? if(trim($rSqlPdvBilheteria['pessoa_email'])=="1") { ?>
                            <div class="col-md-12">
                                <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;padding-left:0px;">E-mail</label>
                                <input value="" type="text" id="email" onblur="javascript:validarEmail('email');" placeholder="" class="form-control"/>
                                <div id="DIV_email_valido" style="display:none;color:#777;font-size:11px;"><i style="color:#25D366;" class="far fa-check-circle"></i>&nbsp;&nbsp;E-mail informado é válido</div>
                                <div id="DIV_email_invalido" style="display:none;color:#777;font-size:11px;"><i style="color:#e70101;" class="far fa-engine-warning"></i>&nbsp;&nbsp;E-mail informado é inválido</div>
                                <input type="hidden" id="email_valido" name="email_valido" value="0">
                            </div>
                            <? } else { ?>
                            <input value="SEM" type="hidden" id="email"/>
							<? } ?>

							<? if(trim($rSqlPdvBilheteria['pessoa_whatsapp'])=="1") { ?>
                            <? monta_mascara("whatsapp","(99) 99999-9999"); ?>
                            <div class="col-md-12">
                                <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;padding-left:0px;">WhatsApp</label>
                                <input value="" type="text" id="whatsapp" onkeypress="javascript:validarWhats('whatsapp');" onblur="javascript:validarWhats('whatsapp');" placeholder="" class="form-control"/>
                                <div id="DIV_whatsapp_valido" style="display:none;color:#777;font-size:11px;margin-top: 5px;"><i style="color:#25D366;" class="fas fa-badge-check"></i>&nbsp;&nbsp;WhatsApp válido</div>
                            </div>
                            <? } else { ?>
                            <input value="SEM" type="hidden" id="whatsapp"/>
							<? } ?>

							<? if(trim($rSqlPdvBilheteria['pessoa_genero'])=="1") { ?>
                            <div class="col-md-12">
                                <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;padding-left:0px;">Gênero</label>
                                <select id="genero" class="form-control bs-select" data-live-search="true" data-show-subtext="true">
                                    <option value="">Selecione um gênero</option>
                                    <option value="F">Feminino</option>
                                    <option value="M">Masculino</option>
                                </select>
                            </div>
                            <? } else { ?>
                            <input value="SEM" type="hidden" id="genero"/>
							<? } ?>
                            
                            <div class="col-md-12" style="width:100%;text-align:right;margin-top:10px;">
                                <button class="btn green" onclick="javascript:pdv_lista_add();" type="button">Adicionar Item</button>
                            </div>
                        </div>

                    </div>
                </div>
				<? } else { ?>
                <input value="SEM" type="hidden" id="nome"/>
                <input value="SEM" type="hidden" id="documento"/>
                <input value="SEM" type="hidden" id="email"/>
                <input value="SEM" type="hidden" id="whatsapp"/>
                <input value="SEM" type="hidden" id="genero"/>
                <? } ?>

                <div class="col-md-6" style="margin-bottom:10px;padding-left:5px;padding-right:5px;">
                    <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;margin-bottom:10px;">
                        <h4 class="font-green-sharp">
                            <span style="width:100%;float:left;">Carrinho</span>
                            <span style="width:100%;font-size:12px;font-style:italic;">Abaixo a lista de itens do carrinho</span>
                        </h4>

                        <div class="col-md-12" id="pdv_lista-lista" style="padding:0px;margin-top:5px;">
                            <? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/pdv_lista-lista.php"); ?>
                        </div>

                        <h4 class="font-green-sharp">
                            <span style="width:100%;float:left;">Pagamento</span>
                        </h4>

                        <style>
                        .div_valor {
                            width: 30% !important;
							float:left;
                        }
                        .div_forma_de_pagamento {
                            width: 45% !important;
							float:left;
                        }
                        .div_btn_add {
                            width: 25% !important;
							float:left;
                        }
                        </style>
                        <input type="hidden" id="valor_pagamento_maior" value="0">
                        <input type="hidden" id="valores_completos" value="0">
                        
						<? if(trim($rSqlPdvBilheteria['split'])=="1") { ?>
                        <input type="hidden" id="pdv_split" value="1">
                        <div class="form-group" id="DIV_fp">
                            <div class="col-md-12">
                                <div class="div_valor">
                                    <label class="control-label col-md-12" style="margin-bottom:3px;padding-left:0px;text-align:left;">Valor a Pagar</label>
                                    <input value="" type="text" id="pagamento_valor" onkeypress="javascript:mascara(this,moeda);" class="form-control" placeholder="" />
                                </div>
                                <div class="div_forma_de_pagamento">
                                    <label class="control-label col-md-12" style="margin-bottom:3px;padding-left:0px;text-align:left;">Forma de Pagamento</label>
                                    <select id="pagamento_forma_de_pagamento" class="form-control bs-select" data-live-search="true" data-show-subtext="true">
                                        <option value="">Selecione uma opção</option>
                                        <? if(trim($rSqlPdvBilheteria['ccr'])=="1") { ?>
                                        <option value="CCR">Cartão de Crédito</option>
                                        <? } ?> 
                                        <? if(trim($rSqlPdvBilheteria['ccd'])=="1") { ?>
                                        <option value="CCD">Cartão de Débito</option>
                                        <? } ?>
                                        <? if(trim($rSqlPdvBilheteria['din'])=="1") { ?>
                                        <option value="DIN">Dinheiro</option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="div_btn_add" style="padding:0px;">
                                    <button class="btn green" onclick="javascript:pdv_fp_add();" style="width:100%;text-align:center;float:right;margin-top:29px;" type="button">Adicionar</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" id="pdv_fp-lista" style="padding:0px;margin-top:5px;">
                            <? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/pdv_fp-lista.php"); ?>
                        </div>

						<? $nome_btn = "Efetuar Venda"; ?>
                        <div class="col-md-12 botoes_de_salvar" style="padding:0px;margin-top:5px;text-align:right;">
                            <button type="button" class="btn green input-label" style="margin-left: 0px;" onclick="javascript:pdv_venda_salvar('<?=$tipo_form_set?>');" style=""><?=$nome_btn?></button>
                        </div>
                        <input type="hidden" name="forma_de_pagamento" id="forma_de_pagamento" value="PDVWEBSPLIT" />
						<? } else { ?>
                        <input type="hidden" id="pdv_split" value="0">
                        <div class="col-md-12" id="pdv_fp-opcoes" style="padding:0px;margin-top:5px;">
                            <? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/pdv_fp-opcoes.php"); ?>
                        </div>

						<? $nome_btn = "Efetuar Venda"; ?>
                        <div class="col-md-12 botoes_de_salvar" style="padding:0px;margin-top:5px;text-align:right;display:none;">
                            <button type="button" class="btn green input-label" style="margin-left: 0px;" onclick="javascript:pdv_venda_salvar('<?=$tipo_form_set?>');" style=""><?=$nome_btn?></button>
                        </div>
						<? } ?>


                    </div>

                </div>
                
            </div>
        </div>
        </form>


    </div>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet">
    <style>
	.checkmark__circle {
	  stroke-dasharray: 166;
	  stroke-dashoffset: 166;
	  stroke-width: 2;
	  stroke-miterlimit: 10;
	  stroke: #7ac142;
	  fill: none;
	  animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
	}
	
	.checkmark {
	  width: 156px;
	  height: 156px;
	  border-radius: 50% !important;
	  display: block;
	  stroke-width: 2;
	  stroke: #fff;
	  stroke-miterlimit: 100;
	  margin: 20px auto;
	  box-shadow: inset 0px 0px 0px #7ac142;
	  animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
	}
	
	.checkmark__check {
	  transform-origin: 50% 50%;
	  stroke-dasharray: 48;
	  stroke-dashoffset: 48;
	  animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
	}
	
	@keyframes stroke {
	  100% {
		stroke-dashoffset: 0;
	  }
	}
	@keyframes scale {
	  0%, 100% {
		transform: none;
	  }
	  50% {
		transform: scale3d(1.1, 1.1, 1);
	  }
	}
	@keyframes fill {
	  100% {
		box-shadow: inset 0px 0px 0px 130px #7ac142;
	  }
	}
    </style>
    <div class="col-md-12" id="DIV_sucesso" style="display:none;">
        <div class="col-md-12" style="background-color: #fff;">
            <div style="text-align:center;background-color: #fff;color:#7ac142;width:100%;font-weight:bold;font-family: 'Josefin Sans', sans-serif;padding-top:20px;">
                VENDA
            </div>
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
              <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
              <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
            </svg>
            <div style="text-align:center;background-color: #fff;color:#7ac142;width:100%;font-weight:bold;font-family: 'Josefin Sans', sans-serif;padding-bottom:20px;">
                REALIZADA COM SUCESSO!
            </div>
        </div>

		<div class="form-row" style="padding:5px;padding-left:0px;padding-right:0px;">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td colspan="2">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="width:50%;text-align:left;" align="left">
                                <button type="button" class="btn blue input-label" style="margin-left: 0px;margin-top:5px;margin-bottom:0px;" 
                                onclick="javascript:window.open('<?=$link?><?=$chave_url?><?=$_SESSION['var1']?>/<?=$_SESSION['var2']?>/','_self','');">NOVA VENDA</button>
                                </td>

                                <td style="width:50%;text-align:right;" align="right">
                                <button type="button" class="btn green input-label" style="margin-left: 0px;margin-top:5px;margin-bottom:0px;margin-right:0px;" 
                                onclick="javascript:window.open('<?=$link?><?=$chave_url?><?=$_SESSION['var1']?>/imprimir-ingressos/<?=$_SESSION['numeroUnicoGerado']?>/','_blank','');">IMPRIMIR INGRESSOS</button>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
		</div>
    </div>
