<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$nomeGet = $_GET['nomeS'];
$linkSiteGet = $_GET['linkSiteS'];
$linkAdminGet = $_GET['linkAdminS'];

$insert = mysql_query("INSERT INTO sysconfig_links (nome,link_site,link_admin,stat,data,dataModificacao) 
													VALUES 
												   ('".$nomeGet."','".$linkSiteGet."','".$linkAdminGet."','1','".$data."','".$data."')");

include("lista_links.php");
?>
