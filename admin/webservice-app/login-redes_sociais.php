<?
if(trim($rSqlEmpresa['stat'])=="0") {
	$campos["data"] = array("retorno" => "login-incorreto", "id" => "0", "msg" => "Não foi possível realizar o login, por favor, verifique E-mail, CPF ou Senha informados!"); 
} else if(trim($CadastroLoginSet)=="0" || trim($CadastroLoginSet)=="2") {
	$campos["data"] = array("retorno" => "login-incorreto", "id" => "0", "msg" => "Pedimos desculpa, mas estamos realizando uma manutenção, realize seu acesso pelo site!"); 
} else {
	$emailGet = str_replace(" ","",$emailGet);
	$nSqlPessoa = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM pessoas WHERE email='".$emailGet."' AND empresa_token='".trim($empresa_tokenGet)."'"));
	if($nSqlPessoa[0]>0) {
		$rSqlPessoa = mysql_fetch_array(mysql_query("SELECT numeroUnico,imagem_perfil_base64 FROM pessoas WHERE email='".$emailGet."' AND empresa_token='".trim($empresa_tokenGet)."'"));
		if(trim($photo_redesGet)=="") { 
			$campo_update = "";
		} else {
			if(trim($rSqlPessoa['imagem_perfil_base64'])=="") { 
				$campo_update = "";
			} else {
				$photo_redes_b64 = file_get_contents("".$photo_redesGet.""); 
				$imagem_perfil_base64Get = base64_encode("".$photo_redes_b64."");
				$campo_update = "imagem_perfil_base64='".$imagem_perfil_base64Get."',";
			}
		}
		$update = mysql_query("
								UPDATE 
									pessoas 
								SET 
									".$campo_update."
									".$tipo_redesGet."='".$token_redesGet."',
									dataModificacao='".$data."'
								WHERE 
									numeroUnico='".$rSqlPessoa['numeroUnico']."'
								");
		$numeroUnicoSet = $rSqlPessoa['numeroUnico'];
	} else {
		if(trim($photo_redesGet)=="") { 
			$campo_insert_1 = "";
			$campo_insert_2 = "";
		} else {
			$photo_redes_b64 = file_get_contents("".$photo_redesGet.""); 
			$imagem_perfil_base64Get = base64_encode("".$photo_redes_b64."");
			$campo_insert_1 = "imagem_perfil_base64,";
			$campo_insert_2 = "'".$imagem_perfil_base64Get."',";
		}
		
		$numeroUnicoSet = geraCodReturn();
		$insert = mysql_query("INSERT INTO pessoas  (idsysusu,
													 empresa,
													 empresa_token,
													 numeroUnico,
													 nome,
													 tipo_documento,
													 email,
													 ".$tipo_redesGet.",
													 ".$campo_insert_1."
													 stat,
													 data,
													 dataModificacao) 
													 VALUES 
													('0',
													 '".$rSqlEmpresa['id']."',
													 '".$rSqlEmpresa['token']."',
													 '".$numeroUnicoSet."',
													 '".$nomeGet."',
													 'cpf',
													 '".$emailGet."',
													 '".$token_redesGet."',
													 ".$campo_insert_2."
													 '1',
													 '".$data."',
													 '".$data."')");
	}
	
	$rSql = mysql_fetch_array(mysql_query("
											SELECT 
												mod_pessoas.id, 
												mod_pessoas.empresa, 
												mod_pessoas.empresa_token, 
												mod_pessoas.numeroUnico,
												mod_pessoas.nome,
												mod_pessoas.imagem_perfil_base64,
												mod_pessoas.imagem_de_capa_base64,
												mod_pessoas.genero,
												mod_pessoas.tipo_documento,
												mod_pessoas.documento,
												mod_pessoas.whatsapp,
												mod_pessoas.aceita_whatsapp,
												mod_pessoas.telefone,
												mod_pessoas.email,
												mod_pessoas.data_de_nascimento,
	
												mod_pessoas.usuario,
												mod_pessoas.status_do_perfil,
												
												mod_pessoas.cidade_id,

												mod_pessoas.nome_da_mae,

												mod_pessoas.cep,
												mod_pessoas.rua,
												mod_pessoas.numero,
												mod_pessoas.complemento,
												mod_pessoas.estado,
												mod_pessoas.cidade,
												mod_pessoas.bairro,
												mod_pessoas.latitude,
												mod_pessoas.longitude
											FROM 
												pessoas AS mod_pessoas 
											WHERE 
												mod_pessoas.numeroUnico='".$numeroUnicoSet."'
											"));
				
	
	if(trim($rSql['id'])=="") {
		$campos["data"] = array("id" => "0", "msg" => "Não foi possível realizar o login, por favor, verifique E-mail, CPF ou Senha informados!"); 
	} else {
	
		if(trim($rSql['genero'])=="U" || trim($rSql['genero'])=="") {
			$generoSet = "Sem gênero definido";
		} elseif(trim($rSql['genero'])=="M") {
			$generoSet = "Masculino";
		} elseif(trim($rSql['genero'])=="F") {
			$generoSet = "Feminino";
		}
		
		$rSql['imagem_de_capa_base64'] = "".str_replace(" ","+",$rSql['imagem_de_capa_base64'])."";
		$rSql['imagem_de_capa_base64'] = "".str_replace("data:image/jpeg;base64,","",$rSql['imagem_de_capa_base64'])."";
	
		$rSql['imagem_perfil_base64'] = "".str_replace(" ","+",$rSql['imagem_perfil_base64'])."";
		$rSql['imagem_perfil_base64'] = "".str_replace("data:image/jpeg;base64,","",$rSql['imagem_perfil_base64'])."";
		
		if($nSqlPessoas[0]>1) {
			$local_setadoSet = "NAO";
		} else {
			$local_setadoSet = "".$rSql['empresa_token']."";
		}
		
		$campos["data"] = array(
								"retorno" => "sucesso",
								"id" => "".$rSql['id']."", 
								"logado" => "online", 
		
								"qtd_cadastros" => $nSqlPessoas[0], 
								"local_setado" => "".$local_setadoSet."", 
								"tipo_empresa" => "".$rSqlPlataforma['tipo_empresa']."", 
	
								"cliente" => $clienteSet,
								"profissional" => $profissionalSet,
								"navegacao" => "".$tipoNavegacao."",
								"empresa_token" => "".$rSql['empresa_token']."",
								"numeroUnico" => "".$rSql['numeroUnico']."",
								"nome" => "".$rSql['nome']."",
								"imagem_de_capa_base64" => "".$rSql['imagem_de_capa_base64']."",
								"imagem_perfil_base64" => "".$rSql['imagem_perfil_base64']."",
								"genero" => "".$rSql['genero']."",
								"genero_txt" => "".$generoSet."",
								"genero_label_form" => "".$generoLabelFormSet."",
								"genero_cor_label_form" => "".$corLabelFormSet."",
								"tipo_documento" => "".$rSql['tipo_documento']."",
								"documento" => "".$rSql['documento']."",
								"telefone" => "".$rSql['telefone']."",
								"email" => "".$rSql['email']."",
								"whatsapp" => "".$rSql['whatsapp']."",
								"aceita_whatsapp" => "".$rSql['aceita_whatsapp']."",
								"data_de_nascimento" => "".ajustaDataSemHoraReturn($rSql['data_de_nascimento'],"d/m/Y")."",
	
								"usuario" => "".$rSql['usuario']."",
								"status_do_perfil" => "".$rSql['status_do_perfil']."",
								
								"cidade_id" => "".$rSql['cidade_id']."",
	
								"nome_da_mae" => "".$rSql['nome_da_mae']."",

								"cep" => "".$rSql['cep']."",
								"rua" => "".$rSql['rua']."",
								"numero" => "".$rSql['numero']."",
								"complemento" => "".$rSql['complemento']."",
								"estado" => "".$rSql['estado']."",
								"cidade" => "".$rSql['cidade']."",
								"bairro" => "".$rSql['bairro']."",
								"latitude" => "".$rSql['latitude']."",
								"longitude" => "".$rSql['longitude'].""
								);
	}
}

$campos["msg"] = "Perfil recuperado com sucesso";
$campos["success"] = true;

#echo "<pre>";
echo json_encode($campos);
?>