<!DOCTYPE html>
<html dir="ltr">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <meta name="referrer" content="origin">
    <!--<meta http-equiv="Content-Security-Policy" content="default-src 'self' data: gap: https://*.googletagmanager.com/ https://*.google.com/ https://*.jsdelivr.net/ https://*.googleapis.com/ https://*.fontawesome.com/ https://*.gstatic.com 'unsafe-eval'; 
    style-src 'self' 'unsafe-inline' https://fonts.googleapis.com/ https://*.fontawesome.com/ https://*.jsdelivr.net/ https://*.google.com/ https://*.googletagmanager.com/; media-src *; img-src 'self' data: content:; ">-->
    
	<? if(trim($meta_description)=="") { $meta_description = $configuracoes_site['texto_seo']; } ?>
    <? if(trim($meta_description)=="") { } else { ?>
    <meta name="description" content="<?=$meta_description?>">
    <? } ?>
    
    <meta name="author" content="SAGUARO Comunicação - Empresa de desenvolvimento de aplicativos móveis, desenvolvimento web e sistemas desktops">

    <!--Favicon -->
    <? if(trim($configuracoes_site['favicon'])=="") { } else { ?>
    <link rel="icon" type="image/ico" href="<?=$link?>files/site/<?=$configuracoes_site['numeroUnico']?>/<?=$configuracoes_site['favicon']?>">
    <? } ?>

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?=$link_modelo?>templates/<?=$pasta_template?>/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=$link_modelo?>templates/<?=$pasta_template?>/css/style.css?<?php echo time(); ?>" type="text/css" />
	<link rel="stylesheet" href="<?=$link_modelo?>templates/<?=$pasta_template?>/css/dark.css" type="text/css" />
	<link rel="stylesheet" href="<?=$link_modelo?>templates/<?=$pasta_template?>/css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?=$link_modelo?>templates/<?=$pasta_template?>/css/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?=$link_modelo?>templates/<?=$pasta_template?>/css/magnific-popup.css" type="text/css" />
    <link rel="stylesheet" href="<?=$link_modelo?>templates/<?=$pasta_template?>/css/swiper.css" type="text/css" />
    <link rel="stylesheet" href="<?=$link_modelo?>templates/<?=$pasta_template?>/css/pogoslider.css" type="text/css" />

	<link rel="stylesheet" href="<?=$link_modelo?>templates/<?=$pasta_template?>/css/custom.css?<?php echo time(); ?>" type="text/css" />
	<? if(trim($pagina)=="evento-mapa.php") { ?>
    <link rel="stylesheet" href="<?=$link_modelo?>mapa/css/image-map-pro.min.css">
    <? } ?>

	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title ============================================= -->
	<title><?=$titulo_seo?></title> 

	<? 
    if(trim($pagina)=="inicial.php") {
        $url_canonical = "https:".$link_modelo."";   	
    } else if(trim($pagina)=="404.php") {
        $url_canonical = "";   	
    } else {
        $url_canonical = "https:".$link_modelo."".$_REQUEST['var1']."/";   	
    }

    if(trim($url_canonical)=="") { } else { ?>
    <link rel="canonical" href="<?=$url_canonical?>"/>
    <? } ?>

    <?
	if(trim($rSqlItem['nome'])=="") {
		$rSqlItem['nome'] = "".$configuracoes_site['nome']."";
	}
	?>
    <meta property="og:title" content="<?=$rSqlItem['nome']?>" />

	<? if(trim($rSqlItem['detalhe'])=="") { $og_description = $configuracoes_site['texto_seo']; } else { $og_description = substr(strip_tags($rSqlItem['detalhe']),0,150); } ?>
    <? if(trim($og_description)=="") { } else { ?>
    <meta property="og:description" content="<?=$og_description?>" />
    <? } ?>

    <? 
	$urlImg = "".$link."files/site/".$configuracoes_site['numeroUnico']."/".$configuracoes_site['favicon']."";

    if(trim($_REQUEST['var3'])=="") {
		if(trim($_REQUEST['var2'])=="") {
			if(trim($_REQUEST['var1'])=="") {
				$urlOg = "".$link_modelo."";
			} else {
				$urlOg = "".$link_modelo."".$_REQUEST['var1']."";
			}
		} else {
			$urlOg = "".$link_modelo."".$_REQUEST['var1']."/".$_REQUEST['var2']."/";
		}
	} else {
		$urlOg = "".$link_modelo."".$_REQUEST['var1']."/".$_REQUEST['var2']."/".$_REQUEST['var3']."/";
	}

    if(trim($urlImg)=="") { } else {
    ?>
    <meta property="og:image" content="<?=$urlImg?>" />
    <link rel="image_src" href="<?=$urlImg?>" />
    <? } ?>
    <meta property="og:url" content="https:<?=$urlOg?>" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="article" />

	<style>
	body, label, .button.button-desc {
		font-family: '<?=$configuracoes_site['fonte_body']?>', sans-serif !important;
	}
	p {
		font-family: '<?=$configuracoes_site['fonte_p']?>', sans-serif !important;
	}
	.menu-link {
		font-family: '<?=$configuracoes_site['fonte_menu']?>', sans-serif !important;
	}
	<? for ($i = 1; $i <= 6; $i++) { ?>
	h<?=$i?> {
		font-family: '<?=$configuracoes_site['fonte_h'.$i.'']?>', sans-serif !important;
	}
	<? } ?>
	#page-title {
		position: relative;
		padding: 2rem 0 !important;
		background-color: #F5F5F5;
		border-bottom: 1px solid #EEE;
	}

	.si-sticky {
		top: 25% !important;
	}
	.menu-mobile-logado {
		display: none !important;
	}
	.menu-desktop-logado {
		display: block !important;
	}
    @media (max-width: 768px) {
		.col-50-mobile {
			width:50% !important;
		}
		.menu-mobile-logado {
			display: block !important;
		}
		.menu-desktop-logado {
			display: none !important;
		}
    }
    </style>
    
	<? if(trim($rSqlEmpresaConfig['id_analytics'])!="") { ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?=$rSqlEmpresaConfig['id_analytics']?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '<?=$rSqlEmpresaConfig['id_analytics']?>');
    </script>
    <? } ?>

    <? if(trim($rSqlEmpresaConfig['id_tag_manager'])!="") { ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?=$rSqlEmpresaConfig['id_tag_manager']?>');</script>
    <!-- End Google Tag Manager -->
    <? } ?>

    <? if(trim($rSqlEmpresaConfig['google_site_verification'])!="") { ?>
    <meta name="google-site-verification" content="<?=$rSqlEmpresaConfig['google_site_verification']?>">
    <? } ?>

    <? if(trim($rSqlEmpresaConfig['facebook_verification'])!="") { ?>
	<meta name="facebook-domain-verification" content="<?=$rSqlEmpresaConfig['facebook_verification']?>" />
    <? } ?>
	
	<? if(trim($rSqlEmpresaConfig['facebook_pixel_code'])!="") { ?>
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '<?=$rSqlEmpresaConfig['facebook_pixel_code']?>');

	<? if($pagina=="carrinho.php") { ?>
	fbq('track', 'Purchase',
	  // begin parameter object data
	  {
		currency: 'BRL',
		contents: [
			<?
			$total = 0;
		    $carrinhoDetalhadoArray = unserialize($_SESSION['carrinho_detalhado_'.$_SESSION['numeroUnico_carrinho'].'']);
		    $carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'numeroUnico_lote', SORT_ASC);
		    $carrinhoDetalhadoArray = array_sort($carrinhoDetalhadoArray, 'ordem', SORT_ASC);
		    foreach ($carrinhoDetalhadoArray as $keyDetalhado => $valueDetalhado) {
				$total = $total + $valueDetalhado['valor'];
			?>
			{
				id: '<?=$valueDetalhado['numeroUnico']?>',
				quantity: 1,
				item_price: <?=$valueDetalhado['valor']?>
		  	},
		  <? } ?>
		  ],
		value: <?=$total?>,
		content_type: 'product'
	  }
	  // end parameter object data
	);
	<? } else { ?>
	fbq('track', 'PageView');
	<? } ?>
	</script>
	<noscript>
	 <img height="1" width="1"
	src="https://www.facebook.com/tr?id=<?=$rSqlEmpresaConfig['facebook_pixel_code']?>&ev=PageView
	&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->
	<? } ?>


	<? if($pagina=="evento.php") { ?>
	<script type="application/ld+json">
	{
	  "@context": "http://schema.org",
	  "@type": "Event",
	  "location": {
		"@type": "Place",
		"address": {
		  "@type": "PostalAddress",
		  "addressLocality": "<?=$rSqlEvento['cidade']?>",
		  "addressRegion": "<?=$rSqlEvento['estado']?>",
		  "postalCode": "<?=$rSqlEvento['cep']?>",
		  "streetAddress": "<?=$rSqlEvento['rua']?>, <?=$rSqlEvento['numero']?>, <?=$rSqlEvento['complemento']?>"
		},
		"name": "<?=$rSqlEvento['local']?>"
	  },
	  "name": "<?=$rSqlEvento['nome']?>",
	  "description": "<?=caracteres_especiais($rSqlEvento['detalhe'],"ler");?>",
	  <?
		$ticketsArray = unserialize($rSqlEvento['tickets']);
		$ticketsArray = array_sort($ticketsArray, 'ticket_data', SORT_ASC);
		foreach ($ticketsArray as $key_ticket => $value_ticket) {
			
			if(trim($value_ticket['stat'])=="1") {
				if(trim($value_ticket['ticket_exibir_site'])=="1") {
					$lotesArray = unserialize($rSqlEvento['lotes']);
					$lotesArray = array_sort($lotesArray, 'lote', SORT_ASC);
					foreach ($lotesArray as $key_lote => $value_lote) {
						if(trim($value_ticket['numeroUnico'])==trim($value_lote['numeroUnico_ticket']) && trim($value_lote['stat'])=="1") {
							$resumo_google_evento .= " \"offers\": { \n";
							$resumo_google_evento .= "  \"@type\": \"Offer\", \n";
							$resumo_google_evento .= "  \"price\": \"".$value_lote['lote_valor']."\", \n";
							$resumo_google_evento .= "  \"priceCurrency\": \"RS\", \n";
							$resumo_google_evento .= "  \"url\": \"https:".$link_modelo."evento/".$rSqlEvento['id']."/".$rSqlEvento['url_amigavel']."/\" \n";
							$resumo_google_evento .= "}, \n";

							$resumo_google_evento_array[] = array('html' => $resumo_google_evento, 'view' => $value_lote['lote_valor']);
						}
					}

				}
			}
		}

		foreach ($resumo_google_evento_array as $key => $row) {
			$html[$key]  = $row['html'];
			$view[$key] = $row['view'];
		}

		array_multisort($view, SORT_ASC,  $resumo_google_evento_array);
		for ($x = 0; $x < 1; $x++) {
			echo $resumo_google_evento_array[$x]['html'];
		}
	  ?>

	  <?
	  $data_eventoSet = substr($rSqlEvento['data_do_evento'],0,10);
	  $hora_eventoSet = substr($rSqlEvento['data_do_evento'],11,5);
	  ?>
	  "startDate": "<?=$data_eventoSet?>T<?=$hora_eventoSet?>",
	  "image": [ "https:<?=$link_modelo?>evento/<?=$rSqlEvento['id']?>/<?=$rSqlEvento['url_amigavel']?>/" ]
	}
	</script>
	<? } ?>

</head>

<body class="stretched">

    <? if(trim($rSqlEmpresaConfig['id_tag_manager'])!="") { ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?=$rSqlEmpresaConfig['id_tag_manager']?>"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <? } ?>

    <? if(trim($rSqlUsuario['id'])=="") { } else { ?>
    <!-- Page Sub Menu
    ============================================= -->
    <div id="page-menu" class="menu-mobile-logado" data-mobile-sticky="true">
        <div id="page-menu-wrap">
            <div class="container">
                <div class="page-menu-row">

                    <div class="page-menu-title">Olá, <span><?=$rSqlUsuario['nome']?></span></div>

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

                    <div id="page-menu-trigger"><i class="icon-user-circle" style="margin-right: 10px;"></i></div>

                </div>
            </div>
        </div>
    </div><!-- #page-menu end -->
    <? } ?>

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<? if(trim($configuracoes_site['top_header'])=="1") { ?>
		<!-- Top Bar
		============================================= -->
		<div id="top-bar" style="background-color:<?=$configuracoes_site['top_header_cor_fundo']?> !important;border-bottom:1px solid <?=$configuracoes_site['top_header_cor_linha_div']?> !important;">
			<div class="container clearfix">

				<div class="row justify-content-between">
					<div class="col-12 col-md-auto d-none d-md-flex">

						<!-- Top Links
						============================================= -->
						<div class="top-links">
							<ul class="top-links-container">
								<? for ($i = 1; $i <= 3; $i++) { ?>
									<? if(trim($configuracoes_site['info_esq_'.$i.''])=="1") { ?>
                                    <?
									?>
                                    <li class="top-links-item">
                                    	<a style="background-color:<?=$configuracoes_site['info_esq_'.$i.'_cor_fundo']?> !important;color:<?=$configuracoes_site['info_esq_'.$i.'_cor_texto']?> !important;" 
                                           href="<?=$configuracoes_site['info_esq_'.$i.'_link']?>" target="<?=$configuracoes_site['info_esq_'.$i.'_target']?>">
                                    		<? if(trim($configuracoes_site['info_esq_'.$i.'_icone'])=="") { } else { ?>
                                            <i class="<?=$configuracoes_site['info_esq_'.$i.'_icone']?>" style="margin-top: 5px !important;"></i> 
                                            <? } ?>
											<?=$configuracoes_site['info_esq_'.$i.'_texto']?>
                                        </a>
                                    </li>
                                    <? } ?>
                                <? } ?>
							</ul>
						</div><!-- .top-links end -->

					</div>

					<div class="col-12 col-md-auto">

						<!-- Top Links
						============================================= -->
						<div class="top-links">
							<ul class="top-links-container">
								<? for ($i = 1; $i <= 3; $i++) { ?>
									<? if(trim($configuracoes_site['info_dir_'.$i.''])=="1") { ?>
                                    <?
									?>
                                    <li class="top-links-item">
                                    	<a style="background-color:<?=$configuracoes_site['info_dir_'.$i.'_cor_fundo']?> !important;color:<?=$configuracoes_site['info_dir_'.$i.'_cor_texto']?> !important;" 
                                           href="<?=$configuracoes_site['info_dir_'.$i.'_link']?>" target="<?=$configuracoes_site['info_dir_'.$i.'_target']?>">
                                    		<? if(trim($configuracoes_site['info_dir_'.$i.'_icone'])=="") { } else { ?>
                                            <i class="<?=$configuracoes_site['info_dir_'.$i.'_icone']?>" style="margin-top: 5px !important;"></i> 
                                            <? } ?>
											<?=$configuracoes_site['info_dir_'.$i.'_texto']?>
                                        </a>
                                    </li>
                                    <? } ?>
                                <? } ?>
							</ul>
						</div><!-- .top-links end -->

					</div>
				</div>

			</div>
		</div><!-- #top-bar end -->
        <? } ?>
        
		<!-- Header
		============================================= -->
		<? if(trim($configuracoes_site['modelo_cabecalho_menu'])=="" || trim($configuracoes_site['modelo_cabecalho_menu'])=="tela_toda") { ?>
        <header id="header" data-logo-height="60" class="full-header">
        <? } else { ?>
        <header id="header" data-logo-height="60">
        <? } ?>
			<div id="header-wrap">
				<div class="container">
					<?
                    if(trim($configuracoes_site['modelo_alinhamento_logotipo'])=="esquerda") {
                        if(trim($configuracoes_site['modelo_alinhamento_menu'])=="esquerda") {
                            $classe_header = "header-row";
                            $classe_logotipo = "mx-0 me-lg-5 order-2 order-lg-1";
                            $classe_menu = "primary-menu me-lg-auto with-arrows order-12 order-lg-2";
                        } else if(trim($configuracoes_site['modelo_alinhamento_menu'])=="centro") {
                            $classe_header = "header-row justify-content-between";
                            $classe_logotipo = "me-lg-0";
                            $classe_menu = "primary-menu";
                        } else if(trim($configuracoes_site['modelo_alinhamento_menu'])=="direita") {
                            $classe_header = "header-row";
                            $classe_logotipo = "";
                            $classe_menu = "primary-menu";
                        }
                    } else if(trim($configuracoes_site['modelo_alinhamento_logotipo'])=="centro") {
                        if(trim($configuracoes_site['modelo_alinhamento_menu'])=="esquerda") {
                            $classe_header = "header-row justify-content-lg-between";
                            $classe_logotipo = "col-auto order-lg-2 me-lg-0 px-0";
                            $classe_menu = "primary-menu with-arrows not-dark col-lg-5 order-lg-1 px-0";
                        } else if(trim($configuracoes_site['modelo_alinhamento_menu'])=="centro") {
                            $classe_header = "header-row justify-content-lg-between";
                            $classe_logotipo = "col-auto col-lg-5 order-lg-2 me-lg-0 px-0";
                            $classe_menu = "primary-menu";
                        } else if(trim($configuracoes_site['modelo_alinhamento_menu'])=="direita") {
                            $classe_header = "header-row justify-content-lg-between";
                            $classe_logotipo = "col-auto order-lg-2 me-lg-0 px-0";
                            $classe_menu = "primary-menu not-dark col-lg-5 order-lg-3 px-0";
                        }
                    } else if(trim($configuracoes_site['modelo_alinhamento_logotipo'])=="direita") {
                        if(trim($configuracoes_site['modelo_alinhamento_menu'])=="esquerda") {
                            $classe_header = "header-row justify-content-between";
                            $classe_logotipo = "header-misc order-3";
                            $classe_menu = "primary-menu col-lg-10 me-lg-auto with-arrows order-1 order-lg-2";
                        } else if(trim($configuracoes_site['modelo_alinhamento_menu'])=="centro") {
                            $classe_header = "header-row justify-content-lg-between";
                            $classe_logotipo = "col-auto order-lg-3 me-lg-0 px-0";
                            $classe_menu = "primary-menu order-lg-2";
                        } else if(trim($configuracoes_site['modelo_alinhamento_menu'])=="direita") {
                            $classe_header = "header-row justify-content-lg-between";
                            $classe_logotipo = "col-auto order-lg-3 me-lg-0 px-0";
                            $classe_menu = "primary-menu order-lg-2";
                        }
                    }
                    ?>
					<div class="<?=$classe_header?>">

                        <!-- Logo
						============================================= -->
						<div id="logo" class="<?=$classe_logotipo?>">
							<a href="<?=$link_modelo?>" class="standard-logo" data-dark-logo="<?=$link?>files/site/<?=$configuracoes_site['numeroUnico']?>/<?=$configuracoes_site['logotipo_cabecalho']?>">
                            <img style="padding-top:5px;padding-bottom:5px;" src="<?=$link?>files/site/<?=$configuracoes_site['numeroUnico']?>/<?=$configuracoes_site['logotipo_cabecalho']?>" alt="<?=$rSqlEmprsa['nome']?>"></a>
							<a href="<?=$link_modelo?>" class="retina-logo" data-dark-logo="<?=$link?>files/site/<?=$configuracoes_site['numeroUnico']?>/<?=$configuracoes_site['logotipo_cabecalho']?>">
                            <img style="padding-top:5px;padding-bottom:5px;" src="<?=$link?>files/site/<?=$configuracoes_site['numeroUnico']?>/<?=$configuracoes_site['logotipo_cabecalho']?>" alt="<?=$rSqlEmprsa['nome']?>"></a>
						</div><!-- #logo end -->

						<div class="header-misc">

							<!-- Top Cart
							============================================= -->
							<div id="top-cart" class="header-misc-icon d-none d-sm-block">
                            	<? include("".$_SERVER['DOCUMENT_ROOT']."/templates/".$pasta_template."/carrinho-lista-topbar.php"); ?>
							</div><!-- #top-cart end -->

						</div>

						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<? if(trim($configuracoes_site['modelo_alinhamento_logotipo'])=="centro") { ?>
							<? if(trim($configuracoes_site['modelo_alinhamento_menu'])=="esquerda") { ?>
                            <nav class="primary-menu not-dark col-lg-5 order-lg-3 px-0"></nav>
                            <? } else if(trim($configuracoes_site['modelo_alinhamento_menu'])=="centro") { ?>
                            <? } else if(trim($configuracoes_site['modelo_alinhamento_menu'])=="direita") { ?>
                            <nav class="primary-menu not-dark col-lg-5 order-lg-1 px-0"></nav>
                            <? } ?>
						<? } else if(trim($configuracoes_site['modelo_alinhamento_logotipo'])=="direita") { ?>
							<? if(trim($configuracoes_site['modelo_alinhamento_menu'])=="esquerda") { ?>
                            <? } else if(trim($configuracoes_site['modelo_alinhamento_menu'])=="centro") { ?>
                            <nav class="primary-menu not-dark col-lg-5 order-lg-1 px-0"></nav>
                            <? } else if(trim($configuracoes_site['modelo_alinhamento_menu'])=="direita") { ?>
                            <nav class="primary-menu not-dark col-lg-5 order-lg-1 px-0"></nav>
                            <? } ?>
                        <? } ?>
                            
                        <nav class="<?=$classe_menu?>">

							<ul class="menu-container">
								<? if(trim($configuracoes_site['menu_topo'])=="") { ?>
								<li class="menu-item"><a class="menu-link" href="<?=$link_modelo?><?=$url_eventos_plural?>/"><div><?=$configuracoes_site['label_menu_eventos_plural']?></div></a></li>
								<!--
                                <li class="menu-item"><a class="menu-link" href="<?=$link_modelo?>"><div>Sobre Nós</div></a></li>
								<li class="menu-item"><a class="menu-link" href="<?=$link_modelo?>"><div>Produtores</div></a></li>
                                -->
								<li class="menu-item"><a class="menu-link" href="<?=$link_modelo?><?=$url_contato?>/"><div><?=$configuracoes_site['label_menu_contato']?></div></a></li>
                                <? } else { ?>
									<?
                                    $menu_topoArray = unserialize($configuracoes_site['menu_topo']);
                                    $menu_topoArray = array_sort($menu_topoArray, 'ordem', SORT_ASC);
                                    foreach ($menu_topoArray as $key_topo => $value_topo) {
    
                                        if($value_topo['stat']=="1") {
											if($value_topo['modulo']=="QuemSomos") {
												$url_menu_topo = "".transformaCaractere($value_topo['nome'])."";
												$label_menu_topo = "".$value_topo['nome']."";
											} else if($value_topo['modulo']=="Blog") {
												$url_menu_topo = "".transformaCaractere($value_topo['nome'])."";
												$label_menu_topo = "".$value_topo['nome']."";
											} else if($value_topo['modulo']=="Duvidas") {
												$url_menu_topo = "".transformaCaractere($value_topo['nome'])."";
												$label_menu_topo = "".$value_topo['nome']."";
											} else if($value_topo['modulo']=="Eventos") {
												$url_menu_topo = "".$url_eventos_plural."";
												$label_menu_topo = "".$value_topo['nome']."";
											} else if($value_topo['modulo']=="Produtos") {
												$url_menu_topo = "".$url_eventos_plural."";
												$label_menu_topo = "".$value_topo['nome']."";
											} else if($value_topo['modulo']=="Contato") {
												$url_menu_topo = "".$url_contato."";
												$label_menu_topo = "".$configuracoes_site['label_menu_contato']."";
											} else if($value_topo['modulo']=="ConteudoPersonalizado") {
												$url_menu_topo = "".transformaCaractere($value_topo['nome'])."";
												$label_menu_topo = "".$value_topo['nome']."";
											} else if($value_topo['modulo']=="Galeria") {
												$url_menu_topo = "".transformaCaractere($value_topo['nome'])."";
												$label_menu_topo = "".$value_topo['nome']."";
											}
                                    ?>
                                        <li class="menu-item"><a class="menu-link" href="<?=$link_modelo?><?=$url_menu_topo?>/"><div><?=$label_menu_topo?></div></a></li>
                                        <? } ?>
                                    <? } ?>
                                <? } ?>
                                <? if(trim($rSqlUsuario['id'])=="") { ?>
								<li class="menu-item"><a class="menu-link" href="<?=$link_modelo?><?=$url_acesso?>/"><div><?=$configuracoes_site['label_menu_acesso']?></div></a></li>
								<li class="menu-item"><a class="menu-link" href="<?=$link_modelo?><?=$url_cadastro?>/"><div><?=$configuracoes_site['label_menu_cadastro']?></div></a></li>
                                <? } else { ?>
								<li class="menu-item menu-desktop-logado"><a class="menu-link" href="<?=$link_modelo?>painel/"><div><?=$configuracoes_site['label_menu_minha_conta']?></div></a></li>
                                <? } ?>
							</ul>

						</nav><!-- #primary-menu end -->

					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->


		<? if($pagina=="inicial.php") { } else { ?>
        <!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1><?=$nomeCabecalho?></h1>
                <!--
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?=$link_modelo?>">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page"><?=$nomeCabecalho?></li>
				</ol>
                -->
			</div>

		</section><!-- #page-title end -->
        <? } ?>
		
        <? if(trim($rSqlUsuario['email'])=="alexsander.lauffer@gmail.com") { ?>
		<? 
        if(trim($_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].''])=="") {
           $nCarrinho = 0;
        } else {
           $nCarrinho = count(unserialize($_SESSION['carrinho_'.$_SESSION['numeroUnico_carrinho'].'']));
        }
        ?>
        <? if($nCarrinho==0) { } else { ?>
		<style>
        .classe_texto {
            width: 70% !important;
        }
        .classe_relogio {
            width: 30% !important;
			text-align:right !important;
			padding-top: 7px !important;
        }
        @media (max-width: 768px) {
			.classe_texto {
				width: 100% !important;
			}
			.classe_relogio {
				width: 100% !important;
				text-align:center !important;
			}
        }
        </style>
        <!-- Page Title
		============================================= -->
		<div class="col-lg-12" style="margin-top:15px;">

			<div class="container clearfix">

                <div class="col-lg-12" style="border-left: 2px solid #faebcc;background-color: #fcf8e3;color: #8a6d3b;padding: 10px;">
                    <div class="row">
                        <div class="col-lg-8 classe_texto">Por favor, complete a sua compra no prazo máximo estabelecido.<br>Depois deste período sua reserva será liberada para venda novamente.</div>
                        <div class="col-lg-4 classe_relogio" style="font-weight: bold;font-size: 24px;" id="relogio-sessao"></div>
                    </div>
                </div>
                
			</div>

		</div>
		<? } ?>
		<? } ?>
		
        
        