<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$CaracteresAceitos1 = 'abcdefghijklmnopqrstuwxyz';
$max1 = strlen($CaracteresAceitos1)-1;
$cod1 = null;
for($i=0; $i < 3; $i++) {
	$cod1 .= $CaracteresAceitos1{mt_rand(0, $max1)};
}

$i=0;
$CaracteresAceitos = '0123456789';
$max = strlen($CaracteresAceitos)-1;
$cod = null;
for($i=0; $i < 5; $i++) {
	$cod .= $CaracteresAceitos{mt_rand(0, $max)};
}
echo strtoupper($cod1.$cod);
?>
