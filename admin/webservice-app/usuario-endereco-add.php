<?
$numeroUnicoGet = geraCodReturn();

if(trim($bairroGet)=="") { } else {
	$bairro = mysql_fetch_array(mysql_query("SELECT id_bairro FROM cepbr_bairro WHERE bairro='".$bairroGet."'"));
	$bairro_idGet = $bairro['id_bairro'];
}
if(trim($cidadeGet)=="") { } else {
	$cidade = mysql_fetch_array(mysql_query("SELECT id_cidade FROM cepbr_cidade WHERE cidade='".$cidadeGet."'"));
	$cidade_idGet = $cidade['id_cidade'];
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

$insert = mysql_query("INSERT INTO pessoas_endereco ( numeroUnico,
													  empresa,
													  empresa_token,
													  pessoa,
													  nome,
													  cep,
													  rua,
													  numero,
													  complemento,
													  estado,
													  cidade,
													  bairro,
													  cidade_id,
													  bairro_id,
													  latitude,
													  longitude,
													  stat,
													  data,
													  dataModificacao) 
													  VALUES 
													 ('".$numeroUnicoGet."',
													  '".$rSqlEmpresa['id']."',
													  '".$rSqlEmpresa['token']."',
													  '".$numeroUnico_usuarioGet."',
													  '".$nomeGet."',
													  '".$cepGet."',
													  '".addslashes($ruaGet)."',
													  '".$numeroGet."',
													  '".addslashes($complementoGet)."',
													  '".$estadoGet."',
													  '".$cidadeGet."',
													  '".$bairroGet."',
													  '".$cidade_idGet."',
													  '".$bairro_idGet."',
													  '".$endereco_latSet."',
													  '".$endereco_lonSet."',
													  '1',
													  '".$data."',
													  '".$data."')");

$campos["data"] = array("retorno" => "criado_sucesso", "msg" => "Endereço criado com sucesso!");
$campos["msg"] = "Endereço criado com sucesso";
$campos["success"] = true;

echo json_encode($campos);
?>