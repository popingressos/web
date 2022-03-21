
					<script>
					function trim(str){return str.replace(/^\s+|\s+$/g,"");}
					function seta_icone_popup(iconSend) {
						parent.$("#icone_set_popup").val(iconSend);
						parent.$("#icone_set_print").addClass(iconSend);
						jQuery.fancybox.close();
					}
					function busca_icone() {
						if(trim($("#busca_icone_pc").val())=="") {
							$('.ul_lista_icone > li ').show();
						} else {
							$('.ul_lista_icone > li').hide();
							$('.ul_lista_icone > li > [class*='+$("#busca_icone_pc").val()+']').parent().show();
						}
						
					}
					
                    </script>
					<style>
					#busca_icone_pc {
						font-size: 11px;
						font-weight: normal;
						color: #333;
						height: 34px;
						width:100%;
						padding: 6px 12px;
						background-color: #fff;
						border: 1px solid #e5e5e5;
						-webkit-box-shadow: none;
						box-shadow: none;
						-webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
						transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
					}

					@font-face {
						font-family: 'adrenaline-icons';
						src:url('http://vpnssl.adrenaline.com.br/fonts/adrenaline-icons.eot?eijlv8');
						src:url('http://vpnssl.adrenaline.com.br/fonts/adrenaline-icons.eot?#iefixeijlv8') format('embedded-opentype'),
							url('http://vpnssl.adrenaline.com.br/fonts/adrenaline-icons.woff?eijlv8') format('woff'),
							url('http://vpnssl.adrenaline.com.br/fonts/adrenaline-icons.ttf?eijlv8') format('truetype'),
							url('http://vpnssl.adrenaline.com.br/fonts/adrenaline-icons.svg?eijlv8#adrenaline-icons') format('svg');
						font-weight: normal;
						font-style: normal;
					}
					
					[class^="icon-adr-"], [class*=" icon-adr-"] {
						font-family: 'adrenaline-icons';
						speak: none;
						font-style: normal;
						font-weight: normal;
						font-variant: normal;
						text-transform: none;
						line-height: 1;
					
						/* Better Font Rendering =========== */
						-webkit-font-smoothing: antialiased;
						-moz-osx-font-smoothing: grayscale;
					}
					
					.icon-adr-pacman:before {
						content: "\e60b";
					}
					.icon-adr-programas-desafio-adrenaline:before {
						content: "\e74c";
					}
					.icon-adr-programas:before {
						content: "\e74e";
					}
					.icon-adr-programas-games:before {
						content: "\e754";
					}
					.icon-adr-triangulo-bottom:before {
						content: "\e74f";
					}
					.icon-adr-triangulo-left:before {
						content: "\e750";
					}
					.icon-adr-triangulo-right:before {
						content: "\e751";
					}
					.icon-adr-triangulo-top:before {
						content: "\e752";
					}
					.icon-adr-triangulo-topright:before {
						content: "\e753";
					}
					.icon-adr-trianguloflat-bottom:before {
						content: "\e7cc";
					}
					.icon-adr-trianguloflat-left:before {
						content: "\e7cd";
					}
					.icon-adr-trianguloflat-right:before {
						content: "\e7ce";
					}
					.icon-adr-trianguloflat-top:before {
						content: "\e7cf";
					}
					.icon-adr-programas-sync:before {
						content: "\e74d";
					}
					.icon-adr-programas-videocast-tech:before {
						content: "\e7d0";
					}

                    .ul_lista_icone { list-style:none; margin-top:20px; margin-bottom:20px; }
                    .ul_lista_icone li { float:left; margin-bottom:5px; border:1px solid #CCC; cursor:pointer; margin-left:5px; height:50px; width:50px; text-align:center; }
                    .ul_lista_icone li:hover { border:1px solid #C00; }
                    .ul_lista_icone li i { font-size:40px !important; line-height:45px !important; }
                    </style>

            <div style="width:1050px;height:500px;">

				<div class="col-md-12">

                    <div class="col-md-12">
                    <h2>Faça sua busca.</h2>
                    <p>Digite uma palavra chave no campo abaixo, e o sistema vai filtrar um ícone que condiz com sua pesquisa</p>
                    <input type="text" value="" id="busca_icone_pc" onkeyup="javascript:busca_icone();" />
                    </div>

                    <div class="col-md-12">
                    <ul class="ul_lista_icone">
                    <li onclick="seta_icone_popup('fa fa-automobile');"><i class="fa fa-automobile"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bank');"><i class="fa fa-bank"></i></li>
                    <li onclick="seta_icone_popup('fa fa-behance');"><i class="fa fa-behance"></i></li>
                    <li onclick="seta_icone_popup('fa fa-behance-square');"><i class="fa fa-behance-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bomb');"><i class="fa fa-bomb"></i></li>
                    <li onclick="seta_icone_popup('fa fa-building');"><i class="fa fa-building"></i></li>
                    <li onclick="seta_icone_popup('fa fa-cab');"><i class="fa fa-cab"></i></li>
                    <li onclick="seta_icone_popup('fa fa-car');"><i class="fa fa-car"></i></li>
                    <li onclick="seta_icone_popup('fa fa-child');"><i class="fa fa-child"></i></li>
                    <li onclick="seta_icone_popup('fa fa-circle-o-notch');"><i class="fa fa-circle-o-notch"></i></li>
                    <li onclick="seta_icone_popup('fa fa-circle-thin');"><i class="fa fa-circle-thin"></i></li>
                    <li onclick="seta_icone_popup('fa fa-codepen');"><i class="fa fa-codepen"></i></li>
                    <li onclick="seta_icone_popup('fa fa-cube');"><i class="fa fa-cube"></i></li>
                    <li onclick="seta_icone_popup('fa fa-cubes');"><i class="fa fa-cubes"></i></li>
                    <li onclick="seta_icone_popup('fa fa-database');"><i class="fa fa-database"></i></li>
                    <li onclick="seta_icone_popup('fa fa-delicious');"><i class="fa fa-delicious"></i></li>
                    <li onclick="seta_icone_popup('fa fa-deviantart');"><i class="fa fa-deviantart"></i></li>
                    <li onclick="seta_icone_popup('fa fa-digg');"><i class="fa fa-digg"></i></li>
                    <li onclick="seta_icone_popup('fa fa-drupal');"><i class="fa fa-drupal"></i></li>
                    <li onclick="seta_icone_popup('fa fa-empire');"><i class="fa fa-empire"></i></li>
                    <li onclick="seta_icone_popup('fa fa-envelope-square');"><i class="fa fa-envelope-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-fax');"><i class="fa fa-fax"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-archive-o');"><i class="fa fa-file-archive-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-audio-o');"><i class="fa fa-file-audio-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-code-o');"><i class="fa fa-file-code-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-excel-o');"><i class="fa fa-file-excel-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-image-o');"><i class="fa fa-file-image-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-movie-o');"><i class="fa fa-file-movie-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-pdf-o');"><i class="fa fa-file-pdf-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-photo-o');"><i class="fa fa-file-photo-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-picture-o');"><i class="fa fa-file-picture-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-powerpoint-o');"><i class="fa fa-file-powerpoint-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-sound-o');"><i class="fa fa-file-sound-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-video-o');"><i class="fa fa-file-video-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-word-o');"><i class="fa fa-file-word-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-zip-o');"><i class="fa fa-file-zip-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-ge');"><i class="fa fa-ge"></i></li>
                    <li onclick="seta_icone_popup('fa fa-git');"><i class="fa fa-git"></i></li>
                    <li onclick="seta_icone_popup('fa fa-git-square');"><i class="fa fa-git-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-google');"><i class="fa fa-google"></i></li>
                    <li onclick="seta_icone_popup('fa fa-graduation-cap');"><i class="fa fa-graduation-cap"></i></li>
                    <li onclick="seta_icone_popup('fa fa-hacker-news');"><i class="fa fa-hacker-news"></i></li>
                    <li onclick="seta_icone_popup('fa fa-header');"><i class="fa fa-header"></i></li>
                    <li onclick="seta_icone_popup('fa fa-history');"><i class="fa fa-history"></i></li>
                    <li onclick="seta_icone_popup('fa fa-institution');"><i class="fa fa-institution"></i></li>
                    <li onclick="seta_icone_popup('fa fa-joomla');"><i class="fa fa-joomla"></i></li>
                    <li onclick="seta_icone_popup('fa fa-jsfiddle');"><i class="fa fa-jsfiddle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-language');"><i class="fa fa-language"></i></li>
                    <li onclick="seta_icone_popup('fa fa-life-bouy');"><i class="fa fa-life-bouy"></i></li>
                    <li onclick="seta_icone_popup('fa fa-life-ring');"><i class="fa fa-life-ring"></i></li>
                    <li onclick="seta_icone_popup('fa fa-life-saver');"><i class="fa fa-life-saver"></i></li>
                    <li onclick="seta_icone_popup('fa fa-mortar-board');"><i class="fa fa-mortar-board"></i></li>
                    <li onclick="seta_icone_popup('fa fa-openid');"><i class="fa fa-openid"></i></li>
                    <li onclick="seta_icone_popup('fa fa-paper-plane');"><i class="fa fa-paper-plane"></i></li>
                    <li onclick="seta_icone_popup('fa fa-paper-plane-o');"><i class="fa fa-paper-plane-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-paragraph');"><i class="fa fa-paragraph"></i></li>
                    <li onclick="seta_icone_popup('fa fa-paw');"><i class="fa fa-paw"></i></li>
                    <li onclick="seta_icone_popup('fa fa-pied-piper');"><i class="fa fa-pied-piper"></i></li>
                    <li onclick="seta_icone_popup('fa fa-pied-piper-alt');"><i class="fa fa-pied-piper-alt"></i></li>
                    <li onclick="seta_icone_popup('fa fa-pied-piper-square');"><i class="fa fa-pied-piper-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-qq');"><i class="fa fa-qq"></i></li>
                    <li onclick="seta_icone_popup('fa fa-ra');"><i class="fa fa-ra"></i></li>
                    <li onclick="seta_icone_popup('fa fa-rebel');"><i class="fa fa-rebel"></i></li>
                    <li onclick="seta_icone_popup('fa fa-recycle');"><i class="fa fa-recycle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-reddit');"><i class="fa fa-reddit"></i></li>
                    <li onclick="seta_icone_popup('fa fa-reddit-square');"><i class="fa fa-reddit-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-send');"><i class="fa fa-send"></i></li>
                    <li onclick="seta_icone_popup('fa fa-send-o');"><i class="fa fa-send-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-share-alt');"><i class="fa fa-share-alt"></i></li>
                    <li onclick="seta_icone_popup('fa fa-share-alt-square');"><i class="fa fa-share-alt-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-slack');"><i class="fa fa-slack"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sliders');"><i class="fa fa-sliders"></i></li>
                    <li onclick="seta_icone_popup('fa fa-soundcloud');"><i class="fa fa-soundcloud"></i></li>
                    <li onclick="seta_icone_popup('fa fa-space-shuttle');"><i class="fa fa-space-shuttle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-spoon');"><i class="fa fa-spoon"></i></li>
                    <li onclick="seta_icone_popup('fa fa-spotify');"><i class="fa fa-spotify"></i></li>
                    <li onclick="seta_icone_popup('fa fa-steam');"><i class="fa fa-steam"></i></li>
                    <li onclick="seta_icone_popup('fa fa-steam-square');"><i class="fa fa-steam-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-stumbleupon');"><i class="fa fa-stumbleupon"></i></li>
                    <li onclick="seta_icone_popup('fa fa-stumbleupon-circle');"><i class="fa fa-stumbleupon-circle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-support');"><i class="fa fa-support"></i></li>
                    <li onclick="seta_icone_popup('fa fa-taxi');"><i class="fa fa-taxi"></i></li>
                    <li onclick="seta_icone_popup('fa fa-tencent-weibo');"><i class="fa fa-tencent-weibo"></i></li>
                    <li onclick="seta_icone_popup('fa fa-tree');"><i class="fa fa-tree"></i></li>
                    <li onclick="seta_icone_popup('fa fa-university');"><i class="fa fa-university"></i></li>
                    <li onclick="seta_icone_popup('fa fa-vine');"><i class="fa fa-vine"></i></li>
                    <li onclick="seta_icone_popup('fa fa-wechat');"><i class="fa fa-wechat"></i></li>
                    <li onclick="seta_icone_popup('fa fa-weixin');"><i class="fa fa-weixin"></i></li>
                    <li onclick="seta_icone_popup('fa fa-wordpress');"><i class="fa fa-wordpress"></i></li>
                    <li onclick="seta_icone_popup('fa fa-yahoo');"><i class="fa fa-yahoo"></i></li>
                    <li onclick="seta_icone_popup('fa fa-adjust');"><i class="fa fa-adjust"></i></li>
                    <li onclick="seta_icone_popup('fa fa-anchor');"><i class="fa fa-anchor"></i></li>
                    <li onclick="seta_icone_popup('fa fa-archive');"><i class="fa fa-archive"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrows');"><i class="fa fa-arrows"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrows-h');"><i class="fa fa-arrows-h"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrows-v');"><i class="fa fa-arrows-v"></i></li>
                    <li onclick="seta_icone_popup('fa fa-asterisk');"><i class="fa fa-asterisk"></i></li>
                    <li onclick="seta_icone_popup('fa fa-automobile');"><i class="fa fa-automobile"></i></li>
                    <li onclick="seta_icone_popup('fa fa-ban');"><i class="fa fa-ban"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bank');"><i class="fa fa-bank"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bar-chart-o');"><i class="fa fa-bar-chart-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-barcode');"><i class="fa fa-barcode"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bars');"><i class="fa fa-bars"></i></li>
                    <li onclick="seta_icone_popup('fa fa-beer');"><i class="fa fa-beer"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bell');"><i class="fa fa-bell"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bell-o');"><i class="fa fa-bell-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bolt');"><i class="fa fa-bolt"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bomb');"><i class="fa fa-bomb"></i></li>
                    <li onclick="seta_icone_popup('fa fa-book');"><i class="fa fa-book"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bookmark');"><i class="fa fa-bookmark"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bookmark-o');"><i class="fa fa-bookmark-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-briefcase');"><i class="fa fa-briefcase"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bug');"><i class="fa fa-bug"></i></li>
                    <li onclick="seta_icone_popup('fa fa-building');"><i class="fa fa-building"></i></li>
                    <li onclick="seta_icone_popup('fa fa-building-o');"><i class="fa fa-building-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bullhorn');"><i class="fa fa-bullhorn"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bullseye');"><i class="fa fa-bullseye"></i></li>
                    <li onclick="seta_icone_popup('fa fa-cab');"><i class="fa fa-cab"></i></li>
                    <li onclick="seta_icone_popup('fa fa-calendar');"><i class="fa fa-calendar"></i></li>
                    <li onclick="seta_icone_popup('fa fa-calendar-o');"><i class="fa fa-calendar-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-camera');"><i class="fa fa-camera"></i></li>
                    <li onclick="seta_icone_popup('fa fa-camera-retro');"><i class="fa fa-camera-retro"></i></li>
                    <li onclick="seta_icone_popup('fa fa-car');"><i class="fa fa-car"></i></li>
                    <li onclick="seta_icone_popup('fa fa-caret-square-o-down');"><i class="fa fa-caret-square-o-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-caret-square-o-left');"><i class="fa fa-caret-square-o-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-caret-square-o-right');"><i class="fa fa-caret-square-o-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-caret-square-o-up');"><i class="fa fa-caret-square-o-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-certificate');"><i class="fa fa-certificate"></i></li>
                    <li onclick="seta_icone_popup('fa fa-check');"><i class="fa fa-check"></i></li>
                    <li onclick="seta_icone_popup('fa fa-check-circle');"><i class="fa fa-check-circle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-check-circle-o');"><i class="fa fa-check-circle-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-check-square');"><i class="fa fa-check-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-check-square-o');"><i class="fa fa-check-square-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-child');"><i class="fa fa-child"></i></li>
                    <li onclick="seta_icone_popup('fa fa-circle');"><i class="fa fa-circle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-circle-o');"><i class="fa fa-circle-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-circle-o-notch');"><i class="fa fa-circle-o-notch"></i></li>
                    <li onclick="seta_icone_popup('fa fa-circle-thin');"><i class="fa fa-circle-thin"></i></li>
                    <li onclick="seta_icone_popup('fa fa-clock-o');"><i class="fa fa-clock-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-cloud');"><i class="fa fa-cloud"></i></li>
                    <li onclick="seta_icone_popup('fa fa-cloud-download');"><i class="fa fa-cloud-download"></i></li>
                    <li onclick="seta_icone_popup('fa fa-cloud-upload');"><i class="fa fa-cloud-upload"></i></li>
                    <li onclick="seta_icone_popup('fa fa-code');"><i class="fa fa-code"></i></li>
                    <li onclick="seta_icone_popup('fa fa-code-fork');"><i class="fa fa-code-fork"></i></li>
                    <li onclick="seta_icone_popup('fa fa-coffee');"><i class="fa fa-coffee"></i></li>
                    <li onclick="seta_icone_popup('fa fa-cog');"><i class="fa fa-cog"></i></li>
                    <li onclick="seta_icone_popup('fa fa-cogs');"><i class="fa fa-cogs"></i></li>
                    <li onclick="seta_icone_popup('fa fa-comment');"><i class="fa fa-comment"></i></li>
                    <li onclick="seta_icone_popup('fa fa-comment-o');"><i class="fa fa-comment-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-comments');"><i class="fa fa-comments"></i></li>
                    <li onclick="seta_icone_popup('fa fa-comments-o');"><i class="fa fa-comments-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-compass');"><i class="fa fa-compass"></i></li>
                    <li onclick="seta_icone_popup('fa fa-credit-card');"><i class="fa fa-credit-card"></i></li>
                    <li onclick="seta_icone_popup('fa fa-crop');"><i class="fa fa-crop"></i></li>
                    <li onclick="seta_icone_popup('fa fa-crosshairs');"><i class="fa fa-crosshairs"></i></li>
                    <li onclick="seta_icone_popup('fa fa-cube');"><i class="fa fa-cube"></i></li>
                    <li onclick="seta_icone_popup('fa fa-cubes');"><i class="fa fa-cubes"></i></li>
                    <li onclick="seta_icone_popup('fa fa-cutlery');"><i class="fa fa-cutlery"></i></li>
                    <li onclick="seta_icone_popup('fa fa-dashboard');"><i class="fa fa-dashboard"></i></li>
                    <li onclick="seta_icone_popup('fa fa-database');"><i class="fa fa-database"></i></li>
                    <li onclick="seta_icone_popup('fa fa-desktop');"><i class="fa fa-desktop"></i></li>
                    <li onclick="seta_icone_popup('fa fa-dot-circle-o');"><i class="fa fa-dot-circle-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-download');"><i class="fa fa-download"></i></li>
                    <li onclick="seta_icone_popup('fa fa-edit');"><i class="fa fa-edit"></i></li>
                    <li onclick="seta_icone_popup('fa fa-ellipsis-h');"><i class="fa fa-ellipsis-h"></i></li>
                    <li onclick="seta_icone_popup('fa fa-ellipsis-v');"><i class="fa fa-ellipsis-v"></i></li>
                    <li onclick="seta_icone_popup('fa fa-envelope');"><i class="fa fa-envelope"></i></li>
                    <li onclick="seta_icone_popup('fa fa-envelope-o');"><i class="fa fa-envelope-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-envelope-square');"><i class="fa fa-envelope-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-eraser');"><i class="fa fa-eraser"></i></li>
                    <li onclick="seta_icone_popup('fa fa-exchange');"><i class="fa fa-exchange"></i></li>
                    <li onclick="seta_icone_popup('fa fa-exclamation');"><i class="fa fa-exclamation"></i></li>
                    <li onclick="seta_icone_popup('fa fa-exclamation-circle');"><i class="fa fa-exclamation-circle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-exclamation-triangle');"><i class="fa fa-exclamation-triangle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-external-link');"><i class="fa fa-external-link"></i></li>
                    <li onclick="seta_icone_popup('fa fa-external-link-square');"><i class="fa fa-external-link-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-eye');"><i class="fa fa-eye"></i></li>
                    <li onclick="seta_icone_popup('fa fa-eye-slash');"><i class="fa fa-eye-slash"></i></li>
                    <li onclick="seta_icone_popup('fa fa-fax');"><i class="fa fa-fax"></i></li>
                    <li onclick="seta_icone_popup('fa fa-female');"><i class="fa fa-female"></i></li>
                    <li onclick="seta_icone_popup('fa fa-fighter-jet');"><i class="fa fa-fighter-jet"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-archive-o');"><i class="fa fa-file-archive-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-audio-o');"><i class="fa fa-file-audio-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-code-o');"><i class="fa fa-file-code-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-excel-o');"><i class="fa fa-file-excel-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-image-o');"><i class="fa fa-file-image-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-movie-o');"><i class="fa fa-file-movie-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-pdf-o');"><i class="fa fa-file-pdf-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-photo-o');"><i class="fa fa-file-photo-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-picture-o');"><i class="fa fa-file-picture-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-powerpoint-o');"><i class="fa fa-file-powerpoint-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-sound-o');"><i class="fa fa-file-sound-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-video-o');"><i class="fa fa-file-video-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-word-o');"><i class="fa fa-file-word-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-zip-o');"><i class="fa fa-file-zip-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-film');"><i class="fa fa-film"></i></li>
                    <li onclick="seta_icone_popup('fa fa-filter');"><i class="fa fa-filter"></i></li>
                    <li onclick="seta_icone_popup('fa fa-fire');"><i class="fa fa-fire"></i></li>
                    <li onclick="seta_icone_popup('fa fa-fire-extinguisher');"><i class="fa fa-fire-extinguisher"></i></li>
                    <li onclick="seta_icone_popup('fa fa-flag');"><i class="fa fa-flag"></i></li>
                    <li onclick="seta_icone_popup('fa fa-flag-checkered');"><i class="fa fa-flag-checkered"></i></li>
                    <li onclick="seta_icone_popup('fa fa-flag-o');"><i class="fa fa-flag-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-flash');"><i class="fa fa-flash"></i></li>
                    <li onclick="seta_icone_popup('fa fa-flask');"><i class="fa fa-flask"></i></li>
                    <li onclick="seta_icone_popup('fa fa-folder');"><i class="fa fa-folder"></i></li>
                    <li onclick="seta_icone_popup('fa fa-folder-o');"><i class="fa fa-folder-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-folder-open');"><i class="fa fa-folder-open"></i></li>
                    <li onclick="seta_icone_popup('fa fa-folder-open-o');"><i class="fa fa-folder-open-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-frown-o');"><i class="fa fa-frown-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-gamepad');"><i class="fa fa-gamepad"></i></li>
                    <li onclick="seta_icone_popup('fa fa-gavel');"><i class="fa fa-gavel"></i></li>
                    <li onclick="seta_icone_popup('fa fa-gear');"><i class="fa fa-gear"></i></li>
                    <li onclick="seta_icone_popup('fa fa-gears');"><i class="fa fa-gears"></i></li>
                    <li onclick="seta_icone_popup('fa fa-gift');"><i class="fa fa-gift"></i></li>
                    <li onclick="seta_icone_popup('fa fa-glass');"><i class="fa fa-glass"></i></li>
                    <li onclick="seta_icone_popup('fa fa-globe');"><i class="fa fa-globe"></i></li>
                    <li onclick="seta_icone_popup('fa fa-graduation-cap');"><i class="fa fa-graduation-cap"></i></li>
                    <li onclick="seta_icone_popup('fa fa-group');"><i class="fa fa-group"></i></li>
                    <li onclick="seta_icone_popup('fa fa-hdd-o');"><i class="fa fa-hdd-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-headphones');"><i class="fa fa-headphones"></i></li>
                    <li onclick="seta_icone_popup('fa fa-heart');"><i class="fa fa-heart"></i></li>
                    <li onclick="seta_icone_popup('fa fa-heart-o');"><i class="fa fa-heart-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-history');"><i class="fa fa-history"></i></li>
                    <li onclick="seta_icone_popup('fa fa-home');"><i class="fa fa-home"></i></li>
                    <li onclick="seta_icone_popup('fa fa-image');"><i class="fa fa-image"></i></li>
                    <li onclick="seta_icone_popup('fa fa-inbox');"><i class="fa fa-inbox"></i></li>
                    <li onclick="seta_icone_popup('fa fa-info');"><i class="fa fa-info"></i></li>
                    <li onclick="seta_icone_popup('fa fa-info-circle');"><i class="fa fa-info-circle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-institution');"><i class="fa fa-institution"></i></li>
                    <li onclick="seta_icone_popup('fa fa-key');"><i class="fa fa-key"></i></li>
                    <li onclick="seta_icone_popup('fa fa-keyboard-o');"><i class="fa fa-keyboard-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-language');"><i class="fa fa-language"></i></li>
                    <li onclick="seta_icone_popup('fa fa-laptop');"><i class="fa fa-laptop"></i></li>
                    <li onclick="seta_icone_popup('fa fa-leaf');"><i class="fa fa-leaf"></i></li>
                    <li onclick="seta_icone_popup('fa fa-legal');"><i class="fa fa-legal"></i></li>
                    <li onclick="seta_icone_popup('fa fa-lemon-o');"><i class="fa fa-lemon-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-level-down');"><i class="fa fa-level-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-level-up');"><i class="fa fa-level-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-life-bouy');"><i class="fa fa-life-bouy"></i></li>
                    <li onclick="seta_icone_popup('fa fa-life-ring');"><i class="fa fa-life-ring"></i></li>
                    <li onclick="seta_icone_popup('fa fa-life-saver');"><i class="fa fa-life-saver"></i></li>
                    <li onclick="seta_icone_popup('fa fa-lightbulb-o');"><i class="fa fa-lightbulb-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-location-arrow');"><i class="fa fa-location-arrow"></i></li>
                    <li onclick="seta_icone_popup('fa fa-lock');"><i class="fa fa-lock"></i></li>
                    <li onclick="seta_icone_popup('fa fa-magic');"><i class="fa fa-magic"></i></li>
                    <li onclick="seta_icone_popup('fa fa-magnet');"><i class="fa fa-magnet"></i></li>
                    <li onclick="seta_icone_popup('fa fa-mail-forward');"><i class="fa fa-mail-forward"></i></li>
                    <li onclick="seta_icone_popup('fa fa-mail-reply');"><i class="fa fa-mail-reply"></i></li>
                    <li onclick="seta_icone_popup('fa fa-mail-reply-all');"><i class="fa fa-mail-reply-all"></i></li>
                    <li onclick="seta_icone_popup('fa fa-male');"><i class="fa fa-male"></i></li>
                    <li onclick="seta_icone_popup('fa fa-map-marker');"><i class="fa fa-map-marker"></i></li>
                    <li onclick="seta_icone_popup('fa fa-meh-o');"><i class="fa fa-meh-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-microphone');"><i class="fa fa-microphone"></i></li>
                    <li onclick="seta_icone_popup('fa fa-microphone-slash');"><i class="fa fa-microphone-slash"></i></li>
                    <li onclick="seta_icone_popup('fa fa-minus');"><i class="fa fa-minus"></i></li>
                    <li onclick="seta_icone_popup('fa fa-minus-circle');"><i class="fa fa-minus-circle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-minus-square');"><i class="fa fa-minus-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-minus-square-o');"><i class="fa fa-minus-square-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-mobile');"><i class="fa fa-mobile"></i></li>
                    <li onclick="seta_icone_popup('fa fa-mobile-phone');"><i class="fa fa-mobile-phone"></i></li>
                    <li onclick="seta_icone_popup('fa fa-money');"><i class="fa fa-money"></i></li>
                    <li onclick="seta_icone_popup('fa fa-moon-o');"><i class="fa fa-moon-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-mortar-board');"><i class="fa fa-mortar-board"></i></li>
                    <li onclick="seta_icone_popup('fa fa-music');"><i class="fa fa-music"></i></li>
                    <li onclick="seta_icone_popup('fa fa-navicon');"><i class="fa fa-navicon"></i></li>
                    <li onclick="seta_icone_popup('fa fa-paper-plane');"><i class="fa fa-paper-plane"></i></li>
                    <li onclick="seta_icone_popup('fa fa-paper-plane-o');"><i class="fa fa-paper-plane-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-paw');"><i class="fa fa-paw"></i></li>
                    <li onclick="seta_icone_popup('fa fa-pencil');"><i class="fa fa-pencil"></i></li>
                    <li onclick="seta_icone_popup('fa fa-pencil-square');"><i class="fa fa-pencil-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-pencil-square-o');"><i class="fa fa-pencil-square-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-phone');"><i class="fa fa-phone"></i></li>
                    <li onclick="seta_icone_popup('fa fa-phone-square');"><i class="fa fa-phone-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-photo');"><i class="fa fa-photo"></i></li>
                    <li onclick="seta_icone_popup('fa fa-picture-o');"><i class="fa fa-picture-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-plane');"><i class="fa fa-plane"></i></li>
                    <li onclick="seta_icone_popup('fa fa-plus');"><i class="fa fa-plus"></i></li>
                    <li onclick="seta_icone_popup('fa fa-plus-circle');"><i class="fa fa-plus-circle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-plus-square');"><i class="fa fa-plus-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-plus-square-o');"><i class="fa fa-plus-square-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-power-off');"><i class="fa fa-power-off"></i></li>
                    <li onclick="seta_icone_popup('fa fa-print');"><i class="fa fa-print"></i></li>
                    <li onclick="seta_icone_popup('fa fa-puzzle-piece');"><i class="fa fa-puzzle-piece"></i></li>
                    <li onclick="seta_icone_popup('fa fa-qrcode');"><i class="fa fa-qrcode"></i></li>
                    <li onclick="seta_icone_popup('fa fa-question');"><i class="fa fa-question"></i></li>
                    <li onclick="seta_icone_popup('fa fa-question-circle');"><i class="fa fa-question-circle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-quote-left');"><i class="fa fa-quote-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-quote-right');"><i class="fa fa-quote-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-random');"><i class="fa fa-random"></i></li>
                    <li onclick="seta_icone_popup('fa fa-recycle');"><i class="fa fa-recycle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-refresh');"><i class="fa fa-refresh"></i></li>
                    <li onclick="seta_icone_popup('fa fa-reorder');"><i class="fa fa-reorder"></i></li>
                    <li onclick="seta_icone_popup('fa fa-reply');"><i class="fa fa-reply"></i></li>
                    <li onclick="seta_icone_popup('fa fa-reply-all');"><i class="fa fa-reply-all"></i></li>
                    <li onclick="seta_icone_popup('fa fa-retweet');"><i class="fa fa-retweet"></i></li>
                    <li onclick="seta_icone_popup('fa fa-road');"><i class="fa fa-road"></i></li>
                    <li onclick="seta_icone_popup('fa fa-rocket');"><i class="fa fa-rocket"></i></li>
                    <li onclick="seta_icone_popup('fa fa-rss');"><i class="fa fa-rss"></i></li>
                    <li onclick="seta_icone_popup('fa fa-rss-square');"><i class="fa fa-rss-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-search');"><i class="fa fa-search"></i></li>
                    <li onclick="seta_icone_popup('fa fa-search-minus');"><i class="fa fa-search-minus"></i></li>
                    <li onclick="seta_icone_popup('fa fa-search-plus');"><i class="fa fa-search-plus"></i></li>
                    <li onclick="seta_icone_popup('fa fa-send');"><i class="fa fa-send"></i></li>
                    <li onclick="seta_icone_popup('fa fa-send-o');"><i class="fa fa-send-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-share');"><i class="fa fa-share"></i></li>
                    <li onclick="seta_icone_popup('fa fa-share-alt');"><i class="fa fa-share-alt"></i></li>
                    <li onclick="seta_icone_popup('fa fa-share-alt-square');"><i class="fa fa-share-alt-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-share-square');"><i class="fa fa-share-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-share-square-o');"><i class="fa fa-share-square-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-shield');"><i class="fa fa-shield"></i></li>
                    <li onclick="seta_icone_popup('fa fa-shopping-cart');"><i class="fa fa-shopping-cart"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sign-in');"><i class="fa fa-sign-in"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sign-out');"><i class="fa fa-sign-out"></i></li>
                    <li onclick="seta_icone_popup('fa fa-signal');"><i class="fa fa-signal"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sitemap');"><i class="fa fa-sitemap"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sliders');"><i class="fa fa-sliders"></i></li>
                    <li onclick="seta_icone_popup('fa fa-smile-o');"><i class="fa fa-smile-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sort');"><i class="fa fa-sort"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sort-alpha-asc');"><i class="fa fa-sort-alpha-asc"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sort-alpha-desc');"><i class="fa fa-sort-alpha-desc"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sort-amount-asc');"><i class="fa fa-sort-amount-asc"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sort-amount-desc');"><i class="fa fa-sort-amount-desc"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sort-asc');"><i class="fa fa-sort-asc"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sort-desc');"><i class="fa fa-sort-desc"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sort-down');"><i class="fa fa-sort-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sort-numeric-asc');"><i class="fa fa-sort-numeric-asc"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sort-numeric-desc');"><i class="fa fa-sort-numeric-desc"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sort-up');"><i class="fa fa-sort-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-space-shuttle');"><i class="fa fa-space-shuttle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-spinner');"><i class="fa fa-spinner"></i></li>
                    <li onclick="seta_icone_popup('fa fa-spoon');"><i class="fa fa-spoon"></i></li>
                    <li onclick="seta_icone_popup('fa fa-square');"><i class="fa fa-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-square-o');"><i class="fa fa-square-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-star');"><i class="fa fa-star"></i></li>
                    <li onclick="seta_icone_popup('fa fa-star-half');"><i class="fa fa-star-half"></i></li>
                    <li onclick="seta_icone_popup('fa fa-star-half-empty');"><i class="fa fa-star-half-empty"></i></li>
                    <li onclick="seta_icone_popup('fa fa-star-half-full');"><i class="fa fa-star-half-full"></i></li>
                    <li onclick="seta_icone_popup('fa fa-star-half-o');"><i class="fa fa-star-half-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-star-o');"><i class="fa fa-star-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-suitcase');"><i class="fa fa-suitcase"></i></li>
                    <li onclick="seta_icone_popup('fa fa-sun-o');"><i class="fa fa-sun-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-support');"><i class="fa fa-support"></i></li>
                    <li onclick="seta_icone_popup('fa fa-tablet');"><i class="fa fa-tablet"></i></li>
                    <li onclick="seta_icone_popup('fa fa-tachometer');"><i class="fa fa-tachometer"></i></li>
                    <li onclick="seta_icone_popup('fa fa-tag');"><i class="fa fa-tag"></i></li>
                    <li onclick="seta_icone_popup('fa fa-tags');"><i class="fa fa-tags"></i></li>
                    <li onclick="seta_icone_popup('fa fa-tasks');"><i class="fa fa-tasks"></i></li>
                    <li onclick="seta_icone_popup('fa fa-taxi');"><i class="fa fa-taxi"></i></li>
                    <li onclick="seta_icone_popup('fa fa-terminal');"><i class="fa fa-terminal"></i></li>
                    <li onclick="seta_icone_popup('fa fa-thumb-tack');"><i class="fa fa-thumb-tack"></i></li>
                    <li onclick="seta_icone_popup('fa fa-thumbs-down');"><i class="fa fa-thumbs-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-thumbs-o-down');"><i class="fa fa-thumbs-o-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-thumbs-o-up');"><i class="fa fa-thumbs-o-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-thumbs-up');"><i class="fa fa-thumbs-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-ticket');"><i class="fa fa-ticket"></i></li>
                    <li onclick="seta_icone_popup('fa fa-times');"><i class="fa fa-times"></i></li>
                    <li onclick="seta_icone_popup('fa fa-times-circle');"><i class="fa fa-times-circle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-times-circle-o');"><i class="fa fa-times-circle-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-tint');"><i class="fa fa-tint"></i></li>
                    <li onclick="seta_icone_popup('fa fa-toggle-down');"><i class="fa fa-toggle-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-toggle-left');"><i class="fa fa-toggle-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-toggle-right');"><i class="fa fa-toggle-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-toggle-up');"><i class="fa fa-toggle-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-trash-o');"><i class="fa fa-trash-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-tree');"><i class="fa fa-tree"></i></li>
                    <li onclick="seta_icone_popup('fa fa-trophy');"><i class="fa fa-trophy"></i></li>
                    <li onclick="seta_icone_popup('fa fa-truck');"><i class="fa fa-truck"></i></li>
                    <li onclick="seta_icone_popup('fa fa-umbrella');"><i class="fa fa-umbrella"></i></li>
                    <li onclick="seta_icone_popup('fa fa-university');"><i class="fa fa-university"></i></li>
                    <li onclick="seta_icone_popup('fa fa-unlock');"><i class="fa fa-unlock"></i></li>
                    <li onclick="seta_icone_popup('fa fa-unlock-alt');"><i class="fa fa-unlock-alt"></i></li>
                    <li onclick="seta_icone_popup('fa fa-unsorted');"><i class="fa fa-unsorted"></i></li>
                    <li onclick="seta_icone_popup('fa fa-upload');"><i class="fa fa-upload"></i></li>
                    <li onclick="seta_icone_popup('fa fa-user');"><i class="fa fa-user"></i></li>
                    <li onclick="seta_icone_popup('fa fa-users');"><i class="fa fa-users"></i></li>
                    <li onclick="seta_icone_popup('fa fa-video-camera');"><i class="fa fa-video-camera"></i></li>
                    <li onclick="seta_icone_popup('fa fa-volume-down');"><i class="fa fa-volume-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-volume-off');"><i class="fa fa-volume-off"></i></li>
                    <li onclick="seta_icone_popup('fa fa-volume-up');"><i class="fa fa-volume-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-warning');"><i class="fa fa-warning"></i></li>
                    <li onclick="seta_icone_popup('fa fa-wheelchair');"><i class="fa fa-wheelchair"></i></li>
                    <li onclick="seta_icone_popup('fa fa-wrench');"><i class="fa fa-wrench"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file');"><i class="fa fa-file"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-archive-o');"><i class="fa fa-file-archive-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-audio-o');"><i class="fa fa-file-audio-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-code-o');"><i class="fa fa-file-code-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-excel-o');"><i class="fa fa-file-excel-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-image-o');"><i class="fa fa-file-image-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-movie-o');"><i class="fa fa-file-movie-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-o');"><i class="fa fa-file-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-pdf-o');"><i class="fa fa-file-pdf-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-photo-o');"><i class="fa fa-file-photo-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-picture-o');"><i class="fa fa-file-picture-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-powerpoint-o');"><i class="fa fa-file-powerpoint-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-sound-o');"><i class="fa fa-file-sound-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-text');"><i class="fa fa-file-text"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-text-o');"><i class="fa fa-file-text-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-video-o');"><i class="fa fa-file-video-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-word-o');"><i class="fa fa-file-word-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-zip-o');"><i class="fa fa-file-zip-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-circle-o-notch');"><i class="fa fa-circle-o-notch"></i></li>
                    <li onclick="seta_icone_popup('fa fa-cog');"><i class="fa fa-cog"></i></li>
                    <li onclick="seta_icone_popup('fa fa-gear');"><i class="fa fa-gear"></i></li>
                    <li onclick="seta_icone_popup('fa fa-refresh');"><i class="fa fa-refresh"></i></li>
                    <li onclick="seta_icone_popup('fa fa-spinner');"><i class="fa fa-spinner"></i></li>
                    <li onclick="seta_icone_popup('fa fa-check-square');"><i class="fa fa-check-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-check-square-o');"><i class="fa fa-check-square-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-circle');"><i class="fa fa-circle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-circle-o');"><i class="fa fa-circle-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-dot-circle-o');"><i class="fa fa-dot-circle-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-minus-square');"><i class="fa fa-minus-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-minus-square-o');"><i class="fa fa-minus-square-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-plus-square');"><i class="fa fa-plus-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-plus-square-o');"><i class="fa fa-plus-square-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-square');"><i class="fa fa-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-square-o');"><i class="fa fa-square-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bitcoin');"><i class="fa fa-bitcoin"></i></li>
                    <li onclick="seta_icone_popup('fa fa-btc');"><i class="fa fa-btc"></i></li>
                    <li onclick="seta_icone_popup('fa fa-cny');"><i class="fa fa-cny"></i></li>
                    <li onclick="seta_icone_popup('fa fa-dollar');"><i class="fa fa-dollar"></i></li>
                    <li onclick="seta_icone_popup('fa fa-eur');"><i class="fa fa-eur"></i></li>
                    <li onclick="seta_icone_popup('fa fa-euro');"><i class="fa fa-euro"></i></li>
                    <li onclick="seta_icone_popup('fa fa-gbp');"><i class="fa fa-gbp"></i></li>
                    <li onclick="seta_icone_popup('fa fa-inr');"><i class="fa fa-inr"></i></li>
                    <li onclick="seta_icone_popup('fa fa-jpy');"><i class="fa fa-jpy"></i></li>
                    <li onclick="seta_icone_popup('fa fa-krw');"><i class="fa fa-krw"></i></li>
                    <li onclick="seta_icone_popup('fa fa-money');"><i class="fa fa-money"></i></li>
                    <li onclick="seta_icone_popup('fa fa-rmb');"><i class="fa fa-rmb"></i></li>
                    <li onclick="seta_icone_popup('fa fa-rouble');"><i class="fa fa-rouble"></i></li>
                    <li onclick="seta_icone_popup('fa fa-rub');"><i class="fa fa-rub"></i></li>
                    <li onclick="seta_icone_popup('fa fa-ruble');"><i class="fa fa-ruble"></i></li>
                    <li onclick="seta_icone_popup('fa fa-rupee');"><i class="fa fa-rupee"></i></li>
                    <li onclick="seta_icone_popup('fa fa-try');"><i class="fa fa-try"></i></li>
                    <li onclick="seta_icone_popup('fa fa-turkish-lira');"><i class="fa fa-turkish-lira"></i></li>
                    <li onclick="seta_icone_popup('fa fa-usd');"><i class="fa fa-usd"></i></li>
                    <li onclick="seta_icone_popup('fa fa-won');"><i class="fa fa-won"></i></li>
                    <li onclick="seta_icone_popup('fa fa-yen');"><i class="fa fa-yen"></i></li>
                    <li onclick="seta_icone_popup('fa fa-align-center');"><i class="fa fa-align-center"></i></li>
                    <li onclick="seta_icone_popup('fa fa-align-justify');"><i class="fa fa-align-justify"></i></li>
                    <li onclick="seta_icone_popup('fa fa-align-left');"><i class="fa fa-align-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-align-right');"><i class="fa fa-align-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bold');"><i class="fa fa-bold"></i></li>
                    <li onclick="seta_icone_popup('fa fa-chain');"><i class="fa fa-chain"></i></li>
                    <li onclick="seta_icone_popup('fa fa-chain-broken');"><i class="fa fa-chain-broken"></i></li>
                    <li onclick="seta_icone_popup('fa fa-clipboard');"><i class="fa fa-clipboard"></i></li>
                    <li onclick="seta_icone_popup('fa fa-columns');"><i class="fa fa-columns"></i></li>
                    <li onclick="seta_icone_popup('fa fa-copy');"><i class="fa fa-copy"></i></li>
                    <li onclick="seta_icone_popup('fa fa-cut');"><i class="fa fa-cut"></i></li>
                    <li onclick="seta_icone_popup('fa fa-dedent');"><i class="fa fa-dedent"></i></li>
                    <li onclick="seta_icone_popup('fa fa-eraser');"><i class="fa fa-eraser"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file');"><i class="fa fa-file"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-o');"><i class="fa fa-file-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-text');"><i class="fa fa-file-text"></i></li>
                    <li onclick="seta_icone_popup('fa fa-file-text-o');"><i class="fa fa-file-text-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-files-o');"><i class="fa fa-files-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-floppy-o');"><i class="fa fa-floppy-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-font');"><i class="fa fa-font"></i></li>
                    <li onclick="seta_icone_popup('fa fa-header');"><i class="fa fa-header"></i></li>
                    <li onclick="seta_icone_popup('fa fa-indent');"><i class="fa fa-indent"></i></li>
                    <li onclick="seta_icone_popup('fa fa-italic');"><i class="fa fa-italic"></i></li>
                    <li onclick="seta_icone_popup('fa fa-link');"><i class="fa fa-link"></i></li>
                    <li onclick="seta_icone_popup('fa fa-list');"><i class="fa fa-list"></i></li>
                    <li onclick="seta_icone_popup('fa fa-list-alt');"><i class="fa fa-list-alt"></i></li>
                    <li onclick="seta_icone_popup('fa fa-list-ol');"><i class="fa fa-list-ol"></i></li>
                    <li onclick="seta_icone_popup('fa fa-list-ul');"><i class="fa fa-list-ul"></i></li>
                    <li onclick="seta_icone_popup('fa fa-outdent');"><i class="fa fa-outdent"></i></li>
                    <li onclick="seta_icone_popup('fa fa-paperclip');"><i class="fa fa-paperclip"></i></li>
                    <li onclick="seta_icone_popup('fa fa-paragraph');"><i class="fa fa-paragraph"></i></li>
                    <li onclick="seta_icone_popup('fa fa-paste');"><i class="fa fa-paste"></i></li>
                    <li onclick="seta_icone_popup('fa fa-repeat');"><i class="fa fa-repeat"></i></li>
                    <li onclick="seta_icone_popup('fa fa-rotate-left');"><i class="fa fa-rotate-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-rotate-right');"><i class="fa fa-rotate-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-save');"><i class="fa fa-save"></i></li>
                    <li onclick="seta_icone_popup('fa fa-scissors');"><i class="fa fa-scissors"></i></li>
                    <li onclick="seta_icone_popup('fa fa-strikethrough');"><i class="fa fa-strikethrough"></i></li>
                    <li onclick="seta_icone_popup('fa fa-subscript');"><i class="fa fa-subscript"></i></li>
                    <li onclick="seta_icone_popup('fa fa-superscript');"><i class="fa fa-superscript"></i></li>
                    <li onclick="seta_icone_popup('fa fa-table');"><i class="fa fa-table"></i></li>
                    <li onclick="seta_icone_popup('fa fa-text-height');"><i class="fa fa-text-height"></i></li>
                    <li onclick="seta_icone_popup('fa fa-text-width');"><i class="fa fa-text-width"></i></li>
                    <li onclick="seta_icone_popup('fa fa-th');"><i class="fa fa-th"></i></li>
                    <li onclick="seta_icone_popup('fa fa-th-large');"><i class="fa fa-th-large"></i></li>
                    <li onclick="seta_icone_popup('fa fa-th-list');"><i class="fa fa-th-list"></i></li>
                    <li onclick="seta_icone_popup('fa fa-underline');"><i class="fa fa-underline"></i></li>
                    <li onclick="seta_icone_popup('fa fa-undo');"><i class="fa fa-undo"></i></li>
                    <li onclick="seta_icone_popup('fa fa-unlink');"><i class="fa fa-unlink"></i></li>
                    <li onclick="seta_icone_popup('fa fa-angle-double-down');"><i class="fa fa-angle-double-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-angle-double-left');"><i class="fa fa-angle-double-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-angle-double-right');"><i class="fa fa-angle-double-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-angle-double-up');"><i class="fa fa-angle-double-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-angle-down');"><i class="fa fa-angle-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-angle-left');"><i class="fa fa-angle-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-angle-right');"><i class="fa fa-angle-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-angle-up');"><i class="fa fa-angle-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrow-circle-down');"><i class="fa fa-arrow-circle-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrow-circle-left');"><i class="fa fa-arrow-circle-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrow-circle-o-down');"><i class="fa fa-arrow-circle-o-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrow-circle-o-left');"><i class="fa fa-arrow-circle-o-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrow-circle-o-right');"><i class="fa fa-arrow-circle-o-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrow-circle-o-up');"><i class="fa fa-arrow-circle-o-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrow-circle-right');"><i class="fa fa-arrow-circle-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrow-circle-up');"><i class="fa fa-arrow-circle-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrow-down');"><i class="fa fa-arrow-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrow-left');"><i class="fa fa-arrow-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrow-right');"><i class="fa fa-arrow-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrow-up');"><i class="fa fa-arrow-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrows');"><i class="fa fa-arrows"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrows-alt');"><i class="fa fa-arrows-alt"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrows-h');"><i class="fa fa-arrows-h"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrows-v');"><i class="fa fa-arrows-v"></i></li>
                    <li onclick="seta_icone_popup('fa fa-caret-down');"><i class="fa fa-caret-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-caret-left');"><i class="fa fa-caret-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-caret-right');"><i class="fa fa-caret-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-caret-square-o-down');"><i class="fa fa-caret-square-o-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-caret-square-o-left');"><i class="fa fa-caret-square-o-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-caret-square-o-right');"><i class="fa fa-caret-square-o-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-caret-square-o-up');"><i class="fa fa-caret-square-o-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-caret-up');"><i class="fa fa-caret-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-chevron-circle-down');"><i class="fa fa-chevron-circle-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-chevron-circle-left');"><i class="fa fa-chevron-circle-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-chevron-circle-right');"><i class="fa fa-chevron-circle-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-chevron-circle-up');"><i class="fa fa-chevron-circle-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-chevron-down');"><i class="fa fa-chevron-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-chevron-left');"><i class="fa fa-chevron-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-chevron-right');"><i class="fa fa-chevron-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-chevron-up');"><i class="fa fa-chevron-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-hand-o-down');"><i class="fa fa-hand-o-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-hand-o-left');"><i class="fa fa-hand-o-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-hand-o-right');"><i class="fa fa-hand-o-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-hand-o-up');"><i class="fa fa-hand-o-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-long-arrow-down');"><i class="fa fa-long-arrow-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-long-arrow-left');"><i class="fa fa-long-arrow-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-long-arrow-right');"><i class="fa fa-long-arrow-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-long-arrow-up');"><i class="fa fa-long-arrow-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-toggle-down');"><i class="fa fa-toggle-down"></i></li>
                    <li onclick="seta_icone_popup('fa fa-toggle-left');"><i class="fa fa-toggle-left"></i></li>
                    <li onclick="seta_icone_popup('fa fa-toggle-right');"><i class="fa fa-toggle-right"></i></li>
                    <li onclick="seta_icone_popup('fa fa-toggle-up');"><i class="fa fa-toggle-up"></i></li>
                    <li onclick="seta_icone_popup('fa fa-arrows-alt');"><i class="fa fa-arrows-alt"></i></li>
                    <li onclick="seta_icone_popup('fa fa-backward');"><i class="fa fa-backward"></i></li>
                    <li onclick="seta_icone_popup('fa fa-compress');"><i class="fa fa-compress"></i></li>
                    <li onclick="seta_icone_popup('fa fa-eject');"><i class="fa fa-eject"></i></li>
                    <li onclick="seta_icone_popup('fa fa-expand');"><i class="fa fa-expand"></i></li>
                    <li onclick="seta_icone_popup('fa fa-fast-backward');"><i class="fa fa-fast-backward"></i></li>
                    <li onclick="seta_icone_popup('fa fa-fast-forward');"><i class="fa fa-fast-forward"></i></li>
                    <li onclick="seta_icone_popup('fa fa-forward');"><i class="fa fa-forward"></i></li>
                    <li onclick="seta_icone_popup('fa fa-pause');"><i class="fa fa-pause"></i></li>
                    <li onclick="seta_icone_popup('fa fa-play');"><i class="fa fa-play"></i></li>
                    <li onclick="seta_icone_popup('fa fa-play-circle');"><i class="fa fa-play-circle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-play-circle-o');"><i class="fa fa-play-circle-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-step-backward');"><i class="fa fa-step-backward"></i></li>
                    <li onclick="seta_icone_popup('fa fa-step-forward');"><i class="fa fa-step-forward"></i></li>
                    <li onclick="seta_icone_popup('fa fa-stop');"><i class="fa fa-stop"></i></li>
                    <li onclick="seta_icone_popup('fa fa-youtube-play');"><i class="fa fa-youtube-play"></i></li>
                    <li onclick="seta_icone_popup('fa fa-adn');"><i class="fa fa-adn"></i></li>
                    <li onclick="seta_icone_popup('fa fa-android');"><i class="fa fa-android"></i></li>
                    <li onclick="seta_icone_popup('fa fa-apple');"><i class="fa fa-apple"></i></li>
                    <li onclick="seta_icone_popup('fa fa-behance');"><i class="fa fa-behance"></i></li>
                    <li onclick="seta_icone_popup('fa fa-behance-square');"><i class="fa fa-behance-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bitbucket');"><i class="fa fa-bitbucket"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bitbucket-square');"><i class="fa fa-bitbucket-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-bitcoin');"><i class="fa fa-bitcoin"></i></li>
                    <li onclick="seta_icone_popup('fa fa-btc');"><i class="fa fa-btc"></i></li>
                    <li onclick="seta_icone_popup('fa fa-codepen');"><i class="fa fa-codepen"></i></li>
                    <li onclick="seta_icone_popup('fa fa-css3');"><i class="fa fa-css3"></i></li>
                    <li onclick="seta_icone_popup('fa fa-delicious');"><i class="fa fa-delicious"></i></li>
                    <li onclick="seta_icone_popup('fa fa-deviantart');"><i class="fa fa-deviantart"></i></li>
                    <li onclick="seta_icone_popup('fa fa-digg');"><i class="fa fa-digg"></i></li>
                    <li onclick="seta_icone_popup('fa fa-dribbble');"><i class="fa fa-dribbble"></i></li>
                    <li onclick="seta_icone_popup('fa fa-dropbox');"><i class="fa fa-dropbox"></i></li>
                    <li onclick="seta_icone_popup('fa fa-drupal');"><i class="fa fa-drupal"></i></li>
                    <li onclick="seta_icone_popup('fa fa-empire');"><i class="fa fa-empire"></i></li>
                    <li onclick="seta_icone_popup('fa fa-facebook');"><i class="fa fa-facebook"></i></li>
                    <li onclick="seta_icone_popup('fa fa-facebook-square');"><i class="fa fa-facebook-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-flickr');"><i class="fa fa-flickr"></i></li>
                    <li onclick="seta_icone_popup('fa fa-foursquare');"><i class="fa fa-foursquare"></i></li>
                    <li onclick="seta_icone_popup('fa fa-ge');"><i class="fa fa-ge"></i></li>
                    <li onclick="seta_icone_popup('fa fa-git');"><i class="fa fa-git"></i></li>
                    <li onclick="seta_icone_popup('fa fa-git-square');"><i class="fa fa-git-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-github');"><i class="fa fa-github"></i></li>
                    <li onclick="seta_icone_popup('fa fa-github-alt');"><i class="fa fa-github-alt"></i></li>
                    <li onclick="seta_icone_popup('fa fa-github-square');"><i class="fa fa-github-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-gittip');"><i class="fa fa-gittip"></i></li>
                    <li onclick="seta_icone_popup('fa fa-google');"><i class="fa fa-google"></i></li>
                    <li onclick="seta_icone_popup('fa fa-google-plus');"><i class="fa fa-google-plus"></i></li>
                    <li onclick="seta_icone_popup('fa fa-google-plus-square');"><i class="fa fa-google-plus-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-hacker-news');"><i class="fa fa-hacker-news"></i></li>
                    <li onclick="seta_icone_popup('fa fa-html5');"><i class="fa fa-html5"></i></li>
                    <li onclick="seta_icone_popup('fa fa-instagram');"><i class="fa fa-instagram"></i></li>
                    <li onclick="seta_icone_popup('fa fa-joomla');"><i class="fa fa-joomla"></i></li>
                    <li onclick="seta_icone_popup('fa fa-jsfiddle');"><i class="fa fa-jsfiddle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-linkedin');"><i class="fa fa-linkedin"></i></li>
                    <li onclick="seta_icone_popup('fa fa-linkedin-square');"><i class="fa fa-linkedin-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-linux');"><i class="fa fa-linux"></i></li>
                    <li onclick="seta_icone_popup('fa fa-maxcdn');"><i class="fa fa-maxcdn"></i></li>
                    <li onclick="seta_icone_popup('fa fa-openid');"><i class="fa fa-openid"></i></li>
                    <li onclick="seta_icone_popup('fa fa-pagelines');"><i class="fa fa-pagelines"></i></li>
                    <li onclick="seta_icone_popup('fa fa-pied-piper');"><i class="fa fa-pied-piper"></i></li>
                    <li onclick="seta_icone_popup('fa fa-pied-piper-alt');"><i class="fa fa-pied-piper-alt"></i></li>
                    <li onclick="seta_icone_popup('fa fa-pied-piper-square');"><i class="fa fa-pied-piper-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-pinterest');"><i class="fa fa-pinterest"></i></li>
                    <li onclick="seta_icone_popup('fa fa-pinterest-square');"><i class="fa fa-pinterest-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-qq');"><i class="fa fa-qq"></i></li>
                    <li onclick="seta_icone_popup('fa fa-ra');"><i class="fa fa-ra"></i></li>
                    <li onclick="seta_icone_popup('fa fa-rebel');"><i class="fa fa-rebel"></i></li>
                    <li onclick="seta_icone_popup('fa fa-reddit');"><i class="fa fa-reddit"></i></li>
                    <li onclick="seta_icone_popup('fa fa-reddit-square');"><i class="fa fa-reddit-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-renren');"><i class="fa fa-renren"></i></li>
                    <li onclick="seta_icone_popup('fa fa-share-alt');"><i class="fa fa-share-alt"></i></li>
                    <li onclick="seta_icone_popup('fa fa-share-alt-square');"><i class="fa fa-share-alt-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-skype');"><i class="fa fa-skype"></i></li>
                    <li onclick="seta_icone_popup('fa fa-slack');"><i class="fa fa-slack"></i></li>
                    <li onclick="seta_icone_popup('fa fa-soundcloud');"><i class="fa fa-soundcloud"></i></li>
                    <li onclick="seta_icone_popup('fa fa-spotify');"><i class="fa fa-spotify"></i></li>
                    <li onclick="seta_icone_popup('fa fa-stack-exchange');"><i class="fa fa-stack-exchange"></i></li>
                    <li onclick="seta_icone_popup('fa fa-stack-overflow');"><i class="fa fa-stack-overflow"></i></li>
                    <li onclick="seta_icone_popup('fa fa-steam');"><i class="fa fa-steam"></i></li>
                    <li onclick="seta_icone_popup('fa fa-steam-square');"><i class="fa fa-steam-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-stumbleupon');"><i class="fa fa-stumbleupon"></i></li>
                    <li onclick="seta_icone_popup('fa fa-stumbleupon-circle');"><i class="fa fa-stumbleupon-circle"></i></li>
                    <li onclick="seta_icone_popup('fa fa-tencent-weibo');"><i class="fa fa-tencent-weibo"></i></li>
                    <li onclick="seta_icone_popup('fa fa-trello');"><i class="fa fa-trello"></i></li>
                    <li onclick="seta_icone_popup('fa fa-tumblr');"><i class="fa fa-tumblr"></i></li>
                    <li onclick="seta_icone_popup('fa fa-tumblr-square');"><i class="fa fa-tumblr-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-twitter');"><i class="fa fa-twitter"></i></li>
                    <li onclick="seta_icone_popup('fa fa-twitter-square');"><i class="fa fa-twitter-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-vimeo-square');"><i class="fa fa-vimeo-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-vine');"><i class="fa fa-vine"></i></li>
                    <li onclick="seta_icone_popup('fa fa-vk');"><i class="fa fa-vk"></i></li>
                    <li onclick="seta_icone_popup('fa fa-wechat');"><i class="fa fa-wechat"></i></li>
                    <li onclick="seta_icone_popup('fa fa-weibo');"><i class="fa fa-weibo"></i></li>
                    <li onclick="seta_icone_popup('fa fa-weixin');"><i class="fa fa-weixin"></i></li>
                    <li onclick="seta_icone_popup('fa fa-windows');"><i class="fa fa-windows"></i></li>
                    <li onclick="seta_icone_popup('fa fa-wordpress');"><i class="fa fa-wordpress"></i></li>
                    <li onclick="seta_icone_popup('fa fa-xing');"><i class="fa fa-xing"></i></li>
                    <li onclick="seta_icone_popup('fa fa-xing-square');"><i class="fa fa-xing-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-yahoo');"><i class="fa fa-yahoo"></i></li>
                    <li onclick="seta_icone_popup('fa fa-youtube');"><i class="fa fa-youtube"></i></li>
                    <li onclick="seta_icone_popup('fa fa-youtube-play');"><i class="fa fa-youtube-play"></i></li>
                    <li onclick="seta_icone_popup('fa fa-youtube-square');"><i class="fa fa-youtube-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-ambulance');"><i class="fa fa-ambulance"></i></li>
                    <li onclick="seta_icone_popup('fa fa-h-square');"><i class="fa fa-h-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-hospital-o');"><i class="fa fa-hospital-o"></i></li>
                    <li onclick="seta_icone_popup('fa fa-medkit');"><i class="fa fa-medkit"></i></li>
                    <li onclick="seta_icone_popup('fa fa-plus-square');"><i class="fa fa-plus-square"></i></li>
                    <li onclick="seta_icone_popup('fa fa-stethoscope');"><i class="fa fa-stethoscope"></i></li>
                    <li onclick="seta_icone_popup('fa fa-user-md');"><i class="fa fa-user-md"></i></li>
                    <li onclick="seta_icone_popup('fa fa-wheelchair');"><i class="fa fa-wheelchair"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-asterisk');"><i class="glyphicon glyphicon-asterisk"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-plus');"><i class="glyphicon glyphicon-plus"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-euro');"><i class="glyphicon glyphicon-euro"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-minus');"><i class="glyphicon glyphicon-minus"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-cloud');"><i class="glyphicon glyphicon-cloud"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-envelope');"><i class="glyphicon glyphicon-envelope"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-pencil');"><i class="glyphicon glyphicon-pencil"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-glass');"><i class="glyphicon glyphicon-glass"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-music');"><i class="glyphicon glyphicon-music"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-search');"><i class="glyphicon glyphicon-search"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-heart');"><i class="glyphicon glyphicon-heart"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-star');"><i class="glyphicon glyphicon-star"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-star-empty');"><i class="glyphicon glyphicon-star-empty"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-user');"><i class="glyphicon glyphicon-user"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-film');"><i class="glyphicon glyphicon-film"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-th-large');"><i class="glyphicon glyphicon-th-large"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-th');"><i class="glyphicon glyphicon-th"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-th-list');"><i class="glyphicon glyphicon-th-list"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-ok');"><i class="glyphicon glyphicon-ok"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-remove');"><i class="glyphicon glyphicon-remove"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-zoom-in');"><i class="glyphicon glyphicon-zoom-in"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-zoom-out');"><i class="glyphicon glyphicon-zoom-out"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-off');"><i class="glyphicon glyphicon-off"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-signal');"><i class="glyphicon glyphicon-signal"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-cog');"><i class="glyphicon glyphicon-cog"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-trash');"><i class="glyphicon glyphicon-trash"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-home');"><i class="glyphicon glyphicon-home"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-file');"><i class="glyphicon glyphicon-file"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-time');"><i class="glyphicon glyphicon-time"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-road');"><i class="glyphicon glyphicon-road"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-download-alt');"><i class="glyphicon glyphicon-download-alt"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-download');"><i class="glyphicon glyphicon-download"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-upload');"><i class="glyphicon glyphicon-upload"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-inbox');"><i class="glyphicon glyphicon-inbox"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-play-circle');"><i class="glyphicon glyphicon-play-circle"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-repeat');"><i class="glyphicon glyphicon-repeat"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-refresh');"><i class="glyphicon glyphicon-refresh"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-list-alt');"><i class="glyphicon glyphicon-list-alt"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-lock');"><i class="glyphicon glyphicon-lock"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-flag');"><i class="glyphicon glyphicon-flag"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-headphones');"><i class="glyphicon glyphicon-headphones"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-volume-off');"><i class="glyphicon glyphicon-volume-off"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-volume-down');"><i class="glyphicon glyphicon-volume-down"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-volume-up');"><i class="glyphicon glyphicon-volume-up"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-qrcode');"><i class="glyphicon glyphicon-qrcode"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-barcode');"><i class="glyphicon glyphicon-barcode"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-tag');"><i class="glyphicon glyphicon-tag"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-tags');"><i class="glyphicon glyphicon-tags"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-book');"><i class="glyphicon glyphicon-book"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-bookmark');"><i class="glyphicon glyphicon-bookmark"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-print');"><i class="glyphicon glyphicon-print"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-camera');"><i class="glyphicon glyphicon-camera"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-font');"><i class="glyphicon glyphicon-font"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-bold');"><i class="glyphicon glyphicon-bold"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-italic');"><i class="glyphicon glyphicon-italic"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-text-height');"><i class="glyphicon glyphicon-text-height"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-text-width');"><i class="glyphicon glyphicon-text-width"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-align-left');"><i class="glyphicon glyphicon-align-left"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-align-center');"><i class="glyphicon glyphicon-align-center"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-align-right');"><i class="glyphicon glyphicon-align-right"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-align-justify');"><i class="glyphicon glyphicon-align-justify"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-list');"><i class="glyphicon glyphicon-list"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-indent-left');"><i class="glyphicon glyphicon-indent-left"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-indent-right');"><i class="glyphicon glyphicon-indent-right"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-facetime-video');"><i class="glyphicon glyphicon-facetime-video"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-picture');"><i class="glyphicon glyphicon-picture"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-map-marker');"><i class="glyphicon glyphicon-map-marker"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-adjust');"><i class="glyphicon glyphicon-adjust"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-tint');"><i class="glyphicon glyphicon-tint"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-edit');"><i class="glyphicon glyphicon-edit"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-share');"><i class="glyphicon glyphicon-share"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-check');"><i class="glyphicon glyphicon-check"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-move');"><i class="glyphicon glyphicon-move"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-step-backward');"><i class="glyphicon glyphicon-step-backward"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-fast-backward');"><i class="glyphicon glyphicon-fast-backward"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-backward');"><i class="glyphicon glyphicon-backward"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-play');"><i class="glyphicon glyphicon-play"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-pause');"><i class="glyphicon glyphicon-pause"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-stop');"><i class="glyphicon glyphicon-stop"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-forward');"><i class="glyphicon glyphicon-forward"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-fast-forward');"><i class="glyphicon glyphicon-fast-forward"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-step-forward');"><i class="glyphicon glyphicon-step-forward"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-eject');"><i class="glyphicon glyphicon-eject"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-chevron-left');"><i class="glyphicon glyphicon-chevron-left"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-chevron-right');"><i class="glyphicon glyphicon-chevron-right"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-plus-sign');"><i class="glyphicon glyphicon-plus-sign"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-minus-sign');"><i class="glyphicon glyphicon-minus-sign"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-remove-sign');"><i class="glyphicon glyphicon-remove-sign"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-ok-sign');"><i class="glyphicon glyphicon-ok-sign"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-question-sign');"><i class="glyphicon glyphicon-question-sign"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-info-sign');"><i class="glyphicon glyphicon-info-sign"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-screenshot');"><i class="glyphicon glyphicon-screenshot"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-remove-circle');"><i class="glyphicon glyphicon-remove-circle"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-ok-circle');"><i class="glyphicon glyphicon-ok-circle"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-ban-circle');"><i class="glyphicon glyphicon-ban-circle"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-arrow-left');"><i class="glyphicon glyphicon-arrow-left"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-arrow-right');"><i class="glyphicon glyphicon-arrow-right"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-arrow-up');"><i class="glyphicon glyphicon-arrow-up"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-arrow-down');"><i class="glyphicon glyphicon-arrow-down"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-share-alt');"><i class="glyphicon glyphicon-share-alt"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-resize-full');"><i class="glyphicon glyphicon-resize-full"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-resize-small');"><i class="glyphicon glyphicon-resize-small"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-exclamation-sign');"><i class="glyphicon glyphicon-exclamation-sign"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-gift');"><i class="glyphicon glyphicon-gift"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-leaf');"><i class="glyphicon glyphicon-leaf"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-fire');"><i class="glyphicon glyphicon-fire"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-eye-open');"><i class="glyphicon glyphicon-eye-open"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-eye-close');"><i class="glyphicon glyphicon-eye-close"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-warning-sign');"><i class="glyphicon glyphicon-warning-sign"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-plane');"><i class="glyphicon glyphicon-plane"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-calendar');"><i class="glyphicon glyphicon-calendar"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-random');"><i class="glyphicon glyphicon-random"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-comment');"><i class="glyphicon glyphicon-comment"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-magnet');"><i class="glyphicon glyphicon-magnet"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-chevron-up');"><i class="glyphicon glyphicon-chevron-up"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-chevron-down');"><i class="glyphicon glyphicon-chevron-down"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-retweet');"><i class="glyphicon glyphicon-retweet"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-shopping-cart');"><i class="glyphicon glyphicon-shopping-cart"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-folder-close');"><i class="glyphicon glyphicon-folder-close"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-folder-open');"><i class="glyphicon glyphicon-folder-open"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-resize-vertical');"><i class="glyphicon glyphicon-resize-vertical"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-resize-horizontal');"><i class="glyphicon glyphicon-resize-horizontal"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-hdd');"><i class="glyphicon glyphicon-hdd"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-bullhorn');"><i class="glyphicon glyphicon-bullhorn"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-bell');"><i class="glyphicon glyphicon-bell"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-certificate');"><i class="glyphicon glyphicon-certificate"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-thumbs-up');"><i class="glyphicon glyphicon-thumbs-up"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-thumbs-down');"><i class="glyphicon glyphicon-thumbs-down"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-hand-right');"><i class="glyphicon glyphicon-hand-right"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-hand-left');"><i class="glyphicon glyphicon-hand-left"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-hand-up');"><i class="glyphicon glyphicon-hand-up"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-hand-down');"><i class="glyphicon glyphicon-hand-down"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-circle-arrow-right');"><i class="glyphicon glyphicon-circle-arrow-right"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-circle-arrow-left');"><i class="glyphicon glyphicon-circle-arrow-left"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-circle-arrow-up');"><i class="glyphicon glyphicon-circle-arrow-up"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-circle-arrow-down');"><i class="glyphicon glyphicon-circle-arrow-down"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-globe');"><i class="glyphicon glyphicon-globe"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-wrench');"><i class="glyphicon glyphicon-wrench"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-tasks');"><i class="glyphicon glyphicon-tasks"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-filter');"><i class="glyphicon glyphicon-filter"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-briefcase');"><i class="glyphicon glyphicon-briefcase"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-fullscreen');"><i class="glyphicon glyphicon-fullscreen"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-dashboard');"><i class="glyphicon glyphicon-dashboard"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-paperclip');"><i class="glyphicon glyphicon-paperclip"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-heart-empty');"><i class="glyphicon glyphicon-heart-empty"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-link');"><i class="glyphicon glyphicon-link"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-phone');"><i class="glyphicon glyphicon-phone"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-pushpin');"><i class="glyphicon glyphicon-pushpin"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-usd');"><i class="glyphicon glyphicon-usd"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-gbp');"><i class="glyphicon glyphicon-gbp"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-sort');"><i class="glyphicon glyphicon-sort"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-sort-by-alphabet');"><i class="glyphicon glyphicon-sort-by-alphabet"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-sort-by-alphabet-alt');"><i class="glyphicon glyphicon-sort-by-alphabet-alt"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-sort-by-order');"><i class="glyphicon glyphicon-sort-by-order"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-sort-by-order-alt');"><i class="glyphicon glyphicon-sort-by-order-alt"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-sort-by-attributes');"><i class="glyphicon glyphicon-sort-by-attributes"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-sort-by-attributes-alt');"><i class="glyphicon glyphicon-sort-by-attributes-alt"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-unchecked');"><i class="glyphicon glyphicon-unchecked"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-expand');"><i class="glyphicon glyphicon-expand"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-collapse-down');"><i class="glyphicon glyphicon-collapse-down"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-collapse-up');"><i class="glyphicon glyphicon-collapse-up"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-log-in');"><i class="glyphicon glyphicon-log-in"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-flash');"><i class="glyphicon glyphicon-flash"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-log-out');"><i class="glyphicon glyphicon-log-out"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-new-window');"><i class="glyphicon glyphicon-new-window"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-record');"><i class="glyphicon glyphicon-record"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-save');"><i class="glyphicon glyphicon-save"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-open');"><i class="glyphicon glyphicon-open"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-saved');"><i class="glyphicon glyphicon-saved"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-import');"><i class="glyphicon glyphicon-import"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-export');"><i class="glyphicon glyphicon-export"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-send');"><i class="glyphicon glyphicon-send"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-floppy-disk');"><i class="glyphicon glyphicon-floppy-disk"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-floppy-saved');"><i class="glyphicon glyphicon-floppy-saved"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-floppy-remove');"><i class="glyphicon glyphicon-floppy-remove"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-floppy-save');"><i class="glyphicon glyphicon-floppy-save"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-floppy-open');"><i class="glyphicon glyphicon-floppy-open"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-credit-card');"><i class="glyphicon glyphicon-credit-card"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-transfer');"><i class="glyphicon glyphicon-transfer"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-cutlery');"><i class="glyphicon glyphicon-cutlery"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-header');"><i class="glyphicon glyphicon-header"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-compressed');"><i class="glyphicon glyphicon-compressed"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-earphone');"><i class="glyphicon glyphicon-earphone"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-phone-alt');"><i class="glyphicon glyphicon-phone-alt"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-tower');"><i class="glyphicon glyphicon-tower"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-stats');"><i class="glyphicon glyphicon-stats"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-sd-video');"><i class="glyphicon glyphicon-sd-video"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-hd-video');"><i class="glyphicon glyphicon-hd-video"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-subtitles');"><i class="glyphicon glyphicon-subtitles"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-sound-stereo');"><i class="glyphicon glyphicon-sound-stereo"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-sound-dolby');"><i class="glyphicon glyphicon-sound-dolby"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-sound-5-1');"><i class="glyphicon glyphicon-sound-5-1"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-sound-6-1');"><i class="glyphicon glyphicon-sound-6-1"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-sound-7-1');"><i class="glyphicon glyphicon-sound-7-1"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-copyright-mark');"><i class="glyphicon glyphicon-copyright-mark"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-registration-mark');"><i class="glyphicon glyphicon-registration-mark"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-cloud-download');"><i class="glyphicon glyphicon-cloud-download"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-cloud-upload');"><i class="glyphicon glyphicon-cloud-upload"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-tree-conifer');"><i class="glyphicon glyphicon-tree-conifer"></i></li>
                    <li onclick="seta_icone_popup('glyphicon glyphicon-tree-deciduous');"><i class="glyphicon glyphicon-tree-deciduous"></i></li>
                    <li onclick="seta_icone_popup('icon-user');"><i class="icon-user"></i></li>
                    <li onclick="seta_icone_popup('icon-user-female');"><i class="icon-user-female"></i></li>
                    <li onclick="seta_icone_popup('icon-users');"><i class="icon-users"></i></li>
                    <li onclick="seta_icone_popup('icon-user-follow');"><i class="icon-user-follow"></i></li>
                    <li onclick="seta_icone_popup('icon-user-following');"><i class="icon-user-following"></i></li>
                    <li onclick="seta_icone_popup('icon-user-unfollow');"><i class="icon-user-unfollow"></i></li>
                    <li onclick="seta_icone_popup('icon-trophy');"><i class="icon-trophy"></i></li>
                    <li onclick="seta_icone_popup('icon-speedometer');"><i class="icon-speedometer"></i></li>
                    <li onclick="seta_icone_popup('icon-social-youtube');"><i class="icon-social-youtube"></i></li>
                    <li onclick="seta_icone_popup('icon-social-twitter');"><i class="icon-social-twitter"></i></li>
                    <li onclick="seta_icone_popup('icon-social-tumblr');"><i class="icon-social-tumblr"></i></li>
                    <li onclick="seta_icone_popup('icon-social-facebook');"><i class="icon-social-facebook"></i></li>
                    <li onclick="seta_icone_popup('icon-social-dropbox');"><i class="icon-social-dropbox"></i></li>
                    <li onclick="seta_icone_popup('icon-social-dribbble');"><i class="icon-social-dribbble"></i></li>
                    <li onclick="seta_icone_popup('icon-shield');"><i class="icon-shield"></i></li>
                    <li onclick="seta_icone_popup('icon-screen-tablet');"><i class="icon-screen-tablet"></i></li>
                    <li onclick="seta_icone_popup('icon-screen-smartphone');"><i class="icon-screen-smartphone"></i></li>
                    <li onclick="seta_icone_popup('icon-screen-desktop');"><i class="icon-screen-desktop"></i></li>
                    <li onclick="seta_icone_popup('icon-plane');"><i class="icon-plane"></i></li>
                    <li onclick="seta_icone_popup('icon-notebook');"><i class="icon-notebook"></i></li>
                    <li onclick="seta_icone_popup('icon-moustache');"><i class="icon-moustache"></i></li>
                    <li onclick="seta_icone_popup('icon-mouse');"><i class="icon-mouse"></i></li>
                    <li onclick="seta_icone_popup('icon-magnet');"><i class="icon-magnet"></i></li>
                    <li onclick="seta_icone_popup('icon-magic-wand');"><i class="icon-magic-wand"></i></li>
                    <li onclick="seta_icone_popup('icon-hourglass');"><i class="icon-hourglass"></i></li>
                    <li onclick="seta_icone_popup('icon-graduation');"><i class="icon-graduation"></i></li>
                    <li onclick="seta_icone_popup('icon-ghost');"><i class="icon-ghost"></i></li>
                    <li onclick="seta_icone_popup('icon-game-controller');"><i class="icon-game-controller"></i></li>
                    <li onclick="seta_icone_popup('icon-fire');"><i class="icon-fire"></i></li>
                    <li onclick="seta_icone_popup('icon-eyeglasses');"><i class="icon-eyeglasses"></i></li>
                    <li onclick="seta_icone_popup('icon-envelope-open');"><i class="icon-envelope-open"></i></li>
                    <li onclick="seta_icone_popup('icon-envelope-letter');"><i class="icon-envelope-letter"></i></li>
                    <li onclick="seta_icone_popup('icon-energy');"><i class="icon-energy"></i></li>
                    <li onclick="seta_icone_popup('icon-emoticon-smile');"><i class="icon-emoticon-smile"></i></li>
                    <li onclick="seta_icone_popup('icon-disc');"><i class="icon-disc"></i></li>
                    <li onclick="seta_icone_popup('icon-cursor-move');"><i class="icon-cursor-move"></i></li>
                    <li onclick="seta_icone_popup('icon-crop');"><i class="icon-crop"></i></li>
                    <li onclick="seta_icone_popup('icon-credit-card');"><i class="icon-credit-card"></i></li>
                    <li onclick="seta_icone_popup('icon-chemistry');"><i class="icon-chemistry"></i></li>
                    <li onclick="seta_icone_popup('icon-bell');"><i class="icon-bell"></i></li>
                    <li onclick="seta_icone_popup('icon-badge');"><i class="icon-badge"></i></li>
                    <li onclick="seta_icone_popup('icon-anchor');"><i class="icon-anchor"></i></li>
                    <li onclick="seta_icone_popup('icon-action-redo');"><i class="icon-action-redo"></i></li>
                    <li onclick="seta_icone_popup('icon-action-undo');"><i class="icon-action-undo"></i></li>
                    <li onclick="seta_icone_popup('icon-bag');"><i class="icon-bag"></i></li>
                    <li onclick="seta_icone_popup('icon-basket');"><i class="icon-basket"></i></li>
                    <li onclick="seta_icone_popup('icon-basket-loaded');"><i class="icon-basket-loaded"></i></li>
                    <li onclick="seta_icone_popup('icon-book-open');"><i class="icon-book-open"></i></li>
                    <li onclick="seta_icone_popup('icon-briefcase');"><i class="icon-briefcase"></i></li>
                    <li onclick="seta_icone_popup('icon-bubbles');"><i class="icon-bubbles"></i></li>
                    <li onclick="seta_icone_popup('icon-calculator');"><i class="icon-calculator"></i></li>
                    <li onclick="seta_icone_popup('icon-call-end');"><i class="icon-call-end"></i></li>
                    <li onclick="seta_icone_popup('icon-call-in');"><i class="icon-call-in"></i></li>
                    <li onclick="seta_icone_popup('icon-call-out');"><i class="icon-call-out"></i></li>
                    <li onclick="seta_icone_popup('icon-compass');"><i class="icon-compass"></i></li>
                    <li onclick="seta_icone_popup('icon-cup');"><i class="icon-cup"></i></li>
                    <li onclick="seta_icone_popup('icon-diamond');"><i class="icon-diamond"></i></li>
                    <li onclick="seta_icone_popup('icon-direction');"><i class="icon-direction"></i></li>
                    <li onclick="seta_icone_popup('icon-directions');"><i class="icon-directions"></i></li>
                    <li onclick="seta_icone_popup('icon-docs');"><i class="icon-docs"></i></li>
                    <li onclick="seta_icone_popup('icon-drawer');"><i class="icon-drawer"></i></li>
                    <li onclick="seta_icone_popup('icon-drop');"><i class="icon-drop"></i></li>
                    <li onclick="seta_icone_popup('icon-earphones');"><i class="icon-earphones"></i></li>
                    <li onclick="seta_icone_popup('icon-earphones-alt');"><i class="icon-earphones-alt"></i></li>
                    <li onclick="seta_icone_popup('icon-feed');"><i class="icon-feed"></i></li>
                    <li onclick="seta_icone_popup('icon-film');"><i class="icon-film"></i></li>
                    <li onclick="seta_icone_popup('icon-folder-alt');"><i class="icon-folder-alt"></i></li>
                    <li onclick="seta_icone_popup('icon-frame');"><i class="icon-frame"></i></li>
                    <li onclick="seta_icone_popup('icon-globe');"><i class="icon-globe"></i></li>
                    <li onclick="seta_icone_popup('icon-globe-alt');"><i class="icon-globe-alt"></i></li>
                    <li onclick="seta_icone_popup('icon-handbag');"><i class="icon-handbag"></i></li>
                    <li onclick="seta_icone_popup('icon-layers');"><i class="icon-layers"></i></li>
                    <li onclick="seta_icone_popup('icon-map');"><i class="icon-map"></i></li>
                    <li onclick="seta_icone_popup('icon-picture');"><i class="icon-picture"></i></li>
                    <li onclick="seta_icone_popup('icon-pin');"><i class="icon-pin"></i></li>
                    <li onclick="seta_icone_popup('icon-playlist');"><i class="icon-playlist"></i></li>
                    <li onclick="seta_icone_popup('icon-present');"><i class="icon-present"></i></li>
                    <li onclick="seta_icone_popup('icon-printer');"><i class="icon-printer"></i></li>
                    <li onclick="seta_icone_popup('icon-puzzle');"><i class="icon-puzzle"></i></li>
                    <li onclick="seta_icone_popup('icon-speech');"><i class="icon-speech"></i></li>
                    <li onclick="seta_icone_popup('icon-vector');"><i class="icon-vector"></i></li>
                    <li onclick="seta_icone_popup('icon-wallet');"><i class="icon-wallet"></i></li>
                    <li onclick="seta_icone_popup('icon-arrow-down');"><i class="icon-arrow-down"></i></li>
                    <li onclick="seta_icone_popup('icon-arrow-left');"><i class="icon-arrow-left"></i></li>
                    <li onclick="seta_icone_popup('icon-arrow-right');"><i class="icon-arrow-right"></i></li>
                    <li onclick="seta_icone_popup('icon-arrow-up');"><i class="icon-arrow-up"></i></li>
                    <li onclick="seta_icone_popup('icon-bar-chart');"><i class="icon-bar-chart"></i></li>
                    <li onclick="seta_icone_popup('icon-bulb');"><i class="icon-bulb"></i></li>
                    <li onclick="seta_icone_popup('icon-calendar');"><i class="icon-calendar"></i></li>
                    <li onclick="seta_icone_popup('icon-control-end');"><i class="icon-control-end"></i></li>
                    <li onclick="seta_icone_popup('icon-control-forward');"><i class="icon-control-forward"></i></li>
                    <li onclick="seta_icone_popup('icon-control-pause');"><i class="icon-control-pause"></i></li>
                    <li onclick="seta_icone_popup('icon-control-play');"><i class="icon-control-play"></i></li>
                    <li onclick="seta_icone_popup('icon-control-rewind');"><i class="icon-control-rewind"></i></li>
                    <li onclick="seta_icone_popup('icon-control-start');"><i class="icon-control-start"></i></li>
                    <li onclick="seta_icone_popup('icon-cursor');"><i class="icon-cursor"></i></li>
                    <li onclick="seta_icone_popup('icon-dislike');"><i class="icon-dislike"></i></li>
                    <li onclick="seta_icone_popup('icon-equalizer');"><i class="icon-equalizer"></i></li>
                    <li onclick="seta_icone_popup('icon-graph');"><i class="icon-graph"></i></li>
                    <li onclick="seta_icone_popup('icon-grid');"><i class="icon-grid"></i></li>
                    <li onclick="seta_icone_popup('icon-home');"><i class="icon-home"></i></li>
                    <li onclick="seta_icone_popup('icon-like');"><i class="icon-like"></i></li>
                    <li onclick="seta_icone_popup('icon-list');"><i class="icon-list"></i></li>
                    <li onclick="seta_icone_popup('icon-login');"><i class="icon-login"></i></li>
                    <li onclick="seta_icone_popup('icon-logout');"><i class="icon-logout"></i></li>
                    <li onclick="seta_icone_popup('icon-loop');"><i class="icon-loop"></i></li>
                    <li onclick="seta_icone_popup('icon-microphone');"><i class="icon-microphone"></i></li>
                    <li onclick="seta_icone_popup('icon-music-tone');"><i class="icon-music-tone"></i></li>
                    <li onclick="seta_icone_popup('icon-music-tone-alt');"><i class="icon-music-tone-alt"></i></li>
                    <li onclick="seta_icone_popup('icon-note');"><i class="icon-note"></i></li>
                    <li onclick="seta_icone_popup('icon-pencil');"><i class="icon-pencil"></i></li>
                    <li onclick="seta_icone_popup('icon-pie-chart');"><i class="icon-pie-chart"></i></li>
                    <li onclick="seta_icone_popup('icon-question');"><i class="icon-question"></i></li>
                    <li onclick="seta_icone_popup('icon-rocket');"><i class="icon-rocket"></i></li>

                    <li onclick="seta_icone_popup('icon-share');"><i class="icon-share"></i></li>
                    <li onclick="seta_icone_popup('icon-share-alt');"><i class="icon-share-alt"></i></li>
                    <li onclick="seta_icone_popup('icon-shuffle');"><i class="icon-shuffle"></i></li>
                    <li onclick="seta_icone_popup('icon-size-actual');"><i class="icon-size-actual"></i></li>
                    <li onclick="seta_icone_popup('icon-size-fullscreen');"><i class="icon-size-fullscreen"></i></li>
                    <li onclick="seta_icone_popup('icon-support');"><i class="icon-support"></i></li>
                    <li onclick="seta_icone_popup('icon-tag');"><i class="icon-tag"></i></li>
                    <li onclick="seta_icone_popup('icon-trash');"><i class="icon-trash"></i></li>
                    <li onclick="seta_icone_popup('icon-umbrella');"><i class="icon-umbrella"></i></li>
                    <li onclick="seta_icone_popup('icon-wrench');"><i class="icon-wrench"></i></li>
                    <li onclick="seta_icone_popup('icon-ban');"><i class="icon-ban"></i></li>
                    <li onclick="seta_icone_popup('icon-bubble');"><i class="icon-bubble"></i></li>
                    <li onclick="seta_icone_popup('icon-camcorder');"><i class="icon-camcorder"></i></li>
                    <li onclick="seta_icone_popup('icon-camera');"><i class="icon-camera"></i></li>
                    <li onclick="seta_icone_popup('icon-check');"><i class="icon-check"></i></li>
                    <li onclick="seta_icone_popup('icon-clock');"><i class="icon-clock"></i></li>
                    <li onclick="seta_icone_popup('icon-close');"><i class="icon-close"></i></li>
                    <li onclick="seta_icone_popup('icon-cloud-download');"><i class="icon-cloud-download"></i></li>
                    <li onclick="seta_icone_popup('icon-cloud-upload');"><i class="icon-cloud-upload"></i></li>
                    <li onclick="seta_icone_popup('icon-doc');"><i class="icon-doc"></i></li>
                    <li onclick="seta_icone_popup('icon-envelope');"><i class="icon-envelope"></i></li>
                    <li onclick="seta_icone_popup('icon-eye');"><i class="icon-eye"></i></li>
                    <li onclick="seta_icone_popup('icon-flag');"><i class="icon-flag"></i></li>
                    <li onclick="seta_icone_popup('icon-folder');"><i class="icon-folder"></i></li>
                    <li onclick="seta_icone_popup('icon-heart');"><i class="icon-heart"></i></li>
                    <li onclick="seta_icone_popup('icon-info');"><i class="icon-info"></i></li>
                    <li onclick="seta_icone_popup('icon-key');"><i class="icon-key"></i></li>
                    <li onclick="seta_icone_popup('icon-link');"><i class="icon-link"></i></li>
                    <li onclick="seta_icone_popup('icon-lock');"><i class="icon-lock"></i></li>
                    <li onclick="seta_icone_popup('icon-lock-open');"><i class="icon-lock-open"></i></li>
                    <li onclick="seta_icone_popup('icon-magnifier');"><i class="icon-magnifier"></i></li>
                    <li onclick="seta_icone_popup('icon-magnifier-add');"><i class="icon-magnifier-add"></i></li>
                    <li onclick="seta_icone_popup('icon-magnifier-remove');"><i class="icon-magnifier-remove"></i></li>
                    <li onclick="seta_icone_popup('icon-paper-clip');"><i class="icon-paper-clip"></i></li>
                    <li onclick="seta_icone_popup('icon-paper-plane');"><i class="icon-paper-plane"></i></li>
                    <li onclick="seta_icone_popup('icon-plus');"><i class="icon-plus"></i></li>
                    <li onclick="seta_icone_popup('icon-pointer');"><i class="icon-pointer"></i></li>
                    <li onclick="seta_icone_popup('icon-power');"><i class="icon-power"></i></li>
                    <li onclick="seta_icone_popup('icon-refresh');"><i class="icon-refresh"></i></li>
                    <li onclick="seta_icone_popup('icon-reload');"><i class="icon-reload"></i></li>
                    <li onclick="seta_icone_popup('icon-settings');"><i class="icon-settings"></i></li>
                    <li onclick="seta_icone_popup('icon-star');"><i class="icon-star"></i></li>
                    <li onclick="seta_icone_popup('icon-symbol-female');"><i class="icon-symbol-female"></i></li>
                    <li onclick="seta_icone_popup('icon-symbol-male');"><i class="icon-symbol-male"></i></li>
                    <li onclick="seta_icone_popup('icon-target');"><i class="icon-target"></i></li>
                    <li onclick="seta_icone_popup('icon-volume-1');"><i class="icon-volume-1"></i></li>
                    <li onclick="seta_icone_popup('icon-volume-2');"><i class="icon-volume-2"></i></li>
                    <li onclick="seta_icone_popup('icon-volume-off');"><i class="icon-volume-off"></i></li>
                    </ul>
                    </div>


</div>
</div>
