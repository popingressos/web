                                                                    <? if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; } ?>
                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nome</th>
                                                                            <th>Descrição</th>
                                                                            <th style="width:70px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
                                                                        $qSqlCategoria = mysql_query("SELECT * FROM ".$modGet."_item WHERE numeroUnico_pai='".$numeroUnicoGet."' ORDER BY nome");
                                                                        while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                        ?>
                                                                        
																		<script>
                                                                        $(function(){

                                                                            $('#nome-item-<?=$rSqlCategoria['id']?>').editable({
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela_ajax_novo('lista_<?=$modGet?>','_item','nome','<?=$rSqlCategoria['id']?>','<?=$modGet?>',value,'<?=$sufixoGet?>','<?=$numeroUnicoGet?>');
                                                                                   }
                                                                                }
                                                                            });
                                                                            
                                                                            $('#texto-item-<?=$rSqlCategoria['id']?>').editable({
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela_ajax_novo('lista_<?=$modGet?>','_item','texto','<?=$rSqlCategoria['id']?>','<?=$modGet?>',value,'<?=$sufixoGet?>','<?=$numeroUnicoGet?>');
                                                                                   }
                                                                                }
                                                                            });

                                                                        });
                                                                        </script>
                                                                        <tr id="lista_categoria_<?=$rSqlCategoria['id']?>">
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Nome" data-placeholder="Digite um Nome" data-placement="right" data-pk="1" data-type="text" id="nome-item-<?=$rSqlCategoria['id']?>" href="#"><?=$rSqlCategoria['nome']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Descrição" data-placeholder="Escolha um Descrição" data-placement="right" data-pk="1" data-type="text" id="texto-item-<?=$rSqlCategoria['id']?>" href="#"><?=$rSqlCategoria['texto']?></a></td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <a href="javascript:void(0);" onClick="remover_item_ajax_novo('lista_<?=$modGet?>','<?=$rSqlCategoria['id']?>','<?=$modGet?>','_item','NAO','','<?=$sufixoGet?>','<?=$numeroUnicoGet?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
																				<? if(trim($rSqlCategoria['stat'])=="1") { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_ajax_novo('lista_<?=$modGet?>','<?=$modGet?>','_item','<?=$rSqlCategoria['id']?>','0','<?=$numeroUnicoGet?>','<?=$sufixoGet?>');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a>
                                                                                <? } else { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_ajax_novo('lista_<?=$modGet?>','<?=$modGet?>','_item','<?=$rSqlCategoria['id']?>','1','<?=$numeroUnicoGet?>','<?=$sufixoGet?>');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a>
                                                                                <? } ?>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
