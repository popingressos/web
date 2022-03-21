<?

$qSql = mysql_query("
					SELECT 
						mod_endereco.id,
						mod_endereco.numeroUnico,
						mod_endereco.cep,
						mod_endereco.nome,
						mod_endereco.rua,
						mod_endereco.numero,
						mod_endereco.complemento,
						mod_endereco.estado,
						mod_endereco.cidade,
						mod_endereco.bairro,
						mod_endereco.latitude,
						mod_endereco.longitude
					FROM 
						pessoas_endereco AS mod_endereco 
					WHERE 
						mod_endereco.stat='1' AND
						mod_endereco.pessoa='".$numeroUnico_usuarioGet."' AND
						mod_endereco.empresa_token='".trim($empresa_tokenGet)."'
					ORDER BY 
						mod_endereco.nome
					LIMIT 1 
					");
					
while($rSql = mysql_fetch_array($qSql)) {
	$campos["data"][] = array(
								"tag" => "enderecos", 
								"id" => "".$rSql['id']."", 
								"numeroUnico" => "".$rSql['numeroUnico']."", 
								"cep" => "".$rSql['cep']."", 
								"nome" => "".$rSql['nome']."", 
								"rua" => "".$rSql['rua']."", 
								"numero" => "".$rSql['numero']."", 
								"complemento" => "".$rSql['complemento']."", 
								"estado" => "".$rSql['estado']."", 
								"cidade" => "".$rSql['cidade']."", 
								"bairro" => "".$rSql['bairro']."", 
								"latitude" => "".$rSql['latitude']."", 
								"longitude" => "".$rSql['longitude']."", 
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