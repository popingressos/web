function submitarSysgrupousuario(e) {
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;

	if (keycode == 13) {
		filtra_itens();
		return false;
	} else { 
		return true;
	}
}

function filtra_itens() {
	var contador = 0;
	var contador_busca = 0;
	var busca = [];
	$('.campo_busca').each(function() {
		contador++;
		var atributo_id = $(this).attr("id");
		var atributo_pesquisa = $(this).attr("pesquisa");
		var atributo_bd_externo = $(this).attr("bd_externo");
		var campo_nome = atributo_id.replace("busca_", "");
		if($.trim($("#"+$(this).attr("id")+"").val())!="") {
			contador_busca++;
		}

		busca.push({ nome:campo_nome, valor:$("#"+atributo_id+"").val(), pesquisa:atributo_pesquisa, bd_externo:atributo_bd_externo });

		if($('.campo_busca').length==contador) {
			if(contador_busca==0) {
				alert("Você deve preencher ou selecionar pelo menos 1 campo de busca.");
			} else {
				var buscaString = JSON.stringify(busca);
				$.ajax({
					url:  ""+linkAdminAcoes+"acoes/sysgrupousuario/filtra-itens.php",
					type: "GET",
					data: "busca="+buscaString+"",
					//dataType: "html",
					success: function(data){
						var url_atual = window.location.href;
						
						var n = url_atual.indexOf("pagina/");
						var n2 = url_atual.lastIndexOf("/");
						var resto = parseInt(n2) - (parseInt(n2) - parseInt(n));
						var res = url_atual.substr(0, resto);
					
						window.history.pushState("object or string", "Title", ""+res+"");
						location.reload();
					},
				});
			}
		}
	});
}

function filtra_limpa() {
	var contador = 0;
	var contador_busca = 0;
	var busca = [];
	$('.campo_busca').each(function() {
		contador++;
		var atributo_id = $(this).attr("id");
		var atributo_pesquisa = $(this).attr("pesquisa");
		var atributo_bd_externo = $(this).attr("bd_externo");
		var campo_nome = atributo_id.replace("busca_", "");
		if($.trim($("#"+$(this).attr("id")+"").val())!="") {
			contador_busca++;
		}

		busca.push({ nome:campo_nome, valor:$("#"+atributo_id+"").val(), pesquisa:atributo_pesquisa, bd_externo:atributo_bd_externo });

		if($('.campo_busca').length==contador) {
			var buscaString = JSON.stringify(busca);
			$.ajax({
				url:  ""+linkAdminAcoes+"acoes/sysgrupousuario/filtra-limpa.php",
				type: "GET",
				data: "busca="+buscaString+"",
				//dataType: "html",
				success: function(data){
					var url_atual = window.location.href;
					
					var n = url_atual.indexOf("pagina/");
					var n2 = url_atual.lastIndexOf("/");
					var resto = parseInt(n2) - (parseInt(n2) - parseInt(n));
					var res = url_atual.substr(0, resto);
				
					window.history.pushState("object or string", "Title", ""+res+"");
					location.reload();
				},
			});
		}
	});
}

function remover_item_lista(numeroUnicoSend,modSend) {
	$.ajax({
		url:  ""+linkAdminAcoes+"acoes/personal/remover-item-lista.php",
		type: "GET",
		data: "numeroUnicoS="+numeroUnicoSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			location.reload();
		},
	});
}

function duplicar_item_lista(numeroUnicoSend,modSend) {
	$.ajax({
		url:  ""+linkAdminAcoes+"acoes/sysgrupousuario/post-"+modSend+".php",
		type: "GET",
		data: "numeroUnicoS="+numeroUnicoSend+"&modS="+modSend+"&duplicar=1",
		//dataType: "html",
		success: function(data){
			location.reload();
		},
	});
}

function muda_lista_stat(numeroUnicoSend,statSend,modSend) {
	$.ajax({
		url:  ""+linkAdminAcoes+"acoes/personal/muda-lista-stat.php",
		type: "GET",
		data: "numeroUnicoS="+numeroUnicoSend+"&statS="+statSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			if(statSend=="0") {
				$("#stat_1_"+numeroUnicoSend+"").hide();
				$("#stat_0_"+numeroUnicoSend+"").show();
			} else if(statSend=="1") {
				$("#stat_0_"+numeroUnicoSend+"").hide();
				$("#stat_1_"+numeroUnicoSend+"").show();
			}
		},
	});
}

function plano_de_assinatura_set() {
	if($.trim($("#tipo").val())=="padrao") {
		$(".plano_de_assinatura_valor").hide();
	} else if($.trim($("#tipo").val())=="assinatura_usuario") {
		$(".plano_de_assinatura_valor").show();
	} else if($.trim($("#tipo").val())=="assinatura_whitelabel") {
		$(".plano_de_assinatura_valor").show();
	}
}

function sysgrupousuario_salvar(acaoSend) {
	$("#idacaoForm").val(acaoSend);
	if($.trim($("#nome").val())=="" ) {
		alert("Um 'Nome' deve ser informado.");
		$("#nome").focus();
	
	} else if($.trim($("#plano_de_assinatura").val())=="1" && $.trim($("#valor").val())=="") {
		alert("Um 'Valor' deve ser informado.");
		$("#valor").focus();
	} else {
		$("#formulario").submit();
	}
}

function cobrancas_adicionais_add() {
	if($.trim($("#cobranca_modelo").val())=="" ) {
		alert("Um 'Modelo de Adicional' deve ser selecionado.");
		$("#cobranca_modelo").focus();
	
	} else if($.trim($("#cobranca_titulo").val())=="" ) {
		alert("Um 'Título' deve ser informado.");
		$("#cobranca_titulo").focus();
	
	} else if($.trim($("#cobranca_tipo").val())=="" ) {
		alert("Um 'Tipo de Cobrança' deve ser informado.");
		$("#cobranca_tipo").focus();
	
	} else if($.trim($("#cobranca_valor").val())=="" ) {
		alert("Um 'Valor Original' deve ser informado.");
		$("#cobranca_valor").focus();
	
	} else {
		preloaderIn();
		var fd = new FormData();
	
		fd.append('cobranca_modelo',$("#cobranca_modelo").val());
		fd.append('cobranca_titulo',$("#cobranca_titulo").val());
		fd.append('cobranca_subtitulo',$("#cobranca_subtitulo").val());
		fd.append('cobranca_tipo',$("#cobranca_tipo").val());
		fd.append('cobranca_valor',$("#cobranca_valor").val());
		fd.append('cobranca_valor_promocional',$("#cobranca_valor_promocional").val());
	
		$.ajax({
			url:  ""+linkAdminAcoes+"acoes/sysgrupousuario/cobrancas_adicionais-add.php",
			type: 'POST',
			data: fd,
			contentType: false,
			processData: false,
			success: function(response){
				$("#cobranca_modelo").val("");
				$("#cobranca_titulo").val("");
				$("#cobranca_subtitulo").val("");
				$("#cobranca_tipo").val("");
				$("#cobranca_valor").val("");
				$("#cobranca_valor_promocional").val("");
				cobrancas_adicionais_lista();
			},
		});
	}
}

function cobrancas_adicionais_editar(numeroUnico_cobrancaSend) {
	if($.trim($("#editar_cobranca_modelo").val())=="" ) {
		alert("Um 'Modelo de Adicional' deve ser selecionado.");
		$("#editar_cobranca_modelo").focus();
	
	} else if($.trim($("#editar_cobranca_titulo").val())=="" ) {
		alert("Um 'Título' deve ser informado.");
		$("#editar_cobranca_titulo").focus();
	
	} else if($.trim($("#editar_cobranca_tipo").val())=="" ) {
		alert("Um 'Tipo de Cobrança' deve ser informado.");
		$("#editar_cobranca_tipo").focus();
	
	} else if($.trim($("#editar_cobranca_valor").val())=="" ) {
		alert("Um 'Valor Original' deve ser informado.");
		$("#editar_cobranca_valor").focus();
	
	} else {
		preloaderIn();
		var fd = new FormData();
	
		fd.append('cobranca_numeroUnico',numeroUnico_cobrancaSend);
		fd.append('cobranca_modelo',$("#editar_cobranca_modelo").val());
		fd.append('cobranca_titulo',$("#editar_cobranca_titulo").val());
		fd.append('cobranca_subtitulo',$("#editar_cobranca_subtitulo").val());
		fd.append('cobranca_tipo',$("#editar_cobranca_tipo").val());
		fd.append('cobranca_valor',$("#editar_cobranca_valor").val());
		fd.append('cobranca_valor_promocional',$("#editar_cobranca_valor_promocional").val());

		$.ajax({
			url:  ""+linkAdminAcoes+"acoes/sysgrupousuario/cobrancas_adicionais-editar.php",
			type: 'POST',
			data: fd,
			contentType: false,
			processData: false,
			success: function(response){
				$("#cobranca_modelo").val("");
				$("#cobranca_titulo").val("");
				$("#cobranca_subtitulo").val("");
				$("#cobranca_tipo").val("");
				$("#cobranca_valor").val("");
				$("#cobranca_valor_promocional").val("");

				$("#cobrancas_adicionais-view").hide();
				$("#cobrancas_adicionais-view").html("");
				$("#cobrancas_adicionais-novo").show();
				cobrancas_adicionais_lista();
			},
		});
	}
}

function cobrancas_adicionais_lista() {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgrupousuario/cobrancas_adicionais-lista.php",
		type: "GET",
		data: "numeroUnico_paiS="+$("#numeroUnico").val()+"",
		//dataType: "html",
		success: function(data){
			$("#cobrancas_adicionais-lista").html(data);
			preloaderOut();
		},
	});
}

function cobrancas_adicionais_stat(numeroUnicoSend,statSend) {
	preloaderIn();
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgrupousuario/cobrancas_adicionais-stat.php",
		type: "GET",
		data: "numeroUnico_paiS="+$("#numeroUnico").val()+"&numeroUnicoS="+numeroUnicoSend+"&statS="+statSend+"",
		//dataType: "html",
		success: function(data){
			cobrancas_adicionais_lista();
		},
	});
}

function cobrancas_adicionais_del(numeroUnicoSend) {
	preloaderIn();
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgrupousuario/cobrancas_adicionais-del.php",
		type: "GET",
		data: "numeroUnico_paiS="+$("#numeroUnico").val()+"&numeroUnicoS="+numeroUnicoSend+"",
		//dataType: "html",
		success: function(data){
			cobrancas_adicionais_lista();
		},
	});
}

function cobrancas_adicionais_ordem(numeroUnicoSend,ordemAtual,tipoSend) {
	$.ajax({
		url:  ""+linkAdminAcoes+"acoes/sysgrupousuario/cobrancas_adicionais-editar-ordem.php",
		type: "GET",
		data: "numeroUnicoS="+numeroUnicoSend+"&ordemAtualS="+ordemAtual+"&tipoS="+tipoSend+"",
		//dataType: "html",
		success: function(data){
			cobrancas_adicionais_lista();
		},
	});
}

function cobrancas_adicionais_view(numeroUnico_cobrancaSend) {
	preloaderIn();
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgrupousuario/cobrancas_adicionais-view.php",
		type: "GET",
		data: "numeroUnico_cobrancaS="+numeroUnico_cobrancaSend+"",
		//dataType: "html",
		success: function(data){
			$("#cobrancas_adicionais-novo").hide();
			$("#cobrancas_adicionais-view").show();
			$("#cobrancas_adicionais-view").html(data);
			preloaderOut();
		},
	});
}

function cobrancas_adicionais_view_cancelar() {
	preloaderIn();
	$("#cobrancas_adicionais-view").hide();
	$("#cobrancas_adicionais-view").html("");
	$("#cobrancas_adicionais-novo").show();
	preloaderOut();
}
