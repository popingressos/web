<? if($formulario==0) { ?> 

					<? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?>
                    <?
                    if(trim($_SESSION["_empresaS_validacao"])=="") {
                        $empresaHomeSet = "";
                    } else {
                        $empresaHomeSet = "".$_SESSION["_empresaS_validacao"]."";
                    }
                    ?>
                    <div class="col-md-12" style="margin-bottom: 10px;width:100%;">
                        <label class="control-label col-md-12" style="text-align:left;padding-left:0px;padding-right:0px;">Empresa</label>
                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                            <select name="empresa" id="empresa" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:filtrar_empresa('validacao');">
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
                                <option value="<?= $rSqlItem['id'] ?>" <? if(trim($empresaHomeSet)==trim($rSqlItem['id'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                                <? } ?>
                            </select>
                        </div>
                    </div>
                    <? } else { ?>
                        <? $empresaHomeSet = "".$sysusu['empresa'].""; ?>
                        <input type="hidden" name="empresa" id="empresa" value="<?=$empresaHomeSet?>">
                    <? } ?>

    <div class="col-md-12" style="margin-bottom:10px;margin-top: 10px;">
        <div class="tabbable tabbable-custom" style="background-color:#FFF;">
            <div class="tab-content tab_content_principal" style="border:0px !important;padding:0px !important;">
                <div class="tab-pane active" id="lista">
                    
                    <style>
                    #reader__scan_region {
						text-align:center !important;
					}
					#reader__dashboard_section_csr {
					    margin-bottom: 10px;
					}
					#reader__camera_selection {
						display: block;
						width: 100%;
						height: 34px;
						padding: 6px 12px;
						font-size: 14px;
						line-height: 1.42857;
						color: #555;
						background-color: #fff;
						background-image: none;
						border: 1px solid #c2cad8;

						outline: none!important;
						box-shadow: none!important;

						-webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
						box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
						-webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
						-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
						transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
						
						margin-top:10px;
						margin-bottom:10px;
					}
					#reader__dashboard_section_csr > div > button {
						display: inline-block;
						margin-bottom: 0;
						font-weight: 400;
						text-align: center;
						vertical-align: middle;
						touch-action: manipulation;
						cursor: pointer;
						background-image: none;
						border: 1px solid #169ef4;
						white-space: nowrap;
						padding: 6px 12px;
						font-size: 14px;

						-webkit-user-select: none;
						-moz-user-select: none;
						-ms-user-select: none;
						user-select: none;


						outline: none!important;
						box-shadow: none!important;

						background-color: #169ef4 !important;
						color: #FFF !important;
						text-align: center !important;
					}
					#reader__dashboard_section_csr > span > button {
						display: inline-block;
						margin-bottom: 0;
						font-weight: 400;
						text-align: center;
						vertical-align: middle;
						touch-action: manipulation;
						cursor: pointer;
						background-image: none;
						border: 1px solid #32c5d2;
						white-space: nowrap;
						padding: 6px 12px;
						font-size: 14px;

						-webkit-user-select: none;
						-moz-user-select: none;
						-ms-user-select: none;
						user-select: none;


						outline: none!important;
						box-shadow: none!important;

						background-color: #32c5d2 !important;
						color: #FFF !important;
						text-align: center !important;
					}
					#reader__dashboard_section_swaplink {
						font-size:12px;
						text-decoration:none !important;
					}
                    </style>
                    

					<? if(trim($empresaHomeSet)=="") { } else { ?>
                    <div id="DIV_pesquisa" style="display:block;padding:10px;">
                        <div style="width: 100%;" id="reader"></div>
        
                        <div class="col-md-12" style="background-color: #fff;padding-left:5px;padding-right:5px;padding-bottom:10px;">
                            <div class="col-md-6" id="barcode_reader" style="background-color: #fff;padding-left:0px;padding-right:0px;padding-bottom:10px;">
                                <div class="col-md-12" style="text-align:left;background-color: #fff;padding-left:0px;">
                                    Posicione o cursor no campo e faça a leitura
                                </div>
                                <input value="" id="cod_voucher_leitor" @input="consultarQuandoParar($event)" type="text" placeholder="Posicione o cursor no campo" class="form-control" />
                            </div>
                            <div class="col-md-6" style="background-color: #fff;padding-left:0px;padding-right:0px;">
                                <div class="col-md-12" style="text-align:left;background-color: #fff;padding-left:0px;padding-right:0px;">
                                    Ou informe um CPF para pesquisar
                                </div>
                                <div class="col-md-12" style="background-color: #fff;text-align:center;padding-left:0px;padding-right:0px;">
                                    <input value="" id="cpf" type="text" placeholder="Digite um CPF" class="form-control" />
                                </div>
                                <div class="col-md-12" style="background-color: #fff;text-align:right;padding-right:0px;">
                                    <button type="button" class="btn green input-label" style="margin-left: 0px;margin-top:5px;margin-bottom:5px;" onclick="javascript:validacao_web_cpf('<?=$empresaHomeSet?>');" style="">Pesquisar por CPF</button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div style="width: 100%;display:none;" id="DIV_conteudo"></div>
                    <? } ?>

                </div>
                <!-- END TAB_LISTA-->
    
            </div>
            <!-- END TAB CONTENT-->
        </div>
    </div>
<? } ?>