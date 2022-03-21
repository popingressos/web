<?
$_POST['valor'] = limpa_valor_dinheiro($_POST['valor']);

if(trim($_POST['acaoForm'])=="editar" || trim($_POST['acaoForm'])=="editar-continuar") {
	$update = mysql_query("
							UPDATE 
								venda_de_ingresso 
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
								valor='".$_POST['valor']."', 
								pessoas_lista='".$_SESSION['pessoas_lista_'.$_SESSION['numeroUnicoGerado'].'']."', 
								dataModificacao='".$data."' 
							WHERE 
								id='".$_POST['iditem']."' ");
} else {
	$insert = mysql_query("INSERT INTO venda_de_ingresso (
														 idsysusu, 
														 empresa,
														 empresa_token,
														 numeroUnico,
														 nome,
														 numeroUnico_evento,
														 numeroUnico_ticket,
														 genero_ticket,
														 qtd_u,
														 qtd_f,
														 qtd_m,
														 valor,
														 pessoas_lista,
														 stat,
														 data,
														 dataModificacao
														) VALUES (
														'".$sysusu['id']."', 
														'".$rSqlEmpresa['id']."', 
														'".$rSqlEmpresa['token']."', 
														'".$_POST['numeroUnico']."', 
														'".$_POST['nome']."', 
														'".$_POST['numeroUnico_evento']."', 
														'".$_POST['numeroUnico_ticket']."', 
														'".$_POST['genero_ticket']."', 
														'".$_POST['qtd_u']."', 
														'".$_POST['qtd_f']."', 
														'".$_POST['qtd_m']."', 
														'".$_POST['valor']."', 
														'".$_SESSION['pessoas_lista_'.$_SESSION['numeroUnicoGerado'].'']."', 
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

