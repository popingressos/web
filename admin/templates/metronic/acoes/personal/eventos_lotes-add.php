<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/chave.php");

$numeroUnicoItem = geraCodReturn();
$_POST['lote_valor'] = limpa_valor_dinheiro($_POST['lote_valor']);

$_POST['valor_pdv_ccr'] = limpa_valor_dinheiro($_POST['valor_pdv_ccr']);
$_POST['valor_pdv_ccd'] = limpa_valor_dinheiro($_POST['valor_pdv_ccd']);
$_POST['valor_pdv_din'] = limpa_valor_dinheiro($_POST['valor_pdv_din']);
$_POST['valor_pdv_bol'] = limpa_valor_dinheiro($_POST['valor_pdv_bol']);
						
$_POST['valor_site_ccr'] = limpa_valor_dinheiro($_POST['valor_site_ccr']);
$_POST['valor_site_ccd'] = limpa_valor_dinheiro($_POST['valor_site_ccd']);
$_POST['valor_site_din'] = limpa_valor_dinheiro($_POST['valor_site_din']);
$_POST['valor_site_bol'] = limpa_valor_dinheiro($_POST['valor_site_bol']);
						
$_POST['valor_app_ccr'] = limpa_valor_dinheiro($_POST['valor_app_ccr']);
$_POST['valor_app_ccd'] = limpa_valor_dinheiro($_POST['valor_app_ccd']);
$_POST['valor_app_din'] = limpa_valor_dinheiro($_POST['valor_app_din']);
$_POST['valor_app_bol'] = limpa_valor_dinheiro($_POST['valor_app_bol']);

$_POST['lote_taxa_pdv_ccr_empresa'] = limpa_valor_dinheiro($_POST['lote_taxa_pdv_ccr_empresa']);
$_POST['lote_taxa_pdv_ccd_empresa'] = limpa_valor_dinheiro($_POST['lote_taxa_pdv_ccd_empresa']);
$_POST['lote_taxa_pdv_din_empresa'] = limpa_valor_dinheiro($_POST['lote_taxa_pdv_din_empresa']);
$_POST['lote_taxa_pdv_bol_empresa'] = limpa_valor_dinheiro($_POST['lote_taxa_pdv_bol_empresa']);
						
$_POST['lote_taxa_site_ccr_empresa'] = limpa_valor_dinheiro($_POST['lote_taxa_site_ccr_empresa']);
$_POST['lote_taxa_site_ccd_empresa'] = limpa_valor_dinheiro($_POST['lote_taxa_site_ccd_empresa']);
$_POST['lote_taxa_site_din_empresa'] = limpa_valor_dinheiro($_POST['lote_taxa_site_din_empresa']);
$_POST['lote_taxa_site_bol_empresa'] = limpa_valor_dinheiro($_POST['lote_taxa_site_bol_empresa']);
						
$_POST['lote_taxa_app_ccr_empresa'] = limpa_valor_dinheiro($_POST['lote_taxa_app_ccr_empresa']);
$_POST['lote_taxa_app_ccd_empresa'] = limpa_valor_dinheiro($_POST['lote_taxa_app_ccd_empresa']);
$_POST['lote_taxa_app_din_empresa'] = limpa_valor_dinheiro($_POST['lote_taxa_app_din_empresa']);
$_POST['lote_taxa_app_bol_empresa'] = limpa_valor_dinheiro($_POST['lote_taxa_app_bol_empresa']);

$_POST['lote_taxa_pdv_ccr_cms'] = limpa_valor_dinheiro($_POST['lote_taxa_pdv_ccr_cms']);
$_POST['lote_taxa_pdv_ccd_cms'] = limpa_valor_dinheiro($_POST['lote_taxa_pdv_ccd_cms']);
$_POST['lote_taxa_pdv_din_cms'] = limpa_valor_dinheiro($_POST['lote_taxa_pdv_din_cms']);
$_POST['lote_taxa_pdv_bol_cms'] = limpa_valor_dinheiro($_POST['lote_taxa_pdv_bol_cms']);
						
$_POST['lote_taxa_site_ccr_cms'] = limpa_valor_dinheiro($_POST['lote_taxa_site_ccr_cms']);
$_POST['lote_taxa_site_ccd_cms'] = limpa_valor_dinheiro($_POST['lote_taxa_site_ccd_cms']);
$_POST['lote_taxa_site_din_cms'] = limpa_valor_dinheiro($_POST['lote_taxa_site_din_cms']);
$_POST['lote_taxa_site_bol_cms'] = limpa_valor_dinheiro($_POST['lote_taxa_site_bol_cms']);
						
$_POST['lote_taxa_app_ccr_cms'] = limpa_valor_dinheiro($_POST['lote_taxa_app_ccr_cms']);
$_POST['lote_taxa_app_ccd_cms'] = limpa_valor_dinheiro($_POST['lote_taxa_app_ccd_cms']);
$_POST['lote_taxa_app_din_cms'] = limpa_valor_dinheiro($_POST['lote_taxa_app_din_cms']);
$_POST['lote_taxa_app_bol_cms'] = limpa_valor_dinheiro($_POST['lote_taxa_app_bol_cms']);

$ordemN = 0;
$statN = 0;
if(trim($_SESSION['eventos_lotes_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].''])=="") { 
} else {
	$carrinhoArray = unserialize($_SESSION['eventos_lotes_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']);
	foreach ($carrinhoArray as $key => $value) {
		if(trim($_SESSION['numeroUnico_ticket'])==trim($value['numeroUnico_ticket'])) {
			$ordemN++;
		}
		if(trim($value['stat'])=="1") {
			$statN++;
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
}
$ordemN++;

if($statN>0) {
	$statSet = "0";
} else {
	$statSet = "1";
}

$dataControle[] = array("tag" => "eventos_lotes", 
						"lote" => $ordemN,
						"numeroUnico" => "".$numeroUnicoItem."",
						"numeroUnico_ticket" => "".$_SESSION['numeroUnico_ticket']."",
						"lote_valor" => $_POST['lote_valor'],
						"lote_qtd" => $_POST['lote_qtd'],

						"valor_pdv_ccr" => $_POST['valor_pdv_ccr'],
						"valor_pdv_ccd" => $_POST['valor_pdv_ccd'],
						"valor_pdv_din" => $_POST['valor_pdv_din'],
						"valor_pdv_bol" => $_POST['valor_pdv_bol'],
						
						"valor_site_ccr" => $_POST['valor_site_ccr'],
						"valor_site_ccd" => $_POST['valor_site_ccd'],
						"valor_site_din" => $_POST['valor_site_din'],
						"valor_site_bol" => $_POST['valor_site_bol'],
						
						"valor_app_ccr" => $_POST['valor_app_ccr'],
						"valor_app_ccd" => $_POST['valor_app_ccd'],
						"valor_app_din" => $_POST['valor_app_din'],
						"valor_app_bol" => $_POST['valor_app_bol'],

						"lote_taxa_pdv_ccr_empresa" => $_POST['lote_taxa_pdv_ccr_empresa'],
						"lote_taxa_pdv_ccd_empresa" => $_POST['lote_taxa_pdv_ccd_empresa'],
						"lote_taxa_pdv_din_empresa" => $_POST['lote_taxa_pdv_din_empresa'],
						"lote_taxa_pdv_bol_empresa" => $_POST['lote_taxa_pdv_bol_empresa'],
						
						"lote_taxa_site_ccr_empresa" => $_POST['lote_taxa_site_ccr_empresa'],
						"lote_taxa_site_ccd_empresa" => $_POST['lote_taxa_site_ccd_empresa'],
						"lote_taxa_site_din_empresa" => $_POST['lote_taxa_site_din_empresa'],
						"lote_taxa_site_bol_empresa" => $_POST['lote_taxa_site_bol_empresa'],
						
						"lote_taxa_app_ccr_empresa" => $_POST['lote_taxa_app_ccr_empresa'],
						"lote_taxa_app_ccd_empresa" => $_POST['lote_taxa_app_ccd_empresa'],
						"lote_taxa_app_din_empresa" => $_POST['lote_taxa_app_din_empresa'],
						"lote_taxa_app_bol_empresa" => $_POST['lote_taxa_app_bol_empresa'],

						"lote_taxa_pdv_ccr_cms" => $_POST['lote_taxa_pdv_ccr_cms'],
						"lote_taxa_pdv_ccd_cms" => $_POST['lote_taxa_pdv_ccd_cms'],
						"lote_taxa_pdv_din_cms" => $_POST['lote_taxa_pdv_din_cms'],
						"lote_taxa_pdv_bol_cms" => $_POST['lote_taxa_pdv_bol_cms'],
						
						"lote_taxa_site_ccr_cms" => $_POST['lote_taxa_site_ccr_cms'],
						"lote_taxa_site_ccd_cms" => $_POST['lote_taxa_site_ccd_cms'],
						"lote_taxa_site_din_cms" => $_POST['lote_taxa_site_din_cms'],
						"lote_taxa_site_bol_cms" => $_POST['lote_taxa_site_bol_cms'],
						
						"lote_taxa_app_ccr_cms" => $_POST['lote_taxa_app_ccr_cms'],
						"lote_taxa_app_ccd_cms" => $_POST['lote_taxa_app_ccd_cms'],
						"lote_taxa_app_din_cms" => $_POST['lote_taxa_app_din_cms'],
						"lote_taxa_app_bol_cms" => $_POST['lote_taxa_app_bol_cms'],

						"stat" => "".$statSet."");

$dataControleSerial = serialize($dataControle);
$_SESSION['eventos_lotes_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].''] = $dataControleSerial;
?>

