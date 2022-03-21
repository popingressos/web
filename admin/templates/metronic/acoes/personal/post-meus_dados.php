<?
$COORDENADAS = latitude_longitude($_POST,"",$GOOGLE_MAP_KEY_SET);
$_POST['latitude'] = $COORDENADAS['latitude'];
$_POST['longitude'] = $COORDENADAS['longitude'];

$_POST['data_de_nascimento'] = normalTOdate($_POST['data_de_nascimento']);
$_POST['data_de_aniversario'] = substr($_POST['data_de_nascimento'],4,6);
$_POST['data_de_aniversario'] = "0000".$_POST['data_de_aniversario']."";

$_POST['senha_conf'] = str_replace(" ","",$_POST['senha']);
$_POST['senha'] = str_replace(" ","",$_POST['senha']);
if(trim($_POST['senha'])!="") { $_POST['senha'] = md5($_POST['senha']); }
$_POST['cpf'] = preg_replace("/[^0-9]/", "", $_POST['cpf']);

$update = mysql_query("
					UPDATE 
						sysusu 
					SET 
						empresa='".$rSqlEmpresa['id']."', 
						empresa_token='".$rSqlEmpresa['token']."', 
						nome='".$_POST['nome']."', 
						genero='".$_POST['genero']."', 
						data_de_nascimento='".$_POST['data_de_nascimento']."', 
						data_de_aniversario='".$_POST['data_de_aniversario']."', 
						cpf='".$_POST['cpf']."', 
						senha='".$_POST['senha']."', 
						senha_conf='".$_POST['senha_conf']."', 
						email='".$_POST['email']."', 
						telefone='".$_POST['telefone']."', 
						instagram='".$_POST['instagram']."', 
						facebook='".$_POST['facebook']."', 
						whatsapp='".$_POST['whatsapp']."', 
						cep='".$_POST['cep']."', 
						rua='".$_POST['rua']."', 
						numero='".$_POST['numero']."', 
						complemento='".$_POST['complemento']."', 
						bairro='".$_POST['bairro']."', 
						cidade='".$_POST['cidade']."', 
						estado='".$_POST['estado']."', 
						latitude='".$_POST['latitude']."', 
						longitude='".$_POST['longitude']."', 
						dataModificacao='".$data."' 
					WHERE 
						id='".$_POST['iditem']."' ");

$rLogin=mysql_fetch_array(mysql_query("SELECT * FROM sysusu WHERE id='".$_POST['iditem']."'"));

setcookie("perfil", "admin", time()+7200 , '/');
setcookie("email",  $rLogin['email'], time()+7200 , '/');
setcookie("senha", $rLogin['senha'], time()+7200 , '/');
setcookie("empresa_set", $rLogin['empresa'], time()+7200 , '/');
setcookie("empresa", $rLogin['empresa'], time()+7200 , '/');
setcookie("empresas_relacionadas", $rLogin['empresas_relacionadas'], time()+7200 , '/');
setcookie("numeroUnico_set", $rLogin['numeroUnico'], time()+7200 , '/');


$_SESSION['numeroUnicoGerado'] = "";

if(trim($_POST['acaoForm'])=="add-continuar" || trim($_POST['acaoForm'])=="editar-continuar") {
	$urlEditar = "editar/".$_POST['numeroUnico']."/";
}
$chave_gerada = geraCodReturn()."/";
echo"<script>window.open('".$link."".$chave_gerada."".$_REQUEST['var1']."/".$_REQUEST['var2']."/".$urlEditar."','_self','')</script>";
?>

