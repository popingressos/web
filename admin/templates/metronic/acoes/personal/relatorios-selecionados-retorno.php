<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/chave.php");

if(trim($_GET['empresaS'])=="") { $filtro_empresa = ""; } else { $filtro_empresa = " WHERE empresa='".$_GET['empresaS']."'"; }

$qSqlItem = mysql_query("
						SELECT 
							numeroUnico,
							nome
							 
						FROM 
							".$_GET['localS']."
						".$filtro_empresa." 
						ORDER BY 
							nome");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
?>
<option value="|<?= $rSqlItem['numeroUnico'] ?>|"><?=$rSqlItem['nome']?></option>
<? } ?>
