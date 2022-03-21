<?
$mod = "empresa";
if(trim($_FILES["logotipo_topo"]["name"])=="") { } else {
	upload_arquivo_nativo("".$mod."","logotipo_topo","");
	$novo_nome = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($_FILES["logotipo_topo"]["name"]));
	$novo_nome = str_replace(" ","_",$novo_nome);
	$novo_nome = strtolower($novo_nome);
	$img_img_b64 = file_get_contents("https:".$link."files/".$mod."/".$_POST['numeroUnico']."/".$novo_nome.""); 
	$data_img_b64 = base64_encode($img_img_b64);
	$_POST['logotipo_topo'] =  $data_img_b64;
	unlink("https:".$link."files/".$mod."/".$_POST['numeroUnico']."/".$novo_nome."");
	file_put_contents("/var/www/html/admin/files/empresa/".$_POST['numeroUnico']."/logotipo_topo.png",base64_decode($_POST['logotipo_topo']));
}

if(trim($_FILES["logotipo_rodape"]["name"])=="") { } else {
	upload_arquivo_nativo("".$mod."","logotipo_rodape","");
	$novo_nome = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($_FILES["logotipo_rodape"]["name"]));
	$novo_nome = str_replace(" ","_",$novo_nome);
	$novo_nome = strtolower($novo_nome);
	$img_img_b64 = file_get_contents("https:".$link."files/".$mod."/".$_POST['numeroUnico']."/".$novo_nome.""); 
	$data_img_b64 = base64_encode($img_img_b64);
	$_POST['logotipo_rodape'] =  $data_img_b64;
	unlink("https:".$link."files/".$mod."/".$_POST['numeroUnico']."/".$novo_nome."");
	file_put_contents("/var/www/html/admin/files/empresa/".$_POST['numeroUnico']."/logotipo_rodape.png",base64_decode($_POST['logotipo_rodape']));
}

$COORDENADAS = latitude_longitude($_POST,"",$GOOGLE_MAP_KEY_SET);
$_POST['latitude'] = $COORDENADAS['latitude'];
$_POST['longitude'] = $COORDENADAS['longitude'];

if(trim($_POST['tipo_documento_cadastro'])=="cpf" ) {
	$_POST['documento'] = $_POST['documento_cpf'];
} else if(trim($_POST['tipo_documento_cadastro'])=="cnpj" ) {
	$_POST['documento'] = $_POST['documento_cnpj'];
}

$_POST['documento'] = preg_replace("/[^0-9]/", "",$_POST['documento']);

$_POST['senha_conf'] = str_replace(" ","",$_POST['senha']);
$_POST['senha'] = str_replace(" ","",$_POST['senha']);
if(trim($_POST['senha'])!="") { $_POST['senha'] = md5($_POST['senha']); }

if(trim($_POST['estado'])=="") { 
	if(trim($_POST['cidade_id'])=="") { } else {
		$cidade = mysql_fetch_array(mysql_query("SELECT cidade FROM cepbr_cidade WHERE id_cidade='".$_POST['cidade_id']."'"));
		$_POST['cidade'] = "".$cidade['cidade']."";
		$_POST['cidade_id'] = $_POST['cidade_id'];
	}
} else {
	if(trim($_POST['cidade'])=="") { } else {
		$cidade = mysql_fetch_array(mysql_query("SELECT id_cidade FROM cepbr_cidade WHERE cidade='".$_POST['cidade']."' AND uf='".$estadoGet."'"));
		$_POST['cidade_id'] = $cidade['id_cidade'];
	}
	if(trim($_POST['cidade_id'])=="") { } else {
		$cidade = mysql_fetch_array(mysql_query("SELECT cidade FROM cepbr_cidade WHERE id_cidade='".$_POST['cidade_id']."'"));
		$_POST['cidade'] = "".$cidade['cidade']."";
		$_POST['cidade_id'] = $_POST['cidade_id'];
	}
}
if(trim($_POST['cidade_id'])=="") { 
	if(trim($_POST['bairro_id'])=="") { } else {
		$bairro = mysql_fetch_array(mysql_query("SELECT bairro FROM cepbr_bairro WHERE id_bairro='".$_POST['bairro_id']."'"));
		$_POST['bairro'] = "".$bairro['bairro']."";
		$_POST['bairro_id'] = $_POST['bairro_id'];
	}
} else {
	if(trim($_POST['bairro'])=="") { } else {
		$bairro = mysql_fetch_array(mysql_query("SELECT id_bairro FROM cepbr_bairro WHERE bairro='".$_POST['bairro']."' AND id_cidade='".$_POST['cidade_id']."'"));
		$_POST['bairro_id'] = $bairro['id_bairro'];
	}
	if(trim($_POST['bairro_id'])=="") { } else {
		$bairro = mysql_fetch_array(mysql_query("SELECT bairro FROM cepbr_bairro WHERE id_bairro='".$_POST['bairro_id']."'"));
		$_POST['bairro'] = "".$bairro['bairro']."";
		$_POST['bairro_id'] = $_POST['bairro_id'];
	}
}

$whatsappGet = preg_replace("/[^0-9]/", "",$_POST['whatsapp']);
if(trim($whatsappGet)=="") { 
	$_POST['whatsapp_valido'] = "0";
} else {
	$retorno_verifica_whatsapp = verificaWhatsApp("".$empresa_idSet."","".$whatsappGet."");

	if(trim($retorno_verifica_whatsapp)=="SIM") {
		$_POST['whatsapp_valido'] = "1";
	} else {
		$_POST['whatsapp_valido'] = "0";
	}
}

$numeroUnico_eventoGet = $_POST['numeroUnico_evento'];
$emailGet = str_replace(" ","",$_POST['email']);
if(trim($emailGet)=="") {
	$_POST['email_valido'] = "0";
	$_POST['email_valido_checado'] = "0";
} else {
	if(trim($numeroUnico_eventoGet)=="") { 
		$_POST['email_valido'] = "0";
		$_POST['email_valido_checado'] = "0";
	} else {
		$retorno_verifica_email = verificaEmail("".$emailGet."");
		if($retorno_verifica_email=="valid") {
			$_POST['email_valido'] = "1";
			$_POST['email_valido_checado'] = "1";
		} else {
			$_POST['email_valido'] = "0";
			$_POST['email_valido_checado'] = "0";
		}
	}
}

if(trim($_POST['pessoa_nome'])=="" || trim($_POST['pessoa_nome'])=="0") { $_POST['pessoa_nome'] = "0"; } else { $_POST['pessoa_nome'] = "1"; }
if(trim($_POST['pessoa_documento'])=="" || trim($_POST['pessoa_documento'])=="0") { $_POST['pessoa_documento'] = "0"; } else { $_POST['pessoa_documento'] = "1"; }
if(trim($_POST['pessoa_email'])=="" || trim($_POST['pessoa_email'])=="0") { $_POST['pessoa_email'] = "0"; } else { $_POST['pessoa_email'] = "1"; }
if(trim($_POST['pessoa_whatsapp'])=="" || trim($_POST['pessoa_whatsapp'])=="0") { $_POST['pessoa_whatsapp'] = "0"; } else { $_POST['pessoa_whatsapp'] = "1"; }
if(trim($_POST['pessoa_genero'])=="" || trim($_POST['pessoa_genero'])=="0") { $_POST['pessoa_genero'] = "0"; } else { $_POST['pessoa_genero'] = "1"; }

if(trim($_POST['pessoa_nome_obrigatorio'])=="" || trim($_POST['pessoa_nome_obrigatorio'])=="0") { $_POST['pessoa_nome_obrigatorio'] = "0"; } else { $_POST['pessoa_nome_obrigatorio'] = "1"; }
if(trim($_POST['pessoa_documento_obrigatorio'])=="" || trim($_POST['pessoa_documento_obrigatorio'])=="0") { $_POST['pessoa_documento_obrigatorio'] = "0"; } else { $_POST['pessoa_documento_obrigatorio'] = "1"; }
if(trim($_POST['pessoa_email_obrigatorio'])=="" || trim($_POST['pessoa_email_obrigatorio'])=="0") { $_POST['pessoa_email_obrigatorio'] = "0"; } else { $_POST['pessoa_email_obrigatorio'] = "1"; }
if(trim($_POST['pessoa_whatsapp_obrigatorio'])=="" || trim($_POST['pessoa_whatsapp_obrigatorio'])=="0") { $_POST['pessoa_whatsapp_obrigatorio'] = "0"; } else { $_POST['pessoa_whatsapp_obrigatorio'] = "1"; }
if(trim($_POST['pessoa_genero_obrigatorio'])=="" || trim($_POST['pessoa_genero_obrigatorio'])=="0") { $_POST['pessoa_genero_obrigatorio'] = "0"; } else { $_POST['pessoa_genero_obrigatorio'] = "1"; }

if(trim($_POST['acaoForm'])=="editar" || trim($_POST['acaoForm'])=="editar-continuar") {

	$rSqlPessoaEmail = mysql_fetch_array(mysql_query("SELECT email FROM pdv WHERE id='".$_POST['iditem']."'"));
	if(trim($rSqlPessoaEmail['email'])==trim($_POST['email'])) { 
		$_POST['email_valido'] = "1";
		$_POST['email_valido_checado'] = "1";
	} else {
		$_POST['email_valido'] = "0";
		$_POST['email_valido_checado'] = "0";
	}

	$rSqlPessoaObjeto = mysql_fetch_array(mysql_query("SELECT * FROM pdv WHERE id='".$_POST['iditem']."'"));
	if(trim($rSqlPessoaObjeto['objetoModificacoes'])=="") { 
		$modificacoesControle[] = array("tag" => "modificacoes", 
										"numeroUnico" => "".geraCodReturn()."", 
										"sysusu" => "".$rSqlPessoaObjeto['id']."", 
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
	
	$_POST['empresa'] = $rSqlEmpresa['id'];
	$_POST['empresa_token'] = $rSqlEmpresa['token']; 
	$_POST['dataModificacao'] = $data; 
	$modificacoesControle[] = array("tag" => "modificacoes", 
									"numeroUnico" => "".geraCodReturn()."", 
									"sysusu" => "".$sysusu['id']."", 
									"post" => $_POST, 
									"data" => "".$data."");
	
	$modificacoesControleSerial = serialize($modificacoesControle);

	if(trim($_FILES["logotipo_topo"]["name"])=="") { } else { $_POST['logotipo_topo'] = " logotipo_topo='".$_POST['logotipo_topo']."', "; }
	if(trim($_FILES["logotipo_rodape"]["name"])=="") { } else { $_POST['logotipo_rodape'] = " logotipo_rodape='".$_POST['logotipo_rodape']."', "; }

	$updateOrdemSet = "";
	$carrinhoArray = unserialize($_SESSION['imp_pdv_ordenacao_'.$_SESSION['numeroUnicoGerado'].'']);
	$carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
	foreach ($carrinhoArray as $key => $value) {
		$updateOrdemSet .= " ".$value["campo"]."='".$value["ordem"]."', ";
	}

	$update = mysql_query("
							UPDATE 
								pdv 
							SET 
								empresa='".$rSqlEmpresa['id']."', 
								empresa_token='".$rSqlEmpresa['token']."', 

								".$_POST['logotipo_topo']." 
								".$_POST['logotipo_rodape']." 

								pessoa_nome='".$_POST['pessoa_nome']."',
								pessoa_documento='".$_POST['pessoa_documento']."',
								pessoa_email='".$_POST['pessoa_email']."',
								pessoa_whatsapp='".$_POST['pessoa_whatsapp']."',
								pessoa_genero='".$_POST['pessoa_genero']."',

								pessoa_nome_obrigatorio='".$_POST['pessoa_nome_obrigatorio']."',
								pessoa_documento_obrigatorio='".$_POST['pessoa_documento_obrigatorio']."',
								pessoa_email_obrigatorio='".$_POST['pessoa_email_obrigatorio']."',
								pessoa_whatsapp_obrigatorio='".$_POST['pessoa_whatsapp_obrigatorio']."',
								pessoa_genero_obrigatorio='".$_POST['pessoa_genero_obrigatorio']."',

								texto_topo='".$_POST['texto_topo']."',
								texto_rodape='".$_POST['texto_rodape']."',

								nome='".$_POST['nome']."',
								tipo_documento='".$_POST['tipo_documento_cadastro']."',
								documento='".$_POST['documento']."',
								senha='".$_POST['senha']."',
								senha_conf='".$_POST['senha_conf']."',
								email='".$_POST['email']."',
								email_valido='".$_POST['email_valido']."',
								email_valido_checado='".$_POST['email_valido_checado']."',
								whatsapp='".$_POST['whatsapp']."',
								aceita_whatsapp='".$_POST['aceita_whatsapp']."',
								whatsapp_valido='".$_POST['whatsapp_valido']."',
								whatsapp_valido_checado='".$_POST['whatsapp_valido_checado']."',
								cep='".$_POST['cep']."',
								numeroUnico_tipos_de_logradouro='".$_POST['numeroUnico_tipos_de_logradouro']."',
								rua='".$_POST['rua']."',
								numero='".$_POST['numero']."',
								complemento='".$_POST['complemento']."',
								bairro='".$_POST['bairro']."',
								bairro_id='".$_POST['bairro_id']."',
								cidade='".$_POST['cidade']."',
								cidade_id='".$_POST['cidade_id']."',
								estado='".$_POST['estado']."',
								latitude='".$_POST['latitude']."',
								longitude='".$_POST['longitude']."',
								pdv_plataforma='".$_POST['pdv_plataforma']."',
								perfil='".$_POST['perfil']."',
								split='".$_POST['split']."',
								abertura='".$_POST['abertura']."',
								sangria='".$_POST['sangria']."',
								fechamento='".$_POST['fechamento']."',
								relatorio='".$_POST['relatorio']."',
								busca='".$_POST['busca']."',
								ccr='".$_POST['ccr']."',
								ccd='".$_POST['ccd']."',
								din='".$_POST['din']."',
								pix='".$_POST['pix']."',
								cortesia='".$_POST['cortesia']."',
								tipo_maquina='".$_POST['tipo_maquina']."',
								tipo_checkout='".$_POST['tipo_checkout']."',
								parcelamento='".$_POST['parcelamento']."',
								venda_com_registro='".$_POST['venda_com_registro']."',
								limite_carrinho='".$_POST['limite_carrinho']."',

								imp_imagem_do_evento_label='".$_POST['imp_imagem_do_evento_label']."',
								imp_empresa_logo_label='".$_POST['imp_empresa_logo_label']."',
								imp_data_do_evento_label='".$_POST['imp_data_do_evento_label']."',
								imp_pdv_id_label='".$_POST['imp_pdv_id_label']."',
								imp_pdv_nome_label='".$_POST['imp_pdv_nome_label']."',
								imp_sysusu_nome_label='".$_POST['imp_sysusu_nome_label']."',
								imp_sysusu_email_label='".$_POST['imp_sysusu_email_label']."',
								imp_sysusu_documento_label='".$_POST['imp_sysusu_documento_label']."',
								imp_compra_id_label='".$_POST['imp_compra_id_label']."',
								imp_evento_nome_label='".$_POST['imp_evento_nome_label']."',
								imp_ingresso_nome_label='".$_POST['imp_ingresso_nome_label']."',
								imp_ingresso_data_label='".$_POST['imp_ingresso_data_label']."',
								imp_compra_adicionais_label='".$_POST['imp_compra_adicionais_label']."',
								imp_compra_valor_label='".$_POST['imp_compra_valor_label']."',
								imp_ingresso_cadeira_label='".$_POST['imp_ingresso_cadeira_label']."',
								imp_pessoa_nome_label='".$_POST['imp_pessoa_nome_label']."',
								imp_pessoa_documento_label='".$_POST['imp_pessoa_documento_label']."',
								imp_info_impressao_ticket_label='".$_POST['imp_info_impressao_ticket_label']."',
								imp_imagem_impressao_ticket_label='".$_POST['imp_imagem_impressao_ticket_label']."',
								imp_compra_data_pagamento_label='".$_POST['imp_compra_data_pagamento_label']."',
								imp_cod_voucher_qrcode_label='".$_POST['imp_cod_voucher_qrcode_label']."',
								imp_cod_voucher_barras_label='".$_POST['imp_cod_voucher_barras_label']."',
								imp_cod_voucher_label='".$_POST['imp_cod_voucher_label']."',
								imp_empresa_nome_label='".$_POST['imp_empresa_nome_label']."',

								imp_imagem_do_evento='".$_POST['imp_imagem_do_evento']."',
								imp_empresa_logo='".$_POST['imp_empresa_logo']."',
								imp_data_do_evento='".$_POST['imp_data_do_evento']."',
								imp_pdv_id='".$_POST['imp_pdv_id']."',
								imp_pdv_nome='".$_POST['imp_pdv_nome']."',
								imp_sysusu_nome='".$_POST['imp_sysusu_nome']."',
								imp_sysusu_email='".$_POST['imp_sysusu_email']."',
								imp_sysusu_documento='".$_POST['imp_sysusu_documento']."',
								imp_compra_id='".$_POST['imp_compra_id']."',
								imp_evento_nome='".$_POST['imp_evento_nome']."',
								imp_ingresso_nome='".$_POST['imp_ingresso_nome']."',
								imp_ingresso_data='".$_POST['imp_ingresso_data']."',
								imp_compra_adicionais='".$_POST['imp_compra_adicionais']."',
								imp_compra_valor='".$_POST['imp_compra_valor']."',
								imp_ingresso_cadeira='".$_POST['imp_ingresso_cadeira']."',
								imp_pessoa_nome='".$_POST['imp_pessoa_nome']."',
								imp_pessoa_documento='".$_POST['imp_pessoa_documento']."',
								imp_info_impressao_ticket='".$_POST['imp_info_impressao_ticket']."',
								imp_imagem_impressao_ticket='".$_POST['imp_imagem_impressao_ticket']."',
								imp_compra_data_pagamento='".$_POST['imp_compra_data_pagamento']."',
								imp_cod_voucher_qrcode='".$_POST['imp_cod_voucher_qrcode']."',
								imp_cod_voucher_barras='".$_POST['imp_cod_voucher_barras']."',
								imp_cod_voucher='".$_POST['imp_cod_voucher']."',
								imp_empresa_nome='".$_POST['imp_empresa_nome']."',

								imp_pdv_id_KEY_ALIGN='".$_POST['imp_pdv_id_KEY_ALIGN']."',
								imp_pdv_id_KEY_TYPEFACE='".$_POST['imp_pdv_id_KEY_TYPEFACE']."',
								imp_pdv_id_KEY_TEXT_SIZE='".$_POST['imp_pdv_id_KEY_TEXT_SIZE']."',
								imp_pdv_nome_KEY_ALIGN='".$_POST['imp_pdv_nome_KEY_ALIGN']."',
								imp_pdv_nome_KEY_TYPEFACE='".$_POST['imp_pdv_nome_KEY_TYPEFACE']."',
								imp_pdv_nome_KEY_TEXT_SIZE='".$_POST['imp_pdv_nome_KEY_TEXT_SIZE']."',
								imp_sysusu_nome_KEY_ALIGN='".$_POST['imp_sysusu_nome_KEY_ALIGN']."',
								imp_sysusu_nome_KEY_TYPEFACE='".$_POST['imp_sysusu_nome_KEY_TYPEFACE']."',
								imp_sysusu_nome_KEY_TEXT_SIZE='".$_POST['imp_sysusu_nome_KEY_TEXT_SIZE']."',
								imp_sysusu_email_KEY_ALIGN='".$_POST['imp_sysusu_email_KEY_ALIGN']."',
								imp_sysusu_email_KEY_TYPEFACE='".$_POST['imp_sysusu_email_KEY_TYPEFACE']."',
								imp_sysusu_email_KEY_TEXT_SIZE='".$_POST['imp_sysusu_email_KEY_TEXT_SIZE']."',
								imp_sysusu_documento_KEY_ALIGN='".$_POST['imp_sysusu_documento_KEY_ALIGN']."',
								imp_sysusu_documento_KEY_TYPEFACE='".$_POST['imp_sysusu_documento_KEY_TYPEFACE']."',
								imp_sysusu_documento_KEY_TEXT_SIZE='".$_POST['imp_sysusu_documento_KEY_TEXT_SIZE']."',
								imp_compra_id_KEY_ALIGN='".$_POST['imp_compra_id_KEY_ALIGN']."',
								imp_compra_id_KEY_TYPEFACE='".$_POST['imp_compra_id_KEY_TYPEFACE']."',
								imp_compra_id_KEY_TEXT_SIZE='".$_POST['imp_compra_id_KEY_TEXT_SIZE']."',
								imp_evento_nome_KEY_ALIGN='".$_POST['imp_evento_nome_KEY_ALIGN']."',
								imp_evento_nome_KEY_TYPEFACE='".$_POST['imp_evento_nome_KEY_TYPEFACE']."',
								imp_evento_nome_KEY_TEXT_SIZE='".$_POST['imp_evento_nome_KEY_TEXT_SIZE']."',
								imp_ingresso_nome_KEY_ALIGN='".$_POST['imp_ingresso_nome_KEY_ALIGN']."',
								imp_ingresso_nome_KEY_TYPEFACE='".$_POST['imp_ingresso_nome_KEY_TYPEFACE']."',
								imp_ingresso_nome_KEY_TEXT_SIZE='".$_POST['imp_ingresso_nome_KEY_TEXT_SIZE']."',
								imp_ingresso_data_KEY_ALIGN='".$_POST['imp_ingresso_data_KEY_ALIGN']."',
								imp_ingresso_data_KEY_TYPEFACE='".$_POST['imp_ingresso_data_KEY_TYPEFACE']."',
								imp_compra_adicionais_KEY_TEXT_SIZE='".$_POST['imp_compra_adicionais_KEY_TEXT_SIZE']."',
								imp_ingresso_data_KEY_TEXT_SIZE='".$_POST['imp_ingresso_data_KEY_TEXT_SIZE']."',
								imp_compra_adicionais_KEY_ALIGN='".$_POST['imp_compra_adicionais_KEY_ALIGN']."',
								imp_compra_adicionais_KEY_TYPEFACE='".$_POST['imp_compra_adicionais_KEY_TYPEFACE']."',
								imp_compra_valor_KEY_ALIGN='".$_POST['imp_compra_valor_KEY_ALIGN']."',
								imp_compra_valor_KEY_TYPEFACE='".$_POST['imp_compra_valor_KEY_TYPEFACE']."',
								imp_compra_valor_KEY_TEXT_SIZE='".$_POST['imp_compra_valor_KEY_TEXT_SIZE']."',
								imp_ingresso_cadeira_KEY_ALIGN='".$_POST['imp_ingresso_cadeira_KEY_ALIGN']."',
								imp_ingresso_cadeira_KEY_TYPEFACE='".$_POST['imp_ingresso_cadeira_KEY_TYPEFACE']."',
								imp_ingresso_cadeira_KEY_TEXT_SIZE='".$_POST['imp_ingresso_cadeira_KEY_TEXT_SIZE']."',
								imp_pessoa_nome_KEY_ALIGN='".$_POST['imp_pessoa_nome_KEY_ALIGN']."',
								imp_pessoa_nome_KEY_TYPEFACE='".$_POST['imp_pessoa_nome_KEY_TYPEFACE']."',
								imp_pessoa_nome_KEY_TEXT_SIZE='".$_POST['imp_pessoa_nome_KEY_TEXT_SIZE']."',
								imp_pessoa_documento_KEY_ALIGN='".$_POST['imp_pessoa_documento_KEY_ALIGN']."',
								imp_pessoa_documento_KEY_TYPEFACE='".$_POST['imp_pessoa_documento_KEY_TYPEFACE']."',
								imp_pessoa_documento_KEY_TEXT_SIZE='".$_POST['imp_pessoa_documento_KEY_TEXT_SIZE']."',
								imp_compra_data_pagamento_KEY_ALIGN='".$_POST['imp_compra_data_pagamento_KEY_ALIGN']."',
								imp_compra_data_pagamento_KEY_TYPEFACE='".$_POST['imp_compra_data_pagamento_KEY_TYPEFACE']."',
								imp_compra_data_pagamento_KEY_TEXT_SIZE='".$_POST['imp_compra_data_pagamento_KEY_TEXT_SIZE']."',
								imp_cod_voucher_KEY_ALIGN='".$_POST['imp_cod_voucher_KEY_ALIGN']."',
								imp_cod_voucher_KEY_TYPEFACE='".$_POST['imp_cod_voucher_KEY_TYPEFACE']."',
								imp_cod_voucher_KEY_TEXT_SIZE='".$_POST['imp_cod_voucher_KEY_TEXT_SIZE']."',
								imp_info_impressao_KEY_ALIGN='".$_POST['imp_info_impressao_KEY_ALIGN']."',
								imp_info_impressao_KEY_TYPEFACE='".$_POST['imp_info_impressao_KEY_TYPEFACE']."',
								imp_info_impressao_KEY_TEXT_SIZE='".$_POST['imp_info_impressao_KEY_TEXT_SIZE']."',
								imp_empresa_nome_KEY_ALIGN='".$_POST['imp_empresa_nome_KEY_ALIGN']."',
								imp_empresa_nome_KEY_TYPEFACE='".$_POST['imp_empresa_nome_KEY_TYPEFACE']."',
								imp_empresa_nome_KEY_TEXT_SIZE='".$_POST['imp_empresa_nome_KEY_TEXT_SIZE']."',

								".$updateOrdemSet."
								imp_pdv_ordenacao='".$_SESSION['imp_pdv_ordenacao_'.$_SESSION['numeroUnicoGerado'].'']."',
								
								dataModificacao='".$data."' ,
								
								objetoModificacoes='".$modificacoesControleSerial."'
							WHERE 
								id='".$_POST['iditem']."' ");
} else {
	$insertOrdem1Set = "";
	$insertOrdem2Set = "";
	$carrinhoArray = unserialize($_SESSION['imp_pdv_ordenacao_'.$_SESSION['numeroUnicoGerado'].'']);
	$carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
	foreach ($carrinhoArray as $key => $value) {
		$insertOrdem1Set .= " ".$value["campo"].", ";
		$insertOrdem2Set .= " '".$value["ordem"]."', ";
	}

	$insert = mysql_query("INSERT INTO pdv (
													 idsysusu, 
													 empresa,
													 empresa_token,
													 numeroUnico,

													 pessoa_nome,
													 pessoa_documento,
													 pessoa_email,
													 pessoa_whatsapp,
													 pessoa_genero,
					
													 pessoa_nome_obrigatorio,
													 pessoa_documento_obrigatorio,
													 pessoa_email_obrigatorio,
													 pessoa_whatsapp_obrigatorio,
													 pessoa_genero_obrigatorio,
					
													 texto_topo,
													 texto_rodape,

													 logotipo_topo,
													 logotipo_rodape,
					
													 nome,
													 tipo_documento,
													 documento,
													 senha,
													 senha_conf,
													 email,
													 email_valido,
													 email_valido_checado,
													 whatsapp,
													 aceita_whatsapp,
													 whatsapp_valido,
													 whatsapp_valido_checado,
													 cep,
													 numeroUnico_tipos_de_logradouro,
													 rua,
													 numero,
													 complemento,
													 bairro,
													 bairro_id,
													 cidade,
													 cidade_id,
													 estado,
													 latitude,
													 longitude,
													 pdv_plataforma,
													 perfil,
													 split,
													 abertura,
													 sangria,
													 fechamento,
													 relatorio,
													 busca,
													 ccr,
													 ccd,
													 din,
													 pix,
													 cortesia,
													 tipo_maquina,
													 tipo_checkout,
													 parcelamento,
													 venda_com_registro,
													 limite_carrinho,

													 imp_imagem_do_evento_label,
													 imp_empresa_logo_label,
													 imp_data_do_evento_label,
													 imp_pdv_id_label,
													 imp_pdv_nome_label,
													 imp_sysusu_nome_label,
													 imp_sysusu_email_label,
													 imp_sysusu_documento_label,
													 imp_compra_id_label,
													 imp_evento_nome_label,
													 imp_ingresso_nome_label,
													 imp_ingresso_data_label,
													 imp_compra_adicionais_label,
													 imp_compra_valor_label,
													 imp_ingresso_cadeira_label,
													 imp_pessoa_nome_label,
													 imp_pessoa_documento_label,
													 imp_info_impressao_ticket_label,
													 imp_imagem_impressao_ticket_label,
													 imp_compra_data_pagamento_label,
													 imp_cod_voucher_qrcode_label,
													 imp_cod_voucher_barras_label,
													 imp_cod_voucher_label,
													 imp_empresa_nome_label,
					
													 imp_imagem_do_evento,
													 imp_empresa_logo,
													 imp_data_do_evento,
													 imp_pdv_id,
													 imp_pdv_nome,
													 imp_sysusu_nome,
													 imp_sysusu_email,
													 imp_sysusu_documento,
													 imp_compra_id,
													 imp_evento_nome,
													 imp_ingresso_nome,
													 imp_ingresso_data,
													 imp_compra_adicionais,
													 imp_compra_valor,
													 imp_ingresso_cadeira,
													 imp_pessoa_nome,
													 imp_pessoa_documento,
													 imp_info_impressao_ticket,
													 imp_imagem_impressao_ticket,
													 imp_compra_data_pagamento,
													 imp_cod_voucher_qrcode,
													 imp_cod_voucher_barras,
													 imp_cod_voucher,
													 imp_empresa_nome,
					
													 imp_pdv_id_KEY_ALIGN,
													 imp_pdv_id_KEY_TYPEFACE,
													 imp_pdv_id_KEY_TEXT_SIZE,
													 imp_pdv_nome_KEY_ALIGN,
													 imp_pdv_nome_KEY_TYPEFACE,
													 imp_pdv_nome_KEY_TEXT_SIZE,
													 imp_sysusu_nome_KEY_ALIGN,
													 imp_sysusu_nome_KEY_TYPEFACE,
													 imp_sysusu_nome_KEY_TEXT_SIZE,
													 imp_sysusu_email_KEY_ALIGN,
													 imp_sysusu_email_KEY_TYPEFACE,
													 imp_sysusu_email_KEY_TEXT_SIZE,
													 imp_sysusu_documento_KEY_ALIGN,
													 imp_sysusu_documento_KEY_TYPEFACE,
													 imp_sysusu_documento_KEY_TEXT_SIZE,
													 imp_compra_id_KEY_ALIGN,
													 imp_compra_id_KEY_TYPEFACE,
													 imp_compra_id_KEY_TEXT_SIZE,
													 imp_evento_nome_KEY_ALIGN,
													 imp_evento_nome_KEY_TYPEFACE,
													 imp_evento_nome_KEY_TEXT_SIZE,
													 imp_ingresso_nome_KEY_ALIGN,
													 imp_ingresso_nome_KEY_TYPEFACE,
													 imp_ingresso_nome_KEY_TEXT_SIZE,
													 imp_ingresso_data_KEY_ALIGN,
													 imp_ingresso_data_KEY_TYPEFACE,
													 imp_compra_adicionais_KEY_TEXT_SIZE,
													 imp_ingresso_data_KEY_TEXT_SIZE,
													 imp_compra_adicionais_KEY_ALIGN,
													 imp_compra_adicionais_KEY_TYPEFACE,
													 imp_compra_valor_KEY_ALIGN,
													 imp_compra_valor_KEY_TYPEFACE,
													 imp_compra_valor_KEY_TEXT_SIZE,
													 imp_ingresso_cadeira_KEY_ALIGN,
													 imp_ingresso_cadeira_KEY_TYPEFACE,
													 imp_ingresso_cadeira_KEY_TEXT_SIZE,
													 imp_pessoa_nome_KEY_ALIGN,
													 imp_pessoa_nome_KEY_TYPEFACE,
													 imp_pessoa_nome_KEY_TEXT_SIZE,
													 imp_pessoa_documento_KEY_ALIGN,
													 imp_pessoa_documento_KEY_TYPEFACE,
													 imp_pessoa_documento_KEY_TEXT_SIZE,
													 imp_compra_data_pagamento_KEY_ALIGN,
													 imp_compra_data_pagamento_KEY_TYPEFACE,
													 imp_compra_data_pagamento_KEY_TEXT_SIZE,
													 imp_cod_voucher_KEY_ALIGN,
													 imp_cod_voucher_KEY_TYPEFACE,
													 imp_cod_voucher_KEY_TEXT_SIZE,
													 imp_info_impressao_KEY_ALIGN,
													 imp_info_impressao_KEY_TYPEFACE,
													 imp_info_impressao_KEY_TEXT_SIZE,
													 imp_empresa_nome_KEY_ALIGN,
													 imp_empresa_nome_KEY_TYPEFACE,
													 imp_empresa_nome_KEY_TEXT_SIZE,

													 ".$insertOrdem1Set."
													 imp_pdv_ordenacao,
													
													 stat,
													 data,
													 dataModificacao
													) VALUES (
													'".$sysusu['id']."', 
													'".$rSqlEmpresa['id']."', 
													'".$rSqlEmpresa['token']."', 
													'".$_POST['numeroUnico']."', 

													'".$_POST['pessoa_nome']."',
													'".$_POST['pessoa_documento']."',
													'".$_POST['pessoa_email']."',
													'".$_POST['pessoa_whatsapp']."',
													'".$_POST['pessoa_genero']."',
					
													'".$_POST['pessoa_nome_obrigatorio']."',
													'".$_POST['pessoa_documento_obrigatorio']."',
													'".$_POST['pessoa_email_obrigatorio']."',
													'".$_POST['pessoa_whatsapp_obrigatorio']."',
													'".$_POST['pessoa_genero_obrigatorio']."',
					
													'".$_POST['texto_topo']."',
													'".$_POST['texto_rodape']."',

													'".$_POST['logotipo_topo']."',
													'".$_POST['logotipo_rodape']."',

													'".$_POST['nome']."',
													'".$_POST['tipo_documento_cadastro']."',
													'".$_POST['documento']."',
													'".$_POST['senha']."',
													'".$_POST['senha_conf']."',
													'".$_POST['email']."',
													'".$_POST['email_valido']."',
													'".$_POST['email_valido_checado']."',
													'".$_POST['whatsapp']."',
													'".$_POST['aceita_whatsapp']."',
													'".$_POST['whatsapp_valido']."',
													'".$_POST['whatsapp_valido_checado']."',
													'".$_POST['cep']."',
													'".$_POST['numeroUnico_tipos_de_logradouro']."',
													'".$_POST['rua']."',
													'".$_POST['numero']."',
													'".$_POST['complemento']."',
													'".$_POST['bairro']."',
													'".$_POST['bairro_id']."',
													'".$_POST['cidade']."',
													'".$_POST['cidade_id']."',
													'".$_POST['estado']."',
													'".$_POST['latitude']."',
													'".$_POST['longitude']."',
													'".$_POST['pdv_plataforma']."',
													'".$_POST['perfil']."',
													'".$_POST['split']."',
													'".$_POST['abertura']."',
													'".$_POST['sangria']."',
													'".$_POST['fechamento']."',
													'".$_POST['relatorio']."',
													'".$_POST['busca']."',
													'".$_POST['ccr']."',
													'".$_POST['ccd']."',
													'".$_POST['din']."',
													'".$_POST['pix']."',
													'".$_POST['cortesia']."',
													'".$_POST['tipo_maquina']."',
													'".$_POST['tipo_checkout']."',
													'".$_POST['parcelamento']."',
													'".$_POST['venda_com_registro']."',
													'".$_POST['limite_carrinho']."',

													'".$_POST['imp_imagem_do_evento_label']."',
													'".$_POST['imp_empresa_logo_label']."',
													'".$_POST['imp_data_do_evento_label']."',
													'".$_POST['imp_pdv_id_label']."',
													'".$_POST['imp_pdv_nome_label']."',
													'".$_POST['imp_sysusu_nome_label']."',
													'".$_POST['imp_sysusu_email_label']."',
													'".$_POST['imp_sysusu_documento_label']."',
													'".$_POST['imp_compra_id_label']."',
													'".$_POST['imp_evento_nome_label']."',
													'".$_POST['imp_ingresso_nome_label']."',
													'".$_POST['imp_ingresso_data_label']."',
													'".$_POST['imp_compra_adicionais_label']."',
													'".$_POST['imp_compra_valor_label']."',
													'".$_POST['imp_ingresso_cadeira_label']."',
													'".$_POST['imp_pessoa_nome_label']."',
													'".$_POST['imp_pessoa_documento_label']."',
													'".$_POST['imp_info_impressao_ticket_label']."',
													'".$_POST['imp_imagem_impressao_ticket_label']."',
													'".$_POST['imp_compra_data_pagamento_label']."',
													'".$_POST['imp_cod_voucher_qrcode_label']."',
													'".$_POST['imp_cod_voucher_barras_label']."',
													'".$_POST['imp_cod_voucher_label']."',
													'".$_POST['imp_empresa_nome_label']."',
					
													'".$_POST['imp_imagem_do_evento']."',
													'".$_POST['imp_empresa_logo']."',
													'".$_POST['imp_data_do_evento']."',
													'".$_POST['imp_pdv_id']."',
													'".$_POST['imp_pdv_nome']."',
													'".$_POST['imp_sysusu_nome']."',
													'".$_POST['imp_sysusu_email']."',
													'".$_POST['imp_sysusu_documento']."',
													'".$_POST['imp_compra_id']."',
													'".$_POST['imp_evento_nome']."',
													'".$_POST['imp_ingresso_nome']."',
													'".$_POST['imp_ingresso_data']."',
													'".$_POST['imp_compra_adicionais']."',
													'".$_POST['imp_compra_valor']."',
													'".$_POST['imp_ingresso_cadeira']."',
													'".$_POST['imp_pessoa_nome']."',
													'".$_POST['imp_pessoa_documento']."',
													'".$_POST['imp_info_impressao_ticket']."',
													'".$_POST['imp_imagem_impressao_ticket']."',
													'".$_POST['imp_compra_data_pagamento']."',
													'".$_POST['imp_cod_voucher_qrcode']."',
													'".$_POST['imp_cod_voucher_barras']."',
													'".$_POST['imp_cod_voucher']."',
													'".$_POST['imp_empresa_nome']."',
					
													'".$_POST['imp_pdv_id_KEY_ALIGN']."',
													'".$_POST['imp_pdv_id_KEY_TYPEFACE']."',
													'".$_POST['imp_pdv_id_KEY_TEXT_SIZE']."',
													'".$_POST['imp_pdv_nome_KEY_ALIGN']."',
													'".$_POST['imp_pdv_nome_KEY_TYPEFACE']."',
													'".$_POST['imp_pdv_nome_KEY_TEXT_SIZE']."',
													'".$_POST['imp_sysusu_nome_KEY_ALIGN']."',
													'".$_POST['imp_sysusu_nome_KEY_TYPEFACE']."',
													'".$_POST['imp_sysusu_nome_KEY_TEXT_SIZE']."',
													'".$_POST['imp_sysusu_email_KEY_ALIGN']."',
													'".$_POST['imp_sysusu_email_KEY_TYPEFACE']."',
													'".$_POST['imp_sysusu_email_KEY_TEXT_SIZE']."',
													'".$_POST['imp_sysusu_documento_KEY_ALIGN']."',
													'".$_POST['imp_sysusu_documento_KEY_TYPEFACE']."',
													'".$_POST['imp_sysusu_documento_KEY_TEXT_SIZE']."',
													'".$_POST['imp_compra_id_KEY_ALIGN']."',
													'".$_POST['imp_compra_id_KEY_TYPEFACE']."',
													'".$_POST['imp_compra_id_KEY_TEXT_SIZE']."',
													'".$_POST['imp_evento_nome_KEY_ALIGN']."',
													'".$_POST['imp_evento_nome_KEY_TYPEFACE']."',
													'".$_POST['imp_evento_nome_KEY_TEXT_SIZE']."',
													'".$_POST['imp_ingresso_nome_KEY_ALIGN']."',
													'".$_POST['imp_ingresso_nome_KEY_TYPEFACE']."',
													'".$_POST['imp_ingresso_nome_KEY_TEXT_SIZE']."',
													'".$_POST['imp_ingresso_data_KEY_ALIGN']."',
													'".$_POST['imp_ingresso_data_KEY_TYPEFACE']."',
													'".$_POST['imp_compra_adicionais_KEY_TEXT_SIZE']."',
													'".$_POST['imp_ingresso_data_KEY_TEXT_SIZE']."',
													'".$_POST['imp_compra_adicionais_KEY_ALIGN']."',
													'".$_POST['imp_compra_adicionais_KEY_TYPEFACE']."',
													'".$_POST['imp_compra_valor_KEY_ALIGN']."',
													'".$_POST['imp_compra_valor_KEY_TYPEFACE']."',
													'".$_POST['imp_compra_valor_KEY_TEXT_SIZE']."',
													'".$_POST['imp_ingresso_cadeira_KEY_ALIGN']."',
													'".$_POST['imp_ingresso_cadeira_KEY_TYPEFACE']."',
													'".$_POST['imp_ingresso_cadeira_KEY_TEXT_SIZE']."',
													'".$_POST['imp_pessoa_nome_KEY_ALIGN']."',
													'".$_POST['imp_pessoa_nome_KEY_TYPEFACE']."',
													'".$_POST['imp_pessoa_nome_KEY_TEXT_SIZE']."',
													'".$_POST['imp_pessoa_documento_KEY_ALIGN']."',
													'".$_POST['imp_pessoa_documento_KEY_TYPEFACE']."',
													'".$_POST['imp_pessoa_documento_KEY_TEXT_SIZE']."',
													'".$_POST['imp_compra_data_pagamento_KEY_ALIGN']."',
													'".$_POST['imp_compra_data_pagamento_KEY_TYPEFACE']."',
													'".$_POST['imp_compra_data_pagamento_KEY_TEXT_SIZE']."',
													'".$_POST['imp_cod_voucher_KEY_ALIGN']."',
													'".$_POST['imp_cod_voucher_KEY_TYPEFACE']."',
													'".$_POST['imp_cod_voucher_KEY_TEXT_SIZE']."',
													'".$_POST['imp_info_impressao_KEY_ALIGN']."',
													'".$_POST['imp_info_impressao_KEY_TYPEFACE']."',
													'".$_POST['imp_info_impressao_KEY_TEXT_SIZE']."',
													'".$_POST['imp_empresa_nome_KEY_ALIGN']."',
													'".$_POST['imp_empresa_nome_KEY_TYPEFACE']."',
													'".$_POST['imp_empresa_nome_KEY_TEXT_SIZE']."',
													
													".$insertOrdem2Set."
													'".$_SESSION['imp_pdv_ordenacao_'.$_SESSION['numeroUnicoGerado'].'']."',
													
													'1',
													'".$data."',
													'".$data."'
													)");
}

$_SESSION['detalhamento_'.$_SESSION['numeroUnicoGerado'].''] = "";
$_SESSION['imp_pdv_ordenacao_'.$_SESSION['numeroUnicoGerado'].''] = "";
$_SESSION['imp_pdv_ordenacao_editando_'.$_SESSION['numeroUnicoGerado'].''] = "";
$_SESSION['numeroUnicoGerado'] = "";

$update = mysql_query("UPDATE empresa SET dataNovoConteudo='".$data."' WHERE id='".$rSqlEmpresa['id']."'");

if(trim($_POST['acaoForm'])=="add-continuar" || trim($_POST['acaoForm'])=="editar-continuar") {
	$urlEditar = "editar/".$_POST['numeroUnico']."/";
}
$chave_gerada = geraCodReturn()."/";
echo"<script>window.open('".$link."".$chave_gerada."".$_REQUEST['var1']."/".$_REQUEST['var2']."/".$urlEditar."','_self','')</script>";
?>

