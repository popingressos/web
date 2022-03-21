		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap" style="padding: 0px 0;">
				<div class="container clearfix">

					<?
					$statusDataDaCompraSet = statusDataDaCompraSimples($rSqlItem);
					$statusDataDaCompraCorSet = $statusDataDaCompraSet['cor'];
					$statusDataDaCompraTxtSet = $statusDataDaCompraSet['txt'];
					?>
                    <div class="row col-mb-50 gutter-50">
						<div class="col-lg-12">
							<h4><?=$configuracoes_site['label_menu_minhas_compras']?></h4>

							<div class="table-responsive">
								<table class="table cart">
									<tbody>
										<tr class="cart_item">
											<td class="border-top-0 cart-product-name">
												<strong>Código</strong>
											</td>

											<td class="border-top-0 cart-product-name">
												<span class="amount">#<?=$rSqlItem['cod_contrato']?></span>
											</td>
										</tr>
										<tr class="cart_item">
											<td class="border-top-0 cart-product-name">
												<strong>Status</strong>
											</td>

											<td class="border-top-0 cart-product-name">
												<span class="amount" style="color:<?=$statusDataDaCompraCorSet?>"><?=$statusDataDaCompraTxtSet?></span>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
                    </div>

                    <div class="row col-mb-50 gutter-50">
						<div class="col-lg-6">
							<h4>Informações do Comprador</h4>

							<div class="table-responsive">
								<table class="table cart">
									<tbody>
										<tr class="cart_item">
											<td class="border-top-0 cart-product-name">
												<strong>Nome Completo</strong>
											</td>

											<td class="border-top-0 cart-product-name">
												<span class="amount"><?=$rSqlItem['pessoa_nome']?></span>
											</td>
										</tr>
										<tr class="cart_item">
											<td class="cart-product-name">
												<strong>CPF</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?=$rSqlItem['pessoa_documento']?></span>
											</td>
										</tr>
										<tr class="cart_item">
											<td class="cart-product-name">
												<strong>E-mail</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?=$rSqlItem['pessoa_email']?></span>
											</td>
										</tr>
										<tr class="cart_item">
											<td class="cart-product-name">
												<strong>Celular / WhatsApp</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?=$rSqlItem['pessoa_telefone']?></span>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<div class="col-lg-6">
							<h4>Endereço Informado</h4>

							<div class="table-responsive">
								<?
								$enderecoArray = unserialize($rSqlItem['objetoEnderecoPagamento']);
								?>
                                <table class="table cart">
									<tbody>
										<tr class="cart_item">
											<td class="border-top-0 cart-product-name">
												<strong>CEP</strong>
											</td>

											<td class="border-top-0 cart-product-name">
												<span class="amount"><?=$enderecoArray['cep']?></span>
											</td>
										</tr>
										<tr class="cart_item">
											<td class="cart-product-name">
												<strong>Rua</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?=$enderecoArray['rua']?></span>
											</td>
										</tr>
										<tr class="cart_item">
											<td class="cart-product-name">
												<strong>Número</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?=$enderecoArray['numero']?></span>
											</td>
										</tr>
										<tr class="cart_item">
											<td class="cart-product-name">
												<strong>Complemento</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?=$enderecoArray['complemento']?></span>
											</td>
										</tr>
										<tr class="cart_item">
											<td class="cart-product-name">
												<strong>Bairro</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?=$enderecoArray['bairro']?></span>
											</td>
										</tr>
										<tr class="cart_item">
											<td class="cart-product-name">
												<strong>Cidade</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?=$enderecoArray['cidade']?></span>
											</td>
										</tr>
										<tr class="cart_item">
											<td class="cart-product-name">
												<strong>Estado</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?=$enderecoArray['estado']?></span>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>


						<div class="w-100"></div>

						<div class="col-lg-12">
							<h4>Detalhes</h4>

							<div class="table-responsive">
                                <table class="table cart mb-5">
                                    <tbody>
                                   <?
                                   $total=0;
                                   $cont=0;
                                   $cont_marcado=0;
                                   $carrinhoDetalhadoArray = unserialize($rSqlItem['objeto_carrinho_detalhado']);
                                   $carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'numeroUnico_lote', SORT_ASC);
                                   $carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'ordem', SORT_ASC);
                                   foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
                                       if(trim($valueDetalhado['tipo'])=="evento") {
                                       $cont++;
                                   ?>
                                    <tr class="cart_item">
                                        <td style="width:70px;vertical-align:top !important;" class="cart-product-thumbnail">
                                            <a href="#"><img width="64" height="64" src="<?=$valueDetalhado['imagem']?>"></a>
                                        </td>
        
                                        <td style="width:200px;vertical-align:top !important;" class="cart-product-name">
                                            <? if(trim($valueDetalhado['tipo'])=="evento") { ?>
                                            <a href="#"><?=$valueDetalhado['evento_nome']?></a>
                                            <p><?=$valueDetalhado['ingresso_nome']?></p>
                                            <p class="text-success"><?=$valueDetalhado['lote']?>° Lote</p>
                                            <? } else if(trim($valueDetalhado['tipo'])=="produto" || trim($valueDetalhado['tipo'])=="combo") { ?>
                                            <a href="#"><?=$valueDetalhado['produto_nome']?></a>
                                            <? } ?>
                                        </td>
        
                                        <td style="width:120px;vertical-align:top !important;" class="cart-product-price">
                                            <span class="amount"><?="R$ ".number_format($valueDetalhado['valor'], 2, ',', '.').""?></span>
                                        </td>
        
                                        <td>
                                             <div class="col-sm-12">
                                                <div class="row align-items-center mt-2">
                                                   <div class="col-sm-12 col-md-12 mb-2">
                                                      <label for="nome" class="mb-0 w-100" style="text-align:left !important;">Nome</label>
                                                      <input type="text" class="form-control" disabled="disabled" id="pessoa_nome_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['pessoa_nome']?>" />
                                                   </div>
                                                   <div class="col-sm-12 col-md-12 mb-2">
                                                      <label for="nome" class="mb-0 w-100" style="text-align:left !important;">CPF</label>
                                                      <input type="text" class="form-control documento" disabled="disabled" id="pessoa_documento_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['pessoa_documento']?>" />
                                                   </div>
                                                   <div class="col-sm-12 col-md-12 mb-2">
                                                      <label for="nome" class="mb-0 w-100" style="text-align:left !important;">E-mail</label>
                                                      <input type="text" class="form-control mb-2" disabled="disabled" id="pessoa_email_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['pessoa_email']?>" />
                                                      <? if(trim($valueDetalhado['telefone_enviar'])=="1") { ?>
                                                      SIM, marcou que deseja receber a informação da sua compra neste e-mail informado
                                                      <? } else { ?>
                                                      NÃO, marcou que não deseja receber a informação da sua compra neste e-mail informado
                                                      <? } ?>
                                                   </div>
                                                   <div class="col-sm-12 col-md-12 mb-2">
                                                      <label for="nome" class="mb-0 w-100" style="text-align:left !important;">Telefone</label>
                                                      <input type="text" class="form-control telefone_whatsapp mb-2" disabled="disabled" id="pessoa_telefone_<?=$valueDetalhado['numeroUnico']?>" value="<?=$valueDetalhado['pessoa_telefone']?>" />
                                                      <? if(trim($valueDetalhado['telefone_enviar'])=="1") { ?>
                                                      SIM, marcou que deseja receber a informação da sua compra neste telefone informado
                                                      <? } else { ?>
                                                      NÃO, marcou que não deseja receber a informação da sua compra neste telefone informado
                                                      <? } ?>
                                                   </div>
                                                </div>
                                             </div>
                                        </td>
                                    </tr>
                                   <? } ?>
                                   <? } ?>
                                </table>
							</div>
						</div>


					</div>
				</div>
			</div>
		</section><!-- #content end -->