<?
if(trim($numeroUnicoGet)=="") { } else {
	$update = mysql_query("
							UPDATE 
								pessoas 
							SET 
								senha='".md5($senhaGet)."', 
								senha_conf= '".$senhaGet."', 
								dataModificacao='".$data."'
							WHERE 
								numeroUnico='".$numeroUnicoGet."'
							");
}
$campos["msg"] = "Solicitação concluída com sucesso";
$campos["success"] = true;

#echo "<pre>";
if(trim($_POST['Webservice'])=="") {
	echo json_encode($campos);
}
?>