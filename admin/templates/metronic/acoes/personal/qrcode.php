<?
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/lib/phpqrcode/qrlib.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/lib/phpqrcode/qrconfig.php");

$tempDir = EXAMPLE_TMP_SERVERPATH;

$codeContents = "".$_REQUEST['cod_voucher'].""; 
     
// generating 
QRcode::png($codeContents); 
?>
                    