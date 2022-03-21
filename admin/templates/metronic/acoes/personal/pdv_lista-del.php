<?
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$numeroUnicoItem = geraCodReturn();

$ordemSet = 0;
$carrinhoArray = unserialize($_SESSION['pdv_lista_'.$_SESSION['numeroUnicoGerado'].'']);
foreach ($carrinhoArray as $key => $value) {
	if($value['numeroUnico']==$_GET['numeroUnicoS']) { } else {
		$ordemSet++;
		$dataControle[] = array("tag" => "pdv_lista", 
										  "ordem" => "".$ordemSet."", 
										  "tipo" => "".$value['tipo']."", 
										  "numeroUnico_pai" => "".$value['numeroUnico_pai']."", 
										  "numeroUnico" => "".$value['numeroUnico']."",
										   
										  "tipo_de_envio" => "".$value['tipo_de_envio']."", 

										  "numeroUnico_loja" => "".$value['numeroUnico_loja']."", 
										  "numeroUnico_pessoa" => "".$value['numeroUnico_pessoa']."", 
										  "pessoa_nome" => "".$value['pessoa_nome']."", 
										  "pessoa_documento" => "".preg_replace("/[^0-9]/", "",$value['pessoa_documento'])."", 
										  "pessoa_email" => "".$value['pessoa_email']."", 
										  "pessoa_telefone" => "".$value['pessoa_telefone']."", 
										  "pessoa_genero" => "".$value['pessoa_genero']."", 
										  "numeroUnico_produto" => "".$value['numeroUnico_produto']."", 
										  "numeroUnico_evento" => "".$value['numeroUnico_evento']."", 
										  "numeroUnico_ticket" => "".$value['numeroUnico_ticket']."", 
										  "numeroUnico_lote" => "".$value['numeroUnico_lote']."", 
										  "lote" => "".$value['lote']."", 
										  "evento_nome" => "".$value['evento_nome']."", 
										  "ingresso_nome" => "".$value['ingresso_nome']."", 
	
										  "nome" => "".$value['nome']."", 
										  "imagem" => "".$value['imagem']."", 
										  "cortesia" => "".$value['cortesia']."", 
										  "valor" => "".$value['valor']."", 
										  "valor_desconto" => "".$value['valor_desconto']."", 
										  "valor_pago" => "".$value['valor_pago']."", 
										  "valor_venda" => "".$value['valor_venda']."", 
										  "qtd" => "".$value['qtd']."", 
										  "stat" => "".$value['stat']."");
	}
}


$dataControleSerial = serialize($dataControle);
$_SESSION['pdv_lista_'.$_SESSION['numeroUnicoGerado'].''] = $dataControleSerial;
?>

