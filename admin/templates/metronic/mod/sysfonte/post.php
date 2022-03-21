<?
	$mod = $_POST['modulo'];             
	if(trim($_POST['acaoForm'])=="add"||trim($_POST['acaoForm'])=="add-continuar") {

		$_POST['nome'] = str_replace("'", "@aspa_simples@", $_POST['nome']);
		$_POST['nome'] = str_replace("\"", "@aspa_dupla@", $_POST['nome']);

		$_POST['link'] = str_replace("'", "@aspa_simples@", $_POST['link']);
		$_POST['link'] = str_replace("\"", "@aspa_dupla@", $_POST['link']);
		$_POST['link'] = str_replace("<", "@html_link@", $_POST['link']);

		$_POST['family'] = str_replace("'", "@aspa_simples@", $_POST['family']);
		$_POST['family'] = str_replace("\"", "@aspa_dupla@", $_POST['family']);

		# Gravação do Log
		$logPerfil = "administrador";
		$logId = $sysusu['id'];
		$logAcao = "Adicionar";
		$logLocal = "Fontes";
		$logDescricao = "Foi adicionado o item <b>".$_POST['nome']."</b>";
		$logData = $data;

		$_POST['data'] = $data;
		$_POST['dataModificacao'] = $data;

		insert($_POST,$mod);
	} else {
		if(trim($_POST['acaoForm'])=="editar"||trim($_POST['acaoForm'])=="editar-continuar") {
			$idEditavel = $_POST['iditem'];
			$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
	
			$_POST['nome'] = str_replace("'", "@aspa_simples@", $_POST['nome']);
			$_POST['nome'] = str_replace("\"", "@aspa_dupla@", $_POST['nome']);
	
			$_POST['link'] = str_replace("'", "@aspa_simples@", $_POST['link']);
			$_POST['link'] = str_replace("\"", "@aspa_dupla@", $_POST['link']);
			$_POST['link'] = str_replace("<", "@html_link@", $_POST['link']);
	
			$_POST['family'] = str_replace("'", "@aspa_simples@", $_POST['family']);
			$_POST['family'] = str_replace("\"", "@aspa_dupla@", $_POST['family']);
	
			# Gravação do Log
			$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$idEditavel."'"));
			$logPerfil = "administrador";
			$logId = $sysusu['id'];
			$logAcao = "Editou";
			$logLocal = "Usuários";
			$logDescricao = "Foi editado o item <b>".$itemAntes['nome']."</b>";
			$logData = $data;
	
			$_POST['dataModificacao'] = $data;
	
			update($_POST,$mod,$idEditavel);
		} else {
			if(trim($_POST['acaoForm'])=="excluir") {
				foreach ($_POST['msg_sel'] as $idcheck) {
					$sql = mysql_query("DELETE FROM ".$mod." WHERE id='".$idcheck."'");
				}
			} else {
				if(trim($_POST['acaoForm'])=="publicar") {
					foreach ($_POST['msg_sel'] as $idcheck) {
						$sql = mysql_query("UPDATE ".$mod." SET stat='1' WHERE id='".$idcheck."'");
					}
				} else {
					if(trim($_POST['acaoForm'])=="despublicar") {
						foreach ($_POST['msg_sel'] as $idcheck) {
							$sql = mysql_query("UPDATE ".$mod." SET stat='0' WHERE id='".$idcheck."'");
						}
					} else {
					}
				}
			}
		}
	}

	gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);
	if(trim($_POST['acaoForm'])=="add-continuar"||trim($_POST['acaoForm'])=="editar-continuar") {
		$item = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE numeroUnico='".$_POST['numeroUnico']."'"));
		echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/editar/".$item['id']."/','_self','')</script>";
	} else {
		echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
	}
?>