<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
?>
<div class="row" style="margin-bottom:10px;">
    <iframe frameborder="0" src="<?=$link?>templates/<?=$layout_padrao_set?>/acoes/sysgeral/lista-icone.php" style="width:100%;height:600px;padding-left:15px;padding-right:15px;" scrolling="auto"></iframe>
</div>
