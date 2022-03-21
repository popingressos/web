                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:150px;">Ordem</th>
                                                                            <th>Nome</th>
                                                                            <th>Prefixo 1</th>
                                                                            <th>Prefixo 2</th>
                                                                            <th>Slug</th>
                                                                            <th style="width:70px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
																		if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; }

                                                                        $qSqlCategoria = mysql_query("SELECT * FROM ".$modGet."".$subLocalGet." ORDER BY ordem");
                                                                        while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                        ?>
                                                                        
																		<script>
                                                                        $(function(){
                                                                             
                                                                            $('#ordem-categoria-<?=$rSqlCategoria['id']?>').editable({
																				source: [
																					<?
																					$nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$modGet."".$subLocalGet.""));
																					if($nordem==0) {
																					?>
																					{value: '1', text: '1'},
																					<?
																					} else {
																					for ($b=1; $b<=$nordem; $b++) {
																					?>
																					{value: '<?=$b?>', text: '<?=$b?>'},
																					<? } } ?>
																				],
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       edita_ordem_categoria('lista_categoria_sysmod','<?=$rSqlCategoria['id']?>','<?=$modGet?>','_categoria',value);
                                                                                   }
                                                                                }
                                                                            });

                                                                            $('#nome-categoria-<?=$rSqlCategoria['id']?>').editable({
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela_ajax('lista_categoria_sysmod','_categoria','nome','<?=$rSqlCategoria['id']?>','<?=$modGet?>',value);
                                                                                   }
                                                                                }
                                                                            });
                                                                            
                                                                            $('#prefixo_mod-categoria-<?=$rSqlCategoria['id']?>').editable({
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela_ajax('lista_categoria_sysmod','_categoria','prefixo_mod','<?=$rSqlCategoria['id']?>','<?=$modGet?>',value);
                                                                                   }
                                                                                }
                                                                            });
                                                                            
                                                                            $('#prefixo_url-categoria-<?=$rSqlCategoria['id']?>').editable({
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela_ajax('lista_categoria_sysmod','_categoria','prefixo_url','<?=$rSqlCategoria['id']?>','<?=$modGet?>',value);
                                                                                   }
                                                                                }
                                                                            });
                                                                            
                                                                            $('#url_amigavel-categoria-<?=$rSqlCategoria['id']?>').editable({
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela_ajax('lista_categoria_sysmod','_categoria','url_amigavel','<?=$rSqlCategoria['id']?>','<?=$modGet?>',value);
                                                                                   }
                                                                                }
                                                                            });

                                                                        });
                                                                        </script>
                                                                        <tr id="lista_categoria_<?=$rSqlCategoria['id']?>">
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Ordem" data-placeholder="Escolha uma Ordem" data-placement="right" data-pk="1" data-alue="<?=$rSqlCategoria['ordem']?>" data-type="select" id="ordem-categoria-<?=$rSqlCategoria['id']?>" href="#"><?=$rSqlCategoria['ordem']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Nome" data-placeholder="Digite um Nome" data-placement="right" data-pk="1" data-type="text" id="nome-categoria-<?=$rSqlCategoria['id']?>" href="#"><?=$rSqlCategoria['nome']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Texto" data-placeholder="Digite um Texto" data-placement="right" data-pk="1" data-type="text" id="prefixo_mod-categoria-<?=$rSqlCategoria['id']?>" href="#"><?=$rSqlCategoria['prefixo_mod']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Texto" data-placeholder="Digite um Texto" data-placement="right" data-pk="1" data-type="text" id="prefixo_url-categoria-<?=$rSqlCategoria['id']?>" href="#"><?=$rSqlCategoria['prefixo_url']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Slug" data-placeholder="Escolha um Status" data-placement="right" data-pk="1" data-type="text" id="url_amigavel-categoria-<?=$rSqlCategoria['id']?>" href="#"><?=$rSqlCategoria['url_amigavel']?></a></td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <a href="javascript:void(0);" onClick="remover_item_ajax('lista_categoria','<?=$rSqlCategoria['id']?>','<?=$modGet?>','_categoria','SIM','<?=$rSqlCategoria['ordem']?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
																				<? if(trim($rSqlCategoria['stat'])=="1") { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_ajax('lista_categoria','<?=$modGet?>','_categoria','<?=$rSqlCategoria['id']?>','0');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a>
                                                                                <? } else { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_ajax('lista_categoria','<?=$modGet?>','_categoria','<?=$rSqlCategoria['id']?>','1');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a>
                                                                                <? } ?>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
