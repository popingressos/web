<?
$documentoGet = preg_replace("/[^0-9]/", "", $documentoGet);

if(strlen($documentoGet)>11) {
	$tipo_documentoGet = "cnpj";
} else {
	$tipo_documentoGet = "cpf";
}

if(trim($estadoGet)=="") { 
	if(trim($id_cidadeGet)=="") { } else {
		$cidade = mysql_fetch_array(mysql_query("SELECT cidade FROM cepbr_cidade WHERE id_cidade='".$id_cidadeGet."'"));
		$cidadeGet = "".$cidade['cidade']."";
		$cidade_idGet = $id_cidadeGet;
	}
} else {
	if(trim($cidadeGet)=="") { } else {
		$cidade = mysql_fetch_array(mysql_query("SELECT id_cidade FROM cepbr_cidade WHERE cidade='".$cidadeGet."' AND uf='".$estadoGet."'"));
		$cidade_idGet = $cidade['id_cidade'];
	}
	if(trim($id_cidadeGet)=="") { } else {
		$cidade = mysql_fetch_array(mysql_query("SELECT cidade FROM cepbr_cidade WHERE id_cidade='".$id_cidadeGet."'"));
		$cidadeGet = "".$cidade['cidade']."";
		$cidade_idGet = $id_cidadeGet;
	}
}
if(trim($cidade_idGet)=="") { 
	if(trim($id_bairroGet)=="") { } else {
		$bairro = mysql_fetch_array(mysql_query("SELECT bairro FROM cepbr_bairro WHERE id_bairro='".$id_bairroGet."'"));
		$bairroGet = "".$bairro['bairro']."";
		$bairro_idGet = $id_bairroGet;
	}
} else {
	if(trim($bairroGet)=="") { } else {
		$bairro = mysql_fetch_array(mysql_query("SELECT id_bairro FROM cepbr_bairro WHERE bairro='".$bairroGet."' AND id_cidade='".$cidade_idGet."'"));
		$bairro_idGet = $bairro['id_bairro'];
	}
	if(trim($id_bairroGet)=="") { } else {
		$bairro = mysql_fetch_array(mysql_query("SELECT bairro FROM cepbr_bairro WHERE id_bairro='".$id_bairroGet."'"));
		$bairroGet = "".$bairro['bairro']."";
		$bairro_idGet = $id_bairroGet;
	}
}

$data_de_nascimentoGet = normalTOdate($data_de_nascimentoGet);
$data_de_aniversarioGet = substr($data_de_nascimentoGet,4,6);
$data_de_aniversarioGet = "0000".$data_de_aniversarioGet."";

if(trim($numeroUnico_profissionalGet)=="") {
	$numeroUnico_profissionalGet = "";
} else {
	$numeroUnico_profissionalGet = "|".$numeroUnico_profissionalGet."|";
}

#Montagem de endereço para retornar Latitude e Longitude
$monta_endereco_geo = "".str_replace(" ","%20",str_replace("-","",$cepGet))."";
$monta_endereco_geo .= ",".str_replace(" ","%20",$ruaGet)."";
if(trim($numeroGet)=="") { } else { $monta_endereco_geo .= ",".$numeroGet.""; }
if(trim($bairroGet)=="") { } else { $monta_endereco_geo .= ",".str_replace(" ","%20",$bairroGet).""; }
if(trim($cidadeGet)=="") { } else { $monta_endereco_geo .= ",".str_replace(" ","%20",$cidadeGet).""; }
if(trim($estadoGet)=="") { } else { $monta_endereco_geo .= ",".$estadoGet.""; }

$address = "".$monta_endereco_geo."";
$address = str_replace(" ","%20",$address);
$geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$address.'&key='.$GOOGLE_MAP_KEY_SET.'');
$output= json_decode($geocode);

$endereco_latSet = $output->results[0]->geometry->location->lat;
$endereco_lonSet = $output->results[0]->geometry->location->lng;

if(trim($numeroUnico_profissionalGet)=="" || trim($numeroUnico_profissionalGet)=="0") { $numeroUnico_profissionalGet = "0"; } else { $numeroUnico_profissionalGet = $numeroUnico_profissionalGet; }

$retorno_verifica_whatsapp = verificaWhatsApp("".$empresa_idSet."","".$whatsappGet."");

if(trim($retorno_verifica_whatsapp)=="SIM") {
	$whatsapp_validoSet = "1";
} else {
	$whatsapp_validoSet = "0";
}

$emailGet = str_replace(" ","",$emailGet);
if(trim($numeroUnico_eventoGet)=="") { 
	$email_validoSet = "0";
	$email_valido_checadoSet = "0";
} else {
	$retorno_verifica_email = verificaEmail("".$emailGet."");
	if($retorno_verifica_email=="valid") {
		$email_validoSet = "1";
		$email_valido_checadoSet = "1";
	} else {
		$email_validoSet = "0";
		$email_valido_checadoSet = "0";
	}
}

if(trim($numeroUnico_tipos_de_logradouroGet)=="") { 
	$numeroUnico_tipos_de_logradouroGet = "";
} else {
	$numeroUnico_tipos_de_logradouroGet = $numeroUnico_tipos_de_logradouroGet;
}

$rSqlPessoaObjeto = mysql_fetch_array(mysql_query("SELECT * FROM pessoas WHERE numeroUnico='".$numeroUnicoGet."'"));
if(trim($rSqlPessoaObjeto['objetoModificacoes'])=="") { 
	$modificacoesControle[] = array("tag" => "modificacoes", 
									"numeroUnico" => "".geraCodReturn()."", 
									"sysusu" => "".$rSqlPessoaObjeto['idsysusu']."", 
									"post" => $rSqlPessoaObjeto, 
									"data" => "".$rSqlPessoaObjeto['data']."");
} else {
	$modificacoesArray = unserialize($rSqlPessoaObjeto['objetoModificacoes']);
	foreach ($modificacoesArray as $key => $value) {
		$modificacoesControle[] = array("tag" => "modificacoes", 
										"numeroUnico" => "".$value['numeroUnico']."", 
										"sysusu" => "".$value['sysusu']."", 
										"post" => "".$value['post']."", 
										"data" => "".$value['data']."");
	}
}

$_POST_NOVO['empresa'] = $rSqlPessoaObjeto['empresa'];
$_POST_NOVO['empresa_token'] = $rSqlPessoaObjeto['empresa_token']; 
$_POST_NOVO['dataModificacao'] = $data; 
$_POST_NOVO['nome']= "".$nomeGet.""; 
$_POST_NOVO['documento']= "".$documentoGet."";
$_POST_NOVO['data_de_nascimento']= "".$data_de_nascimentoGet.""; 
$_POST_NOVO['data_de_aniversario']= "".$data_de_aniversarioGet.""; 
$_POST_NOVO['genero']= "".$generoGet."";
$_POST_NOVO['email']= "".$emailGet.""; 
$_POST_NOVO['telefone']= "".$telefoneGet.""; 
$_POST_NOVO['whatsapp']= "".$whatsappGet.""; 
$_POST_NOVO['aceita_whatsapp']= "".$aceita_whatsappGet."";
$_POST_NOVO['cep']= "".$cepGet.""; 
$_POST_NOVO['numeroUnico_tipos_de_logradouro']= "".$numeroUnico_tipos_de_logradouroGet.""; 
$_POST_NOVO['rua']= "".$ruaGet.""; 
$_POST_NOVO['numero']= "".$numeroGet.""; 
$_POST_NOVO['complemento']= "".$complementoGet.""; 
$_POST_NOVO['bairro_id']= "".$bairro_idGet.""; 
$_POST_NOVO['cidade_id']= "".$cidade_idGet.""; 
$_POST_NOVO['bairro']= "".$bairroGet.""; 
$_POST_NOVO['cidade']= "".$cidadeGet.""; 
$_POST_NOVO['estado']= "".$estadoGet.""; 
$_POST_NOVO['latitude']= "".$endereco_latSet.""; 
$_POST_NOVO['longitude']= "".$endereco_lonSet.""; 
$_POST_NOVO['nome_da_mae']= "".$nome_da_maeGet.""; 

$modificacoesControle[] = array("tag" => "modificacoes", 
								"numeroUnico" => "".geraCodReturn()."", 
								"sysusu" => "0", 
								"post" => $_POST_NOVO, 
								"data" => "".$data."");

$modificacoesControleSerial = serialize($modificacoesControle);

$update = mysql_query("
						UPDATE 
							pessoas 
						SET 
							nome='".$nomeGet."', 
							documento='".$documentoGet."',
							data_de_nascimento='".$data_de_nascimentoGet."', 
							data_de_aniversario='".$data_de_aniversarioGet."', 
							genero='".$generoGet."',
							email='".$emailGet."', 
							telefone='".$telefoneGet."', 
							whatsapp='".$whatsappGet."', 
							aceita_whatsapp='".$aceita_whatsappGet."',
							cep='".$cepGet."', 
							numeroUnico_tipos_de_logradouro='".$numeroUnico_tipos_de_logradouroGet."', 
							rua='".$ruaGet."', 
							numero='".$numeroGet."', 
							complemento='".$complementoGet."', 
							bairro_id='".$bairro_idGet."', 
							cidade_id='".$cidade_idGet."', 
							bairro='".$bairroGet."', 
							cidade='".$cidadeGet."', 
							estado='".$estadoGet."', 
							latitude='".$endereco_latSet."', 
							longitude='".$endereco_lonSet."', 
							
							nome_da_mae='".$nome_da_maeGet."', 
							dataModificacao='".$data."',
							objetoModificacoes='".$modificacoesControleSerial."' 
						WHERE 
							numeroUnico='".$numeroUnicoGet."'
						");

$campos["msg"] = "Solicitação concluída com sucesso";
$campos["success"] = true;

#echo "<pre>";
if(trim($_POST['Webservice'])=="") {
	echo json_encode($campos);
}
?>