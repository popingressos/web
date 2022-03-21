<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/chave.php");

$_GET['documentoS'] = preg_replace("/[^0-9]/", "", $_GET['documentoS']);

$nSqlUsuario = mysql_fetch_row(mysql_query(" SELECT COUNT(*) FROM pdv WHERE documento='".$_GET['documentoS']."' AND empresa='".$_GET['empresaS']."' AND numeroUnico NOT IN ('".$_GET['numeroUnicoS']."')"));
if($nSqlUsuario[0]==0) {
	$nSqlUsuario = mysql_fetch_row(mysql_query(" SELECT COUNT(*) FROM pdv WHERE email='".$_GET['emailS']."' AND empresa='".$_GET['empresaS']."' AND numeroUnico NOT IN ('".$_GET['numeroUnicoS']."')"));
	if($nSqlUsuario[0]==0) {
		echo "SIM";
	} else {
		echo"Já existe um cadastro com este mesmo E-mail informado!";
	}
} else {
	echo"Já existe um cadastro com este mesmo documento informado!";
}

?>

