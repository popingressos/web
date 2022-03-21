<?
// Recebe a URL digitada
#$url_digitada = $_SERVER['REQUEST_URI'];
 
$pos_url_digitada = strpos($_SERVER['REQUEST_URI'], "?");
if(trim($pos_url_digitada)=="" || $pos_url_digitada==0) { 
	$url_digitada = $_SERVER['REQUEST_URI'];
} else {
	$url_digitada = substr($_SERVER['REQUEST_URI'],0,$pos_url_digitada-1);
}
 
// Transforma a URL em array separando a string a cada barra
$url_array = explode("/", $url_digitada);
 
#Esta versão de leitura da url serve para o site no ar
if(trim($url_array[1])==""){
} else {
	$_REQUEST['var1'] = $url_array[1];

	if(trim($url_array[2])==""){
	} else {
		$_REQUEST['var2'] = $url_array[2];

		if(trim($url_array[3])==""){
		} else {
			$_REQUEST['var3'] = $url_array[3];

			if(trim($url_array[4])==""){
			} else {
				$_REQUEST['var4'] = $url_array[4];

				if(trim($url_array[5])==""){
				} else {
					$_REQUEST['var5'] = $url_array[5];
	
					if(trim($url_array[6])==""){
					} else {
	
						$_REQUEST['var6'] = $url_array[6];

						if(trim($url_array[7])==""){
						} else {
		
							$_REQUEST['var7'] = $url_array[7];
						}
					}
				}
			}
		}
	}
}

?>