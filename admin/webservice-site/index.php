<?
header('Access-Control-Allow-Origin: *');

$localGet = $_POST['Local'];

$numeroUnico_usuarioGet = $usuario['numeroUnico'];

$whatsappGet = $_POST['whatsapp'];

$nomeGet = $_POST['nome'];
$cepGet = $_POST['cep'];
$ruaGet = $_POST['rua'];
$numeroGet = $_POST['numero'];
$complementoGet = $_POST['complemento'];
$estadoGet = $_POST['estado'];
$cidadeGet = $_POST['cidade'];
$bairroGet = $_POST['bairro'];

$cartao_binGet = $_POST['card_bin'];
$cartao_numeroGet = $_POST['card_number'];
$cartao_validadeGet = $_POST['card_exp_month']."/".$_POST['card_exp_year'];
$cartao_cvvGet = $_POST['card_cvv'];
$titular_nomeGet = $_POST['card_name'];
$titular_cpfGet = $_POST['card_cpf'];
$titular_telefoneGet = $_POST['card_telefone'];

$numeroUnico_enderecoGet = $_POST['numeroUnico_endereco'];
$numeroUnico_filialGet = $_POST['numeroUnico_filial'];

include("".$localGet.".php");
?>