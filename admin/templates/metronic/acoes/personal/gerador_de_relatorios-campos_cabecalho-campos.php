<?php
if(trim($_GET['numeroUnico_paiS'])=="") {
	$numeroUnico_paiS = $numeroUnicoGerado;
	$localBaseSet = $localBaseSet;
} else {
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
	
	$numeroUnico_paiS = $_GET['numeroUnico_paiS'];
	$localBaseSet = $_GET['localBaseS'];
}
include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/gerador_de_relatorios-campos_cabecalho.php");
?>

                                    <style>
									@media screen and (min-width:1024px){
										.hide-on-desktop{display:none!important}
										.show-on-desktop{display:block}
									}
									
									@media screen and (max-width:1023px){
										.hide-on-mobile{display:none!important}
										.show-on-mobile{display:block}
									}
                                    </style>
                                    <table class="table table-striped table-bordered table-hover display table-header-fixed" style="background-color:#ffffff;" cellspacing="0" width="100%">
                                        <tbody>
											<? 
											$contCampos = 0 ;
											foreach ($listaControle['campos'] as $key => $value) {
												if(strrpos($_SESSION['campos_cabecalho_'.$numeroUnico_paiS.''],"|".$value['campo']."|") === false) {
													if($localBaseSet==$value['local']) {
														$contCampos++;
													}
												}
											}
											if($contCampos==0) { 
											?>
                                                <tr role="row">
                                                    <td colspan="5" style="vertical-align:middle;text-align:center;">Não existem mais campos para relacionar</td>
                                                </tr>
                                            <? } else { ?>
												<?
                                                $corSet = "#ffffff";
                                                foreach ($listaControle['campos'] as $key => $value) {
                                                    if(strrpos($_SESSION['campos_cabecalho_'.$numeroUnico_paiS.''],"|".$value['campo']."|") === false) {
                                                        if($localBaseSet==$value['local']) {
                                                            $contLista++;
                                                            if($corSet=="#ffffff") {
                                                                $corSet = "#e2e2e2";
                                                            } else {
                                                                $corSet = "#ffffff";
                                                            }
                                                ?>
                                                        <tr style="background-color:<?=$corSet?>;" role="row">
                                                            <td style="vertical-align:middle;padding:0px;padding-top:2px;padding-bottom:2px;padding-left:5px;width:100%;"><?=$value['label']?></td>
                                                            <td style="vertical-align:middle;padding:0px;padding-top:2px;padding-bottom:2px;padding-left:3px;padding-right:3px;" class="block_check_click">
                                                                <div class="btn-group">
                                                                    <span class="green btn btn-sm" style="padding: 0px 5px;" onclick="javascript:gerador_de_relatorios_campos_cabecalho_add('<?=$value['label']?>','<?=$value['local']?>','<?=$value['campo']?>','<?=$localBaseSet?>');"><i class="fa fa-plus"></i></span> 
                                                                </div>
                                                            </td>
                
                                                        </tr>
                                                        <? } ?>
                                                    <? } ?>
                                                <? } ?>
											<? } ?>
                                        </tbody>
                                    </table>
