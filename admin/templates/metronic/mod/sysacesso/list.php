				<div class="col-md-12">
                    <div class="tabbable tabbable-custom blue">

                        <ul class="nav nav-tabs">

                            <li class="active"><a data-toggle="tab" href="#tab_acessos">Histórico de Acessos</a></li>

                        </ul>
    
                        <div class="tab-content">
                                
                                
                                <div class="tab-pane active" id="tab_acessos">
                                    <table id="datatable_ajax" class="table table-striped table-bordered table-hover display table-header-fixed" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>

                                                <th>Nome do Usuário</th>
                                                <th>E-mail do Usuário</th>
                                                <th style="width:150px;">Data do Acesso</th>

                                            </tr>
                                        </thead>
                                
										<input type="hidden" id="lista_campo" value="" />
										<input type="hidden" id="lista_campo_sql" value="" />
                                        <tbody id="datatable_ajax_tbody">
                                        	<? include("./templates/".$layout_padrao_set."/acoes/".$mod."/tabela-tbody.php"); ?>
                                        </tbody>
                                
                                    </table>

                                    <div class="row">
                                        <div class="col-md-6"><i>Exibindo <?=$itens_por_pagina?> de <span id="n_exibindo"><?=$nSql?></span> itens</i></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12" id="paginacao" style="text-align:center;">
                                        	<? include("./templates/".$layout_padrao_set."/acoes/_construtor_template/paginacao.php"); ?>
                                        </div>
                                    </div>

                                </div>
                                <!-- END TAB_ACESSOS -->

                        </div>
                        <!-- END TAB CONTENT-->

                    </div>
				</div>
                <!-- FIM COL-MD-12-->
                





