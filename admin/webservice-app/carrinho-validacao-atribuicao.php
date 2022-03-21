<?

$cpfGet = preg_replace("/[^0-9]/", "", $cpfGet);

$achou_compraAutorizada = 0;
if(trim($compra_autorizadaGet)=="1") {
	$nSqlCompraAutorizada = mysql_fetch_row(mysql_query("SELECT 
															COUNT(*) 
														 FROM 
															compra_autorizada 
														 WHERE 
															numeroUnico_evento='".$numeroUnico_eventoGet."' AND 
															numeroUnico_ticket='".$numeroUnico_ticketGet."' AND 
															stat='1'
														 "));
	if(trim($nSqlCompraAutorizada[0])>0) {
		$strSqlCompraAutorizada = "SELECT 
									  pessoas_lista 
								   FROM 
									  compra_autorizada 
								   WHERE 
									  numeroUnico_evento='".$numeroUnico_eventoGet."' AND 
									  numeroUnico_ticket='".$numeroUnico_ticketGet."' AND 
									  stat='1'
								   ";


		$qSqlCompraAutorizada = mysql_query("".$strSqlCompraAutorizada."");
		while($rSqlCompraAutorizada = mysql_fetch_array($qSqlCompraAutorizada)) {
			$compraAutorizadaArray = unserialize($rSqlCompraAutorizada['pessoas_lista']);
			foreach ($compraAutorizadaArray as $keyCompraAutorizada => $valueCompraAutorizada) {
				$valueCompraAutorizada['documento'] = preg_replace("/[^0-9]/", "", $valueCompraAutorizada['documento']);
				if(trim($valueCompraAutorizada['documento'])==trim($cpfGet)) {
					$achou_compraAutorizada++;
				}
			}
		}
	}

} else {
	$achou_compraAutorizada++;
}

if($achou_compraAutorizada>0) {

	$nSqlIngresso = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho_notificacao WHERE pessoa_documento='".$cpfGet."' AND numeroUnico_evento='".$numeroUnico_eventoGet."' AND stat='1'"));
	if($nSqlIngresso[0]>0) {
		$retornoSet = "erro";
		$msgSet = "Este CPF informado já possui ingresso para este evento, e um CPF só pode ter um ingresso por evento!";
	} else {
		$cont_marcacao = 0;
	
		$itemsSet = json_decode(json_encode($itemsGet),true);
		foreach($itemsSet as $valueDetalhado) {
			$valueDetalhado['cpf'] = preg_replace("/[^0-9]/", "", $valueDetalhado['cpf']);
			if($cpfGet==$valueDetalhado['cpf'] && $numeroUnico_eventoGet==$valueDetalhado['numeroUnico_evento']) {
				$cont_marcacao++;
			}
		}
	
		if($cont_marcacao==0) {
			$retornoSet = "sucesso";
			$msgSet = "";
		} else {
			$retornoSet = "erro";
			$msgSet = "Você já utilizou o mesmo CPF em um dos ingressos, e um CPF só pode ter um ingresso por evento!";
		}
	}
} else {
	$retornoSet = "erro";
	$msgSet = "O CPF informado em um dos itens não possui autorização para adquirir o mesmo!";
}

$campos["data"] = array(
	"retorno" => "".$retornoSet."", 
	"msg" => "".$msgSet."", 
	"SQL" => ""
);
$campos["msg"] = "";
$campos["success"] = true;

echo json_encode($campos);
?>