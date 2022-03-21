<?
if(trim($_POST['acaoForm'])=="editar" || trim($_POST['acaoForm'])=="editar-continuar") {
	$update = mysql_query("
							UPDATE 
								relatorios 
							SET 
								empresa='".$rSqlEmpresa['id']."', 
								empresa_token='".$rSqlEmpresa['token']."', 
								modelo='".$_POST['modelo']."', 
								local='".$_POST['local']."', 
								selecionados='".$_POST['selecionados']."', 
								observacao='".$_POST['observacao']."', 
								gerados='".$_SESSION['gerados_'.$_SESSION['numeroUnicoGerado'].'']."', 
								dataModificacao='".$data."' 
							WHERE 
								id='".$_POST['iditem']."' ");
} else {
	$insert = mysql_query("INSERT INTO relatorios (
													 idsysusu, 
													 empresa,
													 empresa_token,
													 numeroUnico,
													 modelo,
													 local, 
													 selecionados, 
													 observacao, 
													 gerados, 
													 stat,
													 data,
													 dataModificacao
													) VALUES (
													'".$sysusu['id']."', 
													'".$rSqlEmpresa['id']."', 
													'".$rSqlEmpresa['token']."', 
													'".$_POST['numeroUnico']."', 
													'".$_POST['modelo']."', 
													'".$_POST['local']."', 
													'".$_POST['selecionados']."', 
													'".$_POST['observacao']."', 
													'".$_SESSION['gerados_'.$_SESSION['numeroUnicoGerado'].'']."', 
													'1',
													'".$data."',
													'".$data."'
													)");
}

$_SESSION['numeroUnicoGerado'] = "";

if(trim($_POST['acaoForm'])=="add-continuar" || trim($_POST['acaoForm'])=="editar-continuar") {
	$urlEditar = "editar/".$_POST['numeroUnico']."/";
}
$chave_gerada = geraCodReturn()."/";
echo"<script>window.open('".$link."".$chave_gerada."".$_REQUEST['var1']."/".$_REQUEST['var2']."/".$urlEditar."','_self','')</script>";
?>

