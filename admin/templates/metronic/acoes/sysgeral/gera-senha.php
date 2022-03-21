<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$CaracteresAceitos1 = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789';
$max1 = strlen($CaracteresAceitos1)-1;
$cod1 = null;
for($i=0; $i < 8; $i++) {
	$cod1 .= $CaracteresAceitos1{mt_rand(0, $max1)};
}

echo $cod1;
?>
