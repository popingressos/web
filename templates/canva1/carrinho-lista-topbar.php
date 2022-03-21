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
						   <? if($nCarrinho>0) { ?>
                           <a href="https://<?=$_SERVER["SERVER_NAME"]?>/checkout/" id="top-cart-trigger"><i class="icon-line-bag"></i><span class="top-cart-number"><?=$nCarrinho?></span></a>
                           <div class="top-cart-content">
                               <div class="top-cart-title">
                                   <h4>Meu Carrinho</h4>
                               </div>
                               <div class="top-cart-items">
									<?
									$total = 0;
                                    $carrinhoArray = unserialize($_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].'']);
                                    $carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
                                    foreach ($carrinhoArray as $key => $value) {
                                        $totalLinha = $value['qtd'] * $value['valor_total'];
										
										$total = $total + $totalLinha;
                                    ?>
                                    <div class="top-cart-item">
                                        <div class="top-cart-item-desc" style="padding-left:0px;">
                                            <div class="top-cart-item-desc-title">
                                               <? if(trim($value['tipo'])=="evento") { ?>
                                               <a href="#"><?=$value['evento_nome']?><br /><i><?=$value['ingresso_nome']?> <?=$value['lote']?>° Lote</i></a>
                                               <? } else if(trim($value['tipo'])=="produto" || trim($value['tipo'])=="combo") { ?>
                                               <a href="#"><?=$value['produto_nome']?></a>
                                               <? } ?>
                                               <span class="top-cart-item-price d-block"><?="R$ ".number_format($value['valor_total'], 2, ',', '.').""?></span>
                                           </div>
                                           <div class="top-cart-item-quantity"><?=$value['qtd']?>x</div>
                                       </div>
                                   </div>
                                   <? } ?>
                               </div>
                               <div class="top-cart-action" style="justify-content: center;">
                                   <span class="top-checkout-price float-end"><?="R$ ".number_format($total, 2, ',', '.').""?></span>
                               </div>
                               <div class="top-cart-action" style="justify-content: center;">
                                   <a href="https://<?=$_SERVER["SERVER_NAME"]?>/checkout/" class="button button-3d button-small m-0">Finalizar Compra</a>
                               </div>
                           </div>
                           <? } else { ?>
                           <a href="https://<?=$_SERVER["SERVER_NAME"]?>/checkout/"><i class="icon-line-bag"></i><span class="top-cart-number"><?=$nCarrinho?></span></a>
                           <? } ?>


