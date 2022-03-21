                    <div class="row align-items-stretch gutter-20 mb-5 min-vh-60" style="margin-bottom:40px;">
						<div class="col-xl-8">
							<div class="fslider" data-arrows="false">
								<div class="flexslider">
									<div>
										<?
                                        $strSql = "
                                            SELECT 
                                                mod_eventos.id AS eventos_id,
                                                mod_eventos.numeroUnico AS eventos_numeroUnico,
                                                mod_eventos.numeroUnico_pessoa AS eventos_numeroUnico_pessoa,
                                                mod_eventos.url_amigavel AS eventos_url_amigavel,
                                                mod_eventos.nome AS eventos_nome,
                                                mod_eventos.imagem_de_icone AS eventos_imagem_de_icone,
                                                mod_eventos.imagem_de_capa AS eventos_imagem_de_capa,
                                                mod_eventos.imagem_de_banner AS eventos_imagem_de_banner,
                                                mod_eventos.imagem_de_banner_2 AS eventos_imagem_de_banner_2,
                                                mod_eventos.data_do_evento AS eventos_data_do_evento,
                                                mod_eventos.hora_inicio AS eventos_hora_inicio,
                                                mod_eventos.data AS eventos_data
                                                
                                            FROM 
                                                eventos AS mod_eventos 
                        
                                            WHERE 
                                                mod_eventos.stat='1' AND
												mod_eventos.exibir_site='1' AND
												mod_eventos.destaque='1' AND
												mod_eventos.".$campoWhereEmpresaEventos."='".$EMPRESA_TOKEN_CONFIG."' AND
												mod_eventos.data_de_publicacao <= '".date("Y-m-d")."' AND
												mod_eventos.data_de_despublicacao >= '".date("Y-m-d")."'
                        
                                            GROUP BY
                                                mod_eventos.id
                                
                                            ORDER BY
                                                mod_eventos.data_do_evento ASC

                                            LIMIT
                                                1
                                                
                                        ";
                        
                                        $corSet = "#ffffff";
                                        $qSql = mysql_query("".$strSql."");
                                        while($rSql = mysql_fetch_array($qSql)) {
                                              $btnSolicitacao = "<button type=\"button\" onclick=\"javascript:window.open('".$link_modelo."".$url_eventos."/".$rSql['eventos_id']."/".$rSql['eventos_url_amigavel']."/','_self','');\" class=\"btn btn-success d-block w-100\">Acessar ".$configuracoes_site['label_evento_singular']."</button>";
                        
                                              $d  = substr($rSql['eventos_data_do_evento'],8,2);
                                              $a  = substr($rSql['eventos_data_do_evento'],0,4);
                                              
                                              // com-feira, sem-feira, curto
                                              $diasemana = diasemana_extenso($rSql['eventos_data_do_evento'],"sem-feira");
                                            
                                              $mes = mes_extenso(substr($rSql['eventos_data_do_evento'],5,2),"longo");
											  
											  $numeroUnicoEvento1 = "'".$rSql['eventos_numeroUnico']."'";
											  $numeroUnicoEventoDestaque = "'".$rSql['eventos_numeroUnico']."'";
                                        ?>
										<div class="slide">
											<a href="<?=$link_modelo?><?=$url_eventos?>/<?=$rSql['eventos_id']?>/<?=$rSql['eventos_url_amigavel']?>/">
                                                <div class="bg-overlay">
                                                    <div class="bg-overlay-content text-overlay-mask dark desc-sm align-items-end justify-content-start">
                                                        <div class="portfolio-desc">
                                                            <h3><?=$rSql['eventos_nome']?></h3>
                                                            <span><?=$diasemana?>, <?=$d?> de <?=$mes?> de <?=$a?> às <?=substr($rSql['eventos_hora_inicio'],0,5)?></span>
                                                        </div>
                                                    </div>
                                                </div>
												<? if(trim($rSql['eventos_imagem_de_banner_2'])=="") { ?>
                                                <img src="<?=$link_modelo?>templates/<?=$pasta_template?>/images/shop/slider/1.jpg" alt="<?=$rSql['eventos_nome']?>">
                                                <? } else { ?>
                                                <img src="data:image/png;base64,<?=$rSql['eventos_imagem_de_banner_2']?>" alt="<?=$rSql['eventos_nome']?>">
                                                <? } ?>
											</a>
										</div>
                                        <? } ?>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-4">
							<div class="row align-items-stretch gutter-20 mb-5 min-vh-60">
								<?
								$cont=0;
                                $strSql = "
                                    SELECT 
                                        mod_eventos.id AS eventos_id,
                                        mod_eventos.numeroUnico AS eventos_numeroUnico,
                                        mod_eventos.numeroUnico_pessoa AS eventos_numeroUnico_pessoa,
                                        mod_eventos.url_amigavel AS eventos_url_amigavel,
                                        mod_eventos.nome AS eventos_nome,
                                        mod_eventos.imagem_de_icone AS eventos_imagem_de_icone,
                                        mod_eventos.imagem_de_capa AS eventos_imagem_de_capa,
										mod_eventos.imagem_de_banner_2 AS eventos_imagem_de_banner_2,
                                        mod_eventos.data_do_evento AS eventos_data_do_evento,
                                        mod_eventos.hora_inicio AS eventos_hora_inicio,
                                        mod_eventos.data AS eventos_data
                                        
                                    FROM 
                                        eventos AS mod_eventos 
                
                                    WHERE 
                                        mod_eventos.numeroUnico NOT IN (".$numeroUnicoEvento1.") AND
                                        mod_eventos.stat='1' AND
										mod_eventos.destaque='1' AND
										mod_eventos.".$campoWhereEmpresaEventos."='".$EMPRESA_TOKEN_CONFIG."' AND
										mod_eventos.data_de_publicacao <= '".date("Y-m-d")."' AND
										mod_eventos.data_de_despublicacao >= '".date("Y-m-d")."'
                
                                    GROUP BY
                                        mod_eventos.id
                        
                                    ORDER BY
                                        mod_eventos.data_do_evento ASC

                                    LIMIT
                                        2
                                        
                                ";
                
                                $corSet = "#ffffff";
                                $qSql = mysql_query("".$strSql."");
                                while($rSql = mysql_fetch_array($qSql)) {
									  $cont++;
                                      $btnSolicitacao = "<button type=\"button\" onclick=\"javascript:window.open('".$link_modelo."".$url_eventos."/".$rSql['eventos_id']."/".$rSql['eventos_url_amigavel']."/','_self','');\" class=\"btn btn-success d-block w-100\">Acessar ".$configuracoes_site['label_evento_singular']."</button>";
                
                                      $d  = substr($rSql['eventos_data_do_evento'],8,2);
                                      $a  = substr($rSql['eventos_data_do_evento'],0,4);
                                      
                                      // com-feira, sem-feira, curto
                                      $diasemana = diasemana_extenso($rSql['eventos_data_do_evento'],"sem-feira");
                                    
                                      $mes = mes_extenso(substr($rSql['eventos_data_do_evento'],5,2),"longo");

									  $numeroUnicoEventoDestaque = "".$numeroUnicoEventoDestaque.",'".$rSql['eventos_numeroUnico']."'";
                                ?>
								<div class="col-12 col-md-6 col-xl-12 min-vh-25 min-vh-md-0">
									<a href="<?=$link_modelo?><?=$url_eventos?>/<?=$rSql['eventos_id']?>/<?=$rSql['eventos_url_amigavel']?>/" class="grid-inner d-block h-100">
                                        <div class="bg-overlay">
                                            <div class="bg-overlay-content text-overlay-mask dark desc-sm align-items-end justify-content-start">
                                                <div class="portfolio-desc">
                                                    <h3><?=$rSql['eventos_nome']?></h3>
                                                    <span><?=$diasemana?>, <?=$d?> de <?=$mes?> de <?=$a?> às <?=substr($rSql['eventos_hora_inicio'],0,5)?></span>
                                                </div>
                                            </div>
                                        </div>
										<? if(trim($rSql['eventos_imagem_de_banner_2'])=="") { ?>
                                        <img src="<?=$link_modelo?>templates/<?=$pasta_template?>/images/shop/slider/1.jpg" alt="<?=$rSql['eventos_nome']?>">
                                        <? } else { ?>
                                        <img style="max-width: calc(100% - 3.5px);" src="data:image/png;base64,<?=$rSql['eventos_imagem_de_banner_2']?>" alt="<?=$rSql['eventos_nome']?>">
                                        <? } ?>
                                    </a>
								</div>
                                <? } ?>
							</div>
						</div>
                        
					</div>
