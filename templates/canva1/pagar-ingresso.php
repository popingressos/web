		<? if(trim($_SESSION["empresa_".$rSqlEmpresa['id']."_email"])=="" || trim($_SESSION["empresa_".$rSqlEmpresa['id']."_senha"])=="") { ?>
			<? include("".$_SERVER['DOCUMENT_ROOT']."/templates/".$pasta_template."/login.php"); ?>
        <? } else { ?>
        <!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap" style="padding-top:40px;">
				<div class="container clearfix">


                    <? if(trim($_SESSION["pagar_ingresso_".$rSqlEmpresa['id']."_cont"])>1) { ?>
                    <div class="col-lg-12" style="text-align:center;">
                        <button type="button" class="button button-3d btn-verde-whats" onclick="javascript:window.open('<?=$link_modelo?>pagar-ingresso-depois/','_self','')">Desejo Pagar Este Ingresso Depois</button>
                    </div>
                    <? } ?>

					<? 
					$strSql = "
						SELECT 
							mod_carrinho.id,
							mod_carrinho.numeroUnico,
							mod_carrinho.numeroUnico_pai,
							mod_carrinho.cod_contrato,
							mod_carrinho.valor_total,
							mod_carrinho.objeto_carrinho_detalhado,
							mod_carrinho.data,
							mod_carrinho.pago,
							mod_carrinho.stat
						FROM 
							carrinho AS mod_carrinho 
						
						WHERE 
							mod_carrinho.numeroUnico='".$_REQUEST['var2']."'
					";
					$corSet = "#ffffff";
					$rSqlItem = mysql_fetch_array(mysql_query("".$strSql.""));
                    ?>

                    <div id="cart" class="cart-card-block show p-0 col-12">
                        <div class="accordion accordion-lg mx-auto mb-0 clearfix">

                          <div id="TAB_carrinho_resumo" class="accordion-header">
                              <div class="accordion-icon">
                                <i class="accordion-closed icon-chevron-right1"></i>
                                <i class="accordion-open icon-chevron-down1"></i>
                              </div>
                              <div class="accordion-title">
                                Resumo da Compra
                              </div>
                          </div>
                          <div id="DIV_carrinho_resumo" class="accordion-content clearfix" style="padding:10px 5px 0px 5px !important;">
                            <? include("".$_SERVER['DOCUMENT_ROOT']."/templates/".$pasta_template."/pagar-ingresso-resumo.php"); ?>
                          </div>

                          <div id="TAB_endereco" class="accordion-header">
                              <div class="accordion-icon">
                                <i class="accordion-closed icon-chevron-right1"></i>
                                <i class="accordion-open icon-chevron-down1"></i>
                              </div>
                              <div class="accordion-title">
                                Endereço de Cobrança
                              </div>
                          </div>
                          <div id="DIV_endereco" class="accordion-content clearfix">
                            <div class="col-lg-12">
                               <div class=" row align-items-center">
                                 <div class="form-group col-sm-8">
                                     <label for="rua">CEP</label>
                                     <input type="text" class="form-control" id="cobranca_cep" value="<?=$rSqlUsuario['cep']?>">
                                 </div>
                                 <div class="form-group col-sm-4">
                                     <input type="button" value="Buscar Endereço" onclick="javascript:buscaCepPadrao('cobranca_');" style="margin-top: 32px;" class="btn btn-primary btn-modern float-left">
                                 </div>
                                 <div class="form-group col-sm-8">
                                     <label for="rua">Rua</label>
                                     <input type="text" class="form-control" id="cobranca_rua" value="<?=$rSqlUsuario['rua']?>">
                                 </div>
                                 <div class="form-group col-sm-4">
                                     <label for="numero">Número</label>
                                     <input type="text" class="form-control" id="cobranca_numero" value="<?=$rSqlUsuario['numero']?>">
                                 </div>
                                 <div class="form-group col-sm-12">
                                     <label for="complemento">Complemento</label>
                                     <input type="text" class="form-control" id="cobranca_complemento" value="<?=$rSqlUsuario['complemento']?>">
                                 </div>
                                 <div class="form-group col-sm-12">
                                     <label for="estado">Estado</label>
                                     <select class="form-control form-control-lg" id="cobranca_estado" style="width:100%;">
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
                                     <select id="cobranca_cidade" class="form-control form-control-lg" style="width:100%;">
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
                                     <select id="cobranca_bairro" class="form-control form-control-lg" style="width:100%;">
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
                               </div>
                               <button type="button" class="button button-3d btn-verde-whats mb-3" style="float:right;" onclick="javascript:carrinhoAccordion('TAB_carrinho_forma_pagamento');">Confirmar e Avançar</button>
                             </div>
                          </div>

                          <div id="TAB_carrinho_forma_pagamento" class="accordion-header">
                              <div class="accordion-icon">
                                <i class="accordion-closed icon-chevron-right1"></i>
                                <i class="accordion-open icon-chevron-down1"></i>
                              </div>
                              <div class="accordion-title">
                                Forma de Pagamento
                              </div>
                          </div>
                          <div id="DIV_carrinho_forma_pagamento" class="accordion-content clearfix">
                             <div class="col-lg-12">
                               <ul class="d-flex flex-wrap align-items-center list-inline m-0 p-0">
                                  <li class="col-md-6 mb-3" onclick="javascript:seleciona_forma_de_pagamento('boleto');" style="display:none;">
                                     <div id="BTN_boleto" class="BTN_forma_de_pagamento w-100 text-white button button-3d btn-azul rounded p-2 pointer p-2 pointer mr-0 text-center"><a class="text-white" href="javascript:void(0);"></a><i class="fal fa-barcode-alt"></i> Boleto</div>
                                  </li>
                                  <li class="col-md-12 mb-3" onclick="javascript:seleciona_forma_de_pagamento('cartao');">
                                     <div id="BTN_cartao" class="BTN_forma_de_pagamento w-100 text-white button button-3d btn-azul rounded p-2 pointer p-2 pointer mr-0 text-center"><a class="text-white" href="javascript:void(0);"></a><i class="fal fa-credit-card-front"></i> Cartão de Crédito</div>
                                  </li>
                               </ul>
                               <div class="col-lg-12 DIV_formas_de_pagamento" id="DIV_boleto" style="display:none;">
                                   <div class="form-group col-sm-12">
                                       <label for="cobranca_cartao_card_name">Nome do Pagador</label>
                                       <input type="text" class="form-control" id="cobranca_boleto_card_name" value="">
                                   </div>
                                   <div class="form-group col-sm-12">
                                       <label for="cobranca_cartao_card_cpf">CPF do Pagador</label>
                                       <input type="text" class="form-control" id="cobranca_boleto_card_cpf" value="">
                                   </div>
                                   <div class="form-group col-sm-12">
                                       <label for="cobranca_cartao_card_telefone">Telefone do Pagador</label>
                                       <input type="text" class="form-control" id="cobranca_boleto_card_telefone" value="">
                                   </div>
                                   <div class="form-group col-sm-12">
                                     <label for="cobranca_boleto_email" class="col-form-label">E-mail do Pagador</label>
                                     <input type="text" class="form-control" id="cobranca_boleto_email" value="<?=$rSqlUsuario['email']?>">
                                   </div>
                                   <div class="col-lg-12 mb-2" style="border-left: 2px solid #0da3e1;background-color: #d3f2ff;color: #777d74;padding: 10px;">
                                        Ao confirmar a compra, seu boleto será gerado e enviado para o e-mail informado acima. Fique atento ao seu e-mail e verifique sua caixa de SPAM. 
                                        O boleto gerado possui uma data de vencimento e não será aceito pagamento e seu evento não será ativada no caso de pagamento fora da data de vencimento informada no boleto.
                                   </div>
                                   <div class="col-lg-12" style="text-align:center;">
                                      <button type="button" id="BTN_boleto_enviar" class="button button-3d btn-verde-whats" onclick="javascript:cobrancaVerificarCamposPagamento('boleto','carrinho-session-checkout');">Confirmar Pagamento e Geração do Boleto</button>
                                      <button type="button" id="BTN_boleto_enviando" class="button button-3d btn-verde-whats" style="display:none;padding-left:20px;"><i class="fad fa-spinner icone_carregando"></i> Enviando pagamento... </button>
                                   </div>
                               </div>
                               <div class="col-lg-12 DIV_formas_de_pagamento" id="DIV_cartao" style="display:none;">
                                     <div class="form-group col-sm-12">
                                         <label for="cobranca_cartao_card_number">Parcelar em</label>
                                         <select class="form-control form-control-lg" id="qtd_parcelas" style="width:100%;">
                                            <? 
                                            for ($x = 1; $x <= 6; $x++) { 
                                                if($x==1) { $selected_set_parcelas = " selected"; } else { $selected_set_parcelas = ""; }
                                                if($x>1) { 
                                                    $total_parcelado = $valorTotal / $x;
                                                    $parcela = $total_parcelado * $rSqlEmpresa['fator_parcela'.$x.''];
                                                    $parcela = round($parcela,2);

                                                    $soma_parcela = $parcela * $x;

                                                    $texto_sufixo = " de (".number_format($parcela, 2, ',', '.').") c/ Juros = ".number_format($soma_parcela, 2, ',', '.').""; 
                                                } else { 
                                                    $parcela = number_format($valorTotal, 2, ',', '.');
                                                    $texto_sufixo = " de (".$parcela.") s/ Juros"; 
                                                }
                                            ?>
                                            <option value="<?=$x?>" <?=$selected_set_parcelas?>><?=$x?>x <?=$texto_sufixo?></option>
                                            <? } ?>
                                         </select>
                                     </div>
                                     <div class="form-group col-sm-12">
                                         <div class="row">
                                             <div class="form-group col-sm-8">
                                                 <label for="cobranca_cartao_card_number">Número do Cartão</label>
                                                 <input type="text" class="form-control" id="cobranca_cartao_card_number" value="">
                                             </div>
                                             <div class="form-group col-sm-4">
                                                 <label for="cobranca_cartao_card_cvv">CVV</label>
                                                 <input type="text" class="form-control" id="cobranca_cartao_card_cvv" value="">
                                             </div>
                                         </div>
                                     </div>
                                     <div class="form-group col-sm-12">
                                         <div class="row">
                                             <div class="form-group col-sm-4">
                                                 <label for="cobranca_cartao_card_bin">Bandeira</label>
                                                 <select class="form-control form-control-lg" id="cobranca_cartao_card_bin" style="width:100%;">
                                                    <option value="">Selecione uma opção</option>
                                                    <option value="visa">Visa</option>
                                                    <option value="mastercard">Mastercard</option>
                                                    <option value="hipercard">Hipercard</option>
                                                    <option value="elo">Elo</option>
                                                    <option value="amex">American Express</option>
                                                 </select>
                                             </div>
                                             <div class="form-group col-sm-4">
                                                 <label for="cobranca_cartao_card_telefone">Mês Vencimento</label>
                                                 <select class="form-control form-control-lg" id="cobranca_cartao_card_exp_month" style="width:100%;">
                                                    <option value="">Mês</option>
                                                    <? for ($i = 1; $i <= 12; $i++) { ?>
                                                        <? if($i<10) { $i = "0".$i.""; } ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                    <? } ?>
                                                 </select>
                                             </div>
                                             <div class="form-group col-sm-4">
                                                 <label for="cobranca_cartao_card_telefone">Ano Vencimento</label>
                                                 <select class="form-control form-control-lg" id="cobranca_cartao_card_exp_year" style="width:100%;">
                                                    <option value="">Ano</option>
                                                    <? for ($i = date("Y"); $i <= date("Y") + 20; $i++) { ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                    <? } ?>
                                                 </select>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="form-group col-sm-12">
                                         <label for="cobranca_cartao_card_name">Nome do Proprietário</label>
                                         <input type="text" class="form-control" id="cobranca_cartao_card_name" value="">
                                         <p>Da mesma forma como está escrito no cartão</p>
                                     </div>

                                     <div class="form-group col-sm-12">
                                         <div class="row">
                                             <div class="form-group col-sm-4">
                                                 <label for="cobranca_cartao_card_cpf">CPF do Proprietário</label>
                                                 <input type="text" class="form-control" id="cobranca_cartao_card_cpf" value="">
                                             </div>
                                             <div class="form-group col-sm-4">
                                                 <label for="cobranca_cartao_card_telefone">Telefone do Proprietário</label>
                                                 <input type="text" class="form-control" id="cobranca_cartao_card_telefone" value="">
                                             </div>
                                             <div class="form-group col-sm-4">
                                                 <label for="cobranca_cartao_card_telefone">E-mail do Proprietário</label>
                                                 <input type="text" class="form-control" id="cobranca_cartao_email" value="<?=$rSqlUsuario['email']?>">
                                             </div>
                                         </div>
                                     </div>

                                  </div>
                        
                                  <div class="col-lg-12 mb-2" style="border-left: 2px solid #0da3e1;background-color: #d3f2ff;color: #777d74;padding: 10px;">
                                      Ao confirmar a compra, será enviado para o e-mail informado acima um comunicado com a confirmação da compra. Fique atento ao seu e-mail e verifique sua caixa de SPAM. 
                                      Sua compra está sendo enviada para análise e caso não seja aceito o pagamento, seu evento não será ativado e você deverá refazer o processo.
                                  </div>
                                 
                                  <div class="col-lg-12" style="text-align:center;">
                                      <button type="button" id="BTN_cartao_enviar" class="button button-3d btn-verde-whats" onclick="javascript:cobrancaVerificarCamposPagamento('cartao','carrinho-session-checkout');">Efetuar Pagamento</button>
                                      <button type="button" id="BTN_cartao_enviando" class="button button-3d btn-verde-whats" style="display:none;padding-left:20px;"><i class="fad fa-spinner icone_carregando"></i> Enviando Pagamento... </button>
                                  </div>
                               </div>
                
                             </div>
                          </div>

                        </div>
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
                    <div class="col-lg-12" style="display:none;" id="DIV_pagamento_enviado">
                       <div class="iq-card" style="padding:10px;">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                              <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                              <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                            </svg>
                            <div style="text-align:center;background-color: #fff;color:#7ac142;width:100%;font-weight:bold;font-family: 'Josefin Sans', sans-serif;padding-bottom:20px;">
                                PAGAMENTO ENVIADO SUCESSO!
                            </div>
                            <div class="col-lg-12 mb-3" style="border-left: 2px solid #0da3e1;background-color: #d3f2ff;color: #777d74;padding: 10px;">
                                  Seu pagamento foi enviado para análise, será enviado para o e-mail informado na confirmação da compra 
                                  acima um comunicado com as informações de sucesso ou caso tenha ocorrido algum erro com a mesma. 
                                  Fique atento ao seu e-mail e verifique sua caixa de SPAM.                   
                            </div>
                             
                            <div class="col-lg-12 mb-2" style="text-align:center;">
                                 <a type="button" class="button button-3d btn-azul" href="<?=$link_modelo?>eventos/">Continuar Comprando</a>
                            </div>
                       </div>
                    </div>

				</div>
			</div>
		</section><!-- #content end -->
        <? } ?>