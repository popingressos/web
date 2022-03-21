<?
$loginValidar = preg_replace("/[^0-9]/", "", $emailGet);
$loginValidar = $loginValidar;
if (is_numeric($loginValidar)) {
	if(strlen($loginValidar)>11) {
		$campoSet = "documento";
		$loginSet = $loginValidar;
	} else {
		$campoSet = "documento";
		$loginSet = $loginValidar;
	}
} else {
	$campoSet = "email";
	$loginSet = $emailGet;
}

$rSqlEmpresa = mysql_fetch_array(mysql_query("
										SELECT 
											*
										FROM 
											empresa
										WHERE 
											id='".$rSqlEmpresa['id']."'
										"));

$rSqlUsuario = mysql_fetch_array(mysql_query("
										SELECT 
											*
										FROM 
											pessoas
										WHERE 
											stat='1' AND 
											".$campoSet."='".$loginSet."' AND 
											empresa='".$rSqlEmpresa['id']."'
										"));
	
$numeroUnicoGet = $rSqlUsuario['numeroUnico'];

$texto_emailSet  = "";
$texto_emailSet .= "<br>";
$texto_emailSet .= "Você solicitou um lembrete de senha, segue abaixo os seus dados e a sua informação de acesso. ";
$texto_emailSet .= "<br><br>";

$htmlEmailSet  = "";
$htmlEmailSet .= "<table width=\"100%\">";

$htmlEmailSet .= "<tr>";
$htmlEmailSet .= "    <td colspan=\"2\" style=\"font-size: 16px;".$font_familySet."\">".$texto_emailSet."</td>";
$htmlEmailSet .= "</tr>";

$htmlEmailSet .= "<tr>";
$htmlEmailSet .= "    <td style=\"width:150px;font-weight:bold;font-size: 16px;".$font_familySet."\">Nome:</td>";
$htmlEmailSet .= "    <td style=\"font-size: 16px;".$font_familySet."\">".$rSqlUsuario['nome']."</td>";
$htmlEmailSet .= "</tr>";

$htmlEmailSet .= "<tr>";
$htmlEmailSet .= "    <td style=\"width:150px;font-weight:bold;font-size: 16px;".$font_familySet."\">E-mail:</td>";
$htmlEmailSet .= "    <td style=\"font-size: 16px;".$font_familySet."\">".$rSqlUsuario['email']."</td>";
$htmlEmailSet .= "</tr>";

$htmlEmailSet .= "<tr>";
$htmlEmailSet .= "    <td style=\"width:150px;font-weight:bold;font-size: 16px;".$font_familySet."\">Senha:</td>";
$htmlEmailSet .= "    <td style=\"font-size: 16px;".$font_familySet."\">".$rSqlUsuario['senha_conf']."</td>";
$htmlEmailSet .= "</tr>";

$htmlEmailSet .= "</table>";

$assuntoDoEmail_PRE = "Lembrete de senha";
$tituloModeloEmail_PRE = "Lembrete de senha";
$textoModeloEmail_PRE = "".$htmlEmailSet."";

$numeroUnico_usuarioSet = $rSqlUsuario['numeroUnico'];
$indexGet = "site";
$_POST['Local'] = "personalizado";
include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-email/index.php");

$campos["data"] = array("retorno" => "enviado_sucesso", "msg" => "Lembrete enviado com sucesso!");
$campos["msg"] = "".$textoRetorno."";
$campos["success"] = true;
	
if(trim($_POST['Webservice'])=="") {
	#echo json_encode($campos);
}
?>