<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$data_pagamentoGet = date("Y-m-d");

$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";
$statGet = $_GET['statS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$modGet." WHERE id='".$idGet."'"));
$itemFluxo = mysql_fetch_array(mysql_query("SELECT * FROM sysfluxo_de_caixa WHERE numeroUnico_pai='".$item['numeroUnico']."'"));

if(trim($statGet)=="1") {
	$update = mysql_query("UPDATE ".$linguagem_set."".$modGet." SET pago='".$statGet."',valor_pago='".$item['valor']."',data_pagamento='".$data_pagamentoGet."',dataModificacao='".$data."' WHERE id='".$item['id']."'");
} else {
	$update = mysql_query("UPDATE ".$linguagem_set."".$modGet." SET pago='".$statGet."',valor_pago='',data_pagamento='',dataModificacao='".$data."' WHERE id='".$item['id']."'");
}
$updateFluxo = mysql_query("UPDATE sysfluxo_de_caixa SET pago='".$statGet."',data_pagamento='".$data_pagamentoGet."',dataModificacao='".$data."' WHERE id='".$itemFluxo['id']."'");
?>
