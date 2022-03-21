<?php
header('Access-Control-Allow-Origin: *');

include("".$_SERVER['DOCUMENT_ROOT']."/include/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$numero_cartaoSet = "".preg_replace("/[^0-9]/", "",$_GET['cobranca_cartao_card_numberS'])."";

$listaBinSet = "";
$carrinhoDetalhadoArray = unserialize($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].'']);
foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
   if(trim($valueDetalhado['tipo'])=="evento") {
		$procura = "".$valueDetalhado['numeroUnico_evento']."";
		$coluna = "numeroUnico_evento";
		
		$found_key = array_search(
			$procura,
			array_filter(
				array_combine(
					array_keys($eventoArray),
					array_column(
						$eventoArray, $coluna
					)
				)
			)
		);

		if(trim($found_key)=="") {
			$rSqlItem = mysql_fetch_array(mysql_query("SELECT empresa,tickets FROM eventos WHERE numeroUnico='".$valueDetalhado['numeroUnico_evento']."'"));
	
			$ticketsArray = unserialize($rSqlItem['tickets']);
			$ticketsArray = array_sort($ticketsArray, 'ticket_data', SORT_ASC);
			foreach ($ticketsArray as $key_ticket => $value_ticket) {
				if(trim($value_ticket['numeroUnico'])==trim($valueDetalhado['numeroUnico_ticket'])) {
					if(trim($value_ticket['ticket_campanha_de_cartao'])=="" || trim($value_ticket['ticket_campanha_de_cartao'])=="undefined") { } else {
						$rSqlCampanha = mysql_fetch_array(mysql_query("SELECT bin FROM campanha_de_cartao WHERE numeroUnico='".$value_ticket['ticket_campanha_de_cartao']."' AND empresa='".$rSqlItem['empresa']."'"));
						$binSet = $rSqlCampanha['bin'];
						$binSet = str_replace(" ","",$binSet);
						$binSet = str_replace(",","||",$binSet);
						$listaBinSet = "".$listaBinSet."|".$binSet."|";
					}
				}
			}

			$eventoArray[]  = array("tag" => "eventos", 
											 "numeroUnico_evento" => "".$valueDetalhado['numeroUnico_evento']."",
											 "numeroUnico_ticket" => "".$valueDetalhado['numeroUnico_ticket']."",
											 "stat" => "1");
		}

   }
}

$campanha_passa = 0;
if(trim($listaBinSet)=="") {
	$campanha_passa = 1;
} else {
	$kws = explode("||", $listaBinSet);
	for($i = 0, $c = count($kws); $i < $c; $i++) {
		$kws[$i] = str_replace("|","",$kws[$i]);
		if(strrpos($numero_cartaoSet,"".$kws[$i]."") === false) { } else { 
			$campanha_passa++;
		}
	}
}

if($campanha_passa>0) {
	echo "SIM";
} else {
	echo "NAO";
}


?>



