		<?
        $strSql = "
            SELECT 
                COUNT(*)
                
            FROM 
                album_de_fotos AS mod_album_de_fotos 

            WHERE 
                mod_album_de_fotos.stat='1' AND
                mod_album_de_fotos.data_de_publicacao <= '".date("Y-m-d")."' AND
                mod_album_de_fotos.data_de_despublicacao > '".date("Y-m-d")."'

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
                                <div class="sb-msg"><i class="icon-info-sign"></i><strong>Ops!</strong> No momento estamos sem álbum de fotos disponíveis para venda.</div>
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
			<div class="content-wrap">

				<div class="container">

					<div class="row col-mb-50 mb-0">
						<?
                        $strSql = "
                            SELECT 
                                mod_album_de_fotos.id,
                                mod_album_de_fotos.numeroUnico,
                                mod_album_de_fotos.url_amigavel,

                                mod_album_de_fotos.nome,
                                mod_album_de_fotos.imagem_de_capa,
                                mod_album_de_fotos.data_da_postagem
                                
                            FROM 
                                album_de_fotos AS mod_album_de_fotos 
        
                            WHERE 
                                mod_album_de_fotos.stat='1' AND
								mod_album_de_fotos.data_de_publicacao <= '".date("Y-m-d")."' AND
								mod_album_de_fotos.data_de_despublicacao > '".date("Y-m-d")."'
        
                            GROUP BY
                                mod_album_de_fotos.id
                
                            ORDER BY
                                mod_album_de_fotos.data_da_postagem ASC
                                
                        ";
        
                        $corSet = "#ffffff";
                        $qSql = mysql_query("".$strSql."");
                        while($rSql = mysql_fetch_array($qSql)) {
                              $d  = substr($rSql['data_da_postagem'],8,2);
                              $a  = substr($rSql['data_da_postagem'],0,4);
                              
                              // com-feira, sem-feira, curto
                              $diasemana = diasemana_extenso($rSql['data_da_postagem'],"sem-feira");
                            
                              $mes = mes_extenso(substr($rSql['data_da_postagem'],5,2),"longo");
                        ?>
						<div class="col-sm-6 col-lg-4">
							<div class="feature-box text-center media-box fbox-bg">
								<div class="fbox-media">
									<? if(trim($rSql['imagem_de_capa'])=="") { ?>
                                    <img src="<?=$link_modelo?>templates/<?=$pasta_template?>/images/sem_imagem.png" style="border: 1px solid #E5E5E5;border-radius: 5px 5px 0px 0px;" alt="<?=$rSql['nome']?>">
								    <? } else { ?>
                                    <img src="<?=$link?>files/album_de_fotos/<?=$rSql['numeroUnico']?>/<?=$rSql['imagem_de_capa']?>" alt="<?=$rSql['nome']?>">
                                    <? } ?>
								</div>
								<div class="fbox-content">
									<h3 style="min-height: 50px;"><?=$rSql['nome']?></h3>
									<h3><span class="subtitle"><?=$diasemana?>, <?=$d?> de <?=$mes?> de <?=$a?></span></h3>
									<p><a href="<?=$link_modelo?><?=$_REQUEST['var1']?>/<?=$rSql['id']?>/<?=$rSql['url_amigavel']?>/" class="button button-3d">Ver Mais</a></p>
								</div>
							</div>
						</div>
                        <? } ?>

					</div>

				</div>

			</div>
		</section><!-- #content end -->

		<? } ?>
