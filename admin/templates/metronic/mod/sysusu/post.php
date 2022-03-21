<?
	$mod = $_POST['modulo'];             

	if(trim($_POST['acaoForm'])=="add"||trim($_POST['acaoForm'])=="add-continuar") {

		if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
			$rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT id,token,tipo_empresa FROM empresa WHERE id='".$_POST['empresa']."' "));
		} else {
			$rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT id,token,tipo_empresa FROM empresa WHERE id='".$sysusu['empresa']."' "));
		}
		$_POST['plataforma'] = $rSqlPlataforma['id'];
		$_POST['plataforma_token'] = $rSqlPlataforma['token'];

			if(trim($_POST['pdv'])=="" || trim($_POST['pdv'])=="0") { } else {
				$rSqlPdv = mysql_fetch_array(mysql_query("SELECT empresa FROM pdv WHERE id='".$_POST['pdv']."' "));
				$rSqlEmpresaPdv = mysql_fetch_array(mysql_query("SELECT id FROM empresa WHERE id='".$rSqlPdv['empresa']."' "));
				$update = mysql_query("UPDATE empresa SET dataNovoConteudo='".$data."' WHERE id='".$rSqlEmpresaPdv['id']."'");
			}
		
		$_POST['senha_conf'] = $_POST['senha'];
		$_POST['senha'] = md5($_POST['senha']);
		
		$_POST['cod_voucher'] = geraCodCont();

		$_POST['cpf'] = preg_replace("/[^0-9]/", "", $_POST['cpf']);

		$_POST['data_de_nascimento'] = normalTOdate($_POST['data_de_nascimento']);
		$_POST['data_de_aniversario'] = substr($_POST['data_de_nascimento'],4,6);
		$_POST['data_de_aniversario'] = "0000".$_POST['data_de_aniversario']."";

		$COORDENADAS = latitude_longitude($_POST,"",$GOOGLE_MAP_KEY_SET);
		$_POST['latitude'] = $COORDENADAS['latitude'];
		$_POST['longitude'] = $COORDENADAS['longitude'];

		upload_arquivo_nativo($mod,"imagem","");

		# Gravação do Log
		$logPerfil = "administrador";
		$logId = $sysusu['id'];
		$logAcao = "Adicionar";
		$logLocal = "Usuário";
		$logDescricao = "Foi adicionado o item <b>".$_POST['nome']."</b>";
		$logData = $data;

		$_POST['data'] = $data;
		$_POST['dataModificacao'] = $data;

		if(trim($_POST['acaoForm'])=="add") {
			$acaFormSet = "add";
		} else {
			$acaFormSet = "add-continuar";
		}
		
		$numeroUnicoSet = $_POST['numeroUnico'];
		$abaSet = $_POST['aba'];

		insert($_POST,$mod,$sysusu['id']);

		if(trim($_POST['idsysgrupousuario'])=="") { } else {
			$item = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE numeroUnico='".$numeroUnicoSet."'"));
			$idEditavel = $item['id'];
			$sysgrupousuario_set = mysql_fetch_array(mysql_query("SELECT permissoes FROM sysgrupousuario WHERE id='".$_POST['idsysgrupousuario']."'"));

			$update = mysql_query("UPDATE sysusu SET permissoes='".$sysgrupousuario_set['permissoes']."' WHERE id='".$idEditavel."' ");
		}

	} else {
		if(trim($_POST['acaoForm'])=="editar"||trim($_POST['acaoForm'])=="editar-continuar") {

			$idEditavel = $_POST['iditem'];
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
	
			if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
				$rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT id,token,tipo_empresa FROM empresa WHERE id='".$_POST['empresa']."' "));
			} else {
				$rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT id,token,tipo_empresa FROM empresa WHERE id='".$sysusu['empresa']."' "));
			}
			$_POST['plataforma'] = $rSqlPlataforma['id'];
			$_POST['plataforma_token'] = $rSqlPlataforma['token'];
	
			if(trim($_POST['pdv'])=="" || trim($_POST['pdv'])=="0") { } else {
				$rSqlPdv = mysql_fetch_array(mysql_query("SELECT empresa FROM pdv WHERE id='".$_POST['pdv']."' "));
				$rSqlEmpresaPdv = mysql_fetch_array(mysql_query("SELECT id FROM empresa WHERE id='".$rSqlPdv['empresa']."' "));
				$update = mysql_query("UPDATE empresa SET dataNovoConteudo='".$data."' WHERE id='".$rSqlEmpresaPdv['id']."'");
			}
	
			if(trim($_POST['senha'])=="") { 
				$_POST['senha_conf'] = $item['senha'];
				$SenhaNova = $item['senha']; 
			} else { 
				$_POST['senha_conf'] = $_POST['senha'];
				$SenhaNova = md5($_POST['senha']);
			}
			$_POST['senha'] = $SenhaNova;
	
			$_POST['cpf'] = preg_replace("/[^0-9]/", "", $_POST['cpf']);

			$_POST['data_de_nascimento'] = normalTOdate($_POST['data_de_nascimento']);
			$_POST['data_de_aniversario'] = substr($_POST['data_de_nascimento'],4,6);
			$_POST['data_de_aniversario'] = "0000".$_POST['data_de_aniversario']."";

			$COORDENADAS = latitude_longitude($_POST,"",$GOOGLE_MAP_KEY_SET);
			$_POST['latitude'] = $COORDENADAS['latitude'];
			$_POST['longitude'] = $COORDENADAS['longitude'];
	
			$campo_imagem = "imagem";
			if(trim($_FILES[$campo_imagem]["name"])=="") {
				$_POST[$campo_imagem] = $item[$campo_imagem];
			} else {
				upload_arquivo_nativo($mod,$campo_imagem,"");
			}
	
			# Gravação do Log
			$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Editou";
			$logLocal = "Usuários";
			$logDescricao = "Foi editado o item <b>".$itemAntes['nome']."</b>";
			$logData = $data;
	
			$_POST['dataModificacao'] = $data;
	
			if(trim($_POST['acaoForm'])=="editar") {
				$acaFormSet = "editar";
			} else {
				$acaFormSet = "editar-continuar";
			}

			$numeroUnicoSet = $_POST['numeroUnico'];
			$abaSet = $_POST['aba'];

	
			update($_POST,$mod,$idEditavel);

			if(trim($_POST['idsysgrupousuario'])=="") { } else {
				$sysgrupousuario_set = mysql_fetch_array(mysql_query("SELECT permissoes FROM sysgrupousuario WHERE id='".$_POST['idsysgrupousuario']."'"));

				$update = mysql_query("UPDATE sysusu SET permissoes='".$sysgrupousuario_set['permissoes']."' WHERE id='".$idEditavel."' ");
			}
			
			if(trim($_REQUEST['var2'])=="meus-dados") {
				$rLogin=mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$idEditavel."'"));
				
				setcookie("email", "", time()-3600, '/');
				setcookie("senha", "", time()-3600, '/');
			
				setcookie("perfil", "administrador", time()+7200 , '/');
				setcookie("email",  $rLogin['email'], time()+7200 , '/');
				setcookie("senha", $rLogin['senha'], time()+7200 , '/');
			}


		} else {
			if(trim($_POST['acaoForm'])=="excluir".$_POST['subMod']."") {

				if(trim($_POST['subMod'])=="") { 
					foreach ($_POST['msg_sel'] as $idcheck) {
						$sql = mysql_query("DELETE FROM ".$mod."".$_POST['subMod']." WHERE id='".$idcheck."'");
					}
				} else {
					foreach ($_POST['msg_sel'] as $idcheck) {
						$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."".$mod."".$_POST['subMod']." WHERE id='".$idcheck."'"));
	
						$qall = mysql_query("SELECT * FROM ".$linguagem_set."".$mod."".$_POST['subMod']."");
						while($rall = mysql_fetch_array($qall)) {
							if( $rall['ordem'] > $item['ordem']) {
								$ordem = $rall['ordem'] - 1;
								$update = mysql_query("UPDATE ".$linguagem_set."".$mod."".$_POST['subMod']." SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
							}
						}
	
						$sql = mysql_query("DELETE FROM ".$mod."".$_POST['subMod']." WHERE id='".$idcheck."'");
					}
				}


			} else {
				if(trim($_POST['acaoForm'])=="publicar".$_POST['subMod']."") {
					foreach ($_POST['msg_sel'] as $idcheck) {
						$sql = mysql_query("UPDATE ".$mod."".$_POST['subMod']." SET stat='1' WHERE id='".$idcheck."'");
					}
	
				} else {
					if(trim($_POST['acaoForm'])=="despublicar".$_POST['subMod']."") {
						foreach ($_POST['msg_sel'] as $idcheck) {
							$sql = mysql_query("UPDATE ".$mod."".$_POST['subMod']." SET stat='0' WHERE id='".$idcheck."'");
						}
					} else {
						if(trim($_POST['acaoForm'])=="permissoes"||trim($_POST['acaoForm'])=="permissoes-continuar") {

							if(trim($_POST['visualizar_dashboard'])=="") { $_POST['visualizar_dashboard']=0; } else { $_POST['visualizar_dashboard']=1; }             

							if(trim($_POST['visualizar_sysusu'])=="") { $_POST['visualizar_sysusu']=0; } else { $_POST['visualizar_sysusu']=1; }             
							if(trim($_POST['todos_sysusu'])=="") { $_POST['todos_sysusu']=0; } else { $_POST['todos_sysusu']=1; }             
							if(trim($_POST['inserir_sysusu'])=="") { $_POST['inserir_sysusu']=0; } else { $_POST['inserir_sysusu']=1; }             
							if(trim($_POST['editar_sysusu'])=="") { $_POST['editar_sysusu']=0; } else { $_POST['editar_sysusu']=1; }             
							if(trim($_POST['excluir_sysusu'])=="") { $_POST['excluir_sysusu']=0; } else { $_POST['excluir_sysusu']=1; }             
							if(trim($_POST['publicar_sysusu'])=="") { $_POST['publicar_sysusu']=0; } else { $_POST['publicar_sysusu']=1; }             
							if(trim($_POST['despublicar_sysusu'])=="") { $_POST['despublicar_sysusu']=0; } else { $_POST['despublicar_sysusu']=1; }             
							if(trim($_POST['lixeira_sysusu'])=="") { $_POST['lixeira_sysusu']=0; } else { $_POST['lixeira_sysusu']=1; }             
							if(trim($_POST['restaurar_sysusu'])=="") { $_POST['restaurar_sysusu']=0; } else { $_POST['restaurar_sysusu']=1; }             
							if(trim($_POST['senha_sysusu'])=="") { $_POST['senha_sysusu']=0; } else { $_POST['senha_sysusu']=1; }             
							if(trim($_POST['dados_sysusu'])=="") { $_POST['dados_sysusu']=0; } else { $_POST['dados_sysusu']=1; }             
							if(trim($_POST['configuracao_sysusu'])=="") { $_POST['configuracao_sysusu']=0; } else { $_POST['configuracao_sysusu']=1; }
							if(trim($_POST['chat_sysusu'])=="") { $_POST['chat_sysusu']=0; } else { $_POST['chat_sysusu']=1; }
						
							if(trim($_POST['visualizar_sysgrupousuario'])=="") { $_POST['visualizar_sysgrupousuario']=0; } else { $_POST['visualizar_sysgrupousuario']=1; }             
							if(trim($_POST['inserir_sysgrupousuario'])=="") { $_POST['inserir_sysgrupousuario']=0; } else { $_POST['inserir_sysgrupousuario']=1; }             
							if(trim($_POST['editar_sysgrupousuario'])=="") { $_POST['editar_sysgrupousuario']=0; } else { $_POST['editar_sysgrupousuario']=1; }             
							if(trim($_POST['excluir_sysgrupousuario'])=="") { $_POST['excluir_sysgrupousuario']=0; } else { $_POST['excluir_sysgrupousuario']=1; }             
							if(trim($_POST['publicar_sysgrupousuario'])=="") { $_POST['publicar_sysgrupousuario']=0; } else { $_POST['publicar_sysgrupousuario']=1; }             
							if(trim($_POST['despublicar_sysgrupousuario'])=="") { $_POST['despublicar_sysgrupousuario']=0; } else { $_POST['despublicar_sysgrupousuario']=1; }             
							if(trim($_POST['lixeira_sysgrupousuario'])=="") { $_POST['lixeira_sysgrupousuario']=0; } else { $_POST['lixeira_sysgrupousuario']=1; }             
							if(trim($_POST['restaurar_sysgrupousuario'])=="") { $_POST['restaurar_sysgrupousuario']=0; } else { $_POST['restaurar_sysgrupousuario']=1; }             
						
							if(trim($_POST['todos_syschamado'])=="") { $_POST['todos_syschamado']=0; } else { $_POST['todos_syschamado']=1; }             
							if(trim($_POST['visualizar_syschamado'])=="") { $_POST['visualizar_syschamado']=0; } else { $_POST['visualizar_syschamado']=1; }             
							if(trim($_POST['inserir_syschamado'])=="") { $_POST['inserir_syschamado']=0; } else { $_POST['inserir_syschamado']=1; }             
							if(trim($_POST['editar_syschamado'])=="") { $_POST['editar_syschamado']=0; } else { $_POST['editar_syschamado']=1; }             
							if(trim($_POST['excluir_syschamado'])=="") { $_POST['excluir_syschamado']=0; } else { $_POST['excluir_syschamado']=1; }             
							if(trim($_POST['publicar_syschamado'])=="") { $_POST['publicar_syschamado']=0; } else { $_POST['publicar_syschamado']=1; }             
							if(trim($_POST['despublicar_syschamado'])=="") { $_POST['despublicar_syschamado']=0; } else { $_POST['despublicar_syschamado']=1; }             
							if(trim($_POST['lista_syschamado'])=="") { $_POST['lista_syschamado']=0; } else { $_POST['lista_syschamado']=1; }             
							if(trim($_POST['atendente_syschamado'])=="") { $_POST['atendente_syschamado']=0; } else { $_POST['atendente_syschamado']=1; }             
						
							if(trim($_POST['visualizar_construtor_modulo'])=="") { $_POST['visualizar_construtor_modulo']=0; } else { $_POST['visualizar_construtor_modulo']=1; }             
							if(trim($_POST['inserir_construtor_modulo'])=="") { $_POST['inserir_construtor_modulo']=0; } else { $_POST['inserir_construtor_modulo']=1; }             
							if(trim($_POST['editar_construtor_modulo'])=="") { $_POST['editar_construtor_modulo']=0; } else { $_POST['editar_construtor_modulo']=1; }             
							if(trim($_POST['excluir_construtor_modulo'])=="") { $_POST['excluir_construtor_modulo']=0; } else { $_POST['excluir_construtor_modulo']=1; }             
							if(trim($_POST['publicar_construtor_modulo'])=="") { $_POST['publicar_construtor_modulo']=0; } else { $_POST['publicar_construtor_modulo']=1; }             
							if(trim($_POST['despublicar_construtor_modulo'])=="") { $_POST['despublicar_construtor_modulo']=0; } else { $_POST['despublicar_construtor_modulo']=1; }             
						
							if(trim($_POST['visualizar_construtor_modulo_campo'])=="") { $_POST['visualizar_construtor_modulo_campo']=0; } else { $_POST['visualizar_construtor_modulo_campo']=1; }             
							if(trim($_POST['inserir_construtor_modulo_campo'])=="") { $_POST['inserir_construtor_modulo_campo']=0; } else { $_POST['inserir_construtor_modulo_campo']=1; }             
							if(trim($_POST['editar_construtor_modulo_campo'])=="") { $_POST['editar_construtor_modulo_campo']=0; } else { $_POST['editar_construtor_modulo_campo']=1; }             
							if(trim($_POST['excluir_construtor_modulo_campo'])=="") { $_POST['excluir_construtor_modulo_campo']=0; } else { $_POST['excluir_construtor_modulo_campo']=1; }             
							if(trim($_POST['publicar_construtor_modulo_campo'])=="") { $_POST['publicar_construtor_modulo_campo']=0; } else { $_POST['publicar_construtor_modulo_campo']=1; }             
							if(trim($_POST['despublicar_construtor_modulo_campo'])=="") { $_POST['despublicar_construtor_modulo_campo']=0; } else { $_POST['despublicar_construtor_modulo_campo']=1; }             
						
							if(trim($_POST['visualizar_construtor_modulo_funcao'])=="") { $_POST['visualizar_construtor_modulo_funcao']=0; } else { $_POST['visualizar_construtor_modulo_funcao']=1; }             
							if(trim($_POST['inserir_construtor_modulo_funcao'])=="") { $_POST['inserir_construtor_modulo_funcao']=0; } else { $_POST['inserir_construtor_modulo_funcao']=1; }             
							if(trim($_POST['editar_construtor_modulo_funcao'])=="") { $_POST['editar_construtor_modulo_funcao']=0; } else { $_POST['editar_construtor_modulo_funcao']=1; }             
							if(trim($_POST['excluir_construtor_modulo_funcao'])=="") { $_POST['excluir_construtor_modulo_funcao']=0; } else { $_POST['excluir_construtor_modulo_funcao']=1; }             
							if(trim($_POST['publicar_construtor_modulo_funcao'])=="") { $_POST['publicar_construtor_modulo_funcao']=0; } else { $_POST['publicar_construtor_modulo_funcao']=1; }             
							if(trim($_POST['despublicar_construtor_modulo_funcao'])=="") { $_POST['despublicar_construtor_modulo_funcao']=0; } else { $_POST['despublicar_construtor_modulo_funcao']=1; }             
						
							if(trim($_POST['visualizar_sysmidia'])=="") { $_POST['visualizar_sysmidia']=0; } else { $_POST['visualizar_sysmidia']=1; }             

							if(trim($_POST['visualizar_construtor_sysperm'])=="") { $_POST['visualizar_construtor_sysperm']=0; } else { $_POST['visualizar_construtor_sysperm']=1; }             
							if(trim($_POST['editar_construtor_sysperm'])=="") { $_POST['editar_construtor_sysperm']=0; } else { $_POST['editar_construtor_sysperm']=1; }             
						
							if(trim($_POST['visualizar_sysacesso'])=="") { $_POST['visualizar_sysacesso']=0; } else { $_POST['visualizar_sysacesso']=1; }             
							if(trim($_POST['admin_sysacesso'])=="") { $_POST['admin_sysacesso']=0; } else { $_POST['admin_sysacesso']=1; }             
						
							if(trim($_POST['visualizar_syslog'])=="") { $_POST['visualizar_syslog']=0; } else { $_POST['visualizar_syslog']=1; }             
							if(trim($_POST['admin_syslog'])=="") { $_POST['admin_syslog']=0; } else { $_POST['admin_syslog']=1; }             
						
							if(trim($_POST['admin_sysconfig'])=="") { $_POST['admin_sysconfig']=0; } else { $_POST['admin_sysconfig']=1; }             
							if(trim($_POST['site_sysconfig'])=="") { $_POST['site_sysconfig']=0; } else { $_POST['site_sysconfig']=1; }             
							if(trim($_POST['layout_sysconfig'])=="") { $_POST['layout_sysconfig']=0; } else { $_POST['layout_sysconfig']=1; }             
							if(trim($_POST['imagens_sysconfig'])=="") { $_POST['imagens_sysconfig']=0; } else { $_POST['imagens_sysconfig']=1; }             
							if(trim($_POST['mensagens_sysconfig'])=="") { $_POST['mensagens_sysconfig']=0; } else { $_POST['mensagens_sysconfig']=1; }             
							if(trim($_POST['seo_sysconfig'])=="") { $_POST['seo_sysconfig']=0; } else { $_POST['seo_sysconfig']=1; }             
							if(trim($_POST['indexacao_sysconfig'])=="") { $_POST['indexacao_sysconfig']=0; } else { $_POST['indexacao_sysconfig']=1; }             
							if(trim($_POST['analytics_sysconfig'])=="") { $_POST['analytics_sysconfig']=0; } else { $_POST['analytics_sysconfig']=1; }             
							if(trim($_POST['erro404_sysconfig'])=="") { $_POST['erro404_sysconfig']=0; } else { $_POST['erro404_sysconfig']=1; }             
							if(trim($_POST['instalacao_sysconfig'])=="") { $_POST['instalacao_sysconfig']=0; } else { $_POST['instalacao_sysconfig']=1; }             
							if(trim($_POST['dominios_sysconfig'])=="") { $_POST['dominios_sysconfig']=0; } else { $_POST['dominios_sysconfig']=1; }             
							if(trim($_POST['servidor_sysconfig'])=="") { $_POST['servidor_sysconfig']=0; } else { $_POST['servidor_sysconfig']=1; }             
							if(trim($_POST['visualizar_sysconfig'])=="") { $_POST['visualizar_sysconfig']=0; } else { $_POST['visualizar_sysconfig']=1; }             
						
							$qSql = mysql_query("SELECT nome_base FROM _construtor_modulo WHERE stat='1' ORDER BY ordem");
							while($rSql = mysql_fetch_array($qSql)) {
								if(trim($_POST['visualizar_'.$rSql['nome_base'].''])=="") { $_POST['visualizar_'.$rSql['nome_base'].'']=0; } else { $_POST['visualizar_'.$rSql['nome_base'].'']=1; }             
								if(trim($_POST['todos_'.$rSql['nome_base'].''])=="") { $_POST['todos_'.$rSql['nome_base'].'']=0; } else { $_POST['todos_'.$rSql['nome_base'].'']=1; }             
								if(trim($_POST['inserir_'.$rSql['nome_base'].''])=="") { $_POST['inserir_'.$rSql['nome_base'].'']=0; } else { $_POST['inserir_'.$rSql['nome_base'].'']=1; }             
								if(trim($_POST['editar_'.$rSql['nome_base'].''])=="") { $_POST['editar_'.$rSql['nome_base'].'']=0; } else { $_POST['editar_'.$rSql['nome_base'].'']=1; }             
								if(trim($_POST['excluir_'.$rSql['nome_base'].''])=="") { $_POST['excluir_'.$rSql['nome_base'].'']=0; } else { $_POST['excluir_'.$rSql['nome_base'].'']=1; }             
								if(trim($_POST['publicar_'.$rSql['nome_base'].''])=="") { $_POST['publicar_'.$rSql['nome_base'].'']=0; } else { $_POST['publicar_'.$rSql['nome_base'].'']=1; }             
								if(trim($_POST['despublicar_'.$rSql['nome_base'].''])=="") { $_POST['despublicar_'.$rSql['nome_base'].'']=0; } else { $_POST['despublicar_'.$rSql['nome_base'].'']=1; }             
								if(trim($_POST['lixeira_'.$rSql['nome_base'].''])=="") { $_POST['lixeira_'.$rSql['nome_base'].'']=0; } else { $_POST['lixeira_'.$rSql['nome_base'].'']=1; }             
								if(trim($_POST['restaurar_'.$rSql['nome_base'].''])=="") { $_POST['restaurar_'.$rSql['nome_base'].'']=0; } else { $_POST['restaurar_'.$rSql['nome_base'].'']=1; }             
								if(trim($_POST['descricao_'.$rSql['nome_base'].''])=="") { $_POST['descricao_'.$rSql['nome_base'].'']=0; } else { $_POST['descricao_'.$rSql['nome_base'].'']=1; }             
								if(trim($_POST['seo_'.$rSql['nome_base'].''])=="") { $_POST['seo_'.$rSql['nome_base'].'']=0; } else { $_POST['seo_'.$rSql['nome_base'].'']=1; }             
								if(trim($_POST['config_'.$rSql['nome_base'].''])=="") { $_POST['config_'.$rSql['nome_base'].'']=0; } else { $_POST['config_'.$rSql['nome_base'].'']=1; }             
								if(trim($_POST['minha_config_'.$rSql['nome_base'].''])=="") { $_POST['minha_config_'.$rSql['nome_base'].'']=0; } else { $_POST['minha_config_'.$rSql['nome_base'].'']=1; }             
							}
						
							# Gravação do Log
							$dataLogout = ajustaDataReturn($data,"d/m/Y");
							$logPerfil = "administrador";
							$logId = $sysusu['id'];
							$logAcao = "Editar";
							$logLocal = "Permissões";
							$logDescricao = "Foi alterada as permissões <b>".$perfilSet['nome']."</b> na seguinte data: <b>".$dataLogout."</b>";
							$logData = $data;
						
							$novo_permissoes = serialize($_POST);
							$update = mysql_query("UPDATE sysusu SET permissoes='".$novo_permissoes."',permissoes_personalizadas='1' WHERE id='".$_POST['idsysusu']."' ");
			
						} else {
						}
					}
				}
			}
		}
	}

	gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	
	if(trim($_POST['acaoForm'])=="add-continuar"||trim($_POST['acaoForm'])=="editar-continuar") {
		$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$numeroUnicoSet."'"));
		echo"<script>window.open('".$link."".$chave_url."".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$item['id']."/#".$abaSet."','_self','')</script>";
	} else {
		if(trim($_POST['acaoForm'])=="permissoes-continuar") {
			echo"<script>window.open('".$link."".$chave_url."".$_REQUEST['var1']."/".$_REQUEST['var2']."/permissoes/".$_POST['idsysusu']."/#".$_POST['aba']."','_self','')</script>";
		} else {
			echo"<script>window.open('".$link."".$chave_url."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
		}
	}
?>