<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$rSqlEvento = mysql_fetch_array(mysql_query("SELECT lotes FROM eventos WHERE numeroUnico='".$_GET['numeroUnico_eventoS']."'"));
$carrinhoArray = unserialize($rSqlEvento['lotes']);
$carrinhoArray = array_sort($carrinhoArray, 'lote', SORT_ASC);
foreach ($carrinhoArray as $key => $value) {
	if(trim($_GET['numeroUnico_ticketS'])==trim($value['numeroUnico_ticket'])) {
		$contLotes++;
	}
}
?>
<? if($contLotes>0) { ?>
<div class="note note-info" style="margin-bottom:0px;">
	<p><b>Os valores abaixo servem apenas como referência</b><br />Lotes disponíveis deste ticket</p>
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
		</tr>

	</thead>

	<tbody>
		<?
		$corSet = "#ffffff";
		$carrinhoArray = unserialize($rSqlEvento['lotes']);
		$carrinhoArray = array_sort($carrinhoArray, 'lote', SORT_ASC);
		foreach ($carrinhoArray as $key => $value) {
			if(trim($_GET['numeroUnico_ticketS'])==trim($value['numeroUnico_ticket'])) {
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
	   </tr>
		<? } ?>
		<? } ?>
	</tbody>
</table>
<? } else { ?>
<div class="note note-info" style="margin-bottom:0px;">
	<p>Este ticket não possui lotes criados</p>
</div>
<? } ?>
