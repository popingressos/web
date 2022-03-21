<?
$ScriptsDashboard = "ON";
if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
	$filtro_empresa['vendas'] = "";
	$filtro_empresa['contas_a_receber'] = "";
	$filtro_empresa['contas_a_pagar'] = "";
} else {
	$filtro_empresa['vendas'] = " AND empresa='".$sysusu['empresa']."'";
	$filtro_empresa['contas_a_receber'] = " AND empresa='".$sysusu['empresa']."'";
	$filtro_empresa['contas_a_pagar'] = " AND vendas.empresa='".$sysusu['empresa']."'";
}

$data = date('D');
$dia = date('d');
if(trim($_SESSION["mes_dashboard"])=="") {
	$mes = date("m");
} else {
	$mes = $_SESSION["mes_dashboard"];
}
$ano = date('Y');

$semana = array(
	'Sun' => 'Domingo', 
	'Mon' => 'Segunda-Feira',
	'Tue' => 'Terca-Feira',
	'Wed' => 'Quarta-Feira',
	'Thu' => 'Quinta-Feira',
	'Fri' => 'Sexta-Feira',
	'Sat' => 'Sábado'
);

$mes_extenso = array(
	'01' => 'Janeiro',
	'02' => 'Fevereiro',
	'03' => 'Março',
	'04' => 'Abril',
	'05' => 'Maio',
	'06' => 'Junho',
	'07' => 'Julho',
	'08' => 'Agosto',
	'09' => 'Setembro',
	'10' => 'Outubro',
	'11' => 'Novembro',
	'12' => 'Dezembro'
);					

$rSqlVendaTudo = mysql_fetch_array(mysql_query("SELECT SUM(valor) AS valor FROM vendas WHERE pago='1' ".$filtro_empresa['vendas'].""));
$rSqlContasAReceberTudo = mysql_fetch_array(mysql_query("SELECT SUM(valor) AS valor FROM contas_a_receber WHERE pago='1' ".$filtro_empresa['contas_a_receber'].""));
$rSqlContasAPagarTudo = mysql_fetch_array(mysql_query("SELECT SUM(valor) AS valor FROM contas_a_pagar WHERE pago='1' ".$filtro_empresa['contas_a_pagar'].""));


$rSqlVenda = mysql_fetch_array(mysql_query("SELECT SUM(valor) AS valor FROM vendas WHERE pago='1' AND data_contratacao BETWEEN '".date("Y")."-".$mes."-01' AND '".date("Y")."-".$mes."-31' ".$filtro_empresa['vendas'].""));
$rSqlContasAReceber = mysql_fetch_array(mysql_query("SELECT SUM(valor) AS valor FROM contas_a_receber WHERE pago='1' AND pagamento BETWEEN '".date("Y")."-".$mes."-01' AND '".date("Y")."-".$mes."-31' ".$filtro_empresa['contas_a_receber'].""));

$rSqlContasAPagar = mysql_fetch_array(mysql_query("SELECT SUM(valor) AS valor FROM contas_a_pagar WHERE pago='1' AND pagamento BETWEEN '".date("Y")."-".$mes."-01' AND '".date("Y")."-".$mes."-31' ".$filtro_empresa['contas_a_pagar'].""));

$CreditoMes = $rSqlVenda['valor'] + $rSqlContasAReceber['valor'];
$DebitoMes = $rSqlContasAPagar['valor'];
$BalancoMes = $CreditoMes - $DebitoMes;
if($BalancoMes>=0) {
	$CorBalancoMes = "#10a9e9";
} else {
	$CorBalancoMes = "#e9101f";
}

$CreditoTudo = $rSqlVendaTudo['valor'] + $rSqlContasAReceberTudo['valor'];
$DebitoTudo = $rSqlContasAPagarTudo['valor'];
$BalancoTudo = $CreditoTudo - $DebitoTudo;
if($BalancoTudo>=0) {
	$CorBalancoTudo = "#10a9e9";
} else {
	$CorBalancoTudo = "#e9101f";
}

$_SESSION['sysusu_numeroUnico'] = $sysusu['numeroUnico'];
$tokenPath = "".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-token/".$_SESSION['sysusu_numeroUnico']."/token.json";
if(trim($_REQUEST['chave'])=="conecta-google" || trim($_GET['code'])!="" || file_exists($tokenPath)) {
	#include("".$_SERVER['DOCUMENT_ROOT']."/admin/webservice-admin/google-calendar.php");
}

?>

<div class="col-md-12" style="padding:0px;margin-top:10px;">

    <div class="col-md-12">

		<style>
		.portlet.calendar .fc-event .fc-title {
			text-align: left;
			float: left;
			color: #fff;
			font-family: 'Open Sans', sans-serif !important;
			font-size:11px !important;
			font-weight: 300;
		}

		.portlet.calendar.light .fc-button {
			top: -70px;
			color: #666;
			text-transform: uppercase;
			font-size: 12px;
			padding-bottom: 35px;
		}

		.evento_aberto {
			background-color:#4B8DF8 !important;
		}
		.evento_aguardando {
			background-color:#F7CA18 !important;
		}
		.evento_executando {
			background-color:#9A12B3 !important;
		}
		.evento_finalizado {
			background-color:#1BA39C !important;
		}
		.evento_cancelado {
			background-color:#D91E18 !important;
		}

		.mt-actions .mt-action .mt-action-body .mt-action-row .mt-action-buttons {
			width: 50px !important;
		}
		.mt-actions .mt-action .mt-action-body .mt-action-row .mt-action-datetime {
			width: 100px !important;
		}
		.mt-actions .mt-action .mt-action-body .mt-action-row .mt-action-datetime-com-hora {
			vertical-align: top;
			display: table-cell;
			text-align: center;
			width: 130px !important;
			white-space: nowrap;
			padding-top: 15px;
			color: #a6a8a8;
		}
		.mt-action-info-carrinho {
			vertical-align: top;
			display: table-cell;
			text-align: center;
			width: 200px !important;
			white-space: nowrap;
			padding-top: 15px;
			color: #a6a8a8;
		}
        .fc-day.fc-mon, .fc-day.fc-tue, .fc-day.fc-wed, .fc-day.fc-thu, .fc-day.fc-fri {
            background-color:#89C4F4 !important;
        }
        .fc-day.fc-mon:hover, .fc-day.fc-tue:hover, .fc-day.fc-wed:hover, .fc-day.fc-thu:hover, .fc-day.fc-fri:hover {
            background-color:#F8CB00 !important;
        }
        .fc-ltr .fc-basic-view .fc-day-number {
            background-color:#FFF !important;
            opacity:1;
        }
        .orientacoes_treino p {
            margin-top:0px !important;
            margin-bottom:0px !important;
        }
        .fc-time {
            display:none !important;
        }
        
        .box_debito, .box_credito, .box_balanco, .box_balanco_tudo, .box_verde, .box_verde_claro, .box_azul_claro, .box_laranja, .box_vermelho_claro, .box_lilas {
            background-color:#ffffff;
            padding:10px;
            border-radius:5px !important;
            cursor:pointer;
        }
        .box_icon {
            width:40px;
			height:40px;
			border-radius:40px !important;
			font-size:20px;
			padding:8px;
			padding-top:9px;
        }

        .box_back_debito {
			color:#961f11;
            background-color: #f36a5a;
        }
        .box_back_credito {
			color:#185d97;
            background-color: #5C9BD1;
        }
        .box_back_verde {
			color:#136632;
            background-color: #12ba51;
        }
        .box_back_verde_claro {
			color:#55755f;
            background-color: #aaeabe;
        }
        .box_back_azul_claro {
			color:#448a9f;
            background-color: #66ebf0;
        }
        .box_back_laranja {
			color:#55755f;
            background-color: #ffa53a;
        }
        .box_back_vermelho_claro {
			color:#966277;
            background-color: #f3939b;
        }
        .box_back_lilas {
			color:#68147a;
            background-color: #c21ce6;
        }
        .box_back_balanco {
			color:#55755f;
            background-color: <?=$CorBalancoMes?>;
        }
        .box_back_balanco_tudo {
			color:#55755f;
            background-color: <?=$CorBalancoTudo?>;
        }

        .box_debito {
            color: #f36a5a;
        }
        .box_credito {
            color: #5C9BD1;
        }
        .box_verde {
            color: #12ba51;
        }
        .box_verde_claro {
            color: #aaeabe;
        }
        .box_azul_claro {
            color: #4ea8b8;
        }
        .box_laranja {
            color: #ffa53a;
        }
        .box_vermelho_claro {
            color: #f3939b;
        }
        .box_lilas {
            color: #c21ce6;
        }
        .box_balanco {
            color: <?=$CorBalancoMes?>;
        }
        .box_balanco_tudo {
            color: <?=$CorBalancoTudo?>;
        }
        .box_debito:hover, .box_credito:hover, .box_balanco:hover, .box_balanco_tudo:hover, .box_verde:hover, .box_lilas:hover {
            background-color:#33d8b7;
            padding:10px;
            border-radius:5px !important;
            color: #ffffff;
            cursor:pointer;
        }
		.mes_atual {
			float:right;
			width:auto !important;
		}
		
		.col-md-left {
			padding:5px;
			padding-right:18px;
			padding-left:0px;
		}
		.col-md-center {
			padding:5px;
			padding-left:8px;
			padding-right:8px;
		}
		.col-md-right {
			padding:5px;
			padding-left:18px;
			padding-right:0px;
		}
		@media (max-width: 650px) {
			.mt-actions .mt-action .mt-action-body .mt-action-row .mt-action-buttons {
				width: 80px !important;
			}
			.mt-action-info-carrinho {
				text-align: left !important;
			}
			.mt-actions .mt-action .mt-action-body .mt-action-row .mt-action-datetime-com-hora {
				text-align: left !important;
			}
			.mt-actions .mt-action .mt-action-body .mt-action-row .mt-action-datetime {
				width: 200px !important;
				text-align: left !important;
				margin-left: 0px !important;
			}

			.mes_atual_div {
				margin-bottom: 35px;
			}
			.mes_atual {
				width:100% !important;
			}

			.col-md-left {
				padding:5px;
				padding-right:0px;
				padding-left:0px;
			}
			.col-md-center {
				padding:5px;
				padding-left:0px;
				padding-right:0px;
			}
			.col-md-right {
				padding:5px;
				padding-left:0px;
				padding-right:0px;
			}
		}
        </style>

        <div class="row" style="padding-left:0px;padding-right:0px;">
			<? if($_construtor_sysperm['admin_dashboard']=="1") { ?>
            <div class="col-md-12" style="margin-top: -22px;margin-bottom: 10px;">
                <a class="btn btn-primary" href="<?=$link?><?=geraCodReturn()?>/sistema/configurar-meu-dashboard/"><i class="fa fa-cogs"></i> Configurar Meu Dashboard</a>

                <a class="btn btn-light" href="<?=$link?>conecta-google/" style="padding: 8px 10px 3px 10px;background-color:#FFF;" title="Conecte sua agenda do Google">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 48 48" class="abcRioButtonSvg">
						<g>
							<path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
							<path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
							<path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
							<path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
							<path fill="none" d="M0 0h48v48H0z"></path>
						</g>
                    </svg>
                </a>
            </div>
            <? } ?>

			<?
            if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
                $sysusu_empresaSet = "".$sysusu['empresa']."";
                $plataforma_exibir_selectSet = 1;
				#echo "1";
            } else {
                if(trim($rSqlEmpresa['plataforma'])=="" || trim($rSqlEmpresa['plataforma'])=="0") {
					if(trim($rSqlEmpresa['tipo_empresa'])=="centralizador_de_empresas" || trim($rSqlEmpresa['tipo_empresa'])=="centralizador_de_empresas") {
						#echo "2";
						$sysusu_empresaSet = "0";
						$plataforma_exibir_selectSet = 0;
						$filtro_empresaSet = " AND mod_empresa.plataforma='".$sysusu['empresa']."' ";
					} else {
						#echo "3";
						$sysusu_empresaSet = "".$sysusu['empresa']."";
						$plataforma_exibir_selectSet = 0;
					}
				} else {
					$rSqlPlataforma = mysql_fetch_array(mysql_query("SELECT plataforma FROM empresa WHERE id='".$sysusu['empresa']."'"));
					if(trim($rSqlPlataforma['plataforma'])=="" || trim($rSqlPlataforma['plataforma'])=="0") {
						#echo "4";
						$sysusu_empresaSet = "0";
						$plataforma_exibir_selectSet = 0;
						$filtro_empresaSet = " AND mod_empresa.plataforma='".$sysusu['empresa']."' ";
					} else { 
						#echo "5";
						$sysusu_empresaSet = "".$sysusu['empresa']."";
						$plataforma_exibir_selectSet = 0;
					}
				}
            }
            ?>

			<? if(trim($sysusu_empresaSet)=="" || trim($sysusu_empresaSet)=="0") {?> 
            <?
			if(trim($_SESSION["_plataformaS_home"])=="") {
				if(trim($rSqlEmpresa['tipo_empresa'])=="centralizador_de_empresas" || trim($rSqlEmpresa['tipo_empresa'])=="centralizador_de_empresas") {
					$plataformaHomeSet = "".$sysusu['empresa']."";
					$filtro_empresaSet = " AND mod_empresa.plataforma='".$sysusu['empresa']."' ";
				} else {
					$plataformaHomeSet = "";
					$filtro_empresaSet = " ";
				}
			} else {
				$plataformaHomeSet = "".$_SESSION["_plataformaS_home"]."";
				$filtro_empresaSet = " AND mod_empresa.plataforma='".$_SESSION["_plataformaS_home"]."' ";
			}

			if(trim($_SESSION["_empresaS_home"])=="") {
				$empresaHomeSet = "";
				$filtro_eventosSet = " ";
				$filtro_carrinhoSet = " ";
			} else {
				$empresaHomeSet = "".$_SESSION["_empresaS_home"]."";
				if(trim($_SESSION["_plataformaS_home"])=="") {
					if(trim($_SESSION["_empresaS_home"])=="") {
						$filtro_eventosSet = " ";
						$filtro_carrinhoSet = " AND mod_carrinho.empresa='".$_SESSION["_empresaS_home"]."' ";
					} else {
						$filtro_eventosSet = " AND mod_eventos.empresa='".$_SESSION["_empresaS_home"]."' ";
						$filtro_carrinhoSet = " AND mod_carrinho.empresa='".$_SESSION["_empresaS_home"]."' ";
					}
				} else {
					if(trim($_SESSION["_empresaS_home"])=="") {
						$filtro_eventosSet = " AND mod_eventos.plataforma='".$_SESSION["_plataformaS_home"]."' ";
						$filtro_carrinhoSet = " AND mod_carrinho.plataforma='".$_SESSION["_empresaS_home"]."' ";
					} else {
						$filtro_eventosSet = " AND mod_eventos.empresa='".$_SESSION["_empresaS_home"]."' ";
						$filtro_carrinhoSet = " AND mod_carrinho.empresa='".$_SESSION["_empresaS_home"]."' ";
					}
				}
			}
			
			?>
            
            <? if($plataforma_exibir_selectSet==1) { ?>
            <div class="col-md-12" style="margin-bottom: 10px;">
                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;padding-right:0px;">Plataforma</label>
                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                    <select name="plataforma" id="plataforma" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:filtrar_plataforma_dashboard();">
                        <option value="">---</option>
                        <?
                        $qSqlItem = mysql_query("
                                                SELECT 
                                                    mod_empresa.id,
                                                    mod_empresa.nome
                                                     
                                                FROM 
                                                    empresa AS mod_empresa 
                                                WHERE
                                                    (mod_empresa.stat='0' OR mod_empresa.stat='1') AND
													mod_empresa.tipo_empresa='centralizador_de_empresas'
                                                ORDER BY 
                                                    mod_empresa.nome");
                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                        ?>
                        <option value="<?= $rSqlItem['id'] ?>" <? if(trim($plataformaHomeSet)==trim($rSqlItem['id'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                        <? } ?>
                    </select>
                </div>
            </div>
            <? } ?>

            <div class="col-md-12" style="margin-bottom: 10px;">
                <label class="control-label col-md-12" style="text-align:left;padding-left:0px;padding-right:0px;">Empresa</label>
                <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                    <select name="empresa" id="empresa" class="form-control bs-select" data-live-search="true" data-show-subtext="true" onchange="javascript:filtrar_empresa_dashboard();">
                        <option value="">---</option>
                        <?
                        $qSqlItem = mysql_query("
                                                SELECT 
                                                    mod_empresa.id,
                                                    mod_empresa.nome
                                                     
                                                FROM 
                                                    empresa AS mod_empresa 
                                                WHERE
                                                    (mod_empresa.stat='0' OR mod_empresa.stat='1') ".$filtro_empresaSet." 
                                                ORDER BY 
                                                    mod_empresa.nome");
                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                        ?>
                        <option value="<?= $rSqlItem['id'] ?>" <? if(trim($empresaHomeSet)==trim($rSqlItem['id'])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                        <? } ?>
                    </select>
                </div>
            </div>
            <? 
			} else {
				$empresaHomeSet = "".$sysusu['empresa']."";
				$filtro_eventosSet = " AND mod_eventos.empresa='".$sysusu['empresa']."' ";
				$filtro_carrinhoSet = " AND mod_carrinho.empresa='".$sysusu['empresa']."' ";
			}
			?>

			<?
			if(trim($plataformaHomeSet)=="") { 
				if(trim($empresaHomeSet)=="") { 
					$dashBoardExibir = 0;
				} else {
					$dashBoardExibir = 1;
				}
			} else {
				if(trim($empresaHomeSet)=="") { 
					$dashBoardExibir = 1;
				} else {
					$dashBoardExibir = 1;
				}
			}
			$dashBoardHabilitado = 1;
			if($dashBoardHabilitado==0) { } else {
				if($dashBoardExibir==0) { } else {
					$rSqlEmpresaHome = mysql_fetch_array(mysql_query("SELECT nome,latitude,longitude FROM empresa WHERE id='".$empresaHomeSet."'"));
	
					$nSqlInicial = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM sysdashboard WHERE idsysusu='".$sysusu['id']."' AND stat='1'"));
					if($nSqlInicial[0]==0 && $_construtor_sysperm['visualizar_dashboard']=="1") {
						$tamanho_do_blocoSet = "col-md-12";
						$scripts_vacinados_por_faixa_etariaSet = "SIM";
						$scripts_vacinados_por_mapaSet = "SIM";
						$scripts_vacinador_por_mapaSet = "SIM";
						$rSqlInicial['numeroUnico'] = "0";
						#include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/sysdashboard_resumo_notificacao_por_evento.php");
						$rSqlInicial['numeroUnico'] = "1";
						#include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/sysdashboard_vacinados_por_faixa_etaria_tabela.php");
						$rSqlInicial['numeroUnico'] = "2";
						#include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/sysdashboard_vacinados_por_faixa_etaria.php");
						$rSqlInicial['numeroUnico'] = "3";
						#include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/sysdashboard_vacinados_por_mapa.php");
						$rSqlInicial['numeroUnico'] = "4";
						#include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/sysdashboard_vacinador_por_mapa.php");
						$rSqlInicial['numeroUnico'] = "5";
						#include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/sysdashboard_vacinados_por_idade_tabela.php");
						$rSqlInicial['numeroUnico'] = "6";
						#include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/sysdashboard_cadastros_por_faixa_etaria_tabela.php");
						$rSqlInicial['numeroUnico'] = "7";
						#include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/sysdashboard_cadastros_por_idade_tabela.php");
						$rSqlInicial['numeroUnico'] = "8";
						#include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/sysdashboard_cadastrados_por_mapa.php");
						$rSqlInicial['numeroUnico'] = "9";
						#include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/sysdashboard_vacinados_por_mapa_de_calor.php");
					} else {
						$strSqlInicial = "
							SELECT 
								mod_sysdashboard.numeroUnico,
								mod_sysdashboard.nome,
								mod_sysdashboard.subtitulo,
								mod_sysdashboard.tamanho_do_bloco,
								mod_sysdashboard.modulo_do_bloco,
								mod_sysdashboard.qtd,
								mod_sysdashboard.ordenacao
							FROM 
								sysdashboard AS mod_sysdashboard 
							
							WHERE
								mod_sysdashboard.stat='1' AND
								mod_sysdashboard.idsysusu='".$sysusu['id']."'
			
							ORDER BY
								mod_sysdashboard.ordem ASC
						";
						$scripts_vacinados_por_periodoSet = "NAO";
						$scripts_vacinados_por_grupoSet = "NAO";
						$scripts_vacinados_por_faixa_etariaSet = "NAO";
						$scripts_vacinados_por_mapaSet = "NAO";
						$qSqlInicial = mysql_query("".$strSqlInicial."");
						while($rSqlInicial = mysql_fetch_array($qSqlInicial)) {
							if(trim($rSqlInicial['modulo_do_bloco'])=="blog") {
								$campoDataSet = "data_da_postagem";
							} else {
								$campoDataSet = "data";
							}
							
							$orderInicialSet = "";
							if(trim($rSqlInicial['ordenacao'])=="randomica") {
								$orderInicialSet = " ORDER BY RAND() ";
							} else if(trim($rSqlInicial['ordenacao'])=="alfabetica_asc") {
								$orderInicialSet = " ORDER BY mod_".$rSqlInicial['modulo_do_bloco'].".nome ASC ";
							} else if(trim($rSqlInicial['ordenacao'])=="alfabetica_desc") {
								$orderInicialSet = " ORDER BY mod_".$rSqlInicial['modulo_do_bloco'].".nome DESC ";
							} else if(trim($rSqlInicial['ordenacao'])=="data_asc") {
								$orderInicialSet = " ORDER BY mod_".$rSqlInicial['modulo_do_bloco'].".".$campoDataSet." ASC ";
							} else if(trim($rSqlInicial['ordenacao'])=="data_desc") {
								$orderInicialSet = " ORDER BY mod_".$rSqlInicial['modulo_do_bloco'].".".$campoDataSet." DESC ";
							} else if(trim($rSqlInicial['ordenacao'])=="ordem_asc") {
								$orderInicialSet = " ORDER BY mod_".$rSqlInicial['modulo_do_bloco'].".ordem ASC ";
							} else if(trim($rSqlInicial['ordenacao'])=="ordem_desc") {
								$orderInicialSet = " ORDER BY mod_".$rSqlInicial['modulo_do_bloco'].".data DESC ";
							}
							
							if(trim($rSqlInicial['qtd'])=="" || trim($rSqlInicial['qtd'])=="0") {
								$limitInicialSet = "LIMIT 3";
							} else {
								$limitInicialSet = "LIMIT ".$rSqlInicial['qtd']."";
							}
			
							if(trim($rSqlInicial['tamanho_do_bloco'])=="") {
								$tamanho_do_blocoSet = "col-md-12";
							} else {
								$tamanho_do_blocoSet = "".$rSqlInicial['tamanho_do_bloco']."";
							}
			
							if(trim($rSqlInicial['modulo_do_bloco'])=="resumo_financeiro_mes_atual") { $moduloBlocoSet = "carrinho"; } else 
							if(trim($rSqlInicial['modulo_do_bloco'])=="resumo_financeiro_total") { $moduloBlocoSet = "carrinho"; } else 
							if(trim($rSqlInicial['modulo_do_bloco'])=="agenda_de_treinos") { $moduloBlocoSet = "agenda_de_treinos"; } else 
							if(trim($rSqlInicial['modulo_do_bloco'])=="treinos_expirando") { $moduloBlocoSet = "treinos"; } else 
							if(trim($rSqlInicial['modulo_do_bloco'])=="agenda_unificada") { $moduloBlocoSet = "agenda_unificada"; } else 
							if(trim($rSqlInicial['modulo_do_bloco'])=="acompanhamento_de_carrinho_de_compras") { $moduloBlocoSet = "carrinho"; } else 
							if(trim($rSqlInicial['modulo_do_bloco'])=="acompanhamento_de_vendas_comercial") { $moduloBlocoSet = "vendas"; } else 
							if(trim($rSqlInicial['modulo_do_bloco'])=="acompanhamento_de_compras_comercial") { $moduloBlocoSet = "compras"; } else 
							if(trim($rSqlInicial['modulo_do_bloco'])=="acompanhamento_de_contas_a_pagar") { $moduloBlocoSet = "tipos_de_pagamento"; } else 
							if(trim($rSqlInicial['modulo_do_bloco'])=="acompanhamento_de_contas_a_receber") { $moduloBlocoSet = "tipos_de_cobranca"; } else 
							if(trim($rSqlInicial['modulo_do_bloco'])=="agenda_de_eventos") { $moduloBlocoSet = "eventos"; } else 
							if(trim($rSqlInicial['modulo_do_bloco'])=="acompanhamento_de_vendas_de_evento") { $moduloBlocoSet = "carrinho"; $scripts_acompanhamento_de_vendas_de_eventoSet = "SIM"; } else 
							if(trim($rSqlInicial['modulo_do_bloco'])=="agenda_de_recursos") { $moduloBlocoSet = "agenda_de_recursos"; } else 
							if(trim($rSqlInicial['modulo_do_bloco'])=="acompanhamento_de_pessoas") { $moduloBlocoSet = "pessoas"; } else 
							if(trim($rSqlInicial['modulo_do_bloco'])=="acompanhamento_de_solicitacoes") { $moduloBlocoSet = "solicitacao"; }
			
							if(trim($rSqlInicial['modulo_do_bloco'])=="vacinados_por_periodo") { $scripts_vacinados_por_periodoSet = "SIM"; }
							if(trim($rSqlInicial['modulo_do_bloco'])=="vacinados_por_grupo") { $scripts_vacinados_por_grupoSet = "SIM"; }
							if(trim($rSqlInicial['modulo_do_bloco'])=="vacinados_por_faixa_etaria") { $scripts_vacinados_por_faixa_etariaSet = "SIM"; }
							if(trim($rSqlInicial['modulo_do_bloco'])=="vacinados_por_mapa") { $scripts_vacinados_por_mapaSet = "SIM"; }
							if(trim($rSqlInicial['modulo_do_bloco'])=="vacinados_por_mapa") { $scripts_vacinados_por_mapaSet = "SIM"; }
							if(trim($rSqlInicial['modulo_do_bloco'])=="vacinador_por_mapa_de_calor") { $scripts_vacinador_por_mapa_de_calorSet = "SIM"; }
							if(trim($rSqlInicial['modulo_do_bloco'])=="cadastrados_por_mapa") { $scripts_cadastrados_por_mapaSet = "SIM"; }
			
							if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
								$filtro_empresa[''.$moduloBlocoSet.''] = "";
							} else {
								$filtro_empresa[''.$moduloBlocoSet.''] = " AND mod_".$moduloBlocoSet.".empresa='".$empresaHomeSet."'";
							}
			
							include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/sysdashboard_".$rSqlInicial['modulo_do_bloco'].".php");
						}
					}
				}
			}
            ?>
            

        </div>

    </div>
</div>

