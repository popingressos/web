<?
$cepGet = preg_replace("/[^0-9]/", "",$cepGet);

$rSqlEndereco = mysql_fetch_array(mysql_query("SELECT id_bairro,id_cidade,logradouro FROM cepbr_endereco WHERE cep='".$cepGet."'"));
$rSqlBairro = mysql_fetch_array(mysql_query("SELECT bairro FROM cepbr_bairro WHERE id_bairro='".$rSqlEndereco['id_bairro']."'"));
$rSqlCidade = mysql_fetch_array(mysql_query("SELECT uf,cidade FROM cepbr_cidade WHERE id_cidade='".$rSqlEndereco['id_cidade']."'"));

if(trim($rSqlEndereco['id_bairro'])=="" && trim($rSqlEndereco['id_cidade'])=="" && trim($rSqlEndereco['logradouro'])=="") {
	$campos["data"] = array("retorno" => "cep-indisponivel", "msg" => "Não foi encontrado endereço para o cep informado!");
	$campos["msg"] = "";
	$campos["success"] = true;
} else {
	$campos["data"][] = array(
								"tag" => "busca-cep", 
								"tit_rua" => "".$rSqlEndereco['logradouro']."",
								"tit_estado" => "".$rSqlCidade['uf']."",
								"tit_cidade" => "".$rSqlCidade['cidade']."",
								"tit_bairro" => "".$rSqlBairro['bairro']."",

								"rua" => "".$rSqlEndereco['logradouro']."",
								"estado" => "".$rSqlCidade['uf']."",
								"cidade" => "".$rSqlCidade['cidade']."",
								"bairro" => "".$rSqlBairro['bairro']."",
							);
	$campos["msg"] = "Endereço recuperado com sucesso";
	$campos["success"] = true;
}
#echo "<pre>";
echo json_encode($campos);
?>