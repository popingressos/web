<?
if($_GET['duplicar']=="1") {
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/chave.php");

	$rSqlItem = mysql_fetch_array(mysql_query("SELECT * FROM ".$_GET['modS']." WHERE numeroUnico='".$_GET['numeroUnicoS']."'"));

	$insert = mysql_query("INSERT INTO gerador_de_relatorios (
																 idsysusu, 
																 plataforma, 
																 plataforma_token, 
																 empresa,
																 empresa_token,
																 mod_sistema,
																 
																 numeroUnico,
																 nome,
																 texto,
																 texto_rodape,
																 modelo_tipo,
																 local_filtro,
																 modulo_tipo,
																 status_do_filtro,
																 carrinho_notificacao,
																 produtos,
																 eventos,
																 tickets,
																 carrinho,
																 numeroUnico_itens,
																 numeroUnico_ticket,
																 numeroUnico_lote,
																 numeroUnico_comissario,
																 device,
																 periodizacao,
																 campo_intervalo,
																 campo_ordem,
																 ordenacao,
																 data_de,
																 data_ate,
																 idade_de,
																 idade_ate,
																 campos_cabecalho,
																 
																 stat,
																 data,
																 dataModificacao
																) VALUES (
																'".$sysusu['id']."', 
																'".$rSqlItem['plataforma']."', 
																'".$rSqlItem['plataforma_token']."', 
																'".$rSqlItem['empresa']."', 
																'".$rSqlItem['empresa_token']."', 
																'".$rSqlItem['mod_sistema']."', 
																 
																'".geraCodReturn()."',
																'".$rSqlItem['nome']." - Cópia', 
																'".$rSqlItem['texto']."', 
																'".$rSqlItem['texto_rodape']."', 
																'".$rSqlItem['modelo_tipo']."', 
																'".$rSqlItem['local_filtro']."', 
																'".$rSqlItem['modulo_tipo']."', 
																'".$rSqlItem['status_do_filtro']."', 
																'".$rSqlItem['carrinho_notificacao']."', 
																'".$rSqlItem['produtos']."', 
																'".$rSqlItem['eventos']."', 
																'".$rSqlItem['tickets']."', 
																'".$rSqlItem['carrinho']."', 
																'".$rSqlItem['numeroUnico_itens']."', 
																'".$rSqlItem['numeroUnico_ticket']."', 
																'".$rSqlItem['numeroUnico_lote']."', 
																'".$rSqlItem['numeroUnico_comissario']."', 
																'".$rSqlItem['device']."', 
																'".$rSqlItem['periodizacao']."', 
																'".$rSqlItem['campo_intervalo']."', 
																'".$rSqlItem['campo_ordem']."', 
																'".$rSqlItem['ordenacao']."', 
																'".$rSqlItem['data_de']."', 
																'".$rSqlItem['data_ate']."', 
																'".$rSqlItem['idade_de']."', 
																'".$rSqlItem['idade_ate']."', 
																'".$rSqlItem['campos_cabecalho']."', 
																
																'1',
																'".$data."',
																'".$data."'
																)");
} else {
	$_POST['data_de'] = normalTOdate($_POST['data_de']);
	$_POST['data_ate'] = normalTOdate($_POST['data_ate']);

	if(trim($rSqlEmpresa['plataforma'])=="0" || trim($rSqlEmpresa['plataforma'])=="") {
		$rSqlEmpresa['plataforma'] = $rSqlEmpresa['id'];
		$rSqlEmpresa['plataforma_token'] = $rSqlEmpresa['token'];
	}

	if(trim($_POST['acaoForm'])=="editar" || trim($_POST['acaoForm'])=="editar-continuar" || trim($_POST['acaoForm'])=="editar-novo") {
		$update = mysql_query("
								UPDATE 
									gerador_de_relatorios 
								SET 
									plataforma='".$rSqlEmpresa['plataforma']."', 
									plataforma_token='".$rSqlEmpresa['plataforma_token']."', 
	
									empresa='".$rSqlEmpresa['id']."', 
									empresa_token='".$rSqlEmpresa['token']."', 
	
									nome='".$_POST['nome']."', 
									texto='".$_POST['texto']."', 
									texto_rodape='".$_POST['texto_rodape']."', 
									modelo_tipo='".$_POST['modelo_tipo']."', 
									local_filtro='".$_POST['local_filtro']."', 
									modulo_tipo='".$_POST['modulo_tipo']."', 
									status_do_filtro='".$_POST['status_do_filtro']."', 
									carrinho_notificacao='".$_POST['carrinho_notificacao']."',
									produtos='".$_POST['produtos']."', 
									eventos='".$_POST['eventos']."', 
									tickets='".$_POST['tickets']."', 
									carrinho='".$_POST['carrinho']."', 
									numeroUnico_itens='".$_POST['numeroUnico_itens']."', 
									numeroUnico_ticket='".$_POST['numeroUnico_ticket']."', 
									numeroUnico_lote='".$_POST['numeroUnico_lote']."', 
									numeroUnico_comissario='".$_POST['numeroUnico_comissario']."', 
									device='".$_POST['device']."', 
									periodizacao='".$_POST['periodizacao']."', 
									campo_intervalo='".$_POST['campo_intervalo']."', 
									campo_ordem='".$_POST['campo_ordem']."', 
									ordenacao='".$_POST['ordenacao']."', 
									data_de='".$_POST['data_de']."', 
									data_ate='".$_POST['data_ate']."', 
									idade_de='".$_POST['idade_de']."', 
									idade_ate='".$_POST['idade_ate']."', 
									campos_cabecalho='".$_SESSION['campos_cabecalho_'.$_SESSION['numeroUnicoGerado'].'']."', 
	
									dataModificacao='".$data."' 
								WHERE 
									id='".$_POST['iditem']."' ");
	} else {
		$insert = mysql_query("INSERT INTO gerador_de_relatorios (
																	 idsysusu, 
																	 
																	 plataforma, 
																	 plataforma_token, 
																	 
																	 empresa,
																	 empresa_token,
																	 
																	 mod_sistema,
																	 numeroUnico,
																	 nome,
																	 texto,
																	 texto_rodape,
																	 modelo_tipo,
																	 local_filtro,
																	 modulo_tipo,
																	 status_do_filtro,
																	 carrinho_notificacao,
																	 produtos,
																	 eventos,
																	 tickets,
																	 carrinho,
																	 numeroUnico_itens,
																	 numeroUnico_ticket,
																	 numeroUnico_lote,
																	 numeroUnico_comissario,
																	 device,
																	 periodizacao,
																	 campo_intervalo,
																	 campo_ordem,
																	 ordenacao,
																	 data_de,
																	 data_ate,
																	 idade_de,
																	 idade_ate,
																	 campos_cabecalho,
																	 
																	 stat,
																	 data,
																	 dataModificacao
																	) VALUES (
																	'".$sysusu['id']."', 

																	'".$rSqlEmpresa['plataforma']."', 
																	'".$rSqlEmpresa['plataforma_token']."', 

																	'".$rSqlEmpresa['id']."', 
																	'".$rSqlEmpresa['token']."',
																	 
																	'".$_SESSION['mod2']."',
																	'".$_POST['numeroUnico']."',
																	'".$_POST['nome']."', 
																	'".$_POST['texto']."', 
																	'".$_POST['texto_rodape']."', 
																	'".$_POST['modelo_tipo']."', 
																	'".$_POST['local_filtro']."', 
																	'".$_POST['modulo_tipo']."', 
																	'".$_POST['status_do_filtro']."', 
																	'".$_POST['carrinho_notificacao']."', 
																	'".$_POST['produtos']."', 
																	'".$_POST['eventos']."', 
																	'".$_POST['tickets']."', 
																	'".$_POST['carrinho']."', 
																	'".$_POST['numeroUnico_itens']."', 
																	'".$_POST['numeroUnico_ticket']."', 
																	'".$_POST['numeroUnico_lote']."', 
																	'".$_POST['numeroUnico_comissario']."', 
																	'".$_POST['device']."', 
																	'".$_POST['periodizacao']."', 
																	'".$_POST['campo_intervalo']."', 
																	'".$_POST['campo_ordem']."', 
																	'".$_POST['ordenacao']."', 
																	'".$_POST['data_de']."', 
																	'".$_POST['data_ate']."',
																	'".$_POST['idade_de']."', 
																	'".$_POST['idade_ate']."',
																	'".$_SESSION['campos_cabecalho_'.$_SESSION['numeroUnicoGerado'].'']."', 
																	
																	'1',
																	'".$data."',
																	'".$data."'
																	)");
	}
}

$_SESSION['numeroUnicoGerado'] = "";

if(trim($_POST['acaoForm'])=="add-continuar" || trim($_POST['acaoForm'])=="editar-continuar") {
	$urlEditar = "editar/".$_POST['numeroUnico']."/";
} else if(trim($_POST['acaoForm'])=="add-novo" || trim($_POST['acaoForm'])=="editar-novo") {
	$urlEditar = "novo/";
}
$chave_gerada = geraCodReturn()."/";
echo"<script>window.open('".$link."".$chave_gerada."".$_REQUEST['var1']."/".$_REQUEST['var2']."/".$urlEditar."','_self','')</script>";
?>

