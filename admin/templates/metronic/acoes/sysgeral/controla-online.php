<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$modGet = "".$_GET['modS']."";

$tipoPerfilGet = "sem-foto";

$sql = mysql_query("DELETE FROM sysusu_online WHERE tempo<'".$timestamp_limite_chat."'");

$retorno = "";

$strSQL = "
SELECT 
mod_sysusu_online.id,
mod_sysusu_online.idsysusu,
mod_sysusu_online.desde,

mod_sysusu.nome AS mod_sysusu_nome,
mod_sysusu.numeroUnico AS mod_sysusu_numeroUnico,
mod_sysusu.imagem AS mod_sysusu_imagem

FROM sysusu_online AS mod_sysusu_online ". 

"LEFT JOIN sysusu AS mod_sysusu ON (mod_sysusu_online.idsysusu = mod_sysusu.id) " .

"";

$qSql = mysql_query("".$strSQL." WHERE idsysusu NOT IN ('0') ORDER BY mod_sysusu.nome");
while($rSql = mysql_fetch_array($qSql)) {
	if(trim($lista_ids_online)=="") {
		$lista_ids_online = "'".$rSql['idsysusu']."'";
	} else {
		$lista_ids_online = $lista_ids_online.",'".$rSql['idsysusu']."'";
	}
	

    if($tipoPerfilGet=="sem-foto") {
		$retorno .= "<li onclick=\"abre_chat('".$rSql['idsysusu']."','".$rSql['mod_sysusu_nome']."','".$sysusu['id']."');\" title=\"Online desde ".date('m/d/Y H:i', $rSql['desde'])."\" style=\"color:#FFF;margin-bottom:9px;cursor:pointer;\"> <i class=\"fa fa-circle\" style=\"color:#0C0;\"></i> ".$rSql['mod_sysusu_nome']."</li>";
	} else {
		$retorno .= "<li onclick=\"abre_chat('".$rSql['idsysusu']."','".$rSql['mod_sysusu_nome']."','".$sysusu['id']."');\" title=\"Online desde ".date('m/d/Y H:i', $rSql['desde'])."\" style=\"color:#FFF;margin-bottom:9px;cursor:pointer;\"> <i class=\"fa fa-circle\" style=\"color:#0C0;position:absolute;margin-left:-8px;margin-top:-3px;\"></i> <img alt=\"\"  style=\"max-width:32px;border:1px solid #b4b4b4;\" src=\"".$link."files/sysusu/".$rSql['mod_sysusu_numeroUnico']."/".$rSql['mod_sysusu_imagem']."\"> ".$rSql['mod_sysusu_nome']."</li>";
	}
}



$strSQL = "
SELECT 
mod_sysusu.id,
mod_sysusu.nome,
mod_sysusu.numeroUnico,
mod_sysusu.imagem

FROM sysusu AS mod_sysusu ". 

"";

if(trim($lista_ids_online)=="") { } else { $filtro_ids = "AND mod_sysusu.id NOT IN(".$lista_ids_online.")";}

$qSql = mysql_query("".$strSQL." WHERE mod_sysusu.stat='1' ".$filtro_ids." ORDER BY mod_sysusu.nome");
while($rSql = mysql_fetch_array($qSql)) {

    if($tipoPerfilGet=="sem-foto") {
		$retorno .= "<li style=\"color:#FFF;margin-bottom:9px;\"><i class=\"fa fa-circle\" style=\"color:#C00;\"></i> ".$rSql['nome']."</li>";
	} else {
		if(trim($rSql['imagem'])=="") {
			$retorno .= "<li style=\"color:#FFF;margin-bottom:9px;\"><i class=\"fa fa-circle\" style=\"color:#C00;position:absolute;margin-left:-8px;margin-top:-3px;\"></i><img alt=\"\" style=\"max-width:32px;border:1px solid #b4b4b4;\" src=\"".$link."templates/metronic/templates/img/avatars/no-photo.jpg\"> ".$rSql['nome']."</li>";
		} else {
			$retorno .= "<li style=\"color:#FFF;margin-bottom:9px;\"><i class=\"fa fa-circle\" style=\"color:#C00;position:absolute;margin-left:-8px;margin-top:-3px;\"></i><img alt=\"\" style=\"max-width:32px;border:1px solid #b4b4b4;\" src=\"".$link."files/sysusu/".$rSql['numeroUnico']."/".$rSql['imagem']."\"> ".$rSql['nome']."</li>";
		}
	}
	
}

echo $retorno;
?>
