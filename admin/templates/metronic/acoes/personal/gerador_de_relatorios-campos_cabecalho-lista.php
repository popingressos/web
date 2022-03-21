<?
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

$contLista = 0;
$_SESSION['campos_cabecalho_'.$numeroUnico_paiS.''] = $_SESSION['campos_cabecalho_'.$numeroUnico_paiS.''];
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
											<? if(trim($_SESSION['campos_cabecalho_'.$numeroUnico_paiS.''])=="") { ?>
                                                <tr role="row">
                                                    <td colspan="5" style="vertical-align:middle;text-align:center;">Não existe nenhum campo relacionado</td>
                                                </tr>
                                            <? } else { ?>
                                                <?
												$corSet = "#ffffff";
												$carrinhoArray = unserialize($_SESSION['campos_cabecalho_'.$numeroUnico_paiS.'']);
												$carrinhoArray = array_sort($carrinhoArray, 'ordem', SORT_ASC);
												foreach ($carrinhoArray as $key => $value) {
													$contLista++;
													if($corSet=="#ffffff") {
														$corSet = "#e2e2e2";
													} else {
														$corSet = "#ffffff";
													}
                                                ?>
                                                <tr style="background-color:<?=$corSet?>;" role="row">
                                                    <td style="vertical-align:middle;text-align:center;">
                                                    <? if(count($carrinhoArray)==1) { ?>
                                                        <i class="fa fa-circle" style="font-size: 6px;"></i>
                                                    <? } else { ?>
                                                        <? if($contLista==count($carrinhoArray)) { ?> 
                                                            <i onClick="gerador_de_relatorios_campos_cabecalho_ordem('<?=$value['numeroUnico']?>','<?=$value['ordem']?>','menos','<?=$localBaseSet?>');" class="fa fa-arrow-up"></i>
                                                        <? } else { ?>
                                                            <? if($contLista==1) { ?> 
                                                                <i onClick="gerador_de_relatorios_campos_cabecalho_ordem('<?=$value['numeroUnico']?>','<?=$value['ordem']?>','mais','<?=$localBaseSet?>');" class="fa fa-arrow-down"></i>
                                                            <? } else { ?>
                                                                <i onClick="gerador_de_relatorios_campos_cabecalho_ordem('<?=$value['numeroUnico']?>','<?=$value['ordem']?>','menos','<?=$localBaseSet?>');" class="fa fa-arrow-up"></i>
                                                                <br />
                                                                <i onClick="gerador_de_relatorios_campos_cabecalho_ordem('<?=$value['numeroUnico']?>','<?=$value['ordem']?>','mais','<?=$localBaseSet?>');" class="fa fa-arrow-down"></i>
                                                            <? } ?>
                                                        <? } ?>
                                                    <? } ?>
                                                    </td>
                                                    <td style="vertical-align:middle;padding:0px;padding-top:2px;padding-bottom:2px;padding-left:5px;width:100%;"><?=$value['label']?></td>
                                                    <td style="vertical-align:middle;padding:0px;padding-top:2px;padding-bottom:2px;padding-left:3px;padding-right:3px;" class="block_check_click">
                                                        <div class="btn-group">
                                                            <span class="red-sunglo btn btn-sm" style="padding: 0px 5px;" onclick="javascript:gerador_de_relatorios_campos_cabecalho_del('<?=$value['numeroUnico']?>','<?=$localBaseSet?>');" title="Excluir"><i class="fa fa-times"></i></span> 
                                                        </div>
                                                    </td>
        
                                                </tr>
                                                <? } ?>
                                            <? } ?>
                                        </tbody>
                                    </table>
