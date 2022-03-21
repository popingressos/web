//function $.trim(str){return str.replace(/^\s+|\s+$/g,"");}

function _construtor_modulo_aba_tipo() {
	
	if($("select[name='tipo']").val()=="arquivo-externo") {
		$("#DIV_arquivo").show();
	} else {
		$("#DIV_arquivo").hide();
	}

}

function _construtor_template_tipo_de_copia() {
	
	if($.trim($("#copia_tipo").val())=="clonar"||$.trim($("#copia_tipo").val())=="") {
		$("#DIV_copia_item").fadeOut();
	} else {
		$("#DIV_copia_item").fadeIn();
	}


}

function tabela_hover(acaoSend) {
	if(acaoSend=="off") {
		$('#datatable_ajax').fadeOut();
	} else {
		$('#datatable_ajax').fadeIn();
	}

}

function muda_edicao_rapida(idSend,statSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_modulo_campo/muda-edicao_rapida.php",
		type: "GET",
		data: "idS="+idSend+"&statS="+statSend+"",
		//dataType: "html",
		success: function(data){
			var $toast = toastr["success"]("Alterado com sucesso !", "");
			$("#edicao_rapida-"+idSend+"").html(data);
			//location.reload();
		},
	});

}

function muda_controle_seo(idSend,statSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_modulo_campo/muda-controle_seo.php",
		type: "GET",
		data: "idS="+idSend+"&statS="+statSend+"",
		//dataType: "html",
		success: function(data){
			location.reload();
		},
	});

}


function sysatalhotag_apenas_tag( tagSend,idSend ) {
	CKEDITOR.instances[""+idSend+""].insertText(""+tagSend+"");
}

function sysatalhotag_tag_id_youtube( tagSend,idSend ) {
	str_return = window.prompt( "Por favor, informe o código do vídeo no YouTube", "Código do vídeo...");
	var resultado = tagSend.replace("@@@@", ""+str_return+"");
	CKEDITOR.instances[""+idSend+""].insertText(""+resultado+"");
}

function sysatalhotag_tag_link( tagSend,idSend ) {
	str_return = window.prompt( "Por favor, informe o link", "#Link do item...");
	var resultado = tagSend.replace("}{", "}"+str_return+"{");
	var resultado = resultado.replace("@@@@", ""+str_return+"");
	CKEDITOR.instances[""+idSend+""].insertText(""+resultado+"");
}

function sysatalhotag_tag_apenas_id( tagSend,idSend ) {
	str_return = window.prompt( "Por favor, informe o código do item", "#ID do item...");
	var resultado = tagSend.replace("}{", "}"+str_return+"{");
	var resultado = resultado.replace("@@@@", ""+str_return+"");
	CKEDITOR.instances[""+idSend+""].insertText(""+resultado+"");
}

function clique_edicao_rapida(campoSend,idSend) {
	$('#'+campoSend+'-'+idSend+'').addClass("edicao_habilitada_"+idSend+"");
	
	$('#'+campoSend+'-'+idSend+'').trigger('click');

	$('.input_edicao_rapida').select();

	window.clearTimeout(MyTimeoutER);
	
}

function abre_edicao_rapida(campoSend,idSend,modSend) {

	 $.fn.editable.defaults.mode = 'inline';
	 
	 $('#'+campoSend+'-'+idSend+'').editable({
		type: 'text',
		title: 'Digite o valor desejado',
		showbuttons: false,
		inputclass: 'input_edicao_rapida',
		validate: function(value) {
		   if($.trim(value) == '') { 
			   salva_campo_tabela_reload(''+campoSend+'',''+idSend+'',''+modSend+'','','---'); 
			   //return 'Este campo é obrigatório';
		   } else {

				var valor_set = value.replace("&", "{ecom}");
				for (i = 0; i < 10; i++) {
					valor_set = valor_set.replace("&", "{ecom}");
					valor_set = valor_set.replace("?", "{interrogacao}");
					valor_set = valor_set.replace("%20", "{espaco}");
					valor_set = valor_set.replace("=", "{igual}");
					valor_set = valor_set.replace("+", "{mais}");
					valor_set = valor_set.replace("#", "{hash}");
				}
			
			   salva_campo_tabela_reload(''+campoSend+'',''+idSend+'',''+modSend+'','',valor_set); 
		   }
		}
	});
	
	if($('#'+campoSend+'-'+idSend+'').hasClass("edicao_habilitada_"+idSend+"")===true) { } else {
		MyTimeoutER = window.setTimeout("clique_edicao_rapida('"+campoSend+"','"+idSend+"');", 10);
	}
	

}

function abre_edicao_rapida_palavras_chave(campoSend,idSend,valorSend,modSend) {

	 $.fn.editable.defaults.mode = 'inline';
	 
	 $('#'+campoSend+'-'+idSend+'').editable({
		type: 'text',
		title: 'Digite o valor desejado',
		showbuttons: false,
		inputclass: 'input_edicao_rapida',
		validate: function(value) {
			/*var valor_set = value.replace("&", "{ecom}");
			for (i = 0; i < 10; i++) {
				valor_set = valor_set.replace("&", "{ecom}");
				valor_set = valor_set.replace("?", "{interrogacao}");
				valor_set = valor_set.replace("%20", "{espaco}");
				valor_set = valor_set.replace("=", "{igual}");
				valor_set = valor_set.replace("+", "{mais}");
				valor_set = valor_set.replace("#", "{hash}");
			}*/
			salva_palavras_chave(''+valorSend+'',value); 
		}
	});
	
	if($('#'+campoSend+'-'+idSend+'').hasClass("edicao_habilitada_"+idSend+"")===true) { } else {
		MyTimeoutER = window.setTimeout("clique_edicao_rapida('"+campoSend+"','"+idSend+"');", 10);
	}
	

}


function salva_campo_tabela_construtor(nomeSend,idSend,modSend,subLocalSend,valorSend) {
	if (confirm("Você realmente editar este campo ?")) {
		preloaderIn();
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_construtor_template/update-campo.php",
			type: "GET",
			data: "nomeS="+nomeSend+"&idS="+idSend+"&modS="+modSend+"&subLocalS="+subLocalSend+"&valorS="+valorSend+"",
			//dataType: "html",
			success: function(data){
				if(modSend=="resultado") { } else {
					var $toast = toastr["success"]("Campo alterado com sucesso !", "");
				}
				$("#tabela_montada").html(data);
				FormEditable.init();
				preloaderOut();
				//location.reload();
			},
		});
	}
}

function edita_ordem_construtor(idSend,modSend,subLocalSend,idCampoDependenteSend,idValorDependenteSend,ordemSend) {
	if (confirm("Você realmente deseja alterar a ordem deste item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_construtor_template/update-ordem.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&subLocalS="+subLocalSend+"&idCampoDependenteS="+idCampoDependenteSend+"&idValorDependenteS="+idValorDependenteSend+"&ordemS="+ordemSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function _construtor_template_copia_submit() {
	
	$("#copia_lista_itens").val(""+parent.$("#lista_checkboxes").val()+"");
	
	if($.trim($("#copia_tipo").val())=="") {
		alert("Você deve selecionar um tipo de cópia!");
		$("#copia_tipo").focus();
	} else {
		if($.trim($("#copia_tipo").val())=="clonar"||$.trim($("#copia_tipo").val())=="") {
			if($.trim($("#TI_copia_campo").val())=="") {
				alert("Você deve selecionar ao menos um campo para realizar a cópia!");
			} else {
				$("#formulario_copiar").submit();
			}
		} else {
			if($.trim($("#copia_item").val())=="") {
				alert("Você deve selecionar ao menos um item para realizar a cópia");
				$("#copia_item").focus();
			} else {
				if($.trim($("#TI_copia_campo").val())=="") {
					alert("Você deve selecionar ao menos um campo para realizar a cópia!");
				} else {
					$("#formulario_copiar").submit();
				}
			}
		}
	}

}

function modal_construtor_modulo(formSend,modSend) {

	jQuery(document).ready(function() {
		$.fancybox({
			'padding': 0,
			'scrolling'   : 'no',
			'openEffect'	: 'elastic',
			'closeEffect'	: 'elastic',
			'width'			: 1100,
			'height'		: 550,
			'type'			: 'ajax',
			'href'			: ''+linkAdminAcoes+'mod/_construtor_template/'+formSend+'.php?modS='+modSend+''
		});
	});

}

function salva_construtor_modulo_campo() {

	if($.trim($("#nome").val())=="") {
		alert("O campo 'Nome' deve ser preenchido");
		$("#nome").focus();
	} else {
		if($.trim($("#nome_base").val())=="") {
			alert("O campo 'Nome na Tabela' deve ser preenchido");
			$("#nome_base").focus();
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_modulo_campo/verifica-campo.php",
				type: "GET",
				data: "nomeS="+$("#nome").val()+"&nome_baseS="+$("#nome_base").val()+"&id_construtor_moduloS="+$("#id_construtor_modulo").val()+"",
				//dataType: "html",
				success: function(data){
					if(data=="1") {
						$("#nome_base_form-group").addClass("has-error");
						$("#nome_base_icone").fadeIn();
						$("#nome_base_info").html("Já existe um campo nesta tabela com este nome!");
					} else {
						$("#nome_base_form-group").removeClass("has-error");
						$("#nome_base_icone").fadeOut();
						$("#nome_base_info").html("");
						document.forms.submit();
					}
				},
			});
		}
	}
	
}

function salva_construtor_modulo() {

	if($.trim($("#nome").val())=="") {
		alert("O campo 'Nome' deve ser preenchido");
		$("#nome").focus();
	} else {
		if($.trim($("#nome_base").val())=="") {
			alert("O campo 'Tabela no Banco' deve ser preenchido");
			$("#nome_base").focus();
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_modulo/verifica-base.php",
				type: "GET",
				data: "nomeS="+$("#nome").val()+"&nome_baseS="+$("#nome_base").val()+"",
				//dataType: "html",
				success: function(data){
					if(data=="1") {
						$("#nome_base_form-group").addClass("has-error");
						$("#nome_base_icone").fadeIn();
						$("#nome_base_info").html("Já existe uma tabela na base de dados com este nome!");
						$("#DIV_inserir_mesmo_assim").fadeIn();
						if($.trim($("#inserir_mesmo_assim").val())=="1") {
							document.forms.submit();
						}
					} else {
						$("#nome_base_form-group").removeClass("has-error");
						$("#nome_base_icone").fadeOut();
						$("#nome_base_info").html("");
						$("#DIV_inserir_mesmo_assim").fadeOut();
						document.forms.submit();
					}
				},
			});
		}
	}
	
}

function remover_construtor_modulo(idSend,modSend,ordemSetSend,ordemSend,tabelaExtraSend,valorTabelaExtraSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_construtor_modulo/remover.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&ordemSetS="+ordemSetSend+"&ordemS="+ordemSend+"&tabelaExtraS="+tabelaExtraSend+"&valorTabelaExtraS="+valorTabelaExtraSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function remover_construtor_modulo_campo(idSend,modSend,id_construtor_moduloSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_construtor_modulo_campo/remover.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&id_construtor_moduloS="+id_construtor_moduloSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function salvar_construtor_modulo_organizacao(moduloSend,abaSend) {

	if($.trim($("#ordem_"+abaSend+"").val())=="") {
		alert("Você deve selecionar uma 'Ordem'");
		$("#ordem_"+abaSend+"").focus();
	} else {
		if($.trim($("#id_construtor_modulo_campo_"+abaSend+"").val())=="") {
			alert("Você deve selecionar um 'Campo'");
			$("#id_construtor_modulo_campo_"+abaSend+"").focus();
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_modulo_organizacao/campo-add.php",
				type: "GET",
				data: "ordemS="+$("#ordem_"+abaSend+"").val()+"&id_construtor_modulo_campoS="+$("#id_construtor_modulo_campo_"+abaSend+"").val()+"&id_construtor_moduloS="+moduloSend+"&id_construtor_modulo_abaS="+abaSend+"",
				//dataType: "html",
				success: function(data){

					location.reload();

				},
			});
		}
	}
	
}

function salvar_descricao_modulo_organizacao(moduloSend,abaSend) {

	if($.trim($("#ordem_"+abaSend+"").val())=="") {
		alert("Você deve selecionar uma 'Ordem'");
		$("#ordem_"+abaSend+"").focus();
	} else {
		if($.trim($("#id_construtor_modulo_campo_"+abaSend+"").val())=="") {
			alert("Você deve selecionar um 'Campo'");
			$("#id_construtor_modulo_campo_"+abaSend+"").focus();
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_descricao_modulo_organizacao/campo-add.php",
				type: "GET",
				data: "ordemS="+$("#ordem_"+abaSend+"").val()+"&id_construtor_modulo_campoS="+$("#id_construtor_modulo_campo_"+abaSend+"").val()+"&id_construtor_moduloS="+moduloSend+"&id_construtor_modulo_abaS="+abaSend+"",
				//dataType: "html",
				success: function(data){

					location.reload();

				},
			});
		}
	}
	
}

function remover_construtor_modulo_organizacao(idSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_construtor_modulo_organizacao/campo-remover.php",
			type: "GET",
			data: "idS="+idSend+"",
			//dataType: "html",
			success: function(data){

				location.reload();

			},
		});
	}
}

function remover_descricao_modulo_organizacao(idSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_descricao_modulo_organizacao/campo-remover.php",
			type: "GET",
			data: "idS="+idSend+"",
			//dataType: "html",
			success: function(data){

				location.reload();

			},
		});
	}
}

function muda_stat_construtor_modulo_organizacao(idSend,statSend) {
	if (confirm("Você realmente deseja modificar o status deste item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_construtor_modulo_organizacao/campo-stat.php",
			type: "GET",
			data: "idS="+idSend+"&statS="+statSend+"",
			//dataType: "html",
			success: function(data){

				location.reload();

			},
		});

	}
}

function muda_stat_descricao_modulo_organizacao(idSend,statSend) {
	if (confirm("Você realmente deseja modificar o status deste item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_descricao_modulo_organizacao/campo-stat.php",
			type: "GET",
			data: "idS="+idSend+"&statS="+statSend+"",
			//dataType: "html",
			success: function(data){

				location.reload();

			},
		});

	}
}

function ordem_construtor_modulo_organizacao(idSend,ordemSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_modulo_organizacao/campo-ordem.php",
		type: "GET",
		data: "idS="+idSend+"&ordemS="+ordemSend+"",
		//dataType: "html",
		success: function(data){

			location.reload();

		},
	});
}

function ordem_descricao_modulo_organizacao(idSend,ordemSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_descricao_modulo_organizacao/campo-ordem.php",
		type: "GET",
		data: "idS="+idSend+"&ordemS="+ordemSend+"",
		//dataType: "html",
		success: function(data){

			location.reload();

		},
	});
}

function nao_exibe_texto_construtor_modulo(modSend,abaSend,idsysusuSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_modulo/exibicao-texto-aba.php",
		type: "GET",
		data: "modS="+modSend+"&abaS="+abaSend+"&idsysusuS="+idsysusuSend+"",
		//dataType: "html",
		success: function(data){
		},
	});

}

function muda_stat_texto_informativo_minha_config(idSysusuSend,modSend,abaSend,statSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/minha-config-texto-stat.php",
		type: "GET",
		data: "idSysusuS="+idSysusuSend+"&modS="+modSend+"&abaS="+abaSend+"&statS="+statSend+"",
		//dataType: "html",
		success: function(data){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/minha-config-texto-lista.php",
				type: "GET",
				data: "idSysusuS="+idSysusuSend+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data_lista){
					$("#lista_minha_config_texto_lista").html(data_lista);
				},
			});

		},
	});

}

function gera_senha_construtor_modulo_campo(idCampoSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/gera-senha.php",
		type: "GET",
		data: "",
		//dataType: "html",
		success: function(data){
			$("#"+idCampoSend+"").val(data);
		},
	});
}

// SCRIPTS CABEÇALHO
function salvar_lista_cabecalho_construtor_modulo(modSend) {

	if($.trim( $("#nome_cabecalho").val())=="") {
		alert("O campo 'Nome' deve ser preenchido");
		$("#nome_cabecalho").focus();
	} else {
		if($.trim( $("#campo_cabecalho").val())=="") {
			alert("O campo 'Título' deve ser preenchido");
			$("#campo_cabecalho").focus();
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/cabecalho-add.php",
				type: "GET",
				data: "nomeS="+$("#nome_cabecalho").val()+"&campoS="+$("#campo_cabecalho").val()+"&ordemS="+$("#ordem_cabecalho").val()+"&tamanhoS="+$("#tamanho_cabecalho").val()+"&tipoS="+$("#tipo_cabecalho").val()+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data){

					$.ajax({
						url: ""+linkAdminAcoes+"acoes/_construtor_template/cabecalho-lista.php",
						type: "GET",
						data: "modS="+modSend+"",
						//dataType: "html",
						success: function(data_lista){
							$("#lista_"+modSend+"_cabecalho").html(data_lista);
						},
					});

					$.ajax({
						url: ""+linkAdminAcoes+"acoes/_construtor_template/cabecalho-form-add.php",
						type: "GET",
						data: "modS="+modSend+"",
						//dataType: "html",
						success: function(data_form){
							$("#formulario-cabecalho").html(data_form);
						},
					});
				
				},
			});
		}
	}
}

function editar_cabecalho_construtor_modulo(idSend,modSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/cabecalho-form-editar.php",
		type: "GET",
		data: "idS="+idSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			$("#formulario-cabecalho").html(data);
		},
	});
}

function cancela_editar_cabecalho_construtor_modulo(modSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/cabecalho-form-add.php",
		type: "GET",
		data: "modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			$("#formulario-cabecalho").html(data);
		},
	});
}

function salvar_editar_cabecalho_construtor_modulo(modSend) {

	if($.trim( $("#nome_cabecalho").val())=="") {
		alert("O campo 'Nome' deve ser preenchido");
		$("#nome_cabecalho").focus();
	} else {
		if($.trim( $("#campo_cabecalho").val())=="") {
			alert("O campo 'Título' deve ser preenchido");
			$("#campo_cabecalho").focus();
		} else {

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/cabecalho-editar.php",
				type: "GET",
				data: "idS="+$("#id_cabecalho").val()+"&ordemS="+$("#ordem_cabecalho").val()+"&nomeS="+$("#nome_cabecalho").val()+"&campoS="+$("#campo_cabecalho").val()+"&tamanhoS="+$("#tamanho_cabecalho").val()+"&tipoS="+$("#tipo_cabecalho").val()+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data){

					$.ajax({
						url: ""+linkAdminAcoes+"acoes/_construtor_template/cabecalho-lista.php",
						type: "GET",
						data: "modS="+modSend+"",
						//dataType: "html",
						success: function(data_lista){
							$("#lista_"+modSend+"_cabecalho").html(data_lista);
						},
					});
		
					$.ajax({
						url: ""+linkAdminAcoes+"acoes/_construtor_template/cabecalho-form-add.php",
						type: "GET",
						data: "modS="+modSend+"",
						//dataType: "html",
						success: function(data_form){
							$("#formulario-cabecalho").html(data_form);
						},
					});

				},
			});
		}
	}

}

function remover_cabecalho_construtor_modulo(idSend,modSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/cabecalho-remover.php",
		type: "GET",
		data: "idS="+idSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/cabecalho-lista.php",
				type: "GET",
				data: "modS="+modSend+"",
				//dataType: "html",
				success: function(data_lista){
					$("#lista_"+modSend+"_cabecalho").html(data_lista);
				},
			});

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/cabecalho-form-add.php",
				type: "GET",
				data: "modS="+modSend+"",
				//dataType: "html",
				success: function(data_form){
					$("#formulario-cabecalho").html(data_form);
				},
			});

		},
	});

}

function muda_stat_cabecalho_construtor_modulo(idSend,modSend,statSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/cabecalho-stat.php",
		type: "GET",
		data: "idS="+idSend+"&modS="+modSend+"&statS="+statSend+"",
		//dataType: "html",
		success: function(data){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/cabecalho-lista.php",
				type: "GET",
				data: "modS="+modSend+"",
				//dataType: "html",
				success: function(data_lista){
					$("#lista_"+modSend+"_cabecalho").html(data_lista);
				},
			});

		},
	});

}

function set_titulo_cabecalho() {
	$("#nome_cabecalho").val(""+$("#campo_cabecalho option:selected").text()+"");
}

// SCRIPTS ORDENAÇÃO
function salvar_lista_ordenacao_construtor_modulo(modSend) {

	if($.trim( $("#campo_ordenacao").val())=="") {
		alert("Um 'Campo' deve ser selecionado");
		$("#campo_ordenacao").focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao-add.php",
			type: "GET",
			data: "tipoS="+$("#tipo_ordenacao").val()+"&campoS="+$("#campo_ordenacao").val()+"&ordemS="+$("#ordem_ordenacao").val()+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao-lista.php",
					type: "GET",
					data: "modS="+modSend+"",
					//dataType: "html",
					success: function(data_lista){
						$("#lista_"+modSend+"_ordenacao").html(data_lista);
					},
				});

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao-form-add.php",
					type: "GET",
					data: "modS="+modSend+"",
					//dataType: "html",
					success: function(data_form){
						$("#formulario-ordenacao").html(data_form);
					},
				});
			
			},
		});
	}
}

function editar_ordenacao_construtor_modulo(idSend,modSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao-form-editar.php",
		type: "GET",
		data: "idS="+idSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			$("#formulario-ordenacao").html(data);
		},
	});
}

function cancela_editar_ordenacao_construtor_modulo(modSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao-form-add.php",
		type: "GET",
		data: "modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			$("#formulario-ordenacao").html(data);
		},
	});
}

function salvar_editar_ordenacao_construtor_modulo(modSend) {

	if($.trim( $("#campo_ordenacao").val())=="") {
		alert("Um 'Campo' deve ser selecionado");
		$("#campo_ordenacao").focus();
	} else {

		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao-editar.php",
			type: "GET",
			data: "idS="+$("#id_ordenacao").val()+"&ordemS="+$("#ordem_ordenacao").val()+"&tipoS="+$("#tipo_ordenacao").val()+"&campoS="+$("#campo_ordenacao").val()+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao-lista.php",
					type: "GET",
					data: "modS="+modSend+"",
					//dataType: "html",
					success: function(data_lista){
						$("#lista_"+modSend+"_ordenacao").html(data_lista);
					},
				});
	
				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao-form-add.php",
					type: "GET",
					data: "modS="+modSend+"",
					//dataType: "html",
					success: function(data_form){
						$("#formulario-ordenacao").html(data_form);
					},
				});

			},
		});
	}

}

function remover_ordenacao_construtor_modulo(idSend,modSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao-remover.php",
		type: "GET",
		data: "idS="+idSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao-lista.php",
				type: "GET",
				data: "modS="+modSend+"",
				//dataType: "html",
				success: function(data_lista){
					$("#lista_"+modSend+"_ordenacao").html(data_lista);
				},
			});

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao-form-add.php",
				type: "GET",
				data: "modS="+modSend+"",
				//dataType: "html",
				success: function(data_form){
					$("#formulario-ordenacao").html(data_form);
				},
			});

		},
	});

}

function muda_stat_ordenacao_construtor_modulo(idSend,modSend,statSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao-stat.php",
		type: "GET",
		data: "idS="+idSend+"&modS="+modSend+"&statS="+statSend+"",
		//dataType: "html",
		success: function(data){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao-lista.php",
				type: "GET",
				data: "modS="+modSend+"",
				//dataType: "html",
				success: function(data_lista){
					$("#lista_"+modSend+"_ordenacao").html(data_lista);
				},
			});

		},
	});

}

// SCRIPTS AÇÃO
function salvar_lista_acao_construtor_modulo(modSend) {

	var cor_set = $("#cor_acao").val().replace("#", "");

	if($.trim( $("#campo_acao").val())=="") {
		alert("Um 'Campo' deve ser selecionado");
		$("#campo_acao").focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_construtor_template/acao-add.php",
			type: "GET",
			data: "modS="+modSend+"&tituloS="+$("#titulo_acao").val()+"&campoS="+$("#campo_acao").val()+"&ordemS="+$("#ordem_acao").val()+"&iconeS="+$("#icone_acao").val()+"&scriptS="+$("#script_acao").val()+"&corS="+cor_set+"",
			//dataType: "html",
			success: function(data){

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/acao-lista.php",
					type: "GET",
					data: "modS="+modSend+"",
					//dataType: "html",
					success: function(data_lista){
						$("#lista_"+modSend+"_acao").html(data_lista);
					},
				});

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/acao-form-add.php",
					type: "GET",
					data: "modS="+modSend+"",
					//dataType: "html",
					success: function(data_form){
						$("#formulario-acao").html(data_form);

						$('.bs-select').selectpicker({
							iconBase: 'fa',
							tickIcon: 'fa-check'
						});

						$('.colorpicker-default').colorpicker({
							format: 'hex'
						});
						$('.colorpicker-rgba').colorpicker();
					},
				});
			

			},
		});
	}
}

function editar_acao_construtor_modulo(idSend,modSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/acao-form-editar.php",
		type: "GET",
		data: "idS="+idSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			$("#formulario-acao").html(data);

			$('.bs-select').selectpicker({
				iconBase: 'fa',
				tickIcon: 'fa-check'
			});

			$('.colorpicker-default').colorpicker({
				format: 'hex'
			});
			$('.colorpicker-rgba').colorpicker();
		},
	});
}

function cancela_editar_acao_construtor_modulo(modSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/acao-form-add.php",
		type: "GET",
		data: "modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			$("#formulario-acao").html(data);

			$('.bs-select').selectpicker({
				iconBase: 'fa',
				tickIcon: 'fa-check'
			});

			$('.colorpicker-default').colorpicker({
				format: 'hex'
			});
			$('.colorpicker-rgba').colorpicker();
		},
	});
}

function salvar_editar_acao_construtor_modulo(modSend) {

	var cor_set = $("#cor_acao").val().replace("#", "");
	
	if($.trim( $("#campo_acao").val())=="") {
		alert("Um 'Campo' deve ser selecionado");
		$("#campo_acao").focus();
	} else {

		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_construtor_template/acao-editar.php",
			type: "GET",
			data: "idS="+$("#id_acao").val()+"&modS="+modSend+"&ordemS="+$("#ordem_acao").val()+"&tituloS="+$("#titulo_acao").val()+"&campoS="+$("#campo_acao").val()+"&iconeS="+$("#icone_acao").val()+"&scriptS="+$("#script_acao").val()+"&corS="+cor_set+"",
			//dataType: "html",
			success: function(data){

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/acao-lista.php",
					type: "GET",
					data: "modS="+modSend+"",
					//dataType: "html",
					success: function(data_lista){
						$("#lista_"+modSend+"_acao").html(data_lista);
					},
				});
	
				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/acao-form-add.php",
					type: "GET",
					data: "modS="+modSend+"",
					//dataType: "html",
					success: function(data_form){
						$("#formulario-acao").html(data_form);

						$('.bs-select').selectpicker({
							iconBase: 'fa',
							tickIcon: 'fa-check'
						});

						$('.colorpicker-default').colorpicker({
							format: 'hex'
						});
						$('.colorpicker-rgba').colorpicker();
					},
				});

			},
		});
	}

}

function remover_acao_construtor_modulo(idSend,modSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/acao-remover.php",
		type: "GET",
		data: "idS="+idSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/acao-lista.php",
				type: "GET",
				data: "modS="+modSend+"",
				//dataType: "html",
				success: function(data_lista){
					$("#lista_"+modSend+"_acao").html(data_lista);
				},
			});

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/acao-form-add.php",
				type: "GET",
				data: "modS="+modSend+"",
				//dataType: "html",
				success: function(data_form){
					$("#formulario-acao").html(data_form);
				},
			});

		},
	});

}

function muda_stat_acao_construtor_modulo(idSend,modSend,statSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/acao-stat.php",
		type: "GET",
		data: "idS="+idSend+"&modS="+modSend+"&statS="+statSend+"",
		//dataType: "html",
		success: function(data){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/acao-lista.php",
				type: "GET",
				data: "modS="+modSend+"",
				//dataType: "html",
				success: function(data_lista){
					$("#lista_"+modSend+"_acao").html(data_lista);
				},
			});

		},
	});

}

// SCRIPTS DESTACAR
function salvar_lista_destacar_construtor_modulo(modSend) {

	var cor_set = $("#cor_destacar").val().replace("#", "");

	if($.trim( $("#campo_destacar").val())=="") {
		alert("Um 'Campo' deve ser selecionado");
		$("#campo_destacar").focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_construtor_template/destacar-add.php",
			type: "GET",
			data: "modS="+modSend+"&campoS="+$("#campo_destacar").val()+"&ordemS="+$("#ordem_destacar").val()+"&comparacaoS="+$("#comparacao_destacar").val()+"&valorS="+$("#valor_destacar").val()+"&corS="+cor_set+"",
			//dataType: "html",
			success: function(data){

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/destacar-lista.php",
					type: "GET",
					data: "modS="+modSend+"",
					//dataType: "html",
					success: function(data_lista){
						$("#lista_"+modSend+"_destacar").html(data_lista);
					},
				});

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/destacar-form-add.php",
					type: "GET",
					data: "modS="+modSend+"",
					//dataType: "html",
					success: function(data_form){
						$("#formulario-destacar").html(data_form);

						$('.bs-select').selectpicker({
							iconBase: 'fa',
							tickIcon: 'fa-check'
						});

						$('.colorpicker-default').colorpicker({
							format: 'hex'
						});
						$('.colorpicker-rgba').colorpicker();
					},
				});
			

			},
		});
	}
}

function editar_destacar_construtor_modulo(idSend,modSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/destacar-form-editar.php",
		type: "GET",
		data: "idS="+idSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			$("#formulario-destacar").html(data);

			$('.bs-select').selectpicker({
				iconBase: 'fa',
				tickIcon: 'fa-check'
			});

			$('.colorpicker-default').colorpicker({
				format: 'hex'
			});
			$('.colorpicker-rgba').colorpicker();
		},
	});
}

function cancela_editar_destacar_construtor_modulo(modSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/destacar-form-add.php",
		type: "GET",
		data: "modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			$("#formulario-destacar").html(data);

			$('.bs-select').selectpicker({
				iconBase: 'fa',
				tickIcon: 'fa-check'
			});

			$('.colorpicker-default').colorpicker({
				format: 'hex'
			});
			$('.colorpicker-rgba').colorpicker();
		},
	});
}

function salvar_editar_destacar_construtor_modulo(modSend) {

	var cor_set = $("#cor_destacar").val().replace("#", "");
	
	if($.trim( $("#campo_destacar").val())=="") {
		alert("Um 'Campo' deve ser selecionado");
		$("#campo_destacar").focus();
	} else {

		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_construtor_template/destacar-editar.php",
			type: "GET",
			data: "idS="+$("#id_destacar").val()+"&modS="+modSend+"&ordemS="+$("#ordem_destacar").val()+"&comparacaoS="+$("#comparacao_destacar").val()+"&valorS="+$("#valor_destacar").val()+"&campoS="+$("#campo_destacar").val()+"&corS="+cor_set+"",
			//dataType: "html",
			success: function(data){

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/destacar-lista.php",
					type: "GET",
					data: "modS="+modSend+"",
					//dataType: "html",
					success: function(data_lista){
						$("#lista_"+modSend+"_destacar").html(data_lista);
					},
				});
	
				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/destacar-form-add.php",
					type: "GET",
					data: "modS="+modSend+"",
					//dataType: "html",
					success: function(data_form){
						$("#formulario-destacar").html(data_form);

						$('.bs-select').selectpicker({
							iconBase: 'fa',
							tickIcon: 'fa-check'
						});

						$('.colorpicker-default').colorpicker({
							format: 'hex'
						});
						$('.colorpicker-rgba').colorpicker();
					},
				});

			},
		});
	}

}

function remover_destacar_construtor_modulo(idSend,modSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/destacar-remover.php",
		type: "GET",
		data: "idS="+idSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/destacar-lista.php",
				type: "GET",
				data: "modS="+modSend+"",
				//dataType: "html",
				success: function(data_lista){
					$("#lista_"+modSend+"_destacar").html(data_lista);
				},
			});

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/destacar-form-add.php",
				type: "GET",
				data: "modS="+modSend+"",
				//dataType: "html",
				success: function(data_form){
					$("#formulario-destacar").html(data_form);
				},
			});

		},
	});

}

function muda_stat_destacar_construtor_modulo(idSend,modSend,statSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/destacar-stat.php",
		type: "GET",
		data: "idS="+idSend+"&modS="+modSend+"&statS="+statSend+"",
		//dataType: "html",
		success: function(data){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/destacar-lista.php",
				type: "GET",
				data: "modS="+modSend+"",
				//dataType: "html",
				success: function(data_lista){
					$("#lista_"+modSend+"_destacar").html(data_lista);
				},
			});

		},
	});

}

// SCRIPTS ORDENAÇÃO CAMPO EXTERNO
function salvar_lista_ordenacao_campo_externo_construtor_modulo(modSend,idCampoSend) {

	if($.trim( $("#campo_ordenacao_campo_externo_"+idCampoSend+"").val())=="") {
		alert("Um 'Campo' deve ser selecionado");
		$("#campo_ordenacao_campo_externo_"+idCampoSend+"").focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao_campo_externo-add.php",
			type: "GET",
			data: "idCampoS="+idCampoSend+"&tipoS="+$("#tipo_ordenacao_campo_externo_"+idCampoSend+"").val()+"&campoS="+$("#campo_ordenacao_campo_externo_"+idCampoSend+"").val()+"&ordemS="+$("#ordem_ordenacao_campo_externo_"+idCampoSend+"").val()+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao_campo_externo-lista.php",
					type: "GET",
					data: "idCampoS="+idCampoSend+"&modS="+modSend+"",
					//dataType: "html",
					success: function(data_lista){
						$("#lista_"+modSend+"_ordenacao_campo_externo_"+idCampoSend+"").html(data_lista);
					},
				});

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao_campo_externo-form-add.php",
					type: "GET",
					data: "idCampoS="+idCampoSend+"&modS="+modSend+"",
					//dataType: "html",
					success: function(data_form){
						$("#formulario-ordenacao_campo_externo_"+idCampoSend+"").html(data_form);
					},
				});
			
			},
		});
	}
}

function editar_ordenacao_campo_externo_construtor_modulo(idSend,modSend,idCampoSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao_campo_externo-form-editar.php",
		type: "GET",
		data: "idS="+idSend+"&idCampoS="+idCampoSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			$("#formulario-ordenacao_campo_externo_"+idCampoSend+"").html(data);
		},
	});
}

function cancela_editar_ordenacao_campo_externo_construtor_modulo(modSend,idCampoSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao_campo_externo-form-add.php",
		type: "GET",
		data: "idCampoS="+idCampoSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			$("#formulario-ordenacao_campo_externo_"+idCampoSend+"").html(data);
		},
	});
}

function salvar_editar_ordenacao_campo_externo_construtor_modulo(modSend,idCampoSend) {

	if($.trim( $("#campo_ordenacao_campo_externo_"+idCampoSend+"").val())=="") {
		alert("Um 'Campo' deve ser selecionado");
		$("#campo_ordenacao_campo_externo_"+idCampoSend+"").focus();
	} else {

		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao_campo_externo-editar.php",
			type: "GET",
			data: "idS="+$("#id_ordenacao_campo_externo_"+idCampoSend+"").val()+"&idCampoS="+idCampoSend+"&ordemS="+$("#ordem_ordenacao_campo_externo_"+idCampoSend+"").val()+"&tipoS="+$("#tipo_ordenacao_campo_externo_"+idCampoSend+"").val()+"&campoS="+$("#campo_ordenacao_campo_externo_"+idCampoSend+"").val()+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao_campo_externo-lista.php",
					type: "GET",
					data: "idCampoS="+idCampoSend+"&modS="+modSend+"",
					//dataType: "html",
					success: function(data_lista){
						$("#lista_"+modSend+"_ordenacao_campo_externo_"+idCampoSend+"").html(data_lista);
					},
				});
	
				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao_campo_externo-form-add.php",
					type: "GET",
					data: "idCampoS="+idCampoSend+"&modS="+modSend+"",
					//dataType: "html",
					success: function(data_form){
						$("#formulario-ordenacao_campo_externo_"+idCampoSend+"").html(data_form);
					},
				});

			},
		});
	}

}

function remover_ordenacao_campo_externo_construtor_modulo(idSend,modSend,idCampoSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao_campo_externo-remover.php",
		type: "GET",
		data: "idS="+idSend+"&idCampoS="+idCampoSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao_campo_externo-lista.php",
				type: "GET",
				data: "idCampoS="+idCampoSend+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data_lista){
					$("#lista_"+modSend+"_ordenacao_campo_externo_"+idCampoSend+"").html(data_lista);
				},
			});

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao_campo_externo-form-add.php",
				type: "GET",
				data: "idCampoS="+idCampoSend+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data_form){
					$("#formulario-ordenacao_campo_externo_"+idCampoSend+"").html(data_form);
				},
			});

		},
	});

}

function muda_stat_ordenacao_campo_externo_construtor_modulo(idSend,modSend,statSend,idCampoSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao_campo_externo-stat.php",
		type: "GET",
		data: "idS="+idSend+"&idCampoS="+idCampoSend+"&modS="+modSend+"&statS="+statSend+"",
		//dataType: "html",
		success: function(data){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/ordenacao_campo_externo-lista.php",
				type: "GET",
				data: "idCampoS="+idCampoSend+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data_lista){
					$("#lista_"+modSend+"_ordenacao_campo_externo_"+idCampoSend+"").html(data_lista);
				},
			});

		},
	});

}

// SCRIPTS FILTRO CAMPO EXTERNO
function salvar_lista_filtro_campo_externo_construtor_modulo(modSend,idCampoSend) {

	if($.trim( $("#campo_filtro_campo_externo_"+idCampoSend+"").val())=="") {
		alert("Um 'Campo' deve ser selecionado");
		$("#campo_filtro_campo_externo_"+idCampoSend+"").focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_construtor_template/filtro_campo_externo-add.php",
			type: "GET",
			data: "idCampoS="+idCampoSend+"&tipoS="+$("#tipo_filtro_campo_externo_"+idCampoSend+"").val()+"&campoS="+$("#campo_filtro_campo_externo_"+idCampoSend+"").val()+"&ordemS="+$("#ordem_filtro_campo_externo_"+idCampoSend+"").val()+"&valorS="+$("#valor_filtro_campo_externo_"+idCampoSend+"").val()+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/filtro_campo_externo-lista.php",
					type: "GET",
					data: "idCampoS="+idCampoSend+"&modS="+modSend+"",
					//dataType: "html",
					success: function(data_lista){
						$("#lista_"+modSend+"_filtro_campo_externo_"+idCampoSend+"").html(data_lista);
					},
				});

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/filtro_campo_externo-form-add.php",
					type: "GET",
					data: "idCampoS="+idCampoSend+"&modS="+modSend+"",
					//dataType: "html",
					success: function(data_form){
						$("#formulario-filtro_campo_externo_"+idCampoSend+"").html(data_form);
					},
				});
			
			},
		});
	}
}

function editar_filtro_campo_externo_construtor_modulo(idSend,modSend,idCampoSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/filtro_campo_externo-form-editar.php",
		type: "GET",
		data: "idS="+idSend+"&idCampoS="+idCampoSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			$("#formulario-filtro_campo_externo_"+idCampoSend+"").html(data);
		},
	});
}

function cancela_editar_filtro_campo_externo_construtor_modulo(modSend,idCampoSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/filtro_campo_externo-form-add.php",
		type: "GET",
		data: "idCampoS="+idCampoSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			$("#formulario-filtro_campo_externo_"+idCampoSend+"").html(data);
		},
	});
}

function salvar_editar_filtro_campo_externo_construtor_modulo(modSend,idCampoSend) {

	if($.trim( $("#campo_filtro_campo_externo_"+idCampoSend+"").val())=="") {
		alert("Um 'Campo' deve ser selecionado");
		$("#campo_filtro_campo_externo_"+idCampoSend+"").focus();
	} else {

		$.ajax({
			url: ""+linkAdminAcoes+"acoes/_construtor_template/filtro_campo_externo-editar.php",
			type: "GET",
			data: "idS="+$("#id_filtro_campo_externo_"+idCampoSend+"").val()+"&idCampoS="+idCampoSend+"&ordemS="+$("#ordem_filtro_campo_externo_"+idCampoSend+"").val()+"&tipoS="+$("#tipo_filtro_campo_externo_"+idCampoSend+"").val()+"&campoS="+$("#campo_filtro_campo_externo_"+idCampoSend+"").val()+"&valorS="+$("#valor_filtro_campo_externo_"+idCampoSend+"").val()+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/filtro_campo_externo-lista.php",
					type: "GET",
					data: "idCampoS="+idCampoSend+"&modS="+modSend+"",
					//dataType: "html",
					success: function(data_lista){
						$("#lista_"+modSend+"_filtro_campo_externo_"+idCampoSend+"").html(data_lista);
					},
				});
	
				$.ajax({
					url: ""+linkAdminAcoes+"acoes/_construtor_template/filtro_campo_externo-form-add.php",
					type: "GET",
					data: "idCampoS="+idCampoSend+"&modS="+modSend+"",
					//dataType: "html",
					success: function(data_form){
						$("#formulario-filtro_campo_externo_"+idCampoSend+"").html(data_form);
					},
				});

			},
		});
	}

}

function remover_filtro_campo_externo_construtor_modulo(idSend,modSend,idCampoSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/filtro_campo_externo-remover.php",
		type: "GET",
		data: "idS="+idSend+"&idCampoS="+idCampoSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/filtro_campo_externo-lista.php",
				type: "GET",
				data: "idCampoS="+idCampoSend+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data_lista){
					$("#lista_"+modSend+"_filtro_campo_externo_"+idCampoSend+"").html(data_lista);
				},
			});

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/filtro_campo_externo-form-add.php",
				type: "GET",
				data: "idCampoS="+idCampoSend+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data_form){
					$("#formulario-filtro_campo_externo_"+idCampoSend+"").html(data_form);
				},
			});

		},
	});

}

function muda_stat_filtro_campo_externo_construtor_modulo(idSend,modSend,statSend,idCampoSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/filtro_campo_externo-stat.php",
		type: "GET",
		data: "idS="+idSend+"&idCampoS="+idCampoSend+"&modS="+modSend+"&statS="+statSend+"",
		//dataType: "html",
		success: function(data){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/filtro_campo_externo-lista.php",
				type: "GET",
				data: "idCampoS="+idCampoSend+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data_lista){
					$("#lista_"+modSend+"_filtro_campo_externo_"+idCampoSend+"").html(data_lista);
				},
			});

		},
	});

}
