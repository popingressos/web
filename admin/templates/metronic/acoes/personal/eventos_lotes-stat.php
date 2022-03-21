<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$numeroUnicoItem = geraCodReturn();

$numeroUnico_ticketSet = "";
$carrinhoArray = unserialize($_SESSION['eventos_lotes_'.$_GET['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']);
foreach ($carrinhoArray as $key => $value) {
	if(trim($_GET['numeroUnicoS'])==trim($value['numeroUnico'])) {
		$numeroUnico_ticketSet = $value['numeroUnico_ticket'];
	}
}

$carrinhoArray = unserialize($_SESSION['eventos_lotes_'.$_GET['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']);
foreach ($carrinhoArray as $key => $value) {
	if(trim($numeroUnico_ticketSet)==trim($value['numeroUnico_ticket'])) {
		if(trim($_GET['numeroUnicoS'])==trim($value['numeroUnico'])) {
			$value['stat'] = $_GET['statS'];
		} else {
			$value['stat'] = "0";
		}
	} else {
		$value['stat'] = $value['stat'];
	}
	$dataControle[] = array("tag" => "eventos_lotes", 
							"lote" => "".$value['lote']."",
							"numeroUnico" => "".$value['numeroUnico']."",
							"numeroUnico_ticket" => $value['numeroUnico_ticket'],
							"lote_valor" => $value['lote_valor'],
							"lote_qtd" => $value['lote_qtd'],

							"valor_pdv_ccr" => $value['valor_pdv_ccr'],
							"valor_pdv_ccd" => $value['valor_pdv_ccd'],
							"valor_pdv_din" => $value['valor_pdv_din'],
							"valor_pdv_bol" => $value['valor_pdv_bol'],
							
							"valor_site_ccr" => $value['valor_site_ccr'],
							"valor_site_ccd" => $value['valor_site_ccd'],
							"valor_site_din" => $value['valor_site_din'],
							"valor_site_bol" => $value['valor_site_bol'],
							
							"valor_app_ccr" => $value['valor_app_ccr'],
							"valor_app_ccd" => $value['valor_app_ccd'],
							"valor_app_din" => $value['valor_app_din'],
							"valor_app_bol" => $value['valor_app_bol'],

							"lote_taxa_pdv_ccr_empresa" => $value['lote_taxa_pdv_ccr_empresa'],
							"lote_taxa_pdv_ccd_empresa" => $value['lote_taxa_pdv_ccd_empresa'],
							"lote_taxa_pdv_din_empresa" => $value['lote_taxa_pdv_din_empresa'],
							"lote_taxa_pdv_bol_empresa" => $value['lote_taxa_pdv_bol_empresa'],
							
							"lote_taxa_site_ccr_empresa" => $value['lote_taxa_site_ccr_empresa'],
							"lote_taxa_site_ccd_empresa" => $value['lote_taxa_site_ccd_empresa'],
							"lote_taxa_site_din_empresa" => $value['lote_taxa_site_din_empresa'],
							"lote_taxa_site_bol_empresa" => $value['lote_taxa_site_bol_empresa'],
							
							"lote_taxa_app_ccr_empresa" => $value['lote_taxa_app_ccr_empresa'],
							"lote_taxa_app_ccd_empresa" => $value['lote_taxa_app_ccd_empresa'],
							"lote_taxa_app_din_empresa" => $value['lote_taxa_app_din_empresa'],
							"lote_taxa_app_bol_empresa" => $value['lote_taxa_app_bol_empresa'],
	
							"lote_taxa_pdv_ccr_cms" => $value['lote_taxa_pdv_ccr_cms'],
							"lote_taxa_pdv_ccd_cms" => $value['lote_taxa_pdv_ccd_cms'],
							"lote_taxa_pdv_din_cms" => $value['lote_taxa_pdv_din_cms'],
							"lote_taxa_pdv_bol_cms" => $value['lote_taxa_pdv_bol_cms'],
							
							"lote_taxa_site_ccr_cms" => $value['lote_taxa_site_ccr_cms'],
							"lote_taxa_site_ccd_cms" => $value['lote_taxa_site_ccd_cms'],
							"lote_taxa_site_din_cms" => $value['lote_taxa_site_din_cms'],
							"lote_taxa_site_bol_cms" => $value['lote_taxa_site_bol_cms'],
							
							"lote_taxa_app_ccr_cms" => $value['lote_taxa_app_ccr_cms'],
							"lote_taxa_app_ccd_cms" => $value['lote_taxa_app_ccd_cms'],
							"lote_taxa_app_din_cms" => $value['lote_taxa_app_din_cms'],
							"lote_taxa_app_bol_cms" => $value['lote_taxa_app_bol_cms'],

							"stat" => $value['stat']);
}


$dataControleSerial = serialize($dataControle);
$_SESSION['eventos_lotes_'.$_GET['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].''] = $dataControleSerial;
?>

