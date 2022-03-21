                                                                    <? if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; } ?>
                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:150px;">Ordem</th>
                                                                            <th>Nome</th>
                                                                            <th>Descrição</th>
                                                                            <th style="width:70px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
                                                                        $qSqlCategoria = mysql_query("SELECT * FROM ".$modGet."_item WHERE numeroUnico_sysplano='".$numeroUnicoGet."' ORDER BY ordem");
                                                                        while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                        ?>
                                                                        
																		<script>
                                                                        $(function(){

                                                                            $('#ordem-categoria-<?=$rSqlCategoria['id']?>').editable({
																				source: [
																					<?
																					$nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$modGet."_item WHERE numeroUnico_sysplano='".$numeroUnicoGet."'"));
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
                                                                                       edita_ordem_sysplano_item('lista_sysplano','<?=$rSqlCategoria['id']?>','<?=$modGet?>','_item',value);
                                                                                   }
                                                                                }
                                                                            });

                                                                            $('#nome-item-<?=$rSqlCategoria['id']?>').editable({
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela_ajax_novo('lista_sysplano','_item','nome','<?=$rSqlCategoria['id']?>','<?=$modGet?>',value,'<?=$sufixoGet?>','<?=$numeroUnicoGet?>');
                                                                                   }
                                                                                }
                                                                            });
                                                                            
                                                                            $('#texto-item-<?=$rSqlCategoria['id']?>').editable({
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_tabela_ajax_novo('lista_sysplano','_item','texto','<?=$rSqlCategoria['id']?>','<?=$modGet?>',value,'<?=$sufixoGet?>','<?=$numeroUnicoGet?>');
                                                                                   }
                                                                                }
                                                                            });

                                                                        });
                                                                        </script>
                                                                        <tr id="lista_categoria_<?=$rSqlCategoria['id']?>">
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Ordem" data-placeholder="Escolha uma Ordem" data-placement="right" data-pk="1" data-value="<?=$rSqlCategoria['ordem']?>" data-type="select" id="ordem-categoria-<?=$rSqlCategoria['id']?>" href="#"><?=$rSqlCategoria['ordem']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Nome" data-placeholder="Digite um Nome" data-placement="right" data-pk="1" data-type="text" id="nome-item-<?=$rSqlCategoria['id']?>" href="#"><?=$rSqlCategoria['nome']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Descrição" data-placeholder="Escolha um Descrição" data-placement="right" data-pk="1" data-type="text" id="texto-item-<?=$rSqlCategoria['id']?>" href="#"><?=$rSqlCategoria['texto']?></a></td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <a href="javascript:void(0);" onClick="remover_item_ajax_novo('lista_sysplano','<?=$rSqlCategoria['id']?>','<?=$modGet?>','_item','NAO','','<?=$sufixoGet?>','<?=$numeroUnicoGet?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
																				<? if(trim($rSqlCategoria['hotsite'])=="1") { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_ajax_novo('hotsite','dataModificacao','lista_sysplano','<?=$modGet?>','_item','<?=$rSqlCategoria['id']?>','0','<?=$numeroUnicoGet?>','<?=$sufixoGet?>');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/bullet_verde.png" /></a>
                                                                                <? } else { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_ajax_novo('hotsite','dataModificacao','lista_sysplano','<?=$modGet?>','_item','<?=$rSqlCategoria['id']?>','1','<?=$numeroUnicoGet?>','<?=$sufixoGet?>');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/bullet_vermelho.png" /></a>
                                                                                <? } ?>
																				<? if(trim($rSqlCategoria['stat'])=="1") { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_ajax_novo('stat','dataModificacao','lista_sysplano','<?=$modGet?>','_item','<?=$rSqlCategoria['id']?>','0','<?=$numeroUnicoGet?>','<?=$sufixoGet?>');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a>
                                                                                <? } else { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_ajax_novo('stat','dataModificacao','lista_sysplano','<?=$modGet?>','_item','<?=$rSqlCategoria['id']?>','1','<?=$numeroUnicoGet?>','<?=$sufixoGet?>');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a>
                                                                                <? } ?>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
