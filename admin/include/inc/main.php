<?
if(!function_exists('existeNoArray')) {
function existeNoArray($procuraSend,$colunaSend,$objetoSend)
{

	$found_key = array_search(
		$procuraSend,
		array_filter(
			array_combine(
				array_keys($objetoSend),
				array_column(
					$objetoSend, $colunaSend
				)
			)
		)
	);
	
	if(trim($found_key)=="") {
		return false;
	} else {
		return true;
	}


}
}


if(!function_exists('geraCodRecursivo')) {
function geraCodRecursivo($numeroUnico_ticketSend,$tamanhoSend=0,$tipoSend=0,$deSend=0,$ateSend=0)
{
	if(trim($tipoSend)=="0") {
		$CaracteresAceitos = '0123456789';
		$tamanho = strlen($ateSend);
		$min = 0;
		$max = 9;
	} else if(trim($tipoSend)=="1") {
		$CaracteresAceitos = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
		$tamanho = $tamanhoSend;
		$min = 0;
		$max = strlen($CaracteresAceitos)-1;
	} else if(trim($tipoSend)=="2") {
		$CaracteresAceitos = '0123456789';
		$tamanho = $tamanhoSend;
		$min = 0;
		$max = strlen($CaracteresAceitos)-1;
	} else if(trim($tipoSend)=="3") {
		$CaracteresAceitos = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';
		$tamanho = $tamanhoSend;
		$min = 0;
		$max = strlen($CaracteresAceitos)-1;
	}

	$cod = "";
	for($i=0; $i < $tamanho; $i++) {
		if(trim($tipoSend)=="0") {
			$cod .= mt_rand($min, $max);
		} else {
			$cod .= $CaracteresAceitos{mt_rand(0, $max)};
		}
	}

	$nSqlCarrinhoCodVoucher = mysql_fetch_row(mysql_query("SELECT 
															  COUNT(*) 
														   FROM 
															  carrinho_notificacao 
														   WHERE 
															  numeroUnico_ticket='".$numeroUnico_ticketSend."' AND 
															  numeroUnico_cod_voucher='".$cod."'
														 "));

	if($nSqlCarrinhoCodVoucher[0]>0) {
		geraCodRecursivo($numeroUnico_ticketSend,$tamanhoSend,$tipoSend,$deSend,$ateSend);
	} else {
		return $cod;
	}

}
}

if(!function_exists('float_rand')) {
function float_rand($Min, $Max, $round=0){
    //validate input
    if ($min>$Max) { $min=$Max; $max=$Min; }
        else { $min=$Min; $max=$Max; }
    $randomfloat = $min + mt_rand() / mt_getrandmax() * ($max - $min);
    if($round>0)
        $randomfloat = round($randomfloat,$round);

    return $randomfloat;
}
}

if (!function_exists('gravaAmbev')) { 
function gravaAmbev($form_data, $country, $brand, $campaign, $form, $unify, $production) {

	$td_env = $production ? 'prod' : 'dev';
	
	$http_protocol = isset($_SERVER['https']) ? 'https://' : 'http://';
	
	$form_data['abi_brand'] = $brand;
	$form_data['abi_campaign'] = $campaign;
	$form_data['abi_campaign_id'] = $campaignID;
	$form_data['abi_form'] = $form;
	$form_data['td_unify'] = $unify;
	$form_data['td_import_method'] = 'postback-api-1.2';
	$form_data['td_client_id'] = $_COOKIE['_td'];
	$form_data['td_url'] = $http_protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$form_data['td_host'] = $_SERVER['HTTP_HOST'];
	echo "<br>Form Data<br>";
	var_dump($form_data);
	echo "<br><br>";
	
	$td_country = $country;
	
	$td_apikey = $td_env !== 'prod' ? '9648/41e45454b77308046627548e0b4fe2ddbc0893d2' : '10086/9c06ed6fa48e0fb6952ed42773cca1cc1d43684e';
	
	$country_zone_mapping = array("nga"=>"africa", "zwe"=>"africa", "zaf"=>"africa", "aus"=>"apac", "chn"=>"apac", "ind"=>"apac", 
								  "jpn"=>"apac", "kor"=>"apac", "tha"=>"apac", "vnm"=>"apac", "bel"=>"eur", "fra"=>"eur", "deu"=>"eur", 
								  "ita"=>"eur", "nld"=>"eur", "rus"=>"eur", "esp"=>"eur", "ukr"=>"eur", "gbr"=>"eur", "col"=>"midam", 
								  "dom"=>"midam", "ecu"=>"midam", "slv"=>"midam", "gtm"=>"midam", "hnd"=>"midam", "mex"=>"midam", 
								  "pan"=>"midam", "per"=>"midam", "can"=>"naz", "usa"=>"naz", "arg"=>"saz", "bol"=>"saz", "bra"=>"saz", "chl"=>"saz", "ury"=>"saz");
	
	$td_zone = $country_zone_mapping[$td_country];
	$curl = curl_init();
	
	$curl_opts = array(
		CURLOPT_URL => "https://in.treasuredata.com/postback/v3/event/".$td_zone."_source/".$td_country."_web_form",
		CURLOPT_POST => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			"X-TD-Write-Key: ".$td_apikey.""
		),
		CURLOPT_POSTFIELDS => json_encode($form_data)
	);
	
	curl_setopt_array($curl, $curl_opts);
	echo "<br>cURL Opts<br>";
	var_dump($curl_opts);
	echo "<br><br>";
	
	$response = @curl_exec($curl);
	echo "<br>Response<br>";
	var_dump($response);
	echo "<br><br>";
	
	$response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	echo "<br>Response Code<br>";
	var_dump($response_code);
	echo "<br><br>";
	
	curl_close($curl);
	
	return $response_code;

}
}


if (!function_exists('retornaTaxas')) { 
function retornaTaxas($empresaSend,$DeviceSet,$taxaSet,$formaPagamentoSet="CCR")
{

	if(trim($formaPagamentoSet)=="CCR") {
		$tipoTaxaSet = "ccr";
	} else if(trim($formaPagamentoSet)=="CCD") {
		$tipoTaxaSet = "ccd";
	} else if(trim($formaPagamentoSet)=="DIN") {
		$tipoTaxaSet = "din";
	} else if(trim($formaPagamentoSet)=="PIX") {
		$tipoTaxaSet = "pix";
	} else if(trim($formaPagamentoSet)=="BOLETO") {
		$tipoTaxaSet = "bol";
	}

	$rSqlEmpresaItem = mysql_fetch_array(mysql_query("
													SELECT 
														mod_empresa.plataforma,
													
														mod_taxa.taxa_site_split_empresa,
														mod_taxa.taxa_app_split_empresa,
														mod_taxa.taxa_pdv_split_empresa,
													
														mod_taxa.taxa_site_split_cms,
														mod_taxa.taxa_app_split_cms,
														mod_taxa.taxa_pdv_split_cms,

														mod_taxa.taxa_site_ccr_empresa,
														mod_taxa.taxa_app_ccr_empresa,
														mod_taxa.taxa_pdv_ccr_empresa,
													
														mod_taxa.taxa_site_ccr_cms,
														mod_taxa.taxa_app_ccr_cms,
														mod_taxa.taxa_pdv_ccr_cms,

														mod_taxa.taxa_site_ccd_empresa,
														mod_taxa.taxa_app_ccd_empresa,
														mod_taxa.taxa_pdv_ccd_empresa,
													
														mod_taxa.taxa_site_ccd_cms,
														mod_taxa.taxa_app_ccd_cms,
														mod_taxa.taxa_pdv_ccd_cms,

														mod_taxa.taxa_site_pix_empresa,
														mod_taxa.taxa_app_pix_empresa,
														mod_taxa.taxa_pdv_pix_empresa,
													
														mod_taxa.taxa_site_pix_cms,
														mod_taxa.taxa_app_pix_cms,
														mod_taxa.taxa_pdv_pix_cms,

														mod_taxa.taxa_site_din_empresa,
														mod_taxa.taxa_app_din_empresa,
														mod_taxa.taxa_pdv_din_empresa,
													
														mod_taxa.taxa_site_din_cms,
														mod_taxa.taxa_app_din_cms,
														mod_taxa.taxa_pdv_din_cms,

														mod_taxa.taxa_site_bol_empresa,
														mod_taxa.taxa_app_bol_empresa,
														mod_taxa.taxa_pdv_bol_empresa,
													
														mod_taxa.taxa_site_bol_cms,
														mod_taxa.taxa_app_bol_cms,
														mod_taxa.taxa_pdv_bol_cms,

														mod_taxa.taxa_site_cor_empresa,
														mod_taxa.taxa_app_cor_empresa,
														mod_taxa.taxa_pdv_cor_empresa,
													
														mod_taxa.taxa_site_cor_cms,
														mod_taxa.taxa_app_cor_cms,
														mod_taxa.taxa_pdv_cor_cms

													 FROM 
													 	empresa AS mod_empresa
													LEFT JOIN 
														empresa_taxas AS mod_taxa ON (mod_taxa.empresa = mod_empresa.id)
													 WHERE 
													 	mod_empresa.id='".$empresaSend."'
													"));
													
	$arrayTaxa["taxa_device"] = $DeviceSet;
	$arrayTaxa["taxa_plataforma"] = $rSqlEmpresaItem['plataforma'];
	if(trim($rSqlEmpresaItem['plataforma'])=="" || trim($rSqlEmpresaItem['plataforma'])=="0") {
		$arrayTaxa["taxa_selecionada"] = "empresa";
		if(trim($DeviceSet)=="SITE") {
			$arrayTaxa["taxa_empresa"] = $rSqlEmpresaItem['taxa_site_'.$tipoTaxaSet.'_empresa'];
			$arrayTaxa["taxa_cms"] = $rSqlEmpresaItem['taxa_site_'.$tipoTaxaSet.'_cms'];
		} else if(trim($DeviceSet)=="APP") {
			$arrayTaxa["taxa_empresa"] = $rSqlEmpresaItem['taxa_app_'.$tipoTaxaSet.'_empresa'];
			$arrayTaxa["taxa_cms"] = $rSqlEmpresaItem['taxa_app_'.$tipoTaxaSet.'_cms'];
		} else if(trim($DeviceSet)=="PDV") {
			$arrayTaxa["taxa_empresa"] = $rSqlEmpresaItem['taxa_pdv_'.$tipoTaxaSet.'_empresa'];
			$arrayTaxa["taxa_cms"] = $rSqlEmpresaItem['taxa_pdv_'.$tipoTaxaSet.'_cms'];
		}
	} else { 
		$rSqlPlataformaItem = mysql_fetch_array(mysql_query("
														SELECT 
															mod_empresa.plataforma,
														
															mod_taxa.taxa_site_split_empresa,
															mod_taxa.taxa_app_split_empresa,
															mod_taxa.taxa_pdv_split_empresa,
														
															mod_taxa.taxa_site_split_cms,
															mod_taxa.taxa_app_split_cms,
															mod_taxa.taxa_pdv_split_cms,
	
															mod_taxa.taxa_site_ccr_empresa,
															mod_taxa.taxa_app_ccr_empresa,
															mod_taxa.taxa_pdv_ccr_empresa,
														
															mod_taxa.taxa_site_ccr_cms,
															mod_taxa.taxa_app_ccr_cms,
															mod_taxa.taxa_pdv_ccr_cms,
	
															mod_taxa.taxa_site_ccd_empresa,
															mod_taxa.taxa_app_ccd_empresa,
															mod_taxa.taxa_pdv_ccd_empresa,
														
															mod_taxa.taxa_site_ccd_cms,
															mod_taxa.taxa_app_ccd_cms,
															mod_taxa.taxa_pdv_ccd_cms,
	
															mod_taxa.taxa_site_pix_empresa,
															mod_taxa.taxa_app_pix_empresa,
															mod_taxa.taxa_pdv_pix_empresa,
														
															mod_taxa.taxa_site_pix_cms,
															mod_taxa.taxa_app_pix_cms,
															mod_taxa.taxa_pdv_pix_cms,
	
															mod_taxa.taxa_site_din_empresa,
															mod_taxa.taxa_app_din_empresa,
															mod_taxa.taxa_pdv_din_empresa,
														
															mod_taxa.taxa_site_din_cms,
															mod_taxa.taxa_app_din_cms,
															mod_taxa.taxa_pdv_din_cms,
	
															mod_taxa.taxa_site_bol_empresa,
															mod_taxa.taxa_app_bol_empresa,
															mod_taxa.taxa_pdv_bol_empresa,
														
															mod_taxa.taxa_site_bol_cms,
															mod_taxa.taxa_app_bol_cms,
															mod_taxa.taxa_pdv_bol_cms,
	
															mod_taxa.taxa_site_cor_empresa,
															mod_taxa.taxa_app_cor_empresa,
															mod_taxa.taxa_pdv_cor_empresa,
														
															mod_taxa.taxa_site_cor_cms,
															mod_taxa.taxa_app_cor_cms,
															mod_taxa.taxa_pdv_cor_cms

														 FROM 
															empresa AS mod_empresa
														 LEFT JOIN 
															empresa_taxas AS mod_taxa ON (mod_taxa.empresa = mod_empresa.id)
														 WHERE 
															mod_empresa.id='".$rSqlEmpresaItem['plataforma']."'
														"));


		if(trim($DeviceSet)=="SITE") {
			if(trim($rSqlEmpresaItem['taxa_site_'.$tipoTaxaSet.'_empresa'])=="") {
				$arrayTaxa["taxa_selecionada"] = "plataforma";
				$arrayTaxa["taxa_empresa"] = $rSqlPlataformaItem['taxa_site_'.$tipoTaxaSet.'_empresa'];
			} else {
				$arrayTaxa["taxa_selecionada"] = "empresa";
				$arrayTaxa["taxa_empresa"] = $rSqlEmpresaItem['taxa_site_'.$tipoTaxaSet.'_empresa'];
			}

			if(trim($rSqlEmpresaItem['taxa_site_'.$tipoTaxaSet.'_cms'])=="") {
				$arrayTaxa["taxa_selecionada"] = "plataforma";
				$arrayTaxa["taxa_cms"] = $rSqlPlataformaItem['taxa_site_'.$tipoTaxaSet.'_cms'];
			} else {
				$arrayTaxa["taxa_selecionada"] = "empresa";
				$arrayTaxa["taxa_cms"] = $rSqlEmpresaItem['taxa_site_'.$tipoTaxaSet.'_cms'];
			}
		} else if(trim($DeviceSet)=="APP") {
			if(trim($rSqlEmpresaItem['taxa_app_'.$tipoTaxaSet.'_empresa'])=="") {
				$arrayTaxa["taxa_selecionada"] = "plataforma";
				$arrayTaxa["taxa_empresa"] = $rSqlPlataformaItem['taxa_app_'.$tipoTaxaSet.'_empresa'];
			} else {
				$arrayTaxa["taxa_selecionada"] = "empresa";
				$arrayTaxa["taxa_empresa"] = $rSqlEmpresaItem['taxa_app_'.$tipoTaxaSet.'_empresa'];
			}

			if(trim($rSqlEmpresaItem['taxa_app_'.$tipoTaxaSet.'_cms'])=="") {
				$arrayTaxa["taxa_selecionada"] = "plataforma";
				$arrayTaxa["taxa_cms"] = $rSqlPlataformaItem['taxa_app_'.$tipoTaxaSet.'_cms'];
			} else {
				$arrayTaxa["taxa_selecionada"] = "empresa";
				$arrayTaxa["taxa_cms"] = $rSqlEmpresaItem['taxa_app_'.$tipoTaxaSet.'_cms'];
			}
		} else if(trim($DeviceSet)=="PDV") {
			if(trim($rSqlEmpresaItem['taxa_pdv_'.$tipoTaxaSet.'_empresa'])=="") {
				$arrayTaxa["taxa_selecionada"] = "plataforma";
				$arrayTaxa["taxa_empresa"] = $rSqlPlataformaItem['taxa_pdv_'.$tipoTaxaSet.'_empresa'];
			} else {
				$arrayTaxa["taxa_selecionada"] = "empresa";
				$arrayTaxa["taxa_empresa"] = $rSqlEmpresaItem['taxa_pdv_'.$tipoTaxaSet.'_empresa'];
			}

			if(trim($rSqlEmpresaItem['taxa_pdv_'.$tipoTaxaSet.'_cms'])=="") {
				$arrayTaxa["taxa_selecionada"] = "plataforma";
				$arrayTaxa["taxa_cms"] = $rSqlPlataformaItem['taxa_pdv_'.$tipoTaxaSet.'_cms'];
			} else {
				$arrayTaxa["taxa_selecionada"] = "empresa";
				$arrayTaxa["taxa_cms"] = $rSqlEmpresaItem['taxa_pdv_'.$tipoTaxaSet.'_cms'];
			}
		}
	}

	return $arrayTaxa[$taxaSet];

}
}

if (!function_exists('viraLote')) { 
function viraLote($numeroUnico_eventoSend,$numeroUnico_ticketSend)
{

	if(trim($numeroUnico_eventoSend)=="" || trim($numeroUnico_ticketSend)=="") { } else {
		$strSqlEvento = "
			SELECT 
				mod_eventos.numeroUnico,
				mod_eventos.tickets,
				mod_eventos.lotes
			
			FROM 
				eventos AS mod_eventos 
		
			WHERE 
				mod_eventos.numeroUnico='".$numeroUnico_eventoSend."'
		";
		$rSqlEvento = mysql_fetch_array(mysql_query("".$strSqlEvento.""));
	
		$virada_de_loteSet = 0;
		$ticketsArray = unserialize($rSqlEvento['tickets']);
		$ticketsArray = array_sort($ticketsArray, 'ticket_data', SORT_ASC);
		foreach ($ticketsArray as $key_ticket => $value_ticket) {
			
			if(trim($value_ticket['numeroUnico'])==trim($numeroUnico_ticketSend)) {
				if(trim($value_ticket['ticket_virada_de_lote'])=="1") {
					$virada_de_loteSet = 1;
				}
			}
		}

		$lotesArray = unserialize($rSqlEvento['lotes']);
		$lotesArray = array_sort($lotesArray, 'lote', SORT_ASC);
		foreach ($lotesArray as $key_lote => $value_lote) {
			if(trim($numeroUnico_ticketSend)==trim($value_lote['numeroUnico_ticket']) && trim($value_lote['stat'])=="1") {
				$nSqlCarrinhoLote = mysql_fetch_row(mysql_query("SELECT 
																	COUNT(*) 
																 FROM 
																	carrinho_notificacao 
																 WHERE 
																	numeroUnico_lote='".$value_lote['numeroUnico']."' AND 
																	stat='1'
																 "));
				if($value_lote['lote_qtd']>$nSqlCarrinhoLote[0]) { } else {
					$numeroUnico_lote_vira = $value_lote['numeroUnico'];
				}
			}
		}

		$viraProximo = 0;
		$lotesArray = unserialize($rSqlEvento['lotes']);
		$lotesArray = array_sort($lotesArray, 'lote', SORT_ASC);
		foreach ($lotesArray as $key_lote => $value_lote) {
			if(trim($numeroUnico_ticketSend)==trim($value_lote['numeroUnico_ticket'])) {
				if($viraProximo==1) {
					$value_lote['stat'] = "1";
					$viraProximo = 0;
				} else {
					if($numeroUnico_lote_vira==$value_lote['numeroUnico']) {
						if($virada_de_loteSet==1) {
							$viraProximo=1;
						}
						$value_lote['stat'] = "0";
					} else {
						$value_lote['stat'] = $value_lote['stat'];
					}
				}
			} else {
				$value_lote['stat'] = $value_lote['stat'];
			}
	
			$dataControle[] = array("tag" => "eventos_lotes", 
									"lote" => "".$value_lote['lote']."",
									"numeroUnico" => "".$value_lote['numeroUnico']."",
									"numeroUnico_ticket" => $value_lote['numeroUnico_ticket'],
									"lote_valor" => $value_lote['lote_valor'],
									"lote_qtd" => $value_lote['lote_qtd'],
		
									"valor_pdv_ccr" => $value_lote['valor_pdv_ccr'],
									"valor_pdv_ccd" => $value_lote['valor_pdv_ccd'],
									"valor_pdv_din" => $value_lote['valor_pdv_din'],
									"valor_pdv_bol" => $value_lote['valor_pdv_bol'],
									
									"valor_site_ccr" => $value_lote['valor_site_ccr'],
									"valor_site_ccd" => $value_lote['valor_site_ccd'],
									"valor_site_din" => $value_lote['valor_site_din'],
									"valor_site_bol" => $value_lote['valor_site_bol'],
									
									"valor_app_ccr" => $value_lote['valor_app_ccr'],
									"valor_app_ccd" => $value_lote['valor_app_ccd'],
									"valor_app_din" => $value_lote['valor_app_din'],
									"valor_app_bol" => $value_lote['valor_app_bol'],
		
									"lote_taxa_pdv_ccr_empresa" => $value_lote['lote_taxa_pdv_ccr_empresa'],
									"lote_taxa_pdv_ccd_empresa" => $value_lote['lote_taxa_pdv_ccd_empresa'],
									"lote_taxa_pdv_din_empresa" => $value_lote['lote_taxa_pdv_din_empresa'],
									"lote_taxa_pdv_bol_empresa" => $value_lote['lote_taxa_pdv_bol_empresa'],
									
									"lote_taxa_site_ccr_empresa" => $value_lote['lote_taxa_site_ccr_empresa'],
									"lote_taxa_site_ccd_empresa" => $value_lote['lote_taxa_site_ccd_empresa'],
									"lote_taxa_site_din_empresa" => $value_lote['lote_taxa_site_din_empresa'],
									"lote_taxa_site_bol_empresa" => $value_lote['lote_taxa_site_bol_empresa'],
									
									"lote_taxa_app_ccr_empresa" => $value_lote['lote_taxa_app_ccr_empresa'],
									"lote_taxa_app_ccd_empresa" => $value_lote['lote_taxa_app_ccd_empresa'],
									"lote_taxa_app_din_empresa" => $value_lote['lote_taxa_app_din_empresa'],
									"lote_taxa_app_bol_empresa" => $value_lote['lote_taxa_app_bol_empresa'],
			
									"lote_taxa_pdv_ccr_cms" => $value_lote['lote_taxa_pdv_ccr_cms'],
									"lote_taxa_pdv_ccd_cms" => $value_lote['lote_taxa_pdv_ccd_cms'],
									"lote_taxa_pdv_din_cms" => $value_lote['lote_taxa_pdv_din_cms'],
									"lote_taxa_pdv_bol_cms" => $value_lote['lote_taxa_pdv_bol_cms'],
									
									"lote_taxa_site_ccr_cms" => $value_lote['lote_taxa_site_ccr_cms'],
									"lote_taxa_site_ccd_cms" => $value_lote['lote_taxa_site_ccd_cms'],
									"lote_taxa_site_din_cms" => $value_lote['lote_taxa_site_din_cms'],
									"lote_taxa_site_bol_cms" => $value_lote['lote_taxa_site_bol_cms'],
									
									"lote_taxa_app_ccr_cms" => $value_lote['lote_taxa_app_ccr_cms'],
									"lote_taxa_app_ccd_cms" => $value_lote['lote_taxa_app_ccd_cms'],
									"lote_taxa_app_din_cms" => $value_lote['lote_taxa_app_din_cms'],
									"lote_taxa_app_bol_cms" => $value_lote['lote_taxa_app_bol_cms'],
		
									"stat" => $value_lote['stat']);
	
		}

		$dataControleSerial = serialize($dataControle);

		if(trim($numeroUnico_lote_vira)=="") { } else {
			$update = mysql_query("
								UPDATE 
									eventos
								SET 
									lotes='".$dataControleSerial."',
									dataModificacao='".date("Y-m-d H:i:s")."'
								WHERE 
									numeroUnico='".$numeroUnico_eventoSend."'
								");
		}
	}

}
}

if (!function_exists('gravaTotvs')) { 
function gravaTotvs($arraySend)
{
	$cabecalhos = array(
		"Content-Type: application/json",
	);
	
	
	$corpo = $arraySend;
	
	$objeto_envio = curl_init();
	
	curl_setopt($objeto_envio,CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($objeto_envio,CURLOPT_HTTPHEADER, $cabecalhos);
	curl_setopt($objeto_envio,CURLOPT_URL, 'https://app.casamaaya.com.br/api/save');
	curl_setopt($objeto_envio,CURLOPT_POSTFIELDS,json_encode($corpo));
	curl_setopt($objeto_envio,CURLOPT_RETURNTRANSFER,true);
	
	// Executa:
	$resposta = curl_exec($objeto_envio);
	
	#$OBJ_ENVIADO_GATEWAY = $corpo;
	#$OBJ_RECEBIDO_GATEWAY = $resposta;
	#$RESPOSTA_GATEWAY_ARRAY = json_decode($resposta,true);
	#$RESPOSTA_GATEWAY = (object) $RESPOSTA_GATEWAY_ARRAY;
	
	// Encerra CURL:
	curl_close($objeto_envio);

}
}

if (!function_exists('getUserIP')) { 
function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}
}

if (!function_exists('cal_days_in_month')) { 
function cal_days_in_month($calendar, $month, $year) 
{ 
	return date('t', mktime(0, 0, 0, $month, 1, $year)); 
} 
}

if(!function_exists('processVideo')) {
function processVideo($videoSource,$videoCaminho,$videoName,$reqExtension, $watermark = "")
{

	$extensao = $videoName;
	$extensao = substr($extensao, -4);
	if($extensao[0] == '.'){
		$extensao = substr($extensao, -3);
	}
	$extensao = strtolower($extensao);
	$videoName = str_replace("".$extensao."","",$videoName);

    $ffmpeg = FFMpeg\FFMpeg::create();

    $video = $ffmpeg->open($videoSource);

    $format = new FFMpeg\Format\Video\X264('libmp3lame', 'libx264');

    if (!empty($watermark))
    {
        $video  ->filters()
                ->watermark($watermark, array(
                    'position' => 'relative',
                    'top' => 0,
                    'right' => 0,
					'all_mode'=> 'overlay',
					'all_opacity' => 0.3,
                ));
    }

    $format
    -> setKiloBitrate(1000)
    -> setAudioChannels(2)
    -> setAudioKiloBitrate(256);

    $randomFileName = $videoName."".$reqExtension."";
    $saveLocation = "".$videoCaminho."".$randomFileName;
    $video->save($format, $saveLocation);

}
}

if(!function_exists('mes_extenso')) {
function mes_extenso($m,$tipo) {
	if($tipo=="longo") {
		if($m=="01") { $mes = "Janeiro"; }
		if($m=="02") { $mes = "Fevereiro"; }
		if($m=="03") { $mes = "Março"; }
		if($m=="04") { $mes = "Abril"; }
		if($m=="05") { $mes = "Maio"; }
		if($m=="06") { $mes = "Junho"; }
		if($m=="07") { $mes = "Julho"; }
		if($m=="08") { $mes = "Agosto"; }
		if($m=="09") { $mes = "Setembro"; }
		if($m=="10") { $mes = "Outubro"; }
		if($m=="11") { $mes = "Novembro"; }
		if($m=="12") { $mes = "Dezembro"; }
	} else {
		if($m=="01") { $mes = "Jan"; }
		if($m=="02") { $mes = "Fev"; }
		if($m=="03") { $mes = "Mar"; }
		if($m=="04") { $mes = "Abr"; }
		if($m=="05") { $mes = "Mai"; }
		if($m=="06") { $mes = "Jun"; }
		if($m=="07") { $mes = "Jul"; }
		if($m=="08") { $mes = "Ago"; }
		if($m=="09") { $mes = "Set"; }
		if($m=="10") { $mes = "Out"; }
		if($m=="11") { $mes = "Nov"; }
		if($m=="12") { $mes = "Dez"; }
	}
	return $mes;
}
}

if(!function_exists('diasemana_extenso')) {
function diasemana_extenso($dataSend,$tipo) {
	$diasemana_sem_feira = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado');
	$diasemana_com_feira = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');					
	$diasemana_curto = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');
	$diasemana_numero = date('w', strtotime($dataSend));					
	if($tipo=="com-feira") {
		return $diasemana_com_feira[$diasemana_numero];
	} else if($tipo=="sem-feira") {
		return $diasemana_sem_feira[$diasemana_numero];
	} else if($tipo=="curto") {
		return $diasemana_curto[$diasemana_numero];
	}
}
}

if(!function_exists('gen_uuid')) {
function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}
}

if(!function_exists('distancia_entre_coordenadas')) {
function distancia_entre_coordenadas($lat1, $lon1, $lat2, $lon2) {
	$lat = deg2rad($lat2-$lat1);
	$lon = deg2rad($lon2-$lon1);
	$t = sin($lat/2) * sin($lat/2) + cos(deg2rad(lat1)) * cos(deg2rad($lat2)) *sin(lon/2) * sin(lon/2);
	$l = 2 * atan2(sqrt($t), sqrt(1-$t));
	$result = 6371 * $l; //para transformar em km
	$result = 1000 * $result; //para transformar em m
	$result = round($result);
	#$result = $l;
	return $result;
}
}

if(!function_exists('format_number')) {
function format_number($number,$dec=0,$trim=false){
  if($trim){
    $parts = explode(".",(round($number,$dec) * 1));
    $dec = isset($parts[1]) ? strlen($parts[1]) : 0;
  }
  $formatted = number_format($number,$dec); 
  return $formatted;
}
}

if(!function_exists('statusDaSolicitacao')) {
function statusDaSolicitacao($rSqlSend) {

	$rSql = $rSqlSend;
	
	if(trim($rSql['stat'])=="0") {
		$txtStat = "EM ABERTO";
		$corStat = "#1a79b0";
	} else if(trim($rSql['stat'])=="1") {
		$txtStat = "EM ATENDIMENTO";
		$corStat = "#d30eda";
	} else if(trim($rSql['stat'])=="10") {
		$txtStat = "EM ATENDIMENTO";
		$corStat = "#0befe7";
	} else if(trim($rSql['stat'])=="2") {
		$txtStat = "ORÇAMENTOS GERADOS";
		$corStat = "#e8be3d";
	} else if(trim($rSql['stat'])=="3") {
		$txtStat = "CANCELADA";
		$corStat = "#da0e0e";
	} else if(trim($rSql['stat'])=="4") {
		$txtStat = "FINALIZADA";
		$corStat = "#1dc9b7";
	}

	$objetoRetorno['cor'] = $corStat;
	$objetoRetorno['txt'] = $txtStat;
	return $objetoRetorno;
}
}

if(!function_exists('statusDataDaCompraSimples')) {
function statusDataDaCompraSimples($rSqlSend,$modSet="carrinho") {

	$rSql = $rSqlSend;
	
	if(trim($rSql['stat'])=="1") {
		if(trim($modSet)=="carrinho") {
			if(trim($rSql['pago'])=="1") {
				$txtStat = "PAGO";
				$corStat = "#15cb7c";
				$cor_txtStat = "#15cb7c";
			} else {
				$txtStat = "VERIFICAR";
				$corStat = "#ff9900";
			}
		} else {
			$txtStat = "PAGO";
			$corStat = "#15cb7c";
			$cor_txtStat = "#15cb7c";
		}
	} else if(trim($rSql['stat'])=="3") {
		$btnStat = "Sua compra foi estornado e você não pode visualizar este item";
		$txtStat = "ESTORNADO";
		$corStat = "#d610c1";
	} else if(trim($rSql['stat'])=="5") {
		$btnStat = "Foi feito um chargeback e você não pode visualizar este item";
		$txtStat = "CHARGEBACK";
		$corStat = "#000000";

	} else if(trim($rSql['stat'])=="6" || trim($rSql['stat'])=="102") {
		$btnStat = "Sua compra está em análise, aguarde o processamento para visualizar este item!";
		$txtStat = "EM ANÁLISE";
		$corStat = "#e5d739";

	} else if(trim($rSql['stat'])=="7") {
		$btnStat = "Sua compra foi recusada e você não pode visualizar este item!";
		$txtStat = "RECUSADA";
		$corStat = "#e53939";

	} else if(trim($rSql['stat'])=="106") {
		$btnStat = "Sua compra está em análise, aguarde o processamento para visualizar este item!";
		$txtStat = "EM ANÁLISE";
		$corStat = "#e5d739";

	} else if(trim($rSql['stat'])=="107") {
		$btnStat = "Sua compra está em processo de estorno, aguarde o processamento para visualizar este item!";
		$txtStat = "EM ESTORNO";
		$corStat = "#f839e4";

	} else if(trim($rSql['stat'])=="999") {
		$btnStat = "Houve um erro com sua compra e a mesma foi recusada!";
		$txtStat = "OCORREU UM ERRO";
		$corStat = "#bf0606";

	} else if(trim($rSql['stat'])=="12") {
		$btnStat = "Sua compra está em processo de cancelamento e você não pode visualizar este item!";
		$txtStat = "BOLETO EM CANCELAMENTO";
		$corStat = "#d610c1";

	} else if(trim($rSql['stat'])=="13") {
		$btnStat = "Sua compra está aguardando pagamento e você não pode visualizar este item!";
		$txtStat = "BOLETO À PAGAR";
		$corStat = "#d610c1";

	} else if(trim($rSql['stat'])=="14") {
		$btnStat = "Sua compra está em processo de liberação e você não pode visualizar este item!";
		$txtStat = "BOLETO EM PROCESSO";
		$corStat = "#d610c1";

	} else if(trim($rSql['stat'])=="15") {
		$btnStat = "Sua compra foi recusada e você não pode visualizar este item!";
		$txtStat = "BOLETO DEVOLVIDO";
		$corStat = "#d610c1";

	} else if(trim($rSql['stat'])=="108") {
		$btnStat = "Sua compra foi enviada para validação!";
		$txtStat = "ENVIADO PARA ANÁLISE";
		$corStat = "#e5d739";

	} else if(trim($rSql['stat'])=="109") {
		$btnStat = "Sua compra foi enviada para validação!";
		$txtStat = "ANÁLISE RECUSADA";
		$corStat = "#e53939";

	} else if(trim($rSql['stat'])=="21") {
		$txtStat = "COBRANÇA GERADA";
		$corStat = "#0dcaf0";

	} else if(trim($rSql['stat'])=="32") {
		$txtStat = "PIX GERADO";
		$corStat = "#f9cc42";
	}

	$objetoRetorno['btn'] = $btnStat;
	$objetoRetorno['cor'] = $corStat;
	$objetoRetorno['txt'] = $txtStat;
	return $objetoRetorno;
}
}

if(!function_exists('formaDePagamento')) {
function formaDePagamento($rSqlSend) {
	$rSql = $rSqlSend;

	if(trim($rSql['forma_de_pagamento'])=="BOLETO") {
		$formaDePagamentoTxtSet = "Boleto";
		$formaDePagamentoCorSet = "bg-light-warning";
		$formaDePagamentoIconSet = "fal fa-barcode-alt";
	} else if(trim($rSql['forma_de_pagamento'])=="CCR") {
		$formaDePagamentoTxtSet = "Cartão de Crédito";
		$formaDePagamentoCorSet = "bg-light-primary";
		$formaDePagamentoIconSet = "fal fa-credit-card-front";
	} else if(trim($rSql['forma_de_pagamento'])=="CCD") {
		$formaDePagamentoTxtSet = "Cartão de Débito";
		$formaDePagamentoCorSet = "bg-light-info";
		$formaDePagamentoIconSet = "fal fa-credit-card-front";
	} else if(trim($rSql['forma_de_pagamento'])=="DIN") {
		$formaDePagamentoTxtSet = "Dinheiro";
		$formaDePagamentoCorSet = "bg-light-success";
		$formaDePagamentoIconSet = "fal fa-money-bill-alt";
	} else if(trim($rSql['forma_de_pagamento'])=="TEF") {
		$formaDePagamentoTxtSet = "Transferência";
		$formaDePagamentoCorSet = "bg-light-success";
		$formaDePagamentoIconSet = "fal fa-money-check-edit-alt";
	} else if(trim($rSql['forma_de_pagamento'])=="PIX") {
		$formaDePagamentoTxtSet = "Pix";
		$formaDePagamentoCorSet = "bg-light-success";
		$formaDePagamentoIconSet = "fal fa-bolt";
	} else if(trim($rSql['forma_de_pagamento'])=="CREDITO") {
		$formaDePagamentoTxtSet = "Crédito";
		$formaDePagamentoCorSet = "bg-light-secondary";
		$formaDePagamentoIconSet = "fal fa-hand-holding-usd";
	} else {
		$formaDePagamentoTxtSet = "<i>Não selecionada</i>";
		$formaDePagamentoCorSet = "bg-light-secondary";
		$formaDePagamentoIconSet = "fad fa-spinner";
	}

	$objetoRetorno['icone'] = $formaDePagamentoIconSet;
	$objetoRetorno['cor'] = $formaDePagamentoCorSet;
	$objetoRetorno['txt'] = $formaDePagamentoTxtSet;
	$objetoRetorno['forma_de_pagamento'] = $formaDePagamentoTxtSet;
	return $objetoRetorno;
}
}

if(!function_exists('calculaDescontoCupom')) {
function calculaDescontoCupom($value,$empresaSet) {
	$rSqlCupom = mysql_fetch_array(mysql_query("SELECT * FROM cupom_de_desconto WHERE codigo='".$_SESSION['CUPOM_CARRINHO']."' AND stat='1' AND empresa_token='".$empresaSet."' ORDER BY id DESC"));

	$achou_cupom=0;
	if(trim($rSqlCupom['id'])=="") { } else {
		if(trim($rSqlCupom['descontos'])=="" || trim($rSqlCupom['descontos'])=="N;") {
			$achou_cupom++;
		} else {
			$achou_cupom=0;
			$descontosArray = unserialize($rSqlCupom['descontos']);
			foreach ($descontosArray as $key_cupom => $cupom) {
				if(trim($value['numeroUnico_item'])==trim($cupom['numeroUnico_item']) && trim($value['tag'])==trim($cupom['tipo_item'])) {
					$achou_cupom++;
				}
			}
		}
	}


	if($achou_cupom>0) {
		$CupomTipo = $rSqlCupom['tipo_desconto']; 
		$CupomValor = $rSqlCupom['desconto']; 
		$CupomPorcentagem = $rSqlCupom['desconto']; 
	
		if(trim($CupomTipo)=="valor") {
			$valor_desconto = $CupomValor;
			$valor_pagando = $value['valor_venda'] - $valor_desconto;
		} else {
			$porcentagemGet = $CupomPorcentagem;
			if($porcentagemGet>0) {
				$valor_desconto = ($porcentagemGet / 100) * $value['valor_venda'];
			} else {
				$valor_desconto = 0;
			}
			$valor_pagando = $value['valor_venda'] - $valor_desconto;
		}
	} else {
		$valor_pagando = $value['valor_venda'];
	}
	
	return $valor_pagando;
}
}

if(!function_exists('latitude_longitude')) {
function latitude_longitude($POST_SEND,$prefixoSend,$GOOGLE_MAP_KEY_Send)
{

	if(trim($GOOGLE_MAP_KEY_Send)=="") {
		$COORDENADAS['latitude'] = "0";
		$COORDENADAS['longitude'] = "0";
	} else {
		$GOOGLE_MAP_KEY_SET = "".$GOOGLE_MAP_KEY_Send."";

		#Montagem de endereço para retornar Latitude e Longitude
		$monta_endereco_geo = "".str_replace(" ","%20",str_replace("-","",$POST_SEND[''.$prefixoSend.'cep']))."";
		$monta_endereco_geo .= ",".str_replace(" ","%20",$POST_SEND[''.$prefixoSend.'rua'])."";
		if(trim($POST_SEND['numero'])=="") { } else { $monta_endereco_geo .= ",".$POST_SEND[''.$prefixoSend.'numero'].""; }
		if(trim($POST_SEND['bairro'])=="") { } else { $monta_endereco_geo .= ",".str_replace(" ","%20",$POST_SEND[''.$prefixoSend.'bairro']).""; }
		if(trim($POST_SEND['cidade'])=="") { } else { $monta_endereco_geo .= ",".str_replace(" ","%20",$POST_SEND[''.$prefixoSend.'cidade']).""; }
		if(trim($POST_SEND['estado'])=="") { } else { $monta_endereco_geo .= ",".$POST_SEND[''.$prefixoSend.'estado'].""; }
		
		$address = "".$monta_endereco_geo."";
		$address = str_replace(" ","%20",$address);
		$geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$address.'&key='.$GOOGLE_MAP_KEY_SET.'');
		$output= json_decode($geocode);
		$COORDENADAS['latitude'] = $output->results[0]->geometry->location->lat;
		$COORDENADAS['longitude'] = $output->results[0]->geometry->location->lng;
	}
	
	return $COORDENADAS;

}
}

if(!function_exists('limpa_valor_dinheiro')) {
function limpa_valor_dinheiro($str)
{
  if(strstr($str, ",")) {
    $str = str_replace(".", "", $str); // replace dots (thousand seps) with blancs
    $str = str_replace(",", ".", $str); // replace ',' with '.'
  }
 
  if(preg_match("#([0-9\.]+)#", $str, $match)) { // search for number that may contain '.'
    return floatval($match[0]);
  } else {
    return floatval($str); // take some last chances with floatval
  }

}
}


if(!function_exists('filtro_tabela')) {
function filtro_tabela()
{

	$sysusuSend = $_SESSION['sysusu'];
	$mod = $_SESSION['mod'];
	if(trim($_SESSION[''.$mod.'busca'])!="") {
		$filtro = "";
		$dataRange = 0;
	
		$buscaArray = json_decode($_SESSION[''.$mod.'busca'], true);
		foreach ($buscaArray as $key => $value) {
			if(trim($value["valor"])!="") {
				if(trim($value["bd_externo"])=="") {
					$modFiltro = "".$mod."";
					$campoFiltro = "".$value["nome"]."";
				} else {
					$modFiltro = "".$value["bd_externo"]."";
					$campoFiltro = "".str_replace("".$value["bd_externo"]."_","",$value["nome"])."";
				}
	
				if(strrpos($campoFiltro,"documento") === false) { } else { 
					$value["valor"] = preg_replace("/[^0-9]/", "", $value["valor"]);
				}

				if(strrpos($campoFiltro,"cpf") === false) { } else { 
					$value["valor"] = preg_replace("/[^0-9]/", "", $value["valor"]);
				}
				
				if($value["pesquisa"]=="igual") {
					$filtro .= " AND mod_".$modFiltro.".".$campoFiltro."='".$value["valor"]."' ";
				
				} else if($value["pesquisa"]=="like") {
					$filtro .= " AND mod_".$modFiltro.".".$campoFiltro." LIKE '%".$value["valor"]."%' ";
				
				} else if($value["pesquisa"]=="data_de") {
					$value["valor"] = normalTOdate($value["valor"]);
					$filtro .= " AND mod_".$modFiltro.".".str_replace("_de","",$campoFiltro)." >= '".$value["valor"]." 00:00:00' ";
				
				} else if($value["pesquisa"]=="data_ate") {
					$value["valor"] = normalTOdate($value["valor"]);
					$filtro .= " AND mod_".$modFiltro.".".str_replace("_ate","",$campoFiltro)." <= '".$value["valor"]." 23:59:59' ";

				} else if($value["pesquisa"]=="valor_de") {
					$value["valor"] = $value["valor"];
					$value["valor"] = str_replace("R$ ","",$value["valor"]);
					$value["valor"] = $value["valor"];
					for ($i = 1; $i <= 10; $i++) {
						$value["valor"] = str_replace(".","",$value["valor"]);
					}
					$value["valor"] = str_replace(",",".",$value["valor"]);
					if(trim($value["valor"])=="" || trim($value["valor"])==0) {
						$value["valor"] = 0.00;
					}
					$filtro .= " AND mod_".$modFiltro.".".str_replace("_de","",$campoFiltro)." >= ".$value["valor"]." ";

				} else if($value["pesquisa"]=="valor_ate") {
					$value["valor"] = $value["valor"];
					$value["valor"] = str_replace("R$ ","",$value["valor"]);
					$value["valor"] = $value["valor"];
					for ($i = 1; $i <= 10; $i++) {
						$value["valor"] = str_replace(".","",$value["valor"]);
					}
					$value["valor"] = str_replace(",",".",$value["valor"]);
					if(trim($value["valor"])=="" || trim($value["valor"])==0) {
						$value["valor"] = 0.00;
					}
					$filtro .= " AND mod_".$modFiltro.".".str_replace("_ate","",$campoFiltro)." <= ".$value["valor"]." ";

				} else if($value["pesquisa"]=="multiplo_like") {
					$kws = explode(",", $modFiltro);
					$filtroMultiplo = "";
					for($i = 0, $c = count($kws); $i < $c; $i++) {
						if($i==0) { $prefixoFiltro = ""; } else { $prefixoFiltro = " OR "; }
						$filtroMultiplo .= " ".$prefixoFiltro." mod_".$kws[$i].".".$campoFiltro." LIKE '%".$value["valor"]."%' ";
					}
					$filtro .= " AND (".$filtroMultiplo.")";

				} else if($value["pesquisa"]=="multiplo_igual") {
					$kws = explode(",", $modFiltro);
					$filtroMultiplo = "";
					for($i = 0, $c = count($kws); $i < $c; $i++) {
						if($i==0) { $prefixoFiltro = ""; } else { $prefixoFiltro = " OR "; }
						$filtroMultiplo .= " ".$prefixoFiltro." mod_".$kws[$i].".".$campoFiltro."='".$value["valor"]."' ";
					}
					$filtro .= " AND (".$filtroMultiplo.")";

				}
			}
		}
	}
	
	$monta_filtro_inline = $filtro;
	
	if(trim($sysusuSend['empresa'])=="" || trim($sysusuSend['empresa'])=="0") {
		if(trim($monta_filtro_inline)=="") {
			$where = " WHERE mod_".$mod.".dataModificacao BETWEEN '0000-00-00 00:00:00' AND '9999-12-31 23:59:59' ";
		} else {
			$where = " WHERE mod_".$mod.".dataModificacao BETWEEN '0000-00-00 00:00:00' AND '9999-12-31 23:59:59' ".$monta_filtro_inline."";
		}
	} else {
		if(trim($monta_filtro_inline)=="") {
			$where = " WHERE mod_".$mod.".dataModificacao BETWEEN '0000-00-00 00:00:00' AND '9999-12-31 23:59:59' AND mod_".$mod.".empresa='".$sysusuSend['empresa']."' ";
		} else {
			$where = " WHERE mod_".$mod.".dataModificacao BETWEEN '0000-00-00 00:00:00' AND '9999-12-31 23:59:59' AND mod_".$mod.".empresa='".$sysusuSend['empresa']."' ".$monta_filtro_inline."";
		}
	}
	
	return $where;

}
}

if(!function_exists('array_sort')) {
function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}
}

if(!function_exists('distance')) {
function distance($lat1, $lon1, $lat2, $lon2, $unit) {
 
	$theta = $lon1 - $lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	$unit = strtoupper($unit);
 
	if ($unit == "K") {
		return ($miles * 1.609344);
	} else if ($unit == "N") {
		return ($miles * 0.8684);
	} else {
		return $miles;
	}
}
}

if(!function_exists('valida_email')) {
function valida_email($email) {
	return preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email);
}
}

if(!function_exists('masc_tel')) {
function masc_tel($TEL) {
	$tam = strlen(preg_replace("/[^0-9]/", "", $TEL));
	if ($tam == 13) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS e 9 dígitos
	  return "+".substr($TEL,0,$tam-11)."(".substr($TEL,$tam-11,2).")".substr($TEL,$tam-9,5)."-".substr($TEL,-4);
	}
	if ($tam == 12) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS
	  return "+".substr($TEL,0,$tam-10)."(".substr($TEL,$tam-10,2).")".substr($TEL,$tam-8,4)."-".substr($TEL,-4);
	}
	if ($tam == 11) { // COM CÓDIGO DE ÁREA NACIONAL e 9 dígitos
	  return "(".substr($TEL,0,2).")".substr($TEL,2,5)."-".substr($TEL,7,11);
	}
	if ($tam == 10) { // COM CÓDIGO DE ÁREA NACIONAL
	  return "(".substr($TEL,0,2).")".substr($TEL,2,4)."-".substr($TEL,6,10);
	}
	if ($tam <= 9) { // SEM CÓDIGO DE ÁREA
	  return substr($TEL,0,$tam-4)."-".substr($TEL,-4);
	}
}
}

if(!function_exists('isMobile')) {
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
}

if(!function_exists('trata_datetime_vazia')) {
function trata_datetime_vazia($campoSend) {
	if(trim($campoSend)=="" || trim($campoSend)=="0000-00-0 00:00:00") {
		$campoSend = "1999-12-31 00:00:00";
	} else {
		$campoSend = $campoSend;
	}
	return $campoSend;
}
}

if(!function_exists('trata_date_vazia')) {
function trata_date_vazia($campoSend) {
	if(trim($campoSend)=="" || trim($campoSend)=="0000-00-00") {
		$campoSend = "1999-12-31";
	} else {
		$campoSend = $campoSend;
	}
	return $campoSend;
}
}

if(!function_exists('mascaraTelefone')) {
function mascaraTelefone($telefoneSend) {
	if(trim($telefoneSend)=="") { } else {
		$valor_print = preg_replace("/[^0-9]/", "",$telefoneSend);
		$parte1 = substr($valor_print,0,2);
		$parte2 = substr($valor_print,2,5);
		$parte3 = substr($valor_print,7,4);
		$valor_print = "(".$parte1.") ".$parte2.".".$parte3."";
		return $valor_print;
	}
}
}

if(!function_exists('mascaraCpf')) {
function mascaraCpf($documentoSend) {
	$documentoSend = preg_replace("/[^0-9]/", "",$documentoSend);
	if(trim($documentoSend)=="") { } else {
		$valor_print = str_replace(" ","",$documentoSend);
		$parte1 = substr($valor_print,0,3);
		$parte2 = substr($valor_print,3,3);
		$parte3 = substr($valor_print,6,3);
		$parte4 = substr($valor_print,9,2);
		$valor_print = "".$parte1.".".$parte2.".".$parte3."-".$parte4."";
		return $valor_print;
	}
}
}

if(!function_exists('mascaraCnpj')) {
function mascaraCnpj($documentoSend) {
	$documentoSend = preg_replace("/[^0-9]/", "",$documentoSend);
	if(trim($documentoSend)=="") { } else {
		$valor_print = str_replace(" ","",$documentoSend);
		$parte1 = substr($valor_print,0,2);
		$parte2 = substr($valor_print,2,3);
		$parte3 = substr($valor_print,5,3);
		$parte4 = substr($valor_print,9,4);
		$parte5 = substr($valor_print,12,2);
		$valor_print = "".$parte1.".".$parte2.".".$parte3."/".$parte4."-".$parte5."";
		return $valor_print;
	}
}
}

if(!function_exists('data_nasc_corrige')) {
function data_nasc_corrige($dataSend) {
	if(trim($dataSend)=="") { 
		$rSql['data_de_nascimento'] = "1999-12-31"; 
	} else {
		$dataSend = preg_replace("/[^0-9]/", "", $dataSend);

		$ano = substr($dataSend,0,4);
		$mes = substr($dataSend,4,2);
		$dia = substr($dataSend,6,2);
		
		if(strlen($ano)<4) { $ano = "1".$ano.""; } else { $ano = $ano; }
		if(strlen($mes)<2) { $mes = "0".$mes.""; } else { $mes = $mes; }
		if(strlen($dia)<2) { $dia = "0".$dia.""; } else { $dia = $dia; }

		if($ano>2019 || $ano<1900) { $ano = 1999; } else { $ano=$ano; }
		if($mes>12 || $mes<1) { $mes = "12"; } else { $mes=$mes; }

		if( $mes=="01" ||
			$mes=="03" ||
			$mes=="05" ||
			$mes=="07" ||
			$mes=="08" ||
			$mes=="10" ||
			$mes=="12"
		) {
			$diaMax = 31;
		} else if( $mes=="02" ) {
			$diaMax = 28;
		} else if( $mes=="04" || $mes=="06" || $mes=="09" || $mes=="11" ) {
			$diaMax = 30;
		}

		if($dia>31 || $dia<1) { 
			$dia = $diaMax; 
		} else { 
			if( ($mes=="01" ||
				$mes=="03" ||
				$mes=="05" ||
				$mes=="07" ||
				$mes=="08" ||
				$mes=="10" ||
				$mes=="12") && $dia>31
			) {
				$dia = 31;
			} else if( $mes=="02" && $dia>28 ) {
				$dia = 28;
			} else if( ($mes=="04" || $mes=="06" || $mes=="09" || $mes=="11") && $dia>30 ) {
				$dia = 30;
			} else {
				$dia=$dia; 
			}
		}
		$rSql['data_de_nascimento'] = "".$ano."-".$mes."-".$dia.""; 
	}
	
	return $rSql['data_de_nascimento'];
}
}

if(!function_exists('data_date_corrige')) {
function data_date_corrige($dataSend) {
	if(trim($dataSend)=="") { 
		$rSql['data_de_nascimento'] = "1999-12-31"; 
	} else {
		$dataSend = preg_replace("/[^0-9]/", "", $dataSend);

		$ano = substr($dataSend,0,4);
		$mes = substr($dataSend,4,2);
		$dia = substr($dataSend,6,2);
		
		if(strlen($ano)<4) { $ano = "1".$ano.""; } else { $ano = $ano; }
		if(strlen($mes)<2) { $mes = "0".$mes.""; } else { $mes = $mes; }
		if(strlen($dia)<2) { $dia = "0".$dia.""; } else { $dia = $dia; }

		if($ano>2099 || $ano<1900) { $ano = 1999; } else { $ano=$ano; }
		if($mes>12 || $mes<1) { $mes = "12"; } else { $mes=$mes; }

		if( $mes=="01" ||
			$mes=="03" ||
			$mes=="05" ||
			$mes=="07" ||
			$mes=="08" ||
			$mes=="10" ||
			$mes=="12"
		) {
			$diaMax = 31;
		} else if( $mes=="02" ) {
			$diaMax = 28;
		} else if( $mes=="04" || $mes=="06" || $mes=="09" || $mes=="11" ) {
			$diaMax = 30;
		}

		if($dia>31 || $dia<1) { 
			$dia = $diaMax; 
		} else { 
			if( ($mes=="01" ||
				$mes=="03" ||
				$mes=="05" ||
				$mes=="07" ||
				$mes=="08" ||
				$mes=="10" ||
				$mes=="12") && $dia>31
			) {
				$dia = 31;
			} else if( $mes=="02" && $dia>28 ) {
				$dia = 28;
			} else if( ($mes=="04" || $mes=="06" || $mes=="09" || $mes=="11") && $dia>30 ) {
				$dia = 30;
			} else {
				$dia=$dia; 
			}
		}
		$rSql['data_de_nascimento'] = "".$ano."-".$mes."-".$dia.""; 
	}
	
	return $rSql['data_de_nascimento'];
}
}

if(!function_exists('monta_conteudo')) {
function monta_conteudo($textoSend)
{

	$conteudo_send = $textoSend;
	
	###### LIMPA TARGET _SELF
	while(($numero_ocorrencias = strpos($conteudo_send, 'target=\"_self\"', $numero_ocorrencias+1)) != 0) {
		$contador_src++;
		$conteudo_send = str_replace('target=\"_self\"','',$conteudo_send);
	}

	###### LIMPA TARGET _BLANK
	while(($numero_ocorrencias = strpos($conteudo_send, 'target=\"_blank\"', $numero_ocorrencias+1)) != 0) {
		$contador_src++;
		$conteudo_send = str_replace('target=\"_blank\"','',$conteudo_send);
	}

	###### LIMPA TARGET _TOP
	while(($numero_ocorrencias = strpos($conteudo_send, 'target=\"_top\"', $numero_ocorrencias+1)) != 0) {
		$contador_src++;
		$conteudo_send = str_replace('target=\"_top\"','',$conteudo_send);
	}

	###### LIMPA TARGET _PARENT
	while(($numero_ocorrencias = strpos($conteudo_send, 'target=\"_parent\"', $numero_ocorrencias+1)) != 0) {
		$contador_src++;
		$conteudo_send = str_replace('target=\"_parent\"','',$conteudo_send);
	}

	###### MONTA LINK E TARGET
	while(($numero_ocorrencias = strpos($conteudo_send, '<a', $numero_ocorrencias+1)) != 0) {

			$conteudo_set = substr($conteudo_send,$numero_ocorrencias);
			$fecha_tag = strpos($conteudo_set, "</a>");

			$tag = substr($conteudo_send,$numero_ocorrencias,$fecha_tag+4);
			
			if(strrpos($tag,"target") > 0) {
				$tag_limpo = str_replace("<a","<a target=\"_blank\" ",$tag);
			} else {
				$tag_limpo = str_replace("<a","<a target=\"_blank\" ",$tag);
			}


			$conteudo_send = str_replace(''.$tag.'',''.$tag_limpo.'',$conteudo_send);
			
	}

	return $conteudo_send;

}
}

if(!function_exists('mysql_datetime_para_timestamp')) {
function mysql_datetime_para_timestamp($dt) {
    $yr=strval(substr($dt,0,4));
    $mo=strval(substr($dt,5,2));
    $da=strval(substr($dt,8,2));
    $hr=strval(substr($dt,11,2));
    $mi=strval(substr($dt,14,2));
    $se=strval(substr($dt,17,2));
    #return $hr."-".$mi."-".$se."-".$mo."-".$da."-".$yr;
    return mktime($hr,$mi,$se,$mo,$da,$yr);
}
}

if(!function_exists('retiraAcentos')) {
function retiraAcentos($string){
	$array1 = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç" , "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç", " " );
	$array2 = array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c" , "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C", "_" );
	return str_replace($array1, $array2,$string);
}
}

if(!function_exists('cor_alteatoria')) {
function cor_alteatoria() {
	$cor = array ( 
		"0" => "#e6b30e",       
		"1" => "#d61212",
		"2" => "#d66e12",
		"3" => "#d6b312",
		"4" => "#e4eb22",
		"5" => "#a2eb22",
		"6" => "#43eb22",
		"7" => "#22eb9d",
		"8" => "#22e4eb",
		"9" => "#2298eb",
		"10" => "#223aeb",
		"11" => "#5622eb",
		"12" => "#8f22eb",
		"13" => "#b922eb",
		"14" => "#eb22df",
		"15" => "#eb22b9",
		"16" => "#eb2281",
		"17" => "#255782",
		"18" => "#258257",
		"19" => "#488225",
		"20" => "#823225"
	); 
 
	return $cor[array_rand($cor)];
}
}

if(!function_exists('get_plataforma')) {
function get_plataforma() {
	$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
	$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
	$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
	$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
	$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
	
	if ($iphone || $ipad == true) {
		$tipo_set = "apple";
	} else if ( $android == true) {
		$tipo_set = "android";
	} else {
		$tipo_set = "outro";
	}
	
	return $tipo_set;
}
}

if(!function_exists('get_origem')) {
function get_origem() {
	$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
	$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
	$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
	$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
	$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
	
	if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
		$tipo_set = "MOBILE";
	} else {
		$tipo_set = "SITE";
	}
	
	return $tipo_set;
}
}

if(!function_exists('get_ipAll')) {
function get_ipAll() {
	$variables = array(REMOTE_ADDR,
	HTTP_X_FORWARDED_FOR,
	HTTP_X_FORWARDED,
	HTTP_FORWARDED_FOR,
	HTTP_FORWARDED,
	HTTP_X_COMING_,
	HTTP_COMING_,
	HTTP_CLIENT_IP);

	$return = Unknown;

	foreach ($variables as $variable) {
		if (isset($_SERVER[$variable])) {
			$return.= $_SERVER[$variable]." - ";
		}
	}

	return $return;
}
}

if(!function_exists('get_client_ip')) {
function get_client_ip() {
     $ipaddress = '';
     if ($_SERVER['HTTP_CLIENT_IP'])
         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
     else if($_SERVER['HTTP_X_FORWARDED_FOR'])
         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
     else if($_SERVER['HTTP_X_FORWARDED'])
         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
     else if($_SERVER['HTTP_FORWARDED_FOR'])
         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
     else if($_SERVER['HTTP_FORWARDED'])
         $ipaddress = $_SERVER['HTTP_FORWARDED'];
     else if($_SERVER['REMOTE_ADDR'])
         $ipaddress = $_SERVER['REMOTE_ADDR'];
     else
         $ipaddress = 'UNKNOWN';

     return $ipaddress; 
}
}

if(!function_exists('MaskCampos')) {
function MaskCampos($mask,$str){

    $str = str_replace(" ","",$str);

    for($i=0;$i<strlen($str);$i++){
        $mask[strpos($mask,"#")] = $str[$i];
    }

    return $mask;

}
}

if(!function_exists('strip_tags_content')) {
function strip_tags_content($text, $tags = '', $invert = FALSE) { 

  preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags); 
  $tags = array_unique($tags[1]); 
    
  if(is_array($tags) AND count($tags) > 0) { 
    if($invert == FALSE) { 
      return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text); 
    } 
    else { 
      return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text); 
    } 
  } 
  elseif($invert == FALSE) { 
    return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text); 
  } 
  return $text; 

} 
}

// Função de porcentagem: Quanto é X% de N?
if(!function_exists('porcentagem_xn')) {
function porcentagem_xn( $porcentagem, $total ) {
	if(trim($porcentagem)=="" || trim($total)=="" || trim($porcentagem)=="0" || trim($total)=="0") { 
		return "0";
	} else {
		return number_format((( $porcentagem / 100 ) * $total), 2, ',', ' ');
	}
}
}

// Função de porcentagem: N é X% de N
if(!function_exists('porcentagem_nx')) {
function porcentagem_nx( $parcial, $total ) {
	if(trim($parcial)=="" || trim($total)=="" || trim($parcial)=="0" || trim($total)=="0") { 
		return number_format(0, 2, ',', ' ');
	} else {
		return number_format((( $parcial * 100 ) / $total), 2, ',', ' ');
	}
}
}

if(!function_exists('limpa_retorno')) {
function limpa_retorno($valorSend,$caracSend) 
{
	$string = preg_replace("/".$caracSend."/", "", $valorSend);
	return $string;
}
}

if(!function_exists('caracteres_especiais')) {
function caracteres_especiais($valorSend,$modoSend) 
{

	if($modoSend=="ler") {
		$valorGet = str_replace("&quot;","\"",$valorSend);
		$valorGet = str_replace("&apos;","'",$valorGet);
		$valorGet = str_replace("{abre_par}","(",$valorGet); 
		$valorGet = str_replace("{fecha_par}",")",$valorGet); 
		$valorGet = str_replace("{interrogacao}","?",$valorGet); 
		$valorGet = str_replace("{espaco}","%20",$valorGet); 
		$valorGet = str_replace("{ecom}","&",$valorGet); 
		$valorGet = str_replace("{igual}","=",$valorGet); 
		$valorGet = str_replace("{mais}","+",$valorGet); 
		$valorGet = str_replace("{hash}","#",$valorGet); 
	} else {
		$valorGet = str_replace("\"","&quot;",$valorSend);
		$valorGet = str_replace("'","&apos;",$valorGet);
		$valorGet = str_replace("(","{abre_par}",$valorGet); 
		$valorGet = str_replace(")","{fecha_par}",$valorGet); 
		$valorGet = str_replace("?","{interrogacao}",$valorGet);
		$valorGet = str_replace("%20","{espaco}",$valorGet);
		$valorGet = str_replace("&","{ecom}",$valorGet);
		$valorGet = str_replace("=","{igual}",$valorGet);
		$valorGet = str_replace("+","{mais}",$valorGet);
		$valorGet = str_replace("#","{hash}",$valorGet);
	}
	
	return $valorGet;


}
}


if(!function_exists('sub_aspas')) {
function sub_aspas($conteudo) 
{
	$value = str_replace("\"","&quot;",$conteudo);
	$value = str_replace("'","&apos;",$value);
	return $value;
}
}

if(!function_exists('numero_processos_sql')) {
function numero_processos_sql() 
{
	$result = mysql_list_processes($link);
	$cont=0;
	while ($row = mysql_fetch_assoc($result)){ $cont++; }
	return $cont;
}
}
if(!function_exists('arraySysusu')) {
function arraySysusu($email,$senha)
{
	$rSql = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE email='".$email."' AND senha='".$senha."'"));
	$list = array();
	$list[0] = $rSql;

	return $list;
}
}

if(!function_exists('arrayModuloConfig')) {
function arrayModuloConfig($mod)
{
	$rSql = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_config ORDER BY id LIMIT 1"));
	$list = array();
	$list[0] = $rSql;

	return $list;
}
}

if(!function_exists('arrayModuloMinhaConfig')) {
function arrayModuloMinhaConfig($mod,$sysusu_id)
{
	$rSql = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_minha_config WHERE idsysusu='".$sysusu_id."' ORDER BY id LIMIT 1"));
	$list = array();
	$list[0] = $rSql;

	return $list;
}
}

if(!function_exists('arrayModuloEstrutura')) {
function arrayModuloEstrutura($mod)
{
	$rSql = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_estrutura LIMIT 1"));
	$list = array();
	$list[0] = $rSql;

	return $list;
}
}

if(!function_exists('By2M')) {
function By2M($size)
{
    $filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    return $size ? round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i] : '0 Bytes';
}
}

if(!function_exists('UrlAtual')) {
function UrlAtual()
{
	$dominio= $_SERVER['SERVER_NAME'];
	$url = "http://" . $dominio. $_SERVER['REQUEST_URI'];
	return $url;
}
}

if(!function_exists('conecta_Memcache')) {
function conecta_Memcache() 
{
	
	$memcache_obj = new Memcache;
	$memcache_obj->connect('127.0.0.1', 11211);
	return $memcache_obj;
	
}
}

if(!function_exists('lista_stat_memcache_key')) {
function lista_stat_memcache_key($key,$statGet)
{

	if($statGet=="detail") {
		return $list[$key]["detail"][1];
	} else {
		return $list[$key][$statGet];
	}

}
}
if(!function_exists('armazena_page_Cache')) {
function armazena_page_Cache($url, $conteudo, $tempo = 600) 
{
	
	$chave = md5($url);

	$memcache_obj = conecta_Memcache();
	if( $memcache_obj->getStats()===false ){ } else {

		$memcache_obj->set($chave, $conteudo, MEMCACHE_COMPRESSED, $tempo);

	}
}
}

if(!function_exists('renova_item_memcache')) {
function renova_item_memcache($tipo, $consulta_url, $tempo = 600) 
{
	
	$chave = md5($consulta_url);

	$memcache_obj = conecta_Memcache();

	if ( trim($tipo) == "sql" ) {
		
		$list = array();
		$cont = 0;
		$qSql = mysql_query($consulta_url);
		while($rSql = mysql_fetch_assoc($qSql)) {
			$id = $rSql['id'];
			$rSql['id_sys_arquivo'] = $rSql['id'];
			$list[$cont] = $rSql;
			$cont++;
		}
		
	} else {

		$contents = file_get_contents("".$consulta_url."");
		
		$list = $contents;

	}

	$query = $memcache_obj->get($chave);
	
	if( $memcache_obj->getStats()===false ){ } else {
		if ( $query === false ) { 
			$memcache_obj->set($chave, $list, MEMCACHE_COMPRESSED, $tempo);
		} else {
			#$memcache_obj->delete($chave);
			$memcache_obj->replace($chave, $list, MEMCACHE_COMPRESSED, $tempo);
		}
	}

}
}

if(!function_exists('carrega_page_Cache')) {
function carrega_page_Cache($url, $tempo = 300) 
{
	
	$chave = md5($url);

	$memcache_obj = conecta_Memcache();
	if( $memcache_obj->getStats()===false ){ } else {

		$pagina_set = $memcache_obj->get($chave);
		
	}

	return $pagina_set;
}
}

if(!function_exists('mysql_queryCache_itens')) {
function mysql_queryCache_itens($cacheOffSend, $consulta, $tempo = 300) 
{

	if($cacheOffSend=="1") {

		$list = array();
		$cont = 0;
		$qSql = mysql_query($consulta);
		while($rSql = mysql_fetch_assoc($qSql)) {
			$id = $rSql['id'];
			$rSql['id_sys_arquivo'] = $rSql['id'];
			$list[$cont] = $rSql;
			$cont++;
		}
		$query = $list;

	} else {

		$chave = md5($consulta);

		$memcache_obj = conecta_Memcache();

		$query = $memcache_obj->get($chave);
	
		$cache_habilitado = $sysconfig['memcache_query'];
	
		if ( $query === false || $memcache_obj->getStats()===false || $cache_habilitado==0 || trim($cache_habilitado)=="" ) {
			
			$list = array();
			$cont = 0;
			$qSql = mysql_query($consulta);
			while($rSql = mysql_fetch_assoc($qSql)) {
				$id = $rSql['id'];
				$rSql['id_sys_arquivo'] = $rSql['id'];
				$list[$cont] = $rSql;
				$cont++;
			}
			
			$memcache_obj->set($chave, $list, MEMCACHE_COMPRESSED, $tempo);
	
			$query = $memcache_obj->get($chave);
	
		}

	}

	return $query;
}
}

if(!function_exists('setTipoValorTbody')) {
function setTipoValorTbody($tipoSend,$campoSend,$valorSend,$modSend,$arraySend,$numeroUnicoSend) 
{
	
	global $data;
	global $link;

	if(trim($tipoSend)=="") {
		$impressao = $valorSend;
	} elseif(trim($tipoSend)=="normal") {
		$impressao = $valorSend;
	} elseif(trim($tipoSend)=="externo_multiplo") {
		
		if (trim($valorSend) != "") {
			$lista_id_multiplo = str_replace("||",", ",$valorSend);
			$lista_id_multiplo = str_replace("|","",$lista_id_multiplo);
			$impressao = $lista_id_multiplo;
		} else {
			$impressao = "";
		}
		
	} elseif(trim($tipoSend)=="externo_unico") {
		$impressao = $valorSend;
	} elseif(trim($tipoSend)=="switch_sim_nao") {
		if(trim($valorSend)=="0"||trim($valorSend)=="") {
			$impressao = "NÃO";
		} else {
			$impressao = "SIM";
		}
	} elseif(trim($tipoSend)=="link") {
		$impressao = "<a href=\"".$valorSend."\" target=\"_blank\">".$valorSend."</a>";
	} elseif(trim($tipoSend)=="milhar") {
		$impressao = formatMilhar($valorSend);
	} elseif(trim($tipoSend)=="moeda") {
		$impressao = formatMoney($valorSend);
	} elseif(trim($tipoSend)=="data") {
		if(trim($valorSend)==""||trim($valorSend)=="0000-00-00") { } else { 
			$impressao = ajustaDataSemHoraReturn($valorSend,"d/m/Y");
		}
	} elseif(trim($tipoSend)=="data_hora") {
		if(trim($valorSend)==""||trim($valorSend)=="0000-00-00 00:00:00") { } else { 
			if($valorSend>$data) {
				$agendado_set = "<div style=\"float:right;\" title=\"Conteúdo agendado para ".ajustaDataReturn($valorSend,"d/m/Y")."\"><i style=\"padding:0px;font-size:20px !important;margin-right:5px;margin-top:5px;margin-left:5px;\" class=\"fa fa-clock-o\"></i></div>";
			}

			$impressao = ajustaDataReturn($valorSend,"d/m/Y")."".$agendado_set."";
		}
	}
	
	if(trim($tipoSend)=="imagem") {
		if(trim($valorSend)=="") {
			$impressao = "";
		} else {
			$css_thumb = "border: 3px solid #fff;webkit-box-shadow: 0 0.5rem 1.5rem 0.5rem rgba(0,0,0,.075);box-shadow: 0 0.5rem 1.5rem 0.5rem rgba(0,0,0,.075);";
			$impressao = "<a href=\"".$link."files/".$modSend."/".$numeroUnicoSend."/".$valorSend."\" style=\"width:100%;\" class=\"thumbnail fancybox-button\"><img style=\"".$css_thumb."\" src=\"".$link."files/".$modSend."/".$numeroUnicoSend."/".$valorSend."\"></a>";
		}
	} else {
		$string = $impressao;
		$charset = (utf8_encode(utf8_decode($string)) == $string);
		if($charset) {
			$impressao = "".$impressao."";
		} else {
			$impressao = mb_convert_encoding($impressao, "UTF-8");
		}
	}

	return $impressao;

}
}

if(!function_exists('setSqlInnerJoin')) {
function setSqlInnerJoin($modSend) 
{

	if(trim($modSend)=="sysacesso"||trim($modSend)=="syslog") {

		$sql_inner .= "INNER JOIN sysusu AS mod_sysusu ON (mod_".$modSend.".idsysusu = mod_sysusu.id) ";

	} else {

		$modulo_set = mysql_fetch_array(mysql_query("SELECT id,nome_base,armazenar_sys_arquivo,contador_conteudo FROM _construtor_modulo WHERE nome_base='".$modSend."'"));
	
		$qSqlListaFunction = mysql_query("SELECT id,campo,tipo,stat,ordem FROM ".$modSend."_cabecalho WHERE stat='1' ORDER BY ordem");
		while($rSqlListaFunction = mysql_fetch_array($qSqlListaFunction)) {

			if(trim($rSqlListaFunction['campo'])=="Personalizado") { } else {
				$rSqlCampoFunction = mysql_fetch_array(mysql_query("SELECT 
																	id,nome_base,id_construtor_modulo,tipo_subitem,tipo_subitem_modulo_externo,numeroUnico,edicao_rapida 
																	FROM _construtor_modulo_campo 
																	WHERE nome_base='".$rSqlListaFunction['campo']."' AND id_construtor_modulo='".$modulo_set['id']."'"));
		
	
				if(strrpos($rSqlListaFunction['campo'],"_categoria") > 0) { 
		
					$sql_inner        .= " LEFT JOIN ".$modSend."_categoria AS mod_".$modSend."_categoria ON (mod_".$modSend.".".$rSqlListaFunction['campo']." = mod_".$modSend."_categoria.id) ";
		
				} elseif(trim($rSqlListaFunction['campo'])=="idsysusu") {
	
					$sql_inner        .= " INNER JOIN sysusu AS mod_sysusu ON (mod_".$modSend.".idsysusu = mod_sysusu.id) ";
		
				} elseif(trim($rSqlListaFunction['tipo'])=="externo_multiplo") {
	
					$sql_inner .= "";
	
				} elseif(trim($rSqlListaFunction['tipo'])=="externo_unico") {
		
						if($rSqlCampoFunction['tipo_subitem_modulo_externo']=="1111111111") {
							$externo_mod = "sysusu";
							$externo_campo = "id";
							$externo_label = "nome";
						} elseif($rSqlCampoFunction['tipo_subitem_modulo_externo']=="2222222222") {
							$externo_mod = "cepbr_estado";
							$externo_campo = "uf";
							$externo_label = "estado";
						} elseif($rSqlCampoFunction['tipo_subitem_modulo_externo']=="3333333333") {
							$externo_mod = "cepbr_cidade";
							$externo_campo = "id_cidade";
							$externo_label = "cidade";
						} elseif($rSqlCampoFunction['tipo_subitem_modulo_externo']=="4444444444") {
							$externo_mod = "cepbr_bairro";
							$externo_campo = "id_bairro";
							$externo_label = "bairro";
						} elseif($rSqlCampoFunction['tipo_subitem_modulo_externo']=="5555555555") {
							$externo_mod = "sysbanco_lista";
							$externo_campo = "id";
							$externo_label = "nome";
							$sql_inner        .= "LEFT JOIN ".$externo_mod." AS mod_".$externo_mod." ON (mod_".$modSend.".".$rSqlListaFunction['campo']." = mod_".$externo_mod.".id) ";
						} else {
		
							$rSqlModulo = mysql_fetch_array(mysql_query("SELECT id,nome_base FROM _construtor_modulo WHERE id='".$rSqlCampoFunction['tipo_subitem_modulo_externo']."'"));
			
							$sql_inner        .= "LEFT JOIN ".$rSqlModulo['nome_base']." AS mod_".$rSqlModulo['nome_base']." ON (mod_".$modSend.".".$rSqlListaFunction['campo']." = mod_".$rSqlModulo['nome_base'].".id) ";
		
						}
		
				} else {
	
				}
			}
		
		}
		//END WHILE

		if(trim($modulo_set['armazenar_sys_arquivo'])=="1") {
			$sql_inner .= "LEFT JOIN sys_arquivo AS mod_sys_arquivo ON ( mod_sys_arquivo.id_referencia = mod_".$modSend.".id AND mod_sys_arquivo.local = '".$modSend."') ";
		}
	
	}
	
	
	return $sql_inner."";

}
}

if(!function_exists('setSqlInnerCampos')) {
function setSqlInnerCampos($modSend) 
{

	if(trim($modSend)=="sysacesso"||trim($modSend)=="syslog") {
		if(trim($idCampoSend)=="idsysusu") {
	
			$sql_inner_campos .= " mod_sysusu.nome as sysusu_nome, ";
			
		} else {
			if(trim($idCampoSend)=="data") {
				$sql_inner_campos .= " mod_sysusu.data as sysusu_data, ";
			} else {
				$sql_inner_campos .= "";
			}
		}

	} else {
		
		$modulo_set = mysql_fetch_array(mysql_query("SELECT id,nome_base,armazenar_sys_arquivo FROM _construtor_modulo WHERE nome_base='".$modSend."'"));
	
		$qSqlListaFunction = mysql_query("SELECT id,campo,tipo,stat,ordem FROM ".$modSend."_cabecalho WHERE stat='1' ORDER BY ordem");
		while($rSqlListaFunction = mysql_fetch_array($qSqlListaFunction)) {

			if(trim($rSqlListaFunction['campo'])=="Personalizado") { } else {
				$rSqlCampoFunction = mysql_fetch_array(mysql_query("SELECT 
																	id,nome_base,id_construtor_modulo,tipo_subitem,tipo_subitem_modulo_externo,numeroUnico,edicao_rapida 
																	FROM _construtor_modulo_campo 
																	WHERE nome_base='".$rSqlListaFunction['campo']."' AND id_construtor_modulo='".$modulo_set['id']."'"));

				if(strrpos($rSqlListaFunction['campo'],"_categoria") > 0) { 
		
					$sql_inner_campos .= " mod_".$modSend."_categoria.nome as mod_".$modSend."_categoria_nome, ";
		
				} elseif(trim($rSqlListaFunction['campo'])=="idsysusu") {
				
					$sql_inner_campos .= " mod_sysusu.nome as sysusu_nome, ";
		
				} elseif(trim($rSqlListaFunction['tipo'])=="externo_multiplo") {
	
					$sql_inner_campos .= " mod_".$modSend.".".$rSqlListaFunction['campo']." as ".$rSqlListaFunction['campo'].", ";
	
					$sql_inner_campos .= "";
	
				} elseif(trim($rSqlListaFunction['tipo'])=="externo_unico") {
		
						if($rSqlCampoFunction['tipo_subitem_modulo_externo']=="1111111111") {
							$externo_mod = "sysusu";
							$externo_campo = "id";
							$externo_label = "nome";
						} elseif($rSqlCampoFunction['tipo_subitem_modulo_externo']=="2222222222") {
							$externo_mod = "cepbr_estado";
							$externo_campo = "uf";
							$externo_label = "estado";
						} elseif($rSqlCampoFunction['tipo_subitem_modulo_externo']=="3333333333") {
							$externo_mod = "cepbr_cidade";
							$externo_campo = "id_cidade";
							$externo_label = "cidade";
						} elseif($rSqlCampoFunction['tipo_subitem_modulo_externo']=="4444444444") {
							$externo_mod = "cepbr_bairro";
							$externo_campo = "id_bairro";
							$externo_label = "bairro";
						} elseif($rSqlCampoFunction['tipo_subitem_modulo_externo']=="5555555555") {
							$externo_mod = "sysbanco_lista";
							$externo_campo = "id";
							$externo_label = "nome";
							$sql_inner_campos .= " mod_".$externo_mod.".".$externo_label." as ".$externo_mod."_".$externo_label.", ";
						} else {
		
							$rSqlModulo = mysql_fetch_array(mysql_query("SELECT id,nome_base FROM _construtor_modulo WHERE id='".$rSqlCampoFunction['tipo_subitem_modulo_externo']."'"));
							
							$campos_exibicao_set = "";

							$rSqlExibicao = mysql_fetch_array(mysql_query("SELECT nome_1,nome_2,nome_3,nome_4,nome_5 FROM ".$rSqlModulo['nome_base']."_estrutura LIMIT 1"));
			
							if(trim($rSqlExibicao['nome_1'])==""||trim($rSqlExibicao['nome_1'])=="null") {
								$sql_inner_campos_1 .= "";
							} else {
								$sql_inner_campos_1 .= " mod_".$rSqlModulo['nome_base'].".".$rSqlExibicao['nome_1']." as ".$rSqlModulo['nome_base']."_".$rSqlExibicao['nome_1'].", ";
							}
						
							if(trim($rSqlExibicao['nome_2'])==""||trim($rSqlExibicao['nome_2'])=="null") {
								$sql_inner_campos_2 .= "";
							} else {
								$sql_inner_campos_2 .= " mod_".$rSqlModulo['nome_base'].".".$rSqlExibicao['nome_2']." as ".$rSqlModulo['nome_base']."_".$rSqlExibicao['nome_2'].", ";
							}
						
							if(trim($rSqlExibicao['nome_3'])==""||trim($rSqlExibicao['nome_3'])=="null") {
								$sql_inner_campos_3 .= "";
							} else {
								$sql_inner_campos_3 .= " mod_".$rSqlModulo['nome_base'].".".$rSqlExibicao['nome_3']." as ".$rSqlModulo['nome_base']."_".$rSqlExibicao['nome_3'].", ";
							}
						
							if(trim($rSqlExibicao['nome_4'])==""||trim($rSqlExibicao['nome_4'])=="null") {
								$sql_inner_campos_4 .= "";
							} else {
								$sql_inner_campos_4 .= " mod_".$rSqlModulo['nome_base'].".".$rSqlExibicao['nome_4']." as ".$rSqlModulo['nome_base']."_".$rSqlExibicao['nome_4'].", ";
							}
						
							if(trim($rSqlExibicao['nome_5'])==""||trim($rSqlExibicao['nome_5'])=="null") {
								$sql_inner_campos_5 .= "";
							} else {
								$sql_inner_campos_5 .= " mod_".$rSqlModulo['nome_base'].".".$rSqlExibicao['nome_5']." as ".$rSqlModulo['nome_base']."_".$rSqlExibicao['nome_5'].", ";
							}
					
							$campos_exibicao_set = $sql_inner_campos_1.$sql_inner_campos_2.$sql_inner_campos_3.$sql_inner_campos_4.$sql_inner_campos_5;
		
							$externo_mod = "".$rSqlModulo['nome_base']."";
						
							if(trim($campos_exibicao_set)=="") {
								$externo_campo = "id";
								$externo_label = "nome";
								$sql_inner_campos .= " mod_".$rSqlModulo['nome_base'].".".$externo_label." as ".$rSqlModulo['nome_base']."_nome, ";
							} else {
								$sql_inner_campos .= "".$campos_exibicao_set."";
							}
		
		
						}
		
				} else {
	
					$sql_inner_campos .= " mod_".$modSend.".".$rSqlListaFunction['campo']." as ".$modSend."_".$rSqlListaFunction['campo'].", ";
		
				}
			}
		
		}
		//END WHILE

	}
	
	$qSqlAcao = mysql_query("SELECT * FROM ".$modSend."_acao WHERE stat='1' ORDER BY ordem");
	while($rSqlAcao = mysql_fetch_array($qSqlAcao)) {
		$campos_mod_acao .= ", mod_".$modSend.".".$rSqlAcao['campo']." as ".$modSend."_".$rSqlAcao['campo']." ";
	}

	if(trim($modulo_set['armazenar_sys_arquivo'])=="1") {
		$campos_sys_arquivo .= ", mod_sys_arquivo.id_referencia, mod_sys_arquivo.id AS mod_sys_arquivo_id ";
	}
	$sql_inner_campos = $sql_inner_campos."mod_".$modSend.".id, mod_".$modSend.".stat, mod_".$modSend.".numeroUnico ".$campos_mod_acao.$campos_sys_arquivo."";
	
	return $sql_inner_campos."";

}
}

if(!function_exists('adicionaAliasCampo')) {
function adicionaAliasCampo(&$campo, $key, $alias)
{
	$campo = "{$alias}.{$campo}";
}
}

// adiciona o alias na lista de campos, assumindo que todos os campos pertencem a mesma tabela
if(!function_exists('adicionaAlias')) {
function adicionaAlias($alias, $campos)
{
	$list = explode(',', trim($campos));
	array_walk($list, 'adicionaAliasCampo', $alias);
	return implode(',', $list);
}
}

if(!function_exists('getListaDeUsuariosAdmin')) {
function getListaDeUsuariosAdmin()
{
	$list = array();
	$rSql = mysql_queryCache_itens("1", "SELECT id,numeroUnico,nome,sobrenome,ferias,imagem,cor,twitter FROM sysusu WHERE stat='1'");
	for ($x = 0; $x < count($rSql); $x++) {
		$id = $rSql[$x]['id'];
		$list[$id] = $rSql[$x];
	}
	return $list;
}
}

if(!function_exists('getListaDeUsuarios')) {
function getListaDeUsuarios()
{
	$list = array();
	$rSql = mysql_queryCache_itens("1", "SELECT * FROM sysusu");
	for ($x = 0; $x < count($rSql); $x++) {
		$id = $rSql[$x]['id'];
		$list[$id] = $rSql[$x];
	}
	return $list;
}
}

if(!function_exists('getListaDeEventos')) {
function getListaDeEventos($empresaSend,$eventosSend,$empresasSend)
{
	if(trim($empresasSend)==""||trim($empresasSend)=="0") { 
		if(trim($empresaSend)==""||trim($empresaSend)=="0") { 
			$filtroEmpresa = ""; 
		} else { 
			$filtroEmpresa = " AND empresa='".$empresaSend."'"; 
		}
	} else { 
		$empresasSysusu = $empresasSend;
		$empresasSysusu = str_replace("||","','",$empresasSysusu);
		$empresasSysusu = str_replace("|","'",$empresasSysusu);
		$filtroEmpresa = " AND empresa IN (".$empresasSysusu.") "; 
	}

	if(trim($eventosSend)==""||trim($eventosSend)=="0") { 
		$filtroEventos = ""; 
	} else { 
		$eventosSysusu = $eventosSend;
		$eventosSysusu = str_replace("||","','",$eventosSysusu);
		$eventosSysusu = str_replace("|","'",$eventosSysusu);
		$filtroEventos = " AND numeroUnico IN (".$eventosSysusu.") "; 
	}
	
	$rSql = mysql_queryCache_itens("1", "SELECT id,empresa,nome,numeroUnico,stat,data_evento FROM eventos WHERE ( stat='0' OR stat='1' ) ".$filtroEmpresa." ".$filtroEventos." ORDER BY data_evento DESC");
	return $rSql;
}
}

if(!function_exists('getListaDeSecoes')) {
function getListaDeSecoes()
{
	$list = array();
	$rSql = mysql_queryCache_itens("1", "SELECT id,nome,icone,cor,url_brandchannel FROM secao WHERE stat='1'");
	for ($x = 0; $x < count($rSql); $x++) {
		$id = $rSql[$x]['id'];
		$rSql[$x]['url_amigavel'] = transformaCaractere($rSql[$x]['nome']);
		$list[$id] = $rSql[$x];
	}
	return $list;
}
}

if(!function_exists('getListaDeSecoesNaoOcultas')) {
function getListaDeSecoesNaoOcultas()
{
	$list = array();
	$rSql = mysql_queryCache_itens("1", "SELECT id,nome,icone,cor,url_brandchannel FROM secao WHERE stat='1' AND oculta='0'");
	for ($x = 0; $x < count($rSql); $x++) {
		$id = $rSql[$x]['id'];
		$rSql[$x]['url_amigavel'] = transformaCaractere($rSql[$x]['nome']);
		$list[$id] = $rSql[$x];
	}
	return $list;
}
}

if(!function_exists('getExternoMultiplo')) {
function getExternoMultiplo($modSend)
{
	$list = array();
	$strSQL = "SELECT id,nome FROM ".$modSend."";
	$sql = mysql_query($strSQL);
	while ($row = mysql_fetch_assoc($sql))
	{
		$id = $row['id'];
		$list[$id] = $row;
	}
	return $list;
}
}

if(!function_exists('build_link')) {
function build_link($site, $tituloSend, $urlSend)
{

	
	$url_atual = $urlSend;
	
	$charset = (utf8_encode(utf8_decode($tituloSend)) == $tituloSend);
	if($charset) {
		$titulo = "".$tituloSend."";
	} else {
		$titulo = mb_convert_encoding($tituloSend, "UTF-8");
	}

	
	switch ($site)
	{
	case 'facebook':
	  $appid = '207972199234600';
	  $u = "https://www.facebook.com/sharer.php?u=".$url_atual."&display=popup&ref=plugin&src=share_button&app_id=".$appid."";
	  break;
	case 'whatsapp':
	  $u = "whatsapp://send?text=".$titulo."%0D%0A".$url_atual."";
	  break;
	case 'twitter':
	  $u = "https://twitter.com/intent/tweet?original_referer=".$url_atual."&ref_src=twsrc%5Etfw&related=&via=Adrenaline&text=".$titulo."&tw_p=tweetbutton&url=".$url_atual."";
	  break;
	case 'google':
	  $u = "https://plus.google.com/share?url=".$url_atual."";
	  break;
	}
	return $u;
}
}

if(!function_exists('resizeImage')) {
function resizeImage($image,$width,$height,$scale) 
{
  list($imagewidth, $imageheight, $imageType) = getimagesize($image);
  $imageType = image_type_to_mime_type($imageType);
  $newImageWidth = ceil($width * $scale);
  $newImageHeight = ceil($height * $scale);
  $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
  switch($imageType) {
    case "image/gif":
      $source=imagecreatefromgif($image); 
      break;
      case "image/pjpeg":
    case "image/jpeg":
    case "image/jpg":
      $source=imagecreatefromjpeg($image); 
      break;
      case "image/png":
    case "image/x-png":
      $source=imagecreatefrompng($image); 
      break;
    }
  imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
  
  switch($imageType) {
    case "image/gif":
        imagegif($newImage,$image); 
      break;
        case "image/pjpeg":
    case "image/jpeg":
    case "image/jpg":
        imagejpeg($newImage,$image,90); 
      break;
    case "image/png":
    case "image/x-png":
      imagepng($newImage,$image);  
      break;
    }
  
  chmod($image, 0777);
  return $image;
}
}

if(!function_exists('criando_bitly_url')) {
function criando_bitly_url($url,$login,$appkey,$format = 'xml',$version = '2.0.1')
{
	//create the URL
	$bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$login.'&apiKey='.$appkey.'&format='.$format;
	
	//get the url
	//could also use cURL here
	$response = file_get_contents($bitly);
	
	//parse depending on desired format
	if(strtolower($format) == 'json')
	{
		$json = @json_decode($response,true);
		return $json['results'][$url]['shortUrl'];
	}
	else //xml
	{
		$xml = simplexml_load_string($response);
		return 'bit.ly/'.$xml->results->nodeKeyVal->hash;
	}
}
}


if(!function_exists('string_to_html')) {
function string_to_html($itemSend) 
{

	$script_set = str_replace("@aspas_dupla@", "\"", $itemSend);
	$script_set = str_replace("@aspas_simples@", "'", $script_set);
	$script_set = str_replace("@interrogacao@", "?", $script_set);
	$script_set = str_replace("@menor@", "<", $script_set);
	$script_set = str_replace("@maior@", ">", $script_set);
	$script_set = str_replace("@ecomercial@", "&", $script_set);
	$script_set = str_replace("@virgula@", ",", $script_set);
	$script_set = str_replace("@ponto_virgula@", ";", $script_set);
	$script_set = str_replace("@dois_pontos@", ":", $script_set);
	$script_set = str_replace("@chaves_abre@", "{", $script_set);
	$script_set = str_replace("@chaves_fecha@", "}", $script_set);
	$script_set = str_replace("@colchetes_abre@", "[", $script_set);
	$script_set = str_replace("@colchetes_fecha@", "]", $script_set);
	$script_set = str_replace("@parenteses_abre@", "(", $script_set);
	$script_set = str_replace("@parenteses_fecha@", ")", $script_set);
	$script_set = str_replace("@barra@", "/", $script_set);
	$script_set = str_replace("@barra_invertida@", "\\", $script_set);
	$script_set = str_replace("@igual@", "=", $script_set);
	$script_set = str_replace("@menos@", "-", $script_set);
	$script_set = str_replace("@mais@", "+", $script_set);
	$script_set = str_replace("@cifrao@", "$", $script_set);

	return $script_set;
}
}

if(!function_exists('select_multiplo')) {
function select_multiplo($itemSend,$modSend) 
{
	$listaItem = $itemSend;
	$listaItem = str_replace("||","','",$listaItem);
	$listaItem = str_replace("|","'",$listaItem);
	if(trim($listaItem)=="") { } else {
		$printItem = "";
		$qSqlCat = mysql_query("SELECT * FROM ".$modSend." WHERE id IN(".$listaItem.") ORDER BY ordem");
		while($rSqlCat = mysql_fetch_array($qSqlCat)) {
			if(trim($printItem)=="") {
				$printItem = $rSqlCat['nome'];
			} else {
				$printItem = $printItem.", ".$rSqlCat['nome'];
			}
		}
	}
	return $printItem;
}
}

if(!function_exists('select_simples')) {
function select_simples($itemSend,$modSend) 
{
	$item_set = mysql_fetch_array(mysql_query("SELECT * FROM ".$modSend." WHERE id='".$itemSend."'"));
	return $item_set['nome'];
}
}

if(!function_exists('formatMoney')) {
function formatMoney($numero)
{

	if(trim($numero)=="") {
		$var ="";
	} else {
		$var = number_format($numero, 2, ',', '.');
	}
	return $var;
}
}

if(!function_exists('formatMilhar')) {
function formatMilhar($numero)
{
	if(trim($numero)=="") {
		$var ="0";
	} else {
		if(strrpos($numero,"-") === false) { 
			$negativo = "";
		} else { 
			$negativo = "-";
		}

		if(strpos($numero,".")!="") {
		
			$valor_set = str_replace(".","",$numero);
			$valor_set = str_replace(".","",$valor_set);
			$valor_set = str_replace(".","",$valor_set);
			$valor_set = str_replace(".","",$valor_set);
			$valor_set = str_replace(".","",$valor_set);
			$valor_set = str_replace(",","",$valor_set);
			$valor_set = str_replace("-","",$valor_set);
			$valor_set = str_replace(" ","",$valor_set);
			$valor_set = str_replace(" ","",$valor_set);
			$valor_set = str_replace(" ","",$valor_set);
			
			$var=$valor_set;
		} else {
			$valor_set = str_replace("-","",$numero);
			$var=$valor_set;
		}
	}

	if(trim($var)=="") {
		$formatado="";
	}
	elseif(strlen($var)==3) {
		#123
		$parte1=substr($var,0,3);
		$formatado=$parte1;
	}
	elseif(strlen($var)==4) {
		#1.234
		$parte1=substr($var,0,1);
		$parte2=substr($var,1,3);
		$formatado=$parte1.'.'.$parte2.'';
	}
	elseif(strlen($var)==5) {
		#12.345
		$parte1=substr($var,0,2);
		$parte2=substr($var,2,3);
		$formatado=$parte1.'.'.$parte2.'';
	}
	elseif(strlen($var)==6) {
		#123.456
		$parte1=substr($var,0,3);
		$parte2=substr($var,3,3);
		$formatado=$parte1.'.'.$parte2.'';
	}
	elseif(strlen($var)==7) {
		#1.234.567
		$parte1=substr($var,0,1);
		$parte2=substr($var,1,3);
		$parte3=substr($var,4,3);
		$formatado=$parte1.'.'.$parte2.'.'.$parte3.'';
	} else {
		$formatado=$var;
	}

	#return $setado."";
	return $negativo.$formatado;
}
}

if(!function_exists('setTipoColuna')) {
function setTipoColuna($modSend,$idSend,$idCampoSend,$idListaSend) 
{

	$modulo_set = mysql_fetch_array(mysql_query("SELECT * FROM _construtor_modulo WHERE nome_base='".$modSend."' LIMIT 1"));

	$rSqlListaFunction = mysql_fetch_array(mysql_query("SELECT * FROM ".$modSend."_cabecalho WHERE id='".$idListaSend."' LIMIT 1"));
	
	$rSqlCampoFunction = mysql_fetch_array(mysql_query("SELECT * FROM _construtor_modulo_campo WHERE id='".$idCampoSend."' LIMIT 1"));

	$rSqlFunction = mysql_fetch_array(mysql_query("SELECT * FROM ".$modSend." WHERE id='".$idSend."' LIMIT 1"));

	if(trim($rSqlListaFunction['tipo'])=="switch_sim_nao") {
		if(trim($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''])=="0") {
			return "NÃO";
		} else {
			return "SIM";
		}
	} else {
		if(trim($rSqlListaFunction['tipo'])=="moeda") {
			return formatMoney($rSqlFunction[''.$rSqlCampoFunction['nome_base'].'']);
		} else {
			if(trim($rSqlListaFunction['tipo'])=="data") {
				if(trim($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''])==""||trim($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''])=="0000-00-00") { } else { return ajustaDataSemHoraReturn($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''],"d/m/Y"); }
			} else {
				if(trim($rSqlListaFunction['tipo'])=="data_hora") {
					if(trim($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''])==""||trim($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''])=="0000-00-00") { } else { return ajustaDataReturn($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''],"d/m/Y"); }
				} else {
					if(trim($rSqlCampoFunction['tipo'])=="text"||trim($rSqlCampoFunction['tipo'])=="tag") {
						return $rSqlFunction[''.$rSqlCampoFunction['nome_base'].''];
					} else {
						if(trim($rSqlCampoFunction['tipo'])=="file") {
							if(trim($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''])=="") {
								return "<a href=\"javascript:void(0);\" title=\"".$rSqlFunction[''.$rSqlCampoFunction['nome_base'].'']."\" style=\"width:60px\" class=\"thumbnail\"><img alt=\"\" src=\"".$link."templates/".$layout_padrao_set."/template/img/dummy_50x50.gif\" style=\"height:50px;width:50px\"></a>";
							} else {
								return "<a href=\"".$link."files/".$linguagem_set.$modSend."/".$rSqlFunction['numeroUnico']."/".$rSqlFunction[''.$rSqlCampoFunction['nome_base'].'']."\" style=\"width:60px\" title=\"".$rSqlFunction[''.$rSqlCampoFunction['nome_base'].'']."\" class=\"thumbnail fancybox-button\"><img style=\"width:50px\" src=\"".$link."files/".$linguagem_set.$modSend."/".$rSqlFunction['numeroUnico']."/".$rSqlFunction[''.$rSqlCampoFunction['nome_base'].'']."\" alt=\"".$rSqlFunction[''.$rSqlCampoFunction['nome_base'].'']."\"/></a>";
							}
						} else {
							if(trim($rSqlCampoFunction['tipo'])=="data") {
								if(trim($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''])==""||trim($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''])=="0000-00-00") { } else { return ajustaDataReturn($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''],"d/m/Y"); }
							} else {
								if(trim($rSqlCampoFunction['tipo'])=="hora") {
									return $rSqlFunction[''.$rSqlCampoFunction['nome_base'].''];
								} else {
									if(trim($rSqlCampoFunction['tipo'])=="slider") {
										return $rSqlFunction[''.$rSqlCampoFunction['nome_base'].''];
									} else {
										if(trim($rSqlCampoFunction['tipo'])=="password") {
											return $rSqlFunction[''.$rSqlCampoFunction['nome_base'].''];
										} else {
											if(trim($rSqlCampoFunction['tipo'])=="switch") {
												return $rSqlFunction[''.$rSqlCampoFunction['nome_base'].''];
											} else {
												if(trim($rSqlCampoFunction['tipo'])=="checkbox") {
													$lista_checkbox = "";
													
													if(trim($rSqlCampoFunction['tipo_subitem'])=="subitens"||trim($rSqlCampoFunction['tipo_subitem'])=="") { 
														$nSqlItem = mysql_num_rows(mysql_query("SELECT * FROM _construtor_modulo_campo_subitem WHERE numeroUnico_pai='".$rSqlCampoFunction['numeroUnico']."' AND stat='1' ORDER BY ordem")); 
														if($nSqlItem==0) {
															if(trim($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''])=="|1|") { $lista_checkbox = "SIM"; }
														} else {
															$qSqlItem = mysql_query("SELECT * FROM _construtor_modulo_campo_subitem WHERE numeroUnico_pai='".$rSqlCampoFunction['numeroUnico']."' AND stat='1' ORDER BY ordem");
															while($rSqlItem = mysql_fetch_array($qSqlItem)) {
																if(trim($rSqlItem['valor_tipo'])=="padrao") {
																	if(strrpos($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''],"|".$rSqlItem['id']."|") === false) { } else { if(trim($lista_checkbox)=="") { $lista_checkbox = "".$rSqlItem['nome'].""; } else { $lista_checkbox = $lista_checkbox.", ".$rSqlItem['nome'].""; } }
																} else {
																	if(strrpos($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''],"|".$rSqlItem['valor']."|") === false) { } else { if(trim($lista_checkbox)=="") { $lista_checkbox = "".$rSqlItem['nome'].""; } else { $lista_checkbox = $lista_checkbox.", ".$rSqlItem['nome'].""; } }
																}
															}
														}
													} else {
														if(trim($rSqlCampoFunction['tipo_subitem'])=="modulo_externo") {
															$rSqlModulo = mysql_fetch_array(mysql_query("SELECT * FROM _construtor_modulo WHERE id='".$rSqlCampoFunction['tipo_subitem_modulo_externo']."'"));
															$qSqlItem = mysql_query("SELECT * FROM ".$rSqlModulo['nome_base']." WHERE stat='1'");
															while($rSqlItem = mysql_fetch_array($qSqlItem)) {
																if(strrpos($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''],"|".$rSqlItem['id']."|") === false) { } else { if(trim($lista_checkbox)=="") { $lista_checkbox = "".$rSqlItem['nome'].""; } else { $lista_checkbox = $lista_checkbox.", ".$rSqlItem['nome'].""; } }
															}
														}
													}
												   
													return $lista_checkbox;
												} else {
													if(trim($rSqlCampoFunction['tipo'])=="radio") {
														$lista_radio = "";
														
														if(trim($rSqlCampoFunction['tipo_subitem'])=="subitens"||trim($rSqlCampoFunction['tipo_subitem'])=="") { 
															$nSqlItem = mysql_num_rows(mysql_query("SELECT * FROM _construtor_modulo_campo_subitem WHERE numeroUnico_pai='".$rSqlCampoFunction['numeroUnico']."' AND stat='1' ORDER BY ordem")); 
															if($nSqlItem==0) {
																if(trim($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''])=="|1|") { $lista_radio = "SIM"; }
															} else {
																$qSqlItem = mysql_query("SELECT * FROM _construtor_modulo_campo_subitem WHERE numeroUnico_pai='".$rSqlCampoFunction['numeroUnico']."' AND stat='1' ORDER BY ordem");
																while($rSqlItem = mysql_fetch_array($qSqlItem)) {
																	if(trim($rSqlItem['valor_tipo'])=="padrao") {
																		if(strrpos($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''],"|".$rSqlItem['id']."|") === false) { } else { if(trim($lista_radio)=="") { $lista_radio = "".$rSqlItem['nome'].""; } else { $lista_radio = $lista_radio.", ".$rSqlItem['nome'].""; } }
																	} else {
																		if(strrpos($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''],"|".$rSqlItem['valor']."|") === false) { } else { if(trim($lista_radio)=="") { $lista_radio = "".$rSqlItem['nome'].""; } else { $lista_radio = $lista_radio.", ".$rSqlItem['nome'].""; } }
																	}
																}
															}
														} else {
															if(trim($rSqlCampoFunction['tipo_subitem'])=="modulo_externo") {
																$rSqlModulo = mysql_fetch_array(mysql_query("SELECT * FROM _construtor_modulo WHERE id='".$rSqlCampoFunction['tipo_subitem_modulo_externo']."'"));
																$qSqlItem = mysql_query("SELECT * FROM ".$rSqlModulo['nome_base']." WHERE stat='1'");
																while($rSqlItem = mysql_fetch_array($qSqlItem)) {
																	if(strrpos($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''],"|".$rSqlItem['id']."|") === false) { } else { if(trim($lista_radio)=="") { $lista_radio = "".$rSqlItem['nome'].""; } else { $lista_radio = $lista_radio.", ".$rSqlItem['nome'].""; } }
																}
															}
														}
													   
														return $lista_radio;
													} else {
														if(trim($rSqlCampoFunction['tipo'])=="select") {
															$lista_select = "";
															
															if(trim($rSqlCampoFunction['select_tipo'])=="multiplo"||trim($rSqlCampoFunction['select_tipo'])=="multiplo-busca") {
																if(trim($rSqlCampoFunction['tipo_subitem'])=="modulo_externo") {
																	$rSqlModulo = mysql_fetch_array(mysql_query("SELECT * FROM _construtor_modulo WHERE id='".$rSqlCampoFunction['tipo_subitem_modulo_externo']."'"));
																	$qSqlItem = mysql_query("SELECT * FROM ".$rSqlModulo['nome_base']." WHERE stat='1'");
																	while($rSqlItem = mysql_fetch_array($qSqlItem)) {
																		if(strrpos($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''],"|".$rSqlItem['id']."|") === false) { } else { if(trim($lista_select)=="") { $lista_select = "".$rSqlItem['nome'].""; } else { $lista_select = $lista_select.", ".$rSqlItem['nome'].""; } }
																	}
																} else {
																	$qSqlItem = mysql_query("SELECT * FROM _construtor_modulo_campo_subitem WHERE numeroUnico_pai='".$rSqlCampoFunction['numeroUnico']."' AND stat='1' ORDER BY ordem");
																	while($rSqlItem = mysql_fetch_array($qSqlItem)) {
																		if(trim($rSqlItem['valor_tipo'])=="padrao") {
																			if(strrpos($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''],"|".$rSqlItem['id']."|") === false) { } else { if(trim($lista_select)=="") { $lista_select = "".$rSqlItem['nome'].""; } else { $lista_select = $lista_select.", ".$rSqlItem['nome'].""; } }
																		} else {
																			if(strrpos($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''],"|".$rSqlItem['valor']."|") === false) { } else { if(trim($lista_select)=="") { $lista_select = "".$rSqlItem['nome'].""; } else { $lista_select = $lista_select.", ".$rSqlItem['nome'].""; } }
																		}
																	}
																}
															} else {
																if(trim($rSqlCampoFunction['tipo_subitem'])=="modulo_externo") {
																	$rSqlModulo = mysql_fetch_array(mysql_query("SELECT * FROM _construtor_modulo WHERE id='".$rSqlCampoFunction['tipo_subitem_modulo_externo']."'"));
																	$qSqlItem = mysql_query("SELECT * FROM ".$rSqlModulo['nome_base']." WHERE stat='1'");
																	while($rSqlItem = mysql_fetch_array($qSqlItem)) {
																		if(trim($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''])==$rSqlItem['id']) { $lista_select = $rSqlItem['nome']; }
																	}
																} else {
																	if(trim($rSqlCampoFunction['tipo_subitem'])=="subitens") {
																		$qSqlItem = mysql_query("SELECT * FROM _construtor_modulo_campo_subitem WHERE numeroUnico_pai='".$rSqlCampoFunction['numeroUnico']."' AND stat='1' ORDER BY ordem");
																		while($rSqlItem = mysql_fetch_array($qSqlItem)) {
																			if(trim($rSqlItem['valor_tipo'])=="padrao") {
																				if(trim($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''])==$rSqlItem['id']) { $lista_select = $rSqlItem['nome']; }
																			} else {
																				if(trim($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''])==$rSqlItem['valor']) { $lista_select = $rSqlItem['nome']; }
																			}
																		}
																	} else {
																		$lista_select = $rSqlFunction[''.$rSqlCampoFunction['nome_base'].''];
																	}
																}
															}
														   
															return $lista_select;
														} else {
															if(trim($rSqlCampoFunction['tipo'])=="textarea") {
																return $rSqlFunction[''.$rSqlCampoFunction['nome_base'].''];
															} else {
																if(trim($rSqlCampoFunction['tipo'])=="categoria") {
																	$lista_categoria = "";
				
																	$qSqlItem = mysql_query("SELECT * FROM ".$modulo_set['nome_base']."_categoria WHERE stat='1'");
																	while($rSqlItem = mysql_fetch_array($qSqlItem)) {
																		if(strrpos($rSqlFunction[''.$rSqlCampoFunction['nome_base'].''],"|".$rSqlItem['id']."|") === false) { } else { if(trim($lista_categoria)=="") { $lista_categoria = "".$rSqlItem['nome'].""; } else { $lista_categoria = $lista_categoria.", ".$rSqlItem['nome'].""; } }
																	}
				
																	return $lista_categoria;
																} else {
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}

}
}

if(!function_exists('setTipoColunaDatatable')) {
function setTipoColunaDatatable($modSend,$valorSend,$idCampoSend,$idListaSend,$idListaLabelSend,$idSend) 
{

	if(trim($modSend)=="sysacesso"||trim($modSend)=="syslog") {
		if(trim($idCampoSend)=="idsysusu") {
	
			$sql_select_set = "SELECT id,nome FROM sysusu";
			$campo_valor = "id";
			$campo_label = "nome";
	
			$qSqlItem = mysql_query($sql_select_set);
			while($rSqlItem = mysql_fetch_array($qSqlItem)) {
				if(trim($valorSend)==$rSqlItem['id']) { if(trim($rSqlItem[''.$idListaLabelSend.''])=="") { $lista_select = "#".$rSqlItem['id'].""; } else { $lista_select = $rSqlItem[''.$idListaLabelSend.'']; } }
			}
			
			#return $lista_select;
			$impressao = $lista_select;
			
		} else {
			if(trim($idCampoSend)=="data") {
				if(trim($valorSend)==""||trim($valorSend)=="0000-00-00 00:00:00") { } else { 
					#return ajustaDataReturn($valorSend,"d/m/Y"); 
					$impressao = ajustaDataReturn($valorSend,"d/m/Y"); 
				}
			} else {
				#return $valorSend;
				$impressao = $valorSend;
			}
		}
	} else {

		$modulo_set = mysql_fetch_array(mysql_query("SELECT id,nome_base FROM _construtor_modulo WHERE nome_base='".$modSend."'"));
	
		$rSqlListaFunction = mysql_fetch_array(mysql_query("SELECT id,campo,tipo FROM ".$modSend."_cabecalho WHERE id='".$idCampoSend."'"));
		
		$rSqlCampoFunction = mysql_fetch_array(mysql_query("SELECT id,nome_base,id_construtor_modulo,tipo_subitem,tipo_subitem_modulo_externo,numeroUnico,edicao_rapida FROM _construtor_modulo_campo WHERE nome_base='".$rSqlListaFunction['campo']."' AND id_construtor_modulo='".$modulo_set['id']."'"));
	
		#return "<td>".$valorSend."</td>";
		#return "".strrpos($rSqlListaFunction['campo'],"_categoria")." - ".$valorSend." - ".$rSqlListaFunction['campo']." - ".$rSqlListaFunction['tipo'];
		
		if(strrpos($rSqlListaFunction['campo'],"_categoria") > 0) { 
			$mod_set_lista = str_replace("id","",$rSqlListaFunction['campo']);
			$sql_select_set = "SELECT id,nome FROM ".$mod_set_lista." ORDER BY nome";
			$campo_valor = "id";
			$campo_label = "nome";
			if(trim($rSqlListaFunction['tipo'])=="externo_multiplo") {
				$qSqlItem = mysql_query($sql_select_set);
				while($rSqlItem = mysql_fetch_array($qSqlItem)) {
					if(strrpos($valorSend,"|".$rSqlItem['id']."|") === false) { } else { if(trim($lista_select)=="") { $lista_select = "".$rSqlItem['nome'].""; } else { $lista_select = $lista_select.", ".$rSqlItem['nome'].""; } }
				}
			} else {
				$qSqlItem = mysql_query($sql_select_set);
				while($rSqlItem = mysql_fetch_array($qSqlItem)) {
					if(trim($valorSend)==$rSqlItem['id']) { if(trim($rSqlItem['nome'])=="") { $lista_select = "#".$rSqlItem['id'].""; } else { $lista_select = $rSqlItem['nome']; } }
				}
			}
			#return $lista_select;
			$impressao = $lista_select;

		} elseif(trim($rSqlListaFunction['campo'])=="idsysusu") {
		
			$sql_select_set = "SELECT id,nome,stat FROM sysusu ORDER BY nome";
			$campo_valor = "id";
			$campo_label = "nome";
	
			if(trim($rSqlListaFunction['tipo'])=="externo_multiplo") {
				$qSqlItem = mysql_query($sql_select_set);
				while($rSqlItem = mysql_fetch_array($qSqlItem)) {
					if(strrpos($valorSend,"|".$rSqlItem['id']."|") === false) { } else { if(trim($lista_select)=="") { $lista_select = "".$rSqlItem['nome'].""; } else { $lista_select = $lista_select.", ".$rSqlItem['nome'].""; } }
				}
			} else {
				$qSqlItem = mysql_query($sql_select_set);
				while($rSqlItem = mysql_fetch_array($qSqlItem)) {
					if(trim($valorSend)==$rSqlItem['id']) { if(trim($rSqlItem['nome'])=="") { $lista_select = "#".$rSqlItem['id'].""; } else { $lista_select = $rSqlItem['nome']; } }
				}
			}
			
			#return $lista_select;
			$impressao = $lista_select;
				
		} elseif(trim($rSqlListaFunction['tipo'])=="") {
			#return $valorSend;
			$impressao = $valorSend;
		} elseif(trim($rSqlListaFunction['tipo'])=="normal") {
			#return $valorSend;
			$impressao = $valorSend;
		} elseif(trim($rSqlListaFunction['tipo'])=="externo_multiplo"||trim($rSqlListaFunction['tipo'])=="externo_unico") {
			$lista_select = "";

			if($rSqlCampoFunction['tipo_subitem_modulo_externo']=="1111111111") {
				$sql_select_set = "SELECT id,nome,stat FROM sysusu ORDER BY nome";
				$campo_valor = "id";
				$campo_label = "nome";
			} elseif($rSqlCampoFunction['tipo_subitem_modulo_externo']=="2222222222") {
				$sql_select_set = "SELECT * FROM cepbr_estado ORDER BY estado";
				$campo_valor = "uf";
				$campo_label = "estado";
			} elseif($rSqlCampoFunction['tipo_subitem_modulo_externo']=="3333333333") {
				$sql_select_set = "SELECT * FROM cepbr_cidade ORDER BY cidade";
				$campo_valor = "id_cidade";
				$campo_label = "cidade";
			} elseif($rSqlCampoFunction['tipo_subitem_modulo_externo']=="4444444444") {
				$sql_select_set = "SELECT * FROM cepbr_bairro ORDER BY bairro";
				$campo_valor = "id_bairro";
				$campo_label = "bairro";
			} elseif($rSqlCampoFunction['tipo_subitem_modulo_externo']=="5555555555") {
				$sql_select_set = "SELECT * FROM sysbanco_lista WHERE stat='1' ORDER BY banco";
				$campo_valor = "id";
				$campo_label = "nome";
			} else {
				$rSqlModulo = mysql_fetch_array(mysql_query("SELECT id,nome_base FROM _construtor_modulo WHERE id='".$rSqlCampoFunction['tipo_subitem_modulo_externo']."'"));

				$ordenacao_set = "";
				
				if (mysql_num_rows(mysql_query("SELECT id,stat,campo,tipo FROM ".$rSqlModulo['nome_base']."_ordenacao WHERE stat='1'"))>0) {
					$qSqlOrdem = mysql_query("SELECT * FROM ".$rSqlModulo['nome_base']."_ordenacao WHERE stat='1' ORDER BY ordem");
					while($rSqlOrdem = mysql_fetch_array($qSqlOrdem)) {
						if(trim($ordenacao_set)=="") {
							$ordenacao_set = "".$rSqlOrdem['campo']." ".$rSqlOrdem['tipo']."";
						} else {
							$ordenacao_set = $ordenacao_set.",".$rSqlOrdem['campo']." ".$rSqlOrdem['tipo']."";
						}
					}
				} else {
					$ordenacao_set = "  id DESC";
				}
				
				$sql_select_set = "SELECT * FROM ".$rSqlModulo['nome_base']." ORDER BY ".$ordenacao_set."";

				$nome_exibicao_set = "";
				$rSqlExibicao = mysql_fetch_array(mysql_query("SELECT nome_1,nome_2,nome_3,nome_4,nome_5 FROM ".$rSqlModulo['nome_base']."_estrutura LIMIT 1"));
	
				$campo_valor = "id";
				$campo_label = "nome";
			}


			$qSqlItem = mysql_query($sql_select_set);
			while($rSqlItem = mysql_fetch_array($qSqlItem)) {

				if(trim($rSqlExibicao['nome_1'])==""||trim($rSqlExibicao['nome_1'])=="null") {
					$nome_1_set = "";
				} else {
					if(trim($rSqlItem["".$rSqlExibicao['nome_1'].""])=="") {
						$nome_1_set = "";
					} else {
						$nome_1_set = "[".$rSqlItem["".$rSqlExibicao['nome_1'].""]."] ";
					}
				}
			
				if(trim($rSqlExibicao['nome_2'])==""||trim($rSqlExibicao['nome_2'])=="null") {
					$nome_2_set = "";
				} else {
					if(trim($rSqlItem["".$rSqlExibicao['nome_2'].""])=="") {
						$nome_2_set = "";
					} else {
						$nome_2_set = "[".$rSqlItem["".$rSqlExibicao['nome_2'].""]."] ";
					}
				}
			
				if(trim($rSqlExibicao['nome_3'])==""||trim($rSqlExibicao['nome_3'])=="null") {
					$nome_3_set = "";
				} else {
					if(trim($rSqlItem["".$rSqlExibicao['nome_3'].""])=="") {
						$nome_3_set = "";
					} else {
						$nome_3_set = "[".$rSqlItem["".$rSqlExibicao['nome_3'].""]."] ";
					}
				}
			
				if(trim($rSqlExibicao['nome_4'])==""||trim($rSqlExibicao['nome_4'])=="null") {
					$nome_4_set = "";
				} else {
					if(trim($rSqlItem["".$rSqlExibicao['nome_4'].""])=="") {
						$nome_4_set = "";
					} else {
						$nome_4_set = "[".$rSqlItem["".$rSqlExibicao['nome_4'].""]."] ";
					}
				}
			
				if(trim($rSqlExibicao['nome_5'])==""||trim($rSqlExibicao['nome_5'])=="null") {
					$nome_5_set = "";
				} else {
					if(trim($rSqlItem["".$rSqlExibicao['nome_5'].""])=="") {
						$nome_5_set = "";
					} else {
						$nome_5_set = "[".$rSqlItem["".$rSqlExibicao['nome_5'].""]."] ";
					}
				}
				$nome_exibicao_set = $nome_1_set.$nome_2_set.$nome_3_set.$nome_4_set.$nome_5_set;


				if(trim($rSqlListaFunction['tipo'])=="externo_multiplo") {
					if(strrpos($valorSend,"|".$rSqlItem[''.$campo_valor.'']."|") === false) { } else { 
						if(trim($nome_exibicao_set)=="") { 
							if(trim($rSqlItem[''.$campo_label.''])=="") { 
								$valor_select = "#".$rSqlItem[''.$campo_valor.''].""; 
							} else { 
								$valor_select = $rSqlItem[''.$campo_label.'']; 
							} 
						} else { 
							$valor_select = $nome_exibicao_set; 
						}
		
						if(trim($lista_select)=="") { 
							$lista_select = "".$valor_select.""; 
						} else { 
							$lista_select = $lista_select.", ".$valor_select.""; 
						} 
					}
				} else {
					if(trim($valorSend)==$rSqlItem[''.$campo_valor.'']) {
						if(trim($nome_exibicao_set)=="") { 
							if(trim($rSqlItem[''.$campo_label.''])=="") { 
								$valor_select = "#".$rSqlItem[''.$campo_valor.''].""; 
							} else { 
								$valor_select = $rSqlItem[''.$campo_label.'']; 
							} 
						} else { 
							$valor_select = $nome_exibicao_set; 
						}
		
						if(trim($lista_select)=="") { 
							$lista_select = "".$valor_select.""; 
						} else { 
							$lista_select = $lista_select.", ".$valor_select.""; 
						} 
					}
				}

			
			}

			#return $lista_select;
			$impressao = $lista_select;

		} elseif(trim($rSqlListaFunction['tipo'])=="switch_sim_nao") {
			if(trim($valorSend)=="0"||trim($valorSend)=="") {
				#return "NÃO";
				$impressao = "NÃO";
			} else {
				#return "SIM";
				$impressao = "SIM";
			}
		} elseif(trim($rSqlListaFunction['tipo'])=="moeda") {
			#return formatMoney($valorSend);
			$impressao = formatMoney($valorSend);
		} elseif(trim($rSqlListaFunction['tipo'])=="data") {
			if(trim($valorSend)==""||trim($valorSend)=="0000-00-00") { } else { 
				#return ajustaDataSemHoraReturn($valorSend,"d/m/Y"); 
				$impressao = ajustaDataSemHoraReturn($valorSend,"d/m/Y");
			}
		} elseif(trim($rSqlListaFunction['tipo'])=="data_hora") {
			if(trim($valorSend)==""||trim($valorSend)=="0000-00-00 00:00:00") { } else { 
				#return ajustaDataReturn($valorSend,"d/m/Y"); 
				$impressao = ajustaDataReturn($valorSend,"d/m/Y");
			}
		}
		
		$string = $impressao;
		$charset = (utf8_encode(utf8_decode($string)) == $string);
		if($charset) {
			$impressao = "".$impressao."";
		} else {
			$impressao = mb_convert_encoding($impressao, "UTF-8");
		}

		if(trim($rSqlCampoFunction['edicao_rapida'])=="1") {
			if(trim($impressao)=="") {
				$valor_edicao_rapida = "---";
			} else {
				$valor_edicao_rapida = "".$impressao."";
			}
			$impressao = "<td><a href=\"#\" style=\"width:100%;\" onclick=\"abre_edicao_rapida('".$rSqlListaFunction['campo']."','".$idSend."','".$modSend."')\" id=\"".$rSqlListaFunction['campo']."-".$idSend."\">".$valor_edicao_rapida."</a></td>";
		} else {
			$impressao = "<td>".$impressao."</td>";
		}

		return $impressao;

	}

}
}

if(!function_exists('setAcoesTabela')) {
function setAcoesTabela($idsysusuSend,$modSend,$idSend,$conexaoSend,$idsys_arquivoSend,$modulo_set_Send,$_construtor_sysperm_Send,$row_estrutura_Send,$modulo_set_categoria_Send,$rSql_Send) 
{
	
	$sysconfig = mysql_fetch_array(mysql_query("SELECT bloqueio_edicao FROM sysconfig LIMIT 1"));

	global $link_site;
	global $link;
	global $sysusu;
	global $chave_url;
	global $timestamp_atual;

	$rItem = $rSql_Send;
	
	if(stripos("".$modSend."","construtor") === false) { 
		$rSqlMod = $modulo_set_Send;
		$rSqlModCat = $modulo_set_categoria_Send;
	} else {
		$rSqlMod = mysql_fetch_array(mysql_query("SELECT id,stat,nome_base,id_construtor_modulo_categoria FROM _construtor_modulo WHERE id='".$rItem['id_construtor_modulo']."'"));
		$rSqlModCat = mysql_fetch_array(mysql_query("SELECT id,stat,nome FROM _construtor_modulo_categoria WHERE stat='1' AND id='".$rSqlMod['id_construtor_modulo_categoria']."'"));
	}

	if(trim($modSend)=="cobertura") {
		$nomeLimpoItem = transformaCaractere($rItem[''.$modSend.'_titulo']);
		$rItem['nome'] = $rItem[''.$modSend.'_titulo'];
	} else {
		$nomeLimpoItem = transformaCaractere($rItem['nome']);
	}
	
	$nomeLimpo = transformaCaractere($rSqlModCat['nome']);
	$nomeLimpoMod = str_replace("-","_",$rSqlMod['nome_base']);
	

	$conteudo[0] = $rItem;
	$list = array();
	$id = $conteudo[0]['id'];
	$conteudo[0]['id_sys_arquivo']  = "".$idsys_arquivoSend.""; 
	$conteudo[0]['local']  = "".$modSend.""; 
	if(trim($rItem[''.$modSend.'_nome'])=="") {
		$conteudo[0]['nome']  = "".$rItem['nome'].""; 
	} else {
		$conteudo[0]['nome']  = "".$rItem[''.$modSend.'_nome'].""; 
	}

	$conteudo[0]['lista_secao'] = $conteudo[0][''.$modSend.'_lista_secao'];

	if(trim($rItem[''.$modSend.'_data_publicacao'])=="") {
		$conteudo[0]['data_publicacao']  = "".$rItem['data_publicacao'].""; 
	} else {
		$conteudo[0]['data_publicacao']  = $rItem[''.$modSend.'_data_publicacao'];
	}

	$conteudo[0]['analise_nome']  = "".$rItem['nome'].""; 
	$conteudo[0]['produto_nome']  = "".$rItem['produto_nome'].""; 
	$conteudo[0]['tipo_de_item_categoria_nome']  = "".$rItem['tipo_de_item_categoria_nome'].""; 
	$conteudo[0]['filtro_img']  = ""; 
	$list[$id] = $conteudo[0];

	$url_set_preview = monta_url_otimizada($list[$conteudo[0]['id']]);
	#$url_set_preview = monta_url("".$modSend."","".$idSend."","".$link_site."");

	
	#BTN Preview
	if(trim($row_estrutura_Send['preview'])==1) {
		if(trim($modSend)=="cobertura") {
			$acoes_set = "<div style=\"float:left;\" id=\"preview-".$idSend."\" ><a href=\"http://adrenaline.uol.com.br/cobertura/".$nomeLimpoItem."/pre/\" target=\"_blank\" class=\"btn btn-xs purple\" title=\"Pré-visualização\"><i class=\"fa fa-eye\"></i></a></div>";
		} else {
			if(trim($modSend)=="chart") {
				$acoes_set = "<div style=\"float:left;\" id=\"preview-".$idSend."\"><a href=\"javascript:void(0)\" onclick=\"chart_preview('".$idSend."')\" target=\"_blank\" class=\"btn btn-xs purple\" title=\"Pré-visualização\"><i class=\"fa fa-eye\"></i></a></div>";
			} else {
				if(trim($modSend)=="links_adrenaline") {
					$acoes_set = "<div style=\"float:left;\" id=\"preview-".$idSend."\"><a href=\"".str_replace("http://www.adrenaline.uol.com.br","http://www.adrenaline.com.br",$url_set_preview)."\" target=\"_blank\" class=\"btn btn-xs purple\" title=\"Pré-visualização\"><i class=\"fa fa-eye\"></i></a></div>";
				} else {
					$acoes_set = "<div style=\"float:left;\" id=\"preview-".$idSend."\" title=\"".$rItem['nome']."\"><a href=\"".$url_set_preview."pre/\" target=\"_blank\" class=\"btn btn-xs purple\" title=\"Pré-visualização\"><i class=\"fa fa-eye\"></i></a></div>";
				}
			}
		}
	}

	#BTN Editar
	if(stripos("".$modSend."","construtor") === false) {

		if($idsysusuSend=="99"||$idsysusuSend=="104") {
			$icone_editado = "fa-pencil";
			$icone_editado_cor = "blue";
			$msg_editar = "Editar";
		} else {
			$icone_editado = "fa-pencil";
			$icone_editado_cor = "blue";
			$msg_editar = "Editar";
		}

		if(trim($_construtor_sysperm_Send['editar'.$conexaoSend.''.$modulo_set_Send['numeroUnico'].''])==1) {
			$acoes_set .= "<a id=\"editar-".$idSend."\" class=\"controle_clique_edicao btn btn-sm blue-madison\" 
			href=\"".$link."".$chave_url."".$nomeLimpo."/".$nomeLimpoMod."/editar/".$idSend."/\" title=\"Editar\"><i class=\"fa fa-edit\"></i></a>";
			#$acoes_set .= "<div style=\"float:left;\" id=\"editar-".$idSend."\"><a id=\"editar-a-".$idSend."\" href=\"".$link."".$chave_url."".$nomeLimpo."/".$nomeLimpoMod."/editar/".$idSend."/\" class=\"controle_clique_edicao btn btn-xs ".$icone_editado_cor."\" title=\"".$msg_editar."\"><i id=\"editar-icon-".$idSend."\" class=\"fa ".$icone_editado."\"></i></a></div>";
		}

	} else {
		if(trim($_construtor_sysperm_Send['editar'.$conexaoSend.''.$modSend.''])==1) {
			$acoes_set .= "<span id=\"editar-".$idSend."\" class=\"controle_clique_edicao btn btn-sm blue-madison\" onclick=\"javascript:window.open('".$link."".$chave_url."construtor/".$nomeLimpo."/campos-do-modulo/".$nomeLimpoMod."/editar/".$idSend."/','_self','');\" title=\"Editar\"><i class=\"fa fa-edit\"></i></span>";
			#$acoes_set .= "<div style=\"float:left;\" id=\"editar-".$idSend."\"><a href=\"".$link."".$chave_url."construtor/".$nomeLimpo."/campos-do-modulo/".$nomeLimpoMod."/editar/".$idSend."/\" class=\"controle_clique_edicao btn btn-xs blue\" title=\"Editar\"><i class=\"fa fa-pencil\"></i></a></div>";
		}
	}

	#BTN Excluir
	if(trim($_construtor_sysperm_Send['excluir'.$conexaoSend.''.$modulo_set_Send['numeroUnico'].''])==1) {
		$acoes_set .= "<span class=\"controle_clique_edicao btn btn-sm red\" onclick=\"javascript:remover_item_tabela('".$idSend."','".$modSend."','NAO','');;\" title=\"Remover\"><i class=\"fa fa-times\"></i></span>";
		#$acoes_set .= "<div style=\"float:left;\" id=\"remover-".$idSend."\"><a href=\"javascript:void(0);\" onclick=\"remover_item_tabela('".$idSend."','".$modSend."','NAO','');\" title=\"Remover\" class=\"controle_clique_edicao btn btn-xs red-thunderbird\"><i class=\"fa fa-times\"></i></a></div>";
	}

	if(stripos("".$modSend."","construtor") === false) { } else {
		if(trim($_construtor_sysperm_Send['excluir'.$conexaoSend.''.$modSend.''])==1) {
			$acoes_set .= "<span class=\"controle_clique_edicao btn btn-sm red\" onclick=\"javascript:remover_item_tabela('".$idSend."','".$modSend."','NAO','');;\" title=\"Remover\"><i class=\"fa fa-times\"></i></span>";
			#$acoes_set .= "<div style=\"float:left;\" id=\"remover-".$idSend."\"><a href=\"javascript:void(0);\" onclick=\"remover_item_tabela('".$idSend."','".$modSend."','NAO','');\" title=\"Remover\" class=\"controle_clique_edicao btn btn-xs red-thunderbird\"><i class=\"fa fa-times\"></i></a></div>";
		}
	}

	#BTN Clonar
	if(stripos("".$modSend."","construtor") === true) { } else {
		if(trim($row_estrutura_Send['clonar'])==1) {
			$acoes_set .= "<div style=\"float:left;\" id=\"clonar-".$idSend."\"><a href=\"javascript:void(0);\" onclick=\"clonar_item_unico_reload('".$idSend."');\" class=\"controle_clique_edicao btn btn-xs blue-madison\" title=\"".stripos("".$modSend."","construtor")." - Clonar este item\"><i class=\"fa fa-copy\"></i></a></div>";
		}
	}

	#BTN Edição Rápida
	if(stripos("".$modSend."","construtor") === false) { } else {
		if(trim($rItem['edicao_rapida'])=="1") {
			$acoes_set .= "<div style=\"float:left;\" id=\"edicao_rapida-".$idSend."\"><a href=\"javascript:void(0);\" onclick=\"muda_edicao_rapida('".$idSend."','0');\" class=\"controle_clique_edicao btn btn-xs\" style=\"color:#FFF;background-color:#F7CA18\" title=\"Desabilitar de edição rápida\"><i class=\"fa fa-bolt\"></i></a></div>";
		} else {
			$acoes_set .= "<div style=\"float:left;\" id=\"edicao_rapida-".$idSend."\"><a href=\"javascript:void(0);\" onclick=\"muda_edicao_rapida('".$idSend."','1');\" class=\"controle_clique_edicao btn btn-xs\" style=\"color:#FFF;background-color:#EEE\" title=\"Habilitar como edição rápida\"><i class=\"fa fa-bolt\"></i></a></div>";
		}

		if(trim($rItem['controle_seo'])=="1") {
			$acoes_set .= "<div style=\"float:left;\" id=\"controle_seo-".$idSend."\"><a href=\"javascript:void(0);\" onclick=\"muda_controle_seo('".$idSend."','0');\" class=\"controle_clique_edicao btn btn-xs\" style=\"color:#FFF;background-color:#4285f4\" title=\"Desabilitar de Controle de SEO\"><i class=\"fa fa-google-plus-square\"></i></a></div>";
		} else {
			$acoes_set .= "<div style=\"float:left;\" id=\"controle_seo-".$idSend."\"><a href=\"javascript:void(0);\" onclick=\"muda_controle_seo('".$idSend."','1');\" class=\"controle_clique_edicao btn btn-xs\" style=\"color:#FFF;background-color:#EEE\" title=\"Habilitar como Controle de SEO\"><i class=\"fa fa-google-plus-square\"></i></a></div>";
		}
	}

	#BTN Ações Dinâmicas
	$qSqlAcao = mysql_query("SELECT * FROM ".$modSend."_acao WHERE stat='1' ORDER BY ordem");
	while($rSqlAcao = mysql_fetch_array($qSqlAcao)) {
		if(trim($rSqlAcao['script'])=="muda_0_1") {
			if(trim($rItem[''.$modSend.'_'.$rSqlAcao['campo'].''])=="1") {
				$acoes_set .= "<div style=\"float:left;\" id=\"".$rSqlAcao['campo']."-".$idSend."\"><a href=\"javascript:void(0);\" onclick=\"javascript:muda_0_1('".$modSend."','".$idSend."','0','".$rSqlAcao['campo']."','EEE');\" class=\"controle_clique_edicao btn btn-xs\" style=\"color:#FFF;background-color:#".$rSqlAcao['cor'].";\"><i class=\"".$rSqlAcao['icone']."\"></i></a></div>";
			} else {
				$acoes_set .= "<div style=\"float:left;\" id=\"".$rSqlAcao['campo']."-".$idSend."\"><a href=\"javascript:void(0);\" onclick=\"javascript:muda_0_1('".$modSend."','".$idSend."','1','".$rSqlAcao['campo']."','".$rSqlAcao['cor']."');\" class=\"controle_clique_edicao btn btn-xs\" style=\"color:#FFF;background-color:#EEE\"><i class=\"".$rSqlAcao['icone']."\"></i></a></div>";
			}
		} else {
		}
	}

	return $acoes_set;

}
}

if(!function_exists('setStatusTabela')) {
function setStatusTabela($idsysusuSend,$modSend,$idSend,$conexaoSend,$idsys_arquivoSend,$modulo_set_Send,$_construtor_sysperm_Send,$row_estrutura_Send,$modulo_set_categoria_Send,$rSql_Send) 
{
	
	$sysconfig = mysql_fetch_array(mysql_query("SELECT bloqueio_edicao FROM sysconfig LIMIT 1"));

	global $link_site;
	global $link;
	global $sysusu;
	global $chave_url;
	global $timestamp_atual;

	$rItem = $rSql_Send;
	
	$conteudo[0] = $rItem;
	$list = array();
	$id = $conteudo[0]['id'];
	$conteudo[0]['id_sys_arquivo']  = "".$idsys_arquivoSend.""; 
	$conteudo[0]['local']  = "".$modSend.""; 
	if(trim($rItem[''.$modSend.'_nome'])=="") {
		$conteudo[0]['nome']  = "".$rItem['nome'].""; 
	} else {
		$conteudo[0]['nome']  = "".$rItem[''.$modSend.'_nome'].""; 
	}

	$conteudo[0]['lista_secao'] = $conteudo[0][''.$modSend.'_lista_secao'];

	$list[$id] = $conteudo[0];

	$url_set_preview = monta_url_otimizada($list[$conteudo[0]['id']]);
	#$url_set_preview = monta_url("".$modSend."","".$idSend."","".$link_site."");

	
	#BTN Ativo (Sim ou Não)
	if(trim($rItem['stat'])=="1") {
	
		if(trim($_construtor_sysperm_Send['despublicar'.$conexaoSend.''.$modulo_set_Send['numeroUnico'].''])==1) {
			$acoes_set .= "<a style=\"width:60px;\" href=\"javascript:void(0);\" onclick=\"muda_stat_tempo_real('".$modSend."','".$idSend."','0','".$conexaoSend."','".$idsysusuSend."');\" class=\"btn btn-xs green\" title=\"Despublicar\"> ATIVO </a>";
		} else {
			$acoes_set .= "<a style=\"width:60px;\" href=\"javascript:void(0);\" onclick=\"alert('Você não tem permissão para esta ação !');\" class=\"btn btn-xs green\" title=\"Despublicar\"> ATIVO </a>";
		}
	
	} else {
	
		if(trim($_construtor_sysperm_Send['publicar'.$conexaoSend.''.$modulo_set_Send['numeroUnico'].''])==1) {
			$acoes_set .= "<a style=\"width:60px;\" href=\"javascript:void(0);\" onclick=\"muda_stat_tempo_real('".$modSend."','".$idSend."','1','".$conexaoSend."','".$idsysusuSend."');\" class=\"btn btn-xs yellow-gold\" title=\"Publicar\"> INATIVO </a>";
		} else {
			$acoes_set .= "<a style=\"width:60px;\" href=\"javascript:void(0);\" onclick=\"alert('Você não tem permissão para esta ação !');\" class=\"btn btn-xs yellow-gold\" title=\"Publicar\"> INATIVO </a>";
		}
	
	}

	return $acoes_set;

}
}

if(!function_exists('monta_secao_interno')) {
function monta_secao_interno($listaSend) 
{

	$secao_print = "";
	if(trim($listaSend)=="") { } else {
		$lista_secao_set = str_replace("||","','",$listaSend); 
		$lista_secao_set = str_replace("|","'",$lista_secao_set); 
		$secao_print .= "<div class=\"tags\">";
		$qSqlSecao = mysql_query("SELECT * FROM secao WHERE stat='1' AND id IN(".$lista_secao_set.") AND oculta !='1' ORDER BY ordem");
		while($rSqlSecao = mysql_fetch_array($qSqlSecao)) {
			$url_amigavel_secao = transformaCaractere($rSqlSecao['nome']);
			if(trim($rSqlSecao['cor'])=="") { $cor_set = ""; } else { $cor_set = "tg-".$rSqlSecao['cor'].""; }
			$secao_print .=     "<span class=\"tag ".$cor_set."\">".$rSqlSecao['nome']."</span> ";
		}
		$secao_print .= "</div>";
		$secao_print .= "<br clear=\"all\" />";
	}
	echo $secao_print;
	
}
}

if(!function_exists('setMysqlChar')) {
function setMysqlChar($tipoSend,$tipoSubitemSend,$selectTipoSend) 
{

	if(trim($tipoSend)=="text"||trim($tipoSend)=="codigo"||trim($tipoSend)=="password"||trim($tipoSend)=="file"||trim($tipoSend)=="switch"||trim($tipoSend)=="slider") {
		$tipo_set = "varchar(255) NOT NULL";
	} else {
		if(trim($tipoSend)=="data") {
			$tipo_set = "DATE NOT NULL";
		} else {
			if(trim($tipoSend)=="hora") {
				$tipo_set = "TIME NOT NULL";
			} else {
				if(trim($tipoSend)=="textarea"||trim($tipoSend)=="tag"||trim($tipoSend)=="categoria"||trim($tipoSend)=="lista") {
					$tipo_set = "longtext NOT NULL";
				} else {
					if(trim($tipoSend)=="checkbox"||trim($tipoSend)=="radio"||trim($tipoSend)=="select") {
						if(trim($tipoSubitemSend)=="modulo_externo") {
							if(trim($selectTipoSend)=="tag"||trim($selectTipoSend)=="multiplo"||trim($selectTipoSend)=="multiplo-busca") {
								$tipo_set = "longtext NOT NULL";
							} else {
								$tipo_set = "int(11) NOT NULL";
							}
						} else {
							$tipo_set = "longtext NOT NULL";
						}
					} else {
						if(trim($tipoSend)=="data_hora") {
							$tipo_set = "DATETIME NOT NULL";
						} else {
							$tipo_set = "longtext NOT NULL";
						}
					}
				}
			}
		}
	}

	return $tipo_set;

}
}

if(!function_exists('verificaTabela')) {
function verificaTabela($tabela) 
{
    $tabelas_consulta = mysql_query('SHOW TABLES');

    while ($tabelas_linha = mysql_fetch_row($tabelas_consulta)) {
        $tabelas[] = $tabelas_linha[0];
    }

    if (!in_array($tabela, $tabelas)) {
        return "0";
    } else {
        return "1";
    }
}
}

if(!function_exists('verificaColunaTabela')) {
function verificaColunaTabela($coluna,$tabela) 
{
    $n = mysql_num_rows(mysql_query("SELECT COLUMN_NAME, TABLE_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME LIKE '".$coluna."' AND TABLE_NAME LIKE '".$tabela."'"));
	return $n;
}
}

if(!function_exists('monta_mascara')) {
function monta_mascara($cmp,$mascara) 
{
	echo "<script>
	jQuery(document).ready(function() {    
		var funcao_campo = function () {
			var mascara_campo = function () {
				$('#".$cmp."').inputmask('mask', {
					'mask': '".$mascara."'
				}); //specifying fn & options
			}
			return {
				//main function to initiate the module
				init: function () {
					mascara_campo();
				}
			};
		
		}();
		funcao_campo.init();
	});
	</script>";
}
}

if(!function_exists('diferenca_entre_datas_DATE')) {
function diferenca_entre_datas_DATE($data1, $data2="")
{

	if($data2==""){
		$data2 = date("d/m/Y H:i:s");
	}

	$start  = new \DateTime( ''.$data1.'' );
	$end    = new \DateTime( ''.$data2.'' );

	$interval = $start->diff( $end );
	
	if($interval->h>1) {
		$texto_hora = "horas";
	} else {
		$texto_hora = "hora";
	}

	if($interval->i>1) {
		$texto_minuto = "minutos";
	} else {
		$texto_minuto = "minuto";
	}

	if($interval->s>1) {
		$texto_segundo = "segundos";
	} else {
		$texto_segundo = "segundo";
	}

	if($interval->h>0) {
		if($interval->s>0) {
			$tempo_de_execucaoSet = "".$interval->h." ".$texto_hora.", ".$interval->i." ".$texto_minuto." e ".$interval->s." ".$texto_segundo."";
		} else {
			$tempo_de_execucaoSet = "".$interval->h." ".$texto_hora.", ".$interval->i." ".$texto_minuto."";
		}
	} else {
		if($interval->s>0) {
			$tempo_de_execucaoSet = "".$interval->i." ".$texto_minuto." e ".$interval->s." ".$texto_segundo."";
		} else {
			$tempo_de_execucaoSet = "".$interval->i." ".$texto_minuto."";
		}
	}

	return $tempo_de_execucaoSet;
}
}

if(!function_exists('diferenca_entre_datas_sem_hora')) {
function diferenca_entre_datas_sem_hora($data1, $data2="")
{
	$d1 = new DateTime(''.$data2.'');
	$d2 = new DateTime(''.$data1.'');
	$intervalo = $d1->diff( $d2 );
	#echo "Diferença de " . $intervalo->d . " dias";
	#echo " e " . $intervalo->m . " mese s";
	#echo " e " . $intervalo->y . " anos.";

	return $intervalo->y;
}
}

if(!function_exists('diferenca_entre_datas')) {
function diferenca_entre_datas($data1, $data2="",$tipo="")
{

	if($data2==""){
		$data2 = date("d/m/Y H:i");
	}

	if($tipo==""){
		$tipo = "h";
	}

	for($i=1;$i<=2;$i++){
		${"dia".$i} 	= substr(${"data".$i},0,2);
		${"mes".$i} 	= substr(${"data".$i},3,2);
		${"ano".$i} 	= substr(${"data".$i},6,4);
		${"horas".$i} 	= substr(${"data".$i},11,2);
		${"minutos".$i} = substr(${"data".$i},14,2);
	}

	$segundos = mktime($horas2,$minutos2,0,$mes2,$dia2,$ano2) - mktime($horas1,$minutos1,0,$mes1,$dia1,$ano1);

	switch($tipo){
	
	 case "s": $difere = $segundos;    		 break;
	 case "m": $difere = $segundos/60;    		 break;
	 case "H": $difere = $segundos/3600;    	 break;
	 case "h": $difere = round($segundos/3600);  break;
	 case "D": $difere = $segundos/86400;    	 break;
	 case "d": $difere = round($segundos/86400); break;
	}

	return $difere;
}
}

if(!function_exists('diferenca_entre_datas_DATE_Return')) {
function diferenca_entre_datas_DATE_Return($data1, $data2="",$tipo="")
{

	if($data2==""){
		$data2 = date("Y-m-d H:i:s");
	}

	if($tipo==""){
		$tipo = "s";
	}

	for($i=1;$i<=2;$i++){
		${"dia".$i} 	= substr(${"data".$i},8,2);
		${"mes".$i} 	= substr(${"data".$i},5,2);
		${"ano".$i} 	= substr(${"data".$i},0,4);
		${"horas".$i} 	= substr(${"data".$i},11,2);
		${"minutos".$i} = substr(${"data".$i},14,2);
		${"segundos".$i} = substr(${"data".$i},17,2);
	}

	$segundos = mktime($horas2,$minutos2,$segundos2,$mes2,$dia2,$ano2) - mktime($horas1,$minutos1,$segundos1,$mes1,$dia1,$ano1);

	switch($tipo){
	
	 case "s": $difere = $segundos;    		 break;
	 case "m": $difere = $segundos/60;    		 break;
	 case "H": $difere = $segundos/3600;    	 break;
	 case "h": $difere = round($segundos/3600);  break;
	 case "D": $difere = $segundos/86400;    	 break;
	 case "d": $difere = round($segundos/86400); break;
	}

	return $difere;
}
}

if(!function_exists('diferenca_entre_timestamp')) {
function diferenca_entre_timestamp($timestamp1, $timestamp2,$tipo)
{

	if(trim($timestamp1)=="" || trim($timestamp2)=="") {
		$segundos = 0;
	} else {
		$segundos = $timestamp1 - $timestamp2;
	}

	switch($tipo){
	
	 case "0": $difere = $segundos;	    		 break;
	 case "m": $difere = $segundos/60;    		 break;
	 case "H": $difere = $segundos/3600;    	 break;
	 case "h": $difere = round($segundos/3600);  break;
	 case "D": $difere = $segundos/86400;    	 break;
	 case "d": $difere = round($segundos/86400); break;
	}

	return $difere;
}
}

if(!function_exists('pluralize')) {
function pluralize( $count, $text ) 
{ 
	return $count . ( ( $count == 1 || $text == "mês" ) ? ( " $text" ) : ( " ${text}s" ) );
}
}

if(!function_exists('faz_quanto_tempo')) {
function faz_quanto_tempo($dataSend)
{
	
	$dia     = substr($dataSend,8,2);
	$mes     = substr($dataSend,5,2);
	$ano     = substr($dataSend,0,4);

	$hora    = substr($dataSend,11,2);
	$minuto  = substr($dataSend,14,2);
	$segundo = substr($dataSend,17,2);

	$data_montada = new DateTime(date('Y-m-d H:i:s',mktime($hora,$minuto,$segundo,$mes,$dia,$ano)));

    $interval = date_create('now')->diff( $data_montada );
    #$suffix = ( $interval->invert ? ' atrás' : '' );
    $suffix = ( $interval->invert ? '' : '' );
    if ( $v = $interval->y >= 1 ) return pluralize( $interval->y, 'ano' ) . $suffix;
    if ( $v = $interval->m >= 1 ) return pluralize( $interval->m, 'mês' ) . $suffix;
    if ( $v = $interval->d >= 1 ) return pluralize( $interval->d, 'dia' ) . $suffix;
    if ( $v = $interval->h >= 1 ) return pluralize( $interval->h, 'hora' ) . $suffix;
    if ( $v = $interval->i >= 1 ) return pluralize( $interval->i, 'minuto' ) . $suffix;
    return pluralize( $interval->s, 'segundo' ) . $suffix;
}
}

if(!function_exists('mes_extrato_anual')) {
function mes_extrato_anual($localSend,$idCategoria,$mesSend,$anoSend) 
{
	
	if(trim($idCategoria)=="") {
		$filtro_categoria = "";
	} else {
		$filtro_categoria = " id".$localSend."_categoria='".$idCategoria."' AND ";
	}

	$valor_total_mes = 0;
	$valor_total_conta = 0;
	$qSql = mysql_query("SELECT * FROM ".$localSend." WHERE ".$filtro_categoria." stat='1' AND data_vencimento BETWEEN '".$anoSend."-".$mesSend."-01' AND '".$anoSend."-".$mesSend."-31'");
	while($rSql = mysql_fetch_array($qSql)) {

		$valor_limpo = str_replace(".","",$rSql['valor']); 
		for ($i = 1; $i <= 10; $i++) {
			$valor_limpo = str_replace(".","",$valor_limpo);
		}
		$valor_limpo = str_replace(",",".",$valor_limpo);
		
		$valor_desconto_limpo = str_replace(".","",$rSql['valor_desconto']); 
		for ($i = 1; $i <= 10; $i++) {
			$valor_desconto_limpo = str_replace(".","",$valor_desconto_limpo);
		}
		$valor_desconto_limpo = str_replace(",",".",$valor_desconto_limpo);
		
		$valor_taxa_limpo = str_replace(".","",$rSql['valor_taxa']); 
		for ($i = 1; $i <= 10; $i++) {
			$valor_taxa_limpo = str_replace(".","",$valor_taxa_limpo);
		}
		$valor_taxa_limpo = str_replace(",",".",$valor_taxa_limpo);
		
		$valor_juro_limpo = str_replace(".","",$rSql['valor_juro']); 
		for ($i = 1; $i <= 10; $i++) {
			$valor_juro_limpo = str_replace(".","",$valor_juro_limpo);
		}
		$valor_juro_limpo = str_replace(",",".",$valor_juro_limpo);
		
		$valor_total_conta = $valor_limpo - $valor_desconto_limpo + ($valor_taxa_limpo + $valor_juro_limpo);
		
		$valor_total_mes = $valor_total_mes + $valor_total_conta;
	}
	
	return $valor_total_mes;

}
}

if(!function_exists('apaga_files')) {
function apaga_files($name,$pasta) 
{
	$dir = ''.$pasta.'';
	if(is_dir($dir))
	{
		if($handle = opendir($dir))
		{
			while(($file = readdir($handle)) !== false)
			{
				if($file != '.' && $file != '..')
				{
					if( $file != $name)
					{
						unlink($dir.$file);
					}
				}
			}
		}
	} else	{
		die("Erro ao abrir dir: $dir");
	}
	return 0;
}
}

if(!function_exists('converte_segundos')) {
function converte_segundos($total_segundos, $inicio = 'Y') 
{

	define('dias_por_mes', ((((365*3)+366)/4)/12) );

	$comecou = false;

	if ($inicio == 'Y')
	{
	$array['anos'] = floor( $total_segundos / (60*60*24* dias_por_mes *12) );
	$total_segundos = ($total_segundos % (60*60*24* dias_por_mes *12));
	$comecou = true;
	}

	if (($inicio == 'm') || ($comecou == true))
	{
	$array['meses'] = floor( $total_segundos / (60*60*24* dias_por_mes ) );
	$total_segundos = ($total_segundos % (60*60*24* dias_por_mes ));
	$comecou = true;
	}

	if (($inicio == 'd') || ($comecou == true))
	{
	$array['dias'] = floor( $total_segundos / (60*60*24) );
	$total_segundos = ($total_segundos % (60*60*24));
	$comecou = true;
	}

	if (($inicio == 'H') || ($comecou == true))
	{
	$array['horas'] = floor( $total_segundos / (60*60) );
	$total_segundos = ($total_segundos % (60*60));
	$comecou = true;
	}

	if (($inicio == 'i') || ($comecou == true))
	{
	$array['minutos'] = floor($total_segundos / 60);
	$total_segundos = ($total_segundos % 60);
	$comecou = true;
	}

	$array['segundos'] = $total_segundos;

	return $array;
}
}

if(!function_exists('tamanhoArquivoSemExtensao')) {
function tamanhoArquivoSemExtensao( $arquivo, $digitos = 2 ) 
{
	
	if (is_file($arquivo)) {
	
		$arquivoTamanho = filesize($arquivo);
		return round($arquivoTamanho, $digitos)."";
	
	}

}
}

if(!function_exists('tamanho_pasta')) {
function tamanho_pasta($modGet,$id=0)
{
	$qSql = mysql_query("SELECT * FROM ".$modGet." WHERE numeroUnico_pai='".$id."' ORDER BY data ASC");
	while($rSql = mysql_fetch_array($qSql)) {

		if(trim($rSql['tipo'])=="folder") {
			$nSql = mysql_num_rows(mysql_query("SELECT * FROM ".$modGet." WHERE numeroUnico_pai='".$rSql['id']."'"));
			
			if($nSql==0) {
			} else {
				$arquivo_tamanho = tamanho_pasta($modGet,$rSql['numeroUnico']);
			}
		} else {
			$arquivo = "../../../../files/".$modGet."/".$rSql['numeroUnico']."/".$rSql['arquivo']."";
			if (is_file($arquivo)) {
			
				$arquivo_tamanho = filesize($arquivo);
				#$tamanho_set .= "[".$id."] -> ../../../../files/".$modGet."/".$rSql['numeroUnico']."/".$rSql['arquivo']." <br>";
			}
		}

		$tamanho_final = $tamanho_final + $arquivo_tamanho;

	}
	return $tamanho_final; 
}
}

if(!function_exists('converteTamanhos')) {
function converteTamanhos( $idGet, $modGet, $tamanho, $digitos = 2 ) 
{

	$data = date("Y-m-d H:i:s");

	$update = mysql_query("UPDATE ".$modGet." SET tamanho='".$tamanho."',dataModificacao='".$data."' WHERE id='".$idGet."'");
	
	$tamanhos = array("TB","GB","MB","KB","B");
	$total = count($tamanhos);
		
	while ($total-- && $tamanho > 1024) {
		$tamanho /= 1024;
	}
		
	$tamanho_final = round($tamanho, $digitos);
	
	if($tamanho_final==0) { } else { echo $tamanho_final." ".$tamanhos[$total]; }


}
}

if(!function_exists('tamanhoArquivoReturn')) {
function tamanhoArquivoReturn($arquivo, $digitos = 2 ) 
{
	
	$data = date("Y-m-d H:i:s");
	
	if (is_file($arquivo)) {

		$arquivo_tamanho = filesize($arquivo);
	
		$tamanhos = array("TB","GB","MB","KB","B");
		$total = count($tamanhos);
		
		while ($total-- && $arquivo_tamanho > 1024) {
			$arquivo_tamanho /= 1024;
		}
		
		return round($arquivo_tamanho, $digitos)." ".$tamanhos[$total];
	
	}
}
}

if(!function_exists('tamanhoArquivo')) {
function tamanhoArquivo( $idGet, $modGet, $arquivo, $digitos = 2 ) 
{
	
	$data = date("Y-m-d H:i:s");
	
	if (is_file($arquivo)) {

		$arquivo_tamanho = filesize($arquivo);

		$update = mysql_query("UPDATE ".$modGet." SET tamanho='".$arquivo_tamanho."',dataModificacao='".$data."' WHERE id='".$idGet."'");
	
		$tamanhos = array("TB","GB","MB","KB","B");
		$total = count($tamanhos);
		
		while ($total-- && $arquivo_tamanho > 1024) {
			$arquivo_tamanho /= 1024;
		}
		
		echo round($arquivo_tamanho, $digitos)." ".$tamanhos[$total];
	
	}
	
	return false;

}
}

if(!function_exists('compacta_arvore')) {
function compacta_arvore($mod,$idSend)
{
	$qSqlItem = mysql_query("SELECT * FROM ".$linguagem_set."".$mod." WHERE idpai='".$idSend."'");
	while($rSqlItem = mysql_fetch_array($qSqlItem)) { 
	
		if($rSqlItem['tipo']=="folder") {
			$nSql = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE idpai='".$rSqlItem['id']."'"));
			if($nSql==0) {
			} else {
				$lista_id_selecionado .= compacta_arvore($mod,$rSqlItem['id']);
			}
		} else {
			$lista_id_selecionado .= "|".$rSqlItem['id']."|";
		}

	}
	return $lista_id_selecionado; 
}
}

if(!function_exists('compacta_arquivo')) {
function compacta_arquivo($idSend)
{
	$qSql = mysql_query("SELECT * FROM sysmidia WHERE idpai='".$idSend."'");
	while($rSql = mysql_fetch_array($qSql)) { 

		$qSqlFile = mysql_query("SELECT * FROM sysmidia WHERE idpai='".$rSql['id']."' AND tipo='file'");
		while($rSqlFile = mysql_fetch_array($qSqlFile)) {
			$_SESSION['lista_ids'] .= "|".$rSqlFile['id']."|";
		}

		compacta_arquivo($rSql['id']);

	}
}
}

if(!function_exists('remove_pasta_arvore')) {
function remove_pasta_arvore($prefixo,$mod,$idSend,$sufixo)
{
	$qSql = mysql_query("SELECT * FROM ".$linguagem_set."".$mod." WHERE id='".$idSend."'");
	while($rSql = mysql_fetch_array($qSql)) { 
		$nSql = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE tipo='folder' AND numeroUnico_pai='".$rSql['numeroUnico']."'"));

		$qSqlFile = mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico_pai='".$rSql['numeroUnico']."' AND tipo='file'");
		while($rSqlFile = mysql_fetch_array($qSqlFile)) {
			remove_arquivo("../../","sysmidia",$rSqlFile['id'],"arquivo",""); 
		}

		remove_pasta_arvore($prefixo,$mod,$rSql['numeroUnico'],$sufixo);

		$update = mysql_query("UPDATE sysmidia SET lixeira='1' WHERE id='".$rSql['id']."'");
		#$sql = mysql_query("DELETE FROM ".$mod." WHERE id='".$rSql['id']."'");
	}
}
}

if(!function_exists('hex2rgb')) {
function hex2rgb($hex) 
{
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}
}

if(!function_exists('hex2rgb_return')) {
function hex2rgb_return($hex) 
{
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }

   //return implode(",", $rgb); // returns the rgb values separated by commas
   return "".$r.",".$g.",".$b.""; // returns an array with the rgb values
}
}

if(!function_exists('remove_arquivo')) {
function remove_arquivo($prefixo,$mod,$id,$campo,$sufixo)
{
	$itemSql = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$id."'"));
	$itemNSql = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$itemSql['numeroUnico']."'"));
	if($itemNSql>1) { } else {
		$qall = mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico_item_pai='".$itemSql['numeroUnico_item_pai']."'");
		while($rall = mysql_fetch_array($qall)) {
			if( $rall['ordem'] > $itemSql['ordem']) {
				$ordem = $rall['ordem'] - 1;
				$update = mysql_query("UPDATE ".$mod." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
			}
		}
		unlink("".$prefixo."files/".$mod."".$sufixo."/".$itemSql['numeroUnico']."/thumb_".$itemSql[$campo]."");
		unlink("".$prefixo."files/".$mod."".$sufixo."/".$itemSql['numeroUnico']."/".$itemSql[$campo]."");
		rmdir("".$prefixo."files/".$mod."".$sufixo."/".$itemSql['numeroUnico']."");
	}

	$update = mysql_query("UPDATE sysmidia SET lixeira='1' WHERE id='".$id."'");
	#$del = mysql_query("DELETE FROM ".$mod." WHERE id='".$id."'");
}
}

if(!function_exists('monta_menu')) {
function monta_menu($id,$idsysusuGet)
{
	$qSql = mysql_query("SELECT * FROM sysmidia WHERE idpai='".$id."' AND tipo='folder' ORDER BY nome");
	while($rSql = mysql_fetch_array($qSql)) { 
		$nSql =  mysql_num_rows(mysql_query("SELECT * FROM sysmidiaperm WHERE numeroUnico='".$rSql['numeroUnico']."' AND idsysusu='".$idsysusuGet."'"));
		if($idsysusuGet==$rSql['idsysusu']) {
			$mostra = 1;
		} else {
			if($nSql==0) {
				$mostra = 0;
			} else {
				$rSqlPerm =  mysql_fetch_array(mysql_query("SELECT * FROM sysmidiaperm WHERE numeroUnico='".$rSql['numeroUnico']."' AND idsysusu='".$idsysusuGet."'"));
				if($rSqlPerm['visualizar_pasta']==0) {
					$mostra = 0;
				} else {
					$mostra = 1;
				}
			}
		}

		if($mostra==1) {

			$nSql = mysql_num_rows(mysql_query("SELECT * FROM sysmidia WHERE tipo='folder' AND idpai='".$rSql['id']."'"));
	
			$print .= "{title: '".$rSql['nome']."', isFolder: true, key:".$rSql['id'].", expand: true,";
			
			if($nSql==0) {
				$print .= "},";
			} else {
				$print .= "children: [";
				$print .= monta_menu($rSql['id'],$idsysusuGet);
				$print .= "]},";
			}
		}
	}
	return $print; 
}
}


if(!function_exists('monta_ul_categoria')) {
function monta_ul_categoria($mod_pai,$mod_categoria,$idSend)
{
	$set_url_mod = "/".$mod_pai."/categoria";
	$qSql = mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$idSend."' ORDER BY ordem");
	while($rSql = mysql_fetch_array($qSql)) {

		$url_set = "".$rSql['url_amigavel']."";

		$nSql = mysql_num_rows(mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSql['id']."'"));
		if(trim($rSql['idpai'])==0) {
			$print .= "<li><a href='".$link_modelo."".$set_url_mod."/".$url_set."'>".$rSql['nome']."<span class='fa arrow'></span></a>";
		} else {
			$print .= "<li><a href='".$link_modelo."".$set_url_mod."/".$url_set."'>".$rSql['nome']."</a>";
		}
		
		if($nSql==0) {
			$print .= "";
		} else {
			$print.="<ul class='sub'>";

			$qSqlSub1 = mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSql['id']."' ORDER BY ordem");
			while($rSqlSub1 = mysql_fetch_array($qSqlSub1)) {

				$url_setSub1 = "".$rSqlSub1['url_amigavel']."";

				$print .= "<li><a href='".$link_modelo."".$set_url_mod."/".$url_set."/".$url_setSub1."'>".$rSqlSub1['nome']."</a>";

				$nSqlSub1 = mysql_num_rows(mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub1['id']."'"));
				if($nSqlSub1==0) {
					$print .= "";
				} else {
					$print.="<ul class='sub' style='padding-left:10px;'>";
		
					$qSqlSub2 = mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub1['id']."' ORDER BY ordem");
					while($rSqlSub2 = mysql_fetch_array($qSqlSub2)) {

						$url_setSub2 = "".$rSqlSub2['url_amigavel']."";
		
						$print .= "<li><a href='".$link_modelo."".$set_url_mod."/".$url_set."/".$url_setSub1."/".$url_setSub2."'>".$rSqlSub2['nome']."</a>";

						$nSqlSub2 = mysql_num_rows(mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub2['id']."'"));
						if($nSqlSub2==0) {
							$print .= "";
						} else {

							$print.="<ul class='sub' style='padding-left:10px;'>";
				
							$qSqlSub3 = mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub2['id']."' ORDER BY ordem");
							while($rSqlSub3 = mysql_fetch_array($qSqlSub3)) {

								$url_setSub3 = "".$rSqlSub3['url_amigavel']."";
				
								$print .= "<li><a href='".$link_modelo."".$set_url_mod."/".$url_set."/".$url_setSub1."/".$url_setSub2."/".$url_setSub3."'>".$rSqlSub3['nome']."</a>";

								$nSqlSub3 = mysql_num_rows(mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub3['id']."'"));
								if($nSqlSub3==0) {
									$print .= "";
								} else {

									$print.="<ul class='sub' style='padding-left:10px;'>";
						
									$qSqlSub4 = mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub3['id']."' ORDER BY ordem");
									while($rSqlSub4 = mysql_fetch_array($qSqlSub4)) {

										$url_setSub4 = "".$rSqlSub4['url_amigavel']."";
						
										$print .= "<li><a href='".$link_modelo."".$set_url_mod."/".$url_set."/".$url_setSub1."/".$url_setSub2."/".$url_setSub3."/".$url_setSub4."'>".$rSqlSub4['nome']."</a>";

										$nSqlSub4 = mysql_num_rows(mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub4['id']."'"));
										if($nSqlSub4==0) {
											$print .= "";
										} else {

											$print.="<ul class='sub' style='padding-left:10px;'>";
								
											$qSqlSub5 = mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub4['id']."' ORDER BY ordem");
											while($rSqlSub5 = mysql_fetch_array($qSqlSub5)) {

												$url_setSub5 = "".$rSqlSub5['url_amigavel']."";
								
												$print .= "<li><a href='".$link_modelo."".$set_url_mod."/".$url_set."/".$url_setSub1."/".$url_setSub2."/".$url_setSub3."/".$url_setSub4."/".$url_setSub5."'>".$rSqlSub5['nome']."</a>";

												$nSqlSub5 = mysql_num_rows(mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub5['id']."'"));
												if($nSqlSub5==0) {
													$print .= "";
												} else {

													$print.="<ul class='sub' style='padding-left:10px;'>";
										
													$qSqlSub6 = mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub5['id']."' ORDER BY ordem");
													while($rSqlSub6 = mysql_fetch_array($qSqlSub6)) {

														$url_setSub6 = "".$rSqlSub6['url_amigavel']."";
										
														$print .= "<li><a href='".$link_modelo."".$set_url_mod."/".$url_set."/".$url_setSub1."/".$url_setSub2."/".$url_setSub3."/".$url_setSub4."/".$url_setSub5."/".$url_setSub6."'>".$rSqlSub6['nome']."</a>";

														$nSqlSub6 = mysql_num_rows(mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub6['id']."'"));
														if($nSqlSub6==0) {
															$print .= "";
														} else {
														}
														$print .= "</li>";
													}
										
													$print.="</ul>";
								
												}
												$print .= "</li>";
											}
								
											$print.="</ul>";
						
										}
										$print .= "</li>";
									}
						
									$print.="</ul>";
				
								}
								$print .= "</li>";
							}
				
							$print.="</ul>";
		
						}
						$print .= "</li>";
					}
		
					$print.="</ul>";
				}
				$print .= "</li>";
			}

			$print.="</ul>";
		}
		$print .= "</li>";
	}
	echo $print; 
}
}

if(!function_exists('monta_td_categoria')) {
function monta_td_categoria($link,$mod_pai,$mod_categoria,$idSend)
{
	$set_url_mod = "/".$mod_pai."/categoria";
	$qSql = mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$idSend."' ORDER BY ordem");
	while($rSql = mysql_fetch_array($qSql)) {

		$url_set = "".$rSql['url_amigavel']."";

		$nSql = mysql_num_rows(mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSql['id']."'"));
		if(trim($rSql['idpai'])==0) {
			$print .= "<tr>
						<td style=\"vertical-align:middle;\">".$rSql['ordem']."</td>
						<td style=\"vertical-align:middle;padding-left:20px;\">>&nbsp;".$rSql['nome']."</td>
						<td style=\"vertical-align:middle;\">".$rSql['url_amigavel']."</td>
			            <td style='vertical-align:middle;' class='nolink'>
							<a href=\"javascript:void(0);\" onClick=\"remover_item_ajax('lista_categoria','".$rSql['id']."','".$mod_pai."','_categoria','SIM','".$rSql['ordem']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>
							";
							if(trim($rSql['stat'])==1) {
							$print .= " <a href=\"javascript:void(0);\" onClick=\"muda_stat_ajax('lista_categoria','".$mod_pai."','_categoria','".$rSql['id']."','0');\" class=\"btn-mini ptip_se\" title=\"Despublicar\"><img src=\"".$link."template/img/icones_novos/16/stat-1.png\" /></a>";
							} else {
							$print .= "<a href=\"javascript:void(0);\" onClick=\"muda_stat_ajax('lista_categoria','".$mod_pai."','_categoria','".$rSql['id']."','1');\" class=\"btn-mini ptip_se\" title=\"Publicar\"><img src=\"".$link."template/img/icones_novos/16/stat-0.png\" /></a>";
							}
						$print .= "</td>
						</tr>";
		} else {
			$print .= "<tr>
						<td style=\"vertical-align:middle;\">".$rSql['ordem']."</td>
						<td style=\"vertical-align:middle;padding-left:20px;\">-&nbsp;".$rSql['nome']."</td>
						<td style=\"vertical-align:middle;\">".$rSql['url_amigavel']."</td>
			            <td style='vertical-align:middle;' class='nolink'>
							<a href=\"javascript:void(0);\" onClick=\"remover_item_ajax('lista_categoria','".$rSql['id']."','".$mod_pai."','_categoria','SIM','".$rSql['ordem']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>
							";
							if(trim($rSql['stat'])==1) {
							$print .= " <a href=\"javascript:void(0);\" onClick=\"muda_stat_ajax('lista_categoria','".$mod_pai."','_categoria','".$rSql['id']."','0');\" class=\"btn-mini ptip_se\" title=\"Despublicar\"><img src=\"".$link."template/img/icones_novos/16/stat-1.png\" /></a>";
							} else {
							$print .= "<a href=\"javascript:void(0);\" onClick=\"muda_stat_ajax('lista_categoria','".$mod_pai."','_categoria','".$rSql['id']."','1');\" class=\"btn-mini ptip_se\" title=\"Publicar\"><img src=\"".$link."template/img/icones_novos/16/stat-0.png\" /></a>";
							}
						$print .= "</td>
						</tr>";
		}
		
		if($nSql==0) {
			$print .= "";
		} else {

			$qSqlSub1 = mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSql['id']."' ORDER BY ordem");
			while($rSqlSub1 = mysql_fetch_array($qSqlSub1)) {

				$url_setSub1 = "".$rSqlSub1['url_amigavel']."";

			$print .= "<tr>
						<td style=\"vertical-align:middle;\">".$rSqlSub1['ordem']."</td>
						<td style=\"vertical-align:middle;padding-left:20px;\">-&nbsp;".$rSqlSub1['nome']."</td>
						<td style=\"vertical-align:middle;\">".$rSqlSub1['url_amigavel']."</td>
			            <td style='vertical-align:middle;' class='nolink'>
							<a href=\"javascript:void(0);\" onClick=\"remover_item_ajax('lista_categoria','".$rSqlSub1['id']."','".$mod_pai."','_categoria','SIM','".$rSqlSub1['ordem']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>
							";
							if(trim($rSqlSub1['stat'])==1) {
							$print .= " <a href=\"javascript:void(0);\" onClick=\"muda_stat_ajax('lista_categoria','".$mod_pai."','_categoria','".$rSqlSub1['id']."','0');\" class=\"btn-mini ptip_se\" title=\"Despublicar\"><img src=\"".$link."template/img/icones_novos/16/stat-1.png\" /></a>";
							} else {
							$print .= "<a href=\"javascript:void(0);\" onClick=\"muda_stat_ajax('lista_categoria','".$mod_pai."','_categoria','".$rSqlSub1['id']."','1');\" class=\"btn-mini ptip_se\" title=\"Publicar\"><img src=\"".$link."template/img/icones_novos/16/stat-0.png\" /></a>";
							}
						$print .= "</td>
						</tr>";

				$nSqlSub1 = mysql_num_rows(mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub1['id']."'"));
				if($nSqlSub1==0) {
					$print .= "";
				} else {
		
					$qSqlSub2 = mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub1['id']."' ORDER BY ordem");
					while($rSqlSub2 = mysql_fetch_array($qSqlSub2)) {

						$url_setSub2 = "".$rSqlSub2['url_amigavel']."";
		
			$print .= "<tr>
						<td style=\"vertical-align:middle;\">".$rSqlSub2['ordem']."</td>
						<td style=\"vertical-align:middle;padding-left:30px;\">-&nbsp;".$rSqlSub2['nome']."</td>
						<td style=\"vertical-align:middle;\">".$rSqlSub2['url_amigavel']."</td>
			            <td style='vertical-align:middle;' class='nolink'>
							<a href=\"javascript:void(0);\" onClick=\"remover_item_ajax('lista_categoria','".$rSqlSub2['id']."','".$mod_pai."','_categoria','SIM','".$rSqlSub2['ordem']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>
							";
							if(trim($rSqlSub2['stat'])==1) {
							$print .= " <a href=\"javascript:void(0);\" onClick=\"muda_stat_ajax('lista_categoria','".$mod_pai."','_categoria','".$rSqlSub2['id']."','0');\" class=\"btn-mini ptip_se\" title=\"Despublicar\"><img src=\"".$link."template/img/icones_novos/16/stat-1.png\" /></a>";
							} else {
							$print .= "<a href=\"javascript:void(0);\" onClick=\"muda_stat_ajax('lista_categoria','".$mod_pai."','_categoria','".$rSqlSub2['id']."','1');\" class=\"btn-mini ptip_se\" title=\"Publicar\"><img src=\"".$link."template/img/icones_novos/16/stat-0.png\" /></a>";
							}
						$print .= "</td>
						</tr>";

						$nSqlSub2 = mysql_num_rows(mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub2['id']."'"));
						if($nSqlSub2==0) {
							$print .= "";
						} else {

				
							$qSqlSub3 = mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub2['id']."' ORDER BY ordem");
							while($rSqlSub3 = mysql_fetch_array($qSqlSub3)) {

								$url_setSub3 = "".$rSqlSub3['url_amigavel']."";
				
			$print .= "<tr>
						<td style=\"vertical-align:middle;\">".$rSqlSub3['ordem']."</td>
						<td style=\"vertical-align:middle;padding-left:40px;\">-&nbsp;".$rSqlSub3['nome']."</td>
						<td style=\"vertical-align:middle;\">".$rSqlSub3['url_amigavel']."</td>
			            <td style='vertical-align:middle;' class='nolink'>
							<a href=\"javascript:void(0);\" onClick=\"remover_item_ajax('lista_categoria','".$rSqlSub3['id']."','".$mod_pai."','_categoria','SIM','".$rSqlSub3['ordem']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>
							";
							if(trim($rSqlSub3['stat'])==1) {
							$print .= " <a href=\"javascript:void(0);\" onClick=\"muda_stat_ajax('lista_categoria','".$mod_pai."','_categoria','".$rSqlSub3['id']."','0');\" class=\"btn-mini ptip_se\" title=\"Despublicar\"><img src=\"".$link."template/img/icones_novos/16/stat-1.png\" /></a>";
							} else {
							$print .= "<a href=\"javascript:void(0);\" onClick=\"muda_stat_ajax('lista_categoria','".$mod_pai."','_categoria','".$rSqlSub3['id']."','1');\" class=\"btn-mini ptip_se\" title=\"Publicar\"><img src=\"".$link."template/img/icones_novos/16/stat-0.png\" /></a>";
							}
						$print .= "</td>
						</tr>";

								$nSqlSub3 = mysql_num_rows(mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub3['id']."'"));
								if($nSqlSub3==0) {
									$print .= "";
								} else {

						
									$qSqlSub4 = mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub3['id']."' ORDER BY ordem");
									while($rSqlSub4 = mysql_fetch_array($qSqlSub4)) {

										$url_setSub4 = "".$rSqlSub4['url_amigavel']."";
						
			$print .= "<tr>
						<td style=\"vertical-align:middle;\">".$rSqlSub4['ordem']."</td>
						<td style=\"vertical-align:middle;padding-left:50px;\">-&nbsp;".$rSqlSub4['nome']."</td>
						<td style=\"vertical-align:middle;\">".$rSqlSub4['url_amigavel']."</td>
			            <td style='vertical-align:middle;' class='nolink'>
							<a href=\"javascript:void(0);\" onClick=\"remover_item_ajax('lista_categoria','".$rSqlSub4['id']."','".$mod_pai."','_categoria','SIM','".$rSqlSub4['ordem']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>
							";
							if(trim($rSqlSub4['stat'])==1) {
							$print .= " <a href=\"javascript:void(0);\" onClick=\"muda_stat_ajax('lista_categoria','".$mod_pai."','_categoria','".$rSqlSub4['id']."','0');\" class=\"btn-mini ptip_se\" title=\"Despublicar\"><img src=\"".$link."template/img/icones_novos/16/stat-1.png\" /></a>";
							} else {
							$print .= "<a href=\"javascript:void(0);\" onClick=\"muda_stat_ajax('lista_categoria','".$mod_pai."','_categoria','".$rSqlSub4['id']."','1');\" class=\"btn-mini ptip_se\" title=\"Publicar\"><img src=\"".$link."template/img/icones_novos/16/stat-0.png\" /></a>";
							}
						$print .= "</td>
						</tr>";

										$nSqlSub4 = mysql_num_rows(mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub4['id']."'"));
										if($nSqlSub4==0) {
											$print .= "";
										} else {

								
											$qSqlSub5 = mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub4['id']."' ORDER BY ordem");
											while($rSqlSub5 = mysql_fetch_array($qSqlSub5)) {

												$url_setSub5 = "".$rSqlSub5['url_amigavel']."";
								
			$print .= "<tr>
						<td style=\"vertical-align:middle;\">".$rSqlSub5['ordem']."</td>
						<td style=\"vertical-align:middle;padding-left:60px;\">-&nbsp;".$rSqlSub5['nome']."</td>
						<td style=\"vertical-align:middle;\">".$rSqlSub5['url_amigavel']."</td>
			            <td style='vertical-align:middle;' class='nolink'>
							<a href=\"javascript:void(0);\" onClick=\"remover_item_ajax('lista_categoria','".$rSqlSub5['id']."','".$mod_pai."','_categoria','SIM','".$rSqlSub5['ordem']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>
							";
							if(trim($rSqlSub5['stat'])==1) {
							$print .= " <a href=\"javascript:void(0);\" onClick=\"muda_stat_ajax('lista_categoria','".$mod_pai."','_categoria','".$rSqlSub5['id']."','0');\" class=\"btn-mini ptip_se\" title=\"Despublicar\"><img src=\"".$link."template/img/icones_novos/16/stat-1.png\" /></a>";
							} else {
							$print .= "<a href=\"javascript:void(0);\" onClick=\"muda_stat_ajax('lista_categoria','".$mod_pai."','_categoria','".$rSqlSub5['id']."','1');\" class=\"btn-mini ptip_se\" title=\"Publicar\"><img src=\"".$link."template/img/icones_novos/16/stat-0.png\" /></a>";
							}
						$print .= "</td>
						</tr>";

												$nSqlSub5 = mysql_num_rows(mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub5['id']."'"));
												if($nSqlSub5==0) {
													$print .= "";
												} else {


										
													$qSqlSub6 = mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub5['id']."' ORDER BY ordem");
													while($rSqlSub6 = mysql_fetch_array($qSqlSub6)) {

														$url_setSub6 = "".$rSqlSub6['url_amigavel']."";
										
			$print .= "<tr>
						<td style=\"vertical-align:middle;\">".$rSqlSub6['ordem']."</td>
						<td style=\"vertical-align:middle;padding-left:70px;\">-&nbsp;".$rSqlSub6['nome']."</td>
						<td style=\"vertical-align:middle;\">".$rSqlSub6['url_amigavel']."</td>
			            <td style='vertical-align:middle;' class='nolink'>
							<a href=\"javascript:void(0);\" onClick=\"remover_item_ajax('lista_categoria','".$rSqlSub6['id']."','".$mod_pai."','_categoria','SIM','".$rSqlSub6['ordem']."');\" class=\"btn-mini ptip_se\" title=\"Remover\"><img src=\"".$link."template/img/icones_novos/16/remover-x.png\" /></a>
							";
							if(trim($rSqlSub6['stat'])==1) {
							$print .= " <a href=\"javascript:void(0);\" onClick=\"muda_stat_ajax('lista_categoria','".$mod_pai."','_categoria','".$rSqlSub6['id']."','0');\" class=\"btn-mini ptip_se\" title=\"Despublicar\"><img src=\"".$link."template/img/icones_novos/16/stat-1.png\" /></a>";
							} else {
							$print .= "<a href=\"javascript:void(0);\" onClick=\"muda_stat_ajax('lista_categoria','".$mod_pai."','_categoria','".$rSqlSub6['id']."','1');\" class=\"btn-mini ptip_se\" title=\"Publicar\"><img src=\"".$link."template/img/icones_novos/16/stat-0.png\" /></a>";
							}
						$print .= "</td>
						</tr>";

														$nSqlSub6 = mysql_num_rows(mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSqlSub6['id']."'"));
														if($nSqlSub6==0) {
															$print .= "";
														} else {
														}
													}
										
								
												}
											}
								
						
										}
									}
						
				
								}
							}
				
		
						}
					}
		
				}
			}

		}
	}
	echo $print; 
}
}

if(!function_exists('monta_select_pastas')) {
function monta_select_pastas($idsysusuSend,$idSend,$j,$modGet,$id=0)
{
	$j=$j;
	$qSql = mysql_query("SELECT * FROM ".$modGet." WHERE numeroUnico_pai='".$id."' AND tipo='folder' ORDER BY idpai ASC, nome");
	while($rSql = mysql_fetch_array($qSql)) {

		$nSql =  mysql_num_rows(mysql_query("SELECT * FROM ".$modGet."perm WHERE numeroUnico='".$rSql['numeroUnico']."' AND idsysusu='".$idsysusuSend."'"));
		if($idsysusuSend==$rSql['idsysusu']) {
			$mostra = 1;
		} else {
			if($nSql==0) {
				$mostra = 0;
			} else {
				$rSqlPerm =  mysql_fetch_array(mysql_query("SELECT * FROM ".$modGet."perm WHERE numeroUnico='".$rSql['numeroUnico']."' AND idsysusu='".$idsysusuSend."'"));
				if($rSqlPerm['visualizar_pasta']==0) {
					$mostra = 0;
				} else {
					$mostra = 1;
				}
			}
		}

		if($mostra==1) {

			if(trim($rSql['numeroUnico_pai'])==0) {
				$simbolo_option = "&lfloor;_";
				$j = "&nbsp;";
			} else {
				$simbolo_option = "".$j."&lfloor;_";
			}
			$nSql = mysql_num_rows(mysql_query("SELECT * FROM ".$modGet." WHERE numeroUnico_pai='".$rSql['numeroUnico']."'"));
			
			if($rSql['numeroUnico']==$idSend) { $selected_set = " selected"; } else { $selected_set = ""; }
	
			$print .= "<option value='".$rSql['numeroUnico']."' ".$selected_set." >&nbsp;".$simbolo_option." ".$rSql['nome']."</option>";
			
			if($nSql==0) {
				$print .= "<br>";
			} else {
				$j.= $j."&nbsp;";
				$print .= monta_select_pastas($idsysusuSend,$idSend,$j,$modGet,$rSql['numeroUnico']);
			}
		}
	}
	return $print; 
}
}

if(!function_exists('monta_select_categoria')) {
function monta_select_categoria($idSend,$j,$mod_categoria,$id=0)
{
	$j=$j;
	$qSql = mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$id."' ORDER BY ordem");
	while($rSql = mysql_fetch_array($qSql)) {
		if(trim($rSql['idpai'])==0) {
			$simbolo_option = "&lfloor;";
			$j = "&nbsp;";
		} else {
			$simbolo_option = "".$j."&ndash;";
		}
		$nSql = mysql_num_rows(mysql_query("SELECT * FROM ".$mod_categoria." WHERE idpai='".$rSql['id']."'"));
		
		if($rSql['id']==$idSend) { $selected_set = " selected"; } else { $selected_set = ""; }

		$print .= "<option value='".$rSql['id']."' ".$selected_set." >".$simbolo_option." ".$rSql['nome']."</option>";
		
		if($nSql==0) {
			$print .= "<br>";
		} else {
			$j.= $j."&nbsp;";
			$print .= monta_select_categoria($idSend,$j,$mod_categoria,$rSql['id']);
		}
	}
	return $print; 
}
}

if(!function_exists('monta_url_recursiva')) {
function monta_url_recursiva($idSend,$mod_categoria,$printSend)
{
	$rSql = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod_categoria." WHERE id='".$idSend."'"));
	$print .= "/".$rSql['url_amigavel']."".$printSend."";
	
	if($rSql['idpai']==0) {
		echo $print; 
	} else {
		$print .= monta_url_recursiva("".$rSql['idpai']."",$mod_categoria,"".$print."");
	}

}
}

if(!function_exists('salva_campo_lista')) {
function salva_campo_lista($campo) 
{
	$catCompleta = "";
	$categorias = $_POST[$campo];
	$ncategorias = count($categorias);
	for ($i=0;$i<count($categorias);$i++)   {
		if($ncategorias==1) {
			$catCompleta = "|".$categorias[$i]."|";
		} else {
			$catCompleta = "".$catCompleta.",|".$categorias[$i]."|";
		}
	}
	if($ncategorias==1) { 
		$_POST[$campo] = $catCompleta; 
	} else {
		$lengthcatCompleta = strlen($catCompleta);
		$catCompleta = substr($catCompleta,1,$lengthcatCompleta);
		$_POST[$campo] = $catCompleta; 
	}
}
}

if(!function_exists('explode_zip')) {
function explode_zip($arquivo,$host,$user,$pass,$raiz) 
{
	
	$conexao_ftp = ftp_connect($host) or die("Não foi possível conectar à ".$host."");
	$login_result = ftp_login($conexao_ftp, $user, $pass); 
	ftp_pasv($conexao_ftp, true);
	
	$command = "unzip ".$arquivo."";


	if (ftp_exec($conexao_ftp, $command)) {
		echo "".$command." executado com sucesso\n";
	} else {
		echo "nã foi possível executar ".$command."\n";
	}

	ftp_close($conexao_ftp);

}
}

# Função responsável por fazer upload de um arquivo e criar pasta caso não exista
if(!function_exists('upload_arquivo_ftp')) {
function upload_arquivo_ftp($mod,$campo,$numero_unico,$host,$user,$pass,$raiz) 
{
	$conexao_ftp = ftp_connect($host) or die("Couldn't connect to ".$host."");
	$login_result = ftp_login($conexao_ftp, $user, $pass); 
	ftp_pasv($conexao_ftp, true);

	$arquivo = $_FILES["".$campo.""]["name"];
	$arquivo_tmp = $_FILES["".$campo.""]["tmp_name"];
	$caminho_remoto = "".$raiz."files/".$mod."/".$numero_unico."/";

	if(@ftp_chdir($conexao_ftp, "".$raiz."files/".$mod."")) { 
		if(@ftp_chdir($conexao_ftp, "".$raiz."files/".$mod."/".$numero_unico."")) { 
			ftp_chdir($conexao_ftp, "".$raiz."files/".$mod."/".$numero_unico."/"); 
		} else {
			ftp_mkdir($conexao_ftp, "".$raiz."files/".$mod."/".$numero_unico."");
			ftp_chdir($conexao_ftp, "".$raiz."files/".$mod."/".$numero_unico."/"); 
		}
	} else {
		ftp_mkdir($conexao_ftp, "".$raiz."files/".$mod."");
		ftp_chmod($conexao_ftp, 0777, "".$raiz."files/".$mod."");
		ftp_mkdir($conexao_ftp, "".$raiz."files/".$mod."/".$numero_unico."");
		ftp_chmod($conexao_ftp, 0777, "".$raiz."files/".$mod."/".$numero_unico."");
		ftp_chdir($conexao_ftp, "".$raiz."files/".$mod."/".$numero_unico."/");
	}
	
	$_POST[$campo] = $arquivo;

	ftp_put($conexao_ftp,$caminho_remoto.'/'.$arquivo,$arquivo_tmp,FTP_BINARY) or die("Unable to upload");
	ftp_close($conexao_ftp);
}
}

if(!function_exists('cleanString')) {
function cleanString($text) {
    $utf8 = array(
        '/[áàâãªä]/u'   =>   'a',
        '/[ÁÀÂÃÄ]/u'    =>   'A',
        '/[ÍÌÎÏ]/u'     =>   'I',
        '/[íìîï]/u'     =>   'i',
        '/[éèêë]/u'     =>   'e',
        '/[ÉÈÊË]/u'     =>   'E',
        '/[óòôõºö]/u'   =>   'o',
        '/[ÓÒÔÕÖ]/u'    =>   'O',
        '/[úùûü]/u'     =>   'u',
        '/[ÚÙÛÜ]/u'     =>   'U',
        '/ç/'           =>   'c',
        '/Ç/'           =>   'C',
        '/ñ/'           =>   'n',
        '/Ñ/'           =>   'N',
        '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
        '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
        '/[“”«»„]/u'    =>   ' ', // Double quote
        '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $text);
}
}

#Função para enviar um único arquivo
if(!function_exists('uploadArquivo')) {
function uploadArquivo($caminho,$arquivo) 
{
	if(trim($_FILES["".$arquivo.""]["name"])=="") {
	} else {
		if ($_FILES["".$arquivo.""]["error"] === 0)  {  
	
			$novo_nome = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($_FILES["".$arquivo.""]["name"]));
			$novo_nome = str_replace(" ","_",$novo_nome);
			$novo_nome = strtolower($novo_nome);
			
			@ move_uploaded_file($_FILES["".$arquivo.""]["tmp_name"],"".$caminho."/".$_FILES["".$arquivo.""]["name"]."");
			rename("".$caminho."/".$_FILES["".$arquivo.""]["name"]."", "".$caminho."/".$novo_nome."");

			$_POST["".$arquivo.""] =  $novo_nome;
		}
	}
}
}

# Função responsável por fazer upload de um arquivo e criar pasta caso não exista
if(!function_exists('upload_arquivo')) {
function upload_arquivo($mod,$campo,$sufixo) 
{
	if(trim($_POST['numeroUnico'])=="") {
		if(is_dir("./files/".$mod."".$sufixo."")) { 
			if(trim($_FILES[$campo]["name"])=="") { } else {
				$caminhoUpload = "./files/".$mod."".$sufixo.""; 
				uploadArquivo("".$caminhoUpload."","".$campo."");
			}
		} else {
			criaPastaComCaminho("files/","".$mod."".$sufixo."");
			if(trim($_FILES[$campo]["name"])=="") { } else {
				$caminhoUpload = "./files/".$mod."".$sufixo.""; 
				uploadArquivo("".$caminhoUpload."","".$campo."");
			}
		}
	} else {
		if(is_dir("./files/".$mod."".$sufixo."")) { 
			if(is_dir("./files/".$mod."".$sufixo."/".$_POST['numeroUnico']."")) { 
				if(trim($_FILES[$campo]["name"])=="") { } else {
					$caminhoUpload = "./files/".$mod."".$sufixo."/".$_POST['numeroUnico'].""; 
					uploadArquivo("".$caminhoUpload."","".$campo."");
				}
			} else {
				criaPastaComCaminho("files/".$mod."".$sufixo."","".$_POST['numeroUnico']."");
				if(trim($_FILES[$campo]["name"])=="") { } else {
					$caminhoUpload = "./files/".$mod."".$sufixo."/".$_POST['numeroUnico'].""; 
					uploadArquivo("".$caminhoUpload."","".$campo."");
				}
			}
		} else {
			criaPastaComCaminho("files","".$mod."".$sufixo."");
			criaPastaComCaminho("files/".$mod."".$sufixo."","".$_POST['numeroUnico']."");
			if(trim($_FILES[$campo]["name"])=="") { } else {
				$caminhoUpload = "./files/".$mod."".$sufixo."/".$_POST['numeroUnico'].""; 
				uploadArquivo("".$caminhoUpload."","".$campo."");
			}
		}
	}
}
}

# Função responsável por fazer upload de um arquivo e criar pasta caso não exista
if(!function_exists('upload_arquivo_nativo')) {
function upload_arquivo_nativo($mod,$campo,$sufixo) 
{
	if(trim($_POST['numeroUnico'])=="") {
		if(is_dir("".$_SERVER['DOCUMENT_ROOT']."/admin/files/".$mod."".$sufixo."")) { 
			if(trim($_FILES[$campo]["name"])=="") { } else {
				$caminhoUpload = "".$_SERVER['DOCUMENT_ROOT']."/admin/files/".$mod."".$sufixo.""; 
				uploadArquivo("".$caminhoUpload."","".$campo."");
			}
		} else {
			criaPastaComCaminhoNativo("".$_SERVER['DOCUMENT_ROOT']."/admin/files/","".$mod."".$sufixo."");
			if(trim($_FILES[$campo]["name"])=="") { } else {
				$caminhoUpload = "".$_SERVER['DOCUMENT_ROOT']."/admin/files/".$mod."".$sufixo.""; 
				uploadArquivo("".$caminhoUpload."","".$campo."");
			}
		}
	} else {
		if(is_dir("".$_SERVER['DOCUMENT_ROOT']."/admin/files/".$mod."".$sufixo."")) { 
			if(is_dir("".$_SERVER['DOCUMENT_ROOT']."/admin/files/".$mod."".$sufixo."/".$_POST['numeroUnico']."")) { 
				if(trim($_FILES[$campo]["name"])=="") { } else {
					$caminhoUpload = "".$_SERVER['DOCUMENT_ROOT']."/admin/files/".$mod."".$sufixo."/".$_POST['numeroUnico'].""; 
					uploadArquivo("".$caminhoUpload."","".$campo."");
				}
			} else {
				criaPastaComCaminhoNativo("".$_SERVER['DOCUMENT_ROOT']."/admin/files/".$mod."".$sufixo."/","".$_POST['numeroUnico']."");
				if(trim($_FILES[$campo]["name"])=="") { } else {
					$caminhoUpload = "".$_SERVER['DOCUMENT_ROOT']."/admin/files/".$mod."".$sufixo."/".$_POST['numeroUnico'].""; 
					uploadArquivo("".$caminhoUpload."","".$campo."");
				}
			}
		} else {
			criaPastaComCaminhoNativo("".$_SERVER['DOCUMENT_ROOT']."/admin/files/","".$mod."".$sufixo."");
			criaPastaComCaminhoNativo("".$_SERVER['DOCUMENT_ROOT']."/admin/files/".$mod."".$sufixo."/","".$_POST['numeroUnico']."");
			if(trim($_FILES[$campo]["name"])=="") { } else {
				$caminhoUpload = "".$_SERVER['DOCUMENT_ROOT']."/admin/files/".$mod."".$sufixo."/".$_POST['numeroUnico'].""; 
				uploadArquivo("".$caminhoUpload."","".$campo."");
			}
		}
	}
}
}

# Função responsável por criar pasta caso não exista
if(!function_exists('cria_pasta')) {
function cria_pasta($prefixo,$mod,$sufixo,$numeroUnicoSend) 
{
	if(is_dir("".$prefixo."files/".$mod."".$sufixo."")) { 
		if(is_dir("".$prefixo."files/".$mod."".$sufixo."/".$numeroUnicoSend."")) { 
		} else {
			criaPastaComCaminho("files/".$mod."".$sufixo."","".$numeroUnicoSend."");
		}
	} else {
		criaPastaComCaminho("files/","".$mod."".$sufixo."");
		criaPastaComCaminho("files/".$mod."".$sufixo."","".$numeroUnicoSend."");
	}
}
}

# Função responsável por reconhecer a operadora de video e montar o link correto
if(!function_exists('get_player')) {
function get_player($link)
{
    $operadora = 'nada';

	if(strrpos($link, "vimeo") > 0) { 

        $padrao = "http://player.vimeo.com/video/";
		$linkLimpo = str_replace("http://vimeo.com/","",$link);
		$linkNovo = $padrao.$linkLimpo;

	} elseif(strrpos($link, "dailymotion") > 0) {

        $padrao = "http://player.vimeo.com/video/";
		$linkLimpo = str_replace("http://vimeo.com/","",$link);
		$linkNovo = $padrao.$linkLimpo;

	} elseif(strrpos($link, "youtube") > 0) {

		$pos      = strripos($link, "watch?v=");
		$recorte = substr($link,$pos+8,$pos+11);
        $padrao = "//www.youtube.com/embed/";
		$linkNovo = $padrao.$recorte."?rel=0";

	} elseif(strrpos($link, "flickr") > 0) {
        $operadora = "flickr";
	} elseif(strrpos($link, "livestream") > 0) {
        $operadora = "livestream";
	} elseif(strrpos($link, "ustream") > 0) {
        $operadora = "ustream";
	} elseif(strrpos($link, "dropbox") > 0) {
        $operadora = "audio";
	} else {
        $padrao = "//www.youtube.com/embed/";
		$linkNovo = $padrao.$link."?rel=0";
	}
	
    return $linkNovo;
}
}

# Função responsável por reconhecer a operadora de video e montar o link correto
if(!function_exists('get_id_video')) {
function get_id_video($link)
{
    $operadora = 'nada';
    if(stripos($link, "vimeo")==0) { } else {
        $padrao = "http://player.vimeo.com/video/";
		$linkLimpo = str_replace("http://vimeo.com/","",$link);
		$linkNovo = $padrao.$linkLimpo;
    }
    if(stripos($link, "dailymotion")==0) { } else {
        $padrao = "http://www.dailymotion.com/embed/video/";
		$linkLimpo = str_replace("http://www.dailymotion.com/video/","",$link);
		$linkNovo = $padrao.$linkLimpo;
    }
    if(stripos($link, "youtube")==0) { } else {
		$pos      = strripos($link, "watch?v=");
		$recorte = substr($link,$pos+8,$pos+11);
        $padrao = "http://www.youtube.com/watch?v=";
		$linkNovo = $padrao.$recorte."?rel=0";
    }
    if(stripos($link, "flickr")==0) { } else {
        $operadora = "flickr";
    }
    if(stripos($link, "livestream")==0) { } else {
        $operadora = "livestream";
    }
    if(stripos($link, "ustream")==0) { } else {
        $operadora = "ustream";
    }
    if(stripos($link, "dropbox")==0) { } else {
        $operadora = "audio";
    }
	
    return $linkNovo;
}
}

# Função responsável por proteção contra SQL INJECTION
if(!function_exists('anti_injection')) {
function anti_injection($sql)
{
	$sql = preg_replace("/( from |select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/", "" ,$sql);
	$sql = trim($sql);
	$sql = strip_tags($sql);
	$sql = (get_magic_quotes_gpc()) ? $sql : addslashes($sql);
	$sql = mysql_real_escape_string($sql);
	return $sql;
}
}

# Função responsável por gerar um código aleatório com 30 caracteres que serve de guia de identificação
if(!function_exists('geraCodCont')) {
function geraCodCont($cont=16) 
{
	$CaracteresAceitos = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
	$max = strlen($CaracteresAceitos)-1;
	$cod = null;
	for($i=0; $i < $cont; $i++) {
		$cod .= $CaracteresAceitos{mt_rand(0, $max)};
	}
	return $cod;
}
}

# Função responsável por gerar um código aleatório com 30 caracteres que serve de guia de identificação
if(!function_exists('geraCod')) {
function geraCod() 
{
	$CaracteresAceitos = 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
	$max = strlen($CaracteresAceitos)-1;
	$cod = null;
	for($i=0; $i < 30; $i++) {
		$cod .= $CaracteresAceitos{mt_rand(0, $max)};
	}
	echo $cod;
}
}

# Função responsável por gerar um código aleatório com 30 caracteres que serve de guia de identificação
if(!function_exists('geraCodReturn')) {
function geraCodReturn() 
{
	$CaracteresAceitos = 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
	$max = strlen($CaracteresAceitos)-1;
	$cod = null;
	for($i=0; $i < 30; $i++) {
		$cod .= $CaracteresAceitos{mt_rand(0, $max)};
	}
	return $cod;
}
}

# Função responsável por gerar um código aleatório com 30 caracteres que serve de guia de identificação
if(!function_exists('geraCodReturnLimitado')) {
function geraCodReturnLimitado($limite_caractere)
{
	$CaracteresAceitos = 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
	$max = strlen($CaracteresAceitos)-1;
	$cod = null;
	for($i=0; $i < $limite_caractere; $i++) {
		$cod .= $CaracteresAceitos{mt_rand(0, $max)};
	}
	return $cod;
}
}

# Função responsável por gerar um código aleatório com 30 caracteres que serve de guia de identificação
if(!function_exists('geraIdChamado')) {
function geraIdChamado() 
{
	$CaracteresAceitos = '123456789';
	$max = strlen($CaracteresAceitos)-1;
	$cod = null;
	for($i=0; $i < 5; $i++) {
		$cod .= $CaracteresAceitos{mt_rand(0, $max)};
	}
	return strtoupper($cod);
}
}

# Função responsável por gerar um código aleatório com caracteres numéricos
if(!function_exists('geraCodNumero')) {
function geraCodNumero($tamanho=6) 
{
	$CaracteresAceitos = '123456789';
	$max = strlen($CaracteresAceitos)-1;
	$cod = null;
	for($i=0; $i < $tamanho; $i++) {
		$cod .= $CaracteresAceitos{mt_rand(0, $max)};
	}
	return strtoupper($cod);
}
}

# Função responsável por substituição de caracteres inválidos em uma sentença
if(!function_exists('remover_caracter')) {
function remover_caracter($string) 
{
	$string = preg_replace("/[áàâãä]/", "a", $string);
	$string = preg_replace("/[ÁÀÂÃÄ]/", "A", $string);
	$string = preg_replace("/[éèê]/", "e", $string);
	$string = preg_replace("/[ÉÈÊ]/", "E", $string);
	$string = preg_replace("/[íì]/", "i", $string);
	$string = preg_replace("/[ÍÌ]/", "I", $string);
	$string = preg_replace("/[óòôõö]/", "o", $string);
	$string = preg_replace("/[ÓÒÔÕÖ]/", "O", $string);
	$string = preg_replace("/[úùü]/", "u", $string);
	$string = preg_replace("/[ÚÙÜ]/", "U", $string);
	$string = preg_replace("/[ç/", "c", $string);
	$string = preg_replace("/Ç/", "C", $string);
	$string = preg_replace("/[][><}{)(:;,!?*%~^`&#@]/", "", $string);
	$string = preg_replace("/ /", "_", $string);
	return $string;
}
}

# Função responsável por substituição de caracteres inválidos em uma sentença
if(!function_exists('transformaCaractere')) {
function transformaCaractere($var) 
{
	$var = caracteres_especiais($var,"ler");
	
	$sizeName = strlen($var); // tamanho do texto	
	$var = utf8_encode($var);
	$var = utf8_decode($var);
	$var = strtolower($var);

	$var = str_replace("&quot;","-",$var); // script de substituição				
	$var = str_replace("&apos;","-",$var); // script de substituição				

	$var = str_replace("á","a",$var); // script de substituição				
	$var = str_replace("ã","a",$var); // script de substituição				
	$var = str_replace("â","a",$var); // script de substituição				
	$var = str_replace("à","a",$var); // script de substituição				
	$var = str_replace("é","e",$var); // script de substituição				
	$var = str_replace("ê","e",$var); // script de substituição				
	$var = str_replace("í","i",$var); // script de substituição				
	$var = str_replace("î","i",$var); // script de substituição				
	$var = str_replace("ó","o",$var); // script de substituição				
	$var = str_replace("ò","o",$var); // script de substituição				
	$var = str_replace("ô","o",$var); // script de substituição				
	$var = str_replace("õ","o",$var); // script de substituição				
	$var = str_replace("ú","u",$var); // script de substituição				
	$var = str_replace("û","u",$var); // script de substituição				
	$var = str_replace("ç","c",$var); // script de substituição				

	$var = str_replace("Á","a",$var); // script de substituição				
	$var = str_replace("Ã","a",$var); // script de substituição				
	$var = str_replace("Â","a",$var); // script de substituição				
	$var = str_replace("À","a",$var); // script de substituição				
	$var = str_replace("É","e",$var); // script de substituição				
	$var = str_replace("Ê","e",$var); // script de substituição				
	$var = str_replace("Í","i",$var); // script de substituição				
	$var = str_replace("Î","i",$var); // script de substituição				
	$var = str_replace("Ó","o",$var); // script de substituição				
	$var = str_replace("Ò","o",$var); // script de substituição				
	$var = str_replace("Ô","o",$var); // script de substituição				
	$var = str_replace("Õ","o",$var); // script de substituição				
	$var = str_replace("Ú","u",$var); // script de substituição				
	$var = str_replace("Û","u",$var); // script de substituição				
	$var = str_replace("Ç","c",$var); // script de substituição				

	$var = str_replace(" ","-",$var); // script de substituição				

	$var = str_replace("/","-",$var); // script de substituição				
	$var = str_replace("'","-",$var); // script de substituição				
	$var = str_replace("\"","-",$var); // script de substituição				
	$var = str_replace("(","-",$var); // script de substituição				
	$var = str_replace(")","-",$var); // script de substituição				
	$var = str_replace("?","-",$var); // script de substituição				
	$var = str_replace(":","-",$var); // script de substituição				
	$var = str_replace(",","-",$var);  // script de substituição				
	$var = str_replace("!","-",$var);  // script de substituição				
	$var = str_replace("@","-",$var);  // script de substituição				
	$var = str_replace("#","-",$var);  // script de substituição				
	$var = str_replace("$","-",$var);  // script de substituição				
	$var = str_replace("¨","-",$var);  // script de substituição				
	$var = str_replace("&","-",$var);  // script de substituição				
	$var = str_replace("*","-",$var);  // script de substituição				
	$var = str_replace("_","-",$var);  // script de substituição				
	$var = str_replace("+","-",$var);  // script de substituição				
	$var = str_replace("}","-",$var);  // script de substituição				
	$var = str_replace("{","-",$var);  // script de substituição				
	$var = str_replace("]","-",$var);  // script de substituição				
	$var = str_replace("[","-",$var);  // script de substituição				
	$var = str_replace("^","-",$var);  // script de substituição				
	$var = str_replace("~","-",$var);  // script de substituição				
	$var = str_replace("/","-",$var);  // script de substituição				
	$var = str_replace(";","-",$var);  // script de substituição				
	$var = str_replace(">","-",$var);  // script de substituição				
	$var = str_replace("<","-",$var);  // script de substituição				
	$var = str_replace("'","-",$var);  // script de substituição				
	$var = str_replace("´","-",$var);  // script de substituição				
	$var = str_replace("`","-",$var);  // script de substituição				
	$var = str_replace("°","-",$var);  // script de substituição				
	$var = str_replace("º","-",$var);  // script de substituição				
	$var = str_replace("ª","-",$var);  // script de substituição				
	$var = str_replace("%","-",$var);  // script de substituição				
	$var = str_replace(".","-",$var);  // script de substituição				
	$var = str_replace("----","-",$var);  // script de substituição				
	$var = str_replace("---","-",$var);  // script de substituição				
	$var = str_replace("--","-",$var);  // script de substituição				

	return $var;
}
}

# Função responsável por substituição de caracteres inválidos em uma sentença
if(!function_exists('toMaiuscula')) {
function toMaiuscula($var) 
{
	$sizeName = strlen($var); // tamanho do texto	
	$var = utf8_encode($var);
	$var = utf8_decode($var);
	$var = strtolower($var);

	$var = str_replace("&quot;","",$var); // script de substituição				
	$var = str_replace("&apos;","",$var); // script de substituição				

	$var = str_replace("á","Á",$var); // script de substituição				
	$var = str_replace("ã","Ã",$var); // script de substituição				
	$var = str_replace("â","Â",$var); // script de substituição				
	$var = str_replace("à","À",$var); // script de substituição				
	$var = str_replace("é","É",$var); // script de substituição				
	$var = str_replace("ê","Ê",$var); // script de substituição				
	$var = str_replace("í","Í",$var); // script de substituição				
	$var = str_replace("î","Î",$var); // script de substituição				
	$var = str_replace("ó","Ó",$var); // script de substituição				
	$var = str_replace("ò","Ò",$var); // script de substituição				
	$var = str_replace("ô","Ô",$var); // script de substituição				
	$var = str_replace("õ","Õ",$var); // script de substituição				
	$var = str_replace("ú","Ú",$var); // script de substituição				
	$var = str_replace("û","Û",$var); // script de substituição				
	$var = str_replace("ç","Ç",$var); // script de substituição				

	return $var;
}
}

if(!function_exists('marcaDagua')) {
function marcaDagua($imageUp,$caminho) 
{
	#variavel que recebe a url/caminho da imagem
	$filename = "".$caminho."".$imageUp."";
	header('Content-type: image/jpg');
	
	#dados da mascara [caminho do arquivo que serve de mascara]
	$marca =  "../img/marcadagua.png";
	$imagem_marca =   ImageCreateFromGif($marca);
	$pontoX1 =   ImagesX($imagem_marca);
	$pontoY1 =   ImagesY($imagem_marca);
	
	#recupera as dimensoes da imagem
	list($width, $height) = getimagesize($filename);
	
	#redesenhando a imagem
	$image_p = imagecreatetruecolor($width, $height);
	$image = imagecreatefromjpeg($filename);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
	
	#Habilitando a opcao abaixo irá criar a mascara com a imagem marca d'agua
	ImageCopyMerge($image_p, $imagem_marca, 160, 90, 0, 0, $pontoX1, $pontoY1, 80);
	
	imagejpeg($image_p, null, 100);
	imagedestroy($image_p);
}
}

#Função para enviar um único arquivo
if(!function_exists('uploadArquivoComReturn')) {
function uploadArquivoComReturn($caminho,$arquivo) 
{
	
	if(trim($_FILES["".$arquivo.""]["name"])=="") {
	} else {
		if ($_FILES["".$arquivo.""]["error"] === 0)  {  
			@ move_uploaded_file($_FILES["".$arquivo.""]["tmp_name"],"./{$caminho}/{$_FILES["".$arquivo.""]["name"]}");

			$fileUpload =  $_FILES["".$arquivo.""]["name"];
		}
	}
	
	return $fileUpload;
}
}

if(!function_exists('explodeGaleria')) {
function explodeGaleria($mod,$id,$caminhoUpload,$fileUpload) 
{

	$filezip = substr("$fileUpload",0,-4);
	$moduloPai = substr("$mod",0,-7);
	$montaCampo = "id".$moduloPai."";
	echo $montaCampo;
	$qtd_fotos = mysql_num_rows(mysql_query("SELECT * FROM $mod WHERE $montaCampo='$id'"));

	$archive = new PclZip("".$caminhoUpload."/".$fileUpload."");
	if (($v_result_list = $archive->extract(PCLZIP_OPT_PATH, "".$caminhoUpload."",PCLZIP_OPT_REMOVE_PATH, "install/release")) == 0) {
		die("Error : ".$archive->errorInfo(true));
	}

	$narray = sizeof($v_result_list);
	$ordem = $qtd_fotos;
	for($i=0;$i < $narray; $i++) {
		$ordem = $ordem + 1;
		$file = $v_result_list[$i]["stored_filename"];
		$nome = substr("$file",0,-4);
		
		$data = date("Y-m-d H:i:s");
		$insert_foto = mysql_query("INSERT INTO $mod (idsysusu,$montaCampo,ordem,nome,arquivo,data,dataModificacao,stat,lixo) VALUES ('$usuario[id]','$id','$ordem','sem legenda','$file','$data','$data','1','0')");
	}

	unlink("".$caminhoUpload."/".$fileUpload."");

}
}

#Função para transformação da data
if(!function_exists('tempoOff')) {
function tempoOff($idGet) 
{
	$usuario_atual = mysql_fetch_array(mysql_query("SELECT * FROM sysusu_logado WHERE idsysusu='".$idGet."'"));
	 
	$dia_inicio = substr($usuario_atual['data'],8,2);
	$mes_inicio = substr($usuario_atual['data'],5,2);
	$ano_inicio = substr($usuario_atual['data'],0,4);
	$hor_inicio = substr($usuario_atual['data'],11,2);
	$min_inicio = substr($usuario_atual['data'],14,2);
	$seg_inicio = substr($usuario_atual['data'],17,2);
	$inicio = mktime($hor_inicio,$min_inicio,$seg_inicio,$mes_inicio,$dia_inicio,$ano_inicio);
	
	$dia_fim = date("d");
	$mes_fim = date("m");
	$ano_fim = date("Y");
	$hor_fim = date("H");
	$min_fim = date("i");
	$seg_fim = date("s");
	$fim = mktime($hor_fim,$min_fim,$seg_fim,$mes_fim,$dia_fim,$ano_fim);
	
	$diferenca = $fim - $inicio;
	return $diferenca;
}
}

#Função para transformação da data
if(!function_exists('normalTOdate')) {
function normalTOdate($dataVar) 
{
	$d  = substr($dataVar,0,2);
	$m  = substr($dataVar,3,2);
	$a  = substr($dataVar,6,4);

	$dataCorreta = "".$a."-".$m."-".$d."";
	return "".$dataCorreta."";
}
}

#Função para transformação da data
if(!function_exists('normalTOdateComHora')) {
function normalTOdateComHora($dataVar) 
{
	$d  = substr($dataVar,0,2);
	$m  = substr($dataVar,3,2);
	$a  = substr($dataVar,6,4);
	$h = substr($dataVar,11,8);

	$dataCorreta = "".$a."-".$m."-".$d." ".$h."";
	return "".$dataCorreta."";
}
}

#Função para transformação da data
if(!function_exists('ajustaDataSemHora')) {
function ajustaDataSemHora($dataVar,$formatacao) 
{
	$d  = substr($dataVar,8,2);
	$m  = substr($dataVar,5,2);
	$a  = substr($dataVar,0,4);

	$arrayData = mktime(0,0,0,$m,$d,$a);
	$dataCorreta = date("".$formatacao."", $arrayData);
	echo "".$dataCorreta."";
}
}

#Função para transformação da data
if(!function_exists('ajustaData')) {
function ajustaData($dataVar,$formatacao) 
{
	$d  = substr($dataVar,8,2);
	$m  = substr($dataVar,5,2);
	$a  = substr($dataVar,0,4);
	$h = substr($dataVar,11,19);

	$arrayData = mktime(0,0,0,$m,$d,$a);
	$dataCorreta = date("".$formatacao."", $arrayData);
	$dataCorreta = str_replace("-","/",$dataCorreta);
	echo "".$dataCorreta." ".$h."";
}
}

#Função para transformação da data
if(!function_exists('ajustaDataSemHoraReturn')) {
function ajustaDataSemHoraReturn($dataVar,$formatacao="Y-m-d") 
{
	if(trim($dataVar)=="0000-00-00" || trim($dataVar)=="" || trim($dataVar)=="1999-11-30") {
		$dataCorreta = "";
	} else {
		$d  = substr($dataVar,8,2);
		$m  = substr($dataVar,5,2);
		$a  = substr($dataVar,0,4);
	
		$arrayData = mktime(0,0,0,$m,$d,$a);
		$dataCorreta = date("".$formatacao."", $arrayData);
	}

	return $dataCorreta;
}
}

#Função para transformação da data
if(!function_exists('ajustaDataSemDataReturn')) {
function ajustaDataSemDataReturn($dataVar,$formatacao="Y-m-d") 
{
	$hora  = substr($dataVar,11,8);

	return $hora;
}
}

#Função para transformação da data
if(!function_exists('ajustaDataReturn')) {
function ajustaDataReturn($dataVar,$formatacao) 
{
	if(trim($dataVar)=="" || trim($dataVar)=="0000-00-00 00:00:00" || trim($dataVar)=="1999-11-30 00:00:00") {
		return "";
	} else {
		
		$d  = substr($dataVar,8,2);
		$m  = substr($dataVar,5,2);
		$a  = substr($dataVar,0,4);
		$h = substr($dataVar,11,5);
		
		if(trim($m)=="" || trim($d)=="" || trim($a)=="") {
			return "Data informada está incorreta";
		} else {
			$arrayData = mktime(0,0,0,$m,$d,$a);
			$dataCorreta = date("".$formatacao."", $arrayData);
		
			return "".$dataCorreta." ".$h."";
		}
	}
}
}

#Função para transformação da data
if(!function_exists('ajustaDataHoraCurtaReturn')) {
function ajustaDataHoraCurtaReturn($dataVar,$formatacao) 
{
	$d  = substr($dataVar,8,2);
	$m  = substr($dataVar,5,2);
	$a  = substr($dataVar,0,4);
	$h = substr($dataVar,11,5);

	$arrayData = mktime(0,0,0,$m,$d,$a);
	$dataCorreta = date("".$formatacao."", $arrayData);

	return "".$dataCorreta." ".$h."";
}
}

#Função para transformação da data para DATETIME
if(!function_exists('ajustaDataMYSQL')) {
function ajustaDataMYSQL($dataVar,$posdia,$posmes,$tipoHora) 
{
	$d  = substr($dataVar,$posdia,2);
	$m  = substr($dataVar,$posmes,2);
	$a  = substr($dataVar,6,4);

	if($tipoHora=="inicio") {
		$h="00:00:00";
	} else {
		$h="23:59:59";
	}

	$dataMYSQL = "".$a."-".$m."-".$d." ".$h."";

	return $dataMYSQL;
}
}

# Função responsável por gravar as ações realizadas dentro do sistema
if(!function_exists('gravaLog')) {
function gravaLog($perfilSet,$idSet,$acaoSet,$localSet,$descricaoSet,$dataSet) 
{
	$log = mysql_query("INSERT INTO syslog (perfil,idsysusu,acao,local,detalhe,data) VALUES ('$perfilSet','$idSet','$acaoSet','$localSet','$descricaoSet','$dataSet')");
}
}

# Função para alterar fonte Maiuscula ou Minuscula
if(!function_exists('upperOrLower')) {
function upperOrLower($palavra,$tipo) 
{
	$retorno = transformaCaractere($palavra);
	if($tipo=="0") {
		$convertido = strtolower($retorno);
	} else {
		$convertido = strtoupper($retorno);
	}
	return $convertido;
}
}

# Função responsável por criação de pasta de galeria
if(!function_exists('criaPasta')) {
function criaPasta($nomePasta,$tipo,$local) 
{
	
	global $hostFTP;
	global $userFTP;
	global $senhaFTP;
	global $adminRootFTP;
	
	// set the various variables
	$ftproot = "".$adminRootFTP."".$local."/".$tipo."/";
	
	// connect to the destination FTP & enter appropriate directories both locally and remotely
	$ftpc = ftp_connect($hostFTP);
	$ftpr = ftp_login($ftpc,$userFTP,$senhaFTP);
	
	if ((!$ftpc) || (!$ftpr)) { echo "FTP connection not established!"; die(); }
	
	ftp_mkdir($ftpc,$ftproot.$nomePasta);
	ftp_chmod($ftpc, 0777, $ftproot.$nomePasta);
	
	// close the FTP connection
	ftp_close($ftpc);

}
}

# Função responsável por criação de pasta de galeria
if(!function_exists('criaPastaComCaminho')) {
function criaPastaComCaminho($caminho,$nomePasta) 
{
	
	global $hostFTP;
	global $userFTP;
	global $senhaFTP;
	global $adminRootFTP;
	
	// set the various variables
	$ftproot = "".$adminRootFTP."".$caminho."/";
	
	// connect to the destination FTP & enter appropriate directories both locally and remotely
	$ftpc = ftp_connect($hostFTP);
	$ftpr = ftp_login($ftpc,$userFTP,$senhaFTP);
	
	if ((!$ftpc) || (!$ftpr)) { echo "FTP connection not established!"; die(); }
	
	ftp_mkdir($ftpc,$ftproot.$nomePasta);
	ftp_chmod($ftpc, 0777, $ftproot.$nomePasta);
	
	// close the FTP connection
	ftp_close($ftpc);

}
}

# Função responsável por criação de pasta de galeria
if(!function_exists('criaPastaComCaminhoNativo')) {
function criaPastaComCaminhoNativo($caminho,$nomePasta) 
{
	
	global $adminRootFTP;
	
	// set the various variables
	#$ftproot = "".$adminRootFTP."".$caminho."".$nomePasta."/";
	$ftproot = "".$caminho."".$nomePasta."/";
	
	mkdir("".$ftproot."", 0777);
	chmod("".$ftproot."", 0777);

}
}
 
# Função responsável por remoção de pasta de galeria
if(!function_exists('removePasta')) {
function removePasta($idGaleria,$tipo,$local) 
{

	global $hostFTP;
	global $userFTP;
	global $senhaFTP;
	global $adminRootFTP;

	$tipoSet = mysql_fetch_array(mysql_query("SELECT * FROM $tipo WHERE id='$idGaleria'"));
	$final = "".$tipoSet['pasta']."/";

	// connect to the destination FTP & enter appropriate directories both locally and remotely
	$ftpc = ftp_connect($hostFTP);
	$ftpr = ftp_login($ftpc,$userFTP,$senhaFTP);
	
	if ((!$ftpc) || (!$ftpr)) { echo "FTP connection not established!"; die(); }

	// set the various variables
	$ftproot = "".$adminRootFTP."".$local."/".$tipo."/";

	ftp_rmdir($ftpc,$ftproot.$final);

	// close the FTP connection
	ftp_close($ftpc);
}
}

# Função responsável por explosão de array
if(!function_exists('mostra_tudo')) {
function mostra_tudo($curarray,$startglue,$endglue,$fimglue,$withkeys=false) 
{
	foreach($curarray as $curkey => $curvalue) {
		if (is_array($curvalue)) {
			$curvalue = mul_dim_implode($curvalue,$startglue,$endglue,$fimglue,$withkeys);
		}
		if (!isset($retu)) {
			if ($withkeys) {
				$retu = $startglue.$curkey.$fimglue;
			} else {
				$retu = $startglue.$curvalue.$endglue;
			}
		} else {
			$result = count($curarray);
			$result = $result - 1;
			if ($withkeys) {
				$retu .= $startglue.$curvalue.$endglue;
			} else {
				if($i < $result ) {
					$retu .= $startglue.$curvalue.$endglue;
				} else {
					$retu .= $startglue.$curvalue.$fimglue;
				}
			}
		}
		$i++;
	}
	return $retu;
}
}

# Função de INSERT (mysql)
if(!function_exists('insert')) {
function insert($post,$db,$idsysusuSend=0) 
{
	

	$a = "'$";
	$b = "_";
	$c = "POST[";
	$post = array_slice($post,5);
	$campo = array();
	$valor = array();
	foreach ($post as $cmp => $value) {
		array_push($campo, $cmp);
		array_push($valor, $value);
	}

	$valor = str_replace("\"","&quot;",$valor);
	$valor = str_replace("'","\'",$valor);

	$second = mostra_tudo($valor,"'","',","'");
	$first = implode(",",$campo);
	
	$sql  = "INSERT INTO";
	$sql .= " ".$linguagem_set."".$db."";
	$sql .= " (";
	$sql .= "$first";
	$sql .= " )";
	$sql .= " ";
	$sql .= " VALUES";
	$sql .= " (";
	$sql .= " $second";
	$sql .= " )";
	if($idsysusuSend=="1") {
		echo"<br><br>";
		echo"$sql";
	}
	$res = mysql_query($sql);
	
}
}

# Função de UPDATE (mysql)
if(!function_exists('update')) {
function update($post,$db,$id,$idsysusuSend=0) 
{
	
	global $sysusu;
	
	$a = "'";
	$b = "_";
	$c = "POST[";
	$post = array_slice($post,6);
	$tudo1 = array();
	$tudo2 = array();
	foreach ($post as $cmp => $value) {

		$value = str_replace("\"","&quot;",$value);
		$value = str_replace("'","\'",$value);
	
		array_push($tudo1,"",$cmp,"='", $value,"'");
		array_push($tudo2,",",$cmp,"='", $value,"'");
	}
	$output1 = array_slice($tudo1, 0, 5);
	$first = implode("",$output1);
	$output2 = array_slice($tudo2, 5);
	$second = implode("",$output2);
	
	$sql  = "UPDATE";
	$sql .= " ".$linguagem_set."".$db."";
	$sql .= " SET ";
	$sql .= "$first";
	$sql .= "$second";
	$sql .= " WHERE id = $a$id$a";

	if($idsysusuSend=="1") {
		echo"<br><br>";
		echo"$sql";
	}
	$res = mysql_query($sql);

}
}

?>