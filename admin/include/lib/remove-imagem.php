<?php
include("../inc/main.php");
include("../inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = $_GET['modS'];
$numeroUnicoGet = $_GET['numeroUnicoS'];
$campoGet = $_GET['campoS'];
$imagemGet = $_GET['imagemS'];
$idGet = $_GET['idS'];

$update = mysql_query("UPDATE ".$modGet." SET ".$campoGet."='',dataModificacao='$data' WHERE id='".$idGet."'");
?>
