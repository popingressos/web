<?
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");


$rSqlUsuario = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$_GET['idS']."'"));

$strSqlSession = "
	SELECT 
		mod_sessoes_de_whatsapp.numeroUnico,
		mod_sessoes_de_whatsapp.session
	
	FROM 
		sessoes_de_whatsapp AS mod_sessoes_de_whatsapp 

	WHERE 
		mod_sessoes_de_whatsapp.status='CONNECTED' AND
		mod_sessoes_de_whatsapp.empresa='".$rSqlUsuario['empresa']."'

	ORDER BY
		RAND ()
";
$rSqlSession = mysql_fetch_array(mysql_query("".$strSqlSession.""));

$rSqlSend['assunto'] = "QRCode de Login PDV";
$assuntoWhatsSet = $rSqlSend['assunto'];
$textoWhatsSet = "Posicione o leitor de QRCode e realize a leitura para fazer o login no seu PDV";
$nomeWhatsSet = $rSqlUsuario['nome'];
$emailWhatsSet = $rSqlUsuario['email'];
$rSqlSend['whatsapp'] = $rSqlUsuario['whatsapp'];
$imagemWhatsSet = "https://www.saguarocomunicacao.com.br/admin/files/qrcode/".$rSqlUsuario['cod_voucher'].".jpg";

#NOVO ENVIO DE WHATSAPP
$rSqlSend['modelo_de_envio_texto'] = 1;
$rSqlSend['modelo_de_envio_pessoa'] = 1;
$rSqlSend['modelo_de_envio_evento'] = 0;
$rSqlSend['com_qrcode'] = 0;
$rSqlSend['whatsapp'] = $rSqlSend['whatsapp'];
$rSqlSend['titulo'] = $rSqlSend['assunto'];
$rSqlSend['nome'] = "".$rSqlUsuario['nome']."";
$rSqlSend['email'] = "".$rSqlUsuario['email']."";
$rSqlSend['documento'] = "";
$rSqlSend['evento_nome'] = "";
$rSqlSend['ingresso_nome'] = "";
$rSqlSend['ingresso_data'] = "";
$rSqlSend['lote_nome'] = "";
$rSqlSend['cod_voucher'] = "";
$rSqlSend['imagem'] = "".$imagemWhatsSet."";
$rSqlSend['texto'] = "".$textoWhatsSet."";
enviarWhatsApp2($rSqlSession['session'],$rSqlSend);

#include("".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/notificacao-whats.php");
?>

