<?php
header('Access-Control-Allow-Origin: *');

include("".$_SERVER['DOCUMENT_ROOT']."/include/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

if(trim($_GET['acaoS'])=="limpar") {
	$_SESSION['carrinho_cupom'] = "";
	$_SESSION['carrinho_cupom_numeroUnico'] = "";
	$_SESSION['carrinho_cupom_tipo_desconto'] = "";
	$_SESSION['carrinho_cupom_desconto'] = "";
	$_SESSION['carrinho_cupom_descontos'] = "";
} else {
	$nSql = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM cupom_de_desconto WHERE codigo='".strtoupper($_GET['codigoS'])."' AND plataforma='".$_GET['empresaS']."' AND stat='1'"));
	if($nSql[0]>0) {
		$rSqlCupom = mysql_fetch_array(mysql_query("SELECT numeroUnico,tipo_desconto,desconto,descontos FROM cupom_de_desconto WHERE codigo='".strtoupper($_GET['codigoS'])."' AND plataforma='".$_GET['empresaS']."' AND stat='1'"));
		$_SESSION['carrinho_cupom'] = "".$_GET['codigoS']."";
		$_SESSION['carrinho_cupom_numeroUnico'] = "".$rSqlCupom['numeroUnico']."";
		$_SESSION['carrinho_cupom_tipo_desconto'] = "".$rSqlCupom['tipo_desconto']."";
		$_SESSION['carrinho_cupom_desconto'] = "".$rSqlCupom['desconto']."";
		$_SESSION['carrinho_cupom_descontos'] = "".$rSqlCupom['descontos']."";
	} else {
		$_SESSION['carrinho_cupom'] = "";
		$_SESSION['carrinho_cupom_numeroUnico'] = "";
		$_SESSION['carrinho_cupom_tipo_desconto'] = "";
		$_SESSION['carrinho_cupom_desconto'] = "";
		$_SESSION['carrinho_cupom_descontos'] = "";
		echo "nao_possui";
	}
}
?>



