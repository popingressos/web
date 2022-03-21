<?
if(trim($_GET['numeroUnico_produtoS'])=="") {
	$numeroUnico_produtoS = $numeroUnicoGerado;
} else {
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
	
	$numeroUnico_produtoS = $_GET['numeroUnico_produtoS'];
}

$carrinhoArray = unserialize($_SESSION['adicionais_'.$numeroUnico_produtoS.'']);
?>
                                    <style>
									@media screen and (min-width:1024px){
										.hide-on-desktop{display:none!important}
										.show-on-desktop{display:block}
									}
									
									@media screen and (max-width:1023px){
										.hide-on-mobile{display:none!important}
										.show-on-mobile{display:block}
									}
									.table-bordered {
										border: 0px solid #e7ecf1 !important;
									}
									.table-striped > tbody > tr:nth-of-type(odd) {
										background-color: #f1f1f1 !important;
									}
									.table-bordered > thead > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > tfoot > tr > td {
										border: 0px solid #e7ecf1 !important;
									}
                                    </style>
                                    <table class="table table-striped table-bordered table-hover display table-header-fixed" style="background-color:#ffffff;" cellspacing="0" width="100%">
                                        <tbody>
											<? 
											$contLista_adicionais=0;
											if(trim($_SESSION['adicionais_'.$numeroUnico_produtoS.''])=="" || count($carrinhoArray)==0) { ?>
                                            <tr id_linha="<?=$rSql['id']?>" cor_anterior="<?=$cor_anterior_set?>" <?=$style_set?> role="row">
                                            	<td colspan="99" style="text-align:center;">Sem itens para exibir</td>
                                            </tr>
											<?
											} else {
												$valorTotal = 0;
												$corSet = "#ffffff";
												$carrinhoArray = unserialize($_SESSION['adicionais_'.$numeroUnico_produtoS.'']);
												$carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
												foreach ($carrinhoArray as $key => $value) {
													$contLista++;
													if($corSet=="#ffffff") {
														$corSet = "#e2e2e2";
													} else {
														$corSet = "#ffffff";
													}

													if(trim($value['tipo'])=="separador") {
														$cssTd = "border-bottom:0px;font-weight:bold;";
														$tipoEscolhaSet = $value['tipo_escolha'];
														
														if(trim($value['qtd_min'])=="" || trim($value['qtd_min'])=="0") {
															if(trim($value['qtd_max'])=="" || trim($value['qtd_max'])=="0") {
																$txtQtd = "";
															} else {
																$txtQtd = "máximo de ".$value['qtd_max']." itens";
															}
														} else {
															if(trim($value['qtd_max'])=="" || trim($value['qtd_max'])=="0") {
																$txtQtd = "mínimo de ".$value['qtd_min']." itens";
															} else {
																$txtQtd = "mínimo de ".$value['qtd_min']." itens e máximo de ".$value['qtd_max']." itens";
															}
														}
													} else {
														$cssTd = "";
													}
                                            ?>
                                            <tr <? if(trim($value['tipo'])=="separador") { ?>style="background-color: #f2f2f2;"<? } ?> role="row">
                                                <td style="vertical-align:middle;text-align:center;">
												<? if(count($carrinhoArray)==1) { ?>
                                                    <i class="fa fa-circle" style="font-size: 6px;"></i>
                                                <? } else { ?>
													<? if($contLista==count($carrinhoArray)) { ?> 
                                                        <i onClick="produtos_adicionais_ordem('<?=$value['numeroUnico']?>','<?=$value['ordem']?>','menos');" class="fa fa-arrow-up"></i>
                                                    <? } else { ?>
                                                        <? if($contLista==1) { ?> 
                                                            <i onClick="produtos_adicionais_ordem('<?=$value['numeroUnico']?>','<?=$value['ordem']?>','mais');" class="fa fa-arrow-down"></i>
                                                        <? } else { ?>
                                                            <i onClick="produtos_adicionais_ordem('<?=$value['numeroUnico']?>','<?=$value['ordem']?>','menos');" class="fa fa-arrow-up"></i>
                                                            <br />
                                                            <i onClick="produtos_adicionais_ordem('<?=$value['numeroUnico']?>','<?=$value['ordem']?>','mais');" class="fa fa-arrow-down"></i>
                                                        <? } ?>
                                                    <? } ?>
                                                <? } ?>
                                                </td>

												<? if(trim($value['tipo'])=="separador") { ?>
                                                <td colspan="2" style="vertical-align:middle;width:100%;<?=$cssTd?>"><?=$value['titulo']?> 
                                                <? if(trim($value['obrigatorio'])=="1") { ?><div style="float:right;font-size:10px;color:#FFF;background-color:#333;border-radius:3px;padding:3px 5px;">Obrigatório</div><? } ?>
                                                <? if(trim($txtQtd)=="") { } else { ?><i class="fas fa-info-circle" title="<?=$txtQtd?>" style="<? if(trim($value['obrigatorio'])=="1") { ?>margin-right:5px;<? } ?>float:right;font-size:16px;margin-top:3px;"></i><? } ?>
                                                </td>
                                                <? } else { ?>
                                                <td style="vertical-align:middle;width:100%;<?=$cssTd?>">
                                                <? if(trim($tipoEscolhaSet)=="unico") { ?>
                                                <i class="far fa-circle" style="margin-right:5px;"></i>
                                                <? } else if(trim($tipoEscolhaSet)=="multiplo_sem_qtd") { ?>
                                                <i class="far fa-square" style="margin-right:5px;"></i>
                                                <? } else if(trim($tipoEscolhaSet)=="multiplo_com_qtd") { ?>
                                                <i class="fal fa-sort-circle" style="margin-right:5px;"></i>
                                                <? } ?>
                                                <?=$value['nome']?>
                                                </td>
                                                <td style="vertical-align:middle;<?=$cssTd?>"><div style="width:100px;text-align:right;">R$ <?=number_format($value['valor'], 2, ',', '.')?></div></td>
                                                <? } ?>

                                                <td style="vertical-align:middle;<?=$cssTd?>">
                                                    <div class="btn-group">
                                                        <span class="red-sunglo btn btn-sm" onclick="javascript:produtos_adicionais_del('<?=$value['numeroUnico']?>');" title="Excluir"><i class="fa fa-times"></i></span> 
                                                    </div>
												</td>
    
                                            </tr>
												<? } ?>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                    <input type="hidden" id="adicionais_lista" value="<?=$contLista_adicionais?>" />
