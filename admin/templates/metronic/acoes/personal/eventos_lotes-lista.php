<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$_SESSION['numeroUnico_ticket'] = $_GET['numeroUnico_ticketS'];

$carrinhoArray = unserialize($_SESSION['eventos_tickets_'.$_GET['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']);
$carrinhoArray = array_sort($carrinhoArray, 'ticket_nome', SORT_ASC);
foreach ($carrinhoArray as $key => $value) {
	if($_GET['numeroUnico_ticketS']==$value['numeroUnico']) {
		$nomeTicket = "".$value['ticket_nome']."";
	}
}

$contLotes = 0;
?>

<div class="note note-info" style="margin-bottom:0px;padding-top:5px;">
    <h3><font style="font-size:14px;">LOTES DO TICKET</font> <br /><b><?=$nomeTicket?></b></h3>
    <p>Preencha os campos abaixo e clique em 'Adicionar Lote' para inserir novos lotes</p>
</div>

<div class="form-group" style="margin-bottom:10px;">
    <label class="control-label col-md-12" style="text-align:left;">Valor do Lote</label>
    <div class="col-md-12">
        <input value="" type="text" id="lote_valor" onkeypress="javascript:mascara(this,calcula_taxas_lote);" placeholder="" class="form-control" />
    </div>
</div>

<input value="" type="hidden" id="lote_taxa_pdv_ccr_empresa" />
<input value="" type="hidden" id="lote_taxa_pdv_ccd_empresa" />
<input value="" type="hidden" id="lote_taxa_pdv_din_empresa" />
<input value="" type="hidden" id="lote_taxa_pdv_bol_empresa" />

<input value="" type="hidden" id="lote_taxa_site_ccr_empresa" />
<input value="" type="hidden" id="lote_taxa_site_ccd_empresa" />
<input value="" type="hidden" id="lote_taxa_site_din_empresa" />
<input value="" type="hidden" id="lote_taxa_site_bol_empresa" />

<input value="" type="hidden" id="lote_taxa_app_ccr_empresa" />
<input value="" type="hidden" id="lote_taxa_app_ccd_empresa" />
<input value="" type="hidden" id="lote_taxa_app_din_empresa" />
<input value="" type="hidden" id="lote_taxa_app_bol_empresa" />

<input value="" type="hidden" id="lote_taxa_pdv_ccr_cms" />
<input value="" type="hidden" id="lote_taxa_pdv_ccd_cms" />
<input value="" type="hidden" id="lote_taxa_pdv_din_cms" />
<input value="" type="hidden" id="lote_taxa_pdv_bol_cms" />

<input value="" type="hidden" id="lote_taxa_site_ccr_cms" />
<input value="" type="hidden" id="lote_taxa_site_ccd_cms" />
<input value="" type="hidden" id="lote_taxa_site_din_cms" />
<input value="" type="hidden" id="lote_taxa_site_bol_cms" />

<input value="" type="hidden" id="lote_taxa_app_ccr_cms" />
<input value="" type="hidden" id="lote_taxa_app_ccd_cms" />
<input value="" type="hidden" id="lote_taxa_app_din_cms" />
<input value="" type="hidden" id="lote_taxa_app_bol_cms" />

<div class="form-group" style="padding-bottom:5px;">
    <label class="control-label col-md-12" style="text-align:left;">Valores de PDV</label>
    <div class="col-md-12">
        <div class="col-md-3" style="padding-left:0px;padding-right:2.5px;">
            <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Crédito</label>
            <input value="" type="text" id="valor_pdv_ccr" onkeypress="javascript:mascara(this,moeda);" class="form-control" placeholder="" />
        </div>
        <div class="col-md-3" style="padding-left:2.5px;padding-right:2.5px;">
            <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Débito</label>
            <input value="" type="text" id="valor_pdv_ccd" onkeypress="javascript:mascara(this,moeda);" class="form-control" placeholder="" />
        </div>
        <div class="col-md-3" style="padding-left:2.5px;padding-right:2.5px;">
            <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Dinheiro</label>
            <input value="" type="text" id="valor_pdv_din" onkeypress="javascript:mascara(this,moeda);" class="form-control" placeholder="" />
        </div>
        <div class="col-md-3" style="padding-left:2.5px;padding-right:0px;">
            <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Boleto</label>
            <input value="" type="text" id="valor_pdv_bol" onkeypress="javascript:mascara(this,moeda);" class="form-control" placeholder="" />
        </div>
    </div>
</div>

<div class="form-group" style="padding-bottom:5px;">
    <label class="control-label col-md-12" style="text-align:left;">Valores de SITE</label>
    <div class="col-md-12">
        <div class="col-md-3" style="padding-left:0px;padding-right:2.5px;">
            <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Crédito</label>
            <input value="" type="text" id="valor_site_ccr" onkeypress="javascript:mascara(this,moeda);" class="form-control" placeholder="" />
        </div>
        <div class="col-md-3" style="padding-left:2.5px;padding-right:2.5px;">
            <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Débito</label>
            <input value="" type="text" id="valor_site_ccd" onkeypress="javascript:mascara(this,moeda);" class="form-control" placeholder="" />
        </div>
        <div class="col-md-3" style="padding-left:2.5px;padding-right:2.5px;">
            <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Dinheiro</label>
            <input value="" type="text" id="valor_site_din" onkeypress="javascript:mascara(this,moeda);" class="form-control" placeholder="" />
        </div>
        <div class="col-md-3" style="padding-left:2.5px;padding-right:0px;">
            <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Boleto</label>
            <input value="" type="text" id="valor_site_bol" onkeypress="javascript:mascara(this,moeda);" class="form-control" placeholder="" />
        </div>
    </div>
</div>

<div class="form-group" style="padding-bottom:5px;">
    <label class="control-label col-md-12" style="text-align:left;">Valores de APP</label>
    <div class="col-md-12">
        <div class="col-md-3" style="padding-left:0px;padding-right:2.5px;">
            <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Crédito</label>
            <input value="" type="text" id="valor_app_ccr" onkeypress="javascript:mascara(this,moeda);" class="form-control" placeholder="" />
        </div>
        <div class="col-md-3" style="padding-left:2.5px;padding-right:2.5px;">
            <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Débito</label>
            <input value="" type="text" id="valor_app_ccd" onkeypress="javascript:mascara(this,moeda);" class="form-control" placeholder="" />
        </div>
        <div class="col-md-3" style="padding-left:2.5px;padding-right:2.5px;">
            <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Dinheiro</label>
            <input value="" type="text" id="valor_app_din" onkeypress="javascript:mascara(this,moeda);" class="form-control" placeholder="" />
        </div>
        <div class="col-md-3" style="padding-left:2.5px;padding-right:0px;">
            <label class="control-label col-md-12" style="text-align:left;padding-left:0px;">Boleto</label>
            <input value="" type="text" id="valor_app_bol" onkeypress="javascript:mascara(this,moeda);" class="form-control" placeholder="" />
        </div>
    </div>
</div>

<div class="form-group" style="margin-bottom:10px;">
    <label class="control-label col-md-12" style="text-align:left;">Quantidade</label>
    <div class="col-md-12">
        <input value="" type="text" id="lote_qtd" onkeypress="javascript:mascara(this,soNumeros);" placeholder="" class="form-control" />
    </div>
</div>

<div class="form-group" style="margin-bottom:10px;">
    <div class="col-md-10">
        <a class="btn input-label" onclick="javascript:eventos_lotes_add('<?=$_SESSION['numeroUnico_ticket']?>');" style="background-color:#19d18e;color:#FFF;text-align:center;"><i class="fa fa-plus"></i>&nbsp;Adicionar Lote</a>
    </div>
</div>

<div id="eventos_lotes-lista" style="width:100%;display:block;">
<? if(trim($_SESSION['eventos_lotes_'.$_GET['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].''])!="") { ?>
	<?
	$carrinhoArray = unserialize($_SESSION['eventos_lotes_'.$_GET['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']);
	$carrinhoArray = array_sort($carrinhoArray, 'lote', SORT_ASC);
	foreach ($carrinhoArray as $key => $value) {
		if(trim($_SESSION['numeroUnico_ticket'])==trim($value['numeroUnico_ticket'])) {
			$contLotes++;
		}
	}
	?>
    <? if($contLotes>0) { ?>
    <div class="note note-info" style="margin-bottom:0px;">
        <p>Lotes disponíveis deste ticket</p>
    </div>
    
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
                <th style="width:70px;">Lote</th>
                <th>Valor</th>
                <th style="width:50px;">Qtd</th>
                <th style="width:50px;"></th>
            </tr>
    
        </thead>
    
        <tbody>
            <?
            $corSet = "#ffffff";
            $carrinhoArray = unserialize($_SESSION['eventos_lotes_'.$_GET['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']);
            $carrinhoArray = array_sort($carrinhoArray, 'lote', SORT_ASC);
            foreach ($carrinhoArray as $key => $value) {
                if(trim($_SESSION['numeroUnico_ticket'])==trim($value['numeroUnico_ticket'])) {
                    if($corSet=="#ffffff") {
                        $corSet = "#e2e2e2";
                    } else {
                        $corSet = "#ffffff";
                    }
            ?>
            <tr style="background-color:<?=$corSet?>;" role="row">
                <td style="vertical-align:middle;"><?=$value['lote']?>&deg;</td>
                <td style="vertical-align:middle;">
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td colspan="4" style="font-weight:bold;font-style:italic;">Valor Original</td>
                        </tr>
                        <tr>
                            <td colspan="4"><?="R$ ".number_format($value['lote_valor'], 2, ',', '.').""?></td>
                        </tr>

                        
                        <tr>
                            <td colspan="4" style="font-weight:bold;font-style:italic;padding-top:10px;">Valores de PDV</td>
                        </tr>
                        <tr>
                            <td style="font-style:italic;font-size:10px;">Crédito</td>
                            <td style="font-style:italic;font-size:10px;">Débito</td>
                            <td style="font-style:italic;font-size:10px;">Dinheiro</td>
                            <td style="font-style:italic;font-size:10px;">Boleto</td>
                        </tr>
                        <tr>
                            <td><?="R$ ".number_format($value['valor_pdv_ccr'], 2, ',', '.').""?></td>
                            <td><?="R$ ".number_format($value['valor_pdv_ccd'], 2, ',', '.').""?></td>
                            <td><?="R$ ".number_format($value['valor_pdv_din'], 2, ',', '.').""?></td>
                            <td><?="R$ ".number_format($value['valor_pdv_bol'], 2, ',', '.').""?></td>
                        </tr>
                        
                        <tr>
                            <td colspan="4" style="font-weight:bold;font-style:italic;padding-top:10px;">Valores de SITE</td>
                        </tr>
                        <tr>
                            <td style="font-style:italic;font-size:10px;">Crédito</td>
                            <td style="font-style:italic;font-size:10px;">Débito</td>
                            <td style="font-style:italic;font-size:10px;">Dinheiro</td>
                            <td style="font-style:italic;font-size:10px;">Boleto</td>
                        </tr>
                        <tr>
                            <td><?="R$ ".number_format($value['valor_site_ccr'], 2, ',', '.').""?></td>
                            <td><?="R$ ".number_format($value['valor_site_ccd'], 2, ',', '.').""?></td>
                            <td><?="R$ ".number_format($value['valor_site_din'], 2, ',', '.').""?></td>
                            <td><?="R$ ".number_format($value['valor_site_bol'], 2, ',', '.').""?></td>
                        </tr>
                        
                        <tr>
                            <td colspan="4" style="font-weight:bold;font-style:italic;padding-top:10px;">Valores de APP</td>
                        </tr>
                        <tr>
                            <td style="font-style:italic;font-size:10px;">Crédito</td>
                            <td style="font-style:italic;font-size:10px;">Débito</td>
                            <td style="font-style:italic;font-size:10px;">Dinheiro</td>
                            <td style="font-style:italic;font-size:10px;">Boleto</td>
                        </tr>
                        <tr>
                            <td><?="R$ ".number_format($value['valor_app_ccr'], 2, ',', '.').""?></td>
                            <td><?="R$ ".number_format($value['valor_app_ccd'], 2, ',', '.').""?></td>
                            <td><?="R$ ".number_format($value['valor_app_din'], 2, ',', '.').""?></td>
                            <td><?="R$ ".number_format($value['valor_app_bol'], 2, ',', '.').""?></td>
                        </tr>
                    </table>
				</td>
                <td style="vertical-align:middle;"><?=$value['lote_qtd']?></td>
                <td style="vertical-align:middle;" class="block_check_click">
                    <div class="btn-group">
                        <? if(trim($value['stat'])=="0") { ?>
                        <span class="red btn btn-sm" onclick="javascript:eventos_lotes_stat('<?=$value['numeroUnico_ticket']?>','<?=$value['numeroUnico']?>','1');" title="Publicar"><i class="fa fa-thumbs-up"></i></span> 
                        <? } else { ?>
                        <span class="green btn btn-sm" onclick="javascript:eventos_lotes_stat('<?=$value['numeroUnico_ticket']?>','<?=$value['numeroUnico']?>','0');" title="Despublicar"><i class="fa fa-thumbs-up"></i></span> 
                        <? } ?>
                    </div>
                </td>
    
            </tr>
            <? } ?>
            <? } ?>
        </tbody>
    </table>
	<? } ?>
<? } ?>
</div>
