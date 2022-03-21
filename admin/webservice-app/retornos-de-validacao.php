<?
$qSql = mysql_query("
					SELECT 
						mod_retornos_de_validacao.numeroUnico,
						mod_retornos_de_validacao.nome
						
					FROM 
						retornos_de_validacao AS mod_retornos_de_validacao 
					WHERE 
						mod_retornos_de_validacao.stat='1' AND 
						mod_retornos_de_validacao.empresa_token='".trim($empresa_tokenGet)."'
					GROUP BY 
						mod_retornos_de_validacao.id 
					ORDER BY 
						mod_retornos_de_validacao.nome 
					");

$cont=0;
while($rSql = mysql_fetch_array($qSql)) {
	$cont++;

	$campos["data"][] = array(
								'numeroUnico'=> $rSql['numeroUnico'],
								'nome'=> $rSql['nome']
							);

}

if(count($campos)>0) {
	$campos["msg"] = "Recuperados com sucesso";
	$campos["success"] = true;
} else {
	$campos["msg"] = "Sem items disponíveis para exibição";
	$campos["success"] = false;
}

#echo "<pre>";
echo json_encode($campos);
?>