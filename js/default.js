function compareDates (date) {
  var parts = date.split('-'); // separa a data pelo caracter '/'
  var today = new Date();      // pega a data atual
  date = new Date(parts[0], parts[1] - 1, parts[2]); // formata 'date'
  // compara se a data informada é maior que a data atual
  // e retorna true ou false
  return date <= today ? true : false
}
function mostra_div_whats() {
	$("#whats_assinado").hide();
	$("#whats_cancelado").hide();
	$("#whats_assinar").fadeIn();
	$("#whatsapp").val("0");
	$("#whatsapp_tipo").val("alterado");
}
function cancela_whats(){
	$("#whats_assinado").hide();
	$("#whats_cancelado").fadeIn();
	$("#whatsapp").val("0");
	$("#whatsapp_tipo").val("cancelado");
}
function fechaBannerFlutuante() {
	$("#BannerFlutuante").hide();
}
function alterarEmail() {
	$("#btn_reenviar").show();
	$("#email").removeAttr("disabled");
}
function mostra_nova_mensagem() {
	$("#nova_mensagem").show();
}
function cancelar_nova_mensagem() {
	$("#nova_mensagem").hide();
}
function nova_mensagem_salvar() {
	if($.trim($("#mensagem").val())=="" ) {
		alert("Você deve inserir um texto no campo 'Mensagem'.");
		$("#mensagem").focus();
	} else {
		$("#nova_mensagem_suporte").submit();
	}
}
function encerrar_chamado() {
	$("#encerrar_suporte").submit();
}
function mostra_chamado(idSend,linkSend) {
	$.fancybox({
		'padding': 0,
		'scrolling'   : 'no',
		'openEffect'	: 'elastic',
		'closeEffect'	: 'elastic',
		'width'			: 1000,
		'height'		: 700,
		'type'			: 'ajax',
		'href'			: 'https:'+linkModelo+'include/chamado-view.php?idS='+idSend+'&link_real_pop='+linkSend+''
	});
}
function mostra_info_ticket(idSend,localSend) {
	$.fancybox({
		'padding':  0,
		'openEffect'	: 'elastic',
		'closeEffect'	: 'elastic',
		'width':    1000,
		'height':   700,
		'type':     'iframe',
		'content':   $("#"+localSend+"_"+idSend+"").show()
	});
	/*$.fancybox({
		'padding': 0,
		'scrolling'   : 'no',
		'openEffect'	: 'elastic',
		'closeEffect'	: 'elastic',
		'width'			: 1000,
		'height'		: 700,
		'type'			: 'ajax',
		'href'			: 'https:'+linkModelo+'include/ticket-view.php?idS='+idSend+''
	});*/
}
function compartilha_ticket(urlSend) {
	$.fancybox({
		'width'            : '75%',
		'height'           : '75%',
		'autoScale'     	: false,
		'transitionIn'     : 'none',
		'transitionOut'    : 'none',
		'type'             : 'iframe'
	});
	/*$.fancybox({
		'padding':  0,
		'openEffect'	: 'elastic',
		'closeEffect'	: 'elastic',
		'width':    1000,
		'height':   700,
		'type':     'iframe',
		'href'			: ''+urlSend+''
	});*/
	/*$.fancybox({
		'padding': 0,
		'scrolling'   : 'no',
		'openEffect'	: 'elastic',
		'closeEffect'	: 'elastic',
		'width'			: 1000,
		'height'		: 700,
		'type'			: 'ajax',
		'href'			: 'https:'+linkModelo+'include/ticket-view.php?idS='+idSend+''
	});*/
}
function le_campo(o){
	v_id  = $(o).attr('id')
    setTimeout("salva_valor_campo_sessao()",1)
}
function salva_valor_campo_sessao() {
	v_val = $("#"+v_id+"").val();
	v_id = v_id;
	$.ajax({
		url: ""+linkModelo+"include/salva-valor-campo-sessao.php",
		type: "GET",
		data: "campoS="+v_id+"&valorS="+v_val+"",
		//dataType: "html",
		success: function(data){
			console.log("["+v_val+"]");
			console.log("["+v_id+"]");
		},
	});
}
function validar_cartao(empresa_idSend,idCardSend) {
	$.ajax({
		url: ""+linkModelo+"include/cartao-carrega-valida-cartao.php",
		type: "GET",
		data: "empresa_idS="+empresa_idSend+"&card_idS="+idCardSend+"",
		//dataType: "html",
		success: function(data){
			window.open(''+linkReal+'validar-cartao/','_self','');
		},
	});
}
function busca_marketplace() {
	if($.trim( $("input[name='busca']").val() )=="" && $.trim( $("select[name='estado']").val() )=="" && $.trim( $("select[name='cidade']").val() )=="") {
		alert("Você precisa escolher ou definir pelo menos 1 parâmetro de busca!");
	} else {
		document.form_busca.submit();
	}
}
function buscaCep() {
	if($.trim( $("input[name='cep']").val() )=="") {
		alert("Para realizar o preenchimento do endereço através do CEP, o campo deve ser preenchido");
		$("input[name='cep']").focus();
	} else {
		$(".preloader_gif").show();
		$.ajax({
			url: ""+linkAdminLib+"include/lib/cep.php",
			type: "GET",
			data: "numeroCep="+$("input[name='cep']").val()+"",
			//dataType: "html",
			success : function(data){
				var retorno = data.split("|");
				$("input[name='rua']").val(""+retorno[1]+"");
				cmpEstado = $("select[name='estado']");
				cmpCidade = $("select[name='cidade']");
				cmpBairro = $("select[name='bairro']");
				$("select[name='estado']").val(""+retorno[4]+"");
				$.ajax({
					url: ""+linkAdminLib+"include/lib/lista-cidades.php",
					type: "GET",
					data: "estadoS="+$("select[name='estado']").val()+"",
					//dataType: "html",
					success: function(data){
						$("select[name='cidade']").html(data);
						$("select[name='cidade']").val(""+retorno[3]+"");
						$.ajax({
							url: ""+linkAdminLib+"include/lib/lista-bairros.php",
							type: "GET",
							data: "cidadeS="+$("select[name='cidade']").val()+"",
							//dataType: "html",
							success: function(data){
								$("select[name='bairro']").html(data);
								$("select[name='bairro']").val(""+retorno[2]+"");
								$(".preloader_gif").fadeOut();
							},
						});
					},
				});
			}
		});
	}
}

function buscaCepId() {
	if($.trim( $("#data_de_nascimento").val() )=="") {
		alert("Sua 'Data de Nascimento' não foi informada!");
		$("#data_de_nascimento").focus();
	} else {
		if($.trim( $("input[name='cep']").val() )=="") {
			alert("Para realizar o preenchimento do endereço através do CEP, o campo deve ser preenchido");
			$("input[name='cep']").focus();
		} else {
			$(".preloader_gif").show();
			$.ajax({
				url: ""+linkAdminLib+"include/lib/cep.php",
				type: "GET",
				data: "numeroCep="+$("input[name='cep']").val()+"",
				//dataType: "html",
				success : function(data){
					var retorno = data.split("|");
					$("input[name='rua']").val(""+retorno[1]+"");
					cmpEstado = $("select[name='estado']");
					cmpCidade = $("select[name='id_cidade']");
					cmpBairro = $("select[name='id_bairro']");
					$("select[name='estado']").val(""+retorno[4]+"");
					$.ajax({
						url: ""+linkAdminLib+"include/lib/lista-cidades.php",
						type: "GET",
						data: "estadoS="+$("select[name='estado']").val()+"",
						//dataType: "html",
						success: function(data_cidade){
							$("select[name='id_cidade']").html(data_cidade);
							$("select[name='id_cidade']").val(""+retorno[3]+"");
							$.ajax({
								url: ""+linkAdminLib+"include/lib/lista-bairros.php",
								type: "GET",
								data: "cidadeS="+$("select[name='id_cidade']").val()+"",
								//dataType: "html",
								success: function(data_bairro){
									$("select[name='id_bairro']").html(data_bairro);
									$("select[name='id_bairro']").val(""+retorno[2]+"");
									$(".preloader_gif").fadeOut();
	
									mostraEventos();
								},
							});
						},
					});
				}
			});
		}
	}
}

function buscaCepPadrao(prefixoSend) {
	if($.trim( $("#"+prefixoSend+"cep").val() )=="") {
		alert("Para realizar o preenchimento do endereço através do CEP, o campo deve ser preenchido");
		$("#"+prefixoSend+"cep").focus();
		return false;
	} else {
		$(".preloader_gif").show();
		$.ajax({
			url: ""+linkAdminLib+"include/lib/cep.php",
			type: "GET",
			data: "numeroCep="+$("#"+prefixoSend+"cep").val()+"",
			//dataType: "html",
			success : function(data){
				var retorno = data.split("|");
				$("#"+prefixoSend+"rua").val(""+retorno[1]+"");
				cmpEstado = $("#"+prefixoSend+"estado");
				cmpCidade = $("#"+prefixoSend+"cidade");
				cmpBairro = $("#"+prefixoSend+"bairro");
				$("#"+prefixoSend+"estado").val(""+retorno[4]+"");
				$.ajax({
					url: ""+linkAdminLib+"include/lib/lista-cidades.php",
					type: "GET",
					data: "estadoS="+$("#"+prefixoSend+"estado").val()+"",
					//dataType: "html",
					success: function(data_cidade){
						$("#"+prefixoSend+"cidade").html(data_cidade);
						$("#"+prefixoSend+"cidade").val(""+retorno[3]+"");
						$.ajax({
							url: ""+linkAdminLib+"include/lib/lista-bairros.php",
							type: "GET",
							data: "cidadeS="+$("#"+prefixoSend+"cidade").val()+"",
							//dataType: "html",
							success: function(data_bairro){
								$("#"+prefixoSend+"bairro").html(data_bairro);
								$("#"+prefixoSend+"bairro").val(""+retorno[2]+"");
								$(".preloader_gif").fadeOut();
							},
						});
					},
				});
			}
		});
	}
}

function buscaCepEmpresa() {
	if($.trim( $("input[name='cep']").val() )=="") {
		alert("Para realizar o preenchimento do endereço através do CEP, o campo deve ser preenchido");
		$("input[name='cep']").focus();
		return false;
	} else {
		$(".preloader_gif").show();
		$.ajax({
			url: ""+linkAdminLib+"include/lib/cep_empresa.php",
			type: "GET",
			data: "empresaS="+$("#empresa_id").val()+"&numeroCepS="+$("input[name='cep']").val()+"",
			//dataType: "html",
			success : function(data){
				if($.trim(data)=="NAO") {
					$('#modal_cep_fora_regiao').modal('show');
					$("#cep_fora_regiao_informado").html($("input[name='cep']").val());
				} else {
					var retorno = data.split("||");
					$("input[name='rua']").val(""+retorno[1]+"");
					$("select[name='id_bairro']").val(""+retorno[2]+"");
					mostraEventos();
				}
			}
		});
	}
}

function buscaEnderecoCadastro() {
	if($.trim($("#usuario_cep").val())=="") {
	} else {
		$.ajax({
			url: ""+linkModelo+"include/busca-endereco-cadastro.php",
			type: "GET",
			data: "usuario_idS="+$("#usuario_id").val()+"",
			//dataType: "html",
			success: function(data){
				console.log("["+data+"]");
				var retorno = data.split("||");
				$("#cep").val(""+$("#usuario_cep").val()+"");
				$( ".bota_busca_cep" ).trigger( "click" );
				$("#rua").val(""+retorno[1]+"");
				$("#numero").val(""+retorno[2]+"");
				$("#complemento").val(""+retorno[3]+"");
			},
		});
	}
}
function mostraCidades() {
	$("select[name='cidade']").html("<option value=''>Carregando...</option>");
	$.ajax({
		url: ""+linkAdminLib+"include/lib/lista-cidades.php",
		type: "GET",
		data: "estadoS="+$("select[name='estado']").val()+"",
		//dataType: "html",
		success: function(data){
			$("select[name='cidade']").html(data);
		},
	});
}
function mostraCidadesId() {
	$("select[name='id_cidade']").html("<option value=''>Carregando...</option>");
	$.ajax({
		url: ""+linkAdminLib+"include/lib/lista-cidades.php",
		type: "GET",
		data: "estadoS="+$("select[name='estado']").val()+"",
		//dataType: "html",
		success: function(data){
			$("select[name='id_cidade']").html(data);
		},
	});
}
function mostraBairros() {
	$("select[name='bairro']").html("<option value=''>Carregando...</option>");
	$.ajax({
		url: ""+linkAdminLib+"include/lib/lista-bairros_string.php",
		type: "GET",
		data: "cidadeS="+$("select[name='cidade']").val()+"",
		//dataType: "html",
		success: function(data){
			$("select[name='bairro']").html(data);
		},
	});
}
function mostraBairrosId() {
	$("select[name='id_bairro']").html("<option value=''>Carregando...</option>");
	$.ajax({
		url: ""+linkAdminLib+"include/lib/lista-bairros_string.php",
		type: "GET",
		data: "cidadeS="+$("select[name='id_cidade']").val()+"",
		//dataType: "html",
		success: function(data){
			$("select[name='id_bairro']").html(data);
		},
	});
}

function buscaCepTxt() {
	if($.trim( $("#cep").val() )=="") {
		alert("Para realizar o preenchimento do endereço através do CEP, o campo deve ser preenchido");
		$("#cep").focus();
	} else {
		$(".preloader_gif").show();
		$.ajax({
			url: ""+linkAdminLib+"include/lib/cepTxt.php",
			type: "GET",
			data: "numeroCep="+$("#cep").val()+"",
			//dataType: "html",
			success : function(data){
				var retorno = data.split("|");
				$("#rua").val(""+retorno[1]+"");
				cmpEstado = $("#estado");
				cmpCidade = $("#cidade");
				cmpBairro = $("#bairro");
				$("#estado").val(""+retorno[4]+"");
				$.ajax({
					url: ""+linkAdminLib+"include/lib/lista-cidadesTxt.php",
					type: "GET",
					data: "estadoS="+$("#estado").val()+"",
					//dataType: "html",
					success: function(data){
						$("#cidade").html(data);
						$("#cidade").val(""+retorno[3]+"");
						$.ajax({
							url: ""+linkAdminLib+"include/lib/lista-bairrosTxt.php",
							type: "GET",
							data: "cidadeS="+$("#cidade").val()+"",
							//dataType: "html",
							success: function(data){
								$("#bairro").html(data);
								$("#bairro").val(""+retorno[2]+"");
								$(".preloader_gif").fadeOut();
							},
						});
					},
				});
			}
		});
	}
}
function mostraCidadesTxt() {
	$("#cidade").html("<option value=''>Cidade</option>");
	$.ajax({
		url: ""+linkAdminLib+"include/lib/lista-cidadesTxt.php",
		type: "GET",
		data: "estadoS="+$("#estado").val()+"",
		//dataType: "html",
		success: function(data){
			$("#cidade").html(data);
		},
	});
}
function mostraBairrosTxt() {
	$("#bairro").html("<option value=''>Carregando...</option>");
	$.ajax({
		url: ""+linkAdminLib+"include/lib/lista-bairrosTxt.php",
		type: "GET",
		data: "cidadeS="+$("#cidade").val()+"",
		//dataType: "html",
		success: function(data){
			$("#bairro").html(data);
		},
	});
}
	if($(".btn_fechar").length) {
		$( ".btn_fechar" ).click(function() {
			window.open(''+linkReal+'','_self','');
		});
	}

	$.mask.definitions['~']='[+-]';
	if($("#telefone_principal").length) {
		$('#telefone_principal').focusout(function(){
			var phone, element;
			element = $(this);
			element.unmask();
			phone = element.val().replace(/\D/g, '');
			element.mask("(99) 9999-9999");
			/*
			if(phone.length > 10) {
				element.mask("(99) 9999-999?9");
			} else {
				element.mask("(99) 9999-9999?9");
			}
			*/
		}).trigger('focusout');
	}
	if($("#telefone_celular").length) {
		$('#telefone_celular').focusout(function(){
			var phone, element;
			element = $(this);
			element.unmask();
			phone = element.val().replace(/\D/g, '');
			if(phone.length > 10) {
				element.mask("(99) 99999-999?9");
			} else {
				element.mask("(99) 9999-9999?9");
			}
		}).trigger('focusout');
	}
	if($("#telefone_atualizacao").length) {
		$('#telefone_atualizacao').focusout(function(){
			var phone, element;
			element = $(this);
			element.unmask();
			phone = element.val().replace(/\D/g, '');
			if(phone.length > 10) {
				element.mask("(99) 99999-999?9");
			} else {
				element.mask("(99) 9999-9999?9");
			}
		}).trigger('focusout');
	}
	if($("#data_de_nascimento").length) {
		//$("#data_de_nascimento").mask("99/99/9999");
	}
	function sem_acento(e,args) {
		if (document.all){
			var evt=event.keyCode;
		} else {
			var evt = e.charCode;
		}
		var valid_chars = '0123456789abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYK-_/@.'+args;      // criando a lista de teclas permitidas
		var chr= String.fromCharCode(evt);      // pegando a tecla digitada
		if (valid_chars.indexOf(chr)>-1 ){return true;} // se a tecla estiver na lista de permissão permite-a
		// para permitir teclas como <BACKSPACE> adicionamos uma permissão para
		// códigos de tecla menores que 09 por exemplo (geralmente uso menores que 20)
		if (valid_chars.indexOf(chr)>-1 || evt < 9){return true;}
		if (valid_chars.indexOf(chr)>30 || evt <35){return true;} //permite a tecla espaço
		return false;   // do contrário nega
	}
	function mascara_manual(VALOR,MASCARA) {
		//var kcode = (window.event) ? evt.keyCode : evt.which;
		/*
		if(navigator.appName == "Netscape") {
			kcode = event.charCode; //or e.which; (standard method)
		} else {
			kcode = event.keyCode;
		}*/
		var evt = window.event;
		kcode = evt.keyCode;
		if (kcode == 8) return;
		if(MASCARA=="CPF") {
			if (VALOR.value.length == 3) { VALOR.value = VALOR.value + '.'; }
			if (VALOR.value.length == 7) { VALOR.value = VALOR.value + '.'; }
			if (VALOR.value.length == 11) { VALOR.value = VALOR.value + '-'; }
		} else {
			if(MASCARA=="DATA") {
				if (VALOR.value.length == 2) { VALOR.value = VALOR.value + '/'; }
				if (VALOR.value.length == 5) { VALOR.value = VALOR.value + '/'; }
			} else {
				if(MASCARA=="CEL") {
					if (VALOR.value.length == 1) { VALOR.value =  '(' + VALOR.value; }
					if (VALOR.value.length == 3) { VALOR.value = VALOR.value + ') '; }
					if (VALOR.value.length == 10) { VALOR.value = VALOR.value + '.'; }
				} else {
					if(MASCARA=="RES") {
						if (VALOR.value.length == 1) { VALOR.value =  '(' + VALOR.value; }
						if (VALOR.value.length == 3) { VALOR.value = VALOR.value + ') '; }
						if (VALOR.value.length == 9) { VALOR.value = VALOR.value + '.'; }
					} else {
						if(MASCARA=="CEP") {
							if (VALOR.value.length == 5) { VALOR.value = VALOR.value + '-'; }
						} else {
							if(MASCARA=="CARTAO_CRED") {
								if (VALOR.value.length == 4) { VALOR.value = VALOR.value + '.'; }
								if (VALOR.value.length == 5) { VALOR.value = VALOR.value + '.'; }
								if (VALOR.value.length == 10) { VALOR.value = VALOR.value + '.'; }
								if (VALOR.value.length == 14) { VALOR.value = VALOR.value + '.'; }
							} else {
							}
						}
					}
				}
			}
		}
	}
 	if($("#cpf").length) {
		//$("#cpf").mask("999.999.999-99");
	}
	if($("#cpf_login").length) {
		//$("#cpf_login").mask("999.999.999-99");
	}
	if($("#cpf_esqueceu").length) {
		//$("#cpf_esqueceu").mask("999.999.999-99");
	}
	if($(".mascara_cpf").length) {
		//$(".mascara_cpf").mask("999.999.999-99");
	}
	if($("#cep").length) {
		//$("#cep").mask("99999-999");
	}

	function validarLogin(campo) {
		var valor_enviado = $("#"+campo+"").val();
		//valor_enviado.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
		var regra = /^[0-9]+$/;
		if (valor_enviado.length == 11 && valor_enviado.match(regra)) {
			valor_enviado=valor_enviado.replace(/\D/g,"");
			valor_enviado=valor_enviado.replace(/(\d{3})(\d)/,"$1.$2");
			valor_enviado=valor_enviado.replace(/(\d{3})(\d)/,"$1.$2");
			valor_enviado=valor_enviado.replace(/(\d{3})(\d{1,2})$/,"$1-$2");
			
			var retorno_validacao = verificaCpf(valor_enviado);
			if(retorno_validacao===true) {
				$("#"+campo+"_valido").val("1");
				$("#DIV_"+campo+"_valido_txt").html("CPF");
				$("#DIV_"+campo+"_invalido_txt").html("CPF");
				$("#DIV_"+campo+"_invalido").hide();
				$("#DIV_"+campo+"_valido").fadeIn();
				return true;
			} else {
				$("#"+campo+"_valido").val("0");
				$("#DIV_"+campo+"_valido_txt").html("CPF");
				$("#DIV_"+campo+"_invalido_txt").html("CPF");
				$("#DIV_"+campo+"_valido").hide();
				$("#DIV_"+campo+"_invalido").fadeIn();
				return false;
			}
		} else {
			usuario = $("#"+campo+"").val().substring(0, $("#"+campo+"").val().indexOf("@"));
			dominio = $("#"+campo+"").val().substring($("#"+campo+"").val().indexOf("@")+ 1, $("#"+campo+"").val().length);
			if ((usuario.length >=1) &&
				(dominio.length >=3) &&
				(usuario.search("@")==-1) &&
				(dominio.search("@")==-1) &&
				(usuario.search(" ")==-1) &&
				(dominio.search(" ")==-1) &&
				(dominio.search(".")!=-1) &&
				(dominio.indexOf(".") >=1)&&
				(dominio.lastIndexOf(".") < dominio.length - 1)) {
					$("#"+campo+"_valido").val("1");
					$("#DIV_"+campo+"_valido_txt").html("E-mail");
					$("#DIV_"+campo+"_invalido_txt").html("E-mail");
					$("#DIV_"+campo+"_invalido").hide();
					$("#DIV_"+campo+"_valido").fadeIn();
					return true;
			} else {
				$("#"+campo+"_valido").val("0");
				$("#DIV_"+campo+"_valido_txt").html("E-mail");
				$("#DIV_"+campo+"_invalido_txt").html("E-mail");
				$("#DIV_"+campo+"_valido").hide();
				$("#DIV_"+campo+"_invalido").fadeIn();
				return false;
			}
		}
	}

	function validarSenha(campo){
		var alphaExp = /^[a-zA-Z-0-9]+$/;
		if($("#"+campo+"").val().match(alphaExp)){
			$("#"+campo+"_valido").val("1");
			$("#DIV_"+campo+"_invalido").hide();
			$("#DIV_"+campo+"_valido").fadeIn();
			return true;
		} else {
			$("#"+campo+"_valido").val("0");
			$("#DIV_"+campo+"_valido").hide();
			$("#DIV_"+campo+"_invalido").fadeIn();
			return false;
		}
	}

	function validarEmail(campo) {
		usuario = $("#"+campo+"").val().substring(0, $("#"+campo+"").val().indexOf("@"));
		dominio = $("#"+campo+"").val().substring($("#"+campo+"").val().indexOf("@")+ 1, $("#"+campo+"").val().length);
		if ((usuario.length >=1) &&
			(dominio.length >=3) &&
			(usuario.search("@")==-1) &&
			(dominio.search("@")==-1) &&
			(usuario.search(" ")==-1) &&
			(dominio.search(" ")==-1) &&
			(dominio.search(".")!=-1) &&
			(dominio.indexOf(".") >=1)&&
			(dominio.lastIndexOf(".") < dominio.length - 1)) {
				$("#"+campo+"_valido").val("1");
				$("#DIV_"+campo+"_invalido").hide();
				$("#DIV_"+campo+"_valido").fadeIn();
				return true;
		} else {
			$("#"+campo+"_valido").val("0");
			$("#DIV_"+campo+"_valido").hide();
			$("#DIV_"+campo+"_invalido").fadeIn();
			return false;
		}
	}

	function verificaCpf(cpf) {
		cpf = cpf.replace(/[^\d]+/g,'');
		if(cpf == '') return false;
		// Elimina CPFs invalidos conhecidos
		if (cpf.length != 11 ||
			cpf == "00000000000" ||
			cpf == "11111111111" ||
			cpf == "22222222222" ||
			cpf == "33333333333" ||
			cpf == "44444444444" ||
			cpf == "55555555555" ||
			cpf == "66666666666" ||
			cpf == "77777777777" ||
			cpf == "88888888888" ||
			cpf == "99999999999")
				return false;
		// Valida 1o digito
		add = 0;
		for (i=0; i < 9; i ++)
			add += parseInt(cpf.charAt(i)) * (10 - i);
			rev = 11 - (add % 11);
			if (rev == 10 || rev == 11)
				rev = 0;
			if (rev != parseInt(cpf.charAt(9)))
				return false;
		// Valida 2o digito
		add = 0;
		for (i = 0; i < 10; i ++)
			add += parseInt(cpf.charAt(i)) * (11 - i);
		rev = 11 - (add % 11);
		if (rev == 10 || rev == 11)
			rev = 0;
		if (rev != parseInt(cpf.charAt(10)))
			return false;
		return true;
	}

	function validarDataDeNascimento(campo) {
		var valor_enviado = $("#"+campo+"").val();
		// Verificar se o formato da data digitada está correto		
		var patternData = /^(((0[1-9]|[12][0-9]|3[01])([-.\/])(0[13578]|10|12)([-.\/])(\d{4}))|(([0][1-9]|[12][0-9]|30)([-.\/])(0[469]|11)([-.\/])(\d{4}))|((0[1-9]|1[0-9]|2[0-8])([-.\/])(02)([-.\/])(\d{4}))|((29)(\.|-|\/)(02)([-.\/])([02468][048]00))|((29)([-.\/])(02)([-.\/])([13579][26]00))|((29)([-.\/])(02)([-.\/])([0-9][0-9][0][48]))|((29)([-.\/])(02)([-.\/])([0-9][0-9][2468][048]))|((29)([-.\/])(02)([-.\/])([0-9][0-9][13579][26])))$/;
		if(!patternData.test(valor_enviado)){
			$("#"+campo+"_valido").val("0");
			$("#DIV_"+campo+"_valido").hide();
			$("#DIV_"+campo+"_invalido").fadeIn();
			return false;
		} else {
			$("#"+campo+"").val(valor_enviado);
			$("#"+campo+"_valido").val("1");
			$("#DIV_"+campo+"_invalido").hide();
			$("#DIV_"+campo+"_valido").fadeIn();
			return true;
		}
	}

	function validarCpf(campo) {
		var valor_enviado = $("#"+campo+"").val();
		valor_enviado = valor_enviado.replace(/[^\d]+/g,'');
		//valor_enviado.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
		var regra = /^[0-9]+$/;
		if (valor_enviado.length == 11) {
			valor_enviado=valor_enviado.replace(/\D/g,"");
			valor_enviado=valor_enviado.replace(/(\d{3})(\d)/,"$1.$2");
			valor_enviado=valor_enviado.replace(/(\d{3})(\d)/,"$1.$2");
			valor_enviado=valor_enviado.replace(/(\d{3})(\d{1,2})$/,"$1-$2");
			
			var retorno_validacao = verificaCpf(valor_enviado);
			if(retorno_validacao===true) {
				$("#"+campo+"_valido").val("1");
				$("#DIV_"+campo+"_invalido").hide();
				$("#DIV_"+campo+"_valido").fadeIn();
				return true;
			} else {
				$("#"+campo+"_valido").val("0");
				$("#DIV_"+campo+"_valido").hide();
				$("#DIV_"+campo+"_invalido").fadeIn();
				return false;
			}
		} else {
			$("#"+campo+"_valido").val("0");
			$("#DIV_"+campo+"_valido").hide();
			$("#DIV_"+campo+"_invalido").fadeIn();
			return false;
		}
	}

	function validarPessoa(campo,campoNome,campoEmail,campoWhatsapp) {
		var valor_enviado = $("#"+campo+"").val();
		valor_enviado = valor_enviado.replace(/[^\d]+/g,'');

		if (event.keyCode) {
			var limite_length = 10;
		} else {
			var limite_length = 11;
		}
		console.log("valor_enviado:"+valor_enviado.length);
		$("#"+campoNome+"").val("");
		$("#"+campoEmail+"").val("");
		$("#"+campoWhatsapp+"").val("");
		if (valor_enviado.length==limite_length) {
			if(validarCpf(campo)) {
				$.ajax({
					url: ""+linkAdminLib+"webservice-app/valida-pessoa.php",
					type: "GET",
					data: "empresaS="+$("#empresa_id").val()+"&numeroS="+valor_enviado+"",
					//dataType: "html",
					success: function(data){
						var retorno = JSON.parse(data);
						if($.trim(retorno["valido"])=="SIM") {
							$("#"+campo+"_valido").val("1");
							$("#DIV_"+campo+"_invalido").fadeOut();
							$("#DIV_"+campo+"_valido").fadeIn();
							$("#"+campoNome+"").val(""+retorno["nome"]+"");
							$("#"+campoEmail+"").val(""+retorno["email"]+"");
							$("#"+campoWhatsapp+"").val(""+retorno["whatsapp"]+"");
							return true;
						} else {
							$("#"+campo+"_valido").val("0");
							$("#DIV_"+campo+"_valido").fadeOut();
							$("#DIV_"+campo+"_invalido").fadeIn();
							return false;
						}
					},
				});
			}
		} else {
			$("#"+campo+"_valido").val("0");
			$("#DIV_"+campo+"_valido").fadeOut();
			$("#DIV_"+campo+"_invalido").fadeIn();
			return false;
		}
	}

	function mostra_ticket_data(idSend) {
		$(".lista_data").hide();
		$("#data_"+idSend+"").fadeIn();
		$(".bullets_data").css({ "color": "#333","background-color": "#FFF" });
		$("#bullet_data_"+idSend+"").css({ "color": "#FFF","background-color": "#333" });
	}

	function verificandoImagem() {
		var path = $("#imagem").val();
		var idx = (~-path.lastIndexOf(".") >>> 0) + 2;
		var ext = path.substr((path.lastIndexOf("/") - idx > -3 ? -1 >>> 0 : idx));
		ext = ext.toLowerCase();
		if(ext == "jpg" || ext == "jpeg" || ext == "gif" || ext == "png" || ext == "bmp") {
			$("#erro_imagem").hide().html("");
		} else {
			$("#erro_imagem").fadeIn().html("Permitido envio apenas de imagens");
			$("#imagem").val("");
			$("#imagem").focus();
			return;
		}
	}


	$( ".menos" ).click(function() {
		var valor_atual =  $(this).next('.quantity-number').val();
		var ref = $(this).attr("ref");
		var ref = ref.replace("menos_", "");
		if(valor_atual==0) { 
			$("#comprar_ingresso_flutuante").hide();
		} else {
			valor_atual = parseInt(valor_atual) - 1;
			$(this).next('.quantity-number').val(""+valor_atual+"");
			$("#"+ref+"").val(""+valor_atual+"");
			controle_comprar_ingresso_flutuante("menos",$("#"+ref+"").attr("valor"));
		}

	});
	$( ".mais" ).click(function() {
		var valor_atual =  $(this).prev('.quantity-number').val();
		var ref = $(this).attr("ref");
		var ref = ref.replace("mais_", "");
		valor_atual = parseInt(valor_atual) + 1;
		$(this).prev('.quantity-number').val(""+valor_atual+"");
		$("#"+ref+"").val(""+valor_atual+"");

		controle_comprar_ingresso_flutuante("mais",$("#"+ref+"").attr("valor"));
	});
	$( ".menos_market" ).click(function() {
		var ref = $(this).attr("ref");
		var ref = ref.replace("menos_", "");
		if(valor_atual==0) { } else {
			valor_atual = parseInt($("#"+ref+"").val()) - 1;
			$("#"+ref+"").val(""+valor_atual+"");
		}
	});
	$( ".mais_market" ).click(function() {
		var ref = $(this).attr("ref");
		var ref = ref.replace("mais_", "");
		valor_atual = parseInt($("#"+ref+"").val()) + 1;
		$("#"+ref+"").val(""+valor_atual+"");
	});
