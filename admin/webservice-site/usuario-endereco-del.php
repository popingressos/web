<?
$update = mysql_query("
						UPDATE 
							pessoas_endereco 
						SET 
							stat='2',
							dataModificacao='".$data."' 
						WHERE 
							numeroUnico='".$numeroUnicoGet."'
						");

$campos["data"] = array("retorno" => "removido_sucesso", "msg" => "Endereço removido com sucesso!");
$campos["msg"] = "Endereço removido com sucesso";
$campos["success"] = true;

echo json_encode($campos);
?>