    <div class="col-md-12" id="DIV_form" style="padding:0px;margin-top:10px;">

        <input type="hidden" id="url_post" value="<?=$link?><?=$chave_url?><?=$_SESSION['var1']?>/<?=$_SESSION['var2']?>/" />
        <form name="forms" method="post" action="<?=$link?><?=$chave_url?><?=$_SESSION['var1']?>/<?=$_SESSION['var2']?>/" target="acoes_hidden" ENCTYPE="multipart/form-data" id="formulario" class="form-horizontal form-bordered form-row-stripped">
            <input type="hidden" id="campos_alterados" value="0" />
            <input type="hidden" name="aba" id="aba" value="" />
            <input type="hidden" name="subMod" value="" />

                <? 
				$tipo_form_set = "add";
                
                echo "<input type=\"hidden\" name=\"acaoLocal\" value=\"interno\" />";
                echo "<input type=\"hidden\" name=\"acaoForm\" id=\"idacaoForm\" value=\"".$tipo_form_set."\" />";
                echo "<input type=\"hidden\" name=\"modulo\" id=\"modulo\" value=\"realizar_sangria_add\" />";
                
				if(trim($_SESSION['numeroUnicoGerado'])=="") {
					$numeroUnicoGerado = geraCodReturn();
					$_SESSION['numeroUnicoGerado'] = $numeroUnicoGerado;
				} else {
					$numeroUnicoGerado = $_SESSION['numeroUnicoGerado'];
				}
				
				$id_redator_set = $sysusu['id'];
				$nome_redator_set = $sysusu['nome'];
				$iditem_input = "<input type=\"hidden\" name=\"iditem\" id=\"iditem\" value=\"\" />";
                
                echo "".$iditem_input."";
                echo "<input type=\"hidden\" name=\"numeroUnico\" id=\"numeroUnico\" value=\"".$_SESSION['numeroUnicoGerado']."\" />";
                echo "<input type=\"hidden\" name=\"idsysusu\" value=\"".$id_redator_set."\" />";
                echo "".$id_item_row_input."";

                ?>

        <div class="col-md-12">

            <div class="row" style="padding-left:10px;padding-right:10px;">
            
                <div class="col-md-4" style="margin-bottom:10px;padding-left:5px;padding-right:5px;"></div>

                <div class="col-md-4" style="margin-bottom:10px;padding-left:5px;padding-right:5px;">
                    <div class="col-md-12" style="background-color:#FFF;padding:10px;border-radius:5px;">
                        <h4 class="font-green-sharp">
                            <span style="width:100%;float:left;">Informações de Sangria</span>
                            <span style="width:100%;font-size:12px;font-style:italic;">Valor e acesso</span>
                        </h4>

						<?
						$rSqlPdvUltimaAbertura = mysql_fetch_array(mysql_query("
																				SELECT 
																					numeroUnico,
																					data,
																					valor AS total 
																				FROM 
																					pdv_fluxo_caixa 
																				WHERE 
																					numeroUnico_usuario='".$sysusu['numeroUnico']."' AND 
																					numeroUnico_finger='".$_COOKIE['finger']."' AND 
																					tipo_operacao='ABERTURA' 
																				ORDER BY 
																					id DESC 
																				LIMIT 1
																				"));

						$rSqlCaixaAtual = mysql_fetch_array(mysql_query("
																		SELECT 
																			SUM(valor) AS total 
																		FROM 
																			pdv_fluxo_caixa_hist 
																		WHERE 
																			numeroUnico_pdv_fluxo_caixa='".$rSqlPdvUltimaAbertura['numeroUnico']."' AND 
																			data > '".$rSqlPdvUltimaAbertura['data']."'
																		"));

						$rSqlSangriaAtual = mysql_fetch_array(mysql_query("
																		SELECT 
																			SUM(valor) AS total 
																		FROM 
																			pdv_fluxo_caixa 
																		WHERE 
																			numeroUnico_usuario='".$sysusu['numeroUnico']."' AND 
																			numeroUnico_finger='".$_COOKIE['finger']."' AND 
																			tipo_operacao='SANGRIA' AND 
																			data > '".$rSqlPdvUltimaAbertura['data']."'
																		"));
	
						$totalSet = ($rSqlPdvUltimaAbertura['total'] + $rSqlCaixaAtual['total']) - $rSqlSangriaAtual['total'];
						?>
                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                            <table class="table table-striped table-bordered table-hover display table-header-fixed" style="background-color:#ffffff;" cellspacing="0" width="100%">
                                <tbody>
                                    <tr role="row">
                                        <td style="vertical-align:middle;text-align:left;width:100%">Valor Informado de Abertura</td>
                                        <td style="vertical-align:middle;text-align:left;">+</td>
                                        <td style="vertical-align:middle;text-align:left;" nowrap="nowrap">R$ <?=number_format($rSqlPdvUltimaAbertura['total'], 2, ',', '.')?></td>
                                    </tr>
                                    <tr role="row">
                                        <td style="vertical-align:middle;text-align:left;width:100%">Valor Já Realizado de Vendas</td>
                                        <td style="vertical-align:middle;text-align:left;">+</td>
                                        <td style="vertical-align:middle;text-align:left;" nowrap="nowrap">R$ <?=number_format($rSqlCaixaAtual['total'], 2, ',', '.')?></td>
                                    </tr>
                                    <tr role="row">
                                        <td style="vertical-align:middle;text-align:left;width:100%">Valor Já Realizado de Sangria</td>
                                        <td style="vertical-align:middle;text-align:left;">-</td>
                                        <td style="vertical-align:middle;text-align:left;" nowrap="nowrap">R$ <?=number_format($rSqlSangriaAtual['total'], 2, ',', '.')?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;padding-left:0px;">Valor em Caixa</label>
                            <table class="table table-striped table-bordered table-hover display table-header-fixed" style="background-color:#ffffff;" cellspacing="0" width="100%">
                                <tbody>
                                    <tr style="background-color:#39F;" role="row">
                                        <td style="vertical-align:middle;text-align:left;color:#FFF;font-size:20px;">R$ <?=number_format($totalSet, 2, ',', '.')?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                            <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;padding-left:0px;">Valor de Sangria</label>
                            <input value="" type="text" name="valor" id="valor" onkeypress="javascript:mascara(this,moeda);" class="form-control" placeholder="" />
                        </div>

                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                            <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;padding-left:0px;">Login</label>
                            <input value="" type="text" name="gestor_login" id="gestor_login" class="form-control" placeholder="" />
                        </div>

                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                            <label class="control-label col-md-12" style="margin-bottom:3px;text-align:left;padding-left:0px;">Senha</label>
                            <input value="" type="password" name="gestor_senha" id="gestor_senha" class="form-control" placeholder="" />
                        </div>

						<? $nome_btn = "Confirmar Sangria de Caixa"; ?>
                        <div class="col-md-12 botoes_de_salvar top-side-desktop" style="padding-left:0px;padding-right:0px;margin-top:10px;text-align:right;">
                            <button type="button" class="btn green input-label" style="margin-left: 0px;" onclick="javascript:pdv_realizar_sangria_salvar('<?=$tipo_form_set?>');" style=""><?=$nome_btn?></button>
                        </div>

                    </div>
                </div>
                
                <div class="col-md-4" style="margin-bottom:10px;padding-left:5px;padding-right:5px;"></div>

            </div>
        </div>
        </form>


    </div>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap" rel="stylesheet">
    <style>
	.checkmark__circle {
	  stroke-dasharray: 166;
	  stroke-dashoffset: 166;
	  stroke-width: 2;
	  stroke-miterlimit: 10;
	  stroke: #7ac142;
	  fill: none;
	  animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
	}
	
	.checkmark {
	  width: 156px;
	  height: 156px;
	  border-radius: 50% !important;
	  display: block;
	  stroke-width: 2;
	  stroke: #fff;
	  stroke-miterlimit: 100;
	  margin: 20px auto;
	  box-shadow: inset 0px 0px 0px #7ac142;
	  animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
	}
	
	.checkmark__check {
	  transform-origin: 50% 50%;
	  stroke-dasharray: 48;
	  stroke-dashoffset: 48;
	  animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
	}
	
	@keyframes stroke {
	  100% {
		stroke-dashoffset: 0;
	  }
	}
	@keyframes scale {
	  0%, 100% {
		transform: none;
	  }
	  50% {
		transform: scale3d(1.1, 1.1, 1);
	  }
	}
	@keyframes fill {
	  100% {
		box-shadow: inset 0px 0px 0px 130px #7ac142;
	  }
	}
    </style>
    <div class="col-md-12" id="DIV_sucesso" style="display:none;">
        <div class="col-md-12" style="background-color: #fff;">
            <div style="text-align:center;background-color: #fff;color:#7ac142;width:100%;font-weight:bold;font-family: 'Josefin Sans', sans-serif;padding-top:20px;">
                SANGRIA
            </div>
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
              <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
              <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
            </svg>
            <div style="text-align:center;background-color: #fff;color:#7ac142;width:100%;font-weight:bold;font-family: 'Josefin Sans', sans-serif;padding-bottom:20px;">
                REALIZADA COM SUCESSO!
            </div>
        </div>
    </div>
