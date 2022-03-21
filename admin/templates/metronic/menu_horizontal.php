		<!-- BEGIN HORIZANTAL MENU -->

		<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->

		<!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) sidebar menu below. So the horizontal menu has 2 seperate versions -->

		<div class="hor-menu hidden-sm hidden-xs" style="width:45%;">

			<ul class="nav navbar-nav" style="width:100%;">


				<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->

				<!--

				<? if($menu_set=="off") { ?>

                <li class="classic-menu-dropdown start active open">

					<a href="javascript:;">

					<i class="fa fa-gears"></i>

					<span class="title">Sistema</span>

					<span class="selected"></span>

					<span class="arrow open"></span>

					</a>

					<ul class="dropdown-menu pull-left">

						<li class="active">

							<a href="<?=$link?>suporte/">

							<i class="fa fa-support"></i> 

							Suporte</a>

						</li>

					</ul>

				</li>

                <? } else { ?>



					<? $permExist = mysql_num_rows(mysql_query("SELECT * FROM _construtor_sysperm WHERE idsysusu='".$sysusu['id']."'")); ?>

					<? if($permExist==0) { } else { ?>



						<? if(trim($_construtor_sysperm['visualizar_sysusu'])==1||trim($_construtor_sysperm['visualizar_sysacesso'])==1||trim($_construtor_sysperm['visualizar_syslog'])==1||trim($_construtor_sysperm['visualizar_sysconfig'])==1||trim($_construtor_sysperm['visualizar_syssuporte'])==1) { ?>

                            <li class="classic-menu-dropdown start 

                            <? if(trim($_REQUEST['var1'])=="sistema"&&(

                                  trim($_REQUEST['var2'])=="usuarios"

                                ||trim($_REQUEST['var2'])=="grupos-de-permissoes"

                                ||trim($_REQUEST['var2'])=="configuracoes"

                                ||trim($_REQUEST['var2'])=="banco-de-midia"

                                ||trim($_REQUEST['var2'])=="fontes"

                                ||trim($_REQUEST['var2'])=="historico-de-acessos"

                                ||trim($_REQUEST['var2'])=="historico-de-operacoes"

                                ||trim($_REQUEST['var2'])=="suporte"

                                ||trim($_REQUEST['var2'])=="controle-de-modulos")) {

                                    ?>

                                    active<? } ?>">

                                <a data-toggle="dropdown" href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">

                                <i class="fa fa-gears"></i>

                                <span class="title">Sistema</span>

                                <i class="fa fa-angle-down"></i>

                                </a>

                                <ul class="dropdown-menu pull-left">

									<? if(trim($_construtor_sysperm['visualizar_sysusu'])==1) { ?>

                                    <li  class="dropdown-submenu <? if(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="usuarios") { ?>active<? } ?>">

                                        <a href="javascript:;">

                                            <i class="fa fa-user"></i> 

                                            Usuários 

                                            <span class="arrow <? if(trim($_REQUEST['var1'])=="sistema"&&(trim($_REQUEST['var2'])=="usuarios")) {?>open<? } ?>"></span>

                                        </a>

                                        <ul class="dropdown-menu">

                                            <li><a href="<?=$link?>sistema/usuarios/" onclick="javascript:$('a[href=#lista]').click();">Lista de Itens</a></li>

                                            <li><a href="<?=$link?>sistema/usuarios/#adicionar-novo" onclick="javascript:$('a[href=#adicionar-novo]').click();">Adicionar Novo</a></li>

                                            <li><a href="<?=$link?>sistema/usuarios/categorias/">Categorias</a></li>

                                        </ul>

                                    </li>

                                    <? } ?>

                                    <? if(trim($_construtor_sysperm['visualizar_sysgrupousuario'])==1) { ?><li <? if(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="grupos-de-permissoes") { ?>class="active"<? } ?>><a href="<?=$link?>sistema/grupos-de-permissoes/"><i class="fa fa-users"></i> Grupos de Permissões</a></li><? } ?>

                                    <? if(trim($_construtor_sysperm['visualizar_sysconfig'])==1) { ?><li <? if(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="configuracoes") { ?>class="active"<? } ?>><a href="<?=$link?>sistema/configuracoes/"><i class="fa fa-cogs"></i> Configurações</a></li><? } ?>

                                    <? if(trim($_construtor_sysperm['visualizar_sysfonte'])==1) { ?><li <? if(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="fontes") { ?>class="active"<? } ?>><a href="<?=$link?>sistema/fontes/"><i class="fa fa-font"></i> Fontes</a></li><? } ?>

                                    <? if(trim($_construtor_sysperm['visualizar_sysacesso'])==1) { ?><li <? if(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="historico-de-acessos") { ?>class="active"<? } ?>><a href="<?=$link?>sistema/historico-de-acessos/"><i class="fa fa-key"></i> Histórico de Acessos</a></li><? } ?>

                                    <? if(trim($_construtor_sysperm['visualizar_syslog'])==1) { ?><li <? if(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="historico-de-operacoes") { ?>class="active"<? } ?>><a href="<?=$link?>sistema/historico-de-operacoes/"><i class="fa fa-flag-checkered"></i> Histórico de Operações</a></li><? } ?>

                                    <? if(trim($_construtor_sysperm['visualizar_syssuporte'])==1) { ?><li <? if(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="suporte") { ?>class="active"<? } ?>><a href="<?=$link?>sistema/suporte/"><i class="fa fa-support"></i> Suporte</a></li><? } ?>

            

                                </ul>

                            </li>

						<? } ?>

					<? } ?>



                <li class="classic-menu-dropdown start">

                    <a data-toggle="dropdown" href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">

                    <i class="fa fa-plus"></i>

                    <span class="title">Adicionar</span>

                    <i class="fa fa-angle-down"></i>

                    </a>

                    <ul class="dropdown-menu pull-left" id="menu_sysfavorito_add">

						<?

						$qSqlFav = mysql_query("SELECT * FROM sysfavorito_add WHERE idsysusu='".$sysusu['id']."'");

                        while($rSqlFav = mysql_fetch_array($qSqlFav)) {

							if(trim($lista_mods)=="") {

								$lista_mods = "'".$rSqlFav['bd']."'";

							} else {

								$lista_mods = $lista_mods.",'".$rSqlFav['bd']."'";

							}

						}

						

						if(trim($lista_mods)=="") {

						?>

						<li class="active">

							<a href="<?=$link?>suporte/">

							<i class="fa fa-support"></i> 

							Nenhum item adicionado como atalho</a>

						</li>

                        <?

						} else {

						$qSqlMod = mysql_query("SELECT * FROM _construtor_modulo WHERE nome_base IN (".$lista_mods.") AND stat='1' ORDER BY ordem");

                        while($rSqlMod = mysql_fetch_array($qSqlMod)) {

                            $nomeLimpo = transformaCaractere($rSqlMod['nome_base']);

                            $url_mod = str_replace("_","-",$rSqlMod['bd']);

							$itemAtualEstrutura = mysql_fetch_array(mysql_query("SELECT * FROM ".$rSqlMod['nome_base']."_estrutura LIMIT 1"));

							

							$rSqlModCat = mysql_fetch_array(mysql_query("SELECT * FROM _construtor_modulo_categoria WHERE id='".$rSqlMod['id_construtor_modulo_categoria']."'"));

                        ?>

                        <? if(trim($_construtor_sysperm['visualizar_'.$rSqlMod['nome_base'].''])==1) { ?>



                        <li <? if(trim($_REQUEST['var1'])==$rSql['url_amigavel']&&trim($_REQUEST['var2'])==$nomeLimpo) { ?>class="active"<? } ?>>

						<li class="active">

							<li>

                            <a href="<?=$link?><?=$rSqlModCat['url_amigavel']?>/<?=$nomeLimpo?>/#adicionar-novo" onclick="javascript:$('a[href=#adicionar-novo]').click();">

                                <? if(trim($rSqlMod['icone'])=="") { } else { ?><i class="<?=$rSqlMod['icone']?>"></i><? } ?> 

                                <?=$rSqlMod['nome']?> 

                            </a>

                            </li>

						</li>

                        <? } } } ?>

					</ul>

				</li>



				<? if(trim($_construtor_sysperm['visualizar_favorito'])==1) { ?>

                <li class="classic-menu-dropdown start">

                    <a data-toggle="dropdown" href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true">

                    <i class="fa fa-star"></i>

                    <span class="title">Favoritos</span>

                    <i class="fa fa-angle-down"></i>

                    </a>



                    <ul class="dropdown-menu pull-left">

						<?

                        $qSqlModCat = mysql_query("SELECT * FROM favorito_categoria WHERE  stat='1' ORDER BY ordem");

                        while($rSqlModCat = mysql_fetch_array($qSqlModCat)) {

							$nSqlMod = mysql_num_rows(mysql_query("SELECT * FROM favorito WHERE lista_categoria='|".$rSqlModCat['id']."|' AND stat='1' ORDER BY ordem"));

							if($nSqlMod==0) { } else {

                        ?>

                        <li  class="dropdown-submenu ">

                            <a href="javascript:;">

                                <? if(trim($rSqlModCat['icone'])=="") { } else { ?><i class="<?=$rSqlModCat['icone']?>"></i><? } ?>

                                <?=$rSqlModCat['nome']?> 

                                <span class="arrow "></span>

                            </a>

                            <ul class="dropdown-menu">

								<?

                                $qSqlMod = mysql_query("SELECT * FROM favorito WHERE lista_categoria='|".$rSqlModCat['id']."|' AND stat='1' ORDER BY ordem");

                                while($rSqlMod = mysql_fetch_array($qSqlMod)) {

                                ?>

                                <li><a href="<?=$rSqlMod['link']?>" target="_blank"><?=$rSqlMod['nome']?></a></li>

                                <? } ?>

                            </ul>

                        </li>

                        <? } } ?>

                    </ul>



				</li>

				<? } ?>



				<? } ?>

                -->



			</ul>

		</div>

		<!-- END HORIZANTAL MENU -->

