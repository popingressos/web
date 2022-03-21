<script>
// Shared Colors Definition
const primary = '#6993FF';
const success = '#1BC5BD';
const info = '#8950FC';
const warning = '#FFA800';
const danger = '#F64E60';

const apexChart_setores_mais_vendidos = "#chart_setores_mais_vendidos";
var options = {
	series: [
	<?
	$contTicket = 0;
	for ($row = 0; $row < count($rData); $row++) {
		$contTicket++;
		if($contTicket<=5) {
			$rSql = $rData[$row];
	?>
		<?=$rSql['total']?>, 
		<? } ?>
	<? } ?>
	],
	chart: {
		width: 380,
		type: 'donut',
	},
	labels: [
	<?
	$contTicket = 0;
	for ($row = 0; $row < count($rData); $row++) {
		$contTicket++;
		if($contTicket<=5) {
			$rSql = $rData[$row];
	?>
		'<?=$rSql['evento_nome']?> - <?=$rSql['ingresso_nome']?>', 
		<? } ?>
	<? } ?>
	],
	responsive: [{
		breakpoint: 480,
		options: {
			chart: {
				width: 200
			},
			legend: {
				position: 'bottom'
			}
		}
	}],
	colors: [primary, success, warning, danger, info]
};

var chart_setores_mais_vendidos = new ApexCharts(document.querySelector(apexChart_setores_mais_vendidos), options);
chart_setores_mais_vendidos.render();

const apexChart_progressao_de_vendas = "#chart_progressao_de_vendas";
var options = {
	series: [{
		name: 'Bruto',
		data: [
			<? for ($i = 6; $i >= 0; $i--) { ?>
            <?
			$dataFiltro = date('Y-m-d',(strtotime ( '-'.$i.' day' , strtotime ($data) ) ));
			#PARCELAS QTD
			$strSql = "
				SELECT 
					SUM(".$campoValorSet.") AS valor
				FROM 
					carrinho_notificacao AS mod_carrinho 
				
				WHERE 
					mod_carrinho.stat='1' AND
					mod_carrinho.forma_de_pagamento NOT IN ('COR') AND
					mod_carrinho.data BETWEEN '".$dataFiltro." 00:00:00' AND '".$dataFiltro." 23:59:59'
					".$filtroEmpresaEventoSet."
					".$filtro_carrinhoSet."
					".$filtroEvento."
					".$filtroEventoData."
			";
			$rSqlVendasData = mysql_fetch_array(mysql_query("".$strSql.""));
			if(trim($rSqlVendasData['valor'])=="" || trim($rSqlVendasData['valor'])=="0") {
				$rSqlVendasData['valor'] = 0;
			}
			?>
			<?=$rSqlVendasData['valor']?>,
			<? } ?>
		]
	}],
	chart: {
		type: 'bar',
		height: 350
	},
	plotOptions: {
		bar: {
			horizontal: false,
			columnWidth: '55%',
			endingShape: 'rounded'
		},
	},
	dataLabels: {
		enabled: false
	},
	stroke: {
		show: true,
		width: 2,
		colors: ['transparent']
	},
	xaxis: {
		categories: [
					 <? for ($i = 6; $i >= 0; $i--) { ?>
					 '<?=date('d/m',(strtotime ( '-'.$i.' day' , strtotime ($data) ) ));?>', 
					 <? } ?>
					 ],
	},
	yaxis: {
		title: {
			text: 'R$ (milhar)'
		}
	},
	fill: {
		opacity: 1
	},
	tooltip: {
		y: {
			formatter: function (val) {
				return "R$ " + val + ""
			}
		}
	},
	colors: [primary, success, warning]
};

var chart_progressao_de_vendas = new ApexCharts(document.querySelector(apexChart_progressao_de_vendas), options);
chart_progressao_de_vendas.render();

const apexChart_parcelas_cartao = "#chart_parcelas_cartao";
var options = {
	series: [{
		name: 'Bruto',
		data: [
		<? for ($i = 1; $i <= 12; $i++) { ?>
            <?
			#PARCELAS QTD
			$strSql = "
				SELECT 
					COUNT(*)
				FROM 
					carrinho_notificacao AS mod_carrinho 
				
				WHERE 
					mod_carrinho.stat='1' AND
					mod_carrinho.forma_de_pagamento='CCR' AND
					mod_carrinho.qtd_parcelas='".$i."'
					".$filtroEmpresaEventoSet."
					".$filtro_carrinhoSet."
					".$filtroEvento."
					".$filtroEventoData."
			";
			$nSqlParcelas = mysql_fetch_row(mysql_query("".$strSql.""));
			?>
		<?=$nSqlParcelas[0]?>,
		<? } ?> 
		]
	}],
	chart: {
		type: 'bar',
		height: 350
	},
	plotOptions: {
		bar: {
			horizontal: false,
			columnWidth: '55%',
			endingShape: 'rounded'
		},
	},
	dataLabels: {
		enabled: false
	},
	stroke: {
		show: true,
		width: 2,
		colors: ['transparent']
	},
	xaxis: {
		categories: [
		<? for ($i = 1; $i <= 12; $i++) { ?>
		'<?=$i?>x',
		<? } ?> 
		],
	},
	yaxis: {
		title: {
			text: 'Quantidade'
		}
	},
	fill: {
		opacity: 1
	},
	tooltip: {
		y: {
			formatter: function (val) {
				return "" + val + ""
			}
		}
	},
	colors: [primary, success, warning]
};

var chart_parcelas_cartao = new ApexCharts(document.querySelector(apexChart_parcelas_cartao), options);
chart_parcelas_cartao.render();

const apexChart_volume_por_dia_da_semana = "#chart_volume_por_dia_da_semana";
var options = {
	series: [{
		name: 'SEMANA',
		data: [0, 0, 0, 0, 0, 0, 0]
	}],
	chart: {
		height: 350,
		type: 'area'
	},
	dataLabels: {
		enabled: false
	},
	stroke: {
		curve: 'smooth'
	},
	xaxis: {
		categories: ["SEG", "TER", "QUA", "QUI", "SEX", "SAB", "DOM"]
	},
	tooltip: {
		x: {
			format: 'dd/MM/yy HH:mm'
		},
	},
	colors: [primary, success]
};

var chart_volume_por_dia_da_semana = new ApexCharts(document.querySelector(apexChart_volume_por_dia_da_semana), options);
chart_volume_por_dia_da_semana.render();
</script>