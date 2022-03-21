<ul id="pageNav">
    <? if(trim($sysperm['visualizar_sysusu'])==1) { ?><li <? if($_REQUEST['var2']=="usuarios") { ?> class="current"<? } ?>><a href="<?=$link?>sistema/usuarios/">Usuários</a></li><? } ?>
    <? if(trim($sysperm['visualizar_sysgrupousuario'])==1) { ?><li <? if($_REQUEST['var2']=="grupos-de-usuarios") { ?> class="current"<? } ?>><a href="<?=$link?>sistema/grupos-de-usuarios/">Grupos de Usuários</a></li><? } ?>
    <? if(trim($sysperm['visualizar_sysconfig'])==1) { ?><li <? if($_REQUEST['var2']=="configuracoes") { ?> class="current"<? } ?>><a href="<?=$link?>sistema/configuracoes/">Configurações</a></li><? } ?>
    <? if(trim($sysperm['visualizar_sysfonte'])==1) { ?><li <? if($_REQUEST['var2']=="fontes") { ?> class="current"<? } ?>><a href="<?=$link?>sistema/fontes/">Fontes</a></li><? } ?>
    <? if(trim($sysperm['visualizar_sysacesso'])==1) { ?><li <? if($_REQUEST['var2']=="historico-de-acessos") { ?> class="current"<? } ?>><a href="<?=$link?>sistema/historico-de-acessos/">Histórico de Acessos</a></li><? } ?>
    <? if(trim($sysperm['visualizar_syslog'])==1) { ?><li <? if($_REQUEST['var2']=="historico-de-operacoes") { ?> class="current"<? } ?>><a href="<?=$link?>sistema/historico-de-operacoes/">Histórico de Operações</a></li><? } ?>
    <? if(trim($sysperm['visualizar_syschamado'])==1) { ?><li <? if($_REQUEST['var2']=="suporte") { ?> class="current"<? } ?>><a href="<?=$link?>sistema/suporte/">Suporte</a></li><? } ?>
    <? if(trim($sysperm['visualizar_sysmod'])==1) { ?><li <? if($_REQUEST['var2']=="controle-de-modulos") { ?> class="current"<? } ?>><a href="<?=$link?>sistema/controle-de-modulos/">Controle de Módulos</a></li><? } ?>
</ul>
