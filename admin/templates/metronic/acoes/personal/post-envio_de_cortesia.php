<?
if(trim($_POST['acaoForm'])=="editar" || trim($_POST['acaoForm'])=="editar-continuar") {
	/*$update = mysql_query("
							UPDATE 
								distribuicao_de_cortesia 
							SET 
								empresa='".$rSqlEmpresa['id']."', 
								empresa_token='".$rSqlEmpresa['token']."', 
								nome='".$_POST['nome']."', 
								numeroUnico_evento='".$_POST['numeroUnico_evento']."', 
								numeroUnico_ticket='".$_POST['numeroUnico_ticket']."', 
								genero_ticket='".$_POST['genero_ticket']."', 
								qtd_u='".$_POST['qtd_u']."', 
								qtd_f='".$_POST['qtd_f']."', 
								qtd_m='".$_POST['qtd_m']."', 
								pessoas_lista='".$_SESSION['pessoas_lista_'.$_SESSION['numeroUnicoGerado'].'']."', 
								dataModificacao='".$data."' 
							WHERE 
								id='".$_POST['iditem']."' ");*/
} else {
	$rSqlEvento = mysql_fetch_array(mysql_query("SELECT plataforma,plataforma_token,empresa,empresa_token FROM eventos WHERE numeroUnico='".$_POST['numeroUnico_evento']."'"));
	$carrinhoArray = unserialize($_SESSION['pessoas_lista_'.$_SESSION['numeroUnicoGerado'].'']);
	$_POST['qtd'] = count($carrinhoArray);
	$insert = mysql_query("INSERT INTO envio_de_cortesia (
														 idsysusu, 
														 numeroUnico_comissario,
														 plataforma,
														 plataforma_token,
														 empresa,
														 empresa_token,
														 numeroUnico,
														 nome,
														 numeroUnico_evento,
														 numeroUnico_ticket,
														 genero_ticket,
														 qtd,
														 pessoas_lista,
														 tipo_de_envio,
														 processado,
														 enviado,
														 stat,
														 data,
														 dataModificacao
														) VALUES (
														'".$sysusu['id']."', 
														'".$sysusu['numeroUnico']."', 
														'".$rSqlEvento['plataforma']."', 
														'".$rSqlEvento['plataforma_token']."', 
														'".$rSqlEvento['empresa']."', 
														'".$rSqlEvento['empresa_token']."', 
														'".$_POST['numeroUnico']."', 
														'".$_POST['nome']."', 
														'".$_POST['numeroUnico_evento']."', 
														'".$_POST['numeroUnico_ticket']."', 
														'".$_POST['genero_ticket']."', 
														'".$_POST['qtd']."', 
														'".$_SESSION['pessoas_lista_'.$_SESSION['numeroUnicoGerado'].'']."', 
														'".$_POST['tipo_de_envio']."', 
														'0',
														'0',
														'1',
														'".$data."',
														'".$data."'
														)");
}

$_SESSION['pessoas_lista_'.$_SESSION['numeroUnicoGerado'].''] = "";
$_SESSION['numeroUnicoGerado'] = "";

if(trim($_POST['acaoForm'])=="add-continuar" || trim($_POST['acaoForm'])=="editar-continuar") {
	$urlEditar = "editar/".$_POST['numeroUnico']."/";
}
$chave_gerada = geraCodReturn()."/";
echo"<script>window.open('".$link."".$chave_gerada."".$_REQUEST['var1']."/".$_REQUEST['var2']."/".$urlEditar."','_self','')</script>";
?>

