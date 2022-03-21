<?php
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/defines.php");

$alfabetoMin =   array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
$alfabetoMai =   array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

$diasemana_sem_feira = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
$diasemana = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');					
$diasemana_mini = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');					
$diasemana_slug = array('domingo', 'segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado');					
$meses1 = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto','Setembro','Outubro','Novembro','Dezembro');					
$meses2 = array('Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago','Set','Out','Nov','Dez');					

# Função responsável por conexão de Banco de Dados
if(!function_exists('conexao')) {
	function conexao() {
		$dbcon = mysqli_connect("","root","") // host, usuário bd, senha bd
		or die("Não foi possível conectar ao servidor msql: ".mysqli_error()); // erro retornado no caso de erro de conexão

		mysqli_select_db($dbcon, "" ) // banco de dados
		or die("Não foi possível selecionar o banco de dados desejado: ".mysqli_error());  // erro retornado no caso de erro de conexão

		mysqli_query($dbcon, "SET NAMES 'utf8'");
		mysqli_query($dbcon, 'SET character_set_connection=utf8');
		mysqli_query($dbcon, 'SET character_set_client=utf8');
		mysqli_query($dbcon, 'SET character_set_results=utf8');
	}
}

conexao();

include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/mysqli.php");

date_default_timezone_set('America/Sao_Paulo');
$data = date("Y-m-d H:i:s");
$timestamp_atual = time();
$timestamp_limite = $timestamp_atual - 15;
$timestamp_limite_chat = $timestamp_atual - 10;
$hora = time();
$hora_limite = time() - (30*60);
$hora_limite_editando = time() - (60*5);
$url_gateway = "".URL_GATEWAY."";

$virgula_ip = stripos($_SERVER['HTTP_X_FORWARDED_FOR'],",");
$meu_ip_set = substr($_SERVER['HTTP_X_FORWARDED_FOR'],0,$virgula_ip);

//Variável que controla se o script de contador de visitantes esta ativo
$controle_visitante = "off";

# Dados de conexão FTP
#$sysconfig = mysql_queryCache_itens("1", "SELECT * FROM sysconfig");
$sysconfig    = mysql_fetch_array(mysql_query("SELECT * FROM sysconfig"));
$sysconfig[0] = $sysconfig;

# Dados Cloudflare
$cloudflare_url = 'https://api.cloudflare.com/client/v4/zones';
$cloudflare_account_id = ''.$sysconfig['cloudflare_account_id'].''; // Cloudflare Accoutn ID
$cloudflare_global_apikey = ''.$sysconfig['cloudflare_global_apikey'].''; // Cloudflare Global API
$cloudflare_email = ''.$sysconfig['cloudflare_email'].''; // Cloudflare Email Adress

#mysql_query("DELETE FROM syseditando WHERE ultima_atividade < '".$hora_limite_editando."' ");

if(trim($_COOKIE["perfil"])=="") { 
	$layout_padrao_set = "metronic";
} else { 
	if(trim($_COOKIE["perfil"])=="admin") { 
		$sysusu_array = arraySysusu($_COOKIE['email'],$_COOKIE['senha']);
		#$sysusu    = $sysusu_array[0];
		$sysusu    = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE email='".$_COOKIE['email']."' AND senha='".$_COOKIE['senha']."'"));

	} else if(trim($_COOKIE["perfil"])=="comissario") { 
		$sysusu    = mysql_fetch_array(mysql_query("SELECT * FROM usuario WHERE cpf='".$_COOKIE['cpf']."' AND senha='".$_COOKIE['senha']."' AND usuario_tipo LIKE '%comissario%'"));
	} else if(trim($_COOKIE["perfil"])=="pdv") { 
		$sysusu    = mysql_fetch_array(mysql_query("SELECT * FROM pdv WHERE email='".$_COOKIE['email']."' AND senha='".$_COOKIE['senha']."' AND stat='1'"));
	} else if(trim($_COOKIE["perfil"])=="conviteamigo") { 
		$sysusu    = mysql_fetch_array(mysql_query("SELECT * FROM usuario WHERE cpf='".$_COOKIE['cpf']."' AND senha='".$_COOKIE['senha']."' AND usuario_tipo LIKE '%conviteamigo%'"));
	} else if(trim($_COOKIE["perfil"])=="cupom") { 
		$sysusu    = mysql_fetch_array(mysql_query("SELECT * FROM usuario WHERE cpf='".$_COOKIE['cpf']."' AND senha='".$_COOKIE['senha']."' AND usuario_tipo LIKE '%cupom%'"));
	}

	$_SESSION['sysusu'] = $sysusu;
	$idsysusuSend = $sysusu['id'];
	$layout_padrao_set = "metronic";
	$_construtor_sysperm = unserialize($sysusu['permissoes']);

	if(trim($_COOKIE["perfil"])=="admin") { 
		$update = mysql_query("UPDATE sysusu SET dataLogin='".$data."' WHERE id='".$sysusu['id']."'");
	}
}

if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") { } else {
	$rSqlEmpresa = mysql_fetch_array(mysql_query("SELECT * FROM empresa WHERE id='".$sysusu['empresa']."'"));
	$sysusu_empresa = mysql_fetch_array(mysql_query("SELECT * FROM empresa WHERE id='".$sysusu['empresa']."'"));
}

if(trim($sysusu['pdv'])=="" || trim($sysusu['pdv'])=="0") { } else {
	$rSqlPdvBilheteria = mysql_fetch_array(mysql_query("SELECT * FROM pdv WHERE numeroUnico='".$sysusu['pdv']."'"));
}

if(trim($_POST['empresa'])=="" || trim($_POST['empresa'])=="0") {
	$rSqlEmpresa['id'] = 0; 
	$rSqlEmpresa['token'] = 0; 
	define("GOOGLE_MAP_KEY","".$sysconfig[0]['google_api_key']."");
	$GOOGLE_MAP_KEY_SET = "".$sysconfig[0]['google_api_key']."";
} else {
	$rSqlEmpresa = mysql_fetch_array(mysql_query("SELECT id,numeroUnico,token,google_api_key,plataforma,plataforma_token FROM empresa WHERE id='".$_POST['empresa']."'"));
	if(trim($rSqlEmpresa['google_api_key'])=="") {
		define("GOOGLE_MAP_KEY","".$sysconfig[0]['google_api_key']."");
		$GOOGLE_MAP_KEY_SET = "".$sysconfig[0]['google_api_key']."";
	} else {
		define("GOOGLE_MAP_KEY","".$rSqlEmpresa['google_api_key']."");
		$GOOGLE_MAP_KEY_SET = "".$rSqlEmpresa['google_api_key']."";
	}

}

# Definição da linguagem do administrativo
$linguagem_set = "";

# Definição da linguagem do site
$linguagem_set_site = "";

# Definição do prazo de liquidacao
$prazo_liquidacao = 31;

# Dados de conexão FTP
$hostFTP  = "".$sysconfig[0]['ftp_host']."";
$userFTP  = "".$sysconfig[0]['ftp_user']."";
$senhaFTP = "".$sysconfig[0]['ftp_pass']."";
$adminRootFTP = "".$sysconfig[0]['ftp_root']."";

$link_vpnssl = "".$sysconfig[0]['url_admin']."";
$link_admin_novo = $link_vpnssl;
$link_oficial = "".$sysconfig[0]['url_admin']."";
$link_site = "".$sysconfig[0]['url_site']."";

$link = "".$sysconfig[0]['url_admin']."";

$menu_set = "on";

if(trim($_COOKIE['empresas_relacionadas'])==""||trim($_COOKIE['empresas_relacionadas'])=="0") {
	if(trim($sysusu['empresas_relacionadas'])==""||trim($sysusu['empresas_relacionadas'])=="0") {
		$empresas_relacionadasSet = "";
	} else {
		$empresas_relacionadasSet = $sysusu['empresas_relacionadas'];
	}
} else {
	$empresas_relacionadasSet = $_COOKIE['empresas_relacionadas'];
}

if(trim($_COOKIE['empresa'])==""||trim($_COOKIE['empresa'])=="0") {
	if(trim($sysusu['empresa'])==""||trim($sysusu['empresa'])=="0") {
		$empresaSet = "";
	} else {
		$empresaSet = $sysusu['empresa'];
	}
} else {
	$empresaSet = $_COOKIE['empresa'];
}

$plataformasSet = $_construtor_sysperm['plataformas'];
$plataformasSet = str_replace("||","','",$plataformasSet);
$plataformasSet = str_replace("|","'",$plataformasSet);
if(trim($plataformasSet)=="") {
	$filtro_plataformasSet = "";
} else {
	$filtro_plataformasSet = " mod_plataforma.numeroUnico IN (".$plataformasSet.") ";
}

if(trim($sysusu['empresa'])=="" || trim($sysusu['empresa'])=="0") {
	$filtro["empresa"] = ""; 
	$filtro["mod_pessoas"] = ""; 
	$filtro["mod_eventos"] = ""; 
} else { 
	$filtro["empresa"] = " AND empresa='".$sysusu['empresa']."'"; 
	$filtro["mod_pessoas"] = " AND mod_pessoas.empresa='".$sysusu['empresa']."'"; 
	$filtro["mod_eventos"] = " AND mod_eventos.empresa='".$sysusu['empresa']."'"; 
}

$dominio_set = $_SERVER["SERVER_NAME"];

$pos      = strripos($dominio_set, "www.");
$pos2      = strripos($_SERVER["HTTP_HOST"], "www.");
if ($pos === false) { 
	if ($pos2 === false) { 
		$dominio_set = "www.".$dominio_set."";
	} else { 
		$dominio_set = "".$dominio_set.""; 
	}
} else { 
	$dominio_set = "".$dominio_set.""; 
}
$pos      = strripos($dominio_set, "www.");
if ($pos === false) { 
	$dominio_set = "www.".$dominio_set."";
} else { 
	$dominio_set = "".$dominio_set.""; 
}
$link = "//".$dominio_set."/admin/";

if(trim($sysconfig[0]['url_admin'])=="//".$dominio_set."/admin/") {
	if(trim($sysconfig[0]['nome'])=="") {
		$tituloSeo = "Sistema Admin";
		$nomeRodape = "SAGUARO";
		$siteRodape = "https://www.saguarocomunicacao.com/";
		$logotipoAdmin = "";
		$logotipoAdminMenu = "";
		$faviconAdmin = "<link rel=\"icon\" type=\"image/ico\" href=\"".$link."template/img/favicon-tagx.ico\">";
	} else {
		$tituloSeo = "Admin ".$sysconfig[0]['nome']."";
		$nomeRodape = "".$sysconfig[0]['nome']."";
		$siteRodape = "https://www.saguarocomunicacao.com/";
		$logotipoAdmin = "<img src=\"".$link."files/sysconfig/".$sysconfig[0]['logotipo']."\" style=\"max-height:100px;max-width: 100%;\" alt=\"".$sysconfig[0]['nome']."\">";
		$logotipoAdminMenu = "<img src=\"".$link."files/sysconfig/".$sysconfig[0]['logotipo']."\" style=\"max-height:35px;margin:6px 0 0 0;max-width:95%;\" alt=\"".$sysconfig[0]['nome']."\">";
		$faviconAdmin = "<link rel=\"icon\" type=\"image/ico\" href=\"".$link."files/sysconfig/".$sysconfig[0]['favicon']."\">";
	}
} else {
	$sysconfig_empresa = mysql_fetch_array(mysql_query("SELECT * FROM empresa WHERE dominio='".$dominio_set."'"));
	$tituloSeo = "Admin ".$sysconfig_empresa['nome']."";
	$nomeRodape = "".$sysconfig_empresa['nome']."";
	$siteRodape = "https://".$dominio_set."/";
	if(trim($sysconfig_empresa['imagem'])=="") { } else {
		$logotipoAdmin = "<img src=\"//".$dominio_set."/admin/files/empresa/".$sysconfig_empresa['numeroUnico']."/logotipo.png\" style=\"max-height:100px;max-width: 100%;\" alt=\"".$sysconfig_empresa['nome']."\">";
		$logotipoAdminMenu = "<img src=\"//".$dominio_set."/admin/files/empresa/".$sysconfig_empresa['numeroUnico']."/logotipo.png\" style=\"max-height:35px;margin:6px 0 0 0;max-width:95%;\" alt=\"".$sysconfig_empresa['nome']."\">";
	}
	if(trim($sysconfig_empresa['favicon'])=="") { } else {
		$faviconAdmin = "<link rel=\"icon\" type=\"image/ico\" href=\"//".$dominio_set."/admin/files/empresa/".$sysconfig_empresa['numeroUnico']."/favicon.png\">";
	}
}

?>