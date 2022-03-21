		<?
        $strSql = "
            SELECT 
                COUNT(*)
                
            FROM 
                eventos AS mod_eventos 

            WHERE 
                mod_eventos.stat='1' AND
                mod_eventos.exibir_site='1' AND
                mod_eventos.".$campoWhereEmpresaEventos."='".$EMPRESA_TOKEN_CONFIG."' AND
                mod_eventos.data_de_publicacao <= '".date("Y-m-d")."' AND
                mod_eventos.data_de_despublicacao > '".date("Y-m-d")."'

        ";
        $nSqlEventosDisp = mysql_fetch_row(mysql_query("".$strSql.""));
        if($nSqlEventosDisp[0]==0) {
        ?>
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="row gutter-40 col-mb-80">
						<!-- Post Content
						============================================= -->
						<div class="postcontent col-lg-12">
                            <div class="style-msg infomsg">
                                <div class="sb-msg"><i class="icon-info-sign"></i><strong>Ops!</strong> No momento estamos sem eventos disponíveis para venda.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <? }  else { ?>
		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap" style="padding-top:40px;padding-bottom:0px;">

				<div id="events" class="single-event header-stick footer-stick clearfix">

					<?
                    if(trim($numeroUnicoEventoDestaque)=="") {
                        $filtroEventosDestaque = "";
                    } else {
                        $filtroEventosDestaque = " mod_eventos.numeroUnico NOT IN (".$numeroUnicoEventoDestaque.") AND ";
                    }
                    $strSql = "
                        SELECT 
                            mod_eventos.id AS eventos_id,
                            mod_eventos.numeroUnico AS eventos_numeroUnico,
                            mod_eventos.numeroUnico_pessoa AS eventos_numeroUnico_pessoa,
                            mod_eventos.url_amigavel AS eventos_url_amigavel,

                            mod_eventos.local AS eventos_local,
                            mod_eventos.rua AS eventos_rua,
                            mod_eventos.numero AS eventos_numero,
                            mod_eventos.complemento AS eventos_complemento,
                            mod_eventos.bairro AS eventos_bairro,
                            mod_eventos.cidade AS eventos_cidade,
                            mod_eventos.bairro AS eventos_bairro,

                            mod_eventos.nome AS eventos_nome,
							mod_eventos.lotes AS eventos_lotes,
                            mod_eventos.imagem_de_icone AS eventos_imagem_de_icone,
                            mod_eventos.imagem_de_capa AS eventos_imagem_de_capa,
                            mod_eventos.data_do_evento AS eventos_data_do_evento,
                            mod_eventos.hora_inicio AS eventos_hora_inicio,
                            mod_eventos.data AS eventos_data
                            
                        FROM 
                            eventos AS mod_eventos 
    
                        WHERE 
                            ".$filtroEventosDestaque."
                            mod_eventos.stat='1' AND
                            mod_eventos.exibir_site='1' AND
                            mod_eventos.".$campoWhereEmpresaEventos."='".$EMPRESA_TOKEN_CONFIG."' AND
                            mod_eventos.data_de_publicacao <= '".date("Y-m-d")."' AND
                            mod_eventos.data_de_despublicacao > '".date("Y-m-d")."'
    
                        GROUP BY
                            mod_eventos.id
            
                        ORDER BY
                            mod_eventos.data_do_evento ASC
                            
                    ";
    
                    $corSet = "#ffffff";
                    $qSql = mysql_query("".$strSql."");
                    while($rSql = mysql_fetch_array($qSql)) {
                          $btnSolicitacao = "<button type=\"button\" onclick=\"javascript:window.open('".$link_modelo."".$url_eventos."/".$rSql['eventos_id']."/".$rSql['eventos_url_amigavel']."/','_self','');\" class=\"btn btn-success d-block w-100\">Acessar ".$configuracoes_site['label_evento_singular']."</button>";
    
                          if(trim($rSql['eventos_local'])=="") { $monta_local = ""; } else { $monta_local = "".$rSql['eventos_local'].""; }

                          $monta_endereco = "";
                          if(trim($rSql['eventos_cidade'])=="") { } else { $monta_endereco .= "<br>".$rSql['eventos_cidade'].""; }
                          if(trim($rSql['eventos_estado'])=="") { } else { $monta_endereco .= "/".$rSql['eventos_estado'].""; }
    
                          $d  = substr($rSql['eventos_data_do_evento'],8,2);
                          $a  = substr($rSql['eventos_data_do_evento'],0,4);
                          
                          // com-feira, sem-feira, curto
                          $diasemana = diasemana_extenso($rSql['eventos_data_do_evento'],"sem-feira");
                        
                          $mes = mes_extenso(substr($rSql['eventos_data_do_evento'],5,2),"longo");

						  $cont_lote=0;
						  $lotesArray = unserialize($rSql['eventos_lotes']);
						  $lotesArray = array_sort($lotesArray, 'lote_valor', SORT_ASC);
						  foreach ($lotesArray as $key_lote => $value_lote) {
							  $cont_lote++;
							  if($cont_lote==1) {
								  $valor_lote = $value_lote['lote_valor'];
							  }
						  }
                    ?>
					<div class="event entry-image parallax mb-0" style="background-image: url('<?=$link_modelo?>admin/files/eventos/<?=$rSql['eventos_numeroUnico']?>/imagem_de_banner.png'); height:600px;background-size:cover;" 
                    data-bottom-top="background-position:0px 0px;" 
                    data-top-bottom="background-position:0px 0px;">
						<div class="entry-overlay-meta">
							<h2><a href="<?=$link_modelo?><?=$url_eventos?>/<?=$rSql['eventos_id']?>/<?=$rSql['eventos_url_amigavel']?>/"><?=$rSql['eventos_nome']?></a></h2>
							<ul class="iconlist">
								<li><i class="icon-calendar3"></i> <strong>Dia:</strong>&nbsp;&nbsp;<?=$diasemana?>, <?=$d?> de <?=$mes?> de <?=$a?></li>
								<li><i class="icon-time"></i> <strong>Hora:</strong>&nbsp;&nbsp;<?=substr($rSql['eventos_hora_inicio'],0,5)?></li>
								<li><i class="icon-map-marker2"></i> <strong>Local:</strong>&nbsp;&nbsp;<?=$rSql['eventos_local']?></li>
								<li><i class="icon-dollar"></i> <strong><?="R$ ".number_format($valor_lote, 2, ',', '.').""?></strong></li>
							</ul>
							<a href="<?=$link_modelo?><?=$url_eventos?>/<?=$rSql['eventos_id']?>/<?=$rSql['eventos_url_amigavel']?>/" class="btn btn-danger w-100 btn-lg">Comprar</a>
						</div>
						<div class="entry-overlay">
							<div id="event-countdown1" class="countdown" data-year="2021" data-month="6" data-day="23"></div>
						</div>
					</div>
                    <? } ?>

                </div>

			</div>
		</section><!-- #content end -->
		<? } ?>

