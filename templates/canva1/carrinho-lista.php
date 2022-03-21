<?php
header('Access-Control-Allow-Origin: *');

if(trim($_GET['reloadS'])=="1") {
	include("".$_SERVER['DOCUMENT_ROOT']."/include/sess.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");
	$numeroUnico_pessoaGet = $_GET['numeroUnico_pessoaS'];
} else {
	$numeroUnico_pessoaGet = $numeroUnico_pessoaGet;
}

$strSqlCreditosComprou = "
SELECT 
	SUM(mod_creditos.valor) AS valor
	
FROM 
	pessoas_creditos AS mod_creditos 

WHERE 
	mod_creditos.stat='1' AND
	mod_creditos.pago='1' AND
	mod_creditos.tipo='comprou' AND
	mod_creditos.numeroUnico_pessoa='".$numeroUnico_pessoaGet."'

ORDER BY
	mod_creditos.data ASC
";
$rSqlCreditosComprou = mysql_fetch_array(mysql_query("".$strSqlCreditosComprou.""));

$strSqlCreditosUsou = "
SELECT 
	SUM(mod_creditos.valor) AS valor
	
FROM 
	pessoas_creditos AS mod_creditos 

WHERE 
	mod_creditos.stat='1' AND
	mod_creditos.pago='1' AND
	mod_creditos.tipo='usou' AND
	mod_creditos.numeroUnico_pessoa='".$numeroUnico_pessoaGet."'

ORDER BY
	mod_creditos.data ASC
";
$rSqlCreditosUsou = mysql_fetch_array(mysql_query("".$strSqlCreditosUsou.""));
$valorTotalCreditos = $rSqlCreditosComprou['valor'] - $rSqlCreditosUsou['valor'];
?>

                        <table class="table cart mb-0">
                            <thead>
                                <tr>
                                    <th class="cart-product-thumbnail">&nbsp;</th>
                                    <th class="cart-product-name">Item</th>
                                    <th class="cart-product-price">Preço Unitário</th>
                                    <th class="cart-product-quantity">Qtd</th>
                                    <th class="cart-product-subtotal">Total</th>
                                    <th class="cart-product-remove">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
						   <?
						   $valorLinha=0;
						   $valorTotalLinha=0;
						   $valorTotal=0;
						   $comCupom=0;
						   $cont=0;
                           $carrinhoArray = unserialize($_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].'']);
						   $carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
                           foreach ($carrinhoArray as $key => $value) {
							   if($value['qtd']>0) {
								    $cont++; 

									$valorTotalLinha = $value['qtd'] * $value['valor_total'];
									
									$achou_cupom = 0;
									
									if(trim($_SESSION['carrinho_cupom_descontos'])=="") {
										$achou_cupom=0;
									} else {
										$cupomArray = unserialize($_SESSION['carrinho_cupom_descontos']);
										foreach ($cupomArray as $keyCupom => $valueCupom) {
											if(trim($value['tipo'])=="evento" || trim($value['tipo'])=="evento-cadeira") {
												if(trim($valueCupom['tipo_item'])=="eventos") {
													if(trim($value['numeroUnico_evento'])==trim($valueCupom['numeroUnico_item'])) {
														$achou_cupom++;
													}
												} else if(trim($valueCupom['tipo_item'])=="tickets") {
													if(trim($value['numeroUnico_ticket'])==trim($valueCupom['numeroUnico_item'])) {
														$achou_cupom++;
													}
												}
											} else if(trim($value['tipo'])=="produto") {
												if(trim($value['numeroUnico_produto'])==trim($valueCupom['numeroUnico_item'])) {
													$achou_cupom++;
												}
											} else if(trim($value['tipo'])=="combo") {
												if(trim($value['numeroUnico_produto'])==trim($valueCupom['numeroUnico_item'])) {
													$achou_cupom++;
												}
											}
										}
									}
										
									if($achou_cupom>0) {
										$comCupom = 1;
										if(trim($_SESSION['carrinho_cupom_tipo_desconto'])=="valor") {
											$valorDescontoCupom = $_SESSION['carrinho_cupom_desconto'];
											$valorLinha = $valorTotalLinha - $valorDescontoCupom;
										} else {
											$porcentagemGet = $_SESSION['carrinho_cupom_desconto'];
											if($porcentagemGet>0) {
												$valorDescontoCupom = ($porcentagemGet / 100) * $valorTotalLinha;
											} else {
												$valorDescontoCupom = 0;
											}
											$valorLinha = $valorTotalLinha - $valorDescontoCupom;
										}
									} else {
										$comCupom = 0;
										$valorLinha = $valorTotalLinha;
									}

									$valorTotal = $valorTotal + $valorLinha;
                           ?>

                           <input type="hidden" id="evento_empresa_<?=$value['numeroUnico_lote']?>" value="<?=$value['empresa']?>" />
                           <input type="hidden" id="evento_empresa_token_<?=$value['numeroUnico_lote']?>" value="<?=$value['empresa_token']?>" />

                           <input type="hidden" id="numeroUnico_loja_<?=$value['numeroUnico_lote']?>" value="<?=$value['numeroUnico_loja']?>" />
                           <input type="hidden" id="numeroUnico_produto_<?=$value['numeroUnico_lote']?>" value="<?=$value['numeroUnico_produto']?>" />
                           <input type="hidden" id="numeroUnico_evento_<?=$value['numeroUnico_lote']?>" value="<?=$value['numeroUnico_evento']?>" />
                           <input type="hidden" id="numeroUnico_ticket_<?=$value['numeroUnico_lote']?>" value="<?=$value['numeroUnico_ticket']?>" />
                           <input type="hidden" id="numeroUnico_lote_<?=$value['numeroUnico_lote']?>" value="<?=$value['numeroUnico_lote']?>" />
                           <input type="hidden" id="lote_<?=$value['numeroUnico_lote']?>" value="<?=$value['lote']?>" />

                           <input type="hidden" id="produto_nome_<?=$value['numeroUnico_lote']?>" value="<?=$value['produto_nome']?>" />
                           <input type="hidden" id="evento_nome_<?=$value['numeroUnico_lote']?>" value="<?=$value['evento_nome']?>" />
                           <input type="hidden" id="ingresso_nome_<?=$value['numeroUnico_lote']?>" value="<?=$value['ticket_nome']?>" />
                           <input type="hidden" id="ingresso_data_<?=$value['numeroUnico_lote']?>" value="<?=$value['ingresso_data']?>" />
                           <input type="hidden" id="ticket_genero_<?=$value['numeroUnico_lote']?>" value="<?=$value['ticket_genero']?>" />
                           <input type="hidden" id="ticket_compra_autorizada_<?=$value['numeroUnico_lote']?>" value="<?=$value['ticket_compra_autorizada']?>" />
                           <input type="hidden" id="imagem_<?=$value['numeroUnico_lote']?>" value="<?=$value['imagem']?>" />
                           <input type="hidden" id="ticket_exibir_lote_<?=$value['numeroUnico_lote']?>" value="<?=$value['ticket_exibir_lote']?>" />
                           <input type="hidden" id="ticket_exibir_taxa_<?=$value['numeroUnico_lote']?>" value="<?=$value['ticket_exibir_taxa']?>" />
                           <input type="hidden" id="ticket_exigir_atribuicao_<?=$value['numeroUnico_lote']?>" value="<?=$value['ticket_exigir_atribuicao']?>" />
                           
                           <input type="hidden" id="valor_<?=$value['numeroUnico_lote']?>" value="<?=$value['valor']?>" />
                           <input type="hidden" id="valor_subtotal_<?=$value['numeroUnico_lote']?>" value="<?=$value['valor_subtotal']?>" />
                           <input type="hidden" id="valor_total_<?=$value['numeroUnico_lote']?>" value="<?=$value['valor_total']?>" />
                           <input type="hidden" id="valor_pago_<?=$value['numeroUnico_lote']?>" value="<?=$value['valor_pago']?>" />
                           <input type="hidden" id="valor_promocional_<?=$value['numeroUnico_lote']?>" value="<?=$value['valor_promocional']?>" />

                            <tr class="cart_item">
                                <td class="cart-product-thumbnail">
                                    <a href="#">
									<? if(trim($value['imagem'])=="") { ?>
                                    <img width="64" height="64" src="<?=$link_modelo?>templates/<?=$pasta_template?>/images/sem_imagem.png" style="border: 1px solid #E5E5E5;border-radius: 5px 5px 0px 0px;" alt="<?=$rSql['eventos_nome']?>">
								    <? } else { ?>
                                    <img width="64" height="64" src="<?=$value['imagem']?>">
                                    <? } ?>
                                    </a>
                                </td>

                                <td class="cart-product-name">
                                    <? if(trim($value['tipo'])=="evento") { ?>
                                    <a href="#"><?=$value['evento_nome']?></a>
                                    <p><?=$value['ingresso_nome']?></p>
                                    <? if(trim($value['ticket_exibir_lote'])=="1") { ?>
                                    <p class="text-success"><?=$value['lote']?>° Lote</p>
                                    <? } ?>
                                    <? } else if(trim($value['tipo'])=="produto" || trim($value['tipo'])=="combo") { ?>
                                    <a href="#"><?=$value['produto_nome']?></a>
                                    <? } ?>
                                </td>

                                <td class="cart-product-price">
                                    <span class="amount"><?="R$ ".number_format($value['valor_total'], 2, ',', '.').""?></span>
                                </td>

                                <td class="cart-product-quantity">
                                	<? if(trim($value['tipo'])=="evento-cadeira") { ?>
                                    <div class="quantity">
                                        <input type="text" name="quantity" id="qtd_<?=$value['numeroUnico_lote']?>"value="<?=$value['qtd']?>" class="qty" />
                                    </div>
                                    <? }  else { ?>
                                    <div class="quantity">
                                        <input type="button" value="-" onclick="javascript:interacaoCarrinho('<?=$value['numeroUnico_lote']?>','menos','<?=$value['tipo']?>');" class="minus">
                                        <input type="text" name="quantity" id="qtd_<?=$value['numeroUnico_lote']?>"value="<?=$value['qtd']?>" class="qty" />
                                        <input type="button" value="+" onclick="javascript:interacaoCarrinho('<?=$value['numeroUnico_lote']?>','mais','<?=$value['tipo']?>');" class="plus">
                                    </div>
                                    <? } ?>
                                </td>

                                <td class="cart-product-subtotal">
                                	<? if($comCupom=="1") { ?>
                                    <span style="width:100% !important;" class="amount"><strike><?="R$ ".number_format($valorTotalLinha, 2, ',', '.').""?></strike></span><br />
                                    <span style="width:100% !important;" class="amount"><?="R$ ".number_format($valorLinha, 2, ',', '.').""?></span>
                                    <? } else { ?>
                                    <span class="amount"><?="R$ ".number_format($valorLinha, 2, ',', '.').""?></span>
                                    <? } ?>
                                </td>

                                <td class="cart-product-remove">
                                    <a href="javascript:void(0);" onclick="javascript:carrinhoDel('<?=$value['numeroUnico']?>','<?=$value['numeroUnico_lote']?>');" class="remove" title="Remove this item"><i class="icon-trash2"></i></a>
                                </td>
                            </tr>
							   <? } ?>
                           <? } ?>
                            <? if(trim($configuracoes_site['checkout_com_cupom'])=="1") { ?>
                            <tr class="cart_item">
                                <td colspan="6">
                                    <div class="row justify-content-between py-2 col-mb-30">
                                        <div class="col-lg-auto ps-lg-0">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <input type="text" class="sm-form-control text-md-start" style="text-transform:uppercase;" name="codigo_cupom" id="codigo_cupom" value="<?=$_SESSION['carrinho_cupom']?>" />
                                                </div>
                                                <div class="col-md-4 mt-3 mt-md-0">
                                                    <? if(trim($_SESSION['carrinho_cupom'])=="") { ?>
                                                    <a href="javascript:void(0);" onclick="javascript:carrinhoCupomReload('');" class="button button-3d btn-verde m-0">Aplicar Cupom</a>
                                                    <? } else { ?>
                                                    <a href="javascript:void(0);" onclick="javascript:carrinhoCupomReload('limpar');" class="button button-3d btn-vermelho m-0">Limpar Cupom</a>
                                                    <? } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <? } ?>
                        </table>

                        <input type="hidden" value="<?=$valorTotalCreditos?>" id="valor_credito_real">
                        <input type="hidden" value="<?="R$ ".number_format($valorTotalCreditos, 2, ',', '.').""?>" id="valor_credito_txt">

                        <input type="hidden" value="<?=$valorTotal?>" id="valor_cobranca_real">
                        <input type="hidden" value="<?="R$ ".number_format($valorTotal, 2, ',', '.').""?>" id="valor_cobranca_txt">
