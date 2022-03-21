<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/chave.php");

$numeroUnicoItem = geraCodReturn();
$_POST['numeroUnico'] = $numeroUnicoItem;

if(trim($_FILES["ticket_imagem_de_capa"]["name"])=="") { } else {
	upload_arquivo_nativo("eventos_ticket_imagem_de_capa","ticket_imagem_de_capa","");
}

if(trim($_FILES["ticket_mapa"]["name"])=="") { } else {
	upload_arquivo_nativo("eventos_ticket_mapa","ticket_mapa","");
}

if(trim($_FILES["ticket_pdf_informativo"]["name"])=="") { } else {
	upload_arquivo_nativo("eventos_ticket_pdf_informativo","ticket_pdf_informativo","");
}

$_POST['ticket_data'] = normalTOdate($_POST['ticket_data']);

$ordemN = 0;
if(trim($_SESSION['eventos_tickets_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].''])=="") { 
} else {
	$carrinhoArray = unserialize($_SESSION['eventos_tickets_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']);
	foreach ($carrinhoArray as $key => $value) {
		$dataControle[] = array("tag" => "eventos_tickets", 
								"numeroUnico" => "".$value['numeroUnico']."",
								"ticket_nome" => $value['ticket_nome'],
								"ticket_cpf_qtd" => $value['ticket_cpf_qtd'],
								"ticket_tipo" => $value['ticket_tipo'],
								"ticket_tipo_numeracao" => $value['ticket_tipo_numeracao'],
								"ticket_tipo_numeracao_tamanho" => $value['ticket_tipo_numeracao_tamanho'],
								"ticket_tipo_numeracao_de" => $value['ticket_tipo_numeracao_de'],
								"ticket_tipo_numeracao_ate" => $value['ticket_tipo_numeracao_ate'],
								"ticket_tipo_numeros_letras" => $value['ticket_tipo_numeros_letras'],
								"ticket_tipo_numeros_letras_qtd_letras" => $value['ticket_tipo_numeros_letras_qtd_letras'],
								"ticket_tipo_numeros_letras_qtd_numeros" => $value['ticket_tipo_numeros_letras_qtd_numeros'],
								"ticket_exibir_lote" => $value['ticket_exibir_lote'],
								"ticket_exibir_taxa" => $value['ticket_exibir_taxa'],
								"ticket_meia_entrada" => $value['ticket_meia_entrada'],
								"ticket_virada_de_lote" => $value['ticket_virada_de_lote'],
								"ticket_qtd_lounge" => $value['ticket_qtd_lounge'],
								"ticket_compra_autorizada" => $value['ticket_compra_autorizada'],
								"ticket_genero" => $value['ticket_genero'],
								"ticket_exigir_atribuicao" => $value['ticket_exigir_atribuicao'],
								"ticket_data" => $value['ticket_data'],
								"ticket_exibir_site" => $value['ticket_exibir_site'],
								"ticket_exibir_app" => $value['ticket_exibir_app'],
								"ticket_exibir_pdv" => $value['ticket_exibir_pdv'],
								"ticket_exibir_com" => $value['ticket_exibir_com'],
								"ticket_info" => $value['ticket_info'],
								"ticket_imagem_de_capa" => $value['ticket_imagem_de_capa'],
								"ticket_mapa" => $value['ticket_mapa'],
								"ticket_pdf_informativo" => $value['ticket_pdf_informativo'],
								"ticket_campanha_de_cartao" => $value['ticket_campanha_de_cartao'],
								"stat" => $value['stat']);
									
	}
}

if(trim($_POST['ticket_campanha_de_cartao'])=="" || trim($_POST['ticket_campanha_de_cartao'])=="undefined") {
	$_POST['ticket_campanha_de_cartao'] = "";
}

$ordemN++;
$dataControle[] = array("tag" => "eventos_tickets", 
						"numeroUnico" => "".$numeroUnicoItem."",
						"ticket_nome" => $_POST['ticket_nome'],
						"ticket_cpf_qtd" => $_POST['ticket_cpf_qtd'],
						"ticket_tipo" => $_POST['ticket_tipo'],
						"ticket_tipo_numeracao" => $_POST['ticket_tipo_numeracao'],
						"ticket_tipo_numeracao_tamanho" => $_POST['ticket_tipo_numeracao_tamanho'],
						"ticket_tipo_numeracao_de" => $_POST['ticket_tipo_numeracao_de'],
						"ticket_tipo_numeracao_ate" => $_POST['ticket_tipo_numeracao_ate'],
						"ticket_tipo_numeros_letras" => $_POST['ticket_tipo_numeros_letras'],
						"ticket_tipo_numeros_letras_qtd_letras" => $_POST['ticket_tipo_numeros_letras_qtd_letras'],
						"ticket_tipo_numeros_letras_qtd_numeros" => $_POST['ticket_tipo_numeros_letras_qtd_numeros'],
						"ticket_exibir_lote" => $_POST['ticket_exibir_lote'],
						"ticket_exibir_taxa" => $_POST['ticket_exibir_taxa'],
						"ticket_meia_entrada" => $_POST['ticket_meia_entrada'],
						"ticket_virada_de_lote" => $_POST['ticket_virada_de_lote'],
						"ticket_qtd_lounge" => $_POST['ticket_qtd_lounge'],
						"ticket_compra_autorizada" => $_POST['ticket_compra_autorizada'],
						"ticket_genero" => $_POST['ticket_genero'],
						"ticket_exigir_atribuicao" => $_POST['ticket_exigir_atribuicao'],
						"ticket_data" => $_POST['ticket_data'],
						"ticket_exibir_site" => $_POST['ticket_exibir_site'],
						"ticket_exibir_app" => $_POST['ticket_exibir_app'],
						"ticket_exibir_pdv" => $_POST['ticket_exibir_pdv'],
						"ticket_exibir_com" => $_POST['ticket_exibir_com'],
						"ticket_info" => $_POST['ticket_info'],
						"ticket_imagem_de_capa" => $_POST['ticket_imagem_de_capa'],
						"ticket_mapa" => $_POST['ticket_mapa'],
						"ticket_pdf_informativo" => $_POST['ticket_pdf_informativo'],
						"ticket_campanha_de_cartao" => $_POST['ticket_campanha_de_cartao'],
						"stat" => "1");

$dataControleSerial = serialize($dataControle);
$_SESSION['eventos_tickets_'.$_POST['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].''] = $dataControleSerial;
?>

