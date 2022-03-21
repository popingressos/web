<?
$rSqlDescricao = mysql_fetch_array(mysql_query("SELECT * FROM fale_conosco_descricao WHERE empresa_token='".trim($empresa_tokenGet)."' ORDER BY data DESC LIMIT 1"));

$campos["data"][] = array("id" => "".$rSqlDescricao['id']."", 
						  "titulo_do_texto_da_pagina" => "".$rSqlDescricao['titulo_do_texto_da_pagina']."", 
						  "texto_da_pagina" => "".$rSqlDescricao['texto_da_pagina']."", 
						  "link_do_mapa" => "".$rSqlDescricao['link_do_mapa']."", 
						  "endereco" => "".$rSqlDescricao['endereco']."", 
						  "telefone" => "".$rSqlDescricao['telefone']."", 
						  "email" => "".$rSqlDescricao['email']."", 
						  "horario_de_funcionamento" => "".$rSqlDescricao['horario_de_funcionamento']."", 
						  );

if(trim($rSqlDescricao['id'])=="") {
	$campos["msg"] = "Sem dados disponíveis para exibição";
	$campos["success"] = false;
} else {
	$campos["msg"] = "Dados recuperadas com sucesso";
	$campos["success"] = true;
}

echo json_encode($campos);
?>