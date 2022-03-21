                            <form 
                             name="meu_endereco_form" 
                             id="meu_endereco_form_meu_endereco"
                             action="<?=$link_modelo?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" 
                             method="post"
                             class="row mb-0" 
                             ENCTYPE="multipart/form-data" 
                             autocomplete="off_<?=$_SESSION['empresa_'.$rSqlEmpresa['id'].'_numeroUnico_carrinho']?>">

                                <input type="hidden" name="acaoForm" value="salva-meu-endereco">
                                <input type="hidden" name="numeroUnico" value="<?=$rSqlUsuario['numeroUnico']?>">

                                 <div class="form-group col-sm-8">
                                     <label for="rua">CEP</label>
                                     <input type="text" class="form-control" name="cep" id="cep" value="<?=$rSqlUsuario['cep']?>">
                                 </div>
                                 <div class="form-group col-sm-4">
                                     <input type="button" value="Buscar Endereço" onclick="javascript:buscaCepPadrao('');" style="margin-top: 32px;" class="btn btn-primary btn-modern float-left">
                                 </div>
                                 <div class="form-group col-sm-8">
                                     <label for="rua">Rua</label>
                                     <input type="text" class="form-control" name="rua" id="rua" value="<?=$rSqlUsuario['rua']?>">
                                 </div>
                                 <div class="form-group col-sm-4">
                                     <label for="numero">Número</label>
                                     <input type="text" class="form-control" name="numero" id="numero" value="<?=$rSqlUsuario['numero']?>">
                                 </div>
                                 <div class="form-group col-sm-12">
                                     <label for="complemento">Complemento</label>
                                     <input type="text" class="form-control" name="complemento" id="complemento" value="<?=$rSqlUsuario['complemento']?>">
                                 </div>
                                 <div class="form-group col-sm-12">
                                     <label for="estado">Estado</label>
                                     <select class="form-control form-control-lg" name="estado" id="estado" style="width:100%;">
                                        <option value="">Selecione um estado</option>
                                        <?
                                        $cont = 0;
                                        $qSqlEstado = mysql_query("SELECT uf,estado FROM cepbr_estado ORDER BY uf");
                                        while($rSqlEstado = mysql_fetch_array($qSqlEstado)) {
                                             $titulo_setado = $rSqlEstado['estado'];
                                        ?>
                                        <option value="<?=$rSqlEstado['uf']?>" <? if(trim($rSqlUsuario['estado'])==trim($rSqlEstado['uf'])) { echo " selected"; } ?>><?=$titulo_setado?></option>
                                        <? } ?>
                                     </select>
                                 </div>
                                 <div class="form-group col-sm-12">
                                     <label for="cidade">Cidade</label>
                                     <select name="id_cidade" id="cidade" class="form-control form-control-lg" style="width:100%;">
                                     <?
                                     if(trim($rSqlUsuario['estado'])=="") { } else {
                                         $qSqlCidade = mysql_query("SELECT id_cidade,cidade FROM cepbr_cidade WHERE uf='".$rSqlUsuario['estado']."' ORDER BY cidade");
                                         while($rSqlCidade = mysql_fetch_array($qSqlCidade)) {
                                         ?>
                                         <option value="<?=$rSqlCidade['id_cidade']?>" <? if(trim($rSqlUsuario['cidade_id'])==trim($rSqlCidade['id_cidade'])) { echo " selected"; } ?>><?=$rSqlCidade['cidade']?></option>
                                         <? } ?>
                                     <? } ?>
                                     </select>
                                 </div>
                                 <div class="form-group col-sm-12">
                                     <label for="bairro">Bairro</label>
                                     <select name="id_bairro" id="bairro" class="form-control form-control-lg" style="width:100%;">
                                     <?
                                     if(trim($rSqlUsuario['cidade_id'])=="") { } else {
                                         $qSqlBairro = mysql_query("SELECT id_bairro,bairro FROM cepbr_bairro WHERE id_cidade='".$rSqlUsuario['cidade_id']."' ORDER BY bairro");
                                         while($rSqlBairro = mysql_fetch_array($qSqlBairro)) {
                                         ?>
                                         <option value="<?=$rSqlBairro['id_bairro']?>" <? if(trim($rSqlUsuario['bairro_id'])==trim($rSqlBairro['id_bairro'])) { echo " selected"; } ?>><?=$rSqlBairro['bairro']?></option>
                                         <? } ?>
                                     <? } ?>
                                     </select>
                                 </div>

								<div class="col-12 form-group">
									<button type="button" class="button button-3d button-black m-0" onclick="javascript:salvarMeuEndereco();">Salvar Alterações</button>
								</div>

							</form>
