		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap" style="padding: 0px 0;">
				<div class="container clearfix">

                    <div class="row col-mb-50 gutter-50">

						<?
						if(trim($rSqlItem['stat'])=="4") {
							$exibeQRCode = "0";
							$colMdSet = "col-lg-6";
							$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"button button-3d\" 
							 style=\"background-color:#000;text-align:center;color:#FFF;width:100%;padding: 8px 0px;\"> BLOQUEADO </a>";
						} else if(trim($rSqlItem['stat'])=="5") {
							$exibeQRCode = "0";
							$colMdSet = "col-lg-6";
							$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"button button-3d\" 
							 style=\"background-color:#000;text-align:center;color:#FFF;width:100%;padding: 8px 0px;\"> CANCELADO </a>";
						} else {
							if(trim($rSqlItem['confirmado'])=="1") {
								$exibeQRCode = "0";
								$colMdSet = "col-lg-6";
								$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"button button-3d\" 
								 style=\"background-color:#093;text-align:center;color:#FFF;width:100%;padding: 8px 0px;\"> JÁ UTILIZADO </a>";
							} else if(trim($rSqlItem['confirmado'])=="0" || trim($rSqlItem['confirmado'])=="") {
								$exibeQRCode = "1";
								$colMdSet = "col-lg-5";
								$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"button button-3d\"
								 style=\"background-color:#c00;text-align:center;color:#FFF;width:100%;padding: 8px 0px;\"> NÃO UTILIZADO </a>";
							}
						}
						?>
                        
						<div class="col-lg-12" style="padding-left:5px;text-align:center;padding-top:10px;padding-bottom:5px;">
							<?=$confirmadoSet?>
						</div>

                        <? if(trim($exibeQRCode)=="1") { ?>
                        <div class="col-lg-2" style="padding-top:0px;margin-top:0px;">
							<h4>QRCode</h4>

							<?
							if (file_exists("".$_SERVER['DOCUMENT_ROOT']."/admin/files/qrcode/".$rSqlItem['cod_voucher'].".jpg")) { } else {
								include_once("".$_SERVER['DOCUMENT_ROOT']."/admin/include/lib/phpqrcode/qrlib.php");
								include_once("".$_SERVER['DOCUMENT_ROOT']."/admin/include/lib/phpqrcode/qrconfig.php");
								
								// generating 
								QRcode::png($rSqlItem['cod_voucher'], "".$_SERVER['DOCUMENT_ROOT']."/admin/files/qrcode/".$rSqlItem['cod_voucher'].".jpg", QR_ECLEVEL_H, 450, 6); 
							}
							?>
                            <div class="table-responsive">
								<table class="table cart" style="border:0px !important;">
									<tbody>
										<tr class="cart_item">
											<td class="border-top-0 cart-product-name p-0" style="padding:0px !important;border:0px !important;">
												<img style="width:100% !important;" src="https://www.saguarocomunicacao.com.br/admin/files/qrcode/<?=$rSqlItem['cod_voucher']?>.jpg?<?=time();?>" />
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
                        <? } ?>

						<div class="<?=$colMdSet?>" style="padding-top:0px;margin-top:0px;">
							<h4>Detalhes</h4>

							<div class="table-responsive">
								<table class="table cart">
									<tbody>
										<tr class="cart_item">
											<td class="border-top-0 cart-product-name">
												<strong><?=$configuracoes_site['label_evento_singular']?></strong>
											</td>

											<td class="border-top-0 cart-product-name">
												<span class="amount"><?=$rSqlItem['eventos_nome']?></span>
											</td>
										</tr>
										<?
										$ticketArray = unserialize($rSqlItem['eventos_tickets']);
										$ticketArray = array_sort($ticketArray, 'ticket_data', SORT_ASC);
										foreach ($ticketArray as $key => $value_ticket) {
											if(trim($value_ticket['numeroUnico'])==trim($rSqlItem["numeroUnico_ticket"])) {
												$rSqlItem['ingresso_nome'] = $value_ticket['ticket_nome'];
												$rSqlItem['ticket_pdf_informativo'] = $value_ticket['ticket_pdf_informativo'];
											}
										}
										?>
                                        <tr class="cart_item">
											<td class="cart-product-name">
												<strong>Ticket</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?=$rSqlItem['ingresso_nome']?></span>
											</td>
										</tr>
										<?
										if(trim($rSqlItem['lote_nome'])=="") {
											$rSqlItem['lote_nome'] = "Sem definição de lote";
										} else {
											if(strrpos($rSqlItem['lote_nome'],"Lote") === false) {
												$rSqlItem['lote_nome'] = "".$rSqlItem['lote_nome']."&deg; Lote";
											} else {
												$rSqlItem['lote_nome'] = "".$rSqlItem['lote_nome']."";
											}
										}
										?>
                                        <tr class="cart_item">
											<td class="cart-product-name">
												<strong>Lote</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?=$rSqlItem['lote_nome']?></span>
											</td>
										</tr>
                                        <? if(trim($rSqlItem['label'])=="") { } else { ?>
                                        <tr class="cart_item">
											<td class="cart-product-name">
												<strong>Cadeira</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?=$rSqlItem['label']?></span>
											</td>
										</tr>
                                        <? } ?>
                                        <? if(trim($rSqlItem['numeroUnico_cod_voucher'])=="") { } else { ?>
                                        <tr class="cart_item">
											<td class="cart-product-name">
												<strong>Código do Voucher</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?=$rSqlItem['numeroUnico_cod_voucher']?></span>
											</td>
										</tr>
                                        <? } ?>
                                        <? if(trim($rSqlItem['ticket_pdf_informativo'])=="") { } else { ?>
                                        <tr class="cart_item">
											<td class="cart-product-name">
												<strong>PDF Informativo</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount">Clique para baixar <a href="<?=$link?>files/eventos_ticket_pdf_informativo/<?=$rSqlItem["numeroUnico_ticket"]?>/<?=$rSqlItem['ticket_pdf_informativo']?>" target="_blank"><?=$rSqlItem['ticket_pdf_informativo']?></a></span>
											</td>
										</tr>
                                        <? } ?>
										<tr class="cart_item">
											<td class="cart-product-name">
												<strong>Valor</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount">R$ <?=number_format($rSqlItem['valor'], 2, ',', '.')?></span>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<div class="<?=$colMdSet?>" style="padding-top:0px;margin-top:0px;">
							<h4>Informações do Beneficiário</h4>

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

					</div>
				</div>
			</div>
		</section><!-- #content end -->