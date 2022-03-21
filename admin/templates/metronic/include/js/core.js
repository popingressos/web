//function trim(str){return str.replace(/^\s+|\s+$/g,"");}

function html_to_string(stringSend) {

	var valor_set = stringSend;
	for (i = 0; i < 1000; i++) {
		valor_set = valor_set.replace("&",   "@ecom@");
		valor_set = valor_set.replace("%20", "@espaco@");
		valor_set = valor_set.replace("#",   "@hash@");
		valor_set = valor_set.replace("\"",  "@aspas_dupla@");
		valor_set = valor_set.replace("'",   "@aspas_simples@");
		valor_set = valor_set.replace("?",   "@interrogacao@");
		valor_set = valor_set.replace("<",   "@menor@");
		valor_set = valor_set.replace(">",   "@maior@");
		valor_set = valor_set.replace("&",   "@ecomercial@");
		valor_set = valor_set.replace(",",   "@virgula@");
		valor_set = valor_set.replace(";",   "@ponto_virgula@");
		valor_set = valor_set.replace(":",   "@dois_pontos@");
		valor_set = valor_set.replace("{",   "@chaves_abre@");
		valor_set = valor_set.replace("}",   "@chaves_fecha@");
		valor_set = valor_set.replace("[",   "@colchetes_abre@");
		valor_set = valor_set.replace("]",   "@colchetes_fecha@");
		valor_set = valor_set.replace("(",   "@parenteses_abre@");
		valor_set = valor_set.replace(")",   "@parenteses_fecha@");
		valor_set = valor_set.replace("/",   "@barra@");
		valor_set = valor_set.replace("\\",  "@barra_invertida@");
		valor_set = valor_set.replace("=",   "@igual@");
		valor_set = valor_set.replace("-",   "@menos@");
		valor_set = valor_set.replace("+",   "@mais@");
		valor_set = valor_set.replace("$",   "@cifrao@");
	}
	return valor_set;

}

function submita_empresa() {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/comissario/seta-empresa.php",
		type: "GET",
		data: "empresa_setS="+$("#empresa_set").val()+"",
		//dataType: "html",
		success: function(data_url){
			location.reload();
		},
	});
}

function str_replace(search, replace, subject, count) {
  //  discuss at: http://phpjs.org/functions/str_replace/
  // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Gabriel Paderni
  // improved by: Philip Peterson
  // improved by: Simon Willison (http://simonwillison.net)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Onno Marsman
  // improved by: Brett Zamir (http://brett-zamir.me)
  //  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  // bugfixed by: Anton Ongson
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Oleg Eremeev
  //    input by: Onno Marsman
  //    input by: Brett Zamir (http://brett-zamir.me)
  //    input by: Oleg Eremeev
  //        note: The count parameter must be passed as a string in order
  //        note: to find a global variable in which the result will be given
  //   example 1: str_replace(' ', '.', 'Kevin van Zonneveld');
  //   returns 1: 'Kevin.van.Zonneveld'
  //   example 2: str_replace(['{name}', 'l'], ['hello', 'm'], '{name}, lars');
  //   returns 2: 'hemmo, mars'

  var i = 0,
    j = 0,
    temp = '',
    repl = '',
    sl = 0,
    fl = 0,
    f = [].concat(search),
    r = [].concat(replace),
    s = subject,
    ra = Object.prototype.toString.call(r) === '[object Array]',
    sa = Object.prototype.toString.call(s) === '[object Array]';
  s = [].concat(s);
  if (count) {
    this.window[count] = 0;
  }

  for (i = 0, sl = s.length; i < sl; i++) {
    if (s[i] === '') {
      continue;
    }
    for (j = 0, fl = f.length; j < fl; j++) {
      temp = s[i] + '';
      repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
      s[i] = (temp)
        .split(f[j])
        .join(repl);
      if (count && s[i] !== temp) {
        this.window[count] += (temp.length - s[i].length) / f[j].length;
      }
    }
  }
  return sa ? s : s[0];
}

var tempo = new Number();
// Tempo da sessão em segundos
tempo = 3600;

function btn_cancelar() {
	/*
	event.preventDefault();
    history.back(1);
	*/

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/url_anterior.php",
		type: "GET",
		data: "",
		//dataType: "html",
		success: function(data_url){
			//alert(data_url);
			for (i = 0; i < 10; i++) {
				data_url = data_url.replace("|", "");
			}
			
			window.open(''+data_url+'','_self','');
		},
	});

}


function logout() {
	document.form_logout.submit();
}

function preloaderIn() {
	$(".preloader-back").show();
	$(".page-spinner-bar-water").show();
	$(".page-spinner-bar").show();
}

function preloaderOut() {
	$(".page-spinner-bar").fadeOut();
	$(".page-spinner-bar-water").fadeOut();
	$(".preloader-back").fadeOut();
}

function parent_preloaderIn() {
	$(".preloader-back").parent().show();
	$(".page-spinner-bar-water").parent().show();
	$(".page-spinner-bar").parent().show();
}

function parent_preloaderOut() {
	parent.$(".page-spinner-bar").fadeOut();
	parent.$(".page-spinner-bar-water").fadeOut();
	parent.$(".preloader-back").fadeOut();
}

toastr.options = {
	closeButton: true,
	debug: false,
	positionClass: 'toast-top-center',
	showDuration: '1000',
	hideDuration: '1000',
	timeOut: '5000',
	extendedTimeOut: '1000',
	showEasing: 'swing',
	hideEasing: 'linear',
	showMethod: 'fadeIn',
	hideMethod: 'fadeOut',
	onclick: null
};


function startCountdown(){

	// Se o tempo não for zerado
	if((tempo - 1) >= 0){

		// Pega a parte inteira dos minutos
		var min = parseInt(tempo/60);
		// Calcula os segundos restantes
		var seg = tempo%60;

		// Formata o número menor que dez, ex: 08, 07, ...
		if(min < 10){
			min = "0"+min;
			min = min.substr(0, 2);
		}
		if(seg <=9){
			seg = "0"+seg;
		}

		// Cria a variável para formatar no estilo hora/cronômetro
		//horaImprimivel = '00:' + min + ':' + seg;
		horaImprimivel = "" + min + ":" + seg +"";
		//JQuery pra setar o valor
		$("#relogio-sessao").html(horaImprimivel);

		// Define que a função será executada novamente em 1000ms = 1 segundo
		setTimeout('startCountdown()',1000);

		// diminui o tempo
		tempo--;

	// Quando o contador chegar a zero faz esta ação
	} else {
		$( "#botão_expirou" ).trigger( "click" );
		//window.open(""+linkSite_Cliente+"admin/sessao-expirada/", "_self","");
	}

}

// Chama a função ao carregar a tela
startCountdown();

function PrintDiv(div) {
	$('#'+div).printElement();
}

function seta_aba(abaSend){

	$("#aba").val(abaSend);

}

function pesquisa_admin() {
	cmpProcura = document.getElementById("idprocura");

	if($.trim(cmpProcura.value)=="") {
		alert("O campo 'Procurar...' deve ser preenchido");
		cmpProcura.focus();
	} else {
		document.procura_admin.submit();
	}
}

function limpa_timeline() {
	cmpProcura = document.getElementById("idprocura");

	cmpProcura.value = "";
	document.procura_admin.submit();
}

function report_view(idSend) {

	$.fancybox({
		'padding': 0,
		'scrolling'   : 'no',
		'openEffect'	: 'elastic',
		'closeEffect'	: 'elastic',
		'width'			: 1000,
		'height'		: 700,
		'type'			: 'ajax',
		'href'			: ''+linkAdminAcoes+'acoes/report_de_erros/report-view.php?idS='+idSend+''
	});
	
	renova_badges();

}

function renova_badges_report() {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/report_de_erros/controle-badges.php",
		type: "GET",
		data: "",
		//dataType: "html",
		success: function(data_retorna){

			$("#controle_badges_report_de_erros").html(data_retorna);

		},
	});

}

function seta_altera_campo() {
	$("#campos_alterados").val("1");
}

function marcar_como_resolvido(idSend) {
	
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/report_de_erros/marcar-como-resolvido.php",
		type: "GET",
		data: "idS="+idSend+"",
		//dataType: "html",
		success: function(data_retorna){

			parent.jQuery.fancybox.close();
			renova_badges_report();

		},
	});

}

function evento_view(idSend) {

	$.fancybox({
		'padding': 0,
		'scrolling'   : 'no',
		'openEffect'	: 'elastic',
		'closeEffect'	: 'elastic',
		'width'			: 1000,
		'height'		: 700,
		'type'			: 'ajax',
		'href'			: ''+linkAdminAcoes+'acoes/syscalendario/evento-view.php?idS='+idSend+''
	});
	
	renova_badges();

}

function renova_badges() {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/syscalendario/controle-badges.php",
		type: "GET",
		data: "",
		//dataType: "html",
		success: function(data_retorna){

			$("#controle_badges").html(data_retorna);

		},
	});

}

function marcar_como_nao_lida(idSend) {
	
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/syscalendario/marcar-como-nao-lida.php",
		type: "GET",
		data: "idS="+idSend+"",
		//dataType: "html",
		success: function(data_retorna){

			parent.jQuery.fancybox.close();
			renova_badges();

		},
	});

}

function filtra_timeline() {
	$("#inicio_time").val("0");

	$.ajax({
		url: ""+linkAdminAcoes+"mod/sys_arquivo/list-list.php",
		type: "GET",
		data: "tipoS="+$("#tipo").val()+"&data_deS="+$("#data_de").val()+"&data_ateS="+$("#data_ate").val()+"&palavra_chaveS="+$("#palavra_chave").val()+"",
		//dataType: "html",
		success: function(data){

			$(".timeline-item").html(data);

		},
	});
}

function mostra_mais_timeline() {

	$("#btn_mostrar_mais").hide();
	$("#btn_carregando").fadeIn();
	
	var valor_ini = $("#inicio_time").val();
	var valor_ini_set = parseInt(valor_ini) + 10;
	$("#inicio_time").val(""+valor_ini_set+"");

	$.ajax({
		url: ""+linkAdminAcoes+"mod/sys_arquivo/list-list.php",
		type: "GET",
		data: "inicioTimeS="+$("#inicio_time").val()+"&tipoS="+$("#tipo").val()+"&data_deS="+$("#data_de").val()+"&data_ateS="+$("#data_ate").val()+"&palavra_chaveS="+$("#palavra_chave").val()+"",
		//dataType: "html",
		success: function(data){

			$("#btn_carregando").hide();
			$("#btn_mostrar_mais").fadeIn();
			
			$(".timeline-item").append(data);

		},
	});
}

function submitarEnter(chaveSend,modSend,tbLocalSend,e) {
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;

	if (keycode == 13) {
		busca_simples(chaveSend,modSend,tbLocalSend);
		return false;
	} else { 
		return true;
	}
}

function submitarEnterIrPara(chaveSend,modSend,limitSend,filtroSend,tbLocalSend,e) {
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;

	if (keycode == 13) {
		paginacao_ir_para(chaveSend,modSend,limitSend,filtroSend,tbLocalSend);
		return false;
	} else { 
		return true;
	}
}

function seta_busca_simples(valorSend) {
	$("#busca").val(""+valorSend+"");
}

function paginacao_ir_para(chaveSend,modSend,limitSend,filtroSend,tbLocalSend) {
	if($.trim($("#ir_para").val())=="") { } else {
		var page_set = $("#ir_para").val();
		var inicio_set = parseInt(limitSend) * parseInt(page_set-1);
		paginacao_controle(''+chaveSend+'',''+page_set+'',''+inicio_set+'',''+modSend+'',''+limitSend+'',''+filtroSend+'',''+tbLocalSend+'');
	}
}

function atualiza_selecionados() {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/atualiza-selecionados.php",
		type: "GET",
		cache: false,
		data: "ids_selecionados="+$("#lista_checkboxes").val()+"",
		//dataType: "html",
		success: function(data){
		},
	});
}

function paginacao(paginaSend,modSend,acoesSend) {
	preloaderIn();
	var url_atual = window.location.href;
	
	var n = url_atual.indexOf("pagina/");
	var n2 = url_atual.lastIndexOf("/");
	var resto = parseInt(n2) - (parseInt(n2) - parseInt(n));
	var res = url_atual.substr(0, resto);

	window.history.pushState("object or string", "Title", ""+res+"pagina/"+paginaSend+"/");

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/"+acoesSend+"/tabela-tbody-"+modSend+".php",
		type: "GET",
		cache: false,
		data: "pagina="+paginaSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			$("#datatable_ajax_tbody").html(data);
			preloaderOut();
			Metronic.init();
		},
	});
}

function paginacao_controle(chaveSend,pageSend,inicioSend,modSend,limitSend,filtroSend,tbLocalSend,sufixoSend) {

	if(sufixoSend=="usuario_carrinho" || sufixoSend=="usuario_carrinho_dashboard_elastic") { 
		numeroUnico_eventos_set = "&numeroUnico_eventosS="+$("#numeroUnico_eventos").val()+"";
	} else {
		var url_atual = window.location.href;
		
		var n = url_atual.indexOf("pagina/");
		var n2 = url_atual.lastIndexOf("/");
		var resto = parseInt(n2) - (parseInt(n2) - parseInt(n));
		var res = url_atual.substr(0, resto);
	
		window.history.pushState("object or string", "Title", ""+res+"pagina/"+pageSend+"/");
		
		numeroUnico_eventos_set = "";
	}
	
	preloaderIn();

	if(sufixoSend=="usuario_carrinho") { 
		var local_set = "usuario";
		var sufixo_set = "-"+sufixoSend+"";

	} else if(
			sufixoSend=="alunos"||
			sufixoSend=="pessoas"||
			sufixoSend=="fornecedores"||
			sufixoSend=="planos_e_pacotes"||
			sufixoSend=="produtos"||
			sufixoSend=="matriculas"||
			sufixoSend=="vendas"||
			sufixoSend=="tipos_de_movimentacao"||
			sufixoSend=="tipos_de_cobranca"||
			sufixoSend=="tipos_de_pagamento"||
			sufixoSend=="contas_a_pagar"||
			sufixoSend=="contas_a_receber"||
			sufixoSend=="inadimplentes"||
			sufixoSend=="extratos"||
			sufixoSend=="emissao_de_nfe"||
			sufixoSend=="aulas"||
			sufixoSend=="professores"||
			sufixoSend=="meus_treinos"||
			sufixoSend=="grupos_de_alimento"||
			sufixoSend=="alimentos"||
			sufixoSend=="plano_nutricional"||
			sufixoSend=="treinos"||
			sufixoSend=="agenda_de_aulas"||
			sufixoSend=="agenda_de_treinos"||
			sufixoSend=="avaliacoes"
	) { 
		var local_set = "personal";
		var sufixo_set = "-"+sufixoSend+"";

	} else if(sufixoSend=="estorno_de_convites"||sufixoSend=="estornos_pendentes"||sufixoSend=="estornados"||sufixoSend=="controle_de_fraude"||sufixoSend=="notificacoes"||sufixoSend=="recuperacao_de_debito") { 
		var local_set = "ferramentas";
		var sufixo_set = "-"+sufixoSend+"";

	} else if(sufixoSend=="cortesia") {
		var local_set = "comissario";
		var sufixo_set = "-"+sufixoSend+"";

	} else if(sufixoSend=="voucher") {
		var local_set = "comissario";
		var sufixo_set = "-"+sufixoSend+"";

	} else if(sufixoSend=="comissario") {
		var local_set = "comissario";
		var sufixo_set = "-"+sufixoSend+"";

	} else if(sufixoSend=="patrocinio") {
		var local_set = "comissario";
		var sufixo_set = "-"+sufixoSend+"";

	} else if(sufixoSend=="chargeback") {
		var local_set = "ferramentas";
		var sufixo_set = "-"+sufixoSend+"";

	} else if(sufixoSend=="pesquisa") {
		var local_set = "usuario";
		var sufixo_set = "";

	} else if(sufixoSend=="pedidos") {
		var local_set = "usuario";
		var sufixo_set = "-"+sufixoSend+"";

	} else if(sufixoSend=="pdv") {
		var local_set = "empresa";
		var sufixo_set = "-"+sufixoSend+"";

	} else if(sufixoSend=="cortesia_lote") {
		var local_set = "empresa";
		var sufixo_set = "-"+sufixoSend+"";
	} else if(sufixoSend=="usuario_carrinho_dashboard_elastic") {
		var local_set = "usuario";
		var sufixo_set = "-"+sufixoSend+"";
	} else {
		if($.trim(tbLocalSend)=="") {
			var local_set = "_construtor_template";
		} else {
			var local_set = ""+modSend+"";
		}

		if($.trim(sufixoSend)=="") {
			var sufixo_set = "";
		} else {
			var sufixo_set = "-"+sufixoSend+"";
		}
	}
	
	console.log(""+linkAdminAcoes+"acoes/"+local_set+"/tabela-tbody"+sufixo_set+".php");
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/"+local_set+"/tabela-tbody"+sufixo_set+".php",
		type: "GET",
		cache: false,
		data: "pageS="+pageSend+"&inicioS="+inicioSend+"&chaveS="+chaveSend+"&modS="+modSend+"&limitS="+limitSend+"&filtroS="+filtroSend+"&tbLocalS="+tbLocalSend+"&sufixoS="+sufixoSend+"&buscaS="+$("#busca").val()+"&campoSqlS="+$("#lista_campo_sql").val()+"&ids_selecionadosS="+$("#lista_checkboxes").val()+""+numeroUnico_eventos_set+"",
		//dataType: "html",
		success: function(data){
			$("#datatable_ajax_tbody").html(data);

			/*$("#lista_checkboxes").val("");*/

			preloaderOut();
			Metronic.init();
		},
	});

}


function busca_simples(chaveSend,modSend,tbLocalSend) {
	preloaderIn();
	
	if($.trim(tbLocalSend)=="") {
		var local_set = "_construtor_template";
	} else {
		var local_set = ""+modSend+"";
	}

	var url_atual = window.location.href;
	
	var n = url_atual.indexOf("pagina/");
	var n2 = url_atual.lastIndexOf("/");
	var resto = parseInt(n2) - (parseInt(n2) - parseInt(n));
	var res = url_atual.substr(0, resto);

	window.history.pushState("object or string", "Title", ""+res+"pagina/1/");

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/tabela-tbody-limpa.php",
		type: "GET",
		cache: false,
		data: "modS="+modSend+"&chaveS="+chaveSend+"",
		success: function(data){
			
			console.log(""+linkAdminAcoes+"acoes/"+local_set+"/tabela-tbody.php");

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/"+local_set+"/tabela-tbody.php",
				type: "GET",
				cache: false,
				data: "pageS=1&inicioS=0&chaveS="+chaveSend+"&modS="+modSend+"&limitS=&filtroS=&tbLocalS="+tbLocalSend+"&buscaS="+$("#busca").val()+"&campoSqlS="+$("#lista_campo_sql").val()+"",
				//dataType: "html",
				success: function(data){
		
					$("#datatable_ajax_tbody").html(data);
		
					$("#lista_checkboxes").val("");
		
					preloaderOut();
					Metronic.init();
		
				},
			});

		},
	});

}

function busca_simples_limpa(chaveSend,modSend,tbLocalSend) {
	preloaderIn();

	if($.trim(tbLocalSend)=="") {
		var local_set = "_construtor_template";
	} else {
		var local_set = ""+modSend+"";
	}

	$("#busca").val("");
	var busca_set = "";

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/tabela-tbody-limpa.php",
		type: "GET",
		cache: false,
		data: "modS="+modSend+"",
		//dataType: "html",
		success: function(data_limpa){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/"+local_set+"/tabela-tbody.php",
				type: "GET",
				cache: false,
				data: "pageS=1&inicioS=0&chaveS="+chaveSend+"&modS="+modSend+"&limitS=&filtroS=&tbLocalS="+tbLocalSend+"&buscaS="+busca_set+"&campoSqlS="+$("#lista_campo_sql").val()+"",
				//dataType: "html",
				success: function(data){
		
					$("#datatable_ajax_tbody").html(data);

					$("#lista_checkboxes").val("");

					preloaderOut();
					Metronic.init();
		
				},
			});

		},
	});

}

function url_menu_limpa(modSend,urlSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/tabela-tbody-limpa.php",
		type: "GET",
		cache: false,
		data: "modS="+modSend+"",
		//dataType: "html",
		success: function(data_limpa){
			
			window.open(""+urlSend+"","_self","");


		},
	});

}

function busca_inline_limpa(chaveSend,modSend,tbLocalSend) {
	preloaderIn();
	
	if($.trim(tbLocalSend)=="") {
		var local_set = "_construtor_template";
	} else {
		var local_set = ""+modSend+"";
	}

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/tabela-tbody-limpa.php",
		type: "GET",
		cache: false,
		data: "modS="+modSend+"&chaveS="+chaveSend+"",
		//dataType: "html",
		success: function(data_limpa){
			
			console.log("["+data_limpa+"]");

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/"+local_set+"/tabela-tbody.php",
				type: "GET",
				data: "pageS=1&inicioS=0&chaveS="+chaveSend+"&modS="+modSend+"&limitS=&filtroS=&tbLocalS="+tbLocalSend+"&limpaS=SIM",
				//dataType: "html",
				success: function(data){
		
					$("#datatable_ajax_tbody").html(data);
		
					$("#lista_checkboxes").val("");
		
					preloaderOut();
					Metronic.init();
		
				},
			});

		},
	});



}

/*
function paginacao_controle(pageSend,inicioSend,modSend,limitSend,filtroSend,tbLocalSend) {

	var url_atual = window.location.href;
	
	var n = url_atual.indexOf("pagina/");
	var n2 = url_atual.lastIndexOf("/");
	var resto = parseInt(n2) - (parseInt(n2) - parseInt(n));
	var res = url_atual.substr(0, resto);

	window.history.pushState("object or string", "Title", ""+res+"pagina/"+pageSend+"/");
	
	preloaderIn();

	if($.trim(tbLocalSend)=="") {
		var local_set = "_construtor_template";
	} else {
		var local_set = ""+modSend+"";
	}
	
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/"+local_set+"/tabela-tbody.php",
		type: "GET",
		data: "pageS="+pageSend+"&inicioS="+inicioSend+"&modS="+modSend+"&limitS="+limitSend+"&filtroS="+filtroSend+"&tbLocalS="+tbLocalSend+"&buscaS="+$("#busca").val()+"&campoSqlS="+$("#lista_campo_sql").val()+"",
		//dataType: "html",
		success: function(data){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/paginacao.php",
				type: "GET",
				data: "pageS="+pageSend+"&inicioS="+inicioSend+"&modS="+modSend+"&limitS="+limitSend+"&filtroS="+filtroSend+"&tbLocalS="+tbLocalSend+"&buscaS="+$("#busca").val()+"&campoSqlS="+$("#lista_campo_sql").val()+"",
				//dataType: "html",
				success: function(data_page){
					$("#datatable_ajax_tbody").html(data);
		
					$("#paginacao").html(data_page);
					$("#lista_checkboxes").val("");

					preloaderOut();
					Metronic.init();
				},
			});

		},
	});

}

function busca_simples(modSend,tbLocalSend) {
	preloaderIn();
	
	if($.trim(tbLocalSend)=="") {
		var local_set = "_construtor_template";
	} else {
		var local_set = ""+modSend+"";
	}

	var busca_set = $("#busca").val();

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/"+local_set+"/tabela-tbody.php",
		type: "GET",
		data: "pageS=1&inicioS=0&modS="+modSend+"&limitS=&filtroS=&buscaS="+busca_set+"&campoSqlS="+$("#lista_campo_sql").val()+"",
		//dataType: "html",
		success: function(data){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/_construtor_template/paginacao.php",
				type: "GET",
				data: "pageS=1&inicioS=0&modS="+modSend+"&limitS=&filtroS=&buscaS="+busca_set+"&campoSqlS="+$("#lista_campo_sql").val()+"",
				//dataType: "html",
				success: function(data_page){

					$.ajax({
						url: ""+linkAdminAcoes+"acoes/_construtor_template/tabela-tbody-n.php",
						type: "GET",
						data: "modS="+modSend+"&buscaS="+busca_set+"",
						//dataType: "html",
						success: function(data_n){
							$("#datatable_ajax_tbody").html(data);

							$("#paginacao").html(data_page);
							$("#lista_checkboxes").val("");
				
							$("#n_exibindo").html(data_n);

							preloaderOut();
							Metronic.init();
						},
					});

				},
			});

		},
	});

}

function busca_simples_limpa(modSend,tbLocalSend) {
	preloaderIn();

	if($.trim(tbLocalSend)=="") {
		var local_set = "_construtor_template";
	} else {
		var local_set = ""+modSend+"";
	}

	$("#busca").val("");
	var busca_set = "";

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/_construtor_template/tabela-tbody-limpa.php",
		type: "GET",
		data: "modS="+modSend+"",
		//dataType: "html",
		success: function(data_limpa){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/"+local_set+"/tabela-tbody.php",
				type: "GET",
				data: "pageS=1&inicioS=0&modS="+modSend+"&limitS=&filtroS=&buscaS="+busca_set+"&campoSqlS="+$("#lista_campo_sql").val()+"",
				//dataType: "html",
				success: function(data){
		
					$.ajax({
						url: ""+linkAdminAcoes+"acoes/_construtor_template/paginacao.php",
						type: "GET",
						data: "pageS=1&inicioS=0&modS="+modSend+"&limitS=&filtroS=&buscaS="+busca_set+"&campoSqlS="+$("#lista_campo_sql").val()+"",
						//dataType: "html",
						success: function(data_page){
		
							$.ajax({
								url: ""+linkAdminAcoes+"acoes/_construtor_template/tabela-tbody-n.php",
								type: "GET",
								data: "modS="+modSend+"&buscaS="+busca_set+"",
								//dataType: "html",
								success: function(data_n){
									$("#datatable_ajax_tbody").html(data);
		
									$("#paginacao").html(data_page);
									$("#lista_checkboxes").val("");
						
									$("#n_exibindo").html(data_n);
		
									preloaderOut();
									Metronic.init();
								},
							});
		
						},
					});
		
				},
			});

		},
	});

}
*/

function carrega_aba(abaSend,modSend){

	$.ajax({
		url: ""+linkAdminAcoes+"mod/_construtor_template/config_"+abaSend+".php",
		type: "GET",
		data: "modS="+modSend+"",
		//dataType: "html",
		success: function(data){

			$("#"+abaSend+"").html(data);

			$('.make-switch').bootstrapSwitch();

			$('.colorpicker-default').colorpicker({
				format: 'hex'
			});
			$('.colorpicker-rgba').colorpicker();

			$('.ckeditor').each(function(index, element) {
				CKEDITOR.replaceAll();
				$(this).removeClass('ckeditor');
			});

		},
	});

}



function apenas_contador_de_caractere(idTitulo,idContador){

	total = $("#"+idTitulo+"").val().length;
	
	$("#"+idContador+"").html(total);

}

function contador_de_caractere(idTitulo,idContador,qtd){

	total = $("#"+idTitulo+"").val().length;

	if(total <= qtd) {
		resto = qtd - total;
		$("#"+idContador+"").html(resto);
	} else {
		$('#'+idTitulo+'').val($('#'+idTitulo+'').val().substr(0, qtd));
	}
}

function atualiza_ordem_com_categoria(modSend,cmpOrdemSend,cmpCatSend) {
	
	$("#"+cmpOrdemSend+"_info").html("Atualizando...");

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/atualiza-ordem.php",
		type: "GET",
		data: "modS="+modSend+"&catS="+$("#"+cmpCatSend+"").val()+"",
		//dataType: "html",
		success: function(data){
			$("#"+cmpOrdemSend+"").html(data);
			$("#"+cmpOrdemSend+"_info").html("Escolha uma categoria");
		},
	});
}

function submit_rapida(modSend,numeroUnicoSend) {
	
	document.getElementById("formulario_exemplo_rapida"+modSend+"").submit();

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/carrega-options.php",
		type: "GET",
		data: "modS="+modSend+"&numeroUnicoS="+numeroUnicoSend+"",
		//dataType: "html",
		success: function(data){
			$("#"+modSend+"").html(data);
			
			$("#rapida"+modSend+"").modal("hide");

		},
	});
}

function remontaMarker(idSend,idSysusuSend,nomeSend,latSend,lngSend) {


	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysusu_geolocalization/markers.php",
		type: "GET",
		data: "idsysusuS="+idSysusuSend+"",
		//dataType: "html",
		success: function(data){
			
			title_atual = new Array();
			lat_atual = new Array();
			lng_atual = new Array();
			for	(i = 0; i < markers.length; i++) {
				title_atual[title_atual.length] =  markers[i].getTitle();
				lat_atual[lat_atual.length] =  markers[i].getPosition().lat();
				lng_atual[lng_atual.length] =  markers[i].getPosition().lng();
			}

			clearMarkers();
			markers = [];
		
			var json = JSON.parse(data);

			for (var i = 0, length = json.length; i < length; i++) {
				var itens = json[i],
				latLng = new google.maps.LatLng(itens.lat, itens.lng); 
			
				/*
				var title_atual = markers[i].getTitle();
				var lat_atual = markers[i].getPosition().lat();
				var lng_atual = markers[i].getPosition().lng();

				if($.trim(markers[i].getTitle())=="") {
					$("#info_mapa").append("<br><br> "+json.length+"");
				
					$("#info_mapa").append("<br><br> nada ainda");
				} else {
					$("#info_mapa").append("<br><br> "+markers[i].getTitle()+"");
				}
				*/

				markers.push(new google.maps.Marker({
					position: latLng,
					id: itens.id,
					title: itens.title,
					map: map,
					icon: new google.maps.MarkerImage(
						"http://chart.googleapis.com/chart?chst=d_bubble_text_small&chld=bb|"+itens.title+"|"+itens.cor+"|FFFFFF",
						null, 
						null, 
						new google.maps.Point(0, 42)),
					draggable: false
				}));

				//$("#info_mapa").append("<br><br> "+i+" <br> "+title_atual+" <br> "+itens.cor+" <br> ALAT: "+lat_atual+" <br> ALNG: "+lng_atual+" <br> ILAT: "+itens.lat+" <br> ILNG: "+itens.lng+"");
				

				
				if(lat_atual[i]==markers[i].getPosition().lat()&&lng_atual[i]==markers[i].getPosition().lng()) { } else {
					/*
					$("#info_mapa").append("<br><br> "+title_atual[i]+" <br> A LAT: "+lat_atual[i]+"");
					$("#info_mapa").append("<br> M LAT: "+markers[i].getPosition().lat()+"");
					$("#info_mapa").append("<br> A LNG: "+lng_atual[i]+"");
					$("#info_mapa").append("<br> M LNG: "+markers[i].getPosition().lng()+"");
					$("#info_mapa").append("<br> ID: "+markers[i].id+"");
					*/
					//markers[i].setMap(null);
					markers[i].setMap(map);
				}

			}

		},
	});
}

// Sets the map on all markers in the array.
function setAllMap(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setAllMap(null);
}

// Shows any markers currently in the array.
function showMarkers() {
  setAllMap(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
  clearMarkers();
  markers = [];
}

function abre_popup(arquivoSend,modSend,idSend) {
	var n = arquivoSend.indexOf("-manual");

	if(parseInt(n)>0) {
		var localCopiar = modSend;
		var arquivoSet = arquivoSend.replace("-manual", "");
	} else {
		var localCopiar = "_construtor_template";
		var arquivoSet = arquivoSend;
	}

	$.fancybox({
		'padding': 0,
		'scrolling'     : 'no',
		'openEffect'	: 'elastic',
		'closeEffect'	: 'elastic',
		'width'			: 1100,
		'height'		: 550,
		'type'			: 'ajax',
		'href'			: ''+linkAdminAcoes+'mod/'+localCopiar+'/'+arquivoSet+'.php?modS='+modSend+'&chaveS='+$("#chave_id").val()+'&idS='+idSend+''
	});
}

function getLocation(idSend,idSysusuSend,sessaoSend,ipSend) {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPositionGeo,showErrorGeo);

		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysusu_geolocalization/grava-geolocalization.php",
			type: "GET",
			data: "latS="+lat+"&lngS="+lng+"&idsysusuS="+idSysusuSend+"&sessaoS="+sessaoSend+"&ipS="+ipSend+"",
			//dataType: "html",
			success: function(data){
				$("#"+idSend+"").html(data);
			},
		});
	
	} else {
		$("#"+idSend+"").html("Geolocalização não é suportada nesse browser.");
	}
}

function getLocationComEndereco(sufixoSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysusu_geolocalization/get-geolocation.php",
		type: "GET",
		data: "nomeS="+$("#nome"+sufixoSend+"").val()+"&ruaS="+$("#rua"+sufixoSend+"").val()+"&numeroS="+$("#numero"+sufixoSend+"").val()+"&estadoS="+$("#estado"+sufixoSend+"").val()+"&cidadeS="+$("#cidade"+sufixoSend+"").val()+"&bairroS="+$("#bairro"+sufixoSend+"").val()+"",
		//dataType: "html",
		success: function(data){
	
			$("#gmap_markers"+sufixoSend+"").fadeIn();
			
			//alert(data);

			var retorno = data.split("|");

			latLng = new google.maps.LatLng(retorno[1], retorno[2]); 
			
			if($.trim(sufixoSend)=="_editar") {
				for (var i = 0; i < markers_editar.length; i++) {
					markers_editar[i].setMap(null);
				}

				markers_editar.push(new google.maps.Marker({
					position: latLng,
					title: retorno[0],
					map: map_editar,
					icon: new google.maps.MarkerImage(
						"http://chart.googleapis.com/chart?chst=d_bubble_text_small&chld=bb|"+retorno[0]+"|044b7c|FFFFFF",
						null, 
						null, 
						new google.maps.Point(0, 42)),
					draggable: false
				}));

				markers_editar[i].setMap(map_editar);
			} else {
				for (var i = 0; i < markers.length; i++) {
					markers[i].setMap(null);
				}

				markers.push(new google.maps.Marker({
					position: latLng,
					title: retorno[0],
					map: map,
					icon: new google.maps.MarkerImage(
						"http://chart.googleapis.com/chart?chst=d_bubble_text_small&chld=bb|"+retorno[0]+"|044b7c|FFFFFF",
						null, 
						null, 
						new google.maps.Point(0, 42)),
					draggable: false
				}));

				markers[i].setMap(map);
			}
			
		},
	});
}
 
function showPositionGeo(position,idSysusuSend,sessaoSend,ipSend) {
	lat = position.coords.latitude;
	lng = position.coords.longitude;
	
	/*
	latlng = new google.maps.LatLng(lat, lng)
	
	mapholder=document.getElementById('mapholder')
	mapholder.style.height='550px';
	mapholder.style.width='500px';
 
	var myOptions={
		center:latlng,zoom:14,
		mapTypeId:google.maps.MapTypeId.ROADMAP,
		mapTypeControl:false,
		navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
	};

	var map = new google.maps.Map(document.getElementById("mapholder"),myOptions);
	var marker = new google.maps.Marker({position:latlng,map:map,title:"Você está Aqui!"});
	*/
}
 
function showErrorGeo(error,idSend) {
	switch(error.code) {
		case error.PERMISSION_DENIED:
		$("#"+idSend+"").html("Usuário rejeitou a solicitação de Geolocalização.");
		break;

		case error.POSITION_UNAVAILABLE:
		$("#"+idSend+"").html("Localização indisponível.");
		break;

		case error.TIMEOUT:
		$("#"+idSend+"").html("O tempo da requisição expirou.");
		break;

		case error.UNKNOWN_ERROR:
		$("#"+idSend+"").html("Algum erro desconhecido aconteceu");
		break;
	}
}

function nao_exibe_texto(modSend,abaSend,idsysusuSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/exibicao-texto-aba.php",
		type: "GET",
		data: "modS="+modSend+"&abaS="+abaSend+"&idsysusuS="+idsysusuSend+"",
		//dataType: "html",
		success: function(data){
		},
	});

}

function adicionar_modulo_favorito_add(modSend,idsysusuSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/favorito-add.php",
		type: "GET",
		data: "modS="+modSend+"&idsysusuS="+idsysusuSend+"",
		//dataType: "html",
		success: function(data){
			if(data=="adicionou") {
				var $toast = toastr["success"]("Adicionado aos favoritos com sucesso !", "");
				$("#btn-favorito").addClass("yellow-gold");
			} else {
				var $toast = toastr["success"]("Removido dos favoritos com sucesso !", "");
				$("#btn-favorito").removeClass("yellow-gold");
			}


			$.ajax({
				url: ""+linkAdminAcoes+"acoes/sysgeral/atualiza-menu-favoritos_add.php",
				type: "GET",
				data: "modS="+modSend+"&idsysusuS="+idsysusuSend+"",
				//dataType: "html",
				success: function(data_menu_add){
					$("#menu_sysfavorito_add").html(data_menu_add);
				},
			});

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/sysgeral/atualiza-menu-favoritos_list.php",
				type: "GET",
				data: "modS="+modSend+"&idsysusuS="+idsysusuSend+"",
				//dataType: "html",
				success: function(data_menu_list){
					$("#menu_sysfavorito_list").html(data_menu_list);
				},
			});

		},
	});

}

function salvar_lista_cabecalho(modSend) {

	cmpNome = document.getElementById("nome_cabecalho");
	cmpCampo = document.getElementById("campo_cabecalho");
	cmpTipo = document.getElementById("tipo_cabecalho");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Título' deve ser preenchido");
		cmpNome.focus();
	} else {
		if($.trim(cmpCampo.value)=="") {
			alert("Você deve selecionar um item de 'Campo'");
			cmpCampo.focus();
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/sysgeral/cabecalho-add.php",
				type: "GET",
				data: "nomeS="+cmpNome.value+"&tipoS="+cmpTipo.value+"&campoBdS="+cmpCampo.value+"&campoS="+$("#campo_cabecalho option:selected").text()+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data){
					cmpNome.value = "";
					cmpCampo.value = "";
					cmpTipo.value = "";
					
					var $toast = toastr["success"]("Adicionada com sucesso !", "");
	
					$("#lista_"+modSend+"_cabecalho").html(data);
	
				},
			});
		}
	}
}

function remover_cabecalho(idSend,modSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/cabecalho-remover.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Removido com sucesso !", "");

				$("#lista_"+modSend+"_cabecalho").html(data);

			},
		});
	}
}

function ordem_cabecalho(idSend,modSend,ordemSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/cabecalho-ordem.php",
		type: "GET",
		data: "idS="+idSend+"&ordemS="+ordemSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			var $toast = toastr["success"]("Ordem alterada com sucesso !", "");

			$("#lista_"+modSend+"_cabecalho").html(data);

		},
	});
}

function muda_stat_cabecalho(idSend,modSend,statSend) {
	if (confirm("Você realmente deseja modificar o status deste item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/cabecalho-stat.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&statS="+statSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["success"]("Status alterado com sucesso !", "");

				$("#lista_"+modSend+"_cabecalho").html(data);
			},
		});

	}
}

function salvar_lista_ordenacao(modSend) {

	cmpCampo = document.getElementById("campo_ordenacao");
	cmpTipo = document.getElementById("tipo_ordenacao");

	if($.trim(cmpCampo.value)=="") {
		alert("Você deve selecionar um item de 'Campo'");
		cmpCampo.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/ordenacao-add.php",
			type: "GET",
			data: "tipoS="+cmpTipo.value+"&campoBdS="+cmpCampo.value+"&campoS="+$("#campo_ordenacao option:selected").text()+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				cmpCampo.value = "";
				cmpTipo.value = "";
				
				var $toast = toastr["success"]("Adicionada com sucesso !", "");

				$("#lista_"+modSend+"_ordenacao").html(data);

			},
		});
	}

}

function remover_ordenacao(idSend,modSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/ordenacao-remover.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Removido com sucesso !", "");

				$("#lista_"+modSend+"_ordenacao").html(data);

			},
		});
	}
}

function ordem_ordenacao(idSend,modSend,ordemSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/ordenacao-ordem.php",
		type: "GET",
		data: "idS="+idSend+"&ordemS="+ordemSend+"&modS="+modSend+"",
		//dataType: "html",
		success: function(data){
			var $toast = toastr["success"]("Ordem alterada com sucesso !", "");

			$("#lista_"+modSend+"_ordenacao").html(data);

		},
	});
}

function muda_stat_ordenacao(idSend,modSend,statSend) {
	if (confirm("Você realmente deseja modificar o status deste item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/ordenacao-stat.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&statS="+statSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["success"]("Status alterado com sucesso !", "");

				$("#lista_"+modSend+"_ordenacao").html(data);
			},
		});

	}
}

function filtrar_fluxo(dsSend,deSend) {
	if($.trim(dsSend)==""&&$.trim(deSend)=="") {
		cmpDS = document.getElementById("iddata_start");
		cmpDE = document.getElementById("iddata_end");
	
		if($.trim(cmpDS.value)=="") {
			alert("O campo 'De' deve ser preenchido");
			cmpDS.focus();
		} else {
			if($.trim(cmpDE.value)=="") {
				alert("O campo 'Até' deve ser preenchido");
				cmpDE.focus();
			} else {
				$.ajax({
					url: ""+linkAdminAcoes+"acoes/sysfluxo/filtra-fluxo.php",
					type: "GET",
					data: "dsS="+cmpDS.value+"&deS="+cmpDE.value+"",
					//dataType: "html",
					success: function(data){
						$("#fluxo_de_caixa").html(data);
					},
				});
			}
		}
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysfluxo/filtra-fluxo.php",
			type: "GET",
			data: "dsS="+dsSend+"&deS="+deSend+"",
			//dataType: "html",
			success: function(data){
				$("#fluxo_de_caixa").html(data);
			},
		});
	}
}

function filtrar_extrato_anual(anoSend) {
	$("#preloader").fadeIn();
	if($.trim(anoSend)=="") {
		if($.trim($("#ano").val())=="") {
			alert("O campo 'Ano' deve ser preenchido");
			$("#ano").focus();
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/sysextrato_anual/filtra-extrato-anual.php",
				type: "GET",
				data: "anoS="+$("#ano").val()+"",
				//dataType: "html",
				success: function(data){
					$("#extrato_anual").html(data);
					$("#preloader").fadeOut();
				},
			});
		}
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysextrato_anual/filtra-extrato-anual.php",
			type: "GET",
			data: "anoS="+anoSend+"",
			//dataType: "html",
			success: function(data){
				$("#extrato_anual").html(data);
				$("#preloader").fadeOut();
			},
		});
	}
}


function muda_sessao(idSend,sessaoSend,ipSend) {
	if (confirm("Você realmente deseja bloquear o outro acesso e utilizar este ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysusu/muda_sessao.php",
			type: "GET",
			data: "idS="+idSend+"&sessaoS="+sessaoSend+"&ipS="+ipSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function salvar_lista_redes_sysfornecedor(modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	cmpNome = document.getElementById("nome_item");
	cmpLink = document.getElementById("link_item");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido");
		cmpNome.focus();
	} else {
		if($.trim(cmpLink.value)=="") {
			alert("O campo 'Link' deve ser preenchido");
			cmpLink.focus();
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/sysfornecedor/add-lista_redes.php",
				type: "GET",
				data: "nomeS="+cmpNome.value+"&linkS="+cmpLink.value+"&numeroUnicoS="+cmpNumeroUnico.value+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data){
					cmpNome.value = "";
					cmpLink.value = "";
					
					var $toast = toastr["success"]("Rede adicionado com sucesso !", "");
	
					$("#lista_"+modSend+"_redes").html(data);
	
				},
			});
		}
	}
}

function remover_redes_sysfornecedor(idSend,modSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysfornecedor/remover-redes.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Rede removido com sucesso !", "");

				$("#lista_"+modSend+"_redes").html(data);

			},
		});
	}
}

function salvar_lista_telefones_sysfornecedor(modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	cmpNome = document.getElementById("nometel_item");
	cmpOperadora = document.getElementById("operadora_item");
	cmpDDD = document.getElementById("ddd_item");
	cmpTelefone = document.getElementById("telefone_item");

	if($.trim(cmpOperadora.value)=="") {
		alert("O campo 'Operadora' deve ser preenchido");
		cmpOperadora.focus();
	} else {
		if($.trim(cmpDDD.value)==""||$.trim(cmpTelefone.value)=="") {
			alert("O campo 'DDD - Telefone' deve ser preenchido");
			if($.trim(cmpDDD.value)=="") {
				cmpDDD.focus();
			} else {
				cmpTelefone.focus();
			}
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/sysfornecedor/add-lista_telefones.php",
				type: "GET",
				data: "nomeS="+cmpNome.value+"&operadoraS="+cmpOperadora.value+"&dddS="+cmpDDD.value+"&telefoneS="+cmpTelefone.value+"&numeroUnicoS="+cmpNumeroUnico.value+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data){
				cmpNome.value = "";
					cmpOperadora.value = "";
					cmpDDD.value = "";
					cmpTelefone.value = "";
					
					var $toast = toastr["success"]("Telefone adicionado com sucesso !", "");
	
					$("#lista_"+modSend+"_telefones").html(data);
	
				},
			});
		}
	}
}

function remover_telefones_sysfornecedor(idSend,modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysfornecedor/remover-telefones.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Telefone removido com sucesso !", "");

				$("#lista_"+modSend+"_telefones").html(data);

			},
		});
	}
}

function salvar_lista_emails_sysfornecedor(modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	cmpNome = document.getElementById("nomeemail_item");
	cmpEmail = document.getElementById("email_item");

	if($.trim(cmpEmail.value)=="") {
		alert("O campo 'E-mail' deve ser preenchido");
		cmpEmail.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysfornecedor/add-lista_emails.php",
			type: "GET",
			data: "nomeS="+cmpNome.value+"&emailS="+cmpEmail.value+"&numeroUnicoS="+cmpNumeroUnico.value+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				cmpNome.value = "";
				cmpEmail.value = "";
				
				var $toast = toastr["success"]("E-mail adicionado com sucesso !", "");

				$("#lista_"+modSend+"_emails").html(data);

			},
		});
	}
}

function remover_emails_sysfornecedor(idSend,modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysfornecedor/remover-emails.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Removido adicionado com sucesso !", "");

				$("#lista_"+modSend+"_emails").html(data);

			},
		});
	}
}

function salvar_email_syschamado(modSend) {

	if($.trim($("#nome_email").val())=="") {
		alert("O campo 'Nome' deve ser preenchido");
		$("#nome_email").focus();
	} else {
		if($.trim($("#email_email").val())=="") {
			alert("O campo 'E-mail' deve ser preenchido");
			$("#email_email").focus();
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/"+modSend+"/add-lista_emails.php",
				type: "GET",
				data: "nomeS="+$("#nome_email").val()+"&emailS="+$("#email_email").val()+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data){
					$("#nome_email").val("");
					$("#email_email").val("");
					
					var $toast = toastr["success"]("E-mail adicionado com sucesso !", "");
	
					$("#lista_"+modSend+"_emails").html(data);
	
				},
			});

			window.setTimeout(function() {
				$.ajax({
					url: ""+linkAdminAcoes+"acoes/"+modSend+"/renova-select_email.php",
					type: "GET",
					data: "",
					//dataType: "html",
					success: function(data){
						$("#email_email").html(data);
					},
				});
			}, 500);		

		}
	}
}

function remover_email_syschamado(idSend,modSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/"+modSend+"/remover-emails.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Removido adicionado com sucesso !", "");

				$("#lista_"+modSend+"_emails").html(data);

			},
		});

		window.setTimeout(function() {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/"+modSend+"/renova-select_email.php",
				type: "GET",
				data: "",
				//dataType: "html",
				success: function(data){
					$("#email_email").html(data);
				},
			});
		}, 500);		
	}
}

function muda_stat_syschamado(idSend,modSend,statSend) {
	if (confirm("Você realmente deseja modificar o status deste item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/"+modSend+"/muda-stat.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&statS="+statSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["success"]("Status alterado com sucesso !", "");

				$("#lista_"+modSend+"_emails").html(data);
			},
		});

	}
}

function responde_chamado(idSend,nomeSend) {
	$("#btn-responde").hide();

	$("#form-reply").fadeIn();
	if($.trim(nomeSend)=="") { } else {
		$("#nome_reply").val("RE: "+nomeSend+"");
		$("#reply").val(idSend);
	}
}

function responde_chamado_cancela() {
	$("#form-reply").fadeOut();
	$("#nome_reply").val("")
	$("#reply").val("")
}

function tipo_de_cliente(sufixoSend) {
	if($.trim($("#tipo_de_documento"+sufixoSend+"").val())=="pf") {
		$("#div_pj"+sufixoSend+"").hide();
		$("#div_estrangeiro"+sufixoSend+"").hide();
		$("#div_pf"+sufixoSend+"").fadeIn();
	} else {
		if($.trim($("#tipo_de_documento"+sufixoSend+"").val())=="pj") {
			$("#div_pf"+sufixoSend+"").hide();
			$("#div_estrangeiro"+sufixoSend+"").hide();
			$("#div_pj"+sufixoSend+"").fadeIn();
		} else {
			if($.trim($("#tipo_de_documento"+sufixoSend+"").val())=="estrangeiro") {
				$("#div_pf"+sufixoSend+"").hide();
				$("#div_pj"+sufixoSend+"").hide();
				$("#div_estrangeiro"+sufixoSend+"").fadeIn();
			} else {
				$("#div_pf"+sufixoSend+"").hide();
				$("#div_pj"+sufixoSend+"").hide();
				$("#div_estrangeiro"+sufixoSend+"").hide();
			}
		}
	}
}

function tipo_de_doc() {
	if($.trim($("#tipo_de_documento").val())=="pf") {
		$("#div_pj").hide();
		$("#div_pf").fadeIn();
	} else {
		if($.trim($("#tipo_de_documento").val())=="pj") {
			$("#div_pf").hide();
			$("#div_pj").fadeIn();
		} else {
			$("#div_pf").hide();
			$("#div_pj").hide();
		}
	}
}

function sysconta_a_receber_gera_boleto(idContaSend) {
	if($.trim($("#banco_boleto").val())=="") {
		alert("É necessário escolher um banco!");
	} else {
		if($.trim($("#prazo_boleto").val())=="") {
			alert("É necessário escolher um prazo para o pagamento!");
		} else {
			$.fancybox({
				width: 800,
				autoSize: true,
				href: ""+linkAdminAcoes+"acoes/sysconta_a_receber/gera_boleto.php?idContaS="+idContaSend+"&idBancoS="+$("#banco_boleto").val()+"&prazo_boletoS="+$("#prazo_boleto").val()+"&infoS="+$("#info_boleto").val()+"",
				type: 'ajax'
			});	
		}
	}
}

function adv_processo_gera_contrato(idProcessoSend) {
	if($.trim($("#syscontrato_modelo").val())=="") {
		alert("É necessário escolher um modelo de contrato!");
	} else {
		if($.trim($("#data_assinatura_dia").val())==""&&$.trim($("#data_assinatura_mes").val())==""&&$.trim($("#data_assinatura_ano").val())=="") {
			alert("É necessário escolher uma data de assinatura!");
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/syscontrato_modelo/gerador_de_contrato.php",
				type: "GET",
				data: "idProcessoS="+idProcessoSend+"&idContratoS="+$("#syscontrato_modelo").val()+"&data_assinatura_diaS="+$("#data_assinatura_dia").val()+"&data_assinatura_mesS="+$("#data_assinatura_mes").val()+"&data_assinatura_anoS="+$("#data_assinatura_ano").val()+"",
				//dataType: "html",
				success: function(data){
					$("#contrato-conteudo").html(data);
					$("#contrato-conteudo").wordExport("contrato-"+idProcessoSend+"");
				},
			});
		}
	}
}

function adv_processo_gera_contrato_cliente(idProcessoSend,idClienteSend,idUsuarioSend) {
	if($.trim($("#syscontrato_modelo_"+idClienteSend+"").val())=="") {
		alert("É necessário escolher um modelo de contrato!");
	} else {
		if($.trim($("#data_assinatura_dia_"+idClienteSend+"").val())==""||$.trim($("#data_assinatura_mes_"+idClienteSend+"").val())==""||$.trim($("#data_assinatura_ano_"+idClienteSend+"").val())=="") {
			alert("É necessário escolher uma data de assinatura!");
		} else {
			$("#btn-gerador_"+idClienteSend+"").hide();
			$("#preloader_"+idClienteSend+"").fadeIn();
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/syscontrato_modelo/gerador_de_contrato.php",
				type: "GET",
				data: "idProcessoS="+idProcessoSend+"&idClienteS="+idClienteSend+"&idUsuarioS="+idUsuarioSend+"&idContratoS="+$("#syscontrato_modelo_"+idClienteSend+"").val()+"&data_assinatura_diaS="+$("#data_assinatura_dia_"+idClienteSend+"").val()+"&data_assinatura_mesS="+$("#data_assinatura_mes_"+idClienteSend+"").val()+"&data_assinatura_anoS="+$("#data_assinatura_ano_"+idClienteSend+"").val()+"",
				//dataType: "html",
				success: function(data){
					$("#preloader_"+idClienteSend+"").hide();
					$("#btn-gerador_"+idClienteSend+"").fadeIn();
					$("#contrato-conteudo").html(data);
					$("#contrato-conteudo").wordExport("contrato-processo-"+idProcessoSend+"-cliente-"+idClienteSend+"");
				},
			});
		}
	}
}

function como_conheceu_set(sufixoSend) {
	if($.trim($("#como_conheceu"+sufixoSend+"").val())=="Outros") {
		$("#como_conheceu_outro"+sufixoSend+"").fadeIn();
	} else {
		$("#como_conheceu_outro"+sufixoSend+"").hide();
	}
}

function salvar_syscronograma() {
	if($.trim($("#nome").val())=="") {
		alert("O campo 'Título da tarefa' deve ser preenchido!");
		$("#nome").focus();
	} else {
		if($.trim($("#criador").val())=="") {
			alert("O campo 'Criador' deve ser preenchido!");
			$("#criador").focus();
		} else {
			$("#idacaoForm").val("add");
			document.forms.submit();
		}
	}
}

function salvar_continuar_editando_syscronograma() {
	if($.trim($("#nome").val())=="") {
		alert("O campo 'Título da tarefa' deve ser preenchido!");
		$("#nome").focus();
	} else {
		if($.trim($("#criador").val())=="") {
			alert("O campo 'Criador' deve ser preenchido!");
			$("#criador").focus();
		} else {
			$("#idacaoForm").val("add-continuar");
			document.forms.submit();
		}
	}
}

function salvar_muda_situacao_syscronograma(situacaoSend) {
	$("#idsituacao").val(""+situacaoSend+"");
	document.forms.submit();
}

function gerar_relatorio_syscronograma(modSend,idCriadorSend) {
	cmpCliente = document.getElementById("idsyscliente_rela");
	cmpResponsavel = document.getElementById("responsavel_rela");
	cmpSituacao = document.getElementById("situacao_rela");
	cmpDataIni = document.getElementById("data_inicio_rela");
	cmpDataFim = document.getElementById("data_fim_rela");
	
	$("#preloader").fadeIn();

	if($.trim(modSend)=="") {
		$("#botao-imprimir-relatorio").fadeOut();
		$("#botao-limpar-relatorio").fadeOut();
		$("#lista_relatorio").html("");
	} else {
		$("#botao-imprimir-relatorio").fadeIn();
		$("#botao-limpar-relatorio").fadeIn();
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syscronograma/lista_relatorio.php",
			type: "GET",
			data: "modS="+modSend+"&clienteS="+cmpCliente.value+"&criadorS="+idCriadorSend+"&responsavelS="+cmpResponsavel.value+"&situacaoS="+cmpSituacao.value+"&data_inicioS="+cmpDataIni.value+"&data_fimS="+cmpDataFim.value+"",
			//dataType: "html",
			success: function(data){
				$("#lista_relatorio").html(data);
				$("#preloader").fadeOut();
			},
		});
	}
}

function salva_processo(idSend) {
	$("#idadv_processo_tipo").val(""+idSend+"");
	$("#formulario").submit();
}

function salvar_muda_situacao(situacaoSend) {
	$("#idsituacao").val(""+situacaoSend+"");
	$("#formulario").submit();
}

function salvar_continuar_editando_send(formSend) {
	$("#idacaoForm_"+formSend+"").val("add-continuar_"+formSend+"");
	$("#"+formSend+"").submit();
}

function salvar_formulario_send(formSend) {
	$("#"+formSend+"").submit();
}
function salvar_formulario() {
	$("#formulario").submit();
}

function clonar_item() {
	$("#idacaoForm").val("add-clone");
	$("#iditem_set").prop( "disabled", true );
	$("#formulario").submit();
}

function busca_syscontrato_cliente(sufixoSend) {
	cmpSyscliente = document.getElementById("idsyscliente"+sufixoSend+"");
	if($.trim(cmpSyscliente.value)=="") {
		alert("É necessário escolher um cliente!");
		cmpSyscliente.focus();
	} else {
	
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syscliente/retorna-syscontrato.php",
			type: "GET",
			data: "idS="+cmpSyscliente.value+"&sufixoS="+sufixoSend+"",
			//dataType: "html",
			success : function(data){  
				if(data=="0") {
					$("#idsyscontrato"+sufixoSend+"").prop( "disabled", true );
					$("#idsyscontrato"+sufixoSend+"").html("");
					$("#idsyscontrato_item"+sufixoSend+"").html("");
					$("#idsyscontrato_item"+sufixoSend+"").prop( "disabled", true );
				} else {
					$("#idsyscontrato"+sufixoSend+"").html(data);
					$("#idsyscontrato"+sufixoSend+"").prop( "disabled", false );
				}
				
			}   
		});
	}
}

function busca_syscontrato_item_cliente(sufixoSend) {
	cmpSyscontrato = document.getElementById("idsyscontrato"+sufixoSend+"");
	if($.trim(cmpSyscontrato.value)=="") {
		alert("É necessário escolher um contrato!");
		cmpSyscontrato.focus();
	} else {
	
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syscliente/retorna-syscontrato-item.php",
			type: "GET",
			data: "idS="+cmpSyscontrato.value+"&sufixoS="+sufixoSend+"",
			//dataType: "html",
			success : function(data){                                               
				if(data=="0") {
					$("#idsyscontrato_item"+sufixoSend+"").prop( "disabled", true );
				} else {
					$("#idsyscontrato_item"+sufixoSend+"").html(data);
					$("#idsyscontrato_item"+sufixoSend+"").prop( "disabled", false );
				}
				
			}   
		});
	}
}

function mostra_tipos_item(sufixoSend) {
	$("#preloader"+sufixoSend+"").fadeIn();

	if($.trim($("#idtipo_job"+sufixoSend+"").val())=="") {
		$("#idjob_categoria"+sufixoSend+"").prop( "disabled", true );
		$("#idjob_categoria"+sufixoSend+"").html("");
		$("#preloader"+sufixoSend+"").fadeOut();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysprospecto/lista-categoria-item.php",
			type: "GET",
			data: "tipoS="+$("#idtipo_job"+sufixoSend+"").val()+"",
			//dataType: "html",
			success: function(data){
				$("#idjob_categoria"+sufixoSend+"").prop( "disabled", false );
				$("#idjob_categoria"+sufixoSend+"").html(data);
				$("#item_label"+sufixoSend+"").html($("#idtipo_job"+sufixoSend+" option:selected").text());
				$("#preloader"+sufixoSend+"").fadeOut();
			},
		});
	}
}

function mostra_servicos_sysprospecto(sufixoSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysprospecto/lista-produtos.php",
		type: "GET",
		data: "idS="+$("#idjob_categoria"+sufixoSend+"").val()+"&tipoS="+$("#idtipo_job"+sufixoSend+"").val()+"",
		//dataType: "html",
		success: function(data){
			$("#campos_servicos"+sufixoSend+"").fadeIn();
			$("#item_label"+sufixoSend+"").html($("#idtipo_job"+sufixoSend+" option:selected").text());
			$("#iditem"+sufixoSend+"").html(data);
		},
	});
}

function mostra_itens_syssistemas(sufixoSend) {
	
	$("#preloader").fadeIn();
	
	if($.trim($("#item_tipo_item"+sufixoSend+"").val())=="sysmodulos") {
		$("#cmp-idsysplano").hide();
		$("#label-item").html("Módulo");
	} else {
		$("#cmp-idsysplano").fadeIn();
		$("#label-item").html("Produto, serviço ou solução");
	}

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/syssistemas/lista-opcoes-categorias.php",
		type: "GET",
		data: "tipoS="+$("#item_tipo_item"+sufixoSend+"").val()+"",
		//dataType: "html",
		success: function(data){
			$("#item_idsysplano"+sufixoSend+"").html("<option value=''>---</option>");
			$("#item_idsysplano"+sufixoSend+"").prop( "disabled", true );
			$("#item_valor"+sufixoSend+"").val("");
			$("#item_valor_mensalidade"+sufixoSend+"").val("");

			$("#campos_itens"+sufixoSend+"").fadeIn();
			$("#item_iditem_categoria"+sufixoSend+"").html(data);
			$("#preloader").fadeOut();
		},
	});
}

function mostra_itens_tipo(sufixoSend) {

	$("#preloader").fadeIn();
	
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/syssistemas/lista-opcoes.php",
		type: "GET",
		data: "tipoS="+$("#item_tipo_item"+sufixoSend+"").val()+"&idS="+$("#item_iditem_categoria"+sufixoSend+"").val()+"",
		//dataType: "html",
		success: function(data){
			$("#item_idsysplano"+sufixoSend+"").html("<option value=''>---</option>");
			$("#item_idsysplano"+sufixoSend+"").prop( "disabled", true );
			$("#item_valor"+sufixoSend+"").val("");
			$("#item_valor_mensalidade"+sufixoSend+"").val("");

			$("#item_iditem"+sufixoSend+"").html(data);
			$("#preloader").fadeOut();
		},
	});
}

function preenche_valor_syssistemas(sufixoSend) {

	$("#preloader").fadeIn();
	
	if($.trim($("#item_iditem_categoria"+sufixoSend+"").val())=="") {
		alert("É necessário escolher um item!");
		$("#item_iditem_categoria"+sufixoSend+"").focus();
	} else {
	
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syssistemas/retorna-valor-item.php",
			type: "GET",
			data: "tipoS="+$("#item_tipo_item"+sufixoSend+"").val()+"&idS="+$("#item_iditem"+sufixoSend+"").val()+"",
			//dataType: "html",
			success : function(data){
				var retorno = data.split("|");
	
				if(retorno[0]=="0") {
					$("#item_idsysplano"+sufixoSend+"").html("<option value=''>---</option>");
					$("#item_idsysplano"+sufixoSend+"").prop( "disabled", true );
					$("#item_valor"+sufixoSend+"").val("");
					$("#item_valor_mensalidade"+sufixoSend+"").val("");
					$("#item_valor"+sufixoSend+"").val(""+retorno[1]+"");
					$("#item_valor_mensalidade"+sufixoSend+"").val(""+retorno[2]+"");
					$("#preloader").fadeOut();
				} else {
					$.ajax({
						url: ""+linkAdminAcoes+"acoes/sysprospecto/lista-planos.php",
						type: "GET",
						data: "idS="+$("#item_iditem"+sufixoSend+"").val()+"",
						//dataType: "html",
						success: function(data){
							$("#item_idsysplano"+sufixoSend+"").html(data);
							$("#item_valor"+sufixoSend+"").val("");
							$("#item_valor_mensalidade"+sufixoSend+"").val("");
							$("#item_idsysplano"+sufixoSend+"").prop( "disabled", false );
							$("#preloader").fadeOut();
						},
					});
				}
				
			}   
		});
	}
}


function preenche_valor_sysplano_syssistemas(sufixoSend) {

	$("#preloader").fadeIn();
	
	if($.trim($("#item_idsysplano"+sufixoSend+"").val())=="") {
		alert("É necessário escolher um plano!");
		$("#item_idsysplano"+sufixoSend+"").focus();
	} else {
	
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syssistemas/retorna-valor-plano.php",
			type: "GET",
			data: "idS="+$("#item_idsysplano"+sufixoSend+"").val()+"",
			//dataType: "html",
			success : function(data){
				$("#item_valor_mensalidade"+sufixoSend+"").val(data);
				$("#preloader").fadeOut();
			}   
		});
	}
}

function salvar_itens_syssistemas(sufixoSend) {

	if($.trim($("#item_tipo_item"+sufixoSend+"").val())=="") {
		alert("Deve ser um 'Tipo de Item' !");
		$("#item_tipo_item"+sufixoSend+"").focus();
	} else {
		if($.trim($("#item_iditem_categoria"+sufixoSend+"").val())=="") {
			alert("Deve ser escolhida uma 'Categoria' !");
			$("#item_iditem_categoria"+sufixoSend+"").focus();
		} else {
			if($.trim($("#item_iditem"+sufixoSend+"").val())=="") {
				alert("Deve ser escolhida um '"+$("#label-item").html()+"' !");
				$("#item_iditem"+sufixoSend+"").focus();
			} else {
				if($("#item_idsysplano"+sufixoSend+"").prop("disabled")===false&&$.trim($("#item_idsysplano"+sufixoSend+"").val())=="") {
					alert("Deve ser escolhido um 'Plano' !");
					$("#item_idsysplano"+sufixoSend+"").focus();
				} else {
					if($("#item_idsysplano"+sufixoSend+"").prop("disabled")===false&&$.trim($("#item_valor_mensalidade"+sufixoSend+"").val())=="") {
						alert("Deve ser preenchido um 'Valor da mensalidade' !");
						$("#item_valor_mensalidade"+sufixoSend+"").focus();
					} else {
						if($("#item_idsysplano"+sufixoSend+"").prop("disabled")===true&&($.trim($("#item_valor"+sufixoSend+"").val())==""&&$.trim($("#item_valor_mensalidade"+sufixoSend+"").val())=="")) {
							alert("Deve ser preenchido um 'Valor' !");
							$("#item_valor"+sufixoSend+"").focus();
						} else {
							$.ajax({
								url: ""+linkAdminAcoes+"acoes/syssistemas/add-item.php",
								type: "GET",
								data: "numeroUnicoS="+$("#numeroUnico"+sufixoSend+"").val()+"&tipoS="+$("#item_tipo_item"+sufixoSend+"").val()+"&iditem_categoriaS="+$("#item_iditem_categoria"+sufixoSend+"").val()+"&iditemS="+$("#item_iditem"+sufixoSend+"").val()+"",
								//dataType: "html",
								success: function(data){
									$("#item_tipo_item"+sufixoSend+"").val("");
									$("#item_iditem_categoria"+sufixoSend+"").html("<option value=''>---</option>");
									$("#item_iditem"+sufixoSend+"").html("<option value=''>---</option>");
									$("#item_idsysplano"+sufixoSend+"").html("<option value=''>---</option>");
									$("#item_idsysplano"+sufixoSend+"").prop( "disabled", true );
									$("#item_valor"+sufixoSend+"").val("");
									$("#item_valor_mensalidade"+sufixoSend+"").val("");
									$("#campos_itens"+sufixoSend+"").fadeOut();
									$("#lista-itens"+sufixoSend+"").html(data);
								},
							});
						}
					}
				}
			}
	
		}
	}
}

function remover_item_syssistemas(numeroUnicoSend,sufixoSend,idSend,modSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syssistemas/remover-item.php",
			type: "GET",
			data: "numeroUnicoS="+numeroUnicoSend+"&idS="+idSend+"&sufixoS="+sufixoSend+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Item removido com sucesso !", "");

				$("#lista-itens"+sufixoSend+"").html(data);
			},
		});
	}
}

function gera_codigo_syssistemas() {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/syssistemas/gera-codigo.php",
		type: "GET",
		data: "",
		//dataType: "html",
		success: function(data){
			$("#cod").val(data);
		},
	});
}

function envia_email_sysprospecto(numeroUnicoSend,idSend) {
	$("#img-envia-email-"+idSend+"").attr("src",""+linkAdminAcoes+"template/img/preloader-3.gif");
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysprospecto/envia-prospecto.php",
		type: "GET",
		data: "numeroUnicoS="+numeroUnicoSend+"&idS="+idSend+"",
		//dataType: "html",
		success: function(data){
			$("#img-envia-email-"+idSend+"").attr("src",""+linkAdminAcoes+"template/img/icones_novos/16/email-send.png");
			var $toast = toastr["success"]("E-mail enviado com sucesso !", "");
		},
	});
}

function envia_email_syscontrato(numeroUnicoSend,idSend,var1Send,var2Send) {
	if (confirm("Você realmente deseja este contrato para o e-mail do cliente ?")) {
		$("#img-envia-email-"+idSend+"").attr("src",""+linkAdminAcoes+"template/img/preloader-3.gif");
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syscontrato/envia-syscontrato.php",
			type: "GET",
			data: "numeroUnicoS="+numeroUnicoSend+"&idS="+idSend+"&linkS="+linkAdminAcoes+"&var1S="+var1Send+"&var2S="+var2Send+"",
			//dataType: "html",
			success: function(data){
				$("#img-envia-email-"+idSend+"").attr("src",""+linkAdminAcoes+"template/img/icones_novos/16/email-send.png");
				var $toast = toastr["success"]("E-mail enviado com sucesso !", "");
			},
		});
	}
}

function gera_syscontrato(idSend,var1Send,var2Send) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysprospecto/gera-contrato.php",
		type: "GET",
		data: "idS="+idSend+"&var1S="+var1Send+"&var2S="+var2Send+"",
		//dataType: "html",
		success: function(data){
			window.open(''+linkAdminAcoes+''+data+'','_self','');
		},
	});
}

function preenche_valor_sysproduto_sysprospecto(sufixoSend,modSend) {

	if($.trim($("#iditem"+sufixoSend+"").val())=="") {
		alert("É necessário escolher um '"+$("#idtipo_job"+sufixoSend+" option:selected").text()+"'!");
		$("#iditem"+sufixoSend+"").focus();
	} else {
	
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysprospecto/retorna-valor-produto.php",
			type: "GET",
			data: "idS="+$("#iditem"+sufixoSend+"").val()+"&modS="+modSend+"&tipoS="+$("#idtipo_job"+sufixoSend+"").val()+"",
			//dataType: "html",
			success : function(data){                                               
				var retorno = data.split("|");
	
				if(retorno[0]=="0") {
					$("#idsysplano"+sufixoSend+"").prop( "disabled", true );
					$("#periodo"+sufixoSend+"").prop( "disabled", true );
					$("#valor"+sufixoSend+"").val("");
					$("#valor_mensalidade"+sufixoSend+"").val("");
					$("#valor"+sufixoSend+"").val(""+retorno[1]+"");
					$("#valor_mensalidade"+sufixoSend+"").val(""+retorno[2]+"");
				} else {
					$.ajax({
						url: ""+linkAdminAcoes+"acoes/sysprospecto/lista-planos.php",
						type: "GET",
						data: "idS="+$("#idsysproduto"+sufixoSend+"").val()+"",
						//dataType: "html",
						success: function(data){
							$("#idsysplano"+sufixoSend+"").html(data);
							$("#valor"+sufixoSend+"").val("");
							$("#valor_mensalidade"+sufixoSend+"").val("");
							$("#idsysplano"+sufixoSend+"").prop( "disabled", false );
							$("#periodo"+sufixoSend+"").prop( "disabled", false );
						},
					});
				}
				
			}   
		});
	}
}

function preenche_valor_sysplano_sysprospecto(sufixoSend,modSend) {
	cmpSysplano = document.getElementById("idsysplano"+sufixoSend+"");
	if($.trim(cmpSysplano.value)=="") {
		alert("É necessário escolher um plano!");
		cmpSysplano.focus();
	} else {
	
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysprospecto/retorna-valor-plano.php",
			type: "GET",
			data: "idS="+cmpSysplano.value+"&modS="+modSend+"",
			//dataType: "html",
			success : function(data){                                               
				var retorno = data.split("|");
	
				$("#valor_mensalidade"+sufixoSend+"").val(data);
				
			}   
		});
	}
}

function salvar_servico_sysprospecto(sufixoSend,modSend) {

	if($.trim($("#idjob_categoria"+sufixoSend+"").val())=="") {
		alert("Deve ser escolhida uma categoria de '"+$("#idtipo_job"+sufixoSend+" option:selected").text()+"' !");
		$("#idjob"+sufixoSend+"").focus();
	} else {
		if($.trim($("#iditem"+sufixoSend+"").val())=="") {
			alert("Deve ser escolhida um '"+$("#idtipo_job"+sufixoSend+" option:selected").text()+"' !");
			$("#iditem"+sufixoSend+"").focus();
		} else {
			if($("#idsysplano"+sufixoSend+"").prop("disabled")===false&&$.trim($("#idsysplano"+sufixoSend+"").val())=="") {
				alert("Deve ser escolhida um 'Plano' !");
				cmpSysplano.focus();
			} else {
				if($("#idsysplano"+sufixoSend+"").prop("disabled")===false&&$.trim($("#valor_mensalidade"+sufixoSend+"").val())=="") {
					alert("Deve ser preenchido um 'Valor de mensalidade' !");
					cmpValorMensalidade.focus();
				} else {
					if($("#idsysplano"+sufixoSend+"").prop("disabled")===true&&$.trim($("#valor"+sufixoSend+"").val())=="") {
						alert("Deve ser preenchido um 'Valor do produto' !");
						$("#valor"+sufixoSend+"").focus();
					} else {
						$.ajax({
							url: ""+linkAdminAcoes+"acoes/sysprospecto/add-servicos.php",
							type: "GET",
							data: "sufixoS="+sufixoSend+"&numeroUnicoS="+$("#numeroUnico"+sufixoSend+"").val()+"&tipoS="+$("#idtipo_job"+sufixoSend+"").val()+"&idsysproduto_categoriaS="+$("#idjob_categoria"+sufixoSend+"").val()+"&idsysprodutoS="+$("#iditem"+sufixoSend+"").val()+"&idsysplanoS="+$("#idsysplano"+sufixoSend+"").val()+"&periodoS="+$("#periodo"+sufixoSend+"").val()+"&valorS="+$("#valor"+sufixoSend+"").val()+"&valor_mensalidadeS="+$("#valor_mensalidade"+sufixoSend+"").val()+"&valor_descontoS="+$("#valor_desconto"+sufixoSend+"").val()+"&modS="+modSend+"",
							//dataType: "html",
							success: function(data){
								$("#idjob"+sufixoSend+"").val("");
								$("#idsysplano"+sufixoSend+"").val("");
								$("#periodo"+sufixoSend+"").val("");
								$("#valor"+sufixoSend+"").val("");
								$("#valor_mensalidade"+sufixoSend+"").val("");
								$("#valor_desconto"+sufixoSend+"").val("");
								$("#lista-servicos"+sufixoSend+"").html(data);
							},
						});
					}
				}
			}
	
		}
	}

}

function salvar_cliente_ajax(sufixoSend,idsysusuSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico_pop_syscliente");
	cmpNome = document.getElementById("nome_pop_syscliente");
	cmpCategoria = document.getElementById("idsyscliente_categoria_pop_syscliente");

	/*
	cmpEmail = document.getElementById("email_pop_syscliente");
	cmpSenha = document.getElementById("senha_pop_syscliente");
	cmpComoConheceu = document.getElementById("como_conheceu_pop_syscliente");
	cmpComoConheceuOutro = document.getElementById("como_conheceu_outro_pop_syscliente");
	cmpTel1Op = document.getElementById("telefone_1_operadora_pop_syscliente");
	cmpTel1DDD = document.getElementById("telefone_1_ddd_pop_syscliente");
	cmpTel1 = document.getElementById("telefone_1_pop_syscliente");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido!");
		cmpNome.focus();
	} else {
		if($.trim(cmpEmail.value)=="") {
			alert("O campo 'E-mail' deve ser preenchido!");
			cmpEmail.focus();
		} else {
			if($.trim(cmpSenha.value)=="") {
				alert("O campo 'Senha' deve ser preenchido!");
				cmpSenha.focus();
			} else {
				if($.trim(cmpComoConheceu.value)=="") {
					alert("O campo 'Como Conheceu' deve ser preenchido!");
					cmpComoConheceu.focus();
				} else {
					if($.trim(cmpComoConheceu.value)=="Outros"&&$.trim(cmpComoConheceuOutro.value)=="") {
						alert("O campo 'Como Conheceu - Outros' deve ser preenchido!");
						cmpComoConheceuOutro.focus();
					} else {
						if($.trim(cmpTel1DDD.value)==""||$.trim(cmpTel1.value)=="") {
							alert("O campo 'Telefone' deve ser preenchido!");
							if($.trim(cmpTel1DDD.value)=="") {
								cmpTel1DDD.focus();
							} else {
								cmpTel1.focus();
							}
						} else {
							$.ajax({
								url: ""+linkAdminAcoes+"acoes/syscliente/add-syscliente.php",
								type: "GET",
								data: "sufixoS="+sufixoSend+"&numeroUnicoS="+cmpNumeroUnico.value+"&nomeS="+cmpNome.value+"&emailS="+cmpEmail.value+"&senhaS="+cmpSenha.value+"&como_conheceuS="+cmpComoConheceu.value+"&como_conheceu_outroS="+cmpComoConheceuOutro.value+"&telefone_1_operadoraS="+cmpTel1Op.value+"&telefone_1_dddS="+cmpTel1DDD.value+"&telefone_1S="+cmpTel1.value+"&modS="+modSend+"",
								//dataType: "html",
								success: function(data){
									$("#idsyscliente"+sufixoSend+"").html(data);
									parent.$.fancybox.close();
								},
							});
						}
					}
				}
			}
	
		}
	}
	*/

	if($.trim(cmpCategoria.value)=="") {
		alert("O campo 'Categoria' deve ser preenchido!");
		cmpCategoria.focus();
	} else {
		if($.trim(cmpNome.value)=="") {
			alert("O campo 'Nome' deve ser preenchido!");
			cmpNome.focus();
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/syscliente/add-syscliente.php",
				type: "GET",
				data: "sufixoS="+sufixoSend+"&numeroUnicoS="+cmpNumeroUnico.value+"&nomeS="+cmpNome.value+"&idsyscliente_categoriaS="+cmpCategoria.value+"&idsysusuS="+idsysusuSend+"",
				//dataType: "html",
				success: function(data){
					$("#idsyscliente"+sufixoSend+"").html(data);
					parent.$.fancybox.close();
				},
			});
		}
	}
}

function salvar_fornecedor_ajax(sufixoSend,modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico_pop_sysfornecedor");
	cmpNome = document.getElementById("nome_pop_sysfornecedor");

	/*
	cmpEmail = document.getElementById("email_pop_sysfornecedor");
	cmpSenha = document.getElementById("senha_pop_sysfornecedor");
	cmpComoConheceu = document.getElementById("como_conheceu_pop_sysfornecedor");
	cmpComoConheceuOutro = document.getElementById("como_conheceu_outro_pop_sysfornecedor");
	cmpTel1Op = document.getElementById("telefone_1_operadora_pop_sysfornecedor");
	cmpTel1DDD = document.getElementById("telefone_1_ddd_pop_sysfornecedor");
	cmpTel1 = document.getElementById("telefone_1_pop_sysfornecedor");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido!");
		cmpNome.focus();
	} else {
		if($.trim(cmpEmail.value)=="") {
			alert("O campo 'E-mail' deve ser preenchido!");
			cmpEmail.focus();
		} else {
			if($.trim(cmpSenha.value)=="") {
				alert("O campo 'Senha' deve ser preenchido!");
				cmpSenha.focus();
			} else {
				if($.trim(cmpComoConheceu.value)=="") {
					alert("O campo 'Como Conheceu' deve ser preenchido!");
					cmpComoConheceu.focus();
				} else {
					if($.trim(cmpComoConheceu.value)=="Outros"&&$.trim(cmpComoConheceuOutro.value)=="") {
						alert("O campo 'Como Conheceu - Outros' deve ser preenchido!");
						cmpComoConheceuOutro.focus();
					} else {
						if($.trim(cmpTel1DDD.value)==""||$.trim(cmpTel1.value)=="") {
							alert("O campo 'Telefone' deve ser preenchido!");
							if($.trim(cmpTel1DDD.value)=="") {
								cmpTel1DDD.focus();
							} else {
								cmpTel1.focus();
							}
						} else {
							$.ajax({
								url: ""+linkAdminAcoes+"acoes/sysfornecedor/add-sysfornecedor.php",
								type: "GET",
								data: "sufixoS="+sufixoSend+"&numeroUnicoS="+cmpNumeroUnico.value+"&nomeS="+cmpNome.value+"&emailS="+cmpEmail.value+"&senhaS="+cmpSenha.value+"&como_conheceuS="+cmpComoConheceu.value+"&como_conheceu_outroS="+cmpComoConheceuOutro.value+"&telefone_1_operadoraS="+cmpTel1Op.value+"&telefone_1_dddS="+cmpTel1DDD.value+"&telefone_1S="+cmpTel1.value+"&modS="+modSend+"",
								//dataType: "html",
								success: function(data){
									$("#idsysfornecedor"+sufixoSend+"").html(data);
									parent.$.fancybox.close();
								},
							});
						}
					}
				}
			}
	
		}
	}
	*/

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido!");
		cmpNome.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysfornecedor/add-sysfornecedor.php",
			type: "GET",
			data: "sufixoS="+sufixoSend+"&numeroUnicoS="+cmpNumeroUnico.value+"&nomeS="+cmpNome.value+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				$("#idsysfornecedor"+sufixoSend+"").html(data);
				parent.$.fancybox.close();
			},
		});
	}
}

function salvar_categoria_sysagenda() {
	cmpNome = document.getElementById("nome_categoria");
	cmpCor = document.getElementById("cor_categoria");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido");
		cmpNome.focus();
	} else {
		if($.trim(cmpCor.value)=="") {
			alert("O campo 'Cor' deve ser preenchido");
			cmpCor.focus();
		} else {
			document.form_categoria.submit();
		}
	}
}

function remover_sysagenda_categoria(idSend,idCriador) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysagenda/remover-categoria.php",
			type: "GET",
			data: "idS="+idSend+"&criadorS="+idCriador+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function muda_stat_sysagenda_categoria(idSend,idCriador,statSend) {
	if (confirm("Você realmente deseja modificar o status deste item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysagenda/muda-stat-sysagenda_categoria.php",
			type: "GET",
			data: "idS="+idSend+"&criadorS="+idCriador+"&statS="+statSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function edita_sysagenda_categoria(idSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysagenda/edita-categoria.php",
		type: "GET",
		data: "idS="+idSend+"",
		//dataType: "html",
		success: function(data){
			
			$("#acaoForm_categoria").val("editar-categoria");
			
			$("#iditem_categoria").prop( "disabled", false );
			$("#iditem_categoria").val(""+idSend+"");

			$("#btns-add").hide();
			$("#btns-editar").fadeIn();
			
			$("#form_categoria").html(data);

			$(document).ready(function() {
				//* colorpicker
				beoro_colorpicker.init();
			});

			//* colorpicker
			beoro_colorpicker = {
				init: function() {
					if($('#cor_categoria').length) {
						$('#cor_categoria').colorpicker({
							format: 'hex'
						})
					}
				}
			};
		},
	});
}


function cancela_edita_categoria_sysagenda(criadorSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysagenda/cancela-edita-categoria.php",
		type: "GET",
		data: "criadorS="+criadorSend+"",
		//dataType: "html",
		success: function(data){
			
			$("#acaoForm_categoria").val("add-categoria");
		
			$("#iditem_categoria").prop( "disabled", true );
			$("#iditem_categoria").val("");

			$("#btns-editar").hide();
			$("#btns-add").fadeIn();
			
			$("#form_categoria").html(data);

			$(document).ready(function() {
				//* colorpicker
				beoro_colorpicker.init();
			});

			//* colorpicker
			beoro_colorpicker = {
				init: function() {
					if($('#cor_categoria').length) {
						$('#cor_categoria').colorpicker({
							format: 'hex'
						})
					}
				}
			};
		},
	});
}
function atualiza_dia_sysagenda(idSend,localSend,diaSend,minutoSend,tipoSend) {
	/*
	alert(idSend);
	alert(localSend);
	alert(diaSend);
	*/

	if (confirm("Você realmente deseja modificar este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysagenda/atualiza-dia-sysagenda.php",
			type: "GET",
			data: "idS="+idSend+"&localS="+localSend+"&diaS="+diaSend+"&minutoS="+minutoSend+"&tipoS="+tipoSend+"",
			//dataType: "html",
			success: function(data){
				//location.reload();
			},
		});
	}
}

function filtra_sysagenda(idSend,criadorSend,var1Send,var2Send,corSend,filtroSend) {
 
	$("#preloader-categoria").fadeIn();

	if(filtroSend==1) {
		if($("#check-"+idSend+"").prop("checked")) {
			$("#check-"+idSend+"").prop( "checked", false );
			$('#div-cor-'+idSend+'').css({"background-color":"#FFF"});
			var res = $('#lista-categorias').val().replace("|"+idSend+"|", "");
			$('#lista-categorias').val(""+res+"");
		} else {
			$("#check-"+idSend+"").prop( "checked", true );
			$('#div-cor-'+idSend+'').css({"background-color":"#"+corSend+""});
			$('#lista-categorias').val(""+$('#lista-categorias').val()+"|"+idSend+"|");
		}
	}



	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysagenda/lista_eventos.php",
		type: "GET",
		data: "filtro="+filtroSend+"&listaIdS="+$('#lista-categorias').val()+"&criadorS="+criadorSend+"&var1S="+var1Send+"&var2S="+var2Send+"",
		//dataType: "html",
		success: function(data){

			$('#calendar_json').fullCalendar('removeEvents');

			if($.trim($('#lista-categorias').val())==""&&filtroSend==1) { } else {
				var myevents = JSON.parse(data);
	
				$('#calendar_json').fullCalendar('addEventSource', myevents);
			}

			$("#preloader-categoria").hide();
		},
	});

}

function filtra_sysdashboard(criadorSend,idSend,filtroSend,localSend,corSend) {
 
	//$("#preloader-categoria").fadeIn();
	
	if(filtroSend==1) {
		if($("#check-"+idSend+"-"+localSend+"").prop("checked")) {
			$("#check-"+idSend+"-"+localSend+"").prop( "checked", false );
			$("#div-cor-"+idSend+"-"+localSend+"").css({"background-color":"#FFF"});
			var res = $("#lista-categorias-"+localSend+"").val().replace("|"+idSend+"|", "");
			$("#lista-categorias-"+localSend+"").val(""+res+"");
		} else {
			$("#check-"+idSend+"-"+localSend+"").prop( "checked", true );
			$("#div-cor-"+idSend+"-"+localSend+"").css({"background-color":"#"+corSend+""});
			$("#lista-categorias-"+localSend+"").val(""+$("#lista-categorias-"+localSend+"").val()+"|"+idSend+"|");
		}
	}

	if ($("#lista-categorias-syscronograma").length){
		syscronograma_url = "&listaIdSSyscronograma="+$("#lista-categorias-syscronograma").val()+"";
	} else {
		syscronograma_url = "";
	}
	
	if ($("#lista-categorias-sysagenda").length){
		sysagenda_url = "&listaIdSSysagenda="+$("#lista-categorias-sysagenda").val()+"";
	} else {
		sysagenda_url = "";
	}
	
	if ($("#lista-categorias-sysconta_a_pagar").length){
		sysconta_a_pagar_url = "&listaIdSSysconta_a_pagar="+$("#lista-categorias-sysconta_a_pagar").val()+"";
	} else {
		sysconta_a_pagar_url = "";
	}
	
	if ($("#lista-categorias-sysconta_a_receber").length){
		sysconta_a_receber_url = "&listaIdSSysconta_a_receber="+$("#lista-categorias-sysconta_a_receber").val()+"";
	} else {
		sysconta_a_receber_url = "";
	}
	
	if ($("#lista-categorias-adv_processo").length){
		adv_processo_url = "&listaIdSAdv_processo="+$("#lista-categorias-adv_processo").val()+"";
	} else {
		adv_processo_url = "";
	}

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysdashboard/lista_eventos.php",
		type: "GET",
		data: "filtro="+filtroSend+"&criadorS="+criadorSend+""+syscronograma_url+sysagenda_url+sysconta_a_pagar_url+sysconta_a_receber_url+adv_processo_url+"",
		//dataType: "html",
		success: function(data){
			$("#preloader-categoria").fadeIn();
			$("#preloader-categoria").html(data);

			$('#calendar_json').fullCalendar('removeEvents');

			var myevents = JSON.parse(data);

			$('#calendar_json').fullCalendar('addEventSource', myevents);

			$("#preloader-categoria").hide();
		},
	});

}

function salvar_categoria_com_pai(modSend,subLocalSend) {
	cmpOrdem = document.getElementById("ordem_categoria");
	cmpNome = document.getElementById("nome_categoria");
	cmpSlug = document.getElementById("slug");
	cmpIdpai = document.getElementById("idpai");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Título' deve ser preenchido");
		cmpNome.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/add-categoria.php",
			type: "GET",
			data: "subLocalS="+subLocalSend+"&modS="+modSend+"&nomeS="+cmpNome.value+"&ordemS="+cmpOrdem.value+"&slugS="+cmpSlug.value+"&idpaiS="+cmpIdpai.value+"",
			//dataType: "html",
			success: function(data){
				location.reload();

			},
		});

	}
}

function remover_item_sysprospecto(numeroUnicoSend,sufixoSend,idSend,modSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysprospecto/remover-sysprospecto.php",
			type: "GET",
			data: "numeroUnicoS="+numeroUnicoSend+"&idS="+idSend+"&sufixoS="+sufixoSend+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Item removido com sucesso !", "");

				$("#lista-servicos"+sufixoSend+"").html(data);
			},
		});
	}
}

function salvar_lista_redes(modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	cmpNome = document.getElementById("nome_item");
	cmpLink = document.getElementById("link_item");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido");
		cmpNome.focus();
	} else {
		if($.trim(cmpLink.value)=="") {
			alert("O campo 'Link' deve ser preenchido");
			cmpLink.focus();
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/"+modSend+"/add-lista_redes.php",
				type: "GET",
				data: "nomeS="+cmpNome.value+"&linkS="+cmpLink.value+"&numeroUnicoS="+cmpNumeroUnico.value+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data){
					cmpNome.value = "";
					cmpLink.value = "";
					
					var $toast = toastr["success"]("Rede adicionada com sucesso !", "");
	
					$("#lista_"+modSend+"_redes").html(data);
	
				},
			});
		}
	}
}

function remover_redes(idSend,modSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/"+modSend+"/remover-redes.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Rede removida com sucesso !", "");

				$("#lista_"+modSend+"_redes").html(data);

			},
		});
	}
}

function salvar_lista_syscliente_adv_processo(modSend) {

	if($.trim($("#idsyscliente").val())=="") {
		alert("O campo 'Cliente' deve ser preenchido");
		$("#idsyscliente").focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/adv_processo/add-lista_adv_processo_syscliente.php",
			type: "GET",
			data: "modS="+modSend+"&numeroUnicoS="+$("#numeroUnico").val()+"&idsysclienteS="+$("#idsyscliente").val()+"",
			//dataType: "html",
			success: function(data){
				$("#idsyscliente").val("");
				
				var $toast = toastr["success"]("Item adicionado com sucesso !", "");

				$("#lista_"+modSend+"_syscliente").html(data);

			},
		});
	}

}

function remover_syscliente_adv_processo(idSend,modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	if (confirm("Você realmente deseja remover este cliente ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/adv_processo/remover-adv_processo_syscliente.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Item removido com sucesso !", "");

				$("#lista_"+modSend+"_syscliente").html(data);

			},
		});
	}
}

function salvar_lista_endereco(modSend) {

	if($.trim($("#nome_endereco").val())=="") {
		alert("O campo 'Nome' deve ser preenchido");
		$("#nome_endereco").focus();
	} else {
		if($.trim($("#cep").val())=="") {
			alert("O campo 'CEP' deve ser preenchido");
			$("#cep").focus();
		} else {
			if($.trim($("#rua").val())=="") {
				alert("O campo 'Rua' deve ser preenchido");
				$("#rua").focus();
			} else {
				if($.trim($("#numero").val())=="") {
					alert("O campo 'Número' deve ser preenchido");
					$("#numero").focus();
				} else {
					if($.trim($("#bairro").val())=="") {
						alert("O campo 'Bairro' deve ser preenchido");
						$("#bairro").focus();
					} else {
						if($.trim($("#cidade").val())=="") {
							alert("O campo 'Cidade' deve ser preenchido");
							$("#cidade").focus();
						} else {
							if($.trim($("#estado").val())=="") {
								alert("O campo 'Estado' deve ser preenchido");
								$("#estado").focus();
							} else {
								$.ajax({
									url: ""+linkAdminAcoes+"acoes/syscliente/add-lista_endereco.php",
									type: "GET",
									data: "modS="+modSend+"&numeroUnicoS="+$("#numeroUnico").val()+"&nomeS="+$("#nome_endereco").val()+"&cepS="+$("#cep").val()+"&ruaS="+$("#rua").val()+"&numeroS="+$("#numero").val()+"&complementoS="+$("#complemento").val()+"&bairroS="+$("#bairro").val()+"&cidadeS="+$("#cidade").val()+"&estadoS="+$("#estado").val()+"&principalS="+$("#principal").val()+"",
									//dataType: "html",
									success: function(data){
										$("#nome_endereco").val("");
										$("#cep").val("");
										$("#rua").val("");
										$("#numero").val("");
										$("#complemento").val("");
										$("#bairro").val("");
										$("#cidade").val("");
										$("#estado").val("");
										
										var $toast = toastr["success"]("Endereço adicionado com sucesso !", "");
						
										$("#lista_"+modSend+"_endereco").html(data);
						
									},
								});
							}
						}
					}
				}
			}
		}
	}

}

function remover_endereco(idSend,modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syscliente/remover-endereco.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Endereço removido com sucesso !", "");

				$("#lista_"+modSend+"_endereco").html(data);

			},
		});
	}
}

function principal_endereco(idSend,modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	if (confirm("Você realmente deseja tornar este item como principal ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syscliente/principal-endereco.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["success"]("Endereço principal alterado com sucesso !", "");

				$("#lista_"+modSend+"_endereco").html(data);

			},
		});
	}
}

function principal_telefones(idSend,modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	if (confirm("Você realmente deseja tornar este item como principal ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syscliente/principal-telefones.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["success"]("Telefone principal alterado com sucesso !", "");

				$("#lista_"+modSend+"_telefones").html(data);

			},
		});
	}
}

function salvar_lista_banco(modSend) {

	if($.trim($("#nome_banco").val())=="") {
		alert("O campo 'Nome' deve ser preenchido");
		$("#nome_banco").focus();
	} else {
		if($.trim($("#tipo_conta").val())=="") {
			alert("O campo 'Tipo de Conta' deve ser preenchido");
			$("#tipo_conta").focus();
		} else {
			if($.trim($("#favorecido").val())=="") {
				alert("O campo 'Nome do Favorecido' deve ser preenchido");
				$("#favorecido").focus();
			} else {
				if($.trim($("#favorecido_cpf").val())==""&&($.trim($("#tipo_conta").val())=="cc-pf"||$.trim($("#tipo_conta").val())=="cp-pf")) {
					alert("O campo 'CPF do favorecido' deve ser preenchido");
					$("#favorecido_cpf").focus();
				} else {
					if($.trim($("#favorecido_cnpj").val())==""&&($.trim($("#tipo_conta").val())=="cc-pj"||$.trim($("#tipo_conta").val())=="cp-pj")) {
						alert("O campo 'CNPJ do favorecido' deve ser preenchido");
						$("#favorecido_cnpj").focus();
					} else {
						if($.trim($("#idbanco").val())=="") {
							alert("O campo 'Banco' deve ser preenchido");
							$("#idbanco").focus();
						} else {
							if($.trim($("#agencia").val())=="") {
								alert("O campo 'Agência' deve ser preenchido");
								$("#agencia").focus();
							} else {
								if($.trim($("#conta").val())=="") {
									alert("O campo 'Conta' deve ser preenchido");
									$("#conta").focus();
								} else {
									if($.trim($("#operacao").val())=="") {
										alert("O campo 'Operação' deve ser preenchido");
										$("#operacao").focus();
									} else {
										$.ajax({
											url: ""+linkAdminAcoes+"acoes/"+modSend+"/add-lista_banco.php",
											type: "GET",
											data: "modS="+modSend+"&numeroUnicoS="+$("#numeroUnico").val()+"&nomeS="+$("#nome_banco").val()+"&tipo_contaS="+$("#tipo_conta").val()+"&idbancoS="+$("#idbanco").val()+"&agenciaS="+$("#agencia").val()+"&contaS="+$("#conta").val()+"&operacaoS="+$("#operacao").val()+"&favorecidoS="+$("#favorecido").val()+"&favorecido_cpfS="+$("#favorecido_cpf").val()+"&favorecido_cnpjS="+$("#favorecido_cnpj").val()+"&principalS="+$("#principal_banco").val()+"",
											//dataType: "html",
											success: function(data){
												$("#nome_banco").val("");
												$("#tipo_conta").val("");
												$("#idbanco").val("");
												$("#agencia").val("");
												$("#conta").val("");
												$("#operacao").val("");
												$("#favorecido").val("");
												$("#favorecido_cpf").val("");
												$("#favorecido_cnpj").val("");
												
												var $toast = toastr["success"]("Banco adicionado com sucesso !", "");
								
												$("#lista_"+modSend+"_banco").html(data);
								
											},
										});
									}
								}
							}
						}
					}
				}
			}
		}
	}

}

function tipo_favorecido() {
	if($.trim($("#tipo_conta").val())=="cc-pf"||$.trim($("#tipo_conta").val())=="cp-pf") {
		$("#div-favorecido_cpf").fadeIn();
		$("#div-favorecido_cnpj").hide();
	} else {
		if($.trim($("#tipo_conta").val())=="cc-pj"||$.trim($("#tipo_conta").val())=="cp-pj") {
			$("#div-favorecido_cpf").hide();
			$("#div-favorecido_cnpj").fadeIn();
		} else {
			$("#div-favorecido_cpf").hide();
			$("#div-favorecido_cnpj").hide();
		}
	}
}

function principal_banco(idSend,modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	if (confirm("Você realmente deseja tornar este item como principal ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/"+modSend+"/principal-banco.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["success"]("Banco principal alterado com sucesso !", "");

				$("#lista_"+modSend+"_banco").html(data);

			},
		});
	}
}

function remover_banco(idSend,modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/"+modSend+"/remover-banco.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Banco removido com sucesso !", "");

				$("#lista_"+modSend+"_banco").html(data);

			},
		});
	}
}

function salvar_lista_horario(modSend,idsysusuSend) {

	if($.trim($("#dia_horario").val())=="") {
		alert("O campo 'Dia' deve ser preenchido");
		$("#dia_horario").focus();
	} else {
		if($.trim($("#hora_inicio_horario").val())==""||$.trim($("#hora_inicio_horario").val())=="0:00"||$.trim($("#hora_inicio_horario").val())=="00:00") {
			alert("O campo 'Horário de Início' deve ser preenchido");
			$("#hora_inicio_horario").focus();
		} else {
			if($.trim($("#hora_fim_horario").val())==""||$.trim($("#hora_fim_horario").val())=="0:00"||$.trim($("#hora_fim_horario").val())=="00:00") {
				alert("O campo 'Horário de Fim' deve ser preenchido");
				$("#hora_fim_horario").focus();
			} else {
                $.ajax({
                    url: ""+linkAdminAcoes+"acoes/"+modSend+"/add-lista_horario.php",
                    type: "GET",
                    data: "modS="+modSend+"&idsysusuS="+idsysusuSend+"&numeroUnicoS="+$("#numeroUnico").val()+"&diaS="+$("#dia_horario").val()+"&hora_inicioS="+$("#hora_inicio_horario").val()+"&hora_fimS="+$("#hora_fim_horario").val()+"",
                    //dataType: "html",
                    success: function(data){
                        $("#dia_horario").val("");
                        $("#hora_inicio_horario").val("");
                        $("#hora_fim_horario").val("");
                        
                        var $toast = toastr["success"]("Horário adicionado com sucesso !", "");
        
                        $("#lista_"+modSend+"_horario").html(data);
        
                    },
                });
			}
		}
	}

}

function remover_horario(idSend,modSend,idsysusuSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/"+modSend+"/remover-horario.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"&idsysusuS="+idsysusuSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Horário removido com sucesso !", "");

				$("#lista_"+modSend+"_horario").html(data);

			},
		});
	}
}

function salvar_lista_telefones(modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	cmpPrincipal = document.getElementById("principal_item");
	cmpNome = document.getElementById("nometel_item");
	cmpOperadora = document.getElementById("operadora_item");
	cmpDDD = document.getElementById("ddd_item");
	cmpTelefone = document.getElementById("telefone_item");

	if($.trim(cmpOperadora.value)=="") {
		alert("O campo 'Operadora' deve ser preenchido");
		cmpOperadora.focus();
	} else {
		if($.trim(cmpDDD.value)==""||$.trim(cmpTelefone.value)=="") {
			alert("O campo 'DDD - Telefone' deve ser preenchido");
			if($.trim(cmpDDD.value)=="") {
				cmpDDD.focus();
			} else {
				cmpTelefone.focus();
			}
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/syscliente/add-lista_telefones.php",
				type: "GET",
				data: "principalS="+cmpPrincipal.value+"&nomeS="+cmpNome.value+"&operadoraS="+cmpOperadora.value+"&dddS="+cmpDDD.value+"&telefoneS="+cmpTelefone.value+"&numeroUnicoS="+cmpNumeroUnico.value+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data){
					cmpPrincipal.value = "";
					cmpNome.value = "";
					cmpOperadora.value = "";
					cmpDDD.value = "";
					cmpTelefone.value = "";
					
					var $toast = toastr["success"]("Telefone adicionado com sucesso !", "");
	
					$("#lista_"+modSend+"_telefones").html(data);
	
				},
			});
		}
	}
}

function remover_telefones(idSend,modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syscliente/remover-telefones.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Telefone removido com sucesso !", "");

				$("#lista_"+modSend+"_telefones").html(data);

			},
		});
	}
}

function salvar_lista_emails(modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	cmpNome = document.getElementById("nomeemail_item");
	cmpEmail = document.getElementById("email_item");

	if($.trim(cmpEmail.value)=="") {
		alert("O campo 'E-mail' deve ser preenchido");
		cmpEmail.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/"+modSend+"/add-lista_emails.php",
			type: "GET",
			data: "nomeS="+cmpNome.value+"&emailS="+cmpEmail.value+"&numeroUnicoS="+cmpNumeroUnico.value+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				cmpNome.value = "";
				cmpEmail.value = "";
				
				var $toast = toastr["success"]("E-mail adicionado com sucesso !", "");

				$("#lista_"+modSend+"_emails").html(data);

			},
		});
	}
}

function remover_emails(idSend,modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/"+modSend+"/remover-emails.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("E-mail removido com sucesso !", "");

				$("#lista_"+modSend+"_emails").html(data);

			},
		});
	}
}

function salvar_lista_telefones_plattol_syscliente(modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	cmpNome = document.getElementById("nometel_item");
	cmpOperadora = document.getElementById("operadora_item");
	cmpDDD = document.getElementById("ddd_item");
	cmpTelefone = document.getElementById("telefone_item");

	if($.trim(cmpOperadora.value)=="") {
		alert("O campo 'Operadora' deve ser preenchido");
		cmpOperadora.focus();
	} else {
		if($.trim(cmpDDD.value)==""||$.trim(cmpTelefone.value)=="") {
			alert("O campo 'DDD - Telefone' deve ser preenchido");
			if($.trim(cmpDDD.value)=="") {
				cmpDDD.focus();
			} else {
				cmpTelefone.focus();
			}
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/plattol_syscliente/add-lista_telefones.php",
				type: "GET",
				data: "nomeS="+cmpNome.value+"&operadoraS="+cmpOperadora.value+"&dddS="+cmpDDD.value+"&telefoneS="+cmpTelefone.value+"&numeroUnicoS="+cmpNumeroUnico.value+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data){
					cmpNome.value = "";
					cmpOperadora.value = "";
					cmpDDD.value = "";
					cmpTelefone.value = "";
					
					var $toast = toastr["success"]("Telefone adicionado com sucesso !", "");
	
					$("#lista_"+modSend+"_telefones").html(data);
	
				},
			});
		}
	}
}

function remover_telefones_plattol_syscliente(idSend,modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/plattol_syscliente/remover-telefones.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Telefone removido com sucesso !", "");

				$("#lista_"+modSend+"_telefones").html(data);

			},
		});
	}
}

function salvar_lista_emails_plattol_syscliente(modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	cmpNome = document.getElementById("nomeemail_item");
	cmpEmail = document.getElementById("email_item");

	if($.trim(cmpEmail.value)=="") {
		alert("O campo 'E-mail' deve ser preenchido");
		cmpEmail.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/plattol_syscliente/add-lista_emails.php",
			type: "GET",
			data: "nomeS="+cmpNome.value+"&emailS="+cmpEmail.value+"&numeroUnicoS="+cmpNumeroUnico.value+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				cmpNome.value = "";
				cmpEmail.value = "";
				
				var $toast = toastr["success"]("E-mail adicionado com sucesso !", "");

				$("#lista_"+modSend+"_emails").html(data);

			},
		});
	}
}

function remover_emails_plattol_syscliente(idSend,modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/plattol_syscliente/remover-emails.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("E-mail removido com sucesso !", "");

				$("#lista_"+modSend+"_emails").html(data);

			},
		});
	}
}

function salvar_lista_redes_plattol_syscliente(modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	cmpNome = document.getElementById("nome_item");
	cmpLink = document.getElementById("link_item");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido");
		cmpNome.focus();
	} else {
		if($.trim(cmpLink.value)=="") {
			alert("O campo 'Link' deve ser preenchido");
			cmpLink.focus();
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/plattol_syscliente/add-lista_redes.php",
				type: "GET",
				data: "nomeS="+cmpNome.value+"&linkS="+cmpLink.value+"&numeroUnicoS="+cmpNumeroUnico.value+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data){
					cmpNome.value = "";
					cmpLink.value = "";
					
					var $toast = toastr["success"]("Rede adicionado com sucesso !", "");
	
					$("#lista_"+modSend+"_redes").html(data);
	
				},
			});
		}
	}
}

function remover_redes_plattol_syscliente(idSend,modSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/plattol_syscliente/remover-redes.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Rede removida com sucesso !", "");

				$("#lista_"+modSend+"_redes").html(data);

			},
		});
	}
}

function remover_links(idSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysconfig/remover-links.php",
			type: "GET",
			data: "idS="+idSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Rede removida com sucesso !", "");

				$("#lista_sysconfig_links_itens").html(data);

			},
		});
	}
}

function salvar_lista_links() {
	cmpNome = document.getElementById("nome_item");
	cmpLinkSite = document.getElementById("link_site_item");
	cmpLinkAdmin = document.getElementById("link_admin_item");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido");
		cmpNome.focus();
	} else {
		if($.trim(cmpLinkSite.value)=="") {
			alert("O campo 'Link do Site' deve ser preenchido");
			cmpLinkSite.focus();
		} else {
			if($.trim(cmpLinkAdmin.value)=="") {
				alert("O campo 'Link do Admin' deve ser preenchido");
				cmpLinkAdmin.focus();
			} else {
				$.ajax({
					url: ""+linkAdminAcoes+"acoes/sysconfig/add-lista_links.php",
					type: "GET",
					data: "nomeS="+cmpNome.value+"&linkAdminAcoesS="+cmpLinkSite.value+"&linkAdminS="+cmpLinkAdmin.value+"",
					//dataType: "html",
					success: function(data){
						cmpNome.value = "";
						cmpLinkSite.value = "";
						cmpLinkAdmin.value = "";
						
						var $toast = toastr["success"]("Link adicionado com sucesso !", "");
		
						$("#lista_sysconfig_links_itens").html(data);
		
					},
				});
			}
		}
	}
}


function salvar_lista_endereco(modSend) {

	if($.trim($("#nome_endereco").val())=="") {
		alert("O campo 'Nome' deve ser preenchido");
		$("#nome_endereco").focus();
	} else {
		if($.trim($("#cep").val())=="") {
			alert("O campo 'CEP' deve ser preenchido");
			$("#cep").focus();
		} else {
			if($.trim($("#rua").val())=="") {
				alert("O campo 'Rua' deve ser preenchido");
				$("#rua").focus();
			} else {
				if($.trim($("#numero").val())=="") {
					alert("O campo 'Número' deve ser preenchido");
					$("#numero").focus();
				} else {
					if($.trim($("#bairro").val())=="") {
						alert("O campo 'Bairro' deve ser preenchido");
						$("#bairro").focus();
					} else {
						if($.trim($("#cidade").val())=="") {
							alert("O campo 'Cidade' deve ser preenchido");
							$("#cidade").focus();
						} else {
							if($.trim($("#estado").val())=="") {
								alert("O campo 'Estado' deve ser preenchido");
								$("#estado").focus();
							} else {
								$.ajax({
									url: ""+linkAdminAcoes+"acoes/syscliente/add-lista_endereco.php",
									type: "GET",
									data: "modS="+modSend+"&numeroUnicoS="+$("#numeroUnico").val()+"&nomeS="+$("#nome_endereco").val()+"&cepS="+$("#cep").val()+"&ruaS="+$("#rua").val()+"&numeroS="+$("#numero").val()+"&complementoS="+$("#complemento").val()+"&bairroS="+$("#bairro").val()+"&cidadeS="+$("#cidade").val()+"&estadoS="+$("#estado").val()+"&principalS="+$("#principal").val()+"",
									//dataType: "html",
									success: function(data){
										$("#nome_endereco").val("");
										$("#cep").val("");
										$("#rua").val("");
										$("#numero").val("");
										$("#complemento").val("");
										$("#bairro").val("");
										$("#cidade").val("");
										$("#estado").val("");
										
										var $toast = toastr["success"]("Endereço adicionado com sucesso !", "");
						
										$("#lista_"+modSend+"_endereco").html(data);
						
									},
								});
							}
						}
					}
				}
			}
		}
	}

}

function remover_endereco(idSend,modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syscliente/remover-endereco.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Endereço removido com sucesso !", "");

				$("#lista_"+modSend+"_endereco").html(data);

			},
		});
	}
}

function gera_senha() {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/gera-senha.php",
		type: "GET",
		data: "",
		//dataType: "html",
		success: function(data){
			$("#senha").val(data);
			$(".senha_gerada").html("A senha gerada é: <b>"+data+"</b>");
		},
	});
}

function gera_codigo_produto() {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/gera-codigo.php",
		type: "GET",
		data: "",
		//dataType: "html",
		success: function(data){
			$("#cod").val(data);
		},
	});
}

function cria_titulo_e_url_sem_trava(idTitulo,idCmp_Titulo_seo,idDiv_Titulo_seo,idCmp_url,idDiv_url,txt_preloader,idContador,qtd,limitadorSend){
	//pega valor do campo e converte para letras minúsculas
	texto = $("#"+idTitulo+"").val().toLowerCase();

	//faz as substituições dos acentos
	texto = texto.replace(/[á|ã|â|à]/gi, "a");
	texto = texto.replace(/[é|ê|è]/gi, "e");
	texto = texto.replace(/[í|ì|î]/gi, "i");
	texto = texto.replace(/[õ|ò|ó|ô]/gi, "o");
	texto = texto.replace(/[ú|ù|û]/gi, "u");
	texto = texto.replace(/[ç]/gi, "c");
	texto = texto.replace(/[ñ]/gi, "n");
	texto = texto.replace(/[á|ã|â]/gi, "a");

	//faz a substituição dos espaços e outros caracteres por - (hífen)
	texto = texto.replace(/\W/gi, "-");

	// remove - (hífen) duplicados
	texto = texto.replace(/(\-)\1+/gi, "-");

	total = $("#"+idTitulo+"").val().length;

	if(limitadorSend==0) {
		resto = qtd - total;
		if(resto<0) {
			$("#"+idContador+"").html("<span style='color:#c00;'>"+resto+"</span>");
		} else {
			$("#"+idContador+"").html(resto);
		}

		$("#"+idCmp_Titulo_seo+"_real").val($("#"+idTitulo+"").val());
		$("#"+idCmp_Titulo_seo+"").val($("#"+idTitulo+"").val());
		$("#"+idDiv_Titulo_seo+"").html($("#"+idTitulo+"").val());

		if($.trim(idCmp_url)=="") { } else {
			$("#"+idCmp_url+"_real").val(texto);
			$("#"+idCmp_url+"").val(texto);
			$("#"+idDiv_url+"").html(""+linkSite_Cliente+""+texto+"");
		}
	} else {
		if(total > 0) {
			if(total <= qtd) {
				resto = qtd - total;
				$("#"+idContador+"").html(resto);
				$("#"+idCmp_Titulo_seo+"_real").val($("#"+idTitulo+"").val());
				$("#"+idCmp_Titulo_seo+"").val($("#"+idTitulo+"").val());
				$("#"+idDiv_Titulo_seo+"").html($("#"+idTitulo+"").val());

				if($.trim(idCmp_url)=="") { } else {
					$("#"+idCmp_url+"_real").val(texto);
					$("#"+idCmp_url+"").val(texto);
					$("#"+idDiv_url+"").html(""+linkSite_Cliente+""+texto+"");
				}
			} else {
				$('#'+idCmp_Titulo_seo+'_real').val($('#'+idCmp_Titulo_seo+'_real').val().substr(0, qtd));
				$('#'+idCmp_Titulo_seo+'').val($('#'+idCmp_Titulo_seo+'').val().substr(0, qtd));
			}
		} else {
			$("#"+idCmp_Titulo_seo+"_real").val();
			$("#"+idCmp_Titulo_seo+"").val();
			$("#"+idDiv_Titulo_seo+"").html(txt_preloader);

			if($.trim(idCmp_url)=="") { } else {
				$("#"+idCmp_url+"_real").val(texto);
				$("#"+idCmp_url+"").val(texto);
				$("#"+idDiv_url+"").html(""+linkSite_Cliente+""+texto+"");
			}
		}
	}

}

function cria_titulo_e_url(idTitulo,idCmp_Titulo_seo,idDiv_Titulo_seo,idCmp_url,idDiv_url,txt_preloader,idContador,qtd,limitadorSend){
	//pega valor do campo e converte para letras minúsculas
	texto = $("#"+idTitulo+"").val().toLowerCase();

	//faz as substituições dos acentos
	texto = texto.replace(/[á|ã|â|à]/gi, "a");
	texto = texto.replace(/[é|ê|è]/gi, "e");
	texto = texto.replace(/[í|ì|î]/gi, "i");
	texto = texto.replace(/[õ|ò|ó|ô]/gi, "o");
	texto = texto.replace(/[ú|ù|û]/gi, "u");
	texto = texto.replace(/[ç]/gi, "c");
	texto = texto.replace(/[ñ]/gi, "n");
	texto = texto.replace(/[á|ã|â]/gi, "a");

	//faz a substituição dos espaços e outros caracteres por - (hífen)
	texto = texto.replace(/\W/gi, "-");

	// remove - (hífen) duplicados
	texto = texto.replace(/(\-)\1+/gi, "-");

	total = $("#"+idTitulo+"").val().length;

	titulo_trava = $("#TI_titulo_seo_travada").bootstrapSwitch("state");
	url_trava = $("#TI_url_amigavel_travada").bootstrapSwitch("state");
	
	if(limitadorSend==0) {
		resto = qtd - total;
		if(resto<0) {
			$("#"+idContador+"").html("<span style='color:#c00;'>"+resto+"</span>");
		} else {
			$("#"+idContador+"").html(resto);
		}

		if(titulo_trava===false){
			$("#"+idCmp_Titulo_seo+"_real").val($("#"+idTitulo+"").val());
			$("#"+idCmp_Titulo_seo+"").val($("#"+idTitulo+"").val());
			$("#"+idDiv_Titulo_seo+"").html($("#"+idTitulo+"").val());
		}
	
		if(url_trava===false){
			if($.trim(idCmp_url)=="") { } else {
				$("#"+idCmp_url+"_real").val(texto);
				$("#"+idCmp_url+"").val(texto);
				$("#"+idDiv_url+"").html(""+linkSite_Cliente+""+texto+"");
			}
		}
	} else {
		if(total > 0) {
			if(total <= qtd) {
				resto = qtd - total;
				$("#"+idContador+"").html(resto);
				if(titulo_trava===false){
					$("#"+idCmp_Titulo_seo+"_real").val($("#"+idTitulo+"").val());
					$("#"+idCmp_Titulo_seo+"").val($("#"+idTitulo+"").val());
					$("#"+idDiv_Titulo_seo+"").html($("#"+idTitulo+"").val());
				}
	
				if(url_trava===false){
					if($.trim(idCmp_url)=="") { } else {
						$("#"+idCmp_url+"_real").val(texto);
						$("#"+idCmp_url+"").val(texto);
						$("#"+idDiv_url+"").html(""+linkSite_Cliente+""+texto+"");
					}
				}
			} else {
				if(titulo_trava===false){
					$('#'+idCmp_Titulo_seo+'_real').val($('#'+idCmp_Titulo_seo+'_real').val().substr(0, qtd));
					$('#'+idCmp_Titulo_seo+'').val($('#'+idCmp_Titulo_seo+'').val().substr(0, qtd));
				}
			}
		} else {
			if(titulo_trava===false){
				$("#"+idCmp_Titulo_seo+"_real").val();
				$("#"+idCmp_Titulo_seo+"").val();
				$("#"+idDiv_Titulo_seo+"").html(txt_preloader);
			}
	
			if(url_trava===false){
				if($.trim(idCmp_url)=="") { } else {
					$("#"+idCmp_url+"_real").val(texto);
					$("#"+idCmp_url+"").val(texto);
					$("#"+idDiv_url+"").html(""+linkSite_Cliente+""+texto+"");
				}
			}
		}
	}

}

function cria_seo_titulo_e_url(idCmp_Titulo_seo,idDiv_Titulo_seo,idCmp_url,idDiv_url,txt_preloader,idContador,qtd,limitadorSend){
	//pega valor do campo e converte para letras minúsculas
	texto = $("#"+idCmp_Titulo_seo+"").val().toLowerCase();

	//faz as substituições dos acentos
	texto = texto.replace(/[á|ã|â|à]/gi, "a");
	texto = texto.replace(/[é|ê|è]/gi, "e");
	texto = texto.replace(/[í|ì|î]/gi, "i");
	texto = texto.replace(/[õ|ò|ó|ô]/gi, "o");
	texto = texto.replace(/[ú|ù|û]/gi, "u");
	texto = texto.replace(/[ç]/gi, "c");
	texto = texto.replace(/[ñ]/gi, "n");
	texto = texto.replace(/[á|ã|â]/gi, "a");
	
	//faz a substituição dos espaços e outros caracteres por - (hífen)
	texto = texto.replace(/\W/gi, "-");

	// remove - (hífen) duplicados
	texto = texto.replace(/(\-)\1+/gi, "-");

	total = $("#"+idCmp_Titulo_seo+"").val().length;

	state_trava = $("#TI_url_amigavel_travada").bootstrapSwitch("state");
	  
	$("#"+idCmp_Titulo_seo+"_real").val($("#"+idCmp_Titulo_seo+"").val());

	if(limitadorSend=="N") {
		$("#"+idDiv_Titulo_seo+"").html($("#"+idCmp_Titulo_seo+"").val());
	
		if($.trim(idCmp_url)=="") { } else {
			if(state_trava===false){
				$("#"+idCmp_url+"_real").val(texto);
				$("#"+idCmp_url+"").val(texto);
				$("#"+idDiv_url+"").html(""+linkSite_Cliente+""+texto+"");
			}
		}
	} else {
		if(limitadorSend=="-1") {
			resto = qtd - total;
			$("#"+idContador+"").html(resto);
	
			$("#"+idDiv_Titulo_seo+"").html($("#"+idCmp_Titulo_seo+"").val());
		
			if($.trim(idCmp_url)=="") { } else {
				if(state_trava===false){
					$("#"+idCmp_url+"_real").val(texto);
					$("#"+idCmp_url+"").val(texto);
					$("#"+idDiv_url+"").html(""+linkSite_Cliente+""+texto+"");
				}
			}
		} else {
			if(limitadorSend==0) {
				resto = qtd - total;
				if(resto<0) {
					$("#"+idContador+"").html("<span style='color:#c00;'>"+resto+"</span>");
				} else {
					$("#"+idContador+"").html(resto);
				}
				$("#"+idDiv_Titulo_seo+"").html($("#"+idCmp_Titulo_seo+"").val());
			
				if($.trim(idCmp_url)=="") { } else {
					if(state_trava===false){
						$("#"+idCmp_url+"_real").val(texto);
						$("#"+idCmp_url+"").val(texto);
						$("#"+idDiv_url+"").html(""+linkSite_Cliente+""+texto+"");
					}
				}
			} else {
				if(total > 0) {
					if(total <= qtd) {
						resto = qtd - total;
						$("#"+idContador+"").html(resto);
						$("#"+idDiv_Titulo_seo+"").html($("#"+idCmp_Titulo_seo+"").val());
			
						if($.trim(idCmp_url)=="") { } else {
							if(state_trava===false){
								$("#"+idCmp_url+"_real").val(texto);
								$("#"+idCmp_url+"").val(texto);
								$("#"+idDiv_url+"").html(""+linkSite_Cliente+""+texto+"");
							}
						}
					} else {
						resto = qtd - total;
						$("#"+idContador+"").html(resto);
						$('#'+idCmp_Titulo_seo+'_real').val($('#'+idCmp_Titulo_seo+'').val().substr(0, qtd));
						$('#'+idCmp_Titulo_seo+'').val($('#'+idCmp_Titulo_seo+'').val().substr(0, qtd));
					}
				} else {
					resto = qtd - total;
					$("#"+idContador+"").html(resto);
					$("#"+idCmp_Titulo_seo+"_real").val();
					$("#"+idCmp_Titulo_seo+"").val();
					$("#"+idDiv_Titulo_seo+"").html(txt_preloader);
			
					if($.trim(idCmp_url)=="") { } else {
						if(state_trava===false){
							$("#"+idCmp_url+"_real").val();
							$("#"+idCmp_url+"").val();
							$("#"+idDiv_url+"").html(""+linkSite_Cliente+"");
						}
					}
				}
			}
		}
	}

}

function adicionar_video(modSend,sufixoSend) {
	cmpNome = document.getElementById("nome_video"+sufixoSend+"");
	cmpNumeroUnico = document.getElementById("numeroUnico"+sufixoSend+"");
	cmpLink = document.getElementById("link_video"+sufixoSend+"");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido.");
		cmpNome.focus();
	} else {
		if($.trim(cmpLink.value)=="") {
			alert("O campo 'Link' deve ser preenchido.");
			cmpLink.focus();
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/portfolio/add-video.php",
				type: "GET",
				data: "nomeS="+cmpNome.value+"&numeroUnicoS="+cmpNumeroUnico.value+"&sufixoS="+sufixoSend+"&modS="+modSend+"&linkS="+cmpLink.value+"",
				//dataType: "html",
				success: function(data){
					var $toast = toastr["success"]("Vídeo adicionado com sucesso !", "");
		
					$("#galeria-video"+sufixoSend+"").html(data);
					cmpNome.value = "";
					cmpLink.value = "";
				},
			});
		}
	}
}

function edita_portfolio_video_ajax(idSend,modSend) {
	cmpNome = document.getElementById("nome_video");
	cmpOrdem = document.getElementById("ordem_video");
	cmpLink = document.getElementById("link_video");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido");
		cmpNome.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/edita-portfolio_video.php",
			type: "GET",
			data: "nomeS="+cmpNome.value+"&linkS="+cmpLink.value+"&idS="+idSend+"&ordemS="+cmpOrdem.value+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
				/*
				parent.$.fancybox.close();

				$("#galeria-fotos").html(data);
	
				parent.$.sticky("Foto editada com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
				*/
				
			},
		});
	}
}

function controle_meta_description(idCmp_Texto,idDiv_Texto_Seo,idDiv_Contador,txt_preloader,qtd,limitadorSend){

	total = $("#"+idCmp_Texto+"").val().length;

	if(limitadorSend=="N") {
		$("#"+idDiv_Texto_Seo+"").html($("#"+idCmp_Texto+"").val());
	} else {
		if(limitadorSend==0) {
			resto = qtd - total;
			if(resto<0) {
				$("#"+idDiv_Contador+"").html("<span style='color:#c00;'>"+resto+"</span>");
			} else {
				$("#"+idDiv_Contador+"").html(resto);
			}
			$("#"+idDiv_Texto_Seo+"").html($("#"+idCmp_Texto+"").val());
		} else {
			if(total > 0) {
				if(total <= qtd) {
					resto = qtd - total;
					$("#"+idDiv_Contador+"").html(resto);
					$("#"+idDiv_Texto_Seo+"").html($("#"+idCmp_Texto+"").val());
				} else {
					$('#'+idCmp_Texto+'').val($('#'+idCmp_Texto+'').val().substr(0, qtd));
				}
			} else {
				$("#"+idDiv_Texto_Seo+"").html(txt_preloader);
			}
		}
	}

}

function controle_caracteres_especiais(idTitulo){
	//pega valor do campo e converte para letras minúsculas
	texto = $("#"+idTitulo+"").val().toLowerCase();

	//faz as substituições dos acentos
	texto = texto.replace(/[á|ã|â|à]/gi, "a");
	texto = texto.replace(/[é|ê|è]/gi, "e");
	texto = texto.replace(/[í|ì|î]/gi, "i");
	texto = texto.replace(/[õ|ò|ó|ô]/gi, "o");
	texto = texto.replace(/[ú|ù|û]/gi, "u");
	texto = texto.replace(/[ç]/gi, "c");
	texto = texto.replace(/[ñ]/gi, "n");
	texto = texto.replace(/[á|ã|â]/gi, "a");

	//faz a substituição dos espaços e outros caracteres por - (hífen)
	texto = texto.replace(/\W/gi, "-");

	// remove - (hífen) duplicados
	texto = texto.replace(/(\-)\1+/gi, "-");

	$("#"+idTitulo+"").val(texto);
}
function controle_url_amigavel(idTitulo,idTitulo_Seo){
	//pega valor do campo e converte para letras minúsculas
	texto = $("#"+idTitulo+"").val().toLowerCase();

	//faz as substituições dos acentos
	texto = texto.replace(/[á|ã|â|à]/gi, "a");
	texto = texto.replace(/[é|ê|è]/gi, "e");
	texto = texto.replace(/[í|ì|î]/gi, "i");
	texto = texto.replace(/[õ|ò|ó|ô]/gi, "o");
	texto = texto.replace(/[ú|ù|û]/gi, "u");
	texto = texto.replace(/[ç]/gi, "c");
	texto = texto.replace(/[ñ]/gi, "n");
	texto = texto.replace(/[á|ã|â]/gi, "a");

	//faz a substituição dos espaços e outros caracteres por - (hífen)
	texto = texto.replace(/\W/gi, "-");

	// remove - (hífen) duplicados
	texto = texto.replace(/(\-)\1+/gi, "-");

	$("#"+idTitulo+"_real").val(texto);
	$("#"+idTitulo+"").val(texto);
	$("#"+idTitulo_Seo+"").html(""+linkSite_Cliente+""+texto+"");
}

function controle_url_amigavel_apenas(idCmp_titulo,idCmp_url){
	//pega valor do campo e converte para letras minúsculas
	texto = $("#"+idCmp_titulo+"").val().toLowerCase();

	//faz as substituições dos acentos
	texto = texto.replace(/[á|ã|â|à]/gi, "a");
	texto = texto.replace(/[é|ê|è]/gi, "e");
	texto = texto.replace(/[í|ì|î]/gi, "i");
	texto = texto.replace(/[õ|ò|ó|ô]/gi, "o");
	texto = texto.replace(/[ú|ù|û]/gi, "u");
	texto = texto.replace(/[ç]/gi, "c");
	texto = texto.replace(/[ñ]/gi, "n");
	texto = texto.replace(/[á|ã|â]/gi, "a");

	//faz a substituição dos espaços e outros caracteres por - (hífen)
	texto = texto.replace(/\W/gi, "-");

	// remove - (hífen) duplicados
	texto = texto.replace(/(\-)\1+/gi, "-");

	$("#"+idCmp_url+"").val(texto);
}

function controle_nome_base_apenas(idCmp_titulo,idCmp_url){
	//pega valor do campo e converte para letras minúsculas
	texto = $("#"+idCmp_titulo+"").val().toLowerCase();

	//faz as substituições dos acentos
	texto = texto.replace(/[á|ã|â|à]/gi, "a");
	texto = texto.replace(/[é|ê|è]/gi, "e");
	texto = texto.replace(/[í|ì|î]/gi, "i");
	texto = texto.replace(/[õ|ò|ó|ô]/gi, "o");
	texto = texto.replace(/[ú|ù|û]/gi, "u");
	texto = texto.replace(/[ç]/gi, "c");
	texto = texto.replace(/[ñ]/gi, "n");
	texto = texto.replace(/[á|ã|â]/gi, "a");

	//faz a substituição dos espaços e outros caracteres por - (hífen)
	texto = texto.replace(/\W/gi, "_");

	// remove - (hífen) duplicados

	texto = texto.replace(/(\-)\1+/gi, "_");

	$("#"+idCmp_url+"").val(texto);
}


function cria_nome_slug(idCmp_origem,idCmp_exibe,idCmp_real){
	//pega valor do campo e converte para letras minúsculas
	texto = $("#"+idCmp_origem+"").val().toLowerCase();

	//faz as substituições dos acentos
	texto = texto.replace(/[á|ã|â|à]/gi, "a");
	texto = texto.replace(/[é|ê|è]/gi, "e");
	texto = texto.replace(/[í|ì|î]/gi, "i");
	texto = texto.replace(/[õ|ò|ó|ô]/gi, "o");
	texto = texto.replace(/[ú|ù|û]/gi, "u");
	texto = texto.replace(/[ç]/gi, "c");
	texto = texto.replace(/[ñ]/gi, "n");
	texto = texto.replace(/[á|ã|â]/gi, "a");

	//faz a substituição dos espaços e outros caracteres por - (hífen)
	texto = texto.replace(/\W/gi, "-");

	// remove - (hífen) duplicados

	texto = texto.replace(/(\-)\1+/gi, "-");

	$("#"+idCmp_exibe+"").val(texto);
	$("#"+idCmp_real+"").val(texto);
}

function pasta_pai(idSend) {
	$( "#idpai" ).val(idSend);
}

function monta_contrato_cliente(sufixoSend,idsysusuSend,linkSend,var1Send,var2Send) {
	idContrato = $("#idsyscontrato_modelo"+sufixoSend+"").val();

	idCliente = $("#idsyscliente"+sufixoSend+"").val();

	if($.trim(idCliente)=="") {
		alert("Um cliente deve ser selecionado");
		$("#idsyscliente"+sufixoSend+"").focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syscontrato/retorna-dados-cliente.php",
			type: "GET",
			data: "idS="+idCliente+"&sufixoS="+sufixoSend+"",
			//dataType: "html",
			success: function(data){
				$("#dados_cliente"+sufixoSend+"").html(data);
			},
		});
	
		if($.trim(idContrato)=="") {
			alert("Um contrato deve ser selecionado");
			$("#idsyscontrato_modelo"+sufixoSend+"").focus();
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/syscontrato/retorna-contrato-email.php",
				type: "GET",
				data: "idContratoS="+idContrato+"&sufixoS="+sufixoSend+"&idsysusuS="+idsysusuSend+"&idClienteS="+idCliente+"&linkS="+linkSend+"&var1S="+var1Send+"&var2S="+var2Send+"",
				//dataType: "html",
				success: function(data){
					$("#texto_email_contrato"+sufixoSend+"").fadeIn();
					$("#contrato_email_content"+sufixoSend+"").html(data);
	
					var config_email = {
						toolbar : [
								{ name: 'document', items: [ 'Source', '-', 'Preview' ] },
								{ name: 'paragraph', groups: [ 'list' ], items: [ 'NumberedList', 'BulletedList' ] },
								{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
								{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
								{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
								{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
								{ name: 'tools', items: [ 'Maximize' ] },
							]
					}
					
					CKEDITOR.replace( 'contrato_email_content'+sufixoSend+'', config_email );
				},
			});

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/syscontrato/retorna-contrato.php",
				type: "GET",
				data: "idContratoS="+idContrato+"&sufixoS="+sufixoSend+"&idsysusuS="+idsysusuSend+"&idClienteS="+idCliente+"",
				//dataType: "html",
				success: function(data){
					$("#texto_contrato"+sufixoSend+"").fadeIn();
					$("#contrato_content"+sufixoSend+"").html(data);
	
					var config = {
						toolbar : [
								{ name: 'document', items: [ 'Source', '-', 'Preview' ] },
								{ name: 'paragraph', groups: [ 'list' ], items: [ 'NumberedList', 'BulletedList' ] },
								{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
								{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
								{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
								{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
								{ name: 'tools', items: [ 'Maximize' ] },
							]
					}
					
					CKEDITOR.replace( 'contrato_content'+sufixoSend+'', config );

				},
			});
		}
	}
}

function seleciona_layout_background() {
	if($.trim($("#background_tipo").val())=="cor") {
		$("#background_div_cor").fadeIn();
		$("#background_div_img").hide();
		$("#background_div_img_tipo").hide();
	} else {
		$("#background_div_cor").hide();
		$("#background_div_img").fadeIn();
		$("#background_div_img_tipo").fadeIn();
	}
}

function qtd_colunas() {
	if($.trim($("#coluna").val())=="1") {
		$("#coluna_1").fadeIn();
		$("#coluna_2").hide();
	} else {
		if($.trim($("#coluna").val())=="2") {
			$("#coluna_1").fadeIn();
			$("#coluna_2").fadeIn();
		} else {
			$("#coluna_1").hide();
			$("#coluna_2").hide();
		}
	}
}

function seleciona_tipo_rodape(boxSend) {
	if($.trim($("#tipo_"+boxSend+"").val())=="texto") {
		$("#modulo_"+boxSend+"_div").hide();
		$("#texto_"+boxSend+"_div").fadeIn();
		$("#link_"+boxSend+"_div").hide();
		$("#imagem_"+boxSend+"_div").hide();
		$("#rede_social_"+boxSend+"_div").hide();
	} else {
		if($.trim($("#tipo_"+boxSend+"").val())=="imagem") {
			$("#modulo_"+boxSend+"_div").hide();
			$("#texto_"+boxSend+"_div").hide();
			$("#link_"+boxSend+"_div").hide();
			$("#imagem_"+boxSend+"_div").fadeIn();
			$("#rede_social_"+boxSend+"_div").hide();
		} else {
			if($.trim($("#tipo_"+boxSend+"").val())=="link") {
				$("#modulo_"+boxSend+"_div").hide();
				$("#texto_"+boxSend+"_div").hide();
				$("#link_"+boxSend+"_div").fadeIn();
				$("#imagem_"+boxSend+"_div").hide();
				$("#rede_social_"+boxSend+"_div").hide();
			} else {
				if($.trim($("#tipo_"+boxSend+"").val())=="texto-imagem") {
					$("#modulo_"+boxSend+"_div").hide();
					$("#texto_"+boxSend+"_div").fadeIn();
					$("#link_"+boxSend+"_div").hide();
					$("#imagem_"+boxSend+"_div").fadeIn();
					$("#rede_social_"+boxSend+"_div").hide();
				} else {
					if($.trim($("#tipo_"+boxSend+"").val())=="texto-link") {
						$("#modulo_"+boxSend+"_div").hide();
						$("#texto_"+boxSend+"_div").fadeIn();
						$("#link_"+boxSend+"_div").fadeIn();
						$("#imagem_"+boxSend+"_div").hide();
						$("#rede_social_"+boxSend+"_div").hide();
					} else {
						if($.trim($("#tipo_"+boxSend+"").val())=="texto-imagem-link") {
							$("#modulo_"+boxSend+"_div").hide();
							$("#texto_"+boxSend+"_div").fadeIn();
							$("#link_"+boxSend+"_div").fadeIn();
							$("#imagem_"+boxSend+"_div").fadeIn();
							$("#rede_social_"+boxSend+"_div").hide();
						} else {
							if($.trim($("#tipo_"+boxSend+"").val())=="imagem-link") {
								$("#modulo_"+boxSend+"_div").hide();
								$("#texto_"+boxSend+"_div").hide();
								$("#link_"+boxSend+"_div").fadeIn();
								$("#imagem_"+boxSend+"_div").fadeIn();
								$("#rede_social_"+boxSend+"_div").hide();
							} else {
								if($.trim($("#tipo_"+boxSend+"").val())=="modulo") {
									$("#modulo_"+boxSend+"_div").fadeIn();
									$("#texto_"+boxSend+"_div").hide();
									$("#link_"+boxSend+"_div").hide();
									$("#imagem_"+boxSend+"_div").hide();
									$("#rede_social_"+boxSend+"_div").hide();
								} else {
									if($.trim($("#tipo_"+boxSend+"").val())=="rede_social") {
										$("#modulo_"+boxSend+"_div").hide();
										$("#texto_"+boxSend+"_div").hide();
										$("#link_"+boxSend+"_div").hide();
										$("#imagem_"+boxSend+"_div").hide();
										$("#rede_social_"+boxSend+"_div").fadeIn();
									} else {
										$("#modulo_"+boxSend+"_div").hide();
										$("#texto_"+boxSend+"_div").hide();
										$("#link_"+boxSend+"_div").hide();
										$("#imagem_"+boxSend+"_div").hide();
										$("#rede_social_"+boxSend+"_div").hide();
									}
								}
							}
						}
					}
				}
			}
		}
	}
}

function tipo_menu(sufixoSend) {
	if($.trim($("#tipo"+sufixoSend+"").val())=="1") {
		$("#idpai_sub"+sufixoSend+"").fadeIn();
		$("#modulo_sub"+sufixoSend+"").fadeIn();
		$("#link_sub"+sufixoSend+"").fadeIn();
	} else {
		if($.trim($("#tipo"+sufixoSend+"").val())=="2") {
			$("#idpai_sub"+sufixoSend+"").hide();
			$("#modulo_sub"+sufixoSend+"").fadeIn();
			$("#link_sub"+sufixoSend+"").fadeIn();
		} else {
			$("#idpai_sub"+sufixoSend+"").hide();
			$("#modulo_sub"+sufixoSend+"").hide();
			$("#link_sub"+sufixoSend+"").hide();
		}
	}
}

function acao_selecionados_script_dash(campoSend,scriptSend,numeroUnicoSend){
	$("#script_campo"+numeroUnicoSend+"").val(""+campoSend+"");
	$("#script_script"+numeroUnicoSend+"").val(""+scriptSend+"");

	aChk = document.getElementsByName('msg_sel[]');
	sel=0;
	for (i=0;i<aChk.length;i++){
		if (aChk[i].checked == true){
			sel=1;
		}
	}

	if (sel==0){
		alert("Você deve selecionar pelo menos um item da lista !");
	}  else {
		if (confirm("Você deseja aplicar esta ação aos itens selecionados ?")) {
			$( "#list"+numeroUnicoSend+"" ).submit();
		}
	}
}

function acao_selecionados_dash(acaoSend,subModSend,numeroUnicoSend){
	$("#script_campo").val("");
	$("#script_script").val("");

	$("#acaoForm_lista"+numeroUnicoSend+"").val(""+acaoSend+""+subModSend+"");

	aChk = document.getElementsByName('msg_sel[]');
	sel=0;
	for (i=0;i<aChk.length;i++){
		if (aChk[i].checked == true){
			sel=1;
		}
	}

	if(acaoSend=="publicar") {
		textoOperacao = "Você tem certeza que deseja publicar os itens selecionados ?";
		confirmacaoSet = 0;
	} else {
		if(acaoSend=="despublicar") {
			textoOperacao = "Você tem certeza que deseja despublicar os itens selecionados ?";
			confirmacaoSet = 0;
		} else {
			if(acaoSend=="excluir") { 
				textoOperacao = "Você tem certeza que deseja excluir os itens selecionados ?"; 
				confirmacaoSet = 1;
			}
		}  
	}  

	if (sel==0){
		alert("Você deve selecionar pelo menos um item da lista !");
	}  else {
		if(confirmacaoSet==1) {
			if (confirm(""+textoOperacao+"")) {
				$( "#list"+numeroUnicoSend+"" ).submit();
			}
		} else {
			$( "#list"+numeroUnicoSend+"" ).submit();
		}
	}
}

function acao_selecionados(acaoSend,subModSend){
	$("#script_campo").val("");
	$("#script_script").val("");

	$("#acaoForm_lista").val(""+acaoSend+""+subModSend+"");

	aChk = document.getElementsByName('msg_sel[]');
	sel=0;
	for (i=0;i<aChk.length;i++){
		if (aChk[i].checked == true){
			sel=1;
		}
	}

	if(acaoSend=="publicar") {
		textoOperacao = "Você tem certeza que deseja publicar os itens selecionados ?";
		confirmacaoSet = 0;
	} else {
		if(acaoSend=="despublicar") {
			textoOperacao = "Você tem certeza que deseja despublicar os itens selecionados ?";
			confirmacaoSet = 0;
		} else {
			if(acaoSend=="excluir") { 
				textoOperacao = "Você tem certeza que deseja excluir os itens selecionados ?"; 
				confirmacaoSet = 1;
			}
		}  
	}  

	if (sel==0){
		alert("Você deve selecionar pelo menos um item da lista !");
	}  else {
		if(confirmacaoSet==1) {
			if (confirm(""+textoOperacao+"")) {
				document.list.submit();
			}
		} else {
			document.list.submit();
		}
	}
}


function modificar_idioma(linguagemSend) {
	if (linguagemSend=="pt_") {
		$( ".form_linguagem" ).hide();
		$( "#form_linguagem_pt" ).fadeIn();

		$( "#linguagem_pt" ).removeClass( "linguagem-sem-borda" ).addClass( "linguagem" );
		$( "#linguagem_en" ).removeClass( "linguagem" ).addClass( "linguagem-sem-borda" );

		$( "#linguagem_pt" ).css({"background-color":"#F8F8F8"});
		$( "#linguagem_en" ).css({"background-color":"#eeeeee"});

		$( "#linguagem" ).val("");
	} else {
		$( ".form_linguagem" ).hide();
		$( "#form_linguagem_en" ).fadeIn();

		$( "#linguagem_en" ).removeClass( "linguagem-sem-borda" ).addClass( "linguagem" );
		$( "#linguagem_pt" ).removeClass( "linguagem" ).addClass( "linguagem-sem-borda" );

		$( "#linguagem_en" ).css({"background-color":"#F8F8F8"});
		$( "#linguagem_pt" ).css({"background-color":"#eeeeee"});

		$( "#linguagem" ).val(""+linguagemSend+"");
	}

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/set-linguagem.php",
		type: "GET",
		data: "linguagemS="+linguagemSend+"",
		//dataType: "html",
		success: function(data){
			location.reload();
		},
	});
}

function mostra_esconde(idSend) {
	if( $('#'+idSend).is(':visible') ) {
		$('#'+idSend).fadeOut('slow');
	} else {
		$('#'+idSend).fadeIn('slow');
	}
}

function verMais(id_componente) {
	display = $('#'+id_componente).css("display");
	if (display=="none") {
		$('#'+id_componente).fadeIn('slow');
	}else{
		$('#'+id_componente).fadeOut('slow');
	}
}

function delCaixaEntrada() {
	aChk = document.getElementsByName('msg_sel[]');
	sel=0;
	for (i=0;i<aChk.length;i++){
		if (aChk[i].checked == true){
			sel=1;
		}
	}

	if (sel==0){
		alert("Você deve selecionar ao menos uma mensagem !");
	}  else {
		if (confirm("Você tem certeza que deseja mover as mensagens selecionadas para a lixeira ?")) {
			document.formsList.submit();
		}
	}
}

function restauraLixeira() {
	cmpAcao = document.getElementById("idacaoForm");
	cmpAcao.value = "restaurar";
	aChk = document.getElementsByName('msg_sel[]');
	sel=0;
	for (i=0;i<aChk.length;i++){
		if (aChk[i].checked == true){
			sel=1;
		}
	}

	if (sel==0){
		alert("Você deve selecionar ao menos uma mensagem !");
	}  else {
		if (confirm("Você tem certeza que deseja restaurar as mensagens selecionada para a caixa de entrada ?")) {
			document.formsList.submit();
		}
	}
}

function delLixeira() {
	cmpAcao = document.getElementById("idacaoForm");
	cmpAcao.value = "remover";
	aChk = document.getElementsByName('msg_sel[]');
	sel=0;
	for (i=0;i<aChk.length;i++){
		if (aChk[i].checked == true){
			sel=1;
		}
	}

	if (sel==0){
		alert("Você deve selecionar ao menos uma mensagem !");
	}  else {
		if (confirm("Você tem certeza que deseja remover permanentemente as mensagens selecionada ?")) {
			document.formsList.submit();
		}
	}
}


function salvar_usuario_restrito_projeto_midia_perm(localSend,sufixoSend) {
	cmpNumeroUnico_pai = document.getElementById("numeroUnico_pai"+sufixoSend+"");

	cmpNumeroUnico = document.getElementById("numeroUnico"+sufixoSend+"");
	cmpUsuario = document.getElementById("idsysusu"+sufixoSend+"");

	cmpVisualizar = document.getElementById("visualizar"+sufixoSend+"_real");
	cmpCriar = document.getElementById("criar"+sufixoSend+"_real");
	cmpRenomear = document.getElementById("renomear"+sufixoSend+"_real");
	cmpExcluir = document.getElementById("excluir"+sufixoSend+"_real");
	cmpPerm = document.getElementById("perm"+sufixoSend+"_real");
	cmpBaixar = document.getElementById("baixar"+sufixoSend+"_real");
	

	$("#btn-adicionar"+sufixoSend+"").hide();
	$("#btn-carregando"+sufixoSend+"").fadeIn();
	
	if($.trim(cmpNumeroUnico_pai.value)=="0") {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/"+localSend+"/usuario-verifica.php",
			type: "GET",
			data: "numeroUnicoS="+cmpNumeroUnico.value+"&idsysusuS="+cmpUsuario.value+"",
			//dataType: "html",
			success: function(data){
				retorno = data;

				if(parseInt(retorno)==0) {
					$.ajax({
						url: ""+linkAdminAcoes+"acoes/"+localSend+"/usuario-perm.php",
						type: "GET",
						data: "sufixoS="+sufixoSend+"&numeroUnicoS="+cmpNumeroUnico.value+"&idsysusuS="+cmpUsuario.value+"&visualizarS="+cmpVisualizar.value+"&criarS="+cmpCriar.value+"&renomearS="+cmpRenomear.value+"&excluirS="+cmpExcluir.value+"&permS="+cmpPerm.value+"&baixarS="+cmpBaixar.value+"",
						//dataType: "html",
						success: function(data){
							cmpUsuario.value = "";
		
							cmpVisualizar.value = "0";
							cmpCriar.value = "0";
							cmpRenomear.value = "0";
							cmpExcluir.value = "0";
							cmpPerm.value = "0";
							cmpBaixar.value = "0";
		
							$("#campo_usuario"+sufixoSend+"").fadeOut();
				
							$("#lista_usuarios"+sufixoSend+"").html(data);

							$("#btn-carregando"+sufixoSend+"").hide();
							$("#btn-adicionar"+sufixoSend+"").fadeIn();
						},
					});
				} else {
					alert("Este usuário já teve suas permissões setadas neste projeto!");

					$("#btn-carregando"+sufixoSend+"").hide();
					$("#btn-adicionar"+sufixoSend+"").fadeIn();
				}
			},
		});
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/"+localSend+"/usuario-verifica-perm.php",
			type: "GET",
			data: "numeroUnico_paiS="+cmpNumeroUnico_pai.value+"&idsysusuS="+cmpUsuario.value+"",
			//dataType: "html",
			success: function(data){
				perm_retorno = data;
			},
		});
	
		window.setTimeout(function() {
			if(parseInt(perm_retorno)==0) {
				/*$.sticky("Usuario removido com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });*/
				alert("Este usuário não tem permissão na pasta superior à esta, para ele conseguir visualizar este conteúdo, você deve setar no mínimo permissão de visualização da pasta superior !");
				$("#btn-carregando"+sufixoSend+"").hide();
				$("#btn-adicionar"+sufixoSend+"").fadeIn();
			} else {
				$.ajax({
					url: ""+linkAdminAcoes+"acoes/"+localSend+"/usuario-verifica.php",
					type: "GET",
					data: "numeroUnicoS="+cmpNumeroUnico.value+"&idsysusuS="+cmpUsuario.value+"",
					//dataType: "html",
					success: function(data){
						retorno = data;
		
						if(parseInt(retorno)==0) {
							$.ajax({
								url: ""+linkAdminAcoes+"acoes/"+localSend+"/usuario-perm.php",
								type: "GET",
								data: "sufixoS="+sufixoSend+"&numeroUnicoS="+cmpNumeroUnico.value+"&idsysusuS="+cmpUsuario.value+"&visualizarS="+cmpVisualizar.value+"&criarS="+cmpCriar.value+"&renomearS="+cmpRenomear.value+"&excluirS="+cmpExcluir.value+"&permS="+cmpPerm.value+"&baixarS="+cmpBaixar.value+"",
								//dataType: "html",
								success: function(data){
									cmpUsuario.value = "";
				
									cmpVisualizar.value = "0";
									cmpCriar.value = "0";
									cmpRenomear.value = "0";
									cmpExcluir.value = "0";
									cmpPerm.value = "0";
									cmpBaixar.value = "0";
				
									$("#campo_usuario"+sufixoSend+"").fadeOut();
						
									$("#lista_usuarios"+sufixoSend+"").html(data);
	
									$("#btn-carregando"+sufixoSend+"").hide();
									$("#btn-adicionar"+sufixoSend+"").fadeIn();
								},
							});
						} else {
							alert("Este usuário já teve suas permissões setadas neste projeto!");
	
							$("#btn-carregando"+sufixoSend+"").hide();
							$("#btn-adicionar"+sufixoSend+"").fadeIn();
						}
					},
				});
			}
		}, 500);
	}

}

function salvar_usuario_restrito_projeto_perm(localSend,sufixoSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico"+sufixoSend+"");
	cmpUsuario = document.getElementById("idsysusu"+sufixoSend+"");

	cmpVisualizarProjeto = document.getElementById("visualizar_projeto"+sufixoSend+"_real");
	cmpInfoProjeto = document.getElementById("info_projeto"+sufixoSend+"_real");
	cmpPermProjeto = document.getElementById("perm_projeto"+sufixoSend+"_real");
	cmpExcluirProjeto = document.getElementById("excluir_projeto"+sufixoSend+"_real");

	cmpVisualizarPasta = document.getElementById("visualizar_pasta"+sufixoSend+"_real");
	cmpCriarPasta = document.getElementById("criar_pasta"+sufixoSend+"_real");
	cmpRenomearPasta = document.getElementById("renomear_pasta"+sufixoSend+"_real");
	cmpExcluirPasta = document.getElementById("excluir_pasta"+sufixoSend+"_real");

	cmpUploadArquivo = document.getElementById("upload_arquivo"+sufixoSend+"_real");
	cmpExcluirArquivo = document.getElementById("excluir_arquivo"+sufixoSend+"_real");
	cmpRenomearArquivo = document.getElementById("renomear_arquivo"+sufixoSend+"_real");
	cmpBaixarArquivo = document.getElementById("baixar_arquivo"+sufixoSend+"_real");

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/"+localSend+"/usuario-verifica.php",
		type: "GET",
		data: "numeroUnicoS="+cmpNumeroUnico.value+"&idsysusuS="+cmpUsuario.value+"",
		//dataType: "html",
		success: function(data){
			retorno = data;
		},
	});

	window.setTimeout(function() {
		if(parseInt(retorno)==0) {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/"+localSend+"/usuario-perm.php",
				type: "GET",
				data: "sufixoS="+sufixoSend+"&numeroUnicoS="+cmpNumeroUnico.value+"&idsysusuS="+cmpUsuario.value+"&visualizar_projetoS="+cmpVisualizarProjeto.value+"&info_projetoS="+cmpInfoProjeto.value+"&perm_projetoS="+cmpPermProjeto.value+"&excluir_projetoS="+cmpExcluirProjeto.value+"&visualizar_pastaS="+cmpVisualizarPasta.value+"&criar_pastaS="+cmpCriarPasta.value+"&renomear_pastaS="+cmpRenomearPasta.value+"&excluir_pastaS="+cmpExcluirPasta.value+"&upload_arquivoS="+cmpUploadArquivo.value+"&excluir_arquivoS="+cmpExcluirArquivo.value+"&renomear_arquivoS="+cmpRenomearArquivo.value+"&baixar_arquivoS="+cmpBaixarArquivo.value+"",
				//dataType: "html",
				success: function(data){
					cmpUsuario.value = "";

					cmpVisualizarProjeto.value = "0";
					cmpInfoProjeto.value = "0";
					cmpPermProjeto.value = "0";
					cmpExcluirProjeto.value = "0";

					cmpVisualizarPasta.value = "0";
					cmpCriarPasta.value = "0";
					cmpRenomearPasta.value = "0";
					cmpExcluirPasta.value = "0";

					cmpUploadArquivo.value = "0";
					cmpExcluirArquivo.value = "0";
					cmpRenomearArquivo.value = "0";
					cmpBaixarArquivo.value = "0";
			
					$("#campo_usuario"+sufixoSend+"").fadeOut();
		
					$("#lista_usuarios"+sufixoSend+"").html(data);
				},
			});
		} else {
			alert("Este usuário já teve suas permissões setadas neste projeto!");
		}
	}, 500);		

}

function set_perm(idSend,sufixoSend) {
	$("#"+idSend+"_real").val($("#"+idSend+"_"+sufixoSend+"").val());
}

function salvar_usuario_pasta_perm() {

	cmpNumeroUnico = document.getElementById("numeroUnico_pasta");
	cmpUsuario = document.getElementById("idsysusu");
	cmpVisualizarPasta = document.getElementById("visualizar_pasta_real");
	cmpCriarPasta = document.getElementById("criar_pasta_real");
	cmpRenomearPasta = document.getElementById("renomear_pasta_real");
	cmpExcluirPasta = document.getElementById("excluir_pasta_real");
	cmpUploadArquivo = document.getElementById("upload_arquivo_real");
	cmpExcluirArquivo = document.getElementById("excluir_arquivo_real");
	cmpRenomearArquivo = document.getElementById("renomear_arquivo_real");
	cmpBaixarArquivo = document.getElementById("baixar_arquivo_real");

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/usuario-verifica.php",
		type: "GET",
		data: "numeroUnicoS="+cmpNumeroUnico.value+"&idsysusuS="+cmpUsuario.value+"",
		//dataType: "html",
		success: function(data){
			retorno = data;
		},
	});

	window.setTimeout(function() {
		if(parseInt(retorno)==0) {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/sysmidia/usuario-perm.php",
				type: "GET",
				data: "numeroUnicoS="+cmpNumeroUnico.value+"&idsysusuS="+cmpUsuario.value+"&visualizar_pastaS="+cmpVisualizarPasta.value+"&criar_pastaS="+cmpCriarPasta.value+"&renomear_pastaS="+cmpRenomearPasta.value+"&excluir_pastaS="+cmpExcluirPasta.value+"&upload_arquivoS="+cmpUploadArquivo.value+"&excluir_arquivoS="+cmpExcluirArquivo.value+"&renomear_arquivoS="+cmpRenomearArquivo.value+"&baixar_arquivoS="+cmpBaixarArquivo.value+"",
				//dataType: "html",
				success: function(data){
					cmpUsuario.value = "";
					cmpVisualizarPasta.value = "0";
					cmpCriarPasta.value = "0";
					cmpRenomearPasta.value = "0";
					cmpExcluirPasta.value = "0";
					cmpUploadArquivo.value = "0";
					cmpExcluirArquivo.value = "0";
					cmpRenomearArquivo.value = "0";
					cmpBaixarArquivo.value = "0";
			
					$("#campo_usuario").fadeOut();
		
					$("#lista_usuarios").html(data);
				},
			});
		} else {
			alert("Este usuário ja teve suas permissões setadas nesta pasta !");
		}
	}, 500);		

}

function salvar_usuario_arquivo_perm() {

	cmpNumeroUnico = document.getElementById("numeroUnico_upload_arquivo");
	cmpUsuario = document.getElementById("idsysusu");
	cmpUploadArquivo = document.getElementById("upload_arquivo_real");
	cmpExcluirArquivo = document.getElementById("excluir_arquivo_real");
	cmpRenomearArquivo = document.getElementById("renomear_arquivo_real");
	cmpBaixarArquivo = document.getElementById("baixar_arquivo_real");

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/usuario-verifica.php",
		type: "GET",
		data: "numeroUnicoS="+cmpNumeroUnico.value+"&idsysusuS="+cmpUsuario.value+"",
		//dataType: "html",
		success: function(data){
			retorno = data;
		},
	});

	window.setTimeout(function() {
		if(parseInt(retorno)==0) {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/sysmidia/usuario-perm-arquivo.php",
				type: "GET",
				data: "numeroUnicoS="+cmpNumeroUnico.value+"&idsysusuS="+cmpUsuario.value+"&upload_arquivoS="+cmpUploadArquivo.value+"&excluir_arquivoS="+cmpExcluirArquivo.value+"&renomear_arquivoS="+cmpRenomearArquivo.value+"&baixar_arquivoS="+cmpBaixarArquivo.value+"",
				//dataType: "html",
				success: function(data){
					cmpUsuario.value = "";
					cmpUploadArquivo.value = "0";
					cmpExcluirArquivo.value = "0";
					cmpRenomearArquivo.value = "0";
					cmpBaixarArquivo.value = "0";
			
					$("#campo_usuario").fadeOut();
		
					$("#lista_usuarios").html(data);
				},
			});
		} else {
			alert("Este usuário ja teve suas permissões setadas nesta pasta !");
		}
	}, 500);		

}

function salvar_formacao(acaoSend,executeSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico"+acaoSend+"");
	cmpTipo = document.getElementById("tipo_de_curso"+acaoSend+"");
	cmpNome = document.getElementById("nome_curso"+acaoSend+"");
	cmpStatus = document.getElementById("status_do_curso"+acaoSend+"");
	cmpFormacao = document.getElementById("tempo_de_formacao"+acaoSend+"");
	cmpExp = document.getElementById("tempo_de_experiencia"+acaoSend+"");

	if($.trim(cmpTipo.value)=="") {
		alert("O campo 'Tipo de Curso' deve ser preenchido");
		cmpTipo.focus();
	} else {
		if($.trim(cmpNome.value)=="") {
			alert("O campo 'Nome do Curso' deve ser preenchido");
			cmpNome.focus();
		} else {
			if($.trim(cmpStatus.value)=="") {
				alert("O campo 'Status do Curso' deve ser preenchido");
				cmpStatus.focus();
			} else {
				if($.trim(cmpFormacao.value)=="") {
					alert("O campo 'Tempo de Formacao' deve ser preenchido");
					cmpFormacao.focus();
				} else {
					if($.trim(cmpExp.value)=="") {
						alert("O campo 'Tempo de Experiência' deve ser preenchido");
						cmpExp.focus();
					} else {
						$.ajax({
							url: ""+linkAdminAcoes+"acoes/trabalhe_conosco/do.php",
							type: "GET",
							data: "acaoS="+executeSend+"&localS=formacao&modS=trabalhe_conosco&numeroUnicoS="+cmpNumeroUnico.value+"&tipo_de_cursoS="+cmpTipo.value+"&nomeS="+cmpNome.value+"&status_do_cursoS="+cmpStatus.value+"&tempo_de_formacaoS="+cmpFormacao.value+"&tempo_de_experienciaS="+cmpExp.value+"",
							//dataType: "html",
							success: function(data){
								cmpTipo.value = "";
								cmpNome.value = "";
								cmpStatus.value = "";
								cmpFormacao.value = "";
								cmpExp.value = "";
								
								$("#campo_formacao"+acaoSend+"").fadeOut();

								$("#tabela_formacao_"+cmpNumeroUnico.value+"").html(data);
							},
						});
					}
				}
			}
		}
	}
}

function salvar_idioma(acaoSend,executeSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico"+acaoSend+"");
	cmpNome = document.getElementById("nome_idioma"+acaoSend+"");
	cmpNivelEscrita = document.getElementById("nivel_escrita_idioma"+acaoSend+"");
	cmpNivelLeitura = document.getElementById("nivel_leitura_idioma"+acaoSend+"");
	cmpNivelConversacao = document.getElementById("nivel_conversacao_idioma"+acaoSend+"");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Idioma' deve ser preenchido");
		cmpNome.focus();
	} else {
		if($.trim(cmpNivelEscrita.value)=="") {
			alert("O campo 'Escrita' deve ser preenchido");
			cmpNivelEscrita.focus();
		} else {
			if($.trim(cmpNivelLeitura.value)=="") {
				alert("O campo 'Leitura' deve ser preenchido");
				cmpNivelLeitura.focus();
			} else {
				if($.trim(cmpNivelConversacao.value)=="") {
					alert("O campo 'Conversação' deve ser preenchido");
					cmpNivelConversacao.focus();
				} else {
					$.ajax({
						url: ""+linkAdminAcoes+"acoes/trabalhe_conosco/do.php",
						type: "GET",
						data: "acaoS="+executeSend+"&localS=idioma&modS=trabalhe_conosco&numeroUnicoS="+cmpNumeroUnico.value+"&nomeS="+cmpNome.value+"&nivelEscritaS="+cmpNivelEscrita.value+"&nivelLeituraS="+cmpNivelLeitura.value+"&nivelConversacaoS="+cmpNivelConversacao.value+"",
						//dataType: "html",
						success: function(data){
							cmpNome.value = "";
							cmpNivelEscrita.value = "";
							cmpNivelLeitura.value = "";
							cmpNivelConversacao.value = "";
							
							$("#campo_idioma"+acaoSend+"").fadeOut();
		
							$("#tabela_idioma_"+cmpNumeroUnico.value+"").html(data);
						},
					});
				}
			}
		}
	}
}

function salvar_status_classificacao(modSend,subLocalSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico"+subLocalSend+"");
	cmpOrdem = document.getElementById("ordem"+subLocalSend+"");
	cmpNome = document.getElementById("nome"+subLocalSend+"");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido");
		cmpNome.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/add-status_classificacao.php",
			type: "GET",
			data: "subLocalS="+subLocalSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"&nomeS="+cmpNome.value+"&ordemS="+cmpOrdem.value+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});

	}
}

function salvar_syscliente_classificacao(modSend,subLocalSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico"+subLocalSend+"");
	cmpOrdem = document.getElementById("ordem"+subLocalSend+"");
	cmpNome = document.getElementById("nome"+subLocalSend+"");
	cmpDe = document.getElementById("de"+subLocalSend+"");
	cmpAte = document.getElementById("ate"+subLocalSend+"");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido");
		cmpNome.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syscliente/add-syscliente_classificacao.php",
			type: "GET",
			data: "subLocalS="+subLocalSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"&nomeS="+cmpNome.value+"&deS="+cmpDe.value+"&ateS="+cmpAte.value+"&ordemS="+cmpOrdem.value+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});

	}
}

function salvar_status_nota(modSend,subLocalSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico"+subLocalSend+"");
	cmpOrdem = document.getElementById("ordem"+subLocalSend+"");
	cmpNome = document.getElementById("nome"+subLocalSend+"");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido");
		cmpNome.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/add-status_nota.php",
			type: "GET",
			data: "subLocalS="+subLocalSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"&nomeS="+cmpNome.value+"&ordemS="+cmpOrdem.value+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});

	}
}

function salvar_sysconta_a_pagar_tipo_pagamento(modSend,subLocalSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico"+subLocalSend+"");
	cmpOrdem = document.getElementById("ordem"+subLocalSend+"");
	cmpNome = document.getElementById("nome"+subLocalSend+"");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido");
		cmpNome.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysconta_a_pagar/add-sysconta_a_pagar_tipo_pagamento.php",
			type: "GET",
			data: "subLocalS="+subLocalSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"&nomeS="+cmpNome.value+"&ordemS="+cmpOrdem.value+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});

	}
}

function atualiza_sysconta_a_pagar_valor_pago() {
	$("#img-valor-pago").attr("src",""+linkAdminAcoes+"template/img/preloader-2.gif");
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysconta_a_pagar/sysconta_a_pagar_calcula_pago.php",
		type: "GET",
		data: "valorS="+$("#valor").val()+"&valor_descontoS="+$("#valor_desconto").val()+"&valor_taxaS="+$("#valor_taxa").val()+"&valor_juroS="+$("#valor_juro").val()+"",
		//dataType: "html",
		success: function(data){
			$("#valor_pago").prop( "disabled", false );
			$("#valor_pago").val(data);
			$("#img-valor-pago").attr("src",""+linkAdminAcoes+"template/img/any.png");
		},
	});
}

function remover_sysconta_a_pagar_tipo_pagamento(modSend,idSend,subLocalSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysconta_a_pagar/remover-sysconta_a_pagar_tipo_pagamento.php",
			type: "GET",
			data: "subLocalS="+subLocalSend+"&idS="+idSend+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function muda_stat_sysconta_a_pagar_tipo_pagamento(modSend,idSend,subLocalSend,statSend) {
	if (confirm("Você realmente deseja modificar o status deste item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysconta_a_pagar/muda-stat-sysconta_a_pagar_tipo_pagamento.php",
			type: "GET",
			data: "modS="+modSend+"&idS="+idSend+"&subLocalS="+subLocalSend+"&statS="+statSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function salvar_sysconta_a_receber_tipo_pagamento(modSend,subLocalSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico"+subLocalSend+"");
	cmpOrdem = document.getElementById("ordem"+subLocalSend+"");
	cmpNome = document.getElementById("nome"+subLocalSend+"");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido");
		cmpNome.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysconta_a_receber/add-sysconta_a_receber_tipo_pagamento.php",
			type: "GET",
			data: "subLocalS="+subLocalSend+"&modS="+modSend+"&numeroUnicoS="+cmpNumeroUnico.value+"&nomeS="+cmpNome.value+"&ordemS="+cmpOrdem.value+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});

	}
}

function atualiza_sysconta_a_receber_valor_pago() {
	$("#img-valor-pago").attr("src",""+linkAdminAcoes+"template/img/preloader-2.gif");
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysconta_a_receber/sysconta_a_receber_calcula_pago.php",
		type: "GET",
		data: "valorS="+$("#valor").val()+"&valor_descontoS="+$("#valor_desconto").val()+"&valor_taxaS="+$("#valor_taxa").val()+"&valor_juroS="+$("#valor_juro").val()+"",
		//dataType: "html",
		success: function(data){
			$("#valor_pago").prop( "disabled", false );
			$("#valor_pago").val(data);
			$("#img-valor-pago").attr("src",""+linkAdminAcoes+"template/img/any.png");
		},
	});
}

function remover_sysconta_a_receber_tipo_pagamento(modSend,idSend,subLocalSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysconta_a_receber/remover-sysconta_a_receber_tipo_pagamento.php",
			type: "GET",
			data: "subLocalS="+subLocalSend+"&idS="+idSend+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function muda_stat_sysconta_a_receber_tipo_pagamento(modSend,idSend,subLocalSend,statSend) {
	if (confirm("Você realmente deseja modificar o status deste item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysconta_a_receber/muda-stat-sysconta_a_receber_tipo_pagamento.php",
			type: "GET",
			data: "modS="+modSend+"&idS="+idSend+"&subLocalS="+subLocalSend+"&statS="+statSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function sysconta_a_receber_tipo_destinatario() {
	$("#div-add-syscliente").hide();
	$("#div-add-sysfornecedor").hide();

	$("#idsyscliente").hide();
	$("#idsysfornecedor").hide();

	$("#img-iddestinatario").attr("src",""+linkAdminAcoes+"template/img/preloader-2.gif");

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysconta_a_receber/retorna-destinatarios.php",
		type: "GET",
		data: "modS="+$("#tipo_destinatario").val()+"",
		//dataType: "html",
		success: function(data){
			if(data=="0") {
				alert("Nenhum registro encontrado para este tipo de perfil!");
			} else {
				if($.trim($("#tipo_destinatario").val())=="syscliente") {
					$("#label-perfil").html("Escolha um cliente");
				} else {
					$("#label-perfil").html("Escolha um fornecedor");
				}

				$("#div-add-"+$("#tipo_destinatario").val()+"").fadeIn();
				$("#id"+$("#tipo_destinatario").val()+"").fadeIn();
				$("#id"+$("#tipo_destinatario").val()+"").html(data);
			}
			$("#img-iddestinatario").attr("src",""+linkAdminAcoes+"template/img/any.png");
		},
	});
}

function remover_status_classificacao(modSend,idSend,subLocalSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/remover-status_classificacao.php",
			type: "GET",
			data: "subLocalS="+subLocalSend+"&idS="+idSend+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function remover_syscliente_classificacao(modSend,idSend,subLocalSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syscliente/remover-syscliente_classificacao.php",
			type: "GET",
			data: "subLocalS="+subLocalSend+"&idS="+idSend+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function remover_status_nota(modSend,idSend,subLocalSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/remover-status_nota.php",
			type: "GET",
			data: "subLocalS="+subLocalSend+"&idS="+idSend+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function muda_stat_status_classificacao(modSend,idSend,subLocalSend,statSend) {
	if (confirm("Você realmente deseja modificar o status deste item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/muda-stat-status_classificacao.php",
			type: "GET",
			data: "modS="+modSend+"&idS="+idSend+"&subLocalS="+subLocalSend+"&statS="+statSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function muda_stat_syscliente_classificacao(modSend,idSend,subLocalSend,statSend) {
	if (confirm("Você realmente deseja modificar o status deste item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syscliente/muda-stat-syscliente_classificacao.php",
			type: "GET",
			data: "modS="+modSend+"&idS="+idSend+"&subLocalS="+subLocalSend+"&statS="+statSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function muda_stat_status_nota(modSend,idSend,subLocalSend,statSend) {
	if (confirm("Você realmente deseja modificar o status deste item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/muda-stat-status_nota.php",
			type: "GET",
			data: "modS="+modSend+"&idS="+idSend+"&subLocalS="+subLocalSend+"&statS="+statSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function edita_ordem_status_classificacao(idSend,modSend,subLocalSend,ordemSend) {
	if (confirm("Você realmente deseja alterar a ordem desta categoria ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/update-ordem-status_classificacao.php",
			type: "GET",
			data: "idS="+idSend+"&subLocalS="+subLocalSend+"&modS="+modSend+"&ordemS="+ordemSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function edita_ordem_syscliente_classificacao(idSend,modSend,subLocalSend,ordemSend) {
	if (confirm("Você realmente deseja alterar a ordem desta categoria ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syscliente/update-ordem-syscliente_classificacao.php",
			type: "GET",
			data: "idS="+idSend+"&subLocalS="+subLocalSend+"&modS="+modSend+"&ordemS="+ordemSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function edita_ordem_status_nota(idSend,modSend,subLocalSend,ordemSend) {
	if (confirm("Você realmente deseja alterar a ordem desta categoria ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/update-ordem-status_nota.php",
			type: "GET",
			data: "idS="+idSend+"&subLocalS="+subLocalSend+"&modS="+modSend+"&ordemS="+ordemSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function salva_campo_status_classificacao(idSend,modSend,subLocalSend,valorSend) {
	if (confirm("Você realmente deseja atualizar o conteúdo deste campo ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/atualiza-campo-status_classificacao.php",
			type: "GET",
			data: "idS="+idSend+"&subLocalS="+subLocalSend+"&modS="+modSend+"&valorS="+valorSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function salva_campo_syscliente_classificacao(idSend,cmpSend,modSend,subLocalSend,valorSend) {
	if (confirm("Você realmente deseja atualizar o conteúdo deste campo ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/syscliente/atualiza-campo-syscliente_classificacao.php",
			type: "GET",
			data: "idS="+idSend+"&subLocalS="+subLocalSend+"&modS="+modSend+"&valorS="+valorSend+"&cmpS="+cmpSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function salva_campo_status_nota(idSend,modSend,subLocalSend,valorSend) {
	if (confirm("Você realmente deseja atualizar o conteúdo deste campo ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/atualiza-campo-status_nota.php",
			type: "GET",
			data: "idS="+idSend+"&subLocalS="+subLocalSend+"&modS="+modSend+"&valorS="+valorSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function salvar_categoria_sysusu(modSend,subLocalSend) {
	cmpOrdem = document.getElementById("ordem_categoria");
	cmpNome = document.getElementById("nome_categoria");
	cmpSlug = document.getElementById("slug");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Título' deve ser preenchido");
		cmpNome.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysusu/add-categoria.php",
			type: "GET",
			data: "subLocalS="+subLocalSend+"&modS="+modSend+"&nomeS="+cmpNome.value+"&ordemS="+cmpOrdem.value+"&slugS="+cmpSlug.value+"",
			//dataType: "html",
			success: function(data){
				location.reload();
				
				/*
				cmpOrdem.value = "";
				cmpNome.value = "";
				cmpIdpai.value = "";
				cmpSlug.value = "";
				
				$.sticky("Adicionado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });

				$("#lista_categoria_itens").html(data);

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/sysusu/atualiza-categoria-ordem.php",
					type: "GET",
					data: "subLocalS="+subLocalSend+"&modS="+modSend+"",
					//dataType: "html",
					success: function(data){
						$("#ordem_categoria").html(data);
					},
				});

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/sysusu/atualiza-categoria-idpai.php",
					type: "GET",
					data: "subLocalS="+subLocalSend+"&modS="+modSend+"",
					//dataType: "html",
					success: function(data){
						$("#idpai_categoria").html(data);
					},
				});
				*/

			},
		});

	}
}

function salvar_categoria_sysmod(modSend,subLocalSend) {
	cmpOrdem = document.getElementById("ordem_categoria");
	cmpNome = document.getElementById("nome_categoria");
	cmpPreMod = document.getElementById("prefixo_mod");
	cmpPreUrl = document.getElementById("prefixo_url");
	cmpSlug = document.getElementById("slug");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Título' deve ser preenchido");
		cmpNome.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysusu/add-categoria-sysmod.php",
			type: "GET",
			data: "subLocalS="+subLocalSend+"&modS="+modSend+"&nomeS="+cmpNome.value+"&ordemS="+cmpOrdem.value+"&preModS="+cmpPreMod.value+"&preUrlS="+cmpPreUrl.value+"&slugS="+cmpSlug.value+"",
			//dataType: "html",
			success: function(data){
				location.reload();
				
				/*
				cmpOrdem.value = "";
				cmpNome.value = "";
				cmpIdpai.value = "";
				cmpSlug.value = "";
				
				$.sticky("Adicionado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });

				$("#lista_categoria_itens").html(data);

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/sysusu/atualiza-categoria-ordem.php",
					type: "GET",
					data: "subLocalS="+subLocalSend+"&modS="+modSend+"",
					//dataType: "html",
					success: function(data){
						$("#ordem_categoria").html(data);
					},
				});

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/sysusu/atualiza-categoria-idpai.php",
					type: "GET",
					data: "subLocalS="+subLocalSend+"&modS="+modSend+"",
					//dataType: "html",
					success: function(data){
						$("#idpai_categoria").html(data);
					},
				});
				*/

			},
		});

	}
}

function edita_syscronograma_item(idSend,sufixoSend,numeroUnicoSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/syscronograma/edita-item.php",
		type: "GET",
		data: "sufixoS="+sufixoSend+"&idS="+idSend+"&numeroUnicoS="+numeroUnicoSend+"",
		//dataType: "html",
		success: function(data){
			
			$("#acaoForm_item").val("editar-tarefas");
			
			$("#iditem_item").prop( "disabled", false );
			$("#iditem_item").val(""+idSend+"");

			$("#btns-add"+sufixoSend+"").hide();
			$("#btns-editar"+sufixoSend+"").fadeIn();
			
			$("#form_item"+sufixoSend+"").html(data);

			$(document).ready(function() {
				//* WYSIWG Editor
				beoro_wysiwg.init();
			});

			//* WYSIWG Editor
			beoro_wysiwg = {
				init: function() {
					if($('#descricao_item'+sufixoSend+'').length) { 
						CKEDITOR.replace( 'descricao_item'+sufixoSend+'', {
							toolbar: 'Standard'
						});
					}
				}
			};
		},
	});
}

function cancela_edita_syscronograma_item(sufixoSend,numeroUnicoSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/syscronograma/cancela-edita-item.php",
		type: "GET",
		data: "sufixoS="+sufixoSend+"&numeroUnicoS="+numeroUnicoSend+"",
		//dataType: "html",
		success: function(data){
			
			$("#acaoForm_item").val("add-tarefas");
		
			$("#iditem_item").prop( "disabled", true );
			$("#iditem_item").val("");

			$("#btns-editar"+sufixoSend+"").hide();
			$("#btns-add"+sufixoSend+"").fadeIn();
			
			$("#form_item"+sufixoSend+"").html(data);

			$(document).ready(function() {
				//* WYSIWG Editor
				beoro_wysiwg.init();
			});

			//* WYSIWG Editor
			beoro_wysiwg = {
				init: function() {
					if($('#descricao_item'+sufixoSend+'').length) { 
						CKEDITOR.replace( 'descricao_item'+sufixoSend+'', {
							toolbar: 'Standard'
						});
					}
				}
			};
		},
	});
}

function salvar_lista_item_cronograma(sufixoSend) {
	cmpNome = document.getElementById("nome_item"+sufixoSend+"");
	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Título' deve ser preenchido");
		cmpNome.focus();
	} else {
		document.forms_tarefas.submit();
	}
}

function salvar_adv_processo_agenda(sufixoSend) {
	cmpNome = document.getElementById("nome_item"+sufixoSend+"");
	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Título' deve ser preenchido");
		cmpNome.focus();
	} else {
		document.forms_agenda.submit();
	}
}

function salvar_lista_item(sufixoSend,modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico"+sufixoSend+"");
	cmpNome = document.getElementById("nome_item"+sufixoSend+"");
	cmpTexto = document.getElementById("texto_item"+sufixoSend+"");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido");
		cmpNome.focus();
	} else {
		if($.trim(cmpTexto.value)=="") {
			alert("O campo 'Descrição' deve ser preenchido");
			cmpTexto.focus();
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/sysgeral/add-lista_item.php",
				type: "GET",
				data: "sufixoS="+sufixoSend+"&nomeS="+cmpNome.value+"&textoS="+cmpTexto.value+"&numeroUnicoS="+cmpNumeroUnico.value+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data){
					cmpNome.value = "";
					cmpTexto.value = "";
					
					var $toast = toastr["success"]("Item adicionado com sucesso !", "");
	
					$("#lista_itens"+sufixoSend+"").html(data);
	
				},
			});
		}
	}
}

function salvar_item_plano(sufixoSend,modSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico"+sufixoSend+"");
	cmpNome = document.getElementById("nome_item"+sufixoSend+"");
	cmpTexto = document.getElementById("texto_item"+sufixoSend+"");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido");
		cmpNome.focus();
	} else {
		if($.trim(cmpTexto.value)=="") {
			alert("O campo 'Descrição' deve ser preenchido");
			cmpTexto.focus();
		} else {
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/sysgeral/add-sysplano_item.php",
				type: "GET",
				data: "sufixoS="+sufixoSend+"&nomeS="+cmpNome.value+"&textoS="+cmpTexto.value+"&numeroUnicoS="+cmpNumeroUnico.value+"&modS="+modSend+"",
				//dataType: "html",
				success: function(data){
					cmpNome.value = "";
					cmpTexto.value = "";
					
					var $toast = toastr["success"]("Item adicionado com sucesso !", "");
	
					$("#lista_sysplano_itens"+sufixoSend+"").html(data);
	
				},
			});
		}
	}
}

function salvar_categoria(modSend,subLocalSend) {
	cmpOrdem = document.getElementById("ordem_categoria");
	cmpNome = document.getElementById("nome_categoria");
	cmpSlug = document.getElementById("slug");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Título' deve ser preenchido");
		cmpNome.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/add-categoria.php",
			type: "GET",
			data: "subLocalS="+subLocalSend+"&modS="+modSend+"&nomeS="+cmpNome.value+"&ordemS="+cmpOrdem.value+"&slugS="+cmpSlug.value+"",
			//dataType: "html",
			success: function(data){
				location.reload();
				
				/*
				cmpOrdem.value = "";
				cmpNome.value = "";
				cmpIdpai.value = "";
				cmpSlug.value = "";
				
				$.sticky("Adicionado com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });

				$("#lista_categoria_itens").html(data);

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/sysgeral/atualiza-categoria-ordem.php",
					type: "GET",
					data: "subLocalS="+subLocalSend+"&modS="+modSend+"",
					//dataType: "html",
					success: function(data){
						$("#ordem_categoria").html(data);
					},
				});

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/sysgeral/atualiza-categoria-idpai.php",
					type: "GET",
					data: "subLocalS="+subLocalSend+"&modS="+modSend+"",
					//dataType: "html",
					success: function(data){
						$("#idpai_categoria").html(data);
					},
				});
				*/

			},
		});

	}
}

function tipo_midia() {
	if ($( "#tipo" ).val()=="folder") {
		$( "#campo_arquivo" ).fadeOut();
	} else {
		$( "#campo_arquivo" ).fadeIn();
	}
}

function remover_trabalhe_conosco(numeroUnicoSend,idSend,modSend,localSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/trabalhe_conosco/do.php",
			type: "GET",
			data: "acaoS=remove&numeroUnicoS="+numeroUnicoSend+"&idS="+idSend+"&modS="+modSend+"&localS="+localSend+"",
			//dataType: "html",
			success: function(data){
				$("#tabela_"+localSend+"_"+numeroUnicoSend+"").html(data);
			},
		});
	}
}

function filtro_show(idSend) {
	if($("#filtro_show_"+idSend+"").prop("checked")) {
		$("#filtro_show_"+idSend+"").prop( "checked", false );
		$("#filtro_show_"+idSend+"_set").val("");
		$(".view_"+idSend+"").hide();
	} else {
		$("#filtro_show_"+idSend+"").prop( "checked", true );
		$("#filtro_show_"+idSend+"_set").val(""+idSend+"");
		$(".view_"+idSend+"").fadeIn();
	}
}

function atualiza_pastas_laterais() {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/atualiza-pastas-laterais.php",
		type: "GET",
		data: "",
		//dataType: "html",
		success: function(data){
			parent.$("#arvore_pasta").html(data);
		},
	});
}

function filtro_order_desc() {
	cmpIdpai = document.getElementById("idpai");

	$("#preloader-atualizando").fadeIn();

	if($("#filtro_order_desc").prop("checked")) {
		orderDirecaoSend = "DESC";
	} else {
		orderDirecaoSend = "";
	}

	$("#filtro_order_desc_set").val(""+orderDirecaoSend+"");

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/abre-pasta.php",
		type: "GET",
		data: "idpaiS="+idSet+"&viewS="+$("#filtro_view_set").val()+"&orderDirecaoS="+orderDirecaoSend+"&orderS="+$("#filtro_order_set").val()+"&showNameS="+$("#filtro_show_name_set").val()+"&showDateS="+$("#filtro_show_date_set").val()+"&showSizeS="+$("#filtro_show_size_set").val()+"",
		//dataType: "html",
		success: function(data){
			$("#preloader-atualizando").hide();
			parent.$("#conteudo_pasta").html(data);
			cmpIdpai.value = idSet;
		},
	});
}

function filtro_view(viewSend) {
	$("#filtro_view_set").val(""+viewSend+"");
	
	alert("-->"+viewSend+"");

	$("#preloader-atualizando").fadeIn();

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/abre-pasta.php",
		type: "GET",
		data: "idpaiS="+$("#idpai").val()+"&viewS="+$("#filtro_view_set").val()+"&orderDirecaoS="+$("#filtro_order_desc_set").val()+"&orderS="+$("#filtro_order_set").val()+"&showNameS="+$("#filtro_show_name_set").val()+"&showDateS="+$("#filtro_show_date_set").val()+"&showSizeS="+$("#filtro_show_size_set").val()+"",
		//dataType: "html",
		success: function(data){
			$("#preloader-atualizando").hide();
			parent.$("#conteudo_pasta").html(data);
		},
	});
}

function filtro_order(ordemSend) {
	cmpIdpai = document.getElementById("idpai");
	$("#filtro_order_set").val(""+ordemSend+"");

	$("#preloader-atualizando").fadeIn();

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/abre-pasta.php",
		type: "GET",
		data: "idpaiS="+idSet+"&viewS="+$("#filtro_view_set").val()+"&orderDirecaoS="+$("#filtro_order_desc_set").val()+"&orderS="+ordemSend+"&showNameS="+$("#filtro_show_name_set").val()+"&showDateS="+$("#filtro_show_date_set").val()+"&showSizeS="+$("#filtro_show_size_set").val()+"",
		//dataType: "html",
		success: function(data){
			$("#preloader-atualizando").hide();
			parent.$("#conteudo_pasta").html(data);
			cmpIdpai.value = idSet;
		},
	});
}

function abre_galeria(numeroUnicoSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/foto/abre-galeria.php",
		type: "GET",
		data: "numeroUnicoS="+numeroUnicoSend+"",
		//dataType: "html",
		success: function(data){
			parent.$(".statusbar").fadeOut();

			parent.$("#galeria-fotos").html(data);
		},
	});
}

function abre_pasta_ajax(idSend,idsysusuSend) {
	cmpIdpai = document.getElementById("idpai");
	if($.trim(idSend)=="") {
		idSet = cmpIdpai.value;
	} else {
		idSet = idSend;
	}

	$("#preloader-atualizando").fadeIn();

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/abre-pasta.php",
		type: "GET",
		data: "idsysusuS="+idsysusuSend+"&idpaiS="+idSet+"&viewS="+$("#filtro_view_set").val()+"&orderDirecaoS="+$("#filtro_order_desc_set").val()+"&orderS="+$("#filtro_order_set").val()+"&showNameS="+$("#filtro_show_name_set").val()+"&showDateS="+$("#filtro_show_date_set").val()+"&showSizeS="+$("#filtro_show_size_set").val()+"",
		//dataType: "html",
		success: function(data){
			$("#preloader-atualizando").hide();
			parent.$("#conteudo_pasta").html(data);
			cmpIdpai.value = idSet;
		},
	});
}

function abre_arquivo_fancy(idSend) {
	$.fancybox({
        width: 800,
        autoSize: true,
        href: ""+linkAdminAcoes+"acoes/sysmidia/visualizar-arquivo.php?idS="+idSend+"",
        type: 'ajax'
    });	
}

function refresh_pasta_ajax() {
	cmpIdpai = document.getElementById("idpai");
	abre_pasta_ajax(cmpIdpai.value,idsysusuSend);
}

function cria_pasta_ajax(idsysusuSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico_pasta");
	cmpIdpai = document.getElementById("idpai");
	cmpNome = document.getElementById("nome_pasta");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome da Pasta' deve ser preenchido");
		cmpNome.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysmidia/cria-pasta.php",
			type: "GET",
			data: "numeroUnicoS="+cmpNumeroUnico.value+"&idpaiS="+cmpIdpai.value+"&nomeS="+cmpNome.value+"&idsysusuS="+idsysusuSend+"",
			//dataType: "html",
			success: function(data){
				parent.$.fancybox.close();

				$("#arvore_pasta").html(data);
				
				abre_pasta_ajax(cmpIdpai.value,idsysusuSend);
	
				var $toast = toastr["success"]("Pasta criada com sucesso !", "");
				
			},
		});
	}
}

function edita_pasta_ajax(idSend,idsysusuSend) {
	cmpIdpai = document.getElementById("idpai");
	cmpNome = document.getElementById("nome_pasta");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome da Pasta' deve ser preenchido");
		cmpNome.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysmidia/edita-pasta.php",
			type: "GET",
			data: "nomeS="+cmpNome.value+"&idS="+idSend+"&idsysusuS="+idsysusuSend+"",
			//dataType: "html",
			success: function(data){
				parent.$.fancybox.close();

				$("#arvore_pasta").html(data);
				
				abre_pasta_ajax(cmpIdpai.value,idsysusuSend);
	
				var $toast = toastr["success"]("Pasta editada com sucesso !", "");
				
			},
		});
	}
}

function edita_foto_ajax(idSend,modSend) {
	cmpNome = document.getElementById("nome_foto");
	cmpOrdem = document.getElementById("ordem_foto");

	if($.trim(cmpNome.value)=="") {
		alert("O campo 'Nome' deve ser preenchido");
		cmpNome.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/edita-foto.php",
			type: "GET",
			data: "nomeS="+cmpNome.value+"&idS="+idSend+"&ordemS="+cmpOrdem.value+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
				/*
				parent.$.fancybox.close();

				$("#galeria-fotos").html(data);
	
				parent.$.sticky("Foto editada com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
				*/
				
			},
		});
	}
}

function remover_foto_unico(idSend,modSend) {
	cmpLista = document.getElementById("lista_fotos_remover");
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/remover-foto.php",
			type: "GET",
			data: "listaIdS=|"+idSend+"|&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
				/*
				abre_pasta_ajax(cmpIdpai.value);

				$.sticky("Arquivo removido com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
				*/
			},
		});
	}
}

function remover_foto_lista(modSend) {
	cmpLista = document.getElementById("lista_fotos_remover");
	if (confirm("Você realmente deseja remover os itens selecionados ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/remover-foto.php",
			type: "GET",
			data: "listaIdS="+cmpLista.value+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
				/*
				abre_pasta_ajax(cmpIdpai.value);

				$.sticky("Arquivo removido com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
				*/
			},
		});
	}
}

function compactar_selecionados(modSend,numeroUnicoSend) {
	cmpLista = document.getElementById("lista_fotos_remover");
	if (confirm("Você realmente deseja baixar os itens selecionados ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/compacta.php",
			type: "GET",
			data: "listaIdS="+cmpLista.value+"&modS="+modSend+"&numeroUnicoS="+numeroUnicoSend+"",
			//dataType: "html",
			success: function(data){
				window.open(""+linkAdminLib+"include/lib/forca-download.php?arquivo="+data+"","lista_galeria_iframe","");
			},
		});
	}
}

function marca_foto_remover(idSend) {
	cmpLista = document.getElementById("lista_fotos_remover");

	if($("#check-"+idSend+"").prop("checked")) {
		cmpLista.value = "|"+idSend+"|"+cmpLista.value+"";
	} else {
		var val = $("#lista_fotos_remover").val();
		$("#lista_fotos_remover").val(val.replace("|"+idSend+"|",""));
	}

}


function remover_portfolio_unico(idSend,modSend) {
	cmpLista = document.getElementById("lista_portfolios_remover");
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/remover-portfolio.php",
			type: "GET",
			data: "listaIdS=|"+idSend+"|&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
				/*
				abre_pasta_ajax(cmpIdpai.value);

				$.sticky("Arquivo removido com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
				*/
			},
		});
	}
}

function remover_portfolio_lista(modSend) {
	cmpLista = document.getElementById("lista_portfolios_remover");
	if (confirm("Você realmente deseja remover os itens selecionados ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/remover-portfolio.php",
			type: "GET",
			data: "listaIdS="+cmpLista.value+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
				/*
				abre_pasta_ajax(cmpIdpai.value);

				$.sticky("Arquivo removido com sucesso !", {autoclose : 3000, position: "top-center", type: "st-success" });
				*/
			},
		});
	}
}

function marca_portfolio_remover(idSend) {
	cmpLista = document.getElementById("lista_portfolios_remover");

	if($("#check-"+idSend+"").prop("checked")) {
		cmpLista.value = "|"+idSend+"|"+cmpLista.value+"";
	} else {
		var val = $("#lista_portfolios_remover").val();
		$("#lista_portfolios_remover").val(val.replace("|"+idSend+"|",""));
	}

}

function remover_arquivo(idSend) {
	cmpIdpai = document.getElementById("idpai");
	if (confirm("Você realmente deseja remover este arquivo ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysmidia/remover-arquivo.php",
			type: "GET",
			data: "idS="+idSend+"&idpaiS="+cmpIdpai.value+"",
			//dataType: "html",
			success: function(data){
				abre_pasta_ajax(cmpIdpai.value);

				var $toast = toastr["error"]("Arquivo removido com sucesso !", "");
			},
		});
	}
}

function remover_pasta(idSend) {
	cmpIdpai = document.getElementById("idpai");
	if (confirm("Você realmente deseja remover esta pasta ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysmidia/remover-pasta.php",
			type: "GET",
			data: "idpaiS="+idSend+"",
			//dataType: "html",
			success: function(data){
				abre_pasta_ajax(cmpIdpai.value,idsysusuSend);

				var $toast = toastr["error"]("Pasta removida com sucesso !", "");

				$("#arvore_pasta").html(data);

			},
		});
	}
}

function cria_arquivo_ajax(idsysusuSend,numeroUnicoSend) {
	cmpIdpai = document.getElementById("idpai");
	cmpNome = document.getElementById("nome_upload_arquivo");
	cmpArquivo = document.getElementById("arquivo_upload_arquivo");
	
	//alert(cmpArquivo.value);

	if($.trim(cmpArquivo.value)=="") {
		alert("Você deve selecionar um arquivo para realizar o upload !");
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysmidia/cria-arquivo.php",
			type: "GET",
			data: "numeroUnicoS="+numeroUnicoSend+"&idpaiS="+cmpIdpai.value+"&nomeS="+cmpNome.value+"&arquivoS="+cmpArquivo.value+"&idsysusuS="+idsysusuSend+"",
			//dataType: "html",
			success: function(data){
				parent.$.fancybox.close();
	
				$("#arvore_pasta").html(data);
				
				abre_pasta_ajax(cmpIdpai.value,idsysusuSend);
	
				var $toast = toastr["success"]("Arquivo criado com sucesso !", "");
				
			},
		});
	}

}

function edita_arquivo_ajax(idSend,idsysusuSend,numeroUnicoSend) {
	cmpIdpai = document.getElementById("idpai");
	cmpNome = document.getElementById("nome_upload_arquivo");
	cmpArquivo = document.getElementById("arquivo_upload_arquivo");

	if($.trim(cmpArquivo.value)=="") {
		alert("Você deve selecionar um arquivo para realizar o upload !");
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysmidia/edita-arquivo.php",
			type: "GET",
			data: "numeroUnicoS="+numeroUnicoSend+"&idpaiS="+cmpIdpai.value+"&nomeS="+cmpNome.value+"&arquivoS="+cmpArquivo.value+"&idS="+idSend+"&idsysusuS="+idsysusuSend+"",
			//dataType: "html",
			success: function(data){
				parent.$.fancybox.close();

				$("#arvore_pasta").html(data);
				
				abre_pasta_ajax(cmpIdpai.value,idsysusuSend);
	
				var $toast = toastr["success"]("Arquivo editado com sucesso !", "");
				
			},
		});
	}
}

function zipar_selecionados(){
	$("#acaoForm_lista").val("compactar");

	aChk = document.getElementsByName('pasta_sel[]');
	sel=0;
	for (i=0;i<aChk.length;i++){
		if (aChk[i].checked == true){
			sel=1;
		}
	}

	if (sel==0){
		alert("Você deve selecionar pelo menos um item da lista !");
	}  else {
		document.list.submit();
	}
}

function excluir_selecionados(){
	$("#acaoForm_lista").val("excluir");

	aChk = document.getElementsByName('pasta_sel[]');
	sel=0;
	for (i=0;i<aChk.length;i++){
		if (aChk[i].checked == true){
			sel=1;
		}
	}

	if (sel==0){
		alert("Você deve selecionar pelo menos um item da lista !");
	}  else {
		document.list.submit();
	}
}

function remover_restrito_projeto_perm(localSend,sufixoSend,idSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico"+sufixoSend+"");
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/"+localSend+"/remover-usuario-perm.php",
			type: "GET",
			data: "sufixoS="+sufixoSend+"&idS="+idSend+"&numeroUnicoS="+cmpNumeroUnico.value+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Usuário removido com sucesso !", "");

				$("#lista_usuarios"+sufixoSend+"").html(data);

			},
		});
	}
}

function remover_usuario_perm(idSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico_pasta");
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysmidia/remover-usuario-perm.php",
			type: "GET",
			data: "idS="+idSend+"&numeroUnicoS="+cmpNumeroUnico.value+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Usuário removido com sucesso !", "");

				$("#lista_usuarios").html(data);

			},
		});
	}
}

function remover_usuario_perm_arquivo(idSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico_pasta");
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysmidia/remover-usuario-perm-arquivo.php",
			type: "GET",
			data: "idS="+idSend+"&numeroUnicoS="+cmpNumeroUnico.value+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["success"]("Usuário removido com sucesso !", "");

				$("#lista_usuarios").html(data);

			},
		});
	}
}

function remover_item_ajax(localSend,idSend,modSend,subLocalSend,ordemSetSend,ordemSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/remover-item-ajax.php",
			type: "GET",
			data: "localS="+localSend+"&idS="+idSend+"&modS="+modSend+"&subLocalS="+subLocalSend+"&ordemSetS="+ordemSetSend+"&ordemS="+ordemSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Item removido com sucesso !", "");

				$("#"+localSend+"").html(data);

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/sysgeral/atualiza-categoria-ordem.php",
					type: "GET",
					data: "subLocalS="+subLocalSend+"&modS="+modSend+"",
					//dataType: "html",
					success: function(data){
						$("#ordem_categoria").html(data);
					},
				});

				$.ajax({
					url: ""+linkAdminAcoes+"acoes/sysgeral/atualiza-categoria-idpai.php",
					type: "GET",
					data: "subLocalS="+subLocalSend+"&modS="+modSend+"",
					//dataType: "html",
					success: function(data){
						$("#idpai_categoria").html(data);
					},
				});
			},
		});
	}
}

function remover_item_ajax_novo(localSend,idSend,modSend,subLocalSend,ordemSetSend,ordemSend,sufixoSend,numeroUnicoSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/remover-item-ajax-novo.php",
			type: "GET",
			data: "localS="+localSend+"&idS="+idSend+"&modS="+modSend+"&subLocalS="+subLocalSend+"&ordemSetS="+ordemSetSend+"&ordemS="+ordemSend+"&sufixoS="+sufixoSend+"&numeroUnicoS="+numeroUnicoSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["error"]("Item removido com sucesso !", "");

				$("#"+localSend+"_itens"+sufixoSend+"").html(data);

			},
		});
	}
}


function edita_ordem_sysplano_item(localSend,idSend,modSend,subLocalSend,ordemSend) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/update-categoria-ordem.php",
			type: "GET",
			data: "localS="+localSend+"&subLocalS="+subLocalSend+"&idS="+idSend+"&modS="+modSend+"&ordemS="+ordemSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
}

function edita_ordem_completo(campoFiltroSend,valorFiltroSend,idSend,modSend,subLocalSend,ordemSend) {
	preloaderIn();
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/update-ordem.php",
		type: "GET",
		data: "idS="+idSend+"&modS="+modSend+"&subLocalS="+subLocalSend+"&ordemS="+ordemSend+"&campoFiltroS="+campoFiltroSend+"&valorFiltroS="+valorFiltroSend+"",
		//dataType: "html",
		success: function(data){
			location.reload();
		},
	});
}

function edita_ordem_categoria(idSend,modSend,subLocalSend,ordemSend) {
		preloaderIn();
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/update-categoria-ordem.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&subLocalS="+subLocalSend+"&ordemS="+ordemSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["success"]("Ordem alterada com sucesso !", "");
				$("#tabela_montada tbody").html(data);
				FormEditable.init();
				preloaderOut();
			},
		});
}

function muda_destaque(modSend,idSend,destaqueSend) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/muda-destaque.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&destaqueS="+destaqueSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
}

function muda_importancia(modSend,idSend,importanteSend) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/muda-importante.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&importanteS="+importanteSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
}

function muda_restrito_projeto_perm(localSend,sufixoSend,campoSend,idSend,numeroUnicoSend,statSend) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/"+localSend+"/muda-permissao.php",
			type: "GET",
			data: "sufixoS="+sufixoSend+"&campoS="+campoSend+"&idS="+idSend+"&numeroUnicoS="+numeroUnicoSend+"&statS="+statSend+"",
			//dataType: "html",
			success: function(data){
				var $toast = toastr["success"]("Status alterado com sucesso !", "");

				$("#lista_usuarios"+sufixoSend+"").html(data);
			},
		});
}

function remover_syscronograma_item(idSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/remover-syscronograma_item.php",
			type: "GET",
			data: "idS="+idSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function muda_stat_syscronograma_item(cmpSend,cmpDataSend,idSend,statSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/muda-syscronograma_item.php",
		type: "GET",
		data: "cmpS="+cmpSend+"&cmpDataS="+cmpDataSend+"&idS="+idSend+"&statS="+statSend+"",
		//dataType: "html",
		success: function(data){
			location.reload();
		},
	});
}

function muda_stat_ajax(localSend,modSend,subLocalSend,idSend,statSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/muda-stat-ajax.php",
		type: "GET",
		data: "localS="+localSend+"&subLocalS="+subLocalSend+"&idS="+idSend+"&modS="+modSend+"&statS="+statSend+"",
		//dataType: "html",
		success: function(data){
			var $toast = toastr["success"]("Status alterado com sucesso !", "");

			$("#"+localSend+"_itens").html(data);
		},
	});
}

function muda_stat_ajax_novo(cmpSend,cmpDataSend,localSend,modSend,subLocalSend,idSend,statSend,numeroUnicoSend,sufixoSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/muda-stat-ajax-novo.php",
		type: "GET",
		data: "cmpS="+cmpSend+"&cmpDataS="+cmpDataSend+"&localS="+localSend+"&subLocalS="+subLocalSend+"&idS="+idSend+"&modS="+modSend+"&statS="+statSend+"&sufixoS="+sufixoSend+"&numeroUnicoS="+numeroUnicoSend+"",
		//dataType: "html",
		success: function(data){
			var $toast = toastr["success"]("Status alterado com sucesso !", "");

			$("#"+localSend+"_itens"+sufixoSend+"").html(data);
		},
	});
}

function muda_stat_tempo_real(modSend,idSend,statSend,conexaoSend,idsysusuSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/muda-stat-tempo-real.php",
		type: "GET",
		data: "idS="+idSend+"&modS="+modSend+"&statS="+statSend+"&conexaoS="+conexaoSend+"&idsysusuS="+idsysusuSend+"",
		//dataType: "html",
		success: function(data){
			if(data.indexOf("NAO_ATIVAR##") < 0) {
				if(modSend=="resultado"||modSend=="chart") { } else {
					var $toast = toastr["success"]("Status alterado com sucesso !", "");
				}
				$("#stat-"+idSend+"").html(data);
			} else {
				var retorno_string = data.replace("NAO_ATIVAR##", "");
				if(modSend=="resultado") { } else {
					var $toast = toastr["error"](""+retorno_string+"", "");
				}
			}

		},
	});

}

function muda_stat(modSend,idSend,statSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/muda-stat.php",
		type: "GET",
		data: "idS="+idSend+"&modS="+modSend+"&statS="+statSend+"",
		//dataType: "html",
		success: function(data){
			location.reload();
		},
	});

}

function remover_imagem(idSend,modSend,campoSend) {
	if (confirm("Você realmente deseja remover esta imagem ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/remover-imagem.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&campoS="+campoSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function mensagemImportante(numeroUnicoSend,idSend) {
	if (confirm("Você realmente deseja modificar o status desta mensagem ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysmensagem/importancia.php",
			type: "GET",
			data: "numeroUnicoS="+numeroUnicoSend+"&idS="+idSend+"",
			//dataType: "html",
			success: function(data){
				$("#controle-msg-"+idSend+"").html(data);
			},
		});
	}
}

function salva_campo_tabela_ajax_novo(localSend,subLocalSend,nomeSend,idSend,modSend,valorSend,sufixoSend,numeroUnicoSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/atualiza-campo-ajax-novo.php",
		type: "GET",
		data: "localS="+localSend+"&subLocalS="+subLocalSend+"&nomeS="+nomeSend+"&idS="+idSend+"&modS="+modSend+"&valorS="+valorSend+"&sufixoS="+sufixoSend+"&numeroUnicoS="+numeroUnicoSend+"",
		//dataType: "html",
		success: function(data){
			location.reload();
		},
	});
}

function salva_campo_tabela_ajax(localSend,subLocalSend,nomeSend,idSend,modSend,valorSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/atualiza-campo-ajax.php",
		type: "GET",
		data: "localS="+localSend+"&subLocalS="+subLocalSend+"&nomeS="+nomeSend+"&idS="+idSend+"&modS="+modSend+"&valorS="+valorSend+"",
		//dataType: "html",
		success: function(data){
			var $toast = toastr["success"]("Salvo com sucesso !", "");

			$("#"+localSend+"_itens").html(data);
		},
	});
}

function salva_ordem_rapida(nomeSend,idSend,modSend,subLocalSend,cmpReferenciaSend,idReferenciaSend,valorSend) {
	preloaderIn();
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/atualiza-ordem-rapida-campo.php",
		type: "GET",
		data: "nomeS="+nomeSend+"&idS="+idSend+"&modS="+modSend+"&subLocalS="+subLocalSend+"&valorS="+valorSend+"&cmpReferenciaS="+cmpReferenciaSend+"&idReferenciaS="+idReferenciaSend+"",
		//dataType: "html",
		success: function(data){
			location.reload();
			/*
			var $toast = toastr["success"]("Campo alterado com sucesso !", "");
			$("#tabela_montada").html(data);
			FormEditable.init();
			preloaderOut();
			*/
		},
	});
}

function salva_campo_tabela(nomeSend,idSend,modSend,subLocalSend,valorSend) {
	preloaderIn();
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/atualiza-campo.php",
		type: "GET",
		data: "nomeS="+nomeSend+"&idS="+idSend+"&modS="+modSend+"&subLocalS="+subLocalSend+"&valorS="+valorSend+"",
		//dataType: "html",
		success: function(data){
			location.reload();
			/*
			var $toast = toastr["success"]("Campo alterado com sucesso !", "");
			$("#tabela_montada").html(data);
			FormEditable.init();
			preloaderOut();
			*/
		},
	});
}

function salva_campo_tabela_reload(nomeSend,idSend,modSend,subLocalSend,valorSend) {

	preloaderIn();

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/atualiza-campo.php",
		type: "GET",
		data: "nomeS="+nomeSend+"&idS="+idSend+"&modS="+modSend+"&subLocalS="+subLocalSend+"&valorS="+valorSend+"",
		//dataType: "html",
		success: function(data){
			if(modSend=="resultado") { } else {
				var $toast = toastr["success"]("Campo alterado com sucesso !", "");
			}

			$('#'+nomeSend+'-'+idSend+'').css("color","green");

			preloaderOut();
			//location.reload();
		},
	});

	/*
	if (confirm("Você realmente deseja atualizar o conteúdo deste campo ?")) {
		preloaderIn();
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/atualiza-campo.php",
			type: "GET",
			data: "nomeS="+nomeSend+"&idS="+idSend+"&modS="+modSend+"&subLocalS="+subLocalSend+"&valorS="+valorSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
	*/
}

function remover_item_caixa(idSend,modSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/remover-item-caixa.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function muda_stat_caixa(modSend,idSend,statSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysgeral/muda-stat-caixa.php",
		type: "GET",
		data: "idS="+idSend+"&modS="+modSend+"&statS="+statSend+"",
		//dataType: "html",
		success: function(data){
			location.reload();
		},
	});
}

function pago_caixa(modSend,idSend,statSend) {
	if (confirm("Você realmente deseja modificar o status deste item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/pago-caixa.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&statS="+statSend+"",
			//dataType: "html",
			success: function(data){
				if(statSend==1) {
					$('#pago-'+idSend+'-0').hide();
					$('#pago-'+idSend+'-1').fadeIn();
				} else {
					$('#pago-'+idSend+'-1').hide();
					$('#pago-'+idSend+'-0').fadeIn();
				}
			},
		});
	}
}

function remover_item_tabela(idSend,modSend,ordemSetSend,ordemSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/remover-item.php",
			type: "GET",
			data: "idS="+idSend+"&modS="+modSend+"&ordemSetS="+ordemSetSend+"&ordemS="+ordemSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function remover_syscontrato(idSend) {
	if (confirm("Você realmente deseja remover este contrato ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysgeral/remover-item-syscontrato.php",
			type: "GET",
			data: "idS="+idSend+"",
			//dataType: "html",
			success: function(data){
				location.reload();
			},
		});
	}
}

function controleTipo() {
	cmpTipo = document.getElementById("tipo");
	if(cmpTipo.value=="texto") {
		$('#controle-mascara').fadeIn();
		$('#controle-itens').fadeOut();
	} else {
		$('#controle-mascara').fadeOut();

		if(cmpTipo.value=="radio"||cmpTipo.value=="check"||cmpTipo.value=="select-simples"||cmpTipo.value=="select-pesquisa"||cmpTipo.value=="select-multiplo") {
			if(cmpTipo.value=="radio"||cmpTipo.value=="check") {
				$('#controle-largura-altura').fadeOut();
			} else {
				$('#controle-largura-altura').fadeIn();
			}
			$('#controle-texto-demonstrativo').fadeOut();
			$('#controle-css').fadeOut();
			$('#controle-mostrar-na-listagem').fadeOut();
			
			$('#controle-itens').fadeIn();
		} else {
			$('#controle-largura-altura').fadeIn();
			$('#controle-texto-demonstrativo').fadeIn();
			$('#controle-css').fadeIn();
			$('#controle-mostrar-na-listagem').fadeIn();

			$('#controle-itens').fadeOut();
		}
	}
}

function controleModeloCampo() {
	cmpTipo = document.getElementById("campo_modelo");
	if(cmpTipo.value=="normal") {
		$('#controle-modelo-campo').hide();
		$('#controle-tipo').fadeIn();
		$('#controle-texto-demonstrativo').fadeIn();
		$('#controle-css').fadeIn();
	} else {
		$('#controle-modelo-campo').fadeIn();
		$('#controle-tipo').fadeOut();
		$('#controle-texto-demonstrativo').fadeOut();
		$('#controle-css').fadeOut();
	}
}

function setListWidth(statusSend) {
	if(statusSend=="0") {
		$('#controle-list-altura').hide();
	} else {
		$('#controle-list-altura').fadeIn();
	}
}

function carregaSysmodcampo() {
	cmpMod = document.getElementById("idsysmoditemexterno");
	$.ajax({
		url: ""+linkAdminLib+"include/lib/lista-sysmodcampoexterno.php",
		type: "GET",
		data: "sysmoditemS="+cmpMod.value+"",
		//dataType: "html",
		success: function(data){
			$("#idsysmodcampoexterno").html(data);
		},
	});
}

function salvarCampoItem() {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	cmpTipo = document.getElementById("tipoItem");
	cmpOrdem = document.getElementById("ordemItem");
	cmpNome = document.getElementById("nomeItem");

	if($.trim(cmpTipo.value)=="") {
		alert("O campo 'Tipo de Item' deve ser preenchido");
		cmpTipo.focus();
	} else {
		if($.trim(cmpOrdem.value)=="") {
			alert("O campo 'Ordem do Item' deve ser preenchido");
			cmpCurso.focus();
		} else {
			if($.trim(cmpNome.value)=="") {
				alert("O campo 'Nome do Item' deve ser preenchido");
				cmpNome.focus();
			} else {
				$.ajax({
					url: ""+linkAdminAcoes+"acoes/sysmodcampoitem/do.php",
					type: "GET",
					data: "acaoS=adiciona&numeroUnicoS="+cmpNumeroUnico.value+"&tipoS="+cmpTipo.value+"&ordemS="+cmpOrdem.value+"&nomeS="+cmpNome.value+"",
					//dataType: "html",
					success: function(data){
						$("#controle-itens").html(data);
					},
				});
			}
		}
	}
}


function gerar_relatorio(modSend) {
	cmpResponsavel = document.getElementById("responsavel_rela");
	cmpSituacao = document.getElementById("situacao_rela");
	cmpDataIni = document.getElementById("data_inicio_rela");
	cmpDataFim = document.getElementById("data_fim_rela");

	if($.trim(modSend)=="") {
		$("#botao-imprimir-relatorio").fadeOut();
		$("#botao-limpar-relatorio").fadeOut();
		$("#lista_relatorio").html("");
	} else {
		if($.trim(cmpResponsavel.value)=="") {
			alert("O campo 'Responsável' deve ser preenchido");
			cmpResponsavel.focus();
		} else {
			$("#botao-imprimir-relatorio").fadeIn();
			$("#botao-limpar-relatorio").fadeIn();
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/sysgeral/lista_relatorio.php",
				type: "GET",
				data: "modS="+modSend+"&responsavelS="+cmpResponsavel.value+"&situacaoS="+cmpSituacao.value+"&data_inicioS="+cmpDataIni.value+"&data_fimS="+cmpDataFim.value+"",
				//dataType: "html",
				success: function(data){
					$("#lista_relatorio").html(data);
				},
			});
		}
	}
}

function updateCampoItem(numeroUnicoSend,idSend) {
	cmpTipo = document.getElementById("idtipoItem-"+idSend+"");
	cmpOrdem = document.getElementById("idordemItem-"+idSend+"");
	cmpNome = document.getElementById("idnomeItem-"+idSend+"");

	if($.trim(cmpTipo.value)=="") {
		alert("O campo 'Tipo de Item' deve ser preenchido");
		cmpTipo.focus();
	} else {
		if($.trim(cmpOrdem.value)=="") {
			alert("O campo 'Ordem do Item' deve ser preenchido");
			cmpCurso.focus();
		} else {
			if($.trim(cmpNome.value)=="") {
				alert("O campo 'Nome do Item' deve ser preenchido");
				cmpNome.focus();
			} else {
				$.ajax({
					url: ""+linkAdminAcoes+"acoes/sysmodcampoitem/do.php",
					type: "GET",
					data: "acaoS=update&idS="+idSend+"&numeroUnicoS="+numeroUnicoSend+"&tipoS="+cmpTipo.value+"&ordemS="+cmpOrdem.value+"&nomeS="+cmpNome.value+"",
					//dataType: "html",
					success: function(data){
						$("#controle-itens").html(data);
					},
				});
			}
		}
	}
}

function statusCampoItem(numeroUnicoSend,idSend,statusSend) {
	if (confirm("Você realmente deseja modificar o status deste item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysmodcampoitem/do.php",
			type: "GET",
			data: "acaoS=status&numeroUnicoS="+numeroUnicoSend+"&statusS="+statusSend+"&idS="+idSend+"",
			//dataType: "html",
			success: function(data){
				$("#controle-itens").html(data);
			},
		});
	}
}

function editaCampoItem(idSend) {
	$("#tipoItem-"+idSend+"").hide();
	$("#ordemItem-"+idSend+"").hide();
	$("#nomeItem-"+idSend+"").hide();
	$("#editarItem-"+idSend+"").hide();

	$("#idtipoItem-"+idSend+"").fadeIn();
	$("#idordemItem-"+idSend+"").fadeIn();
	$("#idnomeItem-"+idSend+"").fadeIn();
	$("#idsalvarItem-"+idSend+"").fadeIn();
}

function removeCampoItem(numeroUnicoSend,idSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysmodcampoitem/do.php",
			type: "GET",
			data: "acaoS=remove&numeroUnicoS="+numeroUnicoSend+"&idS="+idSend+"",
			//dataType: "html",
			success: function(data){
				$("#controle-itens").html(data);
			},
		});
	}
}

function removeImagemFormulario(numeroUnicoSend,modSend,campoSend,imagemSend,idSend) {
	if (confirm("Você realmente deseja remover este item ?")) {
		$.ajax({
			url: ""+linkAdminLib+"include/lib/remove-imagem.php",
			type: "GET",
			data: "numeroUnicoS="+numeroUnicoSend+"&modS="+modSend+"&campoS="+campoSend+"&imagemS="+imagemSend+"&idS="+idSend+"",
			//dataType: "html",
			success: function(data){
				$("#arquivo-atual-"+campoSend+"").hide();
			},
		});
	}
}

function carrega_valores_sysprojeto_modulo() {
	cmpSysprojetoModulo = document.getElementById("idsysprojeto_modulo");
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysprojeto/carrega_valores_sysprojeto_modulo.php",
		type: "GET",
		data: "idS="+cmpSysprojetoModulo.value+"",
		//dataType: "html",
		success: function(data){
			var retorno = data.split("|");
			$("#valor_investimento_inicial").val(retorno[0]);
			$("#valor_mensalidade").val(retorno[1]);
		},
	});
}

function adicionar_sysprojeto_cliente_modulos() {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	cmpSysprojetoModulo = document.getElementById("idsysprojeto_modulo");
	cmpValorInvestimento = document.getElementById("valor_investimento_inicial");
	cmpValorMensalidade = document.getElementById("valor_mensalidade");
	cmpValorDesconto = document.getElementById("valor_desconto");
	cmpQtdMensalidade = document.getElementById("meses_contrato");
	
	if($.trim(cmpSysprojetoModulo.value)=="") {
		alert("Você deve selecionar um módulo para inserir");
		cmpSysprojetoModulo.focus();
	} else {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysprojeto/do.php",
			type: "GET",
			data: "acaoS=consulta&numeroUnicoS="+cmpNumeroUnico.value+"&idS="+cmpSysprojetoModulo.value+"",
			//dataType: "html",
			success: function(data){
				window.setTimeout(function() {
					if(parseInt(data)==0) {
						$.ajax({
							url: ""+linkAdminAcoes+"acoes/sysprojeto/do.php",
							type: "GET",
							data: "acaoS=adiciona&numeroUnicoS="+cmpNumeroUnico.value+"&idS="+cmpSysprojetoModulo.value+"&valor_investimento_inicialS="+cmpValorInvestimento.value+"&valor_mensalidadeS="+cmpValorMensalidade.value+"&valor_descontoS="+cmpValorDesconto.value+"&qtd_mensalidadesS="+cmpQtdMensalidade.value+"",
							//dataType: "html",
							success: function(data){
								$("#lista-sysprojeto_cliente_modulos").html(data);
								$("#idsysprojeto_modulo").val("");
								$("#valor_investimento_inicial").val("");
								$("#valor_mensalidade").val("");
								$("#valor_desconto").val("");
							},
						});
					} else {
						alert("Este módulo ja foi inserido neste projeto !");
					}
				}, 500);		
			},
		});
	}
}

function deletar_sysprojeto_cliente_modulos(idSend) {
	cmpNumeroUnico = document.getElementById("numeroUnico");
	cmpQtdMensalidade = document.getElementById("meses_contrato");

	if (confirm("Você realmente deseja excluir este módulo deste projeto ?")) {
		$.ajax({
			url: ""+linkAdminAcoes+"acoes/sysprojeto/do.php",
			type: "GET",
			data: "acaoS=remove&idS="+idSend+"&numeroUnicoS="+cmpNumeroUnico.value+"&qtd_mensalidadesS="+cmpQtdMensalidade.value+"",
			//dataType: "html",
			success: function(data){
				$("#lista-sysprojeto_cliente_modulos").html(data);
			},
		});
	}
}

function responsavel_buscaCepTxt() {
	if($.trim( $("#responsavel_cep").val() )=="") {
		alert("Para realizar o preenchimento do endereço através do CEP, o campo deve ser preenchido");
		$("#responsavel_cep").focus();
	} else {
		preloaderIn();
		$.ajax({
			url: ""+linkAdminLib+"include/lib/cepTxt.php",
			type: "GET",
			data: "numeroCep="+$("#responsavel_cep").val()+"",
			//dataType: "html",
			success : function(data){
				var retorno = data.split("|");
				$("#responsavel_rua").val(""+retorno[1]+"");
				cmpEstado = $("#responsavel_estado");
				cmpCidade = $("#responsavel_cidade");
				cmpBairro = $("#responsavel_bairro");
				$("#responsavel_estado").val(""+retorno[4]+"");
				$.ajax({
					url: ""+linkAdminLib+"include/lib/lista-cidadesTxt.php",
					type: "GET",
					data: "estadoS="+$("#responsavel_estado").val()+"",
					//dataType: "html",
					success: function(data){
						$("#responsavel_cidade").html(data);
						$("#responsavel_cidade").val(""+retorno[3]+"");
						$.ajax({
							url: ""+linkAdminLib+"include/lib/lista-bairrosTxt.php",
							type: "GET",
							data: "cidadeS="+$("#responsavel_cidade").val()+"",
							//dataType: "html",
							success: function(data){
								$("#responsavel_bairro").html(data);
								$("#responsavel_bairro").val(""+retorno[2]+"");
								preloaderOut();
							},
						});
					},
				});
			}
		});
	}
}

function buscaCepTxt() {
	if($.trim( $("#cep").val() )=="") {
		alert("Para realizar o preenchimento do endereço através do CEP, o campo deve ser preenchido");
		$("#cep").focus();
	} else {
		preloaderIn();
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
								preloaderOut();
							},
						});
					},
				});
			}
		});
	}
}

function buscaCepTxtSemPreloader() {
	if($.trim( $("#cep").val() )=="") {
		alert("Para realizar o preenchimento do endereço através do CEP, o campo deve ser preenchido");
		$("#cep").focus();
	} else {
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
							},
						});
					},
				});
			}
		});
	}
}


function buscaCep() {

	if($.trim( $("input[name='cep']").val() )=="") {
		alert("Para realizar o preenchimento do endereço através do CEP, o campo deve ser preenchido");
		$("input[name='cep']").focus();
	} else {

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

							},
						});
	
					},
				});
	
			}   
		});
	}
}

function buscaCepEditar() {
	cmpCep = document.getElementById("cep_editar");
	if($.trim(cmpCep.value)=="") {
		alert("Para realizar o preenchimento do endereço através do CEP, o campo deve ser preenchido");
		cmpCep.focus();
	} else {
	
		$("#preloader_editar").fadeIn();

		$.ajax({
			url: ""+linkAdminLib+"include/lib/cep.php",
			type: "GET",
			data: "numeroCep="+cmpCep.value+"",
			//dataType: "html",
			success : function(data){                                               
				var retorno = data.split("|");
	
				cmpRua = document.getElementById("rua_editar");
				cmpEstado = document.getElementById("estado_editar");
				cmpCidade = document.getElementById("cidade_editar");
				cmpBairro = document.getElementById("bairro_editar");
	
				cmpRua.value = retorno[1];
	
				$('#estado_editar').find('option[value="'+retorno[4]+'"]').attr('selected',true);
				var valor = cmpEstado.options[cmpEstado.selectedIndex].innerText;
				
				$.ajax({
					url: ""+linkAdminLib+"include/lib/lista-cidades.php",
					type: "GET",
					data: "estadoS="+cmpEstado.value+"",
					//dataType: "html",
					success: function(data){
						$('#cidade_editar').html(data);
						$('#cidade_editar').find('option[value="'+retorno[3]+'"]').attr('selected',true);
						var valor = cmpCidade.options[cmpCidade.selectedIndex].innerText;
	
						$.ajax({
							url: ""+linkAdminLib+"include/lib/lista-bairros.php",
							type: "GET",
							data: "cidadeS="+cmpCidade.value+"",
							//dataType: "html",
							success: function(data){
								$('#bairro_editar').html(data);
								$('#bairro_editar').find('option[value="'+retorno[2]+'"]').attr('selected',true);
								var valor = cmpBairro.options[cmpBairro.selectedIndex].innerText;

								$("#preloader_editar").fadeOut();
							},
						});
	
					},
				});
	
			}   
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

function mostraBairros() {
	$("select[name='bairro']").html("<option value=''>Carregando...</option>");
	$.ajax({
		url: ""+linkAdminLib+"include/lib/lista-bairros.php",
		type: "GET",
		data: "cidadeS="+$("select[name='cidade']").val()+"",
		//dataType: "html",
		success: function(data){
			$("select[name='bairro']").html(data);
		},
	});
}




