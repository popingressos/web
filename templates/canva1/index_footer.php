
		<? if(trim($configuracoes_site['facebook'])=="" && trim($configuracoes_site['instagram'])=="") { } else { ?>
        <div class="si-sticky si-sticky-right d-none d-lg-block" style="z-index: 399;">
			<? if(trim($configuracoes_site['facebook'])=="") { } else { ?>
            <a href="https://www.facebook.com/<?=$configuracoes_site['facebook']?>" target="_blank" class="social-icon si-colored si-facebook" data-animate="bounceInRight">
                <i class="icon-facebook"></i>
                <i class="icon-facebook"></i>
            </a>
			<? } ?>

			<? if(trim($configuracoes_site['instagram'])=="") { } else { ?>
            <a href="https://www.instagram.com/<?=$configuracoes_site['instagram']?>/" target="_blank" class="social-icon si-colored si-instagram" data-animate="bounceInRight" data-delay="300">
                <i class="icon-instagram"></i>
                <i class="icon-instagram"></i>
            </a>
			<? } ?>
        </div>
		<? } ?>


		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark">
			<div class="container">

				<!-- Footer Widgets
				============================================= -->
				<div class="footer-widgets-wrap">

					<div class="row col-mb-50">
						<div class="col-lg-12">

							<div class="row col-mb-50">
                            	<?
								$cont_bloco = 0;
								if(trim($configuracoes_site['rodape_bloco1'])=="1") { $cont_bloco++; }
								if(trim($configuracoes_site['rodape_bloco2'])=="1") { $cont_bloco++; }
								if(trim($configuracoes_site['rodape_bloco3'])=="1") { $cont_bloco++; }
								if(trim($configuracoes_site['rodape_bloco4'])=="1") { $cont_bloco++; }
								$col_bloco = 12 / $cont_bloco;
								?>
								<? if(trim($configuracoes_site['rodape_bloco1'])=="1") { ?>
                                <div class="col-md-<?=$col_bloco?>">

									<div class="widget clearfix">

										<? if(trim($configuracoes_site['rodape_bloco1_label'])=="") { } else { ?>
                                        <h4><?=$configuracoes_site['rodape_bloco1_label']?></h4>
                                        <? } ?>

										<img style="height:60px;margin-bottom:10px;" src="<?=$link?>files/site/<?=$configuracoes_site['numeroUnico']?>/<?=$configuracoes_site['logotipo_rodape']?>">

										<? if(trim($configuracoes_site['rodape_slogan'])=="") { ?>
                                        <p>Acreditamos no <strong>Simples</strong>, <strong>Criativo</strong> &amp; <strong>Flexível</strong>.</p>
                                        <? } else { ?>
                                        <?=$configuracoes_site['rodape_slogan']?>
                                        <? } ?>

										<div>
											<? if(trim($configuracoes_site['rodape_endereco'])=="") { } else { ?>
											<address>
												<strong>Endereço:</strong><br>
												<?=$configuracoes_site['rodape_endereco']?>
											</address>
                                            <? } ?>
											<!--<strong>WhatsApp:</strong></abbr> (61) 90000.0000<br>-->
											<? if(trim($configuracoes_site['rodape_email'])=="") { } else { ?>
											<?=$configuracoes_site['rodape_email']?><br />
                                            <? } ?>
										</div>

									</div>

								</div>
                                <? } ?>

								<? if(trim($configuracoes_site['rodape_bloco2'])=="1") { ?>
								<div class="col-md-<?=$col_bloco?>">

									<div class="widget widget_links clearfix">

										<? if(trim($configuracoes_site['rodape_bloco2_label'])=="") { } else { ?>
										<h4><?=$configuracoes_site['rodape_bloco2_label']?></h4>
                                        <? } ?>

										<ul>
                                            <li><a href="<?=$link_modelo?><?=$url_eventos_plural?>/"><div><?=$configuracoes_site['label_menu_eventos_plural']?></div></a></li>
                                            <!--
                                            <li><a href="<?=$link_modelo?>"><div>Sobre Nós</div></a></li>
                                            <li><a href="<?=$link_modelo?>"><div>Produtores</div></a></li>
                                            -->
                                            <li><a href="<?=$link_modelo?><?=$url_contato?>/"><div><?=$configuracoes_site['label_menu_contato']?></div></a></li>
                                            <? if(trim($rSqlUsuario['id'])=="") { ?>
                                            <li><a href="<?=$link_modelo?><?=$url_acesso?>/"><div><?=$configuracoes_site['label_menu_acesso']?></div></a></li>
                                            <li><a href="<?=$link_modelo?><?=$url_cadastro?>/"><div><?=$configuracoes_site['label_menu_cadastro']?></div></a></li>
                                            <? } else { ?>
                                            <li><a href="<?=$link_modelo?>painel/"><div><?=$configuracoes_site['label_menu_minha_conta']?></div></a></li>
                                            <? } ?>
										</ul>

									</div>

								</div>
                                <? } ?>

								<? if(trim($configuracoes_site['rodape_bloco3'])=="1") { ?>
                                <div class="col-md-<?=$col_bloco?>">

									<div class="widget clearfix">
										<? if(trim($configuracoes_site['rodape_bloco3_label'])=="") { } else { ?>
										<h4><?=$configuracoes_site['rodape_bloco3_label']?></h4>
                                        <? } ?>

										<div class="posts-sm row col-mb-30" id="post-list-footer">
											<?
                                            $strSql = "
                                                SELECT 
                                                    mod_eventos.id AS eventos_id,
                                                    mod_eventos.numeroUnico AS eventos_numeroUnico,
                                                    mod_eventos.numeroUnico_pessoa AS eventos_numeroUnico_pessoa,
                                                    mod_eventos.url_amigavel AS eventos_url_amigavel,
                                                    mod_eventos.nome AS eventos_nome,
                                                    mod_eventos.imagem_de_icone AS eventos_imagem_de_icone,
                                                    mod_eventos.imagem_de_capa AS eventos_imagem_de_capa,
                                                    mod_eventos.data_do_evento AS eventos_data_do_evento,
                                                    mod_eventos.hora_inicio AS eventos_hora_inicio,
                                                    mod_eventos.data AS eventos_data
                                                    
                                                FROM 
                                                    eventos AS mod_eventos 
                            
                                                WHERE 
                                                    mod_eventos.stat='1' AND
                                                    mod_eventos.empresa_token='".$EMPRESA_TOKEN."'
                            
                                                GROUP BY
                                                    mod_eventos.id
                                    
                                                ORDER BY
                                                    mod_eventos.data ASC
												
												LIMIT 3
                                                    
                                            ";
                            
                                            $corSet = "#ffffff";
                                            $qSql = mysql_query("".$strSql."");
                                            while($rSql = mysql_fetch_array($qSql)) {
                                                  $btnSolicitacao = "<button type=\"button\" onclick=\"javascript:window.open('".$link_modelo."".$url_eventos."/".$rSql['eventos_id']."/".$rSql['eventos_url_amigavel']."/','_self','');\" class=\"btn btn-success d-block w-100\">Acessar ".$configuracoes_site['label_evento_singular']."</button>";
                            
                                                  $d  = substr($rSql['eventos_data_do_evento'],8,2);
                                                  $a  = substr($rSql['eventos_data_do_evento'],0,4);
                                                  
                                                  // com-feira, sem-feira, curto
                                                  $diasemana = diasemana_extenso($rSql['eventos_data_do_evento'],"sem-feira");
                                                
                                                  $mes = mes_extenso(substr($rSql['eventos_data_do_evento'],5,2),"longo");
                                            ?>
											<div class="entry col-12">
												<div class="grid-inner row">
													<div class="col">
														<div class="entry-title">
															<h4><a href="<?=$link_modelo?><?=$url_eventos?>/<?=$rSql['eventos_id']?>/<?=$rSql['eventos_url_amigavel']?>/"><?=$rSql['eventos_nome']?></a></h4>
														</div>
														<div class="entry-meta">
															<ul>
																<li><?=$diasemana?>, <?=$d?> de <?=$mes?> de <?=$a?></li>
															</ul>
														</div>
													</div>
												</div>
											</div>
                                            <? } ?>

										</div>
									</div>

								</div>
                                <? } ?>

								<? if(trim($configuracoes_site['rodape_bloco4'])=="1") { ?>
                                <div class="col-md-<?=$col_bloco?>">
									<div class="widget subscribe-widget clearfix">
										<? if(trim($configuracoes_site['rodape_bloco4_label'])=="") { } else { ?>
										<h5><?=$configuracoes_site['rodape_bloco4_label']?></h5>
                                        <? } ?>
										<div class="widget-subscribe-form-result"></div>
										<form id="widget-subscribe-form" action="<?=$link_modelo?>" method="post" class="mb-0">
											<div class="input-group mx-auto">
												<div class="input-group-text"><i class="icon-email2"></i></div>
												<input type="email" id="widget-subscribe-form-email" name="widget-subscribe-form-email" class="form-control required email" placeholder="Digite seu e-mail">
												<button class="btn btn-success" type="submit">Assinar</button>
											</div>
										</form>
									</div>
                                </div>
                                <? } ?>
							</div>

						</div>

					</div>

				</div><!-- .footer-widgets-wrap end -->

			</div>

			<!-- Copyrights
			============================================= -->
			<div id="copyrights">
				<div class="container">

					<div class="row col-mb-30">

						<div class="col-md-6 text-center text-md-start">
							<? if(trim($configuracoes_site['rodape_copyright'])=="") { ?>
                            Copyrights &copy; <?=$configuracoes_site['nome']?> <?=date("Y");?> Todos os direitos reservados.<br>
                            <? } else { ?>
                            <?=$configuracoes_site['rodape_copyright']?><br>
                            <? } ?>
							<div class="copyright-links"><a href="<?=$link_modelo?>termos-de-uso/">Termos de Uso</a> / <a href="<?=$link_modelo?>politica-de-privacidade/">Política de Privacidade</a></div>
						</div>

						<div class="col-md-6 text-center text-md-end">
							<div class="d-flex justify-content-center justify-content-md-end">
								<? if(trim($configuracoes_site['facebook'])=="") { } else { ?>
								<a href="https://www.facebook.com/<?=$configuracoes_site['facebook']?>" target="_blank" class="social-icon si-small si-borderless si-facebook">
									<i class="icon-facebook"></i>
									<i class="icon-facebook"></i>
								</a>
                                <? } ?>

								<? if(trim($configuracoes_site['instagram'])=="") { } else { ?>
                                <a href="https://www.instagram.com/<?=$configuracoes_site['instagram']?>/" target="_blank" class="social-icon si-small si-borderless si-instagram">
									<i class="icon-instagram"></i>
									<i class="icon-instagram"></i>
								</a>
                                <? } ?>

							</div>

							<div class="clear"></div>

						</div>

					</div>

				</div>
			</div><!-- #copyrights end -->
		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

    <? if(trim($camposArray['campo_cliente_data_de_nascimento'][0]['exibir'])=="1") { ?>
    <!-- Modal -->
    <div class="modal1 mfp-hide" id="modalMenor18">
        <div class="block mx-auto" style="background-color: #FFF; max-width: 500px;">
            <div class="center" style="padding: 50px;">
                <h3>Consumo responsável</h3>
                <p class="mb-0" style="text-align:left;">
                Desculpe, o conteúdo desse site não está liberado para você.<br /><br />
                O consumo de bebidas alcoólicas antes dos 18 anos é proibido e pode trazer uma série de riscos e consequências negativas a sua saúde.<br /><br />
                <?=$configuracoes_site['nome']?> se compromete a não anunciar ou comunicar para esse público.
                </p>
            </div>
        </div>
    </div>
    <? } ?>


<? if(trim($configuracoes_site['whatsapp_ativo'])=="1") { ?>
<style>
@media screen and (max-width: 640px) {
	.whats-footer a {
		left: 25px !important;
		bottom: 10px !important;
	}
}
.whats-footer a {
    position: fixed;
    left: 25px;
    bottom: 18px;
    z-index: 9999999999999;
    width: 50px;
    height: 50px;
    background-color: #25D366;
    color: #fff;
    border-radius: 20px;
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    -moz-box-pack: center;
    -webkit-justify-content: center;
    -ms-justify-content: center;
    justify-content: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
    -webkit-animation: pulsar-cia 1.9s infinite;
    -moz-animation: pulsar-cia 1.9s infinite;
    -o-animation: pulsar-cia 1.9s infinite;
    animation: pulsar-cia 1.9s infinite;
}
.whats-footer a span {
    position: absolute;
    background: red;
    top: -5px;
    left: -5px;
    width: 20px;
    height: 20px;
    line-height: 20px;
    text-align: center;
    border-radius: 100%;
    font-size: 12px;
}
.whats-footer a i {
    color: #FFF !important;
    font-size: 26px !important;
	margin-right:0px !important;
}


.cookie-law-info-bar-novo {
	margin-left: 10% !important;   
	margin-right: 50% !important;    
	max-width: 80% !important; 
	margin-bottom: 20px !important;    
	border-radius: 10px !important;
}
@media screen and (max-width: 640px) {
	.cookie-law-info-bar-novo {
		margin-left: 5% !important;    
		margin-right: 50% !important;    
		max-width: 90% !important;    
		margin-bottom: 70px !important;    
		border-radius: 10px !important;
	}
}
</style>        

<div class="whats-footer"> 
<a href="https://api.whatsapp.com/send?phone=55<? echo preg_replace("/[^0-9]/", "", $configuracoes_site['whatsapp_numero']); ?>&text=<?=$configuracoes_site['whatsapp_frase']?>" target="_blank" title="Whatsapp" rel="nofollow noreferrer noopener external">
<span>1</span><i class="fab fa-whatsapp"></i>
</a> 
</div>
<? } ?>

    <input type="hidden" id="usuario_numeroUnico_fingerprint" value="<?=$rSqlUsuario['numeroUnico']?>">

	<input type="hidden" id="_EMPRESA_TOKEN" value="<?=$EMPRESA_TOKEN?>">
	<input type="hidden" id="_EMPRESA_TOKEN_CONFIG" value="<?=$EMPRESA_TOKEN_CONFIG?>">

	<input type="hidden" id="ip_cliente" value="">
	<input type="hidden" id="empresa_token" value="<?=$EMPRESA_TOKEN?>">
	<input type="hidden" id="empresa_id" value="<?=$rSqlEmpresa['id']?>">

    <input type="hidden" id="usuario_id" value="<?=$rSqlUsuario['id']?>">
    <input type="hidden" id="usuario_numeroUnico" value="<?=$rSqlUsuario['numeroUnico']?>">

    <input type="hidden" id="mes_atual" value="<?=date("m")?>">
    <input type="hidden" id="ano_atual" value="<?=date("y")?>">
    <input type="hidden" id="local" value="<?=$_REQUEST['var1']?>">
    <input type="hidden" id="cupom_set" value="<?=$_SESSION['CUPOM_CARRINHO']?>">

    <input type="hidden" id="numeroUnico_pai" value="<?=$_SESSION['empresa_'.$rSqlEmpresa['id'].'_numeroUnico_carrinho']?>" />
    <input type="hidden" id="numeroUnico_carrinho" value="<?=$_SESSION['empresa_'.$rSqlEmpresa['id'].'_numeroUnico_carrinho']?>">

	<script>
    var linkAdminLib = "<?=$link_modelo?>admin/";
    //var linkModelo = "<?=$link_modelo?>";
    var linkModelo = "<?=$link_modelo?>";
    var linkToken = "<?=$link_modelo?><?=$EMPRESA_TOKEN?>/";
    var linkReal = "<?=$link_modelo?>";
    </script>
    
	<!-- JavaScripts
	============================================= -->
	<script src="<?=$link_modelo?>templates/<?=$pasta_template?>/js/jquery.js"></script>
	<script src="<?=$link_modelo?>templates/<?=$pasta_template?>/js/plugins.min.js"></script>
	<script src="https://maps.google.com/maps/api/js?key="></script>
    
	<!-- Footer Scripts
	============================================= -->
	<script src="<?=$link_modelo?>templates/<?=$pasta_template?>/js/functions.js?<?php echo time(); ?>"></script>

	<script src="<?=$link_modelo?>admin/templates/metronic/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?=$link_modelo?>js/default.js?<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
		$("#btn_copia_pix_key_url").click(function(){
			$("#copia_pix_key_url").select();
			document.execCommand('copy');
			alert("URL/Token de pagamento copiada com sucesso!");
		})
  
		$( "#aceito_termos_confere" ).click(function() {
			if ($("#aceito_termos_confere").is(':checked')) {
				$( "#aceito_termos_confere" ).prop("checked", false);
				$( "#aceito_termos" ).val("0");
				$("#div_aceito_termos").css({"color":"#777","border-bottom":"0px solid #fff"});
			} else {
				$( "#aceito_termos_confere" ).prop("checked", true);
				$( "#aceito_termos" ).val("1");
				$("#div_aceito_termos").css({"color":"#3c9e01","border-bottom":"0px solid #fff"});
			}
		});
		$( "#div_aceito_termos" ).click(function() {
			if ($("#aceito_termos_confere").is(':checked')) {
				$( "#aceito_termos_confere" ).prop("checked", false);
				$( "#aceito_termos" ).val("0");
				$("#div_aceito_termos").css({"color":"#777","border-bottom":"0px solid #fff"});
			} else {
				$( "#aceito_termos_confere" ).prop("checked", true);
				$( "#aceito_termos" ).val("1");
				$("#div_aceito_termos").css({"color":"#3c9e01","border-bottom":"0px solid #fff"});
			}
		});

		$( "#aceito_politica_confere" ).click(function() {
			if ($("#aceito_politica_confere").is(':checked')) {
				$( "#aceito_politica_confere" ).prop("checked", false);
				$( "#aceito_politica" ).val("0");
				$("#div_aceito_politica").css({"color":"#777","border-bottom":"0px solid #fff"});
			} else {
				$( "#aceito_politica_confere" ).prop("checked", true);
				$( "#aceito_politica" ).val("1");
				$("#div_aceito_politica").css({"color":"#3c9e01","border-bottom":"0px solid #fff"});
			}
		});
		$( "#div_aceito_politica" ).click(function() {
			if ($("#aceito_politica_confere").is(':checked')) {
				$( "#aceito_politica_confere" ).prop("checked", false);
				$( "#aceito_politica" ).val("0");
				$("#div_aceito_politica").css({"color":"#777","border-bottom":"0px solid #fff"});
			} else {
				$( "#aceito_politica_confere" ).prop("checked", true);
				$( "#aceito_politica" ).val("1");
				$("#div_aceito_politica").css({"color":"#3c9e01","border-bottom":"0px solid #fff"});
			}
		});

		$( "#aceite_extra_1_confere" ).click(function() {
			if ($("#aceite_extra_1_confere").is(':checked')) {
				$( "#aceite_extra_1_confere" ).prop("checked", false);
				$( "#aceite_extra_1" ).val("0");
				$("#div_aceite_extra_1").css({"color":"#777","border-bottom":"0px solid #fff"});
			} else {
				$( "#aceite_extra_1_confere" ).prop("checked", true);
				$( "#aceite_extra_1" ).val("1");
				$("#div_aceite_extra_1").css({"color":"#3c9e01","border-bottom":"0px solid #fff"});
			}
		});
		$( "#div_aceite_extra_1" ).click(function() {
			if ($("#aceite_extra_1_confere").is(':checked')) {
				$( "#aceite_extra_1_confere" ).prop("checked", false);
				$( "#aceite_extra_1" ).val("0");
				$("#div_aceite_extra_1").css({"color":"#777","border-bottom":"0px solid #fff"});
			} else {
				$( "#aceite_extra_1_confere" ).prop("checked", true);
				$( "#aceite_extra_1" ).val("1");
				$("#div_aceite_extra_1").css({"color":"#3c9e01","border-bottom":"0px solid #fff"});
			}
		});

		if ($('#cep').length > 0) {
			$('#cep').inputmask('mask', {
				'mask': '99999-999'
			}); //specifying fn & options
		}
		
		if ($('#cobranca_cep').length > 0) {
			$('#cobranca_cep').inputmask('mask', {
				'mask': '99999-999'
			}); //specifying fn & options
		}
		
		if ($('#card_number').length > 0) {
			$('#card_number').inputmask('mask', {
				'mask': '9999.9999.9999.9999'
			}); //specifying fn & options
		}
		
		if ($('#cobranca_cartao_card_number').length > 0) {
			$('#cobranca_cartao_card_number').inputmask('mask', {
				'mask': '9999.9999.9999.9999'
			}); //specifying fn & options
		}
		
		if ($('#card_cpf').length > 0) {
			$('#card_cpf').inputmask('mask', {
				'mask': '999.999.999-99'
			}); //specifying fn & options
		}
		
		if ($('.documento').length > 0) {
			$('.documento').inputmask('mask', {
				'mask': '999.999.999-99'
			}); //specifying fn & options
		}
		
		if ($('#cobranca_boleto_card_cpf').length > 0) {
			$('#cobranca_boleto_card_cpf').inputmask('mask', {
				'mask': '999.999.999-99'
			}); //specifying fn & options
		}
		
		if ($('#cobranca_boleto_card_telefone').length > 0) {
			$('#cobranca_boleto_card_telefone').inputmask('mask', {
				'mask': '(99) 99999.9999'
			}); //specifying fn & options
		}
		
		if ($('#cobranca_pix_card_cpf').length > 0) {
			$('#cobranca_pix_card_cpf').inputmask('mask', {
				'mask': '999.999.999.99'
			}); //specifying fn & options
		}
		
		if ($('#cobranca_pix_card_telefone').length > 0) {
			$('#cobranca_pix_card_telefone').inputmask('mask', {
				'mask': '(99) 99999.9999'
			}); //specifying fn & options
		}
		
		if ($('#cobranca_cartao_card_cpf').length > 0) {
			$('#cobranca_cartao_card_cpf').inputmask('mask', {
				'mask': '999.999.999-99'
			}); //specifying fn & options
		}
		
		if ($('#cobranca_cartao_card_telefone').length > 0) {
			$('#cobranca_cartao_card_telefone').inputmask('mask', {
				'mask': '(99) 99999.9999'
			}); //specifying fn & options
		}
		
		if ($('#cobranca_credito_card_cpf').length > 0) {
			$('#cobranca_credito_card_cpf').inputmask('mask', {
				'mask': '999.999.999-99'
			}); //specifying fn & options
		}
		
		if ($('#cobranca_credito_card_telefone').length > 0) {
			$('#cobranca_credito_card_telefone').inputmask('mask', {
				'mask': '(99) 99999.9999'
			}); //specifying fn & options
		}
		
		if ($('#card_telefone').length > 0) {
			$('#card_telefone').inputmask('mask', {
				'mask': '(99) 99999.9999'
			}); //specifying fn & options
		}
		
		if ($('#telefone').length > 0) {
			$('#telefone').inputmask('mask', {
				'mask': '(99) 9999.9999'
			}); //specifying fn & options
		}
		
		if ($('#whatsapp').length > 0) {
			$('#whatsapp').inputmask('mask', {
				'mask': '(99) 99999.9999'
			}); //specifying fn & options
		}

		if ($('.telefone_whatsapp').length > 0) {
			$('.telefone_whatsapp').inputmask('mask', {
				'mask': '(99) 99999.9999'
			}); //specifying fn & options
		}

		if ($('#data_de_nascimento').length > 0) {
			$('#data_de_nascimento').inputmask('mask', {
				'mask': '99/99/9999'
			}); //specifying fn & options
		}
		
		$(".email_check").on('change', function(e) {
			var numeroUnicoSend = $(this).attr("numeroUnico");
			var checado = $("#email_enviar_"+numeroUnicoSend+"").val();
			if($.trim(checado)=="0") {
				$("#email_enviar_"+numeroUnicoSend+"").val("1");
			} else if($.trim(checado)=="1") {
				$("#email_enviar_"+numeroUnicoSend+"").val("0");
			}
		});

		$(".telefone_check").on('change', function(e) {
			var numeroUnicoSend = $(this).attr("numeroUnico");
			var checado = $("#telefone_enviar_"+numeroUnicoSend+"").val();
			if($.trim(checado)=="0") {
				$("#telefone_enviar_"+numeroUnicoSend+"").val("1");
			} else if($.trim(checado)=="1") {
				$("#telefone_enviar_"+numeroUnicoSend+"").val("0");
			}
		});
    </script>

	<script src="https://www.gstatic.com/firebasejs/5.8.4/firebase.js"></script>
    <script>
    // Initialize Firebase
	const config = {
	  apiKey: "",
	  authDomain: "pop-ingressos-web.firebaseapp.com",
	  databaseURL: "https://pop-ingressos-web.firebaseio.com",
	  projectId: "pop-ingressos-web",
	  storageBucket: "pop-ingressos-web.appspot.com",
	  messagingSenderId: "556447725405",
	  appId: "1:556447725405:web:74697dd05e6305ace39ab4",
	  measurementId: "G-GZ0QE1BE6N"
    };
  
    firebase.initializeApp(config);
    function facebookSignin() {
        var provider = new firebase.auth.FacebookAuthProvider();

		console.log("provider",provider);

        var existingEmail = null;
        var pendingCred = null;
        firebase.auth().signInWithPopup(provider)
            .then(function(result) {
                  var token = result.credential.accessToken;
                  var user = result.user;
                  console.log("user",user);
                  console.log("user.providerData",user.providerData);
                  console.log("user.providerData[0].email",user.providerData[0].email);
                  console.log("["+user.displayName+"]");
                  console.log("["+user.email+"]");
                  console.log("["+user.uid+"]");
				  
				  var email1 = user.email;
				  var email2 = user.providerData[0].email;
				  if($.trim(email1)=="" || email1 === null) {
					  if($.trim(email2)=="" || email2 === null) {
						  var emailSet = "";
					  } else {
						  var emailSet = ""+email2+"";
					  }
				  } else {
					  var emailSet = ""+email1+"";
				  }

				  //var emailSet = user.email;
				  //var uidSet = user.providerData[0];
		
				  var emailSet = user.providerData[0].email;
				  var uidSet = user.providerData[0].uid;
		
                  $("#nome_redes").val(""+user.displayName+"");
                  $("#email_redes").val(""+emailSet+"");
                  $("#token_redes").val(""+uidSet+"");
                  $("#tipo_redes").val("token_facebook");
                  loginRedes();
            })
            .catch(function(error) {
                // Account exists with different credential. To recover both accounts
                // have to be linked but the user must prove ownership of the original
                // account.
                if (error.code == 'auth/account-exists-with-different-credential') {
                    existingEmail = error.email;
                    pendingCred = error.credential;
                    // Lookup existing account’s provider ID.
                    return firebase.auth().fetchSignInMethodsForEmail(error.email)
                        .then(function(providers) {
                            if (providers.indexOf(firebase.auth.EmailAuthProvider.PROVIDER_ID) != -1) {
                                // Password account already exists with the same email.
                                // Ask user to provide password associated with that account.
                                var password = window.prompt('Please provide the password for ' + existingEmail);
                                return firebase.auth().signInWithEmailAndPassword(existingEmail, password);
                            } else if (providers.indexOf(firebase.auth.GoogleAuthProvider.PROVIDER_ID) != -1) {
                                var googProvider = new firebase.auth.GoogleAuthProvider();
                                // Sign in user to Google with same account.
                                provider.setCustomParameters({'login_hint': existingEmail});
                                return firebase.auth().signInWithPopup(googProvider).then(function(result) {
                                    return result.user;
                                });
                            } else {
                            }
                    })
                    .then(function(user) {
                        // Existing email/password or Google user signed in.
                        // Link Facebook OAuth credential to existing account.
                        return user.linkAndRetrieveDataWithCredential(pendingCred);
                    });
                }
                throw error;
            });
    }
    function googleSignin() {
        var provider = new firebase.auth.GoogleAuthProvider();

		console.log("provider",provider);

        firebase.auth().signInWithPopup(provider).then(function(result) {
          // This gives you a Google Access Token. You can use it to access the Google API.
          var token = result.credential.accessToken;
          // The signed-in user info.
          var user = result.user;

		  console.log("result",result);
		  console.log("user",user);
		  console.log("user.displayName",user.displayName);
		  console.log("user.email",user.email);
		  console.log("user.uid",user.uid);
		  
		  //var emailSet = user.email;
		  //var uidSet = user.providerData[0];

		  var emailSet = user.providerData[0].email;
		  var uidSet = user.providerData[0].uid;

          $("#nome_redes").val(""+user.displayName+"");
          $("#email_redes").val(""+emailSet+"");
          $("#token_redes").val(""+uidSet+"");
          $("#tipo_redes").val("token_google");
          loginRedes();
        }).catch(function(error) {
          // Handle Errors here.
          var errorCode = error.code;
          var errorMessage = error.message;
          // The email of the user's account used.
          var email = error.email;
          // The firebase.auth.AuthCredential type that was used.
          var credential = error.credential;
          // ...
        });
    }
    function loginRedes() {
		var nome_redes_enviado = $("#nome_redes").val();
		var email_redes_enviado = $("#email_redes").val();

        if(nome_redes_enviado.length<5) {
			if($("#tipo_redes").val()=="token_facebook") {
				alert("Ocorreu algum erro na tentativa de login via Facebook, a informação de nome não está liberada, e é necessário que a mesma esteja visível!");
			} else {
				alert("Ocorreu algum erro na tentativa de login via Google, a informação de nome não está liberada, e é necessário que a mesma esteja visível!");
			}
        } else if(email_redes_enviado.length<5) {
			if($("#tipo_redes").val()=="token_facebook") {
				//alert("Ocorreu algum erro na tentativa de login via Facebook, a informação de e-mail não está liberada, e é necessário que a mesma esteja visível!");
				$( "#BTN_myModalFacebook" ).trigger( "click" );
			} else {
				alert("Ocorreu algum erro na tentativa de login via Google, a informação de e-mail não está liberada, e é necessário que a mesma esteja visível!");
			}
        } else {
           document.login_form_redes.submit();
        }
    }
    function signoutRedes() {
        firebase.auth().signOut().then(function() {
            console.log('Signout successful!')
			<? if(trim($rSqlUsuario['id'])=="") { ?>
            window.open('<?=$link_modelo?>acesse-sua-conta/','_parent','');
			<? } else { ?>
            window.open('<?=$link_modelo?>painel/sair/','_parent','');
			<? } ?>
        }).catch(function(error) {
            console.log('Signout failed')
        });
    }
    function loginFacebook() {
        firebase.auth().signOut().then(function() {
            console.log('Signout successful!')
			<? if(trim($rSqlUsuario['id'])=="") { ?>
            window.open('<?=$link_modelo?>acesse-sua-conta/','_parent','');
			<? } else { ?>
            window.open('<?=$link_modelo?>painel/sair/','_parent','');
			<? } ?>
        }).catch(function(error) {
            console.log('Signout failed')
        });
    }

	function fazLoginModalFacebook() {
		if($.trim($("#email_facebook").val())=="") {
			alert("Campo 'E-mail' deve ser preenchido");
			$("#email_facebook").focus();
		} else {
			$("#email_redes").val($("#email_facebook").val());
            document.login_form_redes.submit();
		}
	}

	function fazLogin() {
		if($.trim($("#email").val())=="") {
			alert("Campo 'Login' deve ser preenchido");
			$("#email").focus();
		} else {
			if($.trim($("#senha").val())=="") {
				alert("Campo 'Senha' deve ser preenchido");
				$("#senha").focus();
			} else {
				document.login_form.submit();
			}
		}
	}

	function enviaEsqueceuSenha() {
		if($.trim($("#email").val())=="") {
			alert("Campo 'E-mail' deve ser preenchido");
			$("#email").focus();
		} else {
			document.esqueceu_senha_form.submit();
		}
	}

	function enviarCadastro() {
		if($.trim($("#nome").val())=="") {
			alert("Campo 'Nome' deve ser preenchido");
			$("#nome").focus();
		} else {
			if(verificaCpf($("#documento").val())) {
				if($.trim($("#email").val())=="") {
					alert("Campo 'E-mail' deve ser preenchido");
					$("#email").focus();
					
				} else if($.trim($("#whatsapp").val())=="") {
					alert("Campo 'Telefone' deve ser preenchido");
					$("#whatsapp").focus();
					
				} else if($.trim($("#documento").val())=="") {
					alert("Campo 'CPF' deve ser preenchido");
					$("#documento").focus();
					
				<? if(trim($camposArray['campo_cliente_data_de_nascimento'][0]['exibir'])=="1") { ?>
				} else if($.trim($("#data_de_nascimento").val())=="") {
					alert("Campo '<?=$camposArray['campo_cliente_data_de_nascimento'][0]['label']?>' deve ser preenchido");
					$("#data_de_nascimento").focus();
				<? } ?>
					
				} else if($.trim($("#senha").val())=="") {
					alert("Campo 'Senha' deve ser preenchido");
					$("#senha").focus();
					
				} else if($.trim($("#senha_valido").val())=="0") {
					alert("Você está digitando uma senha inválida, corrija para prosseguir!");
					$("#senha").focus();
					
				} else if($.trim($("#conf_senha").val())=="") {
					alert("Campo 'Confirmação de Senha' deve ser preenchido");
					$("#conf_senha").focus();
					
				} else if($.trim($("#conf_senha_valido").val())=="0") {
					alert("Você está digitando uma senha inválida, corrija para prosseguir! Alguns caracteres não são aceitos, tais como espaço, alguns tipos de acentuação e caracteres tais como: & # * ´ `.");
					$("#conf_senha").focus();
					
				} else if($.trim($("#conf_senha").val())!=$.trim($("#senha").val())) {
					alert("As senhas não conferem!");
					
				} else if($.trim($("#aceito_termos").val())=="0") {
					alert("Você precisa aceitar os termos de uso!");
					$("#aceito_termos").focus();
					
				} else if($.trim($("#aceito_politica").val())=="0") {
					alert("Você precisa aceitar as políticas de privacidade!");
					$("#aceito_politica").focus();
					
				} else {
					<? if(trim($camposArray['campo_cliente_data_de_nascimento'][0]['exibir'])=="1" && trim($camposArray['campo_cliente_data_de_nascimento'][0]['menor_18'])=="0") { ?>
					$.ajax({
						url: ""+linkAdminLib+"templates/metronic/acoes/personal/cadastro-retorna-idade.php",
						type: "GET",
						data: "empresaS="+$("#empresa_id").val()+
							  "&data_de_nascimentoS="+$("#data_de_nascimento").val()+"",
						//dataType: "html",
						success: function(data){
							if($.trim(data)<18) {
								$( "#btn_modal_menor_18" ).trigger( "click" );
							} else {
								document.cadastro_form.submit();
							}
						},
					});
					<? } else { ?>
					document.cadastro_form.submit();
					<? } ?>
				}
			} else {
				alert("O CPF informado é inválido");
				$("#documento").focus();
			}
		}
	}

	function carrinhoLista() {
		
		var fd = new FormData();
	
		$.ajax({
			url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/carrinho-lista.php",
			type: 'GET',
			cache: false,
			data: "reloadS=1&numeroUnico_pessoaS="+$("#usuario_numeroUnico").val()+"",
			//dataType: "html",
			success: function(data){
				$("#DIV_carrinho").html(data);
			},
		});
	}

	function carrinhoResumo() {
		
		var fd = new FormData();
	
		$.ajax({
			url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/carrinho-resumo.php",
			type: 'GET',
			cache: false,
			data: "reloadS=1",
			//dataType: "html",
			success: function(data){
				$("#DIV_carrinho_resumo").html(data);
			},
		});
	}

	function carrinhoListaTopBar() {
		
		var fd = new FormData();
	
		$.ajax({
			url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/carrinho-lista-topbar.php",
			type: 'GET',
			cache: false,
			data: "reloadS=1",
			//dataType: "html",
			success: function(data){
				$("#top-cart").html(data);
			},
		});
	}

	function carrinhoDetalhadoLista() {
		
		var fd = new FormData();
	
		$.ajax({
			url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/carrinho-detalhado-lista.php",
			type: 'GET',
			cache: false,
			data: "reloadS=1",
			//dataType: "html",
			success: function(data){
				$("#DIV_carrinho_detalhado").html(data);
			},
		});
	}

	function carrinhoQtdTopBar() {
		
		var fd = new FormData();
	
		$.ajax({
			url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/carrinho-qtd.php",
			type: 'GET',
			cache: false,
			data: "reloadS=1",
			//dataType: "html",
			success: function(data){
				$("#DIV_qtd_carrinho").html(data);
			},
		});
	}

	function interacaoCarrinho(numeroUnico_loteSend,acaoSend,tipoSend) {
		var qtdAtual = parseInt($("#qtd_"+numeroUnico_loteSend+"").val());
		if(acaoSend=="zero") {
			var qtdNova = qtdAtual + 1;
			$("#qtd_"+numeroUnico_loteSend+"").val(""+qtdNova+"");
		} else if(acaoSend=="menos") {
			var qtdNova = qtdAtual - 1;
			$("#qtd_"+numeroUnico_loteSend+"").val(""+qtdNova+"");
			if(qtdNova==0) {
			}
		} else if(acaoSend=="mais") {
			var qtdNova = qtdAtual + 1;
			$("#qtd_"+numeroUnico_loteSend+"").val(""+qtdNova+"");
		}
		carrinhoAdd(numeroUnico_loteSend,acaoSend,tipoSend);
	}

	function carrinhoAdd(numeroUnico_loteSend,acaoSend,tipoSend) {
		
		var fd = new FormData();
	
		fd.append("acao",""+acaoSend+"");
		fd.append("tipo",""+tipoSend+"");
		fd.append("empresa",""+$("#evento_empresa_"+numeroUnico_loteSend+"").val()+"");
		fd.append("empresa_token",""+$("#evento_empresa_token_"+numeroUnico_loteSend+"").val()+"");

		fd.append("numeroUnico_loja",""+$("#numeroUnico_loja_"+numeroUnico_loteSend+"").val()+"");
		fd.append("numeroUnico_produto",""+$("#numeroUnico_produto_"+numeroUnico_loteSend+"").val()+"");
		fd.append("numeroUnico_evento",""+$("#numeroUnico_evento_"+numeroUnico_loteSend+"").val()+"");
		fd.append("numeroUnico_ticket",""+$("#numeroUnico_ticket_"+numeroUnico_loteSend+"").val()+"");
		fd.append("numeroUnico_lote",""+numeroUnico_loteSend+"");
		fd.append("lote",""+$("#lote_"+numeroUnico_loteSend+"").val()+"");

		fd.append("numeroUnico_pessoa",""+$("#usuario_numeroUnico").val()+"");

		fd.append("produto_nome",""+$("#produto_nome_"+numeroUnico_loteSend+"").val()+"");
		fd.append("evento_nome",""+$("#evento_nome_"+numeroUnico_loteSend+"").val()+"");
		fd.append("ingresso_nome",""+$("#ingresso_nome_"+numeroUnico_loteSend+"").val()+"");
		fd.append("ingresso_data",""+$("#ingresso_data_"+numeroUnico_loteSend+"").val()+"");
		fd.append("ticket_genero",""+$("#ticket_genero_"+numeroUnico_loteSend+"").val()+"");
		fd.append("ticket_compra_autorizada",""+$("#ticket_compra_autorizada_"+numeroUnico_loteSend+"").val()+"");
		fd.append("imagem",""+$("#imagem_"+numeroUnico_loteSend+"").val()+"");
		fd.append("ticket_exibir_lote",""+$("#ticket_exibir_lote_"+numeroUnico_loteSend+"").val()+"");
		fd.append("ticket_exibir_taxa",""+$("#ticket_exibir_taxa_"+numeroUnico_loteSend+"").val()+"");
		fd.append("ticket_exigir_atribuicao",""+$("#ticket_exigir_atribuicao_"+numeroUnico_loteSend+"").val()+"");

		fd.append("valor",""+$("#valor_"+numeroUnico_loteSend+"").val()+"");
		fd.append("valor_subtotal",""+$("#valor_subtotal_"+numeroUnico_loteSend+"").val()+"");
		fd.append("valor_total",""+$("#valor_total_"+numeroUnico_loteSend+"").val()+"");
		fd.append("valor_promocional",""+$("#valor_promocional_"+numeroUnico_loteSend+"").val()+"");
		fd.append("valor_pago",""+$("#valor_pago_"+numeroUnico_loteSend+"").val()+"");

		fd.append("qtd",""+$("#qtd_"+numeroUnico_loteSend+"").val()+"");
	
		$.ajax({
			url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/carrinho-add.php",
			type: 'POST',
			data: fd,
			contentType: false,
			processData: false,
			success: function(response){
				<? if($pagina=="carrinho.php") { ?>
					location.reload();
				<? } ?>
				carrinhoListaTopBar();
			},
		});
	}

	function carrinhoDel(numeroUnicoSend,numeroUnico_loteSend) {
		
		var fd = new FormData();
	
		fd.append("numeroUnico",""+numeroUnicoSend+"");
		fd.append("numeroUnico_lote",""+numeroUnico_loteSend+"");
	
		$.ajax({
			url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/carrinho-del.php",
			type: 'POST',
			data: fd,
			contentType: false,
			processData: false,
			success: function(response){
				$.ajax({
					url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/carrinho-qtd.php",
					type: 'GET',
					cache: false,
					data: "reloadS=1",
					//dataType: "html",
					success: function(data){
						if($.trim(data)=="0") {
							location.reload();
						} else {
							<? if($pagina=="carrinho.php") { ?>
							location.reload();
							<? } else { ?>
							$("#qtd_"+numeroUnico_loteSend+"").val("0");
							$("#BTN_mais_menos_"+numeroUnico_loteSend+"").hide();
							$("#BTN_comprar_add_"+numeroUnico_loteSend+"").fadeIn();
							<? } ?>
							carrinhoListaTopBar();
						}
					},
				});

			},
		});
	}

	function carrinhoDetalhadoDel(numeroUnicoSend,numeroUnico_loteSend) {
		
		var fd = new FormData();
	
		fd.append("numeroUnico",""+numeroUnicoSend+"");
		fd.append("numeroUnico_lote",""+numeroUnico_loteSend+"");
	
		$.ajax({
			url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/carrinho-detalhado-del.php",
			type: 'POST',
			data: fd,
			contentType: false,
			processData: false,
			success: function(response){
				location.reload();
				carrinhoLista();
				carrinhoDetalhadoLista();
				carrinhoResumo();
				carrinhoListaTopBar();
			},
		});
	}

	function carrinhoOutro(numeroUnicoSend) {
		$("#pessoa_nome_"+numeroUnicoSend+"").val("");
		$("#pessoa_documento_"+numeroUnicoSend+"").val("");
		$("#pessoa_email_"+numeroUnicoSend+"").val("");
		$("#pessoa_telefone_"+numeroUnicoSend+"").val("");

		$("#pessoa_nome_"+numeroUnicoSend+"").focus();
	}

	function carrinhoSimMeu(numeroUnicoSend,marcadoSend,numeroUnico_eventoSend) {
		$("#pessoa_nome_"+numeroUnicoSend+"").val(""+$("#usuario_pessoa_nome_"+numeroUnicoSend+"").val()+"");
		$("#pessoa_documento_"+numeroUnicoSend+"").val(""+$("#usuario_pessoa_documento_"+numeroUnicoSend+"").val()+"");
		$("#pessoa_email_"+numeroUnicoSend+"").val(""+$("#usuario_pessoa_email_"+numeroUnicoSend+"").val()+"");
		$("#pessoa_telefone_"+numeroUnicoSend+"").val(""+$("#usuario_pessoa_telefone_"+numeroUnicoSend+"").val()+"");

		if(($.trim($("#usuario_pessoa_nome_"+numeroUnicoSend+"").val())=="" ||
            $.trim($("#usuario_pessoa_documento_"+numeroUnicoSend+"").val())=="" ||
            $.trim($("#usuario_pessoa_email_"+numeroUnicoSend+"").val())=="" ||
            $.trim($("#usuario_pessoa_telefone_"+numeroUnicoSend+"").val())=="") && $.trim(marcadoSend)=="1"
        ) {
		} else {
			carrinhoMeu(numeroUnicoSend,marcadoSend,numeroUnico_eventoSend);
		}
	}

	function carrinhoMeu(numeroUnicoSend,marcadoSend,numeroUnico_eventoSend) {
		var fd = new FormData();
	
		fd.append("numeroUnico",""+numeroUnicoSend+"");
		fd.append("compra_autorizada",""+$("#compra_autorizada_"+numeroUnicoSend+"").val()+"");
		fd.append("pessoa_nome",""+$("#pessoa_nome_"+numeroUnicoSend+"").val()+"");
		fd.append("pessoa_documento",""+$("#pessoa_documento_"+numeroUnicoSend+"").val()+"");
		fd.append("pessoa_email",""+$("#pessoa_email_"+numeroUnicoSend+"").val()+"");
		fd.append("pessoa_telefone",""+$("#pessoa_telefone_"+numeroUnicoSend+"").val()+"");
		fd.append("email_enviar",""+$("#email_enviar_"+numeroUnicoSend+"").val()+"");
		fd.append("telefone_enviar",""+$("#telefone_enviar_"+numeroUnicoSend+"").val()+"");
		fd.append("numeroUnico_evento",""+$("#numeroUnico_evento_"+numeroUnicoSend+"").val()+"");
		fd.append("numeroUnico_ticket",""+$("#numeroUnico_ticket_"+numeroUnicoSend+"").val()+"");
		fd.append("marcado",""+marcadoSend+"");
		
		var qtd_carrinho_detalhado_marcado = $("#qtd_carrinho_detalhado_marcado").val();
	
		$.ajax({
			url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/carrinho-marcacao.php",
			type: 'POST',
			data: fd,
			contentType: false,
			processData: false,
			success: function(response){
				if($.trim(response)=="ja_possui" && $.trim(marcadoSend)=="1") {
					alert("Este CPF informado já possui <?=strtolower($configuracoes_site['label_ticket_singular'])?> para este <?=strtolower($configuracoes_site['label_evento_singular'])?>, e um CPF só pode ter um <?=strtolower($configuracoes_site['label_ticket_singular'])?> por <?=strtolower($configuracoes_site['label_evento_singular'])?>!");
				} else if($.trim(response)=="ja_existe" && $.trim(marcadoSend)=="1") {
					alert("Você já utilizou o mesmo CPF em um dos <?=strtolower($configuracoes_site['label_produto_plural'])?>, e um CPF só pode ter um <?=strtolower($configuracoes_site['label_ticket_singular'])?> por <?=strtolower($configuracoes_site['label_evento_singular'])?>!");
				} else if($.trim(response)=="nao_autorizada" && $.trim(marcadoSend)=="1") {
					alert("O CPF informado em um dos <?=strtolower($configuracoes_site['label_produto_plural'])?>, não possui autorização para adquirir este <?=strtolower($configuracoes_site['label_ticket_singular'])?>!");
				} else {
					location.reload();
					qtd_carrinho_detalhado_marcado = parseInt(qtd_carrinho_detalhado_marcado);
					if($.trim(marcadoSend)=="1") {
						qtd_carrinho_detalhado_marcado = qtd_carrinho_detalhado_marcado + 1;
						$("#marcado_"+numeroUnicoSend+"").val("1");

						$("#BTN_meu_marcar_"+numeroUnicoSend+"").hide();
						$("#BTN_meu_desmarcar_"+numeroUnicoSend+"").fadeIn();

						$("#marcado_pessoa_nome_"+numeroUnicoSend+"").val(""+$("#usuario_pessoa_nome_"+numeroUnicoSend+"").val()+"");
						$("#marcado_pessoa_documento_"+numeroUnicoSend+"").val(""+$("#usuario_pessoa_documento_"+numeroUnicoSend+"").val()+"");
						$("#marcado_pessoa_email_"+numeroUnicoSend+"").val(""+$("#usuario_pessoa_email_"+numeroUnicoSend+"").val()+"");
						$("#marcado_pessoa_telefone_"+numeroUnicoSend+"").val(""+$("#usuario_pessoa_telefone_"+numeroUnicoSend+"").val()+"");
						
						$("#pessoa_nome_"+numeroUnicoSend+"").hide();
						$("#pessoa_documento_"+numeroUnicoSend+"").hide();
						$("#pessoa_email_"+numeroUnicoSend+"").hide();
						$("#pessoa_telefone_"+numeroUnicoSend+"").hide();

						$("#marcado_pessoa_nome_"+numeroUnicoSend+"").fadeIn();
						$("#marcado_pessoa_documento_"+numeroUnicoSend+"").fadeIn();
						$("#marcado_pessoa_email_"+numeroUnicoSend+"").fadeIn();
						$("#marcado_pessoa_telefone_"+numeroUnicoSend+"").fadeIn();

						$("#BTN_carrinho_marcar_"+numeroUnicoSend+"").hide();
						$("#BTN_carrinho_desmarcar_"+numeroUnicoSend+"").fadeIn();

						$("#DIV_msg_meu_outro_"+numeroUnicoSend+"").hide();

						$( "."+numeroUnico_eventoSend+"" ).each(function( index ) {
							var numeroUnicoSet = $( this ).attr("numeroUnico");
							if(numeroUnicoSet==numeroUnicoSend) {
							} else {
								if($.trim($("#marcado_"+numeroUnicoSet+"").val())=="0") {
									$("#pessoa_nome_"+numeroUnicoSet+"").val("");
									$("#pessoa_documento_"+numeroUnicoSet+"").val("");
									$("#pessoa_email_"+numeroUnicoSet+"").val("");
									$("#pessoa_telefone_"+numeroUnicoSet+"").val("");
						
									$("#marcado_pessoa_nome_"+numeroUnicoSet+"").val("");
									$("#marcado_pessoa_documento_"+numeroUnicoSet+"").val("");
									$("#marcado_pessoa_email_"+numeroUnicoSet+"").val("");
									$("#marcado_pessoa_telefone_"+numeroUnicoSet+"").val("");
								}
							}
						});

					} else if($.trim(marcadoSend)=="0") {
						qtd_carrinho_detalhado_marcado = qtd_carrinho_detalhado_marcado - 1;
						
						$("#marcado_"+numeroUnicoSend+"").val("0");
						
						$("#pessoa_nome_"+numeroUnicoSend+"").val("");
						$("#pessoa_documento_"+numeroUnicoSend+"").val("");
						$("#pessoa_email_"+numeroUnicoSend+"").val("");
						$("#pessoa_telefone_"+numeroUnicoSend+"").val("");
			
						$("#marcado_pessoa_nome_"+numeroUnicoSend+"").val("");
						$("#marcado_pessoa_documento_"+numeroUnicoSend+"").val("");
						$("#marcado_pessoa_email_"+numeroUnicoSend+"").val("");
						$("#marcado_pessoa_telefone_"+numeroUnicoSend+"").val("");

						$("#pessoa_nome_"+numeroUnicoSend+"").fadeIn();
						$("#pessoa_documento_"+numeroUnicoSend+"").fadeIn();
						$("#pessoa_email_"+numeroUnicoSend+"").fadeIn();
						$("#pessoa_telefone_"+numeroUnicoSend+"").fadeIn();

						$("#marcado_pessoa_nome_"+numeroUnicoSend+"").hide();
						$("#marcado_pessoa_documento_"+numeroUnicoSend+"").hide();
						$("#marcado_pessoa_email_"+numeroUnicoSend+"").hide();
						$("#marcado_pessoa_telefone_"+numeroUnicoSend+"").hide();

						var checado_email = $("#email_enviar_"+numeroUnicoSend+"").val();
						if($.trim(checado_email)=="1") { } else if($.trim(checado_email)=="0") {
							$("#pessoa_email_check_"+numeroUnicoSend+"").trigger( "click" );
						}
			
						var checado_telefone = $("#telefone_enviar_"+numeroUnicoSend+"").val();
						if($.trim(checado_telefone)=="1") { } else if($.trim(checado_telefone)=="0") {
							$("#pessoa_telefone_check_"+numeroUnicoSend+"").trigger( "click" );
						}
	
						$("#BTN_carrinho_desmarcar_"+numeroUnicoSend+"").hide();
						$("#BTN_carrinho_marcar_"+numeroUnicoSend+"").fadeIn();

						$("#BTN_meu_desmarcar_"+numeroUnicoSend+"").hide();
						$("#BTN_meu_marcar_"+numeroUnicoSend+"").fadeIn();

						$("#DIV_msg_meu_outro_"+numeroUnicoSend+"").fadeIn();

						$( "."+numeroUnico_eventoSend+"" ).each(function( index ) {
							var numeroUnicoSet = $( this ).attr("numeroUnico");
							if(numeroUnicoSet==numeroUnicoSend) {
							} else {
								if($.trim($("#marcado_"+numeroUnicoSet+"").val())=="0") {
									$("#DIV_msg_meu_outro_"+numeroUnicoSet+"").fadeIn();
	
									$("#BTN_meu_desmarcar_"+numeroUnicoSet+"").hide();
									$("#BTN_meu_marcar_"+numeroUnicoSet+"").fadeIn();
								}
							}
						});
					}
					$("#qtd_carrinho_detalhado_marcado").val(qtd_carrinho_detalhado_marcado);
				}
			},
		});
	}

	function carrinhoMarcacao(numeroUnicoSend,marcadoSend,numeroUnico_eventoSend) {
		
		if($.trim($("#pessoa_nome_"+numeroUnicoSend+"").val())=="" && $.trim(marcadoSend)=="1") {
			alert("Você deve preencher o campo 'Nome'");
			$("#pessoa_nome_"+numeroUnicoSend+"").focus();
			
		} else if($.trim($("#pessoa_documento_"+numeroUnicoSend+"").val())=="" && $.trim(marcadoSend)=="1") {
			alert("Você deve preencher o campo 'CPF'");
			$("#pessoa_documento_"+numeroUnicoSend+"").focus();

		} else if(validarCpf("pessoa_documento_"+numeroUnicoSend+"")===false && $.trim(marcadoSend)=="1") {
			alert("Você precisa informar um 'CPF' válido");
			$("#pessoa_documento_"+numeroUnicoSend+"").focus();
			
		} else if($.trim($("#pessoa_email_"+numeroUnicoSend+"").val())=="" && $.trim(marcadoSend)=="1") {
			alert("Você deve preencher o campo 'E-mail'");
			$("#pessoa_email_"+numeroUnicoSend+"").focus();

		} else if(validarEmail("pessoa_email_"+numeroUnicoSend+"")===false) {
			alert("Você precisa informar um E-mail válido");
			$("#pessoa_email_"+numeroUnicoSend+"").focus();
			
		} else if($.trim( $("#pessoa_email_"+numeroUnicoSend+"_valido").val() )=="0") {
			alert("Você precisa informar um E-mail válido");
			$("#pessoa_email_"+numeroUnicoSend+"_valido").focus();
			
		} else if($.trim($("#pessoa_telefone_"+numeroUnicoSend+"").val())=="" && $.trim(marcadoSend)=="1") {
			alert("Você deve preencher o campo 'Telefone'");
			$("#pessoa_telefone_"+numeroUnicoSend+"").focus();
			
		} else {
			var fd = new FormData();
		
			fd.append("numeroUnico",""+numeroUnicoSend+"");
			fd.append("compra_autorizada",""+$("#compra_autorizada_"+numeroUnicoSend+"").val()+"");
			fd.append("pessoa_nome",""+$("#pessoa_nome_"+numeroUnicoSend+"").val()+"");
			fd.append("pessoa_documento",""+$("#pessoa_documento_"+numeroUnicoSend+"").val()+"");
			fd.append("pessoa_email",""+$("#pessoa_email_"+numeroUnicoSend+"").val()+"");
			fd.append("pessoa_telefone",""+$("#pessoa_telefone_"+numeroUnicoSend+"").val()+"");
			fd.append("email_enviar",""+$("#email_enviar_"+numeroUnicoSend+"").val()+"");
			fd.append("telefone_enviar",""+$("#telefone_enviar_"+numeroUnicoSend+"").val()+"");
			fd.append("numeroUnico_evento",""+$("#numeroUnico_evento_"+numeroUnicoSend+"").val()+"");
			fd.append("numeroUnico_ticket",""+$("#numeroUnico_ticket_"+numeroUnicoSend+"").val()+"");
			fd.append("marcado",""+marcadoSend+"");
			
			alert("["+$("#compra_autorizada_"+numeroUnicoSend+"").val()+"]");
			alert("["+$("#numeroUnico_evento_"+numeroUnicoSend+"").val()+"]");
			alert("["+$("#numeroUnico_ticket_"+numeroUnicoSend+"").val()+"]");
			
			var qtd_carrinho_detalhado_marcado = $("#qtd_carrinho_detalhado_marcado").val();
		
			$.ajax({
				url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/carrinho-marcacao.php",
				type: 'POST',
				data: fd,
				contentType: false,
				processData: false,
				success: function(response){
					if($.trim(response)=="ja_possui" && $.trim(marcadoSend)=="1") {
						alert("Este CPF informado já possui <?=strtolower($configuracoes_site['label_ticket_singular'])?> para este <?=strtolower($configuracoes_site['label_evento_singular'])?>, e um CPF só pode ter um <?=strtolower($configuracoes_site['label_ticket_singular'])?> por <?=strtolower($configuracoes_site['label_evento_singular'])?>!");
					} else if($.trim(response)=="ja_existe" && $.trim(marcadoSend)=="1") {
						alert("Você já utilizou o mesmo CPF em um dos <?=strtolower($configuracoes_site['label_produto_plural'])?>, e um CPF só pode ter um <?=strtolower($configuracoes_site['label_ticket_singular'])?> por <?=strtolower($configuracoes_site['label_evento_singular'])?>!");
					} else if($.trim(response)=="nao_autorizada" && $.trim(marcadoSend)=="1") {
						alert("O CPF informado em um dos <?=strtolower($configuracoes_site['label_produto_plural'])?>, não possui autorização para adquirir este <?=strtolower($configuracoes_site['label_ticket_singular'])?>!");
					} else {
						location.reload();
						qtd_carrinho_detalhado_marcado = parseInt(qtd_carrinho_detalhado_marcado);
						if($.trim(marcadoSend)=="1") {
							qtd_carrinho_detalhado_marcado = qtd_carrinho_detalhado_marcado + 1;
							
							$("#marcado_"+numeroUnicoSend+"").val("1");
							
							$("#BTN_carrinho_marcar_"+numeroUnicoSend+"").hide();
							$("#BTN_carrinho_desmarcar_"+numeroUnicoSend+"").fadeIn();

							$("#marcado_pessoa_nome_"+numeroUnicoSend+"").val(""+$("#pessoa_nome_"+numeroUnicoSend+"").val()+"");
							$("#marcado_pessoa_documento_"+numeroUnicoSend+"").val(""+$("#pessoa_documento_"+numeroUnicoSend+"").val()+"");
							$("#marcado_pessoa_email_"+numeroUnicoSend+"").val(""+$("#pessoa_email_"+numeroUnicoSend+"").val()+"");
							$("#marcado_pessoa_telefone_"+numeroUnicoSend+"").val(""+$("#pessoa_telefone_"+numeroUnicoSend+"").val()+"");
	
							$("#pessoa_nome_"+numeroUnicoSend+"").hide();
							$("#pessoa_documento_"+numeroUnicoSend+"").hide();
							$("#pessoa_email_"+numeroUnicoSend+"").hide();
							$("#pessoa_telefone_"+numeroUnicoSend+"").hide();
	
							$("#marcado_pessoa_nome_"+numeroUnicoSend+"").fadeIn();
							$("#marcado_pessoa_documento_"+numeroUnicoSend+"").fadeIn();
							$("#marcado_pessoa_email_"+numeroUnicoSend+"").fadeIn();
							$("#marcado_pessoa_telefone_"+numeroUnicoSend+"").fadeIn();
	
							$("#BTN_meu_marcar_"+numeroUnicoSend+"").hide();
							$("#BTN_meu_desmarcar_"+numeroUnicoSend+"").fadeIn();

							$("#DIV_msg_meu_outro_"+numeroUnicoSend+"").hide();

						} else if($.trim(marcadoSend)=="0") {
							qtd_carrinho_detalhado_marcado = qtd_carrinho_detalhado_marcado - 1;
							
							$("#marcado_"+numeroUnicoSend+"").val("0");
							
							$("#pessoa_nome_"+numeroUnicoSend+"").val("");
							$("#pessoa_documento_"+numeroUnicoSend+"").val("");
							$("#pessoa_email_"+numeroUnicoSend+"").val("");
							$("#pessoa_telefone_"+numeroUnicoSend+"").val("");
				
							$("#marcado_pessoa_nome_"+numeroUnicoSend+"").val("");
							$("#marcado_pessoa_documento_"+numeroUnicoSend+"").val("");
							$("#marcado_pessoa_email_"+numeroUnicoSend+"").val("");
							$("#marcado_pessoa_telefone_"+numeroUnicoSend+"").val("");

							$("#pessoa_nome_"+numeroUnicoSend+"").fadeIn();
							$("#pessoa_documento_"+numeroUnicoSend+"").fadeIn();
							$("#pessoa_email_"+numeroUnicoSend+"").fadeIn();
							$("#pessoa_telefone_"+numeroUnicoSend+"").fadeIn();
	
							$("#marcado_pessoa_nome_"+numeroUnicoSend+"").hide();
							$("#marcado_pessoa_documento_"+numeroUnicoSend+"").hide();
							$("#marcado_pessoa_email_"+numeroUnicoSend+"").hide();
							$("#marcado_pessoa_telefone_"+numeroUnicoSend+"").hide();
	
							var checado_email = $("#email_enviar_"+numeroUnicoSend+"").val();
							if($.trim(checado_email)=="1") { } else if($.trim(checado_email)=="0") {
								$("#pessoa_email_check_"+numeroUnicoSend+"").trigger( "click" );
							}
				
							var checado_telefone = $("#telefone_enviar_"+numeroUnicoSend+"").val();
							if($.trim(checado_telefone)=="1") { } else if($.trim(checado_telefone)=="0") {
								$("#pessoa_telefone_check_"+numeroUnicoSend+"").trigger( "click" );
							}
	
							$("#BTN_carrinho_desmarcar_"+numeroUnicoSend+"").hide();
							$("#BTN_carrinho_marcar_"+numeroUnicoSend+"").fadeIn();

							$("#BTN_meu_desmarcar_"+numeroUnicoSend+"").hide();
							$("#BTN_meu_marcar_"+numeroUnicoSend+"").fadeIn();

							$("#DIV_msg_meu_outro_"+numeroUnicoSend+"").fadeIn();

							$( "."+numeroUnico_eventoSend+"" ).each(function( index ) {
								var numeroUnicoSet = $( this ).attr("numeroUnico");
								if(numeroUnicoSet==numeroUnicoSend) {
								} else {
									if($.trim($("#marcado_"+numeroUnicoSet+"").val())=="0") {
										$("#DIV_msg_meu_outro_"+numeroUnicoSet+"").fadeIn();
		
										$("#BTN_meu_desmarcar_"+numeroUnicoSet+"").hide();
										$("#BTN_meu_marcar_"+numeroUnicoSet+"").fadeIn();
									}
								}
							});
						}
						$("#qtd_carrinho_detalhado_marcado").val(qtd_carrinho_detalhado_marcado);
						carrinhoResumo();
					}
				},
			});
		}
	}


	function carrinhoAccordion(tabSend) {
		if($.trim(tabSend)=="TAB_carrinho_detalhado") {
			$('#TAB_carrinho_detalhado').trigger('click');
			
		} else if($.trim(tabSend)=="TAB_carrinho_resumo") {
			var qtd_carrinho_detalhado = parseInt($("#qtd_carrinho_detalhado").val());
			var qtd_carrinho_detalhado_marcado = parseInt($("#qtd_carrinho_detalhado_marcado").val());
			if(qtd_carrinho_detalhado_marcado<qtd_carrinho_detalhado) {
				alert("Você ainda não informou os dados para todos os <?=$configuracoes_site['label_produto_plural']?>!");
			} else {
				$('#TAB_carrinho_resumo').trigger('click');
			}

		} else if($.trim(tabSend)=="TAB_endereco") {
			var qtd_carrinho_detalhado = parseInt($("#qtd_carrinho_detalhado").val());
			var qtd_carrinho_detalhado_marcado = parseInt($("#qtd_carrinho_detalhado_marcado").val());
			if(qtd_carrinho_detalhado_marcado<qtd_carrinho_detalhado) {
				alert("Você ainda não informou os dados para todos os <?=strtolower($configuracoes_site['label_ticket_plural'])?>!");
			} else {
				$('#TAB_endereco').trigger('click');
			}

		} else if($.trim(tabSend)=="TAB_carrinho_forma_pagamento") {
			$('#cobranca_creditos_total').html(""+$("#valor_credito_txt").val()+"");
			if(parseInt($("#valor_cobranca_real").val())>parseInt($("#valor_credito_real").val())) {
				$("#cobranca_creditos_nao_possui").show();
			} else {
				$("#cobranca_creditos_nao_possui").hide();
			}

			var qtd_carrinho_detalhado = parseInt($("#qtd_carrinho_detalhado").val());
			var qtd_carrinho_detalhado_marcado = parseInt($("#qtd_carrinho_detalhado_marcado").val());
			if(qtd_carrinho_detalhado_marcado<qtd_carrinho_detalhado) {
				alert("Você ainda não informou os dados para todos os <?=strtolower($configuracoes_site['label_ticket_plural'])?>!");
			} else {
				if($.trim($("#cobranca_cep").val())=="") {
					alert("Você deve preencher o campo 'CEP'!");
					$('#TAB_endereco').trigger('click');
					$("#cobranca_cep").focus();
				
				} else if($.trim($("#cobranca_rua").val())=="") {
					alert("Você deve preencher o campo 'Rua'!");
					$('#TAB_endereco').trigger('click');
					$("#cobranca_rua").focus();
				
				} else if($.trim($("#cobranca_numero").val())=="") {
					alert("Você deve preencher o campo 'Número'!");
					$('#TAB_endereco').trigger('click');
					$("#cobranca_numero").focus();
				
				} else if($.trim($("#cobranca_estado").val())=="") {
					alert("Você deve preencher o campo 'Estado'!");
					$('#TAB_endereco').trigger('click');
					$("#cobranca_estado").focus();
				
				} else if($.trim($("#cobranca_cidade").val())=="") {
					alert("Você deve preencher o campo 'Cidade'!");
					$('#TAB_endereco').trigger('click');
					$("#cobranca_cidade").focus();
				
				} else if($.trim($("#cobranca_bairro").val())=="") {
					alert("Você deve preencher o campo 'Bairro'!");
					$('#TAB_endereco').trigger('click');
					$("#cobranca_bairro").focus();
				} else {
					$('#TAB_carrinho_forma_pagamento').trigger('click');
				}
			}

		}
	}

	function carrinhoCupom(acaoSend) {
		if($.trim($("#codigo_cupom").val())=="") {
			alert("Você deve preencher o campo 'Cupom'");
			$("#codigo_cupom").focus();
		} else {
			$.ajax({
				url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/carrinho-cupom.php",
				type: "GET",
				data: "codigoS="+$("#codigo_cupom").val()+"&empresaS="+$("#empresa_id").val()+"&acaoS="+acaoSend+"",
				//dataType: "html",
				success: function(data){
					if($.trim(data)=="nao_possui") {
						alert("O código informado não possui cupom ativo!");
					} else {
						carrinhoLista();
						carrinhoDetalhadoLista();
						carrinhoResumo();
					}
				},
			});
		}
	}

	function carrinhoCupomReload(acaoSend) {
		if($.trim($("#codigo_cupom").val())=="") {
			alert("Você deve preencher o campo 'Cupom'");
			$("#codigo_cupom").focus();
		} else {
			$.ajax({
				url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/carrinho-cupom.php",
				type: "GET",
				data: "codigoS="+$("#codigo_cupom").val()+"&empresaS="+$("#empresa_id").val()+"&acaoS="+acaoSend+"",
				//dataType: "html",
				success: function(data){
					if($.trim(data)=="nao_possui") {
						alert("O código informado não possui cupom ativo!");
					} else {
						location.reload();
					}
				},
			});
		}
	}

	function seleciona_forma_de_pagamento(divSend) {
		$(".BTN_forma_de_pagamento").removeClass("gradient-blue-purple");
		$(".BTN_forma_de_pagamento").addClass("button-white button-light");
		
		$("#forma_de_pagamento").val(""+divSend+"");
		$("#BTN_"+divSend+"").removeClass("button-white button-light");
		$("#BTN_"+divSend+"").addClass("gradient-blue-purple");

		$(".DIV_formas_de_pagamento").hide();
		$("#DIV_"+divSend+"").fadeIn();
	}

	function cobrancaVerificarCamposPagamento(formaDePagamentoSend,localSend) {
		var qtd_carrinho_detalhado = parseInt($("#qtd_carrinho_detalhado").val());
		var qtd_carrinho_detalhado_marcado = parseInt($("#qtd_carrinho_detalhado_marcado").val());
		if(qtd_carrinho_detalhado_marcado<qtd_carrinho_detalhado) {
			alert("Você ainda não informou os dados para todos os <?=strtolower($configuracoes_site['label_ticket_plural'])?>!");
			$('#TAB_carrinho_detalhado').trigger('click');
		} else {
			if($.trim($("#cobranca_cep").val())=="") {
				alert("Você deve preencher o campo 'CEP'!");
				$("#cobranca_cep").focus();
				$('#TAB_endereco').trigger('click');
			
			} else if($.trim($("#cobranca_rua").val())=="") {
				alert("Você deve preencher o campo 'Rua'!");
				$("#cobranca_rua").focus();
				$('#TAB_endereco').trigger('click');
			
			} else if($.trim($("#cobranca_numero").val())=="") {
				alert("Você deve preencher o campo 'Número'!");
				$("#cobranca_numero").focus();
				$('#TAB_endereco').trigger('click');
			
			} else if($.trim($("#cobranca_estado").val())=="") {
				alert("Você deve preencher o campo 'Estado'!");
				$("#cobranca_estado").focus();
				$('#TAB_endereco').trigger('click');
			
			} else if($.trim($("#cobranca_cidade").val())=="") {
				alert("Você deve preencher o campo 'Cidade'!");
				$("#cobranca_cidade").focus();
				$('#TAB_endereco').trigger('click');
			
			} else if($.trim($("#cobranca_bairro").val())=="") {
				alert("Você deve preencher o campo 'Bairro'!");
				$("#cobranca_bairro").focus();
				$('#TAB_endereco').trigger('click');

			} else {

				$('#TAB_carrinho_forma_pagamento').trigger('click');
				if($.trim(formaDePagamentoSend)=="cartao") {
					if($.trim($("#cobranca_cartao_card_number").val())=="") {
						alert("Você deve preencher o campo 'Número do Cartão'");
						$("#cobranca_cartao_card_number").focus();
						
					} else if($.trim($("#cobranca_cartao_card_cvv").val())=="") {
						alert("Você deve preencher o campo 'CVV (Código de Segurança)'");
						$("#cobranca_cartao_card_cvv").focus();
						
					} else if($.trim($("#cobranca_cartao_card_bin").val())=="") {
						alert("Você deve selecionar uma 'Bandeira'");
						$("#cobranca_cartao_card_bin").focus();
						
					} else if($.trim($("#cobranca_cartao_card_exp_month").val())=="") {
						alert("Você deve preencher o campo 'Mês de Expiração'");
						$("#cobranca_cartao_card_exp_month").focus();
						
					} else if($.trim($("#cobranca_cartao_card_exp_year").val())=="") {
						alert("Você deve preencher o campo 'Ano de Expiração'");
						$("#cobranca_cartao_card_exp_year").focus();
						
					} else if($.trim($("#cobranca_cartao_card_name").val())=="") {
						alert("Você deve preencher o campo 'Nome do Proprietário'");
						$("#cobranca_cartao_card_name").focus();
						
					} else if($.trim($("#cobranca_cartao_card_cpf").val())=="") {
						alert("Você deve preencher o campo 'CPF do Proprietário'");
						$("#cobranca_cartao_card_cpf").focus();
	
					} else if($.trim($("#cobranca_cartao_card_telefone").val())=="") {
						alert("Você deve preencher o campo 'Telefone do Proprietário'");
						$("#cobranca_cartao_card_telefone").focus();
	
					} else if($.trim($("#cobranca_cartao_email").val())=="") {
						alert("Você deve preencher o campo 'E-mail do Proprietário'");
						$("#cobranca_cartao_email").focus();
	
					} else {
						<? if(trim($_REQUEST['var1'])=="pagar-ingresso") { ?>
						ingressoRealizarPagamento('CCR',localSend);
						<? } else { ?>
						cobrancaRealizarPagamento('CCR',localSend);
						<? } ?>
					}
				} else if($.trim(formaDePagamentoSend)=="boleto") {
					if($.trim($("#cobranca_boleto_card_name").val())=="") {
						alert("Você deve preencher o campo 'Nome do Pagador'");
						$("#cobranca_boleto_card_name").focus();
						
					} else if($.trim($("#cobranca_boleto_card_cpf").val())=="") {
						alert("Você deve preencher o campo 'CPF do Pagador'");
						$("#cobranca_boleto_card_cpf").focus();
	
					} else if($.trim($("#cobranca_boleto_card_telefone").val())=="") {
						alert("Você deve preencher o campo 'Telefone do Pagador'");
						$("#cobranca_boleto_card_telefone").focus();
	
					} else if($.trim($("#cobranca_boleto_email").val())=="") {
						alert("Você deve preencher o campo 'E-mail do Pagador'");
						$("#cobranca_boleto_email").focus();
					} else {
						<? if(trim($_REQUEST['var1'])=="pagar-ingresso") { ?>
						ingressoRealizarPagamento('BOLETO',localSend);
						<? } else { ?>
						cobrancaRealizarPagamento('BOLETO',localSend);
						<? } ?>
					}
				} else if($.trim(formaDePagamentoSend)=="pix") {
					if($.trim($("#cobranca_pix_card_name").val())=="") {
						alert("Você deve preencher o campo 'Nome do Pagador'");
						$("#cobranca_pix_card_name").focus();
						
					} else if($.trim($("#cobranca_pix_card_cpf").val())=="") {
						alert("Você deve preencher o campo 'CPF do Pagador'");
						$("#cobranca_pix_card_cpf").focus();
	
					} else if($.trim($("#cobranca_pix_card_telefone").val())=="") {
						alert("Você deve preencher o campo 'Telefone do Pagador'");
						$("#cobranca_pix_card_telefone").focus();
	
					} else if($.trim($("#cobranca_pix_email").val())=="") {
						alert("Você deve preencher o campo 'E-mail do Pagador'");
						$("#cobranca_pix_email").focus();
					} else {
						<? if(trim($_REQUEST['var1'])=="pagar-ingresso") { ?>
						ingressoRealizarPagamento('PIX',localSend);
						<? } else { ?>
						cobrancaRealizarPagamento('PIX',localSend);
						<? } ?>
					}
				} else if($.trim(formaDePagamentoSend)=="credito") {
					if(parseInt($("#valor_cobranca_real").val())>parseInt($("#valor_credito_real").val())) {
						alert("Você não possui créditos suficientes para realizar o pagamento, escolha outra forma de pagamento, ou adicione saldo de créditos à sua conta!");
	
					} else if($.trim($("#cobranca_credito_card_name").val())=="") {
						alert("Você deve preencher o campo 'Nome do Pagador'");
						$("#cobranca_credito_card_name").focus();
						
					} else if($.trim($("#cobranca_credito_card_cpf").val())=="") {
						alert("Você deve preencher o campo 'CPF do Pagador'");
						$("#cobranca_credito_card_cpf").focus();
	
					} else if($.trim($("#cobranca_credito_card_telefone").val())=="") {
						alert("Você deve preencher o campo 'Telefone do Pagador'");
						$("#cobranca_credito_card_telefone").focus();
	
					} else if($.trim($("#cobranca_credito_email").val())=="") {
						alert("Você deve preencher o campo 'E-mail do Pagador'");
						$("#cobranca_credito_email").focus();
					} else {
						<? if(trim($_REQUEST['var1'])=="pagar-ingresso") { ?>
						ingressoRealizarPagamento('CREDITO',localSend);
						<? } else { ?>
						cobrancaRealizarPagamento('CREDITO',localSend);
						<? } ?>
					}
				}

			}

		}

	}

	function ingressoRealizarPagamento(forma_pagamentoSend,localSend) {
		$.ajax({
			url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/confere-campanha.php",
			type: 'GET',
			cache: false,
			data: "cobranca_cartao_card_numberS="+$("#cobranca_cartao_card_number").val()+"",
			//dataType: "html",
			success: function(dataConfere){
				if($.trim(dataConfere)=="SIM") {

					if($.trim(forma_pagamentoSend)=="CCR") {
						$("#BTN_cartao_enviar").hide();
						$("#BTN_cartao_enviando").fadeIn();
					} else if($.trim(forma_pagamentoSend)=="BOLETO") {
						$("#BTN_boleto_enviar").hide();
						$("#BTN_boleto_enviando").fadeIn();
					} else if($.trim(forma_pagamentoSend)=="PIX") {
						$("#BTN_pix_enviar").hide();
						$("#BTN_pix_enviando").fadeIn();
					} else if($.trim(forma_pagamentoSend)=="CREDITO") {
						$("#BTN_credito_enviar").hide();
						$("#BTN_credito_enviando").fadeIn();
					}
			
					if($.trim(forma_pagamentoSend)=="CCR") {
						var nomeSet = $("#cobranca_cartao_card_name").val();
						var cpfSet = $("#cobranca_cartao_card_cpf").val();
						var telefoneSet = $("#cobranca_cartao_card_telefone").val();
						var emailSet = $("#cobranca_cartao_email").val();
					} else if($.trim(forma_pagamentoSend)=="BOLETO") {
						var nomeSet = $("#cobranca_boleto_card_name").val();
						var cpfSet = $("#cobranca_boleto_card_cpf").val();
						var telefoneSet = $("#cobranca_boleto_card_telefone").val();
						var emailSet = $("#cobranca_boleto_email").val();
					} else if($.trim(forma_pagamentoSend)=="PIX") {
						var nomeSet = $("#cobranca_pix_card_name").val();
						var cpfSet = $("#cobranca_pix_card_cpf").val();
						var telefoneSet = $("#cobranca_pix_card_telefone").val();
						var emailSet = $("#cobranca_pix_email").val();
					} else if($.trim(forma_pagamentoSend)=="CREDITO") {
						var nomeSet = $("#cobranca_credito_card_name").val();
						var cpfSet = $("#cobranca_credito_card_cpf").val();
						var telefoneSet = $("#cobranca_credito_card_telefone").val();
						var emailSet = $("#cobranca_credito_email").val();
					}
			
					var Objeto = {
								tipo_checkout: "pagamento_ingresso",
								id_transacao: "<?=$rSqlItem['numeroUnico']?>",
								forma_pagamento: forma_pagamentoSend,
								qtd_parcelas: $("#qtd_parcelas").val(),
								codigo_cupom: ""+$("#codigo_cupom").val()+"",
								comprador: {
									nome: "<?=$rSqlUsuario['nome']?>",
									documento: cpfSet,
									email: "<?=$rSqlUsuario['email']?>",
									whatsapp: telefoneSet,
									telefone: "",
									endereco: {
										cep: $("#cobranca_cep").val(),
										rua: $("#cobranca_rua").val(),
										numero: $("#cobranca_numero").val(),
										complemento: $("#cobranca_complemento").val(),
										bairro: $("#cobranca_bairro").val(),
										cidade: $("#cobranca_cidade").val(),
										estado: $("#cobranca_estado").val(),
									},
								},
								pagamento: {
									titular_nome: nomeSet,
									titular_documento: cpfSet,
									titular_email: emailSet,
									titular_telefone: emailSet,
									cartao_numero: $("#cobranca_cartao_card_number").val(),
									cartao_vencimento_mes: $("#cobranca_cartao_card_exp_month").val(),
									cartao_vencimento_ano: $("#cobranca_cartao_card_exp_year").val(),
									cartao_cod_seguranca: $("#cobranca_cartao_card_cvv").val(),
									cartao_bandeira: $("#cobranca_cartao_card_bin").val(),
								},
								items: [
									<?
									$carrinhoDetalhadoArray = unserialize($rSqlItem['objeto_carrinho_detalhado']);
									$carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'numeroUnico_lote', SORT_ASC);
									$carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'ordem', SORT_ASC);
									foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
										if(trim($valueDetalhado['tipo'])=="evento") {
											$valueDetalhado['nome'] = "".$valueDetalhado['evento_nome']." - ".$valueDetalhado['ingresso_nome']."";
										} else if(trim($valueDetalhado['tipo'])=="produto" || trim($valueDetalhado['tipo'])=="combo") {
											$valueDetalhado['nome'] = "".$valueDetalhado['produto_nome']."";
										}
										
										if(trim($valueDetalhado['valor_subtotal'])=="") { $valueDetalhado['valor_subtotal'] = 0.00; }
										if(trim($valueDetalhado['valor_total'])=="") { $valueDetalhado['valor_total'] = 0.00; }
										if(trim($valueDetalhado['valor_promocional'])=="") { $valueDetalhado['valor_promocional'] = 0.00; }
										if(trim($valueDetalhado['valor_desconto'])=="") { $valueDetalhado['valor_desconto'] = 0.00; }
									?>
									{
										tipo: "<?=$valueDetalhado['tipo']?>",

										numeroUnico_loja: "<?=$valueDetalhado['numeroUnico_loja']?>",
										numeroUnico_produto: "<?=$valueDetalhado['numeroUnico_produto']?>",
										numeroUnico_evento: "<?=$valueDetalhado['numeroUnico_evento']?>",
										numeroUnico_ticket: "<?=$valueDetalhado['numeroUnico_ticket']?>",
										numeroUnico_lote: "<?=$valueDetalhado['numeroUnico_lote']?>",
										lote: "<?=$valueDetalhado['lote']?>",
								
										produto_nome: "<?=$valueDetalhado['produto_nome']?>",
										evento_nome: "<?=$valueDetalhado['evento_nome']?>",
										ingresso_nome: "<?=$valueDetalhado['ingresso_nome']?>",
										ingresso_data: "<?=$valueDetalhado['ingresso_data']?>",
										ticket_genero: "<?=$valueDetalhado['ticket_genero']?>",
										ticket_compra_autorizada: "<?=$valueDetalhado['ticket_compra_autorizada']?>",
										imagem: "<?=$valueDetalhado['imagem']?>",
										ticket_exibir_lote: "<?=$valueDetalhado['ticket_exibir_lote']?>",
										ticket_exibir_taxa: "<?=$valueDetalhado['ticket_exibir_taxa']?>",
										ticket_exigir_atribuicao: "<?=$valueDetalhado['ticket_exigir_atribuicao']?>",

										linha: "<?=$valueDetalhado['linha']?>",
										coluna: "<?=$valueDetalhado['coluna']?>",
										linha_real: "<?=$valueDetalhado['linha_real']?>",
										coluna_real: "<?=$valueDetalhado['coluna_real']?>",
										label: "<?=$valueDetalhado['label']?>",

										numeroUnico_pessoa: "<?=$valueDetalhado['numeroUnico_pessoa']?>",
										pessoa_nome: "<?=$valueDetalhado['pessoa_nome']?>",
										pessoa_documento: "<?=$valueDetalhado['pessoa_documento']?>",
										pessoa_email: "<?=$valueDetalhado['pessoa_email']?>",
										pessoa_telefone: "<?=$valueDetalhado['pessoa_telefone']?>",

										nome: "<?=$valueDetalhado['nome']?>",

										valor: <?=$valueDetalhado['valor']?>,
										valor_subtotal: <?=$valueDetalhado['valor_subtotal']?>,
										valor_total: <?=$valueDetalhado['valor_total']?>,
										valor_promocional: <?=$valueDetalhado['valor_promocional']?>,
										valor_desconto: <?=$valueDetalhado['valor_desconto']?>,
										valor_pago: <?=$valueDetalhado['valor_pago']?>,

										marcado: "<?=$valueDetalhado['marcado']?>",
										email_enviar: "<?=$valueDetalhado['email_enviar']?>",
										telefone_enviar: "<?=$valueDetalhado['telefone_enviar']?>",
										qtd: <?=$valueDetalhado['qtd']?>,
									},
									<? } ?>
								],
						};
					
					var fd = new FormData();
				
					fd.append('Modelo',"javascript");
					fd.append('Local',"checkout");
					fd.append('Device',"SITE");
					fd.append('Empresa',"<?=$EMPRESA_TOKEN?>");
					fd.append('Objeto',JSON.stringify(Objeto));
				
					$.ajax({
						url:  "https://www.hubdepagamento.com/admin/webservice-hub/",
						type: 'POST',
						data: fd,
						contentType: false,
						processData: false,
						success: function(response){
			
							console.log('Objeto',Objeto);
							console.log('response',response);
			
							if($.trim(forma_pagamentoSend)=="CCR") {
								$("#cart").hide();
								$("#DIV_pagamento_enviado").fadeIn();
							} else if($.trim(forma_pagamentoSend)=="BOLETO") {
								$("#cart").hide();
								$("#DIV_pagamento_enviado").fadeIn();
							} else if($.trim(forma_pagamentoSend)=="PIX") {
								$("#cart").hide();
								var retorno = JSON.parse(response);
								$("#DIV_qrcode_pix").html("<img src='"+retorno["data"]["pix_qrcode_url"]+"' style='width:100%'>");
								$("#DIV_qrcode_pix").fadeIn();
							} else if($.trim(forma_pagamentoSend)=="CREDITO") {
								$("#cart").hide();
								$("#DIV_pagamento_enviado").fadeIn();
							}
			
						},
					});

				} else if($.trim(dataConfere)=="NAO") {
					alert("Você possui 1 ingresso que pertence à uma campanha que foi destinada para o pagamento com um tipo específico de cartão, retire este item do carrinho, ou utilize um cartão que esteja dentro dos critérios da campanha!");
				}
			},
		});
	

	}

	function carrinhoLimpaFinalizaCompra() {
		
		$.ajax({
			url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/carrinho-limpa.php",
			type: 'GET',
			cache: false,
			data: "empresaS=<?=$rSqlEmpresa['id']?>",
			//dataType: "html",
			success: function(data){
			},
		});
	}

	function cobrancaRealizarPagamento(forma_pagamentoSend,localSend) {

		$.ajax({
			url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/confere-campanha.php",
			type: 'GET',
			cache: false,
			data: "cobranca_cartao_card_numberS="+$("#cobranca_cartao_card_number").val()+"",
			//dataType: "html",
			success: function(dataConfere){
				if($.trim(dataConfere)=="SIM") {

					if($.trim(forma_pagamentoSend)=="CCR") {
						$("#BTN_cartao_enviar").hide();
						$("#BTN_cartao_enviando").fadeIn();
					} else if($.trim(forma_pagamentoSend)=="BOLETO") {
						$("#BTN_boleto_enviar").hide();
						$("#BTN_boleto_enviando").fadeIn();
					} else if($.trim(forma_pagamentoSend)=="PIX") {
						$("#BTN_pix_enviar").hide();
						$("#BTN_pix_enviando").fadeIn();
					} else if($.trim(forma_pagamentoSend)=="CREDITO") {
						$("#BTN_credito_enviar").hide();
						$("#BTN_credito_enviando").fadeIn();
					}
			
					if($.trim(forma_pagamentoSend)=="CCR") {
						var nomeSet = $("#cobranca_cartao_card_name").val();
						var cpfSet = $("#cobranca_cartao_card_cpf").val();
						var telefoneSet = $("#cobranca_cartao_card_telefone").val();
						var emailSet = $("#cobranca_cartao_email").val();
					} else if($.trim(forma_pagamentoSend)=="BOLETO") {
						var nomeSet = $("#cobranca_boleto_card_name").val();
						var cpfSet = $("#cobranca_boleto_card_cpf").val();
						var telefoneSet = $("#cobranca_boleto_card_telefone").val();
						var emailSet = $("#cobranca_boleto_email").val();
					} else if($.trim(forma_pagamentoSend)=="PIX") {
						var nomeSet = $("#cobranca_pix_card_name").val();
						var cpfSet = $("#cobranca_pix_card_cpf").val();
						var telefoneSet = $("#cobranca_pix_card_telefone").val();
						var emailSet = $("#cobranca_pix_email").val();
					} else if($.trim(forma_pagamentoSend)=="CREDITO") {
						var nomeSet = $("#cobranca_credito_card_name").val();
						var cpfSet = $("#cobranca_credito_card_cpf").val();
						var telefoneSet = $("#cobranca_credito_card_telefone").val();
						var emailSet = $("#cobranca_credito_email").val();
					}
			
					var Objeto = {
								tipo_checkout: "checkout",
								id_transacao: "<?=$_SESSION['numeroUnico_carrinho']?>",
								forma_pagamento: forma_pagamentoSend,
								qtd_parcelas: $("#qtd_parcelas").val(),
								codigo_cupom: ""+$("#codigo_cupom").val()+"",
								comprador: {
									nome: "<?=$rSqlUsuario['nome']?>",
									documento: cpfSet,
									email: "<?=$rSqlUsuario['email']?>",
									whatsapp: telefoneSet,
									telefone: "",
									endereco: {
										cep: $("#cobranca_cep").val(),
										rua: $("#cobranca_rua").val(),
										numero: $("#cobranca_numero").val(),
										complemento: $("#cobranca_complemento").val(),
										bairro: $("#cobranca_bairro").val(),
										cidade: $("#cobranca_cidade").val(),
										estado: $("#cobranca_estado").val(),
									},
								},
								pagamento: {
									titular_nome: nomeSet,
									titular_documento: cpfSet,
									titular_email: emailSet,
									titular_telefone: emailSet,
									cartao_numero: $("#cobranca_cartao_card_number").val(),
									cartao_vencimento_mes: $("#cobranca_cartao_card_exp_month").val(),
									cartao_vencimento_ano: $("#cobranca_cartao_card_exp_year").val(),
									cartao_cod_seguranca: $("#cobranca_cartao_card_cvv").val(),
									cartao_bandeira: $("#cobranca_cartao_card_bin").val(),
								},
								items: [
									<?
									$carrinhoDetalhadoArray = unserialize($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].'']);
									$carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'numeroUnico_lote', SORT_ASC);
									$carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'ordem', SORT_ASC);
									foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
										if(trim($valueDetalhado['tipo'])=="evento") {
											$valueDetalhado['nome'] = "".$valueDetalhado['evento_nome']." - ".$valueDetalhado['ingresso_nome']." - ".$valueDetalhado['lote']."° Lote";
										} else if(trim($valueDetalhado['tipo'])=="produto" || trim($valueDetalhado['tipo'])=="combo") {
											$valueDetalhado['nome'] = "".$valueDetalhado['produto_nome']."";
										}
										
										if(trim($valueDetalhado['valor'])=="") { $valueDetalhado['valor'] = 0.00; }
										if(trim($valueDetalhado['valor_subtotal'])=="") { $valueDetalhado['valor_subtotal'] = 0.00; }
										if(trim($valueDetalhado['valor_total'])=="") { $valueDetalhado['valor_total'] = 0.00; }
										if(trim($valueDetalhado['valor_promocional'])=="") { $valueDetalhado['valor_promocional'] = 0.00; }
										if(trim($valueDetalhado['valor_desconto'])=="") { $valueDetalhado['valor_desconto'] = 0.00; }
										if(trim($valueDetalhado['valor_pago'])=="") { $valueDetalhado['valor_pago'] = 0.00; }
									?>
									{
										tipo: "<?=$valueDetalhado['tipo']?>",
			
										numeroUnico_loja: "<?=$valueDetalhado['numeroUnico_loja']?>",
										numeroUnico_produto: "<?=$valueDetalhado['numeroUnico_produto']?>",
										numeroUnico_evento: "<?=$valueDetalhado['numeroUnico_evento']?>",
										numeroUnico_ticket: "<?=$valueDetalhado['numeroUnico_ticket']?>",
										numeroUnico_lote: "<?=$valueDetalhado['numeroUnico_lote']?>",
										lote: "<?=$valueDetalhado['lote']?>",
								
										produto_nome: "<?=$valueDetalhado['produto_nome']?>",
										evento_nome: "<?=$valueDetalhado['evento_nome']?>",
										ingresso_genero: "<?=$valueDetalhado['ingresso_genero']?>",
										ingresso_nome: "<?=$valueDetalhado['ingresso_nome']?>",
										ingresso_data: "<?=$valueDetalhado['ingresso_data']?>",
										ticket_genero: "<?=$valueDetalhado['ticket_genero']?>",
										ticket_compra_autorizada: "<?=$valueDetalhado['ticket_compra_autorizada']?>",
										imagem: "<?=$valueDetalhado['imagem']?>",
										ticket_exibir_lote: "<?=$valueDetalhado['ticket_exibir_lote']?>",
										ticket_exibir_taxa: "<?=$valueDetalhado['ticket_exibir_taxa']?>",
										ticket_exigir_atribuicao: "<?=$valueDetalhado['ticket_exigir_atribuicao']?>",
			
										linha: "<?=$valueDetalhado['linha']?>",
										coluna: "<?=$valueDetalhado['coluna']?>",
										linha_real: "<?=$valueDetalhado['linha_real']?>",
										coluna_real: "<?=$valueDetalhado['coluna_real']?>",
										label: "<?=$valueDetalhado['label']?>",

										numeroUnico_pessoa: "<?=$valueDetalhado['numeroUnico_pessoa']?>",
										pessoa_nome: "<?=$valueDetalhado['pessoa_nome']?>",
										pessoa_documento: "<?=$valueDetalhado['pessoa_documento']?>",
										pessoa_email: "<?=$valueDetalhado['pessoa_email']?>",
										pessoa_telefone: "<?=$valueDetalhado['pessoa_telefone']?>",
			
										nome: "<?=$valueDetalhado['nome']?>",
			
										valor: <?=$valueDetalhado['valor']?>,
										valor_subtotal: <?=$valueDetalhado['valor_subtotal']?>,
										valor_total: <?=$valueDetalhado['valor_total']?>,
										valor_promocional: <?=$valueDetalhado['valor_promocional']?>,
										valor_desconto: <?=$valueDetalhado['valor_desconto']?>,
										valor_pago: <?=$valueDetalhado['valor_pago']?>,
			
										marcado: "<?=$valueDetalhado['marcado']?>",
										email_enviar: "<?=$valueDetalhado['email_enviar']?>",
										telefone_enviar: "<?=$valueDetalhado['telefone_enviar']?>",
										qtd: <?=$valueDetalhado['qtd']?>,
									},
									<? } ?>
								],
						};
					
					var fd = new FormData();
				
					fd.append('Modelo',"javascript");
					fd.append('Local',"checkout");
					fd.append('Device',"SITE");
					fd.append('Empresa',"<?=$EMPRESA_TOKEN?>");
					fd.append('Objeto',JSON.stringify(Objeto));
				
					$.ajax({
						url:  "https://www.hubdepagamento.com/admin/webservice-hub/",
						type: 'POST',
						data: fd,
						contentType: false,
						processData: false,
						success: function(response){
							//console.log('retorno',response["SQL_INSERT_CHECKOUT"]);
			
							console.log('Objeto',Objeto);
							console.log('response',response);
							console.log('response 2');
							console.log(response);
			
							<? if(trim($rSqlUsuario['numeroUnico'])=="wuKfJbhglL1qx7RtaRNhpqd28IbVqn") { ?>
							<? } else { ?>
							if($.trim(forma_pagamentoSend)=="CCR") {
								$("#cart").hide();
								$("#DIV_pagamento_enviado").fadeIn();
								//carrinhoLista();
								//carrinhoDetalhadoLista();
								//carrinhoResumo();
								carrinhoListaTopBar();
							} else if($.trim(forma_pagamentoSend)=="BOLETO") {
								$("#cart").hide();
								$("#DIV_pagamento_enviado").fadeIn();
								//carrinhoLista();
								//carrinhoDetalhadoLista();
								//carrinhoResumo();
								carrinhoListaTopBar();
							} else if($.trim(forma_pagamentoSend)=="PIX") {
								$("#cart").hide();
								var retorno = JSON.parse(response);
								console.log(retorno);
								$("#DIV_pix_qrcode_url").html("<img src='"+retorno["pix_qrcode_url"]+"' style='width:350px;'>");
								$("#DIV_pix_qrcode_url").fadeIn();
								$("#DIV_pix_key_url").html("<div style='width:350px;margin-left: calc(50% - 175px);'>Copie e cole o código no aplicativo do seu banco e faça o pagamento.<br><br>"+retorno["pix_key_url"]+"</div>");
								$("#DIV_pix_key_url").fadeIn();
								$("#DIV_btn_pix_key_url").fadeIn();
								$("#copia_pix_key_url").val(retorno["pix_key_url"]);
								carrinhoListaTopBar();
							} else if($.trim(forma_pagamentoSend)=="CREDITO") {
								$("#cart").hide();
								$("#DIV_pagamento_enviado").fadeIn();
								//carrinhoLista();
								//carrinhoDetalhadoLista();
								//carrinhoResumo();
								carrinhoListaTopBar();
							}
							
							carrinhoLimpaFinalizaCompra();
							<? } ?>
			
						},
					});
				} else if($.trim(dataConfere)=="NAO") {
					alert("Você possui 1 ingresso que pertence à uma campanha destinada ao pagamento com um tipo específico de cartão, retire este item do carrinho, ou utilize um cartão que esteja dentro dos critérios da campanha");
				}
			},
		});
	}

	function salvarMeusDados() {
		if($.trim($("#nome").val())=="") {
			alert("Você deve preencher o campo 'Nome Completo'");
			$("#nome").focus();
			
		} else if($.trim($("#email").val())=="") {
			alert("Você deve preencher o campo 'E-mail'");
			$("#email").focus();
			
		} else if($.trim( $("#data_de_nascimento").val() )=="") {
			alert("Você precisa informar sua 'Data de Nascimento'");
			$("#data_de_nascimento").focus();
			
		} else if(validarDataDeNascimento("data_de_nascimento")===false) {
			alert("Você precisa informar uma 'Data de Nascimento' válida");
			$("#data_de_nascimento").focus();
			
		} else if($.trim( $("#data_de_nascimento_valido").val() )=="0") {
			alert("Você precisa informar uma 'Data de Nascimento' válida");
			$("#data_de_nascimento").focus();
			
		} else if($.trim($("#whatsapp").val())=="") {
			alert("Você deve preencher o campo 'Telefone (Celular/WhatsApp)'");
			$("#whatsapp").focus();
			
		<? if(trim($rSqlUsuario['documento'])=="") { ?>
		} else if($.trim($("#documento").val())=="") {
			alert("Você deve preencher o campo 'CPF'");
			$("#documento").focus();

		} else if(validarCpf("documento")===false) {
			alert("Você precisa informar um 'CPF' válido");
			$("#documento").focus();
			
		} else if($.trim($("#documento_valido").val())=="0") {
			alert("Você deve informar um 'CPF' válido");
			$("#documento").focus();
		<? } ?>
			
		} else {
			document.meus_dados_form.submit();
		}
	}

	function salvarMeuEndereco() {
		if($.trim($("#cep").val())=="") {
			alert("Você deve preencher o campo 'Cep'");
			$("#cep").focus();
		} else if($.trim($("#rua").val())=="") {
			alert("Você deve preencher o campo 'Rua'");
			$("#rua").focus();
		} else if($.trim($("#numero").val())=="") {
			alert("Você deve preencher o campo 'Número'");
			$("#numero").focus();
		} else if($.trim($("#bairro").val())=="") {
			alert("Você deve preencher o campo 'Bairro'");
			$("#bairro").focus();
		} else if($.trim($("#cidade").val())=="") {
			alert("Você deve preencher o campo 'Cidade'");
			$("#cidade").focus();
		} else if($.trim($("#estado").val())=="") {
			alert("Você deve preencher o campo 'Estado'");
			$("#estado").focus();
		} else {
			document.meu_endereco_form.submit();
		}
	}

	function salvarAlterarSenha() {
		if($.trim($("#senha").val())=="") {
			alert("Campo 'Nova Senha' deve ser preenchido");
			$("#senha").focus();
		} else {
			if($.trim($("#senha_valido").val())=="0") {
				alert("Você está digitando uma senha inválida, corrija para prosseguir!");
				$("#senha").focus();
			} else {
				if($.trim($("#conf_senha").val())=="") {
					alert("Campo 'Confirmação de Nova Senha' deve ser preenchido");
					$("#conf_senha").focus();
				} else {
					if($.trim($("#conf_senha_valido").val())=="0") {
						alert("Você está digitando uma senha inválida, corrija para prosseguir!");
						$("#conf_senha").focus();
					} else {
						if($.trim($("#conf_senha").val())!=$.trim($("#senha").val())) {
							alert("As senhas não conferem!");
						} else {
							document.alterar_senha_form.submit();
						}
					}
				}
			}
		}
	}

	function seleciona_tickets_datas(dataSend) {
		$('.item_ticket_data').hide();
		$('#btn_finalizar_compra').fadeIn();

		$(".BTN_tickets_datas").removeClass("gradient-blue-purple");
		$(".BTN_tickets_datas").addClass("button-white button-light");
		
		$("#BTN_tickets_datas_"+dataSend+"").removeClass("button-white button-light");
		$("#BTN_tickets_datas_"+dataSend+"").addClass("gradient-blue-purple");

		$('.item_ticket_data').each(function(index, element) {
			if($.trim(dataSend)==$(this).attr("ticket_data")) {
				$(this).fadeIn();
			}
		});
	}

	function grava_fingerprint() {
		var Objeto = {
					id_transacao: ""+$("#id_transacao").val()+"",
					numeroUnico_fingerprint: ""+$("#numeroUnico_fingerprint").val()+"",
			};
		
		var fd = new FormData();
	
		fd.append('Modelo',"javascript");
		fd.append('Local',"clearsale-fingerprint");
		fd.append('Empresa',"<?=$rSqlEmpresa['token']?>");
		fd.append('Objeto',JSON.stringify(Objeto));
	
		$.ajax({
			url:  "https://www.hubdepagamento.com/admin/webservice-hub/",
			type: 'POST',
			data: fd,
			contentType: false,
			processData: false,
			success: function(response){
			},
		});
	}

	function zera_tempo_sessao() {
		$.ajax({
			url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/zera-tempo-sessao.php",
			type: "GET",
			data: "",
			//dataType: "html",
			success: function(data){
				alert("O tempo para a compra expirou\n\nIsso é necessário para que uma reserva não fique presa e possa estar disponível para compra novamente.\nVocê será redirecionado para poder recomeçar a sua compra.");
				window.open('<?=$link_modelo?>','_self','');
				//console.log();
			},
		});
	
	}

	function grava_tempo_sessao() {
		$.ajax({
			url:  "<?=$link_modelo?>templates/<?=$pasta_template?>/grava-tempo-sessao.php",
			type: "GET",
			data: "",
			//dataType: "html",
			success: function(data){
				//console.log();
			},
		});
	
	}
    </script>

	<? 
    if(trim($_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].''])=="") {
       $nCarrinho = 0;
    } else {
       $nCarrinho = count(unserialize($_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].'']));
    }
    ?>
    <? 
	if($nCarrinho==0) { 
		$_SESSION['data_sessao'] = "";
		$_SESSION['tempo_sessao'] = "";
		$_SESSION['tempo_intervalo'] = "";
	} else { 
	?>
    <script>
	grava_tempo_sessao();
	
    <? if(trim($_SESSION['tempo_intervalo'])=="") { ?>
		<? $_SESSION['tempo_intervalo'] = 900; ?>
	<? } else { ?>
		<? $_SESSION['tempo_intervalo'] = $_SESSION['tempo_intervalo']; ?>
	<? } ?>
	
	var tempo = new Number();
    // Tempo em segundos
    tempo = <?=$_SESSION['tempo_intervalo']?>;
    
    function startCountdown(){
    
        // Se o tempo não for zerado
        if((tempo - 1) >= 0){
    
            // Pega a parte inteira dos minutos
            var min = parseInt(tempo/60);
            // Calcula os segundos restantes
            var seg = tempo%60;
    
            // Formata o número menor que dez, ex: 08, 07, ...
            if(min < 10){
                min = "0"+min;
                min = min.substr(0, 2);
            }
            if(seg <=9){
                seg = "0"+seg;
            }
    
            // Cria a variável para formatar no estilo hora/cronômetro
            //horaImprimivel = '00:' + min + ':' + seg;
            horaImprimivel = "" + min + ":" + seg +"";
            //JQuery pra setar o valor
            $("#relogio-sessao").html(horaImprimivel);
    
            // Define que a função será executada novamente em 1000ms = 1 segundo
            setTimeout('startCountdown()',1000);
    
            // diminui o tempo
            tempo--;
    
        // Quando o contador chegar a zero faz esta ação
        } else {
            zera_tempo_sessao();
        }
    
    }
    
    // Chama a função ao carregar a tela
    startCountdown();
    </script>
    <? } ?>
    
	<script src="<?=$link_modelo?>templates/<?=$pasta_template?>/js/pogoslider.js"></script>
    <script>
	/* -------------------------------------
			CUSTOM FUNCTION WRITE HERE
	-------------------------------------- */
	$(document).ready(function() {
		"use strict";
	
		/* -------------------------------------
				HOME BANNER SLIDER				
		-------------------------------------- */
		var mySlider = jQuery('#tg-homeslidervone').pogoSlider({
			pauseOnHover: false,
			autoplay: false,
			generateNav: false,
			displayProgess: true,
			autoplayTimeout: 6000,
			preserveTargetSize: true,
			targetWidth: 1920,
			targetHeight: 575,
			responsive: true
		}).data('plugin_pogoSlider');
	});    
	</script>

    <script>
        (function (a, b, c, d, e, f, g) {
        a['CsdpObject'] = e; a[e] = a[e] || function () {
        (a[e].q = a[e].q || []).push(arguments)
        }, a[e].l = 1 * new Date(); f = b.createElement(c),
        g = b.getElementsByTagName(c)[0]; f.async = 1; f.src = d; g.parentNode.insertBefore(f, g)
        })(window, document, 'script', '//device.clearsale.com.br/p/fp.js', 'csdp');
        csdp('app', '<?=$rSqlEmpresa['clearsale_fingerprint']?>');
        csdp('outputsessionid', 'numeroUnico_fingerprint');
    </script>
</body>
</html>