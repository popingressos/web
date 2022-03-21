<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

if(trim($_GET['qrCodeSendS'])=="") {
	$tipoFormSet = "reload";
	$filtroSet = " mod_carrinho.numeroUnico='".$_GET['numeroUnicoS']."' ";
} else {
	$tipoFormSet = "hide_divs";
	$filtroSet = " mod_carrinho.cod_voucher='".$_GET['qrCodeSendS']."' ";
}

if(trim($sysusu['empresa'])=="0" || trim($sysusu['empresa'])=="") {
	$filtro_empresa_notificacao = " (mod_carrinho.plataforma='".$_GET['empresaS']."' OR mod_carrinho.empresa='".$_GET['empresaS']."') AND ";
} else {
	$filtro_empresa_notificacao = " mod_carrinho.empresa='".$sysusu['empresa']."' AND ";
}

if(trim($_GET['gerarQrCode'])=="1") {
	$_GET['cpfS'] = preg_replace("/[^0-9]/", "", $_GET['cpfS']);
} else {
	$strSqlModal = "
						SELECT 
							mod_carrinho.id,
							mod_carrinho.empresa,
	
							mod_carrinho.numeroUnico,
							mod_carrinho.numeroUnico_pessoa,
							mod_carrinho.numeroUnico_evento,
							mod_carrinho.numeroUnico_ticket,
							mod_carrinho.cod_voucher,
							mod_carrinho.validador_recebeu,
							mod_carrinho.confirmado,
							mod_carrinho.dataConfirmado,
							mod_carrinho.dataBloqueado,
							mod_carrinho.dataCancelado,
							mod_carrinho.observacao,
							mod_carrinho.stat,
							
							mod_carrinho.numeroUnico_vacinador,
							mod_carrinho.numeroUnico_evento,
							mod_carrinho.numeroUnico_unidades_de_saude,
							mod_carrinho.numeroUnico_estrategia,
							mod_carrinho.numeroUnico_imunobiologico,
							mod_carrinho.numeroUnico_lote,
							mod_carrinho.numeroUnico_vacinas,
							mod_carrinho.numeroUnico_doses,
							mod_carrinho.numero_dose,
							mod_carrinho.numeroUnico_retornos_de_validacao,
							
							mod_carrinho.pessoa_nome AS usuario_nome,
							mod_carrinho.pessoa_documento AS usuario_cpf,
							mod_carrinho.pessoa_email AS usuario_email,
	
							mod_eventos.numero_dose,
							mod_eventos.nome AS eventos_nome,
							mod_eventos.tickets AS eventos_tickets,
							mod_eventos.data_de_publicacao AS eventos_data_vinculacao_inicio,
							mod_eventos.data_de_despublicacao AS eventos_data_vinculacao_fim,
							
							mod_carrinho.lote_nome,
	
							mod_retornos_de_validacao.numeroUnico AS retornos_de_validacao_numeroUnico,
							mod_retornos_de_validacao.nome AS retornos_de_validacao_nome
							
						FROM 
							carrinho_notificacao AS mod_carrinho 
						LEFT JOIN 
							eventos AS mod_eventos ON (mod_eventos.numeroUnico = mod_carrinho.numeroUnico_evento)
						LEFT JOIN 
							retornos_de_validacao AS mod_retornos_de_validacao ON (mod_retornos_de_validacao.numeroUnico = mod_carrinho.numeroUnico_retornos_de_validacao)
						WHERE 
							".$filtro_empresa_notificacao."
							".$filtroSet."
						GROUP BY 
							mod_carrinho.id 
						ORDER BY 
							mod_carrinho.id 
						";
	$rSqlModal = mysql_fetch_array(mysql_query($strSqlModal));
	
	$ticketArray = unserialize($rSqlModal['eventos_tickets']);
	$ticketArray = array_sort($ticketArray, 'ticket_data', SORT_ASC);
	foreach ($ticketArray as $key => $value_ticket) {
		if(trim($value_ticket['numeroUnico'])==trim($rSqlModal["numeroUnico_ticket"])) {
			$rSqlModal['ingresso_nome'] = $value_ticket['ticket_nome'];
		}
	}

	if(trim($rSqlModal['lote_nome'])=="") {
		$rSqlModal['lote_nome'] = "Sem definição de lote";
	} else {
		if(strrpos($rSqlModal['lote_nome'],"Lote") === false) {
			$rSqlModal['lote_nome'] = "".$rSqlModal['lote_nome']."&deg; Lote";
		} else {
			$rSqlIrSqlModaltem['lote_nome'] = "".$rSqlModal['lote_nome']."";
		}
	}

	if(trim($rSqlModal['stat'])=="4") {
		$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"btn\" 
		 style=\"background-color:#000;text-align:center;color:#FFF;margin-right: 0px;margin-top: 0px;padding-top: 1px;padding-bottom: 1px;width:125px;\"> BLOQUEADO </a>";
	} else if(trim($rSqlModal['stat'])=="5") {
		$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"btn\" 
		 style=\"background-color:#000;text-align:center;color:#FFF;margin-right: 0px;margin-top: 0px;padding-top: 1px;padding-bottom: 1px;width:125px;\"> CANCELADO </a>";
	} else {
		if(trim($rSqlModal['confirmado'])=="1") {
			$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"btn\" 
			 style=\"background-color:#093;text-align:center;color:#FFF;margin-right: 0px;margin-top: 0px;padding-top: 1px;padding-bottom: 1px;width:125px;\"> JÁ UTILIZADO </a>";
		} else if(trim($rSqlModal['confirmado'])=="0" || trim($rSqlModal['confirmado'])=="") {
			$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"btn\"
			 style=\"background-color:#c00;text-align:center;color:#FFF;margin-right: 10px;margin-top: 0px;padding-top: 1px;padding-bottom: 1px;width:125px;\"> NÃO UTILIZADO </a>";
		}
	}
}

if(trim($_GET['qrCodeSendS'])=="") {
	$mostra_info_modal = "SIM";
} else {
	$nSqlModal = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho_notificacao AS mod_carrinho WHERE ".$filtro_empresa_notificacao." mod_carrinho.cod_voucher='".$_GET['qrCodeSendS']."'"));
	if($nSqlModal[0]==0) {
		$mostra_info_modal = "NAO";
	} else {
		$mostra_info_modal = "SIM";
	}
}

if(trim($_GET['qrCodeSendS'])=="") {
	$script_zerarSet = "validacao_zerar";
} else {
	if(trim($_GET['scannerS'])=="1") {
		$script_zerarSet = "validacao_fechar_modal_qrcode";
	} else {
		$script_zerarSet = "validacao_zerar";
	}
}

if(trim($mostra_info_modal)=="NAO") {
?>
    <div class="form-row" style="padding:5px;padding-bottom:0px;margin-bottom:0px;">
        <div class="form-group col" style="border-left:3px solid #1bc5bd;padding:10px;background-color:#c9f7f5;margin-bottom:0px;">
        	<b>Atenção</b><br />
            Este QRCode não foi encontrado<br />
        </div>
    </div>

    <div class="col-md-12" style="background-color: #fff;padding-left:5px;padding-right:5px;text-align:left;">
        <button type="button" class="btn yellow-gold input-label" style="margin-left: 0px;margin-top:5px;margin-bottom:5px;" onclick="javascript:<?=$script_zerarSet?>('<?=$_GET['numeroUnicoS']?>','<?=$_GET['qrCodeSendS']?>');">Refazer Pesquisa</button>
    </div>
<? } else { ?>
	<script>
    $(".box_menu").click(function() {
        $(".box_ativo").removeClass( "box_ativo" ).addClass( "box_inativo" );
        $(".div_ativo").removeClass( "div_ativo" ).addClass( "div_inativo" );
        var divSet = $(this).attr("div-toggle");
        $(this).removeClass( "box_inativo" ).addClass( "box_ativo" );
        $("#"+divSet+"").removeClass( "div_inativo" ).addClass( "div_ativo" ).fadeIn();
    });
    $('.date-picker').datepicker({
        format: "dd/mm/yyyy",
        todayBtn: "linked",
        language: "pt-BR",
        autoclose: true,
        orientation: "bottom",
        todayHighlight: true
    });
    </script>
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

    .div_ativo {
        display:block;
    }
    .div_inativo {
        display:none;
    }
    .box_ativo {
        background-color:#1ab394;
        padding:10px;
        border-radius:5px !important;
        color:#FFF;
        cursor:pointer;
    }
    .box_inativo {
        box-shadow: 0px 3px 1px -2px rgb(0 0 0 / 20%), 0px 2px 2px 0px rgb(0 0 0 / 14%), 0px 1px 5px 0px rgb(0 0 0 / 12%);
        background-color: #fff;
        border-radius: 2px;
        
        background-color:#ffffff;
        padding:10px;
        border-radius:5px !important;
        color: #1ab394;
        cursor:pointer;
    }
    .box_inativo:hover {
        box-shadow: 0px 5px 5px -3px rgb(0 0 0 / 20%), 0px 8px 10px 1px rgb(0 0 0 / 14%), 0px 3px 14px 2px rgb(0 0 0 / 12%);
        /*background-color:#33d8b7;*/
        padding:10px;
        border-radius:5px !important;
        color: #1ab394;
        cursor:pointer;
    }

    .col-md-2-5 {
        position: relative;
        min-height: 1px;
    }
    @media (min-width: 992px) {
        .col-md-2-5 {
            width: 25%;
        }
        .col-md-2-5 {
            float: left;
        }
    }
    </style>
    <? if(trim($_GET['gerarQrCode'])=="1") { ?>
    <style>
    .modal-header {
        padding-top: 5px !important;
        padding-bottom: 5px !important
    }
    </style>
    <div class="modal-header">
       <h5 class="modal-title" id="modal-notificacao-qrcodeLabel" style="font-weight:bold">Geração de Novo QR Code</h5>
    </div>
    <input type="hidden" id="documento_modal" value="<?=$_GET['cpfS']?>">
    <input type="hidden" id="empresa_modal" value="<?=$_GET['empresaS']?>">
    <div class="div_ativo" id="gerar-qrcode" style="overflow-y: scroll !important;">
      <div class="modal-body" style="padding-top:0px;">

          <? $data_confirmacaoSet = date("d/m/Y"); ?>
          <div class="form-group">
            <label for="numeroUnico_evento" class="col-form-label">Data da Confirmação:</label>
            <div class="col-md-12" style="padding-left:0px;padding-right: 0px;">
                <div class="col-md-6" style="padding:0px;">
                    <div class="input-group date date-picker" id="TI_data_confirmacao" data-date-format="dd/mm/yyyy"  data-date="<?=$data_confirmacaoSet?>">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span> 
                        <input type="text" id="data_confirmacao" name="data_confirmacao" class="form-control input-sm" value="<?=$data_confirmacaoSet?>" style="height: 34px;margin-top:0px;">
                    </div>
                </div>
            </div>
            <p class="help-block">Você pode alterar a data caso a confirmação tenha sido feita em outro dia, ou pode deixar a data atual já preenchida.</p>
          </div>

          
      </div>
      <div class="modal-footer" id="BTNS_salvar">
        <button type="button" style="float:left;" class="btn btn-secondary" onclick="javascript:<?=$script_zerarSet?>('<?=$_GET['numeroUnicoS']?>','<?=$_GET['qrCodeSendS']?>');">Fechar</button>
        <button type="button" class="btn btn-primary green" onclick="javascript:notificacao_gerar_qrcode('<?=$tipoFormSet?>');">Confirmar a Geração</button>
      </div>
      <div class="modal-footer" id="BTNS_carregando" style="display:none;">
        <button type="button" style="float:left;display:none;" class="btn blue btn-secondary" onclick="javascript:<?=$script_zerarSet?>('<?=$_GET['numeroUnicoS']?>','<?=$_GET['qrCodeSendS']?>');">Nova Pesquisa</button>

        <button class="btn btn-primary" type="button" disabled>
          <i class='fa fa-spinner fa-spin '></i> Aguarde... Gerando QRCode...
        </button>
      </div>
    </div>
    <div id="DIV_sucesso" style="display:none;">
        <div style="text-align:center;background-color: #fff;color:#7ac142;width:100%;font-weight:bold;font-family: 'Josefin Sans', sans-serif;padding-top:20px;">
            QRCODE
        </div>
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
          <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
          <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
        </svg>
        <div style="text-align:center;background-color: #fff;color:#7ac142;width:100%;font-weight:bold;font-family: 'Josefin Sans', sans-serif;padding-bottom:20px;">
            GERADO COM SUCESSO!
        </div>
    </div>
    <? } else { ?>
        <? if(trim($rSqlModal['stat'])=="4" || trim($rSqlModal['stat'])=="5") { ?>
        <div class="modal-header">
            <table cellpadding="0" cellspacing="0" width="100%">
                <? if(trim($rSqlModal['usuario_nome'])=="") { } else { ?>
                <tr style="line-height: 25px;background-color:#e2e2e2;">
                    <td style="width:140px;padding-left:5px;padding-right:5px;"><b>Nome:</b></td>
                    <td style="padding-left:5px;padding-right:5px;"><?= $rSqlModal['usuario_nome'] ?></td>
                </tr>
                <? } ?>
                <? if(trim($rSqlModal['eventos_nome'])=="") { } else { ?>
                <tr style="line-height: 25px;background-color:#FFF;">
                    <td style="width:140px;padding-left:5px;padding-right:5px;"><b>Evento:</b></td>
                    <td style="padding-left:5px;padding-right:5px;"><?=$rSqlModal['eventos_nome']?></td>
                </tr>
                <? } ?>
                <? if(trim($rSqlModal['ingresso_nome'])=="") { } else { ?>
                <tr style="line-height: 25px;background-color:#e2e2e2;">
                    <td style="width:140px;padding-left:5px;padding-right:5px;"><b>Ticket:</b></td>
                    <td style="padding-left:5px;padding-right:5px;"><?= $rSqlModal['ingresso_nome'] ?></td>
                </tr>
                <? } ?>
                <? if(trim($rSqlModal['lote_nome'])=="") { } else { ?>
                <tr style="line-height: 25px;background-color:#FFF;">
                    <td style="width:140px;padding-left:5px;padding-right:5px;"><b>Lote:</b></td>
                    <td style="padding-left:5px;padding-right:5px;"><?= $rSqlModal['lote_nome'] ?></td>
                </tr>
                <? } ?>
                <? if(trim($rSqlModal['dataCancelado'])=="" || trim($rSqlModal['dataCancelado'])=="0000-00-00 00:00:00") { } else { ?>
                <tr style="line-height: 25px;background-color:#FFF;">
                    <td style="width:140px;padding-left:5px;padding-right:5px;"><b>Cancelado em:</b></td>
                    <td style="padding-left:5px;padding-right:5px;"><?=ajustaDataReturn($rSqlModal['dataCancelado'],"d/m/Y");?></td>
                </tr>
                <? } ?>
            </table>
			<?=$confirmadoSet?>
        </div>

        <div class="div_ativo" id="cancelar-utilizacao-<?=$rSqlModal['id']?>">
          <div class="modal-body" style="max-height:300px;overflow-y: scroll !important;">

              <? $data_cancelamentoSet = ajustaDataSemHoraReturn($rSqlModal['dataCancelado'],"d/m/Y"); ?>
              <input type="hidden" name="data_confirmacao" id="data_confirmacao" value="<?=$data_cancelamentoSet?>">
              <input type="hidden" name="numeroUnico_validador" id="numeroUnico_validador" value="<?=$sysusu['numeroUnico']?>">
              <div class="form-group">
                <label for="numeroUnico_evento" class="col-form-label">Data do Cancelamento:</label>
                <div class="col-md-12" style="padding-left:0px;padding-right: 0px;margin-bottom:10px;">
                    <div class="col-md-12" style="padding:0px;">
                        <div class="input-group date date-picker" id="TI_data_confirmacao" data-date-format="dd/mm/yyyy"  data-date="<?=$data_confirmacaoSet?>">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span> 
                            <input type="text" disabled="disabled" class="form-control input-sm" value="<?=$data_cancelamentoSet?>" style="height: 34px;margin-top:0px;">
                        </div>
                    </div>
                </div>
              </div>

              <div class="form-group">
                <label for="numeroUnico_retornos_de_validacao" class="col-form-label">Motivo:</label>
                <select name="numeroUnico_retornos_de_validacao" disabled="disabled" id="numeroUnico_retornos_de_validacao" class="form-control">
                    <option value="">Selecione uma opção</option>
                    <?
                    $qSqlItem = mysql_query("
                                            SELECT 
                                                mod_retornos_de_validacao.numeroUnico,
                                                mod_retornos_de_validacao.nome
                                                 
                                            FROM 
                                                retornos_de_validacao AS mod_retornos_de_validacao 
                                            WHERE
                                                (mod_retornos_de_validacao.stat='0' OR mod_retornos_de_validacao.stat='1') AND
                                                mod_retornos_de_validacao.empresa='".$rSqlModal['empresa']."' 
                                            ORDER BY 
                                                mod_retornos_de_validacao.nome");
                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                    ?>
                    <option value="<?= $rSqlItem['numeroUnico'] ?>" <? if(trim($rSqlItem['numeroUnico'])==trim($rSqlModal['numeroUnico_retornos_de_validacao'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                    <? } ?>
                </select>
              </div>

              <div class="form-group">
                <label for="motivo_cancelamento" class="col-form-label">Mais Detalhes:</label>
                <textarea class="form-control" disabled="disabled"><?=$rSqlModal['observacao']?></textarea>
              </div>
    
              <div class="form-group">
                <label for="numeroUnico_validador" class="col-form-label">Validador Responsável:</label>
                <input type="text" disabled="disabled" class="form-control input-sm" value="<?=$sysusu['nome']?>" style="height: 34px;margin-top:0px;">
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" style="float:left;" class="btn btn-secondary" onclick="javascript:<?=$script_zerarSet?>('<?=$_GET['numeroUnicoS']?>','<?=$_GET['qrCodeSendS']?>');">Fechar</button>
          </div>
        </div>
        <? } else { ?>
        <div class="modal-header">
            <table cellpadding="0" cellspacing="0" width="100%">
                <? if(trim($rSqlModal['usuario_nome'])=="") { } else { ?>
                <tr style="line-height: 25px;background-color:#e2e2e2;">
                    <td style="width:140px;padding-left:5px;padding-right:5px;"><b>Nome:</b></td>
                    <td style="padding-left:5px;padding-right:5px;"><?= $rSqlModal['usuario_nome'] ?></td>
                </tr>
                <? } ?>
                <? if(trim($rSqlModal['eventos_nome'])=="") { } else { ?>
                <tr style="line-height: 25px;background-color:#FFF;">
                    <td style="width:140px;padding-left:5px;padding-right:5px;"><b>Evento:</b></td>
                    <td style="padding-left:5px;padding-right:5px;"><?=$rSqlModal['eventos_nome']?></td>
                </tr>
                <? } ?>
                <? if(trim($rSqlModal['ingresso_nome'])=="") { } else { ?>
                <tr style="line-height: 25px;background-color:#e2e2e2;">
                    <td style="width:140px;padding-left:5px;padding-right:5px;"><b>Ticket:</b></td>
                    <td style="padding-left:5px;padding-right:5px;"><?= $rSqlModal['ingresso_nome'] ?></td>
                </tr>
                <? } ?>
                <? if(trim($rSqlModal['lote_nome'])=="") { } else { ?>
                <tr style="line-height: 25px;background-color:#FFF;">
                    <td style="width:140px;padding-left:5px;padding-right:5px;"><b>Lote:</b></td>
                    <td style="padding-left:5px;padding-right:5px;"><?= $rSqlModal['lote_nome'] ?></td>
                </tr>
                <? } ?>
                <? if(trim($rSqlModal['dataConfirmado'])=="" || trim($rSqlModal['dataConfirmado'])=="0000-00-00 00:00:00") { } else { ?>
                <tr style="line-height: 25px;background-color:#FFF;">
                    <td style="width:140px;padding-left:5px;padding-right:5px;"><b>Utilizado em:</b></td>
                    <td style="padding-left:5px;padding-right:5px;"><?=ajustaDataReturn($rSqlModal['dataConfirmado'],"d/m/Y");?></td>
                </tr>
                <? } ?>
            </table>
			<?=$confirmadoSet?>
        </div>

        <div class="row botoes_aba" style="padding-left:10px;padding-right:10px;">
            <div class="col-md-12" style="margin-bottom:10px;padding-left:10px;padding-right:10px;">
                <p class="help-block" style="padding-left:5px;">Escolha abaixo uma ação desejada para esta notificação.</p>
				<? if(trim($rSqlModal['confirmado'])=="1") { $colSet = "col-md-12"; } else { $colSet = "col-md-6"; ?>
                <div class="col-md-6" style="padding:5px;">
                    <div class="col-md-12 box_menu box_inativo" div-toggle="confirmar-utilizacao-<?=$rSqlModal['id']?>">
                        <h4 style="margin-top:0px;font-size:16px;text-align:center;margin-bottom: 0px;">
                            <span style="width:100%;padding-bottom:10px;">Confirmar Utilização</span>
                        </h4>
                    </div>
                </div>
                <? } ?>

                <div class="<?=$colSet?>" style="padding:5px;">
                    <div class="col-md-12 box_menu box_inativo" div-toggle="cancelar-utilizacao-<?=$rSqlModal['id']?>">
                        <h4 style="margin-top:0px;font-size:16px;text-align:center;margin-bottom: 0px">
                            <span style="width:100%;padding-bottom:10px;">Cancelar Utilização</span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="div_ativo" id="fechar-modal">
          <div class="modal-footer">
            <button type="button" style="float:left;" class="btn btn-secondary" onclick="javascript:<?=$script_zerarSet?>('<?=$_GET['numeroUnicoS']?>','<?=$_GET['qrCodeSendS']?>');">Fechar</button>
          </div>
        </div>

        <div class="div_inativo" id="cancelar-utilizacao-<?=$rSqlModal['id']?>">
          <div class="modal-body">
              <div class="form-group">
                <label for="numeroUnico_retornos_de_validacao" class="col-form-label">Motivo:</label>
                <select name="numeroUnico_retornos_de_validacao" id="numeroUnico_retornos_de_validacao" class="form-control">
                    <option value="">Selecione uma opção</option>
                    <?
                    $qSqlItem = mysql_query("
                                            SELECT 
                                                mod_retornos_de_validacao.numeroUnico,
                                                mod_retornos_de_validacao.nome
                                                 
                                            FROM 
                                                retornos_de_validacao AS mod_retornos_de_validacao 
                                            WHERE
                                                (mod_retornos_de_validacao.stat='0' OR mod_retornos_de_validacao.stat='1') AND
                                                mod_retornos_de_validacao.tipo='cancela' AND
                                                mod_retornos_de_validacao.empresa='".$rSqlModal['empresa']."' 
                                            ORDER BY 
                                                mod_retornos_de_validacao.nome");
                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                    ?>
                    <option value="<?= $rSqlItem['numeroUnico'] ?>" <? if(trim($rSqlItem['numeroUnico'])==trim($rSqlModal['numeroUnico_retornos_de_validacao'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                    <? } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="motivo_cancelamento" class="col-form-label">Mais Detalhes:</label>
                <textarea class="form-control" name="motivo_cancelamento" id="motivo_cancelamento"></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" style="float:left;" class="btn btn-secondary" onclick="javascript:<?=$script_zerarSet?>('<?=$_GET['numeroUnicoS']?>','<?=$_GET['qrCodeSendS']?>');">Fechar</button>
            <button type="button" class="btn btn-primary green" onclick="javascript:notificacao_recebida_cancela('<?=$rSqlModal['numeroUnico']?>','<?=$tipoFormSet?>');">Confirmar Cancelamento</button>
          </div>
        </div>

        <div id="DIV_sucesso_cancelamento" style="display:none;">
            <div style="text-align:center;background-color: #fff;color:#7ac142;width:100%;font-weight:bold;font-family: 'Josefin Sans', sans-serif;padding-top:20px;">
                QRCODE
            </div>
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
              <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
              <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
            </svg>
            <div style="text-align:center;background-color: #fff;color:#7ac142;width:100%;font-weight:bold;font-family: 'Josefin Sans', sans-serif;padding-bottom:20px;">
                CANCELADO COM SUCESSO!
            </div>
        </div>

        <div class="div_inativo" id="reenviar-notificacao-<?=$rSqlModal['id']?>">
          <div class="modal-body">
              <div class="form-group">
                <label for="motivo_reenvio" class="col-form-label">Motivo do reenvio:</label>
                <textarea class="form-control" name="motivo_reenvio" id="motivo_reenvio"></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" style="float:left;" class="btn btn-secondary" onclick="javascript:<?=$script_zerarSet?>('<?=$_GET['numeroUnicoS']?>','<?=$_GET['qrCodeSendS']?>');">Fechar</button>
            <button type="button" class="btn btn-primary green" onclick="javascript:notificacao_recebida_reenvia_notificacao('<?=$rSqlModal['numeroUnico']?>');">Reenviar Notificação</button>
          </div>
        </div>

        <div class="div_inativo" id="confirmar-utilizacao-<?=$rSqlModal['id']?>">
          <div class="modal-body">

              <? $data_confirmacaoSet = date("d/m/Y"); ?>
              <input type="hidden" name="data_confirmacao" id="data_confirmacao" value="<?=$data_confirmacaoSet?>">
              <input type="hidden" name="numeroUnico_validador" id="numeroUnico_validador" value="<?=$sysusu['numeroUnico']?>">
              <div class="form-group">
                <label for="numeroUnico_evento" class="col-form-label">Data da Confirmação:</label>
                <div class="col-md-12" style="padding-left:0px;padding-right: 0px;margin-bottom:10px;">
                    <div class="col-md-12" style="padding:0px;">
                        <div class="input-group date date-picker" id="TI_data_confirmacao" data-date-format="dd/mm/yyyy"  data-date="<?=$data_confirmacaoSet?>">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span> 
                            <input type="text" disabled="disabled" class="form-control input-sm" value="<?=$data_confirmacaoSet?>" style="height: 34px;margin-top:0px;">
                        </div>
                    </div>
                </div>
              </div>

              <div class="form-group">
                <label for="numeroUnico_validador" class="col-form-label">Validador Responsável:</label>
                <input type="text" disabled="disabled" class="form-control input-sm" value="<?=$sysusu['nome']?>" style="height: 34px;margin-top:0px;">
              </div>
              
              
          </div>
          <div class="modal-footer">
            <button type="button" style="float:left;" class="btn btn-secondary" onclick="javascript:<?=$script_zerarSet?>('<?=$_GET['numeroUnicoS']?>','<?=$_GET['qrCodeSendS']?>');">Fechar</button>

            <? if(trim($rSqlModal['confirmado'])=="1") { ?>
            <button type="button" class="btn btn-primary green" onclick="javascript:validacao_web_notificacao_recebida_confirmar('<?=$rSqlModal['numeroUnico']?>','<?=$tipoFormSet?>');">Confirmar Correção</button>
            <? } else { ?>
            <button type="button" class="btn btn-primary green" onclick="javascript:validacao_web_notificacao_recebida_confirmar('<?=$rSqlModal['numeroUnico']?>','<?=$tipoFormSet?>');">Confirmar Utilização</button>
            <? } ?>
          </div>
        </div>

        <div id="DIV_sucesso_confirmar" style="display:none;">
            <div style="text-align:center;background-color: #fff;color:#7ac142;width:100%;font-weight:bold;font-family: 'Josefin Sans', sans-serif;padding-top:20px;">
                QRCODE
            </div>
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
              <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
              <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
            </svg>
            <div style="text-align:center;background-color: #fff;color:#7ac142;width:100%;font-weight:bold;font-family: 'Josefin Sans', sans-serif;padding-bottom:20px;">
            	<? if(trim($rSqlModal['confirmado'])=="1") { ?>
                CORRIGIDO COM SUCESSO!
                <? } else { ?>
                CONFIRMADO COM SUCESSO!
                <? } ?>
            </div>
        </div>
        <? } ?>
    <? } ?>
<? } ?>



