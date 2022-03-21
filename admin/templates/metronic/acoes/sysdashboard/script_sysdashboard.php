<script src="<?=$link?>templates/<?=$layout_padrao_set?>/acoes/sysdashboard/js/scripts.js?<?php echo time(); ?>"></script>
<script src="<?=$link?>templates/<?=$layout_padrao_set?>/acoes/personal/js/scripts.js?<?php echo time(); ?>"></script>

<script>
  window.Promise ||
	document.write(
	  '<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"><\/script>'
	)
  window.Promise ||
	document.write(
	  '<script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js"><\/script>'
	)
  window.Promise ||
	document.write(
	  '<script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"><\/script>'
	)
</script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<? 
if(trim($scripts_acompanhamento_de_vendas_de_eventoSet)=="SIM") { 
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/script_sysdashboard_acompanhamento_de_vendas_de_evento.php");
}
if(trim($scripts_vacinados_por_periodoSet)=="SIM") { 
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/script_sysdashboard_vacinados_por_periodo.php");
}
if(trim($scripts_vacinados_por_grupoSet)=="SIM") { 
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/script_sysdashboard_vacinados_por_grupo.php");
}
if(trim($scripts_vacinados_por_faixa_etariaSet)=="SIM") { 
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/script_sysdashboard_vacinados_por_faixa_etaria.php");
}
if(trim($scripts_vacinados_por_mapaSet)=="SIM") { 
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/script_sysdashboard_vacinados_por_mapa.php");
}
if(trim($scripts_vacinador_por_mapaSet)=="SIM") { 
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/script_sysdashboard_vacinador_por_mapa.php");
}
if(trim($scripts_cadastrados_por_mapaSet)=="SIM") { 
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/script_sysdashboard_cadastrados_por_mapa.php");
}
if(trim($scripts_cadastrados_por_mapa_de_calorSet)=="SIM") { 
	include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/script_sysdashboard_cadastrados_por_mapa_de_calor.php");
}
?>
<script>
$(document).on('keypress', 'input', function(ev){
	seta_altera_campo();
});

$(document).on('change', 'select', function(ev){
	seta_altera_campo();
});

$('.tabela_com_scroll').dataTable( {
	scrollY:        300,
	deferRender:    true,
	scroller:       true,
	"language": {
		"search": "_INPUT_",
		"searchPlaceholder": "Digite sua busca",
		"lengthMenu": "Mostrando _MENU_ itens por página",
		"zeroRecords": "Nada encontrado - desculpa",
		"info": "",
		"infoEmpty": "Sem itens disponíveis",
		"infoFiltered": "(filtrando de _MAX_ total)"
	}
});

function initMap() {
	<?=$script_mapa?>
}

<?=$locations_mapa?>

</script>

    
    