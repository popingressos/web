<?
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$email = anti_injection($_GET['gestor_loginS']);
$senha = anti_injection($_GET['gestor_senhaS']);
$remail = str_replace(" ","",$email);
$rsenha = str_replace(" ","",$senha);

$rSqlUsuario = mysql_fetch_array(mysql_query("SELECT numeroUnico,master FROM sysusu WHERE email='".$remail."' AND senha='".md5($senha)."' AND stat='1'"));
if(trim($rSqlUsuario['master'])=="1") {
	echo "SIM";
} else {
	echo "NAO";
}
?>

