<?
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
											".$filtro_login_pessoas."
										"));
			

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

$campos["msg"] = "Perfil recuperado com sucesso";
$campos["success"] = true;

#echo "<pre>";
echo json_encode($campos);
?>