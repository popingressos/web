<?
	$caminho1 = "Usuários";
	$caminhourl1 = "".$link."usuarios/"; 

	if(trim($_REQUEST['var3'])=="")    { 
		$pagina="mod/".$mod."/list.php";  
	} else {
		if(trim($_REQUEST['var3'])=="detalhes")    { 
			$pagina="mod/".$mod."/list.php";    
			$id = "".$_REQUEST['var4']."";
			$confere = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE id='".$id."'"));
			if($confere==0) {
				$r = mysql_fetch_array(mysql_query("SELECT * FROM syssistema"));
				$pagina="404.php";    
				$caminho1 = "Página não encontrada"; 
			} else {
				$row = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$id."'"));
				$caminho2 = "Detalhes - ".$row['nome']."";
			}
		} else {
			if(trim($_REQUEST['var3'])=="editar")    { 
				$pagina="mod/".$mod."/list.php";    
				$id = "".$_REQUEST['var4']."";
				$confere = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE id='".$id."'"));
				if($confere==0) {
					$r = mysql_fetch_array(mysql_query("SELECT * FROM syssistema"));
					$pagina="404.php";    
					$caminho1 = "Página não encontrada"; 
				} else {
					$row = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$id."'"));
					$caminho2 = "Detalhes - ".$row['nome']."";
				}
			} else {
				if(trim($_REQUEST['var3'])=="excluir")    { 
					$id = "".$_REQUEST['var4']."";

					# Gravação do Log
					$dataLogout = ajustaDataReturn($data,"d/m/Y");
					$itemAntes = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$id."'"));
					$logPerfil = "administrador";
					$logId = $sysusu['id'];
					$logAcao = "Remover";
					$logLocal = "".$caminho1."";
					$logDescricao = "Foi removido o item <b>".$itemAntes['nome']."</b> na seguinte data: ".$dataLogout."";
					$logData = $data;
					gravaLog($logPerfil,$logId,$logAcao,$logLocal,$logDescricao,$logData);

					$sql = mysql_query("DELETE FROM ".$mod." WHERE id='".$id."'"); // deletando

					echo"<script>window.open('".$link."".$_REQUEST['var1']."/".$_REQUEST['var2']."/','_self','')</script>";
				} else {
					if(trim($_REQUEST['var3'])=="permissoes")    { 
						$pagina="mod/".$mod."/list.php";    
						$id = "".$_REQUEST['var4']."";
						$confere = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE id='".$id."'"));
						if($confere==0) {
							$r = mysql_fetch_array(mysql_query("SELECT * FROM syssistema"));
							$pagina="404.php";    
							$caminho1 = "Página não encontrada"; 
						} else {
							$row = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$id."'"));
							$row_setado = unserialize($row['permissoes']);
							$caminho2 = "Permissões - ".$row['nome']."";
						}
					} else {
						if(trim($_REQUEST['var3'])=="historico-de-acessos")    { 
							$pagina="mod/".$mod."/list.php";    
							$id = "".$_REQUEST['var4']."";
							$confere = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE id='".$id."'"));
							if($confere==0) {
								$r = mysql_fetch_array(mysql_query("SELECT * FROM syssistema"));
								$pagina="404.php";    
								$caminho1 = "Página não encontrada"; 
							} else {
								$row = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$id."'"));
								$caminho2 = "Histórico de Acessos - ".$row['nome']."";
							}
						} else {
							if(trim($_REQUEST['var3'])=="historico-de-operacoes")    { 
								$pagina="mod/".$mod."/list.php";    
								$id = "".$_REQUEST['var4']."";
								$confere = mysql_num_rows(mysql_query("SELECT * FROM ".$mod." WHERE id='".$id."'"));
								if($confere==0) {
									$r = mysql_fetch_array(mysql_query("SELECT * FROM syssistema"));
									$pagina="404.php";    
									$caminho1 = "Página não encontrada"; 
								} else {
									$row = mysql_fetch_array(mysql_query("SELECT * FROM ".$mod." WHERE id='".$id."'"));
									$caminho2 = "Histórico de Operações - ".$row['nome']."";
								}
							} else {
								$r = mysql_fetch_array(mysql_query("SELECT * FROM conteudo WHERE toDO='erro-404'"));
								$pagina="404.php";    
								$caminho1 = "Página não encontrada"; 
							}

						}

					}

				}

			}

		}

	}

?>