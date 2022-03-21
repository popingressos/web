<?
if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
	$sysusu_empresaSet = "".$sysusu['empresa']."";
} else {
	$rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT plataforma FROM empresa WHERE id='".$sysusu['empresa']."'"));
	if(trim($rSqlPlataforma['plataforma'])=="" || trim($rSqlPlataforma['plataforma'])=="0") {
		$sysusu_empresaSet = "0";
		$filtro_empresaSet = " AND mod_empresa.plataforma='".$sysusu['empresa']."' ";
	} else { 
		$sysusu_empresaSet = "".$sysusu['empresa']."";
	}
}

if(trim($sysusu_empresaSet)=="" || trim($sysusu_empresaSet)=="0") {
$listaControle['campos'][] = array("tag" => "empresa", "local" => "carrinho_notificacao_evento", "campo" => "empresa", "label" => "Empresa");
}

$listaControle['campos'][] = array("tag" => "device", "local" => "carrinho_notificacao_evento", "campo" => "device", "label" => "Local De Venda");
$listaControle['campos'][] = array("tag" => "pessoa_nome", "local" => "carrinho_notificacao_evento", "campo" => "pessoa_nome", "label" => "Nome");
$listaControle['campos'][] = array("tag" => "pessoa_email", "local" => "carrinho_notificacao_evento", "campo" => "pessoa_email", "label" => "E-mail");
$listaControle['campos'][] = array("tag" => "pessoa_telefone", "local" => "carrinho_notificacao_evento", "campo" => "pessoa_telefone", "label" => "Telefone");
$listaControle['campos'][] = array("tag" => "pessoa_documento", "local" => "carrinho_notificacao_evento", "campo" => "pessoa_documento", "label" => "Documento");
$listaControle['campos'][] = array("tag" => "pessoa_idade", "local" => "carrinho_notificacao_evento", "campo" => "pessoa_idade", "label" => "Idade");
$listaControle['campos'][] = array("tag" => "pessoa_data_de_nascimento", "local" => "carrinho_notificacao_evento", "campo" => "pessoa_data_de_nascimento", "label" => "Data de Nascimento");
$listaControle['campos'][] = array("tag" => "pessoa_genero", "local" => "carrinho_notificacao_evento", "campo" => "pessoa_genero", "label" => "Gênero");
$listaControle['campos'][] = array("tag" => "numeroUnico_cupom", "local" => "carrinho_notificacao_evento", "campo" => "numeroUnico_cupom", "label" => "Cupom Utilizado");
$listaControle['campos'][] = array("tag" => "evento_nome", "local" => "carrinho_notificacao_evento", "campo" => "evento_nome", "label" => "Nome do Evento");
$listaControle['campos'][] = array("tag" => "ingresso_nome", "local" => "carrinho_notificacao_evento", "campo" => "ingresso_nome", "label" => "Nome do Ticket");
$listaControle['campos'][] = array("tag" => "ingresso_data", "local" => "carrinho_notificacao_evento", "campo" => "ingresso_data", "label" => "Data do Ticket");
$listaControle['campos'][] = array("tag" => "qtd_parcelas", "local" => "carrinho_notificacao_evento", "campo" => "qtd_parcelas", "label" => "Qtd Parcelas");
$listaControle['campos'][] = array("tag" => "valor_subtotal", "local" => "carrinho_notificacao_evento", "campo" => "valor_subtotal", "label" => "Valor Subtotal");
$listaControle['campos'][] = array("tag" => "data_hora", "local" => "carrinho_notificacao_evento", "campo" => "data_hora", "label" => "Data e Hora Pagamento Cliente");
$listaControle['campos'][] = array("tag" => "data", "local" => "carrinho_notificacao_evento", "campo" => "data", "label" => "Data Pagamento Cliente");
$listaControle['campos'][] = array("tag" => "hora", "local" => "carrinho_notificacao_evento", "campo" => "hora", "label" => "Hora Pagamento Cliente");
$listaControle['campos'][] = array("tag" => "dataModificacao", "local" => "carrinho_notificacao_evento", "campo" => "dataModificacao", "label" => "Data e Hora Pagamento Operadora");
$listaControle['campos'][] = array("tag" => "dataModificacao_data", "local" => "carrinho_notificacao_evento", "campo" => "dataModificacao_data", "label" => "Data Pagamento Operadora");
$listaControle['campos'][] = array("tag" => "dataModificacao_hora", "local" => "carrinho_notificacao_evento", "campo" => "dataModificacao_hora", "label" => "Hora Pagamento Operadora");

if(trim($sysusu_empresaSet)=="" || trim($sysusu_empresaSet)=="0") {
	$listaControle['campos'][] = array("tag" => "valor_total", "local" => "carrinho_notificacao_evento", "campo" => "valor_total", "label" => "Valor Total");
	$listaControle['campos'][] = array("tag" => "valor_lucro", "local" => "carrinho_notificacao_evento", "campo" => "valor_lucro", "label" => "Valor Lucro");
}
$listaControle['campos'][] = array("tag" => "lote_nome", "local" => "carrinho_notificacao_evento", "campo" => "lote_nome", "label" => "Lote");
$listaControle['campos'][] = array("tag" => "confirmado", "local" => "carrinho_notificacao_evento", "campo" => "confirmado", "label" => "Confirmado (SIM ou NÃO)");
$listaControle['campos'][] = array("tag" => "dataConfirmado", "local" => "carrinho_notificacao_evento", "campo" => "dataConfirmado", "label" => "Data de Confirmado");
$listaControle['campos'][] = array("tag" => "stat", "local" => "carrinho_notificacao_evento", "campo" => "stat", "label" => "Status");

$listaControle['campos'][] = array("tag" => "empresa", "local" => "carrinho_notificacao", "campo" => "empresa", "label" => "Empresa");
$listaControle['campos'][] = array("tag" => "categorias_de_pessoas_nome", "local" => "carrinho_notificacao", "campo" => "categorias_de_pessoas_nome", "label" => "Grupo de Atendimento");
$listaControle['campos'][] = array("tag" => "categorias_de_pessoas_id_esus", "local" => "carrinho_notificacao", "campo" => "categorias_de_pessoas_id_esus", "label" => "Grupo de Atendimento ID SUS");
$listaControle['campos'][] = array("tag" => "pessoa_nome", "local" => "carrinho_notificacao", "campo" => "pessoa_nome", "label" => "Nome");
$listaControle['campos'][] = array("tag" => "pessoa_email", "local" => "carrinho_notificacao", "campo" => "pessoa_email", "label" => "E-mail");
$listaControle['campos'][] = array("tag" => "pessoa_whatsapp", "local" => "carrinho_notificacao", "campo" => "pessoa_whatsapp", "label" => "WhatsApp");
$listaControle['campos'][] = array("tag" => "pessoa_documento", "local" => "carrinho_notificacao", "campo" => "pessoa_documento", "label" => "Documento");
$listaControle['campos'][] = array("tag" => "pessoa_gestante", "local" => "carrinho_notificacao", "campo" => "pessoa_gestante", "label" => "Gestante");
$listaControle['campos'][] = array("tag" => "pessoa_puerpera", "local" => "carrinho_notificacao", "campo" => "pessoa_puerpera", "label" => "Período de parto");
$listaControle['campos'][] = array("tag" => "pessoa_comunicante_hanseniase ", "local" => "carrinho_notificacao", "campo" => "pessoa_comunicante_hanseniase", "label" => "Comunicante Hanseníase");
$listaControle['campos'][] = array("tag" => "pessoa_cns", "local" => "carrinho_notificacao", "campo" => "pessoa_cns", "label" => "CNS");
$listaControle['campos'][] = array("tag" => "pessoa_idade", "local" => "carrinho_notificacao", "campo" => "pessoa_idade", "label" => "Idade");
$listaControle['campos'][] = array("tag" => "pessoa_data_de_nascimento", "local" => "carrinho_notificacao", "campo" => "pessoa_data_de_nascimento", "label" => "Data de Nascimento");
$listaControle['campos'][] = array("tag" => "pessoa_genero", "local" => "carrinho_notificacao", "campo" => "pessoa_genero", "label" => "Gênero");
$listaControle['campos'][] = array("tag" => "pessoa_profissional_da_saude", "local" => "carrinho_notificacao", "campo" => "pessoa_profissional_da_saude", "label" => "Profissional da saúde");
$listaControle['campos'][] = array("tag" => "evento_nome", "local" => "carrinho_notificacao", "campo" => "evento_nome", "label" => "Nome do Evento");
$listaControle['campos'][] = array("tag" => "ingresso_nome", "local" => "carrinho_notificacao", "campo" => "ingresso_nome", "label" => "Nome do Ticket");
$listaControle['campos'][] = array("tag" => "data_do_evento", "local" => "carrinho_notificacao", "campo" => "data_do_evento", "label" => "Data do Evento");
$listaControle['campos'][] = array("tag" => "imunobiologico_id_esus", "local" => "carrinho_notificacao", "campo" => "imunobiologico_id_esus", "label" => "Imunobiológico ID SUS");
$listaControle['campos'][] = array("tag" => "imunobiologico_nome", "local" => "carrinho_notificacao", "campo" => "imunobiologico_nome", "label" => "Imunobiológico Nome");
$listaControle['campos'][] = array("tag" => "imunobiologico_sigla", "local" => "carrinho_notificacao", "campo" => "imunobiologico_sigla", "label" => "Imunobiológico Sigla");
$listaControle['campos'][] = array("tag" => "imunobiologico_filtro", "local" => "carrinho_notificacao", "campo" => "imunobiologico_filtro", "label" => "Imunobiológico Filtro");
$listaControle['campos'][] = array("tag" => "imunobiologico_classe", "local" => "carrinho_notificacao", "campo" => "imunobiologico_classe", "label" => "Imunobiológico Classe");
$listaControle['campos'][] = array("tag" => "estrategia_nome", "local" => "carrinho_notificacao", "campo" => "estrategia_nome", "label" => "Estratégia");
$listaControle['campos'][] = array("tag" => "vacina_nome", "local" => "carrinho_notificacao", "campo" => "vacina_nome", "label" => "Vacina");
$listaControle['campos'][] = array("tag" => "valor", "local" => "carrinho_notificacao", "campo" => "valor", "label" => "Valor");
$listaControle['campos'][] = array("tag" => "valor_subtotal", "local" => "carrinho_notificacao", "campo" => "valor_subtotal", "label" => "Valor Subtotal");
$listaControle['campos'][] = array("tag" => "valor_total", "local" => "carrinho_notificacao", "campo" => "valor_total", "label" => "Valor Total");
$listaControle['campos'][] = array("tag" => "lote_nome", "local" => "carrinho_notificacao", "campo" => "lote_nome", "label" => "Lote");
$listaControle['campos'][] = array("tag" => "lote_data_de_validade", "local" => "carrinho_notificacao", "campo" => "lote_data_de_validade", "label" => "Lote Validade");
$listaControle['campos'][] = array("tag" => "validador_nome", "local" => "carrinho_notificacao", "campo" => "validador_nome", "label" => "Validador Nome");
$listaControle['campos'][] = array("tag" => "validador_cns", "local" => "carrinho_notificacao", "campo" => "validador_cns", "label" => "Validador CNS");
$listaControle['campos'][] = array("tag" => "doses_id_esus", "local" => "carrinho_notificacao", "campo" => "doses_id_esus", "label" => "Dose ID SUS");
$listaControle['campos'][] = array("tag" => "doses_nome", "local" => "carrinho_notificacao", "campo" => "doses_nome", "label" => "Dose Nome");
$listaControle['campos'][] = array("tag" => "unidades_de_saude_nome", "local" => "carrinho_notificacao", "campo" => "unidades_de_saude_nome", "label" => "Unidade de Saúde Nome");
$listaControle['campos'][] = array("tag" => "unidades_de_saude_id_esus", "local" => "carrinho_notificacao", "campo" => "unidades_de_saude_id_esus", "label" => "Unidade de Saúde ID SUS");
$listaControle['campos'][] = array("tag" => "pessoa_encontrase_acamado", "local" => "carrinho_notificacao", "campo" => "pessoa_encontrase_acamado", "label" => "Encontra-se acamado");
$listaControle['campos'][] = array("tag" => "pessoa_contraiu_doenca", "local" => "carrinho_notificacao", "campo" => "pessoa_contraiu_doenca", "label" => "Contraiu alguma doença nos últimos 30 dias");
$listaControle['campos'][] = array("tag" => "vacinas_nome", "local" => "carrinho_notificacao", "campo" => "vacinas_nome", "label" => "Doença contraída");
$listaControle['campos'][] = array("tag" => "confirmado", "local" => "carrinho_notificacao", "campo" => "confirmado", "label" => "Confirmado (SIM ou NÃO)");
$listaControle['campos'][] = array("tag" => "dataConfirmado", "local" => "carrinho_notificacao", "campo" => "dataConfirmado", "label" => "Data de Confirmado");
$listaControle['campos'][] = array("tag" => "dataAplicacao", "local" => "carrinho_notificacao", "campo" => "dataAplicacao", "label" => "Data de Aplicação");
$listaControle['campos'][] = array("tag" => "dataCadastro", "local" => "carrinho_notificacao", "campo" => "dataCadastro", "label" => "Data de Cadastro");

$listaControle['campos'][] = array("tag" => "empresa", "local" => "pessoas", "campo" => "empresa", "label" => "Empresa");
$listaControle['campos'][] = array("tag" => "categorias_de_pessoas_nome", "local" => "pessoas", "campo" => "categorias_de_pessoas_nome", "label" => "Grupo de Atendimento");
$listaControle['campos'][] = array("tag" => "categorias_de_pessoas_id_esus", "local" => "pessoas", "campo" => "categorias_de_pessoas_id_esus", "label" => "Grupo de Atendimento ID SUS");
$listaControle['campos'][] = array("tag" => "atividades_nome", "local" => "pessoas", "campo" => "atividades_nome", "label" => "Profissão");
$listaControle['campos'][] = array("tag" => "etnias_nome", "local" => "pessoas", "campo" => "etnias_nome", "label" => "Etnia");
$listaControle['campos'][] = array("tag" => "nome", "local" => "pessoas", "campo" => "nome", "label" => "Nome");
$listaControle['campos'][] = array("tag" => "email", "local" => "pessoas", "campo" => "email", "label" => "E-mail");
$listaControle['campos'][] = array("tag" => "whatsapp", "local" => "pessoas", "campo" => "whatsapp", "label" => "WhatsApp");
$listaControle['campos'][] = array("tag" => "documento", "local" => "pessoas", "campo" => "documento", "label" => "Documento");
$listaControle['campos'][] = array("tag" => "tipos_sanguineos_nome", "local" => "pessoas", "campo" => "tipos_sanguineos_nome", "label" => "Tipo Sanguíneo");
$listaControle['campos'][] = array("tag" => "idade", "local" => "pessoas", "campo" => "idade", "label" => "Idade");
$listaControle['campos'][] = array("tag" => "cns", "local" => "pessoas", "campo" => "cns", "label" => "CNS");
$listaControle['campos'][] = array("tag" => "data_de_nascimento", "local" => "pessoas", "campo" => "data_de_nascimento", "label" => "Data de Nascimento");
$listaControle['campos'][] = array("tag" => "genero", "local" => "pessoas", "campo" => "genero", "label" => "Gênero");
$listaControle['campos'][] = array("tag" => "nome_da_mae", "local" => "pessoas", "campo" => "nome_da_mae", "label" => "Nome da Mãe");
$listaControle['campos'][] = array("tag" => "nome_do_pai", "local" => "pessoas", "campo" => "nome_do_pai", "label" => "Nome do Pai");
$listaControle['campos'][] = array("tag" => "profissional_da_saude", "local" => "pessoas", "campo" => "profissional_da_saude", "label" => "Profissional da saúde");
$listaControle['campos'][] = array("tag" => "encontrase_acamado", "local" => "pessoas", "campo" => "encontrase_acamado", "label" => "Encontra-se acamado");
$listaControle['campos'][] = array("tag" => "cep", "local" => "pessoas", "campo" => "cep", "label" => "CEP");
$listaControle['campos'][] = array("tag" => "tipos_de_logradouro_nome", "local" => "pessoas", "campo" => "tipos_de_logradouro_nome", "label" => "Tipo de Logradouro");
$listaControle['campos'][] = array("tag" => "rua", "local" => "pessoas", "campo" => "rua", "label" => "Rua");
$listaControle['campos'][] = array("tag" => "numero", "local" => "pessoas", "campo" => "numero", "label" => "Número");
$listaControle['campos'][] = array("tag" => "complemento", "local" => "pessoas", "campo" => "complemento", "label" => "Complemento");
$listaControle['campos'][] = array("tag" => "bairro", "local" => "pessoas", "campo" => "bairro", "label" => "Bairro");
$listaControle['campos'][] = array("tag" => "cidade", "local" => "pessoas", "campo" => "cidade", "label" => "Cidade");
$listaControle['campos'][] = array("tag" => "estado", "local" => "pessoas", "campo" => "estado", "label" => "Estado");

$listaControle['campos'][] = array("tag" => "empresa", "local" => "produtos", "campo" => "empresa", "label" => "Empresa");
$listaControle['campos'][] = array("tag" => "nome", "local" => "produtos", "campo" => "nome", "label" => "Nome");
$listaControle['campos'][] = array("tag" => "codigo", "local" => "produtos", "campo" => "codigo", "label" => "Código");
$listaControle['campos'][] = array("tag" => "valor", "local" => "produtos", "campo" => "valor", "label" => "Valor Original");
$listaControle['campos'][] = array("tag" => "valor_promocional", "local" => "produtos", "campo" => "valor_promocional", "label" => "Valor Promocional");

$listaControle['campos'][] = array("tag" => "empresa", "local" => "eventos", "campo" => "empresa", "label" => "Empresa");
$listaControle['campos'][] = array("tag" => "nome", "local" => "eventos", "campo" => "nome", "label" => "Nome");
$listaControle['campos'][] = array("tag" => "data_do_evento", "local" => "eventos", "campo" => "data_do_evento", "label" => "Data do Evento");
$listaControle['campos'][] = array("tag" => "valor_medio", "local" => "eventos", "campo" => "valor_medio", "label" => "Valor Ticket Médio");
$listaControle['campos'][] = array("tag" => "data_de_publicacao", "local" => "eventos", "campo" => "data_de_publicacao", "label" => "Data de Publicação");
$listaControle['campos'][] = array("tag" => "data_de_despublicacao", "local" => "eventos", "campo" => "data_de_despublicacao", "label" => "Data de Despublicação");
$listaControle['campos'][] = array("tag" => "unidades_de_saude_nome", "local" => "eventos", "campo" => "unidades_de_saude_nome", "label" => "Unidade de Saúde");
$listaControle['campos'][] = array("tag" => "estrategias_nome", "local" => "eventos", "campo" => "estrategias_nome", "label" => "Estratégia");
$listaControle['campos'][] = array("tag" => "imunobiologicos_nome", "local" => "eventos", "campo" => "imunobiologicos_nome", "label" => "Imunobiológicos");
$listaControle['campos'][] = array("tag" => "doses_nome", "local" => "eventos", "campo" => "doses_nome", "label" => "Dose");

$listaControle['campos'][] = array("tag" => "empresa", "local" => "tickets", "campo" => "empresa", "label" => "Empresa");
$listaControle['campos'][] = array("tag" => "nome_evento", "local" => "tickets", "campo" => "nome_evento", "label" => "Nome do Evento");
$listaControle['campos'][] = array("tag" => "nome_ticket", "local" => "tickets", "campo" => "nome_ticket", "label" => "Nome do Ticket");
$listaControle['campos'][] = array("tag" => "data_do_evento", "local" => "tickets", "campo" => "data_do_evento", "label" => "Data do Evento");
$listaControle['campos'][] = array("tag" => "data_do_ticket", "local" => "tickets", "campo" => "data_do_ticket", "label" => "Data do Ticket");
$listaControle['campos'][] = array("tag" => "lote_valor", "local" => "tickets", "campo" => "lote_valor", "label" => "Valor do Lote");
$listaControle['campos'][] = array("tag" => "lote_numero", "local" => "tickets", "campo" => "lote_numero", "label" => "Número do Lote");
$listaControle['campos'][] = array("tag" => "genero", "local" => "tickets", "campo" => "genero", "label" => "Gênero do Ticket");

$listaControle['campos'][] = array("tag" => "empresa", "local" => "carrinho", "campo" => "empresa", "label" => "Empresa");
$listaControle['campos'][] = array("tag" => "pessoa_nome", "local" => "carrinho", "campo" => "pessoa_nome", "label" => "Nome");
$listaControle['campos'][] = array("tag" => "pessoa_email", "local" => "carrinho", "campo" => "pessoa_email", "label" => "E-mail");
$listaControle['campos'][] = array("tag" => "pessoa_whatsapp", "local" => "carrinho", "campo" => "pessoa_whatsapp", "label" => "WhatsApp");
$listaControle['campos'][] = array("tag" => "pessoa_documento", "local" => "carrinho", "campo" => "pessoa_documento", "label" => "Documento");
$listaControle['campos'][] = array("tag" => "pessoa_data_de_nascimento", "local" => "carrinho", "campo" => "pessoa_data_de_nascimento", "label" => "Data de Nascimento");
$listaControle['campos'][] = array("tag" => "pessoa_genero", "local" => "carrinho", "campo" => "pessoa_genero", "label" => "Gênero");
$listaControle['campos'][] = array("tag" => "evento_nome", "local" => "carrinho", "campo" => "evento_nome", "label" => "Nome do Evento");
$listaControle['campos'][] = array("tag" => "ticket_nome", "local" => "carrinho", "campo" => "ticket_nome", "label" => "Nome do Ticket");
$listaControle['campos'][] = array("tag" => "lote_nome", "local" => "carrinho", "campo" => "lote_nome", "label" => "Nome do Lote");
$listaControle['campos'][] = array("tag" => "data_do_evento", "local" => "carrinho", "campo" => "data_do_evento", "label" => "Data do Evento");
$listaControle['campos'][] = array("tag" => "produto_nome", "local" => "carrinho", "campo" => "produto_nome", "label" => "Nome do Produto");
$listaControle['campos'][] = array("tag" => "valor_subtotal", "local" => "carrinho", "campo" => "valor_subtotal", "label" => "Valor Subtotal");
$listaControle['campos'][] = array("tag" => "valor_desconto", "local" => "carrinho", "campo" => "valor_desconto", "label" => "Valor Desconto");
$listaControle['campos'][] = array("tag" => "valor_total_taxas", "local" => "carrinho", "campo" => "valor_total_taxas", "label" => "Valor Total Taxas");
$listaControle['campos'][] = array("tag" => "valor_total", "local" => "carrinho", "campo" => "valor_total", "label" => "Valor Total");
$listaControle['campos'][] = array("tag" => "valor_troco", "local" => "carrinho", "campo" => "valor_troco", "label" => "Valor Troco");
$listaControle['campos'][] = array("tag" => "pago", "local" => "carrinho", "campo" => "pago", "label" => "Pago (SIM ou NÃO)");
$listaControle['campos'][] = array("tag" => "data", "local" => "carrinho", "campo" => "data", "label" => "Data Pagamento Cliente");
$listaControle['campos'][] = array("tag" => "dataModificacao", "local" => "carrinho", "campo" => "dataModificacao", "label" => "Data Pagamento Operadora");
$listaControle['campos'][] = array("tag" => "dataPago", "local" => "carrinho", "campo" => "dataPago", "label" => "Data do Pagamento");

$listaControle['campos'][] = array("tag" => "empresa", "local" => "carrinho_solicitacao", "campo" => "empresa", "label" => "Empresa");
$listaControle['campos'][] = array("tag" => "tid", "local" => "carrinho_solicitacao", "campo" => "tid", "label" => "TID");
$listaControle['campos'][] = array("tag" => "pessoa_nome", "local" => "carrinho_solicitacao", "campo" => "pessoa_nome", "label" => "Nome");
$listaControle['campos'][] = array("tag" => "pessoa_email", "local" => "carrinho_solicitacao", "campo" => "pessoa_email", "label" => "E-mail");
$listaControle['campos'][] = array("tag" => "pessoa_whatsapp", "local" => "carrinho_solicitacao", "campo" => "pessoa_whatsapp", "label" => "WhatsApp");
$listaControle['campos'][] = array("tag" => "pessoa_documento", "local" => "carrinho_solicitacao", "campo" => "pessoa_documento", "label" => "Documento");
$listaControle['campos'][] = array("tag" => "pessoa_data_de_nascimento", "local" => "carrinho_solicitacao", "campo" => "pessoa_data_de_nascimento", "label" => "Data de Nascimento");
$listaControle['campos'][] = array("tag" => "pessoa_genero", "local" => "carrinho_solicitacao", "campo" => "pessoa_genero", "label" => "Gênero");
$listaControle['campos'][] = array("tag" => "qtd_parcelas", "local" => "carrinho_solicitacao", "campo" => "qtd_parcelas", "label" => "Qtd Parcelas");
$listaControle['campos'][] = array("tag" => "valor_subtotal", "local" => "carrinho_solicitacao", "campo" => "valor_subtotal", "label" => "Valor Subtotal");
$listaControle['campos'][] = array("tag" => "valor_desconto", "local" => "carrinho_solicitacao", "campo" => "valor_desconto", "label" => "Valor Desconto");
$listaControle['campos'][] = array("tag" => "valor_total", "local" => "carrinho_solicitacao", "campo" => "valor_total", "label" => "Valor Total");
$listaControle['campos'][] = array("tag" => "pago", "local" => "carrinho_solicitacao", "campo" => "pago", "label" => "Pago (SIM ou NÃO)");
$listaControle['campos'][] = array("tag" => "data", "local" => "carrinho_solicitacao", "campo" => "data", "label" => "Data Pagamento Cliente");
$listaControle['campos'][] = array("tag" => "dataModificacao", "local" => "carrinho_solicitacao", "campo" => "dataModificacao", "label" => "Data Pagamento Operadora");
$listaControle['campos'][] = array("tag" => "dataBaixa", "local" => "carrinho_solicitacao", "campo" => "dataBaixa", "label" => "Data de Baixa");
$listaControle['campos'][] = array("tag" => "boleto_linha_digitavel_pagamento", "local" => "carrinho_solicitacao", "campo" => "boleto_linha_digitavel_pagamento", "label" => "Código de Barras");

$listaControle['campos'][] = array("tag" => "empresa", "local" => "carrinho_notificacao_comissario", "campo" => "empresa", "label" => "Empresa");
$listaControle['campos'][] = array("tag" => "tid", "local" => "carrinho_notificacao_comissario", "campo" => "tid", "label" => "TID");
$listaControle['campos'][] = array("tag" => "lista_nome", "local" => "carrinho_notificacao_comissario", "campo" => "lista_nome", "label" => "Nome da Lista");
$listaControle['campos'][] = array("tag" => "lista_data", "local" => "carrinho_notificacao_comissario", "campo" => "lista_data", "label" => "Data de Criação da Lista");
$listaControle['campos'][] = array("tag" => "sysusu_nome", "local" => "carrinho_notificacao_comissario", "campo" => "sysusu_nome", "label" => "Comissário");
$listaControle['campos'][] = array("tag" => "pessoa_nome", "local" => "carrinho_notificacao_comissario", "campo" => "pessoa_nome", "label" => "Nome");
$listaControle['campos'][] = array("tag" => "pessoa_email", "local" => "carrinho_notificacao_comissario", "campo" => "pessoa_email", "label" => "E-mail");
$listaControle['campos'][] = array("tag" => "pessoa_whatsapp", "local" => "carrinho_notificacao_comissario", "campo" => "pessoa_whatsapp", "label" => "WhatsApp");
$listaControle['campos'][] = array("tag" => "pessoa_documento", "local" => "carrinho_notificacao_comissario", "campo" => "pessoa_documento", "label" => "Documento");
$listaControle['campos'][] = array("tag" => "pessoa_data_de_nascimento", "local" => "carrinho_notificacao_comissario", "campo" => "pessoa_data_de_nascimento", "label" => "Data de Nascimento");
$listaControle['campos'][] = array("tag" => "pessoa_genero", "local" => "carrinho_notificacao_comissario", "campo" => "pessoa_genero", "label" => "Gênero");
$listaControle['campos'][] = array("tag" => "qtd_parcelas", "local" => "carrinho_notificacao_comissario", "campo" => "qtd_parcelas", "label" => "Qtd Parcelas");
$listaControle['campos'][] = array("tag" => "valor_subtotal", "local" => "carrinho_notificacao_comissario", "campo" => "valor_subtotal", "label" => "Valor Subtotal");
$listaControle['campos'][] = array("tag" => "valor_desconto", "local" => "carrinho_notificacao_comissario", "campo" => "valor_desconto", "label" => "Valor Desconto");
$listaControle['campos'][] = array("tag" => "valor_total", "local" => "carrinho_notificacao_comissario", "campo" => "valor_total", "label" => "Valor Total");
$listaControle['campos'][] = array("tag" => "pago", "local" => "carrinho_notificacao_comissario", "campo" => "pago", "label" => "Pago (SIM ou NÃO)");
$listaControle['campos'][] = array("tag" => "data", "local" => "carrinho_notificacao_comissario", "campo" => "data", "label" => "Data Pagamento Cliente");
$listaControle['campos'][] = array("tag" => "dataModificacao", "local" => "carrinho_notificacao_comissario", "campo" => "dataModificacao", "label" => "Data Pagamento Operadora");

$listaControle['campos'][] = array("tag" => "empresa", "local" => "carrinho_notificacao_pdv", "campo" => "empresa", "label" => "Empresa");
$listaControle['campos'][] = array("tag" => "tid", "local" => "carrinho_notificacao_pdv", "campo" => "tid", "label" => "TID");
$listaControle['campos'][] = array("tag" => "sysusu_nome", "local" => "carrinho_notificacao_pdv", "campo" => "sysusu_nome", "label" => "Usuário/PDV");
$listaControle['campos'][] = array("tag" => "pessoa_nome", "local" => "carrinho_notificacao_pdv", "campo" => "pessoa_nome", "label" => "Nome");
$listaControle['campos'][] = array("tag" => "pessoa_email", "local" => "carrinho_notificacao_pdv", "campo" => "pessoa_email", "label" => "E-mail");
$listaControle['campos'][] = array("tag" => "pessoa_whatsapp", "local" => "carrinho_notificacao_pdv", "campo" => "pessoa_whatsapp", "label" => "WhatsApp");
$listaControle['campos'][] = array("tag" => "pessoa_documento", "local" => "carrinho_notificacao_pdv", "campo" => "pessoa_documento", "label" => "Documento");
$listaControle['campos'][] = array("tag" => "pessoa_data_de_nascimento", "local" => "carrinho_notificacao_pdv", "campo" => "pessoa_data_de_nascimento", "label" => "Data de Nascimento");
$listaControle['campos'][] = array("tag" => "pessoa_genero", "local" => "carrinho_notificacao_pdv", "campo" => "pessoa_genero", "label" => "Gênero");
$listaControle['campos'][] = array("tag" => "evento_nome", "local" => "carrinho_notificacao_pdv", "campo" => "evento_nome", "label" => "Nome do Evento");
$listaControle['campos'][] = array("tag" => "ingresso_nome", "local" => "carrinho_notificacao_pdv", "campo" => "ingresso_nome", "label" => "Nome do Ticket");
$listaControle['campos'][] = array("tag" => "ingresso_data", "local" => "carrinho_notificacao_pdv", "campo" => "ingresso_data", "label" => "Data do Ticket");
$listaControle['campos'][] = array("tag" => "forma_de_pagamento", "local" => "carrinho_notificacao_pdv", "campo" => "forma_de_pagamento", "label" => "Forma de Pagamento");
$listaControle['campos'][] = array("tag" => "qtd_parcelas", "local" => "carrinho_notificacao_pdv", "campo" => "qtd_parcelas", "label" => "Qtd Parcelas");
$listaControle['campos'][] = array("tag" => "valor_subtotal", "local" => "carrinho_notificacao_pdv", "campo" => "valor_subtotal", "label" => "Valor Subtotal");
$listaControle['campos'][] = array("tag" => "valor_desconto", "local" => "carrinho_notificacao_pdv", "campo" => "valor_desconto", "label" => "Valor Desconto");
$listaControle['campos'][] = array("tag" => "valor_total", "local" => "carrinho_notificacao_pdv", "campo" => "valor_total", "label" => "Valor Total");
$listaControle['campos'][] = array("tag" => "pago", "local" => "carrinho_notificacao_pdv", "campo" => "pago", "label" => "Pago (SIM ou NÃO)");
$listaControle['campos'][] = array("tag" => "data", "local" => "carrinho_notificacao_pdv", "campo" => "data", "label" => "Data Pagamento Cliente");
$listaControle['campos'][] = array("tag" => "dataModificacao", "local" => "carrinho_notificacao_pdv", "campo" => "dataModificacao", "label" => "Data Pagamento Operadora");
?>