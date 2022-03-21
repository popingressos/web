<?
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$N_ja_existe = 0;

$numeroUnicoItem = geraCodReturn();

$_SESSION['pdv_lista_'.$_SESSION['numeroUnicoGerado'].''] = str_replace("N;","",$_SESSION['pdv_lista_'.$_SESSION['numeroUnicoGerado'].'']);

$rSqlEvento = mysql_fetch_array(mysql_query("SELECT tickets,nome FROM eventos WHERE numeroUnico='".$_GET['numeroUnico_eventoS']."'"));
$ticketArray = unserialize($rSqlEvento['tickets']);
$ticketArray = array_sort($ticketArray, 'ticket_data', SORT_ASC);
foreach ($ticketArray as $key => $value_ticket) {
	if(trim($value_ticket['numeroUnico'])==trim($_GET['numeroUnico_ticketS'])) {
		$_GET['imagemS'] = "".$link."files/eventos_ticket_imagem_de_capa/".$value_ticket['numeroUnico']."/".$value_ticket['ticket_imagem_de_capa']."";
		$_GET['evento_nomeS'] = $rSqlEvento['nome'];
		$_GET['ingresso_nomeS'] = $value_ticket['ticket_nome'];
	}
}

$_GET['valorS'] = limpa_valor_dinheiro($_GET['valorS']);

if(trim($_GET['documentoS'])=="SEM") {
	$_GET['documentoS'] = $_GET['documentoS'];
} else {
	$_GET['documentoS'] = preg_replace("/[^0-9]/", "", $_GET['documentoS']);
}


$ordemSet = 0;
if(trim($_SESSION['pdv_lista_'.$_SESSION['numeroUnicoGerado'].''])=="") { } else {
	$carrinhoArray = unserialize($_SESSION['pdv_lista_'.$_SESSION['numeroUnicoGerado'].'']);
	foreach ($carrinhoArray as $key => $value) {
		$ordemSet++;
		$dataControle[] = array("tag" => "pdv_lista", 
										  "ordem" => "".$value['ordem']."", 
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


$carrinhoArray = unserialize($_SESSION['pdv_lista_'.$_SESSION['numeroUnicoGerado'].'']);
$procura = "".$_GET['documentoS']."";
$coluna = "documento";

$found_key = array_search(
	$procura,
	array_filter(
		array_combine(
			array_keys($carrinhoArray),
			array_column(
				$carrinhoArray, $coluna
			)
		)
	)
);

if(trim($found_key)=="") {
	$ordemSet++;

	if(trim($_GET['cortesiaS'])=="1") {
		$_GET['valorS'] = "0.00";
	} else {
		$_GET['valorS'] = $_GET['valorS'];
	}
	
	$dataControle[] = array("tag" => "pdv_lista", 
									  "ordem" => "".$ordemSet."", 
									  "tipo" => "evento", 
									  "numeroUnico_pai" => "".$_SESSION['numeroUnicoGerado']."", 
									  "numeroUnico" => "".$numeroUnicoItem."",
									   
									  "tipo_de_envio" => "".$_GET['tipo_de_envioS']."", 

									  "numeroUnico_loja" => "", 
									  "numeroUnico_pessoa" => "", 
									  "pessoa_nome" => "".addslashes($_GET['nomeS'])."", 
									  "pessoa_documento" => "".$_GET['documentoS']."", 
									  "pessoa_email" => "".$_GET['emailS']."", 
									  "pessoa_telefone" => "".$_GET['whatsappS']."", 
									  "pessoa_genero" => "".$_GET['generoS']."", 
									  "numeroUnico_produto" => "", 
									  "numeroUnico_evento" => "".$_GET['numeroUnico_eventoS']."", 
									  "numeroUnico_ticket" => "".$_GET['numeroUnico_ticketS']."", 
									  "numeroUnico_lote" => "", 
									  "lote" => "", 
									  "evento_nome" => "".$_GET['evento_nomeS']."", 
									  "ingresso_nome" => "".$_GET['ingresso_nomeS']."", 

									  "nome" => "".$_GET['evento_nomeS']."", 
									  "imagem" => "".$_GET['imagemS']."", 
									  "cortesia" => "".$_GET['cortesiaS']."", 
									  "valor" => "".$_GET['valorS']."", 
									  "valor_desconto" => "0.00", 
									  "valor_pago" => "0.00", 
									  "valor_venda" => "".$_GET['valorS']."", 
									  "qtd" => "1", 
									  "stat" => "1");
} else {
	$N_ja_existe++;
}

if($N_ja_existe>0) {
	echo "SIM";
} else {
	echo "NAO";
}

$dataControleSerial = serialize($dataControle);
$_SESSION['pdv_lista_'.$_SESSION['numeroUnicoGerado'].''] = $dataControleSerial;
?>

