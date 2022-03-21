                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:150px;">Ordem</th>
                                                                            <th>Nome</th>
                                                                            <th style="width:70px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
																		if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; }
																		
                                                                        $qSqlCategoria = mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."".$subLocalGet." ORDER BY ordem");
                                                                        while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                        ?>
                                                                        
																		<script>
                                                                        $(function(){
                                                                             
                                                                            $('#ordem-categoria-<?=$rSqlCategoria['id']?>-<?=$subLocalGet?>').editable({
																				source: [
																					<?
																					$nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."".$subLocalGet.""));
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
                                                                                       edita_ordem_status_classificacao('<?=$rSqlCategoria['id']?>','<?=$modGet?>','<?=$subLocalGet?>',value);
                                                                                   }
                                                                                }
                                                                            });

                                                                            $('#nome-categoria-<?=$rSqlCategoria['id']?>-<?=$subLocalGet?>').editable({
                                                                                validate: function(value) {
                                                                                   if($.trim(value) == '') { 
                                                                                    return 'Este campo é obrigatório';
                                                                                   } else {
                                                                                       salva_campo_status_classificacao('<?=$rSqlCategoria['id']?>','<?=$modGet?>','<?=$subLocalGet?>',value);
                                                                                   }
                                                                                }
                                                                            });
                                                                            
                                                                        });
                                                                        </script>
                                                                        <tr id="lista_categoria_<?=$rSqlCategoria['id']?>">
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Ordem" data-placeholder="Escolha uma Ordem" data-placement="right" data-pk="1" data-value="<?=$rSqlCategoria['ordem']?>" data-type="select" id="ordem-categoria-<?=$rSqlCategoria['id']?>-<?=$subLocalGet?>" href="#"><?=$rSqlCategoria['ordem']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Nome" data-placeholder="Digite um Nome" data-placement="right" data-pk="1" data-type="text" id="nome-categoria-<?=$rSqlCategoria['id']?>-<?=$subLocalGet?>" href="#"><?=$rSqlCategoria['nome']?></a></td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
                                                                                <a href="javascript:void(0);" onClick="remover_status_classificacao('<?=$modGet?>','<?=$rSqlCategoria['id']?>','<?=$subLocalGet?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
																				<? if(trim($rSqlCategoria['stat'])=="1") { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_status_classificacao('<?=$modGet?>','<?=$rSqlCategoria['id']?>','<?=$subLocalGet?>','0');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a>
                                                                                <? } else { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_status_classificacao('<?=$modGet?>','<?=$rSqlCategoria['id']?>','<?=$subLocalGet?>','1');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a>
                                                                                <? } ?>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
