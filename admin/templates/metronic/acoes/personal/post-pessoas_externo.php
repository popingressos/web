<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/sess.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/main.php");
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$_POST['data_de_nascimento'] = normalTOdate($_POST['data_de_nascimento']);
$_POST['data_de_aniversario'] = substr($_POST['data_de_nascimento'],4,6);
$_POST['data_de_aniversario'] = "0000".$_POST['data_de_aniversario']."";
$_POST['responsavel_data_de_nascimento'] = normalTOdate($_POST['responsavel_data_de_nascimento']);
$_POST['responsavel_data_de_aniversario'] = substr($_POST['responsavel_data_de_nascimento'],4,6);
$_POST['responsavel_data_de_aniversario'] = "0000".$_POST['responsavel_data_de_aniversario']."";

$COORDENADAS = latitude_longitude($_POST,"",$GOOGLE_MAP_KEY_SET);
$_POST['latitude'] = $COORDENADAS['latitude'];
$_POST['longitude'] = $COORDENADAS['longitude'];

if(trim($_POST['tipo_documento_cadastro'])=="cpf" ) {
	$_POST['documento'] = $_POST['documento_cpf'];
} else if(trim($_POST['tipo_documento_cadastro'])=="cnpj" ) {
	$_POST['documento'] = $_POST['documento_cnpj'];
}

if(trim($_POST['bairro'])=="") { } else {
	$bairro = mysql_fetch_array(mysql_query("SELECT id_bairro FROM cepbr_bairro WHERE bairro='".$_POST['bairro']."'"));
	$_POST['bairro_id'] = $bairro['id_bairro'];
}
if(trim($_POST['cidade'])=="") { } else {
	$cidade = mysql_fetch_array(mysql_query("SELECT id_cidade FROM cepbr_cidade WHERE cidade='".$_POST['cidade']."'"));
	$_POST['cidade_id'] = $cidade['id_cidade'];
}

$insert = mysql_query("INSERT INTO pessoas (
											 idsysusu, 
											 empresa,
											 empresa_token,
											 numeroUnico,
											 categorias_de_pessoas, 
											 nome,
											 razao_social,
											 avatar,
											 imagem_perfil_base64,
											 imagem_doc_frente_base64,
											 imagem_doc_verso_base64,
											 tipo_documento,
											 documento,
											 data_de_nascimento,
											 data_de_aniversario,
											 genero,
											 senha,
											 senha_conf,
											 cliente, 
											 profissional, 
											 banco, 
											 agencia, 
											 conta, 
											 digito, 
											 email, 
											 email_valido, 
											 email_valido_checado, 
											 telefone, 
											 instagram, 
											 facebook, 
											 whatsapp, 
											 cep, 
											 rua, 
											 numero, 
											 complemento, 
											 bairro, 
											 cidade, 
											 bairro_id, 
											 cidade_id, 
											 estado, 
											 latitude, 
											 longitude,
											 
											 horarios_de_atendimento, 

											 responsavel_nome, 
											 responsavel_genero,
											 responsavel_data_de_nascimento,
											 responsavel_data_de_aniversario,
											 responsavel_cargo, 
											 responsavel_email, 
											 responsavel_whatsapp, 
											 responsavel_telefone, 
											 responsavel_cep, 
											 responsavel_rua, 
											 responsavel_numero, 
											 responsavel_complemento, 
											 responsavel_bairro, 
											 responsavel_cidade, 
											 responsavel_estado, 
											 responsavel_latitude, 
											 responsavel_longitude, 

											 plataforma_site, 
											 plataforma_ios, 
											 plataforma_android, 
											 notificacoes_de_push, 
											 notificacoes_por_email, 
											 alerta_de_envio, 
											 alerta_de_recebimento, 
											 alerta_de_troca, 
											 alerta_de_cancelamento, 
											 alerta_de_estorno, 
											 push_de_propaganda, 
											 mala_direta_por_e_mail, 

											 dados_pessoais, 
											 endereco, 
											 foto_doc_frente, 
											 foto_doc_verso, 
											 foto_perfil, 
											 dados_bancarios, 
											 validacao_atendente,
											 
											 stat,
											 data,
											 dataModificacao
											) VALUES (
											'".$sysusu['id']."', 
											'".$rSqlEmpresa['id']."', 
											'".$rSqlEmpresa['token']."', 
											'".geraCodReturn()."',
											'".$_POST['categorias_de_pessoas']."', 
											'".$_POST['nome']."', 
											'".$_POST['razao_social']."', 
											'".$_POST['avatar']."', 
											'".$_POST['imagem_perfil_base64']."', 
											'".$_POST['imagem_doc_frente_base64']."', 
											'".$_POST['imagem_doc_verso_base64']."', 
											'".$_POST['tipo_documento_cadastro']."', 
											'".$_POST['documento']."', 
											'".$_POST['data_de_nascimento']."', 
											'".$_POST['data_de_aniversario']."', 
											'".$_POST['genero']."', 
											'".$_POST['senha']."', 
											'".$_POST['senha_conf']."', 
											'".$_POST['cliente']."', 
											'".$_POST['profissional']."', 
											'".$_POST['banco']."', 
											'".$_POST['agencia']."', 
											'".$_POST['conta']."', 
											'".$_POST['digito']."', 
											'".$_POST['email']."', 
											'0', 
											'0', 
											'".$_POST['telefone']."', 
											'".$_POST['instagram']."', 
											'".$_POST['facebook']."', 
											'".$_POST['whatsapp']."', 
											'".$_POST['cep']."', 
											'".$_POST['rua']."', 
											'".$_POST['numero']."', 
											'".$_POST['complemento']."', 
											'".$_POST['bairro']."', 
											'".$_POST['cidade']."', 
											'".$_POST['bairro_id']."', 
											'".$_POST['cidade_id']."', 
											'".$_POST['estado']."', 
											'".$_POST['latitude']."', 
											'".$_POST['longitude']."', 
											
											'".$_SESSION['horarios_de_atendimento_'.$_SESSION['numeroUnicoGerado'].'']."',

											'".$_POST['responsavel_nome']."', 
											'".$_POST['responsavel_genero']."', 
											'".$_POST['responsavel_data_de_nascimento']."', 
											'".$_POST['responsavel_data_de_aniversario']."', 
											'".$_POST['responsavel_cargo']."', 
											'".$_POST['responsavel_email']."', 
											'".$_POST['responsavel_whatsapp']."', 
											'".$_POST['responsavel_telefone']."', 
											'".$_POST['responsavel_cep']."', 
											'".$_POST['responsavel_rua']."', 
											'".$_POST['responsavel_numero']."', 
											'".$_POST['responsavel_complemento']."', 
											'".$_POST['responsavel_bairro']."', 
											'".$_POST['responsavel_cidade']."', 
											'".$_POST['responsavel_estado']."', 
											'".$_POST['responsavel_latitude']."', 
											'".$_POST['responsavel_longitude']."', 

											'".$_POST['plataforma_site']."', 
											'".$_POST['plataforma_ios']."', 
											'".$_POST['plataforma_android']."', 
											'".$_POST['notificacoes_de_push']."', 
											'".$_POST['notificacoes_por_email']."', 
											'".$_POST['alerta_de_envio']."', 
											'".$_POST['alerta_de_recebimento']."', 
											'".$_POST['alerta_de_troca']."', 
											'".$_POST['alerta_de_cancelamento']."', 
											'".$_POST['alerta_de_estorno']."', 
											'".$_POST['push_de_propaganda']."', 
											'".$_POST['mala_direta_por_e_mail']."', 

											'".$_POST['dados_pessoais']."', 
											'".$_POST['endereco']."', 
											'".$_POST['foto_doc_frente']."', 
											'".$_POST['foto_doc_verso']."', 
											'".$_POST['foto_perfil']."', 
											'".$_POST['dados_bancarios']."', 
											'".$_POST['validacao_atendente']."', 
			
											'1',
											'".$data."',
											'".$data."'
											)");

?>

