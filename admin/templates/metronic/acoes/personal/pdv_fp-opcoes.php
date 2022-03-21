<?
header('Access-Control-Allow-Origin: *');

if(trim($_GET['numeroUnico_paiS'])=="") {
	$numeroUnico_paiS = $numeroUnicoGerado;
} else {
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");
	
	$numeroUnico_paiS = $_GET['numeroUnico_paiS'];
}

$rSqlEmpresaPdv = mysql_fetch_array(mysql_query("
												SELECT 
													mod_empresa_taxas.taxa_pdv_split_cms,
													mod_empresa_taxas.taxa_pdv_ccr_cms,
													mod_empresa_taxas.taxa_pdv_ccd_cms,
													mod_empresa_taxas.taxa_pdv_pix_cms,
													mod_empresa_taxas.taxa_pdv_din_cms,
													mod_empresa_taxas.taxa_pdv_bol_cms,
													mod_empresa_taxas.taxa_pdv_cor_cms,

													mod_empresa.fator_parcela1,
													mod_empresa.fator_parcela2,
													mod_empresa.fator_parcela3,
													mod_empresa.fator_parcela4,
													mod_empresa.fator_parcela5,
													mod_empresa.fator_parcela6,
													mod_empresa.fator_parcela7,
													mod_empresa.fator_parcela8,
													mod_empresa.fator_parcela9,
													mod_empresa.fator_parcela10,
													mod_empresa.fator_parcela11,
													mod_empresa.fator_parcela12,
													mod_empresa.fator_parcela_deb
												FROM 
													empresa_taxas AS mod_empresa_taxas
												LEFT JOIN 
													empresa AS mod_empresa ON (mod_empresa.id = mod_empresa_taxas.empresa)
												WHERE 
												   mod_empresa_taxas.empresa='".$rSqlPdvBilheteria['empresa']."' 
													"));

$valorTotalGet = 0;
$carrinhoArray = unserialize($_SESSION['pdv_lista_'.$numeroUnico_paiS.'']);
$carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
foreach ($carrinhoArray as $key => $value) {
	$contLista++;
	$valorTotalGet = $valorTotalGet + $value['valor'];
}

$valorRestante = $valorTotalGet;

$valorCCR = $valorRestante + ($valorRestante / 100 * $rSqlEmpresaPdv["taxa_pdv_ccr_cms"]);
$parcela = $valorCCR / 1;
$valorCCR = $parcela * $rSqlEmpresaPdv['fator_parcela1'];
$valorCCR = $valorCCR * 1;
$valorCCR = round($valorCCR,2);

$valorDIN = $valorRestante + ($valorRestante / 100 * $rSqlEmpresaPdv["taxa_pdv_din_cms"]);
$valorCCD = $valorRestante + ($valorRestante / 100 * $rSqlEmpresaPdv["taxa_pdv_ccd_cms"]);
$valorPIX = $valorRestante + ($valorRestante / 100 * $rSqlEmpresaPdv["taxa_pdv_pix_cms"]);

$valorParcelado = $valorRestante + ($valorRestante / 100 * $rSqlEmpresaPdv["taxa_pdv_ccr_cms"]);
?>

<style>
.form-forma_pagamento {
	width: 100%;
	height: calc(1.5em + 1.3rem + 2px);
	padding: 10px 10px 25px 10px;
	font-size: 14px;
	font-weight: 400;
	line-height: 15px;
	color: #495057;
	background-color: #fff;
	background-clip: padding-box;
	border: 1px solid #e2e5ec;
	border-radius: 4px !important;
	transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.col-esq {
	width: 60%;
	float:left;
}
.col-dir {
	width: 40%;
	float:left;
}
.radio_forma_pagamento {
	display:block !important;
	float:left;
	margin-right:8.5px;
	margin-top:1px;
	margin-left:0px;
}

@media (max-width: 768px) {
}
</style>

<div style="display:none;">
valorCCR_format:<input type="text" id="valor_total_ccr_format" value="R$ <?=number_format($valorCCR, 2, ',', '.')?>" /><br />
valorDIN_format:<input type="text" id="valor_total_din_format" value="R$ <?=number_format($valorDIN, 2, ',', '.')?>" /><br />
valorCCD_format:<input type="text" id="valor_total_ccd_format" value="R$ <?=number_format($valorCCD, 2, ',', '.')?>" /><br />
valorPIX_format:<input type="text" id="valor_total_pix_format" value="R$ <?=number_format($valorPIX, 2, ',', '.')?>" /><br />

valorCCR:<input type="text" id="valor_total_ccr" value="<?=$valorCCR?>" /><br />
valorDIN:<input type="text" id="valor_total_din" value="<?=$valorDIN?>" /><br />
valorCCD:<input type="text" id="valor_total_ccd" value="<?=$valorCCD?>" /><br />
valorPIX:<input type="text" id="valor_total_pix" value="<?=$valorPIX?>" /><br />

valor_total_carrinho_format:<input type="text" id="valor_total_carrinho_format" value="<?=number_format($valorTotalGet, 2, ',', '.')?>" /><br />
valor_total_carrinho:<input type="text" id="valor_total_carrinho" value="<?=$valorTotalGet?>" /><br />

</div>

<div class="row" style="width:100%;margin-left:0px;margin-right:0px;">
	<? if(trim($rSqlPdvBilheteria['ccr'])=="1") { ?>
	<div class="col-xl-12" style="margin-bottom:10px;">
		<div class="form-forma_pagamento" onclick="javascript:set_tipo_pagamento_pdv_NOVO('CCR');">
            <div class="col-esq">
                <i id="radio_check_forma_pagamento_CCR" fp="CCR" class="far fa-circle radio_forma_pagamento"></i>
                <label>Cartão de Crédito</label>
            </div>
            <div class="col-dir" style="text-align:right;padding-right:5px;">&nbsp;R$ <?=number_format($valorCCR, 2, ',', '.')?></div>
		</div>
	</div>
    <? } ?>

	<? if(trim($rSqlPdvBilheteria['din'])=="1") { ?>
	<div class="col-xl-12" style="margin-bottom:10px;">
		<div class="form-forma_pagamento" onclick="javascript:set_tipo_pagamento_pdv_NOVO('DIN');">
            <div class="col-esq">
                <i id="radio_check_forma_pagamento_CCR" fp="DIN" class="far fa-circle radio_forma_pagamento"></i>
                <label>Dinheiro</label>
            </div>
            <div class="col-dir" style="text-align:right;padding-right:5px;">&nbsp;R$ <?=number_format($valorDIN, 2, ',', '.')?></div>
		</div>
	</div>
    <? } ?>

	<? if(trim($rSqlPdvBilheteria['ccd'])=="1") { ?>
	<div class="col-xl-12" style="margin-bottom:10px;">
		<div class="form-forma_pagamento" onclick="javascript:set_tipo_pagamento_pdv_NOVO('CCD');">
            <div class="col-esq">
                <i id="radio_check_forma_pagamento_CCR" fp="CCD" class="far fa-circle radio_forma_pagamento"></i>
                <label>Cartão de Débito</label>
            </div>
            <div class="col-dir" style="text-align:right;padding-right:5px;">&nbsp;R$ <?=number_format($valorCCD, 2, ',', '.')?></div>
		</div>
	</div>
    <? } ?>

	<? if(trim($rSqlPdvBilheteria['pix'])=="1") { ?>
	<div class="col-xl-12" style="margin-bottom:10px;">
		<div class="form-forma_pagamento" onclick="javascript:set_tipo_pagamento_pdv_NOVO('PIX');">
            <div class="col-esq">
                <i id="radio_check_forma_pagamento_PIX" fp="PIX" class="far fa-circle radio_forma_pagamento"></i>
                <label>PIX</label>
            </div>
            <div class="col-dir" style="text-align:right;padding-right:5px;">&nbsp;R$ <?=number_format($valorPIX, 2, ',', '.')?></div>
		</div>
	</div>
    <? } ?>

	<? if(trim($rSqlPdvBilheteria['cortesia'])=="1") { ?>
    <div class="col-xl-12" style="margin-bottom:10px;">
		<div class="form-forma_pagamento" onclick="javascript:set_tipo_pagamento_pdv_NOVO('COR');">
            <div class="col-esq">
                <i id="radio_check_forma_pagamento_CCR" fp="COR" class="far fa-circle radio_forma_pagamento"></i>
                <label>Cortesia</label>
            </div>
            <div class="col-dir" style="text-align:right;padding-right:5px;">&nbsp;R$ 0,00</div>
		</div>
	</div>
    <? } ?>

    <div class="col-md-12" id="DIV_parcelamento" style="display:none;">
        <div class="form-group">
            <label>Quantidade de Parcelas</label>
            <select class="form-control" name="qtd_parcelas" id="qtd_parcelas" onchange="javascript:muda_valor_total();">
                <? 
                for ($x = 1; $x <= 12; $x++) { 
                    if(trim($rSqlEmpresaPdv['fator_parcela'.$x.''])=="" || trim($rSqlEmpresaPdv['fator_parcela'.$x.''])=="0") { } else { 
                        if($x==1) { $selected_set_parcelas = " selected"; } else { $selected_set_parcelas = ""; }
                        $parcela = $valorParcelado / $x;
                        $total_parcelado = $parcela * $rSqlEmpresaPdv['fator_parcela'.$x.''];
                        $total_parcelado = $total_parcelado * $x;
                        $total_parcelado = round($total_parcelado,2);
                        $total_parcelado = number_format($total_parcelado, 2, ',', '.');
    
                        $parcela = number_format($parcela, 2, ',', '.');
    
                        $texto_sufixo = "".$x."x de (".$parcela.") total de (".$total_parcelado.") c/ Juros";
                ?>
                <option value="<?=$x?>" <?=$selected_set_parcelas?>><?=$texto_sufixo?></option>
                <? } } ?>
            </select>
            <? 
            for ($x = 1; $x <= 12; $x++) { 
                if(trim($rSqlEmpresaPdv['fator_parcela'.$x.''])=="" || trim($rSqlEmpresaPdv['fator_parcela'.$x.''])=="0") { } else { 
                    $parcela = $valorParcelado / $x;
                    $total_parcelado = $parcela * $rSqlEmpresaPdv['fator_parcela'.$x.''];
                    $total_parcelado = $total_parcelado * $x;
                    $total_parcelado = round($total_parcelado,2);
            ?>
            <input value="R$ <?=number_format($total_parcelado, 2, ',', '.')?>" id="format_fator_parcela<?=$x?>" type="hidden" />
            <input value="<?=$total_parcelado?>" id="fator_parcela<?=$x?>" type="hidden" />
            <? } } ?>
        </div>
    </div>
    
</div>
<input type="hidden" name="forma_de_pagamento" id="forma_de_pagamento" value="" />


