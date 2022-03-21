				<div class="col-md-12">
                    <div class="tabbable tabbable-custom blue">

                        <ul class="nav nav-tabs">

							<? if(trim($_REQUEST['var3'])=="") { } else { ?><li class="active"><a data-toggle="tab" href="#tab_form">Editando <?=$row['nome']?></a></li><? } ?>
                            <li <? if(trim($_REQUEST['var3'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#tab_lista">Lista de Itens</a></li>
                            <? if(trim($_REQUEST['var3'])=="") { ?><li><a data-toggle="tab" href="#tab_form">Adicionar Novo</a></li><? } ?>

                        </ul>
    
                        <div class="tab-content">
                                
                                <div class="tab-pane <? if(trim($_REQUEST['var3'])=="") { ?>active<? } ?>" id="tab_lista">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="actions">
                                                    <div class="btn-group pull-right">
                                                        <a class="btn default yellow-stripe" href="#" data-toggle="dropdown">
                                                        <i class="fa fa-share"></i>
                                                        <span class="hidden-480">
                                                        Ações </span>
                                                        <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a href="javascript:void(0);" onclick="acao_selecionados('excluir','');"><i class="fa fa-times"></i>&nbsp;Remover</a></li>
                                                            <li><a href="javascript:void(0);" onclick="acao_selecionados('publicar','');" class="green"><i class="fa fa-check-circle"></i>&nbsp;Publicar</a></li>
                                                            <li><a href="javascript:void(0);" onclick="acao_selecionados('despublicar','');" class="red-thunderbird"><i class="fa fa-minus-circle"></i>&nbsp;Despublicar</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form name="list" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" method="post" target="_self">
                                    <input type="hidden" name="subMod" value=""/>
                                    <input type="hidden" name="acaoForm" id="acaoForm_lista" value="" />
                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
                                    <table class="table table-striped table-bordered table-hover" id="tabela_montada">
                                        <thead>
                                            <tr role="row" class="heading">
                                                <th style="width:20px;" class="table-checkbox"><input type="checkbox" class="group-checkable" title="Selecionar todos" data-set="#tabela_montada .checkboxes"/></th>
                                                <th>Nome</th>
                                                <th>Link</th>
                                                <th>Font Family</th>
                                                <th style="width:90px;">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?
                                            $qSql = mysql_query("SELECT * FROM ".$mod." ORDER BY nome, data DESC, dataModificacao DESC");
                                            while($rSql = mysql_fetch_array($qSql)) {
                                            ?>
                                            <tr class="odd gradeX">
                                                <td class="center"><input type="checkbox" name="msg_sel[]" class="checkboxes" value="<?=$rSql['id']?>" /></td>
												<? $novo_nome = str_replace("@aspa_simples@","&#039;",$rSql['nome']); $novo_nome = str_replace("@aspa_dupla@","&quot;",$novo_nome); ?>
                                                <td><?=$novo_nome?></td>
                                                <? $novo_link = str_replace("@aspa_simples@","&#039;",$rSql['link']); $novo_link = str_replace("@aspa_dupla@","&quot;",$novo_link); $novo_link = str_replace("@html_link@","&lt;",$novo_link); ?>
                                                <td><?=$novo_link ?></td>
                                                <? $novo_family = str_replace("@aspa_simples@","&#039;",$rSql['family']); $novo_family = str_replace("@aspa_dupla@","&quot;",$novo_family); ?>
                                                <td><?=$novo_family?></td>
                                                <td class="center">
                                                        <a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/editar/<?=$rSql['id']?>/" class="btn btn-xs blue" title="Editar"><i class="fa fa-pencil"></i></a>
                                                        <a href="javascript:void(0);" onclick="remover_item_tabela('<?=$rSql['id']?>','<?=$mod?>','NAO','');" title="Remover" class="btn btn-xs red-thunderbird"><i class="fa fa-times"></i></a>
                                                    <? if(trim($rSql['stat'])=="1") { ?>
                                                        <a href="javascript:void(0);" onclick="muda_stat('<?=$mod?>','<?=$rSql['id']?>','0');" class="btn btn-xs green" title="Despublicar"><i class="fa fa-check-circle"></i></a>
                                                    <? } else { ?>
                                                        <a href="javascript:void(0);" onclick="muda_stat('<?=$mod?>','<?=$rSql['id']?>','1');" class="btn btn-xs yellow-gold" title="Publicar"><i class="fa fa-minus-circle"></i></a>
                                                    <? } ?>
                                                </td>
                                            </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                    </form>
                                </div>
                                <!-- END TAB_LISTA-->
                                
                                <div class="tab-pane <? if(trim($_REQUEST['var3'])=="") { } else { ?> active<? } ?>" id="tab_form">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <ul class="ver-inline-menu tabbable margin-bottom-10">
                                                <li class="active"><a data-toggle="tab" href="#tab2_dados_principais"><i class="fa fa-caret-right"></i> Dados principais</a> <span class="after"></span></li>
                                            </ul>
                                        </div>

                                        <div class="col-md-10">
                                            <div class="portlet light bg-inverse form-fit">
                                            <div class="portlet-body form">
                                                <form name="forms" method="post" action="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="formulario" class="form-horizontal form-bordered form-row-stripped">
                                                <div class="form-body">

                                                    <input type="hidden" name="aba" id="aba" value="" />
                                                    
                                                    <input type="hidden" name="subMod" value="" />
    
                                                    <? if(trim($_REQUEST['var3'])=="") { ?> 
                                                        <input type="hidden" name="acaoLocal" value="interno" />
                                                        <input type="hidden" name="acaoForm" id="idacaoForm" value="add" />
                                                        <input type="hidden" name="modulo" value="<?=$mod?>" />

                                                        <? 
                                                        $numeroUnicoGerado = geraCodReturn(); 
                                                        ?>
                                                        <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
													<? } else { ?>
                                                        <input type="hidden" name="acaoLocal" value="interno" />
                                                        <input type="hidden" name="acaoForm" id="idacaoForm" value="editar" />
                                                        <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                        <input type="hidden" name="iditem" id="iditem_set" value="<?=$_REQUEST['var4']?>" />
            
                                                        <? 
                                                        $numeroUnicoGerado = $row['numeroUnico']; 
                                                        ?>
                                                        <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
                                                    <? } ?>

                                                    <div class="tab-content">
    
                                                        <div id="tab2_dados_principais" class="tab-pane active" style="min-height:350px;">
                        
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Nome</label>
                                                                <div class="col-md-10">
                                                                    <input value="<?=$row['nome']?>" type="text" name="nome" id="nome" class="form-control" />
                                                                </div>
                                                            </div>
                        
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Link</label>
                                                                <div class="col-md-10">
                                                                    <input value="<?=$row['link']?>" type="text" name="link" id="link" class="form-control" />
                                                                </div>
                                                            </div>
                
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Font-Family</label>
                                                                <div class="col-md-10">
                                                                    <input value="<?=$row['family']?>" type="text" name="family" id="family" class="form-control" />
                                                                    <p class="help-block">Colar aqui o conteúdo destacado em negrito como no exemplo:  <b>font-family:'Francois One', sans-serif;</b></p>
                                                                </div>
                                                            </div>
                
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2 req">Ativo ?</label>
                                                                <div class="col-md-10">
                                                                    <div class="radio-list">
                                                                        <label class="radio-inline" style="color:#C00;">
                                                                        <input type="radio" name="stat" id="ativo1" value="0"> não </label>
                                                                        <label class="radio-inline" style="color:#390;">
                                                                        <input type="radio" name="stat" id="ativo2" value="1" checked> sim </label>
                                                                    </div>
                                                                </div>
                                                            </div>	
        
                                                        </div>
                                                        <!-- END Dados principais -->
                                                        
                                                    </div>
    
                                                </div>
                                                <!-- END form-body -->
    
                                                <div class="form-actions" style="border:0px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" style="margin-left:20px;" class="btn green-turquoise"><i class="fa fa-floppy-o"></i> Salvar</button>
                                                            <button type="button" onclick="salvar_continuar_editando('<? if(trim($_REQUEST['var3'])=="") { echo "add-continuar"; } else { echo "editar-continuar"; } ?>');" class="btn green-seagreen"><i class="fa fa-check"></i> Salvar e Continuar Editando</button>
                                                            <button type="button" id="btn_cancelar" class="btn yellow-casablanca"><i class="fa fa-minus-circle"></i> Cancelar</button>
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
				
					var initTable1 = function () {
				
						var table = $('#tabela_montada');
				
						// begin first table
						table.dataTable({

							// Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
							// setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
							// So when dropdowns used the scrollable div should be removed. 
							//"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
				
							"columns": [
								{ "orderable": false }, 
								{ "orderable": true }, 
								{ "orderable": true }, 
								{ "orderable": true }, 
								{ "orderable": false } 
							],

							"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
				
							<? include("templates/".$layout_padrao_set."/include/datatable.config.php"); ?>

							"order": [
								[1, "asc"]
							] // set first column as a default sort by asc
						});
				
						var tableWrapper = jQuery('#tabela_montada_wrapper');
				
						table.find('.group-checkable').change(function () {
							var set = jQuery(this).attr("data-set");
							var checked = jQuery(this).is(":checked");
							jQuery(set).each(function () {
								if (checked) {
									$(this).attr("checked", true);
									$(this).parents('tr').addClass("active");
								} else {
									$(this).attr("checked", false);
									$(this).parents('tr').removeClass("active");
								}
							});
							jQuery.uniform.update(set);
						});
				
						table.on('change', 'tbody tr .checkboxes', function () {
							$(this).parents('tr').toggleClass("active");
						});
				
						tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
					}
				
					
					return {
				
						//main function to initiate the module
						init: function () {
							if (!jQuery().dataTable) {
								return;
							}
				
							initTable1();

						}
				
					};
				
				}();


				jQuery(document).ready(function() {    
					Componentes.init();
				});
                </script>





