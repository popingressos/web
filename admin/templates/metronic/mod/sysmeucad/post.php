<?
	$mod = $_POST['modulo'];             

	$idEditavel = $_POST['iditem'];
	$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));

	if(trim($_POST['senha'])=="") { 
		$SenhaNova = $item['senha']; 
	} else { 
		$SenhaNova = Seguranca::encriptar($_POST['senha'],Seguranca::chave("infiniti")); 
	}
	$_POST['senha'] = $SenhaNova;

	$campo_imagem = "imagem";
	if(trim($_FILES[$campo_imagem]["name"])=="") {
		$_POST[$campo_imagem] = $item[$campo_imagem];
	} else {
		upload_arquivo($mod,$campo_imagem,"");
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

	$numeroUnicoSet = $_POST['numeroUnico'];
	$abaSet = $_POST['aba'];

	update($_POST,$mod,$idEditavel);

	$rLogin=mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$idEditavel."'"));
	
	setcookie("email", "", time()-3600, '/');
	setcookie("senha", "", time()-3600, '/');

	setcookie("perfil", "administrador", time()+7200 , '/');
	setcookie("email",  $rLogin['email'], time()+7200 , '/');
	setcookie("senha", $rLogin['senha'], time()+7200 , '/');

	gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	
	echo"<script>window.open('".$link."".$chave_url."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";

?>