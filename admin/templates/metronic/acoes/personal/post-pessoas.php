<?
if(trim($_POST['acaoForm'])=="envio_de_notificacao") {
	
	$numeroUnico_eventoGet = $_POST['numeroUnico_evento_notificacao'];

	$rSqlUsuario = mysql_fetch_array(mysql_query(" SELECT * FROM pessoas WHERE numeroUnico='".$_POST['numeroUnico']."'"));

	$rSqlEvento = mysql_fetch_array(mysql_query(" SELECT nome FROM eventos WHERE numeroUnico='".$numeroUnico_eventoGet."'"));
		
	$numeroUnico_profissionalGet = "";
	$tituloGet = "Confirmação de QRCode Individual";
	$mensagem_whatsSet = "Segue seu QRCode para o evento *".$rSqlEvento['nome']."*. \n\n*Parabéns*";
	$mensagem_emailSet = "Segue seu QRCode para o evento <b>".$rSqlEvento['nome']."</b>. <br><br><b>Parabéns</b>";


	$numeroUnico_marketingSet = geraCodReturn();
	$_POST['plataforma'] = "envio_de_notificacao";
	$_POST['qtd'] = "1";
	$_POST['qtd_limite'] = "0";
	$_POST['tipo_de_envio'] = "".$tipo_de_envioGet."";

	$numeroUnico_eventoSet = $numeroUnico_eventoGet;
	$empresa_idSet = $rSqlEmpresa['id'];
	$empresa_tokenSet = $rSqlEmpresa['token'];
	$filtroSet = "mod_pessoas.numeroUnico=@".$_POST['numeroUnico']."@";
	$filtroLimpoSet = str_replace("@","'",$filtroSet);

	include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/post-marketing-carrinho_controle.php");

	$insert = mysql_query("INSERT INTO marketing (
													 idsysusu, 
													 empresa,
													 empresa_token,
													 numeroUnico,
													 plataforma,
													 numeroUnico_profissional,
													 numeroUnico_evento,
													 nome,
													 tipo_de_envio,
													 texto,
													 texto_email,
													 filtro,
													 qtd,
													 qtd_limite,
													 processado,
													 enviado,
													 com_qrcode,
													 confirma_notificacao,
													 stat,
													 data,
													 dataModificacao
													) VALUES (
													'0', 
													'".$rSqlEmpresa['id']."', 
													'".$rSqlEmpresa['token']."',
													'".$numeroUnico_marketingSet."', 
													'".$_POST['plataforma']."',
													'".$numeroUnico_profissionalGet."', 
													'".$numeroUnico_eventoGet."', 
													'".$tituloGet."',
													'".$_POST['tipo_de_envio_notificacao']."',
													'".$mensagem_whatsSet."',
													'".$mensagem_emailSet."',
													'".$filtroSet."',
													'".$_POST['qtd']."',
													'".$_POST['qtd_limite']."',
													'0',
													'0',
													'1',
													'0',
													'1',
													'".$data."',
													'".$data."'
													)");

	include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/atualiza-pacotes_de_utilizacao_utilizado.php");
	$numeroUnico_marketingSet = $numeroUnico_marketingSet;
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-cron/marketing-envia-notificacao.php");

	$urlEditar = "editar/".$_POST['numeroUnico']."/";
} else {

	$mod = "pessoas";
	if(trim($_FILES["avatar"]["name"])=="") { } else {
		upload_arquivo_nativo("".$mod."","avatar","");
		$novo_nome = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($_FILES["avatar"]["name"]));
		$novo_nome = str_replace(" ","_",$novo_nome);
		$novo_nome = strtolower($novo_nome);
		$img_img_b64 = file_get_contents("https:".$link."files/".$mod."/".$_POST['numeroUnico']."/".$novo_nome.""); 
		$data_img_b64 = base64_encode($img_img_b64);
		$_POST['avatar'] =  $data_img_b64;
		$_POST['imagem_perfil_base64'] =  $data_img_b64;
		unlink("https:".$link."files/".$mod."/".$_POST['numeroUnico']."/".$novo_nome."");
	}
	
	if(trim($_FILES["imagem_doc_frente_base64"]["name"])=="") { } else {
		upload_arquivo_nativo("".$mod."","imagem_doc_frente_base64","");
		$novo_nome = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($_FILES["imagem_doc_frente_base64"]["name"]));
		$novo_nome = str_replace(" ","_",$novo_nome);
		$novo_nome = strtolower($novo_nome);
		$img_img_b64 = file_get_contents("https:".$link."files/".$mod."/".$_POST['numeroUnico']."/".$novo_nome.""); 
		$data_img_b64 = base64_encode($img_img_b64);
		$_POST['imagem_doc_frente_base64'] =  $data_img_b64;
		unlink("https:".$link."files/".$mod."/".$_POST['numeroUnico']."/".$novo_nome."");
	}
	
	if(trim($_FILES["imagem_doc_verso_base64"]["name"])=="") { } else {
		upload_arquivo_nativo("".$mod."","imagem_doc_verso_base64","");
		$novo_nome = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($_FILES["imagem_doc_verso_base64"]["name"]));
		$novo_nome = str_replace(" ","_",$novo_nome);
		$novo_nome = strtolower($novo_nome);
		$img_img_b64 = file_get_contents("https:".$link."files/".$mod."/".$_POST['numeroUnico']."/".$novo_nome.""); 
		$data_img_b64 = base64_encode($img_img_b64);
		$_POST['imagem_doc_verso_base64'] =  $data_img_b64;
		unlink("https:".$link."files/".$mod."/".$_POST['numeroUnico']."/".$novo_nome."");
	}
	
	$_POST['data_de_nascimento'] = normalTOdate($_POST['data_de_nascimento']);
	$_POST['data_de_aniversario'] = substr($_POST['data_de_nascimento'],4,6);
	$_POST['data_de_aniversario'] = "0000".$_POST['data_de_aniversario']."";
	$_POST['responsavel_data_de_nascimento'] = normalTOdate($_POST['responsavel_data_de_nascimento']);
	$_POST['responsavel_data_de_aniversario'] = substr($_POST['responsavel_data_de_nascimento'],4,6);
	$_POST['responsavel_data_de_aniversario'] = "0000".$_POST['responsavel_data_de_aniversario']."";
	
	$COORDENADAS = latitude_longitude($_POST,"",$GOOGLE_MAP_KEY_SET);
	$_POST['latitude'] = $COORDENADAS['latitude'];
	$_POST['longitude'] = $COORDENADAS['longitude'];
	
	$COORDENADAS = latitude_longitude($_POST,"responsavel_",$GOOGLE_MAP_KEY_SET);
	$_POST['responsavel_latitude'] = $COORDENADAS['latitude'];
	$_POST['responsavel_longitude'] = $COORDENADAS['longitude'];
	
	if(trim($_POST['tipo_documento_cadastro'])=="cpf" ) {
		$_POST['documento'] = $_POST['documento_cpf'];
	} else if(trim($_POST['tipo_documento_cadastro'])=="cnpj" ) {
		$_POST['documento'] = $_POST['documento_cnpj'];
	}
	
	$_POST['documento'] = preg_replace("/[^0-9]/", "",$_POST['documento']);
	
	$_POST['senha_conf'] = str_replace(" ","",$_POST['senha']);
	$_POST['senha'] = str_replace(" ","",$_POST['senha']);
	if(trim($_POST['senha'])!="") { $_POST['senha'] = md5($_POST['senha']); }
	
	if(trim($_POST['cidade'])=="") { } else {
		$cidade = mysql_fetch_array(mysql_query("SELECT id_cidade FROM cepbr_cidade WHERE cidade='".$_POST['cidade']."' AND uf='".$_POST['estado']."'"));
		$_POST['cidade_id'] = $cidade['id_cidade'];
	}
	
	if(trim($_POST['bairro'])=="") { } else {
		$bairro = mysql_fetch_array(mysql_query("SELECT id_bairro FROM cepbr_bairro WHERE bairro='".$_POST['bairro']."' AND id_cidade='".$_POST['cidade_id']."'"));
		$_POST['bairro_id'] = $bairro['id_bairro'];
	}
	
	if(trim($_POST['plataforma'])=="" || trim($_POST['plataforma'])=="0") { 
		$_POST['plataforma'] = "0";
		$_POST['plataforma_token'] = "0";
	} else {
		$rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT id,token FROM empresa WHERE id='".$_POST['plataforma']."'"));
		$_POST['plataforma'] = "".$rSqlPlataforma['id']."";
		$_POST['plataforma_token'] = "".$rSqlPlataforma['token']."";
	}
	
	if(strrpos($_construtor_sysperm['modulo_pessoas'],"|numeroUnico_profissional|") === false) { } else {
		if(trim($_POST['numeroUnico_profissional'])=="" || trim($_POST['numeroUnico_profissional'])=="0") { 
			$_POST['numeroUnico_profissional'] = 0; 
		} else { 
			$_POST['numeroUnico_profissional'] = $_POST['numeroUnico_profissional']; 
		}
	}
	
	if(trim($_POST['numeroUnico_tipos_sanguineos'])=="" || trim($_POST['numeroUnico_tipos_sanguineos'])=="0") { 
		$tipo_sanguineo_numeroUnicoSet = "";
		$tipo_sanguineo_txtSet = "";
	} else {
		$rSqlTipoSanguineo = mysql_fetch_array(mysql_query("SELECT numeroUnico,slug FROM tipos_sanguineos WHERE numeroUnico='".$tipo_sanguineoGet."'"));
		$tipo_sanguineo_numeroUnicoSet = $rSqlTipoSanguineo['numeroUnico'];
		$tipo_sanguineo_txtSet = $rSqlTipoSanguineo['slug'];
	}
	
	if(trim($_POST['numeroUnico_tipos_sanguineos'])=="") { 
		$_POST['numeroUnico_tipos_sanguineos'] = "";
		$_POST['tipo_sanguineo'] = "";
	} else {
		$rSqlTipoSanguineo = mysql_fetch_array(mysql_query("SELECT numeroUnico,slug FROM tipos_sanguineos WHERE numeroUnico='".$_POST['numeroUnico_tipos_sanguineos']."'"));
		$_POST['numeroUnico_tipos_sanguineos'] = $rSqlTipoSanguineo['numeroUnico'];
		$_POST['tipo_sanguineo'] = $rSqlTipoSanguineo['slug'];
	}
	
	if(trim($_POST['numeroUnico_etnias'])=="" || trim($_POST['numeroUnico_etnias'])=="0") { 
		$_POST['numeroUnico_etnias'] = "0";
	} else {
		$_POST['numeroUnico_etnias'] = $_POST['numeroUnico_etnias'];
	}
	
	if(trim($_POST['comunicante_hanseniase'])=="" || trim($_POST['comunicante_hanseniase'])=="0") { 
		$_POST['comunicante_hanseniase'] = "0";
	} else {
		$_POST['comunicante_hanseniase'] = $_POST['comunicante_hanseniase'];
	}
	
	if(trim($_POST['declarado_morto'])=="" || trim($_POST['declarado_morto'])=="0") { 
		$_POST['declarado_morto'] = "0";
	} else {
		$_POST['declarado_morto'] = $_POST['declarado_morto'];
	}
	
	if(trim($_POST['gestante'])=="" || trim($_POST['gestante'])=="0") { 
		$_POST['gestante'] = "0";
	} else {
		$_POST['gestante'] = $_POST['gestante'];
	}
	
	if(trim($_POST['puerpera'])=="" || trim($_POST['puerpera'])=="0") { 
		$_POST['puerpera'] = "0";
	} else {
		$_POST['puerpera'] = $_POST['puerpera'];
	}
	
	if(trim($_POST['acaoForm'])=="editar" || trim($_POST['acaoForm'])=="editar-continuar") {
	
		$rSqlPessoaEmail = mysql_fetch_array(mysql_query("SELECT email FROM pessoas WHERE id='".$_POST['iditem']."'"));
		if(trim($rSqlPessoaEmail['email'])==trim($_POST['email'])) { 
			$_POST['email_valido'] = "1";
			$_POST['email_valido_checado'] = "1";
		} else {
			$_POST['email_valido'] = "0";
			$_POST['email_valido_checado'] = "0";
		}
	
		if(trim($_FILES["avatar"]["name"])=="") { } else { 
			$_POST['avatar'] = " avatar='".$_POST['avatar']."', "; 
			$_POST['imagem_perfil_base64'] = " imagem_perfil_base64='".$_POST['imagem_perfil_base64']."', ";
		}
	
		if(trim($_FILES["imagem_doc_frente_base64"]["name"])=="") { } else { $_POST['imagem_doc_frente_base64'] = " imagem_doc_frente_base64='".$_POST['imagem_doc_frente_base64']."', "; }
		if(trim($_FILES["imagem_doc_verso_base64"]["name"])=="") { } else { $_POST['imagem_doc_verso_base64'] = " imagem_doc_verso_base64='".$_POST['imagem_doc_verso_base64']."', "; }
	
		$rSqlPessoaObjeto = mysql_fetch_array(mysql_query("SELECT * FROM pessoas WHERE id='".$_POST['iditem']."'"));
		if(trim($rSqlPessoaObjeto['objetoModificacoes'])=="") { 
			$modificacoesControle[] = array("tag" => "modificacoes", 
											"numeroUnico" => "".geraCodReturn()."", 
											"sysusu" => "".$rSqlPessoaObjeto['idsysusu']."", 
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
		
		if(trim($_POST['empresa'])=="" || trim($_POST['empresa'])=="0") { $_POST['empresa'] = ""; } else { $_POST['empresa'] = " empresa='".$rSqlEmpresa['id']."', "; }
		if(trim($_POST['empresa_token'])=="" || trim($_POST['empresa_token'])=="0") { $_POST['empresa_token'] = ""; } else { $_POST['empresa_token'] = " empresa_token='".$rSqlEmpresa['token']."', "; }
		if(trim($_POST['plataforma'])=="" || trim($_POST['plataforma'])=="0") { $_POST['plataforma'] = ""; } else { $_POST['plataforma'] = " plataforma='".$_POST['plataforma']."', "; }
		if(trim($_POST['plataforma_token'])=="" || trim($_POST['plataforma_token'])=="0") { $_POST['plataforma_token'] = ""; } else { $_POST['plataforma_token'] = " plataforma_token='".$_POST['plataforma_token']."', "; }
	
		$update = mysql_query("
								UPDATE 
									pessoas 
								SET 
									".$_POST['empresa']."
									".$_POST['empresa_token']."
									".$_POST['plataforma']."
									".$_POST['plataforma_token']."
	
									numeroUnico_profissional='".$_POST['numeroUnico_profissional']."',
									pessoa='".$_POST['pessoa']."',
	
									categorias_de_pessoas='".$_POST['categorias_de_pessoas']."', 
									categorias_de_pessoas_outras='".$_POST['categorias_de_pessoas_outras']."', 
									numeroUnico_atividades='".$_POST['numeroUnico_atividades']."', 
									numeroUnico_atividades_outras='".$_POST['numeroUnico_atividades_outras']."', 
									nome='".$_POST['nome']."', 
									razao_social='".$_POST['razao_social']."', 
									".$_POST['avatar']."
									".$_POST['imagem_perfil_base64']."
									".$_POST['imagem_doc_frente_base64']."
									".$_POST['imagem_doc_verso_base64']."
									tipo_documento='".$_POST['tipo_documento_cadastro']."', 
									documento='".$_POST['documento']."', 
									genero='".$_POST['genero']."', 
									gestante='".$_POST['gestante']."', 
									puerpera='".$_POST['puerpera']."', 
									numeroUnico_etnias='".$_POST['numeroUnico_etnias']."', 
									declarado_morto='".$_POST['declarado_morto']."', 
									numeroUnico_tipos_sanguineos='".$_POST['numeroUnico_tipos_sanguineos']."', 
									tipo_sanguineo='".$_POST['tipo_sanguineo']."', 
									data_de_nascimento='".$_POST['data_de_nascimento']."', 
									data_de_aniversario='".$_POST['data_de_aniversario']."', 
									senha='".$_POST['senha']."', 
									senha_conf='".$_POST['senha_conf']."', 
									cliente='".$_POST['cliente']."', 
									profissional='".$_POST['profissional']."', 
									banco='".$_POST['banco']."', 
									agencia='".$_POST['agencia']."', 
									conta='".$_POST['conta']."', 
									digito='".$_POST['digito']."', 
									email='".$_POST['email']."', 
									email_valido='".$_POST['email_valido']."', 
									email_valido_checado='".$_POST['email_valido_checado']."', 
									telefone='".$_POST['telefone']."', 
									instagram='".$_POST['instagram']."', 
									facebook='".$_POST['facebook']."', 
									whatsapp='".$_POST['whatsapp']."', 
									aceita_whatsapp='".$_POST['aceita_whatsapp']."', 
									cep='".$_POST['cep']."', 
									numeroUnico_tipos_de_logradouro='".$_POST['numeroUnico_tipos_de_logradouro']."', 
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
	
									horarios_de_atendimento='".$_SESSION['horarios_de_atendimento_'.$_SESSION['numeroUnicoGerado'].'']."',
	
									responsavel_nome='".$_POST['responsavel_nome']."', 
									responsavel_data_de_nascimento='".$_POST['responsavel_data_de_nascimento']."', 
									responsavel_data_de_aniversario='".$_POST['responsavel_data_de_aniversario']."', 
									responsavel_genero='".$_POST['responsavel_genero']."', 
									responsavel_cargo='".$_POST['responsavel_cargo']."', 
									responsavel_email='".$_POST['responsavel_email']."', 
									responsavel_whatsapp='".$_POST['responsavel_whatsapp']."', 
									responsavel_telefone='".$_POST['responsavel_telefone']."', 
									responsavel_cep='".$_POST['responsavel_cep']."', 
									responsavel_rua='".$_POST['responsavel_rua']."', 
									responsavel_numero='".$_POST['responsavel_numero']."', 
									responsavel_complemento='".$_POST['responsavel_complemento']."', 
									responsavel_bairro='".$_POST['responsavel_bairro']."', 
									responsavel_cidade='".$_POST['responsavel_cidade']."', 
									responsavel_estado='".$_POST['responsavel_estado']."', 
									responsavel_latitude='".$_POST['responsavel_latitude']."', 
									responsavel_longitude='".$_POST['responsavel_longitude']."', 
	
									plataforma_site='".$_POST['plataforma_site']."', 
									plataforma_ios='".$_POST['plataforma_ios']."', 
									plataforma_android='".$_POST['plataforma_android']."', 
									notificacoes_de_push='".$_POST['notificacoes_de_push']."', 
									notificacoes_por_email='".$_POST['notificacoes_por_email']."', 
									alerta_de_envio='".$_POST['alerta_de_envio']."', 
									alerta_de_recebimento='".$_POST['alerta_de_recebimento']."', 
									alerta_de_troca='".$_POST['alerta_de_troca']."', 
									alerta_de_cancelamento='".$_POST['alerta_de_cancelamento']."', 
									alerta_de_estorno='".$_POST['alerta_de_estorno']."', 
									push_de_propaganda='".$_POST['push_de_propaganda']."', 
									mala_direta_por_e_mail='".$_POST['mala_direta_por_e_mail']."', 
	
									dados_pessoais='".$_POST['dados_pessoais']."', 
									endereco='".$_POST['endereco']."', 
									foto_doc_frente='".$_POST['foto_doc_frente']."', 
									foto_doc_verso='".$_POST['foto_doc_verso']."', 
									foto_perfil='".$_POST['foto_perfil']."', 
									dados_bancarios='".$_POST['dados_bancarios']."', 
									validacao_atendente='".$_POST['validacao_atendente']."', 
	
									numeroUnico_unidades_de_saude='".$_POST['numeroUnico_unidades_de_saude']."', 
									nome_da_mae='".$_POST['nome_da_mae']."', 
									nome_do_pai='".$_POST['nome_do_pai']."', 
									profissional_da_saude='".$_POST['profissional_da_saude']."', 
									cns='".$_POST['cns']."', 
									comunicante_hanseniase='".$_POST['comunicante_hanseniase']."', 
									encontrase_acamado='".$_POST['encontrase_acamado']."', 
									info_verdadeira='".$_POST['info_verdadeira']."', 
									contraiu_doenca='".$_POST['contraiu_doenca']."', 
									numeroUnico_vacinas='".$_POST['numeroUnico_vacinas']."', 
									doenca_outros='".$_POST['doenca_outros']."', 
									comorbidade_pai='".$_POST['comorbidade_pai']."', 
									comorbidade_filho='".$_POST['comorbidade_filho']."', 
									
									dataModificacao='".$data."' ,
									
									objetoModificacoes='".$modificacoesControleSerial."'
								WHERE 
									id='".$_POST['iditem']."' ");
	} else {
		$insert = mysql_query("INSERT INTO pessoas (
													 idsysusu, 
													 empresa,
													 empresa_token,
	
													 plataforma, 
													 plataforma_token, 
					
													 numeroUnico_profissional,
													 pessoa,
													 
													 numeroUnico,
													 categorias_de_pessoas,
													 categorias_de_pessoas_outras,
													 numeroUnico_atividades, 
													 numeroUnico_atividades_outras, 
													 nome,
													 razao_social,
													 avatar,
													 imagem_perfil_base64,
													 imagem_doc_frente_base64,
													 imagem_doc_verso_base64,
													 tipo_documento,
													 documento,
													 data_de_nascimento,
													 data_de_aniversario,
													 genero,
													 gestante,
													 puerpera,
													 numeroUnico_etnias,
													 declarado_morto,
													 numeroUnico_tipos_sanguineos,
													 tipo_sanguineo,
													 senha,
													 senha_conf,
													 cliente, 
													 profissional, 
													 banco, 
													 agencia, 
													 conta, 
													 digito, 
													 email, 
													 email_valido, 
													 email_valido_checado, 
													 telefone, 
													 instagram, 
													 facebook, 
													 whatsapp,
													 aceita_whatsapp, 
													 cep, 
													 numeroUnico_tipos_de_logradouro,
													 rua, 
													 numero, 
													 complemento, 
													 bairro_id, 
													 cidade_id, 
													 bairro, 
													 cidade, 
													 estado, 
													 latitude, 
													 longitude,
													 
													 horarios_de_atendimento, 
	
													 responsavel_nome, 
													 responsavel_genero,
													 responsavel_data_de_nascimento,
													 responsavel_data_de_aniversario,
													 responsavel_cargo, 
													 responsavel_email, 
													 responsavel_whatsapp, 
													 responsavel_telefone, 
													 responsavel_cep, 
													 responsavel_rua, 
													 responsavel_numero, 
													 responsavel_complemento, 
													 responsavel_bairro, 
													 responsavel_cidade, 
													 responsavel_estado, 
													 responsavel_latitude, 
													 responsavel_longitude, 
	
													 plataforma_site, 
													 plataforma_ios, 
													 plataforma_android, 
													 notificacoes_de_push, 
													 notificacoes_por_email, 
													 alerta_de_envio, 
													 alerta_de_recebimento, 
													 alerta_de_troca, 
													 alerta_de_cancelamento, 
													 alerta_de_estorno, 
													 push_de_propaganda, 
													 mala_direta_por_e_mail, 
	
													 dados_pessoais, 
													 endereco, 
													 foto_doc_frente, 
													 foto_doc_verso, 
													 foto_perfil, 
													 dados_bancarios, 
													 validacao_atendente,
													 
													 numeroUnico_unidades_de_saude, 
													 nome_da_mae,
													 nome_do_pai, 
													 profissional_da_saude, 
													 cns,
													 comunicante_hanseniase, 
													 encontrase_acamado, 
													 info_verdadeira, 
													 contraiu_doenca, 
													 numeroUnico_vacinas, 
													 doenca_outros, 
													 comorbidade_pai, 
													 comorbidade_filho, 
					
													 stat,
													 data,
													 dataModificacao
													) VALUES (
													'".$sysusu['id']."', 
													'".$rSqlEmpresa['id']."', 
													'".$rSqlEmpresa['token']."',
	
													'".$_POST['plataforma']."', 
													'".$_POST['plataforma_token']."', 
	
													'".$_POST['numeroUnico_profissional']."',
													'".$_POST['pessoa']."',
													 
													'".$_POST['numeroUnico']."',
													'".$_POST['categorias_de_pessoas']."', 
													'".$_POST['categorias_de_pessoas_outras']."', 
													'".$_POST['numeroUnico_atividades']."', 
													'".$_POST['numeroUnico_atividades_outras']."', 
													'".$_POST['nome']."', 
													'".$_POST['razao_social']."', 
													'".$_POST['avatar']."', 
													'".$_POST['imagem_perfil_base64']."', 
													'".$_POST['imagem_doc_frente_base64']."', 
													'".$_POST['imagem_doc_verso_base64']."', 
													'".$_POST['tipo_documento_cadastro']."', 
													'".$_POST['documento']."', 
													'".$_POST['data_de_nascimento']."', 
													'".$_POST['data_de_aniversario']."', 
													'".$_POST['genero']."', 
													'".$_POST['gestante']."', 
													'".$_POST['puerpera']."', 
													'".$_POST['numeroUnico_etnias']."', 
													'".$_POST['declarado_morto']."', 
													'".$_POST['numeroUnico_tipos_sanguineos']."', 
													'".$_POST['tipo_sanguineo']."', 
													'".$_POST['senha']."', 
													'".$_POST['senha_conf']."', 
													'".$_POST['cliente']."', 
													'".$_POST['profissional']."', 
													'".$_POST['banco']."', 
													'".$_POST['agencia']."', 
													'".$_POST['conta']."', 
													'".$_POST['digito']."', 
													'".$_POST['email']."', 
													'0', 
													'0', 
													'".$_POST['telefone']."', 
													'".$_POST['instagram']."', 
													'".$_POST['facebook']."', 
													'".$_POST['whatsapp']."',
													'".$_POST['aceita_whatsapp']."', 
													'".$_POST['cep']."', 
													'".$_POST['numeroUnico_tipos_de_logradouro']."', 
													'".$_POST['rua']."', 
													'".$_POST['numero']."', 
													'".$_POST['complemento']."', 
													'".$_POST['bairro_id']."', 
													'".$_POST['cidade_id']."', 
													'".$_POST['bairro']."', 
													'".$_POST['cidade']."', 
													'".$_POST['estado']."', 
													'".$_POST['latitude']."', 
													'".$_POST['longitude']."', 
													
													'".$_SESSION['horarios_de_atendimento_'.$_SESSION['numeroUnicoGerado'].'']."',
	
													'".$_POST['responsavel_nome']."', 
													'".$_POST['responsavel_genero']."', 
													'".$_POST['responsavel_data_de_nascimento']."', 
													'".$_POST['responsavel_data_de_aniversario']."', 
													'".$_POST['responsavel_cargo']."', 
													'".$_POST['responsavel_email']."', 
													'".$_POST['responsavel_whatsapp']."', 
													'".$_POST['responsavel_telefone']."', 
													'".$_POST['responsavel_cep']."', 
													'".$_POST['responsavel_rua']."', 
													'".$_POST['responsavel_numero']."', 
													'".$_POST['responsavel_complemento']."', 
													'".$_POST['responsavel_bairro']."', 
													'".$_POST['responsavel_cidade']."', 
													'".$_POST['responsavel_estado']."', 
													'".$_POST['responsavel_latitude']."', 
													'".$_POST['responsavel_longitude']."', 
	
													'".$_POST['plataforma_site']."', 
													'".$_POST['plataforma_ios']."', 
													'".$_POST['plataforma_android']."', 
													'".$_POST['notificacoes_de_push']."', 
													'".$_POST['notificacoes_por_email']."', 
													'".$_POST['alerta_de_envio']."', 
													'".$_POST['alerta_de_recebimento']."', 
													'".$_POST['alerta_de_troca']."', 
													'".$_POST['alerta_de_cancelamento']."', 
													'".$_POST['alerta_de_estorno']."', 
													'".$_POST['push_de_propaganda']."', 
													'".$_POST['mala_direta_por_e_mail']."', 
	
													'".$_POST['dados_pessoais']."', 
													'".$_POST['endereco']."', 
													'".$_POST['foto_doc_frente']."', 
													'".$_POST['foto_doc_verso']."', 
													'".$_POST['foto_perfil']."', 
													'".$_POST['dados_bancarios']."', 
													'".$_POST['validacao_atendente']."', 
					
													'".$_POST['numeroUnico_unidades_de_saude']."', 
													'".$_POST['nome_da_mae']."', 
													'".$_POST['nome_do_pai']."', 
													'".$_POST['profissional_da_saude']."', 
													'".$_POST['cns']."', 
													'".$_POST['comunicante_hanseniase']."', 
													'".$_POST['encontrase_acamado']."', 
													'".$_POST['info_verdadeira']."', 
													'".$_POST['contraiu_doenca']."', 
													'".$_POST['numeroUnico_vacinas']."', 
													'".$_POST['doenca_outros']."', 
													'".$_POST['comorbidade_pai']."', 
													'".$_POST['comorbidade_filho']."', 
					
													'1',
													'".$data."',
													'".$data."'
													)");
	}
	
	$_SESSION['horarios_de_atendimento_'.$_SESSION['numeroUnicoGerado'].''] = "";
	$_SESSION['numeroUnicoGerado'] = "";
	
	if(trim($_POST['acaoForm'])=="add-continuar" || trim($_POST['acaoForm'])=="editar-continuar") {
		$urlEditar = "editar/".$_POST['numeroUnico']."/";
	}
}

$chave_gerada = geraCodReturn()."/";
echo"<script>window.open('".$link."".$chave_gerada."".$_REQUEST['var1']."/".$_REQUEST['var2']."/".$urlEditar."','_self','')</script>";
?>

