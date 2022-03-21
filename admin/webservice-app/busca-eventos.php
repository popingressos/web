<?
if(trim($local_setadoGet)=="NAO" || trim($local_setadoGet)=="") {
	$empresa_tokenGet = $empresa_tokenGet;
} else {
	$empresa_tokenGet = $local_setadoGet;
}

if(trim($ativosGet)=="") {  
	$filtro1 = " ";
} else if(trim($ativosGet)=="0") {
	$filtro1 = " mod_eventos.stat='0' AND ";
} else if(trim($ativosGet)=="1") {
	$filtro1 = " mod_eventos.stat='1' AND ";
} else {
	$filtro1 = " ";
}

if(trim($searchGet)=="") {  
	$filtro2 = " ";
} else {
	$filtro2 = " mod_eventos.nome LIKE '%".$searchGet."%' AND ";
}

if(trim($webserviceSet)=="APP") {
	if(trim($todosGet)=="") {
		if(trim($rSqlPlataforma['exibicao_de_eventos'])=="sempre") {
			$todosGet = "1";
		} else if(trim($rSqlPlataforma['exibicao_de_eventos'])=="apenas_com_ticket") {
			$todosGet = "0";
		} else if(trim($rSqlPlataforma['exibicao_de_eventos'])=="apenas_com_ticket_e_venda") {
			$todosGet = "2";
		}
	} else {
		$todosGet = $todosGet;
	}
} else {
	$todosGet = $todosGet;
}

if(trim($latitude_atualGet)=="" || trim($longitude_atualGet)=="") {
	$qSql = mysql_query("
						SELECT 
							mod_eventos.id,
							mod_eventos.numeroUnico,
							mod_eventos.nome,
							mod_eventos.imagem_de_capa,
							mod_eventos.imagem_de_banner,
							mod_eventos.imagem_de_icone,
							mod_eventos.data_de_publicacao,
							mod_eventos.data_de_despublicacao,
							mod_eventos.tickets,
							mod_eventos.data_do_evento,

							mod_eventos.cep,
							mod_eventos.rua,
							mod_eventos.numero,
							mod_eventos.complemento,
							mod_eventos.estado,
							mod_eventos.cidade,
							mod_eventos.bairro,
							mod_eventos.latitude,
							mod_eventos.longitude

						FROM 
							eventos AS mod_eventos 
						WHERE 
							".$filtro1."
							".$filtro2."
							mod_eventos.empresa_token='".trim($empresa_tokenGet)."'
						ORDER BY 
							mod_eventos.data_do_evento 
						");
} else {
	$qSql = mysql_query("
						SELECT 
							mod_eventos.id,
							mod_eventos.numeroUnico,
							mod_eventos.nome,
							mod_eventos.imagem_de_capa,
							mod_eventos.imagem_de_banner,
							mod_eventos.imagem_de_icone,
							mod_eventos.data_de_publicacao,
							mod_eventos.data_de_despublicacao,
							mod_eventos.tickets,
							mod_eventos.data_do_evento,
							mod_eventos.numero_dose,

							mod_eventos.cep,
							mod_eventos.rua,
							mod_eventos.numero,
							mod_eventos.complemento,
							mod_eventos.estado,
							mod_eventos.cidade,
							mod_eventos.bairro,
							mod_eventos.latitude,
							mod_eventos.longitude,

							(6371 * acos(
							 cos( radians(".$latitude_atualGet.") )
							 * cos( radians( mod_eventos.latitude ) )
							 * cos( radians( mod_eventos.longitude ) - radians(".$longitude_atualGet.") )
							 + sin( radians(".$latitude_atualGet.") )
							 * sin( radians( mod_eventos.latitude ) ) 
							 )
							) AS distancia
						FROM 
							eventos AS mod_eventos 
						WHERE 
							".$filtro1."
							".$filtro2."
							mod_eventos.empresa_token='".trim($empresa_tokenGet)."'
						HAVING 
							distancia < 0.550
						ORDER BY 
							mod_eventos.data_do_evento 
						");

	$eventos_por_regiaoSet = "SIM";
}

					
while($rSql = mysql_fetch_array($qSql)) {

	$contLista = 0;
	$carrinhoArray = unserialize($rSql['tickets']);
	$carrinhoArray = array_sort($carrinhoArray, 'ticket_data', SORT_ASC);
	foreach ($carrinhoArray as $key => $value) {
		$contLista++;
	}

	if($contLista>0 || trim($todosGet)=="1") {
		$dataEventoSet = substr($rSql['data_do_evento'],0,10);
		$horaEventoSet = substr($rSql['data_do_evento'],11,5);
		$diasemana_numero = date('w', strtotime($dataEventoSet));
		$campos["data"][] = array(
									"tag" => "eventos", 
									"id" => "".$rSql['id']."", 
									"numeroUnico" => "".$rSql['numeroUnico']."", 
									"numeroUnico_evento" => "".$rSql['numeroUnico']."", 
									"nome" => "".$rSql['nome']."", 
									"name" => "".$rSql['nome']."", 
									"imagem_de_capa" => "".$rSql['imagem_de_capa']."", 
									"imagem_de_banner" => "".$rSql['imagem_de_banner']."", 
									"imagem_de_icone" => "".$rSql['imagem_de_icone']."", 
									"data_vinculacao_inicio" => "".$rSql['data_de_publicacao']."", 
									"data_vinculacao_fim" => "".$rSql['data_de_despublicacao']."", 

									"cep" => "".$rSql['cep']."",
									"rua" => "".$rSql['rua']."",
									"numero" => "".$rSql['numero']."",
									"complemento" => "".$rSql['complemento']."",
									"estado" => "".$rSql['estado']."",
									"cidade" => "".$rSql['cidade']."",
									"bairro" => "".$rSql['bairro']."",
									"latitude" => "".$rSql['latitude']."",
									"longitude" => "".$rSql['longitude']."",
									"distancia" => "".$rSql['distancia']."",
			
									"text" => "".ajustaDataSemHoraReturn($rSql['data_do_evento'],"d/m/Y")." - ".$diasemana[$diasemana_numero]."", 
									"description" => "".$rSql['local'].""
								);
	}
}

if(count($campos)>0) {
	$campos["msg"] = "Eventos recuperados com sucesso";
	$campos["success"] = true;
} else {
	$campos["data"] = array("retorno" => "indisponiveis", "msg" => "Sem eventos disponíveis para exibição para ".$latitude_atualGet." e ".$longitude_atualGet."");
	$campos["msg"] = "Sem eventos disponíveis para exibição";
	$campos["success"] = true;
}
#echo "<pre>";
echo json_encode($campos);
?>