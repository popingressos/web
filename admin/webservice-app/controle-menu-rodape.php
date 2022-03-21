<?
$campos["data"] = array(
						"eventos" => true,
						"produtos" => false,
						"perfil" => true,
						"pedidos" => true,
						"duvidas" => false,
						"blog" => false,
						"menu" => true,
						);
$campos["msg"] = "";
$campos["success"] = true;

#echo "<pre>";
echo json_encode($campos);
?>