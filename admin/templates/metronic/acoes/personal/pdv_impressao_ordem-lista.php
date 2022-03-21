<?
if(trim($_GET['numeroUnico_paiS'])=="") {
	$numeroUnico_paiS = $numeroUnicoGerado;
} else {
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
	
	$numeroUnico_paiS = $_GET['numeroUnico_paiS'];
}

$contLista = 0;
$_SESSION['imp_pdv_ordenacao_'.$numeroUnico_paiS.''] = $_SESSION['imp_pdv_ordenacao_'.$numeroUnico_paiS.''];
?>
<style>
@media screen and (min-width:1024px){
	.hide-on-desktop{display:none!important}
	.show-on-desktop{display:block}
}

@media screen and (max-width:1023px){
	.hide-on-mobile{display:none!important}
	.show-on-mobile{display:block}
}

.table-bordered {
	border: 0px solid #e7ecf1 !important;
}
.table-striped > tbody > tr:nth-of-type(odd) {
	background-color: #f1f1f1 !important;
}
.table-bordered > thead > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > tfoot > tr > td {
	border: 0px solid #e7ecf1 !important;
}
</style>
<table class="table table-striped table-bordered table-hover display table-header-fixed" style="background-color:#ffffff;" cellspacing="0" width="100%">

    <thead>

        <tr>
            <th style="width:50px;"></th>
            <th style="width:50px;">Ordem</th>
            <th>Título</th>
        </tr>

    </thead>

    <tbody>
		<? if(trim($_SESSION['imp_pdv_ordenacao_'.$numeroUnico_paiS.''])=="") { ?>
            <tr role="row">
                <td colspan="5" style="vertical-align:middle;text-align:center;">Não existe ordenação setada</td>
            </tr>
        <? } else { ?>
			<?
            $corSet = "#ffffff";
            $carrinhoArray = unserialize($_SESSION['imp_pdv_ordenacao_'.$numeroUnico_paiS.'']);
            $carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
            foreach ($carrinhoArray as $key => $value) {
                $contLista++;
                if($corSet=="#ffffff") {
                    $corSet = "#e2e2e2";
                } else {
                    $corSet = "#ffffff";
                }

				if($value['campo']=="imp_imagem_do_evento_ordem") { $moduloSet = "Imagem do Evento";
				} else if($value['campo']=="imp_compra_id_ordem") { $moduloSet = "Id da Compra";
				} else if($value['campo']=="imp_evento_nome_ordem") { $moduloSet = "Nome do Evento";
				} else if($value['campo']=="imp_ingresso_nome_ordem") { $moduloSet = "Nome do Ingresso/Ticket";
				} else if($value['campo']=="imp_ingresso_data_ordem") { $moduloSet = "Data do Ingresso/Ticket";
				} else if($value['campo']=="imp_ingresso_cadeira_ordem") { $moduloSet = "Informações de Local Marcado";
				} else if($value['campo']=="imp_compra_adicionais_ordem") { $moduloSet = "Adicionais Selecionados";
				} else if($value['campo']=="imp_compra_valor_ordem") { $moduloSet = "Valor Pago";
				} else if($value['campo']=="imp_pessoa_nome_ordem") { $moduloSet = "Nome do Beneficiário";
				} else if($value['campo']=="imp_pessoa_documento_ordem") { $moduloSet = "Documento do Beneficiário";
				} else if($value['campo']=="imp_compra_data_pagamento_ordem") { $moduloSet = "Data do Pagamento";
				} else if($value['campo']=="imp_pdv_nome_ordem") { $moduloSet = "Nome do PDV";
				} else if($value['campo']=="imp_pdv_id_ordem") { $moduloSet = "Id do PDV";
				} else if($value['campo']=="imp_sysusu_nome_ordem") { $moduloSet = "Nome do Usuário do PDV";
				} else if($value['campo']=="imp_sysusu_email_ordem") { $moduloSet = "E-mail do Usuário do PDV";
				} else if($value['campo']=="imp_sysusu_documento_ordem") { $moduloSet = "Documento do Usuário do PDV";
				} else if($value['campo']=="imp_cod_voucher_qrcode_ordem") { $moduloSet = "Código Voucher QRCode";
				} else if($value['campo']=="imp_cod_voucher_barras_ordem") { $moduloSet = "Código Voucher Barra";
				} else if($value['campo']=="imp_cod_voucher_ordem") { $moduloSet = "Código Voucher Texto";
				} else if($value['campo']=="imp_info_impressao_ticket_ordem") { $moduloSet = "Informações de Impressão do Ticket";
				} else if($value['campo']=="imp_imagem_impressao_ticket_ordem") { $moduloSet = "Imagem de Informação de Impressão do Ticket";
				} else if($value['campo']=="imp_empresa_nome_ordem") { $moduloSet = "Powered By Empresa";
				} else if($value['campo']=="imp_empresa_logo_ordem") { $moduloSet = "Logo da Empresa"; }
            ?>
            <tr style="background-color:<?=$corSet?>;" role="row">
                <td style="vertical-align:middle;text-align:center;">
                <? if(count($carrinhoArray)==1) { ?>
                    <i class="fa fa-circle" style="font-size: 6px;"></i>
                <? } else { ?>
                    <? if($contLista==count($carrinhoArray)) { ?> 
                        <i onClick="pdv_impressao_ordem_ordem('<?=$value['numeroUnico']?>','<?=$value['ordem']?>','menos');" class="fa fa-arrow-up"></i>
                    <? } else { ?>
                        <? if($contLista==1) { ?> 
                            <i onClick="pdv_impressao_ordem_ordem('<?=$value['numeroUnico']?>','<?=$value['ordem']?>','mais');" class="fa fa-arrow-down"></i>
                        <? } else { ?>
                            <i onClick="pdv_impressao_ordem_ordem('<?=$value['numeroUnico']?>','<?=$value['ordem']?>','menos');" class="fa fa-arrow-up"></i>
                            <br />
                            <i onClick="pdv_impressao_ordem_ordem('<?=$value['numeroUnico']?>','<?=$value['ordem']?>','mais');" class="fa fa-arrow-down"></i>
                        <? } ?>
                    <? } ?>
                <? } ?>
                </td>
                <td style="vertical-align:middle;"><?=$value['ordem']?></td>
                <td style="vertical-align:middle;"><?=$moduloSet?></td>
    
            </tr>
            <? } ?>
		<? } ?>
    </tbody>
</table>
