<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$modGet = "".$_GET['modS']."";

$responsavelGet = $_GET['responsavelS'];
$data_inicioGet = $_GET['data_inicioS'];
$data_fimGet = $_GET['data_fimS'];

$situacaoGet = $_GET['situacaoS'];

$dI  = substr($data_inicioGet,0,2);
$mI  = substr($data_inicioGet,3,2);
$aI  = substr($data_inicioGet,6,4);

$dataCorretaI = $aI."-".$mI."-".$dI;

$dF  = substr($data_fimGet,0,2);
$mF  = substr($data_fimGet,3,2);
$aF  = substr($data_fimGet,6,4);

$dataCorretaF = $aF."-".$mF."-".$dF;

#$data_inicio_set = " data_inicio BETWEEN '".$dataCorretaI."' AND '".$dataCorretaF."'";
#$data_fim_set = " AND data_fim BETWEEN '".$dataCorretaI."' AND '".$dataCorretaF."'";

if(trim($data_inicioGet)=="") {
	if(trim($data_fimGet)=="") {
		$data_inicio_set = "";
		$data_fim_set = "";
	} else {
		$data_fim_set = "WHERE data_fim<='".$dataCorretaF."'";
	}
} else {
	if(trim($data_fimGet)=="") {
		$data_inicio_set = "WHERE data_inicio>='".$dataCorretaI."'";
		$data_fim_set = "";
	} else {
		$data_inicio_set = "WHERE data_inicio>='".$dataCorretaI."'";
		$data_fim_set = " OR data_fim<='".$dataCorretaF."'";
	}
}

if($situacaoGet==0) {
	$filtro_situacao = "";
} else {
	if($situacaoGet==1) {
		$filtro_situacao = " AND concluido='1' AND aprovado='1'";
	} else {
		$filtro_situacao = " AND concluido='1' AND aprovado='0'";
	}
}

?>

                                                            <div id="relatorio_print" style="float:left;width:100%;">
																<script>
                                                                $(function(){
                                                                    
                                                                    $("#barGeral > span").each(function() {
                                                                        $(this)
                                                                            .data("origWidth", $(this).width())
                                                                            .width(0)
                                                                            .animate({
                                                                                width: $(this).data("origWidth")
                                                                            }, 1200);
                                                                    });
                                                                });
                                                                </script>

																<?
																$porcentagem = 0;
                                                                $qSql = mysql_query("SELECT * FROM ".$modGet." ".$data_inicio_set." ".$data_fim_set." ORDER BY data_inicio DESC, hora_inicio DESC");
                                                                while($rSql = mysql_fetch_array($qSql)) {
																	$concluido = 0;
																	$aberto = 0;
																	$qSqlTarefa = mysql_query("SELECT * FROM ".$modGet."_item WHERE stat='1' ".$filtro_situacao." AND responsavel='".$responsavelGet."' AND numeroUnico_pai='".$rSql['numeroUnico']."' ORDER BY nome");
																	while($rSqlTarefa = mysql_fetch_array($qSqlTarefa)) {
																		$nSqlTarefa++;
																		if(trim($rSqlTarefa['concluido'])=="1"&&trim($rSqlTarefa['aprovado'])=="1") {
																			$concluido++;
																		} else {
																			$aberto++;
																		}
																	}
																	
																}

																if($nSqlTarefa==0) {
																	$porcentagem = 0;
																} else {
																	$porcentagem = substr((($concluido / $nSqlTarefa) * 100),0,2);
																}

																if($aberto>0) {
																	if($porcentagem<50) {
																		$classe_barra = "red";
																	} else {
																		if($porcentagem<75) {
																			$classe_barra = "orange";
																		} else {
																			if($porcentagem<95) {
																				$classe_barra = "yellow";
																			} else {
																				$classe_barra = "";
																			}
																		}
																	}
																} else {
																	$classe_barra = "";
																}
																?>
                                                                <div style="width:100%;float:left;">
                                                                    <div id="barGeral" class="meter <?=$classe_barra?>">
                                                                        <span style="width: <?=$porcentagem?>%"><?=$porcentagem?> %</span>
                                                                    </div>
                                                                </div>

                                                                <?
                                                                $qSql = mysql_query("SELECT * FROM ".$modGet." ".$data_inicio_set." ".$data_fim_set." ORDER BY data_inicio DESC, hora_inicio DESC");
                                                                while($rSql = mysql_fetch_array($qSql)) {
																	$nSqlTarefa = mysql_num_rows(mysql_query("SELECT * FROM ".$linguagem_set."".$modGet."_item WHERE stat='1' ".$filtro_situacao." AND responsavel='".$responsavelGet."' AND numeroUnico_pai='".$rSql['numeroUnico']."'"));
																	if($nSqlTarefa==0) { } else {
                                                                ?>
                                                                <div style="float:left;width:100%;border-bottom:3px solid #999;margin-bottom:10px;">
                                                                	<table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                    	<tr>
                                                                        	<td><b>Título</b></td>
                                                                        </tr>
                                                                    	<tr>
                                                                        	<td><?=$rSql['nome']?></td>
                                                                        </tr>
                                                                    	<tr>
                                                                        	<td><b>Data e Hora (START)</b></td>
                                                                        </tr>
                                                                    	<tr>
                                                                        	<td>
																				<? if(trim($rSql['data_inicio'])=="0000-00-00") { } else { 
                                                                                    $d  = substr($rSql['data_inicio'],8,2);
                                                                                    $m  = substr($rSql['data_inicio'],5,2);
                                                                                    $a  = substr($rSql['data_inicio'],0,4);
                                                                                    $h = substr($rSql['data_inicio'],11,19);
                                                                                
                                                                                    $arrayData = mktime(0,0,0,$m,$d,$a);
                                                                                    $dataCorreta = date("d/m/Y", $arrayData);
                                                                                
                                                                                    echo "".$dataCorreta."";
                                                                                } 
                                                                                ?>
																				<? if(trim($rSql['hora_inicio'])=="") { echo date("H:i:s"); } else { echo $rSql['hora_inicio']; } ?>
                                                                            </td>
                                                                        </tr>
                                                                    	<tr>
                                                                        	<td><b>Data e Hora (DEADLINE)</b></td>
                                                                        </tr>
                                                                    	<tr>
                                                                        	<td>
																				<? if(trim($rSql['data_fim'])=="0000-00-00") { } else { 
                                                                                    $d  = substr($rSql['data_fim'],8,2);
                                                                                    $m  = substr($rSql['data_fim'],5,2);
                                                                                    $a  = substr($rSql['data_fim'],0,4);
                                                                                    $h = substr($rSql['data_fim'],11,19);
                                                                                
                                                                                    $arrayData = mktime(0,0,0,$m,$d,$a);
                                                                                    $dataCorreta = date("d/m/Y", $arrayData);
                                                                                
                                                                                    echo "".$dataCorreta."";
                                                                                } 
                                                                                ?>
																				<? if(trim($rSql['hora_fim'])=="") { echo date("H:i:s"); } else { echo $rSql['hora_fim']; } ?>
                                                                            </td>
                                                                        </tr>
                                                                    	<tr>
                                                                        	<td><b>Descrição</b></td>
                                                                        </tr>
                                                                    	<tr>
                                                                        	<td><?=$rSql['texto']?></td>
                                                                        </tr>
                                                                    </table>
        
        
                                                                    <div style="width:100%;float:left;">
                                                                        <? if(trim($modGet)=="") { $modGet = $mod; } else { $modGet = $modGet; } ?>
                                                                        <table id="dt_basic_formacao" class="table table-striped table-condensed">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Responsável</th>
                                                                                <th>Título</th>
                                                                                <th>Descrição</th>
                                                                                <th style="width:130px;">Concluído em</th>
                                                                                <th style="width:130px;">Aprovado em</th>
                                                                                <th style="width:110px;">Ações</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?
                                                                            $qSqlCategoria = mysql_query("SELECT * FROM ".$modGet."_item WHERE stat='1' ".$filtro_situacao." AND responsavel='".$responsavelGet."' AND numeroUnico_pai='".$rSql['numeroUnico']."' ORDER BY nome");
                                                                            while($rSqlCategoria = mysql_fetch_array($qSqlCategoria)) {
                                                                            ?>
                                                                            <tr id="lista_categoria_<?=$rSqlItem['id']?>">
                                                                                <? $rSqlResp = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSqlCategoria['responsavel']."'")); ?>
                                                                                <td style="vertical-align:middle;"><?=$rSqlResp['nome']?></td>
                                                                                <td style="vertical-align:middle;"><?=$rSqlCategoria['nome']?></td>
                                                                                <td style="vertical-align:middle;"><?=$rSqlCategoria['texto']?></td>
                                                                                <td style="vertical-align:middle;">
                                                                                <? if(trim($rSqlCategoria['dataConclusao'])=="0000-00-00 00:00:00") { } else { 
                                                                                    $d  = substr($rSqlCategoria['dataConclusao'],8,2);
                                                                                    $m  = substr($rSqlCategoria['dataConclusao'],5,2);
                                                                                    $a  = substr($rSqlCategoria['dataConclusao'],0,4);
                                                                                    $h = substr($rSqlCategoria['dataConclusao'],11,19);
                                                                                
                                                                                    $arrayData = mktime(0,0,0,$m,$d,$a);
                                                                                    $dataCorreta = date("d-m-Y", $arrayData);
                                                                                
                                                                                    echo "".$dataCorreta." ".$h."";
                                                                                } 
                                                                                ?>
                                                                                </td>
                                                                                <td style="vertical-align:middle;">
                                                                                <? if(trim($rSqlCategoria['dataAprovacao'])=="0000-00-00 00:00:00") { } else { 
                                                                                    $d  = substr($rSqlCategoria['dataAprovacao'],8,2);
                                                                                    $m  = substr($rSqlCategoria['dataAprovacao'],5,2);
                                                                                    $a  = substr($rSqlCategoria['dataAprovacao'],0,4);
                                                                                    $h = substr($rSqlCategoria['dataAprovacao'],11,19);
                                                                                
                                                                                    $arrayData = mktime(0,0,0,$m,$d,$a);
                                                                                    $dataCorreta = date("d-m-Y", $arrayData);
                                                                                
                                                                                    echo "".$dataCorreta." ".$h."";
                                                                                } 
                                                                                ?>
                                                                                </td>
                                                                                <td style="vertical-align:middle;" class="nolink">
                                                                                    <div class="btn-group">
                                                                                    <? if(trim($rSqlCategoria['concluido'])=="1") { ?>
                                                                                        <a href="javascript:void(0);" class="btn-mini ptip_se" title="Concluído"><img src="<?=$link?>template/img/like-1.png" /></a>
                                                                                    <? } else { ?>
                                                                                        <a href="javascript:void(0);" class="btn-mini ptip_se" title="Concluir"><img src="<?=$link?>template/img/like-0.png" /></a>
                                                                                    <? } ?>
                                                                                    <? if(trim($rSqlCategoria['aprovado'])=="1") { ?>
                                                                                        <a href="javascript:void(0);" class="btn-mini ptip_se" title="Aprovado"><img src="<?=$link?>template/img/like-1.png" /></a>
                                                                                    <? } else { ?>
                                                                                        <a href="javascript:void(0);" class="btn-mini ptip_se" title="Aprovar"><img src="<?=$link?>template/img/like-0.png" /></a>
                                                                                    <? } ?>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <? } ?>
                                                                        </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <? } } ?>
                                                            </div>
