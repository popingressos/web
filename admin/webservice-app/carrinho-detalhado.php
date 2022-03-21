<?

$valor_subtotalSet = 0;
$valor_taxa_produto_empresaSet = 0;
$valor_taxa_produto_cmsSet = 0;

$carrinhoDetalhadoArray = json_decode(json_encode($carrinhoDetalhadoGet), true);
foreach ($carrinhoDetalhadoArray as $key => $value) {

	if(trim($value["tag"])=="produto") {
		$strSQL = "
					SELECT 
						mod_produtos.id,
						mod_produtos.numeroUnico,
						mod_produtos.stat,
						mod_produtos.nome,
						mod_produtos.detalhe,
						mod_produtos.imagem,
						mod_produtos.valor,
						mod_produtos.valor_promocional
					FROM 
						produtos AS mod_produtos
					WHERE 
						mod_produtos.numeroUnico='".$value["numeroUnico_produto"]."'
					";
		$rSql = mysql_fetch_array(mysql_query("".$strSQL.""));
		if($rSql['valor_promocional']>0) {
		   $rSql['valor_venda'] = $rSql['valor_promocional'];
		   $rSql['valor_promocional'] = "R$ ".number_format($rSql['valor_promocional'], 2, ',', '.')."";
		} else {
		   $rSql['valor_venda'] = $rSql['valor'];
		   $rSql['valor_promocional'] = "";
		}
		
		if($rSqlEmpresa['taxa_produto_empresa_cobra']=="1") {
		   $rSql['valor_taxa_produto_empresa'] = ($rSqlEmpresa['taxa_produto_empresa'] / 100) * $rSql['valor_venda'];
		} else {
		   $rSql['valor_taxa_produto_empresa'] = 0;
		}
		$valor_taxa_produto_empresaSet = $valor_taxa_produto_empresaSet + $rSql['valor_taxa_produto_empresa'];
	
		if($rSqlEmpresa['taxa_produto_cms_cobra']=="1") {
		   $rSql['valor_taxa_produto_cms'] = ($rSqlEmpresa['taxa_produto_cms'] / 100) * $rSql['valor_venda'];
		} else {
		   $rSql['valor_taxa_produto_cms'] = 0;
		}
		$valor_taxa_produto_cmsSet = $valor_taxa_produto_cmsSet + $rSql['valor_taxa_produto_cms'];

	   $value['preco'] = $rSql['valor_venda'];
	   $value['preco_com_cupom'] = $rSql['valor_venda'];
	   $value['valor_taxa_produto_empresa_cobra'] = $rSql['taxa_produto_empresa_cobra'];
	   $value['valor_taxa_produto_empresa'] = $rSql['valor_taxa_produto_empresa'];
	   $value['valor_taxa_produto_cms_cobra'] = $rSql['taxa_produto_cms_cobra'];
	   $value['valor_taxa_produto_cms'] = $rSql['valor_taxa_produto_cms'];

	}

	if(trim($value["tag"])=="planos_e_pacotes" || trim($value["tag"])=="circuitos" ) {

		if(trim($value["tag"])=="planos_e_pacotes") {
			$strSQL = "
						SELECT 
							mod_planos_e_pacotes.vigencia_tipo,
							mod_planos_e_pacotes.vigencia_qtd
						FROM 
							planos_e_pacotes AS mod_planos_e_pacotes
						WHERE 
							mod_planos_e_pacotes.numeroUnico='".$value["numeroUnico_planos_e_pacotes"]."'
						";
			$rSql = mysql_fetch_array(mysql_query("".$strSQL.""));
			if(trim($rSql['vigencia_tipo'])=="unidades") {
				$sufixoSomaData = "";
				$qtdSet = "";

				$insert = mysql_query("INSERT INTO pessoas_creditos (
																	 idsysusu, 
																	 empresa,
																	 empresa_token,
																	 numeroUnico,
																	 numeroUnico_planos_e_pacotes,
																	 pessoa,
																	 qtd,
																	 disponivel,
																	 stat,
																	 data,
																	 dataModificacao
																	) VALUES (
																	'0', 
																	'".$rSqlEmpresa['id']."', 
																	'".$rSqlEmpresa['token']."', 
																	'".geraCodReturn()."', 
																	'".$value['numeroUnico_planos_e_pacotes']."', 
																	'".$numeroUnico_pessoaGet."', 
																	'".$rSql['vigencia_qtd']."', 
																	'".$rSql['vigencia_qtd']."', 
																	'1',
																	'".$data."',
																	'".$data."'
																	)");
			} else if(trim($rSql['vigencia_tipo'])=="dias") {
				$sufixoSomaData = "days";
				$qtdSet = $rSql['vigencia_qtd'] * 1;
			} else if(trim($rSql['vigencia_tipo'])=="semanas") {
				$sufixoSomaData = "days";
				$qtdSet = $rSql['vigencia_qtd'] * 7;
			} else if(trim($rSql['vigencia_tipo'])=="meses") {
				$sufixoSomaData = "months";
				$qtdSet = $rSql['vigencia_qtd'] * 1;
			} else if(trim($rSql['vigencia_tipo'])=="anos") {
				$sufixoSomaData = "years";
				$qtdSet = $rSql['vigencia_qtd'] * 1;
			}
			
			$value['vigencia_tipo'] = $rSql['vigencia_tipo'];
			$value['vigencia_qtd'] = $rSql['vigencia_qtd'];
			if(trim($rSql['vigencia_tipo'])=="unidades") {
				$value['data_expiracao'] = "0000-00-00";
			} else {
				$value['data_expiracao'] = date('Y-m-d', strtotime("+".$qtdSet." ".$sufixoSomaData."", strtotime("".date("Y-m-d")."")));
			}
		} else {
			$value['vigencia_tipo'] = "";
			$value['vigencia_qtd'] = "";
			$value['data_expiracao'] = "9999-12-31";
		}

		if(trim($rSql['vigencia_tipo'])!="unidades") {
			$insert = mysql_query("INSERT INTO assinaturas (
															 idsysusu, 
															 empresa,
															 empresa_token,
															 numeroUnico,
															 pessoa,
															 tipo,
															 numeroUnico_planos_e_pacotes,
															 numeroUnico_circuitos,
															 valor,
															 vigencia_tipo,
															 vigencia_qtd,
															 observacao,
															 data_contratacao,
															 data_expiracao, 
															 stat,
															 data,
															 dataModificacao
															) VALUES (
															'0', 
															'".$rSqlEmpresa['id']."', 
															'".$rSqlEmpresa['token']."', 
															'".geraCodReturn()."', 
															'".$numeroUnico_pessoaGet."', 
															'".$value["tag"]."', 
															'".$value['numeroUnico_planos_e_pacotes']."', 
															'".$value['numeroUnico_circuitos']."', 
															'".$value['preco']."', 
															'".$value['vigencia_tipo']."', 
															'".$value['vigencia_qtd']."', 
															'', 
															'".date("Y-m-d")."', 
															'".$value['data_expiracao']."', 
															'1',
															'".$data."',
															'".$data."'
															)");
		}
	}
	
	$valor_subtotalSet = $valor_subtotalSet + $rSql['valor_venda'];

	$cod_voucherSet = geraCodCont();
	$cpfGet = preg_replace("/[^0-9]/", "", $cpfSet);
	$insert = mysql_query("INSERT INTO carrinho_detalhado (
														   empresa,
														   empresa_token,
														   
														   tag,
														   numeroUnico,
														   numeroUnico_pai,
														   numeroUnico_filial,
														   numeroUnico_pessoa, 

														   numeroUnico_produto, 
														   numeroUnico_evento, 
														   numeroUnico_ticket, 
														   numeroUnico_lote, 
														   numeroUnico_circuito, 
														   numeroUnico_planos_e_pacotes,
														   
														   cod_voucher, 
														   
														   documento,
														   nome,
														   email,
														   telefone,
	
														   valor,
														   valor_com_desconto,
														   valor_taxa_produto_empresa_cobra,
														   valor_taxa_produto_empresa,
														   valor_taxa_produto_cms_cobra,
														   valor_taxa_produto_cms,

														   pago,
														   stat,
														   data,
														   dataModificacao
														   ) 
														   VALUES 
														   (
														   '".$rSqlEmpresa['id']."', 
														   '".$rSqlEmpresa['token']."', 
														   
														   '".$value["tag"]."', 
														   '".geraCodReturn()."', 
														   '".$numeroUnico_paiGet."',
														   '".$numeroUnico_filialGet."',
														   '".$numeroUnico_pessoaGet."', 

														   '".$value["numeroUnico_produto"]."', 
														   '".$value["numeroUnico_evento"]."', 
														   '".$value["numeroUnico_ticket"]."', 
														   '".$value["numeroUnico_lote"]."', 
														   '".$value["numeroUnico_circuito"]."', 
														   '".$value["numeroUnico_planos_e_pacotes"]."', 
	
														   '".$cod_voucherSet."',
	
														   '".$cpfGet."',
														   '".$nomeSet."',
														   '".$emailSet."',
														   '".$telefoneSet."',
														   
														   '".$value['preco']."',
														   '".$value['preco_com_cupom']."',
														   '".$value['valor_taxa_produto_empresa_cobra']."',
														   '".$value['valor_taxa_produto_empresa']."',
														   '".$value['valor_taxa_produto_cms_cobra']."',
														   '".$value['valor_taxa_produto_cms']."',

														   '0',
														   '6',
														   '".$data."',
														   '".$data."'
														   )");

}
?>