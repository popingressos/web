<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$tipoFormSet = "reload";

if(trim($sysusu['empresa'])=="0" || trim($sysusu['empresa'])=="") {
	$filtro_empresa_notificacao = " (mod_carrinho.plataforma='".$_GET['empresaS']."' OR mod_carrinho.empresa='".$_GET['empresaS']."') ";
} else {
	$filtro_empresa_notificacao = " mod_carrinho.empresa='".$sysusu['empresa']."' ";
}

if(trim($_GET['cod_voucher_leitorS'])=="") {
	$_GET['cpfS'] = preg_replace("/[^0-9]/", "", $_GET['cpfS']);
	
	if(strlen($_GET['cpfS'])>11) {
		$cpfDigitado = mascaraCnpj($_GET['cpfS']);
	} else {
		$cpfDigitado = mascaraCpf($_GET['cpfS']);
	}
	$filtro_carrinho_notificacao = " AND mod_carrinho.pessoa_documento='".$_GET['cpfS']."' ";
	$labelDigitado = "CPF";

	if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
		$empresaSet = $sysusu['empresa'];
	} else {
		$rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT plataforma FROM empresa WHERE id='".$sysusu['empresa']."'"));
		if(trim($rSqlPlataforma['plataforma'])=="" || trim($rSqlPlataforma['plataforma'])=="0") {
			$empresaSet = $sysusu['empresa'];
		} else { 
			$empresaSet = $rSqlPlataforma['plataforma'];
		}
	}
	
	$rSqlPessoa = mysql_fetch_array(mysql_query("SELECT id,nome,documento,email,whatsapp,data_de_nascimento FROM pessoas WHERE documento='".$_GET['cpfS']."' AND empresa='".$empresaSet."' AND stat='1'"));
} else {
	#echo "[".$_GET['cod_voucher_leitorS']."]";
	$filtro_carrinho_notificacao = " AND mod_carrinho.cod_voucher='".$_GET['cod_voucher_leitorS']."' ";
	$cpfDigitado = $_GET['cod_voucher_leitorS'];
	$labelDigitado = "Código Voucher";
}

$strSqlN = "
	SELECT 
		COUNT(*)
	FROM 
		carrinho_notificacao AS mod_carrinho 
	
	WHERE 
		".$filtro_empresa_notificacao."
		".$filtro_carrinho_notificacao."

	ORDER BY
		mod_carrinho.data DESC
		
";

$nSqlIngresso = mysql_fetch_row(mysql_query("".$strSqlN.""));
if($nSqlIngresso[0]==0) {
?>
    <div class="form-row" style="padding:5px;padding-bottom:0px;margin-bottom:0px;">
        <div class="form-group col" style="border-left:3px solid #1bc5bd;padding:10px;background-color:#c9f7f5;margin-bottom:0px;">
        	<b>Atenção</b><br />
            Este <?=$labelDigitado?> informado <b><?=$cpfDigitado?></b> não possui itens disponíveis<br />
        </div>
    </div>

    <div class="col-md-12" style="background-color: #fff;padding-left:5px;padding-right:5px;text-align:left;">
        <button type="button" class="btn yellow-gold input-label" style="margin-left: 0px;margin-top:5px;margin-bottom:5px;" onclick="javascript:validacao_zerar();">Nova Pesquisa</button>
    </div>
<? } else { ?>
	<? $data_confirmacaoSet = date("d/m/Y"); ?>
    <input type="hidden" name="data_confirmacao" id="data_confirmacao" value="<?=$data_confirmacaoSet?>">
    <input type="hidden" name="numeroUnico_validador" id="numeroUnico_validador" value="<?=$sysusu['numeroUnico']?>">

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
<?
	$qSqlItem = mysql_query("
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
							".$filtro_carrinho_notificacao."
						GROUP BY 
							mod_carrinho.id 
						ORDER BY 
							mod_carrinho.id 
						");
	
	$cont_eventos=0;
	while($rSqlItem = mysql_fetch_array($qSqlItem)) {
		if(trim($rSqlItem['id'])=="") { $rSqlItem['id'] = NULL; } else { $rSqlItem['id'] = $rSqlItem['id']; }
		if(trim($rSqlItem['numeroUnico'])=="") { $rSqlItem['numeroUnico'] = NULL; } else { $rSqlItem['numeroUnico'] = "".$rSqlItem['numeroUnico'].""; }
		if(trim($rSqlItem['numeroUnico_pessoa'])=="") { $rSqlItem['numeroUnico_pessoa'] = NULL; } else { $rSqlItem['numeroUnico_pessoa'] = "".$rSqlItem['numeroUnico_pessoa'].""; }
		if(trim($rSqlItem['numeroUnico_evento'])=="") { $rSqlItem['numeroUnico_evento'] = NULL; } else { $rSqlItem['numeroUnico_evento'] = "".$rSqlItem['numeroUnico_evento'].""; }
		if(trim($rSqlItem['cod_voucher'])=="") { $rSqlItem['cod_voucher'] = NULL; } else { $rSqlItem['cod_voucher'] = "".$rSqlItem['cod_voucher'].""; }
	
		if(trim($rSqlItem['usuario_nome'])=="") { $rSqlItem['usuario_nome'] = NULL; } else { $rSqlItem['usuario_nome'] = "".$rSqlItem['usuario_nome'].""; }
		if(trim($rSqlItem['usuario_cpf'])=="") { $rSqlItem['usuario_cpf'] = NULL; } else { $rSqlItem['usuario_cpf'] = "".$rSqlItem['usuario_cpf'].""; }
		if(trim($rSqlItem['usuario_genero'])=="") { $rSqlItem['usuario_genero'] = NULL; } else { $rSqlItem['usuario_genero'] = "".$rSqlItem['usuario_genero'].""; }
	
		if(trim($rSqlItem['eventos_nome'])=="") { $rSqlItem['eventos_nome'] = NULL; } else { $rSqlItem['eventos_nome'] = "".$rSqlItem['eventos_nome'].""; }
		if(trim($rSqlItem['eventos_data_vinculacao_inicio'])=="") { $rSqlItem['eventos_data_vinculacao_inicio'] = NULL; } else { $rSqlItem['eventos_data_vinculacao_inicio'] = "".$rSqlItem['eventos_data_vinculacao_inicio'].""; }
		if(trim($rSqlItem['eventos_data_vinculacao_fim'])=="") { $rSqlItem['eventos_data_vinculacao_fim'] = NULL; } else { $rSqlItem['eventos_data_vinculacao_fim'] = "".$rSqlItem['eventos_data_vinculacao_fim'].""; }
	
		$ticketArray = unserialize($rSqlItem['eventos_tickets']);
		$ticketArray = array_sort($ticketArray, 'ticket_data', SORT_ASC);
		foreach ($ticketArray as $key => $value_ticket) {
			if(trim($value_ticket['numeroUnico'])==trim($rSqlItem["numeroUnico_ticket"])) {
				$rSqlItem['ingresso_nome'] = $value_ticket['ticket_nome'];
				$rSqlItem['ingresso_data'] = $value_ticket['ticket_data'];
			}
		}

		if($sysusu['master']=="1") {
			$_POST['data_limite'] = date('Y-m-d', strtotime("+10 days", strtotime("".date('Y-m-d')."")));
		} else {
			$_POST['data_limite'] = date('Y-m-d', strtotime("+1 days", strtotime("".date('Y-m-d')."")));
		}
		#echo "[".$rSqlItem['ingresso_data']."] <br>";
		#$_POST['data_limite'] = date('Y-m-d');

		if(trim($rSqlItem['lote_nome'])=="") {
			$rSqlItem['lote_nome'] = "Sem definição de lote";
		} else {
			if(strrpos($rSqlItem['lote_nome'],"Lote") === false) {
				$rSqlItem['lote_nome'] = "".$rSqlItem['lote_nome']."&deg; Lote";
			} else {
				$rSqlItem['lote_nome'] = "".$rSqlItem['lote_nome']."";
			}
		}

		if(trim($rSqlItem['validador_recebeu'])=="1") { } else {
			if(trim($listaIds)=="") {
				$listaIds = "'".$rSqlItem['id']."'";
			} else {
				$listaIds = "".$listaIds.",'".$rSqlItem['id']."'";
			}
		}
	
		if(trim($rSqlItem['ingresso_data'])<=trim($_POST['data_limite'])) {
			$eventoArray[]  = array("tag" => "eventos", 
											 'cont'=> intval($cont),
											 'id'=> intval($rSqlItem['id']),
											 'numeroUnico'=> $rSqlItem['numeroUnico'],
											 'numeroUnico_pessoa'=> $rSqlItem['numeroUnico_pessoa'],
											 'numeroUnico_evento'=> $rSqlItem['numeroUnico_evento'],
											 'confirmado'=> $rSqlItem['confirmado'],
											 'data'=> $rSqlItem['data'],
											 'dataConfirmado'=> $rSqlItem['dataConfirmado'],
											 'dataBloqueado'=> $rSqlItem['dataBloqueado'],
											 'dataCancelado'=> $rSqlItem['dataCancelado'],
											 'observacao'=> $rSqlItem['observacao'],
											 'cod_voucher'=> $rSqlItem['cod_voucher'],
			
											 'usuario_nome'=> $rSqlItem['usuario_nome'],
											 'usuario_cpf'=> $rSqlItem['usuario_cpf'],
											 'usuario_email'=> $rSqlItem['usuario_email'],
			
											 'retornos_de_validacao_numeroUnico'=> "".$rSqlItem['retornos_de_validacao_numeroUnico']."",
											 'retornos_de_validacao_nome'=> "".$rSqlItem['retornos_de_validacao_nome']."",
			
											 'eventos_nome'=> $rSqlItem['eventos_nome'],
											 'eventos_data_vinculacao_inicio'=> $rSqlItem['eventos_data_vinculacao_inicio'],
											 'eventos_data_vinculacao_fim'=> $rSqlItem['eventos_data_vinculacao_fim'],
	
											 'ingresso_nome'=> $rSqlItem['ingresso_nome'],
											 'ingresso_data'=> $rSqlItem['ingresso_data'],
											 'lote_nome'=> $rSqlItem['lote_nome'],
	
											 "stat" => $rSqlItem['stat']);
			$cont_eventos++;
		}
	}
	?>
	<? if($cont_eventos>0) { ?>
    	<?
		if(strlen($rSqlPessoa['documento'])>11) {
			$rSqlPessoa['documento'] = mascaraCnpj($rSqlPessoa['documento']);
		} else {
			$rSqlPessoa['documento'] = mascaraCpf($rSqlPessoa['documento']);
		}
		?>
        <input type="hidden" id="documento_gerar_qrcode" value="<?=$_GET['cpfS']?>">
        <input type="hidden" id="empresa_gerar_qrcode" value="<?=$_GET['empresaS']?>">

		<input type="hidden" id="cod_voucher" value="">
        <div id="DIV_lista_retorno">
		<div class="form-row" style="padding:5px;padding-bottom:0px;margin-bottom:0px;">
			<div class="form-group col" style="border-left:3px solid #1bc5bd;padding:10px;background-color:#c9f7f5;margin-bottom:0px;">
				<b>Atenção</b><br />
				<? if($cont_eventos>1) {?>
				Existe mais de 1 (um) QRCode disponível para o mesmo cpf<br />
				<? } ?>
				Verifique abaixo os dados e confira se estão corretos e selecione o item clica no mesmo.<br /><br />
				<i>Vale ressaltar que você deve conferir se o <b>Evento, Ticket (Setor) e Documentos da Pessoa</b> estão de acordo com o ingresso.</i>
			</div>
		</div>
	
		<div class="form-row">
			<div class="form-group col" style="margin-bottom:0px;">
				<label class="font-weight-bold text-dark text-2" style="margin-bottom:10px;margin-top:10px;margin-left:5px;font-weight:bold;text-align:center;width:100%;">QRCodes  Disponíveis</label>
			</div>
		</div>
	
		<script>
		function seleciona_voucher_cadastro(cod_voucherSend){
			$('.voucher_check').each(function(index, element) {
				var cod_voucher_loop = $(this).attr("cod_voucher");
				if (cod_voucher_loop==cod_voucherSend) {
					$( "#voucher"+cod_voucher_loop+"" ).prop("checked", true);
					$("#DIV_voucher"+cod_voucher_loop+"").css({"border":"1px solid #CCC","padding":"10px","margin-bottom":"0px","background-color":"#f3f6f9"});
				} else {
					$( "#voucher"+cod_voucher_loop+"" ).prop("checked", false);
					$("#DIV_voucher"+cod_voucher_loop+"").css({"border":"1px solid #CCC","padding":"10px","margin-bottom":"0px","background-color":"#ffffff"});
				}
				$( "#cod_voucher" ).val(""+cod_voucherSend+"");
				$( "#BTN_confirmar_validacao" ).show();
	
			});
		
		}
		</script>
	
		<div class="form-row" style="padding:5px;padding-bottom:0px;">
            <div style="background-color: #fff;padding-left:0px;padding-right:0px;text-align:left;">
                 <table cellpadding="0" cellspacing="0" width="100%">
                	<tr>
                    	<td style="width:50%;text-align:left;">
                        <button type="button" class="btn yellow-gold input-label" style="margin-left: 0px;margin-top:5px;margin-bottom:0px;" 
                        onclick="javascript:validacao_zerar();">Nova Pesquisa</button>
                        </td>

                    	<td style="width:50%;text-align:right;" align="right">
                        <button type="button" id="BTN_confirmar_validacao" class="btn blue input-label" style="margin-left: 0px;margin-top:5px;margin-bottom:0px;" 
                        onclick="javascript:validacao_web_qrcode_pesquisa();" style="">Escolher Ação</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

		<?
		$eventoArray = array_sort($eventoArray, 'data', SORT_ASC);
		foreach ($eventoArray as $key => $value) {
	
			$motivoTxt = "";
			if(trim($value['stat'])=="4") {
				$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"btn\" 
				 style=\"background-color:#000;text-align:center;color:#FFF;margin-right: 0px;margin-top: -5px;padding-top: 1px;padding-bottom: 1px;width:125px;\"> BLOQUEADO </a>";
			} else if(trim($value['stat'])=="5") {
				if(trim($value['retornos_de_validacao_nome'])=="") {
					$motivoTxt = $value['observacao'];
				} else {
					$motivoTxt = $value['retornos_de_validacao_nome'];
				}
				$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"btn\" 
				 style=\"background-color:#000;text-align:center;color:#FFF;margin-right: 0px;margin-top: -5px;padding-top: 1px;padding-bottom: 1px;width:125px;\"> CANCELADO </a>";
			} else {
				if(trim($value['confirmado'])=="1") {
					$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"btn\" 
					 style=\"background-color:#093;text-align:center;color:#FFF;margin-right: 0px;margin-top: -5px;padding-top: 1px;padding-bottom: 1px;width:125px;\"> JÁ UTILIZADO </a>";
				} else if(trim($value['confirmado'])=="0" || trim($value['confirmado'])=="") {
					$confirmadoSet = "<a href=\"javascript:void(0);\" class=\"btn\"
					 style=\"background-color:#c00;text-align:center;color:#FFF;margin-right: 10px;margin-top: -5px;padding-top: 1px;padding-bottom: 1px;width:125px;\"> NÃO UTILIZADO </a>";
				}
			}
		?>
		<div class="form-row" style="padding:5px;">
			<div id="DIV_voucher<?= $value['cod_voucher'] ?>" cod_voucher="<?= $value['cod_voucher'] ?>" class="voucher_check"
				 <? if(trim($value['stat'])=="4") { ?>
				 onclick="javascript:alert('Este item não pode ser selecionado pois já foi bloqueado');" 
				 <? } else if(trim($value['stat'])=="5") { ?>
				 onclick="javascript:alert('Este item não pode ser selecionado pois já foi cancelado');" 
				 <? } else { ?>
				 onclick="javascript:seleciona_voucher_cadastro('<?= $value['cod_voucher'] ?>');" 
				 <? } ?>
				 style="border:1px solid #CCC;padding:10px;margin-bottom:0px;background-color:#ffffff;cursor:pointer;">
				<div class="custom-control custom-radio">
					<? if(trim($value['stat'])=="4" || trim($value['stat'])=="5") { } else { ?>
					<input type="radio" id="voucher<?= $value['cod_voucher'] ?>" onchange="javascript:seleciona_voucher_cadastro('<?= $value['cod_voucher'] ?>');" value="<?= $value['cod_voucher'] ?>" 
					class="custom-control-input">
					<? } ?>
					<label class="custom-control-label" for="voucher<?= $value['cod_voucher'] ?>"><?= $confirmadoSet ?></label>
				</div>
                <table cellpadding="0" cellspacing="0" width="100%">
					<? if(trim($motivoTxt)=="") { } else { ?>
                	<tr style="line-height: 25px;background-color:#FFF;">
                    	<td style="width:140px;padding-left:5px;padding-right:5px;"><b>Motivo:</b></td>
                        <td style="padding-left:5px;padding-right:5px;"><?= $motivoTxt ?></td>
                    </tr>
                    <? } ?>
					<? if(trim($value['usuario_nome'])=="") { } else { ?>
                	<tr style="line-height: 25px;background-color:#e2e2e2;">
                    	<td style="width:140px;padding-left:5px;padding-right:5px;"><b>Nome:</b></td>
                        <td style="padding-left:5px;padding-right:5px;"><?= $value['usuario_nome'] ?></td>
                    </tr>
                    <? } ?>
					<? if(trim($value['eventos_nome'])=="") { } else { ?>
                	<tr style="line-height: 25px;background-color:#FFF;">
                    	<td style="width:140px;padding-left:5px;padding-right:5px;"><b>Evento:</b></td>
                        <td style="padding-left:5px;padding-right:5px;"><?= $value['eventos_nome'] ?></td>
                    </tr>
                    <? } ?>
					<? if(trim($value['ingresso_nome'])=="") { } else { ?>
                	<tr style="line-height: 25px;background-color:#e2e2e2;">
                    	<td style="width:140px;padding-left:5px;padding-right:5px;"><b>Ticket:</b></td>
                        <td style="padding-left:5px;padding-right:5px;"><?= $value['ingresso_nome'] ?></td>
                    </tr>
                    <? } ?>
					<? if(trim($value['ingresso_data'])=="") { } else { ?>
                	<tr style="line-height: 25px;background-color:#e2e2e2;">
                    	<td style="width:140px;padding-left:5px;padding-right:5px;"><b>Ticket Data:</b></td>
                        <td style="padding-left:5px;padding-right:5px;"><?=ajustaDataReturn($value['ingresso_data'],"d/m/Y");?></td>
                    </tr>
                    <? } ?>
					<? if(trim($value['lote_nome'])=="") { } else { ?>
                	<tr style="line-height: 25px;background-color:#FFF;">
                    	<td style="width:140px;padding-left:5px;padding-right:5px;"><b>Lote:</b></td>
                        <td style="padding-left:5px;padding-right:5px;"><?= $value['lote_nome'] ?></td>
                    </tr>
                    <? } ?>
					<? if(trim($value['dataConfirmado'])=="" || trim($value['dataConfirmado'])=="0000-00-00 00:00:00") { } else { ?>
                	<tr style="line-height: 25px;background-color:#FFF;">
                    	<td style="width:140px;padding-left:5px;padding-right:5px;"><b>Utilizado em:</b></td>
                        <td style="padding-left:5px;padding-right:5px;"><?=ajustaDataReturn($value['dataConfirmado'],"d/m/Y");?></td>
                    </tr>
                    <? } ?>
					<? if(trim($value['dataCancelado'])=="" || trim($value['dataCancelado'])=="0000-00-00 00:00:00") { } else { ?>
                	<tr style="line-height: 25px;background-color:#FFF;">
                    	<td style="width:140px;padding-left:5px;padding-right:5px;"><b>Cancelado em:</b></td>
                        <td style="padding-left:5px;padding-right:5px;"><?=ajustaDataReturn($value['dataCancelado'],"d/m/Y");?></td>
                    </tr>
                    <? } ?>
                    
                    <? if(trim($value['confirmado'])=="1") { } else { ?>
                    <tr>
                    	<td colspan="2">
                            <table cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="width:50%;text-align:left;" align="left">
                                    <button type="button" class="btn green input-label" style="margin-left: 0px;margin-top:5px;margin-bottom:0px;margin-right:30px;" 
                                    onclick="javascript:validacao_web_qrcode_direta('<?=$value['numeroUnico']?>','<?=$tipoFormSet?>');">VALIDAR</button>
                                    </td>

                                    <td style="width:50%;text-align:right;" align="right">
                                    <button type="button" class="btn red input-label" style="margin-left: 0px;margin-top:5px;margin-bottom:0px;" 
                                    onclick="javascript:validacao_zerar();">NÃO VALIDAR</button>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <? } ?>
                </table>
			</div>
		</div>
		<? } ?>
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

	<? } else { ?>
    	<?
		if(strlen($rSqlPessoa['documento'])>11) {
			$rSqlPessoa['documento'] = mascaraCnpj($rSqlPessoa['documento']);
		} else {
			$rSqlPessoa['documento'] = mascaraCpf($rSqlPessoa['documento']);
		}
		?>
        <input type="hidden" id="documento_gerar_qrcode" value="<?=$_GET['cpfS']?>">
        <input type="hidden" id="empresa_gerar_qrcode" value="<?=$_GET['empresaS']?>">
        <script>$('#BTN_gerar_qrcode').show();</script>
		<div class="form-row" style="padding:5px;padding-bottom:0px;margin-bottom:0px;">
			<div class="form-group col" style="border-left:3px solid #1bc5bd;padding:10px;background-color:#c9f7f5;margin-bottom:0px;">
				<b>Atenção</b><br />
				Não existe nenhum QR Code disponível para este CPF<br />
				Verifique abaixo os dados da pessoa e confira se estão corretos.<br /><br />
			</div>
		</div>
		<div class="form-row" style="padding:5px;">
			<div class="form-group col">
                <table cellpadding="0" cellspacing="0" width="100%">
                	<tr style="line-height: 25px;background-color:#FFF;">
                    	<td style="width:150px;padding-left:5px;padding-right:5px;"><b>Nome:</b></td>
                        <td style="padding-left:5px;padding-right:5px;"><?= $rSqlPessoa['nome'] ?></td>
                    </tr>
                	<tr style="line-height: 25px;background-color:#e2e2e2;">
                    	<td style="width:150px;padding-left:5px;padding-right:5px;"><b>Documento:</b></td>
                        <td style="padding-left:5px;padding-right:5px;"><?= $rSqlPessoa['documento'] ?></td>
                    </tr>
                	<tr style="line-height: 25px;background-color:#FFF;">
                    	<td style="width:150px;padding-left:5px;padding-right:5px;"><b>E-mail:</b></td>
                        <td style="padding-left:5px;padding-right:5px;"><?= $rSqlPessoa['email'] ?></td>
                    </tr>
                	<tr style="line-height: 25px;background-color:#e2e2e2;">
                    	<td style="width:150px;padding-left:5px;padding-right:5px;"><b>WhatsApp:</b></td>
                        <td style="padding-left:5px;padding-right:5px;"><?= $rSqlPessoa['whatsapp'] ?></td>
                    </tr>
					<? if(trim($rSqlPessoa['data_de_nascimento'])=="" || trim($rSqlPessoa['data_de_nascimento'])=="0000-00-00") { } else { ?>
                	<tr style="line-height: 25px;background-color:#FFF;">
                    	<td style="width:150px;padding-left:5px;padding-right:5px;"><b>Data de Nascimento:</b></td>
                        <td style="padding-left:5px;padding-right:5px;"><?=ajustaDataReturn($rSqlPessoa['data_de_nascimento'],"d/m/Y");?></td>
                    </tr>
                	<tr style="line-height: 25px;background-color:#e2e2e2;">
                    	<td style="width:150px;padding-left:5px;padding-right:5px;"><b>Idade:</b></td>
                        <td style="padding-left:5px;padding-right:5px;"><?=diferenca_entre_datas_sem_hora("".$rSqlPessoa['data_de_nascimento']."",date("Y-m-d"));?></td>
                    </tr>
                    <? } ?>
                </table>
			</div>
		</div>

        <div class="col-md-12" style="background-color: #fff;padding-left:5px;padding-right:5px;text-align:left;">
            <button type="button" class="btn yellow-gold input-label" style="margin-left: 0px;margin-top:5px;margin-bottom:5px;" onclick="javascript:validacao_zerar();">Nova Pesquisa</button>
        </div>
	<? } ?>
<? } ?>



