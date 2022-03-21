<style type="text/css">
  .custom-clustericon {
	background: var(--cluster-color) !important;
	color: #fff !important;
	border-radius: 100% !important;
	font-weight: bold !important;
	font-size: 15px !important;
	display: flex !important;
	align-items: center !important;
  }

  .custom-clustericon::before,
  .custom-clustericon::after {
	content: "";
	display: block !important;
	position: absolute !important;
	width: 120% !important;
	height: 120% !important;

	transform: translate(-50%, -50%) !important;
	top: 50% !important;
	left: 50% !important;
	background: var(--cluster-color) !important;
	opacity: 0.2 !important;
	border-radius: 100% !important;
  }
  .custom-clustericon::before {
	width: 140% !important;
	height: 140% !important;
  }

  .custom-clustericon::before {
	padding: 7px !important;
  }

  .custom-clustericon::after {
	padding: 14px !important;
  }

  .custom-clustericon-1 {
	--cluster-color: #ff6969;
  }

  .custom-clustericon-2 {
	--cluster-color: #f0dd0b;
  }

  .custom-clustericon-3 {
	--cluster-color: #ff9b00;
  }

  .custom-clustericon-4 {
	--cluster-color: #00a2d3;
  }

  .custom-clustericon-4 {
	--cluster-color: #62cc1b;
  }
</style>

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>

<? if(trim($caminho_scripts)=="") { } else { include("".$caminho_scripts.""); } ?>
<? if($ScriptsDashboard == "ON") { ?>
<? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/cluster-mapa.php"); ?>

<script src="https://maps.googleapis.com/maps/api/js?key=<?=$GOOGLE_KEY?>&callback=initMap&libraries=visualization&v=weekly" async ></script>
<? } ?>

<? if(trim($_REQUEST['var1'])=="editor-de-eventos")    { include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/eventos/js/calcula_porcentagem.js.php"); } ?>

<? if($preloaderEventoExterno==1) { ?>
<script src="<?=$link?>templates/<?=$layout_padrao_set?>/acoes/eventos/js/scripts-v2.js?<?php echo time(); ?>"></script>

<script>
jQuery(document).ready(function() {    
	ticket_lista_POST();
	parent_preloaderOut();	
});
</script>
<? } ?>

<!-- END PAGE LEVEL SCRIPTS -->
<script>

$( ".btn_salvar_desabilitar" ).click(function() {
	$(this).attr('disabled', 'disabled');
});

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

function salvar_continuar_editando(acaoSend) {
	$("#idacaoForm").val(""+acaoSend+"");

	<? if(trim($row_estrutura['interno_galeria'])==1) { ?>
	if($("#ordem_alterada").val()=="1") {
		alert("Você alterou a ordem das imagens da galeria mas não salvou, clique no botão 'SALVAR NOVA ORDENAÇÃO' para concluir o processo!");
	} else {
		$("#formulario").submit();
	}
	<? } else { ?>
	$("#formulario").submit();
	<? } ?>

}

function duplicar_selecionados() {
	$.ajax({
		url:  "<?=$link?>templates/<?=$layout_padrao_set?>/acoes/<?=$_SESSION['acoes']?>/post-<?=$_SESSION['mod']?>.php",
		type: "GET",
		data: "selecionadosS="+$("#lista_checkboxes").val()+"&modS=<?=$_SESSION['mod']?>&duplicar=1",
		//dataType: "html",
		success: function(data){
			location.reload();
		},
	});
}


$.ajaxSetup({ cache: false });

$(window).unbind('beforeunload');

$("form").submit(function(){
	$(window).unbind('beforeunload');
});

$(window).bind('beforeunload', function(){
	if ($("#idacaoForm").val()=="add"&&$("#aba-adicionar-novo").hasClass("active")===true&&$("#campos_alterados").val()=="1"){
		return "Você esta adicionando um item.";
	} else {
		if ($("#idacaoForm").val()=="editar"&&$("#campos_alterados").val()=="1"){
			return "Você esta editando um item.";
		} else {
		}
	}

});

$(window).load(function() {
	$("#body_arvore_galeria").bind("contextmenu",function(e){
		return false;
	});
});

$(".submenu_novo").mouseover(function() {
	var cor_setada = $(this).attr("cor_set");
	$(this).children('a').css("border-left","5px solid "+cor_setada+"");
	/*
	if($(this).hasClass( "open" )) { } else {
		$(this).children('a .submenu_novo_icone').css("color","#FFFFFF");
		$(this).children('.submenu_novo_titulo').css("color","#FFFFFF");
	}
	*/
});

$(".submenu_novo").mouseleave(function() {
	var cor_setada = $(this).attr("cor_set");
	if($(this).hasClass( "open" )) { } else {
		$(this).children('a').css("border-left","0px solid "+cor_setada+"");
	}
	/*
		$(this).children('a .submenu_novo_icone').css("color","#FFFFFF");
		$(this).children('.submenu_novo_titulo').css("color","#FFFFFF");
	}
	*/
});

$(".box_menu").click(function() {
	$(".box_ativo").removeClass( "box_ativo" ).addClass( "box_inativo" );
	$(".div_ativo").removeClass( "div_ativo" ).addClass( "div_inativo" );
	var divSet = $(this).attr("div-toggle");
	$(this).removeClass( "box_inativo" ).addClass( "box_ativo" );
	$("#"+divSet+"").removeClass( "div_inativo" ).addClass( "div_ativo" ).fadeIn();
});

$('.date-picker').datepicker({
	format: "dd/mm/yyyy",
	todayBtn: "linked",
	language: "pt-BR",
	autoclose: true,
	orientation: "bottom",
	todayHighlight: true
});

$('.timepicker').timepicker({
	autoclose: true,
	minuteStep: 5,
	showSeconds: false,
	showMeridian: false
});

$('.color_campo, .campo_cor').each(function() {
	//
	// Dear reader, it's actually very easy to initialize MiniColors. For example:
	//
	//  $(selector).minicolors();
	//
	// The way I've done it below is just for the demo, so don't get confused
	// by it. Also, data- attributes aren't supported at this time...they're
	// only used for this demo.
	//
	$(this).minicolors({
		control: $(this).attr('data-control') || 'hue',
		defaultValue: $(this).attr('data-defaultValue') || '',
		inline: $(this).attr('data-inline') === 'true',
		letterCase: $(this).attr('data-letterCase') || 'lowercase',
		opacity: $(this).attr('data-opacity'),
		position: $(this).attr('data-position') || 'bottom left',
		change: function(hex, opacity) {
			if (!hex) return;
			if (opacity) hex += ', ' + opacity;
			if (typeof console === 'object') {
				console.log(hex);
			}
		},
		theme: 'bootstrap'
	});

});

jQuery(document).ready(function() {    
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
	BancoDeMidia.init();
	ComponentsMenuContextoArvore.init();
	<? if($tabela_ajax==1) { ?>
	TableAjax.init();
	<? } ?>
	<? if($_REQUEST['var3']=="descricao") { } else { ?>
	<? if($ComponentesOpen=="off") { } else { ?>
	Componentes.init();
	<? } ?>
	<? } ?>

	<? if($preloaderEventoExterno==1) { ?>
	ticket_lista();
	parent_preloaderOut();	
	<? } ?>

	$('.btn-cancelar').click(function () {
		event.preventDefault();
		history.back(1);
	});

	$(window).resize(function() {
		$("#arvore_galeria").css( "height", ""+$(".page-galeria-sidebar-wrapper").height()-116+"px" );
		$("#galeria-conteudo-pasta").css( "height", ""+$(".page-galeria-sidebar-wrapper").height()-93+"px" );

		$("#pasta_galeria").css( "height", ""+ $("#galeria-conteudo-pasta").height() - 89 +"px" );
		//$("#iframe_lista").css( "height", ""+ parent.$("#pasta_galeria").height() - 365 +"px" );
	});

});
</script>

<!-- END JAVASCRIPTS -->
