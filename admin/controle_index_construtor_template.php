<?
					$mod = str_replace("-","_",$_REQUEST['var2']);
		
					$nSqlModCampo = mysql_num_rows(mysql_query("SELECT id,id_construtor_modulo FROM _construtor_modulo_campo WHERE id_construtor_modulo='".$modulo_set['id']."'"));
		
					if (mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$linguagem_set."".$mod."_estrutura'"))>0) {
		
						if(trim($row_minha_config['qtd_paginacao'])==0||trim($row_minha_config['qtd_paginacao'])=="") { 
							if(trim($row_estrutura['qtd_paginacao'])==0||trim($row_estrutura['qtd_paginacao'])=="") { 
								if(trim($sysconfig[0]['qtd_paginacao'])==0||trim($sysconfig[0]['qtd_paginacao'])=="") { 
									$itens_por_pagina = 50; 
								} else { 
									$itens_por_pagina = $sysconfig[0]['qtd_paginacao']; 
								}
							} else { 
								$itens_por_pagina = $row_estrutura['qtd_paginacao']; 
							}
						} else { 
							$itens_por_pagina = $row_minha_config['qtd_paginacao']; 
						}
					}
		
					$caminho1 = "".$modulo_set['nome']."";
					$url_mod_navega = str_replace("_","-",$modulo_set['nome_base']);
					$caminhourl1 = "".$link."".$chave_url."".$modulo_set_categoria['url_amigavel']."/".$url_mod_navega."/";
		
					if(trim($_REQUEST['var3'])=="editar")    {
						$UrlAtual = $caminhourl1."".$_REQUEST['var3']."/".$_REQUEST['var4']."/";
					} else {
						$UrlAtual = $caminhourl1;
					}
					
					if(strrpos($_SESSION["urls_navegadas"],"|".$UrlAtual."|") === false) { 
						if(trim($_SESSION["urls_navegadas"])=="") {
							$_SESSION["urls_navegadas"] = "|".$UrlAtual."|";
						} else {
							$_SESSION["urls_navegadas"] = $_SESSION["urls_navegadas"].",|".$UrlAtual."|";
						}
					} else { 
					}
					
					if(trim($modulo_set['tipo'])==""||trim($modulo_set['tipo'])=="construtor") {
						include("templates/".$layout_padrao_set."/mod".PATH_MOD."/_construtor_template/navega.php");
					} else {
						include("templates/".$layout_padrao_set."/mod".PATH_MOD."/".$modulo_set['nome_base']."/navega.php");
					}
?>
