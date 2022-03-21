		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="accordion accordion-lg mx-auto mb-0 clearfix" style="max-width: 550px;">


						<div class="accordion-header">
							<div class="accordion-icon">
								<i class="accordion-closed icon-user4"></i>
								<i class="accordion-open icon-ok-sign"></i>
							</div>
							<div class="accordion-title">
								<a>Não tem login? Cadastre-se</a>
							</div>
						</div>
                        <?
						$camposArray = unserialize($configuracoes_site['campos_cliente']);
						?>
						<div class="clearfix">
                            <form 
                             name="cadastro_form" 
                             id="cadastro_form_cadastro"
                             action="<?=$link_modelo?><?=$_REQUEST['var1']?>/" 
                             method="post"
                             class="row mb-0" 
                             ENCTYPE="multipart/form-data" 
                             autocomplete="off_<?=$_SESSION['empresa_'.$rSqlEmpresa['id'].'_numeroUnico_carrinho']?>">

                                <input type="hidden" name="acaoForm" value="usuario-add">
                                <input type="hidden" name="tipo_cadastro" value="completo">

								<? if(trim($camposArray['campo_cliente_nome'][0]['exibir'])=="1") { ?>
								<? if(trim($camposArray['campo_cliente_nome'][0]['label'])=="") { $camposArray['campo_cliente_nome'][0]['label'] = "Nome"; } ?>
                                <div class="col-12 form-group">
									<label for="register-form-name"><?=$camposArray['campo_cliente_nome'][0]['label']?>:</label>
									<input type="text" name="nome" id="nome" value="" class="form-control" />
								</div>
                                <? } ?>

								<? if(trim($camposArray['campo_cliente_documento'][0]['exibir'])=="1") { ?>
								<? if(trim($camposArray['campo_cliente_documento'][0]['label'])=="") { $camposArray['campo_cliente_documento'][0]['label'] = "CPF"; } ?>
								<div class="col-12 form-group">
									<label for="register-form-username"><?=$camposArray['campo_cliente_documento'][0]['label']?>:</label>
									<input type="text" name="documento" id="documento" value="" class="form-control documento" />
								</div>
                                <? } ?>

								<? if(trim($camposArray['campo_cliente_email'][0]['exibir'])=="1") { ?>
								<? if(trim($camposArray['campo_cliente_email'][0]['label'])=="") { $camposArray['campo_cliente_email'][0]['label'] = "E-mail"; } ?>
								<div class="col-12 form-group">
									<label for="register-form-email"><?=$camposArray['campo_cliente_email'][0]['label']?>:</label>
									<input type="text" name="email" id="email" value="" class="form-control" />
								</div>
                                <? } ?>

								<? if(trim($camposArray['campo_cliente_whatsapp'][0]['exibir'])=="1") { ?>
								<? if(trim($camposArray['campo_cliente_whatsapp'][0]['label'])=="") { $camposArray['campo_cliente_whatsapp'][0]['label'] = "Telefone/WhatsApp"; } ?>
								<div class="col-12 form-group">
									<label for="register-form-phone"><?=$camposArray['campo_cliente_whatsapp'][0]['label']?>:</label>
									<input type="text" name="whatsapp" id="whatsapp" value="" class="form-control" />
								</div>
                                <? } ?>

								<? if(trim($camposArray['campo_cliente_data_de_nascimento'][0]['exibir'])=="1") { ?>
								<? if(trim($camposArray['campo_cliente_data_de_nascimento'][0]['label'])=="") { $camposArray['campo_cliente_data_de_nascimento'][0]['label'] = "Data de Nascimento"; } ?>
								<a id="btn_modal_menor_18" href="#modalMenor18" data-lightbox="inline" class=""></a>
                                <div class="col-12 form-group">
									<label for="register-form-email"><?=$camposArray['campo_cliente_data_de_nascimento'][0]['label']?>:</label>
									<input type="text" name="data_de_nascimento" id="data_de_nascimento" value="<?=$data_de_nascimentoSet?>" onblur="javascript:validarDataDeNascimento('data_de_nascimento');" class="form-control" />
                                    <div id="DIV_data_de_nascimento_valido" style="display:none;color:#777;font-size:11px;"><i style="color:#25D366;" class="far fa-check-circle"></i>&nbsp;&nbsp;Data informada é válida</div>
                                    <div id="DIV_data_de_nascimento_invalido" style="display:none;color:#777;font-size:11px;"><i style="color:#e70101;" class="far fa-engine-warning"></i>&nbsp;&nbsp;Data informada é inválida</div>
                                    <input type="hidden" id="data_de_nascimento_valido" name="data_de_nascimento_valido" value="0">
								</div>
                                <? } ?>

								<div class="col-12 form-group">
									<label for="register-form-password">Senha:</label>
									<input type="password" name="senha" id="senha" value="" class="form-control" onkeypress="javascript:validarSenha('senha');" />
                                    <div id="DIV_senha_valido" style="display:none;color:#777;font-size:11px;"><i style="color:#25D366;" class="far fa-check-circle"></i>&nbsp;&nbsp;Senha informada é válida</div>
                                    <div id="DIV_senha_invalido" style="display:none;color:#777;font-size:11px;"><i style="color:#e70101;" class="far fa-engine-warning"></i>&nbsp;&nbsp;Senha informada é inválida</div>
                                    <input type="hidden" id="senha_valido" name="senha_valido" value="0">
								</div>

								<div class="col-12 form-group">
									<label for="register-form-repassword">Confirmação de Senha:</label>
									<input type="password" name="conf_senha" id="conf_senha" value="" class="form-control" onkeypress="javascript:validarSenha('conf_senha');" />
                                    <div id="DIV_conf_senha_valido" style="display:none;color:#777;font-size:11px;"><i style="color:#25D366;" class="far fa-check-circle"></i>&nbsp;&nbsp;Senha informada é válida</div>
                                    <div id="DIV_conf_senha_invalido" style="display:none;color:#777;font-size:11px;"><i style="color:#e70101;" class="far fa-engine-warning"></i>&nbsp;&nbsp;Senha informada é inválida</div>
                                    <input type="hidden" id="conf_senha_valido" name="conf_senha_valido" value="0">
								</div>

								<div class="col-12 form-group">
                                    <div class="style-msg alertmsg">
                                        <div class="sb-msg"><i class="icon-warning-sign"></i><strong>Atenção!</strong> Pra a criação de sua senha, utilize apenas letras maiúsculas ou minúsculas e números.</div>
                                    </div>
                                </div>
                            
                                <div class="form-row">
                                    <div class="form-group col" style="padding-left:8px;">
                                        <input type="hidden" value="0" name="aceito_termos" id="aceito_termos">
                                        <div style="float:left;cursor:pointer;" id="div_aceito_termos"><input type="checkbox" id="aceito_termos_confere" />&nbsp;&nbsp;
                                        Aceito e concordo com os <a href="<?=$link_modelo?>termos-de-uso/" target="_blank">Termos de Uso</a> da <?=$configuracoes_site['nome']?>.</div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col" style="padding-left:8px;">
                                        <input type="hidden" value="0" name="aceito_politica" id="aceito_politica">
                                        <div style="float:left;cursor:pointer;" id="div_aceito_politica"><input type="checkbox" id="aceito_politica_confere" />&nbsp;&nbsp;
                                        Aceito e concordo com as <a href="<?=$link_modelo?>politica-de-privacidade/" target="_blank">Políticas de Privacidade</a> da <?=$configuracoes_site['nome']?>.</div>
                                    </div>
                                </div>

                                <? if(trim($configuracoes_site['aceite_extra_1'])=="1") { ?>
                                <div class="form-row">
                                    <div class="form-group col" style="padding-left:8px;">
                                        <input type="hidden" value="0" name="aceite_extra_1" id="aceite_extra_1">
                                        <div style="float:left;cursor:pointer;" id="div_aceite_extra_1"><input type="checkbox" id="aceite_extra_1_confere" />&nbsp;&nbsp;
                                        <?=$configuracoes_site['aceite_extra_1_label']?>
                                        <? if(trim($configuracoes_site['aceite_extra_1_texto'])=="") { } else { ?>, <a href="<?=$link_modelo?>aceite-extra-1/" target="_blank">clique aqui para ler</a>.<? } ?></div>
                                    </div>
                                </div>
                                <? } ?>

								<div class="col-12 form-group">
									<button type="button" class="button button-3d button-black m-0" onclick="javascript:enviarCadastro();">Registrar-se Agora</button>
								</div>

                                <!--
                                <div class="col-md-12 p-0 text-center">
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

                                <div class="col-md-12 p-0 text-center">
                                    <a href="javascript:void(0);" onClick="javascript:facebookSignin();" class="form-control button button-3d h60 p-3 border-2 border-0 font-xssss fw-600 text-center text-white position-relative" style="padding-bottom: 38px !important;background-color:#3b5998;">
                                    <i class="fab fa-facebook-square"></i>&nbsp;&nbsp;Continue com Facebook</a>
                                </div>

                                <div class="col-md-12 p-0 text-center mt-2">
                                    <a href="javascript:void(0);" onClick="javascript:googleSignin();" class="form-control button button-3d h60 p-3 text-white border-2 border-0 font-xssss fw-600 text-center position-relative" style="padding-bottom: 38px !important;background-color:#ff4f4f;">
                                    <i class="fab fa-google"></i>&nbsp;&nbsp;Continue com Google</a>
                                </div>
                                -->

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
									  content: "JÁ TEM LOGIN?";
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
									<a href="<?=$link_modelo?>acesse-sua-conta/" class="button button-3d w-100 text-center m-0">Acesse sua conta</a>
								</div>

							</form>
						</div>

					</div>

				</div>
			</div>
		</section><!-- #content end -->