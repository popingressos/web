function busca_inline(chaveSend,modSend,tbLocalSend) {
	
	preloaderIn();
	
	if(trim(tbLocalSend)=="") {
		var local_set = "_construtor_template";
	} else {
		var local_set = ""+modSend+"";
	}

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/"+local_set+"/tabela-tbody.php",
		type: "GET",
		data: "limpaS=NAO&pageS=1&inicioS=0&chaveS="+chaveSend+"&modS="+modSend+"&limitS=&filtroS=&tbLocalS="+tbLocalSend+"&nomeS="+$("#nome_search").val()+"&acaoS="+$("#acao_search").val()+"&localS="+$("#local_search").val()+"&detalheS="+$("#detalhe_search").val()+"&data_deS="+$("#data_de_search").val()+"&data_ateS="+$("#data_ate_search").val()+"",
		//dataType: "html",
		success: function(data){
		
			$("#datatable_ajax_tbody").html(data);

			$("#lista_checkboxes").val("");

			preloaderOut();
			Metronic.init();

		},
	});

}
