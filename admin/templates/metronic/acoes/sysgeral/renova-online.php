<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

if(trim($sysusu['id'])=="0") { } else {
	$online_n = mysql_fetch_row(mysql_query(" SELECT COUNT(*) FROM sysusu_online WHERE idsysusu='".$sysusu['id']."' "));
	
	if($online_n[0]=="0") {
		mysql_query("INSERT INTO sysusu_online (desde, tempo, idsysusu) VALUES ('".$timestamp_atual."', '".$timestamp_atual."', '".$sysusu['id']."' )");
	} else {
		$update = mysql_query("UPDATE sysusu_online SET tempo='".$timestamp_atual."' WHERE idsysusu='".$sysusu['id']."' ");
	}
	
	#echo ":".$meu_ip_set.": idsysusu='".$sysusu['id']."'";
}
?>
