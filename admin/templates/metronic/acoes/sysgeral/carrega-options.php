<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");
$modGet = $_GET['modS'];
$numeroUnicoGet = $_GET['numeroUnicoS'];

?>
<?
$qSqlItem = mysql_query("SELECT * FROM ".$modGet." WHERE stat='1' ORDER BY ordem");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
?>
<option value="<?= $rSqlItem['id'] ?>" <? if($rSqlItem['numeroUnico']==$numeroUnicoGet) { echo "selected"; } ?>><?=$rSqlItem['nome']?></option>
<? } ?>
