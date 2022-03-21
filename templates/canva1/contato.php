		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="row align-items-stretch col-mb-50 mb-0">
						<!-- Contact Form
						============================================= -->
						<div class="col-lg-6">

							<div class="fancy-title title-border">
								<h3>Envie uma mensagem para nós</h3>
							</div>

							<div class="form-widget">

								<div class="form-result"></div>

								<form class="mb-0" id="template-contactform" name="template-contactform" action="include/form.php" method="post">

									<div class="form-process">
										<div class="css3-spinner">
											<div class="css3-spinner-scaler"></div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12 form-group">
											<label for="template-contactform-name">Nome <small>*</small></label>
											<input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control required" />
										</div>

										<div class="col-md-6 form-group">
											<label for="template-contactform-email">E-mail <small>*</small></label>
											<input type="email" id="template-contactform-email" name="template-contactform-email" value="" class="required email sm-form-control" />
										</div>

										<div class="col-md-6 form-group">
											<label for="template-contactform-phone">Telefone</label>
											<input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" />
										</div>

										<div class="w-100"></div>

										<div class="col-md-12 form-group">
											<label for="template-contactform-subject">Assunto <small>*</small></label>
											<input type="text" id="template-contactform-subject" name="subject" value="" class="required sm-form-control" />
										</div>

										<div class="w-100"></div>

										<div class="col-12 form-group">
											<label for="template-contactform-message">Mensagem <small>*</small></label>
											<textarea class="required sm-form-control" id="template-contactform-message" name="template-contactform-message" rows="6" cols="30"></textarea>
										</div>

										<div class="col-12 form-group d-none">
											<input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
										</div>

										<div class="col-12 form-group">
											<button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="button button-3d m-0">Enviar</button>
										</div>
									</div>

									<input type="hidden" name="prefix" value="template-contactform-">

								</form>
							</div>

						</div><!-- Contact Form End -->

						<!-- Google Map
						============================================= -->
						<div class="col-lg-6 min-vh-50">
							<div class="gmap h-100" data-address="<?=$configuracoes_site['contato_endereco_extenso']?>" data-markers='[{address: "<?=$configuracoes_site['contato_endereco_extenso']?>", html: "", 
                            icon:{ image: "<?=$link_modelo?>templates/<?=$pasta_template?>/images/icons/map-icon-red.png", iconsize: [32, 39], iconanchor: [32,39] } }]'></div>
						</div><!-- Google Map End -->
					</div>

					<!-- Contact Info
					============================================= -->
					<div class="row col-mb-50">
						<?
                        $cont_bloco_contato = 0;
                        if(trim($configuracoes_site['contato_bloco_1'])=="1") { $cont_bloco_contato++; }
                        if(trim($configuracoes_site['contato_bloco_2'])=="1") { $cont_bloco_contato++; }
                        if(trim($configuracoes_site['contato_bloco_3'])=="1") { $cont_bloco_contato++; }
                        if(trim($configuracoes_site['contato_bloco_4'])=="1") { $cont_bloco_contato++; }
                        $cont_bloco_contato = 12 / $cont_bloco_contato;
                        ?>

						<? for ($i = 1; $i <= 4; $i++) { ?>
							<? if(trim($configuracoes_site['contato_bloco_'.$i.''])=="1") { ?>
								<?
                                if(trim($configuracoes_site['contato_bloco_'.$i.'_img'])=="") {
                                    $iconeSet = "<i class=\"".$configuracoes_site['contato_bloco_'.$i.'_icone']."\"></i>";
                                } else {
                                    $iconeSet = "<img src=\"".$link."files/site/".$configuracoes_site['numeroUnico']."/".$configuracoes_site['contato_bloco_'.$i.'_img']."\" >";
                                }
                                if(trim($configuracoes_site['contato_bloco_'.$i.'_link'])=="") {
                                    $linkSet = "href=\"#\" ";
                                } else {
                                    $linkSet = "href=\"".$configuracoes_site['contato_bloco_'.$i.'_link']."\" target=\"".$configuracoes_site['contato_bloco_'.$i.'_target']."\" ";
                                }
                                ?>
                                <div class="col-sm-6 col-lg-<?=$cont_bloco_contato?>">
                                    <div class="feature-box fbox-center fbox-bg fbox-plain">
                                        <div class="fbox-icon">
                                            <a <?=$linkSet?>><?=$iconeSet?></a>
                                        </div>
                                        <div class="fbox-content">
                                            <h3><?=$configuracoes_site['contato_bloco_'.$i.'_titulo']?><span class="subtitle"><?=$configuracoes_site['contato_bloco_'.$i.'_texto']?></span></h3>
                                        </div>
                                    </div>
                                </div>
							<? } ?>
                        <? } ?>

					</div><!-- Contact Info End -->

				</div>
			</div>
		</section><!-- #content end -->