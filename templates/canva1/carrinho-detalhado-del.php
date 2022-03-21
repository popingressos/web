<?php
header('Access-Control-Allow-Origin: *');

include("".$_SERVER['DOCUMENT_ROOT']."/include/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

#CARRINHO AGRUPADO
$ordemN = 0;
$carrinhoArray = unserialize($_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].'']);
foreach ($carrinhoArray as $key => $value) {
	if($_POST['numeroUnico_lote']==$value['numeroUnico_lote']) { 
		$ordemN++;
		$value['qtd'] = $value['qtd'] - 1; 
		$value['ordem'] = $ordemN;
	} else {
		$value['qtd'] = $value['qtd'];
		$value['ordem'] = $value['ordem'];
	}
	if($value['qtd']=="0") { } else {
		$dataControle[] = array("tag" => "carrinho", 
								"ordem" => "".$ordemN."", 
								"tipo" => "".$value['tipo']."", 
								"empresa" => "".$value['empresa']."", 
								"empresa_token" => "".$value['empresa_token']."", 
								"numeroUnico_pai" => "".$value['numeroUnico_pai']."", 
								"numeroUnico" => "".$value['numeroUnico']."", 

								"numeroUnico_loja" => "".$value['numeroUnico_loja']."", 
								"numeroUnico_produto" => "".$value['numeroUnico_produto']."", 
								"numeroUnico_evento" => "".$value['numeroUnico_evento']."", 
								"numeroUnico_ticket" => "".$value['numeroUnico_ticket']."", 
								"numeroUnico_lote" => "".$value['numeroUnico_lote']."", 
								"lote" => "".$value['lote']."", 

								"numeroUnico_pessoa" => "".$value['numeroUnico_pessoa']."", 

								"evento_nome" => "".$value['evento_nome']."", 
								"ingresso_nome" => "".$value['ingresso_nome']."", 
								"ingresso_data" => "".$value['ingresso_data']."", 
								"ticket_genero" => "".$value['ticket_genero']."", 
								"ticket_compra_autorizada" => "".$value['ticket_compra_autorizada']."", 
								"imagem" => "".$value['imagem']."", 
								"ticket_exibir_lote" => "".$value['ticket_exibir_lote']."", 
								"ticket_exibir_taxa" => "".$value['ticket_exibir_taxa']."", 
								"ticket_exigir_atribuicao" => "".$value['ticket_exigir_atribuicao']."", 

								"valor" => "".$value['valor']."", 
								"valor_subtotal" => "".$value['valor_subtotal']."", 
								"valor_total" => "".$value['valor_total']."", 
								"valor_promocional" => "".$value['valor_promocional']."", 
								"valor_pago" => "".$value['valor_pago']."", 

								"qtd" => "".$value['qtd']."", 
								"stat" => "1");
	}
}

$dataControleSerial = serialize($dataControle);
$_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].''] = $dataControleSerial;

#CARRINHO DETALHADO
$ordemDetalhadoN = 0;
$carrinhoDetalhadoArray = unserialize($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].'']);
$carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'ordem', SORT_ASC);
foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
	if($_POST['numeroUnico']==$valueDetalhado['numeroUnico']) { } else {
		$ordemDetalhadoN++;
		$dataDetalhadoControle[] = array("tag" => "carrinho-detalhado", 
										 "ordem" => "".$ordemDetalhadoN."", 
										 "tipo" => "".$valueDetalhado['tipo']."", 
										 "empresa" => "".$valueDetalhado['empresa']."", 
										 "empresa_token" => "".$valueDetalhado['empresa_token']."", 
										 "numeroUnico_pai" => "".$valueDetalhado['numeroUnico_pai']."", 
										 "numeroUnico" => "".$valueDetalhado['numeroUnico']."", 

										 "numeroUnico_loja" => "".$valueDetalhado['numeroUnico_loja']."", 
										 "numeroUnico_produto" => "".$valueDetalhado['numeroUnico_produto']."", 
										 "numeroUnico_evento" => "".$valueDetalhado['numeroUnico_evento']."", 
										 "numeroUnico_ticket" => "".$valueDetalhado['numeroUnico_ticket']."", 
										 "numeroUnico_lote" => "".$valueDetalhado['numeroUnico_lote']."", 
										 "lote" => "".$valueDetalhado['lote']."", 

										 "numeroUnico_mapa" => "".$valueDetalhado['numeroUnico_mapa']."", 
										 "linha" => "".$valueDetalhado['linha']."", 
										 "coluna" => "".$valueDetalhado['coluna']."", 
										 "linha_real" => "".$valueDetalhado['linha_real']."", 
										 "coluna_real" => "".$valueDetalhado['coluna_real']."", 
										 "label" => "".$valueDetalhado['label']."", 
										 "ticket_label" => "".$valueDetalhado['numeroUnico_ticket']."_".$valueDetalhado['label']."", 
		
										 "numeroUnico_pessoa" => "".$valueDetalhado['numeroUnico_pessoa']."", 
										 "pessoa_nome" => "".$valueDetalhado['pessoa_nome']."", 
										 "pessoa_documento" => "".$valueDetalhado['pessoa_documento']."", 
										 "pessoa_email" => "".$valueDetalhado['pessoa_email']."", 
										 "pessoa_telefone" => "".$valueDetalhado['pessoa_telefone']."", 

										 "produto_nome" => "".$valueDetalhado['produto_nome']."", 
										 "evento_nome" => "".$valueDetalhado['evento_nome']."", 
										 "ingresso_nome" => "".$valueDetalhado['ingresso_nome']."", 
										 "ingresso_data" => "".$valueDetalhado['ingresso_data']."", 
										 "ticket_genero" => "".$valueDetalhado['ticket_genero']."", 
										 "ticket_compra_autorizada" => "".$valueDetalhado['ticket_compra_autorizada']."", 
										 "imagem" => "".$valueDetalhado['imagem']."", 
										 "ticket_exibir_lote" => "".$valueDetalhado['ticket_exibir_lote']."", 
										 "ticket_exibir_taxa" => "".$valueDetalhado['ticket_exibir_taxa']."", 
										 "ticket_exigir_atribuicao" => "".$valueDetalhado['ticket_exigir_atribuicao']."", 

										 "valor" => "".$valueDetalhado['valor']."", 
										 "valor_subtotal" => "".$valueDetalhado['valor_subtotal']."", 
										 "valor_total" => "".$valueDetalhado['valor_total']."", 
										 "valor_promocional" => "".$valueDetalhado['valor_promocional']."", 
										 "valor_pago" => "".$valueDetalhado['valor_pago']."", 
										 "valor_desconto_em_item_adquirido" => "".$valueDetalhado['valor_desconto_em_item_adquirido']."", 

										 "marcado" => "".$valueDetalhado['marcado']."", 
										 "email_enviar" => "".$valueDetalhado['email_enviar']."", 
										 "telefone_enviar" => "".$valueDetalhado['telefone_enviar']."", 
										 "qtd" => "1", 
										 "stat" => "1");
	}
}

$dataDetalhadoControleSerial = serialize($dataDetalhadoControle);
$_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].''] = $dataDetalhadoControleSerial;
?>



