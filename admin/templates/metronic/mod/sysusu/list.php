				<div class="col-md-12">
                    <div class="tabbable tabbable-custom blue">

                        <ul class="nav nav-tabs">

                            <? if(trim($_REQUEST['var3'])=="permissoes") { ?><li class="active"><a data-toggle="tab" href="#permissoes">Editando Permissões de <?=$row['nome']?></a></li><? } ?>
                            <? if(trim($_REQUEST['var3'])=="historico-de-acessos") { ?><li class="active"><a data-toggle="tab" href="#acessos">Histórico de Acessos de <?=$row['nome']?></a></li><? } ?>
                            <? if(trim($_REQUEST['var3'])=="historico-de-operacoes") { ?><li class="active"><a data-toggle="tab" href="#operacoes">Histórico de Operações de <?=$row['nome']?></a></li><? } ?>
							<? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="permissoes"||trim($_REQUEST['var3'])=="historico-de-acessos"||trim($_REQUEST['var3'])=="historico-de-operacoes") { } else { ?><? if(trim($_construtor_sysperm['editar_'.$mod.''])==1) { ?><li <? if(trim($_REQUEST['var3'])=="permissoes"||trim($_REQUEST['var3'])=="historico-de-acessos"||trim($_REQUEST['var3'])=="historico-de-operacoes") { } else { ?>class="active"<? } ?>><a data-toggle="tab" href="#editando">Editando <?=$row['nome']?></a></li><? } ?><? } ?>
                            <? if(trim($_construtor_sysperm['inserir_'.$mod.''])==1||trim($_construtor_sysperm['editar_'.$mod.''])==1||trim($_construtor_sysperm['excluir_'.$mod.''])==1) { ?><li <? if(trim($_REQUEST['var3'])=="") { ?>class="active"<? } ?>><a data-toggle="tab" href="#lista">Lista de Itens</a></li><? } ?>
                            <? if(trim($_REQUEST['var3'])=="") { ?><? if(trim($_construtor_sysperm['inserir_'.$mod.''])==1) { ?><li><a data-toggle="tab" href="#adicionar-novo">Adicionar Novo</a></li><? } ?><? } ?>

                        </ul>
    
                        <div class="tab-content">
                                
								<? $_GET['modS'] = $mod; ?>
                                <? $_GET['tbLocalS'] = "".$mod.""; ?>
                                <div class="tab-pane <? if(trim($_REQUEST['var3'])=="") { ?>active<? } ?>" id="lista">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="actions">
                                                    <div class="btn-group pull-right">
                                                        <a class="btn default yellow-stripe" href="#" data-toggle="dropdown">
                                                        <i class="fa fa-share"></i>
                                                        <span class="hidden-480">
                                                        Ações </span>
                                                        <i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a href="javascript:void(0);" onclick="acao_selecionados('excluir','');"><i class="fa fa-times"></i>&nbsp;Remover</a></li>
                                                            <li><a href="javascript:void(0);" onclick="acao_selecionados('publicar','');" class="green"><i class="fa fa-check-circle"></i>&nbsp;Publicar</a></li>
                                                            <li><a href="javascript:void(0);" onclick="acao_selecionados('despublicar','');" class="red-thunderbird"><i class="fa fa-minus-circle"></i>&nbsp;Despublicar</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form name="list" action="<?=$link?><?=$chave_url?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>" method="post" target="_self">
                                    <input type="hidden" name="subMod" value=""/>
                                    <input type="hidden" name="acaoForm" id="acaoForm_lista" value="" />
                                    <input type="hidden" name="modulo" value="<?=$mod?>" />
                                    <input type="hidden" name="aba" id="aba_lista" value="" />

                                    <div id="datatable_ajax_tbody">
										<? 
										include("./templates/".$layout_padrao_set."/acoes/sysusu/tabela-tbody-sysusu.php"); 
                                        ?>
                                    </div>
                                    </form>
                                </div>
                                <!-- END TAB_LISTA-->
                                
                                <? if(trim($_REQUEST['var3'])=="historico-de-acessos") { ?>
                                <div class="tab-pane <? if(trim($_REQUEST['var3'])=="historico-de-acessos") { ?> active<? } ?>" id="acessos">
                                    <table class="table table-striped table-bordered table-hover" id="tabela_acessos">
                                        <thead>
                                            <tr role="row" class="heading">
                                                <th>Nome do Usuário</th>
                                                <th>E-mail do Usuário</th>
                                                <th style="width:130px;">Data do Acesso</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?
											$qSql = mysql_query("SELECT * FROM sysacesso WHERE idsysusu='".$_REQUEST['var4']."'");
                                            while($rSql = mysql_fetch_array($qSql)) {
                                            ?>
                                            <tr class="odd gradeX">
                                                <? $rSqlSysusu = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSql['idsysusu']."'")); ?>
                                                <td><?=$rSqlSysusu['nome']?></td>
                                                <td><?=$rSqlSysusu['email']?></td>
                                                <td><? ajustaData($rSql['data'],"d/m/Y"); ?></td>
                                            </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END TAB_ACESSOS -->
                                <? } ?>

                                <? if(trim($_REQUEST['var3'])=="historico-de-operacoes") { ?>
                                <div class="tab-pane <? if(trim($_REQUEST['var3'])=="historico-de-operacoes") { ?> active<? } ?>" id="operacoes">
                                    <table class="table table-striped table-bordered table-hover" id="tabela_operacoes">
                                        <thead>
                                            <tr role="row" class="heading">
                                                <th>Perfil</th>
                                                <th>Usuário</th>
                                                <th>Ação</th>
                                                <th>Local</th>
                                                <th>Descrição</th>
                                                <th style="width:130px;">Data</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?
											$qSql = mysql_query("SELECT * FROM syslog WHERE idsysusu='".$_REQUEST['var4']."' ORDER BY data DESC");
                                            while($rSql = mysql_fetch_array($qSql)) {
                                            ?>
                                            <tr class="odd gradeX">
                                                <td><? if($rSql['perfil']=="administrador") { echo "Administrador"; } else { echo "Cliente"; } ?></td>
                                                <? $rSqlSysusu = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSql['idsysusu']."'")); ?>
                                                <td><?=$rSqlSysusu['nome']?></td>
                                                <td><?=$rSql['acao']?></td>
                                                <td><?=$rSql['local']?></td>
                                                <td><?=$rSql['detalhe']?></td>
                                                <td><? ajustaData($rSql['data'],"d/m/Y"); ?></td>
                                            </tr>
                                            <? } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END TAB_OPERACOES -->
                                <? } ?>

                                <? if(trim($_REQUEST['var3'])=="permissoes"||trim($_REQUEST['var3'])=="historico-de-acessos"||trim($_REQUEST['var3'])=="historico-de-operacoes") { } else { ?>
                                <div class="tab-pane <? if(trim($_REQUEST['var3'])==""||trim($_REQUEST['var3'])=="permissoes") { } else { ?> active<? } ?>" id="<? if(trim($_REQUEST['var3'])=="") { ?>adicionar-novo<? } else { ?>editando<? } ?>">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <ul class="ver-inline-menu tabbable margin-bottom-10">
                                                <li onclick="seta_aba('dados-principais');" class="active"><a data-toggle="tab" href="#dados-principais"><i class="fa fa-caret-right"></i> Dados principais</a> <span class="after"></span></li>
                                                <li onclick="seta_aba('dados-de-contato');"><a data-toggle="tab" href="#dados-de-contato"><i class="fa fa-caret-right"></i> Dados de Contato</a></li>
                                                <li onclick="seta_aba('editar-avatar');"><a data-toggle="tab" href="#editar-avatar"><i class="fa fa-caret-right"></i> Editar Avatar</a></li>
                                                <li onclick="seta_aba('endereco');"><a data-toggle="tab" href="#endereco"><i class="fa fa-caret-right"></i> Endereço</a></li>
                                                <li onclick="seta_aba('dashboard');"><a data-toggle="tab" href="#dashboard"><i class="fa fa-caret-right"></i> Dashboard</a></li>
                                                <li onclick="seta_aba('configuracoes-de-pdv');"><a data-toggle="tab" href="#configuracoes-de-pdv"><i class="fa fa-caret-right"></i> Configurações de PDV</a></li>
                                            </ul>
                                        </div>

                                        <div class="col-md-10">
                                            <div class="portlet light bg-inverse form-fit">
                                            <div class="portlet-body form">
                                                <form name="forms" method="post" action="<?=$link?><?=$chave_url?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data" id="formulario" class="form-horizontal form-bordered form-row-stripped">
                                                <div class="form-body">
                                                        <input type="hidden" name="aba" id="aba" value="dados-principais" />
                                                        
                                                        <input type="hidden" name="subMod" value="" />

                                                    <? if(trim($_REQUEST['var3'])=="") { ?> 
                                                        <input type="hidden" name="acaoLocal" value="interno" />
                                                        <input type="hidden" name="acaoForm" id="idacaoForm" value="add" />
                                                        <input type="hidden" name="modulo" value="<?=$mod?>" />

                                                        <? 
                                                        $numeroUnicoGerado = geraCodReturn(); 
                                                        ?>
                                                        <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
													<? } else { ?>
                                                        <input type="hidden" name="acaoLocal" value="interno" />
                                                        <input type="hidden" name="acaoForm" id="idacaoForm" value="editar" />
                                                        <input type="hidden" name="modulo" value="<?=$mod?>" />
                                                        <input type="hidden" name="iditem" id="iditem_set" value="<?=$_REQUEST['var4']?>" />
            
                                                        <? 
                                                        $numeroUnicoGerado = $row['numeroUnico']; 
                                                        ?>
                                                        <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
                                                    <? } ?>


                                                    <div class="tab-content">
    
                                                        <div id="configuracoes-de-pdv" class="tab-pane" style="min-height:350px;">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Modelo de PDV Relacionado</label>
                                                                <div class="col-md-10">
                                                                    <select name="pdv" id="pdv" class="form-control">
                                                                        <option value="0">---</option>
                                                                        <?
                                                                        $qSqlItem = mysql_query("SELECT numeroUnico,nome FROM pdv ".$filtro_pdv." ORDER BY nome");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <option value="<?= $rSqlItem['numeroUnico'] ?>" <? if($rSqlItem['numeroUnico']==$row['pdv']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                    <p class="help-block">A empresa selecionada, vai conectar o usuário à conta administradora da empresa em questão cadastrada.</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Eventos Relacionados</label>
                                                                <div class="col-md-10">
                                                                    <select id="eventos_relacionados_itens" class="multi-select input-sm" multiple="multiple">
																		<?
																		if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
																			$where_eventos = "WHERE mod_eventos.stat='1'";
																		} else {
																			$where_eventos = "WHERE mod_eventos.stat='1' AND 
																			                       (mod_eventos.empresa='".$sysusu['empresa']."' OR mod_eventos.plataforma='".$sysusu['empresa']."')";
																		}

                                                                        $qSqlItem = mysql_query("SELECT * FROM eventos AS mod_eventos ".$where_eventos." ORDER BY mod_eventos.nome");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                        ?>
                                                                        <option value="|<?= $rSqlItem['id'] ?>|" <? if(strrpos($row['eventos_relacionados'],"|".$rSqlItem['id']."|") === false) { } else { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                    <input value="<?=$row['eventos_relacionados']?>" type="hidden" name="eventos_relacionados" id="eventos_relacionados" />
                                                                    <p class="help-block">Somente os eventos selecionados irão ser exibidos no PDV, caso nenhum seja selecionado, será exibido todos da empresa principal e/ou das empresas relacionadas.</p>
                                                                </div>
                                                            </div>

															<? $nome_campo = "pdv_fechamento"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fechamento Maquineta Habilitado?</label>
                                                                <div class="col-md-10">
                                                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "pdv_sangria"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Sangria Maquineta Habilitada?</label>
                                                                <div class="col-md-10">
                                                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "pdv_relatorio"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Relatório Maquineta Habilitado?</label>
                                                                <div class="col-md-10">
                                                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "pdv_busca"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Busca Maquineta Habilitada?</label>
                                                                <div class="col-md-10">
                                                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                                                    </select>
                                                                </div>
                                                            </div>

															<? $nome_campo = "pdv_split"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Aceita realiza SPLIT no pagamento?</label>
                                                                <div class="col-md-10">
                                                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                
                                
                                                            <? $nome_campo = "pdv_ccr"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Aceita Pagamento em Cartão de Crédito?</label>
                                                                <div class="col-md-10">
                                                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "pdv_ccd"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Aceita Pagamento em Cartão de Débito?</label>
                                                                <div class="col-md-10">
                                                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "pdv_din"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Aceita Pagamento em Dinheiro?</label>
                                                                <div class="col-md-10">
                                                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "pdv_pix"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Aceita Pagamento em PIX?</label>
                                                                <div class="col-md-10">
                                                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                
                                                            <? $nome_campo = "pdv_cortesia"; ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Autorizado a gerar cortesia?</label>
                                                                <div class="col-md-10">
                                                                    <select name="<?=$nome_campo?>" id="<?=$nome_campo?>" class="form-control">
                                                                        <option value="0" <? if(trim($row[''.$nome_campo.''])=="0") { echo " selected"; } ?>>NÃO</option>
                                                                        <option value="1" <? if(trim($row[''.$nome_campo.''])=="1") { echo " selected"; } ?>>SIM</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="dados-principais" class="tab-pane active" style="min-height:350px;">
                            
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Grupo de Permissão</label>
                                                                <div class="col-md-10">
                                                                    <select name="idsysgrupousuario" id="idsysgrupousuario" class="form-control">
                                                                        <option value="0">---</option>
                                                                        <?
																		if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
																			$where_sysgrupousuario = "WHERE mod_sysgrupousuario.tipo='padrao'";
																		} else {
																			$where_sysgrupousuario = "WHERE mod_sysgrupousuario.tipo='padrao' AND mod_sysgrupousuario.empresa='".$sysusu['empresa']."'";
																		}
                                                                        $qSqlItem = mysql_query("
																								SELECT 
																									mod_sysgrupousuario.id, 
																									mod_sysgrupousuario.nome, 
							
																									mod_empresa.nome AS empresa_nome
																								FROM 
																									sysgrupousuario AS mod_sysgrupousuario
																								LEFT JOIN empresa AS mod_empresa ON (mod_empresa.id = mod_sysgrupousuario.empresa)
																								".$where_sysgrupousuario."
																								ORDER BY 
																									mod_sysgrupousuario.nome
																								");
                                                                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
																			if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
																				if(trim($rSqlItem['empresa_nome'])=="") {
																					$rSqlItem['empresa_nome'] = "Sem empresa setada - ";
																				} else {
																					$rSqlItem['empresa_nome'] = "".$rSqlItem['empresa_nome']." - ";
																				}
																			} else {
																				$rSqlItem['empresa_nome'] = "";
																			}
																		?>
                                                                        <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['idsysgrupousuario']) { echo "selected"; } ?>><?=$rSqlItem['empresa_nome']?><?=$rSqlItem['nome']?></option>
                                                                        <? } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                        
															<? if(trim($_construtor_sysperm['todos_sysusu'])==1) { ?>
                                                            
                                                            	<?
																if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
																	$filtro_plataforma = "";
																	$filtro_pdv = "";
																} else {
																	$filtro_plataforma = " WHERE plataforma='".$sysusu['empresa']."'";
																	$filtro_pdv = " WHERE empresa='".$sysusu['empresa']."'";
																}
																?>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-2">Empresa Principal</label>
                                                                    <div class="col-md-10">
                                                                        <select name="empresa" id="empresa" class="form-control">
                                                                            <option value="0">---</option>
                                                                            <?
                                                                            $qSqlItem = mysql_query("SELECT * FROM empresa ".$filtro_plataforma." ORDER BY ordem");
                                                                            while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                            ?>
                                                                            <option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['id']==$row['empresa']) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                            <? } ?>
                                                                        </select>
                                                                        <p class="help-block">A empresa selecionada, vai conectar o usuário à conta administradora da empresa em questão cadastrada.</p>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-2">Empresas Relacionadas</label>
                                                                    <div class="col-md-10">
                                                                        <select id="empresas_relacionadas_itens" class="multi-select input-sm" multiple="multiple">
                                                                            <?
                                                                            $qSqlItem = mysql_query("SELECT * FROM empresa ".$filtro_plataforma." ORDER BY nome");
                                                                            while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                                                                            ?>
                                                                            <option value="|<?= $rSqlItem['id'] ?>|" <? if(strrpos($row['empresas_relacionadas'],"|".$rSqlItem['id']."|") === false) { } else { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
                                                                            <? } ?>
                                                                        </select>
                                                                        <input value="<?=$row['empresas_relacionadas']?>" type="hidden" name="empresas_relacionadas" id="empresas_relacionadas" />
                                                                        <p class="help-block">A empresa selecionada, vai conectar o usuário à conta administradora da empresa em questão cadastrada.</p>
                                                                    </div>
                                                                </div>

                                                                
                                                            <? } else { ?>
																<? if(trim($_REQUEST['var3'])=="") { $empresa_set = "".$sysusu['empresa'].""; } else { $empresa_set = "".$row['empresa'].""; } ?>
                                                                <? $rSqlEmpresa = mysql_fetch_array(mysql_query("SELECT * FROM empresa WHERE id='".$empresa_set."' ")); ?>
                                                                <input type="hidden" name="empresa" id="empresa" value="<?=$empresa_set?>" />
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-2">Empresa</label>
                                                                    <div class="col-md-10">
                                                                        <input value="<?=$rSqlEmpresa['nome']?>" type="text" disabled="disabled" class="form-control" />
                                                                    </div>
                                                                </div>
                                                            <? } ?>

                                                            <? if(trim($sysusu['master'])=="1") { ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Master</label>
                                                                <div class="col-md-10">
                                                                    <select name="master" id="master" class="form-control">
                                                                        <option value="">---</option>
                                                                        <option value="0" <? if(trim($row['master'])=="0") { echo " selected"; } ?>>NÃO</option>
                                                                        <option value="1" <? if(trim($row['master'])=="1") { echo " selected"; } ?>>SIM</option>
                                                                    </select>
                                                                    <p class="help-block">Está configuração fornece ao usuário acesso de login master quando for solicitado em alguma operação dentro do sistema, como por exemplo, autorizações de utilização e operação dentro do PDV.</p>
                                                                </div>
                                                            </div>
                                                            <? } ?>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Nome Completo</label>
                                                                <div class="col-md-10">
                                                                    <input value="<?=$row['nome']?>" type="text" name="nome" id="nome" class="form-control" />
                                                                </div>
                                                            </div>
                        
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Gênero</label>
                                                                <div class="col-md-10">
                                                                    <select name="genero" id="genero" class="form-control">
                                                                        <option value="">---</option>
                                                                        <option value="F" <? if(trim($row['genero'])=="F") { echo " selected"; } ?>>Feminino</option>
                                                                        <option value="M" <? if(trim($row['genero'])=="M") { echo " selected"; } ?>>Masculino</option>
                                                                    </select>
                                                                </div>
                                                            </div>

															<? monta_mascara("whatsapp","(99) 99999-9999"); ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">WhatsApp</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-icon">
                                                                        <i class="fab fa-whatsapp"></i>
                                                                        <input value="<?=$row['whatsapp']?>" class="form-control" type="text" 
                                                                         onkeypress="javascript:validarWhats('whatsapp');" onblur="javascript:validarWhats('whatsapp');"
                                                                         name="whatsapp" id="whatsapp" placeholder="Telefone Celular e WhatsApp" />
                                                                    </div>
                                                                    <div id="DIV_whatsapp_valido" style="display:none;color:#777;font-size:11px;margin-top: 5px;"><i style="color:#25D366;" class="fas fa-badge-check"></i>&nbsp;&nbsp;WhatsApp válido</div>
                                                                    <?
                                                                    if(trim($row['whatsapp'])=="") {
                                                                    } else {
                                                                        if(trim($row['whatsapp_valido'])=="1") {
                                                                            $whatsappSet = $row['whatsapp'];
                                                                            $whatsappSet = preg_replace("/[^0-9]/", "", $whatsappSet);
                                                                            $linkWhatsapp = "https://api.whatsapp.com/send?phone=+55".$whatsappSet."&text=Ol%C3%A1!";
                                                                        ?>
                                                                        <a href="<?=$linkWhatsapp?>" target="_blank" style="padding-top:5px;">Iniciar uma conversa</a>
                                                                        <? } ?>
                                                                    <? } ?>
                                                                </div>
                                                            </div>
                                
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">E-mail de Login</label>
                                                                <div class="col-md-4">
                                                                    <input value="<?=$row['email']?>" class="form-control" type="text" name="email" id="email" onblur="javascript:validarEmail('email');" placeholder="Login" />
                                                                    <div id="DIV_email_valido" style="display:none;color:#777;font-size:11px;"><i style="color:#25D366;" class="far fa-check-circle"></i>&nbsp;&nbsp;E-mail informado é válido</div>
                                                                    <div id="DIV_email_invalido" style="display:none;color:#777;font-size:11px;"><i style="color:#e70101;" class="far fa-engine-warning"></i>&nbsp;&nbsp;E-mail informado é inválido</div>
                                                                    <input type="hidden" id="email_valido" value="0">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Senha</label>
                                                                <div class="col-md-8">
                                                                    <div class="input-group">
                                                                        <div class="input-icon">
                                                                            <i class="fa fa-lock fa-fw"></i>
                                                                            <input class="form-control" type="<? if(trim($_REQUEST['var3'])=="") { ?>text<? } else { ?>password<? } ?>"  name="senha" id="senha" placeholder="Senha" value="<? if(trim($row['senha'])=="") { } else { echo $row['senha_conf']; } ?>"/>
                
                                                                            <script>
                                                                            function exibir_caracteres(acaoSend) {
                                                                                if(acaoSend=="exibir")  {
                                                                                    $('#btn_exibir').hide();
                                                                                    $('#btn_ocultar').fadeIn();
                                                                                    $('#senha').attr('type', 'text');
                                                                                } else {
                                                                                    $('#btn_exibir').fadeIn();
                                                                                    $('#btn_ocultar').hide();
                                                                                    $('#senha').attr('type', 'password');
                                                                                }
                                                                            }
                                                                            </script>
                                                                        </div>
                                                                        <span class="input-group-btn">
                                                                            <button class="btn grey-gallery" onclick="gera_senha();" type="button"><i class="fa fa-arrow-left fa-fw"/></i> Gerar Senha</button>
                                                                        </span>
                                                                        <span class="input-group-btn" id="btn_exibir" style="margin-left:3px;">
                                                                            <button class="btn green" onclick="exibir_caracteres('exibir')" style="width:170px;text-align:center;" type="button">exibir caracteres</button>
                                                                        </span>
                                                                        <span class="input-group-btn" id="btn_ocultar" style="margin-left:3px;display:none;">
                                                                            <button class="btn blue" onclick="exibir_caracteres('ocultar')" style="width:170px;text-align:center;" type="button">ocultar caracteres</button>
                                                                        </span>
                                                                    </div>
                                                                    <p class="help-block senha_gerada"></p>
                                                                </div>
                                                            </div>

                                                            <? monta_mascara("cpf","999.999.999-99"); ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">CPF</label>
                                                                <div class="col-md-5">
                                                                    <input class="form-control" value="<?=$row['cpf']?>" name="cpf" id="cpf" type="text" onblur="javascript:validarCpf('cpf');" >
                                                                    <div id="DIV_cpf_valido" style="display:none;color:#777;font-size:11px;"><i style="color:#25D366;" class="far fa-check-circle"></i>&nbsp;&nbsp;CPF informado é válido</div>
                                                                    <div id="DIV_cpf_invalido" style="display:none;color:#777;font-size:11px;"><i style="color:#e70101;" class="far fa-engine-warning"></i>&nbsp;&nbsp;CPF informado é inválido</div>
                                                                    <input type="hidden" id="cpf_valido" value="0">
                                                                </div>
                                                            </div>

															<? monta_mascara("data_de_nascimento","99/99/9999"); ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Data de nascimento</label>
                                                                <div class="col-md-2">
                                                                    <input class="form-control" value="<? if(trim($row['data_de_nascimento'])==""||trim($row['data_de_nascimento'])=="0000-00-00"||trim($row['data_de_nascimento'])=="1999-11-30") { } else { echo ajustaData($row['data_de_nascimento'],"d/m/Y"); } ?>" 
                                                                     onblur="javascript:validarDataDeNascimento('data_de_nascimento');" name="data_de_nascimento" id="data_de_nascimento" type="text">
                                                                    <div id="DIV_data_de_nascimento_valido" style="display:none;color:#777;font-size:11px;"><i style="color:#25D366;" class="far fa-check-circle"></i>&nbsp;&nbsp;Data informada é válida</div>
                                                                    <div id="DIV_data_de_nascimento_invalido" style="display:none;color:#777;font-size:11px;"><i style="color:#e70101;" class="far fa-engine-warning"></i>&nbsp;&nbsp;Data informada é inválida</div>
                                                                    <input type="hidden" id="data_de_nascimento_valido" value="0">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2 req">Ativo ?</label>
                                                                <div class="col-md-10">
                                                                    <div class="radio-list">
                                                                        <label class="radio-inline" style="color:#C00;">
                                                                        <input type="radio" name="stat" id="ativo1" value="0" <? if($row['stat']==0) { echo "checked"; } ?>> não </label>
                                                                        <label class="radio-inline" style="color:#390;">
                                                                        <input type="radio" name="stat" id="ativo2" value="1" <? if(trim($row['stat'])==""||$row['stat']==1) { echo "checked"; } ?>> sim </label>
                                                                    </div>
                                                                </div>
                                                            </div>	
        
                                                        </div>
                                                        <!-- END dados_principais -->
                                                        
                                                        
                                                        <div id="dados-de-contato" class="tab-pane" style="min-height:350px;">

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">E-mail</label>
                                                                <div class="col-md-4">
                                                                    <div class="input-icon">
                                                                        <i class="fa fa-envelope"></i>
                                                                        <input value="<?=$row['email_news']?>" class="form-control" type="text" name="email_news" id="email_news" placeholder="E-mail para contato" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                
                                                            <? monta_mascara("telefone","(99) 9999-9999"); ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Fixo</label>
                                                                <div class="col-md-10">
                                                                    <input value="<?=$row['telefone']?>" type="text" name="telefone" id="telefone" placeholder="Telefone Fixo" class="form-control" />
                                                                </div>
                                                            </div>
                                
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Instagram</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-icon">
                                                                        <i class="fab fa-instagram"></i>
                                                                        <input value="<?=$row['instagram']?>" class="form-control" type="text" name="instagram" id="instagram" placeholder="Perfil do Instagram" />
                                                                    </div>
                                                                    <?
                                                                    if(trim($row['instagram'])=="") {
                                                                    } else {
                                                                        $instagramSet = $row['instagram'];
                                                                        $instagramSet = str_replace("https://www.instagram.com/","",$instagramSet);
                                                                        $instagramSet = str_replace("https://instagram.com/","",$instagramSet);
                                                                        $instagramSet = str_replace("www.instagram.com/","",$instagramSet);
                                                                        $instagramSet = str_replace("instagram.com/","",$instagramSet);
                                                                        $instagramSet = str_replace("@","",$instagramSet);
                                                                    ?>
                                                                    <a href="https://www.instagram.com/<?=$instagramSet?>" target="_blank" style="padding-top:5px;">Acessar perfil</a>
                                                                    <? } ?>
                                                                </div>
                                                            </div>
                                
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Facebook</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-icon">
                                                                        <i class="fab fa-facebook"></i>
                                                                        <input value="<?=$row['facebook']?>" class="form-control" type="text" name="facebook" id="facebook" placeholder="Perfil do Facebook" />
                                                                    </div>
                                                                    <?
                                                                    if(trim($row['facebook'])=="") {
                                                                    } else {
                                                                        $facebookSet = $row['facebook'];
                                                                        $facebookSet = str_replace("https://www.facebook.com/","",$facebookSet);
                                                                        $facebookSet = str_replace("https://facebook.com/","",$facebookSet);
                                                                        $facebookSet = str_replace("www.facebook.com/","",$facebookSet);
                                                                        $facebookSet = str_replace("facebook.com/","",$facebookSet);
                                                                        $facebookSet = str_replace("@","",$facebookSet);
                                                                    ?>
                                                                    <a href="https://www.facebook.com/<?=$facebookSet?>" target="_blank" style="padding-top:5px;">Acessar perfil</a>
                                                                    <? } ?>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- END dados_complementares -->

                                                        <div id="editar-avatar" class="tab-pane" style="min-height:350px;">
                
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Imagem de Perfil</label>
                                                                <div class="col-md-10">
                
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                                            <? if(trim($row['imagem'])=="") { ?>
                                                                            <img src="<?=$link?>templates/<?=$layout_padrao_set?>/templates/img/dummy_150x150.gif" alt=""/>
                                                                            <? } else { ?>
                                                                            <img id="arquivo-atual-imagem" src="<?=$link?>files/<?=$mod?>/<?=$row['numeroUnico']?>/<?=$row['imagem']?>" alt="">
                                                                            <? } ?>
                                                                        </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;"></div>
            
                                                                        <? if(trim($row['imagem'])=="") { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Selecionar arquivo </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="imagem">
                                                                            </span>
                                                                            <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } else { ?>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Alterar </span>
                                                                                <span class="fileinput-exists"> Alterar </span>
                                                                                <input type="file" name="imagem">
                                                                            </span>
                                                                            <a href="javascript:void(0);" onclick="remover_imagem('<?=$row['id']?>','<?=$mod?>','imagem');" class="btn red fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                                        </div>
                                                                        <? } ?>
                                                                    </div>
                                                                    <div class="clearfix margin-top-10">
                                                                        <span class="label label-warning"> ATENÇÃO! </span>
                                                                        &nbsp;&nbsp;Pré-visualização da imagem só funciona nos seguintes navegadores: IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+.
                                                                    </div>
                
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END editar_avatar -->

                                                        <div id="endereco" class="tab-pane" style="min-height:350px;">

                                                            <? monta_mascara("cep","99999-999"); ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">CEP</label>
                                                                <div class="col-md-6">
                                                                    <div class="form-inline">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <input value="<?=$row['cep']?>" class="form-control" style="width:110px;" type="text" id="cep" name="cep" />
                                                                            <col-md- class="help-block">99999-999</col-md->
                                                                        </div>
                                                                        <div class="form-group" style="border:0px;">
                                                                            <button type="button" onclick="buscaCepTxt();" style="margin-top:-27px;" class="btn grey-gallery">Carregar endereço</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Rua</label>
                                                                <div class="col-md-10">
                                                                    <input value="<?=$row['rua']?>" class="form-control" type="text" id="rua" name="rua" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Número</label>
                                                                <div class="col-md-10">
                                                                    <input value="<?=$row['numero']?>" class="form-control" type="text" id="numero" name="numero" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Complemento</label>
                                                                <div class="col-md-10">
                                                                    <input value="<?=$row['complemento']?>" class="form-control" type="text" id="complemento" name="complemento" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Bairro</label>
                                                                <div class="col-md-10">
                                                                    <input value="<?=$row['bairro']?>" class="form-control" type="text" id="bairro" name="bairro" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Cidade</label>
                                                                <div class="col-md-10">
                                                                    <input value="<?=$row['cidade']?>" class="form-control" type="text" id="cidade" name="cidade" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Estado</label>
                                                                <div class="col-md-10">
                                                                    <input value="<?=$row['estado']?>" class="form-control" type="text" id="estado" name="estado" />
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- END endereco -->

                                                        <div id="dashboard" class="tab-pane" style="min-height:350px;">

                                                            <div class="horizontal-form" style="border:0px;">
                                                                <div class="form-body" style="border:0px;">

                                                                    <div class="form-group">
                                                                        <div class="col-md-1" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Ordem</label>
                                                                                <select id="dashboard_ordem" class="form-control">
                                                                                    <option value="">---</option>
                                                                                    <?
                                                                                    $nSql = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sysdashboard WHERE idsysusu='".$row['id']."' "));
                                                                                    if($nSql[0]==0) {
                                                                                    ?>
                                                                                    <option value='1'>1</option>
                                                                                    <?
                                                                                    } else {
                                                                                        if(trim($tipo_form_set)=="add") {
                                                                                            $ultimaOrdem = $nSql[0] + 1;
                                                                                        } else {
                                                                                            $ultimaOrdem = $nSql[0];
                                                                                        }
                                                                                        for ($b=1; $b<=$ultimaOrdem; $b++) {
                                                                                    ?>
                                                                                        <option value='<?=$b?>' <? if($b==$row['ordem']) { echo "selected"; } ?>><?=$b?></option>
                                                                                        <? } ?>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Título do Bloco</label>
                                                                                <input value="" type="text" id="dashboard_nome" placeholder="" class="form-control" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-5" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Subtítulo do Bloco</label>
                                                                                <input value="" type="text" id="dashboard_subtitulo" placeholder="" class="form-control" />
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="col-md-12" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Módulo do Bloco</label>
                                                                                <select id="dashboard_modulo_do_bloco" class="form-control">
                                                                                    <option value="">---</option>
                                                                                    <option value="resumo_financeiro_mes_atual" <? if(trim($row['modulo_do_bloco'])=="resumo_financeiro_mes_atual") { echo " selected"; } ?>>Resumo Financeiro do mês atual</option>
                                                                                    <option value="resumo_financeiro_total" <? if(trim($row['modulo_do_bloco'])=="resumo_financeiro_total") { echo " selected"; } ?>>Resumo Financeiro Total</option>
                                                                                    <option value="agenda_do_google" <? if(trim($row['modulo_do_bloco'])=="agenda_do_google") { echo " selected"; } ?>>Agenda do Google</option>
                                            
                                                                                    <? if(trim($_construtor_sysperm['visualizar_TRvGFS9gJzCgikXBxXLQJdAzqbs9bq'])==1) { ?>
                                                                                    <option value="resumo_notificacao_por_evento" <? if(trim($row['modulo_do_bloco'])=="resumo_notificacao_por_evento") { echo " selected"; } ?>>Resumo de Notificações por Evento</option>
                                            
                                                                                    <option value="cadastrados_por_mapa" <? if(trim($row['modulo_do_bloco'])=="cadastrados_por_mapa") { echo " selected"; } ?>>Cadastrados por Mapa</option>
                                                                                    <option value="cadastros_por_faixa_etaria_tabela" <? if(trim($row['modulo_do_bloco'])=="cadastros_por_faixa_etaria_tabela") { echo " selected"; } ?>>Tabela de Cadastrados por Faixa Etária</option>
                                                                                    <option value="cadastros_por_idade_tabela" <? if(trim($row['modulo_do_bloco'])=="cadastros_por_idade_tabela") { echo " selected"; } ?>>Tabela de Cadastrados por Idade</option>
                                            
                                                                                    <option value="vacinados_por_periodo_tabela" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_periodo_tabela") { echo " selected"; } ?>>Tabela de Vacinados por Período</option>
                                                                                    <option value="vacinados_por_grupo_tabela" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_grupo_tabela") { echo " selected"; } ?>>Tabela de Vacinados por Grupo</option>
                                                                                    <option value="vacinados_por_faixa_etaria_tabela" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_faixa_etaria_tabela") { echo " selected"; } ?>>Tabela de Vacinados por Faixa Etária</option>
                                                                                    <option value="vacinados_por_idade_tabela" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_idade_tabela") { echo " selected"; } ?>>Tabela de Vacinados por Idade</option>
                                            
                                                                                    <option value="vacinados_por_periodo" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_periodo") { echo " selected"; } ?>>Gráfico de Vacinados por Período</option>
                                                                                    <option value="vacinados_por_grupo" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_grupo") { echo " selected"; } ?>>Gráfico de Vacinados por Grupo</option>
                                                                                    <option value="vacinados_por_faixa_etaria" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_faixa_etaria") { echo " selected"; } ?>>Gráfico de Vacinados por Faixa Etária</option>
                                                                                    <option value="vacinados_por_mapa" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_mapa") { echo " selected"; } ?>>Vacinados por Mapa</option>
                                                                                    <option value="vacinados_por_mapa_de_calor" <? if(trim($row['modulo_do_bloco'])=="vacinados_por_mapa_de_calor") { echo " selected"; } ?>>Vacinados por Mapa de Calor</option>
                                                                                    <option value="vacinador_por_mapa" <? if(trim($row['modulo_do_bloco'])=="vacinador_por_mapa") { echo " selected"; } ?>>Vacinados por Local de Vacinação</option>
                                                                                    <? } ?>
                                            
                                                                                    <? if(trim($_construtor_sysperm['visualizar_agenda_de_treinos'])==1) { ?>
                                                                                    <option value="agenda_de_treinos" <? if(trim($row['modulo_do_bloco'])=="agenda_de_treinos") { echo " selected"; } ?>>Tabela com Solicitações de Agenda de Treino</option>
                                                                                    <? } ?>
                                                                                    
                                                                                    <? if(trim($_construtor_sysperm['visualizar_treinos'])==1) { ?>
                                                                                    <option value="treinos_expirando" <? if(trim($row['modulo_do_bloco'])=="treinos_expirando") { echo " selected"; } ?>>Tabela com Treinos Expirando</option>
                                                                                    <? } ?>
                                                                                    
                                                                                    <option value="agenda_unificada" <? if(trim($row['modulo_do_bloco'])=="agenda_unificada") { echo " selected"; } ?>>Agenda Unificada de Compromissos</option>
                                                                                    
                                                                                    <? if(trim($_construtor_sysperm['visualizar_carrinhos_de_compras'])==1) { ?>
                                                                                    <option value="acompanhamento_de_carrinho_de_compras" <? if(trim($row['modulo_do_bloco'])=="acompanhamento_de_carrinho_de_compras") { echo " selected"; } ?>>Acompanhamento de Carrinho de Compras</option>
                                                                                    <? } ?>
                                                                                    
                                                                                    <? if(trim($_construtor_sysperm['visualizar_vendas'])==1) { ?>
                                                                                    <option value="acompanhamento_de_vendas_comercial" <? if(trim($row['modulo_do_bloco'])=="acompanhamento_de_vendas_comercial") { echo " selected"; } ?>>Acompanhamento de Vendas do Comercial</option>
                                                                                    <? } ?>
                                                                                    
                                                                                    <? if(trim($_construtor_sysperm['visualizar_compras'])==1) { ?>
                                                                                    <option value="acompanhamento_de_compras_comercial" <? if(trim($row['modulo_do_bloco'])=="acompanhamento_de_compras_comercial") { echo " selected"; } ?>>Acompanhamento de Compras do Comercial</option>
                                                                                    <? } ?>
                                                                                    
                                                                                    <? if(trim($_construtor_sysperm['visualizar_contas_a_pagar'])==1) { ?>
                                                                                    <option value="acompanhamento_de_contas_a_pagar" <? if(trim($row['modulo_do_bloco'])=="acompanhamento_de_contas_a_pagar") { echo " selected"; } ?>>Acompanhamento de Contas à Pagar</option>
                                                                                    <? } ?>
                                                                                    
                                                                                    <? if(trim($_construtor_sysperm['visualizar_contas_a_receber'])==1) { ?>
                                                                                    <option value="acompanhamento_de_contas_a_receber" <? if(trim($row['modulo_do_bloco'])=="acompanhamento_de_contas_a_receber") { echo " selected"; } ?>>Acompanhamento de Contas à Receber</option>
                                                                                    <? } ?>
                                                                                    
                                                                                    <? if(trim($_construtor_sysperm['visualizar_editar'])==1) { ?>
                                                                                    <option value="agenda_de_eventos" <? if(trim($row['modulo_do_bloco'])=="agenda_de_eventos") { echo " selected"; } ?>>Agenda de Eventos</option>
                                                                                    <? } ?>
                                                                                    
                                                                                    <? if(trim($_construtor_sysperm['visualizar_wYZyxbB0w96D3Zxc91A70xy20Z74ZY'])==1) { ?>
                                                                                    <option value="acompanhamento_de_vendas_de_evento" <? if(trim($row['modulo_do_bloco'])=="acompanhamento_de_vendas_de_evento") { echo " selected"; } ?>>Acompanhamento de Vendas de Evento</option>
                                                                                    <? } ?>
                                                                                    
                                                                                    <? if(trim($_construtor_sysperm['visualizar_agenda_de_recursos'])==1) { ?>
                                                                                    <option value="agenda_de_recursos" <? if(trim($row['modulo_do_bloco'])=="agenda_de_recursos") { echo " selected"; } ?>>Agenda de Recursos</option>
                                                                                    <? } ?>
                                                                                    
                                                                                    <? if(trim($_construtor_sysperm['visualizar_pessoas'])==1) { ?>
                                                                                    <option value="acompanhamento_de_pessoas" <? if(trim($row['modulo_do_bloco'])=="acompanhamento_de_pessoas") { echo " selected"; } ?>>Acompanhamento de Cadastro de Pessoas</option>
                                                                                    <? } ?>
                                                                                    
                                                                                    <? if(trim($_construtor_sysperm['visualizar_todas'])==1) { ?>
                                                                                    <option value="acompanhamento_de_solicitacoes" <? if(trim($row['modulo_do_bloco'])=="acompanhamento_de_solicitacoes") { echo " selected"; } ?>>Acompanhamento de Solicitações</option>
                                                                                    <? } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="col-md-4" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Tamanho do Bloco</label>
                                                                                <select id="dashboard_tamanho_do_bloco" class="form-control">
                                                                                    <option value="">---</option>
                                                                                    <option value='col-md-1'>10%</option>
                                                                                    <option value='col-md-2'>15%</option>
                                                                                    <option value='col-md-3'>25%</option>
                                                                                    <option value='col-md-4'>35%</option>
                                                                                    <option value='col-md-5'>40%</option>
                                                                                    <option value='col-md-6'>50%</option>
                                                                                    <option value='col-md-7'>60%</option>
                                                                                    <option value='col-md-8'>65%</option>
                                                                                    <option value='col-md-9'>75%</option>
                                                                                    <option value='col-md-10'>85%</option>
                                                                                    <option value='col-md-11'>90%</option>
                                                                                    <option value='col-md-12'>100%</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Quantidade de Items à Exibir</label>
                                                                                <input value="" type="number" id="dashboard_qtd" placeholder="" class="form-control" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Ordenação da Exibição</label>
                                                                                <select id="dashboard_ordenacao" class="form-control">
                                                                                    <option value="">---</option>
                                                                                    <option value="randomica">Ordenação randômica (mostra elementos randomicamente)</option>
                                                                                    <option value="alfabetica_asc">Ordenação alfabética de A para Z</option>
                                                                                    <option value="alfabetica_desc">Ordenação alfabética de Z para A</option>
                                                                                    <option value="data_asc">Data de inserção as mais novas antes</option>
                                                                                    <option value="data_desc">Data de inserção as mais antigas antes</option>
                                                                                    <option value="ordem_asc">Pelo campo ordem de menor para o maior ( 1 para 10)</option>
                                                                                    <option value="ordem_desc">Pelo campo ordem de maior para o menor ( 10 para 1)</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-2" style="border:0px;">
                                                                            <div class="form-group" style="border:0px;">
                                                                                <label class="control-label">Status</label>
                                                                                <select id="dashboard_stat" class="form-control">
                                                                                    <option value="1">ATIVO</option>
                                                                                    <option value="0">INATIVO</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group" style="border:0px;">
                                                                        <div class="col-md-2" style="border:0px;">
                                                                            <div class="form-inline">
                                                                                <div class="form-group" style="border:0px;">
                                                                                    <button type="button" onclick="dashboard_add();" class="btn blue"><i class="fa fa-plus"></i> Adicionar</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group" id="dashboard-lista" style="padding:10px;">
																		<? 
																		include("./templates/".$layout_padrao_set."/acoes/personal/dashboard-lista.php"); ?>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- END horizontal-form BANCOS -->

                                                        </div>
                                                        <!-- END dashboard -->

                                                    </div>
    
                                                </div>
                                                <!-- END form-body -->
    
                                                <div style="border:0px;position:fixed;bottom:35px;background-color:#f6f6f6;padding:10px;">
													<? if(trim($_construtor_sysperm['editar_'.$mod.''])==1) { ?>
                                                    <button type="submit" style="margin-left:20px;" class="btn green-turquoise btn_salvar"><i class="fa fa-floppy-o"></i> Salvar</button>
                                                    <button type="button" onclick="salvar_continuar_editando('<? if(trim($_REQUEST['var3'])=="") { echo "add-continuar"; } else { echo "editar-continuar"; } ?>');" class="btn green-seagreen"><i class="fa fa-check"></i> Salvar e Continuar Editando</button>
                                                    <? } ?>
                                                    <button type="button" onclick="btn_cancelar();" class="btn yellow-casablanca btn-cancelar"><i class="fa fa-minus-circle"></i> Cancelar</button>
                                                </div>

                                                </form>
                                                
        
                                            </div>
                                            </div>
    
                                        </div>
                                        <!-- END COL-10-->

                                     </div>
                                     <!-- END ROW-->
                                        
                                </div>
                                <!-- END TAB_FORM-->
                                <? } ?>

                                <? if(trim($_REQUEST['var3'])=="permissoes") { ?>
                                <div class="tab-pane <? if(trim($_REQUEST['var3'])=="permissoes") { ?> active<? } ?>" id="permissoes">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <ul class="ver-inline-menu tabbable margin-bottom-10">
                                                <li onclick="seta_aba('sistema');" class="active"><a data-toggle="tab" href="#sistema"><i class="fa fa-caret-right"></i> Sistema</a> <span class="after"></span></li>
												<?
												$qSqlCat = mysql_query("SELECT id,numeroUnico,nome FROM _construtor_modulo_categoria WHERE stat='1' ORDER BY ordem");
												while($rSqlCat = mysql_fetch_array($qSqlCat)) {
													$rDataCat[] = $rSqlCat;
                                                ?>
                                                <li onclick="seta_aba('<?=$rSqlCat['url_amigavel']?>');"><a data-toggle="tab" href="#<?=$rSqlCat['url_amigavel']?>"><i class="fa fa-caret-right"></i> <?=$rSqlCat['nome']?></a></li>
                                                <? } ?>
                                            </ul>
                                        </div>

                                        <div class="col-md-10">
                                                <form name="forms" method="post" action="<?=$link?><?=$chave_url?><?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/" target="_self" ENCTYPE="multipart/form-data"id="formulario" class="form-horizontal form-bordered form-row-stripped">
                                                <div class="form-body">
                                                        <input type="hidden" name="aba" id="aba" value="sistema" />
                                                        
                                                        <input type="hidden" name="subMod" value="" />

                                                        <input type="hidden" name="acaoLocal" value="interno" />
                                                        <input type="hidden" name="acaoForm" id="idacaoForm" value="permissoes" />
                                                        <input type="hidden" name="modulo" value="<?=$mod?>" />

                                                        <input type="hidden" name="numeroUnico" id="numeroUnico" value="<?=$numeroUnicoGerado?>">
                                                        <input type="hidden" name="idsysusu" value="<?=$_REQUEST['var4']?>" />

                                                    <div class="tab-content">
    
                                                        <div id="sistema" class="tab-pane active" style="min-height:350px;">
                            
                                                            <h3 class="form-section" style="padding:0px;margin-top:0px;">Configurações Gerais</h3>

                                                            <div class="form-group" style="margin-left:0px;margin-right:0px;">
                                                                <div class="col-md-12" style="border:0px;padding:0px;">
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Visualizar Dashboard</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="visualizar_dashboard" id="visualizar_dashboard" <? if(trim($row_setado['visualizar_dashboard'])==1) { echo " checked"; } ?>  class="make-switch"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                </div>
                                                            </div>
                                                            <!-- END FORM-GROUP Módulo de Banco de Mídia -->

                                                            <h3 class="form-section" style="padding:0px;margin-top:0px;">Módulo de Usuários</h3>

                                                            <div class="form-group" style="margin-left:0px;margin-right:0px;">
                                                                <div class="col-md-12" style="border:0px;padding:0px;">

																	<script type='text/javascript'>
                                                                    $(window).load(function(){
                                                                    
                                                                        $('#sell_sysusu').on('switchChange.bootstrapSwitch', function (event, state) {
                                                                            if(state===true){
                                                                                $(".item_sysusu").prop("checked", true).change();
                                                                            } else {
                                                                                $(".item_sysusu").prop("checked", false).change();
                                                                            }
                                                                        });
                                                                    
                                                                    });
                                                                    </script>
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Selecionar Todos</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input 
																				<? 
                                                                                if(
                                                                                  trim($row_setado['todos_sysusu'])==1
                                                                                &&trim($row_setado['visualizar_sysusu'])==1
                                                                                &&trim($row_setado['inserir_sysusu'])==1
                                                                                &&trim($row_setado['editar_sysusu'])==1
                                                                                &&trim($row_setado['excluir_sysusu'])==1
                                                                                &&trim($row_setado['publicar_sysusu'])==1
                                                                                &&trim($row_setado['despublicar_sysusu'])==1
                                                                                &&trim($row_setado['lixeira_sysusu'])==1
                                                                                &&trim($row_setado['restaurar_sysusu'])==1
                                                                                &&trim($row_setado['senha_sysusu'])==1
                                                                                &&trim($row_setado['dados_sysusu'])==1
                                                                                &&trim($row_setado['configuracao_sysusu'])==1
                                                                                &&trim($row_setado['chat_sysusu'])==1
                                                                                ) { echo " checked"; } ?> 
                                                                                type="checkbox" id="sell_sysusu" <? if(trim($row_setado['sell_sysusu'])==1) { echo " checked"; } ?> class="make-switch"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="SIM" data-off-text="NÃO">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Administrador</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="todos_sysusu" id="todos_sysusu" <? if(trim($row_setado['todos_sysusu'])==1) { echo " checked"; } ?>  class="make-switch item_sysusu"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Visualizar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="visualizar_sysusu" id="visualizar_sysusu" <? if(trim($row_setado['visualizar_sysusu'])==1) { echo " checked"; } ?>  class="make-switch item_sysusu"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Inserir</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="inserir_sysusu" id="inserir_sysusu" <? if(trim($row_setado['inserir_sysusu'])==1) { echo " checked"; } ?>  class="make-switch item_sysusu"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Editar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="editar_sysusu" id="editar_sysusu" <? if(trim($row_setado['editar_sysusu'])==1) { echo " checked"; } ?>  class="make-switch item_sysusu"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Excluir</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="excluir_sysusu" id="excluir_sysusu" <? if(trim($row_setado['excluir_sysusu'])==1) { echo " checked"; } ?>  class="make-switch item_sysusu"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Publicar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="publicar_sysusu" id="publicar_sysusu" <? if(trim($row_setado['publicar_sysusu'])==1) { echo " checked"; } ?>  class="make-switch item_sysusu"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Despublicar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="despublicar_sysusu" id="despublicar_sysusu" <? if(trim($row_setado['despublicar_sysusu'])==1) { echo " checked"; } ?>  class="make-switch item_sysusu"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>

                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Enviar para Lixeira</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="lixeira_sysusu" id="lixeira_sysusu" <? if(trim($row_setado['lixeira_sysusu'])==1) { echo " checked"; } ?>  class="make-switch item_sysusu"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Restaurar da Lixeira</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="restaurar_sysusu" id="restaurar_sysusu" <? if(trim($row_setado['restaurar_sysusu'])==1) { echo " checked"; } ?>  class="make-switch item_sysusu"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Alterar Senha</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="senha_sysusu" id="senha_sysusu" <? if(trim($row_setado['senha_sysusu'])==1) { echo " checked"; } ?>  class="make-switch item_sysusu"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Alterar Dados</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="dados_sysusu" id="dados_sysusu" <? if(trim($row_setado['dados_sysusu'])==1) { echo " checked"; } ?>  class="make-switch item_sysusu"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Alterar Configurações</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="configuracao_sysusu" id="configuracao_sysusu" <? if(trim($row_setado['configuracao_sysusu'])==1) { echo " checked"; } ?>  class="make-switch item_sysusu"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Chat</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                            <input type="checkbox" name="chat_sysusu" id="chat_sysusu" <? if(trim($row_setado['chat_sysusu'])==1) { echo " checked"; } ?>  class="make-switch item_sysusu"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!-- END FORM-GROUP Módulo de Usuários -->

                                                            <h3 class="form-section" style="padding:0px;margin-top:0px;">Módulo de Grupo de Usuários</h3>

                                                            <div class="form-group" style="margin-left:0px;margin-right:0px;">
                                                                <div class="col-md-12" style="border:0px;padding:0px;">

																	<script type='text/javascript'>
                                                                    $(window).load(function(){
                                                                    
                                                                        $('#sell_sysgrupousuario').on('switchChange.bootstrapSwitch', function (event, state) {
                                                                            if(state===true){
                                                                                $(".item_sysgrupousuario").prop("checked", true).change();
                                                                            } else {
                                                                                $(".item_sysgrupousuario").prop("checked", false).change();
                                                                            }
                                                                        });
                                                                    
                                                                    });
                                                                    </script>
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Selecionar Todos</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input 
																				<? 
                                                                                if(
                                                                                  trim($row_setado['visualizar_sysgrupousuario'])==1
                                                                                &&trim($row_setado['inserir_sysgrupousuario'])==1
                                                                                &&trim($row_setado['editar_sysgrupousuario'])==1
                                                                                &&trim($row_setado['excluir_sysgrupousuario'])==1
                                                                                &&trim($row_setado['publicar_sysgrupousuario'])==1
                                                                                &&trim($row_setado['despublicar_sysgrupousuario'])==1
                                                                                &&trim($row_setado['lixeira_sysgrupousuario'])==1
                                                                                &&trim($row_setado['restaurar_sysgrupousuario'])==1
                                                                                ) { echo " checked"; } ?> 
                                                                                type="checkbox" id="sell_sysgrupousuario"  class="make-switch"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="SIM" data-off-text="NÃO">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Visualizar</label>
                                                                            <div class="col-md-12" style="border:0px;">

                                                                                <input type="checkbox" name="visualizar_sysgrupousuario" id="visualizar_sysgrupousuario" <? if(trim($row_setado['visualizar_sysgrupousuario'])==1) { echo " checked"; } ?>  class="make-switch item_sysgrupousuario"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Inserir</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="inserir_sysgrupousuario" id="inserir_sysgrupousuario" <? if(trim($row_setado['inserir_sysgrupousuario'])==1) { echo " checked"; } ?>  class="make-switch item_sysgrupousuario"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Editar</label>

                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="editar_sysgrupousuario" id="editar_sysgrupousuario" <? if(trim($row_setado['editar_sysgrupousuario'])==1) { echo " checked"; } ?>  class="make-switch item_sysgrupousuario"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Excluir</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="excluir_sysgrupousuario" id="excluir_sysgrupousuario" <? if(trim($row_setado['excluir_sysgrupousuario'])==1) { echo " checked"; } ?>  class="make-switch item_sysgrupousuario"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Publicar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="publicar_sysgrupousuario" id="publicar_sysgrupousuario" <? if(trim($row_setado['publicar_sysgrupousuario'])==1) { echo " checked"; } ?>  class="make-switch item_sysgrupousuario"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Despublicar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="despublicar_sysgrupousuario" id="despublicar_sysgrupousuario" <? if(trim($row_setado['despublicar_sysgrupousuario'])==1) { echo " checked"; } ?>  class="make-switch item_sysgrupousuario"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Enviar para Lixeira</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="lixeira_sysgrupousuario" id="lixeira_sysgrupousuario" <? if(trim($row_setado['lixeira_sysgrupousuario'])==1) { echo " checked"; } ?>  class="make-switch item_sysgrupousuario"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Restaurar da Lixeira</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="restaurar_sysgrupousuario" id="restaurar_sysgrupousuario" <? if(trim($row_setado['restaurar_sysgrupousuario'])==1) { echo " checked"; } ?>  class="make-switch item_sysgrupousuario"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                </div>
                                                            </div>
                                                            <!-- END FORM-GROUP Módulo de Grupo de Usuários -->

                                                            <h3 class="form-section" style="padding:0px;margin-top:0px;">Módulo de Permissões</h3>

                                                            <div class="form-group" style="margin-left:0px;margin-right:0px;">
                                                                <div class="col-md-12" style="border:0px;padding:0px;">

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Visualizar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="visualizar_construtor_sysperm" id="visualizar_construtor_sysperm" <? if(trim($row_setado['visualizar_construtor_sysperm'])==1) { echo " checked"; } ?>  class="make-switch"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Editar</label>

                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="editar_construtor_sysperm" id="editar_construtor_sysperm" <? if(trim($row_setado['editar_construtor_sysperm'])==1) { echo " checked"; } ?>  class="make-switch"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                </div>
                                                            </div>
                                                            <!-- END FORM-GROUP Módulo de Permissões -->

                                                            <h3 class="form-section" style="padding:0px;margin-top:0px;">Módulo de Histórico de Acessos</h3>

                                                            <div class="form-group" style="margin-left:0px;margin-right:0px;">
                                                                <div class="col-md-12" style="border:0px;padding:0px;">

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Visualizar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="visualizar_sysacesso" id="visualizar_sysacesso" <? if(trim($row_setado['visualizar_sysacesso'])==1) { echo " checked"; } ?>  class="make-switch"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Visualizar como Admin</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="admin_sysacesso" id="admin_sysacesso" <? if(trim($row_setado['admin_sysacesso'])==1) { echo " checked"; } ?>  class="make-switch"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                </div>
                                                            </div>
                                                            <!-- END FORM-GROUP Módulo de Histórico de Acessos -->
        
                                                            <h3 class="form-section" style="padding:0px;margin-top:0px;">Módulo de Histórico de Operações</h3>

                                                            <div class="form-group" style="margin-left:0px;margin-right:0px;">
                                                                <div class="col-md-12" style="border:0px;padding:0px;">
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Visualizar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="visualizar_syslog" id="visualizar_syslog" <? if(trim($row_setado['visualizar_syslog'])==1) { echo " checked"; } ?>  class="make-switch"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Visualizar como Admin</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="admin_syslog" id="admin_syslog" <? if(trim($row_setado['admin_syslog'])==1) { echo " checked"; } ?>  class="make-switch"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                </div>
                                                            </div>
                                                            <!-- END FORM-GROUP Módulo de Histórico de Operações -->

                                                            <h3 class="form-section" style="padding:0px;margin-top:0px;">Módulo de Banco de Mídia</h3>

                                                            <div class="form-group" style="margin-left:0px;margin-right:0px;">
                                                                <div class="col-md-12" style="border:0px;padding:0px;">
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Visualizar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="visualizar_sysmidia" id="visualizar_sysmidia" <? if(trim($row_setado['visualizar_sysmidia'])==1) { echo " checked"; } ?>  class="make-switch"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                </div>
                                                            </div>
                                                            <!-- END FORM-GROUP Módulo de Banco de Mídia -->

                                                            <h3 class="form-section" style="padding:0px;margin-top:0px;">Módulo de Suporte</h3>

                                                            <div class="form-group" style="margin-left:0px;margin-right:0px;">
                                                                <div class="col-md-12" style="border:0px;padding:0px;">

																	<script type='text/javascript'>
                                                                    $(window).load(function(){
                                                                    
                                                                        $('#sell_syschamado').on('switchChange.bootstrapSwitch', function (event, state) {
                                                                            if(state===true){
                                                                                $(".item_syschamado").prop("checked", true).change();
                                                                            } else {
                                                                                $(".item_syschamado").prop("checked", false).change();
                                                                            }
                                                                        });
                                                                    
                                                                    });
                                                                    </script>
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Selecionar Todos</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input 
																				<? 
                                                                                if(
                                                                                  trim($row_setado['visualizar_syschamado'])==1
                                                                                &&trim($row_setado['inserir_syschamado'])==1
                                                                                &&trim($row_setado['editar_syschamado'])==1
                                                                                &&trim($row_setado['excluir_syschamado'])==1
                                                                                &&trim($row_setado['publicar_syschamado'])==1
                                                                                &&trim($row_setado['despublicar_syschamado'])==1
                                                                                &&trim($row_setado['lista_syschamado'])==1
                                                                                &&trim($row_setado['atendente_syschamado'])==1
                                                                                ) { echo " checked"; } ?> 
                                                                                type="checkbox" id="sell_syschamado"  class="make-switch"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="SIM" data-off-text="NÃO">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Visualizar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="visualizar_syschamado" id="visualizar_syschamado" <? if(trim($row_setado['visualizar_syschamado'])==1) { echo " checked"; } ?>  class="make-switch item_syschamado"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Inserir</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="inserir_syschamado" id="inserir_syschamado" <? if(trim($row_setado['inserir_syschamado'])==1) { echo " checked"; } ?>  class="make-switch item_syschamado"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Editar</label>

                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="editar_syschamado" id="editar_syschamado" <? if(trim($row_setado['editar_syschamado'])==1) { echo " checked"; } ?>  class="make-switch item_syschamado"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Excluir</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="excluir_syschamado" id="excluir_syschamado" <? if(trim($row_setado['excluir_syschamado'])==1) { echo " checked"; } ?>  class="make-switch item_syschamado"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Publicar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="publicar_syschamado" id="publicar_syschamado" <? if(trim($row_setado['publicar_syschamado'])==1) { echo " checked"; } ?>  class="make-switch item_syschamado"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Despublicar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="despublicar_syschamado" id="despublicar_syschamado" <? if(trim($row_setado['despublicar_syschamado'])==1) { echo " checked"; } ?>  class="make-switch item_syschamado"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Criação de Setores</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="lista_syschamado" id="lista_syschamado" <? if(trim($row_setado['lista_syschamado'])==1) { echo " checked"; } ?>  class="make-switch item_syschamado"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Atendimento Suporte</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="atendente_syschamado" id="atendente_syschamado" <? if(trim($row_setado['atendente_syschamado'])==1) { echo " checked"; } ?>  class="make-switch item_syschamado"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                </div>
                                                            </div>
                                                            <!-- END FORM-GROUP Módulo de Suporte -->

                                                            <h3 class="form-section" style="padding:0px;margin-top:0px;">Módulo de Construtor de Módulos</h3>

                                                            <div class="form-group" style="margin-left:0px;margin-right:0px;">
                                                                <div class="col-md-12" style="border:0px;padding:0px;">

																	<script type='text/javascript'>
                                                                    $(window).load(function(){
                                                                    
                                                                        $('#sell_construtor_modulo').on('switchChange.bootstrapSwitch', function (event, state) {
                                                                            if(state===true){
                                                                                $(".item_construtor_modulo").prop("checked", true).change();
                                                                            } else {
                                                                                $(".item_construtor_modulo").prop("checked", false).change();
                                                                            }
                                                                        });
                                                                    
                                                                    });
                                                                    </script>
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Selecionar Todos</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input 
																				<? 
                                                                                if(
                                                                                  trim($row_setado['visualizar_construtor_modulo'])==1
                                                                                &&trim($row_setado['inserir_construtor_modulo'])==1
                                                                                &&trim($row_setado['editar_construtor_modulo'])==1
                                                                                &&trim($row_setado['excluir_construtor_modulo'])==1
                                                                                &&trim($row_setado['publicar_construtor_modulo'])==1
                                                                                &&trim($row_setado['despublicar_construtor_modulo'])==1
                                                                                ) { echo " checked"; } ?> 
                                                                                type="checkbox" id="sell_construtor_modulo"  class="make-switch"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="SIM" data-off-text="NÃO">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Visualizar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="visualizar_construtor_modulo" id="visualizar_construtor_modulo" <? if(trim($row_setado['visualizar_construtor_modulo'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Inserir</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="inserir_construtor_modulo" id="inserir_construtor_modulo" <? if(trim($row_setado['inserir_construtor_modulo'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Editar</label>

                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="editar_construtor_modulo" id="editar_construtor_modulo" <? if(trim($row_setado['editar_construtor_modulo'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Excluir</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="excluir_construtor_modulo" id="excluir_construtor_modulo" <? if(trim($row_setado['excluir_construtor_modulo'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Publicar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="publicar_construtor_modulo" id="publicar_construtor_modulo" <? if(trim($row_setado['publicar_construtor_modulo'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Despublicar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="despublicar_construtor_modulo" id="despublicar_construtor_modulo" <? if(trim($row_setado['despublicar_construtor_modulo'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                </div>
                                                            </div>
                                                            <!-- END FORM-GROUP Módulo de Construtor de Módulos -->


                                                            <h3 class="form-section" style="padding:0px;margin-top:0px;">Módulo de Construtor Campos dos Módulos</h3>

                                                            <div class="form-group" style="margin-left:0px;margin-right:0px;">
                                                                <div class="col-md-12" style="border:0px;padding:0px;">

																	<script type='text/javascript'>
                                                                    $(window).load(function(){
                                                                    
                                                                        $('#sell_construtor_modulo_campo').on('switchChange.bootstrapSwitch', function (event, state) {
                                                                            if(state===true){
                                                                                $(".item_construtor_modulo_campo").prop("checked", true).change();
                                                                            } else {
                                                                                $(".item_construtor_modulo_campo").prop("checked", false).change();
                                                                            }
                                                                        });
                                                                    
                                                                    });
                                                                    </script>
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Selecionar Todos</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input 
																				<? 
                                                                                if(
                                                                                  trim($row_setado['visualizar_construtor_modulo_campo'])==1
                                                                                &&trim($row_setado['inserir_construtor_modulo_campo'])==1
                                                                                &&trim($row_setado['editar_construtor_modulo_campo'])==1
                                                                                &&trim($row_setado['excluir_construtor_modulo_campo'])==1
                                                                                &&trim($row_setado['publicar_construtor_modulo_campo'])==1
                                                                                &&trim($row_setado['despublicar_construtor_modulo_campo'])==1
                                                                                ) { echo " checked"; } ?> 
                                                                                type="checkbox" id="sell_construtor_modulo_campo"  class="make-switch"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="SIM" data-off-text="NÃO">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Visualizar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="visualizar_construtor_modulo_campo" id="visualizar_construtor_modulo_campo" <? if(trim($row_setado['visualizar_construtor_modulo_campo'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo_campo"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Inserir</label>
                                                                            <div class="col-md-12" style="border:0px;">

                                                                                <input type="checkbox" name="inserir_construtor_modulo_campo" id="inserir_construtor_modulo_campo" <? if(trim($row_setado['inserir_construtor_modulo_campo'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo_campo"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Editar</label>

                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="editar_construtor_modulo_campo" id="editar_construtor_modulo_campo" <? if(trim($row_setado['editar_construtor_modulo_campo'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo_campo"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Excluir</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="excluir_construtor_modulo_campo" id="excluir_construtor_modulo_campo" <? if(trim($row_setado['excluir_construtor_modulo_campo'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo_campo"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Publicar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="publicar_construtor_modulo_campo" id="publicar_construtor_modulo_campo" <? if(trim($row_setado['publicar_construtor_modulo_campo'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo_campo"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Despublicar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="despublicar_construtor_modulo_campo" id="despublicar_construtor_modulo_campo" <? if(trim($row_setado['despublicar_construtor_modulo_campo'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo_campo"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                </div>
                                                            </div>
                                                            <!-- END FORM-GROUP Módulo de Construtor Campos dos Módulos -->

                                                            <h3 class="form-section" style="padding:0px;margin-top:0px;">Módulo de Construtor de Funções dos Módulos</h3>

                                                            <div class="form-group" style="margin-left:0px;margin-right:0px;">
                                                                <div class="col-md-12" style="border:0px;padding:0px;">

																	<script type='text/javascript'>
                                                                    $(window).load(function(){
                                                                    
                                                                        $('#sell_construtor_modulo_funcao').on('switchChange.bootstrapSwitch', function (event, state) {
                                                                            if(state===true){
                                                                                $(".item_construtor_modulo_funcao").prop("checked", true).change();
                                                                            } else {
                                                                                $(".item_construtor_modulo_funcao").prop("checked", false).change();
                                                                            }
                                                                        });
                                                                    
                                                                    });
                                                                    </script>
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Selecionar Todos</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input 
																				<? 
                                                                                if(
                                                                                  trim($row_setado['visualizar_construtor_modulo_funcao'])==1
                                                                                &&trim($row_setado['inserir_construtor_modulo_funcao'])==1
                                                                                &&trim($row_setado['editar_construtor_modulo_funcao'])==1
                                                                                &&trim($row_setado['excluir_construtor_modulo_funcao'])==1
                                                                                &&trim($row_setado['publicar_construtor_modulo_funcao'])==1
                                                                                &&trim($row_setado['despublicar_construtor_modulo_funcao'])==1
                                                                                ) { echo " checked"; } ?> 
                                                                                type="checkbox" id="sell_construtor_modulo_funcao"  class="make-switch"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="SIM" data-off-text="NÃO">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Visualizar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="visualizar_construtor_modulo_funcao" id="visualizar_construtor_modulo_funcao" <? if(trim($row_setado['visualizar_construtor_modulo_funcao'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo_funcao"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Inserir</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="inserir_construtor_modulo_funcao" id="inserir_construtor_modulo_funcao" <? if(trim($row_setado['inserir_construtor_modulo_funcao'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo_funcao"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Editar</label>

                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="editar_construtor_modulo_funcao" id="editar_construtor_modulo_funcao" <? if(trim($row_setado['editar_construtor_modulo_funcao'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo_funcao"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Excluir</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="excluir_construtor_modulo_funcao" id="excluir_construtor_modulo_funcao" <? if(trim($row_setado['excluir_construtor_modulo_funcao'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo_funcao"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Publicar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="publicar_construtor_modulo_funcao" id="publicar_construtor_modulo_funcao" <? if(trim($row_setado['publicar_construtor_modulo_funcao'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo_funcao"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Despublicar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="despublicar_construtor_modulo_funcao" id="despublicar_construtor_modulo_funcao" <? if(trim($row_setado['despublicar_construtor_modulo_funcao'])==1) { echo " checked"; } ?>  class="make-switch item_construtor_modulo_funcao"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                </div>
                                                            </div>
                                                            <!-- END FORM-GROUP Módulo de Construtor Funções dos Módulos -->

                                                            <h3 class="form-section" style="padding:0px;margin-top:0px;">Módulo de Configurações</h3>

                                                            <div class="form-group" style="margin-left:0px;margin-right:0px;">
                                                                <div class="col-md-12" style="border:0px;padding:0px;">

																	<script type='text/javascript'>
                                                                    $(window).load(function(){
                                                                    
                                                                        $('#sell_sysconfig').on('switchChange.bootstrapSwitch', function (event, state) {
                                                                            if(state===true){
                                                                                $(".item_sysconfig").prop("checked", true).change();
                                                                            } else {
                                                                                $(".item_sysconfig").prop("checked", false).change();
                                                                            }
                                                                        });
                                                                    
                                                                    });
                                                                    </script>
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Selecionar Todos</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input 
																				<? 
                                                                                if(
                                                                                  trim($row_setado['visualizar_sysconfig'])==1
                                                                                &&trim($row_setado['admin_sysconfig'])==1
                                                                                &&trim($row_setado['site_sysconfig'])==1
                                                                                &&trim($row_setado['layout_sysconfig'])==1
                                                                                &&trim($row_setado['imagens_sysconfig'])==1
                                                                                &&trim($row_setado['mensagens_sysconfig'])==1
                                                                                &&trim($row_setado['seo_sysconfig'])==1
                                                                                &&trim($row_setado['indexacao_sysconfig'])==1
                                                                                &&trim($row_setado['analytics_sysconfig'])==1
                                                                                &&trim($row_setado['erro404_sysconfig'])==1
                                                                                &&trim($row_setado['instalacao_sysconfig'])==1
                                                                                &&trim($row_setado['dominios_sysconfig'])==1
                                                                                &&trim($row_setado['servidor_sysconfig'])==1
                                                                                ) { echo " checked"; } ?> 
                                                                                type="checkbox" id="sell_sysconfig"  class="make-switch"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="SIM" data-off-text="NÃO">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Visualizar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="visualizar_sysconfig" id="visualizar_sysconfig" <? if(trim($row_setado['visualizar_sysconfig'])==1) { echo " checked"; } ?>  class="make-switch item_sysconfig"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Aba Admin</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="admin_sysconfig" id="admin_sysconfig" <? if(trim($row_setado['admin_sysconfig'])==1) { echo " checked"; } ?>  class="make-switch item_sysconfig"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Aba Site</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="site_sysconfig" id="site_sysconfig" <? if(trim($row_setado['site_sysconfig'])==1) { echo " checked"; } ?>  class="make-switch item_sysconfig"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Aba Layout</label>

                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="layout_sysconfig" id="layout_sysconfig" <? if(trim($row_setado['layout_sysconfig'])==1) { echo " checked"; } ?>  class="make-switch item_sysconfig"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Aba Imagens</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="imagens_sysconfig" id="imagens_sysconfig" <? if(trim($row_setado['imagens_sysconfig'])==1) { echo " checked"; } ?>  class="make-switch item_sysconfig"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Aba Mensagens</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="mensagens_sysconfig" id="mensagens_sysconfig" <? if(trim($row_setado['mensagens_sysconfig'])==1) { echo " checked"; } ?>  class="make-switch item_sysconfig"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Aba SEO</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="seo_sysconfig" id="seo_sysconfig" <? if(trim($row_setado['seo_sysconfig'])==1) { echo " checked"; } ?>  class="make-switch item_sysconfig"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Aba Indexação</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="indexacao_sysconfig" id="indexacao_sysconfig" <? if(trim($row_setado['indexacao_sysconfig'])==1) { echo " checked"; } ?>  class="make-switch item_sysconfig"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Aba Analytics</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="analytics_sysconfig" id="analytics_sysconfig" <? if(trim($row_setado['analytics_sysconfig'])==1) { echo " checked"; } ?>  class="make-switch item_sysconfig"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Aba ERRO 404</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="erro404_sysconfig" id="erro404_sysconfig" <? if(trim($row_setado['erro404_sysconfig'])==1) { echo " checked"; } ?>  class="make-switch item_sysconfig"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Aba Instalação</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="instalacao_sysconfig" id="instalacao_sysconfig" <? if(trim($row_setado['instalacao_sysconfig'])==1) { echo " checked"; } ?>  class="make-switch item_sysconfig"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Aba Domínios</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="dominios_sysconfig" id="dominios_sysconfig" <? if(trim($row_setado['dominios_sysconfig'])==1) { echo " checked"; } ?>  class="make-switch item_sysconfig"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Aba Servidor</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="servidor_sysconfig" id="servidor_sysconfig" <? if(trim($row_setado['servidor_sysconfig'])==1) { echo " checked"; } ?>  class="make-switch item_sysconfig"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                </div>
                                                            </div>
                                                            <!-- END FORM-GROUP Módulo de Configurações -->

                                                        </div>
                                                        <!-- END Sistema -->
                                                        
                                                        <?
														for ($row = 0; $row < count($rDataCat); $row++) {
															$rSqlCat = $rDataCat[$row];
                                                        ?>
                                                        <div id="<?=$rSqlCat['url_amigavel']?>" class="tab-pane" style="min-height:350px;">

                                                            <?
                                                            $qSql = mysql_query("SELECT nome,nome_base FROM _construtor_modulo WHERE stat='1' AND id_construtor_modulo_categoria='".$rSqlCat['id']."' ORDER BY ordem");
                                                            while($rSql = mysql_fetch_array($qSql)) {
                                                            ?>

                                                            <h3 class="form-section" style="padding:0px;margin-top:0px;"><?=$rSql['nome']?></h3>

                                                            <div class="form-group" style="margin-left:0px;margin-right:0px;">
                                                                <div class="col-md-12" style="border:0px;padding:0px;">

																	<script type='text/javascript'>
                                                                    $(window).load(function(){
                                                                    
                                                                        $('#sell_<?=$rSql['nome_base']?>').on('switchChange.bootstrapSwitch', function (event, state) {
                                                                            if(state===true){
                                                                                $(".item_<?=$rSql['nome_base']?>").prop("checked", true).change();
                                                                            } else {
                                                                                $(".item_<?=$rSql['nome_base']?>").prop("checked", false).change();
                                                                            }
                                                                        });
                                                                    
                                                                    });
                                                                    </script>
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Selecionar Todos</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input 
																				<? 
                                                                                if(
                                                                                  trim($row_setado['visualizar_'.$rSql['nome_base'].''])==1
                                                                                &&trim($row_setado['todos_'.$rSql['nome_base'].''])==1
                                                                                &&trim($row_setado['inserir_'.$rSql['nome_base'].''])==1
                                                                                &&trim($row_setado['editar_'.$rSql['nome_base'].''])==1
                                                                                &&trim($row_setado['excluir_'.$rSql['nome_base'].''])==1
                                                                                &&trim($row_setado['publicar_'.$rSql['nome_base'].''])==1
                                                                                &&trim($row_setado['despublicar_'.$rSql['nome_base'].''])==1
                                                                                &&trim($row_setado['lixeira_'.$rSql['nome_base'].''])==1
                                                                                &&trim($row_setado['restaurar_'.$rSql['nome_base'].''])==1
                                                                                &&trim($row_setado['descricao_'.$rSql['nome_base'].''])==1
                                                                                &&trim($row_setado['seo_'.$rSql['nome_base'].''])==1
                                                                                &&trim($row_setado['config_'.$rSql['nome_base'].''])==1
                                                                                &&trim($row_setado['minha_config_'.$rSql['nome_base'].''])==1
                                                                                ) { echo " checked"; } ?> 
                                                                                type="checkbox" id="sell_<?=$rSql['nome_base']?>"  class="make-switch"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="SIM" data-off-text="NÃO">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Visualizar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="visualizar_<?=$rSql['nome_base']?>" id="visualizar_<?=$rSql['nome_base']?>" <? if(trim($row_setado['visualizar_'.$rSql['nome_base'].''])==1) { echo " checked"; } ?>  class="make-switch item_<?=$rSql['nome_base']?>"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Administrador</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="todos_<?=$rSql['nome_base']?>" id="todos_<?=$rSql['nome_base']?>" <? if(trim($row_setado['todos_'.$rSql['nome_base'].''])==1) { echo " checked"; } ?>  class="make-switch item_<?=$rSql['nome_base']?>"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Inserir</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="inserir_<?=$rSql['nome_base']?>" id="inserir_<?=$rSql['nome_base']?>" <? if(trim($row_setado['inserir_'.$rSql['nome_base'].''])==1) { echo " checked"; } ?>  class="make-switch item_<?=$rSql['nome_base']?>"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Editar</label>

                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="editar_<?=$rSql['nome_base']?>" id="editar_<?=$rSql['nome_base']?>" <? if(trim($row_setado['editar_'.$rSql['nome_base'].''])==1) { echo " checked"; } ?>  class="make-switch item_<?=$rSql['nome_base']?>"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Excluir</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="excluir_<?=$rSql['nome_base']?>" id="excluir_<?=$rSql['nome_base']?>" <? if(trim($row_setado['excluir_'.$rSql['nome_base'].''])==1) { echo " checked"; } ?>  class="make-switch item_<?=$rSql['nome_base']?>"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Publicar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="publicar_<?=$rSql['nome_base']?>" id="publicar_<?=$rSql['nome_base']?>" <? if(trim($row_setado['publicar_'.$rSql['nome_base'].''])==1) { echo " checked"; } ?>  class="make-switch item_<?=$rSql['nome_base']?>"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Despublicar</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="despublicar_<?=$rSql['nome_base']?>" id="despublicar_<?=$rSql['nome_base']?>" <? if(trim($row_setado['despublicar_'.$rSql['nome_base'].''])==1) { echo " checked"; } ?>  class="make-switch item_<?=$rSql['nome_base']?>"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Enviar para Lixeira</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="lixeira_<?=$rSql['nome_base']?>" id="lixeira_<?=$rSql['nome_base']?>" <? if(trim($row_setado['lixeira_'.$rSql['nome_base'].''])==1) { echo " checked"; } ?>  class="make-switch item_<?=$rSql['nome_base']?>"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Restaurar da Lixeira</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="restaurar_<?=$rSql['nome_base']?>" id="restaurar_<?=$rSql['nome_base']?>" <? if(trim($row_setado['restaurar_'.$rSql['nome_base'].''])==1) { echo " checked"; } ?>  class="make-switch item_<?=$rSql['nome_base']?>"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Aba de Descrição</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="descricao_<?=$rSql['nome_base']?>" id="descricao_<?=$rSql['nome_base']?>" <? if(trim($row_setado['descricao_'.$rSql['nome_base'].''])==1) { echo " checked"; } ?>  class="make-switch item_<?=$rSql['nome_base']?>"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Aba de SEO</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="seo_<?=$rSql['nome_base']?>" id="seo_<?=$rSql['nome_base']?>" <? if(trim($row_setado['seo_'.$rSql['nome_base'].''])==1) { echo " checked"; } ?>  class="make-switch item_<?=$rSql['nome_base']?>"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                
                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Aba de Configurações</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="config_<?=$rSql['nome_base']?>" id="config_<?=$rSql['nome_base']?>" <? if(trim($row_setado['config_'.$rSql['nome_base'].''])==1) { echo " checked"; } ?>  class="make-switch item_<?=$rSql['nome_base']?>"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2" style="border:0px;padding:0px;">
                                                                        <div class="form-group" style="border:0px;">
                                                                            <label class="control-label col-md-12" style="text-align:left;font-size:10px;">Aba Minhas Configurações</label>
                                                                            <div class="col-md-12" style="border:0px;">
                                                                                <input type="checkbox" name="minha_config_<?=$rSql['nome_base']?>" id="minha_config_<?=$rSql['nome_base']?>" <? if(trim($row_setado['minha_config_'.$rSql['nome_base'].''])==1) { echo " checked"; } ?>  class="make-switch item_<?=$rSql['nome_base']?>"  data-size="small" data-on-color="success" data-off-color="danger" data-on-text="&nbsp;&nbsp;&nbsp;SIM&nbsp;&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;&nbsp;NÃO&nbsp;&nbsp;&nbsp;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <? } ?>
                                                            <!-- END FORM-GROUP <?=$rSql['nome']?> -->

                                                        </div>
                                                        <!-- END <?=$rSqlCat['nome']?> -->
                                                        <? } ?>
                                                        
                                                        
                                                    </div>
                                                    <!-- END TAB CONTENT-->
    
                                                </div>
                                                <!-- END form-body -->
    
                                                <div style="border:0px;position:fixed;bottom:35px;background-color:#f6f6f6;padding:10px;">
													<? if(trim($_construtor_sysperm['editar_'.$mod.''])==1) { ?>
                                                    <button type="submit" style="margin-left:20px;" class="btn green-turquoise btn_salvar"><i class="fa fa-floppy-o"></i> Salvar</button>
                                                    <button type="button" onclick="salvar_continuar_editando('permissoes-continuar');" class="btn green-seagreen"><i class="fa fa-check"></i> Salvar e Continuar Editando</button>
                                                    <? } ?>
                                                    <button type="button" onclick="btn_cancelar();" class="btn yellow-casablanca btn-cancelar"><i class="fa fa-minus-circle"></i> Cancelar</button>
                                                </div>

                                                </form>
    
                                        </div>
                                        <!-- END COL-10-->

                                     </div>
                                     <!-- END ROW-->
                                        
                                </div>
                                <!-- END TAB_PERM-->
                                <? } ?>
                                

                        </div>
                        <!-- END TAB CONTENT-->

                    </div>
				</div>
                <!-- FIM COL-MD-12-->
                
                <script>
				var Componentes = function () {
				
					var initTable1 = function () {
				
						var table = $('#tabela_montada');
				
						// begin first table
						table.dataTable({

							// Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
							// setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
							// So when dropdowns used the scrollable div should be removed. 
							//"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
				
							"columns": [
								{ "orderable": false }, 
								{ "orderable": true }, 
								{ "orderable": true }, 
								{ "orderable": true }, 
								{ "orderable": false } 
							],

							"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
				
							<? include("templates/".$layout_padrao_set."/include/datatable.config.php"); ?>

							"order": [
								[2, "asc"]
							] // set first column as a default sort by asc
						});
				
						var tableWrapper = jQuery('#tabela_montada_wrapper');
				
						table.find('.group-checkable').change(function () {
							var set = jQuery(this).attr("data-set");
							var checked = jQuery(this).is(":checked");
							jQuery(set).each(function () {
								if (checked) {
									$(this).attr("checked", true);
									$(this).parents('tr').addClass("active");
								} else {
									$(this).attr("checked", false);
									$(this).parents('tr').removeClass("active");
								}
							});
							jQuery.uniform.update(set);
						});
				
						table.on('change', 'tbody tr .checkboxes', function () {
							$(this).parents('tr').toggleClass("active");
						});
				
						tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
					}
				
				
					<? if(trim($_REQUEST['var3'])=="historico-de-acessos") { ?>
					var initTableAcessos = function () {
				
						var table = $('#tabela_acessos');
				
						// begin first table
						table.dataTable({

							// Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
							// setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
							// So when dropdowns used the scrollable div should be removed. 
							//"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
				
							"columns": [
								{ "orderable": true }, 
								{ "orderable": true }, 
								{ "orderable": true } 
							],

							"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
				
							<? include("templates/".$layout_padrao_set."/include/datatable.config.php"); ?>

							"order": [
								[1, "asc"]
							] // set first column as a default sort by asc
						});
				
						var tableWrapper = jQuery('#tabela_acessos_wrapper');
				
						table.find('.group-checkable').change(function () {
							var set = jQuery(this).attr("data-set");
							var checked = jQuery(this).is(":checked");
							jQuery(set).each(function () {
								if (checked) {
									$(this).attr("checked", true);
									$(this).parents('tr').addClass("active");
								} else {
									$(this).attr("checked", false);
									$(this).parents('tr').removeClass("active");
								}
							});
							jQuery.uniform.update(set);
						});
				
						table.on('change', 'tbody tr .checkboxes', function () {
							$(this).parents('tr').toggleClass("active");
						});
				
						tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
					}
					<? } ?>

					<? if(trim($_REQUEST['var3'])=="historico-de-operacoes") { ?>
					var initTableOperacoes = function () {
				
						var table = $('#tabela_operacoes');
				
						// begin first table
						table.dataTable({

							// Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
							// setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
							// So when dropdowns used the scrollable div should be removed. 
							//"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
				
							"columns": [
								{ "orderable": true }, 
								{ "orderable": true }, 
								{ "orderable": true }, 
								{ "orderable": true }, 
								{ "orderable": true }, 
								{ "orderable": true } 
							],

							"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
				
							<? include("templates/".$layout_padrao_set."/include/datatable.config.php"); ?>

							"order": [
								[1, "asc"]
							] // set first column as a default sort by asc
						});
				
						var tableWrapper = jQuery('#tabela_operacoes_wrapper');
				
						table.find('.group-checkable').change(function () {
							var set = jQuery(this).attr("data-set");
							var checked = jQuery(this).is(":checked");
							jQuery(set).each(function () {
								if (checked) {
									$(this).attr("checked", true);
									$(this).parents('tr').addClass("active");
								} else {
									$(this).attr("checked", false);
									$(this).parents('tr').removeClass("active");
								}
							});
							jQuery.uniform.update(set);
						});
				
						table.on('change', 'tbody tr .checkboxes', function () {
							$(this).parents('tr').toggleClass("active");
						});
				
						tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
					}
					<? } ?>

					var handleMultipleSelect = function () {
						$('#empresas_relacionadas_itens').multiSelect({
						  selectableHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
						  selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
						  afterInit: function(ms){
							var that = this,
								$selectableSearch = that.$selectableUl.prev(),
								$selectionSearch = that.$selectionUl.prev(),
								selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
								selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
						
							that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
							.on('keydown', function(e){
							  if (e.which === 40){
								that.$selectableUl.focus();
								return false;
							  }
							});
						
							that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
							.on('keydown', function(e){
							  if (e.which == 40){
								that.$selectionUl.focus();
								return false;
							  }
							});
						  },
							afterSelect: function(values){
								$('#empresas_relacionadas').val(""+$('#empresas_relacionadas').val()+''+values+'');
							},
							afterDeselect: function(values){
								$('#empresas_relacionadas').val($('#empresas_relacionadas').val().replace(''+values+'',''));
							}
						});
						$('#eventos_relacionados_itens').multiSelect({
						  selectableHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
						  selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Digite sua busca'>",
						  afterInit: function(ms){
							var that = this,
								$selectableSearch = that.$selectableUl.prev(),
								$selectionSearch = that.$selectionUl.prev(),
								selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
								selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
						
							that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
							.on('keydown', function(e){
							  if (e.which === 40){
								that.$selectableUl.focus();
								return false;
							  }
							});
						
							that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
							.on('keydown', function(e){
							  if (e.which == 40){
								that.$selectionUl.focus();
								return false;
							  }
							});
						  },
							afterSelect: function(values){
								$('#eventos_relacionados').val(""+$('#eventos_relacionados').val()+''+values+'');
							},
							afterDeselect: function(values){
								$('#eventos_relacionados').val($('#eventos_relacionados').val().replace(''+values+'',''));
							}
						});
					}

					var handleDatePickers = function () {
				
						if (jQuery().datepicker) {
							$('.date-picker').datepicker({
								rtl: Metronic.isRTL(),
								orientation: "top",
								autoclose: true
							});
							//$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
						}
				
						/* Workaround to restrict daterange past date select: http://stackoverflow.com/questions/11933173/how-to-restrict-the-selectable-date-ranges-in-bootstrap-datepicker */
					}

					var handleTabs = function() {
						//activate tab if tab id provided in the URL
						if (location.hash) {
							var tabid = location.hash.substr(1);
							$('a[href="#' + tabid + '"]').parents('.tab-pane:hidden').each(function() {
								var tabid = $(this).attr("id");
								$('a[href="#' + tabid + '"]').click();
							});
							$('a[href="#' + tabid + '"]').click();
						}
					};
				
					var handle_COR = function() {
						$('.color_campo').each(function() {
							//
							// Dear reader, it's actually very easy to initialize MiniColors. For example:
							//
							//  $(selector).minicolors();
							//
							// The way I've done it below is just for the demo, so don't get confused
							// by it. Also, data- attributes aren't supported at this time...they're
							// only used for this demo.
							//
							$(this).minicolors({
								control: $(this).attr('data-control') || 'hue',
								defaultValue: $(this).attr('data-defaultValue') || '',
								inline: $(this).attr('data-inline') === 'true',
								letterCase: $(this).attr('data-letterCase') || 'lowercase',
								opacity: $(this).attr('data-opacity'),
								position: $(this).attr('data-position') || 'bottom left',
								change: function(hex, opacity) {
									if (!hex) return;
									if (opacity) hex += ', ' + opacity;
									if (typeof console === 'object') {
										console.log(hex);
									}
								},
								theme: 'bootstrap'
							});
				
						});
					}

					var handleColorPicker = function () {
						if (!jQuery().colorpicker) {
							return;
						}
						$('.colorpicker-default').colorpicker({
							format: 'hex'
						});
					}
				
					return {
				
						//main function to initiate the module
						init: function () {
							if (!jQuery().dataTable) {
								return;
							}
				
							initTable1();

							<? if(trim($_REQUEST['var3'])=="historico-de-acessos") { ?>
							initTableAcessos();
							<? } ?>

							<? if(trim($_REQUEST['var3'])=="historico-de-operacoes") { ?>
							initTableOperacoes();
							<? } ?>
							
							handle_COR();
							
							handleColorPicker();
							
							handleDatePickers();
							
							handleTabs();
							
							handleMultipleSelect();
						}
				
					};
				
				}();
                </script>




