<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/chave.php");

$_SESSION['numeroUnico_ticket'] = $_GET['numeroUnico_ticketS'];

$carrinhoArray = unserialize($_SESSION['eventos_tickets_'.$_GET['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']);
$carrinhoArray = array_sort($carrinhoArray, 'ticket_nome', SORT_ASC);
foreach ($carrinhoArray as $key => $value) {
	if($_GET['numeroUnico_ticketS']==$value['numeroUnico']) {
		$rSqlTicket = $value;
	}
}

if(trim($rSqlTicket['ticket_cpf_qtd'])=="" || trim($rSqlTicket['ticket_cpf_qtd'])=="0") { $rSqlTicket['ticket_cpf_qtd'] = "1"; }
?>

                            <div class="note note-warning" style="margin-bottom:0px;padding-top:5px;">
                                <h3><font style="font-size:14px;">EDITANDO TICKET</font> <br /><b><?=$rSqlTicket['ticket_nome']?></b></h3>
                                <p>Modifique os campos desejados e clique em 'Salvar Alterações'</p>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <label class="control-label col-md-12" style="text-align:left;">Nome</label>
                                <div class="col-md-12">
                                    <input value="<?=$rSqlTicket['ticket_nome']?>" type="text" id="editar_ticket_nome" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group" id="DIV_ticket_cpf_qtd" style="margin-bottom:10px;">
                                <label class="control-label col-md-12" style="text-align:left;">Quantidade de Tickets/Vouchers que um mesmo CPF pode adquirir</label>
                                <div class="col-md-12">
                                    <input value="<?=$rSqlTicket['ticket_cpf_qtd']?>" type="number" id="editar_ticket_cpf_qtd" placeholder="" class="form-control" />
                                    <div class="note note-warning" style="margin-bottom:0px;margin-top:5px;padding-top:5px;">
                                        <h3><font style="font-size:14px;">ATENÇÃO</font></h3>
                                        <p>Este campo determina a quantidade de vezes que o cliente que está comprando no site/app pode marcar/atribuir um mesmo CPF em ingressos de mesmo Ticket/Voucher.<br /><br /> 
                                        O recomendado para evitar cambismo de Tickets/Vouchers é deixar o padrão de 1 ingresso por atribuição de CPF.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Tipo de Ticket</label>
                                    <div class="col-md-12">
                                        <select id="editar_ticket_tipo" onchange="javascript:seleciona_ticket_tipo('editar_')" class="form-control">
                                            <option value="0" <? if(trim($rSqlTicket['ticket_tipo'])=="0") { echo " selected"; } ?>>Normal</option>
                                            <option value="1" <? if(trim($rSqlTicket['ticket_tipo'])=="1") { echo " selected"; } ?>>Pré-venda</option>
                                            <option value="2" <? if(trim($rSqlTicket['ticket_tipo'])=="2") { echo " selected"; } ?>>Lista Bônus</option>
                                            <option value="3" <? if(trim($rSqlTicket['ticket_tipo'])=="3") { echo " selected"; } ?>>Lounge</option>
                                            <option value="4" <? if(trim($rSqlTicket['ticket_tipo'])=="4") { echo " selected"; } ?>>Código para Sorteio</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Apenas Compra Autorizada?</label>
                                    <div class="col-md-12">
                                        <select id="editar_ticket_compra_autorizada" class="form-control">
                                            <option value="0" <? if(trim($rSqlTicket['ticket_compra_autorizada'])=="0" || trim($rSqlTicket['ticket_compra_autorizada'])=="") { echo " selected"; } ?>>NÃO</option>
                                            <option value="1" <? if(trim($rSqlTicket['ticket_compra_autorizada'])=="1") { echo " selected"; } ?>>SIM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <?
							if(trim($rSqlTicket['ticket_tipo'])=="4") {
								$display_DIV_ticket_tipo_numeracao = "block";
								if(trim($rSqlTicket['ticket_tipo_numeracao'])=="0") {
									$display_DIV_ticket_tipo_numeracao_tamanho = "none";
								} else {
									$display_DIV_ticket_tipo_numeracao_tamanho = "block";
								}
							} else {
								$display_DIV_ticket_tipo_numeracao = "none";
								$display_DIV_ticket_tipo_numeracao_tamanho = "none";
							}
							?>
                            <div class="form-group" id="DIV_editar_ticket_tipo_numeracao" style="margin-bottom:10px;display:<?=$display_DIV_ticket_tipo_numeracao?>;">
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Tipo de Númeração do Ticket</label>
                                    <div class="col-md-12">
                                        <select id="editar_ticket_tipo_numeracao" onchange="javascript:seleciona_ticket_tipo_numeracao('editar_')" class="form-control">
                                            <option value="0" <? if(trim($rSqlTicket['ticket_tipo_numeracao'])=="0") { echo " selected"; } ?>>Números com definição de início e fim</option>
                                            <option value="1" <? if(trim($rSqlTicket['ticket_tipo_numeracao'])=="1") { echo " selected"; } ?>>Números e Letras Randômicos</option>
                                            <option value="2" <? if(trim($rSqlTicket['ticket_tipo_numeracao'])=="2") { echo " selected"; } ?>>Apenas Números Randômicos</option>
                                            <option value="3" <? if(trim($rSqlTicket['ticket_tipo_numeracao'])=="3") { echo " selected"; } ?>>Apenas Letras Randômicos</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="DIV_editar_ticket_tipo_numeracao_tamanho" style="margin-bottom:10px;display:<?=$display_DIV_ticket_tipo_numeracao_tamanho?>;">
                                <label class="control-label col-md-12" style="text-align:left;">Quantidade de caracteres do Ticket/Voucher</label>
                                <div class="col-md-12">
                                    <input value="<?=$rSqlTicket['ticket_tipo_numeracao_tamanho']?>" type="number" id="editar_ticket_tipo_numeracao_tamanho" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <?
							if(trim($rSqlTicket['ticket_tipo_numeracao'])=="0") {
								$display_DIV_ticket_tipo_numeracao_0 = "block";
							} else {
								$display_DIV_ticket_tipo_numeracao_0 = "none";
							}
							?>
                            <div class="form-group" id="DIV_editar_ticket_tipo_numeracao_0" style="margin-bottom:10px;display:<?=$display_DIV_ticket_tipo_numeracao_0?>;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">De</label>
                                    <div class="col-md-12">
                                        <input value="<?=$rSqlTicket['ticket_tipo_numeracao_de']?>" type="number" id="editar_ticket_tipo_numeracao_de" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Até</label>
                                    <div class="col-md-12">
                                        <input value="<?=$rSqlTicket['ticket_tipo_numeracao_ate']?>" type="number" id="editar_ticket_tipo_numeracao_ate" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <?
							if(trim($rSqlTicket['ticket_tipo_numeracao'])=="1") {
								$display_DIV_ticket_tipo_numeros_letras = "block";
								$display_DIV_ticket_tipo_numeros_letras_qtd = "block";
							} else {
								$display_DIV_ticket_tipo_numeros_letras = "none";
								$display_DIV_ticket_tipo_numeros_letras_qtd = "none";
							}
							?>
                            <div class="form-group" id="DIV_editar_ticket_tipo_numeros_letras" style="margin-bottom:10px;display:<?=$display_DIV_ticket_tipo_numeros_letras?>;">
                                <div class="col-md-12" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Tipo de Númeração do Ticket</label>
                                    <div class="col-md-12">
                                        <select id="editar_ticket_tipo_numeros_letras" onchange="javascript:seleciona_ticket_tipo_numeros_letras('editar_')" class="form-control">
                                            <option value="0" <? if(trim($rSqlTicket['ticket_tipo_numeros_letras'])=="0") { echo " selected"; } ?>>Ordem Aleatória</option>
                                            <option value="1" <? if(trim($rSqlTicket['ticket_tipo_numeros_letras'])=="1") { echo " selected"; } ?>>Começa com Letras</option>
                                            <option value="2" <? if(trim($rSqlTicket['ticket_tipo_numeros_letras'])=="2") { echo " selected"; } ?>>Começa com Números</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="DIV_editar_ticket_tipo_numeros_letras_qtd" style="margin-bottom:10px;display:<?=$display_DIV_ticket_tipo_numeros_letras_qtd?>;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Qtd Letras</label>
                                    <div class="col-md-12">
                                        <input value="<?=$rSqlTicket['ticket_tipo_numeros_letras_qtd_letras']?>" type="number" id="editar_ticket_tipo_numeros_letras_qtd_letras" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Qtd Números</label>
                                    <div class="col-md-12">
                                        <input value="<?=$rSqlTicket['ticket_tipo_numeros_letras_qtd_numeros']?>" type="number" id="editar_ticket_tipo_numeros_letras_qtd_numeros" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <?
							if(trim($rSqlTicket['ticket_tipo'])=="3") {
								$display_DIV_editar_ticket_qtd_lounge = "block";
							} else {
								$display_DIV_editar_ticket_qtd_lounge = "none";
							}
							?>
                            <div class="form-group" id="DIV_editar_ticket_qtd_lounge" style="margin-bottom:10px;display:<?=$display_DIV_editar_ticket_qtd_lounge?>;">
                                <label class="control-label col-md-12" style="text-align:left;">Quantidade de Ingresso por Lounge</label>
                                <div class="col-md-12">
                                    <input value="<?=$rSqlTicket['ticket_qtd_lounge']?>" type="text" id="editar_ticket_qtd_lounge" placeholder="" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Gênero</label>
                                    <div class="col-md-12">
                                        <select id="editar_ticket_genero" class="form-control">
                                            <option value="U" <? if(trim($rSqlTicket['ticket_genero'])=="U") { echo " selected"; } ?>>Unissex</option>
                                            <option value="F" <? if(trim($rSqlTicket['ticket_genero'])=="F") { echo " selected"; } ?>>Feminino</option>
                                            <option value="M" <? if(trim($rSqlTicket['ticket_genero'])=="M") { echo " selected"; } ?>>Masculino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exigir Atribuição de Beneficiário</label>
                                    <div class="col-md-12">
                                        <select id="editar_ticket_exigir_atribuicao" class="form-control">
                                            <option value="1" <? if(trim($rSqlTicket['ticket_exigir_atribuicao'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($rSqlTicket['ticket_exigir_atribuicao'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir Info de Lote</label>
                                    <div class="col-md-12">
                                        <select id="editar_ticket_exibir_lote" class="form-control">
                                            <option value="1" <? if(trim($rSqlTicket['ticket_exibir_lote'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($rSqlTicket['ticket_exibir_lote'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Exibir Info de Taxa</label>
                                    <div class="col-md-12">
                                        <select id="editar_ticket_exibir_taxa" class="form-control">
                                            <option value="1" <? if(trim($rSqlTicket['ticket_exibir_taxa'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($rSqlTicket['ticket_exibir_taxa'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Meia Entrada</label>
                                    <div class="col-md-12">
                                        <select id="editar_ticket_meia_entrada" class="form-control">
                                            <option value="0" <? if(trim($rSqlTicket['ticket_meia_entrada'])=="0") { echo " selected"; } ?>>NÃO</option>
                                            <option value="1" <? if(trim($rSqlTicket['ticket_meia_entrada'])=="1") { echo " selected"; } ?>>SIM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Virada de Lote Automática</label>
                                    <div class="col-md-12">
                                        <select id="editar_ticket_virada_de_lote" class="form-control">
                                            <option value="0" <? if(trim($rSqlTicket['ticket_virada_de_lote'])=="0") { echo " selected"; } ?>>NÃO</option>
                                            <option value="1" <? if(trim($rSqlTicket['ticket_virada_de_lote'])=="1") { echo " selected"; } ?>>SIM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Ativo no Site</label>
                                    <div class="col-md-12">
                                        <select id="editar_ticket_exibir_site" class="form-control">
                                            <option value="1" <? if(trim($rSqlTicket['ticket_exibir_site'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($rSqlTicket['ticket_exibir_site'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Ativo no App</label>
                                    <div class="col-md-12">
                                        <select id="editar_ticket_exibir_app" class="form-control">
                                            <option value="1" <? if(trim($rSqlTicket['ticket_exibir_app'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($rSqlTicket['ticket_exibir_app'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Ativo no PDV</label>
                                    <div class="col-md-12">
                                        <select id="editar_ticket_exibir_pdv" class="form-control">
                                            <option value="1" <? if(trim($rSqlTicket['ticket_exibir_pdv'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($rSqlTicket['ticket_exibir_pdv'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Ativo para Comissário</label>
                                    <div class="col-md-12">
                                        <select id="editar_ticket_exibir_com" class="form-control">
                                            <option value="1" <? if(trim($rSqlTicket['ticket_exibir_com'])=="1") { echo " selected"; } ?>>SIM</option>
                                            <option value="0" <? if(trim($rSqlTicket['ticket_exibir_com'])=="0") { echo " selected"; } ?>>NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|campanha_de_cartao|") === false) { ?>
                            <div class="form-group">
                                <label class="control-label col-md-12" style="text-align:left;">Campanha de Cartão</label>
                                <div class="col-md-12">
                                    <select id="editar_ticket_campanha_de_cartao" class="form-control">
                                        <option value="">---</option>
										<?
                                        $qSqlItem = mysql_query("
                                                                SELECT 
                                                                    mod_campanha_de_cartao.numeroUnico,
                                                                    mod_campanha_de_cartao.nome,
																	mod_empresa.nome AS empresa_nome
                                                                     
                                                                FROM 
                                                                    campanha_de_cartao AS mod_campanha_de_cartao
																LEFT JOIN empresa AS mod_empresa ON (mod_empresa.id = mod_campanha_de_cartao.empresa) 
                                                                WHERE
                                                                    (mod_campanha_de_cartao.stat='0' OR mod_campanha_de_cartao.stat='1') ".$filtro["mod_campanha_de_cartao"]." 
                                                                ORDER BY 
                                                                    mod_campanha_de_cartao.nome");
                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
											if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
												if(trim($rSqlItem['empresa_nome'])=="") {
													$rSqlItem['nome'] = "Sem empresa setada - ".$rSqlItem['nome']."";
												} else {
													$rSqlItem['nome'] = "".$rSqlItem['empresa_nome']." - ".$rSqlItem['nome']."";
												}
											} else {
												$rSqlItem['nome'] = "".$rSqlItem['nome']."";
											}
                                        ?>
                                        <option value="<?= $rSqlItem['numeroUnico'] ?>" <? if(trim($rSqlItem['numeroUnico'])==trim($rSqlTicket['ticket_campanha_de_cartao'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>
                            <? } ?>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Imagem de Capa do Ticket</label>
                                    <div class="col-md-12" style="margin-top:10px;">
                                        <? $campo_imagem_set = "ticket_imagem_de_capa"; ?>
                                        <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                            <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                                <? if(trim($rSqlTicket[''.$campo_imagem_set.''])=="") {  } else { ?>
                                                <img id="arquivo-atual-imagem" src="<?=$link?>files/eventos_ticket_imagem_de_capa/<?=$rSqlTicket['numeroUnico']?>/<?=$rSqlTicket[''.$campo_imagem_set.'']?>" alt="">
                                                <? } ?>
                                            </div>
        
                                            <input value="<?=$rSqlTicket[''.$campo_imagem_set.'']?>" type="hidden" id="editar_<?=$campo_imagem_set?>" />
                                            <? if(trim($rSqlTicket[''.$campo_imagem_set.''])=="") { ?>
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-exists" id="alterar_<?=$campo_imagem_set?>">Alterar</span> 
                                                    <span class="fileinput-new" id="selecionar_<?=$campo_imagem_set?>">Selecionar Imagem</span> 
                                                    <input type="file" name="editar_<?=$campo_imagem_set?>">
                                                </span> 
                                                <a class="btn red" href="javascript:void(0);" style="display:none;" id="remover_<?=$campo_imagem_set?>" data-dismiss="fileinput" onclick="eventos_tickets_remover_imagem('ticket_imagem_de_capa');">Remover</a>
                                            </div>
                                            <? } else { ?>
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-new" id="alterar_<?=$campo_imagem_set?>">Alterar</span> 
                                                    <span class="fileinput-exists" id="selecionar_<?=$campo_imagem_set?>">Selecionar Imagem</span> 
                                                    <input type="file" name="editar_<?=$campo_imagem_set?>">
                                                </span> 
                                                <a class="btn red" href="javascript:void(0);" id="remover_<?=$campo_imagem_set?>" data-dismiss="fileinput" onclick="eventos_tickets_remover_imagem('ticket_imagem_de_capa');">Remover</a>
                                            </div>
                                            <? } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">Mapa informativo do Ticket</label>
                                    <div class="col-md-12" style="margin-top:10px;">
                                        <? $campo_imagem_set = "ticket_mapa"; ?>
                                        <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                            <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                                                <? if(trim($rSqlTicket[''.$campo_imagem_set.''])=="") {  } else { ?>
                                                <img id="arquivo-atual-imagem" src="<?=$link?>files/eventos_ticket_mapa/<?=$rSqlTicket['numeroUnico']?>/<?=$rSqlTicket[''.$campo_imagem_set.'']?>" alt="">
                                                <? } ?>
                                            </div>
        
                                            <input value="<?=$rSqlTicket[''.$campo_imagem_set.'']?>" type="hidden" id="editar_<?=$campo_imagem_set?>" />
                                            <? if(trim($rSqlTicket[''.$campo_imagem_set.''])=="") { ?>
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-exists" id="alterar_<?=$campo_imagem_set?>">Alterar</span> 
                                                    <span class="fileinput-new" id="selecionar_<?=$campo_imagem_set?>">Selecionar Imagem</span> 
                                                    <input type="file" name="editar_<?=$campo_imagem_set?>">
                                                </span> 
                                                <a class="btn red" href="javascript:void(0);" style="display:none;" id="remover_<?=$campo_imagem_set?>" data-dismiss="fileinput" onclick="javascript:eventos_tickets_remover_imagem('ticket_mapa');">Remover</a>
                                            </div>
                                            <? } else { ?>
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-new" id="alterar_<?=$campo_imagem_set?>">Alterar</span> 
                                                    <span class="fileinput-exists" id="selecionar_<?=$campo_imagem_set?>">Selecionar Imagem</span> 
                                                    <input type="file" name="editar_<?=$campo_imagem_set?>">
                                                </span> 
                                                <a class="btn red" href="javascript:void(0);" id="remover_<?=$campo_imagem_set?>" data-dismiss="fileinput" onclick="javascript:eventos_tickets_remover_imagem('ticket_mapa');">Remover</a>
                                            </div>
                                            <? } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-6" style="padding:0px;">
                                    <label class="control-label col-md-12" style="text-align:left;">PDF Informativo do Ticket</label>
                                    <div class="col-md-12" style="margin-top:10px;">
                                        <? $campo_imagem_set = "ticket_pdf_informativo"; ?>
                                        <div class="fileinput top-side top-side-desktop fileinput-new" data-provides="fileinput">
                                            <div id="div_<?=$campo_imagem_set?>" class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px;">
                                                <? if(trim($rSqlTicket[''.$campo_imagem_set.''])=="") {  } else { ?>
                                                <a href="<?=$link?>files/eventos_ticket_pdf_informativo/<?=$rSqlTicket['numeroUnico']?>/<?=$rSqlTicket[''.$campo_imagem_set.'']?>" target="_blank"><?=$rSqlTicket[''.$campo_imagem_set.'']?></a>
                                                <? } ?>
                                            </div>
        
                                            <input value="<?=$rSqlTicket[''.$campo_imagem_set.'']?>" type="hidden" id="editar_<?=$campo_imagem_set?>" />
                                            <? if(trim($rSqlTicket[''.$campo_imagem_set.''])=="") { ?>
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-exists" id="alterar_<?=$campo_imagem_set?>">Alterar</span> 
                                                    <span class="fileinput-new" id="selecionar_<?=$campo_imagem_set?>">Selecionar Arquivo</span> 
                                                    <input type="file" accept="application/pdf" name="editar_<?=$campo_imagem_set?>">
                                                </span> 
                                                <a class="btn red" href="javascript:void(0);" style="display:none;" id="remover_<?=$campo_imagem_set?>" data-dismiss="fileinput" onclick="javascript:eventos_tickets_remover_imagem('ticket_pdf_informativo');">Remover</a>
                                            </div>
                                            <? } else { ?>
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-new" id="alterar_<?=$campo_imagem_set?>">Alterar</span> 
                                                    <span class="fileinput-exists" id="selecionar_<?=$campo_imagem_set?>">Selecionar Arquivo</span> 
                                                    <input type="file" accept="application/pdf" name="editar_<?=$campo_imagem_set?>">
                                                </span> 
                                                <a class="btn red" href="javascript:void(0);" id="remover_<?=$campo_imagem_set?>" data-dismiss="fileinput" onclick="javascript:eventos_tickets_remover_imagem('ticket_pdf_informativo');">Remover</a>
                                            </div>
                                            <? } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?
                            if(trim($rSqlTicket['ticket_data'])=="") {
                                $ticket_dataSet = "";
                            } else {
                                $ticket_dataSet = ajustaDataSemHoraReturn($rSqlTicket['ticket_data'],"d/m/Y");
                            }
                            ?>
                            <div class="form-group" style="margin-bottom:10px;">
                                <label class="control-label col-md-12" style="text-align:left;">Data do Ticket</label>
                                <div class="col-md-12">
                                    <div class="col-md-6" style="padding:0px;">
                                        <div class="input-group date date-picker" id="TI_ticket_data" data-date-format="dd/mm/yyyy"  data-date="<?=$ticket_dataSet?>">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span> 
                                            <input type="text" id="editar_ticket_data" class="form-control input-sm" value="<?=$ticket_dataSet?>" style="height: 34px;margin-top:0px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="help-block">Está data serve para informar ao cliente a data de utilização deste ticket.</p>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:10px;">
                                <label class="control-label col-md-12" style="text-align:left;">Informações</label>
                                <div class="col-md-12">
                                    <textarea class="form-control ckeditor" id="editar_ticket_info"><?=$rSqlTicket['ticket_info']?></textarea>
                                    <p class="help-block">Acima você pode colocar um texto descritivo sobre o ticket, o qual vai aparecer ao ser clicado no ícone de "informações" que fica disponível nas suas plataformas.</p>
                                </div>
                            </div>


                            <div class="form-group" style="margin-bottom:10px;">
                                <div class="col-md-10">
                                    <a class="btn input-label" onclick="javascript:eventos_tickets_editar('<?=$rSqlTicket['numeroUnico']?>');" style="background-color:#19d18e;color:#FFF;text-align:center;"><i class="fa fa-plus"></i>&nbsp;Salvar Alterações</a>
                                    <a class="btn yellow-gold input-label" onclick="javascript:eventos_tickets_view_cancelar();">&nbsp;Cancelar Edição</a>
                                </div>
                            </div>

