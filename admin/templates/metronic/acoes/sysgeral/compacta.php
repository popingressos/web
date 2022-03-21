<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$listaIdGet = str_replace("||","','",$_GET['listaIdS']);
$listaIdGet = str_replace("|","'",$listaIdGet);
$numeroUnicoGet = $_GET["numeroUnicoS"];
$modGet = "".$_GET['modS']."";

/*
if(is_dir("../../../../files/".$modGet."")) { 
	if(is_dir("../../../../files/".$modGet."/".$numeroUnicoGet."")) { 
	} else {
		criaPastaComCaminho("files/".$modGet."/","".$numeroUnicoGet."");
	}
} else {
	if(is_dir("../../../../files/".$modGet."/".$numeroUnicoGet."/")) { 
	} else {
		criaPastaComCaminho("files/","".$modGet."");
		criaPastaComCaminho("files/".$modGet."/","".$numeroUnicoGet."");
	}
}
*/

$zip= new zipfile; //cria o objeto

$qSqlItem = mysql_query("SELECT * FROM ".$modGet."_galeria WHERE id IN (".$listaIdGet.")");
while($rSqlItem = mysql_fetch_array($qSqlItem)) {
	$file_name = $rSqlItem['imagem'];

	$arq1 = "../../../../files/".$modGet."/".$rSqlItem['numeroUnico']."/".$rSqlItem['imagem'].""; //nome do arquivo a ser compactado

	$abre1 = fopen($arq1, "r");
	$com1 = fread($abre1, filesize($arq1)); //string contendo o arquivo a ser compactado
	fclose($abre1);

	$zip->addFile($com1,"$file_name"); //adiciona um arquivo ao zip
}

$strzip=$zip->file(); //string contendo o arquivo zip

$arq="../../files/".$modGet."/".$numeroUnicoGet.".zip";

echo $arq;

$abre = fopen($arq, "w");
$salva = fwrite($abre, $strzip);
fclose($abre);
?>
