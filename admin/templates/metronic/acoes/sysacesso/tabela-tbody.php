<?php
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

if(trim($_GET['modS'])=="") {
	$mod = $mod;
} else {
	$mod = $_GET['modS'];
}

$idsysusuGet = $sysusu['id'];
$itens_por_pagina = 50; 

if(trim($_GET['inicioS'])=="") {
	$inicioGet = $inicioGet;
} else {
	$inicioGet = $_GET['inicioS'];
}

if(trim($_GET['campoS'])=="") {
	$campoGet = $campoGet;
} else {
	$campoGet = $_GET['campoS'];
}

if(trim($_GET['campoSqlS'])=="") {
	$campoSqlGet = $campoSqlGet;
} else {
	$campoSqlGet = $_GET['campoSqlS'];
}

if(trim($_GET['limitS'])=="") {
	$limit = $itens_por_pagina;
	$limit_filtro = "LIMIT ".$itens_por_pagina."";
} else {
	$limit = $_GET['limitS'];
	$limit_filtro = "LIMIT ".$inicioGet.",".$limit."";
}

?>
											<?
											$nSql = mysql_num_rows(mysql_query("SELECT id,idsysusu,data FROM ".$linguagem_set."".$mod." "));
                                            $qSql = mysql_query("SELECT id,idsysusu,data FROM ".$linguagem_set."".$mod." ORDER BY data DESC ".$limit_filtro." ");
                                            while($rSql = mysql_fetch_array($qSql)) {

                                            ?>
                                            <tr role="row">

                                                <? $usuario_set = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$rSql['idsysusu']."'")); ?>
                                                <td><?=$usuario_set['nome']?></td>
                                                <td><?=$usuario_set['email']?></td>
                                                <td><?=ajustaDataReturn($rSql['data'],"d/m/Y");?></td>
    
                                            </tr>
                                            <? } ?>
                                            
