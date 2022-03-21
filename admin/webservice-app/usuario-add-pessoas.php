<?
if(trim($rSqlEmpresa['stat'])=="0") {
	$campos["data"] = array("retorno" => "erro", "msg" => "Não foi possível realizar o cadastro, estamos realizando uma manutenção!");
	$campos["msg"] = "Não foi possível realizar o cadastro, estamos realizando uma manutenção";
	$campos["success"] = true;
} else if(trim($CadastroLoginSet)=="0" || trim($CadastroLoginSet)=="3") {
	$campos["data"] = array("retorno" => "erro", "msg" => "Não foi possível realizar o cadastro, estamos realizando uma manutenção!");
	$campos["msg"] = "Não foi possível realizar o cadastro, estamos realizando uma manutenção";
	$campos["success"] = true;
} else {
	if(trim($estadoGet)=="") { 
		if(trim($id_cidadeGet)=="") { } else {
			$cidade = mysql_fetch_array(mysql_query("SELECT cidade FROM cepbr_cidade WHERE id_cidade='".$id_cidadeGet."'"));
			$cidadeGet = "".$cidade['cidade']."";
			$cidade_idGet = $id_cidadeGet;
		}
	} else {
		if(trim($cidadeGet)=="") { } else {
			$cidade = mysql_fetch_array(mysql_query("SELECT id_cidade FROM cepbr_cidade WHERE cidade='".$cidadeGet."' AND uf='".$estadoGet."'"));
			$cidade_idGet = $cidade['id_cidade'];
		}
		if(trim($id_cidadeGet)=="") { } else {
			$cidade = mysql_fetch_array(mysql_query("SELECT cidade FROM cepbr_cidade WHERE id_cidade='".$id_cidadeGet."'"));
			$cidadeGet = "".$cidade['cidade']."";
			$cidade_idGet = $id_cidadeGet;
		}
	}
	if(trim($cidade_idGet)=="") { 
		if(trim($id_bairroGet)=="") { } else {
			$bairro = mysql_fetch_array(mysql_query("SELECT bairro FROM cepbr_bairro WHERE id_bairro='".$id_bairroGet."'"));
			$bairroGet = "".$bairro['bairro']."";
			$bairro_idGet = $id_bairroGet;
		}
	} else {
		if(trim($bairroGet)=="") { } else {
			$bairro = mysql_fetch_array(mysql_query("SELECT id_bairro FROM cepbr_bairro WHERE bairro='".$bairroGet."' AND id_cidade='".$cidade_idGet."'"));
			$bairro_idGet = $bairro['id_bairro'];
		}
		if(trim($id_bairroGet)=="") { } else {
			$bairro = mysql_fetch_array(mysql_query("SELECT bairro FROM cepbr_bairro WHERE id_bairro='".$id_bairroGet."'"));
			$bairroGet = "".$bairro['bairro']."";
			$bairro_idGet = $id_bairroGet;
		}
	}
	
	$tipo_empresaSet = "plataforma";

	if(trim($local_setadoGet)=="NAO" || trim($local_setadoGet)=="") {
		$empresa_tokenGet = $empresa_tokenGet;
		$rSqlEmpresaToken = mysql_fetch_array(mysql_query(" SELECT id,token,estado,cidade_id FROM empresa WHERE estado='".$estadoGet."' AND cidade_id='".$cidade_idGet."' AND plataforma_token='".$rSqlEmpresa['token']."' AND tipo_empresa='plataforma'"));
	} else {
		$empresa_tokenGet = $local_setadoGet;
		$rSqlEmpresaToken = mysql_fetch_array(mysql_query(" SELECT id,token,estado,cidade_id FROM empresa WHERE token='".trim($empresa_tokenGet)."'"));

		if(trim($rSqlEmpresaToken['estado'])==trim($estadoGet)) {
			if(trim($rSqlEmpresaToken['cidade_id'])==trim($cidade_idGet)) {
				$regiao_atendimentoSet = "SIM";
			} else {
				$regiao_atendimentoSet = "NAO";
			}
		} else {
			$regiao_atendimentoSet = "NAO";
		}
	}

	$empresa_idSet = "".$rSqlEmpresaToken['id']."";
	$empresa_tokenSet = "".$rSqlEmpresaToken['token']."";
	$plataforma_idSet = "".$rSqlEmpresa['id']."";
	$plataforma_tokenSet = "".$rSqlEmpresa['token']."";
	
	if(trim($regiao_atendimentoSet)=="NAO") {
		$campos["data"] = array("retorno" => "erro", "msg" => "O cep e endereço que foi informado de seu endereço não faz parte da nossa região de atendimento!");
		$campos["msg"] = "O cep e endereço que foi informado de seu endereço não faz parte da nossa região de atendimento!";
		$campos["success"] = true;
	} else {
		if(trim($rSqlPlataforma['campo_cliente_documento_obrigatorio'])=="1") {
			if(trim($cpfGet)=="") {
				if(trim($cnpjGet)=="") {
					$enviaCadastro = "NAO";
					$documentoGet = "";
				} else {
					$enviaCadastro = "SIM";
					$documentoGet = preg_replace("/[^0-9]/", "", $cnpjGet);
				}
			} else {
				$enviaCadastro = "SIM";
				$documentoGet = preg_replace("/[^0-9]/", "", $cpfGet);
			}
			
			if(strlen($documentoGet)>11) {
				$tipo_documentoTxtGet = "CNPJ";
				$tipo_documentoGet = "cnpj";
			} else {
				$tipo_documentoTxtGet = "CPF";
				$tipo_documentoGet = "cpf";
			}
		} else {
			$enviaCadastro = "SIM";
			$documentoGet = "";
			$tipo_documentoGet = "";
		}
		
		if(trim($enviaCadastro)=="SIM") {
			if(trim($documentoGet)=="") {
				$filtro_documentoSet = " ";
			} else {
				$filtro_documentoSet = " documento='".$documentoGet."' AND ";
			}
			if(trim($emailGet)=="") {
				$filtro_emailSet = " ";
			} else {
				$filtro_emailSet = " email='".$emailGet."' AND ";
			}
			if(trim($documentoGet)=="" && trim($emailGet)=="") {
				$campos["data"] = array("retorno" => "ja_existe", "msg" => "É necessário informar ao menos um dos dados como e-mail ou documento!");
				$campos["msg"] = "Dados não informados";
				$campos["success"] = true;
			} else {
				$rSqlUsuario = mysql_fetch_array(mysql_query(" SELECT stat FROM pessoas WHERE ".$filtro_documentoSet." ".$filtro_emailSet." empresa='".$empresa_idSet."' AND (stat='0' OR stat='1')"));
				if(trim($rSqlUsuario['stat'])=="" || trim($rSqlUsuario['stat'])=="1") {
					if(trim($rSqlPlataforma['campo_cliente_documento_obrigatorio'])=="1") {
						$local_print = "A";
						$nSqlUsuario = mysql_fetch_row(mysql_query(" SELECT COUNT(*) FROM pessoas WHERE documento='".$documentoGet."' AND empresa='".$empresa_idSet."' AND (stat='0' OR stat='1')"));
					} else {
						if(trim($documentoGet)=="") {
							$local_print = "B";
							$nSqlUsuario[0] = 0;
						} else {
							$local_print = "C";
							$nSqlUsuario = mysql_fetch_row(mysql_query(" SELECT COUNT(*) FROM pessoas WHERE documento='".$documentoGet."' AND empresa='".$empresa_idSet."' AND (stat='0' OR stat='1')"));
						}
					}
			
					if($nSqlUsuario[0]==0) {
						if(trim($rSqlPlataforma['campo_cliente_email_obrigatorio'])=="1") {
							$local_print = "D";
							$nSqlUsuario = mysql_fetch_row(mysql_query(" SELECT COUNT(*) FROM pessoas WHERE email='".$emailGet."' AND empresa='".$empresa_idSet."' AND (stat='0' OR stat='1')"));
						} else {
							if(trim($emailGet)=="") {
								$local_print = "E";
								$nSqlUsuario[0] = 0;
							} else {
								$local_print = "F";
								$nSqlUsuario = mysql_fetch_row(mysql_query(" SELECT COUNT(*) FROM pessoas WHERE email='".$emailGet."' AND empresa='".$empresa_idSet."' AND (stat='0' OR stat='1')"));
							}
						}
				
						if($nSqlUsuario[0]==0) {
							$local_print = "G";
							$numeroUnicoGet = geraCodReturn();
							
							if(trim($nomeGet)=="") {
								$nomeGet = "Não informado";
							} else {
								$nomeGet = $nomeGet;
							}
							
							if(trim($rSqlPlataforma['cadastro_cliente_stat'])=="NAO" || trim($rSqlPlataforma['cadastro_cliente_stat'])=="") {
								$statSet = "1";
								$textoRetorno = "Cadastro realizado com sucesso, faça o login para acessar o aplicativo!";
								$emailLocalSend = "seja_bem_vindo";
							} else if(trim($rSqlPlataforma['cadastro_cliente_stat'])=="SIM") {
								$statSet = "0";
								$textoRetorno = "Cadastro realizado com sucesso, os administradores irão realizar uma validação e você será informado quando seu cadastro for liberado!";
								$emailLocalSend = "seja_bem_vindo_validacao";
							}
							
							$retorno_verifica_whatsapp = verificaWhatsApp("".$empresa_idSet."","".$whatsappGet."");
				
							if(trim($retorno_verifica_whatsapp)=="SIM") {
								$whatsapp_validoSet = "1";
							} else {
								$whatsapp_validoSet = "0";
							}
				
							$emailGet = str_replace(" ","",$emailGet);
							if(trim($numeroUnico_eventoGet)=="") { 
								$email_validoSet = "0";
								$email_valido_checadoSet = "0";
							} else {
								$retorno_verifica_email = verificaEmail("".$emailGet."");
								if($retorno_verifica_email=="valid") {
									$email_validoSet = "1";
									$email_valido_checadoSet = "1";
								} else {
									$email_validoSet = "0";
									$email_valido_checadoSet = "0";
								}
							}
		
							if(trim($tipo_sanguineoGet)=="") { 
								$tipo_sanguineo_numeroUnicoSet = "";
								$tipo_sanguineo_txtSet = "";
							} else {
								$rSqlTipoSanguineo = mysql_fetch_array(mysql_query("SELECT numeroUnico,slug FROM tipos_sanguineos WHERE numeroUnico='".$tipo_sanguineoGet."'"));
								$tipo_sanguineo_numeroUnicoSet = $rSqlTipoSanguineo['numeroUnico'];
								$tipo_sanguineo_txtSet = $rSqlTipoSanguineo['slug'];
							}
							
							if(trim($numeroUnico_etniasGet)=="" || trim($numeroUnico_etniasGet)=="0") { 
								$numeroUnico_etniasGet = "0";
							} else {
								$numeroUnico_etniasGet = $numeroUnico_etniasGet;
							}
							
							if(trim($declarado_mortoGet)=="" || trim($declarado_mortoGet)=="0") { 
								$declarado_mortoGet = "0";
							} else {
								$declarado_mortoGet = $declarado_mortoGet;
							}
							
							if(trim($gestanteGet)=="" || trim($gestanteGet)=="0") { 
								$gestanteGet = "0";
							} else {
								$gestanteGet = $gestanteGet;
							}
							
							if(trim($puerperaGet)=="" || trim($puerperaGet)=="0") { 
								$puerperaGet = "0";
							} else {
								$puerperaGet = $puerperaGet;
							}
							
							$insert = mysql_query("INSERT INTO pessoas ( numeroUnico,
																		 empresa,
																		 empresa_token,
																		 plataforma,
																		 plataforma_token, 
					
																		 cliente,
																		 profissional,
																		 
																		 nome,
																		 tipo_documento,
																		 documento,
																		 genero,
																		 telefone,
																		 whatsapp,
																		 aceita_whatsapp,
																		 whatsapp_valido,
																		 email, 
																		 email_valido, 
																		 email_valido_checado, 
				
																		 bairro_id, 
																		 cidade_id, 
																		 bairro, 
																		 cidade, 
																		 estado, 
							
																		 senha,
																		 senha_conf,
					
																		 stat,
																		 data,
																		 dataModificacao) 
																		 VALUES 
																		('".$numeroUnicoGet."',
																		 '".$empresa_idSet."',
																		 '".$empresa_tokenSet."',
																		 '".$plataforma_idSet."',
																		 '".$plataforma_tokenSet."',
					
																		 '1',
																		 '0',
																		 '0',
																		 
																		 '".$nomeGet."',
																		 '".$tipo_documentoGet."', 
																		 '".$documentoGet."',
																		 '".$generoGet."',
																		 '".$telefoneGet."',
																		 '".$whatsappGet."',
																		 '".$aceita_whatsappGet."',
																		 '".$whatsapp_validoSet."',
																		 '".$emailGet."', 
																		 '".$email_validoSet."', 
																		 '".$email_valido_checadoSet."', 
					
																		 '".$bairro_idGet."', 
																		 '".$cidade_idGet."', 
																		 '".$bairroGet."', 
																		 '".$cidadeGet."', 
																		 '".$estadoGet."', 
				
																		 '".md5($senhaGet)."',
																		 '".$senhaGet."',
					
																		 '".$statSet."',
																		 '".$data."',
																		 '".$data."')");
					
							$rSqlUsuario = mysql_fetch_array(mysql_query(" SELECT * FROM pessoas WHERE numeroUnico='".$numeroUnicoGet."'"));
					
							if(trim($rSqlUsuario['id'])=="") {
								$campos["data"] = array("retorno" => "erro", "msg" => "Ocorreu algum erro no cadastramento", "SQL" => "".$insertSql."");
								$campos["msg"] = "Erro no cadastramento";
								$campos["success"] = true;
							} else {
								if(trim($emailGet)=="") { } else {
									$numeroUnico_usuarioSet = $rSqlUsuario['numeroUnico'];
									$indexGet = "site";
									$_POST['Local'] = "".$emailLocalSend."";
									include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-email/index.php");
								}
					
								$campos["data"] = array("retorno" => "criado_sucesso", "msg" => "".$textoRetorno."", "numeroUnico" => "".$numeroUnicoGet."", "SQL" => "".$insertSql."");
								$campos["msg"] = "".$textoRetorno."";
								$campos["success"] = true;
							}
						} else {
							$campos["data"] = array("retorno" => "ja_existe", "msg" => "Já existe um cadastro com este mesmo E-mail informado!");
							$campos["msg"] = "Cadastro já cadastrado";
							$campos["success"] = true;
						}
					} else {
						$campos["data"] = array("retorno" => "ja_existe", "msg" => "Já existe um cadastro com este mesmo CPF informado!");
						$campos["msg"] = "Cadastro já cadastrado";
						$campos["success"] = true;
					}
				} else {
					$campos["data"] = array("retorno" => "ja_existe", "msg" => "Você já possui um cadstro com estes dados, e ele possui algumas divergência e você deve entrar em contato com a administração!");
					$campos["msg"] = "Cadastro já cadastrado";
					$campos["success"] = true;
				}
			}
		} else {
			$campos["data"] = array("retorno" => "erro", "msg" => "Ocorreu algum erro ao tentar realizar seu cadastro, feche o aplicativo e tente novamente!");
			$campos["msg"] = "Ocorreu algum erro ao tentar realizar seu cadastro, feche o aplicativo e tente novamente";
			$campos["success"] = true;
		}
	}
}
if(trim($_POST['Webservice'])=="") {
	echo json_encode($campos);
}
?>