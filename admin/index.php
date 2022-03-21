<?php
#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);
#error_reporting( error_reporting() & ~E_NOTICE );

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$_REQUEST['chave'] = "";
$_REQUEST['var1'] = "";
$_REQUEST['var2'] = "";
$_REQUEST['var3'] = "";
$_REQUEST['var4'] = "";
$_REQUEST['var5'] = "";
$_REQUEST['var6'] = "";
$_REQUEST['var7'] = "";
$_REQUEST['var8'] = "";
$_REQUEST['var9'] = "";
$_REQUEST['cpf'] = "";
$sysconfig[0]['cor_fundo_submenu_superior'] = "";
$cor_fundo_submenu_superior = "";
$_filtroStatDashS = "";
$numeroUnico_eventos = "";
$caminho1 = "";
$caminho2 = "";
$caminho3 = "";
$caminho4 = "";
$caminho5 = "";
$caminho6 = "";
$caminho7 = "";

$total_vendidos_chart = "";
$total_receita_full = "";
$total_receita = "";
$total_a_receber = "";
$total_liquidacao = "";
$total_receita_disponivel = "";

$_REQUEST['chave'] = "";
$_GET['chaveS'] = "";
$_GET['pageS'] = "";
$_GET['tbLocalS'] = "";
$_GET['numeroUnico_eventosS'] = "";
$_GET['limitS'] = "";

if($_SERVER["REDIRECT_STATUS"]=="500") {
	echo"<script>location.reload;</script>";
}

setcookie('admin_path', '/admin/');
$_COOKIE['admin_path'] = "/admin/";

include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/defines.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/class.Seguranca.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/class.zipfile.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/data.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/url.php");
include("".$_SERVER['DOCUMENT_ROOT']."/admin/include/inc/chave.php");

if(trim($sysusu['modelo_cms'])=="") {
	define("PATH_MOD","");
	define("PATH_ACOES","");
} else {
	define("PATH_MOD","".$sysusu['modelo_cms']."");
	define("PATH_ACOES","".$sysusu['modelo_cms']."");
}

error_reporting(E_ALL);

if(trim($_REQUEST['chave'])=="sair")    { 
	session_destroy();
	setcookie("perfil", "", time()-3600, '/');
	setcookie("email", "", time()-3600, '/');
	setcookie("senha", "", time()-3600, '/');
	setcookie("empresa", "", time()-3600, '/');
	setcookie("empresas_relacionadas", "", time()-3600, '/');
	setcookie("entrar_auto", "", time()-3600, '/');
	echo"<script>window.open('".$link."','_self','')</script>";
} else {
	if($sysusu['id']=="0") {
		$sql = mysql_query("DELETE FROM sysusu_online WHERE idsysusu='".$sysusu['id']."'");
		
		setcookie("perfil", "", time()-3600, '/');
		setcookie("cpf", "", time()-3600, '/');
		setcookie("email", "", time()-3600, '/');
		setcookie("senha", "", time()-3600, '/');
		setcookie("empresa_set", "", time()-3600, '/');
		setcookie("empresa", "", time()-3600, '/');
		setcookie("empresas_relacionadas", "", time()-3600, '/');
		setcookie("numeroUnico_set", "", time()-3600, '/');
		setcookie("entrar_auto", "", time()-3600, '/');
	
		echo"<script>window.open('".$link."','_self','')</script>";
	} else {
		if(trim($_REQUEST['var1'])=="confirma-email-suporte")    { 
			$pagina="templates/".$layout_padrao_set."/mod".PATH_MOD."/syschamado/confirma.php";
		} else {
		
			if($_POST) {
				if(trim($_POST['acaoForm'])=="login") {
					$link_form = $_POST["url_retorno"]; 

					//modo de usar pegando dados vindos do formulario
					$cpf = anti_injection($_POST['cpf']);
					$email = anti_injection($_POST['email']);
					$senha = anti_injection($_POST['senha']);
		
					if(isset($_POST['entrar_auto'])){
						setcookie("entrar_auto", "sim", time()+60*60*24*365, '/');
					} else {
						setcookie("entrar_auto", "", time()-3600, '/');
					}
		
					$rcpf = str_replace(" ","",$cpf);
					$remail = str_replace(" ","",$email);
					$rsenha = str_replace(" ","",$senha);

					if(trim($_POST['perfil'])=="admin") {
						$senha = $rsenha;
					} else if(trim($_POST['perfil'])=="pdv") {
						$senha = $rsenha;
					} else {
						$senha = $rsenha;
					}

					if(trim($_POST['perfil'])=="admin") {
						$sql= "SELECT * FROM sysusu WHERE email='".$remail."' AND senha='".md5($senha)."' AND stat='1'";

					} elseif(trim($_POST['perfil'])=="comissario") {
						$sql= "SELECT * FROM usuario WHERE cpf='".$rcpf."' AND senha='".md5($senha)."' AND usuario_tipo LIKE '%comissario%' AND stat='1'";

					} elseif(trim($_POST['perfil'])=="pdv") {
						$sql= "SELECT * FROM pdv WHERE email='".$remail."' AND senha='".$senha."' AND stat='1'";

					} elseif(trim($_POST['perfil'])=="conviteamigo") {
						$sql= "SELECT * FROM usuario WHERE cpf='".$rcpf."' AND senha='".md5($senha)."' AND usuario_tipo LIKE '%conviteamigo%' AND stat='1'";

					} elseif(trim($_POST['perfil'])=="cupom") {
						$sql= "SELECT * FROM usuario WHERE cpf='".$rcpf."' AND senha='".md5($senha)."' AND usuario_tipo LIKE '%cupom%' AND stat='1'";
					}

					
					$qLogin=mysql_query($sql);
					$nLogin=mysql_num_rows($qLogin);
					if($nLogin > 0) {
						$rLogin=mysql_fetch_array($qLogin);

						setcookie("perfil", "".$_POST['perfil']."", time()+7200 , '/');
						setcookie("email",  $rLogin['email'], time()+7200 , '/');
						setcookie("senha", $rLogin['senha'], time()+7200 , '/');
						setcookie("empresa_set", $rLogin['empresa'], time()+7200 , '/');
						setcookie("empresa", $rLogin['empresa'], time()+7200 , '/');
						setcookie("empresas_relacionadas", $rLogin['empresas_relacionadas'], time()+7200 , '/');
						setcookie("numeroUnico_set", $rLogin['numeroUnico'], time()+7200 , '/');

						$sysacesso = mysql_query("INSERT INTO sysacesso (idsysusu,data) VALUES ('".$rLogin['id']."','".$data."')");
		
						# Gravação do Log
						$dataLogout = ajustaDataReturn($data,"d/m/Y");
						$logPerfil = "administrador";
						$logId = $rLogin['id'];
						$logAcao = "Login";
						$logLocal = "Sistema Administrativo";
						$logDescricao = "O usuário administrativo <b>".$rLogin['nome']."</b> entrou no sistema administrativo na seguinte data: ".$dataLogout."";
						$logData = $data;
						
						$update = mysql_query("UPDATE sysusu SET dataLogin='".$data."' WHERE id='".$rLogin['id']."'");
						gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
					
						@mysql_free_result($qLogin);
						echo"<script>window.open('".$link_form."','_self','')</script>";
					} else {
						echo"<script>alert('Dados de conexão incorretos!')</script>";
						$local = "templates/".$layout_padrao_set."/login.php";
					}
				} elseif(trim($_POST['acaoForm'])=="logout") {
					# Gravação do Log
					$dataLogout = ajustaDataReturn($data,"d/m/Y");
					$logPerfil = "administrador";
					$logDescricao = "O usuário administrativo <b>".$sysusu['nome']."</b> fez logout do sistema administrativo no seguinte dia e hora: ".$dataLogout."";
					$logId = $sysusu['id'];
					$logAcao = "Logout";
					$logLocal = "Sistema Adminstrativo";
					$logData = $data;
					gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
				
					$sql = mysql_query("DELETE FROM sysusu_online WHERE idsysusu='".$sysusu['id']."'");
					
					setcookie("perfil", "", time()-3600, '/');
					setcookie("cpf", "", time()-3600, '/');
					setcookie("email", "", time()-3600, '/');
					setcookie("senha", "", time()-3600, '/');
					setcookie("empresa_set", "", time()-3600, '/');
					setcookie("numeroUnico_set", "", time()-3600, '/');
					setcookie("entrar_auto", "", time()-3600, '/');
		
					echo"<script>window.open('".$link."','_self','')</script>";
			
				} elseif(trim($_POST['acaoForm'])=="alterar-senha") {
					$data = date("Y-m-d H:i:s");
	
					$_POST['senha_conf'] = $_POST['senha'];
					$_POST['senha'] = md5($_POST['senha']);
					setcookie("senha", $_POST['senha'], time()+7200 , '/');
	
					$update = mysql_query("UPDATE sysusu SET senha_conf='".$_POST['senha_conf']."',senha='".$_POST['senha']."' WHERE id='".$_POST['iditem']."'");
	
					echo "<script>alert('Senha alterada com sucesso!')</script>";
					echo "<script>window.open('".$link."','_self','')</script>";

				} elseif(trim($_POST['acaoForm'])=="esqueci-senha") {
					$esqueci_senhaN = mysql_num_rows(mysql_query("SELECT * FROM sysusu WHERE email='".$_POST['email']."'"));
					if($esqueci_senhaN==0) {
						echo"<script>alert('Não possui usuário com este e-mail cadastrado!')</script>";
					} else {
						$esqueci_senha = mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE email='".$_POST['email']."'"));
						include("include/lib/envia-esqueci-senha.php");
						echo"<script>alert('Lembrete enviado com sucesso!')</script>";
					}
			
					echo"<script>window.open('".$link."','_self','')</script>";
				} elseif(
					  $_POST['modulo']=="_construtor_modulo"
					||$_POST['modulo']=="_construtor_modulo_campo"
					||$_POST['modulo']=="_construtor_modulo_funcao"
					||$_POST['modulo']=="_construtor_modulo_aba"
					||$_POST['modulo']=="_construtor_modulo_organizacao"
					||$_POST['modulo']=="_descricao_modulo_campo"
					||$_POST['modulo']=="_descricao_modulo_aba"
					||$_POST['modulo']=="_descricao_modulo_organizacao"
					||$_POST['modulo']=="sysusu"
					||$_POST['modulo']=="sysconfig"
					||$_POST['modulo']=="systransicao"
					||$_POST['modulo']=="sysfonte"
					||$_POST['modulo']=="sysatalhotag"
					) {
						include("templates/".$layout_padrao_set."/mod".PATH_MOD."/".$_POST['modulo']."/post.php");
				}
			
			} else {
				setcookie("perfil", "".$_COOKIE["perfil"]."", time()+7200 , '/');
				setcookie("cpf" , "".$_COOKIE["cpf"]."" , time()+7200 , '/');
				setcookie("email" , "".$_COOKIE["email"]."" , time()+7200 , '/');
				setcookie("senha" , "".$_COOKIE["senha"]."" , time()+7200 , '/');
				setcookie("empresa_set", "".$_COOKIE["empresa_set"]."", time()+7200 , '/');
				setcookie("numeroUnico_set", "".$_COOKIE["numeroUnico_set"]."", time()+7200 , '/');
		
				$nsysusu_logado = mysql_num_rows(mysql_query("SELECT * FROM sysusu_logado WHERE idsysusu='".$sysusu['id']."'"));
				if($nsysusu_logado==0) { 
					$navega_liberado = 1;
				} else {
					$sysusu_logado = mysql_fetch_array(mysql_query("SELECT * FROM sysusu_logado WHERE idsysusu='".$sysusu['id']."'"));
					if(trim($sysusu_logado['sessao'])==session_id()) {
						$navega_liberado = 1;
					} else {
						$tempo = tempoOff($sysusu['id']);
						
						if($tempo>1800) { 
							$navega_liberado = 1;
						} else {
							$navega_liberado = 0;
						}
					}
				}
			
				if(trim($_COOKIE['empresa_set'])=="" || trim($_COOKIE['empresa_set'])=="0") { } else {
					$empresa_token = mysql_fetch_array(mysql_query("SELECT * FROM empresa WHERE id='".$_COOKIE["empresa_set"]."'"));
				}
				
				if(trim($_COOKIE["perfil"])=="pdv") {
					echo"<script>window.open('".$link."pdv/','_self','')</script>";
				} else {

					#$_SESSION['mod'] = "";
					#$_SESSION['mod2'] = "";
					
					if(trim($_REQUEST['var1'])=="sessao-expirada")    { 
						if(trim($_COOKIE["perfil"])==""||trim($_COOKIE["email"])==""||trim($_COOKIE["senha"])=="") {
							echo"<script>window.open('".$link."','_self','')</script>";
						} else {
			
							$sysusu_logado = mysql_fetch_array(mysql_query("SELECT * FROM sysusu_logado WHERE idsysusu='".$sysusu['id']."'"));
							$sql = mysql_query("DELETE FROM sysusu_logado WHERE id='".$sysusu_logado['id']."'");
			
							session_destroy();
							setcookie("perfil", "", time()-3600, '/');
							setcookie("email", "", time()-3600, '/');
							setcookie("senha", "", time()-3600, '/');
							setcookie("entrar_auto", "", time()-3600, '/');
							echo"<script>window.open('".$link."','_self','')</script>";
						}
					} elseif(trim($_REQUEST['var1'])=="" || trim($_GET['code'])!="")    { 
						$ComponentesOpen = "off";
						$mod = "sysdashboard";
			
						$caminho1 = "Dashboard de Acompanhamento";
						$caminhourl1 = "".$link."".$chave_url.""; 

						$caminho_scripts = "".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysdashboard/script_sysdashboard.php";

						$pagina="mod".PATH_MOD."/sysdashboard/home.php";

					} elseif(trim($_REQUEST['var1'])=="minha-conta" && trim($_REQUEST['var2'])=="meus-dados")    {
						$ComponentesOpen = "off";
						$mod = "sysusu";
						$sysmod = mysql_fetch_array(mysql_query("SELECT numeroUnico,icone,nome FROM _construtor_modulo WHERE nome_base='".$mod."'"));
						$_SESSION['mod'] = $mod;
						$_SESSION['acoes'] = "personal";
						$_SESSION['var1'] = $_REQUEST['var1'];
						$_SESSION['var2'] = $_REQUEST['var2'];
						if(trim($_REQUEST['var3'])=="pagina")    {
							$_SESSION[''.$mod.'pagina'] = $_REQUEST['var4'];
						}
						
						$caminho_scripts = "".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/script_meus_dados.php";
			
						$row = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$sysusu['id']."'"));    
						$caminho1 = "<i class=\"fal fa-user\" style=\"padding-right:10px;color:#e5ad16;\"></i>EDITANDO MEUS DADOS";
						$caminho1txt = "".$row['nome']."";
						$caminhourl1 = "".$link."".$chave_url."".$_REQUEST['var1']."/".$_REQUEST['var2']."/"; 

						$pagina="mod".PATH_MOD."/personal/list_meus_dados.php";

					} elseif(trim($_REQUEST['var1'])=="sistema" && trim($_REQUEST['var2'])=="grupos-de-permissoes")    {
						$ComponentesOpen = "off";
						$mod = "sysgrupousuario";
						$_SESSION['mod'] = $mod;
						$_SESSION['acoes'] = "sysgrupousuario";
						$_SESSION['var1'] = $_REQUEST['var1'];
						$_SESSION['var2'] = $_REQUEST['var2'];
						if(trim($_REQUEST['var3'])=="pagina")    {
							$_SESSION[''.$mod.'pagina'] = $_REQUEST['var4'];
						}
						
						$sysmod['nome'] = "Grupos de Permissão / Planos de Assinatura";
						$sysmod['icone'] = "fa fa-users";
						
						$caminho_scripts = "".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysgrupousuario/script_sysgrupousuario.php";
			
						if(trim($_REQUEST['var3'])=="novo" || trim($_REQUEST['var3'])=="editar")    { 
							$formulario = 1;
							if(trim($_REQUEST['var3'])=="novo")    { 
								$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#14b26a;\"></i>NOVO GRUPO DE PERMISSÃO / PLANO DE ASSINATURA";
							} else if(trim($_REQUEST['var3'])=="editar") {
								$row = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_REQUEST['var4']."'"));    
								$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#e5ad16;\"></i>EDITANDO GRUPO DE PERMISSÃO / PLANO DE ASSINATURA";
								$caminho1txt = "".$row['nome']."";
							}
							$btn_voltar_lista = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;\"></i>Lista de ".$sysmod['nome']."";
						} else {
							$formulario = 0;
							$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#1686e5;\"></i>Lista de ".$sysmod['nome']."";
						}
						$caminhourl1 = "".$link."".$chave_url."".$_REQUEST['var1']."/".$_REQUEST['var2']."/"; 

						$pagina="mod".PATH_MOD."/sysgrupousuario/list.php";

					} elseif(trim($_REQUEST['var1'])=="administracao" && trim($_REQUEST['var2'])=="videos-tutoriais")    {
						$ComponentesOpen = "off";
						$mod = "videos_tutoriais";
						$sysmod = mysql_fetch_array(mysql_query("SELECT numeroUnico,icone,nome FROM _construtor_modulo WHERE nome_base='".$mod."'"));
						$_SESSION['mod'] = $mod;
						$_SESSION['acoes'] = "personal";
						$_SESSION['var1'] = $_REQUEST['var1'];
						$_SESSION['var2'] = $_REQUEST['var2'];
						if(trim($_REQUEST['var3'])=="pagina")    {
							$_SESSION[''.$mod.'pagina'] = $_REQUEST['var4'];
						}
						
						$caminho_scripts = "".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/script_videos_tutoriais.php";
			
						if(trim($_REQUEST['var3'])=="novo" || trim($_REQUEST['var3'])=="editar")    { 
							$formulario = 1;
							if(trim($_REQUEST['var3'])=="novo")    { 
								$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#14b26a;\"></i>NOVO VÍDEO";
							} else if(trim($_REQUEST['var3'])=="editar") {
								$row = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_REQUEST['var4']."'"));    
								$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#e5ad16;\"></i>EDITANDO VÍDEO";
								$caminho1txt = "".$row['nome']."";
							}
							$btn_voltar_lista = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;\"></i>Lista de ".$sysmod['nome']."";
						} else {
							$formulario = 0;
							$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#1686e5;\"></i>Lista de ".$sysmod['nome']."";
						}
						$caminhourl1 = "".$link."".$chave_url."".$_REQUEST['var1']."/".$_REQUEST['var2']."/"; 

						$pagina="mod".PATH_MOD."/personal/list_videos_tutoriais.php";

					} elseif(trim($_REQUEST['var1'])=="estrutura-social" && trim($_REQUEST['var2'])=="empresa")    {
						$ComponentesOpen = "off";
						$mod = "empresa";
						$sysmod = mysql_fetch_array(mysql_query("SELECT numeroUnico,icone,nome FROM _construtor_modulo WHERE nome_base='".$mod."'"));
						$_SESSION['mod'] = $mod;
						$_SESSION['acoes'] = "personal";
						$_SESSION['var1'] = $_REQUEST['var1'];
						$_SESSION['var2'] = $_REQUEST['var2'];
						if(trim($_REQUEST['var3'])=="pagina")    {
							$_SESSION[''.$mod.'pagina'] = $_REQUEST['var4'];
						}
						
						$caminho_scripts = "".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/script_empresa.php";
			
						if(trim($_REQUEST['var3'])=="novo" || trim($_REQUEST['var3'])=="editar")    { 
							$formulario = 1;
							if(trim($_REQUEST['var3'])=="novo")    { 
								$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#14b26a;\"></i>NOVA EMPRESA";
							} else if(trim($_REQUEST['var3'])=="editar") {
								$row = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_REQUEST['var4']."'"));    
								$row_taxas = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod."_taxas WHERE empresa_token='".$row['token']."'"));    
								$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#e5ad16;\"></i>EDITANDO EMPRESA";
								$caminho1txt = "".$row['nome']."";
							}
							$btn_voltar_lista = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;\"></i>Lista de ".$sysmod['nome']."";
						} else {
							$formulario = 0;
							$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#1686e5;\"></i>Lista de ".$sysmod['nome']."";
						}
						$caminhourl1 = "".$link."".$chave_url."".$_REQUEST['var1']."/".$_REQUEST['var2']."/"; 

						$pagina="mod".PATH_MOD."/personal/list_empresa.php";

					} elseif(trim($_REQUEST['var1'])=="gestao" && trim($_REQUEST['var2'])=="pessoas")    {
						$ComponentesOpen = "off";
						$mod = "pessoas";
						$sysmod = mysql_fetch_array(mysql_query("SELECT numeroUnico,icone,nome FROM _construtor_modulo WHERE nome_base='".$mod."'"));
						$_SESSION['mod'] = $mod;
						$_SESSION['acoes'] = "personal";
						$_SESSION['var1'] = $_REQUEST['var1'];
						$_SESSION['var2'] = $_REQUEST['var2'];
						if(trim($_REQUEST['var3'])=="pagina")    {
							$_SESSION[''.$mod.'pagina'] = $_REQUEST['var4'];
						}
						
						$caminho_scripts = "".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/script_pessoas.php";
			
						if(trim($_REQUEST['var3'])=="novo" || trim($_REQUEST['var3'])=="editar")    { 
							$formulario = 1;
							if(trim($_REQUEST['var3'])=="novo")    { 
								$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#14b26a;\"></i>NOVA PESSOA";
							} else if(trim($_REQUEST['var3'])=="editar") {
								$row = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_REQUEST['var4']."'"));    
								$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#e5ad16;\"></i>EDITANDO PESSOA";
								$caminho1txt = "".$row['nome']."";
							}
							$btn_voltar_lista = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;\"></i>Lista de ".$sysmod['nome']."";
						} else {
							$formulario = 0;
							$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#1686e5;\"></i>Lista de ".$sysmod['nome']."";
						}
						$caminhourl1 = "".$link."".$chave_url."".$_REQUEST['var1']."/".$_REQUEST['var2']."/"; 

						$pagina="mod".PATH_MOD."/personal/list_pessoas.php";

					} elseif(trim($_REQUEST['var1'])=="gestao" && trim($_REQUEST['var2'])=="pdv")    {
						$ComponentesOpen = "off";
						$mod = "pdv";
						$sysmod = mysql_fetch_array(mysql_query("SELECT numeroUnico,icone,nome FROM _construtor_modulo WHERE nome_base='".$mod."'"));
						$_SESSION['mod'] = $mod;
						$_SESSION['acoes'] = "personal";
						$_SESSION['var1'] = $_REQUEST['var1'];
						$_SESSION['var2'] = $_REQUEST['var2'];
						if(trim($_REQUEST['var3'])=="pagina")    {
							$_SESSION[''.$mod.'pagina'] = $_REQUEST['var4'];
						}
						
						$caminho_scripts = "".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/script_pdv.php";
			
						if(trim($_REQUEST['var3'])=="novo" || trim($_REQUEST['var3'])=="editar")    { 
							$formulario = 1;
							if(trim($_REQUEST['var3'])=="novo")    { 
								$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#14b26a;\"></i>NOVO PDV";
							} else if(trim($_REQUEST['var3'])=="editar") {
								$row = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_REQUEST['var4']."'"));    
								$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#e5ad16;\"></i>EDITANDO PDV";
								$caminho1txt = "".$row['nome']."";
							}
							$btn_voltar_lista = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;\"></i>Lista de ".$sysmod['nome']."";
						} else {
							$formulario = 0;
							$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#1686e5;\"></i>Lista de ".$sysmod['nome']."";
						}
						$caminhourl1 = "".$link."".$chave_url."".$_REQUEST['var1']."/".$_REQUEST['var2']."/"; 

						$pagina="mod".PATH_MOD."/personal/list_pdv.php";
 
					} elseif(trim($_REQUEST['var1'])=="gestao" && trim($_REQUEST['var2'])=="usuarios-de-pdv")    {
						$ComponentesOpen = "off";
						$mod = "pdv_fluxo_caixa";
						$_SESSION['mod'] = $mod;
						$_SESSION['mod2'] = "usuarios_de_pdv";
						$sysmod = mysql_fetch_array(mysql_query("SELECT numeroUnico,icone,nome FROM _construtor_modulo WHERE nome_base='".$_SESSION['mod2']."'"));
						$_SESSION['acoes'] = "personal";
						$_SESSION['var1'] = $_REQUEST['var1'];
						$_SESSION['var2'] = $_REQUEST['var2'];
						if(trim($_REQUEST['var3'])=="pagina")    {
							$_SESSION[''.$mod.'pagina'] = $_REQUEST['var4'];
						}
						
						$caminho_scripts = "".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/personal/script_usuarios_de_pdv.php";
			
						if(trim($_REQUEST['var3'])=="novo" || trim($_REQUEST['var3'])=="editar")    { 
							$formulario = 1;
							if(trim($_REQUEST['var3'])=="novo")    { 
								$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#14b26a;\"></i>NOVO USUÁRIO DE PDV";
							} else if(trim($_REQUEST['var3'])=="editar") {
								$row = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_REQUEST['var4']."'"));    
								$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#e5ad16;\"></i>EDITANDO USUÁRIO DE PDV";
								$caminho1txt = "".$row['nome']."";
							}
							$btn_voltar_lista = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;\"></i>Lista de ".$sysmod['nome']."";
						} else {
							$formulario = 0;
							$caminho1 = "<i class=\"".$sysmod['icone']."\" style=\"padding-right:10px;color:#1686e5;\"></i>Lista de ".$sysmod['nome']."";
						}
						$caminhourl1 = "".$link."".$chave_url."".$_REQUEST['var1']."/".$_REQUEST['var2']."/"; 

						$pagina="mod".PATH_MOD."/personal/list_usuarios_de_pdv.php";


					} elseif(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="usuarios")    {
						$mod = "sysusu";
						$_SESSION['mod'] = $mod;
						$_SESSION['acoes'] = "sysusu";
						$caminho1 = "Usuários";
						$caminhourl1 = "".$link."".$chave_url."sistema/usuarios/"; 

						$caminho_scripts = "".$_SERVER['DOCUMENT_ROOT']."/admin/templates/metronic/acoes/sysusu/script_sysusu.php";
			
			
						include("templates/".$layout_padrao_set."/mod".PATH_MOD."/".$mod."/navega.php");
					} elseif(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="configuracoes")    {
						$caminho1 = "Configurações";
						$caminhourl1 = "".$link."".$chave_url."sistema/configuracoes/"; 
			
						$mod = "sysconfig";
						
						$row = mysql_fetch_array(mysql_query("SELECT * FROM ".$linguagem_set."".$mod." ORDER BY id LIMIT 1"));
			
						$pagina="mod".PATH_MOD."/".$mod."/list.php";
					} elseif(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="timeline")    {
						$caminho1 = "Timeline";
						$caminhourl1 = "".$link."".$chave_url."sistema/timeline/"; 
			
						$mod = "sys_arquivo";
						
						$pagina="mod".PATH_MOD."/".$mod."/list.php";
					} elseif(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="agenda")    {
						$caminho1 = "Agenda";
						$caminhourl1 = "".$link."".$chave_url."sistema/agenda/"; 
			
						$mod = "syscalendario";
						
						include("templates/".$layout_padrao_set."/mod".PATH_MOD."/".$mod."/navega.php");
					} elseif(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="dashboard")    {
						$caminho1 = "Dashboard";
						$caminhourl1 = "".$link."".$chave_url."sistema/dashboard/"; 
			
						$mod = "sysdashboard";
						
						$pagina="mod".PATH_MOD."/".$mod."/home.php";
					} elseif(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="transicao-de-conteudo")    {
						$caminho1 = "Transição de Conteúdo";
						$caminhourl1 = "".$link."".$chave_url."sistema/transicao-de-conteudo/"; 
			
						$mod = "systransicao";
			
						$pagina="mod".PATH_MOD."/".$mod."/list.php";
					} elseif(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="tags")    {
						$caminho1 = "Atalhos/Tags";
						$caminhourl1 = "".$link."".$chave_url."sistema/tags/"; 
			
						$mod = "sysatalhotag";
						include("templates/".$layout_padrao_set."/mod".PATH_MOD."/".$mod."/navega.php");
					} elseif(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="fontes")    {
						$caminho1 = "Fontes";
						$caminhourl1 = "".$link."".$chave_url."sistema/fontes/"; 
			
						$mod = "sysfonte";
						include("templates/".$layout_padrao_set."/mod".PATH_MOD."/".$mod."/navega.php");
					} elseif(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="historico-de-operacoes")    {
						$caminho1 = "Histórico de Operações";
						$caminhourl1 = "".$link."".$chave_url."sistema/historico-de-operacoes/"; 
			
						$mod = "syslog";
			
						$pagina="/mod".PATH_MOD."/".$mod."/list.php";
					} elseif(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="historico-de-acessos")    {
						$caminho1 = "Histórico de Acessos";
						$caminhourl1 = "".$link."".$chave_url."sistema/historico-de-acessos/"; 
			
						$mod = "sysacesso";
			
						$pagina="/mod".PATH_MOD."/".$mod."/list.php";
					} elseif(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="controle-de-querys")    {
						$caminho1 = "Controle de Querys";
						$caminhourl1 = "".$link."".$chave_url."sistema/controle-de-querys/"; 
			
						$mod = "sysquery";
			
						$pagina="/mod".PATH_MOD."/".$mod."/list.php";
					} elseif(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="controle-de-metas")    {
						$caminho1 = "Controle de Metas";
						$caminhourl1 = "".$link."".$chave_url."sistema/controle-de-metas/"; 
			
						$mod = "metas";
			
						$pagina="/mod".PATH_MOD."/".$mod."/list.php";
					} elseif(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="controle-de-modulos")    {
						$caminho1 = "Controle de Módulos";
						$caminhourl1 = "".$link."".$chave_url."sistema/controle-de-modulos/"; 
				
						$mod = "sysmod";
						include("templates/".$layout_padrao_set."/mod".PATH_MOD."/".$mod."/navega.php");
					} elseif(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="grupos-de-permissoes")    {
						$caminho1 = "Grupos de Usuários";
						$caminhourl1 = "".$link."".$chave_url."sistema/grupos-de-permissoes/"; 
				
						$mod = "sysgrupousuario";
						include("templates/".$layout_padrao_set."/mod".PATH_MOD."/".$mod."/navega.php");
					} elseif(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="suporte")    {
						$caminho1 = "Suporte";
						$caminhourl1 = "".$link."".$chave_url."sistema/suporte/"; 
			
						$mod = "syschamado";
						$pagina="templates/".$layout_padrao_set."/mod".PATH_MOD."/".$mod."/list.php";
					} elseif(trim($_REQUEST['var1'])=="sistema"&&trim($_REQUEST['var2'])=="banco-de-midia")    {
						$caminho1 = "Banco de Mídia";
						$caminhourl1 = "".$link."".$chave_url."sistema/banco-de-midia/"; 
			
						$mod = "sysmidia";
						$pagina="templates/".$layout_padrao_set."/mod".PATH_MOD."/".$mod."/list.php";
					} elseif(trim($_REQUEST['var1'])=="construtor"&&trim($_REQUEST['var3'])=="organizacao-do-modulo-descricao")    {
						$caminho1 = "Organização da Descrição";
						$caminhourl1 = "".$link."".$chave_url."construtor/organizacao-do-modulo-descricao/"; 
			
						$mod = "_descricao_modulo_organizacao";
						include("templates/".$layout_padrao_set."/mod/".$mod."/navega.php");
					} else {
						include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."controle_index_construtor_template.php");
					}
				}
			}
		}
		
		if(trim($semInclude)=="ON") { } else {
			#echo "IMPRIMIR INFO \n"; //Descomentar para imprimir as informações abaixo
			echo "<!-- hash:".$sysusu['numeroUnico']." --> \n";
			echo "<!-- raiz:".$_REQUEST['raiz']." --> \n";
			echo "<!-- chave:".$_REQUEST['chave']." --> \n";
			echo "<!-- var1:".$_REQUEST['var1']." --> \n";
			echo "<!-- var2:".$_REQUEST['var2']." --> \n";
			echo "<!-- var3:".$_REQUEST['var3']." --> \n";
			echo "<!-- var4:".$_REQUEST['var4']." --> \n";
			echo "<!-- var5:".$_REQUEST['var5']." --> \n";
			echo "<!-- SERVER_NAME:".$_SERVER["SERVER_NAME"]." --> \n";
			echo "<!-- DOCUMENT_ROOT:".$_SERVER["DOCUMENT_ROOT"]." --> \n";
			echo "<!-- HTTP_HOST:".$_SERVER["HTTP_HOST"]." --> \n";
			echo "<!-- SERVER_NAME:".$_SERVER["SERVER_NAME"]." --> \n";
			echo "<!-- link:".$link." --> \n";
			echo "<!-- link_site:".$link_site." --> \n";
			
			echo "<!-- pagina: ".$pagina." --> \n";
			echo "<!-- sysusu: ".$sysusu['id']." --> \n";
			include("".$local."");
		}
	}
}
?>
