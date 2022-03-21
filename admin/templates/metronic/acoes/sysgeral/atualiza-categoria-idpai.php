<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$subLocalGet = $_GET['subLocalS'];
$modGet = "".$_GET['modS']."";
?>
<option value="0">---</option>
<?
$qSqlItem = mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."".$subLocalGet." WHERE idpai='0' ORDER BY ordem");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
?>
<option value="<?= $rSqlItem['id'] ?>"><?=$rSqlItem['nome']?></option>
<? } ?>
