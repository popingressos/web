<ul id="pageNav">
	<?
    $qSqlMod = mysql_query("SELECT * FROM sysmod WHERE idsysmod_categoria='".$sysmod_set['idsysmod_categoria']."' AND stat='1' ORDER BY ordem");
    while($rSqlMod = mysql_fetch_array($qSqlMod)) {
		$nomeLimpo = transformaCaractere($rSqlMod['nome']);
		$url_mod = str_replace("_","-",$rSqlMod['bd']);
    ?>
    <? if(trim($sysperm['visualizar_'.$rSqlMod['bd'].''])==1) { ?><li <? if($rSqlMod['id']==$sysmod_set['id']) { ?> class="current"<? } ?>><a href="<?=$link?><?=$_REQUEST['var1']?>/<?=$nomeLimpo?>/"><? if(trim($rSqlMod['imagem'])=="") { } else { ?><img style="max-width:16px;max-height:16px;" src="<?=$link?>files/sysmod/<?=$rSqlMod['numeroUnico']?>/<?=$rSqlMod['imagem']?>" /><? } ?> &nbsp;<?=$rSqlMod['nome']?></a></li><? } ?>
    <? } ?>

</ul>
