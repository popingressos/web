function sysmidia_visualizacao(valorSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/geral-grava-visualizacao.php",
		type: "GET",
		data: "valorS="+valorSend+"",
		//dataType: "html",
		success: function(data){
		},
	});
}

function sysmidia_campo_exibe(campoSend,valorSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/geral-grava-campo-exibe.php",
		type: "GET",
		data: "campoS="+campoSend+"&valorS="+valorSend+"",
		//dataType: "html",
		success: function(data){
		},
	});
}

function sysmidia_ordenacao(valorSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/geral-grava-ordenacao.php",
		type: "GET",
		data: "valorS="+valorSend+"",
		//dataType: "html",
		success: function(data){
			$( '#iframe_lista' ).attr( 'src', function () { return $( this )[0].src; } );
		},
	});
}

function sysmidia_ordenacao_direcao(valorSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/geral-grava-ordenacao-direcao.php",
		type: "GET",
		data: "valorS="+valorSend+"",
		//dataType: "html",
		success: function(data){
			$( '#iframe_lista' ).attr( 'src', function () { return $( this )[0].src; } );
		},
	});
}

// INTERNO
function sysmidia_interno_visualizacao(valorSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/geral-grava-visualizacao_interno.php",
		type: "GET",
		data: "valorS="+valorSend+"",
		//dataType: "html",
		success: function(data){
		},
	});
}

function sysmidia_interno_campo_exibe(campoSend,valorSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/geral-grava-campo-exibe_interno.php",
		type: "GET",
		data: "campoS="+campoSend+"&valorS="+valorSend+"",
		//dataType: "html",
		success: function(data){
		},
	});
}

function sysmidia_interno_ordenacao(valorSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/geral-grava-ordenacao_interno.php",
		type: "GET",
		data: "valorS="+valorSend+"",
		//dataType: "html",
		success: function(data){
			$( '#_construtor_template_iframe_lista' ).attr( 'src', function () { return $( this )[0].src; } );
		},
	});
}

function sysmidia_interno_ordenacao_direcao(valorSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/geral-grava-ordenacao-direcao_interno.php",
		type: "GET",
		data: "valorS="+valorSend+"",
		//dataType: "html",
		success: function(data){
			$( '#_construtor_template_iframe_lista' ).attr( 'src', function () { return $( this )[0].src; } );
		},
	});
}

// INTERNO OUT
function sysmidia_interno_out_visualizacao(valorSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/geral-grava-visualizacao_interno_out.php",
		type: "GET",
		data: "valorS="+valorSend+"",
		//dataType: "html",
		success: function(data){
		},
	});
}

function sysmidia_interno_out_campo_exibe(campoSend,valorSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/geral-grava-campo-exibe_interno_out.php",
		type: "GET",
		data: "campoS="+campoSend+"&valorS="+valorSend+"",
		//dataType: "html",
		success: function(data){
		},
	});
}

function sysmidia_interno_out_ordenacao(valorSend,modSend,numeroUnico_modulo_catSend,numeroUnico_moduloSend,numeroUnico_paiSend) {

	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/geral-grava-ordenacao_interno_out.php",
		type: "GET",
		data: "valorS="+valorSend+"&numeroUnico_paiS="+numeroUnico_paiSend+"",
		//dataType: "html",
		success: function(data){

			$.ajax({
				url: ""+linkAdminAcoes+"acoes/sysmidia/_construtor_template-pasta-out.php",
				type: "GET",
				data: "modS="+modSend+"&numeroUnico_modulo_catS="+numeroUnico_modulo_catSend+"&numeroUnico_moduloS="+numeroUnico_moduloSend+"&numeroUnico_paiS="+numeroUnico_paiSend+"",
				//dataType: "html",
				success: function(data_pasta){
					$("#lista_selecionados_galeria").val("")
					$("#DIV_pasta").html(data_pasta);
					Metronic.init();
					Componentes.init();
					$('input').iCheck();

				},
			});

		},
	});
}

function sysmidia_interno_out_ordenacao_direcao(valorSend,modSend,numeroUnico_modulo_catSend,numeroUnico_moduloSend,numeroUnico_paiSend) {
	$.ajax({
		url: ""+linkAdminAcoes+"acoes/sysmidia/geral-grava-ordenacao-direcao_interno_out.php",
		type: "GET",
		data: "valorS="+valorSend+"&numeroUnico_paiS="+numeroUnico_paiSend+"",
		//dataType: "html",
		success: function(data){
			$.ajax({
				url: ""+linkAdminAcoes+"acoes/sysmidia/_construtor_template-pasta-out.php",
				type: "GET",
				data: "modS="+modSend+"&numeroUnico_modulo_catS="+numeroUnico_modulo_catSend+"&numeroUnico_moduloS="+numeroUnico_moduloSend+"&numeroUnico_paiS="+numeroUnico_paiSend+"",
				//dataType: "html",
				success: function(data_pasta){
					$("#lista_selecionados_galeria").val("")
					$("#DIV_pasta").html(data_pasta);
					Metronic.init();
					Componentes.init();

				},
			});
		},
	});
}
