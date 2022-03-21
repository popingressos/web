<?
if(trim($_GET['numeroUnico_paiS'])=="") {
	$numeroUnico_paiS = $numeroUnicoGerado;
} else {
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");
	
	$numeroUnico_paiS = $_GET['numeroUnico_paiS'];
}
$carrinhoArray = unserialize($_SESSION['pdv_lista_'.$numeroUnico_paiS.'']);
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
                                    </style>
                                    <table class="table table-striped table-bordered table-hover display table-header-fixed" style="background-color:#ffffff;" cellspacing="0" width="100%">
                                        <thead>

                                            <tr>
                                                <th style="width:50px;">Gênero</th>
                                                <th>Nome</th>
                                                <th>Ingresso</th>
                                                <th>Valor</th>
                                                <th style="width:50px;"></th>
                                            </tr>

                                        </thead>

                                        <tbody>
											<?
											$totalSet = 0;

											$contLista=0;
											if(trim($_SESSION['pdv_lista_'.$numeroUnico_paiS.''])=="" || count($carrinhoArray)==0) { ?>
                                            <tr id_linha="<?=$rSql['id']?>" cor_anterior="<?=$cor_anterior_set?>" <?=$style_set?> role="row">
                                            	<td colspan="99" style="text-align:center;">Sem itens para exibir</td>
                                            </tr>
											<?
											} else {
												$corSet = "#ffffff";
												$carrinhoArray = unserialize($_SESSION['pdv_lista_'.$numeroUnico_paiS.'']);
												$carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
												foreach ($carrinhoArray as $key => $value) {
													$contLista++;
													if($corSet=="#ffffff") {
														$corSet = "#e2e2e2";
													} else {
														$corSet = "#ffffff";
													}

													if(trim($value['pessoa_genero'])=="") {
														$generoSEMSet++;
														$generoTxt = "Sem";
													} else if(trim($value['pessoa_genero'])=="U") {
														$generoUSet++;
														$generoTxt = "Unissex";
													} else if(trim($value['pessoa_genero'])=="F") {
														$generoFSet++;
														$generoTxt = "Feminino";
													} else if(trim($value['pessoa_genero'])=="M") {
														$generoMSet++;
														$generoTxt = "Masculino";
													}
													
													if(trim($value['pessoa_nome'])=="SEM" && trim($value['pessoa_email'])=="SEM" && trim($value['pessoa_documento'])=="SEM") {
														$value['pessoa_nome'] = "Sem beneficiário definido";
														$value['pessoa_email'] = "";
														$value['pessoa_documento'] = "";
													} else {
														if(trim($value['pessoa_nome'])=="SEM") {
															$value['pessoa_nome'] = "";
														} else {
															$value['pessoa_nome'] = "<b>".$value['pessoa_nome']."</b>";
														}
														
														if(trim($value['pessoa_email'])=="SEM") {
															$value['pessoa_email'] = "";
														} else {
															$value['pessoa_email'] = "<br />".$value['pessoa_email']."";
														}
														
														if(trim($value['pessoa_documento'])=="SEM") {
															$value['pessoa_documento'] = "";
														} else {
															$value['pessoa_documento'] = "<br />".mascaraCpf($value['pessoa_documento'])."";
														}
													}
													
													$totalSet = $totalSet + $value['valor'];
                                            ?>
                                            <tr style="background-color:<?=$corSet?>;" role="row">
                                                <td style="vertical-align:top;"><?=$generoTxt?></td>
                                                <td style="vertical-align:top;"><?=$value['pessoa_nome']?><?=$value['pessoa_email']?><?=$value['pessoa_documento']?></td>
                                                <td style="vertical-align:top;"><b><?=$value['evento_nome']?></b><br /><?=$value['ingresso_nome']?></td>
                                                <td style="vertical-align:top;">R$ <?=number_format($value['valor'], 2, ',', '.')?></td>
                                                <td style="vertical-align:middle;" class="block_check_click">
                                                    <div class="btn-group">
                                                        <span class="red-sunglo btn btn-sm" onclick="javascript:pdv_lista_del('<?=$value['numeroUnico']?>');" title="Excluir"><i class="fa fa-times"></i></span> 
                                                    </div>
												</td>
    
                                            </tr>
												<? } ?>
                                            <? } ?>
                                            <tr style="background-color:#39F;" role="row">
                                                <td colspan="5" style="vertical-align:middle;text-align:right;color:#FFF;font-size:20px;"><b>Total À PAGAR:</b> R$ <?=number_format($totalSet, 2, ',', '.')?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <input type="hidden" id="pdv_lista_lista" value="<?=$contLista?>" />
