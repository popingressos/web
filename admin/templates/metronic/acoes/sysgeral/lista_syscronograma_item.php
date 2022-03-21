                                                                    <? if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; } ?>
                                                                    <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Título</th>
                                                                            <th>Descrição</th>
                                                                            <th style="width:130px;">Concluído em</th>
                                                                            <th style="width:130px;">Aprovado em</th>
                                                                            <th style="width:110px;">Ações</th>
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
                                                                        <tr id="lista_categoria_<?=$rSqlItem['id']?>">
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Título" data-placeholder="Digite um Título" data-placement="right" data-pk="1" data-type="text" id="nome-item-<?=$rSqlCategoria['id']?>" href="#"><?=$rSqlCategoria['nome']?></a></td>
                                                                            <td style="vertical-align:middle;"><a data-original-title="Editar campo Descrição" data-placeholder="Escolha um Descrição" data-placement="right" data-pk="1" data-type="text" id="texto-item-<?=$rSqlCategoria['id']?>" href="#"><?=$rSqlCategoria['texto']?></a></td>
                                                                            <td style="vertical-align:middle;">
																			<? if(trim($rSqlCategoria['dataConclusao'])=="0000-00-00 00:00:00") { } else { 
																				$d  = substr($rSqlCategoria['dataConclusao'],8,2);
																				$m  = substr($rSqlCategoria['dataConclusao'],5,2);
																				$a  = substr($rSqlCategoria['dataConclusao'],0,4);
																				$h = substr($rSqlCategoria['dataConclusao'],11,19);
																			
																				$arrayData = mktime(0,0,0,$m,$d,$a);
																				$dataCorreta = date("d-m-Y", $arrayData);
																			
																				echo "".$dataCorreta." ".$h."";
																			} 
																			?>
                                                                            </td>
                                                                            <td style="vertical-align:middle;">
																			<? if(trim($rSqlCategoria['dataAprovacao'])=="0000-00-00 00:00:00") { } else { 
																				$d  = substr($rSqlCategoria['dataAprovacao'],8,2);
																				$m  = substr($rSqlCategoria['dataAprovacao'],5,2);
																				$a  = substr($rSqlCategoria['dataAprovacao'],0,4);
																				$h = substr($rSqlCategoria['dataAprovacao'],11,19);
																			
																				$arrayData = mktime(0,0,0,$m,$d,$a);
																				$dataCorreta = date("d-m-Y", $arrayData);
																			
																				echo "".$dataCorreta." ".$h."";
																			} 
																			?>
                                                                            </td>
                                                                            <td style="vertical-align:middle;" class="nolink">
                                                                                <div class="btn-group">
																				<? if(trim($rSqlCategoria['concluido'])=="1") { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_ajax_novo('concluido','dataConclusao','lista_<?=$modGet?>','<?=$modGet?>','_item','<?=$rSqlCategoria['id']?>','0','<?=$numeroUnicoGet?>','<?=$sufixoGet?>');" class="btn-mini ptip_se" title="Concluído"><img src="<?=$link?>template/img/like-1.png" /></a>
                                                                                <? } else { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_ajax_novo('concluido','dataConclusao','lista_<?=$modGet?>','<?=$modGet?>','_item','<?=$rSqlCategoria['id']?>','1','<?=$numeroUnicoGet?>','<?=$sufixoGet?>');" class="btn-mini ptip_se" title="Concluir"><img src="<?=$link?>template/img/like-0.png" /></a>
                                                                                <? } ?>
																				<? if(trim($rSqlCategoria['aprovado'])=="1") { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_ajax_novo('aprovado','dataAprovacao','lista_<?=$modGet?>','<?=$modGet?>','_item','<?=$rSqlCategoria['id']?>','0','<?=$numeroUnicoGet?>','<?=$sufixoGet?>');" class="btn-mini ptip_se" title="Aprovado"><img src="<?=$link?>template/img/like-1.png" /></a>
                                                                                <? } else { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_ajax_novo('aprovado','dataAprovacao','lista_<?=$modGet?>','<?=$modGet?>','_item','<?=$rSqlCategoria['id']?>','1','<?=$numeroUnicoGet?>','<?=$sufixoGet?>');" class="btn-mini ptip_se" title="Aprovar"><img src="<?=$link?>template/img/like-0.png" /></a>
                                                                                <? } ?>
                                                                                <a href="javascript:void(0);" onClick="remover_item_ajax_novo('lista_<?=$modGet?>','<?=$rSqlCategoria['id']?>','<?=$modGet?>','_item','NAO','','<?=$sufixoGet?>','<?=$numeroUnicoGet?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>template/img/icones_novos/16/remover-x.png" /></a>
																				<? if(trim($rSqlCategoria['stat'])=="1") { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_ajax_novo('stat','dataModificacao','lista_<?=$modGet?>','<?=$modGet?>','_item','<?=$rSqlCategoria['id']?>','0','<?=$numeroUnicoGet?>','<?=$sufixoGet?>');" class="btn-mini ptip_se" title="Despublicar"><img src="<?=$link?>template/img/icones_novos/16/stat-1.png" /></a>
                                                                                <? } else { ?>
                                                                                    <a href="javascript:void(0);" onclick="muda_stat_ajax_novo('stat','dataModificacao','lista_<?=$modGet?>','<?=$modGet?>','_item','<?=$rSqlCategoria['id']?>','1','<?=$numeroUnicoGet?>','<?=$sufixoGet?>');" class="btn-mini ptip_se" title="Publicar"><img src="<?=$link?>template/img/icones_novos/16/stat-0.png" /></a>
                                                                                <? } ?>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
