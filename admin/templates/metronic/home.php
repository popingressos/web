<!DOCTYPE HTML>
<html>
	<? include("templates/".$layout_padrao_set."/header.php"); ?>
    
    <style>
	.dropdown-menu>li>a {
		padding-left: 30px !important;
	}
	.col-md-2-5 {
		position: relative;
		min-height: 1px;
		padding-left:2.5px;
		padding-right:2.5px;
	}
	.col-md-2-5:first-child {
		padding-left:0px;
	}
	.col-md-2-5:last-child {
		padding-right:0px;
	}
	@media (min-width: 992px) {
		.col-md-2-5 {
			width: 20%;
		}
		.col-md-2-5 {
			float: left;
		}
	}
    </style>

<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->

<body class="page-header-fixed page-style-rounded page-footer-fixed" > 

<style>
.preloader-back, .preloader-back.fade.in {
    background-color: #333 !important;
}
.preloader-back, .preloader-back.fade.in {
    opacity: 0.7;
    filter: alpha(opacity=70);
    background: #fff;
	position: fixed !important;
}
.preloader-back {
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 10049;
    background-color: #000;
}

.page-spinner-bar-water {
    position: fixed;
    z-index: 10051;
    width: 100%;
    top: 0%;
    left: 0%;
    margin-left: 0px;
    text-align: center;
}
.water-body {
	width: 100%;
	height: 100vh;
	background-color: transparent;
	display: flex;
	justify-content: center;
	align-items: center;
}
.wrapper{
    width:200px;
    height:60px;
    position: absolute;
    left:50%;
    top:50%;
    transform: translate(-50%, -50%);
}
.circle{
    width:20px;
    height:20px;
    position: absolute;
    border-radius: 50%;
    background-color: #fff;
    left:15%;
    transform-origin: 50%;
    animation: circle .5s alternate infinite ease;
}

@keyframes circle{
    0%{
        top:60px;
        height:5px;
        border-radius: 50px 50px 25px 25px;
        transform: scaleX(1.7);
    }
    40%{
        height:20px;
        border-radius: 50%;
        transform: scaleX(1);
    }
    100%{
        top:0%;
    }
}
.circle:nth-child(2){
    left:45%;
    animation-delay: .2s;
}
.circle:nth-child(3){
    left:auto;
    right:15%;
    animation-delay: .3s;
}
.shadow{
    width:20px;
    height:4px;
    border-radius: 50%;
    background-color: rgba(0,0,0,.5);
    position: absolute;
    top:62px;
    transform-origin: 50%;
    z-index: -1;
    left:15%;
    filter: blur(1px);
    animation: shadow .5s alternate infinite ease;
}

@keyframes shadow{
    0%{
        transform: scaleX(1.5);
    }
    40%{
        transform: scaleX(1);
        opacity: .7;
    }
    100%{
        transform: scaleX(.2);
        opacity: .4;
    }
}
.shadow:nth-child(4){
    left: 45%;
    animation-delay: .2s
}
.shadow:nth-child(5){
    left:auto;
    right:15%;
    animation-delay: .3s;
}
.wrapper span{
    position: absolute;
    top:80px;
    font-family: 'Open Sans';
    font-size: 14px;
    letter-spacing: 12px;
    color: #fff;
    left:0%;
}
</style>

<div class="preloader-back fade in" style="z-index: 10050;display:none;"></div>
<div class="page-spinner-bar-water" style="z-index: 10050;display:none;">
    <div class="water-body">
    <div class="wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="shadow"></div>
        <div class="shadow"></div>
        <div class="shadow"></div>
        <span>CARREGANDO</span>
    </div>
    </div>
</div>

<a class="btn btn-outline dark" data-target="#static" data-toggle="modal" id="botão_expirou" style="display:none;"> Sessão Expirada </a>
<div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-hidden="true" style="display: none; margin-top: -77px;">
    <div class="modal-body">
        <p> Sua sessão expirou, clique em OK para fazer novo login </p>
    </div>
    <div class="modal-footer">
        <button type="button" onClick="javascript:logout();" class="btn green">OK</button>
    </div>
</div>


<!--<body class="page-header-fixed page-quick-sidebar-over-content page-style-square page-footer-fixed"> -->
<input type="hidden" id="chave_id" value="<?=$_REQUEST['chave']?>" />

<iframe name="acoes_hidden" style="width:0px;height:0px;display:none;" width="0px" height="0px" frameborder="0"></iframe>

<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->

	<div class="page-header-inner">



		<style>
        .new_togle {
			background: url(<?=$link?>templates/metronic/assets/admin/layout/img/sidebar-toggler.png);

		  display: block;
		  cursor: pointer;
		  opacity: 0.7;
		  filter: alpha(opacity=70);
		  width: 17px;
		  height: 13px;
		  margin-top: 10px;
		  margin-right: 10px;
		  float: right !important;
		  -webkit-border-radius: 4px;
		  -moz-border-radius: 4px;
		  -ms-border-radius: 4px;
		  -o-border-radius: 4px;
		  border-radius: 4px;
		}
        </style>
        <div class="page-logo cor_fundo_logotipo" style="padding-top:10px;height:68px;">
            <a href="<?=$link?>"><?=$logotipoAdminMenu?></a>
            <div class="new_togle menu-toggler sidebar-toggler" style="float:right !important;display:none;">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
		<!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"><i class="fal fa-bars" style="color:#000;font-size:30px;margin-top:16px;"></i></a>
        <!-- END RESPONSIVE MENU TOGGLER -->

		<? include("templates/".$layout_padrao_set."/menu_horizontal.php"); ?>

		<!-- BEGIN HEADER SEARCH BOX -->
		<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
        <!--
        <form class="search-form" action="<?=$link?>" method="post">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Procurar..." name="query">
				<span class="input-group-btn">
				<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
				</span>
			</div>
		</form>
        -->
		<!-- END HEADER SEARCH BOX -->


		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu" style="padding-top:10px;">
			<ul class="nav navbar-nav pull-right">

				<li class="dropdown" style="display:none;">
					<a href="<?=$link?>"  class="controle_clique_edicao dropdown-toggle" title="Página Inicial" style="padding:17px 2px 9px 2px !important;">
					<i class="fa icon-home" style="color:#FFF;"></i>
					</a>
				</li>

				<li class="dropdown" style="display:none;">
					<a href="<?=$sysconfig[0]['url_site_2']?>" target="_blank" class="dropdown-toggle" title="Clique para abrir o site" style="padding:17px 2px 9px 2px !important;">
					<i class="fa icon-globe" style="color:#FFF;"></i>
					</a>
				</li>

				<? if($menu_set=="off") { ?>
                    <li class="dropdown start active open">
                        <a href="javascript:;">
                        <i class="fa fa-gears"></i>
                        <span class="title"></span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                        </a>
                        <ul class="dropdown-menu pull-left">
                            <li class="active">
                                <a class="controle_clique_edicao" href="<?=$link?>suporte/">
                                <i class="fa fa-support"></i> 
                                Suporte</a>
                            </li>
                        </ul>
                    </li>
                <? } else { ?>


				<? } ?>


                <!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <form name="form_logout" action="<?=$link?>" method="post" style="height:290px;display:none">
                    <input type="hidden" name="acaoForm" value="logout">
                    <input type="hidden" name="perfil" value="">
                    <input type="hidden" name="email" value="">
                    <input type="hidden" name="senha" value="">
                    <input type="hidden" name="entrar_auto" value="">
                </form>
				<li class="dropdown dropdown-user" style="display:none;">
					<a href="<?=$link?>"  class="controle_clique_edicao dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<? if(trim($sysusu['imagem'])=="") { ?>
					<!--<img alt="" class="img-circle" src="<?=$link?>templates/<?=$sysconfig[0]['layout_padrao']?>/assets/admin/layout/img/avatar3_small.jpg"/>-->
                    <? } else { ?>
                    <img alt="" class="img-circle" src="<?=$link?>files/sysusu/<?=$sysusu['numeroUnico']?>/<?=$sysusu['imagem']?>">
                    <? } ?>
					<span class="username username-hide-on-mobile" style="color:#FFF;">
					Olá, <strong><?=ucfirst($sysusu['nome'])?></strong> </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
                            <? $chave_gerada = geraCodReturn()."/"; ?>
                            <a class="controle_clique_edicao" title="<?=$_COOKIE['email']?>" href="<?=$link?><?=$chave_gerada?>minha-conta/meus-dados/">
							<i class="icon-user"></i> Meus Dados </a>
						</li>

						<!--
                        <li>
                            <a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>meu-dashboard/">
							<i class="fa fa-desktop"></i> Meu Dashboard </a>
						</li>

						<li>
                            <a href="<?=$link?>minha-conta/alterar-senha-de-acesso/">
							<i class="fa fa-key"></i> Alterar Senha </a>
						</li>
                        <li>
                            <a href="<?=$link?>">
							<i class="icon-calendar"></i> Agenda </a>
						</li>
						<li>
							<a href="<?=$link?>">
							<i class="icon-envelope-open"></i> Caixa de entrada <span class="badge badge-danger"> 3 </span>
							</a>
						</li>
						<li>
							<a href="<?=$link?>">
							<i class="icon-rocket"></i> Tarefas <span class="badge badge-success"> 7 </span>
							</a>
						</li>
                        -->

						<li class="divider">
						</li>

						<li>
                            <a class="controle_clique_edicao" onClick="javascript:logout();" href="javascript:void(0)">
							<i class="fa fa-power-off"></i> Sair </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
				<!-- END QUICK SIDEBAR TOGGLER -->

			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->

				<? if($menu_set=="off") { ?>
                <li class="start active open">
					<a href="javascript:;">
					<i class="fa fa-gears"></i>
					<span class="title">Sistema</span>
					<span class="selected"></span>
					<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<li class="active">
							<a class="controle_clique_edicao" href="<?=$link?>suporte/">
							<i class="fa fa-support"></i> 
							Suporte</a>
						</li>
					</ul>
				</li>
                <? } else { ?>

				<li class="logotipo_menu" onClick="javascript:window.open('<?=$link?>','_self','');" style="text-align:center;padding-bottom:10px;">
					<?=$logotipoAdminMenu?>
                </li>

                <? if(trim($_construtor_sysperm['visualizar_dashboard'])=="1") { ?>
                <li class="menu1" class="start  <? if(trim($_REQUEST['var1'])=="") { ?> active <? } ?>">
					<a href="<?=$link?>" style="border-top:0px !important;">
					<i style="color:<?=$sysconfig[0]['cor_icone']?> !important;" class="icon-home"></i>
					<span class="title">Dashboard</span>
					</a>
				</li>
                <li class=" item_modulo  <? if(trim($_REQUEST['var1'])=="minha-conta") { ?> active <? } ?>">
					<? $chave_gerada = geraCodReturn()."/"; ?>
                    <a href="<?=$link?><?=$chave_gerada?>minha-conta/meus-dados/">
					<i class="fal fa-user"></i>
					<span class="title">Meus Dados</span>
					</a>
				</li>
                <? } else { ?>
                <li class="menu1" class="start  <? if(trim($_REQUEST['var1'])=="minha-conta") { ?> active <? } ?>">
					<? $chave_gerada = geraCodReturn()."/"; ?>
                    <a href="<?=$link?><?=$chave_gerada?>minha-conta/meus-dados/" style="border-top:0px !important;">
					<i class="fal fa-user"></i>
					<span class="title">Meus Dados</span>
					</a>
				</li>
                <? } ?>


				<?
				$cont_cat =0;
                $qSql = mysql_query("SELECT id,nome,icone,url_amigavel FROM _construtor_modulo_categoria WHERE stat='1' ORDER BY ordem");
                while($rSql = mysql_fetch_array($qSql)) {

					$nomeLimpo = transformaCaractere($rSql['nome']);

					$nCategoria=0;
					$qSqlModCont = mysql_query("SELECT numeroUnico,nome_base FROM _construtor_modulo WHERE id_construtor_modulo_categoria='".$rSql['id']."' AND stat='1' ORDER BY ordem");
					while($rSqlModCont = mysql_fetch_array($qSqlModCont)) {
						
						if(trim($_construtor_sysperm['visualizar_'.$rSqlModCont['numeroUnico'].''])==1) {
							$nCategoria++;
						}
					}

                    if($nCategoria>0) {
						$cont_cat++;

                ?>

                <!--
                <li class="heading">
                    <h3 class="uppercase"><?=$rSql['nome']?></h3>
                </li>
                -->

                <li class="start <? if(trim($_REQUEST['var1'])==$nomeLimpo) { ?>active open<? } ?>">
                    <a href="javascript:;">
						<? if(trim($rSql['icone'])=="") { } else { ?><i class="<?=$rSql['icone']?>"></i><? } ?>
                        <span class="title"><?=$rSql['nome']?></span>
                        <span class="selected"></span>
                        <span class="arrow <? if(trim($_REQUEST['var1'])==$nomeLimpo) { ?>open<? } ?>"></span>
                    </a>
                    <ul class="sub-menu">

                        <?
						$contLinha = 0;
						$cont_mod = 0;
						$qSqlMod = mysql_query("SELECT 
													id,
													numeroUnico,
													nome_base,
													icone,
													nome,
													novo,
													em_breve,
													lista_de_itens,
													lista_de_itens_tipo,
													adicionar_novo,
													categoria,
													descricao,
													seo,
													configuracoes
												FROM 
													_construtor_modulo 
												WHERE 
													id_construtor_modulo_categoria='".$rSql['id']."' AND 
													stat='1' 
												ORDER BY ordem");
                        while($rSqlMod = mysql_fetch_array($qSqlMod)) {

                            $url_mod = str_replace("_","-",$rSqlMod['nome_base']);
							
							$itemAtualEstrutura = mysql_fetch_array(mysql_query("SELECT * FROM ".$rSqlMod['nome_base']."_estrutura LIMIT 1"));
							
							$nSqlModCampo = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM _construtor_modulo_campo WHERE id_construtor_modulo='".$rSqlMod['id']."'"));
							
							$chave_gerada = geraCodReturn()."/";

							#if(trim($rSqlMod['lista_de_itens_tipo'])=="manual") { $_GET['tbLocalS'] = "".$mod.""; }

							if(trim($rSqlMod['seo'])=="1") {
								$menu_sanfona = "1";
							} else {
								if(trim($rSqlMod['descricao'])=="1") {
									$menu_sanfona = "1";
								} else {
									if(trim($rSqlMod['configuracoes'])=="1") {
										if(trim($_construtor_sysperm['config_'.$rSqlMod['numeroUnico'].''])==1||trim($_construtor_sysperm['minha_config_'.$rSqlMod['numeroUnico'].''])==1) {
											if(trim($rSqlMod['adicionar_novo'])=="1" || trim($rSqlMod['adicionar_novo'])=="1") {
												$menu_sanfona = "1";
											} else {
												$menu_sanfona = "0";
											}
										}
									} else {
										if(trim($rSqlMod['adicionar_novo'])=="1" || trim($rSqlMod['adicionar_novo'])=="1") {
											$menu_sanfona = "1";
										} else {
											$menu_sanfona = "0";
										}
									}
								}
							}
							
							$link_menu = "";
							if(trim($rSqlMod['em_breve'])=="1") {
								$link_menu = "href=\"javascript:void(0);\" onClick=\"alert('Novo módulo com lançamento em breve!');\"";
							} else {
								if($menu_sanfona=="1") {
									$link_menu = "href=\"javascript:;\"";
								} else {
									$link_menu = "href=\"javascript:url_menu_limpa('".$rSqlMod['nome_base']."','".$link."".$chave_gerada."".$nomeLimpo."/".$url_mod."/');\"";
								}
							}
                        ?>
							<? if(trim($_construtor_sysperm['visualizar_'.$rSqlMod['numeroUnico'].''])==1) { ?>
                            
                            	<? if(trim($_construtor_sysperm['visualizar_'.$rSqlMod['numeroUnico'].''])==1||
								trim($_construtor_sysperm['descricao_'.$rSqlMod['numeroUnico'].''])==1||
								trim($_construtor_sysperm['seo_'.$rSqlMod['numeroUnico'].''])==1||
								trim($_construtor_sysperm['config_'.$rSqlMod['numeroUnico'].''])==1) { ?>
									<? $contLinha++; ?>

                                    <li class="<? if(trim($_REQUEST['var1'])==$nomeLimpo&&trim($_REQUEST['var2'])==$url_mod) { ?> active<? } ?> item_modulo" >
                                        <!--<a href="javascript:;" onClick="javascript:window.open('<?=$link?><?=$nomeLimpo?>/<?=$url_mod?>/','_self','');">-->
                                        <!--<a href="javascript:;" onClick="javascript:url_menu_limpa('<?=$rSqlMod['nome_base']?>','<?=$link?><?=$chave_gerada?><?=$nomeLimpo?>/<?=$url_mod?>/');">-->
                                        <a <?=$link_menu?> <? if($contLinha==1) { ?>style="border-top:0px !important;"<? } ?>>
                                            <? if(trim($rSqlMod['icone'])=="") { } else { ?><i class="<?=$rSqlMod['icone']?>"></i><? } ?> 
                                            <span class="title"><?=$rSqlMod['nome']?> </span>
                                            <? if(trim($rSqlMod['novo'])=="1") { ?>
                                            <span style=" float: right; background-color: #0C6; padding: 3px 8px; border-radius: 30px !important; margin-right: -30px; margin-top: 0px; ">novo</span>
                                            <? } ?>
                                            <? if(trim($rSqlMod['em_breve'])=="1") { ?>
                                            <span style=" float: right; background-color: #F90; padding: 3px 8px; border-radius: 30px !important; margin-right: -30px; margin-top: 0px; ">em breve</span>
                                            <? } ?>
                                            <? if($menu_sanfona=="1") { ?>
                                            <span class="arrow <? if(trim($_REQUEST['var1'])==$nomeLimpo&&trim($_REQUEST['var2'])==$url_mod) { ?>open<? } ?>"></span>
                                            <? } ?>
                                        </a>
                                        <? if($menu_sanfona=="1") { ?>
                                        <ul class="sub-menu">
                                            <? if(trim($nSqlModCampo[0])==0) { } else { ?>
                                            <? if(trim($rSqlMod['lista_de_itens'])=="1") { ?>
                                            <li><a style="padding-left: 35px !important;" class="controle_clique_edicao" href-extra="lista" onClick="javascript:url_menu_limpa('<?=$rSqlMod['nome_base']?>','<?=$link?><?=$chave_gerada?><?=$nomeLimpo?>/<?=$url_mod?>/');">Lista de Itens</a></li>
                                            <? } ?>
    
                                            <? if(trim($rSqlMod['adicionar_novo'])=="1") { ?>
                                            <li><a style="padding-left: 35px !important;" class="controle_clique_edicao" href-extra="adicionar-novo" href="<?=$link?><?=$chave_gerada?><?=$nomeLimpo?>/<?=$url_mod?>/adicionar-novo">Adicionar Novo</a></li>
                                            <? } ?>
                                            
                                            <? } ?>
    
                                            <? if(trim($rSqlMod['categoria'])=="1") { ?>
                                            <? if(trim($itemAtualEstrutura['categoria'])==1) { ?>
                                            <li><a style="padding-left: 35px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?><?=$nomeLimpo?>/<?=$url_mod?>/categorias/">Categorias</a></li>
                                            <? } ?>
                                            <? } ?>
    
                                            <? if(trim($rSqlMod['descricao'])=="1") { ?>
                                            <? if(trim($_construtor_sysperm['descricao_'.$rSqlMod['numeroUnico'].''])==1) { ?>
                                            <? if(trim($itemAtualEstrutura['descricao'])==1) { ?>
                                            <li><a style="padding-left: 35px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?><?=$nomeLimpo?>/<?=$url_mod?>/descricao/">Descrição</a></li>
                                            <? } ?>
                                            <? } ?>
                                            <? } ?>
    
                                            <? if(trim($rSqlMod['seo'])=="1") { ?>
                                            <? if(trim($_construtor_sysperm['seo_'.$rSqlMod['numeroUnico'].''])==1) { ?>
                                            <? if(trim($itemAtualEstrutura['aba_seo'])==1) { ?>
                                            <li><a style="padding-left: 35px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?><?=$nomeLimpo?>/<?=$url_mod?>/seo/">SEO</a></li>
                                            <? } ?>
                                            <? } ?>
                                            <? } ?>
    
                                            <? if(trim($rSqlMod['configuracoes'])=="1") { ?>
                                            <? if(trim($_construtor_sysperm['config_'.$rSqlMod['numeroUnico'].''])==1||trim($_construtor_sysperm['minha_config_'.$rSqlMod['numeroUnico'].''])==1) { ?>
                                            <li><a style="padding-left: 35px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?><?=$nomeLimpo?>/<?=$url_mod?>/configuracoes/">Configurações</a></li>
                                            <? } ?>
                                            <? } ?>
    
                                        </ul>
                                        <? } ?>
                                    </li>
                                <? } else { ?>
                                    <!--
                                    <li <? if(trim($_REQUEST['var1'])==$nomeLimpo&&trim($_REQUEST['var2'])==$url_mod) { ?>class="active"<? } ?>>
                                        <a href="<?=$link?><?=$nomeLimpo?>/<?=$url_mod?>/">
                                            <? if(trim($rSqlMod['icone'])=="") { } else { ?><i class="<?=$rSqlMod['icone']?>"></i><? } ?> 
                                            <?=$rSqlMod['nome']?> 
                                        </a>
                                    </li>
                                    -->
                                <? } ?>

							<? } ?>
                        <? } ?>
                    </ul>
                </li>

					<? } ?>
                <? } ?>
                <!-- AQUI TERMINA O NOVO MENU -->

                <li class=" item_modulo">
					<a href="javascript:void(0);" onClick="javascript:logout();">
					<i style="background-color:#C00 !important;color:#FFF !important;" class="fal fa-power-off"></i>
					<span class="title">Sair do Sistema</span>
					</a>
				</li>



					<? $chave_gerada = geraCodReturn()."/"; ?>
                    <? if(trim(
                                $_construtor_sysperm['visualizar_sysusu'])==1||
                           trim($_construtor_sysperm['visualizar_sysacesso'])==1||
                           trim($_construtor_sysperm['visualizar_syslog'])==1||
                           trim($_construtor_sysperm['visualizar_sysgrupousuario'])==1||
                           trim($_construtor_sysperm['visualizar_sysconfig'])==1
                    ) { ?>
                    <li class="heading">
                        <h3 class="uppercase">Sistema</h3>
                    </li>
    
                            <? if(trim($_construtor_sysperm['visualizar_sysusu'])==1) { ?>
                            <li class="item_modulo <? if(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="usuarios") { ?> active <? } ?>">
                                <a href="javascript:;" style="border-top:0px !important;" >
                                    <i class="fa fa-user"></i> 
                                    <span class="title">Usuários</span> 
                                    <span class="arrow <? if(trim($_REQUEST['var1'])=="sistema"&&(trim($_REQUEST['var2'])=="usuarios")) {?>open<? } ?>"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a style="padding-left: 35px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>sistema/usuarios/" href-extra="lista">Lista de Itens</a></li>
                                    <li><a style="padding-left: 35px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>sistema/usuarios/#adicionar-novo" href-extra="adicionar-novo">Adicionar Novo</a></li>
                                    <li><a style="padding-left: 35px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>sistema/usuarios/categorias/">Categorias</a></li>
                                </ul>
                            </li>
    
                            <? } ?>
                            <? if(trim($_construtor_sysperm['visualizar_sysgrupousuario'])==1) { ?><li class="item_modulo <? if(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="grupos-de-permissoes") { ?> active <? } ?>"><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>sistema/grupos-de-permissoes/"><i class="fa fa-users"></i> <span class="title">Grupos de Permissões</span></a></li><? } ?>
                            <? if(trim($_construtor_sysperm['visualizar_sysconfig'])==1) { ?><li class="item_modulo <? if(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="configuracoes") { ?> active <? } ?>"><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>sistema/configuracoes/"><i class="fa fa-cogs"></i> <span class="title">Configurações</span></a></li><? } ?>
    
                            <? if(trim($_construtor_sysperm['visualizar_sysacesso'])==1 || trim($_construtor_sysperm['visualizar_syslog'])==1) { ?>
                            <li class="item_modulo <? if(trim($_REQUEST['var1'])=="sistema"&& (trim($_REQUEST['var2'])=="historico-de-acessos" || trim($_REQUEST['var2'])=="historico-de-operacoes")) { ?> active <? } ?>">
                                <a href="javascript:;">
                                    <i class="fa fa-user"></i> 
                                    <span class="title">Logs </span>
                                    <span class="arrow <? if(trim($_REQUEST['var1'])=="sistema"&&(trim($_REQUEST['var2'])=="historico-de-acessos" || trim($_REQUEST['var2'])=="historico-de-operacoes")) {?>open<? } ?>"></span>
                                </a>
                                <ul class="sub-menu">
                                    <? if(trim($_construtor_sysperm['visualizar_sysacesso'])==1) { ?><li <? if(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="historico-de-acessos") { ?>class="active"<? } ?>><a style="padding-left: 35px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>sistema/historico-de-acessos/"><i class="fa fa-key"></i> Histórico de Acessos</a></li><? } ?>
                                    <? if(trim($_construtor_sysperm['visualizar_syslog'])==1) { ?><li <? if(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="historico-de-operacoes") { ?>class="active"<? } ?>><a style="padding-left: 35px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>sistema/historico-de-operacoes/"><i class="fa fa-flag-checkered"></i> Histórico de Operações</a></li><? } ?>
                                </ul>
                            </li>
                            <? } ?>
    
                    <? } ?>


					<? if(
                      trim($_construtor_sysperm['visualizar_construtor_modulo'])==1
                    ||trim($_construtor_sysperm['visualizar_construtor_modulo_campo'])==1
                    ||trim($_construtor_sysperm['visualizar_construtor_modulo_funcao'])==1
                    ) { ?>
    
    
                    <li class="heading">
                        <h3 class="uppercase">Construtor</h3>
                    </li>
    
                            <? $chave_gerada = geraCodReturn()."/"; ?>
                            <? if(trim($_construtor_sysperm['visualizar_construtor_modulo'])==1) { ?>
                            <li  class="item_modulo <? if(trim($_REQUEST['var1'])=="construtor"&&trim($_REQUEST['var2'])=="modulos") { ?> active<? } ?>">
                                <a href="javascript:;" style="border-top:0px !important;" >
                                    <i class="fa fa-database"></i> 
                                    <span class="title">Módulos </span>
                                    <span class="arrow <? if(trim($_REQUEST['var1'])=="construtor"&&(trim($_REQUEST['var2'])=="modulos")) {?>open<? } ?>"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a style="padding-left: 35px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>construtor/modulos/" href-extra="lista">Lista de Itens</a></li>
                                    <li><a style="padding-left: 35px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>construtor/modulos/#adicionar-novo" href-extra="adicionar-novo">Adicionar Novo</a></li>
                                    <li><a style="padding-left: 35px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>construtor/modulos/categorias/">Categorias</a></li>
                                </ul>
                            </li>
                            <? } ?>
    
                            <? if(trim($_construtor_sysperm['visualizar_construtor_modulo_campo'])==1) { ?>
                            
                            <?
                            $qSqlModCat = mysql_query("SELECT id,icone,nome,url_amigavel FROM _construtor_modulo_categoria WHERE  stat='1' ORDER BY ordem");
                            while($rSqlModCat = mysql_fetch_array($qSqlModCat)) {
                                $nSqlMod = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM _construtor_modulo WHERE  stat='1' AND id_construtor_modulo_categoria='".$rSqlModCat['id']."' ORDER BY ordem"));
                                if($nSqlMod[0]==0) { } else {
                            ?>
                            <li class="item_modulo start <? if(trim($_REQUEST['var1'])=="construtor"&&trim($_REQUEST['var2'])=="".$rSqlModCat['url_amigavel']."") {  ?> active  open<? } ?>">
                                <a href="javascript:;">
                                <? if(trim($rSqlModCat['icone'])=="") { } else { ?><i class="<?=$rSqlModCat['icone']?>"></i><? } ?>
                                <span class="title"><?=$rSqlModCat['nome']?> </span>
                                <span class="arrow <? if(trim($_REQUEST['var1'])=="construtor"&&trim($_REQUEST['var2'])=="".$rSqlModCat['url_amigavel']."") { ?>open<? } ?>"></span>
                                </a>
                                <ul class="sub-menu">
                                    <?
									$qSqlMod = mysql_query("SELECT 
																id,
																numeroUnico,
																nome_base,
																icone,
																nome,
																novo,
																em_breve,
																lista_de_itens,
																lista_de_itens_tipo,
																adicionar_novo,
																categoria,
																descricao,
																seo,
																configuracoes
															FROM 
																_construtor_modulo 
															WHERE 
																id_construtor_modulo_categoria='".$rSqlModCat['id']."' AND 
																stat='1' 
															ORDER BY ordem");
                                    while($rSqlMod = mysql_fetch_array($qSqlMod)) {
                                        $chave_gerada = geraCodReturn()."/";
                                    ?>
        
                                        <li <? if(trim($_REQUEST['var1'])=="construtor"&&trim($_REQUEST['var2'])=="".$rSqlModCat['url_amigavel'].""&&trim($_REQUEST['var4'])=="".$rSqlMod['nome_base']."") { ?>class="active"<? } ?>>
                                            <a style="padding-left: 35px !important;" href="javascript:;">
                                                <? if(trim($rSqlMod['icone'])=="") { } else { ?><i class="<?=$rSqlMod['icone']?>"></i><? } ?> 
                                                <?=$rSqlMod['nome']?> 
                                                <span class="arrow <? if(trim($_REQUEST['var1'])=="construtor"&&trim($_REQUEST['var2'])=="".$rSqlModCat['url_amigavel'].""&&trim($_REQUEST['var4'])=="".$rSqlMod['nome_base']."") { ?>open<? } ?>"></span>
                                            </a>
                                            <ul class="sub-menu">
    
                                                <li>
                                                    <a style="padding-left: 56px !important;" href="javascript:;">
                                                        - Campos 
                                                        <span class="arrow "></span>
                                                    </a>
                                                    <ul class="sub-menu">
                                                        <li <? if(trim($_REQUEST['var1'])=="construtor"&&trim($_REQUEST['var2'])=="".$rSqlModCat['url_amigavel'].""&&trim($_REQUEST['var3'])=="abas-do-modulo"&&trim($_REQUEST['var4'])=="".$rSqlMod['nome_base']."") { ?>class="active"<? } ?>><a style="padding-left: 57px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>construtor/<?=$rSqlModCat['url_amigavel']?>/abas-do-modulo/<?=$rSqlMod['nome_base']?>/">Abas Internas do Módulo</a></li>
                
                                                        <li <? if(trim($_REQUEST['var1'])=="construtor"&&trim($_REQUEST['var2'])=="".$rSqlModCat['url_amigavel'].""&&trim($_REQUEST['var3'])=="campos-do-modulo"&&trim($_REQUEST['var4'])=="".$rSqlMod['nome_base']."") { ?>class="active"<? } ?>><a style="padding-left: 57px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>construtor/<?=$rSqlModCat['url_amigavel']?>/campos-do-modulo/<?=$rSqlMod['nome_base']?>/">Campos do Módulo</a></li>
            
                                                        <? 
                                                        $nSqlAba = mysql_num_rows(mysql_query("SELECT * FROM _construtor_modulo_aba WHERE id_construtor_modulo='".$rSqlMod['id']."' AND stat='1'")); 
                                                        if($nSqlAba==0) { } else {
                                                        ?>
                                                        <li <? if(trim($_REQUEST['var1'])=="construtor"&&trim($_REQUEST['var2'])=="".$rSqlModCat['url_amigavel'].""&&trim($_REQUEST['var3'])=="organizacao-do-modulo"&&trim($_REQUEST['var4'])=="".$rSqlMod['nome_base']."") { ?>class="active"<? } ?>><a style="padding-left: 57px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>construtor/<?=$rSqlModCat['url_amigavel']?>/organizacao-do-modulo/<?=$rSqlMod['nome_base']?>/">Organização do Módulo</a></li>
                                                        <? } ?>
            
                                                        <? if(trim($_construtor_sysperm['visualizar_construtor_modulo_funcao'])==1) { ?>
                                                        <li <? if(trim($_REQUEST['var1'])=="construtor"&&trim($_REQUEST['var2'])=="".$rSqlModCat['url_amigavel'].""&&trim($_REQUEST['var3'])=="funcoes-do-modulo"&&trim($_REQUEST['var4'])=="".$rSqlMod['nome_base']."") { ?>class="active"<? } ?>><a style="padding-left: 57px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>construtor/<?=$rSqlModCat['url_amigavel']?>/funcoes-do-modulo/<?=$rSqlMod['nome_base']?>/">Funções do Módulo</a></li>
                                                        <? } ?>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a style="padding-left: 56px !important;" href="javascript:;">
                                                        - Descrição 
                                                        <span class="arrow "></span>
                                                    </a>
                                                    <ul class="sub-menu">
                                                        <li <? if(trim($_REQUEST['var1'])=="construtor"&&trim($_REQUEST['var2'])=="".$rSqlModCat['url_amigavel'].""&&trim($_REQUEST['var3'])=="abas-do-modulo-descricao"&&trim($_REQUEST['var4'])=="".$rSqlMod['nome_base']."") { ?>class="active"<? } ?>><a style="padding-left: 57px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>construtor/<?=$rSqlModCat['url_amigavel']?>/abas-do-modulo-descricao/<?=$rSqlMod['nome_base']?>/">Abas da Descrição</a></li>
                
                                                        <li <? if(trim($_REQUEST['var1'])=="construtor"&&trim($_REQUEST['var2'])=="".$rSqlModCat['url_amigavel'].""&&trim($_REQUEST['var3'])=="campos-do-modulo-descricao"&&trim($_REQUEST['var4'])=="".$rSqlMod['nome_base']."") { ?>class="active"<? } ?>><a style="padding-left: 57px !important;" class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>construtor/<?=$rSqlModCat['url_amigavel']?>/campos-do-modulo-descricao/<?=$rSqlMod['nome_base']?>/">Campos da Descrição</a></li>
            
                                                        <? 
                                                        $nSqlAba = mysql_num_rows(mysql_query("SELECT * FROM _descricao_modulo_aba WHERE id_construtor_modulo='".$rSqlMod['id']."' AND stat='1'")); 
                                                        if($nSqlAba==0) { } else {
                                                        ?>
                                                        <li <? if(trim($_REQUEST['var1'])=="construtor"&&trim($_REQUEST['var2'])=="".$rSqlModCat['url_amigavel'].""&&trim($_REQUEST['var3'])=="organizacao-do-modulo-descricao"&&trim($_REQUEST['var4'])=="".$rSqlMod['nome_base']."") { ?>class="active"<? } ?>><a style="padding-left: 57px !important;" class="controle_clique_edicao" 
                                                        href="<?=$link?><?=$chave_gerada?>construtor/<?=$rSqlModCat['url_amigavel']?>/organizacao-do-modulo-descricao/<?=$rSqlMod['nome_base']?>/">Organização da Descrição</a></li>
                                                        <? } ?>
            
                                                    </ul>
                                                </li>
        
                                            </ul>
                                        </li>
        
                                    <? } ?>
                                </ul>
                            </li>
                            <? } } ?>
    
                            <? } ?>
    
                    <? } ?>


					<? if(trim($_construtor_sysperm['visualizar_layout_layout'])==1||trim($_construtor_sysperm['visualizar_layout_topo'])==1||trim($_construtor_sysperm['visualizar_layout_menu'])==1||trim($_construtor_sysperm['visualizar_layout_inicial'])==1||trim($_construtor_sysperm['visualizar_layout_rodape'])==1||trim($_construtor_sysperm['visualizar_layout_paginas_de_home'])==1||trim($_construtor_sysperm['visualizar_layout_paginas_interna'])==1) { ?>
                    <li class="start 
                        <? if(trim($_REQUEST['var1'])=="design"&&(
                              trim($_REQUEST['var2'])=="layout"
                            ||trim($_REQUEST['var2'])=="topo"
                            ||trim($_REQUEST['var2'])=="menu"
                            ||trim($_REQUEST['var2'])=="inicial"
                            ||trim($_REQUEST['var2'])=="rodape"
                            ||trim($_REQUEST['var2'])=="paginas-de-home"
                            ||trim($_REQUEST['var2'])=="paginas-interna"
                            )) {
                                ?>
                                active  open<? } ?>">
                            <a href="javascript:;">
                            <i class="fa fa-desktop"></i>
                            <span class="title">Design</span>
                            <span class="selected"></span>
                            <span class="arrow 
                            <? if(trim($_REQUEST['var1'])=="design"&&(
                                  trim($_REQUEST['var2'])=="layout"
                                ||trim($_REQUEST['var2'])=="topo"
                                ||trim($_REQUEST['var2'])=="menu"
                                ||trim($_REQUEST['var2'])=="inicial"
                                ||trim($_REQUEST['var2'])=="rodape"
                                ||trim($_REQUEST['var2'])=="paginas-de-home"
                                ||trim($_REQUEST['var2'])=="paginas-interna"
                                )) {
                                    ?>
                            open<? } ?>"></span>
                            </a>
                            <ul class="sub-menu item_modulo_submenu">
        
                                <li class="item_modulo  <? if(trim($_REQUEST['var1'])=="design"&&trim($_REQUEST['var2'])=="layout")  { ?> active <? } ?>">
                                    <a href="javascript:;">
                                        <i class="fa fa-magic"></i> 
                                        Layout 
                                        <span class="arrow <? if(trim($_REQUEST['var1'])=="design"&&(trim($_REQUEST['var2'])=="layout")) {?>open<? } ?>"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/layout/" href-extra="lista">Lista de Itens</a></li>
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/layout/#adicionar-novo" href-extra="adicionar-novo">Adicionar Novo</a></li>
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/layout/configuracoes/">Configuração</a></li>
                                    </ul>
                                </li>
        
                                <li class="item_modulo  <? if(trim($_REQUEST['var1'])=="design"&&trim($_REQUEST['var2'])=="topo")  { ?> active <? } ?>">
                                    <a href="javascript:;">
                                        <i class="fa fa-level-up"></i> 
                                        Topo 
                                        <span class="arrow <? if(trim($_REQUEST['var1'])=="design"&&(trim($_REQUEST['var2'])=="topo")) {?>open<? } ?>"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/topo/" href-extra="lista">Lista de Itens</a></li>
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/topo/#adicionar-novo" href-extra="adicionar-novo">Adicionar Novo</a></li>
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/topo/configuracoes/">Configuração</a></li>
                                    </ul>
                                </li>
        
                                <li class="item_modulo  <? if(trim($_REQUEST['var1'])=="design"&&trim($_REQUEST['var2'])=="menu")  { ?> active <? } ?>">
                                    <a href="javascript:;">
                                        <i class="fa fa-server"></i> 
                                        Menu 
                                        <span class="arrow <? if(trim($_REQUEST['var1'])=="design"&&(trim($_REQUEST['var2'])=="menu")) {?>open<? } ?>"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/menu/" href-extra="lista">Lista de Itens</a></li>
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/menu/#adicionar-novo" href-extra="adicionar-novo">Adicionar Novo</a></li>
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/menu/configuracoes/">Configuração</a></li>
                                    </ul>
                                </li>
        
                                <li class="item_modulo  <? if(trim($_REQUEST['var1'])=="design"&&trim($_REQUEST['var2'])=="inicial")  { ?> active <? } ?>">
                                    <a href="javascript:;">
                                        <i class="fa fa-home"></i> 
                                        Página inicial 
                                        <span class="arrow <? if(trim($_REQUEST['var1'])=="design"&&(trim($_REQUEST['var2'])=="inicial")) {?>open<? } ?>"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/inicial/" href-extra="lista">Lista de Itens</a></li>
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/inicial/#adicionar-novo" href-extra="adicionar-novo">Adicionar Novo</a></li>
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/inicial/configuracoes/">Configuração</a></li>
                                    </ul>
                                </li>
        
                                <li class="item_modulo  <? if(trim($_REQUEST['var1'])=="design"&&trim($_REQUEST['var2'])=="rodape")  { ?> active <? } ?>">
                                    <a href="javascript:;">
                                        <i class="fa fa-level-down"></i> 
                                        Rodapé 
                                        <span class="arrow <? if(trim($_REQUEST['var1'])=="design"&&(trim($_REQUEST['var2'])=="rodape")) {?>open<? } ?>"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/rodape/" href-extra="lista">Lista de Itens</a></li>
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/rodape/#adicionar-novo" href-extra="adicionar-novo">Adicionar Novo</a></li>
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/rodape/configuracoes/">Configuração</a></li>
                                    </ul>
                                </li>
        
                                <li class="item_modulo <? if(trim($_REQUEST['var1'])=="design"&&trim($_REQUEST['var2'])=="paginas-de-home")  { ?> active <? } ?>">
                                    <a href="javascript:;">
                                        <i class="fa fa-leanpub"></i> 
                                        Páginas de Home 
                                        <span class="arrow <? if(trim($_REQUEST['var1'])=="design"&&(trim($_REQUEST['var2'])=="paginas-de-home")) {?>open<? } ?>"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/paginas-de-home/" href-extra="lista">Lista de Itens</a></li>
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/paginas-de-home/#adicionar-novo" href-extra="adicionar-novo">Adicionar Novo</a></li>
                                    </ul>
                                </li>
        
                                <li class="item_modulo  <? if(trim($_REQUEST['var1'])=="design"&&trim($_REQUEST['var2'])=="paginas-interna")  { ?> active <? } ?>">
                                    <a href="javascript:;">
                                        <i class="fa fa-columns"></i> 
                                        Páginas Interna 
                                        <span class="arrow <? if(trim($_REQUEST['var1'])=="design"&&(trim($_REQUEST['var2'])=="paginas-interna")) {?>open<? } ?>"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/paginas-interna/" href-extra="lista">Lista de Itens</a></li>
                                        <li><a class="controle_clique_edicao" href="<?=$link?><?=$chave_gerada?>design/paginas-interna/#adicionar-novo" href-extra="adicionar-novo">Adicionar Novo</a></li>
                                    </ul>
                                </li>
        
                            </ul>
                    </li>
                    <? } ?>

                <? } ?>

			</ul>
			<!-- END SIDEBAR MENU -->

		</div>
	</div>
	<!-- END SIDEBAR -->

	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<? if(trim($escondeHeader)=="1") { } else { ?>
				<? if(trim($_REQUEST['var1'])=="") { } else { ?>
                    <!-- BEGIN PAGE HEADER-->
                    <? if((
                           (
                            trim($_REQUEST['var1'])=="eventos" && 
                            trim($_REQUEST['var3'])!="" &&
                            trim($_REQUEST['var2'])=="editar"
                           ) || 
                           (
                            trim($_REQUEST['var1'])=="eventos" && 
                            trim($_REQUEST['var2'])=="novo"
                           )
                          ) || 
                         trim($_REQUEST['var3'])=="novo" || 
                         trim($_REQUEST['var3'])=="editar") { ?>
                    <div class="col-md-12" style="padding-right:0px;padding-left:0px;">
                    <? } else { ?>
                    <div class="col-md-8" style="padding-right:0px;padding-left:0px;">
                    <? } ?>
                        <h3 class="page-title">
                        <?=$caminho1?>
                            <? if((
                                   (
                                    trim($_REQUEST['var1'])=="eventos" && 
                                    trim($_REQUEST['var3'])!="" &&
                                    trim($_REQUEST['var2'])=="editar"
                                   ) || 
                                   (
                                    trim($_REQUEST['var1'])=="eventos" && 
                                    trim($_REQUEST['var2'])=="novo"
                                   )
                                  ) || 
                                 trim($_REQUEST['var3'])=="novo" || 
                                 trim($_REQUEST['var3'])=="editar") { ?>
                            <style>.btn_voltar_lista { background-color:#169ef4;color:#FFF;text-align:center;float:right; } .btn_voltar_lista:hover { background-color:#0974b7;color:#FFF; }</style>
                            <? if(trim($_REQUEST['var1'])=="eventos" && trim($_REQUEST['var2'])=="novo") { ?>
                            <a class="btn input-label btn_voltar_lista" href="<?=$link?><?=geraCodReturn()?>/<?=$_REQUEST['var1']?>/editar/"><?=$btn_voltar_lista?></a>
                            <? } else { ?>
                            <a class="btn input-label btn_voltar_lista" href="<?=$link?><?=geraCodReturn()?>/<?=$_REQUEST['var1']?>/<?=$_REQUEST['var2']?>/"><?=$btn_voltar_lista?></a>
                            <? } ?>
                            <? }?>
                        </h3>
                    </div>
                    <!-- END PAGE HEADER-->
                    <? if((
                           (
                            trim($_REQUEST['var1'])=="eventos" && 
                            trim($_REQUEST['var3'])!="" &&
                            trim($_REQUEST['var2'])=="editar"
                           ) || 
                           (
                            trim($_REQUEST['var1'])=="eventos" && 
                            trim($_REQUEST['var2'])=="novo"
                           )
                          ) || 
                         trim($_REQUEST['var3'])=="novo" || 
                         trim($_REQUEST['var3'])=="editar") { } else { ?>
                        <?
                        $nSqlVideo = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM videos_tutoriais WHERE numeroUnico_modulo='".$sysmod['numeroUnico']."'"));
                        if($nSqlVideo[0]>0) {
                        ?>
                        <style>
                        .btn_tutoriais {
                            float:right;
                        }
                        @media (max-width: 650px) {
                            .btn_tutoriais {
                                margin-top:10px;
                                float:none;
                            }
                        }
                        </style>
                        <div class="col-md-4" style="padding-right:0px;padding-left:0px;">
                            <div class="btn-group btn_tutoriais">
                                <a class="btn red btn-outline" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fal fa-video"></i>
                                    <span> Tutoriais </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <?
                                    $qSqlVideosTutoriais = mysql_query("
                                                            SELECT 
                                                                mod_videos.nome,
                                                                mod_videos.link
                                                                 
                                                            FROM 
                                                                videos_tutoriais AS mod_videos 
                                                            WHERE
                                                                mod_videos.stat='1' ".$filtro["mod_videos"]."
                                                            ORDER BY 
                                                                mod_videos.nome");
                                    while($rSqlVideosTutoriais = mysql_fetch_array($qSqlVideosTutoriais)) {
                                    ?>
                                    <li><a href="<?=$rSqlVideosTutoriais['link']?>" target="_blank" class="controle_clique_edicao"><?=$rSqlVideosTutoriais['nome']?></a></li>
                                    <? } ?>
                                </ul>
                            </div>
                        </div>
                        <? } ?>
                    <? } ?>
                <? } ?>
			<? } ?>

			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<? if(trim($pagina)=="") { } else { include("templates/".$layout_padrao_set."/".$pagina.""); } ?>
            </div>

			<div class="clearfix">
			</div>


		</div>
	</div>
	<!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 &copy; <a href="<?=$siteRodape?>" target="_blank"><?=$nomeRodape?></a> <?=date("Y");?> 
	</div>
    <a style="float:right;margin-right:10px;" href="javascript:void(0);" onClick="javascript:location.reload();">RECARREGAR</a>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->


<? include("templates/".$layout_padrao_set."/footer_2.php"); ?>

</body>
<!-- END BODY -->
</html>