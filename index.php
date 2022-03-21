<?php
include("".$_SERVER['DOCUMENT_ROOT']."/include/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/include/url.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");

$dominio_set = $_SERVER["SERVER_NAME"];

if(trim($dominio_set)=="www.saguarocomunicacao.com" || trim($dominio_set)=="saguarocomunicacao.com") {
	$rSqlConfig = mysql_fetch_array(mysql_query("SELECT * FROM configuracoes_descricao LIMIT 1"));
	$configuracoes_site = mysql_fetch_array(mysql_query("SELECT * FROM site WHERE empresa_token='IH5LJS7DKI' "));
	$template_layout = "saguarocomunicacao";
	$link_modelo = "//www.saguarocomunicacao.com/";
} else {

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

	$nSqlEmpresaDominioS = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM empresa_dominios WHERE dominio='".str_replace("www.","",$dominio_set)."' "));
	if($nSqlEmpresaDominioS[0]>0) {
		$rSqlEmpresaDominio = mysql_fetch_array(mysql_query("SELECT plataforma,plataforma_token,token,dominio,empresa_token FROM empresa_dominios WHERE dominio='".str_replace("www.","",$dominio_set)."' AND stat='1' "));
		$rSqlEmpresa = mysql_fetch_array(mysql_query("SELECT dominio FROM empresa WHERE token='".$rSqlEmpresaDominio['empresa_token']."' AND stat='1' "));
		echo "<script>window.open('https://".$rSqlEmpresa['dominio']."','_self','')</script>";
	} else {
		$rSqlEmpresaDominio = mysql_fetch_array(mysql_query("SELECT plataforma,plataforma_token,token,dominio,empresa_token FROM empresa WHERE dominio='".$dominio_set."' AND stat='1' "));
		$rSqlEmpresa = mysql_fetch_array(mysql_query("SELECT * FROM empresa WHERE token='".$rSqlEmpresaDominio['token']."' AND stat='1' "));
	}

	if(trim($rSqlEmpresaDominio['plataforma_token'])=="" || trim($rSqlEmpresaDominio['plataforma_token'])=="0") {
		$rSqlEmpresa = mysql_fetch_array(mysql_query("SELECT * FROM empresa WHERE token='".$rSqlEmpresaDominio['token']."' "));
		$rSqlEmpresaConfig = mysql_fetch_array(mysql_query("SELECT * FROM empresa WHERE token='".$rSqlEmpresaDominio['token']."' "));
		if(trim($rSqlEmpresa['tipo_empresa'])=="centralizador_de_empresas") {
			$campoWhereEmpresaEventos = "plataforma_token";
		} else {
			$campoWhereEmpresaEventos = "empresa_token";
		}
	} else {
		$rSqlEmpresa = mysql_fetch_array(mysql_query("SELECT * FROM empresa WHERE token='".$rSqlEmpresaDominio['plataforma_token']."' "));
		$rSqlEmpresaConfig = mysql_fetch_array(mysql_query("SELECT * FROM empresa WHERE token='".$rSqlEmpresaDominio['token']."' "));
		$campoWhereEmpresaEventos = "empresa_token";
	}


	$configuracoes_site = mysql_fetch_array(mysql_query("
										SELECT 
											mod_site.*,

											mod_site2.*
										FROM 
											site AS mod_site 
										LEFT JOIN 
											site2 AS mod_site2 ON (mod_site2.numeroUnico_site = mod_site.numeroUnico)
										
										WHERE 
											mod_site.empresa_token='".$rSqlEmpresaConfig['token']."' AND
											mod_site.stat='1'
	"));
	$rSqlConfig = mysql_fetch_array(mysql_query("SELECT * FROM configuracoes_descricao WHERE empresa_token='".$rSqlEmpresaConfig['token']."' ORDER BY data DESC LIMIT 1"));
	
	$EMPRESA_TOKEN = $rSqlEmpresa['token'];
	$EMPRESA_TOKEN_CONFIG = $rSqlEmpresa['token'];
	$template_layout = "".$configuracoes_site['template']."";
	$template_pasta = "".$configuracoes_site['template_pasta']."";
	$link_modelo = "//".$dominio_set."/";

	if(trim($_SESSION['empresa_'.$rSqlEmpresa['id'].'_numeroUnico_carrinho'])=="") { 
		$_SESSION['empresa_'.$rSqlEmpresa['id'].'_numeroUnico_carrinho'] = geraCodReturn();
		include("".$_SERVER['DOCUMENT_ROOT']."/include/limpa-session.php"); 
	} else {
		$_SESSION['empresa_'.$rSqlEmpresa['id'].'_numeroUnico_carrinho'] = $_SESSION['empresa_'.$rSqlEmpresa['id'].'_numeroUnico_carrinho'];
		$nSqlCarrinho = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM carrinho WHERE numeroUnico_pai='".$_SESSION['empresa_'.$rSqlEmpresa['id'].'_numeroUnico_carrinho']."' AND stat='1'"));
	}
	$empresa_numeroUnico_carrinho = $_SESSION['empresa_'.$rSqlEmpresa['id'].'_numeroUnico_carrinho'];

	if(trim($_SESSION["logado_".$rSqlEmpresa['id'].""]["id"])=="") {
		if(trim($_SESSION["empresa_".$rSqlEmpresa['id']."_email"])=="" && (trim($_SESSION["empresa_".$rSqlEmpresa['id']."_senha"])=="" || trim($_SESSION["empresa_".$rSqlEmpresa['id']."_token_facebook"])=="" || trim($_SESSION["empresa_".$rSqlEmpresa['id']."_token_google"])=="") ) { } else {
			if(trim($_SESSION["empresa_".$rSqlEmpresa['id']."_senha"])=="") {
				if(trim($_SESSION["empresa_".$rSqlEmpresa['id']."_token_facebook"])=="") {
					if(trim($_SESSION["empresa_".$rSqlEmpresa['id']."_token_google"])=="") {
						$autenticacao_senha = "  AND senha='SEM_AUTENTICACAO' ";
					} else {
						$autenticacao_senha = "  AND token_google='".$_SESSION["empresa_".$rSqlEmpresa['id']."_token_google"]."' ";
					}
				} else {
					$autenticacao_senha = "  AND token_facebook='".$_SESSION["empresa_".$rSqlEmpresa['id']."_token_facebook"]."' ";
				}
			} else {
				$autenticacao_senha = "  AND senha='".$_SESSION["empresa_".$rSqlEmpresa['id']."_senha"]."' ";
			}
			if(trim($_SESSION["empresa_".$rSqlEmpresa['id']."_tabela"])=="pessoas") {
				$autenticacao_email_valido = "  AND email_valido='1' ";
			} else {
				$autenticacao_email_valido = "";
			}
	
			$rSqlUsuario = mysql_fetch_array(mysql_query("SELECT * FROM ".$_SESSION["empresa_".$rSqlEmpresa['id']."_tabela"]." WHERE email='".$_SESSION["empresa_".$rSqlEmpresa['id']."_email"]."' ".$autenticacao_senha." ".$autenticacao_email_valido." AND stat='1' AND empresa='".$rSqlEmpresa['id']."' "));
		}
	} else {
		if(trim($_SESSION["logado_".$rSqlEmpresa['id'].""]["navegacao"])=="profissional") {
			$tabelaNavegacao = "empresa";
		} else if(trim($_SESSION["logado_".$rSqlEmpresa['id'].""]["navegacao"])=="cliente") {
			$tabelaNavegacao = "pessoas";
		} else if(trim($_SESSION["logado_".$rSqlEmpresa['id'].""]["navegacao"])=="padrao") {
			$tabelaNavegacao = "pessoas";
		}
		$autenticacao_senha = "  AND senha='".$_SESSION["logado_".$rSqlEmpresa['id'].""]["senha"]."' ";
		$rSqlUsuario = mysql_fetch_array(mysql_query("SELECT * FROM ".$tabelaNavegacao." WHERE id='".$_SESSION["logado_".$rSqlEmpresa['id'].""]["id"]."' "));
	}
}

if(trim($_SESSION['numeroUnico_carrinho'])=="") {
	$_SESSION['numeroUnico_carrinho'] = geraCodReturn(); 
}

if($template_layout=="outra_pasta") {
	$pasta_template = $template_pasta;
} else {
	$pasta_template = $template_layout;
}

include("./index_canva1.php");
?>
