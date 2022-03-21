<?php
header('Access-Control-Allow-Origin: *');

if(trim($_GET['reloadS'])=="1") {
	include("".$_SERVER['DOCUMENT_ROOT']."/include/sess.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");
}
?>

					    <? 
                        if(trim($_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].''])=="") {
                           $nCarrinho = 0;
                        } else {
                           $nCarrinho = count(unserialize($_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].'']));
                        }
                        ?>
                        <? if($nCarrinho==0) { } else { ?>
                        <style>
                        .campo_codigo_cupom {
							width:40% !important;
							float:left;
						}
                        </style>
                            <table class="table cart mb-5">
                                <thead>
                                    <tr>
                                        <th class="cart-product-thumbnail">&nbsp;</th>
                                        <th class="cart-product-name">Item</th>
                                        <th class="cart-product-price">Preço Unitário</th>
                                        <th class="cart-product-quantity">Qtd</th>
                                        <th class="cart-product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
									 <?
                                     $valorTotal=0;
                                     $cont=0;
                                     $cont_marcado=0;
                                     $carrinhoDetalhadoArray = unserialize($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].'']);
                                     $carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'numeroUnico_lote', SORT_ASC);
                                     $carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'ordem', SORT_ASC);
                                     foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
                                        $cont++;
    
                                        if($valueDetalhado['valor_promocional']>0) {
                                            $valueDetalhado['valor_venda'] = $valueDetalhado['valor_promocional'];
                                        } else {
                                            $valueDetalhado['valor_venda'] = $valueDetalhado['valor_total'];
                                        }
                                    
                                        $valorTotalLinha = $valueDetalhado['qtd'] * $valueDetalhado['valor_venda'];
    
                                        $achou_cupom = 0;
                                        
                                        if(trim($_SESSION['carrinho_cupom_descontos'])=="") {
                                            $achou_cupom++;
                                        } else {
                                            $cupomArray = unserialize($_SESSION['carrinho_cupom_descontos']);
                                            foreach ($cupomArray as $keyCupom => $valueCupom) {
                                                if(trim($valueDetalhado['tipo'])=="evento") {
                                                    if(trim($valueCupom['tipo'])=="evento") {
                                                        if(trim($valueDetalhado['numeroUnico_evento'])==trim($valueCupom['numeroUnico_evento'])) {
                                                            $achou_cupom++;
                                                        }
                                                    } else if(trim($valueCupom['tipo'])=="ticket") {
                                                        if(trim($valueDetalhado['numeroUnico_ticket'])==trim($valueCupom['numeroUnico_ticket'])) {
                                                            $achou_cupom++;
                                                        }
                                                    }
                                                } else if(trim($valueDetalhado['tipo'])=="produto") {
                                                    if(trim($valueDetalhado['numeroUnico_produto'])==trim($valueCupom['numeroUnico_produto'])) {
                                                        $achou_cupom++;
                                                    }
                                                } else if(trim($valueDetalhado['tipo'])=="combo") {
                                                    if(trim($valueDetalhado['numeroUnico_produto'])==trim($valueCupom['numeroUnico_combo'])) {
                                                        $achou_cupom++;
                                                    }
                                                }
                                            }
                                        }
										
                                        if($achou_cupom>0) {
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
                                            $valorLinha = $valorTotalLinha;
                                        }
    
                                        $valorTotal = $valorTotal + $valorLinha;

										if(trim($valueDetalhado['imagem'])=="") {
											$valueDetalhado['imagem'] = "".$link_modelo."templates/".$pasta_template."/images/sem_imagem.png";
										} else {
											$valueDetalhado['imagem'] = $valueDetalhado['imagem'];
										}
                                     ?>
                                    <tr class="cart_item">
                                        <td class="cart-product-thumbnail">
                                            <a href="#">
											<? if(trim($valueDetalhado['imagem'])=="") { ?>
                                            <img width="64" height="64" src="<?=$link_modelo?>templates/<?=$pasta_template?>/images/sem_imagem.png" style="border: 1px solid #E5E5E5;border-radius: 5px 5px 0px 0px;" alt="<?=$rSql['eventos_nome']?>">
                                            <? } else { ?>
                                            <img width="64" height="64" src="<?=$valueDetalhado['imagem']?>">
                                            <? } ?>
                                            </a>
                                        </td>
        
                                        <td class="cart-product-name">
                                            <? if(trim($valueDetalhado['tipo'])=="evento") { ?>
                                            <a href="#"><?=$valueDetalhado['evento_nome']?></a>
                                            <p><?=$valueDetalhado['ingresso_nome']?></p>
                                            <p class="text-success"><?=$valueDetalhado['lote']?>° Lote</p>
                                            <? } else if(trim($valueDetalhado['tipo'])=="produto" || trim($valueDetalhado['tipo'])=="combo") { ?>
                                            <a href="#"><?=$valueDetalhado['produto_nome']?></a>
                                            <? } ?>
                                        </td>
        
                                        <td class="cart-product-price">
                                            <span class="amount"><?="R$ ".number_format($valueDetalhado['valor_total'], 2, ',', '.').""?></span>
                                        </td>
        
                                        <td class="cart-product-quantity">
                                            <?=$valueDetalhado['qtd']?>
                                        </td>
        
                                        <td class="cart-product-subtotal">
                                            <span class="amount"><?="R$ ".number_format($valorLinha, 2, ',', '.').""?></span>
                                        </td>
        
                                    </tr>
                                    <? } ?>

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
                                                            <a href="javascript:void(0);" onclick="javascript:carrinhoCupom('');" class="button button-3d btn-verde m-0">Aplicar Cupom</a>
                                                            <? } else { ?>
                                                            <a href="javascript:void(0);" onclick="javascript:carrinhoCupom('limpar');" class="button button-3d btn-vermelho m-0">Limpar Cupom</a>
                                                            <? } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
        
                            </table>

                            <button type="button" class="button button-3d btn-verde-whats mb-3" style="float:right;" onclick="javascript:carrinhoAccordion('TAB_endereco');">Confirmar e Avançar</button>
                        <? } ?>
                        <input type="hidden" value="<?=$valorTotal?>" id="valor_cobranca_real">
                        <input type="hidden" value="<?="R$ ".number_format($valorTotal, 2, ',', '.').""?>" id="valor_cobranca_txt">
