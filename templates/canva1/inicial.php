		<?
        $strSql = "
            SELECT 
                COUNT(*)
                
            FROM 
                slide AS mod_slide 

            WHERE 
				mod_slide.stat='1' AND
				mod_slide.".$campoWhereEmpresaEventos."='".$EMPRESA_TOKEN_CONFIG."'

        ";
        $nSqlSlideDisp = mysql_fetch_row(mysql_query("".$strSql.""));
        if($nSqlSlideDisp[0]==0) { } else {
        ?>

		<section class="min-vh-0">
			<div class="content-wrap" style="padding-top:0px !important;">
				<!--
				#################################
					- THEMEPUNCH BANNER -
				#################################
				-->
                <div id="tg-homeslidervone" class="tg-homeslidervone tg-homeslider tg-haslayout" style="min-height:none !important;">
                    <?
                    $strSql = "
                        SELECT 
                            mod_slide.id,
                            mod_slide.numeroUnico,
                            mod_slide.exibir_titulo,
                            mod_slide.nome,
                            mod_slide.cor_da_fonte_do_titulo,
                            mod_slide.exibir_subtitulo,
                            mod_slide.subtitulo,
                            mod_slide.cor_da_fonte_do_subtitulo,
                            mod_slide.imagem,
                            mod_slide.imagem_de_fundo,
                            mod_slide.link,
                            mod_slide.texto_do_botao,
                            mod_slide.link_do_botao,
                            mod_slide.target,
                            mod_slide.cor_de_fundo_do_botao
                            
                        FROM 
                            slide AS mod_slide 
        
                        WHERE 
                            mod_slide.stat='1' AND
                            mod_slide.".$campoWhereEmpresaEventos."='".$EMPRESA_TOKEN_CONFIG."'
        
                        ORDER BY
                            mod_slide.ordem ASC
                            
                    ";
        
                    $corSet = "#ffffff";
                    $qSql = mysql_query("".$strSql."");
                    while($rSql = mysql_fetch_array($qSql)) {
                        if(trim($rSql['link_do_botao'])=="") {
                            $linkSet = "";
                        } else {
                            if(trim($rSql['target'])=="" || trim($rSql['target'])=="_blank") {
                                $linkSet = " href=\"".$rSql['link_do_botao']."\" target=\"_blank\"";
                            } else {
                                $linkSet = " href=\"".$rSql['link_do_botao']."\" target=\"".$rSql['target']."\"";
                            }
                        }
                    ?>
                    <div class="pogoSlider-slide" data-transition="fade" data-duration="1500" style="padding:0px !important;">

						<style>
                        .titulo_slide_<?=$rSql['id']?> {
                            color: <?=$rSql['cor_da_fonte_do_titulo']?> !important;
                        }
                        .subtitulo_slide_<?=$rSql['id']?> {
                            color: <?=$rSql['cor_da_fonte_do_subtitulo']?> !important;
                        }
                        .button_slide_<?=$rSql['id']?> {
                            background-color: <?=$rSql['cor_de_fundo_do_botao']?> !important;
                        }
                        </style>

                        <!--
                        <? if(trim($rSql['exibir_titulo'])=="1") { ?>
                        <div
                        style="color: <?=$rSql['cor_da_fonte_do_titulo']?>; white-space: nowrap;margin-left:50%;position:absolute;"><?=$rSql['nome']?></div>
                        <? } ?>

                        <? if(trim($rSql['exibir_subtitulo'])=="1") { ?>
                        <div style="z-index: 3; color: <?=$rSql['cor_da_fonte_do_subtitulo']?>; white-space: nowrap;position:absolute;"><?=$rSql['subtitulo']?></div>
                        <? } ?>

                        <? if(trim($rSql['texto_do_botao'])=="") { } else { ?>
                        <div style="z-index: 3;position:absolute;">
                            <a <?=$linkSet?> class="button button-border button-large button-rounded text-end m-0 button_slide_<?=$rSql['id']?>"><span><?=$rSql['texto_do_botao']?></span><i class="icon-angle-right"></i></a>
                        </div>
                        <? } ?>
                        -->

                        <img src="<?=$link?>files/slide/<?=$rSql['numeroUnico']?>/<?=$rSql['imagem_de_fundo']?>" />
                    </div>
                    <? } ?>
                </div>
            </div>
		</section>
        <? } ?>

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
            	<?
				$strSql = "
					SELECT 
						COUNT(*)
						
					FROM 
						eventos AS mod_eventos 

					WHERE 
						mod_eventos.stat='1' AND
						mod_eventos.exibir_site='1' AND
						mod_eventos.destaque='1' AND
						mod_eventos.".$campoWhereEmpresaEventos."='".$EMPRESA_TOKEN_CONFIG."' AND
						mod_eventos.data_de_publicacao <= '".date("Y-m-d")."' AND
						mod_eventos.data_de_despublicacao > '".date("Y-m-d")."'

				";
				$nSqlEventosDestaque = mysql_fetch_row(mysql_query("".$strSql.""));
				if($nSqlEventosDestaque[0]==0) { } else {
				?>
				<div class="container clearfix">

					<? 
					if($nSqlEventosDestaque[0]>2) {
						include("".$_SERVER['DOCUMENT_ROOT']."/templates/".$pasta_template."/inicial_slide_3_itens.php");
					} else {
						if($nSqlEventosDestaque[0]>1) {
							include("".$_SERVER['DOCUMENT_ROOT']."/templates/".$pasta_template."/inicial_slide_2_itens.php");
						} else {
							include("".$_SERVER['DOCUMENT_ROOT']."/templates/".$pasta_template."/inicial_slide_1_itens.php");
						}
					}
					?>

				</div>
                <? } ?>

				<!--
                <div class="promo parallax promo-full bottommargin-lg" style="background-image: url('https://source.unsplash.com/F75IfIWSqRY/1920x1080');margin-bottom:0px !important;" data-bottom-top="background-position:0px 300px;" data-top-bottom="background-position:0px -300px;">
					<div class="container clearfix">
						<div class="row align-items-center">
							<div class="col-12 col-lg">
								<h3 class="text-white">Divulgue seu <span>evento</span> conosco e ganhe agilidade nas suas vendas. Com nosso checkout <span>POP360</span></h3>
								<span class="text-white">Seus eventos divulgados e vendidos com carinho, segurança e profissionalismo.</span>
							</div>
							<div class="col-12 col-lg-auto mt-4 mt-lg-0">
								<a href="#" class="button button-large button-circle m-0">Fale com um representante</a>
							</div>
						</div>
					</div>
				</div>
                -->

				<div class="container">

					<div class="row col-mb-50 mb-0">
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
                        ?>
						<div class="col-sm-6 col-lg-4">
							<div class="feature-box text-center media-box fbox-bg">
								<div class="fbox-media">
									<? if(trim($rSql['eventos_imagem_de_capa'])=="") { ?>
                                    <img src="<?=$link_modelo?>templates/<?=$pasta_template?>/images/sem_imagem.png" style="border: 1px solid #E5E5E5;border-radius: 5px 5px 0px 0px;" alt="<?=$rSql['eventos_nome']?>">
								    <? } else { ?>
                                    <img src="data:image/png;base64,<?=$rSql['eventos_imagem_de_capa']?>" alt="<?=$rSql['eventos_nome']?>">
                                    <? } ?>
								</div>
								<div class="fbox-content">
									<h3 style="min-height: 50px;"><?=$rSql['eventos_nome']?></h3>
									<? if(trim($monta_local)=="" && trim($monta_endereco)=="") { } else { ?>
                                    <h3><span class="subtitle" style="font-size: 13px;font-style: italic;min-height: 50px;"><?=$monta_local?><?=$monta_endereco?></span></h3>
                                    <? } ?>
									<h3><span class="subtitle"><?=$diasemana?>, <?=$d?> de <?=$mes?> de <?=$a?> às <?=substr($rSql['eventos_hora_inicio'],0,5)?></span></h3>
									<p><a href="<?=$link_modelo?><?=$url_eventos?>/<?=$rSql['eventos_id']?>/<?=$rSql['eventos_url_amigavel']?>/" class="button button-3d">Comprar</a></p>
								</div>
							</div>
						</div>
                        <? } ?>

					</div>

				</div>

			</div>
		</section><!-- #content end -->
		<? } ?>

