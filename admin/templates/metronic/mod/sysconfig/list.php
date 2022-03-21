
				<div class="col-md-12">
                    <div class="tabbable tabbable-custom">

                        <ul class="nav nav-tabs">

                            <li class="active"><a data-toggle="tab" href="#tab_form">Configurações</a></li>

                        </ul>
    
                        <div class="tab-content">
                                
                                
                                <div class="tab-pane active" id="tab_form">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <ul class="ver-inline-menu tabbable margin-bottom-10">



                                                <? if(trim($_construtor_sysperm['admin_'.$mod.''])==1) { $aba_admin = 1; ?><li onclick="seta_aba('admin');" <? if($aba_admin==1) { ?> class="active"<? } ?>><a data-toggle="tab" href="#admin"><i class="fa fa-caret-right"></i> Admin</a> <span class="after"></span></li><? } ?>
                                                <? if(trim($_construtor_sysperm['site_'.$mod.''])==1) { $aba_site = 1; ?><li onclick="seta_aba('site');" <? if($aba_admin==0) { ?> class="active"<? } ?>><a data-toggle="tab" href="#site"><i class="fa fa-caret-right"></i> Site</a></li><? } ?>
                                                <? if(trim($_construtor_sysperm['layout_'.$mod.''])==1) { $aba_layout = 1; ?><li onclick="seta_aba('tela-de-login');" <? if($aba_admin==0&&$aba_site==0) { ?> class="active"<? } ?>><a data-toggle="tab" href="#tela-de-login"><i class="fa fa-caret-right"></i> Tela de Login</a></li><? } ?>
                                                <? if(trim($_construtor_sysperm['layout_'.$mod.''])==1) { $aba_cores_menu_lateral = 1; ?><li onclick="seta_aba('cores-menu-lateral');" <? if($aba_admin==0&&$aba_site==0) { ?> class="active"<? } ?>><a data-toggle="tab" href="#cores-menu-lateral"><i class="fa fa-caret-right"></i> Menu Lateral</a></li><? } ?>
                                                <? if(trim($_construtor_sysperm['layout_'.$mod.''])==1) { $aba_cores_faixa_superior = 1; ?><li onclick="seta_aba('cores-faixa-superior');" <? if($aba_admin==0&&$aba_site==0) { ?> class="active"<? } ?>><a data-toggle="tab" href="#cores-faixa-superior"><i class="fa fa-caret-right"></i> Faixa Superior</a></li><? } ?>
                                                <? if(trim($_construtor_sysperm['layout_'.$mod.''])==1) { $aba_cores_rodape = 1; ?><li onclick="seta_aba('cores-rodape');" <? if($aba_admin==0&&$aba_site==0) { ?> class="active"<? } ?>><a data-toggle="tab" href="#cores-rodape"><i class="fa fa-caret-right"></i> Rodapé</a></li><? } ?>
                                                <? if(trim($_construtor_sysperm['imagens_'.$mod.''])==1) { $aba_imagens = 1; ?><li onclick="seta_aba('imagens');" <? if($aba_admin==0&&$aba_site==0&&$aba_layout==0) { ?> class="active"<? } ?>><a data-toggle="tab" href="#imagens"><i class="fa fa-caret-right"></i> Imagens</a></li><? } ?>
                                                <? if(trim($_construtor_sysperm['mensagens_'.$mod.''])==1) { $aba_mensagens = 1; ?>
                                                <li onclick="seta_aba('mensagens');" <? if($aba_admin==0&&$aba_site==0&&$aba_layout==0&&$aba_imagens==0) { ?> class="active"<? } ?>><a data-toggle="tab" href="#mensagens"><i class="fa fa-caret-right"></i> Fale Conosco</a></li>
                                                <li onclick="seta_aba('report');" <? if($aba_admin==0&&$aba_site==0&&$aba_layout==0&&$aba_imagens==0) { ?> class="active"<? } ?>><a data-toggle="tab" href="#report"><i class="fa fa-caret-right"></i> Report de Erro</a></li>
												<? } ?>
                                                <? if(trim($_construtor_sysperm['seo_'.$mod.''])==1) { $aba_seo = 1; ?><li onclick="seta_aba('seo');" <? if($aba_admin==0&&$aba_site==0&&$aba_layout==0&&$aba_imagens==0&&$aba_mensagens==0) { ?> class="active"<? } ?>><a data-toggle="tab" href="#seo"><i class="fa fa-caret-right"></i> SEO</a></li><? } ?>
                                                <? if(trim($_construtor_sysperm['indexacao_'.$mod.''])==1) { $aba_indexacao = 1; ?><li onclick="seta_aba('indexacao');" <? if($aba_admin==0&&$aba_site==0&&$aba_layout==0&&$aba_imagens==0&&$aba_mensagens==0&&$aba_seo==0) { ?> class="active"<? } ?>><a data-toggle="tab" href="#indexacao"><i class="fa fa-caret-right"></i> Indexação</a></li><? } ?>
                                                <? if(trim($_construtor_sysperm['analytics_'.$mod.''])==1) { $aba_analytics = 1; ?><li onclick="seta_aba('analytics');" <? if($aba_admin==0&&$aba_site==0&&$aba_layout==0&&$aba_imagens==0&&$aba_mensagens==0&&$aba_seo==0&&$aba_indexacao==0) { ?> class="active"<? } ?>><a data-toggle="tab" href="#analytics"><i class="fa fa-caret-right"></i> Analytics</a></li><? } ?>
                                                <? if(trim($_construtor_sysperm['erro404_'.$mod.''])==1) { $aba_erro404 = 1; ?><li onclick="seta_aba('erro-404');" <? if($aba_admin==0&&$aba_site==0&&$aba_layout==0&&$aba_imagens==0&&$aba_mensagens==0&&$aba_seo==0&&$aba_indexacao==0&&$aba_analytics==0) { ?> class="active"<? } ?>><a data-toggle="tab" href="#erro-404"><i class="fa fa-caret-right"></i> ERRO 404</a></li><? } ?>
                                                <? if(trim($_construtor_sysperm['servidor_'.$mod.''])==1) { $aba_servidor = 1; ?><li onclick="seta_aba('servidor');" <? if($aba_admin==0&&$aba_site==0&&$aba_layout==0&&$aba_imagens==0&&$aba_mensagens==0&&$aba_seo==0&&$aba_indexacao==0&&$aba_analytics==0&&$aba_erro404==0) { ?> class="active"<? } ?>><a data-toggle="tab" href="#servidor"><i class="fa fa-caret-right"></i> Servidor</a></li><? } ?>
                                                <li onclick="seta_aba('gateway-cielo');"><a data-toggle="tab" href="#gateway-cielo"><i class="fa fa-caret-right"></i> Configurações Cielo</a></li>
                                                <li onclick="seta_aba('gateway-userede');"><a data-toggle="tab" href="#gateway-userede"><i class="fa fa-caret-right"></i> Configurações UseRede</a></li>
                                                <li onclick="seta_aba('gateway-pagarme');"><a data-toggle="tab" href="#gateway-pagarme"><i class="fa fa-caret-right"></i> Configurações Pagar.me</a></li>
                                                <li onclick="seta_aba('gateway-picpay');"><a data-toggle="tab" href="#gateway-picpay"><i class="fa fa-caret-right"></i> Configurações PicPay</a></li>
                                                <li onclick="seta_aba('gateway-safe2pay');"><a data-toggle="tab" href="#gateway-safe2pay"><i class="fa fa-caret-right"></i> Configurações Safe2Pay</a></li>
                                                <li onclick="seta_aba('outras-integracoes');"><a data-toggle="tab" href="#outras-integracoes"><i class="fa fa-caret-right"></i> Outras Integrações</a></li>
                                                <li onclick="seta_aba('configuracao-busca');"><a data-toggle="tab" href="#configuracao-busca"><i class="fa fa-caret-right"></i> Configurações de Busca</a></li>
                                            </ul>
                                        </div>

                                        <div class="col-md-10">
                                            <div class="portlet light bg-inverse form-fit">
                                            <div class="portlet-body form">
                                                <form name="forms" method="post" action="<?=$link?><?=$chave_url?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="formulario" class="form-horizontal form-bordered form-row-stripped">
                                                <div class="form-body">

                                                    <input type="hidden" name="aba" id="aba" value="admin" />
                                                    <input type="hidden" name="subMod" value="" />
                                                    <input type="hidden" name="acaoLocal" value="interno" />
                                                    <input type="hidden" name="acaoForm" value="add" />
                                                    <input type="hidden" name="modulo" value="<?=$mod?>" />

                                                    <div class="tab-content">
    
                                                        <? if(trim($_construtor_sysperm['admin_'.$mod.''])==1) { $aba_admin = 1; ?>
                                                        <div id="admin" class="tab-pane <? if($aba_admin==1) { ?>active<? } ?>" style="min-height:350px;">
                            
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Quando você entrar no administrativo, que página deve abrir ?</label>
                                                                <div class="col-md-10">
                                                                    <select name="modulo_abertura" id="modulo_abertura" class="form-control">
                                                                        <option value="">---</option>
                                                                        <?
                                                                        $qSqlMod = mysql_query("SELECT * FROM sysmod ORDER BY ordem");
                                                                        while($rSqlMod = mysql_fetch_array($qSqlMod)) {
                                                                            $url_mod = str_replace("_","-",$rSqlMod['bd']);
                                                                        ?>
                                                                        <option value="<?=$url_mod?>" <? if($row['modulo_abertura']==$url_mod) { echo "selected"; } ?>><?=$rSqlMod['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                    <p class="help-block">Altere sempre que desejar</p>
                                                                </div>
                                                            </div>
                                                            <!-- END modulo_abertura -->
                
                                                        </div>
                                                        <!-- END admin -->
                                                        <? } ?>

                                                        <? if(trim($_construtor_sysperm['site_'.$mod.''])==1) { $aba_site = 1; ?>
                                                        <div id="site" class="tab-pane <? if($aba_admin==0) { ?>active<? } ?>" style="min-height:350px;">
                            
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Layout Utilizado</label>
                                                                <div class="col-md-10">
                                                                    <select name="id_layout_layout" class="form-control">
                                                                        <option value="">---</option>
                                                                        <?
                                                                        $qSqlItem = mysql_query("SELECT * FROM _layout_layout ORDER BY titulo");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <option value="<?=$rSqlItem['id']?>" <? if($row['id_layout_layout']==$rSqlItem['id']) { echo "selected"; } ?>><?=$rSqlItem['titulo']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Nome do site</label>
                                                                <div class="col-md-4">
                                                                    <input class="form-control" value="<?=$row['nome']?>" name="nome" id="nome" type="text">
                                                                    <p class="help-block">Recomendamos colocar o nome completo da sua empresa</p>
                                                                </div>
                                                            </div>
                                                            <!-- END nome -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Aviso de Bloqueio de Edição ?</label>
                                                                <div class="col-md-10">
                                                                    <input type="checkbox" name="bloqueio_edicao" id="bloqueio_edicao" <? if(trim($row['bloqueio_edicao'])==1) { echo " checked"; } ?> class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NÃO&nbsp;&nbsp;">
                                                                    <p class="help-block">Quando habilitada, esta função não permite a edição de um mesmo conteúdo por outro usuário e exibe um aviso informativo</p>
                                                                </div>
                                                            </div>
                                                            <!-- END bloqueio_edicao -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Elastic nas consultas ?</label>
                                                                <div class="col-md-10">
                                                                    <input type="checkbox" name="elastic" id="elastic" <? if(trim($row['elastic'])==1) { echo " checked"; } ?> class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NÃO&nbsp;&nbsp;">
                                                                    <p class="help-block">Utiliza as tabelas do ElasticSearch</p>
                                                                </div>
                                                            </div>
                                                            <!-- END elastic -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Site em manutenção ?</label>
                                                                <div class="col-md-10">
                                                                    <input type="checkbox" name="manutencao" id="manutencao" <? if(trim($row['manutencao'])==1) { echo " checked"; } ?> class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NÃO&nbsp;&nbsp;">
                                                                    <p class="help-block">Substitui seu site por uma página indicando que ele está em manutenção</p>
                                                                </div>
                                                            </div>
                                                            <!-- END manutencao -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Mensagem quando o site estiver em manutenção</label>
                                                                <div class="col-md-10">
                                                                    <textarea class="form-control ckeditor" name="manutencao_msg" id="manutencao_msg" style="height:150px;"><?=$row['manutencao_msg']?></textarea>
                                                                </div>
                                                            </div>
                                                            <!-- END manutencao_msg -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Política de Privacidade</label>
                                                                <div class="col-md-10">
                                                                    <textarea class="form-control ckeditor" name="politica_de_privacidade" id="politica_de_privacidade" style="height:150px;"><?=$row['politica_de_privacidade']?></textarea>
                                                                </div>
                                                            </div>
                                                            <!-- END manutencao_msg -->

                                                        </div>
                                                        <!-- END site -->
                                                        <? } ?>
                                                        
                                                        <? if(trim($_construtor_sysperm['layout_'.$mod.''])==1) { $aba_layout = 1; ?>
                                                        <div id="tela-de-login" class="tab-pane <? if($aba_admin==0&&$aba_site==0) { ?>active<? } ?>" style="min-height:350px;">
                            
															<?
                                                            $qSqlItem = mysql_query("SELECT * FROM sysfonte ORDER BY nome");
                                                            while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                $novo_link = str_replace("@aspa_simples@","'",$rSqlItem['link']); 
                                                                $novo_link = str_replace("@aspa_dupla@","\"",$novo_link); 
                                                                $novo_link = str_replace("@html_link@","<",$novo_link); 
                                                                echo $novo_link;
                                                            }
                                                            ?>
                                                            <!--
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Cor do site</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="colorpicker-default form-control" name="cor1" value="<?=$row['cor1']?>"/>
                                                                    <p class="help-block">A cor escolhida afetara detalhes, link e o padrão de cor utilizado no site</p>
                                                                </div>
                                                            </div>
                                                            -->
                                                            <!-- END cor1 -->
                
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Imagem de Fundo Login</label>
                                                                <div class="col-md-10">
                
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                                            <? if(trim($row['imagem_login'])=="") { ?>
                                                                            <img src="<?=$link?>templates/<?=$layout_padrao_set?>/templates/img/dummy_150x150.gif" alt=""/>
                                                                            <? } else { ?>
                                                                            <img id="arquivo-atual-imagem_login" src="<?=$link?>files/<?=$mod?>/<?=$row['imagem_login']?>" alt="">
                                                                            <? } ?>
                                                                        </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>
            
                                                                        <? if(trim($row['imagem_login'])=="") { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Selecionar arquivo </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="imagem_login">
                                                                            </span>
                                                                            <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } else { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Alterar </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="imagem_login">
                                                                            </span>
                                                                            <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','imagem_login');" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } ?>
                                                                    </div>
                                                                    <div class="clearfix margin-top-10">
                                                                        <span class="label label-warning"> ATENÇÃO! </span>
                                                                        &nbsp;&nbsp;Pré-visualização da imagem só funciona nos seguintes navegadores: IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+.
                                                                    </div>
                
                                                                </div>
                                                            </div>
                                                            <!-- END imagem_login -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fundo</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="login_fundo" value="<?=$row['login_fundo']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END login_fundo -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fonte</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="login_fonte" value="<?=$row['login_fonte']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END login_fonte -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Link</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="login_link" value="<?=$row['login_link']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END login_link -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fundo do Box</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="login_fundo_box" value="<?=$row['login_fundo_box']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END login_fundo_box -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fonte do Título Box</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="login_titulo_box" value="<?=$row['login_titulo_box']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END login_titulo_box -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fonte do Box</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="login_fonte_box" value="<?=$row['login_fonte_box']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END login_fonte_box -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Link do Box</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="login_link_box" value="<?=$row['login_link_box']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END login_link_box -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Botão de Entrar/Enviar</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="login_botao_box" value="<?=$row['login_botao_box']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END login_botao_box -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fonte Botão de Entrar/Enviar</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="login_fonte_botao" value="<?=$row['login_fonte_botao']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END login_fonte_botao -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Botão de Esqueceu Senha</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="login_botao_esqueceu_senha" value="<?=$row['login_botao_esqueceu_senha']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END login_botao_esqueceu_senha -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fonte Botão de Esqueceu Senha</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="login_fonte_esqueceu_senha" value="<?=$row['login_fonte_esqueceu_senha']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END login_fonte_esqueceu_senha -->



                                                        </div>
                                                        <!-- END layout -->
                                                        <? } ?>

                                                        <? if(trim($_construtor_sysperm['layout_'.$mod.''])==1) { $aba_cores_menu_lateral = 1; ?>
                                                        <div id="cores-menu-lateral" class="tab-pane <? if($aba_admin==0&&$aba_site==0) { ?>active<? } ?>" style="min-height:350px;">

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fonte do Título</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_titulo" value="<?=$row['cor_titulo']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_fundo_menu -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fundo do Título</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_fundo_titulo" value="<?=$row['cor_fundo_titulo']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_fundo_menu -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Cor do Ícone</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_icone" value="<?=$row['cor_icone']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_fundo_menu -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fundo do Menu Lateral</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_fundo_menu" value="<?=$row['cor_fundo_menu']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_fundo_menu -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fundo do Menu Lateral Ativo</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_menu_active" value="<?=$row['cor_menu_active']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_menu_active -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">MouseOver do Menu Lateral</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_mouseover_menu" value="<?=$row['cor_mouseover_menu']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_mouseover_menu -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fonte do Menu Lateral</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_fonte_menu" value="<?=$row['cor_fonte_menu']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_fonte_menu -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Cor da Linha do Menu</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_linha_menu" value="<?=$row['cor_linha_menu']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_linha_menu -->


                                                        </div>
                                                        <!-- END layout -->
                                                        <? } ?>

                                                        <? if(trim($_construtor_sysperm['layout_'.$mod.''])==1) { $aba_cores_faixa_superior = 1; ?>
                                                        <div id="cores-faixa-superior" class="tab-pane <? if($aba_admin==0&&$aba_site==0) { ?>active<? } ?>" style="min-height:350px;">


                                                            
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fundo Logotipo do Menu Superior</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_fundo_logotipo" value="<?=$row['cor_fundo_logotipo']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_fundo_logotipo -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fundo do Menu Superior</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_fundo_menu_superior" value="<?=$row['cor_fundo_menu_superior']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_fundo_menu_superior -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fundo do Menu Superior Ativo</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_menu_superior_active" value="<?=$row['cor_menu_superior_active']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_menu_superior_active -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fonte do Menu Superior</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_fonte_menu_superior" value="<?=$row['cor_fonte_menu_superior']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_fonte_menu_superior -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fundo do SubMenu Superior</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_fundo_submenu_superior" value="<?=$row['cor_fundo_submenu_superior']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_fundo_submenu_superior -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fundo do SubMenu Superior Ativo</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_submenu_superior_active" value="<?=$row['cor_submenu_superior_active']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_submenu_superior_active -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fonte do SubMenu Superior</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_fonte_submenu_superior" value="<?=$row['cor_fonte_submenu_superior']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_fonte_submenu_superior -->

                                                        </div>
                                                        <!-- END layout -->
                                                        <? } ?>

                                                        <? if(trim($_construtor_sysperm['layout_'.$mod.''])==1) { $aba_cores_rodap = 1; ?>
                                                        <div id="cores-rodape" class="tab-pane <? if($aba_admin==0&&$aba_site==0) { ?>active<? } ?>" style="min-height:350px;">


                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fundo do Rodapé</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_fundo_rodape" value="<?=$row['cor_fundo_rodape']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_fundo_rodape -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fonte do Rodapé</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_fonte_rodape" value="<?=$row['cor_fonte_rodape']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_fonte_rodape -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Link do Rodapé</label>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="color_campo form-control" name="cor_link_rodape" value="<?=$row['cor_link_rodape']?>"/>
                                                                </div>
                                                            </div>
                                                            <!-- END cor_link_rodape -->


                                                        </div>
                                                        <!-- END layout -->
                                                        <? } ?>

                                                        <? if(trim($_construtor_sysperm['imagens_'.$mod.''])==1) { $aba_imagens = 1; ?>
                                                        <div id="imagens" class="tab-pane <? if($aba_admin==0&&$aba_site==0&&$aba_layout==0) { ?>active<? } ?>" style="min-height:350px;">
                            
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Logo do Site</label>
                                                                <div class="col-md-10">
                
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                                            <? if(trim($row['logotipo_site'])=="") { ?>
                                                                            <img src="<?=$link?>templates/<?=$layout_padrao_set?>/templates/img/dummy_150x150.gif" alt=""/>
                                                                            <? } else { ?>
                                                                            <img id="arquivo-atual-logotipo_site" src="<?=$link?>files/<?=$mod?>/<?=$row['logotipo_site']?>" alt="">
                                                                            <? } ?>
                                                                        </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>
            
                                                                        <? if(trim($row['logotipo_site'])=="") { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Selecionar arquivo </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="logotipo_site">
                                                                            </span>
                                                                            <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } else { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Alterar </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="logotipo_site">
                                                                            </span>
                                                                            <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','logotipo_site');" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } ?>
                                                                        <p class="help-block">Aparecerá em todas as páginas do site e na tela de login do administrativo</p>
                                                                    </div>
                                                                    <div class="clearfix margin-top-10">
                                                                        <span class="label label-warning"> ATENÇÃO! </span>
                                                                        &nbsp;&nbsp;Pré-visualização da imagem só funciona nos seguintes navegadores: IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+.
                                                                    </div>
                
                                                                </div>
                                                            </div>
                                                            <!-- END logotipo_site -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Logo do Administrativo</label>
                                                                <div class="col-md-10">
                
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                                            <? if(trim($row['logotipo'])=="") { ?>
                                                                            <img src="<?=$link?>templates/<?=$layout_padrao_set?>/templates/img/dummy_150x150.gif" alt=""/>
                                                                            <? } else { ?>
                                                                            <img id="arquivo-atual-logotipo" src="<?=$link?>files/<?=$mod?>/<?=$row['logotipo']?>" alt="">
                                                                            <? } ?>
                                                                        </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>
            
                                                                        <? if(trim($row['logotipo'])=="") { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Selecionar arquivo </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="logotipo">
                                                                            </span>
                                                                            <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } else { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Alterar </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="logotipo">
                                                                            </span>
                                                                            <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','logotipo');" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } ?>
                                                                        <p class="help-block">Aparecerá em todas as páginas do site e na tela de login do administrativo</p>
                                                                    </div>
                                                                    <div class="clearfix margin-top-10">
                                                                        <span class="label label-warning"> ATENÇÃO! </span>
                                                                        &nbsp;&nbsp;Pré-visualização da imagem só funciona nos seguintes navegadores: IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+.
                                                                    </div>
                
                                                                </div>
                                                            </div>
                                                            <!-- END logotipo -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Favicon</label>
                                                                <div class="col-md-10">
                
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                                            <? if(trim($row['favicon'])=="") { ?>
                                                                            <img src="<?=$link?>templates/<?=$layout_padrao_set?>/templates/img/dummy_150x150.gif" alt=""/>
                                                                            <? } else { ?>
                                                                            <img id="arquivo-atual-favicon" src="<?=$link?>files/<?=$mod?>/<?=$row['favicon']?>" alt="">
                                                                            <? } ?>
                                                                        </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>
            
                                                                        <? if(trim($row['favicon'])=="") { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Selecionar arquivo </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="favicon">
                                                                            </span>
                                                                            <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } else { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Alterar </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="favicon">
                                                                            </span>
                                                                            <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','favicon');" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } ?>
                                                                        <p class="help-block">Aparecerá na aba do navegador quando o site for acessado</p>
                                                                    </div>
                                                                    <div class="clearfix margin-top-10">
                                                                        <span class="label label-warning"> ATENÇÃO! </span>
                                                                        &nbsp;&nbsp;Pré-visualização da imagem só funciona nos seguintes navegadores: IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+.
                                                                    </div>
                
                                                                </div>
                                                            </div>
                                                            <!-- END favicon -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Imagem Padrão</label>
                                                                <div class="col-md-10">
                
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                                            <? if(trim($row['imagem_padrao'])=="") { ?>
                                                                            <img src="<?=$link?>templates/<?=$layout_padrao_set?>/templates/img/dummy_150x150.gif" alt=""/>
                                                                            <? } else { ?>
                                                                            <img id="arquivo-atual-imagem_padrao" src="<?=$link?>files/<?=$mod?>/<?=$row['imagem_padrao']?>" alt="">
                                                                            <? } ?>
                                                                        </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>
            
                                                                        <? if(trim($row['imagem_padrao'])=="") { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Selecionar arquivo </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="imagem_padrao">
                                                                            </span>
                                                                            <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } else { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Alterar </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="imagem_padrao">
                                                                            </span>
                                                                            <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','imagem_padrao');" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } ?>
                                                                        <p class="help-block">Aparecerá na aba do navegador quando o site for acessado</p>
                                                                    </div>
                                                                    <div class="clearfix margin-top-10">
                                                                        <span class="label label-warning"> ATENÇÃO! </span>
                                                                        &nbsp;&nbsp;Pré-visualização da imagem só funciona nos seguintes navegadores: IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+.
                                                                    </div>
                
                                                                </div>
                                                            </div>
                                                            <!-- END imagem_padrao -->
                
                                                        </div>
                                                        <!-- END imagens -->
                                                        <? } ?>
    
                                                        <? if(trim($_construtor_sysperm['mensagens_'.$mod.''])==1) { $aba_mensagens = 1; ?>
                                                        <div id="mensagens" class="tab-pane <? if($aba_admin==0&&$aba_site==0&&$aba_layout==0&&$aba_imagens==0) { ?>active<? } ?>" style="min-height:350px;">
                            
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Título do email</label>
                                                                <div class="col-md-4">
                                                                    <input class="form-control" value="<?=$row['email_title']?>" name="email_title" id="email_title" type="text">
                                                                    <p class="help-block">Este conteúdo será exibido como título do e-mail enviado de retorno automático</p>
                                                                </div>
                                                            </div>
                                                            <!-- END nome -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Encaminhar mensagens do site para o e-mail</label>
                                                                <div class="col-md-4">
                                                                    <input class="form-control" value="<?=$row['email']?>" name="email" id="email" type="text">
                                                                </div>
                                                            </div>
                                                            <!-- END nome -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Ímagem do topo</label>
                                                                <div class="col-md-10">
                
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                                            <? if(trim($row['email_imagem'])=="") { ?>
                                                                            <img src="<?=$link?>templates/<?=$layout_padrao_set?>/templates/img/dummy_150x150.gif" alt=""/>
                                                                            <? } else { ?>
                                                                            <img id="arquivo-atual-email_imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['email_imagem']?>" alt="">
                                                                            <? } ?>
                                                                        </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>
            
                                                                        <? if(trim($row['email_imagem'])=="") { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Selecionar arquivo </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="email_imagem">
                                                                            </span>
                                                                            <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } else { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Alterar </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="email_imagem">
                                                                            </span>
                                                                            <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','email_imagem');" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } ?>
                                                                        <p class="help-block">Aparecerá no topo dos e-mails que você receberá</p>
                                                                    </div>
                                                                    <div class="clearfix margin-top-10">
                                                                        <span class="label label-warning"> ATENÇÃO! </span>
                                                                        &nbsp;&nbsp;Pré-visualização da imagem só funciona nos seguintes navegadores: IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+.
                                                                    </div>
                
                                                                </div>
                                                            </div>
                                                            <!-- END email_imagem -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Texto</label>
                                                                <div class="col-md-10">
                                                                    <div class="row" style="margin-bottom:20px;">
                                                                        <div class="col-md-12">
                                                                            <button type="button" onclick="sysatalhotag_apenas_tag('{data_da_mensagem}','email_texto');" style="margin-right:10px;" class="btn default blue-stripe"> Data da mensagem </button>
                                                                            <button type="button" onclick="sysatalhotag_apenas_tag('{nome_remetente}','email_texto');" style="margin-right:10px;" class="btn default blue-stripe"> Nome do remetente </button>
                                                                            <button type="button" onclick="sysatalhotag_apenas_tag('{email_remetente}','email_texto');" style="margin-right:10px;" class="btn default blue-stripe"> E-mail do remetente </button>
                                                                            <button type="button" onclick="sysatalhotag_apenas_tag('{telefone_remetente}','email_texto');" style="margin-right:10px;" class="btn default blue-stripe"> Telefone do remetente </button>
                                                                            <button type="button" onclick="sysatalhotag_apenas_tag('{assunto}','email_texto');" style="margin-right:10px;" class="btn default blue-stripe"> Assunto da mensagem </button>
                                                                            <button type="button" onclick="sysatalhotag_apenas_tag('{mensagem_enviada}','email_texto');" style="margin-right:10px;" class="btn default blue-stripe"> Mensagem </button>
                                                                        </div>
                                                                    </div>
                                                                    <textarea class="form-control ckeditor" name="email_texto" id="email_texto" style="height:150px;"><?=$row['email_texto']?></textarea>
                                                                </div>
                                                            </div>
                                                            <!-- END manutencao_msg -->

                                                        </div>
                                                        <!-- END mensagens -->

                                                        <div id="report" class="tab-pane <? if($aba_admin==0&&$aba_site==0&&$aba_layout==0&&$aba_imagens==0) { ?>active<? } ?>" style="min-height:350px;">
                            
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Título do email</label>
                                                                <div class="col-md-4">
                                                                    <input class="form-control" value="<?=$row['report_title']?>" name="report_title" id="report_title" type="text">
                                                                    <p class="help-block">Este conteúdo será exibido como título do e-mail enviado de retorno automático</p>
                                                                </div>
                                                            </div>
                                                            <!-- END nome -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Encaminhar mensagens do site para o e-mail</label>
                                                                <div class="col-md-4">
                                                                    <input class="form-control" value="<?=$row['report']?>" name="report" id="report" type="text">
                                                                </div>
                                                            </div>
                                                            <!-- END nome -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Ímagem do topo</label>
                                                                <div class="col-md-10">
                
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                                            <? if(trim($row['report_imagem'])=="") { ?>
                                                                            <img src="<?=$link?>templates/<?=$layout_padrao_set?>/templates/img/dummy_150x150.gif" alt=""/>
                                                                            <? } else { ?>
                                                                            <img id="arquivo-atual-report_imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['report_imagem']?>" alt="">
                                                                            <? } ?>
                                                                        </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>
            
                                                                        <? if(trim($row['report_imagem'])=="") { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Selecionar arquivo </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="report_imagem">
                                                                            </span>
                                                                            <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } else { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Alterar </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="report_imagem">
                                                                            </span>
                                                                            <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','report_imagem');" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } ?>
                                                                        <p class="help-block">Aparecerá no topo dos e-mails que você receberá</p>
                                                                    </div>
                                                                    <div class="clearfix margin-top-10">
                                                                        <span class="label label-warning"> ATENÇÃO! </span>
                                                                        &nbsp;&nbsp;Pré-visualização da imagem só funciona nos seguintes navegadores: IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+.
                                                                    </div>
                
                                                                </div>
                                                            </div>
                                                            <!-- END report_imagem -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Texto</label>
                                                                <div class="col-md-10">
                                                                    <div class="row" style="margin-bottom:20px;">
                                                                        <div class="col-md-12">
                                                                            <button type="button" onclick="sysatalhotag_apenas_tag('{data_da_mensagem}','report_texto');" style="margin-right:10px;" class="btn default blue-stripe"> Data do report </button>
                                                                            <button type="button" onclick="sysatalhotag_apenas_tag('{titulo_report}','report_texto');" style="margin-right:10px;" class="btn default blue-stripe"> Título do report </button>
                                                                            <button type="button" onclick="sysatalhotag_apenas_tag('{url_report}','report_texto');" style="margin-right:10px;" class="btn default blue-stripe"> Link do report </button>
                                                                            <button type="button" onclick="sysatalhotag_apenas_tag('{nome_remetente}','report_texto');" style="margin-right:10px;" class="btn default blue-stripe"> Nome do remetente </button>
                                                                            <button type="button" onclick="sysatalhotag_apenas_tag('{report_remetente}','report_texto');" style="margin-right:10px;" class="btn default blue-stripe"> E-mail do remetente </button>
                                                                            <button type="button" onclick="sysatalhotag_apenas_tag('{mensagem_enviada}','report_texto');" style="margin-right:10px;" class="btn default blue-stripe"> Mensagem </button>
                                                                        </div>
                                                                    </div>
                                                                    <textarea class="form-control ckeditor" name="report_texto" id="report_texto" style="height:150px;"><?=$row['report_texto']?></textarea>
                                                                </div>
                                                            </div>
                                                            <!-- END manutencao_msg -->

                                                        </div>
                                                        <!-- END mensagens -->
                                                        <? } ?>

                                                        <? if(trim($_construtor_sysperm['seo_'.$mod.''])==1) { $aba_seo = 1; ?>
                                                        <div id="seo" class="tab-pane <? if($aba_admin==0&&$aba_site==0&&$aba_layout==0&&$aba_imagens==0&&$aba_mensagens==0) { ?>active<? } ?>" style="min-height:350px;">
                            
															<?
                                                            if(trim($row['title_seo'])=="") {
                                                                $titulo_seo_set = "Título"; 
                                                            } else {
                                                                $titulo_seo_set = $row['title_seo']; 
                                                            }
                
                                                            if(trim($row['url_amigavel'])=="") {
                                                                $url_amigavel_set = "".$link_site.""; 
                                                            } else {
                                                                $url_set = monta_url($mod,$row['id'],$link_site);
                                                                $url_amigavel_set = "".$url_set.""; 
                                                            }

															if(trim($row['texto_seo'])=="") {  
																$texto = "Se você não acrescentar nenhum texto, o Meta Description não será exibido"; 
																$tamanho_texto = 150; 
															} else {
																$texto = $row['texto_seo']; 
															}
                                                            ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Pré-visualização SEO</label>
                                                                <div class="col-md-10">
                                                                    <div style="float:left;width:100%;font-size:18px;color:#1e0fbe;text-decoration: none;padding:5px;" id="titulo_seo_google"><?=$titulo_seo_set?></div>
                                                                    <div style="float:left;width:100%;font-size:medium;color:#006621;padding:5px;" id="url_amigavel_google"><?=$url_amigavel_set?></div>
                                                                    <div style="float:left;width:100%;font-size:small;color:#444;margin-bottom:10px;padding:5px;" id="texto_seo_google"><?=$texto?></div>


                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Título do site</label>
                                                                <div class="col-md-4">
                                                                    <input class="form-control" value="<?=$row['title_seo']?>" name="title_seo" id="title_seo"  onkeyup="cria_seo_titulo_e_url('title_seo','titulo_seo_google','','','Título','titulo_seo_contador','55','-1');" type="text">
                                                                    <p class="help-block">Este conteúdo será exibido como título do site na aba do navegador e também para informações de SEO</p>
                                                                </div>
                                                            </div>
                                                            <!-- END nome -->

															<?
                                                            if(trim($row['texto_seo'])=="") {  
                                                                $tamanho_texto_seo = 150; 
                                                            } else {
                                                                $tamanho_texto_seo = 150 - strlen($row['texto_seo']); 
                                                            }
                                                            ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2 req">Texto (Meta-Description)</label>
                                                                <div class="col-md-10">
                                                                    <textarea class="form-control" name="texto_seo" id="texto_seo" onkeyup="controle_meta_description('texto_seo','texto_seo_google','texto_seo_contador','<?=$texto?>','150','0');" style="height:150px;"><?=$row['texto_seo']?></textarea>
                                                                    <p class="hel-block">Se a meta-description estiver vazia, os robôs dos sites de busca varrerão o conteúdo  <span style="color:#090;" id="texto_seo_contador"><?=$tamanho_texto?></span></p>
                                                                </div>
                                                            </div>
                                                            <!-- END texto_seo -->

															<?
                                                            if(trim($row['palavras_chave'])=="") {  
                                                                $tamanho_palavras_chave = 150; 
                                                            } else {
                                                                $tamanho_palavras_chave = 150 - strlen($row['palavras_chave']); 
                                                            }
                                                            ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2 req">Palavras Chave</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row['palavras_chave']?>" name="palavras_chave" id="TI_palavras_chave" type="text">
                                                                </div>
                                                            </div>
                                                            <!-- END palavras_chave -->

                                                        </div>
                                                        <!-- END seo -->
                                                        <? } ?>

                                                        <? if(trim($_construtor_sysperm['indexacao_'.$mod.''])==1) { $aba_indexacao = 1; ?>
                                                        <div id="indexacao" class="tab-pane <? if($aba_admin==0&&$aba_site==0&&$aba_layout==0&&$aba_imagens==0&&$aba_mensagens==0&&$aba_seo==0) { ?>active<? } ?>" style="min-height:350px;">
                            
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Este site deve ser indexado pelos mecanismos de busca ?</label>
                                                                <div class="col-md-10">
                                                                    <input type="checkbox" name="busca" id="busca" <? if(trim($row['busca'])==1) { echo " checked"; } ?> class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NÃO&nbsp;&nbsp;">
                                                                    <p class="help-block">Cabe aos mecanismos de busca atender seu pedido</p>
                                                                </div>
                                                            </div>
                                                            <!-- END busca -->

                                                        </div>
                                                        <!-- END indexacao -->
                                                        <? } ?>

                                                        <? if(trim($_construtor_sysperm['analytics_'.$mod.''])==1) { $aba_analytics = 1; ?>
                                                        <div id="analytics" class="tab-pane <? if($aba_admin==0&&$aba_site==0&&$aba_layout==0&&$aba_imagens==0&&$aba_mensagens==0&&$aba_seo==0&&$aba_indexacao==0) { ?>active<? } ?>" style="min-height:350px;">
                            
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Google Analytics ID (Tracking ID)</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row['id_google']?>" name="id_google" id="id_google" type="text">
                                                                    <p class="help-block">O ID será algo como segue o exemplo: UA-58204629-1</p>
                                                                </div>
                                                            </div>
                                                            <!-- END id_google -->

                                                        </div>
                                                        <!-- END analytics -->
                                                        <? } ?>

                                                        <? if(trim($_construtor_sysperm['erro404_'.$mod.''])==1) { $aba_erro404 = 1; ?>
                                                        <div id="erro-404" class="tab-pane <? if($aba_admin==0&&$aba_site==0&&$aba_layout==0&&$aba_imagens==0&&$aba_mensagens==0&&$aba_seo==0&&$aba_indexacao==0&&$aba_analytics==0) { ?>active<? } ?>" style="min-height:350px;">
                            
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Título da página</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row['erro404_titulo']?>" name="erro404_titulo" id="erro404_titulo" type="text">
                                                                </div>
                                                            </div>
                                                            <!-- END erro404_titulo -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Texto</label>
                                                                <div class="col-md-10">
                                                                    <textarea class="form-control ckeditor" name="erro404_msg" id="erro404_msg" style="height:150px;"><?=$row['erro404_msg']?></textarea>
                                                                </div>
                                                            </div>
                                                            <!-- END manutencao_msg -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Ímagem de Cabeçalho</label>
                                                                <div class="col-md-10">
                
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                                            <? if(trim($row['erro404_imagem'])=="") { ?>
                                                                            <img src="<?=$link?>templates/<?=$layout_padrao_set?>/templates/img/dummy_150x150.gif" alt=""/>
                                                                            <? } else { ?>
                                                                            <img id="arquivo-atual-erro404_imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['erro404_imagem']?>" alt="">
                                                                            <? } ?>
                                                                        </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>
            
                                                                        <? if(trim($row['erro404_imagem'])=="") { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Selecionar arquivo </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="erro404_imagem">
                                                                            </span>
                                                                            <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } else { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Alterar </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="erro404_imagem">
                                                                            </span>
                                                                            <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','erro404_imagem');" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } ?>
                                                                        <p class="help-block">Aparecerá no topo dos e-mails que você receberá</p>
                                                                    </div>
                                                                    <div class="clearfix margin-top-10">
                                                                        <span class="label label-warning"> ATENÇÃO! </span>
                                                                        &nbsp;&nbsp;Pré-visualização da imagem só funciona nos seguintes navegadores: IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+.
                                                                    </div>
                
                                                                </div>
                                                            </div>
                                                            <!-- END erro404_imagem -->

                                                        </div>
                                                        <!-- END erro404 -->
                                                        <? } ?>

                                                        <? if(trim($_construtor_sysperm['servidor_'.$mod.''])==1) { $aba_servidor = 1; ?>
                                                        <div id="servidor" class="tab-pane <? if($aba_admin==0&&$aba_site==0&&$aba_layout==0&&$aba_imagens==0&&$aba_mensagens==0&&$aba_seo==0&&$aba_indexacao==0&&$aba_analytics==0&&$aba_erro404==0) { ?>active<? } ?>" style="min-height:350px;">
                            
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">URL Site</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row['url_site_2']?>" name="url_site_2" id="url_site_2" type="text">
                                                                    <p class="help-block">http://www.dominio.com.br/</p>
                                                                </div>
                                                            </div>
                                                            <!-- END url_site_2 -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">URL Administrativo</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row['url_admin_2']?>" name="url_admin_2" id="url_admin_2" type="text">
                                                                    <p class="help-block">http://www.dominio.com.br/admin/</p>
                                                                </div>
                                                            </div>
                                                            <!-- END url_admin_2 -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Host FTP</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row['ftp_host']?>" name="ftp_host" id="ftp_host" type="text">
                                                                    <p class="help-block">ftp.dominio.com.br</p>
                                                                </div>
                                                            </div>
                                                            <!-- END ftp_host -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Usuário FTP</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row['ftp_user']?>" name="ftp_user" id="ftp_user" type="text">
                                                                    <p class="help-block">nome_do_usuario</p>
                                                                </div>
                                                            </div>
                                                            <!-- END ftp_user -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Senha FTP</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row['ftp_pass']?>" name="ftp_pass" id="ftp_pass" type="text">
                                                                </div>
                                                            </div>
                                                            <!-- END ftp_pass -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Raiz do FTP</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row['ftp_root']?>" name="ftp_root" id="ftp_root" type="text">
                                                                    <p class="help-block">ftp.dominio.com.br</p>
                                                                </div>
                                                            </div>
                                                            <!-- END ftp_root -->
                
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Barra do Fórum ?</label>
                                                                <div class="col-md-10">
                                                                    <input type="checkbox" name="barra_forum" id="barra_forum" <? if(trim($row['barra_forum'])==1) { echo " checked"; } ?> class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NÃO&nbsp;&nbsp;">
                                                                    <p class="help-block">Substitui seu site por uma página indicando que ele está em manutenção</p>
                                                                </div>
                                                            </div>
                                                            <!-- END barra_forum -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Memcache para o conteúdo ?</label>
                                                                <div class="col-md-10">
                                                                    <input type="checkbox" name="memcache_conteudo" id="memcache_conteudo" <? if(trim($row['memcache_conteudo'])==1) { echo " checked"; } ?> class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NÃO&nbsp;&nbsp;">
                                                                    <p class="help-block">Substitui seu site por uma página indicando que ele está em manutenção</p>
                                                                </div>
                                                            </div>
                                                            <!-- END memcache_conteudo -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Memcache para as consultas SQL ?</label>
                                                                <div class="col-md-10">
                                                                    <input type="checkbox" name="memcache_query" id="memcache_query" <? if(trim($row['memcache_query'])==1) { echo " checked"; } ?> class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NÃO&nbsp;&nbsp;">
                                                                    <p class="help-block">Substitui seu site por uma página indicando que ele está em manutenção</p>
                                                                </div>
                                                            </div>
                                                            <!-- END memcache_query -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Contador de leitores ao conteúdo ?</label>
                                                                <div class="col-md-10">
                                                                    <input type="checkbox" name="contador_conteudo" id="contador_conteudo" <? if(trim($row['contador_conteudo'])==1) { echo " checked"; } ?> class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NÃO&nbsp;&nbsp;">
                                                                    <p class="help-block">Substitui seu site por uma página indicando que ele está em manutenção</p>
                                                                </div>
                                                            </div>
                                                            <!-- END contador_conteudo -->

                                                            <!--
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Contador em Tempo Real para Home do site ?</label>
                                                                <div class="col-md-10">
                                                                    <input type="checkbox" name="contador_home" id="contador_home" <? if(trim($row['contador_home'])==1) { echo " checked"; } ?> class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NÃO&nbsp;&nbsp;">
                                                                    <p class="help-block">Substitui seu site por uma página indicando que ele está em manutenção</p>
                                                                </div>
                                                            </div>
                                                            -->
                                                            <!-- END contador_home -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Contador em Tempo Real (OnLine) ?</label>
                                                                <div class="col-md-10">
                                                                    <input type="checkbox" name="contador_online" id="contador_online" <? if(trim($row['contador_online'])==1) { echo " checked"; } ?> class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NÃO&nbsp;&nbsp;">
                                                                    <p class="help-block">Substitui seu site por uma página indicando que ele está em manutenção</p>
                                                                </div>
                                                            </div>
                                                            <!-- END contador_online -->


                                                        </div>
                                                        <!-- END servidor -->
                                                        <? } ?>

                                                        <div id="configuracao-busca" class="tab-pane" style="min-height:350px;">

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Toda busca do site habilitada?</label>
                                                                <div class="col-md-10">
                                                                    <input type="checkbox" name="busca_completa" id="busca_completa" <? if(trim($row['busca_completa'])==1) { echo " checked"; } ?> class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NÃO&nbsp;&nbsp;">
                                                                    <p class="help-block">Essa opção habilita ou desabilita todas as buscas existentes no site</p>
                                                                </div>
                                                            </div>
                                                            <!-- END busca_completa -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Busca em seções ?</label>
                                                                <div class="col-md-10">
                                                                    <input type="checkbox" name="busca_secao" id="busca_secao" <? if(trim($row['busca_secao'])==1) { echo " checked"; } ?> class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NÃO&nbsp;&nbsp;">
                                                                    <p class="help-block">Essa opção habilita ou desabilita a busca nas Seções do sistema</p>
                                                                </div>
                                                            </div>
                                                            <!-- END busca_secao -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Busca nos tipos de conteúdo ?</label>
                                                                <div class="col-md-10">
                                                                    <input type="checkbox" name="busca_tipo" id="busca_tipo" <? if(trim($row['busca_tipo'])==1) { echo " checked"; } ?> class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NÃO&nbsp;&nbsp;">
                                                                    <p class="help-block">Essa opção habilita ou desabilita a busca nos Tipos de conteúdo. Ex.: Notícias, Vídeos e etc.</p>
                                                                </div>
                                                            </div>
                                                            <!-- END busca_tipo -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Busca por período  ?</label>
                                                                <div class="col-md-10">
                                                                    <input type="checkbox" name="busca_periodo" id="busca_periodo" <? if(trim($row['busca_periodo'])==1) { echo " checked"; } ?> class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NÃO&nbsp;&nbsp;">
                                                                    <p class="help-block">Essa opção habilita ou desabilita a busca por período de data</p>
                                                                </div>
                                                            </div>
                                                            <!-- END busca_periodo -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Busca nos títulos e textos do conteúdo ?</label>
                                                                <div class="col-md-10">
                                                                    <input type="checkbox" name="busca_conteudo" id="busca_conteudo" <? if(trim($row['busca_conteudo'])==1) { echo " checked"; } ?> class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NÃO&nbsp;&nbsp;">
                                                                    <p class="help-block">Essa opção habilita ou desabilita a busca nos Títulos e Texto dos conteúdos</p>
                                                                </div>
                                                            </div>
                                                            <!-- END busca_conteudo -->

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Busca nas palavras-chave ?</label>
                                                                <div class="col-md-10">
                                                                    <input type="checkbox" name="busca_palavras_chave" id="busca_palavras_chave" <? if(trim($row['busca_palavras_chave'])==1) { echo " checked"; } ?> class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;NÃO&nbsp;&nbsp;">
                                                                    <p class="help-block">Essa opção habilita ou desabilita a busca nas Palavras-chave do conteúdo</p>
                                                                </div>
                                                            </div>
                                                            <!-- END busca_palavras_chave -->

                                                        </div>
                                                        <!-- END busca-->

                                                        <div id="gateway-cielo" class="tab-pane" style="min-height:350px;">
                            
															<? $nome_campo = "cielo_ambiente"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Tipo de Ambiente Ativo</label>
                                                                <div class="col-md-10">
                                                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                                                        <option value="">INATIVO</option>
                                                                        <option value="producao" <? if($row[''.$nome_campo.'']=='producao') { echo "selected"; } ?>>PRODUÇÃO</option>
                                                                        <option value="sandbox" <? if($row[''.$nome_campo.'']=='sandbox') { echo "selected"; } ?>>SANDBOX</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <h3 style="padding:10px;">Cielo PRODUÇÃO</h3>

                                                            <? $nome_campo = "cielo_url"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">API Url</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "cielo_merchantid"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Merchant ID</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "cielo_merchantkey"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Merchant Key</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <h3 style="padding:10px;">Cielo SANDBOX</h3>

                                                            <? $nome_campo = "sandbox_cielo_url"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">API Url</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "sandbox_cielo_merchantid"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Merchant ID</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "sandbox_cielo_merchantkey"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Merchant Key</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>



                                                        </div>
                                                        <!-- END gateway-cielo -->

                                                        <div id="gateway-userede" class="tab-pane" style="min-height:350px;">
                            
															<? $nome_campo = "userede_ambiente"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Tipo de Ambiente Ativo</label>
                                                                <div class="col-md-10">
                                                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                                                        <option value="">INATIVO</option>
                                                                        <option value="producao" <? if($row[''.$nome_campo.'']=='producao') { echo "selected"; } ?>>PRODUÇÃO</option>
                                                                        <option value="sandbox" <? if($row[''.$nome_campo.'']=='sandbox') { echo "selected"; } ?>>SANDBOX</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <h3 style="padding:10px;">UseRede PRODUÇÃO</h3>

                                                            <? $nome_campo = "userede_url"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">API Url</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "userede_pv"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">PV</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "userede_token"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">API Url</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <h3 style="padding:10px;">UseRede SANDBOX</h3>

                                                            <? $nome_campo = "sandbox_userede_url"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">API Url</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "sandbox_userede_pv"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">PV</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "sandbox_userede_token"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">API Url</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- END gateway-userede -->

                                                        <div id="gateway-pagarme" class="tab-pane" style="min-height:350px;">
                            
															<? $nome_campo = "pagarme_ambiente"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Tipo de Ambiente Ativo</label>
                                                                <div class="col-md-10">
                                                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                                                        <option value="">INATIVO</option>
                                                                        <option value="producao" <? if($row[''.$nome_campo.'']=='producao') { echo "selected"; } ?>>PRODUÇÃO</option>
                                                                        <option value="sandbox" <? if($row[''.$nome_campo.'']=='sandbox') { echo "selected"; } ?>>SANDBOX</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <h3 style="padding:10px;">Pagar.me PRODUÇÃO</h3>

                                                            <? $nome_campo = "pagarme_url"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">API Url</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "pagarme_apikey"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">API Key</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "pagarme_criptografia"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Criptografia</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <h3 style="padding:10px;">Pagar.me SANDBOX</h3>

                                                            <? $nome_campo = "sandbox_pagarme_url"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">API Url</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "sandbox_pagarme_apikey"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">API Key</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "sandbox_pagarme_criptografia"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Criptografia</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- END gateway-pagarme -->

                                                        <div id="gateway-picpay" class="tab-pane" style="min-height:350px;">
                            
															<? $nome_campo = "picpay_ambiente"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Tipo de Ambiente</label>
                                                                <div class="col-md-10">
                                                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                                                        <option value="">INATIVO</option>
                                                                        <option value="producao" <? if($row[''.$nome_campo.'']=='producao') { echo "selected"; } ?>>ATIVO</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "picpay_url"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">API Url</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "picpay_token"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Token</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "picpay_seller_token"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Token Seller</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <!-- END gateway-picpay -->

                                                        <div id="gateway-safe2pay" class="tab-pane" style="min-height:350px;">
                            
															<? $nome_campo = "safe2pay_ambiente"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Tipo de Ambiente Ativo</label>
                                                                <div class="col-md-10">
                                                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                                                        <option value="">INATIVO</option>
                                                                        <option value="producao" <? if($row[''.$nome_campo.'']=='producao') { echo "selected"; } ?>>PRODUÇÃO</option>
                                                                        <option value="sandbox" <? if($row[''.$nome_campo.'']=='sandbox') { echo "selected"; } ?>>SANDBOX</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <h3 style="padding:10px;">Safe2Pay PRODUÇÃO</h3>

                                                            <? $nome_campo = "safe2pay_url"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">API Url</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "safe2pay_token"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Token</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "safe2pay_secretkey"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Secret Key</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <h3 style="padding:10px;">Safe2Pay SANDBOX</h3>

                                                            <? $nome_campo = "sandbox_safe2pay_url"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">API Url</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "sandbox_safe2pay_token"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Token</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "sandbox_safe2pay_secretkey"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Secret Key</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- END gateway-safe2pay -->

                                                        <div id="outras-integracoes" class="tab-pane" style="min-height:350px;">
                            
                                                            <? $nome_campo = "google_api_key"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Google API Key</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "token_rdstation"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Token RDStation</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "bitly"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Token Bitly</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <h3 style="padding:10px;">CloudFlare</h3>

                                                            <? $nome_campo = "cloudflare_email"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">E-mail</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "cloudflare_account_id"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Account ID</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "cloudflare_global_apikey"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Global API Key</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                            <? $nome_campo = "cloudflare_origin_cakey"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Origin CA Key</label>
                                                                <div class="col-md-10">
                                                                    <input class="form-control" value="<?=$row[''.$nome_campo.'']?>" name="<?=$nome_campo?>" id="<?=$nome_campo?>" type="text">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- END outras-integracoes -->
                                                    </div>
    
                                                </div>
                                                <!-- END form-body -->
    
                                                <div class="form-actions" style="border:0px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" style="margin-left:20px;" class="btn green-turquoise"><i class="fa fa-floppy-o"></i> Salvar</button>
                                                            <button type="button" id="btn_cancelar" class="btn yellow-casablanca btn-cancelar"><i class="fa fa-minus-circle"></i> Cancelar</button>
                                                        </div>
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

					var handleTag = function () {
						if (!jQuery().tagsInput) {
							return;
						}
						$('#TI_palavras_chave').tagsInput({
							defaultText: " ",
							width: 'auto',
							'onAddTag': function () {
								//alert(1);
							},
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
				
					return {
						//main function to initiate the module
						init: function () {            

							handle_COR();
							handleTag();
							handleColorPicker();

						}
					};
				}();  

                </script>





