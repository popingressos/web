<?
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$_GET['cpfS'] = preg_replace("/[^0-9]/", "", $_GET['cpfS']);
if(trim($_GET['cpfS'])=="") {
	$update_cpf = "";
} else {
	$update_cpf = "pessoa_documento='".$_GET['cpfS']."',";
}

if(trim($_GET['emailS'])=="") {
	$update_email = "";
} else {
	$update_email = "pessoa_email='".$_GET['emailS']."',";
}

if(trim($_GET['cpfS'])=="" && trim($_GET['emailS'])=="") { } else {
	$update = mysql_query("
						UPDATE 
							carrinho 
						SET 
							".$update_cpf."
							".$update_email."
							dataModificacao='".$data."'
						WHERE 
							numeroUnico='".$_GET['numeroUnicoS']."'
						");
}

atualizaStatusDaCompra($_GET['numeroUnicoS'],"dataReenvio","carrinho");
?>

