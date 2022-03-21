<?
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$numeroUnicoItem = geraCodReturn();

$carrinhoArray = unserialize($_SESSION['pdv_fp_'.$_SESSION['numeroUnicoGerado'].'']);
foreach ($carrinhoArray as $key => $value) {
	if($value['numeroUnico']==$_GET['numeroUnicoS']) { } else {
		$dataControle[] = array("tag" => "pdv_fp", 
								"numeroUnico" => "".$value['numeroUnico']."", 
								"numeroUnico_pai" => "".$value['numeroUnico_pai']."", 
								"valor" => "".$value['valor']."",
								"forma_de_pagamento" => "".$value['forma_de_pagamento']."",
								"stat" => "".$value['stat']."");
	}
}


$dataControleSerial = serialize($dataControle);
$_SESSION['pdv_fp_'.$_SESSION['numeroUnicoGerado'].''] = $dataControleSerial;
?>

