                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nome</th>
                                                                            <th>Link do Site</th>
                                                                            <th>Link do Admin</th>
                                                                            <th style="width:110px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
                                                                        $qSqlCategoria = mysql_query("SELECT * FROM sysconfig_links ORDER BY nome");
                                                                        while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                        ?>
                                                                        
																		<script>
                                                                        $(function(){

                                                                            $('#nome-item-<?=$rSqlCategoria['id']?>').editable({
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela_ajax_novo('lista_sysconfig','_links','nome','<?=$rSqlCategoria['id']?>','sysconfig',value,'<?=$sufixoGet?>','<?=$numeroUnicoGet?>');
                                                                                   }
                                                                                }
                                                                            });
                                                                            
                                                                            $('#link-site-item-<?=$rSqlCategoria['id']?>').editable({
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela_ajax_novo('lista_sysconfig','_links','link_site','<?=$rSqlCategoria['id']?>','sysconfig',value,'<?=$sufixoGet?>','<?=$numeroUnicoGet?>');
                                                                                   }
                                                                                }
                                                                            });

                                                                            $('#link-admin-item-<?=$rSqlCategoria['id']?>').editable({
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela_ajax_novo('lista_sysconfig','_links','link_admin','<?=$rSqlCategoria['id']?>','sysconfig',value,'<?=$sufixoGet?>','<?=$numeroUnicoGet?>');
                                                                                   }
                                                                                }
                                                                            });

                                                                        });
                                                                        </script>
                                                                        <tr id="lista_categoria_<?=$rSqlItem['id']?>">
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Nome" data-placeholder="Digite um Nome" data-placement="right" data-pk="1" data-type="text" id="nome-item-<?=$rSqlCategoria['id']?>" href="#"><?=$rSqlCategoria['nome']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Link do Site" data-placeholder="Escolha um Link do Site" data-placement="right" data-pk="1" data-type="text" id="link-site-item-<?=$rSqlCategoria['id']?>" href="#"><?=$rSqlCategoria['link_site']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Link do Admin" data-placeholder="Escolha um Link do Admin" data-placement="right" data-pk="1" data-type="text" id="link-admin-item-<?=$rSqlCategoria['id']?>" href="#"><?=$rSqlCategoria['link_admin']?></a></td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <a href="javascript:void(0);" onClick="remover_links('<?=$rSqlCategoria['id']?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
