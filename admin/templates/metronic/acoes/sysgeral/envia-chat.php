<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$guidSet = "".$_GET['idSysusu_1S']."_".$_GET['idSysusu_2S']."";

mysql_query("INSERT INTO syschat (guid, idsysusu_1, idsysusu_2, mensagem, data) VALUES ('".$guidSet."', '".$_GET['idSysusu_1S']."', '".$_GET['idSysusu_2S']."', '".$_GET['msgS']."', '".$data."' )");
?>
