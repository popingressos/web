<?
#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);
#error_reporting( error_reporting() & ~E_NOTICE );

require "".$_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";
ob_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Relatório PDF</title>
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">

        <meta http-equiv='cache-control' content='no-cache'>
        <meta http-equiv='expires' content='0'>
        <meta http-equiv='pragma' content='no-cache'>
        <meta name="robots" content="noindex">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,400;0,600;1,200;1,400;1,600&display=swap" rel="stylesheet">

        <style>
		body {
			font-family: 'Montserrat', sans-serif;
		}
		.cabecalho {
			background-color:#6e7c91;
			color:#ffffff !important;
			font-weight:bold;
			padding:10px 10px;
		}
		table td {
			padding:10px 10px;
			color:#6e7c91 !important;
		}
        </style>

    </head>
<body style="background-color:#FFF;"> 
    <h4 class="font-green-sharp" style="padding-bottom:10px;">
        <span style="width:100%;float:left;padding-bottom:10px;"><i class="fal fa-file-invoice" style="padding-right:10px;"></i><?=$row['empresa_nome']?></span><br>
        <span style="width:100%;font-size:12px;font-style:italic;"><?=$periodoGeracaoSet?></span>
    </h4>

	<?=$row['texto']?>
	<? include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/gerador_de_relatorios-".$row['modelo_tipo'].".php"); ?>
    <?=$row['texto_rodape']?>

</body>
<!-- END BODY -->
</html>
<?
$html = ob_get_contents();
ob_end_clean();

$mpdf = new \Mpdf\Mpdf(array('orientation' => 'L'));

$mpdf->useSubstitutions = true; // optional - just as an example
$mpdf->SetHeader("\n\n" . 'Página {PAGENO}');  // optional - just as an example
$mpdf->CSSselectMedia='mpdf'; // assuming you used this in the document header
$mpdf->setBasePath($url);
$mpdf->WriteHTML($html);

$mpdf->Output();
?>
