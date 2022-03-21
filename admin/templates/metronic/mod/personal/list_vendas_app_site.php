<?
$mod = "eventos";
$where = " WHERE mod_eventos.data BETWEEN '0000-00-00 00:00:00' AND '9999-12-31 23:59:59'";

$_SESSION["".$chave_set."_".$mod."modulo_atualS"] = $mod;


if(trim($_SESSION["_empresaS_".$mod.""])=="") {
	if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
		$where = " ".$where." ";
		$where_profissional = "";
	} else {
		$where = " ".$where." AND mod_eventos.empresa='".$sysusu['empresa']."' ";
	}
} else {
	$where = " ".$where." AND mod_eventos.empresa='".$_SESSION["_empresaS_".$mod.""]."' ";
}

if(trim($_SESSION["_filtroStatS_".$mod.""])=="1") {
	$where = " ".$where." AND mod_eventos.stat='1'"; 
} elseif(trim($_SESSION["_filtroStatS_".$mod.""])=="0") { 
	$where = " ".$where." AND mod_eventos.stat='0'"; 
} elseif(trim($_SESSION["_filtroStatS_".$mod.""])=="2") { 
	$where = " ".$where." AND mod_eventos.stat='2'"; 
} elseif(trim($_SESSION["_filtroStatS_".$mod.""])=="3") { 
	$where = " ".$where." AND mod_eventos.stat='3'"; 
} elseif(trim($_SESSION["_filtroStatS_".$mod.""])=="4") { 
	$where = " ".$where." AND mod_eventos.stat='4'"; 
} elseif(trim($_SESSION["_filtroStatS_".$mod.""])=="5") { 
	$where = " ".$where." AND mod_eventos.stat='5'"; 
} elseif(trim($_SESSION["_filtroStatS_".$mod.""])=="6") { 
	$where = " ".$where." AND mod_eventos.stat='6'"; 
} elseif(trim($_SESSION["_filtroStatS_".$mod.""])=="") { 
	$where = " ".$where." AND mod_eventos.stat='1'"; 
}

if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
	$tamanho_coluna = "col-md-2-5";
} else {
	$tamanho_coluna = "col-md-3";
}
?>

<div class="col-md-12" style="margin-bottom:10px;margin-top: 10px;">
    <div class="col-md-12" style="background-color:#FFF;padding-left:5px;padding-top:5px;padding-right:5px;">
		<? if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { ?> 
        <div class="<?=$tamanho_coluna?>" style="padding:5px;">
            <label class="control-label col-md-12" style="padding:0px;">Empresa</label>
            <div class="col-md-12" style="padding:0px;">
                <select class="form-control" id="empresa" style="margin-right:10px;">
                    <option value="">TODAS AS EMPRESAS</option>
                    <?
                    $qSqlItem = mysql_query("
                                            SELECT 
                                                mod_empresa.id,
                                                mod_empresa.nome,
                                                mod_matriz.nome AS empresa_nome
                                                 
                                            FROM 
                                                empresa AS mod_empresa 
                                            LEFT JOIN 
                                                empresa AS mod_matriz ON (mod_matriz.id = mod_empresa.empresa)
                                            WHERE
                                                (mod_empresa.stat='0' OR mod_empresa.stat='1') 
                                            ORDER BY 
                                                mod_empresa.nome");
                    while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                        if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
                            if(trim($rSqlItem['empresa_nome'])=="") {
                                $rSqlItem['empresa_nome'] = "Sem empresa setada - ";
                            } else {
                                $rSqlItem['empresa_nome'] = "".$rSqlItem['empresa_nome']." - ";
                            }
                        } else {
                            $rSqlItem['empresa_nome'] = "";
                        }
                    ?>
                    <option value="<?= $rSqlItem['id'] ?>" <? if(trim($_SESSION["_empresaS_".$mod.""])=="".$rSqlItem['id']."") { echo " selected"; } ?>><?=$rSqlItem['empresa_nome']?><?=$rSqlItem['nome']?></option>
                    <? } ?>
                </select>
            </div>
        </div>
        <? } else { $empresa_set="".$sysusu['empresa'].""; ?>
        <input type="hidden" name="empresa" id="empresa" value="<?=$sysusu['empresa']?>" />
        <? } ?>

		<?
        if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
            $txtSelectEventoSet = "Selecione uma empresa e um status";
        } else {
            $txtSelectEventoSet = "Selecione um status";
        }
        ?>
        <div class="<?=$tamanho_coluna?>" style="padding:5px;">
            <label class="control-label col-md-12" style="padding:0px;">Status do Evento</label>
            <div class="col-md-12" style="padding:0px;">
                <select name="stat" onchange="javascript:filtrar_empresa_eventos_single('<?=$txtSelectEventoSet?>');" style="margin-right:10px;" id="stat" class="form-control">
                    <option value="0" <? if(trim($_SESSION["_filtroStatS_".$mod.""])=="" || trim($_SESSION["_filtroStatS_".$mod.""])=="0") { echo " selected"; } ?>>Despublicado</option>
                    <option value="1" <? if(trim($_SESSION["_filtroStatS_".$mod.""])=="1") { echo " selected"; } ?>>Publicado</option>
                    <option value="2" <? if(trim($_SESSION["_filtroStatS_".$mod.""])=="2") { echo " selected"; } ?>>Em produção</option>
                    <? if(trim($row['stat'])=="3" || trim($row['stat'])=="4") { ?>
                    <option value="3" <? if(trim($_SESSION["_filtroStatS_".$mod.""])=="3") { echo " selected"; } ?>>Encerrado Automáticamente</option>
                    <option value="4" <? if(trim($_SESSION["_filtroStatS_".$mod.""])=="4") { echo " selected"; } ?>>Encerrado Manualmente</option>
                    <? } ?>
                    <? if(strrpos($_construtor_sysperm['modulo_eventos'],"|info_clinica|") === false) { ?>
                    <option value="5" <? if(trim($_SESSION["_filtroStatS_".$mod.""])=="5") { echo " selected"; } ?>>Eventos de PRIMEIRA dose</option>
                    <option value="6" <? if(trim($_SESSION["_filtroStatS_".$mod.""])=="6") { echo " selected"; } ?>>Eventos de SEGUNDA dose</option>
                    <? } ?>
                </select>
            </div>
        </div>

		<?
        $numeroUnico_eventoSet = "";
        $ticketsSet = "";
        $lotesSet = "";
        ?>
        <div class="<?=$tamanho_coluna?>" style="padding:5px;">
            <label class="control-label col-md-12" style="padding:0px;">Evento</label>
            <div class="col-md-12" style="padding:0px;">
                <select class="form-control" id="numeroUnico_evento" style="margin-right:10px;">
                    <? if(trim($_SESSION["_numeroUnico_eventoS_".$mod.""])=="") { ?>
                    <option value=""><?=$txtSelectEventoSet?></option>
                    <? } else { ?>tickets
                        <?
                        $qSqlItem = mysql_query("
                                                SELECT 
                                                    mod_eventos.numeroUnico,
                                                    mod_eventos.nome,
                                                    mod_eventos.tickets,
                                                    mod_eventos.lotes
                                                     
                                                FROM 
                                                    eventos AS mod_eventos 
                                                WHERE
                                                    mod_eventos.stat='".$_SESSION["_filtroStatS_".$mod.""]."' AND
                                                    mod_eventos.empresa='".$_SESSION["_empresaS_".$mod.""]."' 
                                                ORDER BY 
                                                    mod_eventos.nome");
                        while($rSqlItem = mysql_fetch_array($qSqlItem)) {
                            if(trim($rSqlItem['numeroUnico'])==trim($_SESSION["_numeroUnico_eventoS_".$mod.""])) {
                                $numeroUnico_eventoSet = $rSqlItem['numeroUnico'];
                                $ticketsSet = $rSqlItem['tickets'];
                                $lotesSet = $rSqlItem['lotes'];
                            }
                        ?>
                        <option value="<?= $rSqlItem['numeroUnico'] ?>" <? if(trim($rSqlItem['numeroUnico'])==trim($_SESSION["_numeroUnico_eventoS_".$mod.""])) { echo " selected"; } ?>><?=$rSqlItem['nome']?></option>
                        <? } ?>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="<?=$tamanho_coluna?>" style="padding:5px;">
            <label class="control-label col-md-12" style="padding:0px;">Período</label>
            <div class="col-md-12" style="padding:0px;">
                <div class="col-md-6" style="padding:0px;">
                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy"  data-date="">
                        <input type="text" class="form-control input-sm campo_busca" pesquisa="data_de" bd_externo="" id="busca_data_de" placeholder="De" value="<?=$_SESSION[''.$mod.'data_de']?>" style="height:34px;">
                        <span class="input-group-btn">
                            <button class="btn" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
    
                <div class="col-md-6" style="padding:0px;">
                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy"  data-date="">
                        <input type="text" class="form-control input-sm campo_busca" pesquisa="data_ate" bd_externo="" id="busca_data_ate" placeholder="Até" value="<?=$_SESSION[''.$mod.'data_ate']?>" style="height:34px;">
                        <span class="input-group-btn">
                            <button class="btn" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="<?=$tamanho_coluna?>" style="padding:5px;padding-top: 24px;">
            <button type="button" style="padding:10px 40px;" onclick="javascript:log_de_entrada_filtrar('<?=$mod?>');" class="btn blue-madison btn-outline btn-circle btn-sm pull-right">Filtrar</button>                                            
        </div>
    </div>
</div>

<? if(trim($_SESSION["_numeroUnico_eventoS_".$mod.""])=="") { } else { ?>
<div class="col-md-12" style="margin-bottom:10px;">
	<div class="col-md-12" style="padding:5px;">
    <h3>Total Notificados</h3>
    <table class="table table-striped table-bordered table-hover display table-header-fixed" style="background-color:#ffffff;" cellspacing="0" width="100%">
        <thead>

            <tr>
                <th>Ticket (Setor)</th>
                <th style="width:200px;text-align:center;">Sem gênero definido</th>
                <th style="width:200px;text-align:center;">Mulheres</th>
                <th style="width:200px;text-align:center;">Homens</th>
                <th style="width:200px;text-align:center;">Total</th>
            </tr>

        </thead>

        <?
		$totalSG = 0;
		$totalF = 0;
		$totalM = 0;
		$totalFinal = 0;
		?>
        <tbody>
        	<? if(trim($ticketsSet)=="") { ?>
				<?
				$total_linha = 0;
				$nSqlSG = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho_notificacao WHERE pessoa_genero NOT IN ('M','F') AND numeroUnico_evento='".$_SESSION["_numeroUnico_eventoS_".$mod.""]."'"));
				$nSqlF  = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho_notificacao WHERE pessoa_genero     IN ('F')     AND numeroUnico_evento='".$_SESSION["_numeroUnico_eventoS_".$mod.""]."'"));
				$nSqlM  = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho_notificacao WHERE pessoa_genero     IN ('M')     AND numeroUnico_evento='".$_SESSION["_numeroUnico_eventoS_".$mod.""]."'"));

				$totalSG = $totalSG + $nSqlSG[0];
				$totalF = $totalF + $nSqlF[0];
				$totalM = $totalM + $nSqlM[0];
				$totalLinha = $nSqlSG[0] + $nSqlF[0] + $nSqlM[0];

				$totalFinal = $totalFinal + $totalLinha;
                ?>
                <tr>
                    <td>Sem definição de Ticket (Setor)</td>
                    <td style="width:200px;text-align:center;"><?=$nSqlSG[0]?></td>
                    <td style="width:200px;text-align:center;"><?=$nSqlF[0]?></td>
                    <td style="width:200px;text-align:center;"><?=$nSqlM[0]?></td>
                    <td style="width:200px;text-align:center;"><?=$totalLinha?></td>
                </tr>
			<? } else { ?>
				<?
                $ticketArray = unserialize($ticketsSet);
                $ticketArray = array_sort($ticketArray, 'ticket_data', SORT_ASC);
                foreach ($ticketArray as $key => $value) {
                    $total_linha = 0;
                    $nSqlSG = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho_notificacao WHERE pessoa_genero NOT IN ('M','F') AND numeroUnico_ticket='".$value['numeroUnico']."'"));
                    $nSqlF  = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho_notificacao WHERE pessoa_genero     IN ('F')     AND numeroUnico_ticket='".$value['numeroUnico']."'"));
                    $nSqlM  = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho_notificacao WHERE pessoa_genero     IN ('M')     AND numeroUnico_ticket='".$value['numeroUnico']."'"));
    
                    $totalSG = $totalSG + $nSqlSG[0];
                    $totalF = $totalF + $nSqlF[0];
                    $totalM = $totalM + $nSqlM[0];
                    $totalLinha = $nSqlSG[0] + $nSqlF[0] + $nSqlM[0];
    
                    $totalFinal = $totalFinal + $totalLinha;
                ?>
                <tr>
                    <td><?=$value['nome']?></td>
                    <td style="width:200px;text-align:center;"><?=$nSqlSG[0]?></td>
                    <td style="width:200px;text-align:center;"><?=$nSqlF[0]?></td>
                    <td style="width:200px;text-align:center;"><?=$nSqlM[0]?></td>
                    <td style="width:200px;text-align:center;"><?=$totalLinha?></td>
                </tr>
                <? } ?>
            <? } ?>
            <tr>
                <td></td>
                <td style="width:200px;text-align:center;"><?=$totalSG?></td>
                <td style="width:200px;text-align:center;"><?=$totalF?></td>
                <td style="width:200px;text-align:center;"><?=$totalM?></td>
                <td style="width:200px;text-align:center;"><?=$totalFinal?></td>
            </tr>
        </tbody>
    </table>

    <h3>Total Confirmados</h3>
    <table class="table table-striped table-bordered table-hover display table-header-fixed" style="background-color:#ffffff;" cellspacing="0" width="100%">
        <thead>

            <tr>
                <th>Ticket (Setor)</th>
                <th style="width:200px;text-align:center;">Sem gênero definido</th>
                <th style="width:200px;text-align:center;">Mulheres</th>
                <th style="width:200px;text-align:center;">Homens</th>
                <th style="width:200px;text-align:center;">Total</th>
            </tr>

        </thead>

        <?
		$totalSG_conf = 0;
		$totalF_conf = 0;
		$totalM_conf = 0;
		$totalFinal_conf = 0;
		?>
        <tbody>
        	<? if(trim($ticketsSet)=="") { ?>
				<?
				$total_linha_conf = 0;
				$nSqlSG_conf = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho_notificacao WHERE pessoa_genero NOT IN ('M','F') AND numeroUnico_evento='".$_SESSION["_numeroUnico_eventoS_".$mod.""]."' AND confirmado='1'"));
				$nSqlF_conf  = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho_notificacao WHERE pessoa_genero     IN ('F')     AND numeroUnico_evento='".$_SESSION["_numeroUnico_eventoS_".$mod.""]."' AND confirmado='1'"));
				$nSqlM_conf  = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho_notificacao WHERE pessoa_genero     IN ('M')     AND numeroUnico_evento='".$_SESSION["_numeroUnico_eventoS_".$mod.""]."' AND confirmado='1'"));

				$totalSG_conf = $totalSG_conf + $nSqlSG_conf[0];
				$totalF_conf = $totalF_conf + $nSqlF_conf[0];
				$totalM_conf = $totalM_conf + $nSqlM_conf[0];
				$totalLinha_conf = $nSqlSG_conf[0] + $nSqlF_conf[0] + $nSqlM_conf[0];

				$totalFinal_conf = $totalFinal_conf + $totalLinha_conf;
                ?>
                <tr>
                    <td>Sem definição de Ticket (Setor)</td>
                    <td style="width:200px;text-align:center;"><?=$nSqlSG_conf[0]?></td>
                    <td style="width:200px;text-align:center;"><?=$nSqlF_conf[0]?></td>
                    <td style="width:200px;text-align:center;"><?=$nSqlM_conf[0]?></td>
                    <td style="width:200px;text-align:center;"><?=$totalLinha_conf?></td>
                </tr>
			<? } else { ?>
				<?
                $ticketArray = unserialize($ticketsSet);
                $ticketArray = array_sort($ticketArray, 'ticket_data', SORT_ASC);
                foreach ($ticketArray as $key => $value) {
                    $total_linha_conf = 0;
                    $nSqlSG_conf = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho_notificacao WHERE pessoa_genero NOT IN ('M','F') AND numeroUnico_ticket='".$value['numeroUnico']."' AND confirmado='1'"));
                    $nSqlF_conf  = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho_notificacao WHERE pessoa_genero     IN ('F')     AND numeroUnico_ticket='".$value['numeroUnico']."' AND confirmado='1'"));
                    $nSqlM_conf  = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho_notificacao WHERE pessoa_genero     IN ('M')     AND numeroUnico_ticket='".$value['numeroUnico']."' AND confirmado='1'"));
    
                    $totalSG_conf = $totalSG_conf + $nSqlSG_conf[0];
                    $totalF_conf = $totalF_conf + $nSqlF_conf[0];
                    $totalM_conf = $totalM_conf + $nSqlM_conf[0];
                    $totalLinha_conf = $nSqlSG_conf[0] + $nSqlF_conf[0] + $nSqlM_conf[0];
    
                    $totalFinal_conf = $totalFinal_conf + $totalLinha_conf;
                ?>
                <tr>
                    <td><?=$value['nome']?></td>
                    <td style="width:200px;text-align:center;"><?=$nSqlSG[0]?></td>
                    <td style="width:200px;text-align:center;"><?=$nSqlF[0]?></td>
                    <td style="width:200px;text-align:center;"><?=$nSqlM[0]?></td>
                    <td style="width:200px;text-align:center;"><?=$totalLinha?></td>
                </tr>
                <? } ?>
            <? } ?>
            <tr>
                <td></td>
                <td style="width:200px;text-align:center;"><?=$totalSG_conf?></td>
                <td style="width:200px;text-align:center;"><?=$totalF_conf?></td>
                <td style="width:200px;text-align:center;"><?=$totalM_conf?></td>
                <td style="width:200px;text-align:center;"><?=$totalFinal_conf?></td>
            </tr>
        </tbody>
    </table>

    <h3>Falta Confirmar</h3>
    <table class="table table-striped table-bordered table-hover display table-header-fixed" style="background-color:#ffffff;" cellspacing="0" width="100%">
        <thead>

            <tr>
                <th></th>
                <th style="width:200px;text-align:center;">Sem gênero definido</th>
                <th style="width:200px;text-align:center;">Mulheres</th>
                <th style="width:200px;text-align:center;">Homens</th>
                <th style="width:200px;text-align:center;">Total</th>
            </tr>

        </thead>

        <tbody>
			<?
            $totalSG_nao = $totalSG - $totalSG_conf;
            $totalF_nao = $totalF - $totalF_conf;
            $totalM_nao = $totalM - $totalM_conf;
            $totalFinal_nao = $totalFinal - $totalFinal_conf;
            ?>
            <tr>
                <td></td>
                <td style="width:200px;text-align:center;"><?=$totalSG_nao?></td>
                <td style="width:200px;text-align:center;"><?=$totalF_nao?></td>
                <td style="width:200px;text-align:center;"><?=$totalM_nao?></td>
                <td style="width:200px;text-align:center;"><?=$totalFinal_nao?></td>
            </tr>
        </tbody>
    </table>
    </div>
</div>
<? } ?>
