		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">


					<div class="single-product">
						<div class="product">
							<div class="row gutter-40">


                                <div class="col-md-12">
                                    <?=$rSqlItem['descricao_completa']?>
                                </div>
    
								<div class="w-100"></div>

							</div>
						</div>
					</div>

					<div class="line"></div>

					<div class="masonry-thumbs grid-container grid-6" data-big="3" data-lightbox="gallery">
						<?
                        $strSql = "
                            SELECT 
                                mod_sysmidia.id,
                                mod_sysmidia.numeroUnico,
                                mod_sysmidia.nome,
                                mod_sysmidia.legenda,
                                mod_sysmidia.arquivo
                                
                            FROM 
                                sysmidia AS mod_sysmidia 
        
                            WHERE 
                                mod_sysmidia.stat='1' AND
								mod_sysmidia.numeroUnico_item_pai='".$rSqlItem['numeroUnico']."' AND
								mod_sysmidia.lixeira='0'
        
                            ORDER BY
                                mod_sysmidia.ordem ASC
                                
                        ";
        
                        $corSet = "#ffffff";
                        $qSql = mysql_query("".$strSql."");
                        while($rSql = mysql_fetch_array($qSql)) {
                        ?>
						<a class="grid-item" href="<?=$link?>files/sysmidia/<?=$rSql['numeroUnico']?>/<?=$rSql['arquivo']?>" data-lightbox="gallery-item">
                        	<img src="<?=$link?>files/sysmidia/<?=$rSql['numeroUnico']?>/<?=$rSql['arquivo']?>" alt="<?=$rSql['legenda']?>">
                        </a>
                        <? } ?>
					</div>

					</div>

				</div>
			</div>
		</section><!-- #content end -->