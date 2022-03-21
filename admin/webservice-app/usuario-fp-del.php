<?
$update = mysql_query("
						UPDATE 
							pessoas_formas_de_pagamento 
						SET 
							stat='2',
							dataModificacao='".$data."' 
						WHERE 
							numeroUnico='".$numeroUnicoGet."'
						");

$campos["data"] = array("retorno" => "removido_sucesso", "msg" => "Forma de pagamento removida com sucesso!");
$campos["msg"] = "Forma de pagamento removida com sucesso!";
$campos["success"] = true;

echo json_encode($campos);
?>