<?
if(trim($_GET['numeroUnico_paiS'])=="") {
	$numeroUnico_paiS = $numeroUnicoGerado;
	$_GET['chave_urlS'] = $chave_url;

} else {
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
	include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");
	
	$numeroUnico_paiS = $_GET['numeroUnico_paiS'];
	$_GET['chave_urlS'] = $_GET['chave_urlS'];
}

$contLista = 0;
$_SESSION['eventos_tickets_'.$_GET['chave_urlS'].''.$numeroUnico_paiS.''] = $_SESSION['eventos_tickets_'.$_GET['chave_urlS'].''.$numeroUnico_paiS.''];
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

.table-bordered {
	border: 0px solid #e7ecf1 !important;
}
.table-striped > tbody > tr:nth-of-type(odd) {
	background-color: #f1f1f1 !important;
}
.table-bordered > thead > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > tfoot > tr > td {
	border: 0px solid #e7ecf1 !important;
}
</style>
<? if(trim($_SESSION['eventos_tickets_'.$_GET['chave_urlS'].''.$numeroUnico_paiS.''])!="") { ?>
<table class="table table-striped table-bordered table-hover display table-header-fixed" style="background-color:#ffffff;" cellspacing="0" width="100%">

    <tbody>
        <?
        $corSet = "#ffffff";
        $carrinhoArray = unserialize($_SESSION['eventos_tickets_'.$_GET['chave_urlS'].''.$numeroUnico_paiS.'']);
        $carrinhoArray = array_sort($carrinhoArray, 'ticket_data', SORT_ASC);
        foreach ($carrinhoArray as $key => $value) {
			$contLista++;
			if($corSet=="#ffffff") {
				$corSet = "#e2e2e2";
			} else {
				$corSet = "#ffffff";
			}

			if(trim($value['ticket_compra_autorizada'])=="0" || trim($value['ticket_compra_autorizada'])=="") {
				$compra_autorizadaSet = "";
			} else if(trim($value['ticket_compra_autorizada'])=="1") {
				$compra_autorizadaSet = "<br><i>Apenas Compra Autorizada</i>";
			}

			if($value['ticket_genero']=="U") {
				$generoSet = "Unissex";
			} else if($value['ticket_genero']=="F") {
				$generoSet = "Feminino";
			} else if($value['ticket_genero']=="M") {
				$generoSet = "Masculino";
			}

			if($value['ticket_exibir_site']=="1") {
				if($value['ticket_exibir_app']=="1") {
					if($value['ticket_exibir_pdv']=="1") {
						if($value['ticket_exibir_com']=="1") {
							$plataformasSet = "Site, App, PDV e Comissário";
						} else {
							$plataformasSet = "Site, App e PDV";
						}
					} else {
						if($value['ticket_exibir_com']=="1") {
							$plataformasSet = "Site, App e Comissário";
						} else {
							$plataformasSet = "Site e App";
						}
					}
				} else {
					if($value['ticket_exibir_pdv']=="1") {
						if($value['ticket_exibir_com']=="1") {
							$plataformasSet = "Site, PDV e Comissário";
						} else {
							$plataformasSet = "Site e PDV";
						}
					} else {
						if($value['ticket_exibir_com']=="1") {
							$plataformasSet = "Site e Comissário";
						} else {
							$plataformasSet = "Site";
						}
					}
				}
			} else {
				if($value['ticket_exibir_app']=="1") {
					if($value['ticket_exibir_pdv']=="1") {
						if($value['ticket_exibir_com']=="1") {
							$plataformasSet = "App, PDV e Comissário";
						} else {
							$plataformasSet = "App e PDV";
						}
					} else {
						if($value['ticket_exibir_com']=="1") {
							$plataformasSet = "App e Comissário";
						} else {
							$plataformasSet = "App";
						}
					}
				} else {
					if($value['ticket_exibir_pdv']=="1") {
						if($value['ticket_exibir_com']=="1") {
							$plataformasSet = "PDV e Comissário";
						} else {
							$plataformasSet = "PDV";
						}
					} else {
						if($value['ticket_exibir_com']=="1") {
							$plataformasSet = "Comissário";
						} else {
							$plataformasSet = "";
						}
					}
				}
			}
			
			if(trim($value['ticket_cpf_qtd'])=="" || trim($value['ticket_cpf_qtd'])=="0" || trim($value['ticket_cpf_qtd'])=="1") {
				$value['ticket_cpf_qtd'] = "1 ingresso de atribuição por CPF";
			} else {
				$value['ticket_cpf_qtd'] = "".$value['ticket_cpf_qtd']." ingressos de atribuição por CPF";
			}
			
			if(trim($plataformasSet)=="") { } else { $plataformasSet = "<br> <b style\"font-size:9px;\">".$plataformasSet."</b>"; }
			
        ?>
        <tr style="background-color:<?=$corSet?>;" role="row">
            <td style="vertical-align:middle;width:60px;">
            <? if(trim($value['ticket_imagem_de_capa'])=="") { } else { ?>
            <img style="max-width:50px;border-radius: 5px !important;" src="<?=$link?>files/eventos_ticket_imagem_de_capa/<?=$value['numeroUnico']?>/<?=$value['ticket_imagem_de_capa']?>" />
            <? } ?>
            </td>
            <td style="vertical-align:middle;"><?=$value['ticket_nome']?><br /><i><?=ajustaDataReturn($value['ticket_data'],"d/m/Y");?></i><?=$plataformasSet?><?=$compra_autorizadaSet?><br /><i><?=$value['ticket_cpf_qtd']?></i></td>
            <td style="vertical-align:middle;width:50px;"><?=$generoSet?></td>
            <td style="vertical-align:middle;width:140px;" class="block_check_click">
                <div class="btn-group">
                    <span class="blue-madison btn btn-sm" style="background-color:#169ef4;" onclick="javascript:eventos_tickets_view('<?=$value['numeroUnico']?>');" title="Editar Ticket"><i class="fal fa-edit"></i></span> 
                </div>
                <div class="btn-group">
                    <? if(trim($value['stat'])=="0") { ?>
                    <span class="red btn btn-sm" onclick="javascript:eventos_tickets_stat('<?=$value['numeroUnico']?>','1');" title="Publicar"><i class="fa fa-thumbs-up"></i></span> 
                    <? } else { ?>
                    <span class="green btn btn-sm" onclick="javascript:eventos_tickets_stat('<?=$value['numeroUnico']?>','0');" title="Despublicar"><i class="fa fa-thumbs-up"></i></span> 
                    <? } ?>
                </div>
                <? if(trim($value['ticket_tipo'])=="2") { ?>
                <div class="btn-group">
                    <span class="blue-madison btn btn-sm" onclick="javascript:alert('Este é um ticket de Lista Bônus e não possui a opção de inserção de lotes');" title="Visualizar Lotes"><i class="fal fa-list-alt"></i></span> 
                </div>
                <? } else { ?>
                <div class="btn-group">
                    <span class="blue-madison btn btn-sm" onclick="javascript:eventos_tickets_lista_horarios_produtos_e_lotes('<?=$value['numeroUnico']?>');" title="Visualizar Horários, Produtos e Lotes"><i class="fal fa-list-alt"></i></span> 
                </div>
                <? } ?>
            </td>

        </tr>
        <? } ?>
    </tbody>
</table>
<? } ?>
<input type="hidden" id="eventos_tickets_lista" value="<?=$contLista?>" />
