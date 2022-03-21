<?
if($_GET['duplicar']=="1") {
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/chave.php");

	$lista_copia = str_replace("||","','",$_GET['selecionadosS']);
	$lista_copia = str_replace("|","'",$lista_copia);
	
	$rSqlItem = mysql_fetch_array(mysql_query("SELECT * FROM ".$_GET['modS']." WHERE numeroUnico='".$_GET['numeroUnicoS']."'"));
	
	$_POST['acaoForm'] = "";
	$_POST = $rSqlItem;
	$rSqlEmpresa['id'] = $rSqlItem['empresa'];
	$rSqlEmpresa['token'] = $rSqlItem['empresa_token'];
	$_POST['numeroUnico'] = geraCodReturn();

	$_POST['nome'] = "".$rSqlItem['nome']." - Cópia";
} else {
	if(trim($_POST['visualizar_dashboard'])=="") { $_POST['visualizar_dashboard']=0; } else { $_POST['visualizar_dashboard']=1; }             
	if(trim($_POST['admin_dashboard'])=="") { $_POST['admin_dashboard']=0; } else { $_POST['admin_dashboard']=1; }             
	
	if(trim($_POST['todos_sysusu'])=="") { $_POST['todos_sysusu']=0; } else { $_POST['todos_sysusu']=1; }             
	if(trim($_POST['visualizar_sysusu'])=="") { $_POST['visualizar_sysusu']=0; } else { $_POST['visualizar_sysusu']=1; }             
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
	
	if(trim($_POST['visualizar_syschamado'])=="") { $_POST['visualizar_syschamado']=0; } else { $_POST['visualizar_syschamado']=1; }             
	if(trim($_POST['todos_syschamado'])=="") { $_POST['todos_syschamado']=0; } else { $_POST['todos_syschamado']=1; }             
	if(trim($_POST['inserir_syschamado'])=="") { $_POST['inserir_syschamado']=0; } else { $_POST['inserir_syschamado']=1; }             
	if(trim($_POST['editar_syschamado'])=="") { $_POST['editar_syschamado']=0; } else { $_POST['editar_syschamado']=1; }             
	if(trim($_POST['excluir_syschamado'])=="") { $_POST['excluir_syschamado']=0; } else { $_POST['excluir_syschamado']=1; }             
	if(trim($_POST['publicar_syschamado'])=="") { $_POST['publicar_syschamado']=0; } else { $_POST['publicar_syschamado']=1; }             
	if(trim($_POST['despublicar_syschamado'])=="") { $_POST['despublicar_syschamado']=0; } else { $_POST['despublicar_syschamado']=1; }             
	if(trim($_POST['lista_syschamado'])=="") { $_POST['lista_syschamado']=0; } else { $_POST['lista_syschamado']=1; }             
	if(trim($_POST['atendente_syschamado'])=="") { $_POST['atendente_syschamado']=0; } else { $_POST['atendente_syschamado']=1; }             
	
	if(trim($_POST['visualizar_construtor_modulo'])==""||trim($_POST['visualizar_construtor_modulo'])=="") { $_POST['visualizar_construtor_modulo']=0; } else { $_POST['visualizar_construtor_modulo']=1; }             
	if(trim($_POST['inserir_construtor_modulo'])==""||trim($_POST['inserir_construtor_modulo'])=="") { $_POST['inserir_construtor_modulo']=0; } else { $_POST['inserir_construtor_modulo']=1; }             
	if(trim($_POST['editar_construtor_modulo'])==""||trim($_POST['editar_construtor_modulo'])=="") { $_POST['editar_construtor_modulo']=0; } else { $_POST['editar_construtor_modulo']=1; }             
	if(trim($_POST['excluir_construtor_modulo'])==""||trim($_POST['excluir_construtor_modulo'])=="") { $_POST['excluir_construtor_modulo']=0; } else { $_POST['excluir_construtor_modulo']=1; }             
	if(trim($_POST['publicar_construtor_modulo'])==""||trim($_POST['publicar_construtor_modulo'])=="") { $_POST['publicar_construtor_modulo']=0; } else { $_POST['publicar_construtor_modulo']=1; }             
	if(trim($_POST['despublicar_construtor_modulo'])==""||trim($_POST['despublicar_construtor_modulo'])=="") { $_POST['despublicar_construtor_modulo']=0; } else { $_POST['despublicar_construtor_modulo']=1; }             
	
	if(trim($_POST['visualizar_construtor_modulo_campo'])==""||trim($_POST['visualizar_construtor_modulo_campo'])=="") { $_POST['visualizar_construtor_modulo_campo']=0; } else { $_POST['visualizar_construtor_modulo_campo']=1; }             
	if(trim($_POST['inserir_construtor_modulo_campo'])==""||trim($_POST['inserir_construtor_modulo_campo'])=="") { $_POST['inserir_construtor_modulo_campo']=0; } else { $_POST['inserir_construtor_modulo_campo']=1; }             
	if(trim($_POST['editar_construtor_modulo_campo'])==""||trim($_POST['editar_construtor_modulo_campo'])=="") { $_POST['editar_construtor_modulo_campo']=0; } else { $_POST['editar_construtor_modulo_campo']=1; }             
	if(trim($_POST['excluir_construtor_modulo_campo'])==""||trim($_POST['excluir_construtor_modulo_campo'])=="") { $_POST['excluir_construtor_modulo_campo']=0; } else { $_POST['excluir_construtor_modulo_campo']=1; }             
	if(trim($_POST['publicar_construtor_modulo_campo'])==""||trim($_POST['publicar_construtor_modulo_campo'])=="") { $_POST['publicar_construtor_modulo_campo']=0; } else { $_POST['publicar_construtor_modulo_campo']=1; }             
	if(trim($_POST['despublicar_construtor_modulo_campo'])==""||trim($_POST['despublicar_construtor_modulo_campo'])=="") { $_POST['despublicar_construtor_modulo_campo']=0; } else { $_POST['despublicar_construtor_modulo_campo']=1; }             
	
	if(trim($_POST['visualizar_construtor_modulo_funcao'])==""||trim($_POST['visualizar_construtor_modulo_funcao'])=="") { $_POST['visualizar_construtor_modulo_funcao']=0; } else { $_POST['visualizar_construtor_modulo_funcao']=1; }             
	if(trim($_POST['inserir_construtor_modulo_funcao'])==""||trim($_POST['inserir_construtor_modulo_funcao'])=="") { $_POST['inserir_construtor_modulo_funcao']=0; } else { $_POST['inserir_construtor_modulo_funcao']=1; }             
	if(trim($_POST['editar_construtor_modulo_funcao'])==""||trim($_POST['editar_construtor_modulo_funcao'])=="") { $_POST['editar_construtor_modulo_funcao']=0; } else { $_POST['editar_construtor_modulo_funcao']=1; }             
	if(trim($_POST['excluir_construtor_modulo_funcao'])==""||trim($_POST['excluir_construtor_modulo_funcao'])=="") { $_POST['excluir_construtor_modulo_funcao']=0; } else { $_POST['excluir_construtor_modulo_funcao']=1; }             
	if(trim($_POST['publicar_construtor_modulo_funcao'])==""||trim($_POST['publicar_construtor_modulo_funcao'])=="") { $_POST['publicar_construtor_modulo_funcao']=0; } else { $_POST['publicar_construtor_modulo_funcao']=1; }             
	if(trim($_POST['despublicar_construtor_modulo_funcao'])==""||trim($_POST['despublicar_construtor_modulo_funcao'])=="") { $_POST['despublicar_construtor_modulo_funcao']=0; } else { $_POST['despublicar_construtor_modulo_funcao']=1; }             
	
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
	
	$qSql = mysql_query("SELECT numeroUnico,nome_base FROM _construtor_modulo WHERE stat='1' ORDER BY ordem");
	while($rSql = mysql_fetch_array($qSql)) {
		if(trim($_POST['visualizar_'.$rSql['numeroUnico'].''])=="") { $_POST['visualizar_'.$rSql['numeroUnico'].'']=0; } else { $_POST['visualizar_'.$rSql['numeroUnico'].'']=1; }             
		if(trim($_POST['todos_'.$rSql['numeroUnico'].''])=="") { $_POST['todos_'.$rSql['numeroUnico'].'']=0; } else { $_POST['todos_'.$rSql['numeroUnico'].'']=1; }             
		if(trim($_POST['inserir_'.$rSql['numeroUnico'].''])=="") { $_POST['inserir_'.$rSql['numeroUnico'].'']=0; } else { $_POST['inserir_'.$rSql['numeroUnico'].'']=1; }             
		if(trim($_POST['editar_'.$rSql['numeroUnico'].''])=="") { $_POST['editar_'.$rSql['numeroUnico'].'']=0; } else { $_POST['editar_'.$rSql['numeroUnico'].'']=1; }             
		if(trim($_POST['excluir_'.$rSql['numeroUnico'].''])=="") { $_POST['excluir_'.$rSql['numeroUnico'].'']=0; } else { $_POST['excluir_'.$rSql['numeroUnico'].'']=1; }             
		if(trim($_POST['publicar_'.$rSql['numeroUnico'].''])=="") { $_POST['publicar_'.$rSql['numeroUnico'].'']=0; } else { $_POST['publicar_'.$rSql['numeroUnico'].'']=1; }             
		if(trim($_POST['despublicar_'.$rSql['numeroUnico'].''])=="") { $_POST['despublicar_'.$rSql['numeroUnico'].'']=0; } else { $_POST['despublicar_'.$rSql['numeroUnico'].'']=1; }             
		if(trim($_POST['lixeira_'.$rSql['numeroUnico'].''])=="") { $_POST['lixeira_'.$rSql['numeroUnico'].'']=0; } else { $_POST['lixeira_'.$rSql['numeroUnico'].'']=1; }             
		if(trim($_POST['restaurar_'.$rSql['numeroUnico'].''])=="") { $_POST['restaurar_'.$rSql['numeroUnico'].'']=0; } else { $_POST['restaurar_'.$rSql['numeroUnico'].'']=1; }             
		if(trim($_POST['descricao_'.$rSql['numeroUnico'].''])=="") { $_POST['descricao_'.$rSql['numeroUnico'].'']=0; } else { $_POST['descricao_'.$rSql['numeroUnico'].'']=1; }             
		if(trim($_POST['seo_'.$rSql['numeroUnico'].''])=="") { $_POST['seo_'.$rSql['numeroUnico'].'']=0; } else { $_POST['seo_'.$rSql['numeroUnico'].'']=1; }             
		if(trim($_POST['config_'.$rSql['numeroUnico'].''])=="") { $_POST['config_'.$rSql['numeroUnico'].'']=0; } else { $_POST['config_'.$rSql['numeroUnico'].'']=1; }             
		if(trim($_POST['minha_config_'.$rSql['numeroUnico'].''])=="") { $_POST['minha_config_'.$rSql['numeroUnico'].'']=0; } else { $_POST['minha_config_'.$rSql['numeroUnico'].'']=1; }
	}
	
	$_POST['permissoes'] = serialize($_POST);
	$_POST['cobrancas_adicionais'] = $_SESSION['cobrancas_adicionais_'.$_SESSION['numeroUnicoGerado'].''];
	
	$_POST['valor'] = limpa_valor_dinheiro($_POST['valor']);
	$_POST['valor_promocional'] = limpa_valor_dinheiro($_POST['valor_promocional']);
	
}

$_POST['url_amigavel'] = transformaCaractere($_POST['nome']);

if(trim($_POST['acaoForm'])=="editar" || trim($_POST['acaoForm'])=="editar-continuar") {
	$update = mysql_query("
							UPDATE 
								sysgrupousuario 
							SET 
								empresa='".$rSqlEmpresa['id']."', 
								empresa_token='".$rSqlEmpresa['token']."', 
								url_amigavel='".$_POST['url_amigavel']."', 
								numeroUnico_pacotes_de_utilizacao='".$_POST['numeroUnico_pacotes_de_utilizacao']."', 
								nome='".$_POST['nome']."', 
								tipo='".$_POST['tipo']."', 
								vigencia_tipo='".$_POST['vigencia_tipo']."', 
								vigencia_qtd='".$_POST['vigencia_qtd']."', 
								plano_de_assinatura='".$_POST['plano_de_assinatura']."', 
								pessoas_qtd='".$_POST['pessoas_qtd']."', 
								destaque='".$_POST['destaque']."', 
								valor='".$_POST['valor']."', 
								valor_promocional='".$_POST['valor_promocional']."', 
								cobrancas_adicionais='".$_POST['cobrancas_adicionais']."',
								informacoes='".$_POST['informacoes']."', 
								chamada='".$_POST['chamada']."', 
								permissoes='".$_POST['permissoes']."', 
								modulo_empresa='".$_POST['modulo_empresa']."', 
								modulo_eventos='".$_POST['modulo_eventos']."', 
								modulo_pessoas='".$_POST['modulo_pessoas']."', 
								modulo_gerador_de_relatorios='".$_POST['modulo_gerador_de_relatorios']."', 
								modulo_atendimento_de_balcao='".$_POST['modulo_atendimento_de_balcao']."', 
								modulo_envio_de_notificacao='".$_POST['modulo_envio_de_notificacao']."', 
								plataformas='".$_POST['plataformas']."', 
								dataModificacao='".$data."' 
							WHERE 
								id='".$_POST['iditem']."' ");

	$qSqlSysusu = mysql_query("SELECT id FROM sysusu WHERE idsysgrupousuario='".$_POST['iditem']."' AND permissoes_personalizadas='0'");
	while($rSqlSysusu = mysql_fetch_array($qSqlSysusu)) {
		$update = mysql_query("UPDATE sysusu SET permissoes='".$_POST['permissoes']."' WHERE id='".$rSqlSysusu['id']."' ");
	}
} else {
	$insert = mysql_query("INSERT INTO sysgrupousuario (
															 idsysusu, 
															 empresa,
															 empresa_token,
															 numeroUnico,
															 numeroUnico_pacotes_de_utilizacao,
															 nome,
															 tipo,
															 vigencia_tipo, 
															 vigencia_qtd, 
															 plano_de_assinatura,
															 pessoas_qtd,
															 destaque,
															 valor,
															 valor_promocional,
															 cobrancas_adicionais,
															 informacoes,
															 chamada,
															 permissoes,
															 modulo_empresa,
															 modulo_eventos,
															 modulo_pessoas,
															 modulo_gerador_de_relatorios,
															 modulo_atendimento_de_balcao,
															 modulo_envio_de_notificacao,
															 plataformas, 
															 stat,
															 data,
															 dataModificacao
															) VALUES (
															'".$sysusu['id']."', 
															'".$rSqlEmpresa['id']."', 
															'".$rSqlEmpresa['token']."', 
															'".$_POST['numeroUnico']."', 
															'".$_POST['numeroUnico_pacotes_de_utilizacao']."', 
															'".$_POST['nome']."', 
															'".$_POST['tipo']."', 
															'".$_POST['vigencia_tipo']."', 
															'".$_POST['vigencia_qtd']."', 
															'".$_POST['plano_de_assinatura']."', 
															'".$_POST['pessoas_qtd']."', 
															'".$_POST['destaque']."', 
															'".$_POST['valor']."', 
															'".$_POST['valor_promocional']."',
															'".$_POST['cobrancas_adicionais']."', 
															'".$_POST['informacoes']."', 
															'".$_POST['chamada']."', 
															'".$_POST['permissoes']."', 
															'".$_POST['modulo_empresa']."',
															'".$_POST['modulo_eventos']."',
															'".$_POST['modulo_pessoas']."',
															'".$_POST['modulo_gerador_de_relatorios']."',
															'".$_POST['modulo_atendimento_de_balcao']."',
															'".$_POST['modulo_envio_de_notificacao']."',
															'".$_POST['plataformas']."', 
															'1',
															'".$data."',
															'".$data."'
															)");
}

$_SESSION['cobrancas_adicionais_'.$_SESSION['numeroUnicoGerado'].''] = "";
$_SESSION['numeroUnicoGerado'] = "";

if(trim($_POST['acaoForm'])=="add-continuar" || trim($_POST['acaoForm'])=="editar-continuar") {
	$urlEditar = "editar/".$_POST['numeroUnico']."/";
}
$chave_gerada = geraCodReturn()."/";
echo"<script>window.open('".$link."".$chave_gerada."".$_REQUEST['var1']."/".$_REQUEST['var2']."/".$urlEditar."','_self','')</script>";
?>

