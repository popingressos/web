                                                                    <? if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; } ?>
                                                                    <table class="table table-striped table-bordered table-advance table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:20px;"></th>
                                                                            <th style="width:70px;">Ordem</th>
                                                                            <th>Ordenação</th>
                                                                            <th>Campo</th>
                                                                            <th>Campo (BD)</th>
                                                                            <th style="width:60px;">Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?
                                                                        $nSqlLista = mysql_num_rows(mysql_query("SELECT * FROM ".$modGet."_ordenacao ORDER BY ordem"));
                                                                        $qSqlLista = mysql_query("SELECT * FROM ".$modGet."_ordenacao ORDER BY ordem");
                                                                        while($rSqlLista = mysql_fetch_array($qSqlLista)) {
																			$contLista++;
                                                                        ?>
                                                                        
                                                                        <tr class="odd gradeX">
                                                                            <td>
																			<? if(trim($contLista)==trim($nSqlLista)) { ?> 
                                                                                <i onClick="ordem_ordenacao('<?=$rSqlLista['id']?>','<?=$modGet?>','<? echo $rSqlLista['ordem'] - 1; ?>');" class="fa fa-arrow-up"></i>
																			<? } else { ?>
																				<? if(trim($rSqlLista['ordem'])=="1") { ?> 
                                                                                    <i onClick="ordem_ordenacao('<?=$rSqlLista['id']?>','<?=$modGet?>','<? echo $rSqlLista['ordem'] + 1; ?>');" class="fa fa-arrow-down"></i>
                                                                                <? } else { ?>
	                                                                                <i onClick="ordem_ordenacao('<?=$rSqlLista['id']?>','<?=$modGet?>','<? echo $rSqlLista['ordem'] - 1; ?>');" class="fa fa-arrow-up"></i>
                                                                                    <br />
                                                                                    <i onClick="ordem_ordenacao('<?=$rSqlLista['id']?>','<?=$modGet?>','<? echo $rSqlLista['ordem'] + 1; ?>');" class="fa fa-arrow-down"></i>
                                                                                <? } ?>
																			<? } ?>
                                                                            </td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlLista['ordem']?></td>
                                                                           <? if(trim($rSqlLista['tipo'])=="ASC") { $tipo_set = "do menor para o maior ( ex.: 1 a 10 )"; } else { $tipo_set = "do maior para o menor ( ex.: 10 a 1 )"; } ?>
                                                                            <td style="vertical-align:middle;"><?=$rSqlLista['tipo']?>: <?=$tipo_set?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlLista['campo']?></td>
                                                                            <td style="vertical-align:middle;"><?=$rSqlLista['campo_bd']?></td>
                                                                            <td style="vertical-align:middle;">
                                                                                <div class="btn-group">
                                                                                <? if(trim($rSqlLista['stat'])=="1") { ?>
                                                                                <a href="javascript:void(0);" onClick="muda_stat_ordenacao('<?=$rSqlLista['id']?>','<?=$modGet?>','0');" class="btn-mini ptip_se" title="Habilitado"><img src="<?=$link?>templates/<?=$layout_padrao_set?>/templates/img/icones_novos/16/stat-1.png" /></a>
                                                                                <? } else { ?>
                                                                                <a href="javascript:void(0);" onClick="muda_stat_ordenacao('<?=$rSqlLista['id']?>','<?=$modGet?>','1');" class="btn-mini ptip_se" title="Desabilitado"><img src="<?=$link?>templates/<?=$layout_padrao_set?>/templates/img/icones_novos/16/stat-0.png" /></a>
                                                                                <? } ?>
                                                                                <a href="javascript:void(0);" onClick="remover_ordenacao('<?=$rSqlLista['id']?>','<?=$modGet?>');" class="btn-mini ptip_se" title="Remover"><img src="<?=$link?>templates/<?=$layout_padrao_set?>/templates/img/icones_novos/16/remover-x.png" /></a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <? } ?>
                                                                    </tbody>
                                                                    </table>
