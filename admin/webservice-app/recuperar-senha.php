<?
$loginValidar = preg_replace("/[^0-9]/", "", $cpfGet);
$loginValidar = $loginValidar;
if (is_numeric($loginValidar)) {
	if(strlen($loginValidar)>11) {
		$campoSet = "email";
		$loginSet = $cpfGet;
		$labelSet = "E-mail";
	} else {
		$campoSet = "documento";
		$loginSet = $loginValidar;
		$labelSet = "CPF";
	}
} else {
	$campoSet = "email";
	$loginSet = $cpfGet;
	$labelSet = "E-mail";
}

$qSql = "
			SELECT 
				*
			FROM 
				pessoas AS mod_pessoas 
			WHERE 
				mod_pessoas.stat='1' AND 
				mod_pessoas.".$campoSet."='".$loginSet."' AND 
				mod_pessoas.empresa_token='".trim($empresa_tokenGet)."'
			";
			
$rSqlUsuario = mysql_fetch_array(mysql_query($qSql));

if(trim($rSqlUsuario['id'])=="") {
	$campos["data"] = array("id" => "0", "msg" => "O ".$labelSet." informado não possui cadastro no nosso sistema!"); 
} else {

	$hash_token = geraCodReturn();
	$update = mysql_query("UPDATE pessoas SET token_recuperar_senha='".$hash_token."' WHERE id='".$rSqlUsuario['id']."'");

	$numeroUnico_usuarioSet = $rSqlUsuario['numeroUnico'];
	$indexGet = "site";
	$_POST['Local'] = "esqueceu_sua_senha";
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-email/index.php");
	
	$campos["data"] = array(
							"id" => "".$rSqlUsuario['id']."", 
							"nome" => "".$rSqlUsuario['nome']."",
							"email" => "".$rSqlUsuario['email']."",
							"documento" => "".$rSqlUsuario['documento']."",
							"senha_conf" => "".$rSqlUsuario['senha_conf'].""
							);
}

$campos["msg"] = "Usuário recuperado com sucesso";
$campos["success"] = true;

#echo "<pre>";
echo json_encode($campos);
?>