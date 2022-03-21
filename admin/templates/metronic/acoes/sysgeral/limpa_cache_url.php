<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$url = $url_setada;
// só isso que vou mudar do que já mostrei no inicio

$chave = md5($url);

$memcache_obj = conecta_Memcache();
$memcache_obj->delete($chave);
?>

