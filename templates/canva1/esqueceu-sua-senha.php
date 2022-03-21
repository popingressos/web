		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="accordion accordion-lg mx-auto mb-0 clearfix" style="max-width: 550px;">

                        <? if((trim($_SESSION["empresa_".$rSqlEmpresa['id']."_email"])=="" || trim($_SESSION["empresa_".$rSqlEmpresa['id']."_senha"])=="") && $pagina=="carrinho.php") { ?>
                        <div class="style-msg infomsg">
                            <div class="sb-msg"><i class="icon-info-sign"></i><strong>Atenção!</strong> Antes de prosseguir para o pagamento, você deve acessar sua conta, e caso ainda não tenha uma, fazer seu cadastro.</div>
                        </div>
                        <? } ?>

						<div class="accordion-header">
							<div class="accordion-icon">
								<i class="accordion-closed icon-lock3"></i>
								<i class="accordion-open icon-unlock"></i>
							</div>
							<div class="accordion-title">
								Acesse sua conta
							</div>
						</div>
						<div class="accordion-content clearfix">
                            <form name="login_form_redes" action="<?=$link_modelo?>" method="post" target="_self" ENCTYPE="multipart/form-data" autocomplete="off">
                                <input type="hidden" name="acaoForm" value="fazer-login-redes">
                                <input type="hidden" name="nome_redes" id="nome_redes" value="" />
                                <input type="hidden" name="email_redes" id="email_redes" value="" />
                                <input type="hidden" name="tipo_redes" id="tipo_redes" value="" />
                                <input type="hidden" name="token_redes" id="token_redes" value="" />
                            </form>

                            <form 
                             name="esqueceu_senha_form" 
                             id="esqueceu_senha_form_cadastro"
                             action="<?=$link_modelo?><?=$_REQUEST['var1']?>/" 
                             method="post" 
                             ENCTYPE="multipart/form-data"
                              class="row mb-0" 
                             autocomplete="off_<?=$_SESSION['empresa_'.$rSqlEmpresa['id'].'_numeroUnico_carrinho']?>">

                                <input type="hidden" name="acaoForm" value="esqueceu-senha">

								<div class="col-12 form-group">
									<label for="login-form-username">E-mail:</label>
									<input type="text" name="email" id="email" value="" class="form-control" />
								</div>

								<div class="col-12 form-group">
									<button type="button" class="button button-3d button-black m-0" onclick="javascript:enviaEsqueceuSenha();">Enviar Lembrete</button>
								</div>

                                <?
								$IP_CLIENTE = getUserIP();
								$IP_CLIENTE_2 = "AA";
								if(trim($IP_CLIENTE)=="2804:1b0:1403:a4c7:9ce8:47df:a832:7ade" || trim($IP_CLIENTE)=="191.30.2.97" || trim($IP_CLIENTE_2)=="AA") {
								?>
                                <div class="col-md-12 text-center">
                                    <style>
									.hr5 {
									  border: 0;
									  border-top: solid 1px #000;
									  height: 1px;
									  overflow: visible;
									  padding: 0;
									  color: #000;
									  text-align: center;
									}
									
									.hr5::after {
									  content: "OU";
									  display: inline-block;
									  position: relative;
									  top: -0.7em;
									  font-size: 12px;
									  padding: 0px 10px 0px 10px;
									  background: #FFF;
									}
                                    </style>
                                    <h6 class="hr5 mt-4 mb-4"></h6>
                                </div>

                                <div class="col-md-12 text-center">
                                    <a href="javascript:void(0);" onClick="javascript:facebookSignin();" class="form-control button button-3d h60 p-3 border-2 border-0 font-xssss fw-600 text-center text-white position-relative" style="padding-bottom: 38px !important;background-color:#3b5998;">
                                    <i class="fab fa-facebook-square"></i>&nbsp;&nbsp;Continue com Facebook</a>
                                </div>

                                <div class="col-md-12 text-center mt-2">
                                    <a href="javascript:void(0);" onClick="javascript:googleSignin();" class="form-control button button-3d h60 p-3 text-white border-2 border-0 font-xssss fw-600 text-center position-relative" style="padding-bottom: 38px !important;background-color:#ff4f4f;">
                                    <i class="fab fa-google"></i>&nbsp;&nbsp;Continue com Google</a>
                                </div>

                                <a id="BTN_myModalFacebook" href="#myModalFacebook" data-lightbox="inline" class="btn btn-secondary btn-lg" style="display:none;">Modal Facebook</a>
                                <!-- Modal -->
                                <div class="modal1 mfp-hide" id="myModalFacebook">
                                    <div class="block mx-auto" style="background-color: #FFF; max-width: 500px;">
                                        <div class="feature-box fbox-center fbox-effect fbox-lg border-bottom-0 mb-0" style="padding: 40px;padding-top:10px;padding-bottom:10px;">
                                            <div class="fbox-content">
                                                <h3>Login via Facebook<span class="subtitle" style="text-align:left;padding-bottom:20px;padding-top:20px;font-size:13px;">
                                                O seu e-mail utilizado no Facebook não está disponível para visualização pública, 
                                                portanto não foi possível fazer login utilizando a rede social.<br /><br />

Seu email possui uma configuração de privacidade (que controla as pessoas com quem você o compartilha) e uma configuração que controla se ele pode ou não ser exibido no seu perfil.<br />
Por exemplo, você pode optar por exibir seu email no seu perfil, mas configurar sua privacidade como Amigos. Assim, seu email será compartilhado no seu perfil e em outros lugares no Facebook com seus amigos.<br />
Para ajustar com quem você compartilha seu email e decidir se ele será exibido no seu perfil:<br /><br />
<b>1.</b> Clique em sua foto do perfil no canto superior direito do Facebook.<br /><br />
<b>2.</b> Clique em Sobre, na parte superior do perfil.<br /><br />
<b>3.</b> Clique em Informações básicas e de contato no menu à esquerda.<br /><br />
<b>4.</b> Clique em Editar ao lado do email e clique no seletor de público ao lado do email para alterar o público com o qual ele é compartilhado. Salve as alterações.

                                                
                                                </span></h3>
                                            </div>
                                            <!--
                                            <div class="col-12 form-group">
                                                <label for="login-form-username" style="text-align:left;width:100%;">E-mail:</label>
                                                <input type="text" id="email_facebook" value="" class="form-control" />
                                            </div>
                                            -->
                                        </div>
                                        <div class="section center m-0" style="padding: 30px;padding-top:10px;padding-bottom:10px;">
                                            <a href="#" class="button button-3d" style="background-color:#ff4f4f;" onClick="$.magnificPopup.close();return false;">&nbsp;&nbsp;&nbsp;&nbsp;Usar Outra Opção&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                            <!--<a href="#" class="button" style="background-color:#3b5998;" onClick="javascript:fazLoginModalFacebook();">Fazer Login Facebook</a>-->
                                        </div>
                                    </div>
                                </div>
                    
                                <? } ?>

                                <div class="col-md-12 text-center">
                                    <style>
									.hr6 {
									  border: 0;
									  border-top: solid 1px #000;
									  height: 1px;
									  overflow: visible;
									  padding: 0;
									  color: #000;
									  text-align: center;
									}
									
									.hr6::after {
									  content: "NÃO TEM LOGIN?";
									  display: inline-block;
									  position: relative;
									  top: -0.7em;
									  font-size: 12px;
									  padding: 0px 10px 0px 10px;
									  background: #FFF;
									}
                                    </style>
                                    <h6 class="hr6 mt-4 mb-4"></h6>
                                </div>

								<div class="col-12 form-group">
									<a href="<?=$link_modelo?>cadastre-se/" class="button button-3d w-100 text-center m-0">Cadastre-se</a>
								</div>
							</form>
						</div>

					</div>

				</div>
			</div>
		</section><!-- #content end -->