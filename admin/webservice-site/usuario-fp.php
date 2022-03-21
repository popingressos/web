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
					LIMIT 1
					");
					
while($rSql = mysql_fetch_array($qSql)) {
	$rSql['cartao_numero'] = str_replace(" ","",$rSql['cartao_numero']);
	$cartaoNumero1 = substr($rSql['cartao_numero'],0,4);
	$cartaoNumero2 = substr($rSql['cartao_numero'],12,4);
	
	$capaFpSet = "".$link_site."img/fp/".$rSql['cartao_bin'].".png";

	$campos["data"][] = array(
								"tag" => "usuario_fp", 
								"id" => "".$rSql['id']."", 
								"numeroUnico" => "".$rSql['numeroUnico']."", 
								"fp_tipo" => "online", 
								"cartao_bin" => "".$rSql['cartao_bin']."", 
								"cartao_numero" => "".$cartaoNumero1." **** **** ".$cartaoNumero2."", 
								"cartao_validade" => "".$rSql['cartao_validade']."", 
								"cartao_cvv" => "".$rSql['cartao_cvv']."", 
								"titular_nome" => "".$rSql['titular_nome']."", 
								"titular_cpf" => "".$rSql['titular_cpf']."", 
								"cartao_imagem" => "".$capaFpSet."", 
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