                                                                <?
                                                                $modGet = "sysmidia";
                                                                $numeroUnico_modulo_catGet = "";
                                                                $numeroUnico_moduloGet = "";
                                                                $numeroUnico_paiGet = $numeroUnicoGerado;
                                                                ?>
                                                                <div class="form-group">
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
                                                
                                                                            <a class="divider" style="border-left:1px solid #F7CA18;padding-bottom: 0px;padding-top:0px;margin-left:10px;margin-right:10px;"></a>
                                                
                                                                            <a onclick="_construtor_template_reordenar_nome('<?=$modGet?>','<?=$numeroUnico_modulo_catGet?>','<?=$numeroUnico_moduloGet?>','<?=$numeroUnico_paiGet?>');" class="btn default blue-stripe"><i class="fa fa-sort-alpha-asc"></i>&nbsp;&nbsp;Reordenar alfabeticamente</a>
                                                                            <!--
                                                                            <a id="btn-finalizar-upload" onclick="_construtor_template_refresh_iframes_out('<?=$modGet?>','<?=$numeroUnico_modulo_catGet?>','<?=$numeroUnico_moduloGet?>','<?=$numeroUnico_paiGet?>');" class="btn default blue-stripe disabled"><i class="fa fa-upload"></i>&nbsp;&nbsp;Finalizar Upload</a>
    
                                                                            <a class="divider" style="border-left:1px solid #F7CA18;padding-bottom: 0px;padding-top:0px;margin-left:10px;margin-right:10px;"></a>
                                                                            -->
                                                
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
    
                                                                            <!--
                                                                            <a onclick="sysmidia_muda_ordem_out('menos','<?=$modGet?>','<?=$numeroUnico_modulo_catGet?>','<?=$numeroUnico_moduloGet?>','<?=$numeroUnico_paiGet?>');" class="btn default purple"><i class="fa fa-arrow-left"></i></a>
                                                                            <a href="javascript:void(0);">&nbsp;Organizar a ordem&nbsp;</a>
                                                                            <a onclick="sysmidia_muda_ordem_out('mais','<?=$modGet?>','<?=$numeroUnico_modulo_catGet?>','<?=$numeroUnico_moduloGet?>','<?=$numeroUnico_paiGet?>');" class="btn default purple"><i class="fa fa-arrow-right"></i></a>
    
                                                                            <a onclick="NOVO_sysmidia_muda_ordem_out('menos','<?=$modGet?>','<?=$numeroUnico_modulo_catGet?>','<?=$numeroUnico_moduloGet?>','<?=$numeroUnico_paiGet?>');" class="btn default purple"><i class="fa fa-arrow-left"></i></a>
                                                                            <a href="javascript:void(0);">&nbsp;Organizar ordem&nbsp;</a>
                                                                            <a onclick="NOVO_sysmidia_muda_ordem_out('mais','<?=$modGet?>','<?=$numeroUnico_modulo_catGet?>','<?=$numeroUnico_moduloGet?>','<?=$numeroUnico_paiGet?>');" class="btn default purple"><i class="fa fa-arrow-right"></i></a>
                                                                            <a onclick="NOVO_sysmidia_salva_ordem('<?=$modGet?>','<?=$numeroUnico_modulo_catGet?>','<?=$numeroUnico_moduloGet?>','<?=$numeroUnico_paiGet?>');" id="btn_salvar_nova_ordenacao" style="display:none;" href="javascript:void(0);" class="btn default red"><i class="fa fa-save"></i>&nbsp;SALVAR NOVA ORDENAÇÃO&nbsp;</a>
                                                                            -->
    
                                                                        </div>
                                                                        
                                                                        <div id="DIV_dropzone" class="col-md-12" style="margin-top:10px;padding-left:25px;padding-right:25px;">
                                                                            <form action="http://www.pasang.com.br/admin/templates/<?=$layout_padrao_set?>/acoes/sysmidia/_construtor_template-arquivo-drop.php?idsysusuS=<?=$sysusu['id']?>&modS=<?=$modGet?>&idpaiS=<?=$idpaiGet?>&numeroUnico_paiS=<?=$numeroUnico_paiGet?>&numeroUnico_modulo_catS=<?=$numeroUnico_modulo_catGet?>&numeroUnico_moduloS=<?=$numeroUnico_moduloGet?>" class="dropzone" id="my-dropzone" target="acoes_hidden" ENCTYPE="multipart/form-data">
                                                                            <? 
                                                                            include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."templates/metronic/acoes/sysmidia/_construtor_template-dropzone-out.php"); 
                                                                            ?>
                                                                            </form>
                                                                        </div>
    
                                                                        <div id="DIV_pasta" class="col-md-12" style="margin-top:10px;padding-left:25px;padding-right:25px;">
                                                                            <? 
                                                                            include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."templates/metronic/acoes/sysmidia/_construtor_template-pasta-out.php"); 
                                                                            ?>
                                                                        </div>
                                                                    </div>
        
                                                                </div>
                                                                </div>
                                                                
