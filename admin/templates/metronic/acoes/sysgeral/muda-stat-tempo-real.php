<?
# ini_set('display_errors', 1);
# ini_set('display_startup_errors', 1);
# error_reporting(E_ALL);
# error_reporting( error_reporting() & ~E_NOTICE );

include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$modGet = "".$_GET['modS']."";
$statGet = $_GET['statS'];
$conexaoGet = $_GET['conexaoS'];
$idsysusuGet = $_GET['idsysusuS'];

$rSqlMod = mysql_fetch_array(mysql_query("SELECT id,numeroUnico,stat,nome_base,id_construtor_modulo_categoria,armazenar_sys_arquivo FROM _construtor_modulo WHERE stat='1' AND nome_base='".$modGet."'"));
$row_estrutura = mysql_fetch_array(mysql_query("SELECT * FROM ".$modGet."_estrutura LIMIT 1"));


$_construtor_sysperm_function = mysql_fetch_array(mysql_query("SELECT id,idsysusu,despublicar".$conexaoGet."".$modGet.",publicar".$conexaoGet."".$modGet." FROM _construtor_sysperm WHERE idsysusu='".$idsysusuGet."'"));

$item = mysql_fetch_array(mysql_query("SELECT * FROM  ".$modGet." WHERE id='".$idGet."'"));


$qSqlCampo = mysql_query("SELECT * FROM _construtor_modulo_campo WHERE id_construtor_modulo='".$rSqlMod['id']."' AND stat='1'  ORDER BY ordem");
while($rSqlCampo = mysql_fetch_array($qSqlCampo)) {
	if(trim($row_estrutura[''.$rSqlCampo['nome_base'].'_req'])==1 && trim($item[''.$rSqlCampo['nome_base'].''])=="" ) {
		$não_ativar++;
		if(trim($row_estrutura[''.$rSqlCampo['nome_base'].'_label'])=="") {
			$label_campo = "".$rSqlCampo['nome']."";
		} else {
			$label_campo = "".$row_estrutura[''.$rSqlCampo['nome_base'].'_label']."";
		}
		$retorno_campos .= "O campo '".$label_campo."' é obrigatório e não foi preenchido <br><br>";

	}
}

if(trim($modGet)=="enquete") {
	$nSqlEnquete = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM enquete_lista_de_respostas WHERE stat='1' AND numeroUnico_pai='".$item['numeroUnico']."'"));
	if($nSqlEnquete[0]<2) {
		$não_ativar++;
	}
}

if(trim($row_estrutura['interno_galeria'])==1) {
	if(trim($row_estrutura['interno_galeria_filtro'])=="") { 
		$nSysmidia[0]="1";
	} else {
		$kws = explode(",", $row_estrutura['interno_galeria_filtro']);
		for($i = 0, $c = count($kws); $i < $c; $i++) {
			if(trim($kws[$i])=="") { } else {
				$filtroGet = $kws[$i];
				if(trim($modGet)=="analise") {
					$rItem = mysql_fetch_array(mysql_query("SELECT produto FROM ".$modGet." WHERE numeroUnico='".$item['numeroUnico']."' LIMIT 1"));
					$nSysmidia = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sysmidia WHERE numeroUnico_item_pai='".$item['numeroUnico']."' AND tipo='file' AND lixeira NOT IN ('1') AND arquivo LIKE '%".$filtroGet."%'"));
					if($nSysmidia[0]==0) {
						$rProduto = mysql_fetch_array(mysql_query("SELECT numeroUnico FROM produto WHERE id='".$rItem['produto']."' LIMIT 1"));
						$nSysmidia = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sysmidia WHERE numeroUnico_item_pai='".$rProduto['numeroUnico']."' AND tipo='file' AND lixeira NOT IN ('1') AND arquivo LIKE '%".$filtroGet."%'"));
					}
			
				} else {
					$nSysmidia = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sysmidia WHERE numeroUnico_item_pai='".$item['numeroUnico']."' AND tipo='file' AND lixeira NOT IN ('1') AND arquivo LIKE '%".$filtroGet."%'"));
				}
			}
			if($nSysmidia[0]==0) {
				$retorno_campos .= "Imagem [ ".$filtroGet." ] requisitada não inserida <br><br>";
			}
		}
	}
} else {
	$nSysmidia[0]="1";
}

if($não_ativar==0&&$nSysmidia[0]>0) {

	$update = mysql_query("UPDATE ".$linguagem_set."".$modGet." SET stat='".$statGet."',dataModificacao='".$data."' WHERE id='".$idGet."'");

	$item = mysql_fetch_array(mysql_query("SELECT * FROM  ".$modGet." WHERE id='".$idGet."'"));

	if(trim($rSqlMod['armazenar_sys_arquivo'])==1) {
	
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
	
		$url_item = monta_url_otimizada($item_sys_arquivo[0]);
		
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
	
														produto='".$item['produto']."',
														produto_recomendado='".$item['produto_recomendado']."',
														desenvolvedor='".$item['desenvolvedor']."',
														destaque='".$item['destaque']."',
	
														postar_twitter='".$twitter_post_set."',
														texto_twitter='".$message."',
	
														data_publicacao='".$item['data_publicacao']."',
														stat='".$item['stat']."'
						
														WHERE id='".$item_sys_arquivo[0]['id']."'");
		#limpa_Cache_url($url_item) ;
	
	}

	if(trim($statGet)=="1") {
	
		if(trim($_construtor_sysperm['despublicar'.$conexaoGet.''.$rSqlMod['numeroUnico'].''])==1) {
			$acoes_set .= "<a style=\"width:60px;\" href=\"javascript:void(0);\" onclick=\"muda_stat_tempo_real('".$modGet."','".$idGet."','0','".$conexaoGet."','".$idsysusuGet."');\" class=\"btn btn-xs green\" title=\"Despublicar\"> ATIVO </a>";
		} else {
			$acoes_set .= "<a style=\"width:60px;\" href=\"javascript:void(0);\" onclick=\"alert('Você não tem permissão para esta ação !');\" class=\"btn btn-xs green\" title=\"Despublicar\"> ATIVO </a>";
		}
	
	} else {
	
		if(trim($_construtor_sysperm['publicar'.$conexaoGet.''.$rSqlMod['numeroUnico'].''])==1) {
			$acoes_set .= "<a style=\"width:60px;\" href=\"javascript:void(0);\" onclick=\"muda_stat_tempo_real('".$modGet."','".$idGet."','1','".$conexaoGet."','".$idsysusuGet."');\" class=\"btn btn-xs yellow-gold\" title=\"Publicar\"> INATIVO </a>";
		} else {
			$acoes_set .= "<a style=\"width:60px;\" href=\"javascript:void(0);\" onclick=\"alert('Você não tem permissão para esta ação !');\" class=\"btn btn-xs yellow-gold\" title=\"Publicar\"> INATIVO </a>";
		}
	
	}

	if(trim($modGet)=="analise") {
		$strSQL_conteudo = "
		SELECT 
		a.id,
		a.titulo_seo,
		a.url_amigavel,
		a.texto_seo,
		a.numeroUnico,
		a.produto,
		a.produto_recomendado,
		a.nota,
		a.id_antigo,
		a.lista_secao,
		a.texto,
		a.data_publicacao,
		a.palavras_chave,
		a.nome,
		a.texto_seo,
		a.stat,
		
		p.id as produto_id,
		p.propgroupid,
		p.nome as produto_nome,
		p.numeroUnico as produto_numeroUnico,
		p.lista_secao as produto_lista_secao,
		p.palavras_chave as produto_palavras_chave,
		p.data_publicacao as produto_data_publicacao,
		p.tipo_de_item as produto_tipo_de_item,
	
		mod_tipo_de_item_categoria.nome as tipo_de_item_categoria_nome
	
		FROM analise AS a ". 
		
		"INNER JOIN produto AS p ON (p.id = a.produto) " .
	
		"LEFT JOIN tipo_de_item_categoria AS mod_tipo_de_item_categoria ON (mod_tipo_de_item_categoria.id = p.tipo_de_item ) " .
		
		"";
	
		$sql_completo = "".$strSQL_conteudo." WHERE a.id='".$idGet."'";
	} else {
		$sql_completo = "SELECT * FROM ".$modGet." WHERE id='".$idGet."'";
	}

	$conteudo = mysql_queryCache_itens("1", "".$sql_completo."", "1", "7200");

	#limpa_Cache_url($link_site) ;
	#limpa_Cache_url($link_barra);

	if(trim($modGet)=="analise") {
		$url_analise = "".$link_site."analises";
		#limpa_Cache_url($url_analise) ;
	}

	echo $acoes_set;
} else {
	echo "NAO_ATIVAR##".$retorno_campos;
}
?>
