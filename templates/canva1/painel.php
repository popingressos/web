		<!-- Page Sub Menu
		============================================= -->
		<div id="page-menu" class="menu-desktop-logado" data-mobile-sticky="true">
			<div id="page-menu-wrap">
				<div class="container">
					<div class="page-menu-row">

						<div class="page-menu-title">Menu <span>Painel</span></div>

						<nav class="page-menu-nav">
							<ul class="page-menu-container">
								<li class="page-menu-item <? if(trim($_REQUEST['var2'])=="" || trim($_REQUEST['var2'])=="meus-dados") { ?>current<? } ?>"><a href="<?=$link_modelo?>painel/meus-dados/" class="d-flex"><i class="icon-user"></i>&nbsp;&nbsp;<div>Meus Dados</div></a></li>
								<li class="page-menu-item <? if(trim($_REQUEST['var2'])=="meu-endereco") { ?>current<? } ?>"><a href="<?=$link_modelo?>painel/meu-endereco/" class="d-flex"><i class="icon-line-map-pin"></i>&nbsp;&nbsp;<div>Meu Endereço</div></a></li>
								<li class="page-menu-item <? if(trim($_REQUEST['var2'])=="alterar-senha") { ?>current<? } ?>"><a href="<?=$link_modelo?>painel/alterar-senha/" class="d-flex"><i class="icon-lock1"></i>&nbsp;&nbsp;<div>Alterar Senha</div></a></li>
								<li class="page-menu-item <? if(trim($_REQUEST['var2'])=="".$url_minhas_compras."") { ?>current<? } ?>"><a href="<?=$link_modelo?>painel/<?=$url_minhas_compras?>/" class="d-flex"><i class="icon-line-bag"></i>&nbsp;&nbsp;<div><?=$configuracoes_site['label_menu_minhas_compras_plural']?></div></a></li>
								<li class="page-menu-item <? if(trim($_REQUEST['var2'])=="".$url_meus_ingressos."") { ?>current<? } ?>"><a href="<?=$link_modelo?>painel/<?=$url_meus_ingressos?>/" class="d-flex"><i class="icon-ticket"></i>&nbsp;&nbsp;<div><?=$configuracoes_site['label_menu_meus_ingressos_plural']?></div></a></li>
								<li class="page-menu-item"><a href="javascript:void(0);" onclick="javascript:signoutRedes();" class="d-flex"><i class="icon-line2-logout"></i>&nbsp;&nbsp;<div>Logout</div></a></li>
							</ul>
						</nav>

						<div id="page-menu-trigger"><i class="icon-reorder"></i></div>

					</div>
				</div>
			</div>
		</div><!-- #page-menu end -->

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="row clearfix">

						<!--
                        <div class="col-md-3">

							<div class="list-group">
								<a href="<?=$link_modelo?>painel/meus-dados/" class="list-group-item list-group-item-action d-flex"><i class="icon-user"></i>&nbsp;&nbsp;<div>Meus Dados</div></a>
								<a href="<?=$link_modelo?>painel/meu-endereco/" class="list-group-item list-group-item-action d-flex"><i class="icon-line-map-pin"></i>&nbsp;&nbsp;<div>Meu Endereço</div></a>
								<a href="<?=$link_modelo?>painel/alterar-senha/" class="list-group-item list-group-item-action d-flex"><i class="icon-lock1"></i>&nbsp;&nbsp;<div>Alterar Senha</div></a>
								<a href="<?=$link_modelo?>painel/minhas-compras/" class="list-group-item list-group-item-action d-flex"><i class="icon-line-bag"></i>&nbsp;&nbsp;<div>Minhas Compras</div></a>
								<a href="<?=$link_modelo?>painel/meus-ingressos/" class="list-group-item list-group-item-action d-flex"><i class="icon-ticket"></i>&nbsp;&nbsp;<div>Meus ingressos</div></a>
								<a href="<?=$link_modelo?>sair/" class="list-group-item list-group-item-action d-flex"><i class="icon-line2-logout"></i>&nbsp;&nbsp;<div>Logout</div></a>
							</div>

						</div>
                        -->

						<div class="w-100 line d-block d-md-none"></div>

						<div class="col-md-12">
                        	<? include("".$pagina_in.""); ?>
                        </div>

					</div>

				</div>
			</div>
		</section><!-- #content end -->