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

$fp = fopen($arquivo_csv, 'w+');

fputcsv($fp, $html);

fwrite($fp, $html); /** Once the data is written it will be saved in the path given */
fclose($fp);

header("Content-Length: ".filesize($arquivo_csv)); // informa o tamanho do arquivo_csv ao navegador
header("Content-Disposition: attachment; filename=".basename($arquivo_csv)); // informa ao navegador que é tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo_csv
readfile($arquivo_csv); // lê o arquivo_csv
if(file_exists($arquivo_csv)){
    unlink($filePath);
}

exit; // aborta pós-ações

?>



