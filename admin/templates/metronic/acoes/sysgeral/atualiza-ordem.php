<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");
$modGet = $_GET['modS'];
$catGet = $_GET['catS'];

?>

<?
$nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$modGet." WHERE id".$modGet."_categoria='".$catGet."'"));
if($nordem==0) {
?>
<option value='1'>1</option>
<?
} else {
$ultimaOrdem = $nordem + 1;
for ($b=1; $b<=$ultimaOrdem; $b++) {
?>
<option value='<?=$b?>' <? if($b==$ultimaOrdem) { echo "selected"; } ?>><?=$b?></option>
<? } } ?>
