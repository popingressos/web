		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="row align-items-center col-mb-80">

						<div class="col-lg-12" style="padding-bottom: 10px;">

							<div class="heading-block text-center text-lg-start border-bottom-0" style="margin-bottom: 10px;">
								<h4>Ooopps! Os dados de cadastro informados já possuem no nosso sistema.</h4>
								<span>Você pode ter feito cadastro em algum outro momento e não se lembra, peça uma recuperação de senha, ou tente realizar login por umas das opções abaixo.</span>
							</div>

						</div>

                        <div class="col-md-12 text-center" style="padding-bottom: 10px;">
                            <style>
                            .hr16 {
                              border: 0;
                              border-top: solid 1px #000;
                              height: 1px;
                              overflow: visible;
                              padding: 0;
                              color: #000;
                              text-align: center;
                            }
                            
                            .hr16::after {
                              content: "JÁ TEM LOGIN?";
                              display: inline-block;
                              position: relative;
                              top: -0.7em;
                              font-size: 12px;
                              padding: 0px 10px 0px 10px;
                              background: #FFF;
                            }
                            </style>
                            <h6 class="hr16 mt-4 mb-4"></h6>
                        </div>

                        <div class="col-12 form-group" style="padding-bottom: 10px;">
                            <a href="<?=$link_modelo?>acesse-sua-conta/" class="button button-3d w-100 text-center m-0">Acesse sua conta</a>
                        </div>

                        <div class="col-md-12 text-center" style="padding-bottom: 10px;">
                            <style>
                            .hr17 {
                              border: 0;
                              border-top: solid 1px #000;
                              height: 1px;
                              overflow: visible;
                              padding: 0;
                              color: #000;
                              text-align: center;
                            }
                            
                            .hr17::after {
                              content: "OU USE SUAS REDE SOCIAIS";
                              display: inline-block;
                              position: relative;
                              top: -0.7em;
                              font-size: 12px;
                              padding: 0px 10px 0px 10px;
                              background: #FFF;
                            }
                            </style>
                            <h6 class="hr17 mt-4 mb-4"></h6>
                        </div>

                        <div class="col-md-12 text-center" style="padding-bottom: 10px;">
                            <a href="javascript:void(0);" onClick="javascript:facebookSignin();" class="form-control button button-3d h60 p-3 border-2 border-0 font-xssss fw-600 text-center text-white position-relative" style="margin-left: 0px;padding-bottom: 38px !important;background-color:#3b5998;">
                            <i class="fab fa-facebook-square"></i>&nbsp;&nbsp;Continue com Facebook</a>
                        </div>

                        <div class="col-md-12 text-center mt-0" style="padding-bottom: 10px;">
                            <a href="javascript:void(0);" onClick="javascript:googleSignin();" class="form-control button button-3d h60 p-3 text-white border-2 border-0 font-xssss fw-600 text-center position-relative" style="margin-left: 0px;padding-bottom: 38px !important;background-color:#ff4f4f;">
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

					</div>

				</div>
			</div>
		</section><!-- #content end -->