<?
header('Access-Control-Allow-Origin: *');

include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$numeroCep = $_REQUEST['numeroCep'];
$numeroCep=str_replace(".","","".$numeroCep."");
$numeroCep=str_replace("-","","".$numeroCep."");

$endereco = mysql_fetch_array(mysql_query("SELECT * FROM cepbr_endereco WHERE cep='".$numeroCep."'"));
$bairro = mysql_fetch_array(mysql_query("SELECT * FROM cepbr_bairro WHERE id_bairro='".$endereco['id_bairro']."'"));
$cidade = mysql_fetch_array(mysql_query("SELECT * FROM cepbr_cidade WHERE id_cidade='".$endereco['id_cidade']."'"));
$estado = mysql_fetch_array(mysql_query("SELECT * FROM cepbr_estado WHERE uf='".$cidade['uf']."'"));

$endereco['logradouro'] = str_replace("'","",$endereco['logradouro']);
$endereco['logradouro'] = str_replace("&acute;","",$endereco['logradouro']); 

$bairro['bairro'] = str_replace("'","",$bairro['bairro']);
$bairro['bairro'] = str_replace("&acute;","",$bairro['bairro']); 

$cidade['cidade'] = str_replace("'","",$cidade['cidade']);
$cidade['cidade'] = str_replace("&acute;","",$cidade['cidade']); 

$var = "".$numeroCep."|".$endereco['logradouro']."|".$bairro['bairro']."|".$cidade['cidade']."|".$estado['uf']."";

echo $var;
?>