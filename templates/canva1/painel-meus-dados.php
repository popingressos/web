                            <form 
                             name="meus_dados_form" 
                             id="meus_dados_form_meus_dados"
                             action="<?=$link_modelo?><?=$_REQUEST['var1']?>/" 
                             method="post"
                             class="row mb-0" 
                             ENCTYPE="multipart/form-data" 
                             autocomplete="off_<?=$_SESSION['empresa_'.$rSqlEmpresa['id'].'_numeroUnico_carrinho']?>">

                                <input type="hidden" name="acaoForm" value="salva-meus-dados">
                                <input type="hidden" name="numeroUnico" value="<?=$rSqlUsuario['numeroUnico']?>">

								<? if(trim($rSqlUsuario['nome'])=="" ||
								      trim($rSqlUsuario['email'])=="" || 
								      trim($rSqlUsuario['genero'])=="" || 
								      trim($rSqlUsuario['data_de_nascimento'])=="" || 
									  trim($rSqlUsuario['whatsapp'])=="" || 
									  trim($rSqlUsuario['documento'])=="") { ?>
								<div class="col-12 form-group">
                                    <div class="style-msg errormsg">
                                        <div class="sb-msg"><i class="icon-remove"></i><strong>Atenção!</strong> Para finalizar sua compra é necessário que você informe todos os dados abaixo.</div>
                                    </div>
                                </div>
                                <? } ?>
    
								<div class="col-12 form-group">
									<label for="register-form-name">Nome Completo:</label>
									<input type="text" name="nome" id="nome" value="<?=$rSqlUsuario['nome']?>" class="form-control" />
								</div>

								<div class="col-12 form-group">
									<label for="register-form-email">E-mail:</label>
									<input type="text" name="email" id="email" value="<?=$rSqlUsuario['email']?>" class="form-control" />
								</div>

                                <div class="form-group col-sm-12">
                                    <label for="estado">Gênero</label>
                                    <select class="form-control form-control-lg" name="genero" id="genero" style="width:100%;margin-bottom:0px;">
                                       <option value="">Selecione um gênero</option>
                                       <option value=""></option>
                                       <option value="F" <? if(trim($rSqlUsuario['genero'])=="F") { echo " selected"; } ?>>Feminino</option>
                                       <option value="M" <? if(trim($rSqlUsuario['genero'])=="M") { echo " selected"; } ?>>Masculino</option>
                                    </select>
                                </div>
        
                                <?
								if(trim($rSqlUsuario['data_de_nascimento'])=="" || trim($rSqlUsuario['data_de_nascimento'])=="0000-00-00" || trim($rSqlUsuario['data_de_nascimento'])=="0000-00-00 00:00:00") {
									$data_de_nascimentoSet = "";
								} else {
									$data_de_nascimentoSet = "".ajustaDataSemHoraReturn($rSqlUsuario['data_de_nascimento'],"d/m/Y")."";
								}
								?>
								<div class="col-12 form-group">
									<label for="register-form-email">Data de Nascimento:</label>
									<input type="text" name="data_de_nascimento" id="data_de_nascimento" value="<?=$data_de_nascimentoSet?>" onblur="javascript:validarDataDeNascimento('data_de_nascimento');" class="form-control" />
                                    <div id="DIV_data_de_nascimento_valido" style="display:none;color:#777;font-size:11px;"><i style="color:#25D366;" class="far fa-check-circle"></i>&nbsp;&nbsp;Data informada é válida</div>
                                    <div id="DIV_data_de_nascimento_invalido" style="display:none;color:#777;font-size:11px;"><i style="color:#e70101;" class="far fa-engine-warning"></i>&nbsp;&nbsp;Data informada é inválida</div>
                                    <input type="hidden" id="data_de_nascimento_valido" name="data_de_nascimento_valido" value="0">
								</div>

								<div class="col-12 form-group">
									<label for="register-form-phone">Telefone (Celular/WhatsApp):</label>
									<input type="text" name="whatsapp" id="whatsapp" value="<?=$rSqlUsuario['whatsapp']?>" class="form-control" />
								</div>

								<div class="col-12 form-group">
									<label for="register-form-username">CPF:</label>
									<input type="text" name="documento" id="documento" 
									 maxlength="11" onblur="javascript:validarCpf('documento');"
									 <? if(trim($rSqlUsuario['documento'])=="") { } else { ?>disabled="disabled"<? } ?>  value="<?=$rSqlUsuario['documento']?>" class="form-control" />
                                    <div id="DIV_documento_valido" style="display:none;color:#777;font-size:11px;"><i style="color:#25D366;" class="far fa-check-circle"></i>&nbsp;&nbsp;CPF informado é válido</div>
                                    <div id="DIV_documento_invalido" style="display:none;color:#777;font-size:11px;"><i style="color:#e70101;" class="far fa-engine-warning"></i>&nbsp;&nbsp;CPF informado é inválido</div>
                                    <input type="hidden" id="documento_valido" name="documento_valido" value="0">
								</div>

								<div class="col-12 form-group">
									<button type="button" class="button button-3d button-black m-0" onclick="javascript:salvarMeusDados();">Salvar Alterações</button>
								</div>

							</form>
