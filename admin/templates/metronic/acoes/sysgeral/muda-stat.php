<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";
$statGet = $_GET['statS'];

$update = mysql_query("UPDATE ".$linguagem_set."".$modGet." SET stat='".$statGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");


$item = mysql_fetch_array(mysql_query("SELECT * FROM  ".$modGet." WHERE id='".$idGet."'"));

$item_sys_arquivo = array();
$cont = 0;
$strSQL = "SELECT * FROM sys_arquivo WHERE numeroUnico='".$item['numeroUnico']."' LIMIT 1";
$qSql = mysql_query($strSQL);
while($rSql = mysql_fetch_assoc($qSql)) {
	$id = $rSql['id'];
	$rSql['id_sys_arquivo'] = $rSql['id'];
	$item_sys_arquivo[$cont] = $rSql;
	$cont++;
}

$update = mysql_query("UPDATE sys_arquivo SET 
													titulo_seo='".$item['titulo_seo']."',
													url_amigavel='".$item['url_amigavel']."',
													texto_seo='".$item['texto_seo']."',

													nome='".$item['nome']."',
													idsysusu='".$item['idsysusu']."',
													cadastrado_por='".$item['cadastrado_por']."',
													lista_secao='".$item['lista_secao']."',
													palavras_chave='".$item['palavras_chave']."',
													nome='".$item['nome']."',
													texto='".$item['texto']."',
													exclusivo_bc='".$item['exclusivo_bc']."',
													chamada='".$item['chamada']."',

													produto='".$item['id']."',
													desenvolvedor='".$item['desenvolvedor']."',
													destaque='".$item['destaque']."',

													data_publicacao='".$item['data_publicacao']."',
													stat='".$item['stat']."'
					
													WHERE id='".$item_sys_arquivo[0]['id']."'");

$url_item = monta_url_otimizada($item_sys_arquivo[0]);

limpa_Cache_url($url_item) ;

limpa_Cache_url($link_site) ;
limpa_Cache_url($link_barra);

if(trim($modGet)=="analise") {
	$url_atual = "".$link_site."analises";
	limpa_Cache_url($url_atual) ;
}

?>
