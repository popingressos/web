<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/class.Conteudo_site.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idsysusuGet = $_GET['idsysusuS'];
$modGet = $_GET['modS'];
?>

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
                                <a class="controle_clique_edicao" href="<?=$link?>suporte/">
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
                            <li>
                            <a class="controle_clique_edicao" href-extra="lista" onClick="javascript:url_menu_limpa('<?=$rSqlMod['nome_base']?>','<?=$link?><?=$rSqlModCat['url_amigavel']?>/<?=$nomeLimpo?>/');">
								<? if(trim($rSqlMod['icone'])=="") { } else { ?><i class="<?=$rSqlMod['icone']?>"></i><? } ?> 
                                <?=$rSqlMod['nome']?> 
                            </a>
                            </li>
                            <? } } } ?>
