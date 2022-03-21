<?
	$mod = $_POST['modulo'];
	$nConfig = mysql_num_rows(mysql_query("SELECT * FROM ".$mod.""));

	if($nConfig==0) { 

		if(trim($_POST['busca'])=="") { $_POST['busca']=0; } else { $_POST['busca']=1; }
		if(trim($_POST['barra_forum'])=="") { $_POST['barra_forum']=0; } else { $_POST['barra_forum']=1; }
		if(trim($_POST['elastic'])=="") { $_POST['elastic']=0; } else { $_POST['elastic']=1; }
		if(trim($_POST['manutencao'])=="") { $_POST['manutencao']=0; } else { $_POST['manutencao']=1; }
		if(trim($_POST['memcache_conteudo'])=="") { $_POST['memcache_conteudo']=0; } else { $_POST['memcache_conteudo']=1; }
		if(trim($_POST['memcache_query'])=="") { $_POST['memcache_query']=0; } else { $_POST['memcache_query']=1; }
		if(trim($_POST['bloqueio_edicao'])=="") { $_POST['bloqueio_edicao']=0; } else { $_POST['bloqueio_edicao']=1; }
		if(trim($_POST['contador_home'])=="") { $_POST['contador_home']=0; } else { $_POST['contador_home']=1; }
		if(trim($_POST['contador_conteudo'])=="") { $_POST['contador_conteudo']=0; } else { $_POST['contador_conteudo']=1; }
		if(trim($_POST['contador_online'])=="") { $_POST['contador_online']=0; } else { $_POST['contador_online']=1; }

		if(trim($_POST['busca_completa'])=="") { $_POST['busca_completa']=0; } else { $_POST['busca_completa']=1; }
		if(trim($_POST['busca_secao'])=="") { $_POST['busca_secao']=0; } else { $_POST['busca_secao']=1; }
		if(trim($_POST['busca_tipo'])=="") { $_POST['busca_tipo']=0; } else { $_POST['busca_tipo']=1; }
		if(trim($_POST['busca_periodo'])=="") { $_POST['busca_periodo']=0; } else { $_POST['busca_periodo']=1; }
		if(trim($_POST['busca_conteudo'])=="") { $_POST['busca_conteudo']=0; } else { $_POST['busca_conteudo']=1; }
		if(trim($_POST['busca_palavras_chave'])=="") { $_POST['busca_palavras_chave']=0; } else { $_POST['busca_palavras_chave']=1; }

		$campo_imagem = "logotipo";
		if(trim($_FILES[$campo_imagem]["name"])=="") {
			$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
		} else {
			upload_arquivo($mod,$campo_imagem,"");
		}

		$campo_imagem = "logotipo_site";
		if(trim($_FILES[$campo_imagem]["name"])=="") {
			$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
		} else {
			upload_arquivo($mod,$campo_imagem,"");
		}

		$campo_imagem = "favicon";
		if(trim($_FILES[$campo_imagem]["name"])=="") {
			$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
		} else {
			upload_arquivo($mod,$campo_imagem,"");
		}

		$campo_imagem = "email_imagem";
		if(trim($_FILES[$campo_imagem]["name"])=="") {
			$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
		} else {
			upload_arquivo($mod,$campo_imagem,"");
		}

		$campo_imagem = "report_imagem";
		if(trim($_FILES[$campo_imagem]["name"])=="") {
			$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
		} else {
			upload_arquivo($mod,$campo_imagem,"");
		}

		$campo_imagem = "erro404_imagem";
		if(trim($_FILES[$campo_imagem]["name"])=="") {
			$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
		} else {
			upload_arquivo($mod,$campo_imagem,"");
		}

		$campo_imagem = "imagem_padrao";
		if(trim($_FILES[$campo_imagem]["name"])=="") {
			$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
		} else {
			upload_arquivo($mod,$campo_imagem,"");
		}

		$campo_imagem = "imagem_login";
		if(trim($_FILES[$campo_imagem]["name"])=="") {
			$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
		} else {
			upload_arquivo($mod,$campo_imagem,"");
		}

		$insert = mysql_query("INSERT INTO ".$mod." (
													cor_fundo_menu,
													cor_menu_active,
													cor_mouseover_menu,
													cor_fonte_menu,
													cor_fundo_rodape,
													cor_fonte_rodape,
													cor_link_rodape,
													cor_fundo_menu_superior,
													cor_mouseover_menu_superior,
													cor_fundo_submenu_superior,
													cor_fonte_menu_superior,
													cor_fonte_submenu_superior,
													cor_menu_superior_active,
													cor_submenu_superior_active,
													cor_fundo_logotipo,
													cor_linha_menu,
													imagem_login,

													login_fundo,
													login_fonte,
													login_link,
													login_fundo_box,
													login_titulo_box,
													login_fonte_box,
													login_link_box,
													login_botao_box,
													login_fonte_botao,
													login_botao_esqueceu_senha,
													login_fonte_esqueceu_senha,

													cor_icone,
													cor_titulo,
													cor_fundo_titulo,

													modulo_abertura,
													linguagem_padrao,
													id_layout_layout,
													nome,
													bloqueio_edicao,
													contador_home,
													contador_conteudo,
													contador_online,
													
													busca_completa,
													busca_secao,
													busca_tipo,
													busca_periodo,
													busca_conteudo,
													busca_palavras_chave,
													
													elastic,
													manutencao,
													manutencao_msg,
													politica_de_privacidade,
													linguagem_padrao_site,
													logotipo,
													logotipo_site,
													favicon,
													email_title,
													email,
													email_imagem,
													email_texto,
													report_title,
													report,
													report_imagem,
													report_texto,
													title_seo,
													texto_seo,
													palavras_chave,
													busca,
													barra_forum,
													id_google,
													erro404_titulo,
													erro404_imagem,
													erro404_msg,
													imagem_padrao,

													cielo_url,
													cielo_merchantkey,
													cielo_merchantid,
													userede_url,
													userede_pv,
													userede_token,
													pagarme_url,
													pagarme_apikey,
													pagarme_criptografia,
													safe2pay_url,
													safe2pay_token,
													safe2pay_secretkey,
													sandbox_cielo_url,
													sandbox_cielo_merchantkey,
													sandbox_cielo_merchantid,
													sandbox_userede_url,
													sandbox_userede_pv,
													sandbox_userede_token,
													sandbox_pagarme_url,
													sandbox_pagarme_apikey,
													sandbox_pagarme_criptografia,
													sandbox_safe2pay_url,
													sandbox_safe2pay_token,
													sandbox_safe2pay_secretkey,
													picpay_ambiente,
													picpay_token,
													picpay_seller_token,
													picpay_url,
													cielo_ambiente,
													userede_ambiente,
													pagarme_ambiente,
													safe2pay_ambiente,
													google_api_key,
													token_rdstation,
													bitly,

													cloudflare_email,
													cloudflare_account_id,
													cloudflare_global_apikey,
													cloudflare_origin_cakey,
													
													url_site,
													url_admin,
													ftp_host,
													ftp_user,
													ftp_pass,
													ftp_root,
													memcache_conteudo,
													memcache_query
													) 
													VALUES (
													'".$_POST['cor_fundo_menu']."',
													'".$_POST['cor_menu_active']."',
													'".$_POST['cor_mouseover_menu']."',
													'".$_POST['cor_fonte_menu']."',
													'".$_POST['cor_fundo_rodape']."',
													'".$_POST['cor_fonte_rodape']."',
													'".$_POST['cor_link_rodape']."',
													'".$_POST['cor_fundo_menu_superior']."',
													'".$_POST['cor_mouseover_menu_superior']."',
													'".$_POST['cor_fundo_submenu_superior']."',
													'".$_POST['cor_fonte_menu_superior']."',
													'".$_POST['cor_fonte_submenu_superior']."',
													'".$_POST['cor_menu_superior_active']."',
													'".$_POST['cor_submenu_superior_active']."',
													'".$_POST['cor_fundo_logotipo']."',
													'".$_POST['cor_linha_menu']."',
													'".$_POST['imagem_login']."',

													'".$_POST['login_fundo']."',
													'".$_POST['login_fonte']."',
													'".$_POST['login_link']."',
													'".$_POST['login_fundo_box']."',
													'".$_POST['login_titulo_box']."',
													'".$_POST['login_fonte_box']."',
													'".$_POST['login_link_box']."',
													'".$_POST['login_botao_box']."',
													'".$_POST['login_fonte_botao']."',
													'".$_POST['login_botao_esqueceu_senha']."',
													'".$_POST['login_fonte_esqueceu_senha']."',

													'".$_POST['cor_icone']."',
													'".$_POST['cor_titulo']."',
													'".$_POST['cor_fundo_titulo']."',

													'".$_POST['modulo_abertura']."',
													'".$_POST['linguagem_padrao']."',
													'".$_POST['id_layout_layout']."',
													'".$_POST['nome']."',
													'".$_POST['bloqueio_edicao']."',
													'".$_POST['contador_home']."',
													'".$_POST['contador_conteudo']."',
													'".$_POST['contador_online']."',

													'".$_POST['busca_completa']."',
													'".$_POST['busca_secao']."',
													'".$_POST['busca_tipo']."',
													'".$_POST['busca_periodo']."',
													'".$_POST['busca_conteudo']."',
													'".$_POST['busca_palavras_chave']."',

													'".$_POST['elastic']."',
													'".$_POST['manutencao']."',
													'".$_POST['manutencao_msg']."',
													'".$_POST['politica_de_privacidade']."',
													'".$_POST['linguagem_padrao_site']."',
													'".$_POST['logotipo']."',
													'".$_POST['logotipo_site']."',
													'".$_POST['favicon']."',
													'".$_POST['email_title']."',
													'".$_POST['email']."',
													'".$_POST['email_imagem']."',
													'".$_POST['email_texto']."',
													'".$_POST['report_title']."',
													'".$_POST['report']."',
													'".$_POST['report_imagem']."',
													'".$_POST['report_texto']."',
													'".$_POST['title_seo']."',
													'".$_POST['texto_seo']."',
													'".$_POST['palavras_chave']."',
													'".$_POST['busca']."',
													'".$_POST['barra_forum']."',
													'".$_POST['id_google']."',
													'".$_POST['erro404_titulo']."',
													'".$_POST['erro404_imagem']."',
													'".$_POST['erro404_msg']."',
													'".$_POST['imagem_padrao']."',

													'".$_POST['cielo_url']."',
													'".$_POST['cielo_merchantkey']."',
													'".$_POST['cielo_merchantid']."',
													'".$_POST['userede_url']."',
													'".$_POST['userede_pv']."',
													'".$_POST['userede_token']."',
													'".$_POST['pagarme_url']."',
													'".$_POST['pagarme_apikey']."',
													'".$_POST['pagarme_criptografia']."',
													'".$_POST['safe2pay_url']."',
													'".$_POST['safe2pay_token']."',
													'".$_POST['safe2pay_secretkey']."',
													'".$_POST['sandbox_cielo_url']."',
													'".$_POST['sandbox_cielo_merchantkey']."',
													'".$_POST['sandbox_cielo_merchantid']."',
													'".$_POST['sandbox_userede_url']."',
													'".$_POST['sandbox_userede_pv']."',
													'".$_POST['sandbox_userede_token']."',
													'".$_POST['sandbox_pagarme_url']."',
													'".$_POST['sandbox_pagarme_apikey']."',
													'".$_POST['sandbox_pagarme_criptografia']."',
													'".$_POST['sandbox_safe2pay_url']."',
													'".$_POST['sandbox_safe2pay_token']."',
													'".$_POST['sandbox_safe2pay_secretkey']."',
													'".$_POST['picpay_ambiente']."',
													'".$_POST['picpay_token']."',
													'".$_POST['picpay_seller_token']."',
													'".$_POST['picpay_url']."',
													'".$_POST['cielo_ambiente']."',
													'".$_POST['userede_ambiente']."',
													'".$_POST['pagarme_ambiente']."',
													'".$_POST['safe2pay_ambiente']."',
													'".$_POST['google_api_key']."',
													'".$_POST['token_rdstation']."',
													'".$_POST['bitly']."',

													'".$_POST['cloudflare_email']."',
													'".$_POST['cloudflare_account_id']."',
													'".$_POST['cloudflare_global_apikey']."',
													'".$_POST['cloudflare_origin_cakey']."',

													'".$_POST['url_site']."',
													'".$_POST['url_admin']."',
													'".$_POST['ftp_host']."',
													'".$_POST['ftp_user']."',
													'".$_POST['ftp_pass']."',
													'".$_POST['ftp_root']."',
													'".$_POST['memcache_conteudo']."',
													'".$_POST['memcache_query']."'
													)");

	} else {
		$itemAtual = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." ORDER BY data LIMIT 1"));

		if(trim($_POST['busca'])=="") { $_POST['busca']=0; } else { $_POST['busca']=1; }
		if(trim($_POST['barra_forum'])=="") { $_POST['barra_forum']=0; } else { $_POST['barra_forum']=1; }
		if(trim($_POST['elastic'])=="") { $_POST['elastic']=0; } else { $_POST['elastic']=1; }
		if(trim($_POST['manutencao'])=="") { $_POST['manutencao']=0; } else { $_POST['manutencao']=1; }
		if(trim($_POST['memcache_conteudo'])=="") { $_POST['memcache_conteudo']=0; } else { $_POST['memcache_conteudo']=1; }
		if(trim($_POST['memcache_query'])=="") { $_POST['memcache_query']=0; } else { $_POST['memcache_query']=1; }
		if(trim($_POST['bloqueio_edicao'])=="") { $_POST['bloqueio_edicao']=0; } else { $_POST['bloqueio_edicao']=1; }
		if(trim($_POST['contador_home'])=="") { $_POST['contador_home']=0; } else { $_POST['contador_home']=1; }
		if(trim($_POST['contador_conteudo'])=="") { $_POST['contador_conteudo']=0; } else { $_POST['contador_conteudo']=1; }
		if(trim($_POST['contador_online'])=="") { $_POST['contador_online']=0; } else { $_POST['contador_online']=1; }

		if(trim($_POST['busca_completa'])=="") { $_POST['busca_completa']=0; } else { $_POST['busca_completa']=1; }
		if(trim($_POST['busca_secao'])=="") { $_POST['busca_secao']=0; } else { $_POST['busca_secao']=1; }
		if(trim($_POST['busca_tipo'])=="") { $_POST['busca_tipo']=0; } else { $_POST['busca_tipo']=1; }
		if(trim($_POST['busca_periodo'])=="") { $_POST['busca_periodo']=0; } else { $_POST['busca_periodo']=1; }
		if(trim($_POST['busca_conteudo'])=="") { $_POST['busca_conteudo']=0; } else { $_POST['busca_conteudo']=1; }
		if(trim($_POST['busca_palavras_chave'])=="") { $_POST['busca_palavras_chave']=0; } else { $_POST['busca_palavras_chave']=1; }

		$campo_imagem = "logotipo";
		if(trim($_FILES[$campo_imagem]["name"])=="") {
			$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
		} else {
			upload_arquivo($mod,$campo_imagem,"");
		}

		$campo_imagem = "logotipo_site";
		if(trim($_FILES[$campo_imagem]["name"])=="") {
			$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
		} else {
			upload_arquivo($mod,$campo_imagem,"");
		}

		$campo_imagem = "favicon";
		if(trim($_FILES[$campo_imagem]["name"])=="") {
			$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
		} else {
			upload_arquivo($mod,$campo_imagem,"");
		}

		$campo_imagem = "email_imagem";
		if(trim($_FILES[$campo_imagem]["name"])=="") {
			$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
		} else {
			upload_arquivo($mod,$campo_imagem,"");
		}

		$campo_imagem = "report_imagem";
		if(trim($_FILES[$campo_imagem]["name"])=="") {
			$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
		} else {
			upload_arquivo($mod,$campo_imagem,"");
		}

		$campo_imagem = "erro404_imagem";
		if(trim($_FILES[$campo_imagem]["name"])=="") {
			$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
		} else {
			upload_arquivo($mod,$campo_imagem,"");
		}

		$campo_imagem = "imagem_padrao";
		if(trim($_FILES[$campo_imagem]["name"])=="") {
			$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
		} else {
			upload_arquivo($mod,$campo_imagem,"");
		}

		$campo_imagem = "imagem_login";
		if(trim($_FILES[$campo_imagem]["name"])=="") {
			$_POST[$campo_imagem] = $itemAtual[$campo_imagem];
		} else {
			upload_arquivo($mod,$campo_imagem,"");
		}

		$update = mysql_query("UPDATE ".$mod." SET 
													cor_fundo_menu='".$_POST['cor_fundo_menu']."',
													cor_menu_active='".$_POST['cor_menu_active']."',
													cor_mouseover_menu='".$_POST['cor_mouseover_menu']."',
													cor_fonte_menu='".$_POST['cor_fonte_menu']."',
													cor_fundo_rodape='".$_POST['cor_fundo_rodape']."',
													cor_fonte_rodape='".$_POST['cor_fonte_rodape']."',
													cor_link_rodape='".$_POST['cor_link_rodape']."',
													cor_fundo_menu_superior='".$_POST['cor_fundo_menu_superior']."',
													cor_mouseover_menu_superior='".$_POST['cor_mouseover_menu_superior']."',
													cor_fundo_submenu_superior='".$_POST['cor_fundo_submenu_superior']."',
													cor_fonte_menu_superior='".$_POST['cor_fonte_menu_superior']."',
													cor_fonte_submenu_superior='".$_POST['cor_fonte_submenu_superior']."',
													cor_menu_superior_active='".$_POST['cor_menu_superior_active']."',
													cor_submenu_superior_active='".$_POST['cor_submenu_superior_active']."',
													cor_fundo_logotipo='".$_POST['cor_fundo_logotipo']."',
													cor_linha_menu='".$_POST['cor_linha_menu']."',
													imagem_login='".$_POST['imagem_login']."',

													login_fundo='".$_POST['login_fundo']."',
													login_fonte='".$_POST['login_fonte']."',
													login_link='".$_POST['login_link']."',
													login_fundo_box='".$_POST['login_fundo_box']."',
													login_titulo_box='".$_POST['login_titulo_box']."',
													login_fonte_box='".$_POST['login_fonte_box']."',
													login_link_box='".$_POST['login_link_box']."',
													login_botao_box='".$_POST['login_botao_box']."',
													login_fonte_botao='".$_POST['login_fonte_botao']."',
													login_botao_esqueceu_senha='".$_POST['login_botao_esqueceu_senha']."',
													login_fonte_esqueceu_senha='".$_POST['login_fonte_esqueceu_senha']."',

													cor_icone='".$_POST['cor_icone']."',
													cor_titulo='".$_POST['cor_titulo']."',
													cor_fundo_titulo='".$_POST['cor_fundo_titulo']."',

													modulo_abertura='".$_POST['modulo_abertura']."',
													linguagem_padrao='".$_POST['linguagem_padrao']."',
													id_layout_layout='".$_POST['id_layout_layout']."',
													nome='".$_POST['nome']."',
													bloqueio_edicao='".$_POST['bloqueio_edicao']."',
													contador_home='".$_POST['contador_home']."',
													contador_conteudo='".$_POST['contador_conteudo']."',
													contador_online='".$_POST['contador_online']."',

													busca_completa='".$_POST['busca_completa']."',
													busca_secao='".$_POST['busca_secao']."',
													busca_tipo='".$_POST['busca_tipo']."',
													busca_periodo='".$_POST['busca_periodo']."',
													busca_conteudo='".$_POST['busca_conteudo']."',
													busca_palavras_chave='".$_POST['busca_palavras_chave']."',

													cielo_url='".$_POST['cielo_url']."',
													cielo_merchantkey='".$_POST['cielo_merchantkey']."',
													cielo_merchantid='".$_POST['cielo_merchantid']."',
													userede_url='".$_POST['userede_url']."',
													userede_pv='".$_POST['userede_pv']."',
													userede_token='".$_POST['userede_token']."',
													pagarme_url='".$_POST['pagarme_url']."',
													pagarme_apikey='".$_POST['pagarme_apikey']."',
													pagarme_criptografia='".$_POST['pagarme_criptografia']."',
													safe2pay_url='".$_POST['safe2pay_url']."',
													safe2pay_token='".$_POST['safe2pay_token']."',
													safe2pay_secretkey='".$_POST['safe2pay_secretkey']."',
													sandbox_cielo_url='".$_POST['sandbox_cielo_url']."',
													sandbox_cielo_merchantkey='".$_POST['sandbox_cielo_merchantkey']."',
													sandbox_cielo_merchantid='".$_POST['sandbox_cielo_merchantid']."',
													sandbox_userede_url='".$_POST['sandbox_userede_url']."',
													sandbox_userede_pv='".$_POST['sandbox_userede_pv']."',
													sandbox_userede_token='".$_POST['sandbox_userede_token']."',
													sandbox_pagarme_url='".$_POST['sandbox_pagarme_url']."',
													sandbox_pagarme_apikey='".$_POST['sandbox_pagarme_apikey']."',
													sandbox_pagarme_criptografia='".$_POST['sandbox_pagarme_criptografia']."',
													sandbox_safe2pay_url='".$_POST['sandbox_safe2pay_url']."',
													sandbox_safe2pay_token='".$_POST['sandbox_safe2pay_token']."',
													sandbox_safe2pay_secretkey='".$_POST['sandbox_safe2pay_secretkey']."',
													picpay_ambiente='".$_POST['picpay_ambiente']."',
													picpay_token='".$_POST['picpay_token']."',
													picpay_seller_token='".$_POST['picpay_seller_token']."',
													picpay_url='".$_POST['picpay_url']."',
													cielo_ambiente='".$_POST['cielo_ambiente']."',
													userede_ambiente='".$_POST['userede_ambiente']."',
													pagarme_ambiente='".$_POST['pagarme_ambiente']."',
													safe2pay_ambiente='".$_POST['safe2pay_ambiente']."',
													google_api_key='".$_POST['google_api_key']."',
													token_rdstation='".$_POST['token_rdstation']."',
													bitly='".$_POST['bitly']."',

													cloudflare_email='".$_POST['cloudflare_email']."',
													cloudflare_account_id='".$_POST['cloudflare_account_id']."',
													cloudflare_global_apikey='".$_POST['cloudflare_global_apikey']."',
													cloudflare_origin_cakey='".$_POST['cloudflare_origin_cakey']."',
													
													elastic='".$_POST['elastic']."',
													manutencao='".$_POST['manutencao']."',
													manutencao_msg='".$_POST['manutencao_msg']."',
													politica_de_privacidade='".$_POST['politica_de_privacidade']."',
													linguagem_padrao_site='".$_POST['linguagem_padrao_site']."',
													logotipo='".$_POST['logotipo']."',
													logotipo_site='".$_POST['logotipo_site']."',
													favicon='".$_POST['favicon']."',
													email_title='".$_POST['email_title']."',
													email='".$_POST['email']."',
													email_imagem='".$_POST['email_imagem']."',
													email_texto='".$_POST['email_texto']."',
													report_title='".$_POST['report_title']."',
													report='".$_POST['report']."',
													report_imagem='".$_POST['report_imagem']."',
													report_texto='".$_POST['report_texto']."',
													title_seo='".$_POST['title_seo']."',
													texto_seo='".$_POST['texto_seo']."',
													palavras_chave='".$_POST['palavras_chave']."',
													busca='".$_POST['busca']."',
													barra_forum='".$_POST['barra_forum']."',
													id_google='".$_POST['id_google']."',
													erro404_titulo='".$_POST['erro404_titulo']."',
													erro404_imagem='".$_POST['erro404_imagem']."',
													erro404_msg='".$_POST['erro404_msg']."',
													imagem_padrao='".$_POST['imagem_padrao']."',
													ftp_host='".$_POST['ftp_host']."',
													ftp_user='".$_POST['ftp_user']."',
													ftp_pass='".$_POST['ftp_pass']."',
													ftp_root='".$_POST['ftp_root']."',
													memcache_conteudo='".$_POST['memcache_conteudo']."',
													memcache_query='".$_POST['memcache_query']."'

													WHERE id='".$itemAtual['id']."'");

	}

	#renova_item_memcache("sql", "SELECT * FROM sysconfig");

	unlink("config_home_admin.txt");
	
	// Abre ou cria o arquivo bloco1.txt
	// "a" representa que o arquivo é aberto para ser escrito
	$fp = fopen("config_home_admin.txt", "a");
	
	$texto_config_home  = "".$_POST['login_fundo'].";";
	$texto_config_home .= "".$_POST['login_fonte'].";";
	$texto_config_home .= "".$_POST['login_link'].";";
	$texto_config_home .= "".$_POST['login_fundo_box'].";";
	$texto_config_home .= "".$_POST['login_titulo_box'].";";
	$texto_config_home .= "".$_POST['login_fonte_box'].";";
	$texto_config_home .= "".$_POST['login_link_box'].";";
	$texto_config_home .= "".$_POST['login_botao_box'].";";
	$texto_config_home .= "".$_POST['login_fonte_botao'].";";
	$texto_config_home .= "".$_POST['login_botao_esqueceu_senha'].";";
	$texto_config_home .= "".$_POST['login_fonte_esqueceu_senha'].";";
	 
	// Escreve "exemplo de escrita" no bloco1.txt
	$escreve = fwrite($fp, "".$texto_config_home."");
	 
	// Fecha o arquivo
	fclose($fp);
	
	echo"<script>window.open('".$link."".$chave_url."".$_REQUEST['var1']."/configuracoes#".$_POST['aba']."','_self','')</script>";
?>