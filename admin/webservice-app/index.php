<?
header('Access-Control-Allow-Origin: *');

include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/defines.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");
require("".$_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");

$tipoWebservice = "INDEFINIDO";
if (isset($_POST['Local'])) {
	$tipoWebservice = "POST";
	$_POST = $_POST;
}

if (isset($_REQUEST['Local'])) {
	if(trim($tipoWebservice)=="POST") {
		$_POST = $_POST;
	} else {
		$tipoWebservice = "REQUEST";
		$_POST = $_REQUEST;
	}
}

if(trim($tipoWebservice)=="POST") {
	
	$MODELO_BUILD = $_POST['MODELO_BUILD'];
	$VERSION_BUILD = $_POST['VERSION_BUILD'];

	if(trim($MODELO_BUILD)=="") {
		$webserviceSet = "SITE";
		$localGet = $_POST['Local'];
		$DeviceGet = $_POST['Device'];
		$objetoGet = $_POST['Objeto'];
		$MODELO_BUILD = $_POST['MODELO_BUILD'];
		
		if(trim($_POST['Requisicao'])=="ajax") {
			$obj = json_decode($objetoGet);
		} else if(trim($_POST['Requisicao'])=="fetch") {
			$obj = json_decode($_POST['Objeto']);
		} else {
			$obj = json_decode(json_encode($objetoGet));
		}
	} else {
		$webserviceSet = "APP";
		$localGet = $_POST['Local'];
		$DeviceGet = $_POST['Device'];
		$objetoGet = $_POST['Objeto'];
		$MODELO_BUILD = $_POST['MODELO_BUILD'];

		$obj = json_decode($objetoGet);
	}

	$empresa_tokenGet = $_POST['Empresa'];
	$empresa_token_novoGet = $obj->{'token_empresa'};
	if(trim($empresa_token_novoGet)=="" || trim($empresa_token_novoGet)=="0") {
		$empresa_tokenGet = $empresa_tokenGet;
	} else {
		$empresa_tokenGet = $empresa_token_novoGet;
	}
	
	$rSqlEmpresa = mysql_fetch_array(mysql_query("SELECT * FROM empresa WHERE token='".trim($empresa_tokenGet)."' AND stat='1'"));
	$rSqlEmpresaTaxas = mysql_fetch_array(mysql_query("SELECT taxa_app_ccr_cms FROM empresa_taxas WHERE empresa_token='".trim($empresa_tokenGet)."' AND stat='1'"));
	
	$tag_carrinho_orcamentoGet = "orcamento_no_app";
	$tag_carrinhoGet = "compra_no_app";
	
} else if(trim($tipoWebservice)=="REQUEST") {
	$webserviceSet = "SITE";
	$localGet = $_POST['Local'];
	$DeviceGet = $_POST['Device'];
	$objetoGet = $_POST['Objeto'];
	$MODELO_BUILD = $_POST['MODELO_BUILD'];
	$VERSION_BUILD = $_POST['VERSION_BUILD'];
	
	$empresa_tokenGet = $_POST['Empresa'];
	$empresa_token_novoGet = $obj->{'token_empresa'};
	if(trim($empresa_token_novoGet)=="" || trim($empresa_token_novoGet)=="0") {
		$empresa_tokenGet = $empresa_tokenGet;
	} else {
		$empresa_tokenGet = $empresa_token_novoGet;
	}
	
	$rSqlEmpresa = mysql_fetch_array(mysql_query("SELECT * FROM empresa WHERE token='".trim($empresa_tokenGet)."' AND stat='1'"));
	$rSqlEmpresaTaxas = mysql_fetch_array(mysql_query("SELECT taxa_app_ccr_cms FROM empresa_taxas WHERE empresa_token='".trim($empresa_tokenGet)."' AND stat='1'"));

	if(trim($_POST['Requisicao'])=="ajax") {
		$obj = json_decode($objetoGet);
	} else if(trim($_POST['Requisicao'])=="fetch") {
		$obj = json_decode($_POST['Objeto']);
	} else {
		$objetoGet = json_encode($_POST['Objeto']);
		$obj = json_decode($objetoGet);
	}

	$empresa_tokenGet = $rSqlEmpresa['token'];

	$tag_carrinho_orcamentoGet = "orcamento_no_site";
	$tag_carrinhoGet = "compra_no_site";
}

if(trim($DeviceGet)=="") {
	$DeviceGet = "APP";
} else {
	$DeviceGet = $DeviceGet;
}

if(trim($webserviceSet)=="APP") {
	$strSQLPlataforma = "
				SELECT 
					mod_aplicativo.numeroUnico,
					mod_aplicativo.nome,
					mod_aplicativo.checkout_com_cupom,
					mod_aplicativo.aceita_boleto,
	
					mod_aplicativo.cod_validacao_profissional,
					mod_aplicativo.cod_validacao_cliente,
	
					mod_aplicativo.campos_profissional,
					mod_aplicativo.campos_cliente,

					mod_aplicativo.cadastro_profissional_stat,
					mod_aplicativo.cadastro_cliente_stat,

					mod_aplicativo.cadastro_profissional_assinatura,
					mod_aplicativo.cadastro_cliente_assinatura,

					mod_aplicativo.cadastro_profissional_completo_obrigatorio,
					mod_aplicativo.cadastro_cliente_completo_obrigatorio,

					mod_aplicativo.orcamento,
					mod_aplicativo.loja_virtual,
					mod_aplicativo.delivery,
					mod_aplicativo.exibicao_de_produtos,
					mod_aplicativo.exibicao_de_produtos_perfil,
					mod_aplicativo.exibicao_de_eventos,

					mod_aplicativo.atribuicao_pessoa_nome,
					mod_aplicativo.atribuicao_pessoa_documento,
					mod_aplicativo.atribuicao_pessoa_email,
					mod_aplicativo.atribuicao_pessoa_whatsapp,
					mod_aplicativo.atribuicao_pessoa_genero,
					mod_aplicativo.atribuicao_pessoa_nome_obrigatorio,
					mod_aplicativo.atribuicao_pessoa_documento_obrigatorio,
					mod_aplicativo.atribuicao_pessoa_email_obrigatorio,
					mod_aplicativo.atribuicao_pessoa_whatsapp_obrigatorio,
					mod_aplicativo.atribuicao_pessoa_genero_obrigatorio,
					mod_aplicativo.atribuicao_venda_com_registro,

					mod_empresa.token,
					mod_empresa.login_pessoa,
					
					mod_empresa.cadastro_site,
					mod_empresa.venda_produto_site,
					mod_empresa.venda_evento_site,
					mod_empresa.venda_credito_site,
					
					mod_empresa.cadastro_app,
					mod_empresa.venda_produto_app,
					mod_empresa.venda_evento_app,
					mod_empresa.venda_credito_app,
					
					mod_empresa.tipo_empresa
	
				FROM 
					aplicativo AS mod_aplicativo
				LEFT JOIN 
					empresa AS mod_empresa ON (mod_empresa.id = mod_aplicativo.empresa)

				WHERE 
					mod_aplicativo.empresa_token='".trim($empresa_tokenGet)."' AND
					mod_aplicativo.stat='1'
				";
	$rSqlPlataforma = mysql_fetch_array(mysql_query("".$strSQLPlataforma.""));

	$campos_clienteArray = unserialize($rSqlPlataforma['campos_cliente']);
	$campos_profissionalArray = unserialize($rSqlPlataforma['campos_profissional']);

	if(trim($rSqlPlataforma['cod_validacao_profissional'])=="" || trim($rSqlPlataforma['cod_validacao_profissional'])=="0") { $rSqlPlataforma['cod_validacao_profissional'] = "0"; } else { $rSqlPlataforma['cod_validacao_profissional'] = "1"; }
	if(trim($rSqlPlataforma['cod_validacao_cliente'])=="" || trim($rSqlPlataforma['cod_validacao_cliente'])=="0") { $rSqlPlataforma['cod_validacao_cliente'] = "0"; } else { $rSqlPlataforma['cod_validacao_cliente'] = "1"; }
	
	if(trim($campos_profissionalArray['campo_profissional_nome'][0]['obrigatorio'])=="" || trim($campos_profissionalArray['campo_profissional_nome'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_profissional_nome_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_profissional_nome_obrigatorio'] = "1"; }
	if(trim($campos_profissionalArray['campo_profissional_documento'][0]['obrigatorio'])=="" || trim($campos_profissionalArray['campo_profissional_documento'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_profissional_documento_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_profissional_documento_obrigatorio'] = "1"; }
	if(trim($campos_profissionalArray['campo_profissional_genero'][0]['obrigatorio'])=="" || trim($campos_profissionalArray['campo_profissional_genero'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_profissional_genero_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_profissional_genero_obrigatorio'] = "1"; }
	if(trim($campos_profissionalArray['campo_profissional_email'][0]['obrigatorio'])=="" || trim($campos_profissionalArray['campo_profissional_email'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_profissional_email_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_profissional_email_obrigatorio'] = "1"; }
	if(trim($campos_profissionalArray['campo_profissional_telefone'][0]['obrigatorio'])=="" || trim($campos_profissionalArray['campo_profissional_telefone'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_profissional_telefone_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_profissional_telefone_obrigatorio'] = "1"; }
	if(trim($campos_profissionalArray['campo_profissional_whatsapp'][0]['obrigatorio'])=="" || trim($campos_profissionalArray['campo_profissional_whatsapp'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_profissional_whatsapp_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_profissional_whatsapp_obrigatorio'] = "1"; }
	if(trim($campos_profissionalArray['campo_profissional_cep'][0]['obrigatorio'])=="" || trim($campos_profissionalArray['campo_profissional_cep'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_profissional_cep_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_profissional_cep_obrigatorio'] = "1"; }
	if(trim($campos_profissionalArray['campo_profissional_rua'][0]['obrigatorio'])=="" || trim($campos_profissionalArray['campo_profissional_rua'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_profissional_rua_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_profissional_rua_obrigatorio'] = "1"; }
	if(trim($campos_profissionalArray['campo_profissional_numero'][0]['obrigatorio'])=="" || trim($campos_profissionalArray['campo_profissional_numero'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_profissional_numero_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_profissional_numero_obrigatorio'] = "1"; }
	if(trim($campos_profissionalArray['campo_profissional_complemento'][0]['obrigatorio'])=="" || trim($campos_profissionalArray['campo_profissional_complemento'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_profissional_complemento_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_profissional_complemento_obrigatorio'] = "1"; }
	if(trim($campos_profissionalArray['campo_profissional_bairro'][0]['obrigatorio'])=="" || trim($campos_profissionalArray['campo_profissional_bairro'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_profissional_bairro_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_profissional_bairro_obrigatorio'] = "1"; }
	if(trim($campos_profissionalArray['campo_profissional_cidade'][0]['obrigatorio'])=="" || trim($campos_profissionalArray['campo_profissional_cidade'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_profissional_cidade_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_profissional_cidade_obrigatorio'] = "1"; }
	if(trim($campos_profissionalArray['campo_profissional_estado'][0]['obrigatorio'])=="" || trim($campos_profissionalArray['campo_profissional_estado'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_profissional_estado_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_profissional_estado_obrigatorio'] = "1"; }
	if(trim($campos_profissionalArray['campo_profissional_data_de_nascimento'][0]['obrigatorio'])=="" || trim($campos_profissionalArray['campo_profissional_data_de_nascimento'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_profissional_data_de_nascimento_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_profissional_data_de_nascimento_obrigatorio'] = "1"; }
	
	if(trim($campos_clienteArray['campo_cliente_nome'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_nome'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_nome_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_nome_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_documento'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_documento'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_documento_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_documento_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_genero'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_genero'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_genero_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_genero_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_email'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_email'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_email_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_email_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_telefone'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_telefone'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_telefone_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_telefone_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_whatsapp'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_whatsapp'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_whatsapp_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_whatsapp_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_cep'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_cep'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_cep_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_cep_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_rua'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_rua'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_rua_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_rua_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_numero'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_numero'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_numero_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_numero_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_complemento'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_complemento'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_complemento_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_complemento_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_bairro'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_bairro'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_bairro_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_bairro_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_cidade'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_cidade'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_cidade_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_cidade_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_estado'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_estado'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_estado_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_estado_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_profissional_da_saude'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_profissional_da_saude'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_profissional_da_saude_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_profissional_da_saude_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_encontrase_acamado'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_encontrase_acamado'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_encontrase_acamado_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_encontrase_acamado_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_nome_da_mae'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_nome_da_mae'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_nome_da_mae_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_nome_da_mae_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_cns'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_cns'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_cns_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_cns_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_data_de_nascimento'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_data_de_nascimento'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_data_de_nascimento_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_data_de_nascimento_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_categorias_de_pessoas'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_categorias_de_pessoas'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_categorias_de_pessoas_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_categorias_de_pessoas_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_numeroUnico_atividades'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_numeroUnico_atividades'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_numeroUnico_atividades_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_numeroUnico_atividades_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_numeroUnico_unidades_de_saude'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_numeroUnico_unidades_de_saude'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_numeroUnico_unidades_de_saude_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_numeroUnico_unidades_de_saude_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_tipo_sanguineo'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_tipo_sanguineo'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_tipo_sanguineo_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_tipo_sanguineo_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_contraiu_doenca'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_contraiu_doenca'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_contraiu_doenca_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_contraiu_doenca_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_numeroUnico_vacinas'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_numeroUnico_vacinas'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_numeroUnico_vacinas_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_numeroUnico_vacinas_obrigatorio'] = "1"; }
	if(trim($campos_clienteArray['campo_cliente_doenca_outros'][0]['obrigatorio'])=="" || trim($campos_clienteArray['campo_cliente_doenca_outros'][0]['obrigatorio'])=="0") { $rSqlPlataforma['campo_cliente_doenca_outros_obrigatorio'] = "0"; } else { $rSqlPlataforma['campo_cliente_doenca_outros_obrigatorio'] = "1"; }
	

	if(trim($campos_clienteArray['campo_cliente_nome'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_nome_label'] = "Nome completo"; } else { $rSqlPlataforma['campo_cliente_nome_label'] = "".$campos_clienteArray['campo_cliente_nome'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_documento'][0]['label'])=="") { 
		if(trim($campos_clienteArray['campo_cliente_documento'][0]['tipo'])=="qualquer") {
			$campos_clienteArray['campo_cliente_documento_label'] = "CPF, RG ou CNPJ"; 
		} else if(trim($campos_clienteArray['campo_cliente_documento'][0]['tipo'])=="cnpj") {
			$campos_clienteArray['campo_cliente_documento_label'] = "CNPJ"; 
		} else if(trim($campos_clienteArray['campo_cliente_documento'][0]['tipo'])=="cpf") {
			$campos_clienteArray['campo_cliente_documento_label'] = "CPF"; 
		}
	} else { 
		$campos_clienteArray['campo_cliente_documento_label'] = "".$campos_clienteArray['campo_cliente_documento'][0]['label'].""; 
	}
	if(trim($campos_clienteArray['campo_cliente_genero'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_genero_label'] = "Gênero"; } else { $rSqlPlataforma['campo_cliente_genero_label'] = "".$campos_clienteArray['campo_cliente_genero'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_email'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_email_label'] = "E-mail"; } else { $rSqlPlataforma['campo_cliente_email_label'] = "".$campos_clienteArray['campo_cliente_email'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_telefone'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_telefone_label'] = "Telefone"; } else { $rSqlPlataforma['campo_cliente_telefone_label'] = "".$campos_clienteArray['campo_cliente_telefone'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_whatsapp'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_whatsapp_label'] = "WhatsApp"; } else { $rSqlPlataforma['campo_cliente_whatsapp_label'] = "".$campos_clienteArray['campo_cliente_whatsapp'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_cep'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_cep_label'] = "CEP"; } else { $rSqlPlataforma['campo_cliente_cep_label'] = "".$campos_clienteArray['campo_cliente_cep'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_rua'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_rua_label'] = "Rua"; } else { $rSqlPlataforma['campo_cliente_rua_label'] = "".$campos_clienteArray['campo_cliente_rua'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_numero'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_numero_label'] = "Número"; } else { $rSqlPlataforma['campo_cliente_numero_label'] = "".$campos_clienteArray['campo_cliente_numero'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_complemento'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_complemento_label'] = "Complemento"; } else { $rSqlPlataforma['campo_cliente_complemento_label'] = "".$campos_clienteArray['campo_cliente_complemento'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_bairro'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_bairro_label'] = "Bairro"; } else { $rSqlPlataforma['campo_cliente_bairro_label'] = "".$campos_clienteArray['campo_cliente_bairro'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_cidade'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_cidade_label'] = "Cidade"; } else { $rSqlPlataforma['campo_cliente_cidade_label'] = "".$campos_clienteArray['campo_cliente_cidade'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_estado'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_estado_label'] = "Estado"; } else { $rSqlPlataforma['campo_cliente_estado_label'] = "".$campos_clienteArray['campo_cliente_estado'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_profissional_da_saude'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_profissional_da_saude_label'] = "Profissional da Saúde?"; } else { $rSqlPlataforma['campo_cliente_profissional_da_saude_label'] = "".$campos_clienteArray['campo_cliente_profissional_da_saude'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_encontrase_acamado'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_encontrase_acamado_label'] = "Encontra-se Acamado?"; } else { $rSqlPlataforma['campo_cliente_encontrase_acamado_label'] = "".$campos_clienteArray['campo_cliente_encontrase_acamado'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_nome_da_mae'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_nome_da_mae_label'] = "Nome da Mãe"; } else { $rSqlPlataforma['campo_cliente_nome_da_mae_label'] = "".$campos_clienteArray['campo_cliente_nome_da_mae'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_cns'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_cns_label'] = "CNS"; } else { $rSqlPlataforma['campo_cliente_cns_label'] = "".$campos_clienteArray['campo_cliente_cns'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_data_de_nascimento'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_data_de_nascimento_label'] = "Data de Nascimento"; } else { $rSqlPlataforma['campo_cliente_data_de_nascimento_label'] = "".$campos_clienteArray['campo_cliente_data_de_nascimento'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_categorias_de_pessoas'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_categorias_de_pessoas_label'] = "Grupo de Atendimento"; } else { $rSqlPlataforma['campo_cliente_categorias_de_pessoas_label'] = "".$campos_clienteArray['campo_cliente_categorias_de_pessoas'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_numeroUnico_atividades'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_numeroUnico_atividades_label'] = "Profissão"; } else { $rSqlPlataforma['campo_cliente_numeroUnico_atividades_label'] = "".$campos_clienteArray['campo_cliente_numeroUnico_atividades'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_numeroUnico_unidades_de_saude'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_numeroUnico_unidades_de_saude_label'] = "Unidade de saúde que sou cadastrado"; } else { $rSqlPlataforma['campo_cliente_numeroUnico_unidades_de_saude_label'] = "".$campos_clienteArray['campo_cliente_numeroUnico_unidades_de_saude'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_tipo_sanguineo'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_tipo_sanguineo_label'] = "Tipo Sanguíneo"; } else { $rSqlPlataforma['campo_cliente_tipo_sanguineo_label'] = "".$campos_clienteArray['campo_cliente_tipo_sanguineo'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_contraiu_doenca'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_contraiu_doenca_label'] = "Contraiu alguma doença nos últimos 30 dias?"; } else { $rSqlPlataforma['campo_cliente_contraiu_doenca_label'] = "".$campos_clienteArray['campo_cliente_contraiu_doenca'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_numeroUnico_vacinas'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_numeroUnico_vacinas_label'] = "Lista de Doenças"; } else { $rSqlPlataforma['campo_cliente_numeroUnico_vacinas_label'] = "".$campos_clienteArray['campo_cliente_numeroUnico_vacinas'][0]['label'].""; }
	if(trim($campos_clienteArray['campo_cliente_doenca_outros'][0]['label'])=="") { $rSqlPlataforma['campo_cliente_doenca_outros_label'] = "Digite o nome da doença, caso OUTRA"; } else { $rSqlPlataforma['campo_cliente_doenca_outros_label'] = "".$campos_clienteArray['campo_cliente_doenca_outros'][0]['label'].""; }
	
	if(trim($rSqlPlataforma['cadastro_profissional_stat'])=="" || trim($rSqlPlataforma['cadastro_profissional_stat'])=="0") { $rSqlPlataforma['cadastro_profissional_stat'] = "NAO"; } else { $rSqlPlataforma['cadastro_profissional_stat'] = "SIM"; }
	if(trim($rSqlPlataforma['cadastro_cliente_stat'])=="" || trim($rSqlPlataforma['cadastro_cliente_stat'])=="0") { $rSqlPlataforma['cadastro_cliente_stat'] = "NAO"; } else { $rSqlPlataforma['cadastro_cliente_stat'] = "SIM"; }

	if(trim($rSqlPlataforma['cadastro_profissional_assinatura'])=="" || trim($rSqlPlataforma['cadastro_profissional_assinatura'])=="0") { $rSqlPlataforma['cadastro_profissional_assinatura'] = "NAO"; } else { $rSqlPlataforma['cadastro_profissional_assinatura'] = "SIM"; }
	if(trim($rSqlPlataforma['cadastro_cliente_assinatura'])=="" || trim($rSqlPlataforma['cadastro_cliente_assinatura'])=="0") { $rSqlPlataforma['cadastro_cliente_assinatura'] = "NAO"; } else { $rSqlPlataforma['cadastro_cliente_assinatura'] = "SIM"; }

	if(trim($rSqlPlataforma['cadastro_profissional_completo_obrigatorio'])=="" || trim($rSqlPlataforma['cadastro_profissional_completo_obrigatorio'])=="0") { $rSqlPlataforma['cadastro_profissional_completo_obrigatorio'] = "NAO"; } else { $rSqlPlataforma['cadastro_profissional_completo_obrigatorio'] = "SIM"; }
	if(trim($rSqlPlataforma['cadastro_cliente_completo_obrigatorio'])=="" || trim($rSqlPlataforma['cadastro_cliente_completo_obrigatorio'])=="0") { $rSqlPlataforma['cadastro_cliente_completo_obrigatorio'] = "NAO"; } else { $rSqlPlataforma['cadastro_cliente_completo_obrigatorio'] = "SIM"; }

	if(trim($rSqlPlataforma['orcamento'])=="" || trim($rSqlPlataforma['orcamento'])=="0") { $rSqlPlataforma['orcamento'] = "0"; } else { $rSqlPlataforma['orcamento'] = "1"; }
	if(trim($rSqlPlataforma['loja_virtual'])=="" || trim($rSqlPlataforma['loja_virtual'])=="0") { $rSqlPlataforma['loja_virtual'] = "0"; } else { $rSqlPlataforma['loja_virtual'] = "1"; }
	if(trim($rSqlPlataforma['delivery'])=="" || trim($rSqlPlataforma['delivery'])=="0") { $rSqlPlataforma['delivery'] = "0"; } else { $rSqlPlataforma['delivery'] = "1"; }
	if(trim($rSqlPlataforma['exibicao_de_produtos'])=="") { $rSqlPlataforma['exibicao_de_produtos'] = "sempre"; } else { $rSqlPlataforma['exibicao_de_produtos'] = "".$rSqlPlataforma['exibicao_de_produtos'].""; }
	if(trim($rSqlPlataforma['exibicao_de_produtos_perfil'])=="") { $rSqlPlataforma['exibicao_de_produtos_perfil'] = "todos"; } else { $rSqlPlataforma['exibicao_de_produtos_perfil'] = "".$rSqlPlataforma['exibicao_de_produtos_perfil'].""; }
	if(trim($rSqlPlataforma['exibicao_de_eventos'])=="") { $rSqlPlataforma['exibicao_de_eventos'] = "sempre"; } else { $rSqlPlataforma['exibicao_de_eventos'] = "".$rSqlPlataforma['exibicao_de_eventos'].""; }
} else {
	$strSQLPlataforma = "
				SELECT 
					mod_site.numeroUnico,
					mod_site.nome,
					mod_site.checkout_com_cupom,
					mod_site.aceita_boleto,
	
					mod_site.cod_validacao_profissional,
					mod_site.cod_validacao_cliente,
	
					mod_site.campo_profissional_nome_obrigatorio,
					mod_site.campo_profissional_documento_obrigatorio,
					mod_site.campo_profissional_email_obrigatorio,
					mod_site.campo_profissional_telefone_obrigatorio,
					mod_site.campo_profissional_whatsapp_obrigatorio,

					mod_site.campo_cliente_nome_obrigatorio,
					mod_site.campo_cliente_documento_obrigatorio,
					mod_site.campo_cliente_email_obrigatorio,
					mod_site.campo_cliente_telefone_obrigatorio,
					mod_site.campo_cliente_whatsapp_obrigatorio,

					mod_site.orcamento,
					mod_site.loja_virtual,
					mod_site.delivery,
					mod_site.exibicao_de_produtos,
					mod_site.exibicao_de_produtos_perfil,
					mod_site.exibicao_de_eventos,

					mod_empresa.login_pessoa,
					
					mod_empresa.cadastro_site,
					mod_empresa.venda_produto_site,
					mod_empresa.venda_evento_site,
					mod_empresa.venda_credito_site,
					
					mod_empresa.cadastro_app,
					mod_empresa.venda_produto_app,
					mod_empresa.venda_evento_app,
					mod_empresa.venda_credito_app,
					
					mod_empresa.tipo_empresa
	
				FROM 
					site AS mod_site
				LEFT JOIN 
					empresa AS mod_empresa ON (mod_empresa.id = mod_site.empresa)

				WHERE 
					mod_site.empresa_token='".trim($empresa_tokenGet)."' AND
					mod_site.stat='1'
				";
	$rSqlPlataforma = mysql_fetch_array(mysql_query("".$strSQLPlataforma.""));

	if(trim($rSqlPlataforma['cod_validacao_profissional'])=="" || trim($rSqlPlataforma['cod_validacao_profissional'])=="0") { $rSqlPlataforma['cod_validacao_profissional'] = "0"; } else { $rSqlPlataforma['cod_validacao_profissional'] = "1"; }
	if(trim($rSqlPlataforma['cod_validacao_cliente'])=="" || trim($rSqlPlataforma['cod_validacao_cliente'])=="0") { $rSqlPlataforma['cod_validacao_cliente'] = "0"; } else { $rSqlPlataforma['cod_validacao_cliente'] = "1"; }
	
	if(trim($rSqlPlataforma['campo_profissional_nome_obrigatorio'])=="" || trim($rSqlPlataforma['campo_profissional_nome_obrigatorio'])=="1") { $rSqlPlataforma['campo_profissional_nome_obrigatorio'] = "1"; } else { $rSqlPlataforma['campo_profissional_nome_obrigatorio'] = "0"; }
	if(trim($rSqlPlataforma['campo_profissional_documento_obrigatorio'])=="" || trim($rSqlPlataforma['campo_profissional_documento_obrigatorio'])=="1") { $rSqlPlataforma['campo_profissional_documento_obrigatorio'] = "1"; } else { $rSqlPlataforma['campo_profissional_documento_obrigatorio'] = "0"; }
	if(trim($rSqlPlataforma['campo_profissional_email_obrigatorio'])=="" || trim($rSqlPlataforma['campo_profissional_email_obrigatorio'])=="1") { $rSqlPlataforma['campo_profissional_email_obrigatorio'] = "1"; } else { $rSqlPlataforma['campo_profissional_email_obrigatorio'] = "0"; }
	if(trim($rSqlPlataforma['campo_profissional_telefone_obrigatorio'])=="" || trim($rSqlPlataforma['campo_profissional_telefone_obrigatorio'])=="1") { $rSqlPlataforma['campo_profissional_telefone_obrigatorio'] = "1"; } else { $rSqlPlataforma['campo_profissional_telefone_obrigatorio'] = "0"; }
	if(trim($rSqlPlataforma['campo_profissional_whatsapp_obrigatorio'])=="" || trim($rSqlPlataforma['campo_profissional_whatsapp_obrigatorio'])=="1") { $rSqlPlataforma['campo_profissional_whatsapp_obrigatorio'] = "1"; } else { $rSqlPlataforma['campo_profissional_whatsapp_obrigatorio'] = "0"; }
	
	if(trim($rSqlPlataforma['campo_cliente_nome_obrigatorio'])=="" || trim($rSqlPlataforma['campo_cliente_nome_obrigatorio'])=="1") { $rSqlPlataforma['campo_cliente_nome_obrigatorio'] = "1"; } else { $rSqlPlataforma['campo_cliente_nome_obrigatorio'] = "0"; }
	if(trim($rSqlPlataforma['campo_cliente_documento_obrigatorio'])=="" || trim($rSqlPlataforma['campo_cliente_documento_obrigatorio'])=="1") { $rSqlPlataforma['campo_cliente_documento_obrigatorio'] = "1"; } else { $rSqlPlataforma['campo_cliente_documento_obrigatorio'] = "0"; }
	if(trim($rSqlPlataforma['campo_cliente_email_obrigatorio'])=="" || trim($rSqlPlataforma['campo_cliente_email_obrigatorio'])=="1") { $rSqlPlataforma['campo_cliente_email_obrigatorio'] = "1"; } else { $rSqlPlataforma['campo_cliente_email_obrigatorio'] = "0"; }
	if(trim($rSqlPlataforma['campo_cliente_telefone_obrigatorio'])=="" || trim($rSqlPlataforma['campo_cliente_telefone_obrigatorio'])=="1") { $rSqlPlataforma['campo_cliente_telefone_obrigatorio'] = "1"; } else { $rSqlPlataforma['campo_cliente_telefone_obrigatorio'] = "0"; }
	if(trim($rSqlPlataforma['campo_cliente_whatsapp_obrigatorio'])=="" || trim($rSqlPlataforma['campo_cliente_whatsapp_obrigatorio'])=="1") { $rSqlPlataforma['campo_cliente_whatsapp_obrigatorio'] = "1"; } else { $rSqlPlataforma['campo_cliente_whatsapp_obrigatorio'] = "0"; }

	if(trim($rSqlPlataforma['orcamento'])=="" || trim($rSqlPlataforma['orcamento'])=="0") { $rSqlPlataforma['orcamento'] = "0"; } else { $rSqlPlataforma['orcamento'] = "1"; }
	if(trim($rSqlPlataforma['loja_virtual'])=="" || trim($rSqlPlataforma['loja_virtual'])=="0") { $rSqlPlataforma['loja_virtual'] = "0"; } else { $rSqlPlataforma['loja_virtual'] = "1"; }
	if(trim($rSqlPlataforma['delivery'])=="" || trim($rSqlPlataforma['delivery'])=="0") { $rSqlPlataforma['delivery'] = "0"; } else { $rSqlPlataforma['delivery'] = "1"; }
	if(trim($rSqlPlataforma['exibicao_de_produtos'])=="") { $rSqlPlataforma['exibicao_de_produtos'] = "sempre"; } else { $rSqlPlataforma['exibicao_de_produtos'] = "".$rSqlPlataforma['exibicao_de_produtos'].""; }
	if(trim($rSqlPlataforma['exibicao_de_produtos_perfil'])=="") { $rSqlPlataforma['exibicao_de_produtos_perfil'] = "todos"; } else { $rSqlPlataforma['exibicao_de_produtos_perfil'] = "".$rSqlPlataforma['exibicao_de_produtos_perfil'].""; }
	if(trim($rSqlPlataforma['exibicao_de_eventos'])=="") { $rSqlPlataforma['exibicao_de_eventos'] = "sempre"; } else { $rSqlPlataforma['exibicao_de_eventos'] = "".$rSqlPlataforma['exibicao_de_eventos'].""; }
}

if(trim($DeviceGet)=="APP") {
	$CadastroLoginSet = "".$rSqlPlataforma['cadastro_app']."";
	$VendaProdutoSet = "".$rSqlPlataforma['venda_produto_app']."";
	$VendaEventoSet = "".$rSqlPlataforma['venda_evento_app']."";
	$VendaCreditoSet = "".$rSqlPlataforma['venda_credito_app']."";
} else {
	$CadastroLoginSet = "".$rSqlPlataforma['cadastro_site']."";
	$VendaProdutoSet = "".$rSqlPlataforma['venda_produto_site']."";
	$VendaEventoSet = "".$rSqlPlataforma['venda_evento_site']."";
	$VendaCreditoSet = "".$rSqlPlataforma['venda_credito_site']."";
}


if(trim($rSqlEmpresa['google_api_key'])=="") {
	define("GOOGLE_MAP_KEY","".$sysconfig[0]['google_api_key']."");
	$GOOGLE_MAP_KEY_SET = "".$sysconfig[0]['google_api_key']."";
} else {
	define("GOOGLE_MAP_KEY","".$rSqlEmpresa['google_api_key']."");
	$GOOGLE_MAP_KEY_SET = "".$rSqlEmpresa['google_api_key']."";
}

if(trim($rSqlEmpresa['taxa_frete_minimo_empresa'])=="" || trim($rSqlEmpresa['taxa_frete_minimo_empresa'])=="0") { $rSqlEmpresa['taxa_frete_minimo_empresa'] = 0; }
if(trim($rSqlEmpresa['taxa_frete_minimo_cms'])=="" || trim($rSqlEmpresa['taxa_frete_minimo_cms'])=="0") { $rSqlEmpresa['taxa_frete_minimo_cms'] = 0; }

if(trim($rSqlEmpresa['taxa_produto_empresa_cobra'])=="" || trim($rSqlEmpresa['taxa_produto_empresa_cobra'])=="0") { $rSqlEmpresa['taxa_produto_empresa_cobra'] = 0; }
if(trim($rSqlEmpresa['taxa_produto_empresa_km'])=="" || trim($rSqlEmpresa['taxa_produto_empresa_km'])=="0") { $rSqlEmpresa['taxa_produto_empresa_km'] = 0; }
if(trim($rSqlEmpresa['taxa_produto_cms'])=="" || trim($rSqlEmpresa['taxa_produto_cms'])=="0") { $rSqlEmpresa['taxa_produto_cms'] = 0; }

if(trim($rSqlEmpresa['taxa_produto_cms_cobra'])=="" || trim($rSqlEmpresa['taxa_produto_cms_cobra'])=="0") { $rSqlEmpresa['taxa_produto_cms_cobra'] = 0; }
if(trim($rSqlEmpresa['taxa_produto_cms_km'])=="" || trim($rSqlEmpresa['taxa_produto_cms_km'])=="0") { $rSqlEmpresa['taxa_produto_cms_km'] = 0; }
if(trim($rSqlEmpresa['taxa_produto_cms'])=="" || trim($rSqlEmpresa['taxa_produto_cms'])=="0") { $rSqlEmpresa['taxa_produto_cms'] = 0; }

$idGet = $obj->{'ID_ITEM'};
$idItemGet = $obj->{'id'};
$numeroUnicoGet = $obj->{'numeroUnico'};
$filialGet = $obj->{'filial'};
$id_viewGet = $obj->{'id_view'};
$cod_voucherGet = $obj->{'cod_voucher'};
$tokenGet = $obj->{'TOKEN'};
$userGet = $obj->{'USER_TOKEN'};
$userEnvGet = $obj->{'USER_TOKEN_usuario'};
$TELA_LOCAL = $obj->{'TELA_LOCAL'};

$hash_da_contaGet = $obj->{'perfil'}->{'hash_da_conta'};
$empresaGet = $obj->{'perfil'}->{'empresa'};
$campoUpdateGet = $obj->{'campo'};

$idPerfilGet = $obj->{'id_usuario'};
if(trim($idPerfilGet)=="") {
	$idPerfilGet = $obj->{'perfil'}->{'id'};
}

$numeroUnicoPerfilGet = $obj->{'perfil'}->{'numeroUnico'};

$local_solicitacaoGet = $obj->{'local_solicitacao'};
$local_loginGet = $obj->{'local_login'};
$local_pagamentoGet = $obj->{'local_pagamento'};
$carrinhoGet = $obj->{'carrinho'};
$itemsGet = $obj->{'items'};
$carrinhoDetalhadoGet = $obj->{'carrinhoDetalhado'};
$carrinhoRepeticoesGet = $obj->{'carrinhoRepeticoes'};
$treinoIntervalosGet = $obj->{'treinoIntervalos'};

$mes_dashboardGet = $obj->{'mes_dashboard'}; 

$valor_taxa_frete_minimo_empresaGet = $obj->{'valor_taxa_frete_minimo_empresa'}; 
$valor_taxa_frete_minimo_cmsGet = $obj->{'valor_taxa_frete_minimo_cms'}; 

$valor_taxa_produto_empresa_cobraGet = $obj->{'valor_taxa_produto_empresa_cobra'}; 
$valor_taxa_produto_empresa_kmGet = $obj->{'valor_taxa_produto_empresa_km'}; 
$valor_taxa_produto_empresaGet = $obj->{'valor_taxa_produto_empresa'}; 

$valor_taxa_produto_cms_cobraGet = $obj->{'valor_taxa_produto_cms_cobra'}; 
$valor_taxa_produto_cms_kmGet = $obj->{'valor_taxa_produto_cms_km'}; 
$valor_taxa_produto_cmsGet = $obj->{'valor_taxa_produto_cms'}; 

$moduloGet = $obj->{'modulo'};
$numeroUnico_pasta_paiGet = $obj->{'numeroUnico_pasta_pai'};
$numeroUnico_arquivoGet = $obj->{'numeroUnico_arquivo'};
$nome_arquivoGet = $obj->{'nome_arquivo'};

$documento_numeroUnicoGet = $obj->{'documento_numeroUnico'};
$documento_nomeGet = $obj->{'documento_nome'};

$contato_numeroUnicoGet = $obj->{'contato_numeroUnico'};
$contato_usuarioGet = $obj->{'contato_usuario'};
$contato_nomeGet = $obj->{'contato_nome'};
$contato_generoGet = $obj->{'contato_genero'};
$contato_genero_htmlGet = $obj->{'contato_genero_html'};
$contato_imagem_perfilGet = $obj->{'contato_imagem_perfil'};

$audioGet = $obj->{'audio'};
$videoGet = $obj->{'video'};
$adicionaisGet = $obj->{'adicionaisItems'};
$campoUpdate = $obj->{'campo'};
$carteiraGet = $obj->{'carteira'};
$campo_buscaGet = $obj->{'campo_busca'};
$ativosGet = $obj->{'ativos'};
$todosGet = $obj->{'todos'};
$updateGet = $obj->{'update'};
$confirmadosGet = $obj->{'confirmados'};
$confirmaGet = $obj->{'confirma'};
$emailGet = $obj->{'email'};
$produtoGet = $obj->{'produto'}; 
$cod_validacaoGet = $obj->{'cod_validacao'};
$cod_validacao_clienteGet = $obj->{'cod_validacao_cliente'};
$cod_validacao_profissionalGet = $obj->{'cod_validacao_profissional'};
$local_updateGet = $obj->{'local_update'};
$nomeGet = $obj->{'nome'};
$usuarioGet = $obj->{'usuario'};
$subtituloGet = $obj->{'subtitulo'};
$passwordGet = $obj->{'password'};
$valorGet = $obj->{'valor'};
$valor_pagamentoGet = $obj->{'valor_pagamento'};
$valor_promocionalGet = $obj->{'valor_promocional'};
$valor_creditoGet = $obj->{'valor_credito'};
$carrinhoTotalTaxaGet = $obj->{'carrinhoTotalTaxa'};
$carrinhoTotalFreteGet = $obj->{'carrinhoTotalFrete'};
$valor_subtotalGet = $obj->{'valor_subtotal'};
$valor_totalGet = $obj->{'valor_total'};
$valor_trocoGet = $obj->{'valor_troco'};
$tipo_checkoutGet = $obj->{'tipo_checkout'};
$formas_pagamentoGet = $obj->{'formas_pagamento'};
$forma_pagamentoGet = $obj->{'forma_pagamento'};
$quantidade_de_parcelasGet = $obj->{'quantidade_de_parcelas'};
$qtd_parcelasGet = $obj->{'qtd_parcelas'};
$cpfGet = $obj->{'cpf'};
$cnpjGet = $obj->{'cnpj'};
$midia_localGet = $obj->{'midia_local'};
$tagGet = $obj->{'tag'};

$tipo_redesGet = $obj->{'tipo_redes'};
$token_redesGet = $obj->{'token_redes'};
$photo_redesGet = $obj->{'photo_redes'};

$pessoa_nomeGet = $obj->{'pessoa_nome'};
$pessoa_emailGet = $obj->{'pessoa_email'};
$pessoa_documentoGet = $obj->{'pessoa_documento'};
$pessoa_generoGet = $obj->{'pessoa_genero'};
$pessoa_data_de_nascimentoGet = $obj->{'pessoa_data_de_nascimento'};
$pessoa_telefoneGet = $obj->{'pessoa_telefone'};

$tipo_descontoGet = $obj->{'tipo_desconto'};
$desconto_porcentagemGet = $obj->{'desconto_porcentagem'};
$desconto_valorGet = $obj->{'desconto_valor'};
$informacoesGet = $obj->{'informacoes'};

$fromGet = $obj->{'from'};
$toGet = $obj->{'to'};
$historicoGet = $obj->{'historico'};

$seriesGet = $obj->{'series'}; 
$dropGet = $obj->{'drop'}; 
$obsGet = $obj->{'obs'};
$tipo_de_envioGet = $obj->{'tipo_de_envio'};

$data_inicioGet = $obj->{'data_inicio'};
$avaliacao_intensidadeGet = $obj->{'avaliacao_intensidade'};
$avaliacao_qualidadeGet = $obj->{'avaliacao_qualidade'};
$avaliacao_txtGet = $obj->{'avaliacao_txt'};

$valor_aberturaGet = $obj->{'valor_abertura'};
$valor_fechamentoGet = $obj->{'valor_fechamento'};
$valor_sangriaGet = $obj->{'valor_sangria'};
$valor_a_receber_originalGet = $obj->{'valor_a_recer'};
$valor_a_receberGet = $obj->{'valor_a_recer'};
$gestor_loginGet = $obj->{'gestor_login'};
$gestor_senhaGet = $obj->{'gestor_senha'};

$caracteristicaGet = $obj->{'caracteristica'};
$notaGet = $obj->{'nota'};
$aceitouGet = $obj->{'aceitou'};
$tipoGet = $obj->{'tipo'};
$tipo_visualizacaoGet = $obj->{'tipo_visualizacao'};

$tipo_UGet = $obj->{'tipo_U'};
$tipo_CFGet = $obj->{'tipo_CF'};
$tipo_CMGet = $obj->{'tipo_CM'};
$tipo_MGet = $obj->{'tipo_M'};
$tipo_FGet = $obj->{'tipo_F'};
$tipo_GGet = $obj->{'tipo_G'};

$tipo_genero_UGet = $obj->{'tipo_genero_U'};
$tipo_genero_CFGet = $obj->{'tipo_genero_CF'};
$tipo_genero_CMGet = $obj->{'tipo_genero_CM'};
$tipo_genero_MGet = $obj->{'tipo_genero_M'};
$tipo_genero_FGet = $obj->{'tipo_genero_F'};
$tipo_genero_GGet = $obj->{'tipo_genero_G'};

$horasGet = $obj->{'horas'};
$numeroUnicoGet = $obj->{'numeroUnico'};
$numeroUnico_categorias_de_grupoGet = $obj->{'numeroUnico_categorias_de_grupo'};
$numeroUnico_perfilGet = $obj->{'numeroUnico_perfil'};
$numeroUnico_pessoaGet = $obj->{'numeroUnico_pessoa'};
$numeroUnico_pessoa_recebeuGet = $obj->{'numeroUnico_pessoa_recebeu'};
$numeroUnico_profissionalGet = $obj->{'numeroUnico_profissional'};
$numeroUnico_categorias_de_produtosGet = $obj->{'numeroUnico_categorias_de_produtos'};
$numeroUnico_propostaGet = $obj->{'numeroUnico_proposta'};
$numeroUnico_itemGet = $obj->{'numeroUnico_item'};
$numeroUnico_sysgrupousuarioGet = $obj->{'numeroUnico_sysgrupousuario'};
$numeroUnico_retornos_de_validacaoGet = $obj->{'numeroUnico_retornos_de_validacao'};
$numeroUnico_filialGet = $obj->{'numeroUnico_filial'};
$numeroUnico_solicitacaoGet = $obj->{'numeroUnico_solicitacao'};
$numeroUnico_fingerGet = $obj->{'numeroUnico_finger'};
$numeroUnico_fluxo_caixaGet = $obj->{'numeroUnico_fluxo_caixa'};
$numeroUnico_referenciaGet = $obj->{'numeroUnico_referencia'};
$numeroUnico_paiGet = $obj->{'numeroUnico_pai'};
$numeroUnico_carrinhoGet = $obj->{'numeroUnico_carrinho'};
$numeroUnico_campanhaGet = $obj->{'numeroUnico_campanha'};
$numeroUnico_compradorGet = $obj->{'numeroUnico_comprador'};
$numeroUnico_usuarioGet = $obj->{'numeroUnico_usuario'};
$numeroUnico_eventoGet = $obj->{'numeroUnico_evento'};
$numeroUnico_ticketGet = $obj->{'numeroUnico_ticket'};
$numeroUnico_loteGet = $obj->{'numeroUnico_lote'};
$categorias_de_pessoasGet = $obj->{'categorias_de_pessoas'};
$tipo_itemGet = $obj->{'tipo_item'};
$hora_limiteGet = $obj->{'hora_limite'};
$qtd_limiteGet = $obj->{'qtd_limite'};
$statGet = $obj->{'stat'};
$qtdGet = $obj->{'qtd'};
$cupomGet = $obj->{'cupom'};
$linhaGet = $obj->{'linha'};
$colunaGet = $obj->{'coluna'};
$linha_realGet = $obj->{'linha_real'};
$coluna_realGet = $obj->{'coluna_real'};
$labelGet = $obj->{'label'};
$statusGet = $obj->{'status'};
$acentoControleGet = $obj->{'acentoControle'};
$cadeira_txtGet = $obj->{'cadeira_txt'};
$vigencia_tipoGet = $obj->{'vigencia_tipo'};
$vigencia_qtdGet = $obj->{'vigencia_qtd'};
$fechadoGet = $obj->{'fechado'};
$loteGet = $obj->{'lote'};
$compra_autorizadaGet = $obj->{'compra_autorizada'};

$numeroUnico_eventos_stat5Get = $obj->{'numeroUnico_eventos_stat5'};
$numeroUnico_lote_stat5Get = $obj->{'numeroUnico_lote_stat5'};
$data_aplicacao_stat5Get = $obj->{'data_aplicacao_stat5'};

$numeroUnico_eventos_stat6Get = $obj->{'numeroUnico_eventos_stat6'};
$numeroUnico_lote_stat6Get = $obj->{'numeroUnico_lote_stat6'};
$data_aplicacao_stat6Get = $obj->{'data_aplicacao_stat6'};

$message_replyGet = $obj->{'message_reply'};
$messageGet = $obj->{'message'};

$carrega_paginaQtdGet = $obj->{'carrega_paginaQtd'};
$paginaQtdGet = $obj->{'paginaQtd'};
$paginaGet = $obj->{'pagina'};
$searchGet = $obj->{'search'};

$latitudeGet = $obj->{'latitude'};
$longitudeGet = $obj->{'longitude'};
$latitude_atualGet = $obj->{'latitude_atual'};
$longitude_atualGet = $obj->{'longitude_atual'};

$latitude_entregadorGet = $obj->{'latitude_entregador'};
$longitude_entregadorGet = $obj->{'longitude_entregador'};

$motivo_cancelamentoGet = $obj->{'motivo_cancelamento'};
$galeriaGet = $obj->{'galeria'};
$galeria2Get = $obj->{'galeria2'};

$tit_cpfGet = $obj->{'tit_cpf'};
$tit_data_de_nascimentoGet = $obj->{'tit_data_de_nascimento'};
$tit_nomeGet = $obj->{'tit_nome'};
$tit_cepGet = $obj->{'tit_cep'};
$tit_ruaGet = $obj->{'tit_rua'};
$tit_numeroGet = $obj->{'tit_numero'};
$tit_complementoGet = $obj->{'tit_complemento'};
$tit_estadoGet = $obj->{'tit_estado'};
$tit_cidadeGet = $obj->{'tit_cidade'};
$tit_bairroGet = $obj->{'tit_bairro'};
$tit_emailGet = $obj->{'tit_email'};
$tit_dddGet = $obj->{'tit_ddd'};
$tit_telefoneGet = $obj->{'tit_telefone'};

$cartao_binGet = $obj->{'cartao_bin'};
$cartao_numeroGet = $obj->{'cartao_numero'};
$cartao_validadeGet = $obj->{'cartao_validade'};
$cartao_cvvGet = $obj->{'cartao_cvv'};
$cartao_expiracaoGet = $obj->{'cartao_expiracao'};
$card_cvvGet = $obj->{'card_cvv'};

$titular_nomeGet = $obj->{'titular_nome'};
$titular_cpfGet = $obj->{'titular_cpf'};
$titular_emailGet = $obj->{'titular_email'};
$titular_telefoneGet = $obj->{'titular_telefone'};

$endereco_idGet = $obj->{'endereco_id'};
$fp_tipoGet = $obj->{'fp_tipo'};
$fp_idGet = $obj->{'fp_id'};
$card_binGet = $obj->{'card_bin'};
$card_numberGet = $obj->{'card_number'};
$card_nameGet = $obj->{'card_name'};
$card_cpfGet = $obj->{'card_cpf'};
$card_cvcGet = $obj->{'card_cvc'};
$codigo_validacaoGet = $obj->{'codigo_validacao'};

if(trim($obj->{'card_expiry'})=="") {
	$card_expiry_mesGet = $obj->{'card_expiry_mes'};
	if(strlen($obj->{'card_expiry_ano'})>2) {
		$card_expiry_anoGet = substr($obj->{'card_expiry_ano'},-2);
	} else {
		$card_expiry_anoGet = $obj->{'card_expiry_ano'};
	}
	$card_expiryGet = $card_expiry_mesGet.$card_expiry_anoGet;
} else {
	$card_expiryGet = $obj->{'card_expiry'};
}

$senhaGet = $obj->{'senha'};
$conf_senhaGet = $obj->{'conf_senha'};
$nova_senhaGet = $obj->{'nova_senha'};
$senha_eventoGet = $obj->{'senha_evento'};
$senha_notificaGet = $obj->{'senha_notifica'};

$numeroUnico_localGet = $obj->{'numeroUnico_local'};
$local_setadoGet = $obj->{'local_setado'};
$login_emailGet = $obj->{'login_email'};
$login_senhaGet = $obj->{'login_senha'};

$navegacaoGet = $obj->{'navegacao'};
$url_amigavelGet = $obj->{'url_amigavel'};
$nomeGet = $obj->{'nome'};
$emailGet = $obj->{'email'};
$email_validoGet = $obj->{'email_valido'};
$telefoneGet = $obj->{'telefone'};
$generoGet = $obj->{'genero'};
$numeroUnico_etniasGet = $obj->{'numeroUnico_etnias'};
$whatsappGet = $obj->{'whatsapp'};
$whatsapp_validoGet = $obj->{'whatsapp_valido'};
$aceita_whatsappGet = $obj->{'aceita_whatsapp'};
$telefone_celularGet = $obj->{'telefone_celular'};
$telefone_celular_smsGet = $obj->{'telefone_celular_sms'};
$codigo_smsGet = $obj->{'codigo_sms'};
$cpfGet = $obj->{'cpf'};
$confereGet = $obj->{'confere'};
$documentoGet = $obj->{'documento'};
$data_de_nascimentoGet = $obj->{'data_de_nascimento'};
$cepGet = $obj->{'cep'};
$numeroUnico_tipos_de_logradouroGet = $obj->{'numeroUnico_tipos_de_logradouro'};
$ruaGet = $obj->{'rua'};
$numeroGet = $obj->{'numero'};
$complementoGet = $obj->{'complemento'};
$estadoGet = $obj->{'estado'};
$cidadeGet = $obj->{'cidade'};
$id_cidadeGet = $obj->{'id_cidade'};
$bairroGet = $obj->{'bairro'};
$id_bairroGet = $obj->{'id_bairro'};
$atividadesGet = $obj->{'atividades'};
$tipo_cadastroGet = $obj->{'tipo_cadastro'};
$nome_da_maeGet = $obj->{'nome_da_mae'};

$aceito_termosGet = $obj->{'aceito_termos'};
$aceito_politicaGet = $obj->{'aceito_politica'};
$aceite_extra_1Get = $obj->{'aceite_extra_1'};

$bancoGet = $obj->{'banco'};
$agenciaGet = $obj->{'agencia'};
$contaGet = $obj->{'conta'};
$digitoGet = $obj->{'digito'};

$bikeGet = $obj->{'bike'};
$motoGet = $obj->{'moto'};
$caminhaoGet = $obj->{'caminhao'};
$apeGet = $obj->{'ape'};

$numeroUnico_publicacaoGet = $obj->{'numeroUnico_publicacao'};
$numeroUnico_comentarioGet = $obj->{'numeroUnico_comentario'};
$textoGet = $obj->{'texto'};
$videoGet = $obj->{'video'};
$video_linkGet = $obj->{'video_link'};
$imagem_doc_frente_base64Get = $obj->{'imagem_doc_frente'};
$imagem_doc_verso_base64Get = $obj->{'imagem_doc_verso'};
$filenameGet = $obj->{'filename'};

if(trim($obj->{'imagem_de_capa_ticket'})=="") {
	$imagem_de_capa_ticketGet = NULL;
} else {
	$imagem_de_capa_ticketGet = $obj->{'imagem_de_capa_ticket'};
}

if(trim($obj->{'imagem_de_icone'})=="") {
	$imagem_de_iconeGet = NULL;
} else {
	$imagem_de_iconeGet = $obj->{'imagem_de_icone'};
}

if(trim($obj->{'imagem_de_capa'})=="") {
	$imagem_de_capaGet = NULL;
} else {
	$imagem_de_capaGet = $obj->{'imagem_de_capa'};
}

if(trim($obj->{'imagem_de_banner'})=="") {
	$imagem_de_bannerGet = NULL;
} else {
	$imagem_de_bannerGet = $obj->{'imagem_de_banner'};
}

if(trim($obj->{'imagem_de_capa_base64'})=="") {
	$imagem_de_capa_base64Get = NULL;
} else {
	$imagem_de_capa_base64Get = $obj->{'imagem_de_capa_base64'};
}

if(trim($obj->{'imagem_perfil'})=="") {
	if(trim($obj->{'imagem_perfil_base64'})=="") {
		$imagem_perfil_base64Get = NULL;
	} else {
		$imagem_perfil_base64Get = $obj->{'imagem_perfil_base64'};
	}
} else {
	$imagem_perfil_base64Get = $obj->{'imagem_perfil'};
}

if(trim($obj->{'imagem_publica'})=="") {
	$imagem_publicaGet = "";
} else {
	$imagem_publicaGet = $obj->{'imagem_publica'};
}

if(trim($obj->{'imagem_privada'})=="") {
	$imagem_privadaGet = "";
} else {
	$imagem_privadaGet = $obj->{'imagem_privada'};
}

if(trim($obj->{'imagem'})=="") {
	$imagemGet = "";
} else {
	$imagemGet = $obj->{'imagem'};
}


$taxa_comissarioGet = $obj->{'taxa_comissario'};
$qtd_homemGet = $obj->{'qtd_homem'};
$qtd_mulherGet = $obj->{'qtd_mulher'};
$periodo_deGet = $obj->{'periodo_de'};
$periodo_ateGet = $obj->{'periodo_ate'};
$id_compraGet = $obj->{'id_compra'};
$local_publicacoesGet = $obj->{'local_publicacoes'};

$usuario_numeroUnicoGet = $obj->{'usuario_numeroUnico'};
$usuario_nomeGet = $obj->{'usuario_nome'};

$objetoComboGet = $obj->{'objetoCombo'};
$modelo_envioGet = $obj->{'modelo_envio'};
$numeroUnico_comentario_paiGet = $obj->{'numeroUnico_comentario_pai'};
$estados_selecionadosGet = $obj->{'estados_selecionados'};
$sexoGet = $obj->{'sexo'};
$usuario_tipoGet = $obj->{'usuario_tipo'};
$tituloGet = $obj->{'titulo'};
$mensagemGet = $obj->{'mensagem'};
$detalheGet = $obj->{'detalhe'};
$observacaoGet = $obj->{'observacao'};
$codigoGet = $obj->{'codigo'};

$valor_maximoGet = $obj->{'valor_maximo'};
$diaGet = $obj->{'dia'};
$hora_deGet = $obj->{'hora_de'};
$hora_ateGet = $obj->{'hora_ate'};
$hora_inicioGet = $obj->{'hora_inicio'};
$hora_fimGet = $obj->{'hora_fim'};
$descricaoGet = $obj->{'descricao'};
$data_do_eventoGet = $obj->{'data_do_evento'};
$data_de_publicacaoGet = $obj->{'data_de_publicacao'};
$data_de_despublicacaoGet = $obj->{'data_de_despublicacao'};

$orderIdGet = $obj->{'orderId'};
$authCodeGet = $obj->{'authCode'};
$brandGet = $obj->{'brand'};
$applicationIdGet = $obj->{'applicationId'};
$primaryProductNameGet = $obj->{'primaryProductName'};
$externalCallMerchantCodeGet = $obj->{'externalCallMerchantCode'};
$applicationNameGet = $obj->{'applicationName'};
$paymentTransactionIdGet = $obj->{'paymentTransactionId'};
$binGet = $obj->{'bin'};
$originalTransactionIdGet = $obj->{'originalTransactionId'};
$cardLabelApplicationGet = $obj->{'cardLabelApplication'};
$merchantNameGet = $obj->{'merchantName'};
$cardCaptureTypeGet = $obj->{'cardCaptureType'};
$requestDateGet = $obj->{'requestDate'};
$numberOfQuotasGet = $obj->{'numberOfQuotas'};
$cieloCodeGet = $obj->{'cieloCode'};

include("".$localGet.".php");
?>