<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$_SESSION['numeroUnico_ticket'] = $_GET['numeroUnico_ticketS'];

$carrinhoArray = unserialize($_SESSION['eventos_tickets_'.$_GET['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']);
$carrinhoArray = array_sort($carrinhoArray, 'ticket_nome', SORT_ASC);
foreach ($carrinhoArray as $key => $value) {
	if($_GET['numeroUnico_ticketS']==$value['numeroUnico']) {
		$nomeTicket = "".$value['ticket_nome']."";
	}
}

$contHorarios = 0;
?>

<div class="note note-info" style="margin-bottom:0px;padding-top:5px;">
    <h3><font style="font-size:14px;">HORÁRIOS DO TICKET</font> <br /><b><?=$nomeTicket?></b></h3>
    <p>Preencha os campos abaixo e clique em 'Adicionar Horário' para inserir novos horários</p>
</div>

<div class="form-group" style="margin-bottom:10px;">
    <label class="control-label col-md-12" style="text-align:left;">Começa em</label>
    <div class="col-md-12">
        <input type="text" id="horario_inicio" value="00:00" class="form-control input-sm timepicker timepicker-24" style="height: 34px;">
    </div>
</div>

<div class="form-group" style="margin-bottom:10px;">
    <label class="control-label col-md-12" style="text-align:left;">Duração de cada horário</label>
    <div class="col-md-12">
        <input value="" type="text" id="horario_periodo" onkeypress="javascript:mascara(this,soNumeros);" placeholder="" class="form-control" />
        <p class="help-block">Quantidade deve ser informada em minutos. Ex.: Para 1 hora, deve-se informa 60.</p>
    </div>
</div>

<div class="form-group" style="margin-bottom:10px;">
    <label class="control-label col-md-12" style="text-align:left;">Intervalo entre um horário e outro?</label>
    <div class="col-md-12">
        <input value="" type="text" id="horario_intervalo" onkeypress="javascript:mascara(this,soNumeros);" placeholder="" class="form-control" />
        <p class="help-block">Caso os horários possuam intervalo entre um e outro, preencha o tempo de intervalo no campo acima. Ex.: Caso você queira inserir 3 horários de 1 hora de duração, porém com 15 minutos de intervalo
        das 13:00 às 14:00, 14:15h às 16:15 e 16:30 às 17:30.</p>
    </div>
</div>

<div class="form-group" style="margin-bottom:10px;">
    <label class="control-label col-md-12" style="text-align:left;">Quantidade</label>
    <div class="col-md-12">
        <input value="" type="text" id="horario_qtd" onkeypress="javascript:mascara(this,soNumeros);" placeholder="" class="form-control" />
    </div>
</div>

<div class="form-group" style="margin-bottom:10px;">
    <div class="col-md-10">
        <a class="btn input-label" onclick="javascript:eventos_horarios_add('<?=$_SESSION['numeroUnico_ticket']?>');" style="background-color:#19d18e;color:#FFF;text-align:center;"><i class="fa fa-plus"></i>&nbsp;Adicionar Horário</a>
    </div>
</div>

<div id="eventos_horarios-lista" style="width:100%;display:block;">
<? if(trim($_SESSION['eventos_horarios_'.$_GET['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].''])!="") { ?>
	<?
	$carrinhoArray = unserialize($_SESSION['eventos_horarios_'.$_GET['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']);
	$carrinhoArray = array_sort($carrinhoArray, 'horario_inicio_time', SORT_ASC);
	foreach ($carrinhoArray as $key => $value) {
		if(trim($_SESSION['numeroUnico_ticket'])==trim($value['numeroUnico_ticket'])) {
			$contHorarios++;
		}
	}
	?>
    <? if($contHorarios>0) { ?>
    <div class="note note-info" style="margin-bottom:0px;">
        <p>Horários disponíveis deste ticket</p>
    </div>
    
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
    <table class="table table-striped table-bordered table-hover display table-header-fixed" style="background-color:#ffffff;" cellspacing="0" width="100%">
    
        <thead>
    
            <tr>
                <th>De</th>
                <th>Até</th>
                <th style="width:90px;"></th>
            </tr>
    
        </thead>
    
        <tbody>
            <?
            $corSet = "#ffffff";
            $carrinhoArray = unserialize($_SESSION['eventos_horarios_'.$_GET['chave_urlS'].''.$_SESSION['numeroUnicoGerado'].'']);
            $carrinhoArray = array_sort($carrinhoArray, 'horario_inicio_time', SORT_ASC);
            foreach ($carrinhoArray as $key => $value) {
                if(trim($_SESSION['numeroUnico_ticket'])==trim($value['numeroUnico_ticket'])) {
                    if($corSet=="#ffffff") {
                        $corSet = "#e2e2e2";
                    } else {
                        $corSet = "#ffffff";
                    }
            ?>
            <tr style="background-color:<?=$corSet?>;" role="row">
                <td style="vertical-align:middle;"><?=$value['horario_inicio']?></td>
                <td style="vertical-align:middle;"><?=$value['horario_fim']?></td>
                <td style="vertical-align:middle;" class="block_check_click">
                    <div class="btn-group">
                        <? if(trim($value['stat'])=="0") { ?>
                        <span class="red btn btn-sm" onclick="javascript:eventos_horarios_stat('<?=$value['numeroUnico_ticket']?>','<?=$value['numeroUnico']?>','1');" title="Publicar"><i class="fa fa-thumbs-up"></i></span> 
                        <? } else { ?>
                        <span class="green btn btn-sm" onclick="javascript:eventos_horarios_stat('<?=$value['numeroUnico_ticket']?>','<?=$value['numeroUnico']?>','0');" title="Despublicar"><i class="fa fa-thumbs-up"></i></span> 
                        <? } ?>
                    </div>
                    <div class="btn-group">
                        <span class="red-sunglo btn btn-sm" onclick="javascript:eventos_horarios_del('<?=$value['numeroUnico_ticket']?>','<?=$value['numeroUnico']?>');" title="Excluir"><i class="fa fa-times"></i></span> 
                    </div>
                </td>
    
            </tr>
            <? } ?>
            <? } ?>
        </tbody>
    </table>
	<? } ?>
<? } ?>
</div>

<script>
$('.timepicker').timepicker({
	autoclose: true,
	minuteStep: 5,
	showSeconds: false,
	showMeridian: false
});
</script>