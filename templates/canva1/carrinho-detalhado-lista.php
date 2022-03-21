<?php
header('Access-Control-Allow-Origin: *');

if(trim($_GET['reloadS'])=="1") {
	include("".$_SERVER['DOCUMENT_ROOT']."/include/sess.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");
}
?>

					    <? 
                        if(trim($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].''])=="") {
                           $nCarrinho = 0;
                        } else {
                           $nCarrinho = count(unserialize($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].'']));
                        }
                        ?>
                        <? if($nCarrinho==0) { } else { ?>
						   <?
						   $cont_ingressos=0;
                           $carrinhoDetalhadoArray = unserialize($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].'']);
						   $carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'numeroUnico_lote', SORT_ASC);
						   $carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'ordem', SORT_ASC);
                           foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
							   if(trim($valueDetalhado['tipo'])=="evento" || trim($valueDetalhado['tipo'])=="evento-cadeira") {
								   $cont_ingressos++;
							   }
						   }
                           ?>
                        <? if($cont_ingressos==0) { ?>
                        <div class="col-lg-12" style="padding-left:0px;padding-right:0px;">
                           <div class="iq-card">
                              <h4 class="card-title text-center pt-2 pb-2">Seu carrinho não possui itens do tipo ingresso</h4>
                           </div>
                        </div>
                        <? } else { ?>
                        <div class="col-lg-12" style="padding-left:0px;padding-right:0px;">
                        <table class="table cart mb-0">
                            <tbody>
						   <?
						   $total=0;
						   $cont=0;
						   $cont_marcado=0;
                           $carrinhoDetalhadoArray = unserialize($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].'']);
						   $carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'numeroUnico_lote', SORT_ASC);
						   $carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'ordem', SORT_ASC);
                           foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
							   
							   if(trim($valueDetalhado['tipo'])=="evento" || trim($valueDetalhado['tipo'])=="evento-cadeira") {
							   $cont++;

							   $ja_existe = 0;
							   if($valueDetalhado['ticket_exigir_atribuicao']=="1") { 
								   if($valueDetalhado['marcado']=="1") { 
									   $cont_marcado++;
	
									   if(trim($valueDetalhado['email_enviar'])=="1") {
										   $email_enviar_checked = "1";
										   $valueDetalhado['email_enviar'] = "1";
									   } else {
										   $email_enviar_checked = "0";
										   $valueDetalhado['email_enviar'] = "0";
									   }
	
									   if(trim($valueDetalhado['telefone_enviar'])=="1") {
										   $telefone_enviar_checked = "1";
										   $valueDetalhado['telefone_enviar'] = "1";
									   } else {
										   $telefone_enviar_checked = "0";
										   $valueDetalhado['telefone_enviar'] = "0";
									   }
	
									   $display_marcado_pessoa_nome = "block";
									   $display_marcado_pessoa_documento = "block";
									   $display_marcado_pessoa_email = "block";
									   $display_marcado_pessoa_telefone = "block";
	
									   $display_pessoa_nome = "none";
									   $display_pessoa_documento = "none";
									   $display_pessoa_email = "none";
									   $display_pessoa_telefone = "none";
	
									   $display_BTN_meu_desmarcar = "block";
									   $display_BTN_meu_marcar = "none";
	
									   $display_BTN_carrinho_desmarcar = "block";
									   $display_BTN_carrinho_marcar = "none";
	
									   $display_DIV_msg_meu_outro = "none";
	
									   if(trim($valueDetalhado['pessoa_documento'])==trim($rSqlUsuario['documento'])) {
										   $display_CAMPOS_meu = "block";
										   $display_CAMPOS_outro = "none";
									   } else {
										   $display_CAMPOS_meu = "none";
										   $display_CAMPOS_outro = "block";
									   }
								   } else {
									   $carrinhoDetalhadoArrayIn = unserialize($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].'']);
									   foreach ($carrinhoDetalhadoArrayIn as $keyDetalhadoIn => $valueDetalhadoIn) {
										   if($valueDetalhadoIn['marcado']=="1") {
											   if($valueDetalhado['numeroUnico_evento']==$valueDetalhadoIn['numeroUnico_evento']) {
												   if($valueDetalhadoIn['pessoa_documento']==$rSqlUsuario['documento']) {
													   $ja_existe = 1;
												   }
											   }
										   }
									   }
	
									   if(trim($valueDetalhado['email_enviar'])=="0") {
										   $email_enviar_checked = "1";
										   $valueDetalhado['email_enviar'] = "1";
									   } else {
										   $email_enviar_checked = "1";
										   $valueDetalhado['email_enviar'] = "1";
									   }
									   
									   if(trim($valueDetalhado['telefone_enviar'])=="0") {
										   $telefone_enviar_checked = "1";
										   $valueDetalhado['telefone_enviar'] = "1";
									   } else {
										   $telefone_enviar_checked = "1";
										   $valueDetalhado['telefone_enviar'] = "1";
									   }
									   
									   if(trim($valueDetalhado['ticket_genero'])=="" || trim($valueDetalhado['ticket_exibir_taxa'])=="U") { 
									       $generoSet = ""; 
									       $valueDetalhado['ticket_genero'] = "U";
									   } else if(trim($valueDetalhado['ticket_genero'])=="F") {
									       $generoSet = "Feminino"; 
									   } else if(trim($valueDetalhado['ticket_genero'])=="M") {
									   	   $generoSet = "Masculino"; 
									   }

									   #$valueDetalhado['pessoa_nome'] = "".$rSqlUsuario['nome']."";
									   #$valueDetalhado['pessoa_documento'] = "".$rSqlUsuario['documento']."";
									   #$valueDetalhado['pessoa_email'] = "".$rSqlUsuario['email']."";
									   #$valueDetalhado['pessoa_telefone'] = "".$rSqlUsuario['whatsapp']."";
	
									   $display_marcado_pessoa_nome = "none";
									   $display_marcado_pessoa_documento = "none";
									   $display_marcado_pessoa_email = "none";
									   $display_marcado_pessoa_telefone = "none";
	
									   $display_pessoa_nome = "block";
									   $display_pessoa_documento = "block";
									   $display_pessoa_email = "block";
									   $display_pessoa_telefone = "block";
	
									   $display_CAMPOS_meu = "block";
									   $display_CAMPOS_outro = "none";
	
									   $display_BTN_meu_desmarcar = "none";
									   $display_BTN_meu_marcar = "block";
	
									   $display_DIV_msg_meu_outro = "block";
	
									   $display_BTN_carrinho_desmarcar = "none";
									   $display_BTN_carrinho_marcar = "block";
								   }
							   } else {
								   $cont_marcado++;
							   }
                           ?>
                            <input type="hidden" id="evento_empresa_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['empresa']?>" />
                            <input type="hidden" id="evento_empresa_token_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['empresa_token']?>" />

                            <input type="hidden" id="numeroUnico_loja_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['numeroUnico_loja']?>" />
                            <input type="hidden" id="numeroUnico_produto_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['numeroUnico_produto']?>" />
                            <input type="hidden" id="numeroUnico_evento_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['numeroUnico_evento']?>" />
                            <input type="hidden" id="numeroUnico_ticket_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['numeroUnico_ticket']?>" />
                            <input type="hidden" id="lote_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['lote']?>" />

                            <input type="hidden" id="produto_nome_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['produto_nome']?>" />
                            <input type="hidden" id="evento_nome_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['evento_nome']?>" />
                            <input type="hidden" id="ingresso_nome_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['ingresso_nome']?>" />
                            <input type="hidden" id="ingresso_data_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['ingresso_data']?>" />
                            <input type="hidden" id="ticket_genero_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['ticket_genero']?>" />
                            <input type="hidden" id="ticket_compra_autorizada_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['ticket_compra_autorizada']?>" />
                            <input type="hidden" id="imagem_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['imagem']?>" />
                            <input type="hidden" id="ticket_exibir_lote_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['ticket_exibir_lote']?>" />
                            <input type="hidden" id="ticket_exibir_taxa_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['ticket_exibir_taxa']?>" />
                            <input type="hidden" id="ticket_exigir_atribuicao_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['ticket_exigir_atribuicao']?>" />

                            <input type="hidden" id="valor_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['valor']?>" />
                            <input type="hidden" id="valor_subtotal_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['valor_subtotal']?>" />
                            <input type="hidden" id="valor_total_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['valor_total']?>" />
                            <input type="hidden" id="valor_pago_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['valor_pago']?>" />
                            <input type="hidden" id="valor_promocional_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['valor_promocional']?>" />

                            <tr class="cart_item">
                                <td style="vertical-align:top !important;padding-left:0px !important;" class="td_thumb cart-product-thumbnail">
                                    <a href="#">
									<? if(trim($valueDetalhado['imagem'])=="") { ?>
                                    <img width="64" height="64" src="<?=$link_modelo?>templates/<?=$pasta_template?>/images/sem_imagem.png" style="border: 1px solid #E5E5E5;border-radius: 5px 5px 0px 0px;" alt="<?=$rSql['eventos_nome']?>">
								    <? } else { ?>
                                    <img width="64" height="64" src="<?=$valueDetalhado['imagem']?>">
                                    <? } ?>
                                    </a>
                                </td>

                                <td style="vertical-align:top !important;" class="td_detalhes cart-product-name">
                                    <? if(trim($valueDetalhado['tipo'])=="evento") { ?>
                                    <a href="#"><?=$valueDetalhado['evento_nome']?></a>
                                    <p><?=$valueDetalhado['ingresso_nome']?></p>
                                    <? if(trim($valueDetalhado['ticket_exibir_lote'])=="1") { ?>
                                    <p class="text-success"><?=$valueDetalhado['lote']?>° Lote</p>
                                    <? } ?>
                                    <? if(trim($generoSet)=="") { } else { ?>
                                    <b><i><?=$generoSet?></i></b><br />
                                    <? } ?>
                                    <? } else if(trim($valueDetalhado['tipo'])=="produto" || trim($valueDetalhado['tipo'])=="combo") { ?>
                                    <a href="#"><?=$valueDetalhado['produto_nome']?></a>
                                    <? } ?>
                                </td>

                                <? if($valueDetalhado['ticket_exigir_atribuicao']=="1") { ?>
                                <td style="padding-right:0px !important;" class="td_campos">
        
                                     <div class="col-sm-12" style="padding-right:0px !important;">
                                        
                                        <div class="row align-items-center mt-2">

                                            <div numeroUnico_evento="<?=$valueDetalhado['numeroUnico_evento']?>"
                                                 numeroUnico="<?=$valueDetalhado['numeroUnico']?>"
                                                 id="DIV_msg_meu_outro_<?=$valueDetalhado['numeroUnico']?>" 
                                                 class="<?=$valueDetalhado['numeroUnico_evento']?> col-lg-12 mb-2" 
                                                 style="border-left: 2px solid #0da3e1;background-color: #d3f2ff;color: #777d74;padding: 10px;display:<?=$display_DIV_msg_meu_outro?>;">
                                                  Você deve informar se o ingresso é seu ou será enviado para outra pessoa
                                            </div>
    
                                           <div numeroUnico_evento="<?=$valueDetalhado['numeroUnico_evento']?>"
                                                numeroUnico="<?=$valueDetalhado['numeroUnico']?>" 
                                                id="BTN_meu_marcar_<?=$valueDetalhado['numeroUnico']?>" 
                                                class="<?=$valueDetalhado['numeroUnico_evento']?> col-sm-12 col-md-12 mb-2" style="display:<?=$display_BTN_meu_marcar?>;">
                                               <div class="row">
                                                   <div class="btn_eu_meu col-sm-6 col-md-6">
                                                       <button type="button" class="button button-3d btn-verde-whats w-100"
                                                       style="margin-left:0px !important;font-size: 12px;padding: 8px 10px;" 
                                                       onclick="javascript:carrinhoSimMeu('<?=$valueDetalhado['numeroUnico']?>','1','<?=$valueDetalhado['numeroUnico_evento']?>');">SIM, esse ingresso é meu</button>
                                                   </div>
                                                   <div class="btn_outro col-sm-6 col-md-6">
                                                       <button type="button" class="button button-3d btn-azul w-100" 
                                                       style="margin-left:0px !important;margin-right:0px !important;font-size: 12px;padding: 8px 10px;"
                                                       onclick="javascript:carrinhoOutro('<?=$valueDetalhado['numeroUnico']?>');">Esse ingresso é para outra pessoa</button>
                                                   </div>
                                               </div>
                                           </div>

                                           <div numeroUnico_evento="<?=$valueDetalhado['numeroUnico_evento']?>" 
                                                numeroUnico="<?=$valueDetalhado['numeroUnico']?>"
                                                id="BTN_meu_desmarcar_<?=$valueDetalhado['numeroUnico']?>" 
                                                class="<?=$valueDetalhado['numeroUnico_evento']?> col-sm-12 col-md-12 mb-2" style="display:<?=$display_BTN_meu_desmarcar?>;">
                                               <div class="row">
                                                   <div class="col-sm-12 col-md-12" style="padding-left:0px;padding-right:0px;">
                                                       <button type="button" id="BTN_emeu_desmarcar_<?=$valueDetalhado['numeroUnico']?>" class="button button-3d btn-azul w-100" 
                                                       style="margin-left:0px !important;margin-right:0px !important;font-size: 12px;padding: 8px 10px;"
                                                       onclick="javascript:carrinhoMeu('<?=$valueDetalhado['numeroUnico']?>','0','<?=$valueDetalhado['numeroUnico_evento']?>');">Enviar ingresso para outra pessoa</button>
                                                   </div>
                                               </div>
                                           </div>

                                           <input type="hidden" 
                                                  numeroUnico_evento="<?=$valueDetalhado['numeroUnico_evento']?>"
                                                  numeroUnico="<?=$valueDetalhado['numeroUnico']?>"
                                                  class="<?=$valueDetalhado['numeroUnico_evento']?> form-control" id="marcado_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['marcado']?>" />

                                           <input type="hidden" class="form-control" id="compra_autorizada_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['ticket_compra_autorizada']?>" />
                                           <input type="hidden" class="form-control" id="usuario_pessoa_nome_<?=$valueDetalhado['numeroUnico']?>" value="<?=$rSqlUsuario['nome']?>" />
                                           <input type="hidden" class="form-control documento" id="usuario_pessoa_documento_<?=$valueDetalhado['numeroUnico']?>" value="<?=$rSqlUsuario['documento']?>" />
                                           <input type="hidden" class="form-control mb-2" id="usuario_pessoa_email_<?=$valueDetalhado['numeroUnico']?>" value="<?=$rSqlUsuario['email']?>" onblur="javascript:validarEmail('pessoa_email_<?=$valueDetalhado['numeroUnico']?>');" />
                                           <input type="hidden" class="form-control telefone_whatsapp mb-2" id="usuario_pessoa_telefone_<?=$valueDetalhado['numeroUnico']?>" value="<?=$rSqlUsuario['whatsapp']?>" />


                                           <div class="col-sm-12 col-md-12 mb-2" style="padding-left:0px;padding-right:0px;">
                                              <label for="nome" class="mb-0 w-100" style="text-align:left !important;">Nome</label>
                                              <input type="text" class="form-control" disabled="disabled" id="marcado_pessoa_nome_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['pessoa_nome']?>" style="display:<?=$display_marcado_pessoa_nome?>" />
                                              <input type="text"
                                                     numeroUnico_evento="<?=$valueDetalhado['numeroUnico_evento']?>"  
                                                     numeroUnico="<?=$valueDetalhado['numeroUnico']?>"  
                                                     class="<?=$valueDetalhado['numeroUnico_evento']?> form-control" id="pessoa_nome_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['pessoa_nome']?>" style="display:<?=$display_pessoa_nome?>" />
                                           </div>
                                           <div class="col-sm-12 col-md-12 mb-2" style="padding-left:0px;padding-right:0px;">
                                              <label for="nome" class="mb-0 w-100" style="text-align:left !important;">CPF</label>
                                              <input type="text" class="form-control documento" disabled="disabled" id="marcado_pessoa_documento_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['pessoa_documento']?>" style="display:<?=$display_marcado_pessoa_documento?>" />
                                              <input type="text"
                                                     numeroUnico_evento="<?=$valueDetalhado['numeroUnico_evento']?>"  
                                                     numeroUnico="<?=$valueDetalhado['numeroUnico']?>"  
                                                     class="<?=$valueDetalhado['numeroUnico_evento']?> form-control documento" id="pessoa_documento_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['pessoa_documento']?>" style="display:<?=$display_pessoa_documento?>" />
                                           </div>
                                           <div class="col-sm-12 col-md-12 mb-2" style="padding-left:0px;padding-right:0px;">
                                              <label for="nome" class="mb-0 w-100" style="text-align:left !important;">E-mail</label>
                                              <input type="text" class="form-control mb-2" disabled="disabled" id="marcado_pessoa_email_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['pessoa_email']?>" style="display:<?=$display_marcado_pessoa_email?>" /> 
                                              <input type="text"
                                                     numeroUnico_evento="<?=$valueDetalhado['numeroUnico_evento']?>"  
                                                     numeroUnico="<?=$valueDetalhado['numeroUnico']?>"  
                                                     class="<?=$valueDetalhado['numeroUnico_evento']?> form-control mb-2" id="pessoa_email_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['pessoa_email']?>" style="display:<?=$display_pessoa_email?>" 
                                                     onblur="javascript:validarEmail('pessoa_email_<?=$valueDetalhado['numeroUnico']?>');" />
                                              
                                              <div id="DIV_pessoa_email_<?=$valueDetalhado['numeroUnico']?>_valido" style="display:none;color:#777;font-size:11px;"><i style="color:#25D366;" class="far fa-check-circle"></i>&nbsp;&nbsp;E-mail informado é válido</div>
                                              <div id="DIV_pessoa_email_<?=$valueDetalhado['numeroUnico']?>_invalido" style="display:none;color:#777;font-size:11px;"><i style="color:#e70101;" class="far fa-engine-warning"></i>&nbsp;&nbsp;E-mail informado é inválido</div>
                                              <input type="hidden" id="pessoa_email_<?=$valueDetalhado['numeroUnico']?>_valido" value="0">
                                              
                                               <div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline mr-1">
                                                   <div class="custom-switch-inner">
                                                       <input type="hidden" class="form-control" id="email_enviar_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['email_enviar']?>" />
                                                       <input type="checkbox" class="custom-control-input email_check bg-success" numeroUnico="<?=$valueDetalhado['numeroUnico']?>" 
                                                       id="pessoa_email_check_<?=$valueDetalhado['numeroUnico']?>"
                                                       <? if(trim($email_enviar_checked)=="1") { ?>checked="checked"<? } ?>>
                                                       <label class="custom-control-label" for="pessoa_email_check_<?=$valueDetalhado['numeroUnico']?>" data-on-label="SIM" data-off-label="NÃO"></label>
                                                   </div>
                                               </div>
                                               Deseja receber a informação da sua compra neste e-mail informado?
                                           </div>
                                           <div class="col-sm-12 col-md-12 mb-2" style="padding-left:0px;padding-right:0px;">
                                              <label for="nome" class="mb-0 w-100" style="text-align:left !important;">Telefone</label>
                                              <input type="text" class="form-control telefone_whatsapp mb-2" disabled="disabled" id="marcado_pessoa_telefone_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['pessoa_telefone']?>" style="display:<?=$display_marcado_pessoa_telefone?>" />
                                              <input type="text"
                                                     numeroUnico_evento="<?=$valueDetalhado['numeroUnico_evento']?>"  
                                                     numeroUnico="<?=$valueDetalhado['numeroUnico']?>"  
                                                     class="<?=$valueDetalhado['numeroUnico_evento']?> form-control telefone_whatsapp mb-2" id="pessoa_telefone_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['pessoa_telefone']?>" style="display:<?=$display_pessoa_telefone?>" />
                                              <div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline mr-1">
                                                  <div class="custom-switch-inner">
                                                      <input type="hidden" class="form-control" id="telefone_enviar_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['telefone_enviar']?>" />
                                                      <input type="checkbox" class="custom-control-input telefone_check bg-success" numeroUnico="<?=$valueDetalhado['numeroUnico']?>" 
                                                      id="pessoa_telefone_check_<?=$valueDetalhado['numeroUnico']?>"
                                                      <? if(trim($telefone_enviar_checked)=="1") { ?>checked="checked"<? } ?>>
                                                      <label class="custom-control-label" for="pessoa_telefone_check_<?=$valueDetalhado['numeroUnico']?>" data-on-label="SIM" data-off-label="NÃO"></label>
                                                  </div>
                                              </div>
                                              Deseja receber a informação da sua compra neste telefone informado?
                                           </div>
                                           <div class="col-sm-12 col-md-12">
                                               <div class="row">
                                                   <div class="col-sm-12 col-md-12 mb-2" style="padding-left:0px;padding-right:0px;">
                                                       <button type="button" id="BTN_carrinho_desmarcar_<?=$valueDetalhado['numeroUnico']?>" class="button button-3d btn-azul w-100" 
                                                        style="margin-left:0px !important;margin-right:0px !important;font-size: 12px;padding: 8px 10px;display:<?=$display_BTN_carrinho_desmarcar?>;"
                                                        onclick="javascript:carrinhoMarcacao('<?=$valueDetalhado['numeroUnico']?>','0','<?=$valueDetalhado['numeroUnico_evento']?>');">Retirar Atribuição</button>
        
                                                       <button type="button" id="BTN_carrinho_marcar_<?=$valueDetalhado['numeroUnico']?>" class="button button-3d btn-verde-whats w-100" 
                                                        style="margin-left:0px !important;margin-right:0px !important;font-size: 12px;padding: 8px 10px;display:<?=$display_BTN_carrinho_marcar?>;"
                                                        onclick="javascript:carrinhoMarcacao('<?=$valueDetalhado['numeroUnico']?>','1','<?=$valueDetalhado['numeroUnico_evento']?>');">Atribuir Ingresso</button>
                                                   </div>
                                                   <div class="col-sm-6 col-md-6" style="display:none;">
                                                       <button type="button" class="button button-3d btn-vermelho w-100" 
                                                        style="margin-left:0px !important;margin-right:0px !important;font-size: 12px;padding: 8px 10px;"
                                                        onclick="javascript:carrinhoDetalhadoDel('<?=$valueDetalhado['numeroUnico']?>','<?=$valueDetalhado['numeroUnico_lote']?>');">Remover</button>
                                                   </div>
                                               </div>
                                           </div>

                                        </div>
                                     </div>
                                </td>
								<? } else { ?>
                                <td style="vertical-align:top !important;" class="td_detalhes cart-product-name">
                                    <a href="#"><?=$configuracoes_site['label_voucher_intranferivel']?></a>
                                    <p><?=$rSqlUsuário['nome']?></p>
                                </td>
                                <? } ?>
                            </tr>
                           <? } ?>
                           <? } ?>
                        </table>
                        <input type="hidden" id="qtd_carrinho_detalhado" value="<?=$cont?>" />
                        <input type="hidden" id="qtd_carrinho_detalhado_marcado" value="<?=$cont_marcado?>" />
                        </div>
					    <? } ?>
                        <? } ?>
                        
                        <? if(trim($_GET['reloadS'])=="1") { ?>
                        <script>
						$('.documento').inputmask('mask', {
							'mask': '999.999.999.99'
						}); //specifying fn & options
						$('.telefone_whatsapp').inputmask('mask', {
							'mask': '(99) 99999.9999'
						}); //specifying fn & options
                        </script>
                        <? } ?>
