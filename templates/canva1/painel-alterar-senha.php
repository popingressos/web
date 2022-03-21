                            <form 
                             name="alterar_senha_form" 
                             id="alterar_senha_form_alterar_senha"
                             action="<?=$link_modelo?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" 
                             method="post"
                             class="row mb-0" 
                             ENCTYPE="multipart/form-data" 
                             autocomplete="off_<?=$_SESSION['empresa_'.$rSqlEmpresa['id'].'_numeroUnico_carrinho']?>">

                                <input type="hidden" name="acaoForm" value="salva-alterar-senha">
                                <input type="hidden" name="numeroUnico" value="<?=$rSqlUsuario['numeroUnico']?>">

								<div class="col-12 form-group">
									<label for="register-form-password">Nova Senha:</label>
									<input type="password" name="senha" id="senha" value="" class="form-control" onkeypress="javascript:validarSenha('senha');" />
                                    <div id="DIV_senha_valido" style="display:none;color:#777;font-size:11px;"><i style="color:#25D366;" class="far fa-check-circle"></i>&nbsp;&nbsp;Nova Senha informada é válida</div>
                                    <div id="DIV_senha_invalido" style="display:none;color:#777;font-size:11px;"><i style="color:#e70101;" class="far fa-engine-warning"></i>&nbsp;&nbsp;Nova Senha informada é inválida</div>
                                    <input type="hidden" id="senha_valido" name="senha_valido" value="0">
								</div>

								<div class="col-12 form-group">
									<label for="register-form-repassword">Confirmação de Nova Senha:</label>
									<input type="password" name="conf_senha" id="conf_senha" value="" class="form-control" onkeypress="javascript:validarSenha('conf_senha');" />
                                    <div id="DIV_conf_senha_valido" style="display:none;color:#777;font-size:11px;"><i style="color:#25D366;" class="far fa-check-circle"></i>&nbsp;&nbsp;Nova Senha informada é válida</div>
                                    <div id="DIV_conf_senha_invalido" style="display:none;color:#777;font-size:11px;"><i style="color:#e70101;" class="far fa-engine-warning"></i>&nbsp;&nbsp;Nova Senha informada é inválida</div>
                                    <input type="hidden" id="conf_senha_valido" name="conf_senha_valido" value="0">
								</div>

								<div class="col-12 form-group">
									<button type="button" class="button button-3d button-black m-0" onclick="javascript:salvarAlterarSenha();">Salvar Alterações</button>
								</div>

							</form>
