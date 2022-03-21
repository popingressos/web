<?

$qSql = mysql_query("
					SELECT 
						mod_fp.id,
						mod_fp.numeroUnico,
						mod_fp.cartao_bin,
						mod_fp.cartao_numero,
						mod_fp.cartao_validade,
						mod_fp.cartao_cvv,
						mod_fp.titular_nome,
						mod_fp.titular_cpf
					FROM 
						pessoas_formas_de_pagamento AS mod_fp 
					WHERE 
						mod_fp.stat='1' AND
						mod_fp.pessoa='".$numeroUnico_usuarioGet."' AND
						mod_fp.empresa_token='".trim($empresa_tokenGet)."'
					ORDER BY 
						mod_fp.data DESC 
					");
					
while($rSql = mysql_fetch_array($qSql)) {
	$rSql['cartao_numero'] = str_replace(" ","",$rSql['cartao_numero']);
	$cartaoNumero1 = substr($rSql['cartao_numero'],0,4);
	$cartaoNumero2 = substr($rSql['cartao_numero'],12,4);
	
	$icone_32FpSet = "https:".$link_site."img/fp/".$rSql['cartao_bin'].".png";
	$icone_16FpSet = "https:".$link_site."img/fp/".$rSql['cartao_bin'].".png";

	$campos["data"][] = array(
								"tag" => "usuario_fps", 
								"id" => "".$rSql['id']."", 
								"numeroUnico" => "".$rSql['numeroUnico']."", 
								"fp_tipo" => "usuario_fp", 
								"cartao_bin" => "".$rSql['cartao_bin']."", 
								"cartao_numero" => "".$rSql['cartao_numero']."", 
								"cartao_numero_print" => "".$cartaoNumero1." **** **** ".$cartaoNumero2."", 
								"cartao_validade" => "".$rSql['cartao_validade']."", 
								"cartao_cvv" => "".$rSql['cartao_cvv']."", 
								"titular_nome" => "".$rSql['titular_nome']."", 
								"titular_cpf" => "".$rSql['titular_cpf']."", 
								"debito_credito" => true, 
								"solicitar_troco" => false, 
								"icone_32" => "".$icone_32FpSet."", 
								"icone_16" => "".$icone_16FpSet."", 
							);
}

if(count($campos)>0) {
	$campos["msg"] = "Formas de pagamento recuperadas com sucesso";
	$campos["success"] = true;
} else {
	$campos["data"] = array("retorno" => "fps-indisponiveis");
	$campos["msg"] = "Sem formas de pagamento disponíveis para exibição";
	$campos["success"] = true;
}
#echo "<pre>";
echo json_encode($campos);
?>