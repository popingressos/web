<?
if(trim($_FILES["info_ingresso_img_b64"]["name"])=="") { } else {
	upload_arquivo_nativo("eventos","info_ingresso_img_b64","");
}
if(trim($_FILES["pdf_informativo"]["name"])=="") { } else {
	upload_arquivo_nativo("eventos","pdf_informativo","");
}

$_POST['imagem_de_capa'] = str_replace("data:image/png;base64,","",$_POST['imagem_de_capa']);
$_POST['imagem_de_icone'] = str_replace("data:image/png;base64,","",$_POST['imagem_de_icone']);
$_POST['imagem_de_banner'] = str_replace("data:image/png;base64,","",$_POST['imagem_de_banner']);
$_POST['imagem_de_banner_2'] = str_replace("data:image/png;base64,","",$_POST['imagem_de_banner_2']);
$_POST['imagem_de_banner_vertical'] = str_replace("data:image/png;base64,","",$_POST['imagem_de_banner_vertical']);

criaPastaComCaminhoNativo("/var/www/html/admin/files/eventos/",$_POST['numeroUnico']);
file_put_contents("/var/www/html/admin/files/eventos/".$_POST['numeroUnico']."/imagem_de_capa.png",base64_decode($_POST['imagem_de_capa']));
file_put_contents("/var/www/html/admin/files/eventos/".$_POST['numeroUnico']."/imagem_de_icone.png",base64_decode($_POST['imagem_de_icone']));
file_put_contents("/var/www/html/admin/files/eventos/".$_POST['numeroUnico']."/imagem_de_banner.png",base64_decode($_POST['imagem_de_banner']));
file_put_contents("/var/www/html/admin/files/eventos/".$_POST['numeroUnico']."/imagem_de_banner_2.png",base64_decode($_POST['imagem_de_banner_2']));
file_put_contents("/var/www/html/admin/files/eventos/".$_POST['numeroUnico']."/imagem_de_banner_vertical.png",base64_decode($_POST['imagem_de_banner_vertical']));

$_POST['data_do_evento'] = normalTOdate($_POST['data_do_evento']);
$_POST['data_de_publicacao'] = normalTOdate($_POST['data_de_publicacao']);
$_POST['data_de_despublicacao'] = normalTOdate($_POST['data_de_despublicacao']);

$COORDENADAS = latitude_longitude($_POST,"",$GOOGLE_MAP_KEY_SET);
$_POST['latitude'] = $COORDENADAS['latitude'];
$_POST['longitude'] = $COORDENADAS['longitude'];

if(trim($_POST['bairro'])=="") { } else {
	$bairro = mysql_fetch_array(mysql_query("SELECT id_bairro FROM cepbr_bairro WHERE bairro='".$_POST['bairro']."'"));
	$_POST['bairro_id'] = $bairro['id_bairro'];
}
if(trim($_POST['cidade'])=="") { } else {
	$cidade = mysql_fetch_array(mysql_query("SELECT id_cidade FROM cepbr_cidade WHERE cidade='".$_POST['cidade']."'"));
	$_POST['cidade_id'] = $cidade['id_cidade'];
}

if(trim($_POST['info_ingresso_img_b64'])=="") { $linkImagemB64 = ""; } else { $linkImagemB64 = "<br><img src=\"".$link."files/eventos/".$_POST['numeroUnico']."/".$_POST['info_ingresso_img_b64']."\" >"; }
if(trim($_POST['info_ingresso_texto'])=="") { $_POST['info_ingresso'] = ""; } else { $_POST['info_ingresso'] = "<p>".$_POST['info_ingresso_texto']."".$linkImagemB64."</p>"; }

if(trim($_POST['titulo_seo_travada'])=="" || trim($_POST['titulo_seo_travada'])=="0") { $_POST['titulo_seo_travada']=0; } else { $_POST['titulo_seo_travada']=1; }
if(trim($_POST['url_amigavel_travada'])=="" || trim($_POST['url_amigavel_travada'])=="0") { $_POST['url_amigavel_travada']=0; } else { $_POST['url_amigavel_travada']=1; }

if(trim($_POST['notifica_no_cadastro_raio'])=="" || trim($_POST['notifica_no_cadastro_raio'])=="0") { 
	$_POST['notifica_no_cadastro_raio'] = "50000";
} else {
	$_POST['notifica_no_cadastro_raio'] = $_POST['notifica_no_cadastro_raio'];
}

if(trim($_POST['plataforma'])=="" || trim($_POST['plataforma'])=="0") { 
	$rSqlPlataforma['id'] = "0";
	$rSqlPlataforma['token'] = "0";
} else {
	$rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT id,token FROM empresa WHERE id='".$_POST['plataforma']."'"));
}

if(trim($_POST['acaoForm'])=="encerrar") {
	$strSqlEvento = "
		SELECT 
			mod_eventos.id,
			mod_eventos.numeroUnico,
			mod_eventos.nome,
			mod_eventos.data_de_despublicacao
		
		FROM 
			eventos AS mod_eventos
		WHERE
			mod_eventos.numeroUnico='".$_POST['numeroUnico']."' 
	
		ORDER BY
			mod_eventos.data ASC
			
	";
	$qSqlEvento = mysql_query("".$strSqlEvento."");
	while($rSqlEvento = mysql_fetch_array($qSqlEvento)) {
		$nSqlCarrinhoNotificacao = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho_notificacao WHERE numeroUnico_evento='".$rSqlEvento['numeroUnico']."'"));
		if($nSqlCarrinhoNotificacao[0]>1) {
			$strSqlNotificacao = "
				SELECT 
					mod_carrinho.id,
					mod_carrinho.confirmado
				
				FROM 
					carrinho_notificacao AS mod_carrinho 
				WHERE 
					mod_carrinho.numeroUnico_evento='".$rSqlEvento['numeroUnico']."'
			
				ORDER BY
					mod_carrinho.data ASC
					
			";
			$qSqlNotificacao = mysql_query("".$strSqlNotificacao."");
			while($rSqlNotificacao = mysql_fetch_array($qSqlNotificacao)) {
				if(trim($rSqlNotificacao['confirmado'])=="1") { } else {
					$update = mysql_query("UPDATE carrinho_notificacao SET stat='98',dataModificacao='".$data."' WHERE id='".$rSqlNotificacao['id']."'");
				}
			}
		}
		$update = mysql_query("UPDATE eventos SET stat='3',dataModificacao='".$data."' WHERE id='".$rSqlEvento['id']."'");
	}
} else if(trim($_POST['acaoForm'])=="editar" || trim($_POST['acaoForm'])=="editar-continuar") {
	if(trim($_FILES["info_ingresso_img_b64"]["name"])=="") { } else { $_POST['info_ingresso_img_b64'] = " info_ingresso_img_b64='".$_POST['info_ingresso_img_b64']."', "; }
	if(trim($_FILES["pdf_informativo"]["name"])=="") { } else { $_POST['pdf_informativo'] = " pdf_informativo='".$_POST['pdf_informativo']."', "; }


	$rSqlEventoAtual = mysql_fetch_array(mysql_query("SELECT tickets,lotes FROM eventos WHERE id='".$_POST['iditem']."'"));
	if(trim($rSqlEventoAtual["tickets"])=="") { $_POST['tickets_backup'] = ""; } else { $_POST['tickets_backup'] = " tickets_backup='".$rSqlEventoAtual['tickets']."', "; }
	if(trim($rSqlEventoAtual["lotes"])=="") { $_POST['lotes_backup'] = "";  } else { $_POST['lotes_backup'] = " lotes_backup='".$rSqlEventoAtual['lotes']."', "; }

	$update = mysql_query("
							UPDATE 
								eventos 
							SET 
								detalhe='".addslashes($_POST['detalhe'])."', 
								extras='".addslashes($_POST['extras'])."' 
							WHERE 
								id='".$_POST['iditem']."' ");

	$update = mysql_query("
							UPDATE 
								eventos 
							SET 
								plataforma='".$rSqlPlataforma['id']."', 
								plataforma_token='".$rSqlPlataforma['token']."', 

								empresa='".$rSqlEmpresa['id']."', 
								empresa_token='".$rSqlEmpresa['token']."', 

								titulo_seo='".$_POST['titulo_seo']."', 
								url_amigavel='".$_POST['url_amigavel']."', 
								texto_seo='".$_POST['texto_seo']."', 
								palavras_chave_seo='".$_POST['palavras_chave_seo']."', 
								titulo_seo_travada='".$_POST['titulo_seo_travada']."', 
								url_amigavel_travada='".$_POST['url_amigavel_travada']."', 

								destaque='".$_POST['destaque']."', 
								nome='".$_POST['nome']."', 
								subtitulo='".$_POST['subtitulo']."', 
								imagem_de_capa='".$_POST['imagem_de_capa']."', 
								imagem_de_icone='".$_POST['imagem_de_icone']."', 
								imagem_de_banner='".$_POST['imagem_de_banner']."', 
								imagem_de_banner_2='".$_POST['imagem_de_banner_2']."', 
								imagem_de_banner_vertical='".$_POST['imagem_de_banner_vertical']."', 
								".$_POST['info_ingresso_img_b64']."
								".$_POST['pdf_informativo']."

								data_do_evento='".$_POST['data_do_evento']."', 
								hora_inicio='".$_POST['hora_inicio']."', 
								hora_fim='".$_POST['hora_fim']."', 
								data_de_publicacao='".$_POST['data_de_publicacao']."', 
								data_de_despublicacao='".$_POST['data_de_despublicacao']."', 
								numeroUnico_senhas_para_evento='".$_POST['numeroUnico_senhas_para_evento']."', 
								numeroUnico_campanha_de_cartao='".$_POST['numeroUnico_campanha_de_cartao']."', 
								maximo_de_compra_permitida='".$_POST['maximo_de_compra_permitida']."', 

								info_ingresso_texto='".$_POST['info_ingresso_texto']."', 
								info_ingresso='".$_POST['info_ingresso']."', 

								chat='".$_POST['chat']."', 
								exibir_site='".$_POST['exibir_site']."', 
								exibir_app='".$_POST['exibir_app']."', 
								fila_de_compra_site='".$_POST['fila_de_compra_site']."', 
								fila_de_compra_app='".$_POST['fila_de_compra_app']."', 
								senhas_para_evento='".$_POST['senhas_para_evento']."', 

								local='".$_POST['local']."', 
								cep='".$_POST['cep']."', 
								rua='".$_POST['rua']."', 
								numero='".$_POST['numero']."', 
								complemento='".$_POST['complemento']."', 
								bairro='".$_POST['bairro']."', 
								cidade='".$_POST['cidade']."', 
								bairro_id='".$_POST['bairro_id']."', 
								cidade_id='".$_POST['cidade_id']."', 
								estado='".$_POST['estado']."', 
								latitude='".$_POST['latitude']."', 
								longitude='".$_POST['longitude']."', 

								tickets='".$_SESSION['eventos_tickets_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']."', 
								produtos='".$_SESSION['eventos_produtos_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']."', 
								lotes='".$_SESSION['eventos_lotes_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']."', 
								horarios='".$_SESSION['eventos_horarios_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']."', 

								".$_POST['tickets_backup']."
								".$_POST['lotes_backup']."

								categorias_de_pessoas='".$_POST['categorias_de_pessoas']."', 
								numeroUnico_unidades_de_saude='".$_POST['numeroUnico_unidades_de_saude']."', 
								numeroUnico_estrategias='".$_POST['numeroUnico_estrategias']."', 
								numeroUnico_imunobiologicos='".$_POST['numeroUnico_imunobiologicos']."', 
								numeroUnico_doses='".$_POST['numeroUnico_doses']."', 
								numero_dose='".$_POST['numero_dose']."', 
								notifica_no_cadastro='".$_POST['notifica_no_cadastro']."', 
								notifica_no_cadastro_parametro='".$_POST['notifica_no_cadastro_parametro']."', 
								notifica_no_cadastro_raio='".$_POST['notifica_no_cadastro_raio']."', 
								notifica_no_cadastro_idades='".$_POST['notifica_no_cadastro_idades']."', 

								numeroUnico_unidades_de_saude_primeira='".$_POST['numeroUnico_unidades_de_saude_primeira']."', 
								numeroUnico_estrategias_primeira='".$_POST['numeroUnico_estrategias_primeira']."', 
								numeroUnico_imunobiologicos_primeira='".$_POST['numeroUnico_imunobiologicos_primeira']."', 
								numeroUnico_doses_primeira='".$_POST['numeroUnico_doses_primeira']."', 

								exibir_site='".$_POST['exibir_site']."', 
								exibir_app='".$_POST['exibir_app']."', 
								exibir_pdv='".$_POST['exibir_pdv']."', 
								exibir_com='".$_POST['exibir_com']."', 
								stat='".$_POST['stat']."', 
								dataModificacao='".$data."' 
							WHERE 
								id='".$_POST['iditem']."' ");
} else {
	$insert = mysql_query("INSERT INTO eventos (
												 idsysusu,
												  
												 plataforma,
												 plataforma_token,
												 
												 empresa,
												 empresa_token,
												 
												 numeroUnico,

												 titulo_seo, 
												 url_amigavel, 
												 texto_seo,
												 palavras_chave_seo, 
												 titulo_seo_travada, 
												 url_amigavel_travada, 

												 destaque,
												 nome,
												 subtitulo,
												 imagem_de_capa,
												 imagem_de_icone,
												 imagem_de_banner,
												 imagem_de_banner_2,
												 imagem_de_banner_vertical,
												 info_ingresso_img_b64,
												 pdf_informativo,
												 
												 data_do_evento,
												 hora_inicio, 
												 hora_fim, 
												 data_de_publicacao, 
												 data_de_despublicacao, 
												 numeroUnico_senhas_para_evento, 
												 numeroUnico_campanha_de_cartao, 
												 maximo_de_compra_permitida, 

												 detalhe, 
												 extras, 

												 info_ingresso_texto, 
												 info_ingresso, 
				
												 chat, 
												 fila_de_compra_site, 
												 fila_de_compra_app, 
												 senhas_para_evento, 
				
												 local,
												 cep, 
												 rua, 
												 numero, 
												 complemento, 
												 bairro, 
												 cidade, 
												 bairro_id, 
												 cidade_id, 
												 estado, 
												 latitude, 
												 longitude, 
												 
												 tickets, 
												 produtos, 
												 lotes, 
												 horarios,

												 categorias_de_pessoas,
												 numeroUnico_unidades_de_saude, 
												 numeroUnico_estrategias,
												 numeroUnico_imunobiologicos,
												 numeroUnico_doses,
												 numero_dose,
												 notifica_no_cadastro,
												 notifica_no_cadastro_parametro, 
												 notifica_no_cadastro_raio,
												 notifica_no_cadastro_idades, 

												 numeroUnico_unidades_de_saude_primeira, 
												 numeroUnico_estrategias_primeira, 
												 numeroUnico_imunobiologicos_primeira, 
												 numeroUnico_doses_primeira, 
				
												 exibir_site, 
												 exibir_app, 
												 exibir_pdv,
												 exibir_com, 
												 stat,
												 data,
												 dataModificacao
												) VALUES (
												'".$sysusu['id']."', 
												
												'".$rSqlPlataforma['id']."', 
												'".$rSqlPlataforma['token']."', 

												'".$rSqlEmpresa['id']."', 
												'".$rSqlEmpresa['token']."', 

												'".$_POST['numeroUnico']."', 

												'".$_POST['titulo_seo']."', 
												'".$_POST['url_amigavel']."', 
												'".$_POST['texto_seo']."',
												'".$_POST['palavras_chave_seo']."', 
												'".$_POST['titulo_seo_travada']."', 
												'".$_POST['url_amigavel_travada']."', 
	
												'".$_POST['destaque']."', 
												'".$_POST['nome']."', 
												'".$_POST['subtitulo']."', 
												'".$_POST['imagem_de_capa']."', 
												'".$_POST['imagem_de_icone']."', 
												'".$_POST['imagem_de_banner']."', 
												'".$_POST['imagem_de_banner_2']."', 
												'".$_POST['imagem_de_banner_vertical']."', 
												'".$_POST['info_ingresso_img_b64']."',
												'".$_POST['pdf_informativo']."',
												 
												'".$_POST['data_do_evento']."',
												'".$_POST['hora_inicio']."', 
												'".$_POST['hora_fim']."', 
												'".$_POST['data_de_publicacao']."', 
												'".$_POST['data_de_despublicacao']."', 
												'".$_POST['numeroUnico_senhas_para_evento']."', 
												'".$_POST['numeroUnico_campanha_de_cartao']."', 
												'".$_POST['maximo_de_compra_permitida']."', 

												'".$_POST['detalhe']."', 
												'".$_POST['extras']."', 
												 
												'".$_POST['info_ingresso_texto']."', 
												'".$_POST['info_ingresso']."', 
				
												'".$_POST['chat']."', 
												'".$_POST['fila_de_compra_site']."', 
												'".$_POST['fila_de_compra_app']."', 
												'".$_POST['senhas_para_evento']."', 
				
												'".$_POST['local']."', 
												'".$_POST['cep']."', 
												'".$_POST['rua']."', 
												'".$_POST['numero']."', 
												'".$_POST['complemento']."', 
												'".$_POST['bairro']."', 
												'".$_POST['cidade']."', 
												'".$_POST['bairro_id']."', 
												'".$_POST['cidade_id']."', 
												'".$_POST['estado']."', 
												'".$_POST['latitude']."', 
												'".$_POST['longitude']."', 

												'".$_SESSION['eventos_tickets_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']."', 
												'".$_SESSION['eventos_produtos_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']."', 
												'".$_SESSION['eventos_lotes_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']."',
												'".$_SESSION['eventos_horarios_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']."',

												'".$_POST['categorias_de_pessoas']."',
												'".$_POST['numeroUnico_unidades_de_saude']."',
												'".$_POST['numeroUnico_estrategias']."', 
												'".$_POST['numeroUnico_imunobiologicos']."', 
												'".$_POST['numeroUnico_doses']."', 
												'".$_POST['numero_dose']."', 
												'".$_POST['notifica_no_cadastro']."', 
												'".$_POST['notifica_no_cadastro_parametro']."', 
												'".$_POST['notifica_no_cadastro_raio']."', 
												'".$_POST['notifica_no_cadastro_idades']."', 
				
												'".$_POST['numeroUnico_unidades_de_saude_primeira']."', 
												'".$_POST['numeroUnico_estrategias_primeira']."', 
												'".$_POST['numeroUnico_imunobiologicos_primeira']."', 
												'".$_POST['numeroUnico_doses_primeira']."', 
				
												'".$_POST['exibir_site']."', 
												'".$_POST['exibir_app']."', 
												'".$_POST['exibir_pdv']."', 
												'".$_POST['exibir_com']."', 
												'".$_POST['stat']."',
												'".$data."',
												'".$data."'
												)");
}

$_SESSION['eventos_tickets_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].''] = "";
$_SESSION['eventos_lotes_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].''] = "";
$_SESSION['eventos_horarios_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].''] = "";
$_SESSION['eventos_produtos_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].''] = "";
$_SESSION['numeroUnicoGerado'] = "";

if(trim($_POST['acaoForm'])=="add-continuar" || trim($_POST['acaoForm'])=="editar-continuar") {
	$urlEditar = "editar/".$_POST['numeroUnico']."/";
} else {
	$urlEditar = "editar/";
}
$chave_gerada = geraCodReturn()."/";
echo"<script>window.open('".$link."".$chave_gerada."".$_REQUEST['var1']."/".$urlEditar."','_self','')</script>";
?>

