<?
$cartao_numeroGet = preg_replace("/[^0-9]/", "", $cartao_numeroGet);
$titular_cpfGet = preg_replace("/[^0-9]/", "", $titular_cpfGet);
$numeroUnico_pessoas_formas_de_pagamentoGet = geraCodReturn();
$insert = mysql_query("INSERT INTO pessoas_formas_de_pagamento (  numeroUnico,
																  pessoa,
																  empresa,
																  empresa_token,
																  cartao_bin,
																  cartao_numero,
																  cartao_validade,
																  cartao_cvv,
																  titular_nome,
																  titular_cpf,
																  titular_telefone,
																  stat,
																  data,
																  dataModificacao) 
																  VALUES 
																 ('".$numeroUnico_pessoas_formas_de_pagamentoGet."',
																  '".$numeroUnico_usuarioGet."',
																  '".$rSqlEmpresa['id']."',
																  '".$rSqlEmpresa['token']."',
																  '".$cartao_binGet."',
																  '".$cartao_numeroGet."',
																  '".$cartao_validadeGet."',
																  '".$cartao_cvvGet."',
																  '".$titular_nomeGet."',
																  '".$titular_cpfGet."',
																  '".$titular_telefoneGet."',
																  '1',
																  '".$data."',
																  '".$data."')");
?>