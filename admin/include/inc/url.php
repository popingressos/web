<?
$_SERVER['REQUEST_URI'] = anti_injection($_SERVER['REQUEST_URI']);

// Recebe a URL digitada
$url_digitada = $_SERVER['REQUEST_URI'];
 
// Transforma a URL em array separando a string a cada barra
$url_array = explode("/", $url_digitada);
 
// Verifica se a primeira posição está vazia
if(trim($url_array[1])==""){
} else {
	$_REQUEST['raiz'] = $url_array[1];

	if(trim($url_array[2])==""){
	} else {
		$_REQUEST['chave'] = $url_array[2];
	
		if(trim($url_array[3])==""){
		} else {
			$_REQUEST['var1'] = $url_array[3];
	
			if(trim($url_array[4])==""){
			} else {
				$_REQUEST['var2'] = $url_array[4];
	
				if(trim($url_array[5])==""){
				} else {
					$_REQUEST['var3'] = $url_array[5];
	
					if(trim($url_array[6])==""){
					} else {
						$_REQUEST['var4'] = $url_array[6];
		
						if(trim($url_array[7])==""){
						} else {
		
							$_REQUEST['var5'] = $url_array[7];
	
							if(trim($url_array[8])==""){
							} else {
			
								$_REQUEST['var6'] = $url_array[8];
	
								if(trim($url_array[9])==""){
								} else {
				
									$_REQUEST['var7'] = $url_array[9];
	
									if(trim($url_array[10])==""){
									} else {
					
										$_REQUEST['var8'] = $url_array[10];
									}
								}
							}
						}
					}
				}
			}
		}
	}
}

if(trim($_REQUEST['var1'])=="confirma-email-suporte")    {
	$local = "templates/".$layout_padrao_set."/home.php";
} else {
	if(trim($_REQUEST['var2'])=="suporte"&&trim($_REQUEST['var2'])=="responder") {
		$local = "templates/".$layout_padrao_set."/home.php";
	} else {
		if(trim($_REQUEST['var2'])==""||trim($_REQUEST['var2'])=="index.php") {
			if(trim($_COOKIE["email"])==""&&trim($_COOKIE["senha"])=="") {
				$local = "templates/".$layout_padrao_set."/login.php";
			} else {
				if(trim($sysusu['modelo_cms'])=="_v3") {
					$local = "templates/".$layout_padrao_set."/home_v3.php";
				} else {
					$local = "templates/".$layout_padrao_set."/home.php";
				}
			}
		} else {
			if(trim($_COOKIE["email"])==""&&trim($_COOKIE["senha"])=="") {
				$local = "templates/".$layout_padrao_set."/login.php";
			} else {
				if(trim($sysusu['modelo_cms'])=="_v3") {
					$local = "templates/".$layout_padrao_set."/home_v3.php";
				} else {
					$local = "templates/".$layout_padrao_set."/home.php";
				}
			}
		}
	}
}
?>