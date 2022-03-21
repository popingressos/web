<?

if(trim($_POST['acaoForm'])=="editar" || trim($_POST['acaoForm'])=="editar-continuar") {

	$item = mysql_fetch_array(mysql_query("SELECT ordem FROM sysdashboard WHERE id='".$_POST['iditem']."'"));

	$qall = mysql_query("SELECT id,ordem FROM sysdashboard WHERE idsysusu='".$sysusu['id']."' ");
	while($rall = mysql_fetch_array($qall)) {
		if($rall['ordem'] > $item['ordem']) {
			$ordem = $rall['ordem'] - 1;
			$update = mysql_query("UPDATE sysdashboard SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
		}
	}

	$qall = mysql_query("SELECT id,ordem FROM sysdashboard WHERE idsysusu='".$sysusu['id']."' ");
	while($rall = mysql_fetch_array($qall)) {
		if($rall['ordem'] >= $_POST['ordem']) {
			$ordem = $rall['ordem'] + 1;
			$update = mysql_query("UPDATE sysdashboard SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
		}
	}

	$update = mysql_query("
							UPDATE 
								sysdashboard 
							SET 
								ordem='".$_POST['ordem']."', 
								nome='".$_POST['nome']."', 
								subtitulo='".$_POST['subtitulo']."', 
								icone='".$_POST['icone']."', 
								tamanho_do_bloco='".$_POST['tamanho_do_bloco']."', 
								modulo_do_bloco='".$_POST['modulo_do_bloco']."', 
								qtd='".$_POST['qtd']."', 
								ordenacao='".$_POST['ordenacao']."', 

								stat='".$_POST['stat']."', 
								dataModificacao='".$data."' 
							WHERE 
								id='".$_POST['iditem']."' ");
} else {
	$qall = mysql_query("SELECT id,ordem FROM sysdashboard WHERE idsysusu='".$sysusu['id']."' ");
	while($rall = mysql_fetch_array($qall)) {
		if( $rall['ordem'] >= $_POST['ordem']) {
			$ordem = $rall['ordem'] + 1;
			$update = mysql_query("UPDATE sysdashboard SET ordem='".$ordem."' WHERE id='".$rall['id']."'");
		}
	}

	$insert = mysql_query("INSERT INTO sysdashboard (
													 idsysusu, 
													 numeroUnico,
													 numeroUnico_usuario,
	
													 ordem, 
													 nome, 
													 subtitulo, 
													 icone, 
													 tamanho_do_bloco, 
													 modulo_do_bloco, 
													 qtd, 
													 ordenacao, 

													 stat,
													 data,
													 dataModificacao
													) VALUES (
													'".$sysusu['id']."', 
													'".$_POST['numeroUnico']."', 
													'".$sysusu['numeroUnico']."', 
	
													'".$_POST['ordem']."', 
													'".$_POST['nome']."', 
													'".$_POST['subtitulo']."', 
													'".$_POST['icone']."', 
													'".$_POST['tamanho_do_bloco']."', 
													'".$_POST['modulo_do_bloco']."', 
													'".$_POST['qtd']."', 
													'".$_POST['ordenacao']."', 

													'".$_POST['stat']."',
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

