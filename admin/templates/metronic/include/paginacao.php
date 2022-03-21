							<?
							$inicio = 0;
							$limit = $itens_por_pagina;
							$page = "";
							?>
                        	<ul class="pagination pagination-sm">

								<? if($inicio==0) { ?>
                                <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                <? } else { ?>
                                <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                <? } ?>


								<input type="text" class="form-control input-small input-inline" placeholder="">
								<?
								
								$qtdPaginas = 4;
								
                                if(trim($page)=="") { $paginaAtual=1; } else {  $paginaAtual= intval($page);}

                                $nnot = mysql_num_rows(mysql_query("SELECT * FROM ".$mod.""));
                                $totPaginas = $nnot / $limit;
                                $totPaginasInt = intval($totPaginas);
                                
                                
                                for($i=1;$i<=$qtdPaginas;$i++) {
									$pagei++;
                                ?>

								<? if($pagei==$paginaAtual) { ?>
                                <li><a class="disabled" href="javascript:void(0);" onclick="javascript:_construtor_template_paginacao('<?=$mod?>','<?= $pagei - 1 ?>','<?=$itens_por_pagina?>','<?=$sysusu['id']?>')"> <?= $pagei ?> </a></li>
                                <? } else { ?>
                                <li><a href="javascript:void(0);" onclick="javascript:_construtor_template_paginacao('<?=$mod?>','<?= $pagei - 1 ?>','<?=$itens_por_pagina?>','<?=$sysusu['id']?>')"> <?= $pagei ?> </a></li>
                                <? } ?>

								<? } ?>



								<? if($paginaAtual==($totPaginasInt+1)) { ?>
                                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                <? } else { ?>
                                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                <? } ?>

								<? $pageFim = $totPaginasInt + 1; $limiteFim = $totPaginasInt * $limit; ?>

                            </ul>
