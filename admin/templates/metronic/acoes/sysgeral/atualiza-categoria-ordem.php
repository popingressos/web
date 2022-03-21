<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$subLocalGet = $_GET['subLocalS'];
$modGet = "".$_GET['modS']."";
?>
<?
$nordem = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."".$subLocalGet.""));
if($nordem==0) {
?>
<option value='1'>1</option>
<?
} else {
$ultimaOrdem = $nordem+1;
for ($b=1; $b<=$ultimaOrdem; $b++) {
?>
<option value='<?=$b?>' <? if($b==$ultimaOrdem) { echo "selected"; } ?>><?=$b?></option>
<? } } ?>
