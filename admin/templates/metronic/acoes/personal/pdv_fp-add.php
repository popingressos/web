<?
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$numeroUnicoItem = geraCodReturn();

$_SESSION['pdv_fp_'.$_SESSION['numeroUnicoGerado'].''] = str_replace("N;","",$_SESSION['pdv_fp_'.$_SESSION['numeroUnicoGerado'].'']);

$_GET['valorS'] = limpa_valor_dinheiro($_GET['valorS']);

if(trim($_SESSION['pdv_fp_'.$_SESSION['numeroUnicoGerado'].''])=="") { } else {
	$carrinhoArray = unserialize($_SESSION['pdv_fp_'.$_SESSION['numeroUnicoGerado'].'']);
	foreach ($carrinhoArray as $key => $value) {
		$dataControle[] = array("tag" => "pdv_fp", 
								"numeroUnico" => "".$value['numeroUnico']."", 
								"numeroUnico_pai" => "".$value['numeroUnico_pai']."", 
								"valor" => "".$value['valor']."",
								"forma_de_pagamento" => "".$value['forma_de_pagamento']."",
								"stat" => "".$value['stat']."");
	}
}


$dataControle[] = array("tag" => "pdv_fp", 
						"numeroUnico" => "".$numeroUnicoItem."", 
						"numeroUnico_pai" => "".$_SESSION['numeroUnicoGerado']."", 
						"valor" => "".$_GET['valorS']."",
						"forma_de_pagamento" => "".$_GET['forma_de_pagamentoS']."",
						"stat" => "1");

$dataControleSerial = serialize($dataControle);
$_SESSION['pdv_fp_'.$_SESSION['numeroUnicoGerado'].''] = $dataControleSerial;
?>

