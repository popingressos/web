<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$sufixoGet = $_GET['sufixoS'];

$item_produto = mysql_fetch_array(mysql_query("SELECT * FROM sysproduto WHERE id='".$idGet."'"));
$item_plano = mysql_fetch_array(mysql_query("SELECT * FROM sysplano WHERE id='".$idGet."'"));
?>
<p>
<b>SERVIÇO/PRODUTO:</b>	<?=$item_produto['nome']?><br />
<b>DATA DE CONTRATAÇÃO:</b>	<? echo date("d/m/Y"); ?>
<br /><br />
<table style="border:1px solid #000" border="0" cellpadding="0" cellpadding="0" width="100%">
    <tr style="background-color:#CCC;border-bottom:1px solid #000;">
        <td style="border-right:1px solid #000;">&nbsp;&nbsp;<b>Serviço</b></td>
        <td>&nbsp;&nbsp;<b>Descrição</b></td>
    </tr>
	<?
    $qSqlItem = mysql_query("SELECT * FROM sysplano_item WHERE numeroUnico_sysplano='".$item_plano['numeroUnico']."' ORDER BY nome");
    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
    ?>
    <tr style="border-bottom:1px solid #000;">
        <td style="border-right:1px solid #000;">&nbsp;&nbsp;<?=$rSqlItem['nome']?></td>
        <td>&nbsp;&nbsp;<?=$rSqlItem['texto']?></td>
    </tr>
    <? } ?>
</table>
</p>
