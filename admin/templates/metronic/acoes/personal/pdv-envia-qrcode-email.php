<?
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");


$rSqlUsuario = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$_GET['idS']."'"));
$rSqlEmpresa = mysql_fetch_array(mysql_query("SELECT * FROM empresa WHERE id='".$rSqlUsuario['empresa']."'"));

$rSqlSend['assunto'] = "QRCode de Login PDV";

$font_familySet = "font-family: Montserrat,Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Tahoma,sans-serif;";

$texto_emailSet  = "";
$texto_emailSet .= "".$rSqlMarketing['texto_email']."";

$htmlEmailSet  = "";
$htmlEmailSet .= "<table width=\"100%\">";

$htmlEmailSet .= "<tr>";
$htmlEmailSet .= "    <td colspan=\"2\" style=\"".$font_familySet."\">Posicione o leitor de QRCode e realize a leitura para fazer o login no seu PDV</td>";
$htmlEmailSet .= "</tr>";

$htmlEmailSet .= "<tr>";
$htmlEmailSet .= "    <td style=\"vertical-align:top;width:150px;font-weight:bold;font-size: 16px;".$font_familySet."\">Nome:</td>";
$htmlEmailSet .= "    <td style=\"vertical-align:top;font-size: 16px;".$font_familySet."\">".$rSqlUsuario['nome']."</td>";
$htmlEmailSet .= "</tr>";

$htmlEmailSet .= "<tr>";
$htmlEmailSet .= "    <td style=\"vertical-align:top;width:150px;font-weight:bold;font-size: 16px;".$font_familySet."\">E-mail:</td>";
$htmlEmailSet .= "    <td style=\"vertical-align:top;font-size: 16px;".$font_familySet."\">".$rSqlUsuario['email']."</td>";
$htmlEmailSet .= "</tr>";

$htmlEmailSet .= "<tr>";
$htmlEmailSet .= "    <td style=\"vertical-align:top;width:150px;font-weight:bold;font-size: 16px;".$font_familySet."\">QRCode:</td>";
$htmlEmailSet .= "    <td style=\"vertical-align:top;font-size: 16px;".$font_familySet."\"><img style=\"height:150px;border: 1px solid #CCC;margin-top: 10px;\" src=\"https://www.saguarocomunicacao.com.br/admin/files/qrcode/".$rSqlUsuario['cod_voucher'].".jpg\"></td>";
$htmlEmailSet .= "</tr>";

$htmlEmailSet .= "</table>";

$assuntoDoEmail_PRE = "".$rSqlSend['assunto']."";
$tituloModeloEmail_PRE = "".$rSqlSend['assunto']."";
$textoModeloEmail_PRE = "".$htmlEmailSet."";

$indexGet = "site";
$_POST['Local'] = "personalizado";
include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-email/index.php");
?>

