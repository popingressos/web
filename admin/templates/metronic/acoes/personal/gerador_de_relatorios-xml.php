<?php
header('Access-Control-Allow-Origin: *');

if(trim($numeroUnicoNotificacaoGet)=="") {
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

	$numeroUnicoNotificacaoGet = $_REQUEST['numeroUnico'];
} else {
	$numeroUnicoNotificacaoGet = $numeroUnicoNotificacaoGet;
}

$strSql = "
	SELECT 
		mod_carrinho.id,
		mod_carrinho.empresa,

		mod_carrinho.numeroUnico,
		mod_carrinho.numeroUnico_pessoa,
		mod_carrinho.numeroUnico_evento,
		mod_carrinho.cod_voucher,
		mod_carrinho.confirmado,
		mod_carrinho.dataConfirmado,
		mod_carrinho.dataBloqueado,
		mod_carrinho.dataCancelado,
		mod_carrinho.observacao,
		
		mod_empresa.id AS empresa_id,
		mod_empresa.token AS empresa_token,
		mod_empresa.cod_ibge AS empresa_cod_ibge,
		mod_empresa.razao_social AS empresa_razao_social,
		mod_empresa.documento AS empresa_documento,
		mod_empresa.email AS empresa_email,
		mod_empresa.whatsapp AS empresa_whatsapp,
		mod_empresa.telefone AS empresa_telefone,
		mod_empresa.cns_validador AS empresa_cns,
		mod_empresa.cnes_validador AS empresa_cnes,
		mod_empresa.cbo_validador AS empresa_cbo,

		mod_pessoas.id AS usuario_id,
		mod_pessoas.numeroUnico_etnias AS usuario_numeroUnico_etnias,
		mod_pessoas.nome AS usuario_nome,
		mod_pessoas.nome_da_mae AS usuario_nome_da_mae,
		mod_pessoas.nome_do_pai AS usuario_nome_do_pai,
		mod_pessoas.data_de_nascimento AS usuario_data_de_nascimento,
		mod_pessoas.documento AS usuario_documento,
		mod_pessoas.cns AS usuario_cns,
		mod_pessoas.gestante AS usuario_gestante,
		mod_pessoas.puerpera AS usuario_puerpera,
		mod_pessoas.comunicante_hanseniase AS usuario_comunicante_hanseniase,
		mod_pessoas.whatsapp AS usuario_whatsapp,
		mod_pessoas.telefone AS usuario_telefone,
		mod_pessoas.email AS usuario_email,
		mod_pessoas.genero AS usuario_genero,
		mod_categorias_de_pessoas.id_esus AS categorias_de_pessoas_id_esus,
		mod_etnias.id_esus AS etnias_id_esus,

		mod_eventos.numero_dose,
		mod_eventos.nome AS evento_nome,
		mod_eventos.data_de_publicacao AS evento_data_de_publicacao,
		mod_eventos.data_de_despublicacao AS evento_data_de_despublicacao,
		mod_eventos.cep AS evento_cep,
		mod_eventos.rua AS evento_rua,
		mod_eventos.numero AS evento_numero,
		mod_eventos.complemento AS evento_complemento,
		mod_eventos.estado AS evento_estado,
		mod_eventos.cidade AS evento_cidade,
		mod_eventos.bairro AS evento_bairro,
		
		mod_unidades_de_saude.numeroUnico AS unidades_de_saude_numeroUnico,
		mod_unidades_de_saude.nome AS unidades_de_saude_nome,
		mod_unidades_de_saude.cnes AS unidades_de_saude_cnes,
		mod_unidades_de_saude.ine AS unidades_de_saude_ine,
		mod_categorias_de_unidades.id_esus AS unidades_de_saude_tipo_id_esus,
		
		mod_lotes.numeroUnico AS lote_numeroUnico,
		mod_lotes.nome AS lote_nome,
		
		mod_vacinador.numeroUnico AS vacinador_numeroUnico,
		mod_vacinador.nome AS vacinador_nome,
		mod_vacinador.cns AS vacinador_cns,
		mod_vacinador.cnes AS vacinador_cnes,
		mod_atividades.id_esus AS vacinador_codigo_2002,
		
		mod_imunobiologicos.numeroUnico AS imunobiologicos_numeroUnico,
		mod_imunobiologicos.nome AS imunobiologicos_nome,
		mod_imunobiologicos.id_esus AS imunobiologicos_id_esus,

		mod_vacinas.numeroUnico AS vacinas_numeroUnico,
		mod_vacinas.nome AS vacinas_nome,

		mod_estrategias.numeroUnico AS estrategias_numeroUnico,
		mod_estrategias.nome AS estrategias_nome,
		mod_estrategias.id_esus AS estrategias_id_esus,

		mod_doses.numeroUnico AS doses_numeroUnico,
		mod_doses.nome AS doses_nome,
		mod_doses.id_esus AS doses_id_esus,

		mod_fabricantes.numeroUnico AS fabricantes_numeroUnico,
		mod_fabricantes.nome AS fabricantes_nome,
		mod_fabricantes.id_esus AS fabricantes_id_esus

	FROM 
		carrinho_notificacao AS mod_carrinho 
	LEFT JOIN 
		empresa AS mod_empresa ON (mod_empresa.id = mod_carrinho.empresa)
	LEFT JOIN 
		pessoas AS mod_pessoas ON (mod_pessoas.numeroUnico = mod_carrinho.numeroUnico_pessoa)
	LEFT JOIN 
		unidades_de_saude AS mod_unidades_de_saude ON (mod_unidades_de_saude.numeroUnico = mod_carrinho.numeroUnico_unidades_de_saude)
	LEFT JOIN 
		lotes AS mod_lotes ON (mod_lotes.numeroUnico = mod_carrinho.numeroUnico_lote)
	LEFT JOIN 
		vacinador AS mod_vacinador ON (mod_vacinador.numeroUnico = mod_carrinho.numeroUnico_vacinador)
	LEFT JOIN 
		eventos AS mod_eventos ON (mod_eventos.numeroUnico = mod_carrinho.numeroUnico_evento)
	LEFT JOIN 
		imunobiologicos AS mod_imunobiologicos ON (mod_imunobiologicos.numeroUnico = mod_carrinho.numeroUnico_imunobiologico)
	LEFT JOIN 
		vacinas AS mod_vacinas ON (mod_vacinas.numeroUnico = mod_carrinho.numeroUnico_vacinas)
	LEFT JOIN 
		estrategias AS mod_estrategias ON (mod_estrategias.numeroUnico = mod_carrinho.numeroUnico_estrategia)
	LEFT JOIN 
		doses AS mod_doses ON (mod_doses.numeroUnico = mod_carrinho.numeroUnico_doses)
	LEFT JOIN 
		atividades AS mod_atividades ON (mod_atividades.numeroUnico = mod_vacinador.numeroUnico_atividades)
	LEFT JOIN 
		categorias_de_unidades AS mod_categorias_de_unidades ON (mod_categorias_de_unidades.numeroUnico = mod_unidades_de_saude.categorias_de_unidades)
	LEFT JOIN 
		categorias_de_pessoas AS mod_categorias_de_pessoas ON (mod_categorias_de_pessoas.numeroUnico = mod_pessoas.categorias_de_pessoas)
	LEFT JOIN 
		etnias AS mod_etnias ON (mod_etnias.numeroUnico = mod_pessoas.numeroUnico_etnias)
	LEFT JOIN 
		fabricantes AS mod_fabricantes ON (mod_fabricantes.id_esus = mod_imunobiologicos.id_esus)
	WHERE
		mod_carrinho.xml_gerado='0' AND
		mod_carrinho.numeroUnico='".$numeroUnicoNotificacaoGet."'
		
";

$rSqlNotificacao = mysql_fetch_array(mysql_query("".$strSql.""));

if(is_dir("".$_SERVER['DOCUMENT_ROOT']."/admin/files/xml_export/".$rSqlNotificacao['empresa_token']."")) { } else {
	mkdir("".$_SERVER['DOCUMENT_ROOT']."/admin/files/xml_export/".$rSqlNotificacao['empresa_token']."", 0777);
	chmod("".$_SERVER['DOCUMENT_ROOT']."/admin/files/xml_export/".$rSqlNotificacao['empresa_token']."", 0777);
}

$l_nfe = dir("".$_SERVER['DOCUMENT_ROOT']."/admin/files/xml_export/".$rSqlNotificacao['empresa_token']."/");

while($arquivo = $l_nfe -> read()){
	if($arquivo == "." || $arquivo == "..") { } else {
		#echo "[".$arquivo."] <br>";
	}
}

$caracteres_invalidos = array(",", ";", ".", ":", "<", ">", "´", "`", "^", "~", "\"", "!", "@", "#", "$", "%", "¨", "&", "*", "(", ")", "-", "_", "+", "=", "§", "¬", "?", "º", "{", "}", "[", "]");

$rSqlNotificacao['usuario_nome'] = str_replace($caracteres_invalidos, "", "".$rSqlNotificacao['usuario_nome']."");
$rSqlNotificacao['usuario_nome'] = str_replace("  ", " ", "".$rSqlNotificacao['usuario_nome']."");
$rSqlNotificacao['usuario_nome'] = strtoupper($rSqlNotificacao['usuario_nome']);

$rSqlNotificacao['usuario_documento'] = preg_replace("/[^0-9]/", "", $rSqlNotificacao['usuario_documento']);
$rSqlNotificacao['usuario_cns'] = preg_replace("/[^0-9]/", "", $rSqlNotificacao['usuario_cns']);

if(trim($rSqlNotificacao['usuario_documento'])=="") {
	if(trim($rSqlNotificacao['usuario_cns'])=="") {
		$rSqlNotificacao['prefixo_xml'] = "";
	} else {
		$rSqlNotificacao['prefixo_xml'] = "cns_";
	}
} else {
	$rSqlNotificacao['prefixo_xml'] = "cpf_";
}

if(trim($rSqlNotificacao['usuario_genero'])=="F") {
	$rSqlNotificacao['usuario_genero'] = 1;
} else if(trim($rSqlNotificacao['usuario_genero'])=="F") {
	$rSqlNotificacao['usuario_genero'] = 0;
} else {
	$rSqlNotificacao['usuario_genero'] = 4;
}

$rSqlNotificacao['usuario_data_de_nascimento'] = strtotime(''.$rSqlNotificacao['usuario_data_de_nascimento'].' 00:00:00');

$rSqlNotificacao['usuario_whatsapp'] = preg_replace("/[^0-9]/", "", $rSqlNotificacao['usuario_whatsapp']);
if(trim($rSqlNotificacao['usuario_whatsapp'])=="") {
	$rSqlNotificacao['usuario_whatsapp'] = "00000000000";
} else {
	$rSqlNotificacao['usuario_whatsapp'] = $rSqlNotificacao['usuario_whatsapp'];
}

$rSqlNotificacao['usuario_nome_da_mae'] = str_replace($caracteres_invalidos, "", "".$rSqlNotificacao['usuario_nome_da_mae']."");
$rSqlNotificacao['usuario_nome_da_mae'] = str_replace("  ", " ", "".$rSqlNotificacao['usuario_nome_da_mae']."");
$rSqlNotificacao['usuario_nome_da_mae'] = strtoupper($rSqlNotificacao['usuario_nome_da_mae']);

if(trim($rSqlNotificacao['usuario_nome_da_mae'])=="") {
	$rSqlNotificacao['usuario_desconhece_nome_da_mae'] = "true";
} else {
	$rSqlNotificacao['usuario_desconhece_nome_da_mae'] = "false";
}

if(trim($rSqlNotificacao['usuario_nome_do_pai'])=="") {
	$rSqlNotificacao['usuario_desconhece_nome_do_pai'] = "true";
} else {
	$rSqlNotificacao['usuario_desconhece_nome_do_pai'] = "false";
}

if(trim($rSqlNotificacao['usuario_numeroUnico_etnias'])=="" || trim($rSqlNotificacao['usuario_numeroUnico_etnias'])=="0") {
	$rSqlNotificacao['etnias_id_esus'] = "6";
} else {
	$rSqlNotificacao['etnias_id_esus'] = $rSqlNotificacao['etnias_id_esus'];
}

//Caso Raça for indigena
if(trim($rSqlNotificacao['etnias_id_esus'])=="5") {
	$rSqlNotificacao['etnia'] = "405";
} else {
	$rSqlNotificacao['etnia'] = "";
}

if(trim($rSqlNotificacao['usuario_gestante'])=="" || trim($rSqlNotificacao['usuario_gestante'])=="0") {
	$rSqlNotificacao['usuario_gestante'] = "false";
} else if(trim($rSqlNotificacao['usuario_gestante'])=="1") {
	$rSqlNotificacao['usuario_gestante'] = "true";
}

if(trim($rSqlNotificacao['usuario_puerpera'])=="" || trim($rSqlNotificacao['usuario_puerpera'])=="0") {
	$rSqlNotificacao['usuario_puerpera'] = "false";
} else if(trim($rSqlNotificacao['usuario_puerpera'])=="1") {
	$rSqlNotificacao['usuario_puerpera'] = "true";
}

if(trim($rSqlNotificacao['usuario_comunicante_hanseniase'])=="" || trim($rSqlNotificacao['usuario_comunicante_hanseniase'])=="0") {
	$rSqlNotificacao['usuario_comunicante_hanseniase'] = "false";
} else if(trim($rSqlNotificacao['usuario_comunicante_hanseniase'])=="1") {
	$rSqlNotificacao['usuario_comunicante_hanseniase'] = "true";
}

//Desabilitado, pois só é utilizado quando existir vacinação de BCG
$rSqlNotificacao['usuario_comunicante_hanseniase'] = "";
/*			<comunicanteHanseniase><?=$rSqlNotificacao['usuario_comunicante_hanseniase']?></comunicanteHanseniase>*/

$rSqlNotificacao['unidades_de_saude_cnes'] = str_replace(" ","",$rSqlNotificacao['unidades_de_saude_cnes']);
$rSqlNotificacao['usuario_cns'] = str_replace(" ","",$rSqlNotificacao['usuario_cns']);
$rSqlNotificacao['vacinador_cns'] = str_replace(" ","",$rSqlNotificacao['vacinador_cns']);
$rSqlNotificacao['vacinador_cnes'] = str_replace(" ","",$rSqlNotificacao['vacinador_cnes']);

$rSqlNotificacao['dataConfirmado'] = strtotime(''.$rSqlNotificacao['dataConfirmado'].'');

$rSqlNotificacao['empresa_documento'] = preg_replace("/[^0-9]/", "", $rSqlNotificacao['empresa_documento']);
$rSqlNotificacao['empresa_whatsapp'] = preg_replace("/[^0-9]/", "", $rSqlNotificacao['empresa_whatsapp']);
$rSqlNotificacao['empresa_telefone'] = preg_replace("/[^0-9]/", "", $rSqlNotificacao['empresa_telefone']);

$rSqlNotificacao['uuid_documento'] = "".$rSqlNotificacao['unidades_de_saude_cnes']."-".gen_uuid()."";

include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/gerador_de_relatorios_ficha-xml.php");
if(file_exists($arquivo_ficha_xmlSet)){
	if(trim($rSqlNotificacao['prefixo_xml'])=="cpf_") {
		include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/gerador_de_relatorios_pessoa-xml.php");
		$update = mysql_query("UPDATE carrinho_notificacao SET xml_gerado='1' WHERE id='".$rSqlNotificacao['id']."'");
	}
}
?>