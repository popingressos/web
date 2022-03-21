<?
$qSql = mysql_query("
					SELECT 
						mod_endereco.id,
						mod_endereco.numeroUnico,
						mod_endereco.latitude,
						mod_endereco.longitude,
						mod_endereco.cep,
						mod_endereco.nome,
						mod_endereco.rua,
						mod_endereco.numero,
						mod_endereco.complemento,
						mod_endereco.estado,
						mod_endereco.cidade,
						mod_endereco.bairro
					FROM 
						pessoas_endereco AS mod_endereco 
					WHERE 
						mod_endereco.stat='1' AND
						mod_endereco.pessoa='".$numeroUnico_usuarioGet."' AND
						mod_endereco.empresa_token='".trim($empresa_tokenGet)."'
					ORDER BY 
						mod_endereco.nome 
					");
					
while($rSql = mysql_fetch_array($qSql)) {
	#Montagem de endereço para retornar endereco_formatado
	$monta_endereco_formatado = "";
	$monta_endereco_formatado .= "".$rSql['rua']."";
	if(trim($rSql['numero'])=="") { } else { $monta_endereco_formatado .= ", ".$rSql['numero'].""; }
	if(trim($rSql['complemento'])=="") { } else { $monta_endereco_formatado .= " - ".$rSql['complemento'].""; }
	if(trim($rSql['bairro'])=="") { } else { $monta_endereco_formatado .= ". ".$rSql['bairro'].""; }
	if(trim($rSql['cidade'])=="") { } else { $monta_endereco_formatado .= " - ".$rSql['cidade'].""; }
	if(trim($rSql['estado'])=="") { } else { $monta_endereco_formatado .= "/".$rSql['estado'].""; }

	$campos["data"][] = array(
								"tag" => "enderecos", 
								"id" => "".$rSql['id']."", 
								"numeroUnico" => "".$rSql['numeroUnico']."", 
								"latitude" => "".$rSql['latitude']."", 
								"longitude" => "".$rSql['longitude']."", 
								"cep" => "".$rSql['cep']."", 
								"nome" => "".$rSql['nome']."", 
								"rua" => "".$rSql['rua']."", 
								"numero" => "".$rSql['numero']."", 
								"complemento" => "".$rSql['complemento']."", 
								"estado" => "".$rSql['estado']."", 
								"cidade" => "".$rSql['cidade']."", 
								"bairro" => "".$rSql['bairro']."", 
								"endereco_formatado" => "".$monta_endereco_formatado."", 
							);
}

if(count($campos)>0) {
	$campos["msg"] = "Endereços recuperados com sucesso";
	$campos["success"] = true;
} else {
	$campos["data"] = array("retorno" => "enderecos-indisponiveis");
	$campos["msg"] = "Sem endereços disponíveis para exibição";
	$campos["success"] = true;
}
#echo "<pre>";
echo json_encode($campos);
?>