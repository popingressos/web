        <!-- main content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span2">
                        <div class="sidebar">
                        	<? include("./templates/".$layout_padrao_set."/acoes/sysgeral/menu-sistema.php"); ?>
                        </div>
                    </div>
                    <div class="span10">
                        <div class="w-box">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="tabbable tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a data-toggle="tab" href="#tb1_a">Editando <?=$row['nome']?></a></li>
                                                <li><a data-toggle="tab" href="#tb1_b">Lista de Itens</a></li>
                                                <li><a data-toggle="tab" href="#tb1_c">Adicionar Novo</a></li>
                                            </ul>
											<script>
                                            $(document).ready(function() {
                                                //* form validation
                                                forms.simple();
            
                                                //* datatables
                                                beoro_datatables.basic();
                                                $('.dataTables_filter input').each(function() {
                                                    $(this).attr("placeholder", "Digite sua busca aqui");
                                                })
			
												beoro_select_row.init();
            
                                                //* masked inputs
                                                beoro_maskedInputs.init();
                                            });
            
                                            //* form validation
                                            forms = {
                                                simple: function() {
                                                    if($('#forms').length) {
                                                        $('#forms').validate({
                                                            onkeyup: false,
                                                            errorClass: 'error',
                                                            validClass: 'valid',
                                                            highlight: function(element) {
                                                                $(element).closest('div').addClass("f-error");
                                                            },
                                                            unhighlight: function(element) {
                                                                $(element).closest('div').removeClass("f-error");
                                                            },
                                                            errorPlacement: function(error, element) {
                                                                $(element).closest('div').append(error);
                                                            },
                                                            rules: {
                                                                nome: { required: true },
                                                                email: { required: true },
                                                                senha: { required: true },
                                                                stat: { required: true },
                                                            },
                                                            invalidHandler: function(form, validator) {
                                                                // callback
                                                            }
                                                        })
                                                    }
                                                }
                                            };
                                            
											//* select all rows
											beoro_select_row = {
												init: function() {
													$('.select_msgs').click(function () {
														var tableid = $(this).data('tableid');
														$('#'+tableid).find('input[class=select_msg]').attr('checked', this.checked);
													});
												}
											};
                                            
                                            //* datatables
                                            beoro_datatables = {
                                                //* column reorder & toggle visibility
                                                basic: function() {
                                                    if($('#dt_basic').length) {
                                                        $('#dt_basic').dataTable({
                                                            "sPaginationType": "bootstrap_full",
															"aoColumns": [
																{ "bSortable": false },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "sType": "string" },
																{ "bSortable": false }
															]
                                                        });
                                                    }
                                                }
                                            };

                                            </script>
                                            <div class="tab-content">
                                                <div id="tb1_a" class="tab-pane active">
                                                    <div>
                                                        <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                            <input type="hidden" name="acaoLocal" value="interno" />
                                                            <input type="hidden" name="acaoForm" value="editar" />
                                                            <input type="hidden" name="modulo" value="sysfonte" />
                                                            <input type="hidden" name="iditem" value="<?=$_REQUEST['var4']?>" />
                
                                                            <? 
                                                            $numeroUnicoGerado = $row['numeroUnico']; 
                                                            ?>
                                                            <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
                
            
                                                            <div class="formSep">
                                                                <div style="float:left;margin-right:10px;">
                                                                    <label class="req">Nome</label>
                                                                    <input value="<?=$row['nome']?>" style="width:350px;" type="text" name="nome" id="nome" />
                                                                    <span class="help-block">Apens um nome para referência dentro do sistema</span>
                                                                </div>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <label class="req">Link</label>
                                                                <input value="<?=$row['link']?>" class="span7" type="text" name="link" id="link" />
                                                                <span class="help-block">Copiar o link fornecido pelo Google Web Fonts ou pela ferramenta de fornecimento da WebFont</span>
                                                            </div>
                
                                                            <div class="formSep">
                                                                <label>Font-Family</label>
                                                                <input value="<?=$row['family']?>" class="span5" type="text" name="family" id="family" />
                                                                <span class="help-block">Colar aqui o conteúdo destacado em negrito como no exemplo:  <b>font-family:'Francois One', sans-serif;</b></span>
                                                            </div>
                    
                                                            <div class="formSep">
                                                                <label class="req">Ativo ?</label>
                                                                <label class="radio" style="color:#C00;">
                                                                    <input type="radio" name="stat" id="stat1" value="0" <? if($row['stat']==0) { echo "checked"; } ?> >
                                                                    não
                                                                </label>
                                                                <label class="radio" style="color:#390;">
                                                                    <input type="radio" name="stat" id="stat2" value="1" <? if($row['stat']==1) { echo "checked"; } ?> >
                                                                    sim
                                                                </label>
                                                            </div>	
                                                            
                                                            <div class="formSep">
                                                                <? if(trim($sysperm['editar_sysusu'])==1) { ?>
                                                                <button type="submit" class="btn btn-success">Salvar</button>
                                                                <? } ?>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div id="tb1_b" class="tab-pane">
                                                    <div class="w-box w-box">
                                                        <div class="w-box-header">
                                                            <div class="pull-left">
                                                                <div class="toggle-group">
                                                                    <span data-toggle="dropdown" class="dropdown-toggle">Ações <span class="caret"></span></span>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="javascript:void(0);" onclick="acao_selecionados('excluir');"><img style="margin-left:-15px;margin-top:-2px;" src="<?=$link?>templates/<?=$layout_padrao_set?>/template/img/icones_novos/16/remover-x.png" />&nbsp;Remover</a></li>
                                                                        <li><a href="javascript:void(0);" onclick="acao_selecionados('publicar');"><img style="margin-left:-15px;margin-top:-2px;" src="<?=$link?>templates/<?=$layout_padrao_set?>/template/img/icones_novos/16/stat-1.png" />&nbsp;Publicar</a></li>
                                                                        <li><a href="javascript:void(0);" onclick="acao_selecionados('despublicar');"><img style="margin-left:-15px;margin-top:-2px;" src="<?=$link?>templates/<?=$layout_padrao_set?>/template/img/icones_novos/16/stat-0.png" />&nbsp;Despublicar</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="w-box-content">
                                                            <form name="list" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" method="post" target="_self">
                                                            <input type="hidden" name="acaoForm" id="acaoForm_lista" value="" />
                                                            <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                            <table id="dt_basic" class="table table-striped table-condensed">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:20px;" class="table_checkbox"><input type="checkbox" name="select_msgs" class="select_msgs ptip_se" title="Selecionar todos" data-tableid="dt_basic" /></th>
                                                                    <th>Nome</th>
                                                                    <th>Link</th>
                                                                    <th>Font Family</th>
                                                                    <th style="width:90px;">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                $qSql = mysql_query("SELECT * FROM ".$mod." ORDER BY nome");
                                                                while($rSql = mysql_fetch_array($qSql)) {
                                                                     $url_limpa = transformaCaractere($rSql['nome']);
                                                                ?>
                                                                <script>
																$(function(){
																	 
																	$('#nome-<?=$rSql['id']?>').editable({
																		validate: function(value) {
																		   if($.trim(value) == '') { 
																		    return 'Este campo é obrigatório';
																		   } else {
																			   salva_campo_tabela('nome','<?=$rSql['id']?>','<?=$mod?>',value);
																		   }
																		}
																	});

																	$('#link-<?=$rSql['id']?>').editable({
																		validate: function(value) {
																		   if($.trim(value) == '') { 
																		    return 'Este campo é obrigatório';
																		   } else {
																			   salva_campo_tabela('link','<?=$rSql['id']?>','<?=$mod?>',value);
																		   }
																		}
																	});

																	$('#family-<?=$rSql['id']?>').editable({
																		validate: function(value) {
																		   if($.trim(value) == '') { 
																		    return 'Este campo é obrigatório';
																		   } else {
																			   salva_campo_tabela('family','<?=$rSql['id']?>','<?=$mod?>',value);
																		   }
																		}
																	});
																	
																});
                                                                </script>
                                                                <tr id="linha-<?=$rSql['id']?>">
                                                                    <td style="vertical-align:middle;" class="nolink"><input type="checkbox" name="msg_sel[]" class="select_msg" value="<?=$rSql['id']?>" /></td>
                                                                    <td><a data-original-title="Editar campo Nome" data-placeholder="Digite um nome" data-placement="right" data-pk="1" data-type="text" id="nome-<?=$rSql['id']?>" href="#"><?=$rSql['nome']?></a></td>
                                                                    <td><a data-original-title="Editar campo Link" data-placeholder="Digite um link" data-placement="right" data-pk="1" data-type="text" id="link-<?=$rSql['id']?>" href="#"><?=$rSql['link']?></a></td>
                                                                    <td><a data-original-title="Editar campo Font Family" data-placeholder="Digite um font family" data-placement="right" data-pk="1" data-type="text" id="family-<?=$rSql['id']?>" href="#"><?=$rSql['family']?></a></td>
                                                                    <td class="nolink">
                                                                        <div class="btn-group">
                                                                        <a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/editar/<?=$rSql['id']?>/" class="btn-mini ptip_se" title="Editar"><img src="<?=$link?>templates/<?=$layout_padrao_set?>/template/img/icones_novos/16/editar.png" /></a>
                                                                        <a href="javascript:void(0);" onclick="remover_item_tabela('<?=$rSql['id']?>','<?=$mod?>','NAO','<?=$rSql['ordem']?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>templates/<?=$layout_padrao_set?>/template/img/icones_novos/16/remover-x.png" /></a>
                                                                        <? if(trim($rSql['stat'])=="1") { ?>
                                                                            <a href="javascript:void(0);" onclick="muda_stat('<?=$mod?>','<?=$rSql['id']?>','0');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>templates/<?=$layout_padrao_set?>/template/img/icones_novos/16/stat-1.png" /></a>
                                                                        <? } else { ?>
                                                                            <a href="javascript:void(0);" onclick="muda_stat('<?=$mod?>','<?=$rSql['id']?>','1');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>templates/<?=$layout_padrao_set?>/template/img/icones_novos/16/stat-0.png" /></a>
                                                                        <? } ?>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <? } ?>
                                                            </tbody>
                                                            </table>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="tb1_c" class="tab-pane">
                                                    <div>
                                                    <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="forms">
                                                        <input type="hidden" name="acaoLocal" value="interno" />
                                                        <input type="hidden" name="acaoForm" value="add" />
                                                        <input type="hidden" name="modulo" value="sysfonte" />
            
                                                        <? 
                                                        $numeroUnicoGerado = geraCodReturn(); 
                                                        ?>
                                                        <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
            
                                                        <div class="formSep">
                                                            <div style="float:left;margin-right:10px;">
                                                                <label class="req">Nome</label>
                                                                <input value="" style="width:350px;" type="text" name="nome" id="nome" />
                                                                <span class="help-block">Apens um nome para referência dentro do sistema</span>
                                                            </div>
                                                        </div>
            
                                                        <div class="formSep">
                                                            <label class="req">Link</label>
                                                            <input value="" class="span7" type="text" name="link" id="link" />
                                                            <span class="help-block">Copiar o link fornecido pelo Google Web Fonts ou pela ferramenta de fornecimento da WebFont</span>
                                                        </div>
            
                                                        <div class="formSep">
                                                            <label>Font-Family</label>
                                                            <input value="" class="span5" type="text" name="family" id="family" />
                                                            <span class="help-block">Colar aqui o conteúdo destacado em negrito como no exemplo:  <b>font-family:'Francois One', sans-serif;</b></span>
                                                        </div>
            
                                                        <div class="formSep">
                                                            <label class="req">Ativo ?</label>
                                                            <label class="radio" style="color:#C00;">
                                                                <input type="radio" name="stat" id="ativo1" value="0" >
                                                                não
                                                            </label>
                                                            <label class="radio" style="color:#390;">
                                                                <input type="radio" name="stat" id="ativo2" checked="checked" value="1" >
                                                                sim
                                                            </label>
                                                        </div>	
                                                        
                                                        <div class="formSep">
                                                            <button type="submit" class="btn btn-success">Salvar</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
