										<? if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; } ?>
                                        <?
                                        $qSql = mysql_query("SELECT * FROM ".$modGet."_categoria ORDER BY ordem");
                                        while($rSql = mysql_fetch_array($qSql)) {
                                        ?>
                                        <tr class="odd gradeX">
                                            <td class="center"><input type="checkbox" name="msg_sel[]" class="checkboxes" value="<?=$rSql['id']?>" /></td>
                                            <td class="center"><a href="#" id="ordem-<?=$rSql['id']?>" data-type="select" data-pk="1" data-value="<?=$rSql['ordem']?>" data-original-title="Selecione a ordem"><?=$rSql['ordem']?></a></td>
                                            <td class="center"><? if(trim($rSql['icone'])=="") { } else { ?><i class="<?=$rSql['icone']?>"></i><? } ?></td> 
                                            <td><a href="#" id="nome-<?=$rSql['id']?>" data-type="text" data-pk="1" data-placement="right" data-value="<?=$rSql['nome']?>" data-placeholder="Required" data-original-title="Digite um nome"><?=$rSql['nome']?></td>
                                            <td class="center">
                                                <? if(trim($sysperm['editar_'.$modGet.''])==1) { ?>
                                                    <a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/<?=$_REQUEST['var3']?>/editar/<?=$rSql['id']?>/" class="btn btn-xs blue" title="Editar"><i class="fa fa-pencil"></i></a>
                                                <? } ?>
                                                <? if(trim($sysperm['excluir_'.$modGet.''])==1) { ?>
                                                    <a href="javascript:void(0);" onclick="remover_item_tabela('<?=$rSql['id']?>','<?=$modGet?>_categoria','NAO','');" title="Remover" class="btn btn-xs red-thunderbird"><i class="fa fa-times"></i></a>
                                                <? } ?>
                                                <? if(trim($rSql['stat'])=="1") { ?>
                                                    <? if(trim($sysperm['despublicar_'.$modGet.''])==1) { ?>
                                                    <a href="javascript:void(0);" onclick="muda_stat('<?=$modGet?>_categoria','<?=$rSql['id']?>','0');" class="btn btn-xs green" title="Despublicar"><i class="fa fa-check-circle"></i></a>
                                                    <? } else { ?>
                                                    <a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn btn-xs green" title="Despublicar"><i class="fa fa-check-circle"></i></a>
                                                    <? } ?>
                                                <? } else { ?>
                                                    <? if(trim($sysperm['publicar_'.$modGet.''])==1) { ?>
                                                    <a href="javascript:void(0);" onclick="muda_stat('<?=$modGet?>_categoria','<?=$rSql['id']?>','1');" class="btn btn-xs yellow-gold" title="Publicar"><i class="fa fa-minus-circle"></i></a>
                                                    <? } else { ?>
                                                    <a href="javascript:void(0);" onclick="alert('Você não tem permissão para esta ação !');" class="btn btn-xs yellow-gold" title="Publicar"><i class="fa fa-minus-circle"></i></a>
                                                    <? } ?>
                                                <? } ?>
                                            </td>
                                        </tr>
                                        <? } ?>
