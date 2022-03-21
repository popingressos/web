<?
include("".$_SERVER['DOCUMENT_ROOT']."".$_COOKIE['admin_path']."include/inc/data.php");

$data = date("Y-m-d H:i:s");

$idGet = $_GET['idS'];
$sufixoGet = $_GET['sufixoS'];

$item = mysql_fetch_array(mysql_query("SELECT * FROM syscliente WHERE id='".$idGet."'"));

$rCidade = mysql_fetch_array(mysql_query("SELECT * FROM cepbr_cidade WHERE id_cidade='".$item['cidade']."' ORDER BY cidade"));
$rBairro = mysql_fetch_array(mysql_query("SELECT * FROM cepbr_bairro WHERE id_bairro='".$item['bairro']."' ORDER BY bairro"));

?>
<p>
<b>ID:</b>	<?=$item['id']?>
<br /><br />

<? if(trim($item['tipo_de_documento'])=="pf"||trim($item['tipo_de_documento'])=="estrangeiro") { ?>
<b>Nome:</b> <?=$item['nome']?><br />
<? } else { ?>
	<? if(trim($item['tipo_de_documento'])=="pj") { ?>
    <b>Razão Social:</b> <?=$item['razao_social']?><br />
    <b>Nome Fantasia:</b> <?=$item['nome_fantasia']?><br />
    <b>Responsável:</b>	<?=$item['responsavel']?><br />
    <b>Cargo do Responsável:</b> <?=$item['responsavel_cargo']?><br />
    <? } else { ?>
    <? } ?>
<? } ?>

<? if(trim($item['telefone_1_operadora'])==""&&trim($item['telefone_1_ddd'])==""&&trim($item['telefone_1'])=="") { } else { ?>
<b>Telefone 1:</b> <? if(trim($item['telefone_1_operadora'])=="") { } else { ?>	<?=$item['telefone_1_operadora']?> - <? } ?>(<?=$item['telefone_1_ddd']?>) <?=$item['telefone_1']?>	<br />
<? } ?>
<? if(trim($item['telefone_2_operadora'])==""&&trim($item['telefone_2_ddd'])==""&&trim($item['telefone_2'])=="") { } else { ?>
<b>Telefone 2:</b> <? if(trim($item['telefone_2_operadora'])=="") { } else { ?>	<?=$item['telefone_2_operadora']?> - <? } ?>(<?=$item['telefone_2_ddd']?>) <?=$item['telefone_2']?>	<br />
<? } ?>

<? if(trim($item['tipo_de_documento'])=="pf") { ?>
	<? if(trim($item['cpf'])==""&&trim($item['rg'])=="") { } else { ?>
		<? if(trim($item['cpf'])=="") { } else { ?>
        <b>CPF:</b>	<?=$item['cpf']?>	<br />
		<? } ?>

		<? if(trim($item['rg'])=="") { } else { ?>
        <b>RG:</b> <?=$item['rg']?>	<br />
		<? } ?>
    <? } ?>
<? } else { ?>
	<? if(trim($item['tipo_de_documento'])=="pj") { ?>
		<? if(trim($item['cnpj'])==""&&trim($item['ie'])=="") { } else { ?>
			<? if(trim($item['cnpj'])=="") { } else { ?>
            <b>CNPJ:</b> <?=$item['cnpj']?>	<br />
			<? } ?>

			<? if(trim($item['ie'])=="") { } else { ?>
            <b>Inscr. Est.:</b> <?=$item['ie']?>	<br />
			<? } ?>
		<? } ?>
    <? } else { ?>
		<? if(trim($item['tipo_de_documento'])=="estrangeiro") { ?>
        <b><?=$item['entrangeiro_nome']?>:</b> <?=$item['entrangeiro_numero']?>	<br />
		<? } ?>
    <? } ?>
<? } ?>

<? if(trim($item['email'])=="") { } else { ?>
<b>E-mail(s):</b> <?=$item['email']?> <br />
<? } ?>

<? if(trim($item['rua'])==""&&trim($item['numero'])=="") { } else { ?>
<b>Endereço:</b> <?=$item['rua']?><? if(trim($item['numero'])=="") { } else { ?>, <?=$item['numero']?><? } ?> <br />
<? } ?>

<? if(trim($item['complemento'])=="") { } else { ?>
<b>Complemento:</b> <?=$item['complemento']?><br />
<? } ?>

<? if(trim($item['bairro'])=="") { } else { ?>
<b>Bairro:</b> <?=utf8_encode($rBairro['bairro'])?><br />
<? } ?>

<? if(trim($item['cidade'])=="") { } else { ?>
<b>Cidade:</b> <?=utf8_encode($rCidade['cidade'])?><br />
<? } ?>

<? if(trim($item['estado'])=="") { } else { ?>
<b>UF:</b> <?=$item['estado']?><br />
<? } ?>

<? if(trim($item['cep'])=="") { } else { ?>
<b>CEP:</b> <?=$item['cep']?></b>	<br />
<? } ?>
</p>

