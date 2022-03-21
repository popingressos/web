<?
$colDelim = ",";
$rowDelim = "\r\n";

$relatorio_html = substr($relatorio_html,strpos($relatorio_html,"#ID"),strlen($relatorio_html));
$html = $relatorio_html;

$html = str_replace("<table class=\"table table-striped table-bordered table-hover tabela_com_scroll\" id=\"sample_1\">", "", $html);
$html = str_replace("<thead>", "", $html);
$html = str_replace("</thead>", "", $html);
$html = str_replace("<tbody>", "", $html);
$html = str_replace("</tbody>", "", $html);
$html = str_replace("</table>", "", $html);

$html = str_replace("<th>", "<td>", $html);
$html = str_replace("</th>", "</td>", $html);

#$html = html_entity_decode(htmlentities($html, ENT_QUOTES, 'UTF-8'), ENT_QUOTES , 'ISO-8859-15');

$html = str_replace("<td>", "", $html);
$html = str_replace("</td>", "".$colDelim."", $html);

$html = str_replace("<tr>", "", $html);
$html = str_replace("<tr>", "", $html);
$html = str_replace("<tr>", "", $html);
$html = str_replace("</tr>", "".$rowDelim."", $html);

$data_arquivo = date("YmdHis");
$arquivo_csv = "".$_SERVER['DOCUMENT_ROOT']."/admin/files/csv_export/gerador_de_relatorio_csv_".$data_arquivo.".csv";
$arquivo_xls = "".$_SERVER['DOCUMENT_ROOT']."/admin/files/csv_export/gerador_de_relatorio_excel_".$data_arquivo.".xls";

$fp = fopen($arquivo_csv, 'w+');

fputcsv($fp, $html);

fwrite($fp, $html); /** Once the data is written it will be saved in the path given */
fclose($fp);

// Converte para XLS
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/lib/phpexcel/Classes/PHPExcel/IOFactory.php");

$objReader = PHPExcel_IOFactory::createReader('CSV');
$objReader->setInputEncoding('UTF-8'); // habilita os caracteres latinos.
$objPHPExcel = $objReader->load($arquivo_csv); //indica qual o arquivo_csv CSV que será convertido
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

// It will be called file.xls
header('Content-Disposition: attachment; filename="gerador_de_relatorio_excel_'.$data_arquivo.'.xls"');

// Write file to the browser
#$objWriter->save('php://output');

#$objWriter->save("".$arquivo_xls.""); // Resultado da conversão; um arquivo do EXCEL  

ob_end_clean();
ob_start();
$objWriter->save('php://output');

#header("Content-Length: ".filesize($arquivo_xls)); // informa o tamanho do arquivo ao navegador
#header("Content-Disposition: attachment; filename=".basename($arquivo_xls)); // informa ao navegador que é tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo
#readfile($arquivo_xls); // lê o arquivo

if(file_exists($arquivo_csv)){
    unlink($arquivo_csv);
}
if(file_exists($arquivo_xls)){
    unlink($arquivo_xls);
}

exit; // aborta pós-ações
?>
