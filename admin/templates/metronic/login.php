<!DOCTYPE html>
<!-- saved from url=(0076)https://keenthemes.com/metronic/preview/demo6/custom/pages/user/login-3.html -->
<html lang="en">
<!-- begin::Head -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<? $link = str_replace("http://","//",$link); ?>
    
    <!--favicon::Admin -->
    <?=$faviconAdmin?>
    
    <title><?=$tituloSeo?></title>
    <meta name="description" content="Sistema Administrativo <?=$nomeRodape?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/novo_login/css">        <!--end::Fonts -->

    
    <!--begin::Page Custom Styles(used by this page) -->
    <link href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/novo_login/login-3.css" rel="stylesheet" type="text/css">
    <!--end::Page Custom Styles -->
    
    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/novo_login/plugins.bundle.css" rel="stylesheet" type="text/css">
    <link href="<?=$link?>templates/<?=$layout_padrao_set?>/assets/novo_login/style.bundle.css" rel="stylesheet" type="text/css">
    <!--end::Global Theme Styles -->
    
    <!--begin::Layout Skins(used by all pages) -->
    <!--end::Layout Skins -->

</head>
    <!-- end::Head -->

    <!-- begin::Body -->
    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-aside--minimize">

       
    <!-- begin:: Page -->
	<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
		<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
	<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(<?=$link?>templates/<?=$layout_padrao_set?>/assets/images/bg-3.jpg);">
		<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
			<div class="kt-login__container">
				<div class="kt-login__logo">
					<a href=""><?=$logotipoAdmin?></a>
				</div>
				<div class="kt-login__signin">
					<div class="kt-login__head">
						<h3 class="kt-login__title">Faça seu login</h3>
					</div>
					<?
                    $link_form = $link; 
                    if(trim($_REQUEST['raiz'])=="admin") { 
                        $perfilSet = "admin";
                        $link_form = $link_form;
                    } else if(trim($_REQUEST['raiz'])=="admin-pdv") { 
                        $perfilSet = "pdv";
                        $link_form = str_replace("admin/","admin-pdv/",$link_form);
                    } else if(trim($_REQUEST['raiz'])=="admin-promoter") { 
                        $perfilSet = "admin";
                        $link_form = str_replace("admin/","admin-promoter/",$link_form);
                    } else if(trim($_REQUEST['raiz'])=="admin-comissario") { 
                        $perfilSet = "comissario";
                        $link_form = str_replace("admin/","admin-comissario/",$link_form);
                    }
                    ?>
					<form class="kt-form" action="<?=$link_form?>" method="post">
                        <input type="hidden" name="acaoForm" value="login">
                        <input type="hidden" name="url_retorno" value="<?=$link_form?>">
                        <input type="hidden" name="perfil" value="<?=$perfilSet?>">
						<div class="input-group">
							<? if(trim($_REQUEST['raiz'])=="admin-comissario") { ?>
                            <input class="form-control" type="text" placeholder="CPF" name="cpf" autocomplete="off">
                            <? } else { ?>
                            <input class="form-control" type="text" placeholder="Login" name="email" autocomplete="off">
                            <? } ?>
						</div>
						<div class="input-group">
							<input class="form-control" type="password" placeholder="Senha" name="senha">
						</div>
						<div class="row kt-login__extra">
							<div class="col">
								<label class="kt-checkbox">
									<input type="checkbox" name="remember"> Lembrar-me
									<span></span>
								</label>
							</div>
							<div class="col kt-align-right">
								<a href="javascript:;" id="kt_login_forgot" class="kt-login__link">Esqueceu sua senha ?</a>
							</div>
						</div>
						<div class="kt-login__actions">
							<button type="submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Entrar</button>
						</div>
					</form>
				</div>
				<div class="kt-login__forgot">
					<div class="kt-login__head">
						<h3 class="kt-login__title">Esqueceu sua senha ?</h3>
						<div class="kt-login__desc">Digite seu login para receber sua senha no e-mail cadastrado:</div>
					</div>
					<form class="kt-form"  action="<?=$link?>" method="post">
                        <input type="hidden" name="acaoForm" value="esqueci-senha">
						<div class="input-group">
							<input class="form-control" type="text" placeholder="Login" name="email" id="kt_email" autocomplete="off">
						</div>
						<div class="kt-login__actions">
							<button type="submit" id="kt_login_forgot_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Solicitar</button>&nbsp;&nbsp;
							<button id="kt_login_forgot_cancel" class="btn btn-light btn-elevate kt-login__btn-secondary">Cancelar</button>
						</div>
					</form>
				</div>
			</div>	
		</div>
	</div>
</div>	
	</div>
	
<!-- end:: Page -->


<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
var KTAppOptions = {"colors":{"state":{"brand":"#22b9ff","light":"#ffffff","dark":"#282a3c","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
</script>
<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="<?=$link?>templates/<?=$layout_padrao_set?>/assets/novo_login/plugins.bundle.js" type="text/javascript"></script>
<script src="<?=$link?>templates/<?=$layout_padrao_set?>/assets/novo_login/scripts.bundle.js" type="text/javascript"></script>
<!--end::Global Theme Bundle -->


<!--begin::Page Scripts(used by this page) -->
<script src="<?=$link?>templates/<?=$layout_padrao_set?>/assets/novo_login/login-general.js" type="text/javascript"></script>
<!--end::Page Scripts -->

<!-- end::Body -->

</body></html>