				<div class="col-md-12">
                    <div class="tabbable tabbable-custom blue">

                        <ul class="nav nav-tabs">

							<li class="active"><a data-toggle="tab" href="#tab_form">Editando <?=$row['nome']?></a></li>

                        </ul>
    
                        <div class="tab-content">
                                
                                <div class="tab-pane active" id="tab_form">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <ul class="ver-inline-menu tabbable margin-bottom-10">
                                                <li onclick="seta_aba('dados-principais');" class="active"><a data-toggle="tab" href="#dados-principais"><i class="fa fa-caret-right"></i> Dados principais</a> <span class="after"></span></li>
                                                <li onclick="seta_aba('dados-complementares');"><a data-toggle="tab" href="#dados-complementares"><i class="fa fa-caret-right"></i> Dados complementares</a></li>
                                                <li onclick="seta_aba('editar-avatar');"><a data-toggle="tab" href="#editar-avatar"><i class="fa fa-caret-right"></i> Editar Avatar</a></li>
                                                <li onclick="seta_aba('contatos');"><a data-toggle="tab" href="#contatos"><i class="fa fa-caret-right"></i> Contatos</a></li>
                                                <li onclick="seta_aba('dados-bancarios');"><a data-toggle="tab" href="#dados-bancarios"><i class="fa fa-caret-right"></i> Dados Bancários</a></li>
                                            </ul>
                                        </div>

                                        <div class="col-md-10">
                                            <div class="portlet light bg-inverse form-fit">
                                            <div class="portlet-body form">
                                                <form name="forms" method="post" action="<?=$link?><?=$chave_url?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="formulario" class="form-horizontal form-bordered form-row-stripped">
                                                <div class="form-body">
                                                    <input type="hidden" name="aba" id="aba" value="dados-principais" />
                                                    
                                                    <input type="hidden" name="subMod" value="" />

                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                    <input type="hidden" name="acaoForm" id="idacaoForm" value="editar" />
                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                    <input type="hidden" name="iditem" id="iditem_set" value="<?=$sysusu['id']?>" />
        
                                                    <? 
                                                    $numeroUnicoGerado = $row['numeroUnico']; 
                                                    ?>
                                                    <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">

                                                    <div class="tab-content">
    
                                                        <div id="dados-principais" class="tab-pane active" style="min-height:350px;">
            
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Nome</label>
                                                                <div class="col-md-10">
                                                                    <input value="<?=$row['nome']?>" style="width:350px;" type="text" name="nome" id="nome" class="form-control" />
                                                                </div>
                                                            </div>
                        
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Sobrenome</label>
                                                                <div class="col-md-10">
                                                                    <input value="<?=$row['sobrenome']?>" style="width:350px;" type="text" name="sobrenome" id="sobrenome" class="form-control" />
                                                                </div>
                                                            </div>
                        
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Login</label>
                                                                <div class="col-md-4">
                                                                    <div class="input-icon">
                                                                        <i class="fa fa-envelope"></i>
                                                                        <input value="<?=$row['email']?>" autocomplete="off" class="form-control" type="text" name="email" id="email" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Senha</label>
                                                                <div class="col-md-4">
                                                                    <div class="input-group">
                                                                        <div class="input-icon">
                                                                            <i class="fa fa-lock fa-fw"></i>
                                                                            <input class="form-control" type="password"  name="senha" id="senha" autocomplete="off" placeholder="Senha" value="<? if(trim($row['senha'])=="") { } else { $senhaSet = Seguranca::decriptar($row['senha'],Seguranca::chave("infiniti")); echo $senhaSet; } ?>"/>
                
                                                                            <script>
                                                                            function exibir_caracteres(acaoSend) {
                                                                                if(acaoSend=="exibir")  {
                                                                                    $('#btn_exibir').hide();
                                                                                    $('#btn_ocultar').fadeIn();
                                                                                    $('#senha').attr('type', 'text');
                                                                                } else {
                                                                                    $('#btn_exibir').fadeIn();
                                                                                    $('#btn_ocultar').hide();
                                                                                    $('#senha').attr('type', 'password');
                                                                                }
                                                                            }
                                                                            </script>
                                                                        </div>
                                                                        <span class="input-group-btn">
                                                                            <button class="btn grey-gallery" onclick="gera_senha();" type="button"><i class="fa fa-arrow-left fa-fw"/></i> Gerar Senha</button>
                                                                        </span>
                                                                        <span class="input-group-btn" id="btn_exibir" style="margin-left:3px;">
                                                                            <button class="btn green" onclick="exibir_caracteres('exibir')" style="width:120px;" type="button">exibir caracteres</button>
                                                                        </span>
                                                                        <span class="input-group-btn" id="btn_ocultar" style="margin-left:3px;display:none;">
                                                                            <button class="btn blue" onclick="exibir_caracteres('ocultar')" style="width:120px;" type="button">ocultar caracteres</button>
                                                                        </span>
                                                                    </div>
                                                                    <p class="help-block senha_gerada"></p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Cor do usuário</label>
                                                                <div class="col-md-4">
                                                                    <? if(trim($row['cor'])=="") { $cor_set = "#FFFFFF"; } else { $cor_set = $row['cor']; } ?>
                                                                    <input type="text" name="cor" id="cor" class="form-control color_campo" data-position="top left" value="<?=$cor_set?>">
                                                                    <p class="help-block">A cor escolhida afetara detalhes de informações do usuário dentor do sistema</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Descrição do usuário</label>
                                                                <div class="col-md-10">
                                                                    <textarea class="form-control ckeditor" name="descricao" id="descricao" style="height:150px;"><?=$row['descricao']?></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2 req">Ativo ?</label>
                                                                <div class="col-md-10">
                                                                    <div class="radio-list">
                                                                        <label class="radio-inline" style="color:#C00;">
                                                                        <input type="radio" name="stat" id="ativo1" value="0" <? if($row['stat']==0) { echo "checked"; } ?>> não </label>
                                                                        <label class="radio-inline" style="color:#390;">
                                                                        <input type="radio" name="stat" id="ativo2" value="1" <? if(trim($row['stat'])==""||$row['stat']==1) { echo "checked"; } ?>> sim </label>
                                                                    </div>
                                                                </div>
                                                            </div>	
        
                                                        </div>
                                                        <!-- END dados_principais -->
                                                        
                                                        <div id="dados-complementares" class="tab-pane" style="min-height:350px;">

                                                            <? monta_mascara("cpf","999.999.999-99"); ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">CPF</label>
                                                                <div class="col-md-5">
                                                                    <input class="form-control" value="<?=$row['cpf']?>" name="cpf" id="cpf" type="text">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">RG</label>
                                                                <div class="col-md-4">
                                                                    <input class="form-control" value="<?=$row['rg']?>" name="rg" id="rg" type="text">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Passaporte</label>
                                                                <div class="col-md-4">
                                                                    <input class="form-control" value="<?=$row['passaporte']?>" name="passaporte" id="passaporte" type="text">
                                                                </div>
                                                            </div>

															<? monta_mascara("data_nascimento","99/99/9999"); ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Data de nascimento</label>
                                                                <div class="col-md-2">
                                                                    <input class="form-control" value="<? if(trim($row['data_nascimento'])==""||trim($row['data_nascimento'])=="0000-00-00"||trim($row['data_nascimento'])=="1999-11-30") { } else { echo ajustaData($row['data_nascimento'],"d/m/Y"); } ?>" name="data_nascimento" id="data_nascimento" type="text">
                                                                </div>
                                                            </div>

                                                            <div class="horizontal-form" style="border:0px;">
                                                                <div class="form-body" style="border:0px;">

                                                                    <h3 class="form-section" style="padding:10px;">Listagem de Redes Sociais</h3>

                                                                    <div class="form-group">
                                                                        <div class="col-md-6" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Nome</label>
                                                                                <input value="" class="form-control" type="text" id="nome_item" placeholder="Digite o nome da rede" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6" style="border:0px;">
                                                                            <label class="control-label">Link</label>
                                                                            <div class="form-inline">
                                                                                <div class="form-group col-md-9" style="border:0px;padding-left:0px;">
                                                                                    <input value="" class="form-control" style="width:100%;" type="text" id="link_item" placeholder="Digite ou cole aqui o link da rede" />
                                                                                </div>
                                                                                <div class="form-group" style="border:0px;">
                                                                                    <button type="button" onclick="salvar_lista_redes('<?=$mod?>');" class="btn blue"><i class="fa fa-plus"></i> Adicionar</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- END form-group E-MAIL'S -->

                                                                    <div class="form-group" id="lista_<?=$mod?>_redes" style="padding:10px;">
																		<? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./templates/".$layout_padrao_set."/acoes/".$mod."/lista_redes.php"); ?>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- END horizontal-form REDES SOCIAIS -->

                                                        </div>
                                                        <!-- END dados_complementares -->

                                                        <div id="editar-avatar" class="tab-pane" style="min-height:350px;">
                
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Avatar</label>
                                                                <div class="col-md-10">
                
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                                            <? if(trim($row['imagem'])=="") { ?>
                                                                            <img src="<?=$link?>templates/<?=$layout_padrao_set?>/templates/img/dummy_150x150.gif" alt=""/>
                                                                            <? } else { ?>
                                                                            <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['imagem']?>" alt="">
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
                                                                            <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','imagem');" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
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
                                                        <!-- END editar_avatar -->

                                                        <div id="contatos" class="tab-pane" style="min-height:350px;">

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Telefone 1</label>
                                                                <div class="col-md-3" style="border:0px;">
                                                                    <div class="form-group" style="border:0px;">
                                                                        <label class="control-label">Operadora</label>
                                                                        <select name="telefone_1_operadora" id="telefone_1_operadora" class="form-control">
                                                                            <option value="">---</option>
                                                                            <option value="Oi" <? if($row['telefone_1_operadora']=="Oi") { echo "selected"; } ?>>Oi</option>
                                                                            <option value="TIM" <? if($row['telefone_1_operadora']=="TIM") { echo "selected"; } ?>>TIM</option>
                                                                            <option value="Claro" <? if($row['telefone_1_operadora']=="Claro") { echo "selected"; } ?>>Claro</option>
                                                                            <option value="Vivo" <? if($row['telefone_1_operadora']=="Vivo") { echo "selected"; } ?>>Vivo</option>
                                                                            <option value="Nextel" <? if($row['telefone_1_operadora']=="Nextel") { echo "selected"; } ?>>Nextel</option>
                                                                            <option value="Outra" <? if($row['telefone_1_operadora']=="Outra") { echo "selected"; } ?>>Outra</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4" style="border:0px;">
                                                                    <label class="control-label">Telefone (DDD + Número)</label>
                                                                    <div class="form-inline">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <input class="form-control" style="width:50px;" value="<?=$row['telefone_1_ddd']?>" name="telefone_1_ddd"  id="telefone_1_ddd" type="text">
                                                                        </div>
                                                                        <div class="form-group" style="border:0px;">
                                                                            <input class="form-control" style="width:200px;" value="<?=$row['telefone_1']?>" name="telefone_1"  id="telefone_1" type="text">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- END telefone_1 -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Telefone 2</label>
                                                                <div class="col-md-3" style="border:0px;">
                                                                    <div class="form-group" style="border:0px;">
                                                                        <label class="control-label">Operadora</label>
                                                                        <select name="telefone_2_operadora" id="telefone_2_operadora" class="form-control">
                                                                            <option value="">---</option>
                                                                            <option value="Oi" <? if($row['telefone_2_operadora']=="Oi") { echo "selected"; } ?>>Oi</option>
                                                                            <option value="TIM" <? if($row['telefone_2_operadora']=="TIM") { echo "selected"; } ?>>TIM</option>
                                                                            <option value="Claro" <? if($row['telefone_2_operadora']=="Claro") { echo "selected"; } ?>>Claro</option>
                                                                            <option value="Vivo" <? if($row['telefone_2_operadora']=="Vivo") { echo "selected"; } ?>>Vivo</option>
                                                                            <option value="Nextel" <? if($row['telefone_2_operadora']=="Nextel") { echo "selected"; } ?>>Nextel</option>
                                                                            <option value="Outra" <? if($row['telefone_2_operadora']=="Outra") { echo "selected"; } ?>>Outra</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4" style="border:0px;">
                                                                    <label class="control-label">Telefone (DDD + Número)</label>
                                                                    <div class="form-inline">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <input class="form-control" style="width:50px;" value="<?=$row['telefone_2_ddd']?>" name="telefone_2_ddd"  id="telefone_2_ddd" type="text">
                                                                        </div>
                                                                        <div class="form-group" style="border:0px;">
                                                                            <input class="form-control" style="width:200px;" value="<?=$row['telefone_2']?>" name="telefone_2"  id="telefone_2" type="text">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- END telefone_2 -->


                                                            <h3 class="form-section" style="padding:10px;">E-mail's</h3>

                                                            <div class="form-group">
                                                                <div class="col-md-6" style="border:0px;">
                                                                    <div class="form-group" style="border:0px;">
                                                                        <label class="control-label">Nome</label>
                                                                        <input class="form-control" value="" id="nomeemail_item" type="text">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6" style="border:0px;">
                                                                    <label class="control-label">E-mail</label>
                                                                    <div class="form-inline">
                                                                        <div class="form-group col-md-9" style="border:0px;padding-left:0px;">
                                                                            <input class="form-control" style="width:100%;" value="" id="email_item" type="text">
                                                                        </div>
                                                                        <div class="form-group" style="border:0px;">
                                                                            <button type="button" onclick="salvar_lista_emails('<?=$mod?>');" class="btn blue"><i class="fa fa-plus"></i> Adicionar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- END form-group E-MAIL'S -->

                                                            <div class="form-group" id="lista_<?=$mod?>_emails" style="padding:10px;">
                                                                <? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./templates/".$layout_padrao_set."/acoes/".$mod."/lista_emails.php"); ?>
                                                            </div>

                                                            <? monta_mascara("cep","99999-999"); ?>
                                                            <div class="form-group">
                                                                <div class="col-md-5" style="border:0px;">
                                                                    <label class="control-label">CEP</label>
                                                                    <div class="form-inline">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <input value="<?=$row['cep']?>" class="form-control" style="width:110px;" type="text" id="cep" name="cep" />
                                                                            <col-md- class="help-block">99999-999</col-md->
                                                                        </div>
                                                                        <div class="form-group" style="border:0px;">
                                                                            <button type="button" onclick="buscaCep();" style="margin-top:-27px;" class="btn grey-gallery">Carregar endereço</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
            
                                                            <div class="form-group">
                                                                <div class="col-md-6" style="border:0px;">
                                                                    <div class="form-group" style="border:0px;">
                                                                        <label class="control-label">Rua</label>
                                                                        <input value="<?=$row['rua']?>" class="form-control" type="text" id="rua" name="rua" />
                                                                    </div>
                                                                </div>
            
                                                                <div class="col-md-2" style="border:0px;padding:0px;">
                                                                    <div class="form-group" style="border:0px;">
                                                                        <label class="control-label">Número</label>
                                                                        <input value="<?=$row['numero']?>" class="form-control" type="text" id="numero" name="numero" />
                                                                    </div>
                                                                </div>
            
                                                                <div class="col-md-4" style="border:0px;">
                                                                    <div class="form-group" style="border:0px;">
                                                                        <label class="control-label">Complemento</label>
                                                                        <input value="<?=$row['complemento']?>" class="form-control" type="text" id="complemento" name="complemento" />
                                                                    </div>
                                                                </div>
                                                            </div>
            
                                                            <div class="form-group">
                                                                <div class="col-md-4" style="border:0px;">
                                                                    <div class="form-group" style="border:0px;">
                                                                        <label class="control-label">Estado</label>
                                                                        <select id="estado" name="estado" class="form-control" onchange="mostraCidades();">
                                                                            <option value="">---</option>
                                                                            <?
                                                                            $qSqlEstado = mysql_query("SELECT * FROM cepbr_estado ORDER BY estado");
                                                                            while($rSqlEstado = mysql_fetch_array($qSqlEstado)) {
                                                                            ?>
                                                                            <option value="<?= $rSqlEstado['uf'] ?>" <? if($rSqlEstado['uf']==$row['estado']) { echo "selected"; $estado_set = $rSqlEstado['uf']; } ?>><?= utf8_encode($rSqlEstado['estado']) ?></option>
                                                                            <? } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
            
                                                                <div class="col-md-4" style="border:0px;">
                                                                    <div class="form-group" style="border:0px;">
                                                                        <label class="control-label">Cidade</label>
                                                                        <select id="cidade" name="cidade" class="form-control" onchange="javascript:mostraBairros();">
                                                                            <? if(trim($row['estado'])=="") { ?>
                                                                            <option value="">---</option>
                                                                            <? } else { ?>
                                                                            <option value="">---</option>
                                                                            <?
                                                                            $qSqlCidade = mysql_query("SELECT * FROM cepbr_cidade WHERE id_cidade='".$row['cidade']."' ORDER BY cidade");
                                                                            while($rSqlCidade=mysql_fetch_array($qSqlCidade)) {
                                                                            ?>
                                                                            <option value="<?=$rSqlCidade['id_cidade']?>" <? if($rSqlCidade['id_cidade']==$row['cidade']) { echo "selected"; $cidade_set = utf8_encode($rSqlCidade['cidade']); } ?>><?=utf8_encode($rSqlCidade['cidade'])?></option>
                                                                            <? } ?>
                                                                            <? } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
            
                                                                <div class="col-md-4" style="border:0px;">
                                                                    <div class="form-group" style="border:0px;">
                                                                        <label class="control-label">Bairro</label>
                                                                        <select id="bairro" name="bairro" class="form-control">
                                                                            <? if(trim($row['cidade'])=="") { ?>
                                                                            <option value="">---</option>
                                                                            <? } else { ?>
                                                                            <option value="">---</option>
                                                                            <?
                                                                            $qSqlBairro = mysql_query("SELECT * FROM cepbr_bairro WHERE id_cidade='".$row['cidade']."' ORDER BY bairro");
                                                                            while($rSqlBairro=mysql_fetch_array($qSqlBairro)) {
                                                                            ?>
                                                                            <option value="<?=$rSqlBairro['id_bairro']?>" <? if($rSqlBairro['id_bairro']==$row['bairro']) { echo "selected"; $bairro_set = utf8_encode($rSqlBairro['bairro']); } ?>><?=utf8_encode($rSqlBairro['bairro'])?></option>
                                                                            <? } ?>
                                                                            <? } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- END contatos -->
                                                        
                                                        <div id="dados-bancarios" class="tab-pane" style="min-height:350px;">

                                                            <div class="horizontal-form" style="border:0px;">
                                                                <div class="form-body" style="border:0px;">

                                                                    <h3 class="form-section" style="padding:10px;">Listagem de Bancos</h3>

                                                                    <div class="form-group">
                                                                        <div class="col-md-1" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Principal ?</label>
                                                                                <select id="principal_banco" class="form-control">
                                                                                    <option value="0">NÃO</option>
                                                                                    <option value="1">SIM</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Nome</label>
                                                                                <input value="" class="form-control" type="text" id="nome_banco" />
                                                                                <p class="help-block">Digite um nome para identificar este banco</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="col-md-3" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Tipo de Conta</label>
                                                                                <select id="tipo_conta" class="form-control" onchange="tipo_favorecido();">
                                                                                    <option value="">---</option>
                                                                                    <option value="cc-pf">Conta Corrente - PF</option>
                                                                                    <option value="cp-pf">Conta Poupança - PF</option>
                                                                                    <option value="cc-pj">Conta Corrente - PJ</option>
                                                                                    <option value="cp-pj">Conta Poupança - PJ</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-5" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Nome do Favorecido</label>
                                                                                <input value="" class="form-control" type="text" id="favorecido" />
                                                                            </div>
                                                                        </div>

                                                                        <? monta_mascara("favorecido_cpf","999.999.999-99"); ?>
                                                                        <div class="col-md-4" id="div-favorecido_cpf" style="border:0px;display:none;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">CPF</label>
                                                                                <input value="" class="form-control" type="text" id="favorecido_cpf" />
                                                                            </div>
                                                                        </div>

                                                                        <? monta_mascara("favorecido_cnpj","99.999.999/9999-99"); ?>
                                                                        <div class="col-md-4" id="div-favorecido_cnpj" style="border:0px;display:none;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">CNPJ</label>
                                                                                <input value="" class="form-control" type="text" id="favorecido_cnpj" />
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="col-md-4" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Banco</label>
                                                                                <select id="idbanco" class="form-control">
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $qSqlItem = mysql_query("SELECT * FROM sysbanco_lista WHERE stat='1' ORDER BY nome");
                                                                                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                                    ?>
                                                                                    <option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Agência</label>
                                                                                <input value="" class="form-control" type="text" id="agencia" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Conta</label>
                                                                                <input value="" class="form-control" type="text" id="conta" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-2" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Operação</label>
                                                                                <input value="" class="form-control" type="text" id="operacao" />
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group" style="border:0px;">
                                                                        <div class="col-md-2" style="border:0px;">
                                                                            <div class="form-inline">
                                                                                <div class="form-group" style="border:0px;">
                                                                                    <button type="button" onclick="salvar_lista_banco('<?=$mod?>');" class="btn blue"><i class="fa fa-plus"></i> Adicionar</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group" id="lista_<?=$mod?>_banco" style="padding:10px;">
																		<? $sufixoGet = ""; $numeroUnicoGet = $numeroUnicoGerado; include("./templates/".$layout_padrao_set."/acoes/".$mod."/lista_banco.php"); ?>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- END horizontal-form BANCOS -->

                                                        </div>
                                                        <!-- END dados_bancarios -->

                                                    </div>
    
                                                </div>
                                                <!-- END form-body -->

                                                <div style="border:0px;position:fixed;bottom:35px;background-color:#f6f6f6;padding:10px;">
                                                    <div class="col-md-12">
                                                        <? if(trim($_construtor_sysperm['senha_'.$mod.''])==1 || trim($_construtor_sysperm['dados_'.$mod.''])==1) { ?>
                                                        <button type="submit" style="margin-left:20px;" class="btn green-turquoise"><i class="fa fa-floppy-o"></i> Salvar</button>
                                                        <? } ?>
                                                        <button type="button" id="btn_cancelar" class="btn yellow-casablanca"><i class="fa fa-minus-circle"></i> Cancelar</button>
                                                    </div>
                                                </div>

                                                </form>
                                                
        
                                            </div>
                                            </div>
    
                                        </div>
                                        <!-- END COL-10-->

                                     </div>
                                     <!-- END ROW-->
                                        
                                </div>
                                <!-- END TAB_FORM-->

                        </div>
                        <!-- END TAB CONTENT-->

                    </div>
				</div>
                <!-- FIM COL-MD-12-->
                
                <script>
				var Componentes = function () {
				
					var handle_COR = function() {
						$('.color_campo').each(function() {
							//
							// Dear reader, it's actually very easy to initialize MiniColors. For example:
							//
							//  $(selector).minicolors();
							//
							// The way I've done it below is just for the demo, so don't get confused
							// by it. Also, data- attributes aren't supported at this time...they're
							// only used for this demo.
							//
							$(this).minicolors({
								control: $(this).attr('data-control') || 'hue',
								defaultValue: $(this).attr('data-defaultValue') || '',
								inline: $(this).attr('data-inline') === 'true',
								letterCase: $(this).attr('data-letterCase') || 'lowercase',
								opacity: $(this).attr('data-opacity'),
								position: $(this).attr('data-position') || 'bottom left',
								change: function(hex, opacity) {
									if (!hex) return;
									if (opacity) hex += ', ' + opacity;
									if (typeof console === 'object') {
										console.log(hex);
									}
								},
								theme: 'bootstrap'
							});
				
						});
					}

					var handleColorPicker = function () {
						if (!jQuery().colorpicker) {
							return;
						}
						$('.colorpicker-default').colorpicker({
							format: 'hex'
						});
					}
				
					var handleDatePickers = function () {
				
						if (jQuery().datepicker) {
							$('.date-picker').datepicker({
								rtl: Metronic.isRTL(),
								orientation: "top",
								autoclose: true
							});
							//$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
						}
				
						/* Workaround to restrict daterange past date select: http://stackoverflow.com/questions/11933173/how-to-restrict-the-selectable-date-ranges-in-bootstrap-datepicker */
					}

					return {
				
						//main function to initiate the module
						init: function () {
							
							handle_COR();
							
							handleColorPicker();
							
							handleDatePickers();
						}
				
					};
				
				}();

				jQuery(document).ready(function() {    
					Componentes.init();
				});
                </script>





