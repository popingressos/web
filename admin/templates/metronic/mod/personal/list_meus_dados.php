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
            </style>
            <div class="row" style="padding-left:0px;padding-right:0px;">
                <div class="col-md-12" style="margin-bottom:10px;padding-left:10px;padding-right:10px;">
                    <div class="col-md-3" style="padding:5px;">
                        <div class="col-md-12 box_menu box_ativo" div-toggle="informacoes-basicas">
                            <h4>
                                <span style="width:100%;float:left;">Informações Básicas<i class="fal fa-user-circle" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de identificação da pessoa e cadastro básico</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="endereco">
                            <h4>
                                <span style="width:100%;float:left;">Endereço<i class="fal fa-map-marked-alt" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de localização e endereço</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:5px;">
                        <div class="col-md-12 box_menu box_inativo" div-toggle="galeria-de-images-e-videos">
                            <h4>
                                <span style="width:100%;float:left;">Galeria de Imagens e Vídeos<i class="fal fa-photo-video" style="float:right;"></i></span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Fotos e vídeos de acompanhamento</span>
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
                    echo "<input type=\"hidden\" name=\"modulo\" id=\"modulo\" value=\"meus_dados_add\" />";
                    
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
                <div class="col-md-12 div_ativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="informacoes-basicas">
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-user-circle" style="padding-right:10px;"></i>Informações básicas</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de perfil</span>
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

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">CPF</label>
                                <? monta_mascara("cpf","999.999.999.-99"); ?>
                                <div class="col-md-12">
                                    <input value="<?=$row['cpf']?>" type="text" name="cpf" id="cpf" placeholder="N&deg; Documento" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Senha de Acesso</label>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="input-icon">
                                            <i class="fa fa-lock fa-fw"></i>
                                            <input class="form-control" 
                                            type="<? if(trim($_REQUEST['var3'])=="") { ?>text<? } else { ?>password<? } ?>"  
                                             onkeypress="return sem_acento(event);"
                                             name="senha" id="senha" placeholder="Senha" value="<?=$row['senha_conf']?>"/>

                                            <script>
                                            function exibir_caracteres(acaoSend) {
                                                if(acaoSend=="exibir")  {
                                                    $('#btn_exibir').hide();
                                                    $('#btn_ocultar').show();
                                                    $('#senha').attr('type', 'text');
                                                } else {
                                                    $('#btn_ocultar').hide();
                                                    $('#btn_exibir').show();
                                                    $('#senha').attr('type', 'password');
                                                }
                                            }
                                            </script>
                                        </div>
                                        <span class="input-group-btn">
                                            <button class="btn grey-gallery" onclick="gera_senha();" type="button"><i class="fa fa-arrow-left fa-fw"/></i> Gerar Senha</button>
                                        </span>
                                        <span class="input-group-btn" id="btn_exibir" style="margin-left:3px;">
                                            <button class="btn green" onclick="exibir_caracteres('exibir')" style="width:170px;text-align:center;" type="button">exibir caracteres</button>
                                        </span>
                                        <span class="input-group-btn" id="btn_ocultar" style="margin-left:3px;display:none;">
                                            <button class="btn blue" onclick="exibir_caracteres('ocultar')" style="width:170px;text-align:center;" type="button">ocultar caracteres</button>
                                        </span>
                                    </div>
                                    <p class="help-block senha_gerada"></p>
                                </div>
                            </div>

							<? monta_mascara("data_de_nascimento","99/99/9999"); ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Data de Nascimento</label>
                                <div class="col-md-12">
                                    <input value="<?=ajustaDataSemHoraReturn($row['data_de_nascimento'],"d/m/Y");?>" type="text" name="data_de_nascimento" id="data_de_nascimento" placeholder="Data de Nascimento" maxlength="10" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Gênero</label>
                                <div class="col-md-12">
                                    <select name="genero" id="genero" class="form-control">
                                        <option value="">---</option>
                                        <option value="F" <? if(trim($row['genero'])=="F") { echo " selected"; } ?>>Feminino</option>
                                        <option value="M" <? if(trim($row['genero'])=="M") { echo " selected"; } ?>>Masculino</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Imagem de Perfil</label>
                                <div class="col-md-12">

                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                            <? if(trim($row['imagem'])=="") { ?>
                                            <img src="<?=$link?>templates/<?=$layout_padrao_set?>/templates/img/dummy_150x150.gif" alt=""/>
                                            <? } else { ?>
                                            <img id="arquivo-atual-imagem" src="<?=$link?>files/sysusu/<?=$row['numeroUnico']?>/<?=$row['imagem']?>" alt="">
                                            <? } ?>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>

                                        <? if(trim($row['imagem'])=="") { ?>
                                        <div>
                                            <span class="btn default btn-file">
                                                <span class="fileinput-new"> Selecionar arquivo </span>
                                                <span class="fileinput-exists"> Alterar </span>
                                                <input type="file" name="imagem">
                                            </span>
                                            <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                        </div>
                                        <? } else { ?>
                                        <div>
                                            <span class="btn default btn-file">
                                                <span class="fileinput-new"> Alterar </span>
                                                <span class="fileinput-exists"> Alterar </span>
                                                <input type="file" name="imagem">
                                            </span>
                                            <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','sysusu','imagem');" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                        </div>
                                        <? } ?>
                                    </div>
                                    <div class="clearfix margin-top-10">
                                        <span class="label label-warning"> ATENÇÃO! </span>
                                        &nbsp;&nbsp;Pré-visualização da imagem só funciona nos seguintes navegadores: IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+.
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-clipboard-list-check" style="padding-right:10px;"></i>Informações de contato e social</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">E-mails, telefones e redes sociais</span>
                            </h4>
    
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">E-mail</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['email']?>" type="text" name="email" id="email" placeholder="E-mail" class="form-control" />
                                </div>
                            </div>

                            <? monta_mascara("whatsapp","(99) 99999-9999"); ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">WhatsApp</label>
                                <div class="col-md-12">
                                    <div class="input-icon">
                                        <i class="fab fa-whatsapp"></i>
                                        <input value="<?=$row['whatsapp']?>" class="form-control" type="text" name="whatsapp" id="whatsapp" placeholder="Telefone Celular e WhatsApp" />
                                    </div>
                                    <?
                                    if(trim($row['whatsapp'])=="") {
                                    } else {
                                        $whatsappSet = $row['whatsapp'];
                                        $whatsappSet = preg_replace("/[^0-9]/", "", $whatsappSet);
                                        $linkWhatsapp = "https://api.whatsapp.com/send?phone=+55".$whatsappSet."&text=Ol%C3%A1!";
                                    ?>
                                    <a href="<?=$linkWhatsapp?>" target="_blank" style="padding-top:5px;">Iniciar uma conversa</a>
                                    <? } ?>
                                </div>
                            </div>

                            <? monta_mascara("telefone","(99) 9999-9999"); ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Fixo</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['telefone']?>" type="text" name="telefone" id="telefone" placeholder="Telefone Fixo" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Instagram</label>
                                <div class="col-md-12">
                                    <div class="input-icon">
                                        <i class="fab fa-instagram"></i>
                                        <input value="<?=$row['instagram']?>" class="form-control" type="text" name="instagram" id="instagram" placeholder="Perfil do Instagram" />
                                    </div>
                                    <?
                                    if(trim($row['instagram'])=="") {
                                    } else {
                                        $instagramSet = $row['instagram'];
                                        $instagramSet = str_replace("https://www.instagram.com/","",$instagramSet);
                                        $instagramSet = str_replace("https://instagram.com/","",$instagramSet);
                                        $instagramSet = str_replace("www.instagram.com/","",$instagramSet);
                                        $instagramSet = str_replace("instagram.com/","",$instagramSet);
                                        $instagramSet = str_replace("@","",$instagramSet);
                                    ?>
                                    <a href="https://www.instagram.com/<?=$instagramSet?>" target="_blank" style="padding-top:5px;">Acessar perfil</a>
                                    <? } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Facebook</label>
                                <div class="col-md-12">
                                    <div class="input-icon">
                                        <i class="fab fa-facebook"></i>
                                        <input value="<?=$row['facebook']?>" class="form-control" type="text" name="facebook" id="facebook" placeholder="Perfil do Facebook" />
                                    </div>
                                    <?
                                    if(trim($row['facebook'])=="") {
                                    } else {
                                        $facebookSet = $row['facebook'];
                                        $facebookSet = str_replace("https://www.facebook.com/","",$facebookSet);
                                        $facebookSet = str_replace("https://facebook.com/","",$facebookSet);
                                        $facebookSet = str_replace("www.facebook.com/","",$facebookSet);
                                        $facebookSet = str_replace("facebook.com/","",$facebookSet);
                                        $facebookSet = str_replace("@","",$facebookSet);
                                    ?>
                                    <a href="https://www.facebook.com/<?=$facebookSet?>" target="_blank" style="padding-top:5px;">Acessar perfil</a>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END informacoes-basicas-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="endereco">
                    <div class="col-md-12" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-map-marked-alt" style="padding-right:10px;"></i>Endereço</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de localização e endereço</span>
                            </h4>

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
                </div>
                <!-- END endereco-->

                <div class="col-md-12 div_inativo" style="margin-bottom:10px;padding-left:10px;padding-right:10px;padding-top:0px;margin-top:-5px;" id="responsavel">
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-map-marked-alt" style="padding-right:10px;"></i>Dados do Responsável</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados principais de identificação</span>
                            </h4>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Nome</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['responsavel_nome']?>" type="text" id="responsavel_nome" name="responsavel_nome" class="form-control" placeholder="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Cargo</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['responsavel_cargo']?>" type="text" id="responsavel_cargo" name="responsavel_cargo" class="form-control" placeholder="" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">E-mail</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['responsavel_email']?>" type="text" id="responsavel_email" name="responsavel_email" class="form-control" placeholder="" />
                                </div>
                            </div>

                            <? monta_mascara("responsavel_whatsapp","(99) 99999-9999"); ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">WhatsApp</label>
                                <div class="col-md-12">
                                    <div class="input-icon">
                                        <i class="fab fa-whatsapp"></i>
                                        <input value="<?=$row['responsavel_whatsapp']?>" class="form-control" type="text" name="responsavel_whatsapp" id="responsavel_whatsapp" placeholder="Telefone Celular e WhatsApp" />
                                    </div>
                                    <?
                                    if(trim($row['responsavel_whatsapp'])=="") {
                                    } else {
                                        $responsavel_whatsappSet = $row['responsavel_whatsapp'];
                                        $responsavel_whatsappSet = preg_replace("/[^0-9]/", "", $responsavel_whatsappSet);
                                        $responsavel_linkWhatsapp = "https://api.whatsapp.com/send?phone=+55".$responsavel_whatsappSet."&text=Ol%C3%A1!";
                                    ?>
                                    <a href="<?=$responsavel_linkWhatsapp?>" target="_blank" style="padding-top:5px;">Iniciar uma conversa</a>
                                    <? } ?>
                                </div>
                            </div>

                            <? monta_mascara("responsavel_telefone","(99) 9999-9999"); ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Fixo</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['responsavel_telefone']?>" type="text" name="responsavel_telefone" id="responsavel_telefone" placeholder="Telefone Fixo" class="form-control" />
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6" style="padding:5px;">
                        <div class="col-md-12" style="background-color:#FFF;padding:10px;">
                            <h4 class="font-green-sharp">
                                <span style="width:100%;float:left;"><i class="fal fa-map-marked-alt" style="padding-right:10px;"></i>Endereço do Responsável</span>
                                <span style="width:100%;font-size:12px;font-style:italic;">Dados de localização</span>
                            </h4>

							<? monta_mascara("responsavel_cep","99999-999"); ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">CEP</label>
                                <div class="col-md-4" style="padding-right:0px;">
                                    <input value="<?=$row['responsavel_cep']?>" class="form-control" type="text" id="responsavel_cep" name="responsavel_cep" />
                                    <p class="help-block">Ex.: 99999-999</p>
                                </div>
                                <div class="col-md-3" style="padding-left:0px;">
                                    <button type="button" onclick="responsavel_buscaCepTxt();" style="margin-top:0px;" class="btn grey-gallery">Carregar endereço</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Rua</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['responsavel_rua']?>" type="text" id="responsavel_rua" name="responsavel_rua" class="form-control" placeholder="Ex.: Rua, Logradouro, Avenida." />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Número</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['responsavel_numero']?>" type="text" id="responsavel_numero" name="responsavel_numero" class="form-control" placeholder="Digite o número do endereço" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Complemento</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['responsavel_complemento']?>" type="text" id="responsavel_complemento" name="responsavel_complemento" class="form-control" placeholder="Ex.: Apt 000, Bloco X, Sala 0000" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Bairro</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['responsavel_bairro']?>" type="text" name="responsavel_bairro" id="responsavel_bairro" placeholder="Bairro" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Cidade</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['responsavel_cidade']?>" type="text" name="responsavel_cidade" id="responsavel_cidade" placeholder="Cidade" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Estado</label>
                                <div class="col-md-12">
                                    <input value="<?=$row['responsavel_estado']?>" type="text" name="responsavel_estado" id="responsavel_estado" placeholder="Cidade" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END responsavel-->

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


    <div class="botoes_salvar_rodape">
        <div class="row top-side">
            <!-- Inicio menu desktop-->
            <div class="col-xs-6 col-sm-12 botoes_de_salvar top-side-desktop">
                <button type="button" class="btn yellow-gold input-label" style="margin-left: 0px;" onclick="javascript:meus_dados_salvar();" style="">Salvar Mudanças</button>
            </div>
            <!-- Fim menu desktop-->
        </div>
    </div>
