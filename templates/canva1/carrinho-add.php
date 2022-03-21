<?php
header('Access-Control-Allow-Origin: *');

include("".$_SERVER['DOCUMENT_ROOT']."/include/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

#CARRINHO AGRUPADO
$numeroUnicoGet = geraCodReturn();
if(trim($_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].''])=="") { } else {
	$ordemN = 0;
	$carrinhoArray = unserialize($_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].'']);
	$carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
	foreach ($carrinhoArray as $key => $value) {
		if(trim($_POST['tipo'])=="evento-cadeira") {
			if($_POST['numeroUnico_ticket']==$value['numeroUnico_ticket']) {
				if($_POST['label']==$value['label']) {
					$ordemN++;
					if((int)$_POST['qtd']==0) {
						$value['qtd'] = (int)$_POST['qtd'];
						$value['ordem'] = $ordemN;
					} else {
						$value['qtd'] = $value['qtd'];
						$value['ordem'] = $value['ordem'];
					}
				} else {
					$value['qtd'] = $value['qtd'];
					$value['ordem'] = $value['ordem'];
				}
			} else {
				$ordemN++;
				$value['qtd'] = $value['qtd'];
				$value['ordem'] = $ordemN;
			}
		} else {
			if($_POST['numeroUnico_lote']==$value['numeroUnico_lote']) {
				$ordemN++;
				$value['qtd'] = (int)$_POST['qtd'];
				$value['ordem'] = $ordemN;
			} else {
				$value['qtd'] = $value['qtd'];
				$value['ordem'] = $value['ordem'];
			}
		}
		if($value['qtd']=="0") { } else {
			$dataControle[] = array("tag" => "carrinho", 
									"ordem" => "".$value['ordem']."", 
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

									"produto_nome" => "".$value['produto_nome']."", 
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
}

if(trim($_POST['tipo'])=="evento-cadeira") {
	$procura = "".$_POST['numeroUnico_ticket']."_".$_POST['label']."";
	$coluna = "ticket_label";
} else {
	$procura = "".$_POST['numeroUnico_lote']."";
	$coluna = "numeroUnico_lote";
}

$found_key = array_search(
	$procura,
	array_filter(
		array_combine(
			array_keys($dataControle),
			array_column(
				$dataControle, $coluna
			)
		)
	)
);

if(trim($found_key)=="") {
	if($_POST['qtd']=="0") { } else {
		$dataControle[] = array("tag" => "carrinho", 
								"ordem" => "1", 
								"tipo" => "".$_POST['tipo']."", 
								"empresa" => "".$_POST['empresa']."", 
								"empresa_token" => "".$_POST['empresa_token']."", 
								"numeroUnico_pai" => "".$_SESSION['numeroUnico_carrinho']."", 
								"numeroUnico" => "".$numeroUnicoGet."", 

								"numeroUnico_loja" => "".$_POST['numeroUnico_loja']."", 
								"numeroUnico_produto" => "".$_POST['numeroUnico_produto']."", 
								"numeroUnico_evento" => "".$_POST['numeroUnico_evento']."", 
								"numeroUnico_ticket" => "".$_POST['numeroUnico_ticket']."", 
								"numeroUnico_lote" => "".$_POST['numeroUnico_lote']."", 
								"lote" => "".$_POST['lote']."", 

								"numeroUnico_pessoa" => "".$_POST['numeroUnico_pessoa']."", 

								"produto_nome" => "".$_POST['produto_nome']."", 
								"evento_nome" => "".$_POST['evento_nome']."", 
								"ingresso_nome" => "".$_POST['ingresso_nome']."", 
								"ingresso_data" => "".$_POST['ingresso_data']."", 
								"ticket_genero" => "".$_POST['ticket_genero']."", 
								"ticket_compra_autorizada" => "".$_POST['ticket_compra_autorizada']."", 
								"imagem" => "".$_POST['imagem']."", 
								"ticket_exibir_lote" => "".$_POST['ticket_exibir_lote']."", 
								"ticket_exibir_taxa" => "".$_POST['ticket_exibir_taxa']."", 
								"ticket_exigir_atribuicao" => "".$_POST['ticket_exigir_atribuicao']."", 

								"valor" => "".$_POST['valor']."", 
								"valor_subtotal" => "".$_POST['valor_subtotal']."", 
								"valor_total" => "".$_POST['valor_total']."", 
								"valor_promocional" => "".$_POST['valor_promocional']."", 
								"valor_pago" => "".$_POST['valor_pago']."", 

								"qtd" => "".$_POST['qtd']."", 
								"stat" => "1");
	}
}

$dataControleSerial = serialize($dataControle);
$_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].''] = $dataControleSerial;

#CARRINHO DETALHADO
if(trim($_POST['acao'])=="menos") {
	$naoMarcado = 0;
	$carrinhoDetalhadoArray = unserialize($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].'']);
	$carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'ordem', SORT_ASC);
	foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
		$remover=0;
		if($_POST['numeroUnico_lote']==$valueDetalhado['numeroUnico_lote']) {
			if(trim($valueDetalhado['pessoa_nome'])=="") {
				$naoMarcado++;
			}
		}
	}

	$ordemDetalhadoN = 0;
	$contadorMenos = 0;
	$carrinhoDetalhadoArray = unserialize($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].'']);
	$carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'ordem', SORT_ASC);
	foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
		$remover=0;
		if(trim($_POST['tipo'])=="evento-cadeira") {
			if($_POST['numeroUnico_ticket']==$valueDetalhado['numeroUnico_ticket']) {
				if($_POST['label']==$valueDetalhado['label']) {
					$remover=1;
				} else {
					$remover=0;
				}
			} else {
				$remover=0;
			}
		} else {
			if($_POST['numeroUnico_lote']==$valueDetalhado['numeroUnico_lote']) {
				if($naoMarcado>0) {
					if(trim($valueDetalhado['pessoa_nome'])=="") {
						$contadorMenos++;
						if($contadorMenos==1) {
							$remover=1;
						} else {
							$remover=0;
						}
					} else {
						$remover=0;
					}
				} else {
					$contadorMenos++;
					if($contadorMenos==1) {
						$remover=1;
					} else {
						$remover=0;
					}
				}
			} else {
				$remover=0;
			}
		}
		if($remover==0) {
			if($_POST['numeroUnico_lote']==$valueDetalhado['numeroUnico_lote']) {
				$ordemDetalhadoN++;
				$valueDetalhado['ordem'] = $ordemDetalhadoN;
			} else {
				$valueDetalhado['ordem'] = $valueDetalhado['ordem'];
			}
			$dataDetalhadoControle[] = array("tag" => "carrinho-detalhado", 
											 "ordem" => "".$valueDetalhado['ordem']."", 
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
} else {
	$ordemDetalhadoN = 0;
	if(trim($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].''])=="") { } else {
		$carrinhoDetalhadoArray = unserialize($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].'']);
		$carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'ordem', SORT_ASC);
		foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
			if($_POST['numeroUnico_lote']==$valueDetalhado['numeroUnico_lote']) {
				$ordemDetalhadoN++;
				$valueDetalhado['ordem'] = $ordemDetalhadoN;
			} else {
				$valueDetalhado['ordem'] = $valueDetalhado['ordem'];
			}
			$dataDetalhadoControle[] = array("tag" => "carrinho-detalhado", 
											 "ordem" => "".$valueDetalhado['ordem']."", 
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

											 "marcado" => "".$valueDetalhado['marcado']."", 
											 "email_enviar" => "".$valueDetalhado['email_enviar']."", 
											 "telefone_enviar" => "".$valueDetalhado['telefone_enviar']."", 
											 "qtd" => "1", 
											 "stat" => "1");
		}
	}
	
	$ordemDetalhadoN++;
	$numeroUnicoDetalhadoGet = geraCodReturn();
	$dataDetalhadoControle[] = array("tag" => "carrinho-detalhado", 
									 "ordem" => "".$ordemDetalhadoN."", 
									 "tipo" => "".$_POST['tipo']."", 
									 "empresa" => "".$_POST['empresa']."", 
									 "empresa_token" => "".$_POST['empresa_token']."", 
									 "numeroUnico_pai" => "".$_SESSION['numeroUnico_carrinho']."", 
									 "numeroUnico" => "".$numeroUnicoDetalhadoGet."", 

									 "numeroUnico_loja" => "".$_POST['numeroUnico_loja']."", 
									 "numeroUnico_produto" => "".$_POST['numeroUnico_produto']."", 
									 "numeroUnico_evento" => "".$_POST['numeroUnico_evento']."", 
									 "numeroUnico_ticket" => "".$_POST['numeroUnico_ticket']."", 
									 "numeroUnico_lote" => "".$_POST['numeroUnico_lote']."", 
									 "lote" => "".$_POST['lote']."", 

									 "numeroUnico_pessoa" => "", 
									 "pessoa_nome" => "", 
									 "pessoa_documento" => "", 
									 "pessoa_email" => "", 
									 "pessoa_telefone" => "", 

									 "produto_nome" => "".$_POST['produto_nome']."", 
									 "evento_nome" => "".$_POST['evento_nome']."", 
									 "ingresso_nome" => "".$_POST['ingresso_nome']."", 
									 "ingresso_data" => "".$_POST['ingresso_data']."", 
									 "ticket_genero" => "".$_POST['ticket_genero']."", 
									 "ticket_compra_autorizada" => "".$_POST['ticket_compra_autorizada']."", 
									 "imagem" => "".$_POST['imagem']."", 
									 "ticket_exibir_lote" => "".$_POST['ticket_exibir_lote']."", 
									 "ticket_exibir_taxa" => "".$_POST['ticket_exibir_taxa']."", 
									 "ticket_exigir_atribuicao" => "".$_POST['ticket_exigir_atribuicao']."", 

									 "valor" => "".$_POST['valor']."", 
									 "valor_subtotal" => "".$_POST['valor_subtotal']."", 
									 "valor_total" => "".$_POST['valor_total']."", 
									 "valor_promocional" => "".$_POST['valor_promocional']."", 
									 "valor_pago" => "".$_POST['valor_pago']."", 

									 "marcado" => "0", 
									 "email_enviar" => "0", 
									 "telefone_enviar" => "0", 
									 "qtd" => "1", 
									 "stat" => "1");
}

$dataDetalhadoControleSerial = serialize($dataDetalhadoControle);
$_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].''] = $dataDetalhadoControleSerial;
?>



